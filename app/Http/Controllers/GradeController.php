<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;

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


	/** GRADES FOR A STUDENT */


	/**
	 * Fetch all the Grades for one student
	 * Input : request (student_id) or student name ?
	 * Sorted by subject.name 
	 * @return $grades with column (grade.grade, grade.coefficient, subject.name)
	 */
    
   public static function getGradesStudent(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->where('grade.student_id',$request->input('student_id'))
		->select('grade.grade', 'grade.coefficient', 'subject.name')
		->orderBy('subject.name')
		->get();
		return $grades;
	}	

	/** 
	 * Fetch all the grade for one student in a given subject
	 * Input : request (student_id, subject_id)
	 * @return $grades with column (grade.grade, grade.coefficient)
	 */

	public static function getGradesStudentSubject(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->where([
			'subject.subject_id' => $request->input('subject_id'),
			'grade.student_id' => $request->input('student_id')
		])->select('grade.grade', 'grade.coefficient')
		->get();
		return $grades;
	}

	/** 
	 * Fetch all the grade for one student in a given UE
	 * Input : request (student_id, ue_id)
	 * Sorted by subject.name
	 * @return $grades with column (subject.name, subject.coefficient, grade.grade, grade.coefficient)
	 */

	public static function getGradesStudentUe(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->where([
			'ue.ue_id' => $request->input('ue_id'),
			'grade.student_id' => $request->input('student_id')
		])->select('subject.name','subject.coefficient', 'grade.grade', 'grade.coefficient')
		->orderBy('subject.name')
		->get();
		return $grades;
	}

	/** 
	 * Fetch all the grade for one student in a given semester
	 * Input : request (student_id, semester)
	 * Sorted by ue.name
	 * @return $grades with column (ue.name, subject.name, subject.coefficient,grade.grade, grade.coefficient)
	 */

	public static function getGradesStudentSemester(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->where([
			'ue.semester' => $request->input('semester'),
			'grade.student_id' => $request->input('student_id')
		])->select('ue.name' ,'subject.name','subject.coefficient', 'grade.grade', 'grade.coefficient')
		->orderBy('ue.name')
		->get();
		return $grades;
	}


	
	/** GRADES FOR A PROMO */


	/** 
	 * Fetch all the grade for a promo in a given subject
	 * Input : request (promo, subject)
	 * @return $grades with column (grade.grade, grade.coefficient)
	 */

	public static function getGradesPromoSubject(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->where([
			'subject.subject_id' => $request->input('subject_id'),
			'student.promo' => $request->input('promo')
		])->select('grade.grade', 'grade.coefficient')
		->get();
		return $grades;
	}


	/** 
	 * Fetch all the grade for a promo in a given ue
	 * Input : request (promo, ue)
	 * Sorted by subject.name
	 * @return $grades with column (subject.name, subject.coefficient, grade.grade, grade.coefficient)
	 */

	public static function getGradesPromoUe(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->where([
			'ue.ue_id' => $request->input('ue_id'),
			'student.promo' => $request->input('promo')
		])->select('subject.name','subject.coefficient', 'grade.grade', 'grade.coefficient')
		->orderBy('subject.name')
		->get();
		return $grades;
	}

	/** 
	 * Fetch all the grade for a promo in a given semester
	 * Input : request (promo, semester)
	 * Sorted by ue.name
	 * @return $grades with column (ue.name, subject.name, subject.coefficient,grade.grade, grade.coefficient)
	 */

	public static function getGradesPromoSemester(Request $request) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->where([
			'ue.semester' => $request->input('semester'),
			'student.promo' => $request->input('promo')
		])->select('ue.name' ,'subject.name','subject.coefficient', 'grade.grade', 'grade.coefficient')
		->orderBy('ue.name')
		->get();
		return $grades;
	}




	/** ADD DELETE UPDATE GRADE FOR ONE STUDENT */


	/**
	 * Add a new grade and assignment associated to a student
	 * input : request 
	 */

	public static function addGrade(Request $request){
		Assignment::insert(
			['name' => $request->input('subject.name'), 'description' => $request->input('subject.description'), 'coefficient' => $request->input('subject.coefficient')]
		);
        Grade::insert(
            ['grade' => $request->input('grade.userId'),'subject_id' => $request->input('courseId'), 'student_id' => $request->input('grades.userID')]
		);
	}


	/**
	 * Add grades and assignments associated to a promo
	 * input : request 
	 */

	public static function addGradesPromo(Request $request){
		Assignment::insert(
			['name' => $request->input('subject.name'), 'description' => $request->input('subject.description'), 'coefficient' => $request->input('subject.coefficient')]
		);
		$current_assignment_id = Assignment::where('name', $request->input('name'))->select('assignment_id'); //Foreign key constraint on the grade.assignment_id so we get the current assignment that is beign added to use it later.
		$grades = $request->input('grades');
		foreach ($grades as $userID => $note) {
			Grade::insert(
            	['grade' => $note,'subject_id' => $request->input('courseId'), 'student_id' => $userID, 'assignment_id' => $current_assignment_id]
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
