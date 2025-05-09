<?php

require_once 'includes/constants/connection.php';

session_start();

if(isset($_SESSION['loginname']))
{
	header('Location: home.php');
	die();
}

if(!empty($_POST))
{
	$dbconnection = mysqli_connect($db_server, $db_user, $db_password, $db_name);

	if (!$dbconnection)
	{
    	die("Problemas en la conexión: " . mysqli_connect_error());
	}

	$form_user = strtolower($_POST['user']);
	$form_password = $_POST['password'];

	$userok = mysqli_real_escape_string($dbconnection, $form_user);
	$passwordok = mysqli_real_escape_string($dbconnection, $form_password);

	$sentence = "SELECT user_id, user_loginname, user_type, user_count FROM users WHERE BINARY `user_loginname` = '$userok' AND BINARY `user_password` = '$passwordok'";
	$result = mysqli_query($dbconnection, $sentence);
	$rows = mysqli_num_rows($result);
	if($rows > 0 && $rows < 2)
	{
		$data = mysqli_fetch_assoc($result);
		$_SESSION['loginname'] = $data['user_loginname'];
		$_SESSION['type'] = $data['user_type'];
		$userid = $data['user_id'];
		$_SESSION['id'] = $userid;
		$count = $data['user_count'] + 1;
		
		$sentence = "UPDATE users SET user_count = '$count' WHERE user_id = '$userid'";
		mysqli_query($dbconnection, $sentence);

		mysqli_free_result($result);
		mysqli_close($dbconnection);

		if($data['user_type'] == 0)
		{
			header('Location: home.php?pagina=pedidos');
			die();
		}
		else
		{
			header('Location: home.php?pagina=ofertas');
			die();
		}
	}
	else
	{
		$loginmessage = "Usuario o contraseña incorrectos";
		mysqli_free_result($result);
		mysqli_close($dbconnection);
	}
}
else
{
	$loginmessage = "Ingrese usuario y contraseña";
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="restocompras">
    <meta name="author" content="restocompras">
    
    <link rel="shortcut icon" href="index/img/resto.ico.png">

    <title>RestoCompras</title>

    <!-- Bootstrap core CSS -->
    <link href="index/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="index/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="index/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="index/css/creative.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">RestoCompras</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contacto</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <div><?php echo "$loginmessage"; ?></div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
				      <input type="text" name="user" class="form-control" placeholder="Usuario" required><br>
				      <input type="password" name="password" class="form-control" placeholder="Contraseña" required><br>
				      <input type="submit" value="Iniciar sesión" name="" class="btn btn-primary btn-lg btn-block">
			    </form>
          </div>
        </div>
      </div>
    </header>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
            <a> <button class="btn btn-secondary" id="link">Ver Términos y condiciones de uso </button></a>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-primary" id="terms">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center" >
            <hr class="light my-4">
            <h2 lang="es-ES" align="center">
</h2>
<h2 lang="es-ES" align="center">
    TÉRMINOS Y CONDICIONES
</h2>
<p lang="es-ES">
    Este contrato describe los términos y condiciones aplicables al uso de los
    servicios ofrecidos por RESTOCOMPRAS, de Luis M. Attorresi, CUIT.
    20-14888648-3 , de Martín Ballester DNI:40904978 de Rubén Ballester DNI:
    14758455 (en adelante los “Servicios”) a través del sitio web
    www.restocompras.com adelante el “Sitio”). Cualquier persona (en adelante
    “Usuario” o “Usuarios”- proveedores - clientes) que decida acceder y/o usar
    el sitio quedará sujeto a los presentes Términos y Condiciones.
</p>
<p lang="es-ES">
    Los Términos y Condiciones incluyen también las Políticas de Privacidad y
    los demás documentos incorporados a los mismos por referencia, y deberán
    ser leídos, comprendidos y aceptados por el Usuario previo a su
    registración como Usuario del Sitio. Estos términos y condiciones tienen
    carácter obligatorio y vinculante para el Usuario del Sitio. RestoCompras
    se reserva el derecho de actualizar y/o modificar los presentes Términos y
    Condiciones en cualquier momento. Queda convenido que el Usuario es el
    único y exclusivo responsable de revisar los Términos y Condiciones
    periódicamente.
</p>
<h2 lang="es-ES">
    1. ALCANCE DEL SERVICIO
