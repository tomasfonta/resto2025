<!DOCTYPE html>
<html lang="en">

<body>

    <div id="wrapper">

        <div id="page-wrapper">
    
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header hidden-xs hidden-sm">Proveedores</h1> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-lg-12">
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
                                    		$sentence = "SELECT * FROM users WHERE user_type = 0";
                                    		$result = mysqli_query($dbconnection, $sentence);
                                    		$rows = mysqli_num_rows($result);
                                    		if($rows > 0)
                                    		{
                                    			while($row = mysqli_fetch_assoc($result))
                                    			{
                                    				$nameok = strtoupper($row['user_name']);
                                    				$description = $row['user_description'];
                                    				$idok = $row['user_id'];
                                    
                                    				echo "
                                                        <tr>
                                                        <td>
                                                        <a href=\"home.php?pagina=perfil&id=$idok\">
                                                            <div class=\"col-lg-12\">
                                                                <div class=\"panel panel-primary\">
                                                                    <div class=\"panel-heading\">
                                                                        Nombre: $nameok
                                                                    </div>
                                                                    <div class=\"panel-body\">
                                                                        <p>Descripcion: $description</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        </td>
                                                        <tr>";
                                    			}
                                    		}
                                    		else
                                    		{
                                    			echo "<div class='error'>Actualmente no hay proveedores</div>";
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


