<?php
    include( "connect.php");

	include( "db_posts.php");

$pages1 = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' and post_parent!='0' ORDER BY ID")
	or die("Error: ".mysqli_error($con));
	
$pages2 = mysqli_query($con,"SELECT ID FROM wp_posts WHERE post_type='page' and post_status='publish' and post_parent='0' ORDER BY ID")
	or die("Error: ".mysqli_error($con));
	
$row = mysqli_fetch_array($pages1);
$row1 = mysqli_fetch_array($pages2);

echo "While </br> <table border='1'>
<tr>
<th>post_title</th>
<th>post_parent</th>
</tr>";

while($row = mysqli_fetch_array($pages1)) {
	$i = $row[post_parent];
	$u = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' and post_parent='0' and ID=$i ORDER BY ID")
	 or die("Error: ".mysqli_error($con));
	$o = mysqli_fetch_array($u);
					 
	echo "<tr>";
  echo "<td>" . $row[post_title] . "</td>";
  echo "<td>" . $o[post_title] . "</td>";
  echo "</tr>";				
						}
						
echo "</table>";

echo "Posts </br> <table border='1'>
<tr>
<th>post_title</th>
<th>post_status</th>
<th>post_type</th>
<th>post_name</th>
</tr>";
while($row = mysqli_fetch_array($posts))
  {
  echo "<tr>";
  echo "<td>" . $row['post_title'] . "</td>";
  echo "<td>" . $row['post_status'] . "</td>";
  echo "<td>" . $row['post_type'] . "</td>";
  echo "<td>" . $row['post_name'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

$pages = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' ORDER BY ID")
	or die("Error: ".mysqli_error($con));

echo "Pages </br> <table border='1'>
<tr>
<th>post_title</th>
<th>post_status</th>
<th>post_type</th>
<th>post_name</th>
</tr>";
while($row = mysqli_fetch_array($pages))
  {
  echo "<tr>";
  echo "<td>" . $row['post_title'] . "</td>";
  echo "<td>" . $row['post_status'] . "</td>";
  echo "<td>" . $row['post_type'] . "</td>";
  echo "<td>" . $row['post_name'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

$parent_pages = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' and post_parent='0' ORDER BY ID")
	or die("Error: ".mysqli_error($con));

echo "Parent Pages </br> <table border='1'>
<tr>
<th>post_title</th>
<th>post_status</th>
<th>post_type</th>
<th>post_name</th>
</tr>";
while($row = mysqli_fetch_array($parent_pages))
  {
  echo "<tr>";
  echo "<td>" . $row['post_title'] . "</td>";
  echo "<td>" . $row['post_status'] . "</td>";
  echo "<td>" . $row['post_type'] . "</td>";
  echo "<td>" . $row['post_name'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

$pages3 = mysqli_query($con,"SELECT * FROM wp_posts WHERE post_type='page' and post_status='publish' and post_parent!='0' ORDER BY ID")
	or die("Error: ".mysqli_error($con));

echo "Child pages </br> <table border='1'>
<tr>
<th>post_title</th>
<th>post_status</th>
<th>post_type</th>
<th>post_name</th>
<th>post_parent</th>
</tr>";
while($row = mysqli_fetch_array($pages3))
  {
  echo "<tr>";
  echo "<td>" . $row['post_title'] . "</td>";
  echo "<td>" . $row['post_status'] . "</td>";
  echo "<td>" . $row['post_type'] . "</td>";
  echo "<td>" . $row['post_name'] . "</td>";
	echo "<td>" . $row['post_parent'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?> 
