<?php namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
 	protected $fillable = ['lastname', 'firstname', 'username', 'password', 'promo', 'td', 'user_id'];
}