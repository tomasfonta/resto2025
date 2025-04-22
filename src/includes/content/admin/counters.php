<div class="articles">
	<div id="list" class="list">
	<?php
		$totalcounter = 0;
		$clientcounter = 0;
		$providercounter = 0;
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
				$user_type = $row['user_type'];
				$user_count = $row['user_count'];
				$user_id = $row['user_id'];

				if($user_type == 0)
				{
					$userlabel = 'proveedor';
				}
				else
				{
					$userlabel = 'cliente';
				}

				echo "<div class='article'>\n";
				echo "Usuario: $user_loginname<br>";
				echo "Tipo de usuario: $userlabel<br>";
				echo "Inicios de sesión: $user_count<br>";
				echo "</div>\n";
				echo "<span class='edit' onclick=\"reset('$user_id');\">Reiniciar</span>\n";
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