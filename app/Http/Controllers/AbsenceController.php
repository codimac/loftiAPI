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
		->join('user', 'student.user_id', '=', 'user.user_id')
		->select('student.student_id', 'user.username' 'absence.absence_id', 'absence.date', 'absence.justified')
		->where('student.student_id', $student_id)
		->get();

		$absencesArray = (array)$absences;
		$absencesArray = array_filter($absencesArray);
		if(empty($absencesArray)){
			return response()->json(['error' => 'Can\'t find absence for this student.'], 400);

		}

		return response()->json($absences);
    	
	}


}