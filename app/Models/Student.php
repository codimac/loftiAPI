<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {
	protected $table = 'student';
    protected $primaryKey = 'student_id';
    public $timestamps = false;

 	protected $fillable = ['lastname', 'firstname', 'username', 'password', 'promo', 'td', 'user_id'];
}