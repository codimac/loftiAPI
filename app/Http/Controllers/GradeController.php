<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
   /**
	 * Fetch all the Grade of the database
	 * @return $grades
	 */
    
   public static function getAll() {
		$grades=Grade::all();
		return $grades;
	}

	/**
	 * Fetch all the Grades for one student
	 * @return $grades
	 */
    
   public static function getGradeStudent(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('user', 'user.user_id', '=', 'grade.student_id')
		->select('grade.grade', 'grade.coefficient', 'subject.name')
		->group('subject.name')
		->get();
		return $grades;
	}	

	/**
	 * Add a new grade to a student
	 * input : request (grade, coefficient, subject_id, user_id)
	 */

	public static function addGrade(Request $request){
        Grade::insert(
            ['grade' => $request->input('grade'), 'coefficient' => $request->input('coefficient'),'subject_id' => $request->input('subject_id'), 'student_id' => $request->input('student_id')]
		);
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
