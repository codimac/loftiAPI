<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
     /**
	 * Fetch all the Subject of the database
	 */
    
   public static function getAll() {
		$subject=Subject::all();
		return $subject;
    }
    
    /**
	 * Récupère les matieres pour une UE par semestre
	 * Tri par semestre
	 * @param  $ue_id 
	 */
	public static function getSubjectInUE($ue_id) {        
        $subjects=Subject::join('ue', 'ue.id', '=', 'subject.ue_id')
        ->where('subject.ue_id', $ue_id)
        ->orderBy('ue.semester')
        ->get();
		return $subjects;
    }
    
    public static function createSubject(Request $request){
        Subject::insert(
            ['name' => $request->input('name'), 'coefficient' => $request->input('coefficient'),'ue_id' => $request->input('ue_id')]
		);
    }
}
=======
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

		$subjects = Subject::whereIn('ue_id', $ues)->get();
		//$subjects = $this->getSubjectsByUe($ues);

		// Si le tableau est vide (aucune matière trouvée)
		$subjectsArray = (array)$subjects;
		$subjectsArray = array_filter($subjectsArray);
		if(empty($subjectsArray)) {
    		return response()->json(['error' => 'Can\'t find subject for this semester.'], 400);
    	} else {
    		return response()->json($subjects);
    	}
	}

// Cette fonctionne ne marche pas à cause du fait que les fonctions que j'appelle 
	public function getSubjectsByPromo($year) {
		// Si $year n'est pas un INT 
		if(!is_numeric($year)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 415);
		}

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

// COUNT as SORT BY ASC LIMIT 10
>>>>>>> 4d33665d18a8b92ba5092d8d97d5a40a55c8e34d
