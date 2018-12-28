<?php 

require_once "conexion.php";
/**
 * MODELO CATEGORÍAS
 */
class ModeloActividades
{
	
	# ==========================================
	# = MOSTRAR CATEGORÍAS           =
	# ==========================================
	static public function mdlMostrarActividades($tabla, $item, $valor){

		if ($item != null) {
		
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}	


		$stmt -> close();

		$stmt = null;

	}	

	# ==========================================
	# = INSERTAR CATEGORÍAS           =
	# ==========================================
	static public function mdlCrearActividades($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria, ruta) VALUES (:categoria, :ruta)");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);

		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "false";
		} 

		$stmt -> close();

		$stmt = null;

	}

	# ==========================================
	# = EDITAR CATEGORÍAS           =
	# ==========================================
	static public function mdlEditarActividades($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria, ruta = :ruta WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);

		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "false";
		} 

		$stmt -> close();

		$stmt = null;

	}

	# ==========================================
	# = BORRAR ACTIVIDAD           =
	# ==========================================
	static public function mdlBorrarActividad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";

		} else {

			return "false";
		} 

		$stmt -> close();

		$stmt = null;

	}




		
}