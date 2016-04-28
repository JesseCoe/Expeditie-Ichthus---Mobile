<?php

include( "connect.php");
include( "db_posts.php");
include( "settings.php");

if ($blog_popup == true)
  {
  $popup = "data-rel='dialog' data-transition='pop'";
  $popup1 = "a";
  }
  else
 {
  $popup = "";
  $popup1 = "a";
 }

echo '<html>
	<head> 
	<title>Expeditie Ichthus</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="../themes/expeditieichthus.min.css" />
	<link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="../themes/jquery.mobile.structure-1.4.0.min.css" />
  	<link rel="shortcut icon" href="../favicon.ico">
	<script src="../themes/js/jquery.js"></script>
  	<script src="../themes/index.js"></script>
	<script src="../themes/js/jquery.mobile-1.4.0.min.js"></script>
	<script src="../themes/js/jquery-1.10.2.min.js"></script>
	</head> 
<body> ';

echo "<div data-role='page' id='blog'>

	<div data-role='header'>
		<h1>Expeditie Ichthus Blog</h1>
	</div><!-- /header -->

	<div data-role='content' class='ui-body-a'>
		<h2>Blog</h2>

		<p>Bekijk hier de posts van Expeditie Ichthus.</p>
	";


    /* fetch associative array */
    while ($obj = mysqli_fetch_object($posts)) {
        printf ("
		<a href='#%s' class='ui-btn ui-shadow ui-corner-all' %s >%s</a> 
", $obj->post_name, $popup, $obj->post_title);
	}
	   
	    /* free result set */
    mysqli_free_result($posts);
	
echo "</div><!-- /content -->

	<div data-role='footer' data-theme='".$popup1."'>
		<h4>Expeditie Ichthus</h4>
	</div><!-- /footer -->
</div>";

/* fetch associative array */
    while ($obj1 = mysqli_fetch_object($posts1)) {
        printf ("
		<div data-role='page' id='%s'>
			<div data-role='header' data-theme='a'>
		<h1>Post</h1>
	</div><!-- /header -->
	<div data-role='content' class='ui-body-a'>
		<h2>%s</h2>
		<p>%s</p>
		<p><a href='#blog' data-rel='back' data-role='button' data-inline='true' data-icon='back'>Terug naar de pagina</a></p>
		</div>
	<div data-role='footer'>
		<h4>Expeditie Ichthus</h4>
	</div><!-- /footer -->
</div>
", $obj1->post_name, $obj1->post_title, $obj1->post_content);
	}

echo "		</body>
</html>";


    /* free result set */
    mysqli_free_result($posts1);


/* close connection */
mysqli_close($con);

?>