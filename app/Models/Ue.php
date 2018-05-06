<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ue extends Model
{
    protected $table = 'ue';
    protected $primaryKey = 'ue_id';
    public $timestamps = false;

	/********************* CONSTRUCTOR *********************/
	
	// Constructor unaccessible
	function __construct() {}

	/**
	 * Create an instance of UE using the database
	 * @param int $ue_id (database value)
	 * @return UE instance corresponding to the $ue_id
	 * @throws Exception if the $ue_id is unkown
	 */
	public static function createFromId($ue_id){
		$ue = App\Subject::find($ue_id); 
		return $ue;
	}
	
	/**
	 * Fetch all the UE
	 * Fold by Semester
	 * @return array<UE> list of instance UE
	 */
	public static function getAll() {
		$i=0;
		$tab = array();
		$pdo = MyPDO::getInstance()->prepare("SELECT * FROM ue ORDER BY semester");
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"UE");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}
}
