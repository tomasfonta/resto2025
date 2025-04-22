<?php

require_once 'includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
	{
		header('Location: login.php');
		die();
	}


if($_SESSION['type'] == 0)
{
	$file_include = "providers";
}
else
{
	$file_include = "clients";
}

if(!empty($_GET['pagina']))
{
	$select = $_GET['pagina'];

	if($select === 'inicio')
	{
		$option = 'index';
		$title = 'Inicio';
	}
	elseif($select === 'perfil')
	{
		$option = 'profile';
		$title = 'Perfil';
	}
	elseif($select === 'ayuda')
	{
		$option = 'help';
		$title = 'Ayuda';
	}
	elseif($select === 'salir')
	{
		session_destroy();
		header('Location: index.php');
		die();
	}
	else
	{
		if($_SESSION['type'] == 0)
		{
			switch($select)
			{
				case 'agregar':
					$option = 'add';
					$title = 'Agregar';
					break;

				case 'misproductos':
					$option = 'myproducts';
					$title = 'Mis productos';
					break;
					
				case 'misproductos2':
					$option = 'myproducts2';
					$title = 'Mis productos2';
					break;
					
				case 'misproductos3':
					$option = 'myproducts3';
					$title = 'Mis productos3';
					break;
					

				case 'misofertas':
					$option = 'myoffers';
					$title = 'Mis ofertas';
					break;

				case 'solicitudes':
					$option = 'requested';
					$title = 'solicitudes';
					break;
		
				default:
					$option = 'index';
					$title = 'Inicio';
					break;
			}
		}
		else
		{
			switch($select)
			{
				case 'proveedores':
					$option = 'providers';
					$title = 'Proveedores';
					break;

				case 'buscar':
					$option = 'search';
					$title = 'Buscar';
					break;
				
				case 'ofertas':
					$option = 'offers';
					$title = 'Ofertas';
					break;

				case 'solicitar':
					$option = 'request';
					$title = 'Solicitar';
					break;

				default:
					$option = 'index';
					$title = 'Inicio';
					break;
			}
		}
	}
}
else
{
	$option = 'index';
	$title = 'Inicio';
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
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<script type="application/javascript" src="scripts/functions.js" charset="UTF-8"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="application/javascript" src="scripts/jquery.search.min.js" charset="UTF-8"></script>
		<script type="application/javascript" src="scripts/search-it.min.js" charset="UTF-8"></script>
		
		<link rel="shortcut icon" href="/img/resto.ico.png">
		
	</head>
	<body class="home">
		<div id="modal" class="modal">
			<div class="container">
				<button class="menubutton2" onclick="hide('modal');"></button>
				<div class="delete">
					<span class="message">¿Desea eliminar este artículo?</span><br>
					<button class="deletebutton" onclick="drop();">Eliminar</button>
				</div>
			</div>
		</div>
		<div id="modaledit" class="modal">
			<div class="container2">
				<button class="menubutton2" onclick="hide('modaledit');"></button>
				<div class="delete">
					<span class="editlabel">Precio</span><br>
					<input type="text" id="editprice" class="editinput priceimage"><br>
					<span class="editlabel">Añadir horas de duración</span><br>
					<input type="text" id="edittime" value="0" class="editinput"><br>
					<button class="deletebutton" onclick="modify();">Editar</button>
					<button class="deletebutton" onclick="drop();">Eliminar</button>
				</div>
			</div>
		</div>
		<div class="menu" id="menu">
			<button class="menubutton2" onclick="toggle('menu');"></button>
			<img src="images/logo.png" class="logomenu">
			<div class="navlist">
				<?php require_once "includes/content/$file_include/menu.php"; ?>
			</div>
		</div>
		<div class="header">
			<button class="menubutton" onclick="toggle('menu');"></button>
			<div class="sectionname"><?php echo strtoupper($title); ?></div>
		</div>
		<div class="body">
			<?php require_once "includes/content/$file_include/$option.php"; ?>
		</div>
	</body>
	
</html>