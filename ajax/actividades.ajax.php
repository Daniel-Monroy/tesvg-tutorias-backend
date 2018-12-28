<?php 

require_once "../controladores/actividades.controlador.php";

require_once "../modelos/actividades.modelo.php";

/**
 * Ajax Actividades
 */
class AjaxActividades 
{
	
	# ========================================
	# =           EDITAR CATEGORÍA           =
	# ========================================	
	public $idActividad;

	public function editarActividad() {

		$item = "id";

		$valor = $this->idActividad;

		$respuesta = ControladorActividades::ctrMostrarActividades($item, $valor);

		echo json_encode($respuesta);
	}


	# ========================================
	# =  VALIDAR ACTIVIDAD REPEDITiDA      =
	# ========================================	
	public  $actividadValidar;

	public function validarActividad(){

		$item = "categoria";

		$valor = $this->actividadValidar;

		$respuesta = ControladorActividades::ctrMostrarActividades($item, $valor);

	 	echo json_encode($respuesta);

	}
	
}



# ========================================
# =           EDITAR ACTIVIDAD           =
# ========================================	
if (isset($_POST["idActividad"])) {
	
	$editarActividad = new AjaxActividades();

	$editarActividad -> idActividad = $_POST["idActividad"];

	$editarActividad -> editarActividad();
}


# ========================================
# =  VALIDAR ACTIVIDAD REPEDITIDA        =
# ========================================	
if (isset($_POST["actividadValidar"])) {
	
	$actividadValidar = new AjaxActividades();

	$actividadValidar -> actividadValidar = $_POST["actividadValidar"];

	$actividadValidar -> validarActividad();
}