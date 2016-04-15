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

	function getEmailByName($user_name)
	{
		$sql = "SELECT email FROM users WHERE user_name='$user_name'";

		$results = $this->query($sql);

		foreach($results as $row)
			return $row['email'];
	}

	function getUsers() {
		$sql = "SELECT * FROM users;";

		$results = $this->query($sql);

		$out = Array();

		foreach($results as $row)
		{
			$out [] = $row['user_name'];
		}

		return $out;
	}

	function setPass($user_name, $hash) {
		$sql = "UPDATE users SET password='$hash' WHERE user_name='$user_name'";

		$results = $this->query($sql);
	}
}
?>
