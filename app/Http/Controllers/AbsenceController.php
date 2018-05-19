<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AbsenceController extends Controller {


	public function getAbsByStudent($student_id) {

		if(!is_numeric($student_id)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 415);
		}
		
		$absences = DB::table('absence')
		->join('student', 'student.student_id', '=', 'absence.student_id')
		->where('student.student_id', $student_id)
		->get();

		$absencesArray = (array)$absences;
		$absencesArray = array_filter($absencesArray);
		if(empty($absencesArray)){
			return response()->json(['error' => 'Can\'t find absence for this student.'], 400);

		}

		return response()->json($absences);
    	
	}


	public function getAbsTenFisrtStudents($promo) {

		if(!is_numeric($promo)) {
			return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 415);
		}
		

		$students = DB::table('student')
		->join('absence', 'student.student_id', '=', 'absence.student_id')
		->select('student.student_id', DB::raw('count(*) as abs_count, student.student_id'))
		->where('student.promo_id', $promo)
		->orderBy('abs_count', 'DESC')
		->groupBy('student.student_id')
		->limit(10)
		->get();

		$studentsArray = (array)$students;
		$studentsArray = array_filter($studentsArray);
		if(empty($studentsArray)){
			return response()->json(['error' => 'Can\'t find students for this promo.'], 400);

		}

		return response()->json($students);


	}
    
}