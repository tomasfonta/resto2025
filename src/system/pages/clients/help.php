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
                                <li><a href="#buscar" data-toggle="tab">Buscar Productos</a>
                                </li>
                                <li><a href="#oferta" data-toggle="tab">Productos en Oferta</a>
                                </li>
                                <li><a href="#solicitar" data-toggle="tab">Solicitar Productos</a>
                                </li>
                                <li><a href="#perfil" data-toggle="tab">Perfil</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="proveedores">
                                    <p></br>En la opción “proveedores”  encontrara toda la lista de proveedores que actualmente están dentro del sistema de –RestoCompras.<br><br>
                                		<strong>PROVEEDOR SELECCIONADO:</strong><br><br>
                                		Al seleccionar el proveedor deseado se direccionará al perfil del mismo, observando los siguientes datos:<br><br>
                                		-Logo: con nombre del proveedor<br>
                                		-Contactos: Números de teléfono fijo, números de teléfonos celulares, email de contacto, pagina web<br><br>
                                
                                		Debajo del perfil, se encontrara información relacionada con las ofertas y productos actuales del proveedor, cada oferta tendrá:<br><br>
                                		● Nombre del producto, marca, dimensión del producto (5kg, 1 Litro, etc), precio, vencimiento de la oferta, compra mínima en unidades, última edición de la oferta.<br><br>
                                		
                                		Debajo de las ofertas actuales del proveedor se encontraran:<br><br>
                                		● Nombre del producto, marca, dimensión del producto (5kg, 1 Litro, etc), precio, última edición del producto.<br></p>
                                </div>
                                <div class="tab-pane fade" id="buscar">
                                    <p></br>Al ingresar a la opción “<strong>buscar producto</strong>” el cliente podrá ver un listado con todos los productos disponibles en la página, debajo de ellos se encontrara el nombre del proveedor que al presionar sobre el nombre se direccionará al perfil del proveedor.<br><br>
		                            Para realizar una búsqueda más cómoda y rápida se encuentra una barra en la parte superior en la cual podrá ingresar un nombre, marca o dimensión del producto y -RestoCompras se encargara de mostrarle <strong>todos los proveedores que tengan el producto que usted busca</strong> con sus precios respectivos. Al encontrar el producto deseado podrá presionar sobre el nombre del proveedor para poder obtener su información de contacto. </p>
                                </div>
                                <div class="tab-pane fade" id="oferta">
                                    
                                    <p></br>Cuando se presiona en la barra de opciones la opción “<strong>Productos en oferta</strong>” se mostraran todas las ofertas disponibles de todos los proveedores que están dentro del sistema.<br><br>
		                            Usted podrá buscar, deslizando hacia abajo, el producto que usted busca o visualizar todas las ofertas y considerar si alguna se adapta a su necesidad.<br><br></p>
                                    En caso de querer únicamente buscar, si existen promociones disponibles para un producto en especial, deberá dirigirse hacia la parte superior donde encontrara una barra en la cual podrá escribir el producto o marca que busca y –RestoCompras le mostrara todas las ofertas que existen actualmente. Si desea alguna en especial presione sobre el nombre del proveedor para obtener los datos de contacto del mismo.
                                </div>
                                <div class="tab-pane fade" id="solicitar">
                                    
                                    <p></br>Si usted utiliza algún tipo de producto en una cantidad estipulada que es mayor a la que ofertan actualmente los proveedores y desea saber si alguno de ellos le puede ofrecer un mejor precio por la cantidad deseada, se puede dirigir a la opción “<strong>Solicitar productos</strong>” que encontrara en la barra de opciones.<br><br> 

                            		Esta sección contiene <strong>una barra para realizar una nueva solicitud</strong> en la cual encontrara:<br><br>
                            		
                            		● Nombre del producto deseado<br>
                            		● Marca<br>
                            		● Dimensión que quiere comprar<br><br>
                            
                            		Al enviar esta solicitud presionando en la opción “<strong>Solicitar</strong>" <strong>se enviara a todos los proveedores que se encuentren dentro de –RestoCompras</strong>, ellos visualizaran su solicitud y se comunicaran con usted para ofertar en caso de poseer el producto.<br><br>
                            
                            		Si usted ya ha ingresado solicitudes anteriormente podrá visualizarlas debajo de la barra para solicitar un nuevo producto.<br><br> 
                            
                            		En caso de haber concretado una compra con un proveedor deberá borrar la solicitud si es que lo desea para dejar de recibir ofertas de otros proveedores.</p>
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
