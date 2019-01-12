<?php 

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

/**
 * AjaxUsuarios
 */
class AjaxUsuarios 
{

	/*==================================
	= EVITAR USUARIO REPETIDO      =
	==================================*/
	public $validarUsuario;

	public function validarUsuario(){

		$item = "usuario";

		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}


	# ======================================
	# =           ACTIVAR USUARIO           =
	# ======================================
	public $idUsuarioActivar;

	public $estadoUsuarioActivar;

	public function ajaxActivarUsuario(){

		$tabla = "usuarios";
		
		$item1 = "estado";

		$valor1 = $this->estadoUsuarioActivar;

		$item2 = "id";

		$valor2 = $this->idUsuarioActivar;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);

	}


	# ======================================
	# = MOSTRAR USUARIO           =
	# ======================================
	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "id";

		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}


	# ======================================
	# = MOSTRAR PERFIL           =
	# ======================================
	public $idPerfil;

	public function ajaxMostrarPerfil(){

		$item = "id";

		$valor = $this->idPerfil;

		$respuesta = ControladorUsuarios::ctrMostrarPerfiles($item, $valor);

		echo json_encode($respuesta);

	}

}		
	

# ======================================
# =           EDITAR USUARIO           =
# ======================================

if(isset($_POST["idUsuario"])){

	$editar = new AjaxUsuarios();

	$editar -> idUsuario = $_POST["idUsuario"];

	$editar -> ajaxEditarUsuario();

}


# ======================================
# =           ACTIVAR USUARIO           =
# ======================================
if (isset($_POST["idUsuarioActivar"])) {
	
	$activar = new AjaxUsuarios();

	$activar -> idUsuarioActivar = $_POST["idUsuarioActivar"];

	$activar -> estadoUsuarioActivar = $_POST["estadoUsuarioActivar"];

	$activar -> ajaxActivarUsuario();
}


/*==================================
= EVITAR USUARIO REPETIDO      =
==================================*/
if (isset($_POST["validarUsuario"])) {
	
	$validar = new AjaxUsuarios();

	$validar -> validarUsuario = $_POST["validarUsuario"];

	$validar -> validarUsuario();

}


# ============================
# =  MOSTRAR PERFIL          =
# ============================
if(isset($_POST["idPerfil"])){

	$perfil = new AjaxUsuarios();

	$perfil -> idPerfil = $_POST["idPerfil"];

	$perfil -> ajaxMostrarPerfil();

}
