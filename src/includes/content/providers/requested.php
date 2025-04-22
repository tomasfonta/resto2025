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
		$sentence = "SELECT * FROM requests JOIN users_category ON requests.request_category = users_category.category_id JOIN category ON category.category_id = requests.request_category WHERE users_category.user_id ='$owner'";
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
				$ownername = $row['request_ownername'];
				$ownerid = $row['request_owner'];
				$category_name = $row['category_name'];

				echo "<div class='article'>\n";
				echo "$name<br>";
				echo "Marca: $brand<br>";
				echo "Dimensión: $dimension<br>";
				echo "Categoría: $category_name<br>";
				echo "</div>\n";
				echo "<a href='profile.php?usuario=$ownerid'><span class='edit'>$ownername</span></a>\n";
			}
		}
		else
		{
			echo "<div class='error'>Actualmente no hay solicitudes</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>