</h2>
<p lang="es-ES">
    RestoCompras ofrece a través de su Sitio una red privada la información de
    comercialización de productos gastronómicos, en la que los Usuario/s-
    proveedores puede ofrecer productos determinados y ofertas publicadas, que
    pueden ser vistas por otros Usuarios (Clientes) del Sitio.
</p>
<p lang="es-ES">
    El Servicio está fundamentalmente destinado a
    <em>
        <strong>
            empresas de comercialización de insumos gastronómicos, y se limita
            a promover y facilitar el comercio entre Usuarios, brindando la
            posibilidad de publicación de ofertas de productos determinados en
            el Sitio, comparando precios, marcas, dimensiones, etc. y
            realizando gestiones tendientes a generar el contacto entre
            Usuarios (proveedores y clientes) que manifiesten su voluntad de
            venta y de compra respectivamente, en relación a un producto o
            productos determinados., informando datos del proveedor o clientes
            que están interesados de dichos productos
        </strong>
    </em>
</p>
<p lang="es-ES">
    La actividad de RestoCompras se limita a brindar información entre la
    oferta y la demanda, y
    <em>
        <strong>
            no es parte en ninguna operación que eventualmente pueda realizarse
            entre los Usuarios
        </strong>
    </em>
    . No interviene en la negociación, en la determinación de las condiciones
    particulares de la operación, ni en el perfeccionamiento del negocio
    definitivo entre los Usuarios.-
</p>
<p lang="es-ES">
    El servicio prestado por RestoCompras se regirá en todos los casos por la
    ley de la República Argentina.-
</p>
<h2 lang="es-ES">
    2. USUARIOS (proveedores y clientes)
</h2>
<h2 lang="es-ES">
    2.1 Capacidad
</h2>
<p lang="es-ES">
    La persona que desee utilizar los Servicios y/o Registrarse como Usuario
deberá    <strong>ser mayor de edad y tener capacidad legal para contratar</strong>,
    de acuerdo a la normativa vigente. Deberá contar además con los permisos,
    licencias o habilitaciones especiales que establezcan las normas, o que
    requiera este acuerdo, para la comercialización de los productos que
    pretenda publicar. No podrá utilizar los Servicios el Usuario que haya sido
    inhabilitado, o cuya cuenta haya sido suspendida en los términos de este
    acuerdo. Para el caso que el Usuario se registre como representante de una
    empresa, deberá tener facultades suficientes para contratar en nombre y
    representación de esa empresa, y para aceptar los presentes Términos y
    Condiciones.-
</p>
<h3 lang="es-ES">
    2.2 Registración
</h3>
<p lang="es-ES">
    Quien tenga intención de registrarse como Usuario deberá completar el
    <strong>
        formulario de registración en todos sus campos con datos válidos
    </strong>
    . El interesado deberá completarlo con su información personal de manera
    exacta, precisa y verdadera y para el caso de que se modificase alguno de
    los datos ingresados, asume el compromiso de actualizarlo en forma
    inmediata.
    <strong>
        El Usuario presta expresa conformidad de publicar los datos a través
        del sitio y que RestoCompras
    </strong>
    utilice diversos medios para identificar sus datos personales, asumiendo el
    Usuario la obligación de revisarlos y mantenerlos actualizados.
    RestoCompras no se responsabiliza por la certeza de los datos personales
    del Usuario. El Usuario garantiza y responde, en cualquier caso, por la
    veracidad, exactitud, vigencia y autenticidad de los datos personales
    registrados.-
</p>
<h3 lang="es-ES">
    2.3 Cuenta y contraseña
</h3>
<p lang="es-ES">
    El Usuario accederá a su “
    <strong>
        cuenta” personal mediante NOMBRE y la contraseña ASIGNADA por
        RestoCompras.
    </strong>
    El Usuario se obliga a mantener la confidencialidad de sus datos de usuario
    y contraseña. La cuenta creada es única, personal e intransferible. En caso
    que RestoCompras detecte distintas cuentas que contengan datos coincidentes
    o relacionados, podrá cancelarlas, suspenderlas o inhabilitarlas. El
    Usuario será responsable por todas las acciones y operaciones efectuadas
    mediante el uso de su cuenta, toda vez que el acceso a la misma estará
    limitado al ingreso de su nombre de usuario y contraseña, de conocimiento
    exclusivo del Usuario.-Queda a cargo exclusivo del Usuario la obligación de
    notificar fehacientemente de manera inmediata a RestoCompras sobre
    cualquier uso o ingreso no autorizado a su cuenta.-
</p>
<h3 lang="es-ES">
    2.4 Cancelación de registración
