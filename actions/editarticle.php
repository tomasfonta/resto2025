<?php

require_once '../includes/constants/connection.php';

date_default_timezone_set("America/Argentina/Buenos_Aires");

session_start();

	$id = $_POST['id'];
	$price = $_POST['price'];
	
	$sql = "UPDATE products SET product_price = '$price', product_date =  CURRENT_TIMESTAMP	 WHERE product_id = '$id'";
	
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

?>