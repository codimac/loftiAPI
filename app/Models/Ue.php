<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Ue extends Model
{
    protected $table = 'ue';
    protected $primaryKey = 'ue_id';
    public $timestamps = false;
	
}
=======
class Ue extends Model {
	protected $table = 'ue';
    protected $primaryKey = 'ue_id';
    public $timestamps = false;

 	protected $fillable = ['semester', 'ects', 'name'];
}

// Class App\Http\Controllers\Ue does not exist
// Sûrement une erreur toute bête...
>>>>>>> 4d33665d18a8b92ba5092d8d97d5a40a55c8e34d
