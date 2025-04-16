<?php

require_once '../includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: ../login.php');
	die();
}

if(!empty($_GET['data1']) && !empty($_GET['data2']))
{
	$id = $_GET['data1'];
	$type = $_GET['data2'];
	$owner = $_SESSION['id'];
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);

	if(!$dbconnection)
	{
		echo "<div class='error'>Error al conectar con la base de datos</div>";
		die();
	}

	if($type == 1)
	{
		$sql = "DELETE FROM products WHERE product_id = $id AND product_owner = $owner";
	}
	elseif($type == 2) 
	{
		$sql = "DELETE FROM offers WHERE offer_id = $id AND offer_owner = $owner";
	}
	elseif($type == 3) 
	{
		$sql = "DELETE FROM requests WHERE request_id = $id AND request_owner = $owner";
	}
	else
	{
		echo "Error";
		die();
	}

	if (mysqli_query($dbconnection, $sql))
	{
	    echo "<div class='error'>Borrado exitosamente</div>";
	}
	else
	{
    	echo "<div class='error'>Error al intentar borrar</div>";
	}
	mysqli_close($dbconnection);
}
else
{
	echo "<div class='error'>Error al intentar borrar</div>";
	die();
}

?>