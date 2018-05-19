<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class Absence extends Model 
{ 
	public $table = "absence";
	protected $primaryKey = 'absence_id';
    public $timestamps = false;

 	protected $fillable = ['student_id', 'beginning', 'end', 'justified'];

}
?>