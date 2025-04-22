<?php

require_once 'includes/constants/connection.php';

session_start();

if(!isset($_SESSION['loginname']))
{
	header('Location: index.php');
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

if(!empty($_GET['usuario']))
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	$userid =  mysqli_real_escape_string($dbconnection, $_GET['usuario']);
	$sentence = "SELECT * FROM users WHERE user_id = '$userid'";
	$result = mysqli_query($dbconnection, $sentence);
	$rows = mysqli_num_rows($result);
	if($rows > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$user_id = $row['user_id'];
			$user_type = $row['user_type'];
			$user_loginname = strtoupper($row['user_loginname']);
			$user_location = $row['user_location'];
			$user_telephone1 = $row['user_telephone1'];
			$user_telephone2 = $row['user_telephone2'];
			$user_cellphone1 = $row['user_cellphone1'];
			$user_cellphone2 = $row['user_cellphone2'];
			$user_contactemail = $row['user_contactemail'];
			$user_website = $row['user_website'];
			$user_name = $row['user_name'];
			$user_description = $row['user_description'];
			$user_photo = $row['user_photo'];
		}
		if(($_SESSION['type'] === $user_type) && ($_SESSION['id'] != $user_id))
		{
			mysqli_free_result($result);
			mysqli_close($dbconnection);
			header('Location: home.php');
			die();
		}
	}
	else
	{
		header('Location: home.php');
		die();
	}
}
else
{
	header('Location: home.php');
	die();
}

date_default_timezone_set("America/Argentina/Buenos_Aires");

?>

<!DOCTYPE html>
<html lang="es-AR">
	<head>
		<title><?php echo "RestoCompras - $user_loginname"; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0, maximun-scale=1.0, user-scalable=no">
		<meta name="theme-color" content="#74b9ff">
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<script type="application/javascript" src="scripts/functions.js" charset="UTF-8"></script>
	</head>
	<body class="home">
		<div class="menu" id="menu">
			<button class="menubutton2" onclick="toggle('menu');"></button>
			<img src="images/logo.png" class="logomenu">
			<div class="navlist">
				<?php require_once "includes/content/$file_include/menu.php"; ?>
			</div>
		</div>
		<div class="header">
			<button class="menubutton" onclick="toggle('menu');"></button>
			<div class="sectionname">PERFIL</div>
		</div>
		<div class="body">
			<div class="profile">
				<div class="cover">
					<div class="picture"><img class="photo" src="images/<?php echo $user_photo; ?>"></div>
				</div>
				<div class="profiledata">
					<span class="contact"><?php echo "$user_loginname"; ?></span>
					<span><?php echo "$user_name"; ?></span><br>
					<span class="resume"><?php echo "$user_description"; ?></span><br>
				</div>
				<div class="contactdata">
					<span class="title">Dirección</span><br>
					<span><?php echo "$user_location"; ?></span><br>
				</div>
				<div class="contactdata">
					<span class="title">Número de teléfono</span><br>
					<span><h2><?php echo "$user_telephone1"; ?></h2></span><br>
					<span><h2><?php echo "$user_telephone2"; ?></h2></span><br>
				</div>
				<div class="contactdata">
					<span class="title">Número de celular</span><br>
					<span><h2><?php echo "$user_cellphone1"; ?></h2></span><br>
					<span><h2><?php echo "$user_cellphone2"; ?></h2></span><br>
				</div>
				<div class="contactdata">
					<span class="title">Email de contacto</span><br>
					<span><?php echo "$user_contactemail"; ?></span><br>
				</div>
				<div class="contactdata">
					<span class="title">Página web</span><br>
					<span><?php echo "$user_website"; ?></span><br>
				</div>
			</div>
			<?php

			if($user_type == 0)
			{
				$timenow = time();
				$sentence = "SELECT * FROM offers WHERE offer_owner = '$userid' AND offer_time > '$timenow'";
				$result = mysqli_query($dbconnection, $sentence);
				$rows = mysqli_num_rows($result);
				if($rows > 0)
				{
					echo "<div class='articles articlesprofile'>\n<div class='header'>Ofertas actuales</div>\n<div class='profilelist'>\n";
					while($row = mysqli_fetch_assoc($result))
					{
						$name = $row['offer_name'];
						$dimension = $row['offer_dimension'];
						$brand = $row['offer_brand'];
						$minimun = $row['offer_minimun'];
						$time = $row['offer_time'];
						$expiration = date("d/m/Y H:i \h\s", $time);
						$price = number_format($row['offer_price'], 2, ',', '.');
						$date = date("d/m/Y H:i \h\s", strtotime($row['offer_date']));

						echo "<div class='article'>\n";
						echo "<strong>$name</strong><br>";
						echo "Marca: $brand<br>";
						echo "Dimensión: $dimension<br>";
						echo "Precio: $$price<br>";
						echo "Valido hasta: $expiration<br>";
						echo "Compra mínima en unidades: $minimun<br>";
						echo "Última edición: $date<br>";
						echo "</div>\n";
						echo "<span class='edit'></span>\n";
					}
					echo "</div>\n</div>\n";
				}
				else
				{
					echo "<div class='errorcontainer'><div class='error'>Sin ofertas activas</div></div>";
				}
				$sentence = "SELECT * FROM products WHERE product_owner = '$userid'";
				$result = mysqli_query($dbconnection, $sentence);
				$rows = mysqli_num_rows($result);
				if($rows > 0)
				{
					echo "<div class='articles articlesprofile'>\n<div class='header'>Productos actuales</div>\n<div class='profilelist'>\n";
					while($row = mysqli_fetch_assoc($result))
					{
						$name = $row['product_name'];
						$dimension = $row['product_dimension'];
						$brand = $row['product_brand'];
						$price = $row['product_price'];
						$priceok = number_format($price, 2, ',', '.');
						$date = date("d/m/Y H:i \h\s", strtotime($row['product_date']));

						echo "<div class='article'>\n";
						echo "<strong>$name</strong><br>";
						echo "Marca: $brand<br>";
						echo "Dimensión: $dimension<br>";
						echo "Precio: $$priceok<br>";
						echo "Última edición: $date<br>";
						echo "</div>\n";
						echo "<span class='edit'></span>\n";
					}
					echo "</div>\n</div>\n";
				}
				else
				{
					echo "<div class='errorcontainer'><div class='error'>Sin productos activos</div></div>";
				}
				mysqli_free_result($result);
				mysqli_close($dbconnection);
			}
			else
			{
				mysqli_free_result($result);
				mysqli_close($dbconnection);
			}

			?>
		</div>
	</body>
</html>