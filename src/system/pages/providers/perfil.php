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
