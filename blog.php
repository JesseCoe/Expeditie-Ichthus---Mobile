<?php

function blog() {
	include("settings.php");
	include("connect.php");

// blog popup aan/uit
if ($blog_popup == true)
  {
  $popup = "data-rel='dialog' data-transition='pop'";
  }
  else
 {
  $popup = "";
 }

// weergegeven posts
$posts1 = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='post' and post_status='publish' ORDER BY post_date_gmt DESC LIMIT $aantalposts_blog")
	or die("Error: ".mysqli_error($con));

// fetch array
    while ($post_list1 = mysqli_fetch_object($posts1)) {
        printf ("
				<a href='#%s' class='ui-btn ui-shadow ui-corner-all' %s>%s</a>", $post_list1->post_name, $popup, $post_list1->post_title);
	}
	   
	    // free result set
    mysqli_free_result($posts1);

// posts in de collapsible
$posts2 = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='post' and post_status='publish' ORDER BY post_date_gmt DESC LIMIT $aantalposts_blog,10000")
	or die("Error: ".mysqli_error($con));

// begin collapsible
echo "
				<div data-role='collapsible'><h4>Meer/minder posts</h4>";

// fetch array
    while ($post_list2 = mysqli_fetch_object($posts2)) {
        printf ("
					<a href='#%s' class='ui-btn ui-shadow ui-corner-all' %s>%s</a>", $post_list2->post_name, $popup, $post_list2->post_title);
	}

	    // free result set
    mysqli_free_result($posts2);

// sluit collapsible
echo "
				</div><!-- /collapsible -->";
	
// sluit connectie
mysqli_close($con);
}

?>