<?php
function f_input($data){
	$data = trim($data) ;
	$data = stripslashes($data) ;
	$data = htmlspecialchars($data) ;
	return $data ;
}
//echo "i am here top";

  if( isset($_POST['mem_password']) && isset($_POST['mem_pass_again']) 
	&& isset($_POST['mem_name']) && 
	isset($_POST['mem_email'])  && isset($_POST['mem_telephone']))
 {
	//echo "i am here -1";
	
	$password = $_POST['mem_password'];
	$p_again = $_POST['mem_pass_again'];
	$name = $_POST['mem_name'] ;
	$email = $_POST['mem_email'] ;
	$telephone = $_POST['mem_telephone'] ;
	$current_user = $_SESSION['lib_username'];
	if(!empty($password))
	{
		if( empty($p_again))
		{
			$pass_again_err = "retype password ";
		}
		else
		{
		$password = f_input($password) ;
		$password_hash = md5($password);
	   }

	}
	
	if(!empty($p_again))
	{
		$p_again = f_input($p_again) ;
	}
	if(!empty($name))
	{
		$name = f_input($name) ;
		if (!(preg_match("/^[a-zA-Z]*$/",$name)  || preg_match("/^[a-zA-Z ]*$/",$name)))
		{
			$mem_name_err = "Only letters and whitespaces are allowed." ;
		}
		else
		{
			    $query3 = "UPDATE `librarian` SET 
				
				`lib_name` = '$name'
				WHERE `lib_username` = '$current_user' ";
				$query_run3 = mysqli_query($mysql_connect , $query3);
				$_SESSION['lib_name'] = "$name";
		}
	}
	
	if(!empty($email))
	{
		$email = f_input($email) ;
		if(! filter_var($email , FILTER_VALIDATE_EMAIL))
			{$email_err = "Enter a valid Email address." ;}
		else
		{
			    $query1 = "SELECT `lib_email` FROM `librarian` WHERE `lib_email` = '$email' " ;
		        $query_run1 = mysqli_query($mysql_connect , $query1);
                if(($query_run1) &&(mysqli_num_rows($query_run1) == 1))
				{
			    //echo "i am here 9";
				$email_err = "This email is already registered.";
				}
				else
				{

			    $query3 = "UPDATE `librarian` SET
				`lib_email` = '$email'
				WHERE `lib_username` = '$current_user' ";
				$query_run3 = mysqli_query($mysql_connect , $query3);
				$_SESSION['lib_email'] = "$email";
			     }
		}
	}
	
	if(!empty($telephone))
	{
		$telephone = f_input($telephone) ;
		if(!preg_match("/^[0-9]*$/", $telephone))
			{$telephone_err = "Enter a valid mobile number.";}
		else
		{
			    $query2 = "SELECT `lib_phone` FROM `librarian` WHERE `lib_phone` = '$telephone' " ;
		
		        $query_run2 = mysqli_query($mysql_connect , $query2);
			    if(($query_run2) &&(mysqli_num_rows($query_run2) == 1))
				{
			    
				$telephone_err = "This phone no. is already in use." ;
				}
				else
				{
			    $query3 = "UPDATE `librarian` SET 
				`lib_phone`='$telephone'
				WHERE `lib_username` = '$current_user' ";
				$query_run3 = mysqli_query($mysql_connect , $query3);
				$_SESSION['lib_phone'] = "$telephone";
			}
		}
	}
	//echo "i am here 3";
	if(!empty($password) && !empty($p_again))
	{
		if($password != $p_again)
			{
				$pass_match_err = "Password don't match as above." ;
				
                //echo "<script> alert($pass_match_err) </script>";
				

		    }
		else
		{
			//echo "i am here 4";
			    $query3 = "UPDATE `librarian` SET 
				`lib_password` = '$password_hash' 
				WHERE `lib_username` = '$current_user' ";
				$query_run3 = mysqli_query($mysql_connect , $query3);
		}
	}
	if( (!empty($password) || !empty($p_again) || !empty($name) ||  !empty($email)  
		|| !empty($telephone)) 
	  )
	{
		if ( ($password == $p_again)  ) {
			header("Location: update_confirm.php");
		}
		
	}
	else
	{
		echo "<script> alert(\"nothing to update\") </script>";
	}
	
}
//echo "i am here bottom";
?>