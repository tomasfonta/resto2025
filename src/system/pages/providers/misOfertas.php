<!DOCTYPE html>
<html lang="en">
<body>

    <div id="wrapper">
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Mis Ofertas</h1>
                    
                    <?php
                		$owner = $_SESSION['id'];
                		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
                		if (!$dbconnection)
                		{
                    		echo "Error conectando a la base de datos";
                    		die();
                		}
                		$sentence = "SELECT * FROM offers WHERE offer_owner = '$owner'";
                		$result = mysqli_query($dbconnection, $sentence);
                		$rows = mysqli_num_rows($result);
                		if($rows > 0)
                		{
                			while($row = mysqli_fetch_assoc($result))
                			{
                				$name = $row['offer_name'];
                				$dimension = $row['offer_dimension'];
                				$brand = $row['offer_brand'];
                				$id = $row['offer_id'];
                				$minimun = $row['offer_minimun'];
                				$time = $row['offer_time'];
                				$expiration = date("d/m/Y H:i \h\s", $time);
                				$price = number_format($row['offer_price'], 2, ',', '.');
                				$date = date("d/m/Y H:i \h\s", strtotime($row['offer_date']));
            
                
                				echo "
                    				<tr>
                                    <td>
                                        <div class=\"col-lg-12\">
                                            <div class=\"panel panel-primary\">
                                                <div class=\"panel-heading\">
                                                    $name
                                                </div>
                                                <div class=\"panel-body\">
                                                    <p>Marca: $brand  -   Dimension: $dimension  </br>
                                                        Compra Minima: $minimun -  Fecha de Expiracion: $expiration</p>
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
                			echo "<div class='error'>Aún no creaste ofertas, si no sabes como hacerlo, visita la sección ayuda</div>";
                		}
                		mysqli_free_result($result);
                		mysqli_close($dbconnection);
                	?>
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
			url:   'actions/deleteOferta.php',
			type:  'post',
			success:  function (response) {
				console.log(response);
				location.reload();
			}
		});
     
}
</script>

