<?php

require_once '../includes/constants/connection.php';

session_start();

if(isset($_SESSION['loginname']))
{
	header('Location: ../home.php');
	die();
}

if(!isset($_SESSION['admin']))
{
	header('Location: index.php');
	die();
}

if(!empty($_POST))
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);

	if (!$dbconnection)
	{
    	echo "<div class='error'>Error al conectar con la base de datos</div>";
		die();
	}

	$user_loginname = strtolower($_POST['name']);
	$user_password = $_POST['password'];
	$user_name = strtolower($_POST['userName']);
	$user_type = $_POST['type'];
	
	$categories = $_POST['categoria'];
	
	
	$sentence = "INSERT INTO users (user_name, user_loginname, user_password, user_type)
		 VALUES ('$user_name', '$user_loginname', '$user_password', '$user_type')";
	
	if (mysqli_query($dbconnection, $sentence))
	{
		
		mysqli_close($dbconnection);
		
		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    	
    	//BUSCO EL ID DEL NUEVO USUARIO GENEREADO

    	$sentence = "SELECT user_id FROM users WHERE user_loginname = '$user_loginname'";
						$result = mysqli_query($dbconnection, $sentence);
						$rows = mysqli_num_rows($result);
						if($rows > 0)
						{
							while($row = mysqli_fetch_assoc($result))
							{
								$id = $row['user_id'];
							}
						}
						
    	//Cargo las categorias para el usuario
    	foreach ($categories as $category){ 
    		$sentence = "INSERT INTO users_category (user_id, category_id) VALUES ('$id', '$category')";
			mysqli_query($dbconnection, $sentence);
		}
		
    	header('Location: ../admin/home.php?pagina=nuevousuario');
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