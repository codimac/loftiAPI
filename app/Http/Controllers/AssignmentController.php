<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
	public static function addAssignment(Request $request){

        if(Auth::user()->role_id == 1){

            $name = $request->input('assignment.name');
            $description = $request->input('assignment.description');
            $coefficient = $request->input('assignment.coefficient');
            Assignment::insert(
                ['name' => $name, 'description' => $description, 'coefficient' => $coefficient]
            );
            // if there are grades associated then we can continue, else it's just an assignment
            $grades = $request->input('grades');
            if(isset($grades) && $grades != NULL){
                $current_assignment_id = Assignment::where('name', $name)->value("assignment_id"); 
                foreach ($grades as $userID => $grade) {
                    Grade::insert(
                        ['grade' => $grade,'subject_id' => $request->input('subjectId'), 'student_id' => $userID,'assignment_id' => $current_assignment_id]
                    );
                }
            }
        return response()->json(["Success" => "Everything has been added successfully"], 200);
        }
        else {
            return response()->json(["Error" => "You are not allowed to do that"], 403);
        }
    }
}




	
