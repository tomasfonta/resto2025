<?php
if(!empty($_GET['id']))
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
	$userid =  mysqli_real_escape_string($dbconnection, $_GET['id']);
	$sentence = "SELECT * FROM users WHERE user_id = '$userid'";
	$result = mysqli_query($dbconnection, $sentence);
	$rows = mysqli_num_rows($result);
	if($rows > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$user_id = $row['user_id'];
			$user_type = $row['user_type'];
			$user_loginname = strtoupper($row['user_loginname']);
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
		header('Location: home.php');
		die();
	}
}
else
{
	header('Location: home.php');
	die();
}

date_default_timezone_set("America/Argentina/Buenos_Aires");

?>
<!DOCTYPE html>
<html lang="en">

<body>

    <div id="wrapper">

        <div id="page-wrapper">
            
            <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo "$user_name";?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" class="text-center">
                                        <div class="form-group">
                                            <label>Direccion:</label>
                                            <p class="form-control-static"><?php echo $user_location;?></p>
                                            <label>Telefono:</label>
                                            <p class="form-control-static"><?php echo $user_telephone1;?></p>
                                            <p class="form-control-static"><?php echo $user_telephone2;?></p>
                                            <label>Celular:</label>
                                            <p class="form-control-static"><?php echo $user_cellphone1;?></p>
                                            <p class="form-control-static"><?php echo $user_cellphone2;?></p>
                                            <label>Email de contacto:</label>
                                            <p class="form-control-static"><?php echo $user_contactemail;?></p>
                                            <label>Pagina Web:</label>
                                            <p class="form-control-static"><?php echo $user_website;?></p>
                                        </div>
                                    </form>
                                    <div> 
                                        <h1>Ofertas</h1>
                                        <div class="row">
                                            
                                            <?php
                        						$owner = $_SESSION['id'];
                        						$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
                        						if (!$dbconnection)
                        						{
                        				    		echo "Error conectando a la base de datos";
                        				    		die();
                        						}
                        						$timenow = time();
                        						$sentence = "SELECT * FROM offers WHERE offer_time > $timenow and offer_owner=$userid";
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
                        								$expiration = date("d/m/Y H:i \h\s", $time);
                        								$price = number_format($row['offer_price'], 2, ',', '.');
                        								$date = date("d/m/Y H:i \h\s", strtotime($row['offer_date']));
                        								
                        								if($price==0){
                                				        $price = "Consultar";
                                				        }else{
                                				            $price = "$".$price;
                                				        }
                        				
                        								echo "
                        				
                                            				<tr>
                                                            <td>
                                                            <div class=\"col-lg-12\">
                                                                    <div class=\"panel panel-info\">
                                                                        <div class=\"panel-heading\">
                                                                            $name
                                                                        </div>
                                                                        <div class=\"panel-body\">
                                                                            <p>Marca: $brand  -   Dimension: $dimension -  Fecha Vencimiento: $expiration - Compra Minima: $minimun</br>
                                                                        </div>
                                                                        <div class=\"panel-footer\">
                                                                            <strong>$price</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </td>
                                                            <tr>";
                        							}
                        						}
                        						else
                        						{
                        							echo "<div class=\"col-lg-12\">
                                                                    <div class=\"panel panel-info\">
                                                                        <div class=\"panel-heading\">
                                                                            Actualmente el proveedor no tiene ofertas activas
                                                                        </div>
                                                                    </div>
                                                                </div>";
                        						}
                        						mysqli_free_result($result);
                        						mysqli_close($dbconnection);
                        					?>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                <!-- Para Mobile -->
                                
                                    <div class="panel panel-default">
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="input-field" id="input-container-3">
                                                <label class="control-label" for="navbar-search">Buscar:</label>
                                                <input id="navbar-search" class="form-control" type="text">
                                            </div>
                                            <table class="table" id="productos">
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
                                                		$sentence = "SELECT * FROM products JOIN category ON category.category_id = products.product_category where product_owner=".$userid;
                                                		try{
                                                		    
                                                		    $result = mysqli_query($dbconnection, $sentence);
                                                		    $rows = mysqli_num_rows($result);
                                                		    
                                                		}catch(Exception $e){
                                                		    echo ("error");
                                                		    die();
                                                		    
                                                		}
                                                		
                                                		
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
                                
                                <!-- /.col-lg-12 -->
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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
$(document).ready(function() {
$('#productos').searchIt({
        itemSelector: 'tr',
        $searchInput: $('#input-container-3').find('input'),
    });
});
</script>
