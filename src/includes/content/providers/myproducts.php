<div class="articles">
	<div>
                <div class="input-field" id="input-container-3">
                    <label for="navbar-search">Buscar:</label>
                    <input id="navbar-search" type="text">
                </div>
                <table class="table" id="searchable-3">
                    <tbody>
                        <?php
							$owner = $_SESSION['id'];
							$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
							if (!$dbconnection)
							{
					    		echo "Error conectando a la base de datos";
					    		die();
							}
							$sentence = "SELECT * FROM `products` inner join category on product_category = category.category_id WHERE product_owner = '$owner' ";
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
									$category = $row['category_name'];
									$date = date("d/m/Y H:i \h\s", strtotime($row['product_date']));
									
									echo "<tr>";
					                echo "<td>";
					                echo "<div class='article'>\n";
									echo "<strong>$name</strong><br>";
									echo "Marca: $brand<br>";
									echo "Dimensión: $dimension<br>";
									echo "Precio: $$priceok<br>";
									echo "Categoria: $category<br>";
									echo "Última edición: $date<br>";
									echo "</div>\n";
									echo "<span class='edit' onclick=\"showmodal('$id', 1);\">Eliminar</span>\n";
					                echo "</td>";
					            	echo "</tr>";
									
								}
							}
							else
							{
								echo "<div class='error'>Aún no cargaste productos, si no sabes como hacerlo, visita la sección ayuda</div>";
							}
							mysqli_free_result($result);
							mysqli_close($dbconnection);
						?>
                    </tbody>
                </table>
            </div>
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




