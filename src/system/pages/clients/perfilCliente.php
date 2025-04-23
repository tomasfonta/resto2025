<?php

$userid = $_SESSION['id'];
$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
if (!$dbconnection)
{
	echo "Error conectando a la base de datos";
	die();
}
$sentence = "SELECT * FROM users WHERE user_id = '$userid'";
$result = mysqli_query($dbconnection, $sentence);
$rows = mysqli_num_rows($result);
if($rows > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$user_email = $row['user_contactemail'];
		$user_loginname = $row['user_loginname'];
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
	echo "Parece que algo inesperado sucedio :(";
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
                <div class="col-lg-12">
                    <h1 class="page-header">Perfil</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Nombre de Usuario:<?php echo $user_loginname ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="informacion">
                                        <div class="form-group">
                                            <label>Nombre de Contacto:</label>
                                            <input id="nombre" class="form-control" value="<?php echo $user_name ?>">
                                            <label>Descripcion:</label>
                                            <textarea id="descripcion" class="form-control" rows="3"><?php echo $user_description ?></textarea>
                                            <label>Direccion:</label>
                                            <input id="direccion" class="form-control" value="<?php echo $user_location ?>">
                                            <label>Telefono1:</label>
                                            <input id="tel1" class="form-control" value="<?php echo $user_telephone1 ?>">
                                             <label>Telefono2:</label>
                                            <input id="tel2" class="form-control" value="<?php echo $user_telephone2 ?>">
                                            <label>Celular1:</label>
                                            <input id="cel1" class="form-control" value="<?php echo $user_cellphone1 ?>">
                                            <label>Celular2:</label>
                                            <input id="cel2" class="form-control" value="<?php echo $user_cellphone2 ?>">
                                            <label>Email de contacto:</label>
                                            <input id="email"class="form-control" value="<?php echo $user_contactemail ?>">
                                            <label>Pagina Web:</label>
                                            <input id="web" class="form-control" value="<?php echo $user_website ?>">
                                            </br>
                                            <button type="submit" id="actualizar" class="btn btn-outline btn-primary btn-lg btn-block">Actualizar Perfil</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                		<div class="col-md-12" id="resultado"></div>
                                	</div>
                                </div>
                                <div class="col-lg-6">
                                <div id="passChange">
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Button trigger modal -->
                                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                        Cambio de Contraseña
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Cambio de Contraseña</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="passwordOldGroup" class="form-group has-error">
                                                        <label class="control-label">Contraseña actual</label>
                                                        <input id="passwordOld" class="form-control" placeholder="Contraseña actual" value="">
                                                    </div>
                                                    <div id="passwordGroup" class="form-group has-error">
                                                        <label>Contraseña Nueva:</label>
                                                        <input class="form-control" placeholder="Contraseña Nueva" id="password" name="password" type="password" value="">
                                                    </div>
                                                    <div id="password_confirmGroup" class="form-group has-error">
                                                        <label>Repita Contraseña Nueva:</label>
                                                        <input id="password_confirm" class="form-control" placeholder="Repetir Contraseña Nueva" name="password_confirm" type="password" value="">
                                                    </div>
                                                
                                                    </br>
                                                    <div class="row" >
                                                		<div class="alert alert-info" id="resultadoPass">
                                                		    La contraseña debe tener mas de 5 caractere no toma espacios en blancos.</br> Puede contener minusculas y numeros.
                                                		</div>
                                                	</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button id="actualizarPass" type="button" class="btn btn-primary" disabled>Guardar Cambios</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </div>
                                <!-- .panel-body -->
                                </div>
                                <div class="row">
                            		<div class="col-md-12" id="resultado"></div>
                            	</div>
                            </div>
                                   
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

<script type="text/javascript">
	$("#actualizar").click(function(event){
		var updateUser = {
			"nombre" : $('#nombre').val(),
			"descripcion" : $('#descripcion').val(),
			"direccion" : $('#direccion').val(),
			"tel1" : $('#tel1').val(),
			"tel2" : $('#tel2').val(),
			"cel1" : $('#cel1').val(),
			"cel2" : $('#cel2').val(),
			"email" : $('#email').val(),
			"web" : $('#web').val()
		};
		$.ajax({
			data:  { "updateUser" : updateUser }, 
			url:   'actions/updateprofile.php',
			type:  'post',
			beforeSend: function () {
				$("#resultado").html("Procesando, espere por favor...");
			},
			success:  function (response) {
				location.reload();
			},
			error: function(response){
			    console.log(response);
            },
			
		});
	});
	
	$("#actualizarPass").click(function(event){

		var actual = $('#passwordOld').val();
	    var nueva = $('#password').val();
	
		$.ajax({
			data:  { "actual" : actual ,"nueva" : nueva  }, 
			url:   'actions/updatePass.php',
			type:  'post',
			beforeSend: function () {
				$("#resultadoPass").html("Procesando, espere por favor...");
			},
			success:  function (response) {
				$("#resultadoPass").html(response);
			},
			error: function(response){
			    $("#resultadoPass").html(response);
            },
			
		});
	});
	
    // Name can't be blank
    var pasOld = false;
    var passs = false;
    var pasRep =false;
    
    $('#passwordOld').on('input', function() {
    	var input=$('#passwordOld');
    	var is_name=input.val();
    	if(is_name.length > 0){
    	    $('#passwordOldGroup').removeClass("has-error").addClass("has-success");
    	    pasOld = true;
    	}
    	else{
    	    $('#passwordOldGroup').removeClass("has-success").addClass("has-error");
    	    pasOld = false;
    	}
    });
    
    $('#password').on('input', function() {
    	var input=$('#password');
    	var pas=input.val();
    	if(pas.length > 5){
    	    $('#passwordGroup').removeClass("has-error").addClass("has-success");
    	    passs = true;
    	}
    	else{
    	    $('#passwordGroup').removeClass("has-success").addClass("has-error");
    	    passs = false;
    	}
    });
    
    $('#password_confirm').on('input', function() {
    	var input=$('#password_confirm');
    	var passConf=input.val();
    	if(passConf.length > 5 && passConf===$('#password').val()) {
    	    $('#password_confirmGroup').removeClass("has-error").addClass("has-success");
    	    pasRep = true;
    	}
    	else{
    	    $('#password_confirmGroup').removeClass("has-success").addClass("has-error");
    	    pasRep = false;
    	}
    });
    
    $("#passChange").on('input', function(){
        console.log("123");
        if(pasOld && passs && pasRep){
        $('#actualizarPass').attr("disabled", false);
    }else{
         $('#actualizarPass').attr("disabled", true);
    }
    });
</script>
