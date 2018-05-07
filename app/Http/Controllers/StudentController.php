<?php
 
namespace App\Http\Controllers;
 
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
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

    public function findAll() {
        $students = Student::all();
        
        return response()->json($students);
    }
}