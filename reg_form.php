<?php
require "validate.php" ;
?>
<!doctype html>
<html lang="en-US">
<head>
	<title>
		New Registration
	</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="form_page.css">
    <script src="jquery-2.2.4.js"></script>
</head>
<body>
	<div id="instruction">
		<div id="inst">
			Important INSTRUCTIONS!!<br><br>
			<ul>
			<li> Fields with '*' mark are compulsory.</li><br>
			<li> Ensure that password typed again is same as the previous one. </li><br>
			<li> Ensure that E-mail address and mobile number provided by you is currently in use. </li>
			</ul>
		</div>
	</div>
	<div id="form_pg">
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" >
			<h1>Please fill this form for new member registration.</h1><hr><br>
			Username: <br>  <input id="UN" class="field" type="text" name="mem_username" placeholder="username" 
			maxlength="30" value="<?php if(isset($username)){ echo $username ;}?>">
			<span class='ast'>*</span> 
			<span class="err"><?php if(isset($username_err)) {echo $username_err; echo "<script>$(\"#UN\").css(\"border\" , 
			\"0.3vmin solid red\");</script>" ;} ?>
			</span><br>
			Password: <br> <input id="PW" class="field" type="password" name="mem_password" placeholder="password" 
			maxlength="30"> <span class='ast'>*</span> <span class="err"><?php if(isset($password_err)){ echo  $password_err; 
				echo "<script>$(\"#PW\").css(\"border\" , \"0.3vmin solid red\");</script>" ;}?></span><br>
			Password again: <br> <input id="PWA" class="field" type="password" name="mem_pass_again" placeholder="password" 
			maxlength="30"> <span class='ast'>*</span> <span class="err">
			<?php if(isset($pass_again_err)){ echo $pass_again_err;}
			if(isset($pass_match_err)){ echo $pass_match_err ;} if(isset($pass_match_err) || isset($pass_again_err)){ 
			echo "<script>$(\"#PWA\").css(\"border\" , \"0.3vmin solid red\");</script>" ;}?></span><br>
			Name: <br> <input id="FN" class="field" type="text" name="mem_name" placeholder="Name" maxlength="40" value="<?php 
			if(isset($name)){ echo $name ;}?>">
			<span class='ast'>*</span> <span class="err"><?php if(isset($fname_err)){ echo  $fname_err; echo "<script>
			$(\"#FN\").css(\"border\" , \"0.3vmin solid red\");</script>" ;}?></span><br>
			E-mail address: <br> <input id="EM"  class="field" type="email" name="mem_email" placeholder="Email address" 
			maxlength="50" value="<?php if(isset($email)){ echo $email ;}?>">
			<span class='ast'>*</span> <span class="err"><?php if(isset($email_err)){ echo  $email_err; echo "<script>
			$(\"#EM\").css(\"border\" , \"0.3vmin solid red\");</script>";} ?></span><br>
			Gender: <span class='ast'>*</span> <div id="dob"> Date of birth: <span class='ast'>*</span> </div> <br>
			<input type="radio" name="mem_gender" value="male" checked>Male 
			<input type="radio" name="mem_gender" value="female">Female
			<input type="radio" name="mem_gender" value="others">Others  
			<input id="DB" class="field" type="date" name="mem_dob" value="<?php if(isset($dob)){ echo $dob ;}?>"> 
			<br><br> 
			<div id="db_err" class="err"><?php if(isset($dob_err)){ echo $dob_err; echo 
			"<script>$(\"#DB\").css(\"border\" , \"0.3vmin solid red\");</script>" ;}?></div>
			Mobile number: <br> <input id="MN" class="field" type="tel" name="mem_telephone" placeholder=
			"Mobile no." maxlength="10" minlength="10" value="<?php if(isset($telephone)){ echo $telephone ;}?>"> 
			<span class='ast'>*</span> <span class="err"><?php if(isset($telephone_err)){ echo $telephone_err; 
			echo "<script>$(\"#MN\").css(\"border\" , \"0.3vmin solid red\");</script>" ;} ?></span><br>
			Address: <br> <textarea name="mem_address" rows="9" cols="50" maxlength="200"></textarea><br><br>
			<button type="submit" >Confirm</button>
			
		</form>
		
	</div>
</body>
</html>