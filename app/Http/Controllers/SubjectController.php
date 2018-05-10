<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UE;

class SubjectController extends Controller {

	public function getSubjectsByUE($ue_id){


    	$subject = Subject::where('ue_id', '=', $ue_id)->get();
    	return response()->json($subject);

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
    
}