<?php

require_once '../includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: ../login.php');
	die();
}

if($_POST['producto'])
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	
	if(!$dbconnection)
	{
		echo "<div class='error'>Error al conectar con la base de datos</div>";
    	die();
	}
	
	$ownerok = $_SESSION['id'];
	$ownername = $_SESSION['loginname'];

	$form_name = strip_tags($_POST['producto']['pname']);
	$form_brand = strip_tags($_POST['producto']['pbrand']);
	$form_dimension = $_POST['producto']['pdimension'];
	$form_unit = $_POST['producto']['punit'];
	$form_price = $_POST['producto']['pprice'];
	$form_category = $_POST['producto']['pcategory'];

	$nameok = mysqli_real_escape_string($dbconnection, $form_name);
	$brandok = mysqli_real_escape_string($dbconnection, $form_brand);
	$dimensionok = mysqli_real_escape_string($dbconnection, $form_dimension);
	$unitok = mysqli_real_escape_string($dbconnection, $form_unit);
	$priceok = mysqli_real_escape_string($dbconnection, $form_price);
	$categoryok = mysqli_real_escape_string($dbconnection, $form_category);

	
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
	
	$owner = $_SESSION['id'];
	
	$sql = "INSERT INTO products (product_category, product_name, product_brand, product_dimension, product_price, product_ownername, product_owner)
		 VALUES ('$categoryok','$nameok', '$brandok', '$dimension', '$priceok', '$ownername', '$ownerok')";

	try{ 
        mysqli_query($dbconnection, $sql);
        echo "<div  class=\"alert alert-success\"> Cargado Correctamente </div>";

	} catch (mysqli_sql_exception $e) {
        echo "<div  class=\"alert alert-error\"> Error </div>";
	}
	mysqli_close($dbconnection);
}
else
{
	echo "Error al intentar actualizar";
}

?>