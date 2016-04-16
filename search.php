<?php
require_once('database.php');

if(!isset($_POST['keywords']))
	echo "sucks to suck";

$db = new Database();
$arr = array();
if (isset($_POST['keywords'])) {
	echo $_POST['keywords'];
 	$keywords = SQLite3::escapeString($_POST['keywords']);
 	$sql = "SELECT * FROM pets WHERE short LIKE '%".$keywords."%' OR long LIKE '%".$keywords."%'";

	$results = $db->query($sql);

 	foreach ($results as $obj) {
 		$arr[] = array('id' => $obj['id'], 'image' => $obj['image'], 'weight_lb' => $obj['weight_lb'], 'short' => $obj['short'], 'long' => $obj['long']);
 	}
}
echo json_encode($arr);
?>
