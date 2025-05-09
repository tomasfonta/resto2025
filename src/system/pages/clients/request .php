<!DOCTYPE html>
<html lang="en">
<body>

    <div id="wrapper">
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Mis Solicitudes</h1>
                    
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
				

				
				echo "
				
				<tr>
                <td>
                    <div class=\"col-lg-12\">
                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                $name
                            </div>
                            <div class=\"panel-body\">
                                <p>Marca: $brand  -   Dimension: $dimension 
                            </div>
                            <div class=\"panel-footer text-center\" onClick=\"eliminar($id)\" name=\"$id\">
                              Eliminar
                            </div>
                        </div>
                    </div>
                </td>
                <tr>";
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
                <div class="col-lg-6">
                    <h1 class="page-header">Solicitar Producto</h1>
                    
                    <form id="form3" action="actions/newrequest.php" method="POST">
        			
        			<div class="form-group">
                        <label>Nombre del Producto</label>
                        <input id="name" name="name" class="form-control" required>
                        <p class="help-block">Ejemplo: Crema de leche</p>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <input id="brand" name="brand" class="form-control" required>
                        <p class="help-block">Ejemplo: La Serenisima</p>
                    </div>
        			<div class="form-group">
        				<label>Dimension</label>
        				<input id="dimension" name="dimension" class="form-control" required>
        				<select id="unit" name="unit" class="form-control">
        					<option value="1">Gramos</option>
        					<option value="2">Kilogramos</option>
        					<option value="3">Litros</option>
        					<option value="4">Mililitros</option>
        				</select>
        			</div>
        			<div class="form-group">
                        <label>Categoria</label>
                        <select id="category" name="category" class="form-control" required>
                            <?php
            						// Busco todas las categorias
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
            								$name = $row['category_name'];
            								
            								echo "<option value=$id>$name</option>";
            							}
            						}
            				?>
                        </select>
                        <p class="help-block">Este pedido le llegara a todos los proveedores de la categoria que seleccione.</p>
                    </div>
                    <button id="submit1" class="btn btn-outline btn-primary btn-lg btn-block" onclick="submitform('form3');">Solicitar</button>
                    
        		    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'layout/footer.php'; ?>

</body>

</html>
<script>
function eliminar(id) {
    var id = id;
    $.ajax({
			data:  {id}, 
			url:   'actions/deleterequest.php',
			type:  'post',
			success:  function (response) {
				console.log(response);
				location.reload();
			}
		});
     
}
</script>

