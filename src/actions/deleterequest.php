<?php

require_once '../includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: ../login.php');
	die();
}

if($_POST)
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	
	if(!$dbconnection)
	{
		echo "<div class='error'>Error al conectar con la base de datos</div>";
    	die();
	}

	
	$id = mysqli_real_escape_string($dbconnection, $_POST['id']);


	$sql = "DELETE FROM `requests` WHERE request_id =".$id;

	if (mysqli_query($dbconnection, $sql))
	{	
	    //header('Location: ../home.php?pagina=solicitar');
		//die();
	}
	else
	{
    	echo "Error al intentar actualizar";
	}
	mysqli_close($dbconnection);
}
else
{
	echo "Error al intentar actualizar";
	die();
}

?>