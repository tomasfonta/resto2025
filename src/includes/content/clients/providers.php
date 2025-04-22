<div class="articles">
	<div class="searchbar">
		<input id="searchproviders" onkeydown="enter(event, 5);" type="text" class="searchinput" placeholder="Nombre del proveedor">
		<button class="searchbutton" onclick="search('searchproviders', 'list', 5);">Buscar</button>
	</div>
	<div id="list" class="list">
	<?php
		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
		if (!$dbconnection)
		{
    		echo "Error conectando a la base de datos";
    		die();
		}
		$sentence = "SELECT * FROM users WHERE user_type = 0";
		$result = mysqli_query($dbconnection, $sentence);
		$rows = mysqli_num_rows($result);
		if($rows > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$nameok = strtoupper($row['user_name']);
				$photook = $row['user_photo'];
				$idok = $row['user_id'];

				echo "<a href='profile.php?usuario=$idok'><div class='providers'>\n";
				echo "<div class='providerphoto'><img width='50' height='50' src='images/$photook'></div>\n";
				echo "$nameok<br>";
				echo "</div></a>\n";
			}
		}
		else
		{
			echo "<div class='error'>Actualmente no hay proveedores</div>";
		}
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	?>
	</div>
</div>