<?php

require_once '../includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: ../login.php');
	die();
}

if($_GET)
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	
	if(!$dbconnection)
	{
		echo "<div class='error'>Error al conectar con la base de datos</div>";
    	die();
	}

	$nameok = mysqli_real_escape_string($dbconnection, $_GET['data1']);
	$nameok = strip_tags($nameok);
	
	$descriptionok = mysqli_real_escape_string($dbconnection, $_GET['data2']);
	$descriptionok = strip_tags($descriptionok);
	
	$locationok = mysqli_real_escape_string($dbconnection, $_GET['data3']);
	$locationok = strip_tags($locationok);
	
	$telephone1ok = mysqli_real_escape_string($dbconnection, $_GET['data4']);
	$telephone1ok = strip_tags($telephone1ok);
	
	$telephone2ok = mysqli_real_escape_string($dbconnection, $_GET['data5']);
	$telephone2ok = strip_tags($telephone2ok);
	
	$cellphone1ok = mysqli_real_escape_string($dbconnection, $_GET['data6']);
	$cellphone1ok = strip_tags($cellphone1ok);
	
	$cellphone2ok = mysqli_real_escape_string($dbconnection, $_GET['data7']);
	$cellphone2ok = strip_tags($cellphone2ok);
	
	$contactemailok = mysqli_real_escape_string($dbconnection, $_GET['data8']);
	$contactemailok = strip_tags($contactemailok);
	
	$websiteok = mysqli_real_escape_string($dbconnection, $_GET['data9']);
	$websiteok = strip_tags($websiteok);

	$owner = $_SESSION['id'];

	$sql = "UPDATE users SET user_name='$nameok', user_description='$descriptionok', user_location='$locationok', user_telephone1='$telephone1ok', user_telephone2='$telephone2ok', user_cellphone1='$cellphone1ok', user_cellphone2='$cellphone2ok', user_contactemail='$contactemailok', user_website='$websiteok' WHERE user_id = '$owner'";

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