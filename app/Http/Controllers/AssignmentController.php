<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;

class AssignmentController extends Controller
{

    /**
     * 
     * Sorted by UE
     */


    public static function getAssignments(){
        $assignmentsData = Assignment::join('grade', 'grade.assignment_id', '=', 'assignment.assignment_id') // Just to get the coefficient and the subject (grade.coefficient)
        ->join('subject', 'subject.subject_id', '=', 'grade.subject_id')
        ->join('ue', 'ue.ue_id', 'subject.ue_id')
        ->join('student', 'student.student_id', '=', 'grade.student_id')
        ->join('user', 'user.user_id', '=', 'student.user_id')
        ->select('ue.ue_id', 'ue.name AS ue_name', 'subject.subject_id', 'subject.name AS subject_name', 'assignment.assignment_id', 'assignment.name AS assignment_name', 'assignment.description', 'grade.coefficient')
        ->orderBy("ue.ue_id")
        ->get(); 



        foreach ($assignmentsData as $keys) {
            $current_ue = $keys->first();
        }

        // return $current_ue;
        return $assignmentsData;

        // $resultat->toArray();

        // return $resultat;
        
        // $assignments = collec(['name' => 'Desk', 'price' => 200]);

        // $keyed = $assignmentsData->keyBy('ue_id');

        // $grouped = $keyed->mapToGroups(function ($item, $key) {
        //     return [$item['subject_id'] => $item['subject_name']];
        // });

        // $key = $assignmentsData->keys();

        //The put method sets the given key and value in the collection:
        // $collection->put('key',$value);

        // $assignmentsData->toArray();

        // return $key;
        // return $grouped;
    }



	public static function addGradesAssignment(Request $request){
        $name = $request->input('assignment.name');
        $description = $request->input('assignment.description');
		Assignment::insert(
			['name' => $name, 'description' => $description]
		);
        $current_assignment_id = Assignment::where('name', $name)->value("assignment_id"); //Foreign key constraint on the grade.assignment_id so we get the current assignment that is beign added to use it later.
		$grades = $request->input('grades');
		foreach ($grades as $userID => $note) {
			Grade::insert(
            	['grade' => $note,'subject_id' => $request->input('subjectId'), 'student_id' => $userID, 'coefficient' => $request->input('assignment.coefficient'),'assignment_id' => $current_assignment_id]
			);
		} 
	}

	/**
	 * Update a grade to a student (same subject)
	 * input : request (grade, coefficient)
	 */
	public static function updateGrade(Request $request){
        Grade::update(
			['grade' => $request->input('grade'), 'coefficient' => $request->input('coefficient')])
			-> where('student_id', $request->input('student_id')
		);
	}
	
	/**
	 * Delete a grade from a student (same subject)
	 * input : request (grade_id)
	 */
	public static function deleteGrade(Request $request){
        Grade::delete()-> where('grade_id', $request->input('grade_id'));
    }
}


/*{
    promotionYear: 2020,
    semesterId: 2,
    ueId: 1,
    subjectId: 4,
    assignment: {
        name: "Devoir test",
        description: "Voilà l'ajout",
        coefficient: 2,
    },
    grades: {
        2: 10,
        3: 10
    }
}*/
