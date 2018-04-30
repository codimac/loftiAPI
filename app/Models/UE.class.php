<?php


class UE {

	/***********************ATTRIBUTS***********************/
	
	// Id
	private $UE_id=null;
	// Name
	private $name=null;
	// Semester
	private $semester=null;
	// ECTS
	private $ects=null;
	

	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Create an instance of UE using the database
	 * @param int $UE_id (database value)
	 * @return UE instance corresponding to the $UE_id
	 * @throws Exception if the $UE_id is unkown
	 */
	public static function createFromId($UE_id){
		$stmt = MyPDO::getInstance()->prepare("SELECT * FROM UE WHERE UE_id = :UE_id");
		$stmt->bindParam(':UE_id',$UE_id);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, "UE"); 

		if (($object = $stmt->fetch()) !== false){
			return $object;
		}
		else{
			throw new Exception("Error Processing Request", 1);
		}
		//	throw new Exception(...);
	}

	/********************GETTERS SIMPLES********************/
	
	/**
	 * Getter on the id
	 * @return int $id
	 */
	public function getId() {
		return $this->UE_id;
	}

	/**
	 * Getter on the name
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Getter on the semester
	 * @return string $semester
	 */
	public function getSemester() {
		return $this->semester;
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
	 * Fetch all the UE
	 * Fold by Semester
	 * @return array<UE> list of instance UE
	 */
	public static function getAll() {
		$i=0;
		$tab = array();
		$pdo = MyPDO::getInstance()->prepare("SELECT * FROM UE ORDER BY semester");
		$pdo->execute();
		$pdo->setFetchMode(PDO::FETCH_CLASS,"UE");
		while(($ligne = $pdo->fetch()) != false){
			$tab[$i]=$ligne;
			$i++;
		}
		return $tab;
	}

	

}
