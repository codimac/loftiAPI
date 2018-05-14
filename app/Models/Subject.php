<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Subject extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'subject_id';
    public $timestamps = false;

}
=======
 
class Subject extends Model
{ 
	public $table = "subject";
	protected $primaryKey = 'subject_id';
    public $timestamps = false;

 	protected $fillable = ['name', 'coefficient', 'ue_id'];

}
?>
>>>>>>> 4d33665d18a8b92ba5092d8d97d5a40a55c8e34d
