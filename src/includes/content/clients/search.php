<div class="articles">
	<div class="input-field" id="input-container-3">
                    <label for="navbar-search">Buscar:</label>
                    <input id="navbar-search" type="text">
                </div>
                <table class="table" id="searchable-3">
                    <tbody>
	<?php
		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
		if (!$dbconnection)
		{
    		echo "Error conectando a la base de datos";
    		die();
		}
		$sentence = "SELECT * FROM products JOIN category ON category.category_id = products.product_category";
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
				$category = $row['category_name'];

				echo "<tr>";
				echo "<td>";
				echo "<div class='article'>\n";
				echo "<strong>$name</strong><br>";
				echo "Marca: $brand<br>";
				echo "Dimensión: $dimension<br>";
				echo "<h2>Precio: $$priceok </h2>";
				echo "Última edición: $date<br>";
				echo "Categoria: $category<br>";
				echo "</div>\n";
				echo "<a href='profile.php?usuario=$ownerid'><span class='edit'>$ownername</span></a>\n";
				echo "</td>";
				echo "</tr>";
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
<script>
$(document).ready(function() {
$('#searchable-3').searchIt({
        itemSelector: 'tr',
        $searchInput: $('#input-container-3').find('input'),
    });
});
</script>
