<?php 

require_once "conexion.php";

/**
 * ModeloAlumnos
 */
class ModeloAlumnos
{
	
	# ========================================
	# =           MOSTRAR ALUMNOS           =
	# ========================================
	static public function mdlMostrarAlumnos($tabla, $item, $valor){

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

    # ========================================
	# =           INSERTAR ALUMNO          =
	# ========================================
	static public function mdlNuevoAlumno($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellidos, numeroControl, carrera, grupo, email, password, activo, foto, verificacion, modo, emailEncriptado) VALUES (:nombre, :apellidos, :numeroControl, :carrera, :grupo, :email, :password, :activo, :foto, :verificacion, :modo, :emailEncriptado)");

		$stmt -> bindParam("nombre", $datos["nombre"], PDO::PARAM_STR);
		
		$stmt -> bindParam("apellidos", $datos["apellidos"], PDO::PARAM_STR);
		
		$stmt -> bindParam("numeroControl", $datos["numeroControl"], PDO::PARAM_STR);
		
		$stmt -> bindParam("carrera", $datos["carrera"], PDO::PARAM_STR);
		
		$stmt -> bindParam("grupo", $datos["grupo"], PDO::PARAM_STR);
		
		$stmt -> bindParam("email", $datos["email"], PDO::PARAM_STR);
		
		$stmt -> bindParam("password", $datos["password"], PDO::PARAM_STR);

		$stmt -> bindParam("activo", $datos["activo"], PDO::PARAM_STR);
		
		$stmt -> bindParam("foto", $datos["foto"], PDO::PARAM_STR);
		
		$stmt -> bindParam("verificacion", $datos["verificacion"], PDO::PARAM_STR);
		
		$stmt -> bindParam("modo", $datos["modo"], PDO::PARAM_STR);
		
		$stmt -> bindParam("emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);
	
		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";
		}

		$stmt -> close();

		$stmt = null;

	}

	# ========================================
	# =           EDITAR ALUMNO          =
	# ========================================
	static public function mdlEditarAlumno($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellidos = :apellidos, numeroControl = :numeroControl, carrera = :carrera, grupo = :grupo, email = :email, password = :password, activo = :activo, foto = :foto, verificacion = :verificacion, modo = :modo, emailEncriptado = :emailEncriptado WHERE id = :id");

		$stmt -> bindParam("nombre", $datos["nombre"], PDO::PARAM_STR);
		
		$stmt -> bindParam("apellidos", $datos["apellidos"], PDO::PARAM_STR);
		
		$stmt -> bindParam("numeroControl", $datos["numeroControl"], PDO::PARAM_STR);
		
		$stmt -> bindParam("carrera", $datos["carrera"], PDO::PARAM_STR);
		
		$stmt -> bindParam("grupo", $datos["grupo"], PDO::PARAM_STR);
		
		$stmt -> bindParam("email", $datos["email"], PDO::PARAM_STR);
		
		$stmt -> bindParam("password", $datos["password"], PDO::PARAM_STR);

		$stmt -> bindParam("activo", $datos["activo"], PDO::PARAM_STR);
		
		$stmt -> bindParam("foto", $datos["foto"], PDO::PARAM_STR);
		
		$stmt -> bindParam("verificacion", $datos["verificacion"], PDO::PARAM_STR);
		
		$stmt -> bindParam("modo", $datos["modo"], PDO::PARAM_STR);
		
		$stmt -> bindParam("emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);

		$stmt -> bindParam("id", $datos["id"], PDO::PARAM_INT);
	
		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";
		}

		$stmt -> close();

		$stmt = null;

	}



	# ======================================
	# = ACTUALIZAR ALUMNO       =
	# ======================================
	static public function mdlActualizarAlumno($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);

		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt -> execute();

		return "ok";

		$stmt -> close();

		$stmt = null;

	}




}