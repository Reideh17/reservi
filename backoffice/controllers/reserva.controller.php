<?php
//include ("../views/js/plugins/qr/phpqrcode/qrlib.php");

// https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class reservaController
{

   public function ctrRegistroResera()
   {
      
      $ruta = ControladorGeneral::ctrRuta();
      //Header("Content-type: image/png");
      //echo "<img style='padding:20px; width:15%' src='".QRcode::png('PHP QR Code :)')."'> ";
      //echo '<img src="example_001_simple_png_output.php" />';


      
      if (isset($_POST["fecha_reserva"])) {

            

            $cadena = $_POST["id_token"].$_POST["user_mail"].$_POST["fecha_reserva"];
            $cod_reserva1 = crypt($cadena, '2a07asxx54ahjppf17sd87a5a4dDDGsystemdevmybebe');
            $cod_reserva = md5($cod_reserva1);


            $tabla = "reservas";
				$datos = array("id_usuario" => $_POST["id_token"],
							   "codigo_reserva" => $cod_reserva,
							   "descripcion_reserva" => "Reserva para el dia: ".$_POST["fecha_reserva"],
							   "fecha_ingreso" => $_POST["fecha_reserva"],						   
							   "fecha_salida" => $_POST["fecha_reserva"],
							   "fecha_reserva" => $_POST["user_date"]); 

               //print_r($datos);
               $respuesta = ReservaModel::mdlRegistroReserva($tabla,$datos);          
               
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
   
                  $mail->Subject  = "Codigo de reserva";
   
                  $mail->addAddress($_POST["user_mail"]);
   
                  $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
      
                  <center>
                        
                     <img style="padding:20px; width:10%" src="http://reservi.tech/views/img/logo.png">
   
                  </center>
   
                  <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                     
                     <center>
   
                        <img style="padding:20px; width:15%" src="http://reservi.tech/views/img/logo.png">
   
                        <h3 style="font-weight:100; color:#999">Presente el siguiente codigo</h3>
   
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
                           text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["user_mail"].' '.$mail->ErrorInfo.', por favor inténtelo nuevamente",
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


					} // IF DEL POST 
					
      }// IF DE LA FUNCION 

         
   
}// fin de la clase 
