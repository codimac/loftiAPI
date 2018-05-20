<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Promo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    public function getAllStudents() {
        $students = DB::table('student')
                        ->join('user', 'user.user_id', '=', 'student.user_id')
                        ->join('promo', 'promo.promo_id', '=', 'student.promo_id')
                        ->select('user.firstname', 'user.lastname', 'user.username', 'student.student_id', 'student.td', 'promo.year')
                        ->get();

        return response()->json($students);
    }

    public function getStudentsByPromo($year) {
        if(!is_numeric($year))
            return response()->json(['error' => 'Please enter a valid promotion. It must be an integer.'], 400);
        
        $students = DB::table('student')
                    ->join('user', 'user.user_id', '=', 'student.user_id')
                    ->join('promo', 'promo.promo_id', '=', 'student.promo_id')
                    ->where('promo.year', $year)
                    ->select('user.firstname', 'user.lastname', 'user.username', 'student.student_id', 'student.td', 'promo.year')
                    ->get();

        $studentsArray = (array)$students;
            $studentsArray = array_filter($studentsArray);
            if(empty($studentsArray))
                return response()->json(['error' => 'Can\'t find that promotion.'], 400);

        return response()->json($students);
    }

    public static function getSemestersByPromo($year) {
        // Si $year n'est pas un INT
        if(!is_numeric($year)) {
            return response()->json(['error' => 'The supplied request data is not in a format acceptable for processing by this resource. It must be an integer.'], 400);
        }

        $date = getdate();
        $currentYear = $date['year'];
        $currentMonth = $date['mon'];

        if($currentMonth<8 && $currentYear<=$year-3)
            // Si la promo n'est pas encore à l'IMAC 
            return response()->json(['error' => 'Can\'t find semesters for this promo. This promo does not exist yet.'], 400);

        else if(($currentMonth>8 && $currentYear<=$year) || ($currentYear>$year))
            // Si la promo n'est plus présente à l'IMAC 
            return response()->json(['error' => 'Can\'t find semesters for this promo. This promo does not exist anymore.'], 400);

        else {
            // La promo est présente à l'IMAC
            if(($currentMonth<8 && $currentYear==$year) || ($currentMonth>8 && $currentYear==$year-1)) {
                //IMAC 3
                return response()->json(['semesters' => array(5, 6),
                                        'name' => 'IMAC 3']);

            } else if(($currentMonth<8 && $currentYear==$year-1) || ($currentMonth>8 && $currentYear==$year-2)) {
                //IMAC 2
                return response()->json(['semesters' => array(3, 4),
                                        'name' => 'IMAC 2']);

            } else if(($currentMonth<8 && $currentYear==$year-2) || ($currentMonth>8 && $currentYear==$year-3)) {
                //IMAC 1
                return response()->json(['semesters' => array(1, 2),
                                        'name' => 'IMAC 1']);
            }
        }
    }
}