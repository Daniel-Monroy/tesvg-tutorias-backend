<?php 

require_once "../controladores/alumnos.controlador.php";
require_once "../modelos/alumnos.modelo.php";
require_once "../modelos/subactividades.modelo.php";

/**
 * AjaxAlumnos
 */
class AjaxAlumnos
{

	/*==================================
	= EDITAR ALUMNO      =
	==================================*/
	public $idAlumnoEditar;

	public function ajaxEditarAlumno(){

		$item = "id";

		$valor = $this->idAlumnoEditar;

		$respuesta = ControladorAlumnos::ctrMostrarAlumnos($item, $valor);

		echo json_encode($respuesta);

	}

	/*==================================
	= EVITAR ALUMNO REPETIDO      =
	==================================*/
	public $validarNumeroControl;

	public function validarNumeroControl(){

		$item = "numeroControl";

		$valor = $this->validarNumeroControl;

		$respuesta = ControladorAlumnos::ctrMostrarAlumnos($item, $valor);

		echo json_encode($respuesta);

	}

	/*==================================
	= EVITAR CORREO REPETIDO      =
	==================================*/
	public $validarEmail;

	public function validarEmail(){

		$item = "email";

		$valor = $this->validarEmail;

		$respuesta = ControladorAlumnos::ctrMostrarAlumnos($item, $valor);

		echo json_encode($respuesta);

	}

	# ======================================
	# =           ACTIVAR ALUMNO           =
	# ======================================
	public $idAlumnoActivar;

	public $estadoAlumnoActivar;

	public function ajaxActivarAlumno(){

		$tabla = "alumnos";
		
		$item1 = "activo";

		$valor1 = $this->estadoAlumnoActivar;

		$item2 = "id";

		$valor2 = $this->idAlumnoActivar;

		$respuesta = ModeloAlumnos::mdlActualizarAlumno($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);

	}

	# ========================================
	# COMENTARIOS A LAS ACTIVIDADES REALIZADAS
	# ========================================
	public $idComentario;

	public $estadoActividad;

	public function ajaxComentarioSubActividad(){

		$tabla = "comentarios_actividad";

		$item1 = "estadoActividad";

		$valor1 = $this->estadoActividad;

		$item2 = "id";
		
		$valor2 = $this->idComentario;

		$respuesta = ModeloSubActividades::mdlActualizarComentarioSubActividad($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);

	}


}		
	
/*==================================
= EVITAR USUARIO REPETIDO      =
==================================*/
if (isset($_POST["validarNumeroControl"])) {
	
	$validarNumeroControl = new AjaxAlumnos();

	$validarNumeroControl -> validarNumeroControl = $_POST["validarNumeroControl"];

	$validarNumeroControl -> validarNumeroControl();

}

/*==================================
= EVITAR EMAIL REPETIDO      =
==================================*/
if (isset($_POST["validarEmail"])) {
	
	$validarEmail = new AjaxAlumnos();

	$validarEmail -> validarEmail = $_POST["validarEmail"];

	$validarEmail -> validarEmail();

}


# ======================================
# =           ACTIVAR ALUMNO           =
# ======================================
if (isset($_POST["idAlumnoActivar"])) {
	
	$activarAlumno = new AjaxAlumnos();

	$activarAlumno -> idAlumnoActivar = $_POST["idAlumnoActivar"];

	$activarAlumno -> estadoAlumnoActivar = $_POST["estadoAlumnoActivar"];

	$activarAlumno -> ajaxActivarAlumno();
}


# ======================================
# =           EDITAR ALUMNO           =
# ======================================
if (isset($_POST["idAlumno"])) {
	
	$idAlumnoEditar = new AjaxAlumnos();

	$idAlumnoEditar -> idAlumnoEditar = $_POST["idAlumno"];

	$idAlumnoEditar -> ajaxEditarAlumno();
}


# ========================================
# COMENTARIOS A LAS ACTIVIDADES REALIZADAS
# ========================================
if (isset($_POST["idComentario"])) {
	
	$actividadRevisada = new AjaxAlumnos();

	$actividadRevisada -> idComentario = $_POST["idComentario"];

	$actividadRevisada -> estadoActividad = $_POST["estadoActividad"];

	$actividadRevisada -> ajaxComentarioSubActividad();
}	