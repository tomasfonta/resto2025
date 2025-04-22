<?php

session_start();

if(isset($_SESSION['loginname']))
{
	session_destroy();
	header('Location: index.php');
	die();
}

?>