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

if(!empty($_GET['pagina']))
{
	$select = $_GET['pagina'];
	switch ($select)
	{
		case 'nuevousuario':
			$option = 'newuser';
			$title = 'Nuevo usuario';
			break;
		
		case 'listarusuarios':
			$option = 'users';
			$title = 'Usuarios';
			break;

		case 'contadores':
			$option = 'counters';
			$title = 'Contadores';
			break;
			
		case 'providers':
			$option = 'providers';
			$title = 'Detalle del Proveedor';
			break;

		case 'salir':
			session_destroy();
			header('Location: index.php');
			die();

		default:
			$option = 'index';
			$title = 'Inicio2';
			break;
	}
}
else
{
	$option = 'index';
	$title = 'Inicio3';
}

date_default_timezone_set("America/Argentina/Buenos_Aires");

?>

<!DOCTYPE html>
<html lang="es-AR">
	<head>
		<title><?php echo "RestoCompras - $title"; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0, maximun-scale=1.0, user-scalable=no">
		<meta name="theme-color" content="#74b9ff">
		<link rel="stylesheet" type="text/css" href="../styles/main.css">
		<script type="application/javascript" src="../scripts/functions.js" charset="UTF-8"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<div id="modal" class="modal">
		<div class="container">
			<button class="menubutton2" onclick="hide('modal');"></button>
			<div class="delete">
				<span class="message">¿Desea eliminar este artículo?</span><br>
				<button class="deletebutton" onclick="drop();">Eliminar</button>
			</div>
		</div>
	</div>
	<body class="home">
		<div class="menu" id="menu">
			<button class="menubutton2" onclick="toggle('menu');"></button>
			<img src="../images/logo.png" class="logomenu">
			<div class="navlist">
				<?php require_once "../includes/content/admin/menu.php"; ?>
			</div>
		</div>
		<div class="header">
			<button class="menubutton" onclick="toggle('menu');"></button>
			<div class="sectionname"><?php echo strtoupper($title); ?></div>
		</div>
		<div class="body">
			<?php require_once "../includes/content/admin/$option.php"; ?>
		</div>
	</body>
	
</html>