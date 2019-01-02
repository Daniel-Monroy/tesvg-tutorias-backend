<?php 

require_once "conexion.php";
/**
 * ModeloGrupos
 */
class ModeloGrupos
{
	
	# ========================================
	# =           MOSTRAR GRUPOS           =
	# ========================================
	static public function mdlMostrarGrupos($tabla, $item, $valor){

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

	# ======================
	# = GRUPOS POR CARRERA  =
	# ======================
	static public function mdlMostrarGruposCarrera($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	# ======================
	# = GRUPOS Y CARRERA   =
	# ======================
	static public function mdlMostrarGruposbyCarrera($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :$item1 AND $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);

		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	# ======================
	# = CREAR GRUPO   =
	# ======================
	static public function mdlCrearGrupo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, id_carrera) VALUES (:nombre, :id_carrera)");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt -> bindParam(":id_carrera", $datos["id_carrera"], PDO::PARAM_INT);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "false";
		}

		$stmt -> close();

		$stmt = null;

	}

	# ======================
	# = EDITAR GRUPO   =
	# ======================
	static public function mdlEditarGrupo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_carrera = :id_carrera WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt -> bindParam(":id_carrera", $datos["id_carrera"], PDO::PARAM_INT);

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "false";
		}

		$stmt -> close();

		$stmt = null;
	}


	# ======================
	# = ELIMINAR GRUPO    =
	# ======================
	static public function mdlEliminarGrupo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "false";
		}

		$stmt -> close();

		$stmt = null;
		
	}

}