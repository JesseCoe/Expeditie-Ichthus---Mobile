<?php
    include( "connect.php");
	include( "settings.php");

$eerste_posts = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='post' and post_status='publish' ORDER BY post_date_gmt DESC LIMIT $aantalposts")
	or die("Error: ".mysqli_error($con));
	
?>