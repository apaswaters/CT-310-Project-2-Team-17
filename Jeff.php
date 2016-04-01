<?php
	session_start();
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

	<h1>Jeff</h1>

	<img src="Jeff_sq.jpg" alt="Smiley face"> 
	<div id = "caption">

	<a href="http://colliesheltierescue.org/"> "Image from Rocky Mountain Collie and Sheltie Rescue"</a>
	</div>

	<p>
	According Rocky Mountain Collie and Sheltie Rescue website "These two darling tri-colored Shelties are 
	littermates and only a year old. Our director tagged them 
	Mutt and Jeff with Mutt and are both looking to go to the same forever home."
	</p>

	<?php
if (isset($_SESSION['user'])){
	if (isset($_POST['op'])) {
		$name     = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$subject  = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
		$content  = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
	
	
		
		?>
		<h4>Thanks! Your message has been received.<h4>
		<?php
	
	}
	else {
	?>

   		<form method="post" action="Jeff.php">
      		Name    <input type="text" name="name"    size="30"><br/>
      		Subject <input type="text" name="subject" size="30"><br/>
      		<textarea name="content" rows="5" cols="40">Your comment here.</textarea><br/>
     		<input type="hidden" value="done" name="op">
     		<input type="submit" value="Send">
   		</form>
	
	<?php
	}
}else{
	?>
	<h4>login to post<h4>
	<?php
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
