<?php 

/**
 * ControladorGrupos
 */
class ControladorGrupos
{
	
	# ======================
	# = MOSTRAR GRUPOS    =
	# ======================
	static public function ctrMostrarGrupos($item, $valor){

		$tabla = "grupos";

		$respuesta = ModeloGrupos::mdlMostrarGrupos($tabla, $item, $valor);

		return $respuesta;

	}

	# ======================
	# = GRUPOS POR CARRERA =
	# ======================
	static public function ctrMostrarGruposCarrera($item, $valor){

		$tabla = "grupos";

		$respuesta = ModeloGrupos::mdlMostrarGruposCarrera($tabla, $item, $valor);

		return $respuesta;

	}



	# ======================
	# = GRUPOS Y CARRERA    =
	# ======================
	static public function ctrMostrarGruposbyCarrera($item1, $valor1, $item2, $valor2){

		$tabla = "grupos";

		$respuesta = ModeloGrupos::mdlMostrarGruposbyCarrera($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}


	# ======================
	# = CREAR GRUPO    =
	# ======================
	static public function ctrCrearGrupo(){

		if (isset($_POST["nuevoGrupo"])) {
		
			if (preg_match('/^[0-9]+$/', $_POST["nuevoGrupo"])) {
				
				$tabla = "grupos";

				$datos = array('nombre' => $_POST["nuevoGrupo"], 'id_carrera' => $_POST["nuevaCarreraGrupo"]);

				$respuesta = ModeloGrupos::mdlCrearGrupo($tabla, $datos);
				
				if ($respuesta == "ok") {
					echo'  
						<script> 
							swal({
								title: "Genial",
								type: "success",
								text: "El grupo ha sido almacenado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false		
							}).then((result)=>{
								if(result.value){
									window.location = "grupos";
								}
							});	
						</script>
					';
				}
			}
		}
	}

	# ======================
	# = EDITAR GRUPO    =
	# ======================
	static public function ctrEditarGrupo(){

		if (isset($_POST["editarGrupo"])) {
		
			if (preg_match('/^[0-9]+$/', $_POST["editarGrupo"])) {
				
				$tabla = "grupos";

				$datos = array('nombre' => $_POST["editarGrupo"], 'id_carrera' => $_POST["editarCarrera"], 'id' => $_POST["idGrupo"]);

				$respuesta = ModeloGrupos::mdlEditarGrupo($tabla, $datos);
				
				if ($respuesta == "ok") {
					echo'  
						<script> 
							swal({
								title: "Genial",
								type: "success",
								text: "El grupo ha sido editado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false		
							}).then((result)=>{
								if(result.value){
									window.location = "grupos";
								}
							});	
						</script>
					';
				}
			}
		}
	}

	# ======================
	# = ELIMINAR GRUPO    =
	# ======================
	static public function ctrEliminarGrupo(){

		if (isset($_GET["idGrupoEliminar"])) {
		
			$tabla = "grupos";

			$datos = array('id' => $_GET["idGrupoEliminar"]);

			$respuesta = ModeloGrupos::mdlEliminarGrupo($tabla, $datos);

			if ($respuesta == "ok") {
				echo ' 
					<script> 
						swal({
							type: "success",
							title: "!Correcto!",
							text: "Grupo Eliminado con Exito",	
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeConfirmButton: false
						}).then((result)=>{
							if(result.value){
								window.location = "grupos";
							}
						});
					</script>
				';
			}
		}
	}
}