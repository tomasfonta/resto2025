<!DOCTYPE html>
<html lang="en">
<body>

    <div id="wrapper">
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Solicitudes</h1>
                    <div class="panel-heading">
                            Haga click en una solicitud para ver los datos del Cliente.
                        </div>
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
                				$idok = $row['request_owner'];
                				$category_name = $row['category_name'];
                
                				
                				echo "
                				
                				<tr>
                                <a href=\"home.php?pagina=perfil&id=$idok\">
                                <td>
                                    <div class=\"col-lg-12\">
                                        <div class=\"panel panel-primary\">
                                            <div class=\"panel-heading\">
                                                $name
                                            </div>
                                            <div class=\"panel-body\">
                                                <p>Marca: $brand  -   Dimension: $dimension -  Categoria: $category_name</br>
                                            </div>
                                            
                                              
                                            
                                        </div>
                                    </div>
                                </td>
                                </a>
                                <tr>";
                			}
                		}
                		else
                		{
                			echo "<div class='error'>No hay solicitudes pendientes</div>";
                		}
                		mysqli_free_result($result);
                		mysqli_close($dbconnection);
                	?>
                </div>
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'layout/footer.php'; ?>

</body>

</html>


