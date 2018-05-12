<?php

namespace App\Http\Controllers;

use App\Models\Ue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// Class App\Http\Controllers\Ue does not exist
// Sûrement une erreur toute bête...

class UeController extends Controller
{
    public function getAllUe() {
        $ue = Ue::all();

        return response()->json($ue);
    }

    public function getUeBySemester($semester) {
        if(is_numeric($semester)) {
            $ue = DB::table('ue')->where('semester', $semester)->get();

            $ueArray = (array)$ue;
                $ueArray = array_filter($ueArray);
                if(empty($ueArray))
                    return response()->json(['error' => 'Can\'t find that UE.'], 400);

            return response()->json($ue);
        }

        else
            return response()->json(['error' => 'Please enter a valid semester.'], 400);
    }
}