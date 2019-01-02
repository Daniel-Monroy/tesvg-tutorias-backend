<?php 
/**
 * AlumnosControlador
 */
class ControladorAlumnos
{
	# ======================
	# = MOSTRAR ALUMNO    =
	# ======================
	static public function ctrMostrarAlumnos($item, $valor){

		$tabla = "alumnos";

		$respuesta = ModeloAlumnos::mdlMostrarAlumnos($tabla, $item, $valor);

		return $respuesta;

	}

	# ======================
	# = CREAR ALUMNO     =
	# ======================
	static public function ctrCrearAlumno(){

		if (isset($_POST["nuevoNombre"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidos"]) &&
				preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST['nuevoEmail']) &&
				preg_match('/^[0-9]+$/', $_POST["nuevoNumeroControl"]) &&  
				preg_match('/^[a-zA-Z0-9]*$/', $_POST['nuevoPassword'])) {
				
				$tabla = "alumnos";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxy54ahjppf45sd87a5a4dDDGsystemdev$');

            	$encriptarEmail = md5($_POST['nuevoEmail']);

				$datos = array('nombre' => $_POST["nuevoNombre"],
							   'apellidos' => $_POST["nuevoApellidos"], 
							   'numeroControl' => $_POST["nuevoNumeroControl"], 
							   'id_carrera' => $_POST["nuevaCarrera"],
							   'email' => $_POST["nuevoEmail"], 
							   'id_grupo' => $_POST["nuevoGrupo"],
							   'password' => $encriptar, 
							   'verificacion' => 1, 
							   'activo' => 0,    
							   'foto' => "",
							   'modo' => "directo",
							   'emailEncriptado' => $encriptarEmail
							);

				$respuesta = ModeloAlumnos::mdlNuevoAlumno($tabla, $datos);

				if ($respuesta == "ok") {

					/*=============================================>>>>>
		             = VERIFICACIÓN DE EMAIL POR PARTE DEL ALUMNO =
		            ===============================================>>>>>*/
					date_default_timezone_set("America/Mexico_City");

	                $url = Ruta::ctrRuta();

	                $mail = new PHPMailer;

	                $mail->CharSet = 'UTF-8';

	                $mail-> isMail();

	                $mail ->setFrom('tutoriasTESVG@gmail.com', 'Tutorias TESVG');

	                $mail -> addReplyTo('tutoriasTESVG@gmail.com', 'Tutorias TESVG');

	                $mail ->Subject = "Por favor verifique su direccion de Correo Electrónico";

	                $mail -> addAddress($_POST["nuevoEmail"]);

	                $mail -> msgHTML('
		                 <div style="background:#eee; position: relative; font-family: sans-serif; padding-bottom: 40px;">
						    <center>
						      <img style="padding:20px; width:10%;" src="http://chamoysteam.xyz/tutorias-admin/vistas/img/plantilla/logoTutorias.png" alt="">
						    </center>


		                     <div style="position:relative; margin:auto; width:600px; background:white; padding:20px;">
						      <center>
						        <img style="padding: 20px; width:15%;" src="http://tutorialesatualcance.com/tienda/icon-email.png" alt="">
		                     
		                      <h3 style="font-weight:100; color:#999;">Verifica tu EMAIL '.$datos["nombre"]." ".$datos["apellidos"].'</h3>
		                     
		                      <hr style="border:1px solid #ccc; width:80%">

		                  	  <h4 style="font-weight:100; color:#999; padding:0 20px;">Para poder usar su cuenta en Tutorias TESVG debe confirmar su Email</h4>

		                      <a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">
		                      <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su Email</div>
		                      </a>

		                      <br>
		                      <hr style="border:1px solid #ccc; width:80%">
		                      <h5 style="font-weight:100; color:#999;">Si no es dueño de esta cuenta en Tutorias TESVG puede ignorar este correo y la cuenta se eliminara<</h5>

		                    </center>

		                  </div>

		                 </div>
	                ');

	                $envio = $mail->Send();

	                if (!$envio) { 

	                	echo '   
							<script> 
								swal({
									type: "error",
									title: "!Error!",
									text: "No se ha podido registrar correctamente al alumno",	
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeConfirmButton: false
								}).then((result)=>{
									if(result.value){
										window.location = "alumnos";
									}
								});
							</script>

	                	';

	                } else {

					echo ' 
						<script> 
							swal({
								type: "success",
								title: "!Genial!",
								text: "Alumno Almacenado con exito, se le ha enviado un Email para que inicie en el sistema",	
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeConfirmButton: false
							}).then((result)=>{
								if(result.value){
									window.location = "alumnos";
								}
							});
						</script>
					 ';

	                }
	            
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
								window.location = "alumnos";
							}
						});
					</script>
				 ';

			}

		}

	}

	# ======================
	# = EDITAR ALUMNO     =
	# ======================
	static public function ctrEditarAlumno(){

		if (isset($_POST["editarNombre"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && 
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidos"]) &&
				preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST['editarEmail']) &&
				preg_match('/^[0-9]+$/', $_POST["editarNumeroControl"])) {
				
				$tabla = "alumnos";

             	$encriptarEmail = md5($_POST['editarEmail']);

				$datos = array('nombre' => $_POST["editarNombre"],
							   'apellidos' => $_POST["editarApellidos"], 
							   'numeroControl' => $_POST["editarNumeroControl"], 
							   'id_carrera' => $_POST["editarCarrera"],
							   'email' => $_POST["editarEmail"], 
							   'id_grupo' => $_POST["editarGrupo"],
							   'password' => $_POST["passwordActual"], 
							   'verificacion' => 1, 
							   'activo' => $_POST["activo"],    
							   'foto' => $_POST["fotoActual"],
							   'modo' => "directo",
							   'emailEncriptado' => $encriptarEmail,
							   'id' => $_POST["id"]
							);

					$respuesta = ModeloAlumnos::mdlEditarAlumno($tabla, $datos);

					var_dump($respuesta);

					if ($respuesta == "ok") {

						echo ' 
							<script> 
								swal({
									type: "success",
									title: "!Genial!",
									text: "Alumno Editado con exito",	
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeConfirmButton: false
								}).then((result)=>{
									if(result.value){
										window.location = "alumnos";
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
								window.location = "alumnos";
							}
						});
					</script>
				 ';

			}

		}

	}


	# ==========================================
	# = MOSTRAR ACTIVIDADES REALIZADAS         =
	# ==========================================
	static public function ctrMostrarActividadesRealizadas($item, $valor){

		$tabla = "actividades_alumnos";

		$respuesta = ModeloSubActividades::mdlMostrarSubActividadesCategoria($tabla, $item, $valor);

		return $respuesta;
	}


}