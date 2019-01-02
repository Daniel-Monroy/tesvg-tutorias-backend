<?php 
require_once "conexion.php";
/**
 * ModeloCarreras
 */
class ModeloCarreras
{
	
	# ==============================
	# = MOSTRAR CARRERAS           =
	# ==============================
	static public function mdlMostrarCarreras($tabla, $item, $valor){

		if ($item != null){ 

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

	# ====================
	# = INSERTAR CARRERAS=
	# ====================
	static public function mdlCrearCarrera($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(carrera, descripcion, id_jefe, id_coordinador) VALUES (:carrera, :descripcion, :id_jefe, :id_coordinador)");

		$stmt -> bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);

		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		$stmt -> bindParam(":id_jefe", $datos["id_jefe"], PDO::PARAM_INT);
	
		$stmt -> bindParam(":id_coordinador", $datos["id_coordinador"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "false";
		} 

		$stmt -> close();

		$stmt = null;

	}


	# ===================
	# = EDITAR CARRERAS 
	# ===================
	static public function mdlEditarCarrera($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET carrera = :carrera, descripcion = :descripcion, id_jefe = :id_jefe, id_coordinador = :id_coordinador WHERE id = :id");

		$stmt -> bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);

		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		$stmt -> bindParam(":id_jefe", $datos["id_jefe"], PDO::PARAM_INT);
	
		$stmt -> bindParam(":id_coordinador", $datos["id_coordinador"], PDO::PARAM_INT);

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "false";
		} 

		$stmt -> close();

		$stmt = null;

	}


	# ======================================
	# = BORRAR CARRERA       =
	# ======================================
	static public function mdlBorrarCarrera($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam("id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		
		} else {
		
			return "false";
		
		}

		$stmt -> close();

		$stmt = null;


	}

}