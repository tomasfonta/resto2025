<?php

require_once '../includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']) || $_SESSION['type'] == 0)
{
	header('Location: ../login.php');
	die();
}

if($_SESSION['type'] == 0)
{
	$file_include = "providers";
}
else
{
	$file_include = "clients";
}

if(!empty($_POST))
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);

	if (!$dbconnection)
	{
    	echo "<div class='error'>Error al conectar con la base de datos</div>";
		die();
	}

	$form_name = strip_tags($_POST['name']);
	$form_brand = strip_tags($_POST['brand']);
	$form_dimension = $_POST['dimension'];
	$form_unit = $_POST['unit'];
	$form_category = $_POST['category'];

	$nameok = mysqli_real_escape_string($dbconnection, $form_name);
	$brandok = mysqli_real_escape_string($dbconnection, $form_brand);
	$dimensionok = mysqli_real_escape_string($dbconnection, $form_dimension);
	$unitok = mysqli_real_escape_string($dbconnection, $form_unit);
	$categoryok = mysqli_real_escape_string($dbconnection, $form_category);

	$ownerok = $_SESSION['id'];
	$ownername = $_SESSION['loginname'];

	switch ($unitok)
	{
		case 1:
			$unit = "g";
			break;
		
		case 2:
			$unit = "kg";
			break;
		
		case 3:
			$unit = "l";
			break;
		
		case 4:
			$unit = "ml";
			break;
		default:
			$unit = "";
			break;
	}

	$dimension = "$dimensionok $unit";

	$sentence = "INSERT INTO requests (request_name, request_brand, request_dimension, request_ownername, request_owner , request_category)
		 VALUES ('$nameok', '$brandok', '$dimension', '$ownername', '$ownerok', '$categoryok')";

	if (mysqli_query($dbconnection, $sentence))
	{
    	header('Location: ../home.php?pagina=solicitar');
		die();
	}
	else
	{
    	echo "<div class='error'>Error al conectar con la base de datos</div>";
		die();
	}
	mysqli_close($dbconnection);
}
else
{
	echo "<div class='error'>Error al intentar agregar</div>";
	die();
}

?>