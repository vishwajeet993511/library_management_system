<?php
	ob_start();
?>
<html lang="en-US">
<head>
	<title>
		<?php echo $_SESSION['mem_username']; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="member.css">
	<script src="jquery-2.2.4.js"></script>

</head>
<body>
	<div id="top_head">
		<div id="user_div" > <a href="index.php"><?php echo "Welcome " ,  $_SESSION['mem_name'] ; ?></a></div>
		<div id="logout_div" class="rightdivs"><a id="logoutlink" class="rightlinks" href='logout.php'> logout </a></div>
		<div id="search_div" class="rightdivs"><a id="searchlink" class="rightlinks" href='Search.php'> Search Books </a></div>
		<div id="recommendation_div" class="rightdivs"><a id="recommendationlink" class="rightlinks" href='recommendations.php'> Recommendations </a></div>
		<div id="students_div" class="rightdivs"><a id="studlink" class="rightlinks" href='update_profile.php'> Update profile </a></div>
	</div>
	<div id="libr_info">
		<table id="info_table">
			<tr>
				<td>Username:</td>
				<td><?php echo $_SESSION['mem_username']?> </td>
			</tr>
			<tr>
				<td>Name:</td>
				<td><?php echo $_SESSION['mem_name']?> </td>
			</tr>
			<tr>
				<td>Email Address:</td>
				<td><?php echo $_SESSION['mem_email']?> </td>
			</tr>
			<tr>
				<td>Phone Number:</td>
				<td><?php echo $_SESSION['mem_phone']?> </td>
			</tr>
			<tr>
				<td>Date of birth:</td>
				<td><?php echo $_SESSION['mem_dob']?> </td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td><?php echo $_SESSION['mem_gender']?> </td>
			</tr>
			<tr>
				<td>Age:</td>
				<td><?php echo $_SESSION['mem_age']?> </td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><?php echo $_SESSION['mem_address']?> </td>
			</tr>
		</table>
	</div>
</body>
</html>