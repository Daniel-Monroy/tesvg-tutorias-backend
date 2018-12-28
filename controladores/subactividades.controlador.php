<?php 

/**
 * Controlador Sub-Actividades
 */
class ControladorSubActividades
{
	
	# ============================
	# = MOSTRAR SUB-ACTIVIDADES  =
	# ============================
	static public function ctrMostrarSubActividades($item, $valor){

		$tabla = "sub_actividades";

		$respuesta = ModeloSubActividades::mdlMostrarSubActividades($tabla, $item, $valor);

		return $respuesta;
	}
	
}