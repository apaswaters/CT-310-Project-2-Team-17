<?php

// Start the session
session_start();

require_once('database.php');

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="mystyle1.css">
</head>

<body>

	<div id = "contents">
		<div id = "header">
			<?php
				include 'Header.inc';
			?>
		</div>
		<div id = "body">
			<?php
				function generateRandomString($length=32)
				{
					$charSet = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$setLen = strlen($charSet);
					$out = "";
					for($i = 0; $i < $length; $i++)
					{
						$out .= $charSet[rand(0, $setLen - 1)];
					}
					return str_shuffle($out);
				}

				$db = new Database();

				if(isset($_GET['key']))
					$key = $_GET['key'];

				if(!isset($_SESSION['key']) || !isset($key))
				{
					if(isset ($_POST['full_name']) && $_POST['full_name'] !== "")
					{
	        				$_SESSION['key'] = generateRandomString();
						$_SESSION['full_name'] = $_POST['full_name'];

						$name = $_POST['full_name'];
						$email = $db->getEmailByName($_POST['full_name']);
						$content = "Follow this link to reset your password:\n".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."/passwordReset.php?key=".$_SESSION['key']."";
		
						if(mail($email, "Password Reset", $content))
						{
							echo "<p>An E-mail has been sent to $email containing a link to reset your password.</p>";
						}
					}
					else
					{
?>
			<p>Select your name:</p>
			<form action="" method="post">
			<select name="full_name">
			<?php
			echo "\n";
			$users = $db->getUsers();
			foreach ($users as $u)
			{
				echo "\t\t\t\t<option value=\"$u\" > $u </option>\n";
			}
			?>
			      </select>
			      <input type="submit" />
			  </form>
			<?php
					}

				}
				else if(isset($key) && $key === $_SESSION['key'])
				{
					if(isset($_POST['pass']))
					{
						$pass = $_POST['pass'];
						if($pass !== $_POST['confPass'])
						{
							echo "<span style=\"color:red\">Passwords must match.</span>\n";
			             			echo "<br>\n";
			   ?>
			  <p>Password Reset Form:</p>
			  <form action="" method="post">
			      <label for="password">Password: </label>
			      <input type="password" name="pass" id="password" />
			      <label for="confirm">Confirm Password: </label>
			      <input type="password" name="confPass" id="confirm"/>
			      <input type="submit" />
			  </form>
			<?php
						}
						else
						{
							$db->setPass($_SESSION['full_name'], md5($pass));
							unset($_SESSION['key']);
							unset($_SESSION['full_name']);
							unset($_POST['pass']);
							unset($_POST['confPass']);
							unset($key);
							header ( "Location: login.php" );
						}
					}
					else
					{
			?>
			  <p>Password Reset Form:</p>
			  <form action="" method="post">
			      <label for="password">Password: </label>
			      <input type="password" name="pass" id="password" />
			      <label for="confirm">Confirm Password: </label>
			      <input type="password" name="confPass" id="confirm"/>
			      <input type="submit" />
			  </form>
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

</body>

</html>
