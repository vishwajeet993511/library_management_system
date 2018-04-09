<?php
ob_start();
	if(isset($_POST['submit']))
	{
		header("Location: admin_access.php");
	}
?>
<!doctype html>
<html lang="en-US">
<head>
	<title>
		Confirmation page
	</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="confirmation.css">
</head>
<body>
	<div id="confirm">
		<span id="congrats">CONGRATULATION !!</span><br><hr>
		<div id="thanks">Librarian account has been successfully created.</div> 
		<form action=<?php echo $_SERVER['PHP_SELF'] ;?> method="POST">
			<input type="submit" name="submit" value="login">
		</form>
	</div>
</body>
</html>