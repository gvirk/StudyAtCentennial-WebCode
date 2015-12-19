
<?php
ob_start();
include 'connect.php';
if(!empty($_POST["user_name"])) {
//$result = mysql_query("SELECT count(*) FROM users WHERE user_name='" . $_POST["user_name"] . "'");
//$row = mysql_fetch_row($result);
$chck_name = ("SELECT * FROM users WHERE user_name = '" .mysql_real_escape_string($_POST['user_name']). "'");
$check_sql = mysql_query($chck_name);
 if (mysql_num_rows($check_sql) > 0) {
	echo "<span class='status-not-available'> Username Not Available.</span>";
	}
else {
	echo "<span class='status-available'> Username Available.</span>";
	}
}
?>
