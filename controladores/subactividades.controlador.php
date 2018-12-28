<?php 

/**
 * Controlador Sub-Actividades
 */
class ControladorSubActividades
{
	
	# ============================
	# = MOSTRAR SUB-ACTIVIDADES  =
	# ============================
	static public function ctrMostrarSubActividades($item, $valor){

		$tabla = "sub_actividades";

		$respuesta = ModeloSubActividades::mdlMostrarSubActividades($tabla, $item, $valor);

		return $respuesta;
	}

	# ============================
	# = INGRESAR SUB-ACTIVIDADES =
	# ============================
	static public function ctrCrearSubActividades(){

		if (isset($_POST["nuevaSubActividad"])) {
		
			if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["nuevaSubActividad"]) &&
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["nuevoObjetivo"]) &&
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["nuevoTextoAyuda"]) &&
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["nuevasActividades"]) 
				){
					
					$tabla = "sub_actividades";

					$datos = array(
						'id_actividad' => $_POST["nuevaActividad"], 
						'ruta' => $_POST["nuevaRuta"], 
						'ruta_archivo' => "vistas/actividades/1.pdf", 
						'nombre' => $_POST["nuevaSubActividad"],
						'objetivo' => $_POST["nuevoObjetivo"],  
						'imagen' => "vistas/actividades/1.jpg", 
						'textoAyuda' => $_POST["nuevoTextoAyuda"],
						'actividades' => $_POST["nuevasActividades"] 
					);

					$respuesta = ModeloSubActividades::mdlCrearSubActividades($tabla, $datos);

					if ($respuesta == "ok") {
						echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Genial!",
								text: "Usuario Almacenado con exito",	
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
	
}