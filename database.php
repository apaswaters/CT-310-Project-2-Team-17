<?php
class Database extends PDO {
	public function __construct() {
		parent::__construct("sqlite:./MyDatabase.db");
	}

	function getNumberOfPets() {
		$pet_num = $this->query("SELECT count(*) FROM pets");
		return $pet_num->fetchColumn();
	}

	function getHashByName($user_name) {
		$sql = "SELECT password FROM users WHERE user_name='$user_name'";

		$results = $this->query($sql);

		foreach($results as $row)
			return $row['password'];
	}
}
?>
