<?php 

/**
 * ControladorCarreras
 */
class ControladorCarreras
{
	
	# ======================
	# = MOSTRAR CARRERAS   =
	# ======================
	static public function ctrMostrarCarreras($item, $valor){

		$tabla = "carreras";

		$respuesta = ModeloCarreras::mdlMostrarCarreras($tabla, $item, $valor);

		return $respuesta;

	}
	
	# ======================
	# = CREAR CARRERA    =
	# ======================
	static public function ctrCrearCarrera(){
	
		if (isset($_POST["nuevaCarrera"])) {

			var_dump($_POST);
				
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionCarrera"])){

				$tabla = "carreras";

				$datos = array(
					'carrera' => $_POST["nuevaCarrera"], 
					'descripcion' => $_POST["nuevaDescripcionCarrera"],
					'id_jefe' => $_POST["nuevoJefe"],
					'id_coordinador' => $_POST["nuevoCoordinadorCarrera"]
				);

				$respuesta = ModeloCarreras::mdlCrearCarrera($tabla, $datos);

				if ($respuesta == "ok") {	
					echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Genial!",
								text: "Carrera almacenada con éxito",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "carreras";
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
							text: "Todos los campos son obligatorios y no se permiten caracteres especiales",	
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeConfirmButton: false
						}).then((result)=>{
							if(result.value){
								window.location = "carreras";
							}
						});
					</script>
				 ';

			}

		}

	}

	# ======================
	# = EDITAR CARRERA    =
	# ======================
	static public function ctrEditarCarrera(){
	
		if (isset($_POST["editarCarrera"])) {
				
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionCarrera"])){

				$tabla = "carreras";

				$datos = array(
					'id' => $_POST["idCarrera"],
					'carrera' => $_POST["editarCarrera"], 
					'descripcion' => $_POST["editarDescripcionCarrera"],
					'id_jefe' => $_POST["editarJefe"],
					'id_coordinador' => $_POST["editarCoordinadorCarrera"]
				);

				$respuesta = ModeloCarreras::mdlEditarCarrera($tabla, $datos);

				if ($respuesta == "ok") {	
					echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Genial!",
								text: "Carrera editada con éxito",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "carreras";
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
							text: "Todos los campos son obligatorios y no se permiten caracteres especiales",	
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeConfirmButton: false
						}).then((result)=>{
							if(result.value){
								window.location = "carreras";
							}
						});
					</script>
				 ';

			}

		}

	}


	# ======================
	# = ELIMINAR CARRERA   =
	# ======================
	static public function ctrEliminarCarrera(){
	
		if (isset($_GET["idCarreraEliminar"])) {
		
			$tabla = "carreras";

			$datos = array('id' => $_GET["idCarreraEliminar"]);

			$respuesta = ModeloCarreras::mdlBorrarCarrera($tabla, $datos);

			if ($respuesta == "ok") {
				echo '  
					<script> 
						swal({
							type: "success",
							title: "!Genial!",
							text: "Carrera eliminada con éxito",	
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeConfirmButton: false
						}).then((result)=>{
							if(result.value){
								window.location = "carreras";
							}
						});
					</script>
				';

			}

		}
	
	}

}

