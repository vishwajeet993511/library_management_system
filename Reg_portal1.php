<!doctype html>
<html lang="en-US">
<head>
	<title>
		Registration
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home_page.css">
    <script src="jquery-2.2.4.js"></script>
    <script src="login.js"></script>
</head>
<body>
	<div id="header">
		<div id="noteshare">Library Management System
			
		</div>
	</div>	
	<!--<div id="greet_cont">
		<div id="greeting1">
			<img style="width:20vw" src="logoLIB.png" />
		</div>
		<hr/>
		<div id="greeting2">
			Knowledge is free at the library. Just bring your own container.
		</div>
	</div>-->
	<div id="login_pg">
			<button id="login_pg_hd1" type="button">member</button>
			<button id="login_pg_hd2" type="button">librarian</button>
			<form id = "stud_form" action="<?php echo htmlspecialchars($script_name);?>" method="POST" enctype="multipart/form-data">
				<span id="check"><?php
				if(isset($_POST['mem_username']) && isset($_POST['mem_password']))
				{
					$mem_username = $_POST['mem_username'];
					$mem_password = $_POST['mem_password'];
					$mem_password_hash = md5($mem_password) ;
					if(empty($mem_username)||empty($mem_password))
					{
						$mem_err =  "Empty fields.";
					}
					if(!empty($mem_username) && !empty($mem_password))
					{
						$mquery = "SELECT `mem_id`,`mem_username` , `mem_password` , `mem_name` , `mem_email` , `mem_phone_number` , `mem_gender` , `mem_dob` , 
						`mem_age`,`mem_address`  FROM `lib_member` WHERE `mem_username` = '".mysqli_real_escape_string($mysql_connect , $mem_username)."' 
						AND `mem_password` = '".mysqli_real_escape_string($mysql_connect , $mem_password_hash)."' " ;
						$mquery_run = mysqli_query($mysql_connect , $mquery);
						if($mquery_run)
						{
							if(mysqli_num_rows($mquery_run) == 0)
							{
								$mem_err = "Incorrect username or password.";
							}
							else if(mysqli_num_rows($mquery_run) == 1)
							{
								while($row = mysqli_fetch_assoc($mquery_run))
								{
									$_SESSION['mem_id'] = $row['mem_id'];
									$_SESSION['mem_username'] = $row['mem_username'];
									$_SESSION['mem_name'] = $row['mem_name'];
									$_SESSION['mem_email'] = $row['mem_email'];
									$_SESSION['mem_phone'] = $row['mem_phone_number'];
									$_SESSION['mem_gender'] = $row['mem_gender'];
									$_SESSION['mem_age'] = $row['mem_age'];
									$_SESSION['mem_dob'] = $row['mem_dob'];
									$_SESSION['mem_address'] = $row['mem_address'];
								}  
								header("Location: index.php");
							}
						}
					}
				}
				?> </span>
				memberId:<br>
				<input id="UN"class="field" type="text" name="mem_username" placeholder="id" value=<?php if(isset($mem_username))
				{ echo $mem_username; }?>>
				<br><br>
				Password:<br>
				<input id="PW"class="field" type="password" name="mem_password" placeholder="password">
				<br><br><br>
				<?php if(isset($mem_err))
				{
					echo "<script>alert(\"$mem_err\");</script>";
				}?>
		    	<button type="submit" id="final_log">login</button>
				<a id="signup_link" href="reg_form.php"><u>Don't have an account? </u></a>
		    </form>
			<form id = "libr_form" action="<?php echo htmlspecialchars($script_name);?>" method="POST" enctype="multipart/form-data">
				<span id="check"><?php
				if(isset($_POST['lib_username']) && isset($_POST['lib_password']))
				{
					$lib_username = $_POST['lib_username'];
					$lib_password = $_POST['lib_password'];
					$lib_password_hash = md5($lib_password) ;
					if(empty($lib_username)||empty($lib_password))
					{
						$lib_err =  "Empty fields.";
					}
					if(!empty($lib_username) && !empty($lib_password))
					{
						$lquery = "SELECT `lib_id`,`lib_username` , `lib_name` , `lib_email` , `lib_password` ,`lib_gender`,`lib_dob`, `lib_phone` 
						FROM `librarian` WHERE `lib_username` = '".mysqli_real_escape_string($mysql_connect , $lib_username)."' 
						AND `lib_password` = '".mysqli_real_escape_string($mysql_connect , $lib_password_hash)."' " ;
						$lquery_run = mysqli_query($mysql_connect , $lquery);
						if($lquery_run)
						{
							if(mysqli_num_rows($lquery_run) == 0)
							{
								$lib_err =  "Incorrect username or password.";
							}
							else if(mysqli_num_rows($lquery_run) == 1)
							{
								while($row = mysqli_fetch_assoc($lquery_run))
								{
									$_SESSION['lib_id'] = $row['lib_id'];
									$_SESSION['lib_username'] = $row['lib_username'];
									$_SESSION['lib_name'] = $row['lib_name'];
									$_SESSION['lib_email'] = $row['lib_email'];
									$_SESSION['lib_phone'] = $row['lib_phone'];
									$_SESSION['lib_dob'] = $row['lib_dob'];
									$_SESSION['lib_gender'] = $row['lib_gender'];
								}  
								header("Location: index.php");
							}
						}
					}
				}
				?> </span>
				LibrarianId:<br>
				<input id="UN"class="field" type="text" name="lib_username" placeholder="id" value=<?php if(isset($lib_username))
				{ echo $lib_username; }?>>
				</span><br><br>
				Password:<br>
				<input id="PW"class="field" type="password" name="lib_password" placeholder="password">
				</span><br><br><br>
				<a id="signup_link" href="send_email.html"> <u>Request For Account?</u></a>
				<?php if(isset($lib_err))
				{
					echo "<script>$(\"#login_pg_hd2\").css({\"background-color\":\"rgba(70,70,70,0.3)\"});
					$(\"#login_pg_hd1\").css({\"background-color\":\"rgba(80,80,80)\"});
					$(\"#stud_form\").css({\"display\":\"none\"});$(\"#libr_form\").css({\"display\":\"block\"});
					alert(\"$lib_err\");</script>";
				}?>
		    	<button type="submit" id="final_log">login</button>
		    </form>
	</div>
</body>
</html>