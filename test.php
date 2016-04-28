<?php
$link = mysql_connect("www.expeditie-ichthus.nl","expeditie_mobile","3maYaKtQ");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db("expeditie_wp1")) {
    die('Could not select database: ' . mysql_error());
}
$result = mysql_query("SELECT post_title FROM wp_posts  WHERE post_type='post' and post_status='publish' ORDER BY post_date_gmt DESC");
if (!$result) {
    die('Could not query:' . mysql_error());
}
echo mysql_result($result, 2);

mysql_close($link);
?>
