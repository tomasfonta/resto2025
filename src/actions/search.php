<?php

require_once '../includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: login.php');
	die();
}

date_default_timezone_set("America/Argentina/Buenos_Aires");

$owner = $_SESSION['id'];

if($_GET)
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	
	if (!$dbconnection)
	{
    	echo "<div class='error'>Error al conectar con la base de datos</div>";
    	die();
	}
	
	$var1 = mysqli_real_escape_string($dbconnection, $_GET['data1']);
	$var2 = mysqli_real_escape_string($dbconnection, $_GET['type']);
	$timenow = time();

	$message = "";

	switch ($var2)
	{
		// MATCH(title, body) AGAINST ('PHP')
		// product_name LIKE '%$var1%' OR product_brand LIKE '%$var1%' OR product_dimension LIKE '%$var1%' OR product_ownername LIKE '%$var1%'
		// MATCH (title, body) AGAINST ('$f')

		case '1':
			if(empty($var1))
			{
				$sql = "SELECT * FROM products WHERE product_owner = '$owner'";
				break;
			}
			else
			{
				$sql = "SELECT * FROM products WHERE MATCH (product_name, product_brand, product_dimension, product_ownername) AGAINST ('$var1') AND product_owner = '$owner'";
				break;
			}
		case '2':
			if(empty($var1))
			{
				$sql = "SELECT * FROM offers WHERE offer_owner = '$owner'";
				break;
			}
			else
			{
				$sql = "SELECT * FROM offers WHERE MATCH (offer_name, offer_brand, offer_dimension, offer_ownername) AGAINST ('$var1') AND offer_owner = '$owner'";
				break;
			}
		case '3':
			if(empty($var1))
			{
				$sql = "SELECT * FROM products";
				break;
			}
			else
			{
				$sql = "SELECT * FROM products WHERE MATCH (product_name, product_brand, product_dimension, product_ownername) AGAINST ('$var1')";
				break;
			}
		case '4':
			if(empty($var1))
			{
				$sql = "SELECT * FROM offers WHERE offer_time > '$timenow'";
				break;
			}
			else
			{
				$sql = "SELECT * FROM offers WHERE MATCH (offer_name, offer_brand, offer_dimension, offer_ownername) AGAINST ('$var1') AND offer_time > '$timenow'";
				break;
			}
		case '5':
			$sql = "SELECT * FROM users WHERE user_loginname LIKE '%$var1%' AND user_type = 0";
			break;

		default:
			$sql = "SELECT * FROM products";
			break;
	}
	

	$result = mysqli_query($dbconnection, $sql);
	$rows = mysqli_num_rows($result);
	if ($rows === 0)
	{
		$message = "<div class='error'>No se encontraron resultados</div>";
	}
	else
	{
		while($row = mysqli_fetch_array($result))
		{
			switch ($var2)
			{
				case '1':
					$name = $row['product_name'];
					$dimension = $row['product_dimension'];
					$brand = $row['product_brand'];
					$id = $row['product_id'];
					$price = $row['product_price'];
					$priceok = number_format($price, 2, ',', '.');
					$date = date("d/m/Y H:i \h\s", strtotime($row['product_date']));

					$message .= "<div class='article'>\n<strong>$name</strong><br>Marca: $brand<br>Dimensión: $dimension<br>Precio: $$priceok<br>Última edición: $date<br></div>\n<span class='edit' onclick=\"showmodal('$id', 1);\">Eliminar</span>\n";
					break;
				
				case '2':
					$name = $row['offer_name'];
					$dimension = $row['offer_dimension'];
					$brand = $row['offer_brand'];
					$id = $row['offer_id'];
					$minimun = $row['offer_minimun'];
					$time = $row['offer_time'];
					$expiration = date("d/m/Y H:i \h\s", $time);
					$price = number_format($row['offer_price'], 2, ',', '.');
					$date = date("d/m/Y H:i \h\s", strtotime($row['offer_date']));

					$message .= "<div class='article'>\n<strong>$name</strong><br>Marca: $brand<br>Dimensión: $dimension<br>Precio: $$price<br>Valido hasta: $expiration<br>Compra mínima en unidades: $minimun<br>Última edición: $date<br></div>\n<span class='edit' onclick=\"showmodal('$id', 2);\">Eliminar/Editar</span>\n";
					break;

				case '3':
					$name = $row['product_name'];
					$dimension = $row['product_dimension'];
					$brand = $row['product_brand'];
					$ownername = strtoupper($row['product_ownername']);
					$ownerid = $row['product_owner'];
					$id = $row['product_id'];
					$price = $row['product_price'];
					$priceok = number_format($price, 2, ',', '.');
					$date = date("d/m/Y H:i \h\s", strtotime($row['product_date']));

					$message .= "<div class='article'>\n<strong>$name</strong><br>Marca: $brand<br>Dimensión: $dimension<br>Precio: $$priceok<br>Última edición: $date<br></div>\n<a href='profile.php?usuario=$ownerid'><span class='edit'>$ownername</span></a>\n";
					break;

				case '4':
					$name = $row['offer_name'];
					$dimension = $row['offer_dimension'];
					$brand = $row['offer_brand'];
					$ownername = strtoupper($row['offer_ownername']);
					$ownerid = $row['offer_owner'];
					$id = $row['offer_id'];
					$minimun = $row['offer_minimun'];
					$time = $row['offer_time'];
					$expiration = date("d/m/Y H:i \h\s", $time);
					$price = number_format($row['offer_price'], 2, ',', '.');
					$date = date("d/m/Y H:i \h\s", strtotime($row['offer_date']));

					$message .= "<div class='article'>\n<strong>$name</strong><br>Marca: $brand<br>Dimensión: $dimension<br>Precio: $$price<br>Valido hasta: $expiration<br>Compra mínima en unidades: $minimun<br>Última edición: $date<br></div>\n<a href='profile.php?usuario=$ownerid'><span class='edit'>$ownername</span></a>\n";
					break;

				case '5':
					$nameok = strtoupper($row['user_loginname']);
					$photook = $row['user_photo'];
					$idok = $row['user_id'];

					$message .= "<a href='profile.php?usuario=$idok'><div class='providers'>\n<div class='providerphoto'><img width='50' height='50' src='images/$photook'></div>\n$nameok<br></div></a>\n";
					break;

				default:
					break;
			}
		}

	}

	mysqli_close($dbconnection);
	echo $message;
}

?>