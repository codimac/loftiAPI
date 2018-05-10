<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UE;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller {

	public function getSubjectsByUE($ue_id){


    	$subjects = Subject::where('ue_id', '=', $ue_id)->get();
    	return response()->json($subjects);

    	/*foreach($subjects as $subject){
		  echo $subject->name; 
		}

    	$json_data = json_decode($subjects, true);
		foreach($subject as $v){
		   echo $v['name'].'<br>';
		}*/
    	

    	/*$subjectArray = (array)$subject;
		$subjectArray = array_filter($subjectArray);
 
    	if(empty($subjectArray)){
    		return response()->json(['error' => 'Cant find that UE.'], 400);
    	}else{
    		return response()->json($subject);
    	}*/
 
	}

	public function getSubjectsBySemestrer($semester){

		$ues = UE::where('semester', '=', $semester)->get(['ue_id']);
		//return response()->json($ues);

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

		return response()->json($subjects);

	}





    
}