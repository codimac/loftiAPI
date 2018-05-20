<?php

namespace App\Http\Controllers;
use App\Models\Ue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UeController extends Controller
{
    public function getAllUes() {
        $ues = Ue::all();

        return response()->json($ues);
    }

    public function getUesBySemester($semesterId) {
        if(!is_numeric($semesterId))
            return response()->json(['error' => 'Please enter a valid semester. It must be an integer.'], 400);

        $ues = DB::table('ue')->where('semester', $semesterId)->get();

        $uesArray = (array)$ues;
            $uesArray = array_filter($uesArray);
            if(empty($uesArray))
                return response()->json(['error' => 'Can\'t find that UE.'], 400);

        return response()->json($ues);
    }
}
