<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UE;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller {

	public function getSubjectsByUE($ue_id){

		// Si $ue_id n'est pas un INT 
		if(!is_numeric($ue_id)){
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. IT MUST BE AN INTEGER'], 415);
		}

    	$subjects = Subject::where('ue_id', '=', $ue_id)->get();

    	/*foreach($subjects as $subject){
		  echo $subject->name; 
		}

    	$json_data = json_decode($subjects, true);
		foreach($subject as $v){
		   echo $v['name'].'<br>';
		}*/
    	
		// Si l'UE n'hésiste pas 
    	$subjectArray = (array)$subjects;
		$subjectArray = array_filter($subjectArray);
    	if(empty($subjectArray)){
    		return response()->json(['error' => 'Cant find that UE.'], 400);
    	}else{
    		return response()->json($subjects);
    	}
 
	}

	public function getSubjectsBySemestrer($semester){


		// Si $semester n'est pas un INT 
		if(!is_numeric($semester)){
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. IT MUST BE AN INTEGER'], 415);
		}


		$ues = UE::where('semester', '=', $semester)->get(['ue_id']);


		/*
		var_dump(json_decode($ues, true));
		echo '<br> random tab : ';
		$random = array_rand(json_decode($ues, true));
		echo $random.'<br>';
		var_dump(json_decode($ues, true)[$random]["ue_id"]);
		*/


		$subjects = Subject::whereIn('ue_id', $ues)->get();

		/*foreach($subjects as $subject){
		  echo $subject->name.'<br>'; 
		}*/

		//S'il n'y a pas de matières pour cet UE 
		$subjectArray = (array)$subjects;
		$subjectArray = array_filter($subjectArray);
		if(empty($subjectArray)){
    		return response()->json(['error' => 'Cant find subject for this semester.'], 400);
    	}else{
    		return response()->json($subjects);
    	}

	}

	public function getSubjectsByPromo($promo){

		// Si $promo n'est pas un INT 
		if(!is_numeric($promo)){
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. IT MUST BE AN INTEGER'], 415);
		}

		$date = getdate();

		$year = $date['year'];
		$mon = $date['mon'];

		if($mon<8 && $year<=$promo-3){ // Si la promo n'est pas encore à l'imac 
			//echo "Promo pas encore présente";
			return response()->json(['error' => 'Cant find subject for this promo. PROMO TOO YOUNG'], 400);
		}else if(($mon>8 && $year<=$promo) || ($year>$promo)){ // Si la promo n'est plus présente à l'imac 
			//echo "Promo plus présente";
			return response()->json(['error' => 'Cant find subject for this promo. PROMO TOO OLD'], 400);
		}else{ // La promo est présente à l'imac
			//echo "Promo présente </br>";

			if(($mon<8 && $year==$promo) || ($mon>8 && $year==$promo-1)){
				//echo "IMAC 3</br>";
				$ues = UE::whereIn('semester', array(5,6))->get();
			}else if(($mon<8 && $year==$promo-1) || ($mon>8 && $year==$promo-2)){
				//echo "IMAC 2</br>";
				$ues = UE::whereIn('semester', array(3,4))->get();
			}else if(($mon<8 && $year==$promo-2) || ($mon>8 && $year==$promo-3)){
				//echo "IMAC 1</br>";
				$ues = UE::whereIn('semester', array(1,2))->get();				
			}

			$subjects = Subject::whereIn('ue_id', $ues)->get();
			$subjectArray = (array)$subjects;
			$subjectArray = array_filter($subjectArray);
			if(empty($subjectArray)){
	    		return response()->json(['error' => 'Cant find subject for this year.'], 400);
	    	}else{
	    		return response()->json($subjects);
	    	}

		}
		
	}

    
}