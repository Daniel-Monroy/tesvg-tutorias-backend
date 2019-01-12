<?php

/**
 * Controlador Usuarios
 */
class ControladorUsuarios
{
	
	# ======================
	# = INGRESO USUARIO    =
	# ======================
	static public function ctrIngresoUsuario(){

		if (isset($_POST["ingUsuario"])) {
			
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"] ) && (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"] ))) {

				
				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxy54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "usuario";

				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

				if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar ) {
					

					if ($respuesta["estado"] == 1) {
						

						echo '
						<br> 
						<div class="alert alert-success">Bienvenido <span class="text-uppercase"> '.$respuesta["nombre"].' </span> al sistema</div>
						';

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["apellidos"] = $respuesta["apellidos"];
						$_SESSION["profesion"] = $respuesta["profesion"];
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						# ===============================================================
						# =           REGISTRAR FECHA Y HORA DEL ULTIMO LOGIN           =
						# ===============================================================
						
						date_default_timezone_set('America/Mexico_City');
						
						$fecha = date('Y-m-d'); 

						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";

						$valor1 = $fechaActual;

						$item2 = "id";

						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if ($ultimoLogin == "ok") {
						
							echo ' <script> window.location = "inicio"; </script> ';
						
						}

					} else {

						echo '
						<br> 
						<div class="alert alert-danger">El usuario <span class="text-uppercase"> '.$respuesta["usuario"].' </span> no ésta activado</div>
						';


					}

					
				} else {
					echo '
						<br> 
						<div class="alert alert-danger"> Error al Ingresar, vuelve a intentarlo</div>
					';
				}

			}

		}	

	}

	# ======================
	# = CREAR USUARIO     =
	# ======================
	static public function ctrCrearUsuario(){

		if (isset($_POST["nuevoUsuario"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevosApellidos"]) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) &&
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaProfesion"])) {
				
				$ruta = "";
				#=======================
				#= VALIDAR IMAGEN      =
				#=======================
				if (isset($_FILES["nuevaFoto"]["tmp_name"])) {
					
					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;

					$nuevoAlto = 500;

					# =======================
					# = Crear Directorio para guardar la IMG      =
					# =======================
					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					# ======================================================================================
					# =           DE ACUERDO EL TIPO DE ARCHIVO USAMOS EL MÉTODO CORRESPONDIENTE           =
					# ======================================================================================
					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
					
						# =======================
						# = Guardo la imagen en el directorio      =
						# =======================

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

						imagejpeg($destino, $ruta);

					}	

					if ($_FILES["nuevaFoto"]["type"] == "image/png") {
					
						# =======================
						# = Guardo la imagen en el directorio      =
						# =======================

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

						imagepng($destino, $ruta);

					}						
					
				}

				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxy54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array('nombre' => $_POST["nuevoNombre"],
							   'apellidos' => $_POST["nuevosApellidos"],  
							   'usuario' => $_POST["nuevoUsuario"], 
							   'profesion' => $_POST["nuevaProfesion"], 
							   'password' => $encriptar, 
							   'estado' => 0, 
							   'perfil' => $_POST["nuevoPerfil"], 
							   'foto' => $ruta
							);

				$respuesta = ModeloUsuarios::mdlNuevoUsuario($tabla, $datos);

				var_dump($respuesta);	

				if ($respuesta == "ok") {
					
					echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Genial!",
								text: "Tutor Almacenado con exito",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "tutores";
								}
							});
						</script>
					 ';

				}

			} else {

				echo ' 
					<script> 
						swal({
							type: "error",
							title: "!Error!",
							text: "Todos los campos son Obligatorios y no se permiten caracteres especiales",	
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeConfirmButton: false
						}).then((result)=>{
							if(result.value){
								window.location = "tutores";
							}
						});
					</script>
				 ';

			}

		}

	}

	# ======================
	# = MOSTRAR USUARIO    =
	# ======================
	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}


	# ======================
	# = MOSTRAR USUARIOS    =
	# ======================
	static public function ctrMostrarVariosUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarVariosUsuarios($tabla, $item, $valor);

		return $respuesta;

	}

	# ======================
	# = MOSTRAR PERFILEs    =
	# ======================
	static public function ctrMostrarPerfiles($item, $valor){

		$tabla = "perfiles";

		$respuesta = ModeloUsuarios::mdlMostrarPerfiles($tabla, $item, $valor);

		return $respuesta;

	}

	# ======================================
	# =  EDITAR USUARIO           =
	# ======================================
	public function ctrEditarUsuario(){

		if (isset($_POST["editarUsuario"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && 
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidos"]) && 
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProfesion"])) {
			
				$ruta = $_POST["fotoActual"];
				# =======================
				# = VALIDAR IMAGEN      =
				# =======================
				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {
					
					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;

					$nuevoAlto = 500;

					# =======================
					# = Crear Directorio para guardar la IMG      =
					# =======================
					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					# ====================================================================================
					# =           PRIMERO PREGUNTAMOS SI EXISTE UNA IMAGEN EN LA BASE DE DATOS           =
					# ====================================================================================
					if (!empty($_POST["fotoActual"])) {
						
						unlink($_POST["fotoActual"]);
					
					} else {

						mkdir($directorio, 0755);
				
					}
	
					# ======================================================================================
					# =           DE ACUERDO EL TIPO DE ARCHIVO USAMOS EL MÉTODO CORRESPONDIENTE           =
					# ======================================================================================
					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
					
						# =======================
						# = Guardo la imagen en el directorio      =
						# =======================

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

						imagejpeg($destino, $ruta);

					}	

					if ($_FILES["editarFoto"]["type"] == "image/png") {
					
						# =======================
						# = Guardo la imagen en el directorio      =
						# =======================

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

						imagepng($destino, $ruta);

					}

				}	

				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {
					
					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
					
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxy54ahjppf45sd87a5a4dDDGsystemdev$');

					} else {

						echo ' 
						<script> 
							swal({
								type: "error",
								title: "!Error!",
								text: "La contraseña no puede ir vacía y no se permiten caracteres especiales",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "tutores";
								}
							});
						</script>
					 	';
					}	

				} else {

					$encriptar = $_POST["passwordActual"];
				
				} 

				$datos = array(
						   'id' => $_POST["idTutor"],
						   'nombre' => $_POST["editarNombre"],
						   'apellidos' => $_POST["editarApellidos"],  
						   'usuario' => $_POST["editarUsuario"], 
						   'profesion' => $_POST["editarProfesion"], 
						   'password' => $encriptar, 
						   'estado' => 0, 
						   'perfil' => $_POST["editarPerfil"], 
						   'foto' => $ruta
						);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Exelente!",
								text: "El usuario ha sido editado correctamente",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "tutores";
								}
							});
						</script>
					 	';
				}

			} else {

				echo ' 
				<script> 
					swal({
						type: "error",
						title: "!Error!",
						text: "El usuario no puede ir vacío y No se permiten caracteres especiales",	
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeConfirmButton: false
					}).then((result)=>{
						if(result.value){
							window.location = "tutores";
						}
					});
				</script>
			 	';

			}
			
		}

	}

	# ======================================
	# =  ELIMINAR USUARIO           =
	# ======================================
	static public function ctrBorrarUsuario(){

		if (isset($_GET["idUsuario"])) {
		
			$tabla = "usuarios";

			$datos = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") {
				
				unlink($_GET["fotoUsuario"]);

				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if ($respuesta) {
				echo ' 
				<script> 
					swal({
						type: "success",
						title: "!Correcto!",
						text: "Usuario Eliminado con Exito",	
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeConfirmButton: false
					}).then((result)=>{
						if(result.value){
							window.location = "tutores";
						}
					});
				</script>
			 	';

			}

		}

	}

}