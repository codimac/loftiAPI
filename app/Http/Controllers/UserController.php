<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller {

    public function getAuthUser() {
        return response()->json(Auth::user());
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