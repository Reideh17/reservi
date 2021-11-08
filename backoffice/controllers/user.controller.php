<?php

// https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


Class UserController{

	/*=============================================
	Registro de usuarios
	=============================================*/

	public function ctrRegistroUsuario(){

		if(isset($_POST["numero_id"])){
		
			$ruta = RouteController::ctrRoute();

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["numero_id"]) /*preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["numero_id"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
			    preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])*/){

				//$encriptar = crypt($_POST["password1"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$encriptar = crypt($_POST["password1"], '$2a$07$asxx54ahjppf17sd87a5a4dDDGsystemdevmybebe$');

				$encriptarEmail = md5($_POST["email"]);

				$tabla = "genusuario";
				$datos = array("genrol" => "1",
							   "usunombre" => $_POST["numero_id"],
							   "usudescrip" => $_POST["nombre"],
							   "usuclave" => $encriptar,
							   "usuemail" => $_POST["email"],
							   "usuemailen" => $encriptarEmail,
							   "usuverific" => 0); 

				
				$respuesta = UserModel::mdlRegistroUsuario($tabla, $datos);				

				if($respuesta == "ok"){

					/*=============================================
					Verificación Correo Electrónico
					=============================================*/

					date_default_timezone_set("America/Bogota");

					$mail = new PHPMailer(true);
			

					$mail->Charset = "UTF-8";

					$mail->isMail();

					$mail->setFrom("sdhsoluciones.sas@gmail.com", "SDH Soluciones  ",0);

					$mail->addReplyTo("sdhsoluciones.sas@gmail.com", "Informacion SDH Soluciones");

					$mail->Subject  = "Por favor verifique su direcci&oacute;n de correo electr&oacute;nico";

					$mail->addAddress($_POST["email"]);

					$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
					<center>
							
						<img style="padding:20px; width:10%" src="http://www.hdv.gov.co/images/logos/logoHDV1.png">

					</center>

					<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
						
						<center>

							<img style="padding:20px; width:15%" src="http://www.hdv.gov.co/images/logos/logoHDV1.png">

							<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCI&Oacute;N DE CORREO ELECTR&Oacute;NICO</h3>

							<hr style="border:1px solid #ccc; width:80%">

							<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su direcci&oacute;n de correo electr&oacute;nico</h4>

							<a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
								
								<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su direcci&oacute;n de correo electr&oacute;nico</div>

							</a>

							<br>

							<hr style="border:1px solid #ccc; width:80%">

							<h5 style="font-weight:100; color:#999">Si no se inscribi&oacute; en esta cuenta, puede ignorar este correo electr&oacute;nico y eliminarlo.</h5>

						</center>	

					</div>

				</div>');
							
					$envio = $mail->Send();

					if(!$envio){

						echo '<script>

							swal({

								type:"error",
								title: "¡ERROR!",
								text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["email"].' '.$mail->ErrorInfo.', por favor inténtelo nuevamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									history.back();

								}


							});	

						</script>';


					}else{


						echo '<script>

							swal({

								type:"success",
								title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
								text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "'.$ruta.'ingreso";

								}


							});	

						</script>';


					}
					
				}

			}else{

				echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});	

				</script>';


			}

		}

	}



	/*=============================================
	Mostrar Usuarios
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){
	
		$tabla = "genusuario";

		$respuesta = UserModel::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Mostrar Inversiones por usuario
	=============================================*/

	static public function ctrMostrarInversionesPorusuario($item, $valor, $id_user){
	
		$tabla1 = "usuarios";
		$tabla2 = "sol_inversion";

		$respuesta = UserModel::mdlMostrarInversionesPorUsuario($tabla1, $tabla2, $item, $valor, $id_user);

		return $respuesta;

	}

	/*=============================================
	Mostrar Inversiones
	=============================================*/

	static public function ctrMostrarInversionesPorAprobar($item, $valor){
	
		$tabla1 = "usuarios";
		$tabla2 = "sol_inversion";

		$respuesta = UserModel::mdlMostrarInversionesPorArpobar($tabla1, $tabla2, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Mostrar datos de la inversion y del usuario
	=============================================*/

	static public function ctrMostrarDatosInversionesPorAprobarxidarchivo($valor){
	
		
		$tabla1 = "sol_inversion";
		$tabla2 = "usuarios";

		$respuesta = UserModel::mdlMostrardatosInversionesPorId( $tabla1, $tabla2, $valor);

		return $respuesta;

	}


	/*=============================================
	Mostrar archivo de  Inversiones
	=============================================*/

	static public function ctrMostrarInversionesPorAprobarxidarchivo($valor){
	
		
		$tabla = "sol_inversion";

		$respuesta = UserModel::mdlMostrarInversionesPorArpobarxArchivo( $tabla, $valor);

		return $respuesta;

	}


	/*=============================================
	Actualizar Usuario
	=============================================*/

	static public function ctrActualizarUsuario($id, $item, $valor){

		$tabla = "genusuario";

		$respuesta = UserModel::mdlActualizarUsuario($tabla, $id, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Ingreso Usuario
	=============================================*/

	public function ctrIngresoUsuario(){

		if(isset($_POST["user01"])){

		//	 if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

			 	//$encriptar = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$encriptar = crypt($_POST["passwords01"], '$2a$07$asxx54ahjppf17sd87a5a4dDDGsystemdevmybebe$');

			 	$tabla = "genusuario";
			 	$item = "usunombre";
			 	$valor = $_POST["user01"];

			 	$respuesta = UserModel::mdlMostrarUsuarios($tabla, $item, $valor);

				//echo "<pre>".print_r($respuesta)."</pre>";

			 	if($respuesta["usunombre"] == $_POST["user01"] && $respuesta["usuclave"] == $encriptar){

			 		if($respuesta["usuverific"] == 0){

			 			echo'<script>

							swal({
									type:"error",
								  	title: "¡ERROR!",
								  	text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta, o contáctese con nuestro soporte a info@valientesdigitales.com.co!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
							}).then(function(result){

									if(result.value){   
									    history.back();
									  } 
							});

						</script>';

						return;

			 		}else{

			 			$_SESSION["validarSesion"] = "ok";
			 			$_SESSION["id"] = $respuesta["oid"];

			 			$ruta = RouteController::ctrRoute();

			 			echo '<script>
					
							window.location = "'.$ruta.'backoffice";				

						</script>';

			 		}

			 	}else{

			 		echo'<script>

						swal({
								type:"error",
							  	title: "¡ERROR!",
							  	text: "¡El email o contraseña no coinciden!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

			 	}


		/*	 }else{

			 	echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';

			 }*/

		}

	}

		/*=============================================
	actualizar la solicitud de inversion 
	=============================================*/

	public function ctrUpdateInversion(){

		if(isset($_POST["idUsuarioInversion"])){
			
				/* espacio para insertar datos en la tabla */
				date_default_timezone_set("America/Bogota");
				$id = $_POST["txt_id_solicitud"];
				$tabla = "sol_inversion";
				$fecha_apobacion = substr(date("c"), 0, -6);				
				/*	$estado = $_POST["options"];
				
				$id_user_aprobo = $_POST["idUsuarioInversion"];
				$observacion =  $_POST["txt_detalles"];*/
				

				$datos_inv = array("estado" => $_POST["options"] ,
						"fecha_apobacion" => $fecha_apobacion ,
						"id_user_aprobo" =>  $_POST["idUsuarioInversion"],
						"observacion" => $_POST["txt_detalles"] );

				//echo '<pre>'; print_r($datos_inv); echo '</pre>';
				//	echo "<script>console.log(".$datos_inv.");</script>";


				$respuestaok = UserModel::mdlUpdateSolicitudInversion($tabla, $datos_inv, $id);

				//echo "<script>console.log(".$respuesta.");</script>";

				if($respuestaok == "ok"){

					if($_POST["options"] == "2"){

						$crearTransacion = new UserController();
          				$crearTransacion -> ctrCreartransacion();
					}
					else{
						echo '<script>

								swal({

									type:"success",
									title: "¡SU SOLICITUD HA SIDO ENVIADA!",
									text: "¡El usuario podra revisar el estado de la solicitud en su opcion de historico  2!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								});	

							</script>';
					}

				}


			
		}
	}





		/*=============================================
	Crear transacion de la inversion autorizada
	=============================================*/

	public function ctrCreartransacion(){
		if(isset($_POST["idUsuarioInversion"])){		

				/* espacio para insertar datos en la tabla */
				$tabla = "vad_transaciones";
				$fecha_movimiento = substr(date("c"), 0, -6);
				//$plan = $_POST["options"];
				//$fecha_fin = substr(date("c") + $plan, 0, -6)."Z";
				//$id = $_POST["txt_id_solicitud"];





						$datos_mov = array("id_inversion" => $_POST["txt_id_solicitud"] ,
						"monto" => $_POST["txt_monto"] ,
						"tipo_movimiento" =>  "1",
						"fecha_movimiento" => $fecha_movimiento );

						/* datos de los movimientos esta 1 es inversion , 2 es ganancia , 3 retiro */

				//echo '<pre>'; print_r($datos_mov); echo '</pre>';

				$respuesta = UserModel::mdlRegistroMovimientoInversion($tabla, $datos_mov);

				if($respuesta == "ok"){

					echo '<script>

								swal({

									type:"success",
									title: "¡SU SOLICITUD HA SIDO ENVIADA!",
									text: "¡El usuario podra revisar el estado de la solicitud en su opcion de historico!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								});	

							</script>';
					

				}  // fin swl if que valida para enviar el mail

				/* Fin de la insercion de datos de la tabla*/
			
		}// fin del primer if donde pregunta si se envio el id del usuario		
	} // fin de la funcion publica



	/*=============================================
	Crear inversion
	=============================================*/

	public function ctrCrearInversion(){
		if(isset($_POST["idUsuarioInversion"])){

			
			if(isset($_FILES["soporteimg"]["tmp_name"]) && !empty($_FILES["soporteimg"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["soporteimg"]["tmp_name"]);

				$nuevoAncho = 1500;
				$nuevoAlto = 1500;
				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/
				date_default_timezone_set("America/Bogota");
				$fecha_img = date("d")."_".date("m")."_".date("y")."_".date("h")."_".date("i")."_".date("s")."_".date("a");              

				$directorio_inv = "views/img/inversion/".$_POST["idUsuarioInversion"];

				if(!file_exists($directorio_inv)){	

					mkdir($directorio_inv, 0755);

				}

				//echo $directorio_inv;
				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["soporteimg"]["type"] == "image/jpeg"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio_inv."/".$aleatorio."_".$fecha_img.".jpg";

					$origen = imagecreatefromjpeg($_FILES["soporteimg"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);	


				}else if($_FILES["soporteimg"]["type"] == "image/png"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio_inv."/".$aleatorio."_".$fecha_img.".png";

					$origen = imagecreatefrompng($_FILES["soporteimg"]["tmp_name"]);	

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

					imagealphablending($destino, FALSE);
		
					imagesavealpha($destino, TRUE);		

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);		

					imagepng($destino, $ruta);

				}else{

					echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten formatos diferentes a JPG y/o PNG invsersion!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}

				/* espacio para insertar datos en la tabla */
				$tabla = "sol_inversion";
				$fecha_solictud= substr(date("c"), 0, -6);
				$plan = $_POST["options"];
				//$fecha_fin = substr(date("c") + $plan, 0, -6)."Z";


				$fechaInicial = substr($fecha_solictud,0,-10);
				$fechaVencimiento = strtotime('+'.$plan.' days', strtotime($fechaInicial) );
				$vencimiento = date("Y-m-d", $fechaVencimiento);


			/*	$datos_inv = array("fecha_solicitud" => $fecha_solictud ,
				"id_usuario" => $_POST["idUsuarioInversion"] ,
				"email_fondos" => $_POST["email_fondo"],
				"monto" => $_POST["monto"],
				"plan_inversion" => $plan,
				"fecha_final" => $vencimiento,
				"soporte" =>  $ruta,
				"estado" =>  "1",
				"fecha_apobacion" =>"",
				"id_user_aprobo" =>"",
				"observacion" =>""); */

			$datos_inv = array("fecha_solicitud" => $fecha_solictud ,
						"id_usuario" => $_POST["idUsuarioInversion"] ,
						"email_fondos" => $_POST["email_fondo"] ,
						"monto" => $_POST["monto"] ,
						"plan_inversion" => $plan ,
						"fecha_final" => $vencimiento ,
						"soporte" =>  $ruta ,
						"estado" =>  "1" ,
						"fecha_apobacion" => NULL ,
						"id_user_aprobo" => NULL ,
						"observacion" => NULL );

				//echo '<pre>'; print_r($datos_inv); echo '</pre>';

				$respuesta = UserModel::mdlRegistroInversion($tabla, $datos_inv);

				if($respuesta == "ok"){


					/*=============================================
						Verificación Correo Electrónico
						=============================================*/
						$elcorreo = $_POST["email_fondo"];
						//$rutainv = RouteController::ctrRoute();

						date_default_timezone_set("America/Bogota");

						$mail = new PHPMailer;

						$mail->Charset = "UTF-8";

						$mail->isMail();

						$mail->setFrom("info@valientesdigitales.com.co", "Valientes Digitales");

						$mail->addReplyTo("info@valientesdigitales.com.co", "Valientes Digitales");

						$mail->Subject  = "Solicitud de inversion programa capitalVAD";

						$mail->addAddress($elcorreo);

						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
						<center>
								
							<img style="padding:20px; width:10%" src="http://capital.valientesdigitales.com.co/views/img/logo.png">

						</center>

						<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
							<center>

								<img style="padding:20px; width:15%" src="http://capital.valientesdigitales.com.co/views/img/logo.png">

								<h3 style="font-weight:100; color:#999">SOLICITUD DE INVERSION EN CAPITALVAD</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px">Nuestros colaboradores est&aacute;n verificando su transferencia, por favor espere la aprobaci&oacute;n. Esta puede tardar hasta tres días h&aacute;biles.</h4>

								<a href="http://capital.valientesdigitales.com.co" target="_blank" style="text-decoration:none">
									
									<div style="line-height:60px; background:#0aa; width:60%; color:white">Monto de inverion de "'.$_POST["monto"] .'" USD, Con un plazo de "'.$plan.'"  dias.</div>

								</a>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								

							</center>	

						</div>

					</div>');
								
						$envio = $mail->Send();

						if(!$envio){

							echo '<script>

								swal({

									type:"error",
									title: "¡ERROR!",
									text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$elcorreo.' '.$mail->ErrorInfo.', por favor inténtelo nuevamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										history.back();

									}


								});	

							</script>';


						}else{


							echo '<script>

								swal({

									type:"success",
									title: "¡SU SOLICITUD HA SIDO ENVIADA!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico al igual que en la opcion de Inversiones / Historico ver el estado de la solicitud!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								});	

							</script>';


						}


				}  // fin swl if que valida para enviar el mail

				/* Fin de la insercion de datos de la tabla*/



			}// fin del if interno donde pregunta por el file
		}// fin del primer if donde pregunta si se envio el id del usuario		
	} // fin de la funcion publica

	/*=============================================
	Cambiar foto perfil
	=============================================*/

	public function ctrCambiarFotoPerfil(){

		if(isset($_POST["idUsuarioFoto"])){

			$ruta = $_POST["fotoActual"];

			if(isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/

				$directorio = "views/img/usuarios/".$_POST["idUsuarioFoto"];

				/*=============================================
				PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD Y EL CARPETA
				=============================================*/

				if($ruta != ""){

					unlink($ruta);

				}else{

					if(!file_exists($directorio)){	

						mkdir($directorio, 0755);

					}

				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["cambiarImagen"]["type"] == "image/jpeg"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);	


				}else if($_FILES["cambiarImagen"]["type"] == "image/png"){

					$aleatorio = mt_rand(100,999);

					$ruta = $directorio."/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);	

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

					imagealphablending($destino, FALSE);
		
					imagesavealpha($destino, TRUE);		

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);		

					imagepng($destino, $ruta);

				}else{

					echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}
			
			}

			// final condicion

			$tabla = "genusuario";
			$id = $_POST["idUsuarioFoto"];
			$item = "usufoto";
			$valor = $ruta;

			$respuesta = UserModel::mdlActualizarUsuario($tabla, $id, $item, $valor);

			if($respuesta == "ok"){

				echo '<script>

					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡La foto de perfil ha sido actualizada!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';


			}

		}

	}

	/*=============================================
	Cambiar contraseña
	=============================================*/

	public function ctrCambiarPassword(){

		if(isset($_POST["idUsuarioPassword"])){	

			//if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

				//$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf17sd87a5a4dDDGsystemdevmybebe$');

				$tabla = "genusuario";
				$id = $_POST["idUsuarioPassword"];
				$item = "usuclave";
				$valor = $encriptar;

				$respuesta = UserModel::mdlActualizarUsuario($tabla, $id, $item, $valor);

				if($respuesta == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡La contraseña ha sido actualizada!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';


				}

		/*	}else{

			 	echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en la contraseña!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';

			 }*/


		}

	}

	/*=============================================
	Recuperar contraseña
	=============================================*/

	public function ctrRecuperarPassword(){

		if(isset($_POST["emailRecuperarPassword"])){

		//	if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])){

				/*=============================================
				GENERAR CONTRASEÑA ALEATORIA
				=============================================*/

				function generarPassword($longitud){

					$password = "";
					$patron = "1234567890abcdefghijklmnopqrstuvwxyz";

					$max = strlen($patron)-1;

					for($i = 0; $i < $longitud; $i++){

						$password .= $patron{mt_rand(0,$max)};

					}

					return $password;

				}

				$nuevoPassword = generarPassword(11);

				$encriptar = crypt($nuevoPassword, '$2a$07$asxx54ahjppf17sd87a5a4dDDGsystemdevmybebe$');
				//$encriptar = crypt($_POST["password1"], '$2a$07$asxx54ahjppf17sd87a5a4dDDGsystemdevmybebe$');

				$tabla = "genusuario";
				$item = "usuemail";
				$valor = $_POST["emailRecuperarPassword"];

				$traerUsuario = UserModel::mdlMostrarUsuarios($tabla, $item, $valor);

				if($traerUsuario){

					$id = $traerUsuario["oid"];
					$item = "usuclave";
					$valor = $encriptar;

					$actualizarPassword = UserModel::mdlActualizarUsuario($tabla, $id, $item, $valor);

					if($actualizarPassword  == "ok"){

						/*=============================================
						Verificación Correo Electrónico
						=============================================*/

						$ruta = RouteController::ctrRoute();

						date_default_timezone_set("America/Bogota");

						$mail = new PHPMailer;

						$mail->Charset = "UTF-8";

						$mail->isMail();

						$mail->setFrom("sistemas.soportehdv@gmail.com", "Hospital Departamental de villavicencio  ");

						$mail->addReplyTo("sistemas.coordinador@hdv.gov.co", "Hospital Departamental de Villavicencio");

						$mail->Subject  = "Solicitud nueva contraseña";

						$mail->addAddress($traerUsuario["usuemail"]);

						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
							<center>
								
								<img style="padding:20px; width:10%" src="http://www.hdv.gov.co/images/logos/logoHDV1.png">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
								<center>
								
								<img style="padding:20px; width:15%" src="http://www.hdv.gov.co/images/logos/logoHDV1.png">

								<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevoPassword.'</h4>

								<a href="'.$ruta.'ingreso" target="_blank" style="text-decoration:none">

								<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">			
									Haz click aquí
								</div>

								</a>

								<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

								</center>

							</div>

						</div>');
								
						$envio = $mail->Send();

						if(!$envio){

							echo '<script>

								swal({

									type:"error",
									title: "¡ERROR!",
									text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$traerUsuario["usuemail"].' '.$mail->ErrorInfo.', por favor inténtelo nuevamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										history.back();

									}


								});	

							</script>';


						}else{


							echo '<script>

								swal({

									type:"success",
									title: "¡SU NUEVA CONTRASEÑA HA SIDO ENVIADA!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para tomar la nueva contraseña!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										window.location = "'.$ruta.'ingreso";

									}


								});	

							</script>';


						}
					
					}


				}else{

					echo '<script>

						swal({
							type:"error",
						  	title: "¡ERROR!",
						  	text: "¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}

			/*}else{


				echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡Error al escribir el correo!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';

			}*/


		}


	}

	/*=============================================
	Iniciar Suscripción
	=============================================*/

	static public function ctrIniciarSuscripcion($datos){

		$tabla = "usuarios";

		$respuesta = UserModel::mdlIniciarSuscripcion($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	Cancelar Suscripción
	=============================================*/

	static public function ctrCancelarSuscripcion($valor){

		$tabla = "usuarios";

		$datos = array(	"id_usuario" => $valor,
						"suscripcion" => 0,
						"ciclo_pago" => null,
						"firma" => null,
						"fecha_contrato" => null);


		$respuesta = UserModel::mdlCancelarSuscripcion($tabla, $datos);

		return $respuesta;

	}



} // fin de la clase 

