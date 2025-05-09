<!DOCTYPE html>
<html lang="en">

<body>

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">RestoCompras</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Ayuda
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#proveedores" data-toggle="tab">Proveedores</a>
                                </li>
                                <li><a href="#buscar" data-toggle="tab">Mis Productos</a>
                                </li>
                                <li><a href="#misOfertas" data-toggle="tab">Mis Ofertas</a>
                                </li>
                                <li><a href="#solicitar" data-toggle="tab">Solicitides Recibidas</a>
                                </li>
                                <li><a href="#perfil" data-toggle="tab">Perfil</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="proveedores">
                                    <p>
                                        <div id="help1" class="textbox" style="display: block;">
                                    		Al seleccionar la opción “<strong>Agregar</strong>” en la barra de opciones, usted podrá elegir entre dos posibilidades:<br><br>
                                    		
                                    		<strong>NUEVO PRODUCTO:</strong><br><br>
                                    
                                    		Si desea ingresar un nuevo producto a su lista de precios presionara sobre “Nuevo producto” y se abrirá una lista que usted deberá llenar para que el producto aparezca dentro de su lista de precios. En esta lista encontrara:<br><br>
                                    
                                    		● Nombre del producto<br>
                                    		● Marca<br>
                                    		● Dimensión (Ejemplo: 5, 6, 7). Al presionar en “Gramos” se deslizaran las opciones de dimensión.<br>
                                    		● Precio (500, 600, 50, 70)<br><br>
                                    
                                    		Junto con su producto se ingresara una <strong>fecha en la cual agrego el producto</strong> automáticamente.<br><br> 
                                    
                                    		<strong>INGRESE NUEVA OFERTA:</strong><br><br>
                                    
                                    		Al presionar sobre “Nueva oferta” se desliza una lista, la cual deberá llenar para mostrar su oferta a los clientes. La misma contendrá:<br><br>
                                    
                                    		● Nombre del producto<br>
                                    		● Marca<br>
                                    		● Dimensión (Ejemplo: 5, 6, 7). Al presionar en “Gramos” se deslizaran las opciones de dimensión.<br>
                                    		● Precio (Ejemplo: 500, 600, 50, 70)<br>
                                    		● Duración de oferta en horas (Ejemplo: 12, 24, 48, 72)<br>
                                    		● Compra mínima por unidades<br>
                                    	</div>
                                        
                                    </p>
                                    </div>
                                    <div class="tab-pane fade" id="buscar">
                                        
                                        
                                	<p></br>	Cuando ingrese a la opción “<strong>Mis productos</strong>”, usted podrá visualizar todos los productos que dispone en su lista de precios.<br><br>
                                
                                		Si al visualizar todos sus productos desea eliminar alguno de ellos, bastará con presionar sobre “<strong>Eliminar</strong>” para que no se muestre más dentro de los mismos.<br><br> 
                                
                                		Si usted desea visualizar un producto en particular podrá buscarlo en la barra superior escribiendo, nombre o marca del mismo y aparecerán los que tiene disponibles en su lista.
                            	            </p>
                                        
                                    </div>  
                                    <div class="tab-pane fade" id="misOfertas">

                                       <p></br>Al ingresar a la opción “<strong>Mis ofertas</strong>” encontrara todas las ofertas que ha cargado hasta el momento. En las mismas se encontraran ofertas vencidas y ofertas activas.En el caso de tener una oferta vencida que se desea recargar podrá seleccionar en “<strong>Eliminar/Editar</strong>”, se abrirá una lista en la cual pondrá el precio que desea y la duración en horas desde el momento de la carga. Al terminar la edición seleccionara “<strong>Editar</strong>” y se recargara la oferta.<br><br>

                                		En caso de querer eliminar una oferta, seleccionara en “<strong>Eliminar/Editar</strong>”, se abrirá la lista y presionara directamente sobre “<strong>Eliminar</strong>”.<br><br>
                                
                                		Suponiendo que usted tiene un listado de ofertas extenso y quiere ver únicamente una oferta, tiene una barra en la parte superior en la cual ingresara nombre del producto, marca o dimensión, presionara “<strong>Buscar</strong>” y –RestoCompras le mostrara la oferta actual o vencida que tiene esas características. </p>
                                    </div>
                                <div class="tab-pane fade" id="solicitar">
                                    
                                    <p></br>Dentro de la sección “<strong>Solicitudes</strong>” se encontraran <strong>todas las solicitudes de productos por cantidad creadas por clientes</strong> dentro del servicio de –RestoCompras, por lo cual tendrá la posibilidad de ver y en caso de poder ofertar a una de ellas bastará con presionar sobre el nombre del cliente para ser direccionado al perfil del cliente y comunicarse con él.</p>
                                </div>
                                <div class="tab-pane fade" id="perfil">
                                    <p></br>Al ingresar al servicio –RestoCompras usted ha firmado una solicitud con sus datos personales los cuales fueron escritos en su perfil, para ingresar a él deberá dirigirse a la barra de opciones y presionar sobre “<strong>Perfil</strong>”.<br><br>

                            		Los datos que estén dentro de <strong>su perfil se utilizan para ser mostrados a los proveedores</strong>, por lo tanto es imprescindible que usted mantenga actualizada esta sección para mejorar la comunicación con los proveedores.<br><br>
                            
                            		En su perfil encontrara:<br><br>
                            		
                            		● Nombre de contacto, descripción, dirección física, dos teléfonos fijos, dos teléfonos celulares, email de contacto (opcional), página web (opcional).</p>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'layout/footer.php'; ?>

</body>

</html>
