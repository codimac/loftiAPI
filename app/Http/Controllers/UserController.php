<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller {

/* Renvoie les informations du user connecté */
    public function getAuthUser() {
        return response()->json(Auth::user());
    }

/*
    Teste le rôle du user connecté
        Retourne 0 si c'est un élève
        Retourne 1 si c'est un admin
*/
    public function isAdmin() {
        return Auth::user()->role_id;
    }
}