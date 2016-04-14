<?php

// Start the session
session_start();

if(isset($_SESSION["time"])){
	session_unset(); 
	session_destroy(); 
	
} else{

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
	// checks for required values 
		if (!isset(firstName)){ echo "First Name Required";}
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
	?>
</div>
<div id = "footer">
	<?php
  	include "Footer.inc";
    ?>
</div>
</div>
</html>