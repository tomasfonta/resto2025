<div class="articles">
	<div class="searchbar">
		<input id="searchmyproducts" onkeydown="enter(event, 1);" type="text" class="searchinput" placeholder="Nombre, marca o dimension">
		<button class="searchbutton" onclick="search('searchmyproducts', 'list', 1);">Buscar</button>
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
		$sentence = "SELECT * FROM products WHERE product_owner = '$owner'";
		$result = mysqli_query($dbconnection, $sentence);
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$name = $row['product_name'];
				$dimension = $row['product_dimension'];
				$brand = $row['product_brand'];
				$id = $row['product_id'];
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
				echo "<span class='edit' onclick=\"showmodal('$id', 1);\">Eliminar</span>\n";
			}
		}
		else
		{
			echo "<div class='error'>Aún no cargaste productos, si no sabes como hacerlo, visita la sección ayuda</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>