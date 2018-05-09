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

    public function getStudentsByPromo($semester_id) {
        $ue = DB::table('ue')->where('semester_id', $semester_id)->get();

        return response()->json($ue);
    }
}