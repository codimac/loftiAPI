<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Promo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    public function getAllStudents() {
        /*
        SELECT * FROM `student`
        JOIN `user` ON user.user_id = student.user_id
        JOIN `promo` ON promo.promo_id = student.promo_id
        WHERE promo.year = 2019
        */
        $students = DB::table('student')
                        ->join('user', 'user.user_id', '=', 'student.user_id')
                        ->join('promo', 'promo.promo_id', '=', 'student.promo_id')
                        ->select('user.firstname', 'user.lastname', 'student.td', 'promo.year')
                        ->get();

        return response()->json($students);
    }

    public function getStudentsByPromo($year) {
        if(is_numeric($year)) {
            /*$students = DB::table('student')
                        ->where('promo', $year)->get();*/

            $students = DB::table('student')
                        ->join('user', 'user.user_id', '=', 'student.user_id')
                        ->join('promo', 'promo.promo_id', '=', 'student.promo_id')
                        ->where('promo.year', $year)
                        ->select('user.firstname', 'user.lastname', 'student.td', 'promo.year')
                        ->get();

            $studentsArray = (array)$students;
                $studentsArray = array_filter($studentsArray);
                if(empty($studentsArray))
                    return response()->json(['error' => 'Can\'t find that promotion.'], 400);

            return response()->json($students);
        }

        else
            return response()->json(['error' => 'Please enter a valid promotion.'], 415);
    }
}