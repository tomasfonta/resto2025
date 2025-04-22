<?php

$userid = $_SESSION['id'];
$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
if (!$dbconnection)
{
	echo "Error conectando a la base de datos";
	die();
}
$sentence = "SELECT * FROM users WHERE user_id = '$userid'";
$result = mysqli_query($dbconnection, $sentence);
$rows = mysqli_num_rows($result);
if($rows > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$user_email = $row['user_email'];
		$user_loginname = $row['user_loginname'];
		$user_registered = $row['user_registered'];
		$user_location = $row['user_location'];
		$user_telephone1 = $row['user_telephone1'];
		$user_telephone2 = $row['user_telephone2'];
		$user_cellphone1 = $row['user_cellphone1'];
		$user_cellphone2 = $row['user_cellphone2'];
		$user_contactemail = $row['user_contactemail'];
		$user_website = $row['user_website'];
		$user_name = $row['user_name'];
		$user_description = $row['user_description'];
		$user_photo = $row['user_photo'];
	}
}
else
{
	echo "Parece que algo inesperado sucedio :(";
}
mysqli_free_result($result);
mysqli_close($dbconnection);

?>
<div class="profile">
	<div class="cover">
		<div class="picture"><img class="photo" src="images/<?php echo $user_photo; ?>"></div>
	</div>
	<div class="profiledata">
		<span class="contact">Usuario</span>
		<span><?php echo $user_loginname; ?></span><br>
		<span><?php echo $user_email; ?></span>
	</div>
	<div class="editabledata">
		<span class="contact">Datos de contacto</span>
		
		<span class="label">Nombre de contacto</span><br>
		<input class="input" id="uname" type="text" maxlength="30" value="<?php echo $user_name; ?>"><br>
		
		<span class="label">Descripción</span><br>
		<textarea class="area" id="udescription" maxlength="150"><?php echo $user_description; ?></textarea>
		
		<span class="label">Dirección física</span><br>
		<input class="input" id="ulocation" type="text" maxlength="100" value="<?php echo $user_location; ?>"><br>
		
		<span class="label">Telefono fijo</span><br>
		<input class="input" id="utelephone1" type="text" maxlength="45" value="<?php echo $user_telephone1; ?>"><br>
		
		<span class="label">Telefono fijo</span><br>
		<input class="input" id="utelephone2" type="text" maxlength="45" value="<?php echo $user_telephone2; ?>"><br>
		
		<span class="label">Celular</span><br>
		<input class="input" id="ucellphone1" type="text" maxlength="45" value="<?php echo $user_cellphone1; ?>"><br>
		
		<span class="label">Celular</span><br>
		<input class="input" id="ucellphone2" type="text" maxlength="45" value="<?php echo $user_cellphone2; ?>"><br>
		
		<span class="label">Email de contacto</span><br>
		<input class="input" id="ucontactemail" type="text" maxlength="60" value="<?php echo $user_contactemail; ?>"><br>
		
		<span class="label">Página web</span><br>
		<input class="input" id="uwebsite" type="text" maxlength="50" value="<?php echo $user_website; ?>"><br>

		<button class="update" onclick="updateprofile();">Actualizar datos</button>
	</div>
</div>