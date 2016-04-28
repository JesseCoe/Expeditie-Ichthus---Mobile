<?php

include( "connect.php");

    /* fetch associative array */
    while ($obj = mysqli_fetch_object($posts)) {
        printf ("%s \n </br>", $obj->post_title);
	}

    /* free result set */
    mysqli_free_result($posts);


/* close connection */
mysqli_close($con);
	
?>