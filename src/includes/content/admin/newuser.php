<div class="add">
    <button class="button" onclick="switchforms('product');">NUEVO USUARIO</button>
    <div class="form" id="product">
        <form id="form1" action="../actions/newuser.php" method="POST">
            <div class="fields">
                Nombre de usuario<br>
                <input type="text" class="input" name="name" maxlength="20" required><br>
            </div>
            <div class="fields">
                Nombre de cliente<br>
                <input type="text" class="input" name="userName" maxlength="100" required>
            </div>
            <div class="fields">
                Contraseña<br>
                <input type="text" class="input" name="password" maxlength="20" required>
            </div>
            <div class="fields">
                Tipo de usuario<br>
                <select class="input" name="type" id="tipoUser">
                    <option value="1">Cliente</option>
                    <option value="0">Proveedor</option>
                </select> 
            </div>
            <div class="fields" id="category" style="display:none;">
                Categorias<br>
        
        <?php
        // Busco las categorias y las listo en checkbox

            $dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
            if (!$dbconnection)
            {
                echo "Error conectando a la base de datos";
                die();
            }
            $sentence = "SELECT * FROM category";
            $result = mysqli_query($dbconnection, $sentence);
            $rows = mysqli_num_rows($result);
            if($rows > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                
                    $id = $row['category_id'];
                    $category_name = $row['category_name'];
    
                    echo "<input type=\"checkbox\" name=\"categoria[]\" value=\"$id\">$category_name<br>";  // corrected name=\"categoria\" to name=\"categoria[]\"
    
                }
            }
            mysqli_free_result($result);
            mysqli_close($dbconnection);
        ?>
            </div>
            <input class="submit" type="submit" value="Agregar">
        </form>
    </div>
</div>

<script type="text/javascript" >

jQuery(document).ready(function () {
	
		$("#category").hide()
});

jQuery(document).change(function () {
	
	if ($("#tipoUser option:selected" ).text() == "Proveedor" ){
		$("#category").show()
	}else{
		$("#category").hide()
	}
	
});

</script>
