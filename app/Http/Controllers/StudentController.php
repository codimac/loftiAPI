<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Absence;
use App\Models\Promo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getStudent($studentId) {

        $student = DB::table('student')
            ->join('user', 'user.user_id', '=', 'student.user_id')
            ->join('promo', 'promo.promo_id', '=', 'student.promo_id')
            ->where('student.student_id', $studentId)
            ->select('user.firstname', 'user.lastname', 'user.username', 'student.student_id', 'student.td', 'promo.year')
            ->get();
 
        return response()->json($student);
    }

    public function getTopAbsStudentsByPromo($promo) {

        if(!is_numeric($promo)) {
            return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 415);
        }

        $students = DB::table('student')
            ->join('absence', 'student.student_id', '=', 'absence.student_id')
            ->join('user', 'student.user_id', '=', 'user.user_id')
            ->join('promo', 'promo.promo_id', "=", "student.promo_id")
            ->select('user.user_id', 'user.username', 'user.lastname', 'user.firstname','student.promo_id', 'student.td', DB::raw('count(*) as abs_count, student.student_id'))
            ->where('promo.year', $promo)
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