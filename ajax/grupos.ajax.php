<?php 

require_once "../controladores/grupos.controlador.php";
require_once "../modelos/grupos.modelo.php";

/**
 * AjaxGrupos
 */
class AjaxGrupos
{


	# =========================================
	# EVITAR GRUPO REPETIDO EN LA MISMA CARRERA
	# =========================================
	public $idCarrera;

	public $nombreGrupo;

	public function ajaxNuevoGrupo(){

		 $item1 = "nombre";
		 
		 $valor1 = $this->nombreGrupo;

		 $item2 = "id_carrera";

		 $valor2 = $this->idCarrera;

		 $respuesta = ControladorGrupos::ctrMostrarGruposbyCarrera($item1, $valor1, $item2, $valor2);

		 echo json_encode($respuesta);	

	}


	# =========================================
	# MOSTRAR GRUPO
	# =========================================
	public $idGrupo;

	public function ajaxMostrarGrupo(){

		$item = "id";

		$valor = $this->idGrupo;

		$respuesta = ControladorGrupos::ctrMostrarGrupos($item, $valor);

		echo json_encode($respuesta);

	}

	# =========================================
	# MOSTRAR GRUPOS POR CARRERAS
	# =========================================
	public $idCarreraGrupo;

	public function ajaxMostrarGrupoCarrera(){

		$item = "id_carrera";

		$valor = $this->idCarreraGrupo;

		$respuesta = ControladorGrupos::ctrMostrarGruposCarrera($item, $valor);

		echo json_encode($respuesta);

	}

}


# =========================================
# EVITAR GRUPO REPETIDO EN LA MISMA CARRERA
# =========================================
if (isset($_POST["nombreGrupo"])) {
	
	$nombreGrupo = new AjaxGrupos();

	$nombreGrupo -> nombreGrupo = $_POST["nombreGrupo"];

	$nombreGrupo -> idCarrera = $_POST["idCarrera"];

	$nombreGrupo -> ajaxNuevoGrupo();
}


# ===============
# MOSTRAR GRUPOS
# ===============
if (isset($_POST["idGrupo"])) {
	
	$idGrupo = new AjaxGrupos();

	$idGrupo -> idGrupo = $_POST["idGrupo"];

	$idGrupo -> ajaxMostrarGrupo();
}


# ===============
# MOSTRAR GRUPOS POR CARRERAS
# ===============
if (isset($_POST["idCarrera"])) {
	
	$idCarreraGrupo = new AjaxGrupos();

	$idCarreraGrupo -> idCarreraGrupo = $_POST["idCarrera"];

	$idCarreraGrupo -> ajaxMostrarGrupoCarrera();
}
