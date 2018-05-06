<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'subject_id';
    public $timestamps = false;


	/********************* CONSTRUCTOR S*********************/
	
	// Constructor unaccessible
	function __construct() {}

	/**
	 * Create an instance of Subject using the database
	 * @param int $subject_id (database value)
	 * @return Subject instance corresponding to the $subject_id
	 * @throws Exception if the $subject_id is unkown
	 */
	public static function createFromId($subject_id){
		$subject = App\Subject::find($subject_id); 
		return $subject;
	}

	/**
	 * Fetch all the Subject
	 * Fold by semester then UE
	 * @return array<Subject> list of instance Subject
	 */
	public static function getAll() {
		$i=0;
		$tab = array();
		$pdo = MyPDO::getInstance()->prepare("SELECT * FROM Subject as S INNER JOIN ue as U ON S.ue_id = U.ue_id ORDER BY U.semester, U.name ");
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"Subject");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}

	/**
	 * Récupère les matieres pour une UE par semestre
	 * Tri par semestre
	 * @param  $ue_id 
	 * @return array<Subject> liste des instances de UE
	 */
	public static function getSubjectInUE($ue_id) {

		$i=0;
		$pdo = MyPDO::getInstance()->prepare("SELECT * FROM Subject as M INNER JOIN ue as U ON U.ue_id = M.ue_id WHERE M.ue_id = :ue_id ORDER BY U.semester");
		$pdo->bindParam(':ue_id',$ue_id);
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"Subject");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}
}
