<!DOCTYPE html>
<html lang="en">
<body>

    <div id="wrapper">
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ofertas</h1>
                    <div class="panel-heading">
                            Haga click en una ofeta para ver su Proveedor.
                        </div>
                    
                    <?php
						$owner = $_SESSION['id'];
						$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
						if (!$dbconnection)
						{
				    		echo "Error conectando a la base de datos";
				    		die();
						}
						$timenow = time();
						$sentence = "SELECT * FROM offers WHERE offer_time > '$timenow'";
						$result = mysqli_query($dbconnection, $sentence);
						$rows = mysqli_num_rows($result);
						if($rows > 0)
						{
							while($row = mysqli_fetch_assoc($result))
							{
								$name = $row['offer_name'];
								$dimension = $row['offer_dimension'];
								$brand = $row['offer_brand'];
								$ownername = strtoupper($row['offer_ownername']);
								$ownerid = $row['offer_owner'];
								$minimun = $row['offer_minimun'];
								$time = $row['offer_time'];
								$expiration = date("d/m/Y H:i \h\s", strtotime($time));
								$price = number_format($row['offer_price'], 2, ',', '.');
								$date = date("d/m/Y H:i \h\s", strtotime($row['offer_date']));
				
								echo "
				
                    				<tr>
                                    <td>
                                    <a href=home.php?pagina=perfil&id=$ownerid><div class=\"col-lg-12\">
                                            <div class=\"panel panel-info\">
                                                <div class=\"panel-heading\">
                                                    $name
                                                </div>
                                                <div class=\"panel-body\">
                                                    <p>Marca: $brand  -   Dimension: $dimension -  Fecha Vencimiento: $expiration - Compra Minima: $minimun</br>
                                                </div>
                                                <div class=\"panel-footer\">
                                                    <strong>$$price</strong>
                                                </div>
                                            </div>
                                        </div></a>
                                        
                                    </td>
                                    <tr>";
							}
						}
						else
						{
							echo "<div class='error'>Actualmente no hay ofertas</div>";
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
			url:   'actions/deleterequest.php',
			type:  'post',
			success:  function (response) {
				console.log(response);
				location.reload();
			}
		});
     
}
</script>

