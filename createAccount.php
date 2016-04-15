<?php

// Start the session
session_start();

if(isset($_SESSION["time"])){
	session_unset(); 
	session_destroy(); 
	
} 

$whitelist = array('129.82.46', '129.82.45', '129.82.44');

//129.82.44.* and 129.82.45.

// check for correct ip
$ip = $_SERVER['REMOTE_ADDR'];
$ip = substr($ip, 0, 9);
if (!in_array($ip, $whitelist)){
	header("Location: index.php"); 
}

?>

<!DOCTYPE  html>
<html>
<link rel="stylesheet" type="text/css" href="mystyle1.css">

<div id="contents">
<div id = "header">
	<?php  
	include 'Header.inc';
	?>
</div>

<div id = "body">
	<h1>
	Login page
	</h1>

	<form action="createAccount.php", method="POST">
		First Name: <input type=text name='firstName'><br/>
		Middle Name: <input type=text name='midName'><br/>
		Last Name: <input type=text name='lastName'><br/>
		Phone #: <input type=text name='phone'><br/>
		Email Id: <input type=text name='email'><br/>
		Username: <input type=text name='username'><br/>
		Password: <input type=password name='pass'><br/>
		Confirm Password: <input type=password name='cPass'><br/>
		Have you had any of the following pets before?<br/>
		Dogs: 
		<input type="radio" name="dog" value='y'> Yes
		<input type="radio" name="dog" value='n'> No<br>
		Cats:
		<input type="radio" name="cat" value='y'> Yes
		<input type="radio" name="cat" value='n'> No<br>
		Turtles:
		<input type="radio" name="turtle" value='y'> Yes
		<input type="radio" name="turtle" value='n'> No<br>
		Are you interested in fostering a pet? <br>
		<input type="radio" name="petFos" value='y'> Yes
		<input type="radio" name="petFos" value='n'> No<br>
		Do you have a pet needing a home? <br>
		<input type="radio" name="needHome" value='y'> Yes
		<input type="radio" name="needHome" value='n'> No<br>
		If yes please explain: <br>
		<textarea name="needHomeText" rows="5" cols="40">Your answer here.</textarea><br>
		<input type=submit value = 'Submit' name='submit'>
	</form>

	<?php
<<<<<<< HEAD

	//if(!empty ($_POST['user'])  && !empty($_POST['pass'])){
	//	$user=filter_var($_POST['user'],FILTER_SANITIZE_STRING);
	// checks for required values 
		if (!empty($POST['firstName'])){ 
			$firstName=filter_var($_POST['firstName'],FILTER_SANITIZE_STRING);
		}else {
			echo "First Name Required";
		}
		/*
		if (!isset(lastName)){ echo "Last Name Required";}
		if (!isset(email)){ echo "Email Required";}
		if (!isset(username)){ echo "Username Required";}
		if (!isset(pass) || !isset(cPass)){ echo "Password required"}
		if (!(pass == cPass)){echo "Passwords don't match"}
		if (!isset(dog)){ echo "Please answer weither you have owned a dog in the past";}
		if (!isset(cat)){ echo "Please answer weither you have owned a cat in the past";}
		if (!isset(turtle)){ echo "Please answer weither you have owned a turtle in the past";}
		if (!isset(petFos)){ echo "Please answer weither you are interested in fostering a pet";}
		if (!isset(needHome)){ echo "Please answer weither you have a pet that needs a home";}
		*/
=======
		$problem = false;

	// checks for required values
		if (!isset($_POST['firstName'])) {
			echo "First Name Required";
			$problem = true;
		}
		else if(!isset($_POST['lastName'])) {
			echo "Last Name Required";
			$problem = true;
		}
		else if (!isset($_POST['phone'])) {
			echo "Phone # Required";
			$problem = true;
		}
		else {
			$phone = strip_tags($_POST['phone']);
			$phone = preg_replace('/([^\d]+)/', '', $phone);
			if(strlen($phone) > 10 || strlen($phone) < 9) {
				echo "Phone # must be real phone #.";
				$problem = true;
			}
			else if (!isset($_POST['email'])) {
				echo "Email Required";
				$problem = true;
			}
			else if (!isset($_POST['username'])) {
				echo "Username Required";
				$problem = true;
			}
			else if (!isset($_POST['pass']) || !isset($_POST['cPass'])) {
				echo "Password required";
				$problem = true;
			}
			else if (!($_POST['pass'] == $_POST['cPass'])) {
				echo "Passwords don't match";
				$problem = true;
			}
			else if (!isset($_POST['dog'])) {
				echo "Please answer weither you have owned a dog in the past";
				$problem = true;
			}
			else if (!isset($_POST['cat'])) {
				echo "Please answer weither you have owned a cat in the past";
				$problem = true;
			}
			else if (!isset($_POST['turtle'])) {
				echo "Please answer weither you have owned a turtle in the past";
				$problem = true;
			}
			else if (!isset($_POST['petFos'])) {
				echo "Please answer weither you are interested in fostering a pet";
				$problem = true;
			}
			else if (!isset($_POST['needHome'])) {
				echo "Please answer weither you have a pet that needs a home";
				$problem = true;
			}
		}

		if(!$problem) {
			$first = strip_tags($_POST['firstName']);
			$middle = strip_tags($_POST['midName']);
			$last = strip_tags($_POST['lastName']);

			$phone = strip_tags($_POST['phone']);
			$phone = preg_replace('/([^\d]+)/', '', $phone);

			$email = strip_tags($_POST['email']);
			$user_name = strip_tags($_POST['username']);
			$pass = strip_tags($_POST['pass']);
			$dogs = $_POST['dog'] === 'y' ? 1 : 0;
			$cats = $_POST['cat'] === 'y' ? 1 : 0;
			$turtles = $_POST['turtle'] === 'y' ? 1 : 0;
			$foster = $_POST['petFos'] === 'y' ? 1 : 0;
			$givingPet = $_POST['needHome'] === 'y' ? 1 : 0;
			$petExplain = strip_tags($_POST['needHomeText']);

			$pass = md5($pass);

			if($givingPet === 0)
			{
				$petExplain = '';
			}

			try
			{
				$dbh = new PDO("sqlite:./MyDatabase.db");
			}
			catch(PDOexception $e)
			{
				die;
			}

			$sql = "INSERT INTO users VALUES (NULL, :first_name, :middle_name, :last_name, :phone_num, :email, :user_name, :password, :hadDogs, :hadCats, :hadTurtles, :foster, :givingPet, :petExplination)";

			$stm = $dbh->prepare($sql);

			$stm->execute(array(':first_name' => $first, ':middle_name' => $middle, ':last_name' => $last, ':phone_num' => $phone, ':email' => $email, ':user_name' => $user_name, ':password' => $pass, ':hadDogs' => $dogs, ':hadCats' => $cats, ':hadTurtles' => $turtles, ':foster' => $foster, ':givingPet' => $givingPet, ':petExplination' => $petExplain));

			header('Location: ./index.php');

		}

>>>>>>> ceb454edd6ad67daf6e4104c82ecc1682796f3f0
	?>
</div>
<div id = "footer">
	<?php
  	include "Footer.inc";
    ?>
</div>
</div>
</html>
