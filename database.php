<?php
class Database extends PDO {
	public function __construct() {
		parent::__construct("sqlite".__DIR__."/MyDatabase.db");
	}

	function getNumberOfPets() {
		$pet_num = $this->query("SELECT count(*) FROM pets");
		return $pet_num->fetchColumn();
	}

	
}
?>
