
<?php
ob_start();
session_start();
//require "var.inc.php";
require "conn.inc.php";
if(! isset($_SESSION['mem_username']))
{
	header("Location: index.php");
}
/*$_gender_of_session = 1;
$_age_of_session = 20;*/
//$zero = 0;
$curr_gen = $_SESSION['mem_gender'];
$curr_age = $_SESSION['mem_age'];
//echo "$curr_gen";


$query = "SELECT `book`.`book_title` AS `title`, `book`.`category` AS `category`,  COUNT(`transaction`.`mem_id`) AS `numofmembers` 
FROM `transaction`, `lib_member`, `book`
WHERE `transaction`.`book_id` = `book`.`book_id`  AND  `transaction`.`mem_id` = `lib_member`.`mem_id` AND `lib_member`.`mem_age` BETWEEN $curr_age - 2 AND $curr_age + 2 
GROUP BY `transaction`.`book_id`
ORDER BY `numofmembers` DESC
LIMIT 5";
$Result = mysqli_query($mysql_connect, $query);

$query1 = "SELECT `book`.`book_title` AS `title`, `book`.`category` AS `category`, COUNT(`transaction`.`mem_id`) AS `numofmembers` 
FROM `transaction`, `lib_member`, `book`
WHERE `transaction`.`book_id` = `book`.`book_id`  AND `transaction`.`mem_id` = `lib_member`.`mem_id` AND `lib_member`.`mem_gender` = '$curr_gen'
GROUP BY `transaction`.`book_id`
ORDER BY `numofmembers` DESC
LIMIT 5";
$Result1 = mysqli_query($mysql_connect, $query1);

$query2 = "SELECT `book`.`book_title` AS `title`, `book`.`category` AS `category`,  COUNT(`transaction`.`mem_id`) AS `numofmembers` 
FROM `transaction`, `lib_member`, `book`
WHERE `transaction`.`book_id` = `book`.`book_id`  AND  `transaction`.`mem_id` = `lib_member`.`mem_id`
GROUP BY `transaction`.`book_id`
ORDER BY `numofmembers` DESC
LIMIT 5";
$Result2 = mysqli_query($mysql_connect, $query2);

?>

<!--
TRANSACTION TABLE:-
transaction_id
mem_id
librarian_id
book_id
issue_date
return_date
fine

MEMBER TABLE:-
mem_id
mem_name
mem_username
mem_password
member_type
mem_email
mem_phone
mem_address
mem_gender
mem_dob
mem_age



<style>

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 60%;
}

td, th {
    border: 1px solid #AF601A;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #AF601A;
}
</style>

-->


<!doctype html>
<html lang="en-US">



<head>


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

    <title>
        Registration
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home_page.css">
    <link rel="stylesheet" href="recommend.css">

    <script src="jquery-2.2.4.js"></script>
    <script src="login.js"></script>
</head>
<body>
    <div id="top_head">
		<div id="user_div" > <a href="index.php"><?php echo "Welcome " ,  $_SESSION['mem_name'] ; ?></a></div>
		<div id="logout_div" class="rightdivs"><a id="logoutlink" class="rightlinks" href='logout.php'> logout </a></div>
		<div id="search_div" class="rightdivs"><a id="searchlink" class="rightlinks" href='search.php'> Search Books </a></div>
		<div id="recommendation_div" class="rightdivs"><a id="recommendationlink" class="rightlinks" href='recommendations.php'> Recommendations </a></div>
		<div id="students_div" class="rightdivs"><a id="studlink" class="rightlinks" href='update_profile.php'> Update profile </a></div>
	</div>
    <div id="back_ground">
    <form id = "age_form" action="<?php echo htmlspecialchars($script_name);?>" method="POST" enctype="multipart/form-data">
    <div class="row">
    <div class="column" align = "left" style="background-color: rgba(0,0,0,0);">
       
        <p>
                <font size="5" color="khaki">

                People with same age<br>
                also borrowed:<br>


                <?php
                echo "<table>";

                echo "<tr>";

                echo "<td style ='font:18px/27px Arial,tahoma,sans-serif;color:#A9DFBF; text-align:left'>"."Book Title"."</td>";
                echo "</td>";

                echo "<td style ='font:18px/27px Arial,tahoma,sans-serif;color:#A9DFBF; text-align:left' >"."Category"."</td>";
                echo "</tr>";

                while($bookid = mysqli_fetch_assoc($Result)){
                    echo "<tr>";

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>".$bookid['title']."</td>";
                    echo "</td>";

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left' >".$bookid['category']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
                </font>
        </p>
    </div>
    <div class="column" style="background-color:rgba(0,0,0,0);">
        <p>
                <font size="5" color="khaki">

                People with same gender<br>
                also borrowed:<br>


                <?php
                echo "<table>";

                echo "<tr>";

                echo "<td style ='font:18px/27px Arial,tahoma,sans-serif;color:#A9DFBF; text-align:left'>"."Book Title"."</td>";
                echo "</td>";

                echo "<td style ='font:18px/27px Arial,tahoma,sans-serif;color:#A9DFBF; text-align:left' >"."Category"."</td>";
                echo "</tr>";
                while($bookid = mysqli_fetch_assoc($Result1)){
                    echo "<tr>";
                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>".$bookid['title']."</td>";

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>".$bookid['category']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
                </font>

        </p>
    </div>
    <div class="column" style="background-color:rgba(0,0,0,0);">
        <p>
                <font size="5" color="khaki">

                Most borrowed books<br>
                from here:<br>
  
                <?php
                echo "<table>";

                echo "<tr>";

                echo "<td style ='font:18px/27px Arial,tahoma,sans-serif;color:#A9DFBF; text-align:left'>"."Book Title"."</td>";
                echo "</td>";

                echo "<td style ='font:18px/27px Arial,tahoma,sans-serif;color:#A9DFBF; text-align:left' >"."Category"."</td>";
                echo "</tr>";
                while($bookid = mysqli_fetch_assoc($Result2)){
                    echo "<tr>";
                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>".$bookid['title']."</td>";

                    echo "<td style ='font:15px/25px Arial,tahoma,sans-serif;color:#ffffff; text-align:left'>".$bookid['category']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
                </font>

        </p>
    </div>

    </form>
            
    </div>
</body>
</html>