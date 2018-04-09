<?php
$host_name = "localhost";
$user_name = "root";
$pass = "";

$mysql_connect = mysqli_connect($host_name , $user_name , $pass);
$mysql_db = mysqli_select_db($mysql_connect ,"my_database");
if((!$mysql_connect) || (!$mysql_db))
{
	die(mysqli_error($mysql_connect));
}	
?>