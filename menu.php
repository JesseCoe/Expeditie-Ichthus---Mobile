<?php

function menu_button($page) {
	echo "<a href='#".$page->post_name."menu' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-bars ui-btn-icon-left ui-btn-a' data-rel='panel'>Menu</a>";
}

function menu($page) {
	include("settings.php");
	include("connect.php");
	
$menu_items = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' and post_parent='0' ORDER BY ID")
	or die("Error: ".mysqli_error($con));
	
$menu_subitems = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' and post_parent!='0' ORDER BY ID")
	or die("Error: ".mysqli_error($con));
	
$menu_posts = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='post' and post_status='publish' ORDER BY post_date_gmt DESC LIMIT $aantalposts_menu")
	or die("Error: ".mysqli_error($con));

echo "<div id='".$page->post_name."menu' data-role='panel' data-position='left' data-display='". $menu_data_display."'>
    				<div data-role='collapsible-set' data-theme='a' data-content-theme='a' data-collapsed-icon='arrow-r' data-expanded-icon='arrow-d' style='margin:0; width:250px;'>
					";
echo "<ul data-role='listview'>";

// fetch array
    while ($menu = mysqli_fetch_object($menu_items)) {
		if ($page->post_title == $menu->post_title){
			$btn_disabled = " class='ui-disabled'";
		} else {
			$btn_disabled = "";
		}
		if ($menu->post_title == "Overig") {
			// de menuknop "Overig" weglaten
		} elseif ($menu->post_title == "Blog") {
			echo "
						<div data-role='collapsible' data-inset='true'>";
        	printf ("<h2>%s</h2>", $menu->post_title);
			echo "
							<ul data-role='listview'>";
			echo "
								<li><a".$btn_disabled."";
			printf (" href='#%s'>%s</a></li>", $menu->post_name, $menu->post_title);
			// hier posts 1-3, daarna knop "meer"
			while ($post = mysqli_fetch_array($menu_posts)) {
				if ($page->post_title == $post[post_title]){
					$btn_subitem_disabled = " class='ui-disabled'";
				} else {
					$btn_subitem_disabled = "";
				}
				echo "
								<li><a".$btn_subitem_disabled."";
				printf (" href='#%s'>%s</a></li>", $post[post_name], $post[post_title]);
			}
			echo "
								<li><a".$btn_disabled."";
			printf (" href='#%s'>Meer</a></li>", $menu->post_name);
			echo "
							</ul>
        					</div><!-- /collapsible -->";
		} elseif ($menu->post_title == "Expeditieleden"){
			echo "
						<div data-role='collapsible' data-inset='true'>";
        	printf ("<h2>%s</h2>", $menu->post_title);
			echo "
							<ul data-role='listview'>";
			echo "
								<li><a".$btn_disabled."";
			printf (" href='#%s'>%s</a></li>", $menu->post_name, $menu->post_title);
			// hier expeditieleden
			while ($menu_subitem = mysqli_fetch_array($menu_subitems)) {
				if ($page->post_title == $menu_subitem[post_title]){
					$btn_subitem_disabled = " class='ui-disabled'";
				} else {
					$btn_subitem_disabled = "";
				}
				if ($menu->ID == $menu_subitem[post_parent]) {
					echo "
								<li><a".$btn_subitem_disabled."";
					printf (" href='#%s'>%s</a></li>", $menu_subitem[post_name], $menu_subitem[post_title]);
				}
			}
			echo "
							</ul>
        					</div><!-- /collapsible -->";
		} else {
			echo "
						<li><a".$btn_disabled."";
			printf (" href='#%s'>%s</a></li>", $menu->post_name, $menu->post_title);
		}
	}
	
echo "
					</ul>";
	   		
echo "
				</div><!-- /collapsible set -->
			</div><!-- /panel -->";


    // free result set
    mysqli_free_result($menu_items);


// sluit connectie
mysqli_close($con);

}

?>