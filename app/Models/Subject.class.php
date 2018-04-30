<?php


class Subject {

	/***********************ATTRIBUTS***********************/
	
	// Identifiant
	private $subject_id=null;
	// Name
	private $name=null;
	// id_UE
	private $id_UE=null;
	// coeff
	private $coeff=null;


	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Create an instance of Subject using the database
	 * @param int $subject_id (database value)
	 * @return Subject instance corresponding to the $subject_id
	 * @throws Exception if the $subject_id is unkown
	 */
	public static function createFromId($subject_id){
		// TO DO
		$stmt = MyPDO::getInstance()->prepare("SELECT * FROM Subject WHERE id = :subject_id");
		$stmt->bindParam(':subject_id',$subject_id);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Subject"); 

		if (($object = $stmt->fetch()) !== false){
			return $object;
		}
		else{
			throw new Exception("Error Processing Request", 1);
		}
	}

	/********************GETTERS SIMPLES********************/
	
	/**
	 * Getter on the id
	 * @return int $subject_id
	 */
	public function getId() {
		return $this->subject_id;
	}

	/**
	 * Getter on the name
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Getter on the id_UE
	 * @return string $id_UE
	 */
	public function getIdUE() {
		return $this->id_UE;
	}

	/**
	 * Getter on the ects
	 * @return int $ects
	 */
	public function getEcts() {
		return $this->ects;
	}

	

	/*******************GETTERS COMPLEXES*******************/

	/**
	 * Fetch all the Subject
	 * Fold by semester then UE
	 * @return array<Subject> list of instance Subject
	 */
	public static function getAll() {
		$i=0;
		$tab = array();
		$pdo = MyPDO::getInstance()->prepare("SELECT * FROM Subject as S INNER JOIN UE as U ON S.UE_id = U.UE_id ORDER BY U.semester, U.name ");
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"UE");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}



	/**
	 * Récupère les matieres pour une UE par semestre
	 * Tri par semestre
	 * @param  $UE identifiant du film
	 * @return array<Cast> liste des instances de UE
	 */
	public static function getMatieresInUE($id_UE) {

		$i=0;
		$pdo = MyPDO::getInstance()->prepare("SELECT * FROM Matiere as M INNER JOIN UE as U ON U.id_UE = M.id_UE WHERE M.id_UE = :id_UE ORDER BY U.semester");
		$pdo->bindParam(':id_UE',$id);
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"UE");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}

	

}
