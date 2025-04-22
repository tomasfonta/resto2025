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
		$option = 'buscar';
		$title = 'Inicio2';
	}
	elseif($select === 'perfil')
	{
		$option = 'perfil';
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
					$option = 'agregar';
					$title = 'Agregar';
					break;

				case 'misproductos':
					$option = 'misProductos';
					$title = 'Mis productos';
					break;

				case 'ofertas':
					$option = 'misOfertas';
					$title = 'Mis ofertas';
					break;

				case 'pedidos':
					$option = 'pedidos';
					$title = 'solicitudes';
					break;
				
				case 'perfilProveedor':
					$option = 'perfilProveedor';
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
					$option = 'proveedores';
					$title = 'Proveedores';
					break;

				case 'buscar1':
					$option = 'buscar';
					$title = 'Buscar';
					break;
					
				
				case 'ofertas':
					$option = 'ofertas';
					$title = 'Ofertas';
					break;

				case 'perfil':
					$option = 'perfil';
					$title = 'Solicitar';
					break;
					
				case 'perfilCliente':
					$option = 'perfilCliente';
					$title = 'perfilCliente';
					break;
					
				case 'solicitar':
					$option = 'request';
					$title = 'perfilCliente';
					break;

				default:
					$option = 'buscar';
					$title = 'buscar';
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
	
	<?php 
		include 'system/pages/clients/layout/header.php';
	if($_SESSION['type'] == 1)
	{	 
		include 'system/pages/clients/layout/navClients.php'; 
	}
	if($_SESSION['type'] == 0)
	{	 
		include 'system/pages/providers/layout/navProviders.php'; 
	}
	?>
	<body class="home">
			<?php require_once "system/pages/$file_include/$option.php"; ?>
	</body>
</html>