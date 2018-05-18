<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;

class GradeController extends Controller
{
	
	/** GRADES FOR A STUDENT */


	/**
	 * Fetch all the Grades for one student
	 * Input : $student_id
	 * Sorted by subject.name 
	 * @return $grades with column (subject_name, grade.grade, grade_coefficient)
	 */
    
   public static function getGradesStudent($student_id) {
		if(!is_numeric($student_id))
            return response()->json(['error' => 'Please enter a valid id student. It must be an integer.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->where('grade.student_id', $student_id)
		->select('subject.name AS subject_name','grade.grade', 'assignment.coefficient AS grade_coefficient')
		->orderBy('subject.name')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}
	
		return $grades;
	}	

	/** 
	 * Fetch all the grade for one student in a given subject
	 * Input : $student_id, $subject_id
	 * @return $grades with column (grade.grade, grade_coefficient)
	 */

	public static function getGradesStudentSubject($student_id, $subject_id) {
		if(!is_numeric($student_id) || !is_numeric($subject_id))
            return response()->json(['error' => 'Please enter valid ids. They must be integers.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('assignment', 'assignment.assignment_id', '=', 'grade.assignment_id')
		->where([
			'subject.subject_id' => $subject_id,
			'grade.student_id' => $student_id
		])->select('grade.grade', 'assignment.coefficient AS grade_coefficient')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}

		return $grades;
	}

	/** 
	 * Fetch all the grade for one student in a given UE
	 * Input : $student_id, $ue_id
	 * Sorted by subject.name
	 * @return $grades with column (subject_name, subject_coefficient, grade.grade, grade_coefficient)
	 */

	public static function getGradesStudentUe($student_id, $ue_id) {
		if(!is_numeric($student_id) || !is_numeric($ue_id))
            return response()->json(['error' => 'Please enter valid ids. They must be integers.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('assignment', 'assignment.assignment_id', '=', 'grade.assignment_id')
		->where([
			'ue.ue_id' => $ue_id,
			'grade.student_id' => $student_id
		])->select('subject.name AS subject_name','subject.coefficient AS subject_coefficient', 'grade.grade', 'assignment.coefficient AS grade_coefficient')
		->orderBy('subject.name')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}

		return $grades;
	}

	/** 
	 * Fetch all the grade for one student in a given semester
	 * Input : $student_id, $semester)
	 * Sorted by ue.name
	 * @return $grades with column (ue_name, subject_name, subject_coefficient,grade.grade, grade_coefficient)
	 */

	public static function getGradesStudentSemester($student_id, $semester) {
		if(!is_numeric($student_id) || !is_numeric($semester))
            return response()->json(['error' => 'Please enter valid ids. They must be integers.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('assignment', 'assignment.assignment_id', '=', 'grade.assignment_id')
		->where([
			'ue.semester' => $semester,
			'grade.student_id' => $student_id
		])->select('ue.name AS ue_name' ,'subject.name AS subject_name','subject.coefficient AS subject_coefficient', 'grade.grade', 'assignment.coefficient AS grade_coefficient')
		->orderBy('ue.name')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}

		return $grades;
	}


	
	/** GRADES FOR A PROMO */


	/** 
	 * Fetch all the grade for a promo
	 * Input : $year
	 * @return $grades with column ('student.student_id', subject_name, grade.grade, grade_coefficient)
	 */

	public static function getGradesPromo($year) {
		if(!is_numeric($year))
            return response()->json(['error' => 'Please enter a valid promo year. It must be an integer.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->join('assignment', 'assignment.assignment_id', '=', 'grade.assignment_id')
		->where([
			'promo.year' => $promo
		])->select('student.student_id','subject.name AS subject_name','grade.grade', 'assignment.coefficient AS grade_coefficient')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}

		return $grades;
	}


	/** 
	 * Fetch all the grade for a promo in a given subject
	 * Input : $year, $subject_id
	 * @return $grades with column (student.student_id, grade.grade, grade_coefficient)
	 */

	public static function getGradesPromoSubject($year, $subject_id) {
		if(!is_numeric($year) || !is_numeric($subject_id))
            return response()->json(['error' => 'Please enter valid parameters. They must be integers.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->join('assignment', 'assignment.assignment_id', '=', 'grade.assignment_id')
		->where([
			'subject.subject_id' => $subject_id,
			'promo.year' => $year
		])->select('student.student_id','grade.grade', 'assignment.coefficient AS grade_coefficient')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}

		return $grades;
	}


	/** 
	 * Fetch all the grade for a promo in a given ue
	 * Input : $year, $ue_id
	 * Sorted by subject.name
	 * @return $grades with column (student.student_id, subject_name, subject_coefficient, grade.grade, grade_coefficient)
	 */

	public static function getGradesPromoUe($year, $ue_id) {
		if(!is_numeric($year) || !is_numeric($ue_id))
            return response()->json(['error' => 'Please enter valid parameters. They must be integers.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->join('assignment', 'assignment.assignment_id', '=', 'grade.assignment_id')
		->where([
			'ue.ue_id' => $ue_id,
			'promo.year' => $year
		])->select('student.student_id','subject.name AS subject_name','subject.coefficient AS subject_coefficient', 'grade.grade', 'assignment.coefficient AS grade_coefficient')
		->orderBy('subject.name')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}

		return $grades;
	}

	/** 
	 * Fetch all the grade for a promo in a given semester
	 * Input : $year, $semester
	 * Sorted by ue.name
	 * @return $grades with column (student.student_id, ue_name, subject_name, subject_coefficient,grade.grade, grade_coefficient)
	 */

	public static function getGradesPromoSemester($year, $semester) {
		if(!is_numeric($year) || !is_numeric($semester))
            return response()->json(['error' => 'Please enter valid parameters. They must be integers.'], 415);

		$grades=Grade::join('subject', 'subject.subject_id', '=', 'grade.subject_id')
		->join('ue', 'ue.ue_id', '=', 'subject.ue_id')
		->join('student', 'student.student_id', '=', 'grade.student_id')
		->join('promo', 'promo.promo_id', "=", "student.promo_id")
		->join('assignment', 'assignment.assignment_id', '=', 'grade.assignment_id')
		->where([
			'ue.semester' => $semester,
			'promo.year' => $year
		])->select('student.student_id','ue.name AS ue_name','subject.name AS subject_name','subject.coefficient AS subject_coefficient', 'grade.grade', 'assignment.coefficient AS grade_coefficient')
		->orderBy('ue.name')
		->get();

		if(empty($grades)){
			return response()->json(['error' => 'No grades for these parameters'], 400);
		}

		return $grades;
	}






	

}
