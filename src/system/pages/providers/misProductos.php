<!DOCTYPE html>
<html lang="en">

<body>

    <div id="wrapper">

        <div id="page-wrapper">
    
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header hidden-xs hidden-sm">Mis Productos</h1> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- Para pc -->
                <div class="col-lg-12 hidden-xs hidden-sm">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Marca</th>
                                        <th>Dimension</th>
                                        <th>Ultima Edicion</th>
                                        <th>Precio</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
                                		if (!$dbconnection)
                                		{
                                    		echo "Error conectando a la base de datos";
                                    		die();
                                		}
                                		$sentence = "SELECT * FROM products JOIN category ON category.category_id = products.product_category where products.product_owner=".$_SESSION['id'];
                                		$result = mysqli_query($dbconnection, $sentence);
                                		$rows = mysqli_num_rows($result);
                                		if($rows > 0)
                                		{
                                			while($row = mysqli_fetch_assoc($result))
                                			{
                                				$name = $row['product_name'];
                                				$dimension = $row['product_dimension'];
                                				$brand = $row['product_brand'];
                                				$ownername = strtoupper($row['product_ownername']);
                                				$ownerid = $row['product_owner'];
                                				$price = $row['product_price'];
                                				$priceok = number_format($price, 2, ',', '.');
                                				$date = date("d/m/Y H:i \h\s", strtotime($row['product_date']));
                                				$category = $row['category_name'];
                                				
                                				if($priceok==0){
                        				            $priceok = "Consultar";
                        				        }else{
                        				            $priceok = "$".$priceok;
                        				        }
                                                
                                                
                                                echo "<tr>";
                                                echo "    <td>$name</td>";
                                                echo "    <td>$brand</td>";
                                                echo "    <td>$dimension</td>";
                                                echo "    <td>$date</td>";
                                                echo "    <td>$priceok</td>";
                                                echo "</tr>";
                                				
                                			}
                                		}
                                		else
                                		{
                                			echo "<div class='error'>Aún no hay productos cargados</div>";
                                		}
                                		mysqli_free_result($result);
                                		mysqli_close($dbconnection);
                                	?>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                <!-- Para Mobile -->
                <div class="col-xs-12 hidden-lg hidden-md">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="input-field" id="input-container-3">
                                <label class="control-label" for="navbar-search">Buscar:</label>
                                <input id="navbar-search" class="form-control" type="text">
                            </div>
                            <table class="table" id="mobile">
                                    <thead>
                                        <tr>
                                            <th>Productos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                		$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
                                		if (!$dbconnection)
                                		{
                                    		echo "Error conectando a la base de datos";
                                    		die();
                                		}
                                		$sentence = "SELECT * FROM products JOIN category ON category.category_id = products.product_category where products.product_owner=".$_SESSION['id'];
                                		$result = mysqli_query($dbconnection, $sentence);
                                		$rows = mysqli_num_rows($result);
                                		if($rows > 0)
                                		{
                                			while($row = mysqli_fetch_assoc($result))
                                			{
                                				$name = $row['product_name'];
                                				$dimension = $row['product_dimension'];
                                				$brand = $row['product_brand'];
                                				$ownername = strtoupper($row['product_ownername']);
                                				$ownerid = $row['product_owner'];
                                				$price = $row['product_price'];
                                				$priceok = number_format($price, 2, ',', '.');
                                				$date = date("d/m/Y H:i \h\s", strtotime($row['product_date']));
                                				$category = $row['category_name'];
                                				
                                				if($priceok==0){
                        				            $priceok = "Consultar";
                        				        }else{
                        				            $priceok = "$".$priceok;
                        				        }
                                                
                                                
                                                echo "
                                                <tr>
                                                <td>
                                                    <div class=\"col-lg-12\">
                                                        <div class=\"panel panel-primary\">
                                                            <div class=\"panel-heading\">
                                                                $name
                                                            </div>
                                                            <div class=\"panel-body\">
                                                                <p>Marca: $brand  -   Dimension: $dimension  -   Ultima Edicion: $date</br></p>
                                                            </div>
                                                            <div class=\"panel-footer\">
                                                              <strong>$priceok</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <tr>";
                                				
                                			}
                                		}
                                		else
                                		{
                                			echo "<div class='error'>Aún no hay productos cargados</div>";
                                		}
                                		mysqli_free_result($result);
                                		mysqli_close($dbconnection);
                                	?>
                                        
                                        </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    </div>
    <!-- /#wrapper -->
    
    <?php include 'layout/footer.php'; ?>
    

</body>

</html>


<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    //Redirijo a la pagina de un proveedor.
    function proveedor(id){
        url = 'perfil.php?id='+id;
        window.location.replace(url)
    }
    
</script>
<script>
$(document).ready(function() {
$('#mobile').searchIt({
        itemSelector: 'tr',
        $searchInput: $('#input-container-3').find('input'),
    });
});
</script>


