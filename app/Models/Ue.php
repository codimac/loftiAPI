<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Class App\Http\Controllers\Ue does not exist
// Sûrement une erreur toute bête...

class Ue extends Model {
	protected $table = 'ue';
    protected $primaryKey = 'ue_id';
    public $timestamps = false;

 	protected $fillable = ['semester', 'ects', 'name'];
}