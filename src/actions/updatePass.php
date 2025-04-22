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
	
	$userid = $_SESSION['id'];
	$sentence = "SELECT * FROM users WHERE user_id = '$userid'";
	$result = mysqli_query($dbconnection, $sentence);
	$rows = mysqli_num_rows($result);
	if($rows > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$user_password = $row['user_password'];
			
		}
	}
	else
	{
		echo "Parece que algo inesperado sucedio :(";
	}
	mysqli_free_result($result);
	
	$actualok = $_POST['actual'];
	
	$new = mysqli_real_escape_string($dbconnection, $_POST['nueva']);
	$newok = strip_tags($new);
	
	if ( $user_password === $actualok){
		
	
		$sql = "UPDATE users SET user_password='$newok' WHERE user_id = '$userid'";
	
		if (mysqli_query($dbconnection, $sql))
		{	
		    echo "Cambio realizado con Exito";
			die();
		}
		else
		{
	    	echo "Error al intentar actualizar";
		}
		mysqli_close($dbconnection);
		
	}else{
		//puso mal la clave actual
		echo "Datos Incorrectos";
		die();
	}
}
else
{
	echo "Error al intentar actualizar";
	die();
}

?>