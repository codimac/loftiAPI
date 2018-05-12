<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
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

    public function getAllStudents() {
        $students = Student::all();

        return response()->json($students);
    }

    // A DEPLACER DANS LE CONTROLLER PROMO
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