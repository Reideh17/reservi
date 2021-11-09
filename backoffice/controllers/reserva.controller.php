<?php


// https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class reservaController
{

   public function ctrRegistroResera()
   {

      if (isset($_POST["fecha_reserva"])) {
         $ruta = RouteController::ctrRoute();

         date_default_timezone_set("America/Bogota");

					$mail = new PHPMailer(true);
			

					$mail->Charset = "UTF-8";

					$mail->isMail();

					$mail->setFrom("sdhsoluciones.sas@gmail.com", "SDH Soluciones  ",0);

					$mail->addReplyTo("sdhsoluciones.sas@gmail.com", "Informacion SDH Soluciones");

					$mail->Subject  = "Por favor verifique su direcci&oacute;n de correo electr&oacute;nico";

					$mail->addAddress("hedier.alvarez@gmail.com");

					$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
					<center>
							
						<img style="padding:20px; width:10%" src="http://reservi.tech/views/img/logo.png">

					</center>

					<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
						
						<center>

							<img style="padding:20px; width:15%" src="http://reservi.tech/views/img/logo.png">                     

							<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCI&Oacute;N DE CORREO ELECTR&Oacute;NICO</h3>

							<hr style="border:1px solid #ccc; width:80%">

							<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su direcci&oacute;n de correo electr&oacute;nico</h4>

							<a href="'.$ruta.'" target="_blank" style="text-decoration:none">
								
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
								text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a , por favor inténtelo nuevamente",
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

      }
   
}// fin de la clase 
