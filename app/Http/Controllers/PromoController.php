<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Promo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    public function getAllStudents() {
        $students = Student::all();

        return response()->json($students);
    }

    public function getStudentsByPromo($year) {
        if(is_numeric($year)) {
            $students = DB::table('student')->where('promo', $year)->get();

            $studentArray = (array)$students;
                $studentArray = array_filter($studentArray);
                if(empty($studentArray))
                    return response()->json(['error' => 'Can\'t find that promotion.'], 400);

            return response()->json($students);
        }

        else
            return response()->json(['error' => 'Please enter a valid promotion.'], 415);
    }
}