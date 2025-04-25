<?php
                                		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
                                		if (!$dbconnection)
                                		{
                                    		echo "Error conectando a la base de datos";
                                    		die();
                                		}
                                		$sentence = "SELECT count(product_id) FROM products where product_owner=".$_SESSION['id'];
                                		$result = mysqli_query($dbconnection, $sentence);
                                		$rows = mysqli_num_rows($result);
                                		if($rows > 0)
                                		{
                                			while($row = mysqli_fetch_assoc($result))
                                			{
                                				$numero = $row['count(product_id)'];
                                				
                                			}
                                		}
                                		mysqli_free_result($result);
                                		mysqli_close($dbconnection);
                                		
                                		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
                                		if (!$dbconnection)
                                		{
                                    		echo "Error conectando a la base de datos";
                                    		die();
                                		}
                                		$sentence = "SELECT count(offer_id) FROM offers where offer_owner=".$_SESSION['id'];
                                		$result = mysqli_query($dbconnection, $sentence);
                                		$rows = mysqli_num_rows($result);
                                		if($rows > 0)
                                		{
                                			while($row = mysqli_fetch_assoc($result))
                                			{
                                				$numeroOfertas = $row['count(offer_id)'];
                                				
                                			}
                                		}
                                		mysqli_free_result($result);
                                		mysqli_close($dbconnection);
                                	?>
                                                    
<!DOCTYPE html>
<html lang="en">
<body>

    <div id="wrapper">
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-lg-12 col-md-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tags fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $numeroOfertas;?></div>
                                    <div>Ofertas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <h1 class="page-header">Agregar Oferta</h1>
                    
                    <div>
            			<div class="form-group">
            				<label>Nombre del producto</label>
            				<input id="oname" type="text" class="form-control" name="name" placeholder="Leche Entera" requeried>
            			
            				<label>Marca</label>
            				<input id="obrand" type="text" class="form-control" name="brand" placeholder="Sancor"requeried>
            			
            				<label>Dimensión</label>
            				<input id="odimension" type="text" class="form-control" name="dimension" placeholder="1">
            				<select class="form-control" id="ounit">
            					<option value="1">Gramos</option>
            					<option value="2">Kilogramos</option>
            					<option value="3">Litros</option>
            					<option value="4">Mililitros</option>
            					<option value="5">Unidades</option>
            				</select> 
            				<br>
            			
            				<label>Precio</label>
            				<input id="oprice" type="text" class="form-control" name="price" placeholder="30">
            			
            				<label>Categoria</label>
            				<select id="ocategory" class="form-control" name="category">
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
            				<label>Duracion en Horas</label>
            				<input id="otime" type="text" class="form-control"  placeholder="24">
            				<label>Compra mínima en Unidades</label>
            				<input id="omin" type="text" class="form-control"  placeholder="40">
            				
            			</div>
            		</div>
            		<button id="nuevaOferta" class="btn btn-outline btn-primary btn-lg btn-block">Añadir Oferta</button>
            		<div id="responseOferta"></div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $numero;?></div>
                                    <div>Productos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <h1 class="page-header">Agregar Producto</h1>
                    
                    <div>
            			<div class="form-group">
            				<label>Nombre del producto</label>
            				<input id="pname" type="text" class="form-control" name="name"  requeried>
            			
            				<label>Marca</label>
            				<input id="pbrand" type="text" class="form-control" name="brand" requeried>
            			
            				<label>Dimensión</label>
            				<input id="pdimension" type="text" class="form-control" name="dimension" maxlength="6">
            				<select class="form-control" id="punit">
            					<option value="1">Gramos</option>
            					<option value="2">Kilogramos</option>
            					<option value="3">Litros</option>
            					<option value="4">Mililitros</option>
            					<option value="5">Unidades</option>
            				</select> 
            				<br>
            			
            				<label>Precio</label>
            				<input id="pprice" type="text" class="form-control" name="price" maxlength="10">
            			
            				<label>Categoria</label>
            				<select id="pcategory" class="form-control" name="category">
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
            				
            			</div>
            		</div>
            		<button id="nuevoProducto" class="btn btn-outline btn-primary btn-lg btn-block">Añadir Producto</button>
            		<div id="response"></div>
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
<script>
      	$('#nuevoProducto').click(function() {
        
        var producto = {
			"pname" : $('#pname').val(),
			"pbrand" : $('#pbrand').val(),
			"pdimension" : $('#pdimension').val(),
			"punit" : $('#punit').val(),
			"pprice" : $('#pprice').val(),
			"pcategory" : $('#pcategory').val()
		};
		
        $.ajax({
			data:  { "producto": producto
			}, 
			url:   'actions/nuevoProducto.php',
			type:  'post',
			success:  function (response) {
				console.log(response);
				$('#response').html(response);
			    setTimeout(function(){location.reload(); }, 10000000);
			}
		});
  	});
  	
  	
  	$('#nuevaOferta').click(function() {
        
        var oferta = {
			"oname" : $('#oname').val(),
			"obrand" : $('#obrand').val(),
			"odimension" : $('#odimension').val(),
			"ounit" : $('#ounit').val(),
			"oprice" : $('#oprice').val(),
			"ocategory" : $('#ocategory').val(),
			"otime" : $('#otime').val(),
			"omin" : $('#omin').val()
		};
		
        $.ajax({
			data:  { "oferta": oferta
			}, 
			url:   'actions/nuevaOferta.php',
			type:  'post',
			success:  function (response) {
			    console.log(response);
				$('#responseOferta').html(response);
			    setTimeout(function(){location.reload(); }, 1000);
			}
		});
  	});
  </script>
