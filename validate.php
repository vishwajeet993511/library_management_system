<?php
ob_start();
require "conn.inc.php" ;
function f_input($data){
	$data = trim($data) ;
	$data = stripslashes($data) ;
	$data = htmlspecialchars($data) ;
	return $data ;
}
if(isset($_POST['mem_username']) && isset($_POST['mem_password']) && isset($_POST['mem_pass_again']) 
	&& isset($_POST['mem_name']) && 
	isset($_POST['mem_email'])  && isset($_POST['mem_dob']) && isset($_POST['mem_telephone']) 
	&& isset($_POST['mem_address']))
{
	$username = $_POST['mem_username'];
	$password = $_POST['mem_password'];
	$p_again = $_POST['mem_pass_again'];
	$name = $_POST['mem_name'] ;
	$email = $_POST['mem_email'] ;
	$dob = $_POST['mem_dob'] ;
	$telephone = $_POST['mem_telephone'] ;
	$add = $_POST['mem_address'] ;
	if(!empty($username))
	{
		$username = f_input($username) ;
	}
	else
	{
		$username_err = "Must supply a username." ;
	}
	if(!empty($password))
	{
		$password = f_input($password) ;
	}
	else
	{
		$password_err = "Must supply a password." ;
	}
	if(!empty($p_again))
	{
		$p_again = f_input($p_again) ;
	}
	else
	{
		$pass_again_err = "Type the same password as above." ;
	}
	if(!empty($name))
	{
		$name = f_input($name) ;
		if (!(preg_match("/^[a-zA-Z]*$/",$name)  || preg_match("/^[a-zA-Z ]*$/",$name)))
		{
			$mem_name_err = "Only letters and whitespaces are allowed." ;
		}
	}
	else
	{
		$fname_err = "Enter your name.";
	}
	if(!empty($email))
	{
		$email = f_input($email) ;
		if(! filter_var($email , FILTER_VALIDATE_EMAIL))
			{$email_err = "Enter a valid Email address." ;}
	}
	else
	{
		$email_err = "Must enter your email address.";
	}
	if(!empty($telephone))
	{
		$telephone = f_input($telephone) ;
		if(!preg_match("/^[0-9]*$/", $telephone))
			{$telephone_err = "Enter a valid mobile number.";}
	}
	else
	{
		$telephone_err = "Enter your mobile number." ;
	}
	if(!empty($add))
	{
		$add = f_input($add) ; 
		
	}
	if(empty($dob))
	{
		$dob_err = "Select your date of birth.";
		
	}
	if( !empty($dob))
	{
		//$year1  = YEAR('$dob');
		$year2 = date("Y");
		$temp1 = "SELECT YEAR('$dob') AS Year" ;
		$temp1run = mysqli_query($mysql_connect , $temp1);
		$rt1 = mysqli_fetch_assoc($temp1run);
		$year1 = $rt1['Year'];
		$age = $year2 - $year1;
	}
	//echo "i am here 3";
	if(!empty($password) && !empty($p_again))
	{
		if($password !== $p_again)
			{$pass_match_err = "Password don't match as above." ;
		    }
			//echo "i am here 4";
	}
	if(!empty($username) && !empty($password) && !empty($p_again) && !empty($name) &&  !empty($email)  
		&& !empty($dob) && !empty($telephone)  &&
	 preg_match("/^[0-9]*$/", $telephone) && filter_var($email , FILTER_VALIDATE_EMAIL) 
	 && ($password == $p_again) && (preg_match("/^[a-zA-Z]*$/",$name)  || preg_match("/^[a-zA-Z ]*$/",$name))
	  )
	{
		//echo "i am here 5";
		$password_hash = md5($password) ;
		$query = "SELECT `mem_username` FROM `lib_member` WHERE `mem_username` = '$username' " ;
		$query_run = mysqli_query($mysql_connect , $query);
		$query1 = "SELECT `mem_email` FROM `lib_member` WHERE `mem_email` = '$email' " ;
		$query_run1 = mysqli_query($mysql_connect , $query1);
		$query2 = "SELECT `mem_phone_number` FROM `users` WHERE `mem_phone_number` = '$telephone' " ;
		//echo "i am here 6";
		$query_run2 = mysqli_query($mysql_connect , $query2);
		//echo "i am here 7";
		if(($query_run) &&(mysqli_num_rows($query_run) == 1))
		{
			     //echo "i am here 8";
				$username_err = "The username already exists.";
		}
		if(($query_run1) &&(mysqli_num_rows($query_run1) == 1))
		{
			   //echo "i am here 9";
				$email_err = "This email is already registered.";
		}
		if(($query_run2) &&(mysqli_num_rows($query_run2) == 1))
		{
			    //echo "i am here 10";
				$telephone_err = "This phone no. is already in use." ;
		}
		//echo "i am here 11";
		if(!(($query_run) && ($query_run1) && ($query_run2)))
		{
			//echo "i am here successful";
			if((mysqli_num_rows($query_run) == 0) && (mysqli_num_rows($query_run1) == 0) 
				&& (mysqli_num_rows($query_run2) == 0))
			{
				$query3 = "INSERT INTO `lib_member` ( `mem_name`, `mem_username` , `mem_password`  ,  
				`mem_email` , `mem_phone_number` ,`mem_dob` , `mem_address`, `mem_age`)
							VALUES ( '$name', '$username' , '$password_hash'  ,  '$email' , 
							'$telephone' , '$dob' , '$add' ,'$age') " ;
				$query_run3 = mysqli_query($mysql_connect , $query3);
				if($query_run3)
				{
					if(isset($_POST['mem_gender']))
					{
						if(!empty($_POST['mem_gender']))
						{
							$gender = $_POST['mem_gender'];
							$query4 = "UPDATE `lib_member` SET `mem_gender` = '$gender' WHERE `mem_username` = '$username' " ;
							$query_run4 = mysqli_query($mysql_connect , $query4);
						}
					}
					header("Location: confirmation.php");
				}
				else{ echo mysqli_error($mysql_connect);}									
			}
		}
							 
	}
}
?>
