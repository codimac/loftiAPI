<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{


   /**
	 * Fetch all the Grade of the database
	 * @return array<Grade> list of instance Grade
	 */
    
   public static function getAll() {
		$grades=Grade::all();
		return $grades;
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


	public static function addGrade(Request $request){
        Subject::insert(
            ['name' => $request->input('name'), 'coefficient' => $request->input('coefficient'),'ue_id' => $request->input('ue_id')]
		);
    }

}
