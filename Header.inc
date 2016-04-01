<?php
	//session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
<div id = "head">
<h3>Salman and Austin's Pet Rescue</h3>

  <a href="index.php">Home</a>
  <a href="Pets_List.php">Pets List</a>
  <a href="About_Us.php">About Us</a>
  <?php
  if (!isset($_SESSION["user"])){
	?>
	<a href="login.php">Login</a>
	<?php
  }else {
	?>
	<a href="logout.php">Logout</a>
	<?php
  }
  ?>
</div>
