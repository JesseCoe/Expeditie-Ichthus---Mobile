<?php
    include( "connect.php");

$posts = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='post' and post_status='publish' ORDER BY post_date_gmt DESC LIMIT 0,5")
	or die("Error: ".mysqli_error($con));
	
?>