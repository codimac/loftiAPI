<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $guarded = [
        'user_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        var_dump($this->user_id);
        // var_dump($this->join('role', 'user.role_id', '=', 'role.role_id')->get());

        return [
            'role_label' => $this->join('role', 'user.role_id', '=', 'role.role_id')
                ->where('user_id', $this->user_id)
                ->first()->label,
            'role_id' => $this->role_id
        ];
    }
}
