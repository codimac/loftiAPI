<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UE;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
	public function getSubjectsByUe($ueId) {
		// Si $ueId n'est pas un INT 
		if(!is_numeric($ueId)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 415);
		}

    	$subjects = Subject::where('ue_id', $ueId)->get();

    	/*foreach($subjects as $subject) {
		  echo $subject->name; 
		}

    	$json_data = json_decode($subjects, true);
		foreach($subject as $v) {
		   echo $v['name'].'<br>';
		}*/
    	
		// Si l'UE n'hésiste pas 
    	$subjectArray = (array)$subjects;
		$subjectArray = array_filter($subjectArray);
    	if(empty($subjectArray)) {
    		return response()->json(['error' => 'Can\'t find that UE.'], 400);
    	} else {
    		return response()->json($subjects);
    	}
	}

	public function getSubjectsBySemester($semesterId) {
		// Si $semesterId n'est pas un INT
		if(!is_numeric($semesterId)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 415);
		}
		
		$ues = UE::where('semester', $semesterId)->get(['ue_id']);

		/*
		var_dump(json_decode($ues, true));
		echo '<br> random tab : ';
		$random = array_rand(json_decode($ues, true));
		echo $random.'<br>';
		var_dump(json_decode($ues, true)[$random]["ue_id"]);
		*/

		$subjects = Subject::whereIn('ue_id', $ues)->get();
		//$subjects = $this->getSubjectsByUe($ues);

		/*foreach($subjects as $subject) {
		  echo $subject->name.'<br>'; 
		}*/

		// Si le tableau est vide (aucune matière trouvée)
		$subjectsArray = (array)$subjects;
		$subjectsArray = array_filter($subjectsArray);
		if(empty($subjectsArray)) {
    		return response()->json(['error' => 'Can\'t find subject for this semester.'], 400);
    	} else {
    		return response()->json($subjects);
    	}
	}

	public function getSubjectsByPromo($year) {
    	// Cette fonction marchait correctement. Je ne sais pas ce que j'ai fait mais elle renvoit ça maintenant, quand je saisis un entier :
  		// {
		//     "headers": {},
		//     "original": {
		//         "error": "The supplied request data is not in a format acceptable for processing by this resource. It must be an integer."
		//     },
		//     "exception": null
		// }
		// Habiuellement, cette erreur ressemble à ça :
		// {
		//     "error": "The supplied request data is not in a format acceptable for processing by this resource. It must be an integer."
		// }
		// En fait jobitens cette erreur si je fais appel à une des fonctions ecrites plus hautes... Mais pourquoi ?
		

		// Si $year n'est pas un INT 
		if(!is_numeric($year)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 415);
		}
		
		// Je n'arrive pas à recuperer le "sous-tabeau" semesters qui vient de la fonction getSemestersByPromo($year)
		// et qui contient les deux semestres correspondant à la promo

		$semesters = PromoController::getSemestersByPromo($year);
		$semestersArray = (array)json_decode($semesters, true); ;
		$semestersArray = array_filter($semestersArray);
		var_dump($semestersArray);

		$subjects = $this->getSubjectsBySemester($semesters);
		
		// Si le tableau est vide (aucune matière trouvée)
		$subjectArray = (array)$subjects;
		$subjectArray = array_filter($subjectArray);
		if(empty($subjectArray)) {
    		return response()->json(['error' => 'Can\'t find subject for this promotion.'], 400);
    	} else {
    		return response()->json($subjects);
    	}
	}
}