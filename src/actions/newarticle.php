<?php

require_once '../includes/constants/connection.php';

date_default_timezone_set("America/Argentina/Buenos_Aires");

session_start();

if(!isset($_SESSION['loginname']) || $_SESSION['type'] == 1)
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
	$form_price = $_POST['price'];
	$form_category = $_POST['category'];
	$form_case = $_POST['case'];

	$nameok = mysqli_real_escape_string($dbconnection, $form_name);
	$brandok = mysqli_real_escape_string($dbconnection, $form_brand);
	$dimensionok = mysqli_real_escape_string($dbconnection, $form_dimension);
	$unitok = mysqli_real_escape_string($dbconnection, $form_unit);
	$priceok = mysqli_real_escape_string($dbconnection, $form_price);
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

		case 5:
			$unit = "unidades";
			break;

		default:
			$unit = "";
			break;
	}

	$dimension = "$dimensionok $unit";

	if($form_case == 1)
	{
		$form_time = $_POST['time'];
		$form_minimun = $_POST['minimun'];
		$timeok = mysqli_real_escape_string($dbconnection, $form_time);
		$minimunok = mysqli_real_escape_string($dbconnection, $form_minimun);
		if($timeok < 1)
		{
			$timeok = 1;
		}
		$time = strtotime("$timeok hours");
		$sentence = "INSERT INTO offers (offer_name, offer_brand, offer_dimension, offer_price, offer_minimun, offer_time, offer_ownername, offer_owner)
		 VALUES ('$nameok', '$brandok', '$dimension', '$priceok', '$minimunok', '$time', '$ownername','$ownerok')";
	}
	else
	{
		$sentence = "INSERT INTO products (product_category, product_name, product_brand, product_dimension, product_price, product_ownername, product_owner)
		 VALUES ('$categoryok','$nameok', '$brandok', '$dimension', '$priceok', '$ownername', '$ownerok')";
	}

	if (mysqli_query($dbconnection, $sentence))
	{
		if($form_case == 1)
		{
			header('Location: ../home.php?pagina=agregar&form=2');
			die();	
		}
		else
		{
			header('Location: ../home.php?pagina=agregar&form=1');
			die();
		}
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