</h3>
<p lang="es-ES">
    RestoCompras se reserva el derecho de rechazar cualquier solicitud de
    registración o de cancelar una registración previamente aceptada, sin
    obligación de comunicar o exponer las razones de esa decisión y sin que
    ello genere derecho alguno a indemnización o resarcimiento.-Asimismo, el
    Usuario podrá solicitar la cancelación de su registración en cualquier
    momento.-
</p>
<h3 lang="es-ES">
    2.5 Mención de Usuario como cliente del Sitio
</h3>
<p lang="es-ES">
    RestoCompras queda facultada a mencionar a los Usuarios registrados -y a
    las empresas que éstos representen- como clientes del Sitio, pudiendo
    publicar su nombre o logotipo identificatorio a tal fin.-
</p>
<h2 lang="es-ES">
    3. MODIFICACIONES A LOS TÉRMINOS Y CONDICIONES
</h2>
<p lang="es-ES">
    RestoCompras se encuentra expresamente facultado para modificar estos
    Términos y Condiciones en cualquier momento. Los Términos y Condiciones
    modificados se harán públicos en el Sitio y entrarán en vigencia a los diez
    (10) días corridos contados desde esa publicación. Dentro de ese plazo el
    Usuario podrá rechazar las modificaciones introducidas, lo que traerá
    aparejado la cancelación de su registración en el Sitio a partir de la
    fecha de la manifestación del Usuario. Vencido este plazo, se considerarán
    aceptados los nuevos Términos y Condiciones. Todo ello sin perjuicio de las
    facultades del Usuario de suscribirse del Sitio o dejar de utilizar sus
    Servicios.-
</p>
<h2 lang="es-ES">
    4. PUBLICACIÓN DE PRODUCTOS
</h2>
<h3 lang="es-ES">
    4.1 Titularidad y disponibilidad del producto ofrecido
</h3>
<p lang="es-ES">
    Un Usuario
    <strong>
        no podrá publicar un producto con otra finalidad que no sea la de su
        venta
    </strong>
    . Deberá ser propietario del producto o estar suficientemente autorizado
    por su propietario para publicar la oferta.-En su caso, deberá contar
    además con los permisos, licencias o habilitaciones especiales que
    establezca la normativa vigente para la comercialización de los productos
    ofrecidos.-RestoCompras se reserva el derecho a no publicar en el Sitio un
    aviso postulado por el Usuario.-
</p>
<h3 lang="es-ES">
    4.2 Precios
</h3>
<p lang="es-ES">
Las publicaciones de los Usuarios deberán consignar el precio del producto.    <strong>Ese precio se expresará en pesos argentinos </strong>Deberá
    asimismo consignarse de manera clara y precisa a qué cantidad del producto
    ofrecido le corresponde el precio publicado.-La publicación cuyo precio no
    sea expresado de esta forma podrá ser suspendida o eliminada por
    RESTOCOMPRAS a los efectos de evitar inconvenientes entre los Usuarios.-
</p>
<h3 lang="es-ES">
    4.3 Contenido de la publicación e imágenes
</h3>
<h3 lang="es-ES">
    Los usuarios autorizan a RestoCompras a publicar la información de los
    productos, y la publicación de un producto procurará brindar la mejor
    información posible, al eventual comprador, y deberá contar con una
    descripción completa y suficiente del producto.
</h3>
<p lang="es-ES">
    En la publicación podrán incluirse textos descriptivos, gráficos,
    fotografías y otros contenidos, RestoCompras se reserva el derecho de
    editar y modificar a su criterio el formato y contenido de la publicación,
    sin alterar las condiciones de venta postuladas por el Usuario.-El Usuario
    podrá incluir imágenes y fotografías del producto ofrecido. RestoCompras se
    reserva el derecho de retocar y adaptar las imágenes aportadas por el
    Usuario.-Para el caso que el Usuario quisiere publicar imágenes o logotipos
    que identifiquen la marca del producto ofrecido, deberá contar con las
    autorizaciones suficientes para realizar esa publicación, y será el único y
    exclusivo responsable por el uso de esa imagen o logotipo de la
    marca.-RestoCompras podrá utilizar imágenes contenidas en las publicaciones
    a los efectos de exhibir y promocionar dichas publicaciones.-Para el caso
    de publicaciones que infrinjan cualquiera de las disposiciones aquí
    establecidas, RestoCompras se reserva el derecho de editar directamente la
    publicación, solicitar al Usuario que la edite, o eliminar la publicación
    en la que se verifique la infracción.
