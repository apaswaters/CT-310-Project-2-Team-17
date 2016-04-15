<?php
$loginPage = TRUE;
$users = readUsers(); 

if (isset ( $_POST ['full_name'] )) {
	$name = strip_tags($_POST ['full_name']);
	$key = str_shuffle('abcdefghijklmnopqrstuvwxyz012345');
	$url = 'https://'.$_SERVER['HTTP_HOST'].'/~apaswate/passwordreset.php?key='.$key; 
	$file = fopen("users.csv", "r");
	$_SESSION['username'] = $name;
	$_SESSION['key'] = $key;
	while (!feof($file)){
		$line = fgetcsv($file);
		if ($line[2] == $name){
			$email = $line[4];
		}
	}
	fclose($file);
	if(mail($email, "Password Reset", $url)){
		echo "email has been sent\n";
	} else {
		echo "there was an error sending the email\n";
	}

	
	
}
?>
</head>
<!-- Start of page Body -->
<body>
 	<div class="header">
		<?php  
		include 'Header.inc';
		?>
	</div>
	<div class="contents">
		<p>Select your name:</p>
		<form action="forgot.php" method="post">
			<select name="full_name">	
			<?php 
			echo "\n";
			foreach ($users as $u) {
           $flag = ($u->full_name == $_SESSION['userName']) ? 'selected' : '';
           echo "\t\t\t\t<option value=\"$u->full_name\" $flag > $u->full_name </option>\n";
         }
			?>
			</select> 
			<input type="submit" value= "Send" />
		</form>
		<a href="passwordreset.php">Reset</a>
	</div>
<?php include 'footer.php'; ?>