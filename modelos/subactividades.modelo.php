<?php 

require_once "conexion.php";

/**
 * Modelo Sub-Actividades
 */
class ModeloSubActividades
{

	# ============================
	# = MOSTRAR SUB-ACTIVIDADES  =
	# ============================
	static public function mdlMostrarSubActividades($tabla, $item, $valor){

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
	# = INSERTAR SUBACTIVIDADES           =
	# ==========================================
	static public function mdlCrearSubActividades($tabla, $datos){

		$stmt = Conexion::conectar()->prepare(

		"INSERT INTO $tabla(id_actividad, id_tutor, ruta, ruta_archivo, nombre, objetivo, imagen, textoAyuda, actividades) VALUES (:id_actividad, :id_tutor, :ruta, :ruta_archivo, :nombre, :objetivo, :imagen, :textoAyuda, :actividades)");

		$stmt -> bindParam(":id_actividad", $datos["id_actividad"], PDO::PARAM_INT);

		$stmt -> bindParam(":id_tutor", $datos["id_tutor"], PDO::PARAM_INT);

		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

		$stmt -> bindParam(":ruta_archivo", $datos["ruta_archivo"], PDO::PARAM_STR);

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt -> bindParam(":objetivo", $datos["objetivo"], PDO::PARAM_STR);

		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

		$stmt -> bindParam(":textoAyuda", $datos["textoAyuda"], PDO::PARAM_STR);

		$stmt -> bindParam(":actividades", $datos["actividades"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "false";
		} 

		$stmt -> close();

		$stmt = null;

	}


	# ==========================================
	# = EDITAR SUBACTIVIDADES           =
	# ==========================================
	static public function mdlEditarSubActividades($tabla, $datos){

		$stmt = Conexion::conectar()->prepare(

		"UPDATE $tabla SET id_actividad = :id_actividad, id_tutor = :id_tutor, ruta = :ruta, ruta_archivo = :ruta_archivo, nombre = :nombre, objetivo = :objetivo, imagen = :imagen, textoAyuda = :textoAyuda, actividades = :actividades WHERE id = :id");

		$stmt -> bindParam(":id_actividad", $datos["id_actividad"], PDO::PARAM_INT);

		$stmt -> bindParam(":id_tutor", $datos["id_tutor"], PDO::PARAM_INT);

		$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);

		$stmt -> bindParam(":ruta_archivo", $datos["ruta_archivo"], PDO::PARAM_STR);

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt -> bindParam(":objetivo", $datos["objetivo"], PDO::PARAM_STR);

		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);

		$stmt -> bindParam(":textoAyuda", $datos["textoAyuda"], PDO::PARAM_STR);
		
		$stmt -> bindParam(":actividades", $datos["actividades"], PDO::PARAM_STR);

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "false";
		} 

		$stmt -> close();

		$stmt = null;

	}


	# ============================
	# = MOSTRAR SUB-ACTIVIDADES POR CATEGORIA =
	# ============================
	static public function mdlMostrarSubActividadesCategoria($tabla, $item, $valor){

		if ($item != null) {
		
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}	


		$stmt -> close();

		$stmt = null;

	}



	# ======================================
	# = BORRAR SUB-ACTIVIDAD       =
	# ======================================
	static public function mdlBorrarSubActividad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam("id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		
		} else {
		
			return "false";
		
		}

		$stmt -> close();

		$stmt = null;


	}

	# ==========================================
	# MOSTRAR COMENTARIOS ACTIVIDADES REALIZADAS
	# ==========================================
	static public function mdlMostrarComentariosSubActividades($tabla, $item, $valor){

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

	# ==========================================
	# ACTUALIZAR COMENTARIO ACTIVIDADES REALIZADAS
	# ==========================================
	static public function mdlActualizarComentarioSubActividad($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);

		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt -> execute();

		return "ok";

		$stmt -> close();

		$stmt = null;

	}

	# ==================================
    # =MOSTRAR MOSTRAR SUB-ACTIVIDADES 
    # ==================================
    static public function mdlMostrarSubActividadesRealizadas($tabla, $item, $valor, $ordenar, $modo, $base, $tope){

       if ($item != null) {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $ordenar $modo LIMIT $base, $tope");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

      } else {

          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");

          $stmt -> execute();

          return $stmt -> fetchAll();

        }

         $stmt -> close();

         $stmt = null;

    }


    # ===========================
    # =MOSTRAR SUB-ACTIVIDADES  =
    # ===========================
    static public function mdlMostrarTodasSubActividades($tabla, $item, $valor){

      if ($item != null) {
              
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll(); 

        } else {

          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

          $stmt -> execute();

          return $stmt -> fetchAll(); 

        }

        $stmt -> close();

        $stmt = null;

    }


    # ===================================
	# =MOSTRAR SUB-ACTIVIDADES PENDIENTES
	# ===================================
    static public function mdlMostrarSubActividadesPendientes($tabla, $item, $valor){

      if ($item != null) {
              
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetchAll(); 

        } else {

          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

          $stmt -> execute();

          return $stmt -> fetchAll(); 

        }

        $stmt -> close();

        $stmt = null;

    }



}