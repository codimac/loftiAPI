<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function getAuthUser() {
        return response()->json(Auth::user());
    }

/*
    Teste le rôle du user connecté
        Retourne 0 si c'est un élève
        Retourne 1 si c'est un admin
*/
    public function isAdmin() {
        if(getAuthUser()->role_id == 1)
            return 1;
        return 0;
    }

    public function create(Request $request) {
        $user = User::create($request->all());
        return response()->json($user);
    }
     
    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->lastname = $request->input('lastname');
        $user->firstname = $request->input('firstname');
        $user->username = $request->input('username');
        $user->password = $request->input('password');
        $user->role_id = $request->input('role_id');
        $user->save();
        
        return response()->json($user);
    }
}