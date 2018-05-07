<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ue;

class UeController extends Controller
{
   /**
	 * Fetch all the Ue of the database
	 */
    
   public static function getAll() {
		$ue=Ue::all();
		return $ue;
	}

	public static function createUe(Request $request){
        Ue::insert(
            ['name' => $request->input('name'), 'semester' => $request->input('semester'), 'ects' => $request->input('ects')]
		);
    }
}
