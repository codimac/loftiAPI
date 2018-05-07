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
