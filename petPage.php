<?php
	session_start();
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
<?php
	if(isset($_GET['r']))
		$temp = $_GET['r'];

	$db = new Database();

	if(isset($temp) && $content = $db->getPet($temp))
	{
		$img_stuff = $db->getImage($content->image);
?>
	<img src="getImage.php?id=<?php echo $img_stuff->id;?>" >

	<p>
	<?php echo $content->long;?>
	</p>

	<p>
	Weight: <?php echo $content->weight?> lb.
	</p>

	<?php
	}
	else
	{

	?>
	<h1>That pet does not seem to exist.</h1>

	<?php
	}
	?>

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
