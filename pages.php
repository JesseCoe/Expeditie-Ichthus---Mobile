<?php

function pages() {
	include("connect.php");
	include("settings.php");
	include("menu.php");
	include("blog.php");
	
	function page_content($page) {
		$page_content = $page->post_content;
		include("replace.php");
		echo "". str_ireplace ($search, $replace, $page_content) ."";
	}
	
	function post_content($page) {
		$post_content = $page->post_content;
		include("replace.php");
		echo "". str_ireplace ($search, $replace, $post_content) ."";
	}

// pages
$pages = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' ORDER BY ID")
	or die("Error: ".mysqli_error($con));

// fetch array
    while ($page = mysqli_fetch_object($pages)) {
		if ($page->post_title == "Home") {
			// geen "terug naar vorige pagina" knop, in header alleen "Expeditie Ichthus"
			printf ("
		<div data-role='page' id='%s'>
			", $page->post_name);
			menu($page);
			echo "
			<div data-role='header' data-theme='a' data-position='fixed'>
				";
			menu_button($page);
			printf("
				<h1>Expeditie Ichthus</h1>
			</div><!-- /header -->
			<div data-role='content' class='ui-body-a'>
				<h2>%s</h2>", $page->post_title);
			page_content($page);
			echo "
			</div><!-- /content -->
			<div data-role='footer' data-position='fixed'>
				<h4>Expeditie Ichthus</h4>
			</div><!-- /footer -->
		</div><!-- /page -->";
		}elseif ($page->post_title == "Blog") {
			// andere inhoud voor pagina "Blog"
			printf ("
		<div data-role='page' id='%s'>
			", $page->post_name);
			menu($page);
			echo "
			<div data-role='header' data-theme='a' data-position='fixed'>
				";
			menu_button($page);
			printf("
				<h1>%s</h1>
				<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-left ui-btn-a ui-icon-back'>Terug</a>
			</div><!-- /header -->
			<div data-role='content' class='ui-body-a'>
				<h2>%s</h2>", $page->post_title, $page->post_title);
			blog();
			echo "
			</div><!-- /content -->
			<div data-role='footer' data-position='fixed'>
				<h4>Expeditie Ichthus</h4>
			</div><!-- /footer -->
		</div><!-- /page -->";
		} else {
			// paginanaam in header
        	printf ("
		<div data-role='page' id='%s'>
			", $page->post_name);
			menu($page);
			echo "
			<div data-role='header' data-theme='a' data-position='fixed'>
				";
			menu_button($page);
			printf("
				<h1>%s</h1>
				<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-left ui-btn-a ui-icon-back'>Terug</a>
			</div><!-- /header -->
			<div data-role='content' class='ui-body-a'>
				<h2>%s</h2>", $page->post_title, $page->post_title);
			page_content($page);
			echo "
			</div><!-- /content -->
			<div data-role='footer' data-position='fixed'>
				<h4>Expeditie Ichthus</h4>
			</div><!-- /footer -->
		</div><!-- /page -->";
		}
	}
	
	// free result set
    mysqli_free_result($pages);

// posts
$posts = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='post' and post_status='publish' ORDER BY post_date_gmt DESC")
	or die("Error: ".mysqli_error($con));
	
// fetch array, post vervangen door page
    while ($page = mysqli_fetch_object($posts)) {
		printf ("
		<div data-role='page' id='%s'>
			", $page->post_name);
		menu($page);
        echo "
			<div data-role='header' data-theme='a' data-position='fixed'>
				";
		menu_button($page);
		printf ("
				<h1>%s</h1>
				<a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-left ui-btn-a ui-icon-back'>Terug</a>
			</div><!-- /header -->
			<div data-role='content' class='ui-body-a'>
				<h2>%s</h2>", $page->post_title, $page->post_title);
		post_content($page);
		echo "
				<p><a href='#blog' data-rel='back' data-role='button' data-inline='true' data-icon='back'>Terug naar de blog</a></p>
			</div><!-- /content -->
			<div data-role='footer' data-position='fixed'>
				<h4>Expeditie Ichthus</h4>
			</div><!-- /footer -->
		</div><!-- /page -->";
	}
		
	// free result set
	    mysqli_free_result($posts);

// sluit connectie
mysqli_close($con);

}

?>