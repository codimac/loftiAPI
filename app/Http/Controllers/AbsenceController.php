<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\User;

class AbsenceController extends Controller {

	public function create(Request $request){

		//On verifie que l'élève existe
		User::findOrFail($request->student_id);

		//On verifie que la date de debut est inférieur à la date de fin
		$dateBeg = date_create($request->beginning);
		$dateEnd = date_create($request->end);

		$diff = date_diff($dateBeg, $dateEnd)->format('%R%');
		if( $diff != "+"){
			return false; //(Je ne sais pas comment renvoyer un message d'erreur)
		}

    	$abs = Absence::create($request->all());
 
    	return response()->json($abs);
 
	}
    
}