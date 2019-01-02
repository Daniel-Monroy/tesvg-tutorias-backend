<?php 

require_once "../controladores/carrera.controlador.php";
require_once "../modelos/carrera.modelo.php";

/**
 * AjaxCarreras
 */
class AjaxCarreras
{

	# =========================================
	# MOSTRAR CARRERA
	# =========================================
	public $valor;

	public $item;

	public function ajaxMostrarCarrera(){

		$item = $this->item;

		$valor = $this->valor;

		$respuesta = ControladorCarreras::ctrMostrarCarreras($item, $valor);

		echo json_encode($respuesta);

	}

	# =========================================
	# EDITAR CARRERA
	# =========================================
	public $idEditarCarrera;

	public function ajaxEditarCarrera(){

		$item = "id";

		$valor = $this->idEditarCarrera;

		$respuesta = ControladorCarreras::ctrMostrarCarreras($item, $valor);

		echo json_encode($respuesta);

	}

}

# =========================================
# MOSTRAR CARRERA
# =========================================
if (isset($_POST["valor"])) {
	
	$valor = new AjaxCarreras();

	$valor -> item = $_POST["item"];

	$valor -> valor = $_POST["valor"];

	$valor -> ajaxMostrarCarrera();
}

# =========================================
# EDITAR CARRERA
# =========================================
if (isset($_POST["idEditarCarrera"])) {
	
	$idEditarCarrera = new AjaxCarreras();

	$idEditarCarrera -> idEditarCarrera = $_POST["idEditarCarrera"];

	$idEditarCarrera -> ajaxEditarCarrera();
}