</p>
<h3 lang="es-ES">
    4.4 Productos prohibidos
</h3>
<p lang="es-ES">
    Sólo podrán ser publicados los productos cuya venta no se encuentre tácita
    o expresamente prohibida por estos Términos y Condiciones Generales y demás
    políticas de RestoCompras o por las leyes generales y/o normativas
    específicas vigentes.-
</p>
<h3 lang="es-ES">
    4.5 Protección propiedad intelectual
</h3>
<p lang="es-ES">
    Ante la sospecha de violación de derechos de propiedad intelectual,
    RestoCompras se reserva el derecho de suspender o eliminar publicaciones,
    de informar tal circunstancia a los titulares de los derechos afectados,
    informando los datos personales del Usuario que hubiere efectuado la
    publicación. Asimismo, los titulares de derechos y sus representantes o
    herederos, podrán identificar y solicitar a RestoCompras la remoción de
    aquellas publicaciones que a su criterio infrinjan o violen sus derechos.-
</p>
<h3 lang="es-ES">
    5.6 Reclamos
</h3>
<p lang="es-ES">
    Cualquier reclamo de los Usuarios, ya sean compradores o vendedores,
    relativos al pago del precio, entrega del producto, o cualquier otra
    circunstancia relativa a la negociación y/o perfeccionamiento de la
    operación, deberá dirimirse directamente entre los Usuarios, sin
    intervención alguna de RestoCompras.
</p>
<h2 lang="es-ES">
    5. SANCIONES
</h2>
<p lang="es-ES">
    Sin perjuicio de otras medidas, RestoCompras podrá suspender en forma
    temporal o definitivamente la cuenta de un Usuario o una o más
    publicaciones, iniciar las acciones que estime pertinentes y/o suspender la
    prestación de los Servicios si: (a) se transgrediera alguna norma legal, o
    cualquiera de las estipulaciones de los Términos y Condiciones Generales y
    demás políticas de RestoCompras.; (b) si incumpliera sus obligaciones o
    compromisos como Usuario; (c) si se incurriera a criterio RestoCompras en
    conductas o actos dolosos o fraudulentos; (d) no pudiera verificarse la
    identidad del Usuario, la representación que alegue, o cualquier
    información proporcionada por el mismo fuere errónea; (e) RestoCompras
    entendiera que las publicaciones u otras acciones pueden ser causa de
    responsabilidad para el Usuario que las publicó, para RestoCompras o para
    los demás Usuarios en general. En el caso de la suspensión de un Usuario,
    sea temporal o definitiva, todos las publicaciones que se encontraran
    vigentes serán removidas del sistema.-.
</p>
<h2 lang="es-ES">
    6. RESPONSABILIDAD
</h2>
<h3 lang="es-ES">
    6.1 Independencia de RestoCompras respecto del Usuario
</h3>
<p lang="es-ES">
    <strong>
        Ni los Servicios ni este contrato crean ninguna relación asociativa
    </strong>
    , de mandato, de franquicia, de agencia, de dependencia y/o de trabajo
    entre RestoCompras y el Usuario.- RestoCompras no es el propietario de los
    productos ofrecidos, no tiene posesión de ellos ni los ofrece en venta, por
    lo que el Usuario reconoce y acepta que RestoCompras no es parte en ninguna
    operación, ni tiene injerencia ni posibilidad de control algunos sobre la
    existencia, vigencia, calidad, seguridad o legalidad de los bienes
    publicados, la veracidad o exactitud de las publicaciones, y/o la
    autorización o capacidad de los Usuarios para comercializar los bienes
    publicados.-
</p>
<h3 lang="es-ES">
    6.2 Independencia de RestoCompras respecto de los productos publicados
</h3>
<p lang="es-ES">
    RestoCompras no puede garantizar el cumplimiento de una operación por parte
    del Usuario, ni verificar la identidad o datos personales ingresados por el
    Usuario. Las obligaciones asumidas por los Usuarios, serán contraídas
    individualmente y a nombre propio. En ningún caso RestoCompras responderá
    por esas obligaciones.-
</p>
<h3 lang="es-ES">
    6.3 Responsabilidad del Usuario
</h3>
<p lang="es-ES">
    Cada Usuario es el exclusivo responsable por los productos que publica para
    su venta y por la aceptación a las ofertas que realice.-Los productos
    ofrecidos y/o publicados en el Sitio no se encuentran garantizados por
    RestoCompras.
