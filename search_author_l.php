<?php
require "conn.inc.php" ;
require "var.inc.php";
if(isset($_POST['searchBook_A']))
{
	$input = $_POST['searchBook_A'];
}
?>

<!doctype html>
<html lang="en-US">
<head>
	<title>
		Registration
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="search_l.css">
    <script src="jquery-2.2.4.js"></script>
    <script src="login.js"></script>
</head>

<style>
table, th, td {
    border: 1px solid white;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
th {
    text-align: left;
}
</style>

<body>


	<div id="top_head">
		<div id="user_div" > <a href="index.php"><?php echo "Welcome " ,  $_SESSION['lib_name'] ; ?></a></div>
		<div id="logout_div" class="rightdivs"><a id="logoutlink" class="rightlinks" href='logout.php'> logout </a></div>
		<div id="search_div" class="rightdivs"><a id="searchlink" class="rightlinks" href='Search_l.php'> Search Books </a></div>
		<div id="students_div" class="rightdivs"><a id="studlink" class="rightlinks" href='lib_pro_update.php'> Update profile </a></div>
	</div>

	<div id="search_head">
	
		<div id="login_pg">
				
   			<div class="result_table" align = "center" style="background-color: rgba(0,0,0,0);">
   			<br>
   			<br>					
					<?php
					
					        /*
							$query = "SELECT `mem_username` , `mem_password` , `mem_name` , `mem_email`,`mem_phone_number` , `mem_gender` , `mem_dob` , `mem_address`  FROM `lib_member` WHERE `mem_username` = '".mysqli_real_escape_string($mysql_connect , $username)."' 
							AND `mem_password` = '".mysqli_real_escape_string($mysql_connect , $password_hash)."' " ;
							$query_run = mysqli_query($mysql_connect , $query);
							*/
							$query = "SELECT DISTINCT  `book`.`availability` as `avaibility`, `book`.`book_title` as `title`, `book`.`category` as `category`,`author`.`book_id` as `book_id`  FROM  `book`, `author` WHERE  `author`.`name` LIKE '%$input%' && `author`.`book_id`=`book`.`book_id`";

							$query_run = mysqli_query($mysql_connect , $query);
							//$result = mysql_query($sql);
							$rowcount=mysqli_num_rows($query_run);

							echo "<font color=white>Total ".$rowcount." results found.</font>";
							echo "<br>";
							echo "<br>";
                echo "<table>";

                    echo "<tr>";

                    echo "<td style ='font:17px/27px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>"."Title"."</td>";

                    echo "<td style ='font:17px/27px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>"."Category"."</td>";

                    echo "<td style ='font:17px/27px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>"."Book-ID"."</td>";

                    echo "<td style ='font:17px/27px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>"."Available Copies"."</td>";


							while($row = mysqli_fetch_assoc($query_run)) 
							{

                    echo "<tr>";

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>".$row['title']."</td>";

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left' >".$row['category']."</td>";
                    

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left' >".$row['book_id']."</td>";

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left' >".$row['avaibility']."</td>";

						}
                echo "</table>";

					
					?> 
				<br>
				<br>
				
		<form action ="search_l.php" method="POST">
			<button type = "Submit" name="submit_n">Back to Search</button>
		</form>


		</div>
			
	</div>
</body>
</html>
