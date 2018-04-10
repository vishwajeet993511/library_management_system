<?php
$host_name = "db733487241.db.1and1.com";
$user_name = "dbo733487241";
$pass = "viswajeet123";

$mysql_connect = mysqli_connect($host_name , $user_name , $pass);
$mysql_db = mysqli_select_db($mysql_connect ,"my_database");
if((!$mysql_connect) || (!$mysql_db))
{
	die(mysqli_error($mysql_connect));
}
?>
