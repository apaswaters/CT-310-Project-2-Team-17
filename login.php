<?php

// Start the session
session_start();

if(isset($_SESSION["time"])){
	session_unset(); 
	session_destroy(); 
	
}

require_once('database.php');

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

	<form action="login.php", method="POST">
		UserName: <input type=text name='user'><br/>
		Password: <input type=password name='pass'><br/>
		<input type=submit value = 'Submit' name='submit'>
	</form>

	<?php
	if(!empty ($_POST['user'])  && !empty($_POST['pass'])){
		$user=filter_var($_POST['user'],FILTER_SANITIZE_STRING);
		$pass=filter_var(md5($_POST['pass']),FILTER_SANITIZE_STRING);

		$db = new Database();

 		if($pass === $db->getHashByName($user)) {
			echo " That is valid username and password for CT310";
			$_SESSION["time"] = date("h:i:sa");
			$_SESSION["user"] = $user;
	 
		    header("Location: index.php"); 
			echo $_SESSION["time"];
		}else{
			?>
			<h4>Invalid Login please try again</h4>
			<?php
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





