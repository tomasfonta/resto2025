<?php

require_once '../includes/constants/connection.php';

date_default_timezone_set("America/Argentina/Buenos_Aires");

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: ../login.php');
	die();
}

if(!empty($_GET['data1']) && !empty($_GET['data2']))
{
	$id = $_GET['data1'];
	$price = $_GET['data2'];
	$time = $_GET['data3'];
	$owner = $_SESSION['id'];

	if($time > 0)
	{
		$timeok = strtotime("$time hours");
		$sql = "UPDATE offers SET offer_price = '$price', offer_time = '$timeok' WHERE offer_owner = '$owner' AND offer_id = '$id'";
	}
	else
	{
		$sql = "UPDATE offers SET offer_price = '$price' WHERE offer_owner = '$owner' AND offer_id = '$id'";
	}

	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);

	if(!$dbconnection)
	{
		echo "<div class='error'>Error al conectar con la base de datos</div>";
		die();
	}

	if (mysqli_query($dbconnection, $sql))
	{
	    echo "<div class='error'>Editado exitosamente</div>";
	}
	else
	{
    	echo "<div class='error'>Error al intentar editar</div>";
	}
	mysqli_close($dbconnection);
}
else
{
	echo "<div class='error'>Error al intentar editar</div>";
	die();
}

?>