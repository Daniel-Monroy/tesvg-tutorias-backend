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
	# = MOSTRAR SUB-ACTIVIDADES POR CATEGORIA =
	# ============================
	static public function ctrMostrarSubActividadesCategoria($item, $valor){

		$tabla = "sub_actividades";

		$respuesta = ModeloSubActividades::mdlMostrarSubActividadesCategoria($tabla, $item, $valor);

		return $respuesta;
	}

	# ============================
	# = INGRESAR SUB-ACTIVIDADES =
	# ============================
	static public function ctrCrearSubActividades(){

		if (isset($_POST["nuevaSubActividad"])) {

			if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿! ]+$/', $_POST["nuevaSubActividad"])
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

						$documento = "";
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
						'id_tutor' => $_POST["idTutor"],
						'ruta' => $_POST["nuevaRuta"],
						'ruta_archivo' => $documento,
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
	# = EDITAR SUB-ACTIVIDADES =
	# ============================
	static public function ctrEditarSubActividades(){

		if (isset($_POST["editarSubActividad"])) {

		$rutaImagen = $_POST["fotoActual"];
		# =======================
		# = VALIDAR IMAGEN SUB-ACTIVIDAD=
		# =======================
		if (isset($_FILES["nuevaImagen"]["tmp_name"])  && !empty($_FILES["nuevaImagen"]["tmp_name"]) ) {

			list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

			$nuevoAncho = 500;

			$nuevoAlto = 500;

			# =======================
			# = Crear Directorio para guardar la IMG=
			# =======================
			$directorio = "vistas/actividades/imagenes/".$_POST["editarRuta"];

			if (!empty($_POST["fotoActual"])) {
					
				unlink($_POST["fotoActual"]);
				
				} else {

				mkdir($directorio, 0755);
			
			}

			# ======================================================================================
			# = DE ACUERDO EL TIPO DE ARCHIVO USAMOS EL MÉTODO CORRESPONDIENTE           =
			# ======================================================================================
			if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

				# =======================
				# = Guardo la imagen en el directorio      =
				# =======================

				$rutaImagen = "vistas/actividades/imagenes/".$_POST["editarRuta"]."/".$_POST["editarRuta"].".jpg";

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

				$rutaImagen = "vistas/actividades/imagenes/".$_POST["editarRuta"]."/".$_POST["editarRuta"].".png";

				$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				// imagecopyresized("imagen de destino", "origen", "0", "0", "0", "0", "$nuevoAncho", "$nuevoAlto", "$alto", "$ancho");

				imagepng($destino, $rutaImagen);

			}
		}

		$documento = $_POST["editarArchivo"];
		# =======================
		# = VALIDAR DOCUEMENTO SUB-ACTIVIDAD=
		# =======================
	 	if (isset($_FILES["nuevoArchivo"]) && !empty($_FILES["nuevoArchivo"]["tmp_name"])) {

	        $directorio = "vistas/actividades/archivos/".$_POST["editarRuta"];

	        #Verificamos si existe un documento ya almacenado
			if (!empty($_POST["editarArchivo"])) {
					
				unlink($_POST["editarArchivo"]);
				
				} else {

				mkdir($directorio, 0755);
			
			}

	        $documento = $directorio.'/'.$_POST["editarRuta"].'.pdf';

	        move_uploaded_file($_FILES['nuevoArchivo']['tmp_name'], $documento);

        }

		$tabla = "sub_actividades";

		$datos = array(
		'id_actividad' => $_POST["editarActividad"],
		'id_tutor' => $_POST["idTutor"],
		'ruta' => $_POST["editarRuta"],
		'ruta_archivo' => $documento,
		'nombre' => $_POST["editarSubActividad"],
		'objetivo' => $_POST["editarObjetivo"],
		'imagen' => $rutaImagen,
		'textoAyuda' => $_POST["editarTextoAyuda"],
		'actividades' => $_POST["editarActividades"],
		'id' => $_POST["id"]
		);

		$respuesta = ModeloSubActividades::mdlEditarSubActividades($tabla, $datos);

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

		}
				
	}

	# ======================================
	# =  ELIMINAR SUB-ACTIVIDAD           =
	# ======================================
	static public function ctrEliminarSubActividad(){

		if (isset($_GET["idSubActividadEliminar"])) {
		
			$tabla = "sub_actividades";

			$datos = $_GET["idSubActividadEliminar"];

			#IMAGEN
			if ($_GET["imagen"] != "") {
				
				unlink($_GET["imagen"]);

				rmdir('vistas/actividades/imagenes/'.$_GET["nombre"]);

			} 

			#ARCHIVO
			if ($_GET["archivo"] != "") {
				
				unlink($_GET["archivo"]);

				rmdir('vistas/actividades/archivos/'.$_GET["nombre"]);

			} 

			$respuesta = ModeloSubActividades::mdlBorrarSubActividad($tabla, $datos);

			if ($respuesta) {
				echo ' 
				<script> 
					swal({
						type: "success",
						title: "!Correcto!",
						text: "Sub-Actividad Eliminada con Exito",	
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

		}

	}


}
