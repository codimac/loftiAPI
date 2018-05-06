<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grade';
    protected $primaryKey = 'grade_id';
    public $timestamps = false;
	

	/*********************CONSTRUCTEURS*********************/
	
	// Constructor unaccessible
	function __construct() {}

	/**
	 * Create an instance of Grade using the database
	 * @param int $grade_id (database value)
	 * @return Grade instance corresponding to the $grade_id
	 * @throws Exception if the $grade_id is unkown
	 */
	public static function createFromId($grade_id){
		$grade = App\Subject::find($grade_id); 
		return $grade;
    }
	
	
	/**
	 * Fetch all the Grade of the database
	 * @return array<Grade> list of instance Grade
	 */
	public static function getAll() {
		// TO DO
		$i=0;
		$tab = array();
		$pdo = MyPDO::getInstance()->prepare("SELECT * FROM Grade");
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"Grade");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}


    /**
	 * Fetch all the Grade 
     * Fold by semester then UE and subject
	 * @return array<Grade> list of instance grade
	 */
	public static function getGradesFolded($student_id) {
		$i=0;
		$tab = array();
		$pdo = MyPDO::getInstance()->prepare("SELECT G.grade, S.name FROM Grade as G INNER JOIN Subject as S ON G.subject_id = S.subject_id INNER JOIN UE as U ON S.UE_id = U.UE_id INNER JOIN 
        WHERE G.student_id = :student_id ORDER BY U.semester, U.name");
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"Grade");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}


    /**
	 * Fetch all the Grade for one student
     * Fold by semester then UE and subject
	 * @return array<Grade> list of instance grade
	 */
	public static function getStudentGradeFolded($student_id) {
		$i=0;
		$tab = array();
		$pdo = MyPDO::getInstance()->prepare("SELECT G.grade, S.name FROM Grade as G INNER JOIN Subject as S ON G.subject_id = S.subject_id INNER JOIN UE as U ON S.UE_id = U.UE_id
        WHERE G.student_id = :student_id ORDER BY U.semester, U.name");
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"Grade");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
    }
    
    /* Actions upons table */

    /*
	 * Add one grade to one student
	 */

    public static function addGradeStudent($grade, $coefficient, $subject_id, $student_id) {
		$stmt = MyPDO::getInstance()->prepare("INSERT INTO grade (grade, coefficient, subject_id, student_id) VALUES (':grade',':coefficient',':subject_id',':student_id')");
		$stmt->bindParam(':grade',$grade);
		$stmt->bindParam(':coefficient',$coefficient);
		$stmt->bindParam(':subject_id',$subject_id);
		$stmt->bindParam(':student_id',$subject_id);
        $stmt->execute();
    }

    /*
	 * Add one grade to multiple student
     * Need tab of student_id
	 */

    public static function addGradeStudents($grade, $coefficient, $subject_id, $tab_student_id) {
		$stmt = MyPDO::getInstance()->prepare("INSERT INTO grade (grade, coefficient, subject_id, student_id) VALUES (':grade',':coefficient',':subject_id',':student_id')");
		$stmt->bindParam(':grade',$grade);
		$stmt->bindParam(':coefficient',$coefficient);
        $stmt->bindParam(':subject_id',$subject_id);
        foreach ($tab_student as $value) {
           $stmt->bindParam(':student_id',$student_id); 
           $stmt->execute();
        }
    }


    /*
	 * Update one student's grade
     * Need to know grade_id
	 */

    public static function UpdateGradeStudent($grade_id, $new_grade) {
		$stmt = MyPDO::getInstance()->prepare("UPDATE grade SET grade = :new_grade WHERE grade_id = :grade_id");
		$stmt->bindParam(':new_grade',$new_grade);
        $stmt->bindParam(':grade_id',$grade_id);
        $stmt->execute();
    }


}
