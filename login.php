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

	<form action="login.php", method="POST">
		UserName: <input type=text name='user'><br/>
		Password: <input type=password name='pass'><br/>
		<input type=submit value = 'Submit' name='submit'>
	</form>

	<?php
	if(!empty ($_POST['user'])  && !empty($_POST['pass'])){
		$user=filter_var($_POST['user'],FILTER_SANITIZE_STRING);
		$pass=filter_var(md5($_POST['pass']),FILTER_SANITIZE_STRING);

		$user1= 'ct310';
		$pass1 = '63009f7c847ffbccb9422954b6c121b6';
		$user2 = 'salman';
		$pass2 = '5d41402abc4b2a76b9719d911017c592';
		$user3 = 'apaswate';
		$pass3 = '650cf75d8e46fd0a4f3e1d2e8967aa98';

 		if((($user == $user1 ) && ($pass == $pass1)) || (($user == $user2) && ($pass == $pass2)) || (($user == $user3) && ($pass == $pass3))){
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





