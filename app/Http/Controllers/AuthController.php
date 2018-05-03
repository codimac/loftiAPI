<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class AuthController extends Controller {

    protected $jwt;

    public function __construct(JWTAuth $jwt) 
    {
        $this->jwt = $jwt;
    }

    public function signIn(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            if (!$token = $this->jwt->attempt($request->only('username', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        return response()->json(compact('token'));
    }

    public function getAuthUser(Request $user_id) {
        // SELECT * FROM `user` WHERE `user_id`= $user_id
        $user = User::find($user_id);

        //return response()->json([
        //    'message' => 'Blalba'
        //]);

        return response()->json(compact($user));
    }
}