<?php

require_once '../includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: ../login.php');
	die();
}

if($_POST['oferta'])
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	
	if(!$dbconnection)
	{
		echo "<div class='error'>Error al conectar con la base de datos</div>";
    	die();
	}
	
	$ownerok = $_SESSION['id'];
	$ownername = $_SESSION['loginname'];

	$form_name = strip_tags($_POST['oferta']['oname']);
	$form_brand = strip_tags($_POST['oferta']['obrand']);
	$form_dimension = $_POST['oferta']['odimension'];
	$form_unit = $_POST['oferta']['ounit'];
	$form_price = $_POST['oferta']['oprice'];
	$form_category = $_POST['oferta']['ocategory'];
	
	$form_time = $_POST['oferta']['otime'];
	$form_minimun = $_POST['oferta']['omin'];
	$timeok = mysqli_real_escape_string($dbconnection, $form_time);
	$minimunok = mysqli_real_escape_string($dbconnection, $form_minimun);
	
	if($timeok < 1)
		{
			$timeok = 1;
		}
	$time = strtotime("$timeok hours");
	
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
	
	$sql = "INSERT INTO offers (offer_name, offer_brand, offer_dimension, offer_price, offer_minimun, offer_time, offer_ownername, offer_owner, offer_category)
		 VALUES ('$nameok', '$brandok', '$dimension', '$priceok', '$minimunok', '$time', '$ownername','$ownerok', '$categoryok')";
	
	echo($sql);

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