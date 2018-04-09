<?php
ob_start();
require "conn.inc.php" ;
function f_input($data){
	$data = trim($data) ;
	$data = stripslashes($data) ;
	$data = htmlspecialchars($data) ;
	return $data ;
}


if(isset($_POST['bid']))
{
	$bkid = $_POST['bid'];
	if(!empty($bkid))
	{
		$bkid = f_input($bkid) ;
		$rquery = "SELECT `book_id`,`book_title` FROM `book` WHERE `book_id` = '$bkid'";
		$rquery_run = mysqli_query($mysql_connect , $rquery);
		if($rquery_run)
		{
			if(mysqli_num_rows($rquery_run)==0)
			{
				$bkid_err = "Book not found.";
			}
			else
			{
				$r = mysqli_fetch_assoc($rquery_run);
				$rquery1 = "DELETE FROM `book` WHERE `book`.`book_id` = '$bkid'";
				$rquery1_run = mysqli_query($mysql_connect , $rquery1);
				$bkid_err = "Successfully removed the book (".$r['book_title'].") from library.";
			}
		}
	}
	else
	{
		$bkid_err = "Must supply a book id." ;
	}
}
if(isset($_POST['bkttl']) && isset($_POST['bkcat']) && isset($_POST['bkcop']) && isset($_POST['bkpubn']) && isset($_POST['bkpubd']) && isset($_POST['bkaut']))
{
	$bookttl = $_POST['bkttl'];
	$bookcat = $_POST['bkcat'];
	$bookcop = $_POST['bkcop'];
	$bookpubn = $_POST['bkpubn'];
	$bookpubd = $_POST['bkpubd'];
	$bookaut = $_POST['bkaut'];
	if(!empty($bookttl))	{$bookttl = f_input($bookttl) ;}
	if(!empty($bookcat))	{$bookcat = f_input($bookcat) ;}
	if(!empty($bookcop))	{$bookcop = f_input($bookcop) ;}
	if(!empty($bookpubn))	{$bookpubn = f_input($bookpubn);}
	if(!empty($bookaut))	{$bookaut = f_input($bookaut);}
	if(empty($bookttl) || empty($bookcat) || empty($bookcop) || empty($bookpubn) || empty($bookpubd) || empty($bookaut))
	{
		$bookadd_err = "Empty fields.";
	}
	
	if(!empty($bookttl)&&!empty($bookcat)&&!empty($bookcop)&&!empty($bookpubn)&&!empty($bookpubd)&&!empty($bookaut))
	{
		$curr_date=date("y-m-d");
		$baquery = "INSERT INTO `book` (`book_title` , `category` , `copies` , `availability` , `publication_date` , `entry_date`)
							VALUES ('$bookttl' , '$bookcat' , '$bookcop' , '$bookcop' , '$bookpubd' , '$curr_date') " ;
		$baquery_run = mysqli_query($mysql_connect , $baquery);
	
		$temp = "SELECT `book_id` FROM `book` WHERE `book_title` = '$bookttl'";
		$temprun = mysqli_query($mysql_connect , $temp);
		$rt = mysqli_fetch_assoc($temprun);
		$id = $rt['book_id'];
		$aaquery = "INSERT INTO `author` (`book_id` , `name`) VALUES ('$id' , '$bookaut') " ;
		$aaquery_run = mysqli_query($mysql_connect , $aaquery);
		
		$temp1 = "SELECT YEAR('$bookpubd') AS Year" ;
		$temp1run = mysqli_query($mysql_connect , $temp1);
		$rt1 = mysqli_fetch_assoc($temp1run);
		$year = $rt1['Year'];
		
		$paquery = "INSERT INTO `publisher` (`publisher_year`, `publisher_name`, `book_id`) VALUES ('$year','$bookpubn','$id')";
		$paquery_run = mysqli_query($mysql_connect , $paquery);
		
		if($baquery_run && $aaquery_run && $paquery_run) {$bookadd_err = "Successfully added the book into the library.";}
		else {$bookadd_err = "Some error has occurred.";}
	}
}

if(isset($_POST['isbkid']) && isset($_POST['ismusr']))
{
	$isbookid = $_POST['isbkid'];
	$ismemusr = $_POST['ismusr'];
	if(!empty($isbookid))	{$isbookid = f_input($isbookid) ;}
	if(!empty($ismemusr))	{$ismemusr = f_input($ismemusr) ;}
	if(empty($isbookid) || empty($ismemusr))
	{
		$bookissue_err = "Empty fields.";
	}
	if(!empty($isbookid) && !empty($ismemusr))
	{
		$query = "SELECT `mem_id` FROM `lib_member` WHERE `mem_username` = '$ismemusr'";
		$query_run = mysqli_query($mysql_connect , $query);
		$query2 = "SELECT `availability` FROM `book` WHERE `book_id` = '$isbookid'";
		$query_run2 = mysqli_query($mysql_connect , $query2);
		if((mysqli_num_rows($query_run) == 0) || (mysqli_num_rows($query_run2) == 0))
		{
			$bookissue_err =  "Information not available.";
		}
		else
		{
			$row1 = mysqli_fetch_assoc($query_run2);
			$avl = $row1['availability'];
			if($avl<=0){$bookissue_err =  "Book cannot be issued due to unavailability.";}
			else
			{
				$row = mysqli_fetch_assoc($query_run);
				$mid = $row['mem_id'];
				$lid = $_SESSION['lib_id'];
				$curr_date=date("y-m-d h:i:sa");
				$query1 = "INSERT INTO `transaction` (`mem_id`, `lib_id`, `book_id`, `issue_date`) VALUES ('$mid','$lid','$isbookid','$curr_date')";
				$query_run1 = mysqli_query($mysql_connect , $query1);
				$avl = $avl - 1;
				$query3 = "UPDATE `book` SET `availability` = '$avl' WHERE `book_id` = '$isbookid'" ;
				$query_run3 = mysqli_query($mysql_connect , $query3);
				if($query_run1 && $query_run3) {$bookissue_err = "Successfully issued the book.";}
				else{$bookissue_err = "Some error has occurred.";}
			}
		}
	}
}

