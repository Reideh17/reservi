<div class="col-12 col-md-8">

	<div class="card card-primary card-outline">

		<div class="card-header">

			<h5 class="m-0 text-uppercase text-secondary">

				<strong>Datos personales</strong>

			</h5>

		</div>

		<div class="card-body">

			<h6 class="card-title">¡ Atualiza tus datos !</h6>

			<br>

			<p class="card-text">Al activar su cuenta ingresa en nuestro programa SIP con el cuel tendra acceso a difeentes modulos deacuerdo a su rol asignado, en caso de requerir permisos comunicarse con el administrador del sistema.</a></p>

			<div class="form-group">

				<label for="inputName" class="control-label">Nombre completo</label>

				<div>

					<input type="text" class="form-control" id="inputName" value="<?php echo $usuario["usudescrip"] ?>" readonly>

				</div>

			</div>

			<div class="form-group">

				<label for="inputEmail" class="control-label">Correo electrónico</label>

				<div>

					<input type="text" class="form-control" id="inputEmail" value="<?php echo $usuario["usuemail"] ?>" readonly>

				</div>

			</div>

			<div class="form-group">

				<label for="inputMovil" class="control-label">Teléfono Móvil</label>

				<div class="input-group">

					<div class="input-group-prepend">
						<span class="p-2 bg-info rounded-left dialCode">+57</span>
					</div>

					<input type="text" class="form-control" id="inputMovil" data-inputmask="'mask':'(999) 999-9999'" data-mask>

				</div>

			</div>


			<!--=====================================
			CONTRATO
			======================================-->

			<div class="clearfix"></div>

			<div id="terminos" class="form-group">
				<label for="inputMovil" class="control-label">Firma digital del usuario</label>

				<div id="signatureparent" class="mb-4">
					<div id="signature"></div>
				</div>
				<button type="button" class="repetirFirma btn btn-default btn-sm">Repetir firma</button>

			</div>


			<div class="form-group">
						<div class="col-sm-offset-2">
							<button type="submit" name="sava_registro" id="sava_registro" class="btn btn-dark suscribirse">Actualizar informacion</button>
						</div>

				<?php


				if (!$_POST) {
					$estado = "INACTIVE";
				} else {


					if (isset($_POST['sava_registro'])) {
						

					
							$estado = "ACTIVE";
						

						if ($estado == "ACTIVE") {

							$paypal = $usuario["usuemail"];
							$suscripcion = 1;
							$id_suscripcion = "FREE";
							$ciclo_pago = 1;

							$fechaInicial1 = getdate();
							//$fechaInicial = substr($fechaInicial1,0,-10);
							$fechaVencimiento = strtotime('+1 month', strtotime($fechaInicial));
							$vencimiento = date("Y-m-d", $fechaVencimiento);

							$enlace_afiliado = $_COOKIE["enlace_afiliado"];
							$pais = $_COOKIE["pais"];
							$codigo_pais = $_COOKIE["codigo_pais"];
							$telefono_movil = $_COOKIE["telefono_movil"];
							$firma = $_COOKIE["firma"];

							

							$datos = array(
								"id_usuario" => $usuario["id_usuario"],
								"suscripcion" => $suscripcion,
								"id_suscripcion" => $id_suscripcion,
								"ciclo_pago" => $ciclo_pago,
								"vencimiento" => "2021-01-01 22:08:00",
								"enlace_afiliado" => $enlace_afiliado,
								"patrocinador" => $confimarPatrocinador,
								"paypal" => $paypal,
								"pais" => $pais,
								"codigo_pais" => $codigo_pais,
								"telefono_movil" => $telefono_movil,
								"firma" => $firma,
								"fecha_contrato" => "2021-12-31 22:08:00"
							);

							echo '<pre>';
							print_r($datos);
							echo '</pre>';

							$iniciarSuscripcion = UserController::ctrIniciarSuscripcion($datos);

							if ($iniciarSuscripcion == "ok") {

								echo '<script>

									swal({
										type:"success",
										title: "¡¡Bienvenido!",
										text: "¡Bienvenido a Capital VAD La suscripción se ha hecho correctamente , Recomienda este proyecto a familiares y amigos.",
										showConfirmButton: true,
										confirmButtonText: "Cerrar"
									
									}).then(function(result){

										if(result.value){   
											window.location = "' . $ruta . 'backoffice/perfil";	
										} 
									});

									</script>';

								return;
							}
						} 
					}
				}

				?>




			</div>


		</div>

	</div>

</div>