<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UE;

class SubjectController extends Controller {

	public function getSubjectsByUE($ue_id){

 
    	$subject = Subject::where('ue_id', '=', $ue_id)->get();
 
    	if(!$subject){
    		return response()->json(['error' => 'Cant find that UE.'], 400);
    	}else{
    		return response()->json($subject);
    	}
 
	}
    
}