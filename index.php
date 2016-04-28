<?php

	include("pages.php");
	include("head.php");
	
// begin van de site
echo "<!DOCTYPE html>
";
echo "<html>
	";
echo $head;
echo "
	<body>";

// print alle pagina's	
pages();

// eind van de site
echo "
	</body>
";
echo "</html>";

?>