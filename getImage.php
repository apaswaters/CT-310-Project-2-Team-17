<?php
	require_once('database.php');

	if(!isset($_GET['id']))
		die();

	$db = new Database();
	$image = $db->getImage(intval($_GET['id']));
	if($image === FALSE)
		die();

	$name = "uploads/".str_pad($image->id, 5, "0", STR_PAD_LEFT).".".$image->ext;
	$fp = fopen($name, 'rb');

	$contentType = "Content-Type: ".$image->type;
	header($contentType);
	header("Content-Length: ".filesize($name));

	fpassthru($fp);
	exit();
?>
