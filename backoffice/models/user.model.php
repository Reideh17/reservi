<?php

require_once "conexion.php";

class UserModel{

	/*=============================================
	Registro de usuarios
	=============================================*/

	static public function mdlRegistroUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(genrol, usunombre, usudescrip, usuclave, usuemail, usuemailen, usuverific) VALUES (:genrol, :usunombre, :usudescrip, :usuclave, :usuemail, :usuemailen, :usuverific)");

		$stmt->bindParam(":genrol", $datos["genrol"], PDO::PARAM_STR);
		$stmt->bindParam(":usunombre", $datos["usunombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usudescrip", $datos["usudescrip"], PDO::PARAM_STR);
		$stmt->bindParam(":usuclave", $datos["usuclave"], PDO::PARAM_STR);
		$stmt->bindParam(":usuemail", $datos["usuemail"], PDO::PARAM_STR);
		$stmt->bindParam(":usuemailen", $datos["usuemailen"], PDO::PARAM_STR);
		$stmt->bindParam(":usuverific", $datos["usuverific"], PDO::PARAM_STR);		

		

		if($stmt->execute()){

			
			return "ok";

		}else{
			
			return print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Registro de primer movimiento de inverson 
	=============================================*/

	static public function mdlRegistroMovimientoInversion($tabla, $datos_inv){		

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_inversion, monto, tipo_movimiento, fecha_movimiento) VALUES (:id_inversion, :monto, :tipo_movimiento, :fecha_movimiento) ");	

		$stmt->bindParam(":id_inversion", $datos_inv["id_inversion"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos_inv["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_movimiento", $datos_inv["tipo_movimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_movimiento", $datos_inv["fecha_movimiento"], PDO::PARAM_STR);
		

		//echo '<pre>'; print_r($stmt); echo '</pre>';

		if($stmt->execute()){

			
			return "ok";

		}else{
			
			return print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Registro de usuarios en el plan de inversion
	=============================================*/

	static public function mdlRegistroInversion($tabla, $datos_inv){		

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha_solicitud, id_usuario, email_fondos, monto, plan_inversion, fecha_final, soporte, estado, fecha_apobacion, id_user_aprobo, observacion) VALUES (:fecha_solicitud, :id_usuario, :email_fondos, :monto, :plan_inversion, :fecha_final, :soporte, :estado, :fecha_apobacion, :id_user_aprobo, :observacion)");	

		$stmt->bindParam(":fecha_solicitud", $datos_inv["fecha_solicitud"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos_inv["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":email_fondos", $datos_inv["email_fondos"], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos_inv["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":plan_inversion", $datos_inv["plan_inversion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_final", $datos_inv["fecha_final"], PDO::PARAM_STR);
		$stmt->bindParam(":soporte", $datos_inv["soporte"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos_inv["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_apobacion", $datos_inv["fecha_apobacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_user_aprobo", $datos_inv["id_user_aprobo"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos_inv["observacion"], PDO::PARAM_STR);

		//echo '<pre>'; print_r($stmt); echo '</pre>';

		if($stmt->execute()){

			
			return "ok";

		}else{
			
			return print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Mostrar Usuarios
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt-> close();

		$stmt = null;

	}

/*=============================================
	Mostrar Inversiones por usuario
	=============================================*/

	static public function mdlMostrarInversionesPorUsuario($tabla1, $tabla2, $item, $valor, $id_user){

		$stmt = Conexion::conectar()->prepare("SELECT A.`id_inversion`,A.`id_usuario`, B.`nombre`,A.`email_fondos`,A.`monto`,A.`plan_inversion`, A.`estado`, A.`observacion`
		FROM $tabla2 AS A INNER JOIN 
			 $tabla1 AS B ON A. `id_usuario` = B. `id_usuario`
		WHERE A.`id_usuario` = $id_user");

		$stmt -> execute();

		return $stmt -> fetchAll();

	

	$stmt-> close();

	$stmt = null;

}



	/*=============================================
	Mostrar Inversiones por aprobar
	=============================================*/

	static public function mdlMostrarInversionesPorArpobar($tabla1, $tabla2, $item, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT A.`id_inversion`,A.`id_usuario`, B.`nombre`,A.`email_fondos`,A.`monto`,A.`plan_inversion`, A.`estado`
			FROM $tabla2 AS A INNER JOIN 
				 $tabla1 AS B ON A. `id_usuario` = B. `id_usuario`
			WHERE A.`estado` = 1");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Datos de la inverion por id
	=============================================*/

	static public function mdlMostrardatosInversionesPorId($tabla1, $tabla2, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT A.`id_inversion` , B.`nombre`, A.`email_fondos`, A.`monto`, A.`plan_inversion`
			FROM  $tabla1 A INNER JOIN 
				  $tabla2 AS B ON A.`id_usuario` = B.`id_usuario` where `id_inversion` = $valor");

		$stmt -> execute();

		return $stmt -> fetch();

	

	$stmt-> close();

	$stmt = null;

}






	/*=============================================
	Mostrar archio de Inversiones por aprobar
	=============================================*/

	static public function mdlMostrarInversionesPorArpobarxArchivo($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT `soporte` FROM $tabla where `id_inversion` = $valor");

		$stmt -> execute();

		return $stmt -> fetch();

	

	$stmt-> close();

	$stmt = null;

}

	/*=============================================
	Actualizar Solicitud de inversion 
	=============================================*/

	static public function mdlUpdateSolicitudInversion($tabla, $datos_inv, $id){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado, fecha_apobacion = :fecha_apobacion, id_user_aprobo = :id_user_aprobo, observacion = :observacion WHERE id_inversion = :id_inversion");

		$stmt -> bindParam(":estado", $datos_inv["estado"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_apobacion", $datos_inv["fecha_apobacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_user_aprobo", $datos_inv["id_user_aprobo"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos_inv["observacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_inversion", $id, PDO::PARAM_INT);

		//print_r($stmt);

		if($stmt -> execute()){

			return "ok";

		}else{

			return print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;
		
	}





	/*=============================================
	Actualizar usuario
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $id, $item, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE oid = :oid");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":oid", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;
		
	}

/*=============================================
	Iniciar Suscripción
	=============================================*/

	static public function mdlIniciarSuscripcion($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET suscripcion = :suscripcion, id_suscripcion = :id_suscripcion, ciclo_pago = :ciclo_pago, vencimiento = :vencimiento,  enlace_afiliado = :enlace_afiliado, patrocinador = :patrocinador, paypal = :paypal, pais = :pais, codigo_pais = :codigo_pais, telefono_movil = :telefono_movil, firma = :firma, fecha_contrato = :fecha_contrato  WHERE id_usuario = :id_usuario");

		//echo "valor :".$datos["suscripcion"];
		//print_r($stmt);

		$stmt -> bindParam(":suscripcion", $datos["suscripcion"], PDO::PARAM_STR);
		//print_r($stmt);
		$stmt -> bindParam(":id_suscripcion", $datos["id_suscripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ciclo_pago", $datos["ciclo_pago"], PDO::PARAM_STR);
		$stmt -> bindParam(":vencimiento", $datos["vencimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":enlace_afiliado", $datos["enlace_afiliado"], PDO::PARAM_STR);
		$stmt -> bindParam(":patrocinador", $datos["patrocinador"], PDO::PARAM_STR);
		$stmt -> bindParam(":paypal", $datos["paypal"], PDO::PARAM_STR);
		$stmt -> bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo_pais", $datos["codigo_pais"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono_movil", $datos["telefono_movil"], PDO::PARAM_STR);
		$stmt -> bindParam(":firma", $datos["firma"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_contrato", $datos["fecha_contrato"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return print_r(Conexion::conectar()->errorInfo());
		}

		$stmt-> close();

		$stmt = null;
	}

	/*=============================================
	Cancelar Suscripción
	=============================================*/

	static public function mdlCancelarSuscripcion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  suscripcion = :suscripcion, ciclo_pago = :ciclo_pago, firma = :firma, fecha_contrato = :fecha_contrato WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":suscripcion", $datos["suscripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ciclo_pago", $datos["ciclo_pago"], PDO::PARAM_STR);
		$stmt -> bindParam(":firma", $datos["firma"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_contrato", $datos["fecha_contrato"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return print_r(Conexion::conectar()->errorInfo());		

		}

		$stmt-> close();

		$stmt = null;

	}



} // fin del modelo 
