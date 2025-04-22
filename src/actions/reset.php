<?php

require_once '../includes/constants/connection.php';

session_start();

if(isset($_SESSION['loginname']))
{
	header('Location: ../home.php');
	die();
}

if(!isset($_SESSION['admin']))
{
	header('Location: index.php');
	die();
}

if($_GET)
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	
	$user_id = $_GET['data1'];

	if(!$dbconnection)
	{
		echo "<div class='error'>Error al conectar con la base de datos</div>";
    	die();
	}

	$sql = "UPDATE users SET user_count = 0 WHERE user_id = '$user_id'";

	if (mysqli_query($dbconnection, $sql))
	{
	    echo "<div class='error'>Actualizado correctamente</div>";
	}
	else
	{
    	echo "<div class='error'>Error al intentar actualizar</div>";
	}
	mysqli_close($dbconnection);
}
else
{
	echo "<div class='error'>Error al intentar actualizar</div>";
	die();
}

?>