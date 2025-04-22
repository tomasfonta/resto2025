<div class="articles">
	<div id="list" class="list">
	<?php
		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
		if (!$dbconnection)
		{
    		echo "Error conectando a la base de datos";
    		die();
		}
		$sentence = "SELECT * FROM users";
		$result = mysqli_query($dbconnection, $sentence);
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$user_loginname = $row['user_loginname'];
				$user_password = $row['user_password'];
				$user_email = $row['user_email'];
				$type = $row['user_type'];
				
				echo "<div class='article'>\n";
				echo "Usuario: $user_loginname<br>";
				echo "Contraseña: $user_password<br>";
				echo "Email: $user_email<br>";

				if($type == 1)
				{
					$user_type = 'Cliente';
					
					
					echo "Tipo: $user_type<br>";
					
				}
				else
				{
					$user_type = 'Proveedor';
					
					echo "Tipo: $user_type<br>";
					echo "Categorias: ";
					
					$id = $row['user_id'];
				
					$categories = "";
					
					// Aca tengo que traer todas las categorias
					
					$sentence = "SELECT * FROM users_category join category on category.category_id = users_category.category_id where users_category.user_id = '$id'";
					$result2 = mysqli_query($dbconnection, $sentence);
					$rows = mysqli_num_rows($result2);
					if($rows > 0)
					{
						while($row = mysqli_fetch_assoc($result2))
						{
							$categories = $row['category_name'];
							echo $categories." ";
						}
					}
					echo "<br>";
				}
				echo "</div>\n";
				if($type == 1)
				{
					$user_type = 'Cliente';
					
					
					echo "<span class='edit'></span></a>";
					
				}else{
					echo "<a href=\"home.php?pagina=providers&usuario=$id\"> <span class='edit'> Ver Todo los productos </span></a>";
				}
				
			}
		}
		else
		{
			echo "<div class='error'>Aún no hay usuarios cargados</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>
