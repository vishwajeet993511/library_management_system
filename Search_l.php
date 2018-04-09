<?php
require "var.inc.php" ;
require "conn.inc.php" ;
?>
<html lang="en-US">
<head>
	<title>
		<?php echo $_SESSION['lib_username']; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="search_l.css">
	<script src="jquery-2.2.4.js"></script>
	<script src="profile.js"></script>
</head>
<body>
	<div id="top_head">
		<div id="user_div" > <a href="index.php"><?php echo "Welcome " ,  $_SESSION['lib_name'] ; ?></a></div>
		<div id="logout_div" class="rightdivs"><a id="logoutlink" class="rightlinks" href='logout.php'> logout </a></div>
		<div id="search_div" class="rightdivs"><a id="searchlink" class="rightlinks" href='Search_l.php'> Search Books </a></div>
		<div id="students_div" class="rightdivs"><a id="studlink" class="rightlinks" href='lib_pro_update.php'> Update profile </a></div>
	</div>

	<div id="search_head">
		<form action ="search_name_l.php" method="POST">
			<font color="white">
			<br>
			<br>
			<label type="text" name = "search_N" > &nbsp; &nbsp; &nbsp; &nbsp; Search Book Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label>
			</font>
			<input type="text" name="searchBook_N" placeholder = "Type Book Name.." >
   			<div class="search_buttons" align = "left" style="background-color: rgba(0,0,0,0);">
			<button type = "Submit" name="submit_n">Search</button>
			</div>
		</form>
			<br>
		<form action="search_publisher_l.php" method="POST" >
			<font color="white">
			<label class = "search_menu" type="text" name = "search_P" > &nbsp; &nbsp; &nbsp; &nbsp;Search Book Publisher  &nbsp; &nbsp; &nbsp; &nbsp; </label>
			<input type="text" name="searchBook_P" placeholder = "Type Publisher Name..">
			</font>

   			<div class="search_buttons" align = "left" style="background-color: rgba(0,0,0,0);">
			<button type = "Submit" name="submit_n">Search</button>
			</div>		</form>
			<br>
		<form action="search_author_l.php" method="POST">
			<font color="white">
			<label class = "search_menu" type="text" name = "search_A" > &nbsp; &nbsp; &nbsp; &nbsp;Search Author Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label>
			<input type="text" name="searchBook_A" placeholder = "Type Author Name..">
			</font>

   			<div class="search_buttons" align = "left" style="background-color: rgba(0,0,0,0);">
			<button type = "Submit" name="submit_n">Search</button>
			</div>		</form>
	</div>
</body>
</html>