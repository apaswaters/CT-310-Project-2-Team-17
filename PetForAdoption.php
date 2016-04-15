<?php

// Start the session
session_start();

if(!isset($_SESSION["time"])){ 
	header("Location: login.php");
} 

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
		// checks for if info is set
		if (empty($_POST["short"])){
			echo "Short text Missing!";
		}else{
			$shortText = filter_var($_POST['short'],FILTER_SANITIZE_STRING);
									//Where you can add to database
		} 

		if (empty($_POST["long"])){
			echo "Long text Missing!";
		}else{
			$longText = filter_var($_POST['long'],FILTER_SANITIZE_STRING);
									//Where you can add to database
		}

		if (empty($_POST["weight"])){
			echo "Weight Missing!";
		}else{
			$weight = filter_var($_POST['weight'],FILTER_SANITIZE_STRING);
									//Where you can add to database
		}

		// image checks
		if (isset($_FILES["image"])){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
			// Check if file already exists
			if (file_exists($target_file)) {
    			echo "Sorry, file already exists.";
    			$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["image"]["size"] > 500000) {
    			echo "Sorry, your file is too large.";
    			$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    			$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
    			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
    			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        			echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    			} else {
        			echo "Sorry, there was an error uploading your file.";
    			}
			}
		}
	}
	?>
</div>
<div id = "footer">
	<?php
  	include "Footer.inc";
    ?>
</div>
</div>
</html>