if(isset($_POST['rebkid']) && isset($_POST['remusr']))
{
	$rebookid = $_POST['rebkid'];
	$rememusr = $_POST['remusr'];
	if(!empty($rebookid))	{$rebookid = f_input($rebookid) ;}
	if(!empty($rememusr))	{$rememusr = f_input($rememusr) ;}
	if(empty($rebookid) || empty($rememusr))
	{
		$bookreturn_err = "Empty fields.";
	}
	if(!empty($rebookid) && !empty($rememusr))
	{
		$query4 = "SELECT `mem_id` FROM `lib_member` WHERE `mem_username` = '$rememusr'";
		$query_run4 = mysqli_query($mysql_connect , $query4);
		if(mysqli_num_rows($query_run4) == 0)
		{
			$bookreturn_err =  "Information not available.";
		}
		else
		{
			$row1 = mysqli_fetch_assoc($query_run4);
			$rememusrid = $row1['mem_id'];
			$query = "SELECT `mem_id`,`book_id` FROM `transaction` WHERE `mem_id` = '$rememusrid' AND `book_id` = '$rebookid' AND `return_date` IS NULL";
			$query_run = mysqli_query($mysql_connect , $query);
			if(mysqli_num_rows($query_run) == 0)
			{
				$bookreturn_err =  "Information not available.";
			}
			else
			{
				$curr_date=date("y-m-d h:i:sa");
				$query1 = "UPDATE `transaction` SET `return_date` = '$curr_date' WHERE `mem_id` = '$rememusrid' AND `book_id` = '$rebookid' AND `return_date` IS NULL";
				$query_run1 = mysqli_query($mysql_connect , $query1);
				$query2 = "SELECT `availability` FROM `book` WHERE `book_id` = '$rebookid'";
				$query_run2 = mysqli_query($mysql_connect , $query2);
				$row = mysqli_fetch_assoc($query_run2);
				$avl = $row['availability'];
				$avl = $avl + 1;
				$query3 = "UPDATE `book` SET `availability` = '$avl' WHERE `book_id` = '$rebookid'" ;
				$query_run3 = mysqli_query($mysql_connect , $query3);
				if($query_run1 && $query_run3 && $query_run2) {$bookreturn_err = "Successfully returned the book.";}
				else{$bookreturn_err = "Some error has occurred.";}
			}
		}
	}
}

if(isset($_POST['muname']))
{
	$dmusr = $_POST['muname'];
	if(empty($dmusr)) {$due_err = "Empty fields.";}
	if(!empty($dmusr))
	{
		$dmusr = f_input($dmusr) ;
		$query = "SELECT `mem_id` FROM `lib_member` WHERE `mem_username` = '$dmusr'";
		$query_run = mysqli_query($mysql_connect , $query);
		if(mysqli_num_rows($query_run) == 0){ $due_err =  "Information not available."; }
		else
		{
			$row = mysqli_fetch_assoc($query_run);
			$dmusrid = $row['mem_id'];
			$query1 = "SELECT `total_fine` FROM (SELECT `mem_id`,sum(`fine`) AS `total_fine` FROM `transaction` WHERE `return_date` 
			IS NOT NULL GROUP BY `mem_id`) AS `fine_all` WHERE `mem_id` = '$dmusrid'";
			$query_run1 = mysqli_query($mysql_connect , $query1);
			if($query_run1)
			{
				$row1 = mysqli_fetch_assoc($query_run1);
				$fine_amount = $row1['total_fine'];
				/*$query2 = "SELECT `total_fine` FROM (SELECT `mem_id`,sum(`fine`) AS `total_fine` FROM `transaction` WHERE `return_date` 
				IS NULL GROUP BY `mem_id`) AS `fine_all` WHERE `mem_id` = '$dmusrid'";
				$query_run2 = mysqli_query($mysql_connect , $query2);
				$row2 = mysqli_fetch_assoc($query_run2);
				if($query_run2)
				{
					$fine_amount = $row2['total_fine'];
				}*/
			}
			else
			{
				
				$due_err =  "Some error has occurred.";
			}
		}
		if(!isset($fine_amount)){$fine_amount = 0;}
	}
}

if(isset($_POST['duemem']) && isset($_POST['duemoney']))
{
	$dmem = $_POST['duemem'];
	$dmon = $_POST['duemoney'];
	if(empty($dmem)||empty($dmon))
	{
		$dueconfirm_err = "Empty Fields.";
	}
	if($dmon == 0)
	{
		$dueconfirm_err = "No fine to be paid.";
	}
	else if(!empty($dmem)&&!empty($dmon))
	{
		$query = "SELECT `mem_id` FROM `lib_member` WHERE `mem_username` = '$dmem'";
		$query_run = mysqli_query($mysql_connect , $query);
		$row = mysqli_fetch_assoc($query_run);
		$memid = $row['mem_id'];
		$f_new = 0;
		$query1 = "UPDATE `transaction` SET `fine` = '$f_new' WHERE `mem_id` = '$memid' AND `return_date` IS NOT NULL" ;
		$query_run1 = mysqli_query($mysql_connect , $query1);
		if(($query_run)&&($query_run1))
		{
			$dueconfirm_err = "Fine cleared.";
		}
		else
		{
			$dueconfirm_err = "Some error has occured.";
		}
	}
}
?>