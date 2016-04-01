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
  
			<h1>Pinky</h1>
			<a href="Pinky.php"><img src="Pinky_gallery.jpg" alt="Smiley face" width="300" height="300" align="middle"> 
			<div id="caption">
				<a href="http://colliesheltierescue.org/"> "Image from Rocky Mountain Collie and Sheltie Rescue"</a>
			</div>


			<h1>Muff</h1>
			<a href="Muff.php"><img src="Mutt_SQ.jpg" alt="Smiley face" width="300" height="300" align="middle"> 
			<div id ="caption">
				<a href="http://colliesheltierescue.org/"> "Image from Rocky Mountain Collie and Sheltie Rescue"</a>
			</div>
    
			<h1>Jeff</h1>
			<a href="Jeff.php"><img src="Jeff_sq.jpg" alt="Smiley face" width="300" height="300" align="middle"> 
			<div id ="caption">
				<a href="http://colliesheltierescue.org/"> "Image from Rocky Mountain Collie and Sheltie Rescue"</a>
			</div>
  
	</div>

	<div id = "footer">
  		<?php
  		include "Footer.inc";
  		?>
	</div>
</div>
</html>



