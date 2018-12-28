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

						$ruta = "";
						# =======================
						# = VALIDAR IMAGEN SUB-ACTIVIDAD=
						# =======================
						if (isset($_FILES["nuevaImagen"]["tmp_name"])) {

							list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

							$nuevoAncho = 500;

							$nuevoAlto = 500;

							# =======================
							# = Crear Directorio para guardar la IMG      =
							# =======================
							$directorio = "vistas/actividades/imagenes/".$_POST["nuevaRuta"];

							mkdir($directorio, 0755);

							# ======================================================================================
							# = DE ACUERDO EL TIPO DE ARCHIVO USAMOS EL MÉTODO CORRESPONDIENTE           =
							# ======================================================================================
							if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

								# =======================
								# = Guardo la imagen en el directorio      =
								# =======================

								$rutaImagen = "vistas/actividades/imagenes/".$_POST["nuevaRuta"]."/".$_POST["nuevaRuta"].".jpg";

								$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

								$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

								imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

								// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

								imagejpeg($destino, $rutaImagen);

							}

							if ($_FILES["nuevaImagen"]["type"] == "image/png") {

								# =======================
								# = Guardo la imagen en el directorio      =
								# =======================

								$aleatorio = mt_rand(100,999);

								$rutaImagen = "vistas/actividades/imagenes/".$_POST["nuevaRuta"]."/".$_POST["nuevaRuta"].".png";

								$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

								$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

								imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

								// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

								imagepng($destino, $rutaImagen);

							}
						}

						$directorio = "";
						# =======================
						# = VALIDAR DOCUEMENTO SUB-ACTIVIDAD=
						# =======================
					 	if (isset($_FILES["nuevoArchivo"])) {

				        $directorio = "vistas/actividades/archivos/".$_POST["nuevaRuta"];

				        mkdir($directorio, 0755);

				        $documento = $directorio.'/'.$_POST["nuevaRuta"].'.pdf';

				        move_uploaded_file($_FILES['nuevoArchivo']['tmp_name'], $documento);

				        }

						$tabla = "sub_actividades";

						$datos = array(
						'id_actividad' => $_POST["nuevaActividad"],
						'ruta' => $_POST["nuevaRuta"],
						'ruta_archivo' => $directorio,
						'nombre' => $_POST["nuevaSubActividad"],
						'objetivo' => $_POST["nuevoObjetivo"],
						'imagen' => $rutaImagen,
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
									text: "Sub-Actividad Almacenado con exito",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeConfirmButton: false
								}).then((result)=>{
									if(result.value){
										window.location = "sub-actividades";
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

	# ============================
	# = INGRESAR SUB-ACTIVIDADES =
	# ============================
	static public function ctrEditarSubActividades(){

		if (isset($_POST["editarSubActividad"])) {

			if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["editarSubActividad"]) &&
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["editarObjetivo"]) &&
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["editarnTextoAyuda"]) &&
				preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["editarActividades"])
				){

						$ruta = "";
						# =======================
						# = VALIDAR IMAGEN SUB-ACTIVIDAD=
						# =======================
						if (isset($_FILES["nuevaImagen"]["tmp_name"])) {

							list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

							$nuevoAncho = 500;

							$nuevoAlto = 500;

							# =======================
							# = Crear Directorio para guardar la IMG      =
							# =======================
							$directorio = "vistas/actividades/imagenes/".$_POST["nuevaRuta"];

							mkdir($directorio, 0755);

							# ======================================================================================
							# = DE ACUERDO EL TIPO DE ARCHIVO USAMOS EL MÉTODO CORRESPONDIENTE           =
							# ======================================================================================
							if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

								# =======================
								# = Guardo la imagen en el directorio      =
								# =======================

								$rutaImagen = "vistas/actividades/imagenes/".$_POST["nuevaRuta"]."/".$_POST["nuevaRuta"].".jpg";

								$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

								$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

								imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

								// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

								imagejpeg($destino, $rutaImagen);

							}

							if ($_FILES["nuevaImagen"]["type"] == "image/png") {

								# =======================
								# = Guardo la imagen en el directorio      =
								# =======================

								$aleatorio = mt_rand(100,999);

								$rutaImagen = "vistas/actividades/imagenes/".$_POST["nuevaRuta"]."/".$_POST["nuevaRuta"].".png";

								$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

								$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

								imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

								// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

								imagepng($destino, $rutaImagen);

							}
						}

						$directorio = "";
						# =======================
						# = VALIDAR DOCUEMENTO SUB-ACTIVIDAD=
						# =======================
					 	if (isset($_FILES["nuevoArchivo"])) {

				        $directorio = "vistas/actividades/archivos/".$_POST["nuevaRuta"];

				        mkdir($directorio, 0755);

				        $documento = $directorio.'/'.$_POST["nuevaRuta"].'.pdf';

				        move_uploaded_file($_FILES['nuevoArchivo']['tmp_name'], $documento);

				        }

				        var_dump($rutaImagen);

				        var_dump($documento);

						$tabla = "sub_actividades";

						$datos = array(
						'id_actividad' => $_POST["nuevaActividad"],
						'ruta' => $_POST["nuevaRuta"],
						'ruta_archivo' => $directorio,
						'nombre' => $_POST["nuevaSubActividad"],
						'objetivo' => $_POST["nuevoObjetivo"],
						'imagen' => $rutaImagen,
						'textoAyuda' => $_POST["nuevoTextoAyuda"],
						'actividades' => $_POST["nuevasActividades"]
						);

						var_dump($datos);

						// $respuesta = ModeloSubActividades::mdlCrearSubActividades($tabla, $datos);

						// if ($respuesta == "ok") {
						// 	echo '
						// 	<script>
						// 		swal({
						// 			type: "success",
						// 			title: "!Genial!",
						// 			text: "Sub-Actividad Almacenado con exito",
						// 			showConfirmButton: true,
						// 			confirmButtonText: "Cerrar",
						// 			closeConfirmButton: false
						// 		}).then((result)=>{
						// 			if(result.value){
						// 				window.location = "sub-actividades";
						// 			}
						// 		});
						// 	</script>
						//  ';
						// }


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
