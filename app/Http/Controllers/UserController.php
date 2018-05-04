<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller {

    protected $user_id;

    public function __construct(User $user_id) {
        $this->user_id = $user_id;
    }

    public function getAuthUser() {
        return response()->json(Auth::user());
    }
}