</p>
<h3 lang="es-ES">
    6.5 Indemnidad
</h3>
<p lang="es-ES">
    El Usuario acepta indemnizar y eximir de responsabilidad a RestoCompras., y
    a sus integrantes, socios, gerentes, directores, funcionarios o
    representantes por cualquier reclamo formulado por cualquier Usuario y/o
    tercero por cualquier infracción a estos Términos y Condiciones y demás
    Anexos y Políticas que se entienden incorporadas al presente, y/o cualquier
    ley y/o derechos de terceros.-
</p>
<h2 lang="es-ES">
    7. TARIFA Y FACTURACIÓN
</h2>
<p lang="es-ES">
    Por la utilización de los servicios del sitio www.restocompras.com, el
    usuario se obliga a abonarle a RestoCompras, en concepto de tarifa del
    servicio, la suma equivalente a un abono mensual de pesos previamente
    pactado, del 1 al 10 del mes de la prestación del servicio.
</p>
<p lang="es-ES">
    La tarifa podrá ser modificada por acuerdo entre el Usuario y RestoCompras,
</p>
<p lang="es-ES">
    El usuario y RestoCompras quedan facultados para rescindir este contrato en
    forma individual, sin ninguna indemnización para cada una de las partes.
</p>
<h2 lang="es-ES">
    8. PROPIEDAD INTELECTUAL
</h2>
<p lang="es-ES">
    Los contenidos del Sitio como así también los programas, bases de datos,
    redes, archivos que permiten al Usuario acceder y usar su cuenta, son de
    propiedad de RestoCompras y están protegidas por las leyes y los tratados
    internacionales de derecho de autor, marcas, patentes, modelos y diseños
    industriales. El uso indebido y la reproducción total o parcial de dichos
    contenidos quedan prohibidos.-
</p>
<p lang="es-ES">
    El Sitio puede contener enlaces a otros sitios web, lo cual no indica que
    sean propiedad u operados por RestoCompras En virtud que no tiene control
    sobre tales sitios, no será responsable por los contenidos, materiales,
    acciones y/o servicios prestados por los mismos, ni por daños o pérdidas
    ocasionadas por la utilización de los mismos, sean causadas directa o
    indirectamente. La presencia de enlaces a otros sitios web no implica una
    sociedad, relación, aprobación, respaldo de RestoCompras a dichos sitios y
    sus contenidos.-
</p>
<h2 lang="es-ES">
    9. VIOLACIONES DEL SISTEMA O BASES DE DATOS
</h2>
<p lang="es-ES">
    No está permitida ninguna acción o uso de dispositivo, software, u otro
    medio tendiente a interferir tanto en las actividades y operatoria del
    sitio, como en las ofertas, descripciones, cuentas o bases de datos de
    RestoCompras. Cualquier intromisión, tentativa o actividad violatoria o
    contraria a las leyes sobre derecho de propiedad intelectual y/o a las
    prohibiciones estipuladas en este acuerdo harán pasible a su responsable de
    las acciones legales pertinentes.-
</p>
<h2 lang="es-ES">
    10. COMPETENCIA Y LEY APLICABLE
</h2>
<p lang="es-ES">
    Este acuerdo se regirá en todo su contenido por la ley de la República
    Argentina.-
</p>
<p lang="es-ES">
    RestoCompras y el Usuario se someten a los efectos del presente acuerdo a
    la jurisdicción de los Tribunales Ordinarios de la ciudad de Rosario,
    Provincia de Santa Fe, renunciando a cualquier fuero que pudiese
    corresponderles, inclusive el Federal.-A todos los efectos de este
    contrato, RestoCompras se encuentra en Rosario, Provincia de Santa Fe,
    República Argentina, y el Usuario constituye domicilio en el declarado al
    momento de su registración o en la última actualización realizada de sus
    datos personales.-
</p>
</br>
</br>
</br>
</br>
          </div>
        </div>
      </div>
    </section>
    
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Contacto</h2>
            <hr class="my-4">
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 ml-auto text-center">
            <i class="fa fa-phone fa-3x mb-3 sr-contact"></i>
            <p>Luis: +54 9 341 6412407</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="index/vendor/jquery/jquery.min.js"></script>
    <script src="index/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="index/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="index/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="index/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="index/js/creative.min.js"></script>

  </body>

</html>

<script type="text/javascript">
$( "#terms" ).hide();
$( "#link" ).click(function() {
  $( "#terms" ).show( "slow", function() {
  });
});
  
</script>
