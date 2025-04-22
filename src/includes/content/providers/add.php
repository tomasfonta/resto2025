<?php

if(!empty($_GET['form']))
{
	if($_GET['form'] == 1)
	{
		$class1 = "form visible";
		$class2 = "form";
	}
	elseif ($_GET['form'] == 2)
	{
		$class1 = "form";
		$class2 = "form visible";
	}
	else
	{
		$class1 = "form";
		$class2 = "form";
	}
}
else
{
	$class1 = "form";
	$class2 = "form";
}
?>
<div class="add">
	<button class="button" onclick="switchforms('product');">NUEVO PRODUCTO</button>
	<div class="<?php echo $class1; ?>" id="product">
		<form id="form1" action="actions/newarticle.php" method="POST">
			<div class="fields">
				Nombre del producto<br>
				<input id="name" type="text" class="input" name="name" maxlength="50"><br>
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
					<option value="5">Unidades</option>
				</select> 
				<br>
			</div>
			<div class="fields">
				Precio<br>
				<input id="price" type="text" class="input priceimage" name="price" maxlength="10">
			</div>
			<div class="fields">
				Categoria<br>
				<select id="category" class="selectCategory" name="category">
				<?php
				
						// Busco todas las categorias
						$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
						if (!$dbconnection)
						{
				    		echo "Error conectando a la base de datos";
				    		die();
						}
						$ownerok = $_SESSION['id'];
						$sentence = "SELECT * FROM category join users_category on category.category_id = users_category.category_id WHERE users_category.user_id ='$ownerok'";
						$result = mysqli_query($dbconnection, $sentence);
						$rows = mysqli_num_rows($result);
						if($rows > 0)
						{
							while($row = mysqli_fetch_assoc($result))
							{
								$id = $row['category_id'];
								$name = $row['category_name'];
								
								echo "<option value=$id>$name</option>";
							}
						}
				?>
				</select> 
				<br>
			</div>
			<input type="hidden" name="case" value="0">
		</form>
		<button id="submit1" class="submit" onclick="submitform('form1');">Añadir</button>
	</div>
	
	<button class="button" onclick="switchforms('offer');">NUEVA OFERTA</button>
	<div class="<?php echo $class2; ?>" id="offer">
		<form id="form2" action="actions/newarticle.php" method="POST">
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
					<option value="5">Unidades</option>
				</select> 
				<br>
			</div>
			<div class="fields">
				Precio<br>
				<input id="price" type="text" class="input priceimage" name="price" maxlength="10">
			</div>
			<div class="fields">
				Duración de oferta en horas<br>
				<input id="time" type="text" class="input" name="time" maxlength="3">
			</div>
			<div class="fields">
				Compra mínima en unidades<br>
				<input id="minimun" type="text" class="input" name="minimun" maxlength="4">
			</div>
			<input type="hidden" name="case" value="1">
		</form>
		<button id="submit2" class="submit" onclick="submitform('form2');">Añadir</button>
	</div>
</div>