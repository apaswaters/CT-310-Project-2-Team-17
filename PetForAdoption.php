<?php

// Start the session
session_start();

if(!isset($_SESSION["time"])){ 
	header("Location: login.php");
}

require_once("database.php");

?>

<!DOCTYPE  html>
<html>
<link rel="stylesheet" type="text/css" href="mystyle1.css">

<div id= "contents">
<div id = "header">
	<?php  
	include 'Header.inc';
	?>
</div>

<div id = "body">
	<h1>
	Pet for Adoption
	</h1>

	<form action="PetForAdoption.php" method="post" enctype="multipart/form-data">
		<input type="file" name="image" id="image" /><br/>
		Short Text: <input type="text" name="short" id="short" /><br/>
		Long Text: <br/>
		<textarea name="long" id="long" rows="5" cols="40"></textarea><br/>
		Weight: <input type="number" name="weight" id="weight" /><br/>
		<input type="hidden" name="hidden" id="hidden"/> 
		<input type=submit value = 'Submit' name='submit'>
	</form>

	<?php
	if (isset($_POST['hidden'])){

		$problem = FALSE;
		// checks for if info is set
		if (empty($_POST["short"])){
			echo "Short text Missing!";
			$problem = TRUE;
		}else{
			$shortText = filter_var($_POST['short'],FILTER_SANITIZE_STRING);
									//Where you can add to database
		} 

		if (empty($_POST["long"])){
			echo "Long text Missing!";
			$problem = TRUE;
		}else{
			$longText = filter_var($_POST['long'],FILTER_SANITIZE_STRING);
									//Where you can add to database
		}

		if (empty($_POST["weight"])){
			echo "Weight Missing!";
			$problem = TRUE;
		}else{
			$weight = filter_var($_POST['weight'],FILTER_SANITIZE_STRING);
									//Where you can add to database
		}

		// image checks
		$db = new Database();
		$fid;
		if (!$problem && $_FILES && isset($_FILES["image"])){
			$target_dir = "uploads/";
			$uploadOk = 1;
			$imageFileType = parseFileSuffix($_FILES['image']['type']);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
    			$check = getimagesize($_FILES["image"]["tmp_name"]);
    			if($check !== false) {
        			echo "File is an image - " . $check["mime"] . ".";
        			$uploadOk = 1;
    			} else {
        			echo "File is not an image.";
        			$uploadOk = 0;
    			}
			}
			// Check file size
			if ($_FILES["image"]["size"] > 500000) {
    			echo "Sorry, your file is too large.";
    			$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType === '') {
    			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    			$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
    			echo "Sorry, your file was not uploaded.";
			$problem = TRUE;
			// if everything is ok, try to upload file
			} else {
			$fid = $db->saveImage($_FILES["image"], $imageFileType);
			$target_file = str_pad($fid, 5, "0", STR_PAD_LEFT).".".$imageFileType;
    			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$target_file)) {
        			echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    			} else {
        			echo "Sorry, there was an error uploading your file.";
				$problem = TRUE;
    			}
			}
		}
		if(!$problem)
		{
			$db->insertPet(
				$fid,
				$weight,
				$shortText,
				$longText
			);
		}
	}
	?>
</div>
<div id = "footer">

	<?php
	function parseFileSuffix($iType)
	{
		if($iType === 'image/jpeg')
		{
			return 'jpg';
		}
		if($iType === 'image/gif')
		{
			return 'gif';
		}
		if($iType === 'image/png')
		{
			return 'png';
		}
		if($iType === 'image/tif')
		{
			return 'tif';
		}
		return '';
	}
	?>

	<?php
  	include "Footer.inc";
    ?>
</div>
</div>
</html>
