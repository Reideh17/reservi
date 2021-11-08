<?php

session_start();
$ruta = RouteController::ctrRoute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservas</title>
    <base href="views/">
    <link rel="icon" src="img/plantilla/img/icono.png">
    <!--=====================================
	VÍNCULOS CSS
	======================================-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Fuente Open Sans 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Hoja Estilo Personalizada -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
     <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!--=====================================
	VÍNCULOS JAVASCRIPT
	======================================-->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <!-- https://easings.net/es# -->
    <script src="js/plugins/jquery.easing.js"></script>
    <!-- https://markgoodyear.com/labs/scrollup/ -->
    <script src="js/plugins/scrollUP.js"></script>
    <!-- https://www.jqueryscript.net/loading/Handle-Loading-Progress-jQuery-Nite-Preloader.html -->
    <script src="js/plugins/jquery.nite.preloader.js"></script>

    <!-- SWEET ALERT 2 -->	
	<!-- https://sweetalert2.github.io/ -->
	<script src="js/plugins/sweetalert2.all.js"></script>

</head>

<body>

    <?php

/*=============================================
	Validar correo electrónico
	=============================================*/

	$item = "usuemailen";
	$valor = $_GET["pagina"];

	$validarCorreo = UserController::ctrMostrarUsuarios($item, $valor);

	if($validarCorreo["usuemailen"] == $_GET["pagina"]){

		$id = $validarCorreo["oid"];
		$item = "usuverific";
		$valor = 1;

		$respuesta = UserController::ctrActualizarUsuario($id, $item, $valor);

		if($respuesta == "ok"){

			echo'<script>

					swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡Su cuenta ha sido verificada, ya puede ingresar al sistema!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
					}).then(function(result){

							if(result.value){   
							    window.location = "'.$ruta.'ingreso"
							  } 
					});

				</script>';

			return;

		}
	
	}

/*=============================================
	Enlace de afiliado 
	=============================================*/

	//$validarEnlace = UserController::ctrMostrarUsuarios("enlace_afiliado", $_GET["pagina"]);

 /*	if($validarEnlace["enlace_afiliado"] == $_GET["pagina"] && $validarEnlace["suscripcion"] == 1){

 		setcookie("patrocinador", $validarEnlace["enlace_afiliado"], time() + 604800, "/" );

 		include "paginas/ingreso.php";

 	}*/

     


    if (isset($_GET["pagina"])) {

        if ($_GET["pagina"] == "inicio") {

            include "paginas/inicio.php";
        }

        if ($_GET["pagina"] == "ingreso") {

            if (isset($_POST["idioma"])) {

                if ($_POST["idioma"] == "es") {

                    include "paginas/ingreso.php";
                } else {

                    include "paginas/ingreso_en.php";
                }
            } else {

                include "paginas/ingreso.php";
            }
        }

        if ($_GET["pagina"] == "registro") {

            if (isset($_POST["idioma"])) {

                if ($_POST["idioma"] == "es") {

                    include "paginas/registro.php";
                } else {

                    include "paginas/registro_en.php";
                }
            } else {

                include "paginas/registro.php";
            }
        }
    } else {

        include "paginas/inicio.php";
    }



    ?>

<?php if (!isset($_COOKIE["ver_cookies"])): ?>

<div class="jumbotron bg-white w-100 text-center py-4 shadow-lg cookies">	

	<p>Este sitio web utiliza cookies para garantizar que obtenga la mejor experiencia al navegar nuestro sitio.
	<a href="reservi.pdf" target="_blank">Leer más</a>
	</p>
	<button class="btn btn-info btn-sm px-5">Ok</button>

</div>

<?php endif ?>


<input type="hidden" value="<?php echo $ruta; ?>" id="ruta">
<script src="js/script.js"></script>


</body>

</html>