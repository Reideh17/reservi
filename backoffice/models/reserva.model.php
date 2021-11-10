<?php

require_once "conexion.php";

class ReservaModel
{

    
	/*=============================================
	Registro de usuarios
	=============================================*/

	static public function mdlRegistroReserva($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, codigo_reserva, descripcion_reserva, fecha_ingreso, fecha_salida) VALUES (:id_usuario, :codigo_reserva, :descripcion_reserva, :fecha_ingreso, :fecha_salida)");

		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_reserva", $datos["codigo_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_reserva", $datos["descripcion_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_salida", $datos["fecha_salida"], PDO::PARAM_STR);
		/*$stmt->bindParam(":fecha_reserva", $datos["fecha_reserva"], PDO::PARAM_STR);*/
			
        
		if($stmt->execute()){
			
			return "ok";

		}else{
			
			return print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;


    }

} // fin de la calse modelo