<div class="articles">
	<div class="searchbar">
		<input id="searchmyoffers" onkeydown="enter(event, 2);" type="text" class="searchinput" placeholder="Nombre, marca o dimension">
		<button class="searchbutton" onclick="search('searchmyoffers', 'list', 2);">Buscar</button>
	</div>
	<div id="list" class="list">
	<?php
		$owner = $_SESSION['id'];
		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
		if (!$dbconnection)
		{
    		echo "Error conectando a la base de datos";
    		die();
		}
		$sentence = "SELECT * FROM offers WHERE offer_owner = '$owner'";
		$result = mysqli_query($dbconnection, $sentence);
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$name = $row['offer_name'];
				$dimension = $row['offer_dimension'];
				$brand = $row['offer_brand'];
				$id = $row['offer_id'];
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
				echo "<span class='edit' onclick=\"showedit('$id', 2);\">Eliminar/Editar</span>\n";
			}
		}
		else
		{
			echo "<div class='error'>Aún no creaste ofertas, si no sabes como hacerlo, visita la sección ayuda</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>