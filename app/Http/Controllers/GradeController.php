<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{


   /**
	 * Fetch all the Grade of the database
	 * @return array<Grade> list of instance Grade
	 */
    

   public static function getAll() {
		$grades=Grade::all();
		return $grades;
	}
}
