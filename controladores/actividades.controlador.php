<?php

/**
 * ControladorActividades
 */
class ControladorActividades
{
	
	# ==========================================
	# =           MOSTRAR ACTIVIDADES           =
	# ==========================================
	static public function ctrMostrarActividades($item, $valor){

		$tabla = "actividades";

		$respuesta = ModeloActividades::mdlMostrarActividades($tabla, $item, $valor);

		return $respuesta;

	}


	# ========================================
	# =           CREAR ACTIVIDAD           =
	# ========================================
	
	static public function ctrCrearActividad(){

		if (isset($_POST["nuevaActividad"])) {
				
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaActividad"])){

				$tabla = "actividades";

				$datos = array('categoria' => $_POST["nuevaActividad"], 'ruta' => $_POST["nuevaActividadRuta"]);

				$respuesta = ModeloActividades::mdlCrearActividades($tabla, $datos);

				if ($respuesta == "ok") {	
					echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Genial!",
								text: "Actividad almacenada con éxito",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "actividades";
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
								window.location = "actividades";
							}
						});
					</script>
				 ';

			}

		}

	}


	# ========================================
	# =           EDITAR ACTIVIDAD        =
	# ========================================
	static public function ctrEditarActividad(){

		if (isset($_POST["editarActividad"])) {
				
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarActividad"])){

				$tabla = "actividades";

				$datos = array('id' => $_POST["idActividad"], 'categoria' => $_POST["editarActividad"], 'ruta' => $_POST["editarActividadRuta"]);

				$respuesta = ModeloActividades::mdlEditarActividades($tabla, $datos);

				if ($respuesta == "ok") {	
					echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Genial!",
								text: "Actividad editada con éxito",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "actividades";
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
								window.location = "usuarios";
							}
						});
					</script>
				 ';

			}

		}

	}


	# ========================================
	# = BORRAR ACTIVIDAD           =
	# ========================================
	static public function ctrEliminarActividad(){

		if (isset($_GET["borrarActividad"])) {
			
			$tabla = "actividades";

			$datos = $_GET["borrarActividad"];

			$respuesta = ModeloActividades::mdlBorrarActividad($tabla, $datos);

			if ($respuesta == "ok") {
				echo ' 
					<script> 
						swal({
							type: "success",
							title: "!Genial!",
							text: "La actividad ha sido borrado correctamente",	
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeConfirmButton: false
						}).then((result)=>{
							if(result.value){
								window.location = "actividades";
							}
						});
					</script>
				 ';
			}

		}

	}
	
}