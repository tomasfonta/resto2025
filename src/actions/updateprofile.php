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

	
	$nameok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['nombre']);
	$nameok = strip_tags($nameok);
	
	$descriptionok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['descripcion']);
	$descriptionok = strip_tags($descriptionok);
	
	$locationok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['direccion']);
	$locationok = strip_tags($locationok);
	
	$telephone1ok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['tel1']);
	$telephone1ok = strip_tags($telephone1ok);
	
	$telephone2ok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['tel2']);
	$telephone2ok = strip_tags($telephone2ok);
	
	$cellphone1ok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['cel1']);
	$cellphone1ok = strip_tags($cellphone1ok);
	
	$cellphone2ok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['cel2']);
	$cellphone2ok = strip_tags($cellphone2ok);
	
	$contactemailok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['email']);
	$contactemailok = strip_tags($contactemailok);
	
	$websiteok = mysqli_real_escape_string($dbconnection, $_POST['updateUser']['web']);
	$websiteok = strip_tags($websiteok);

	$owner = $_SESSION['id'];
	


	$sql = "UPDATE users SET user_name='$nameok', user_description='$descriptionok', user_location='$locationok', user_telephone1='$telephone1ok', user_telephone2='$telephone2ok', user_cellphone1='$cellphone1ok', user_cellphone2='$cellphone2ok', user_contactemail='$contactemailok', user_website='$websiteok' WHERE user_id = '$owner'";

	if (mysqli_query($dbconnection, $sql))
	{	
	    header('Location: ../home.php?pagina=perfilCliente');
		die();
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
	header('Location: ../home.php?pagina=perfilCliente');
	die();
}

?>