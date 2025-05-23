<div class="articles">
	<div class="searchbar">
		<input id="searchoffers" onkeydown="enter(event, 4);" type="text" class="searchinput" placeholder="Nombre, marca o dimension">
		<button class="searchbutton" onclick="search('searchoffers', 'list', 4);">Buscar</button>
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
		$timenow = time();
		$sentence = "SELECT * FROM offers WHERE offer_time > '$timenow'";
		$result = mysqli_query($dbconnection, $sentence);
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$name = $row['offer_name'];
				$dimension = $row['offer_dimension'];
				$brand = $row['offer_brand'];
				$ownername = strtoupper($row['offer_ownername']);
				$ownerid = $row['offer_owner'];
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
				echo "<a href='profile.php?usuario=$ownerid'><span class='edit'>$ownername</span></a>\n";
			}
		}
		else
		{
			echo "<div class='error'>Actualmente no hay ofertas</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>