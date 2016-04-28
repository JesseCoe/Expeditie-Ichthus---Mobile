<?php

include( "db_posts_1.php");
include( "posts_list.php");

echo '<head>
    <title>Posts</title>
    <link rel="stylesheet" type="text/css" href="css/spoiler.css" />
    <script type="text/javascript" src="js/spoiler.js"></script>
</head>
<div class="spoiler">
    	<input type="button" onclick="showSpoiler(this);" value="Meer" />
    	<div class="inner" style="display:none;">';
    		
			include("db_posts_2.php");
			include("posts_list.php");
   
echo    	'</div>
	</div>';

?> 