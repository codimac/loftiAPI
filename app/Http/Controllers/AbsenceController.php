<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;

class AbsenceController extends Controller {

	public function create(Request $request){
 
    	$abs = Absence::create($request->all());
 
    	return response()->json($abs);
 
	}
    
}