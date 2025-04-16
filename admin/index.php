<?php

require_once '../includes/constants/connection.php';

session_start();

if(isset($_SESSION['loginname']))
{
	header('Location: ../home.php');
	die();
}

if(isset($_SESSION['admin']))
{
	header('Location: home.php');
	die();
}

if(!empty($_POST))
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);

	if (!$dbconnection)
	{
    	die("Problemas en la conexión: " . mysqli_connect_error());
	}

	$form_user = strtolower($_POST['user']);
	$form_password = $_POST['password'];

	$userok = mysqli_real_escape_string($dbconnection, $form_user);
	$passwordok = mysqli_real_escape_string($dbconnection, $form_password);

	$sentence = "SELECT * FROM admins WHERE BINARY `admin_loginname` = '$userok' AND BINARY `admin_password` = '$passwordok'";
	$result = mysqli_query($dbconnection, $sentence);
	$rows = mysqli_num_rows($result);
	if($rows > 0 && $rows < 2)
	{
		$data = mysqli_fetch_assoc($result);
		$_SESSION['admin'] = $data['admin_loginname'];

		mysqli_free_result($result);
		mysqli_close($dbconnection);

		header('Location: home.php');
		die();
	}
	else
	{
		$loginmessage = "Usuario o contraseña incorrectos";
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	}
}
else
{
	$loginmessage = "Ingrese usuario y contraseña";
}

?>

<!DOCTYPE html>
<html lang="es-AR">
	<head>
		<title>Iniciar sesión - Administrador</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0, maximun-scale=1.0, user-scalable=no">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="theme-color" content="#74b9ff">
		<link rel="stylesheet" type="text/css" href="../styles/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body class="index">
		<img src="../images/logo.png" class="logoheader">
		<div class="body">
			<div class="login-message"><?php echo "$loginmessage"; ?></div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
				<input type="text" name="user" class="login-field" placeholder="Usuario" required><br>
				<input type="password" name="password" class="login-field" placeholder="Contraseña" required><br>
				<input type="submit" value="Iniciar sesión" name="" class="login-field radius">
			</form>
		</div>
		<div class="footer">
			Terminos y Condiciones
		</div>
	</body>
</html>