<?php
ob_start();
session_start();
$script_name = $_SERVER['SCRIPT_NAME'];
if(isset($_SERVER['HTTP_REFERER']))
{
	$http_referer = $_SERVER['HTTP_REFERER'];
}
function loggedin()
{
	if((isset($_SESSION['mem_username']) && !empty($_SESSION['mem_username'])) ||  (isset($_SESSION['lib_username']) && !empty($_SESSION['lib_username'])))
	{
		return true;
	}
	else
	{
		return false;
	}
}

?>