<?php 

require_once "../controladores/subactividades.controlador.php";

require_once "../modelos/subactividades.modelo.php";

/**
 * Ajax SubActividades
 */
class AjaxSubActividades 
{
	
	# ========================================
	# =  VALIDAR ACTIVIDAD REPEDITiDA      =
	# ========================================	
	public  $subactividadValidar;

	public function validarSubActividad(){

		$item = "nombre";

		$valor = $this->subactividadValidar;

		$respuesta = ControladorSubActividades::ctrMostrarSubActividades($item, $valor);

	 	echo json_encode($respuesta);

	}
	
}

# ========================================
# =  VALIDAR ACTIVIDAD REPEDITIDA        =
# ========================================	
if (isset($_POST["subactividadValidar"])) {
	
	$subactividadValidar = new AjaxSubActividades();

	$subactividadValidar -> subactividadValidar = $_POST["subactividadValidar"];

	$subactividadValidar -> validarSubActividad();
}