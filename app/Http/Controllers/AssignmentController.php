<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    /**
	 * Add grades and assignment associated
	 * input : request 
	 */

	public static function addGradesAssignment(Request $request){
        $name = $request->input('assignment.name');
        $description = $request->input('assignment.description');
		Assignment::insert(
			['name' => $name, 'description' => $description]
		);
        $current_assignment_id = Assignment::where('name', $name)->value("assignment_id"); //Foreign key constraint on the grade.assignment_id so we get the current assignment that is beign added to use it later.
        // $current_assignment_id = $current_assignment_id->assignment_id;
        //var_dump($current_assignment);
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
