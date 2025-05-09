<div class="articles">
	<div class="searchbar">
		<input id="searchproduct" onkeydown="enter(event, 3);" type="text" class="searchinput" placeholder="Nombre, marca o dimension">
		<button class="searchbutton" onclick="search('searchproduct', 'list', 3);">Buscar</button>
	</div>
	<div id="list" class="list">
	<?php
		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
		if (!$dbconnection)
		{
    		echo "Error conectando a la base de datos";
    		die();
		}
		$sentence = "SELECT * FROM products";
		$result = mysqli_query($dbconnection, $sentence);
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$name = $row['product_name'];
				$dimension = $row['product_dimension'];
				$brand = $row['product_brand'];
				$ownername = strtoupper($row['product_ownername']);
				$ownerid = $row['product_owner'];
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
				echo "<a href='profile.php?usuario=$ownerid'><span class='edit'>$ownername</span></a>\n";
			}
		}
		else
		{
			echo "<div class='error'>Aún no hay productos cargados</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>