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



	// ERROR : 400 : y'en a pas   415 requetes incorrecte


	/** GRADES FOR A STUDENT */


	/**
	 * Fetch all the Grades for one student
	 * Input : request (student_id) or student name ?
	 * Sorted by subject.name 
	 * @return $grades with column (grade.grade, grade.coefficient, subject.name)
	 */
    
   public static function getGradesStudent($student_id) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->where('grade.student_id', $student_id)
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

	public static function getGradesStudentSubject($student_id, $subject_id) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->where([
			'subject.subject_id' => $subject_id,
			'grade.student_id' => $student_id
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

	public static function getGradesStudentUe($student_id, $ue_id) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->where([
			'ue.ue_id' => $ue_id,
			'grade.student_id' => $student_id
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

	public static function getGradesStudentSemester($student_id, $semester) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->where([
			'ue.semester' => $semester,
			'grade.student_id' => $student_id
		])->select('ue.name' ,'subject.name','subject.coefficient', 'grade.grade', 'grade.coefficient')
		->orderBy('ue.name')
		->get();
		return $grades;
	}


	
	/** GRADES FOR A PROMO */


	/** 
	 * Fetch all the grade for a promo
	 * Input : $year
	 * @return $grades with column ('student.student_id', subject.name, grade.grade, grade.coefficient)
	 */

	public static function getGradesPromo($year) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->where([
			'promo.year' => $promo
		])->select('student.student_id','subject.name','grade.grade', 'grade.coefficient')
		->get();
		return $grades;
	}


	/** 
	 * Fetch all the grade for a promo in a given subject
	 * Input : $year, $subject_id
	 * @return $grades with column (grade.grade, grade.coefficient)
	 */

	public static function getGradesPromoSubject($year, $subject_id) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->where([
			'subject.subject_id' => $subject_id,
			'promo.year' => $year
		])->select('student.student_id','grade.grade', 'grade.coefficient')
		->get();
		return $grades;
	}


	/** 
	 * Fetch all the grade for a promo in a given ue
	 * Input : $year, $ue_id
	 * Sorted by subject.name
	 * @return $grades with column (subject.name, subject.coefficient, grade.grade, grade.coefficient)
	 */

	public static function getGradesPromoUe($year, $ue_id) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->where([
			'ue.ue_id' => $ue_id,
			'promo.year' => $year
		])->select('student.student_id','subject.name','subject.coefficient', 'grade.grade', 'grade.coefficient')
		->orderBy('subject.name')
		->get();
		return $grades;
	}

	/** 
	 * Fetch all the grade for a promo in a given semester
	 * Input : $year, $semester
	 * Sorted by ue.name
	 * @return $grades with column (ue.name, subject.name, subject.coefficient,grade.grade, grade.coefficient)
	 */

	public static function getGradesPromoSemester($year, $semester) {
		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->where([
			'ue.semester' => $semester,
			'promo.year' => $year
		])->select('student.student_id','ue.name' ,'subject.name','subject.coefficient', 'grade.grade', 'grade.coefficient')
		->orderBy('ue.name')
		->get();
		return $grades;
	}




	/** ADD DELETE UPDATE GRADES / ASSIGNMENT */


	/**
	 * Add grades and assignment associated
	 * input : request 
	 */

	public static function addGradesAssignment(Request $request){
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
