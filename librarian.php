<?php
require "updatebook.php" ;
?>
<html lang="en-US">
<head>
	<title>
		<?php echo $_SESSION['lib_username']; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="home_page.css">
	<link rel="stylesheet" href="librarian.css">
	<script src="jquery-2.2.4.js"></script>
	<script src="login.js"></script>
</head>
<body>
	<div id="top_head">
		<div id="user_div" ><a href="index.php"> <?php echo "Welcome ".$_SESSION['lib_name']; ?></a></div>
		<div class="rightdivs"><a id="logoutlink" class="rightlinks" href='logout.php'> logout </a></div>
		<div class="rightdivs"><a class="rightlinks" href="Search_l.php" >Search Books</a></div>
		<div class="rightdivs"><a class="rightlinks" href="lib_pro_update.php">Update Profile</a></div>
	</div>
	<div id="libr_info">
		<table id="info_table">
			<tr>
				<td>Username:</td>
				<td><?php echo $_SESSION['lib_username']?> </td>
			</tr>
			<tr>
				<td>Name:</td>
				<td><?php echo $_SESSION['lib_name']?> </td>
			</tr>
			<tr>
				<td>Email Address:</td>
				<td><?php echo $_SESSION['lib_email']?> </td>
			</tr>
			<tr>
				<td>Phone Number:</td>
				<td><?php echo $_SESSION['lib_phone']?> </td>
			</tr>
			<tr>
				<td>Date of birth:</td>
				<td><?php echo $_SESSION['lib_dob']?> </td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td><?php echo $_SESSION['lib_gender']?> </td>
			</tr>
		</table>
	</div>
	<button id="issue" class="prof_menu" type="button">Issue Book</button>
	<button id="return" class="prof_menu" type="button">Submit Book</button>
	<button id="remove" class="prof_menu" type="button">Remove Book</button>
	<button id="add" class="prof_menu" type="button">Add Book</button>
	<button id="due" class="prof_menu" type="button">Due Clearence</button>
	<div id="remove_con" class="menu_content" style="display:none">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" style="width:50%">
			<span style="position:relative;left:39%;font-size:4vmin">Book id</span><br>
			<input type="text" placeholder="book id" class="field" name="bid" style="width:100%"><br><br>
			<span class="err"><?php if(isset($bkid_err)){echo "<script>$(\"#remove\").css({\"background-color\":\"rgba(70,70,70,0.8)\"});
			$(\"#remove_con\").css({\"display\":\"block\"});</script>";echo $bkid_err ;}?></span>
			<button type="submit" id="final_log" style="right:41%;top:-1%">Remove</button>
		</form>
	</div>
	<div id="add_con" class="menu_content" style="display:none">
		<form id="form_add" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
			Book Title: <input type="text" placeholder="book title" class="bkadd_field" name="bkttl" ><br><br>
			Category:   <input type="text" placeholder="book category" class="bkadd_field" name="bkcat"><br><br>
			Copies:		<input type="number" min="1" placeholder="Number of copies" class="bkadd_field" name="bkcop"><br><br>
			Publisher name:<input type="text" placeholder="publisher name" class="bkadd_field" name="bkpubn"><br><br>
			Publication date:<input type="date" class="bkadd_field" name="bkpubd"><br><br>
			Author: <input type="text" placeholder="book author" class="bkadd_field" name="bkaut">
			<?php if(isset($_POST['bkttl']) && isset($_POST['bkcat']) && isset($_POST['bkcop']) && isset($_POST['bkpubn']) && 
			isset($_POST['bkpubd']) && isset($_POST['bkaut']))
			{
				echo "<script>$(\"#add\").css({\"background-color\":\"rgba(70,70,70,0.8)\"}); $(\"#add_con\").css({\"display\":\"block\"});</script>";
				echo "<script>alert(\"$bookadd_err\");</script>";
			}?>
			<button type="submit" id="final_log" style="float:right;left:35vw;top:-17vh">Add</button>
		</form>
	</div>
	<div id="issue_con" class="menu_content" style="display:none">
		<form id="form_issue" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
			Book Id: <input type="text" placeholder="book id" class="bkadd_field" name="isbkid" ><br><br><br>
			Member username:  <input type="text" placeholder="member username" class="bkadd_field" name="ismusr" ><br><br><br>
			<button type="submit" id="final_log" style="right:41%;top:-1%">Issue</button>
			<?php if(isset($_POST['isbkid']) && isset($_POST['ismusr']))
			{
				echo "<script>$(\"#issue\").css({\"background-color\":\"rgba(70,70,70,0.8)\"}); $(\"#issue_con\").css({\"display\":\"block\"});</script>";
				echo "<script>alert(\"$bookissue_err\");</script>";
			}?>
		</form>
	</div>
	<div id="return_con" class="menu_content" style="display:none">
		<form id="form_return" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
			Book Id: <input type="text" placeholder="book id" class="bkadd_field" name="rebkid" ><br><br><br>
			Member username:  <input type="text" placeholder="member username" class="bkadd_field" name="remusr" ><br><br><br>
			<button type="submit" id="final_log" style="right:41%;top:-1%">Return</button>
			<?php if(isset($_POST['rebkid']) && isset($_POST['remusr']))
			{
				echo "<script>$(\"#return\").css({\"background-color\":\"rgba(70,70,70,0.8)\"}); $(\"#return_con\").css({\"display\":\"block\"});</script>";
				echo "<script>alert(\"$bookreturn_err\");</script>";
			}?>
		</form>
	</div>
	<div id="dueconfirm_con" class="menu_content" style="display:none">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" style="width:50%">
			<span style="position:relative;font-size:4vmin;font-family:Corbel">Username:</span>
			<input type="text" name="duemem" value="<?php if(isset($dmusr)){echo $dmusr;}?>" style="position:relative;float:right;width:8vw;text-align:center;
			height:4vh;font-size:3.4vmin" readonly><br> <span style="position:relative;font-size:4vmin;
			font-family:Corbel">Fine(Rs.):</span>
			<input type="number" name="duemoney" value="<?php if(isset($fine_amount)){echo $fine_amount;}?>" style="position:relative;float:right;width:8vw;text-align:center;
			height:4vh;font-size:4.1vmin" readonly><br><br>
			<button type="submit" id="final_log" style="right:8vw;top:-1%">confirm</button>
			<button type="button" id="final_log2" style="right:10vw;top:-1%">back</button>
			<?php if(isset($_POST['duemem']) && isset($_POST['duemoney']))
			{
				echo "<script>$(\"#due\").css({\"background-color\":\"rgba(70,70,70,0.8)\"}); $(\"#dueconfirm_con\").css({\"display\":\"block\"});</script>";
				echo "<script>alert(\"$dueconfirm_err\");</script>";
			}
			?>
		</form>
	</div>
	<div id="due_con" class="menu_content" style="display:none">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" style="width:50%">
			<span style="position:relative;left:7.5vw;font-size:4vmin">Member username</span><br>
			<input type="text" placeholder="member username" class="field" name="muname" style="width:100%"><br><br>
			<?php if(isset($_POST['muname']))
			{
				if(isset($due_err))
				{
					echo "<script>$(\"#due\").css({\"background-color\":\"rgba(70,70,70,0.8)\"}); $(\"#due_con\").css({\"display\":\"block\"});</script>";
					echo "<script>alert(\"$due_err\");</script>";
				}
				else
				{
					echo "<script>$(\"#due\").css({\"background-color\":\"rgba(70,70,70,0.8)\"}); $(\"#dueconfirm_con\").css({\"display\":\"block\"});</script>";
				}
			}
			?>
			<button type="submit" id="final_log1" style="right:41%;top:-1%">proceed</button>
		</form>
	</div>
</body>
</html>