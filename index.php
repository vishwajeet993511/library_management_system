<?php
require "var.inc.php" ;
require "conn.inc.php" ;

$firstq = "SELECT `transaction_id`,`issue_date` FROM `transaction` WHERE `return_date` IS NULL" ;
$firstq_run = mysqli_query($mysql_connect , $firstq);
if(mysqli_num_rows($firstq_run) != 0)
{
	$current_date=date("y-m-d h:i:sa");
	while($frow = mysqli_fetch_assoc($firstq_run))
	{
		$iss = $frow['issue_date'];
		$ti = $frow['transaction_id'];
		$date1=date_create("$iss");
		$date2=date_create("$current_date");
		$diff=date_diff($date1,$date2);
		$k =  (int)$diff->format("%a");
		if($k > 60)
		{
			$fine_new = 1*($k-60);
			$firstq1 = "UPDATE `transaction` SET `fine` = '$fine_new' WHERE `transaction_id` = '$ti'" ;
			$firstq_run1 = mysqli_query($mysql_connect , $firstq1);
		}
	}
}

if(loggedin())
{
	if(isset($_SESSION['mem_username']) && !empty($_SESSION['mem_username']))
	{
		include "member.php";
	}
	if(isset($_SESSION['lib_username']) && !empty($_SESSION['lib_username']))
	{
		include "librarian.php";
	}
}
else
{
	require "Reg_portal1.php";
}
?>