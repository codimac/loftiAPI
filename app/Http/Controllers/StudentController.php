<?php

namespace App\Http\Controllers;

use App\Models\Student;
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

    /*public function create(Request $request) {

        $student = Student::create($request->all());
 
        return response()->json($student);
    }
 
    public function update(Request $request, $studentId) {
        $student = Student::find($studentId);
        $student->make = $request->input('lastname');
        $student->make = $request->input('firstname');
        $student->make = $request->input('username');
        $student->model = $request->input('password');
        $student->year = $request->input('year');
        $student->save();
 
        return response()->json($student);
    }  

    public function delete($studentId) {
        $student  = Student::find($studentId);
        $student->delete();
 
        return response()->json('Removed successfully.');
    }*/
}