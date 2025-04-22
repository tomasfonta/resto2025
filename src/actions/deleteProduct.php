<?php

require_once '../includes/constants/connection.php';

session_start();

//El Proveedor no puede eliminar
if(isset($_SESSION['loginname']))
{
	header('Location: ../home.php');
	die();
}

//El administardor si
if(!isset($_SESSION['admin']))
{
	header('Location: index.php');
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


	$sql = "DELETE FROM `products` WHERE product_id =".$id;

	if (mysqli_query($dbconnection, $sql))
	{	
	    echo "Eliminado";
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