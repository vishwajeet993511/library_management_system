<?php
ob_start();
session_start();
require "conn.inc.php";
if(! isset($_SESSION['lib_username']))
{
	header("Location: index.php");
}
require "lib_pro_validate.php" ;
?>
<!doctype html>
<html lang="en-US">
<head>
	<title>
		update datails
	</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib_pro_update.css">
    <script src="jquery-2.2.4.js"></script>
</head>
<body>
	<!--<div id="instruction">
		<div id="inst">
			Important INSTRUCTIONS!!<br><br>
			<ul>
			<li> You can leave the fields which you don't want to update.</li><br>
			<li> Ensure that password typed again is same as the previous one. </li><br>
			<li> Ensure that E-mail address and mobile number provided by you is currently in use. </li>
			</ul>
		</div>
	</div>-->
	<div id="form_pg" style="height:115vh">
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" style="position:relative;top:7vh">
			<h1>Enter new informations to be changed </h1><hr><br>
			
			new Password: <br> <input id="PW" class="field" type="password" name="mem_password" placeholder="password" 
			maxlength="30"><span class="err"><?php if(isset($password_err)){ echo  $password_err; 
			echo "<script>$(\"#PW\").css(\"border\" , \"0.3vmin solid red\");</script>" ;}?></span>
			<br>
			Password again: <br> <input id="PWA" class="field" type="password" name="mem_pass_again" placeholder="retype password" 
			maxlength="30"> <span class="err">
			<?php if(isset($pass_again_err)){ echo $pass_again_err;}
			if(isset($pass_match_err)){ echo $pass_match_err ;} if(isset($pass_match_err) || isset($pass_again_err)){ 
			echo "<script>$(\"#PWA\").css(\"border\" , \"0.3vmin solid red\");</script>" ;}?></span>
			<br>
			Name: <br> <input id="FN" class="field" type="text" name="mem_name" placeholder="Name" maxlength="40" 
			value=<?php 
			if(isset($mem_name)){ echo $mem_name ;}?>>  <span class="err"><?php if(isset($fname_err)){ echo  $fname_err; echo "<script>
			$(\"#FN\").css(\"border\" , \"0.3vmin solid red\");</script>" ;}?></span><br>

			E-mail address: <br> <input id="EM"  class="field" type="email" name="mem_email" placeholder="Email address" 
			maxlength="50" value=<?php if(isset($mem_email)){ echo $mem_email ;}?>> <span class="err"><?php if(isset($email_err))
			{ echo  $email_err; echo "<script>
			$(\"#EM\").css(\"border\" , \"0.3vmin solid red\");</script>";} ?></span><br>
			

			Mobile number: <br> <input id="MN" class="field" type="tel" name="mem_telephone" placeholder=
			"Mobile no." maxlength="10" minlength="10" value="<?php if(isset($mem_telephone)){ echo $mem_telephone ;}?>"> <span class="err">
			<?php if(isset($telephone_err)){ echo $telephone_err; 
			echo "<script>$(\"#MN\").css(\"border\" , \"0.3vmin solid red\");</script>" ;} ?></span><br><br><br>
			<button type="submit" >Confirm</button>
			
			
		</form>
		
	</div>
	<div id="top_head">
		<div id="user_div" > <a href="index.php"><?php echo "Welcome " ,  $_SESSION['lib_name'] ; ?></a></div>
		<div id="logout_div" class="rightdivs"><a id="logoutlink" class="rightlinks" href='logout.php'> logout </a></div>
		<div id="search_div" class="rightdivs"><a id="searchlink" class="rightlinks" href='Search_l.php'> Search Books </a></div>
		<div id="students_div" class="rightdivs"><a id="studlink" class="rightlinks" href='lib_pro_update.php'> Update profile </a></div>
	</div>
</body>
</html>