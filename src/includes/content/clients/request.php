<div class="add">
	<button class="button" onclick="toggle('product');">NUEVA SOLICITUD</button>
	<div class="form" id="product">
		<form id="form3" action="actions/newrequest.php" method="POST">
			<div class="fields">
				Nombre del producto<br>
				<input id="name" type="text" class="input" name="name" maxlength="30"><br>
			</div>
			<div class="fields">
				Marca<br>
				<input id="brand" type="text" class="input" name="brand" maxlength="30">
			</div>
			<div class="fields">
				Dimensión<br>
				<input id="dimension" type="text" class="dimension" name="dimension" maxlength="6">
				<select class="select" name="unit">
					<option value="1">Gramos</option>
					<option value="2">Kilogramos</option>
					<option value="3">Litros</option>
					<option value="4">Mililitros</option>
				</select> 
				<br>
			</div>
		</form>
		<button id="submit1" class="submit" onclick="submitform('form3');">Solicitar</button>
	</div>
</div>
<div class="articles">
	<div id="list" class="list">
	<?php
		$owner = $_SESSION['id'];
		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
		if (!$dbconnection)
		{
    		echo "Error conectando a la base de datos";
    		die();
		}
		$sentence = "SELECT * FROM requests WHERE request_owner = '$owner'";
		$result = mysqli_query($dbconnection, $sentence);
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$name = $row['request_name'];
				$dimension = $row['request_dimension'];
				$brand = $row['request_brand'];
				$id = $row['request_id'];

				echo "<div class='article'>\n";
				echo "$name<br>";
				echo "Marca: $brand<br>";
				echo "Dimensión: $dimension<br>";
				echo "</div>\n";
				echo "<span class='edit' onclick=\"showmodal('$id', 3);\">Eliminar</span>\n";
			}
		}
		else
		{
			echo "<div class='error'>Aún no solicitaste productos, si no sabes como hacerlo, visita la sección ayuda</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>