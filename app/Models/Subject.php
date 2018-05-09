<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 
class Subject extends Model
{ 
	public $table = "subject";
	protected $primaryKey = 'subject_id';
    public $timestamps = false;

 	protected $fillable = ['name', 'coefficient', 'ue_id'];

}
?>