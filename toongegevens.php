<?php
    include( "connect.php");

$result = mysqli_query($con,"SELECT * FROM wp_posts")
	or die("Error: ".mysqli_error($con));
echo "<table border='1'>
<tr>
<th>post_title</th>
<th>post_status</th>
<th>post_type</th>
<th>post_name</th>
</tr>";
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['post_title'] . "</td>";
  echo "<td>" . $row['post_status'] . "</td>";
  echo "<td>" . $row['post_type'] . "</td>";
  echo "<td>" . $row['post_name'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
?> 