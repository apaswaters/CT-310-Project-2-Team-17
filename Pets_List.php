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

		<form role="form" method="post">
 			<input type="text" class="form-control" id="keyword" placeholder="Search Here">
 		</form>
		<p id="debug"></p>
 		<ul id="content"></ul>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    	<script type="text/javascript">
 		$(document).ready(function() {
 			$('#keyword').on('input', function() {
 				var searchKey = $(this).val();
 				if (searchKey.length >= 0) {
 					$.ajax({
						type: "POST",
						url: "search.php",
						data: "{keywords: '" + searchKey + "'}",
						dataType: "json",
						async: "true",
						cache: "false",
						success: function(data) {
							$('ul#content').empty();
 							$('ul#content').html(
 							$.each(data, function() {
 								$('ul#content').append('<li><a href="petPage.php?r=' + this.id + '"><img src=getImage.php?id=' + this.image  + '/></a><p>' + this.short + '</p></li>');
 								}));
 							},
						Error: function(xhr, status, error) {
							}
						});
 				}
 			});
 		});
 		</script>
	</div>

	<div id = "footer">
  		<?php
  		include "Footer.inc";
  		?>
	</div>
</div>
</html>



