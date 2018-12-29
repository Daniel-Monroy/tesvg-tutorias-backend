<?php 

/**
 * AlumnosControlador
 */
class ControladorAlumnos
{
	# ======================
	# = MOSTRAR ALUMNO    =
	# ======================
	static public function ctrMostrarAlumnos($item, $valor){

		$tabla = "alumnos";

		$respuesta = ModeloAlumnos::mdlMostrarAlumnos($tabla, $item, $valor);

		return $respuesta;

	}
}