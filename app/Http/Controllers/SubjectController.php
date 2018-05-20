<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UE;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
	public function getSubjectsByUe($ueId) {
		// Si $ueId n'est pas un INT 
		if(!is_numeric($ueId)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 400);
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
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 400);
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

	public function getSubjectsByPromo($year) {
		// Si $currentYear n'est pas un INT 
		if(!is_numeric($year)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 400);
		}

		$date = getdate();
        $currentYear = $date['year'];
        $currentMonth = $date['mon'];

        if($currentMonth<8 && $currentYear<=$year-3)
            // Si la promo n'est pas encore à l'IMAC 
            return response()->json(['error' => 'Can\'t find subjects for this promo. This promo does not exist yet.'], 400);

        else if(($currentMonth>8 && $currentYear<=$year) || ($currentYear>$year))
            // Si la promo n'est plus présente à l'IMAC 
            return response()->json(['error' => 'Can\'t find subjects for this promo. This promo does not exist anymore.'], 400);

        else {
            // La promo est présente à l'IMAC
            if(($currentMonth<8 && $currentYear==$year) || ($currentMonth>8 && $currentYear==$year-1)) {
                //IMAC 3
                $semesters = array(5, 6);

            } else if(($currentMonth<8 && $currentYear==$year-1) || ($currentMonth>8 && $currentYear==$year-2)) {
                //IMAC 2
                $semesters = array(3, 4);

            } else if(($currentMonth<8 && $currentYear==$year-2) || ($currentMonth>8 && $currentYear==$year-3)) {
                //IMAC 1
                $semesters = array(1, 2);
			}
        }

        /* METHODE DE AUBANE : mix de matières de plusieurs promos
    		if(($currentMonth<8 && $currentYear==$promo) || ($currentMonth>8 && $currentYear==$promo-1)){
 				$ues = UE::whereIn('semester', array(5,6))->get();
 			}else if(($currentMonth<8 && $currentYear==$promo-1) || ($currentMonth>8 && $currentYear==$promo-2)){
 				$ues = UE::whereIn('semester', array(3,4))->get();
 			}else if(($currentMonth<8 && $currentYear==$promo-2) || ($currentMonth>8 && $currentYear==$promo-3)){
 				$ues = UE::whereIn('semester', array(1,2))->get();				
 			}
 
			$subjects = Subject::whereIn('ue_id', $ues)->get();
        */

		/* Double requête : un semestre écrase l'autre. Ne fonctionne pas non plus avec un foreach. */
		$ues = UE::where('semester', $semesters)->get(['ue_id']);
		$subjects = Subject::whereIn('ue_id', $ues)->get();

		/* L'appel à une fonction d'un autre controller n'est pas concluant car celle-ci renvoie plus de data que nécessaire */
		// $subjects = $this->getSubjectsBySemester($semesters);

		/* La jointure fonctionne bien sur phpmyadmin mais je n'arrive pas à obtenir les matières pour les deux semestres (au mieux, j'arrive à récupérer celle du premier ou du deuximèe semestre seul) */
        /* foreach ($semesters as $semester) {
        	if(isset($subjects)) {
	        	$subjects += DB::table('subject')
		            ->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		            ->where('ue.semester', $semester)
		            ->get();
        	}
        	else {
        		$subjects = DB::table('subject')
					->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
					->where('ue.semester', $semester)
					->get();
        	}
        }*/

		// Si le tableau est vide (aucune matière trouvée)
		$subjectArray = (array)$subjects;
		$subjectArray = array_filter($subjectArray);
		if(empty($subjectArray)) {
    		return response()->json(['error' => 'Can\'t find any subject for this promotion.'], 400);
    	} else {
    		return response()->json($subjects);
    	}
	}
    
    /*
    public function test() {
        return User::isAdmin();
    }
    */
}