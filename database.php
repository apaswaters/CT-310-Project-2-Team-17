<?php
require_once('image_class.php');
require_once('pet_class.php');
class Database extends PDO {
	public function __construct() {
		parent::__construct("sqlite:./MyDatabase.db");
	}

	public function saveImage($imgArray, $ext) {
		$sql = "INSERT INTO images (name, type, size, ext) VALUES (?,?,?,?)";
		$stm = $this->prepare($sql);
		$values = array(
			$imgArray["name"],
			$imgArray["type"],
			$imgArray["size"],
			$ext
		);
		if($stm->execute($values) === FALSE)
		{
			return -1;
		}
		else
		{
			return $this->lastInsertId("id");
		}
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

	function getPets() {		
		$sql = "SELECT * FROM pets;";

		$results = $this->query($sql);

		$out = Array();

		foreach($results as $row)
		{
			$out [] = new Pet($row['id'], $row['image'], $row['weight_lb'], $row['short'], $row['long']);
		}

		return $out;
	}

	function getImages() {		
		$sql = "SELECT * FROM images;";

		$results = $this->query($sql);

		$out = Array();

		foreach($results as $row)
		{
			$out [] = new Image($row['id'], $row['name'], $row['type'], $row['size'], $row['ext']);
		}

		return $out;
	}

	function getPet($id) {
		$id = SQLite3::escapeString($id);
		$sql = "SELECT * FROM pets WHERE id=$id";

		$results = $this->query($sql);
		
		foreach($results as $row)
			return new Pet($row['id'], $row['image'], $row['weight_lb'], $row['short'], $row['long']);

		return FALSE;
	}

	function getImage($id) {
		$id = SQLite3::escapeString($id);
		$sql = "SELECT * FROM images WHERE id=$id";

		$results = $this->query($sql);
		
		foreach($results as $row)
			return new Image($row['id'], $row['name'], $row['type'], $row['size'], $row['ext']);

		return FALSE;
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

	function insertPet($image_id, $wht, $shrt, $lng) {
		$sql = "INSERT INTO pets (image, weight_lb, short, long) VALUES (?,?,?,?)";

		$stm = $this->prepare($sql);
		$values = array(
			$image_id,
			$wht,
			$shrt,
			$lng
		);
		$stm->execute($values);
	}

}
?>
