/*==================================
= EVITAR NÚMERO DE CONTROL REPETIDO      =
==================================*/
$(document).on("change", "#nuevoNumeroControl", function(){

	$(".alert").remove();

	var numeroControl = $(this).val();

	var datos = new FormData();

	datos.append("validarNumeroControl", numeroControl);

	$.ajax({
		url: rutaOcultaServidor+"ajax/alumnos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			if (!respuesta) {

			} else {
				$("#nuevoNumeroControl").parent().after('<br> <div class="alert alert-warning">Este número de control ya existe en la base de datos </div>');
				
				$("#nuevoNumeroControl").val("");
			}
		}
	});
})

/*==================================
= EVITAR EMAIL REPETIDO      =
==================================*/
$(document).on("change", "#nuevoEmail", function(){

	$(".alert").remove();

	var Email = $(this).val();

	var datos = new FormData();

	datos.append("validarEmail", Email);

	$.ajax({
		url: rutaOcultaServidor+"ajax/alumnos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			if (!respuesta) {

			} else {
				$("#nuevoEmail").parent().after('<br> <div class="alert alert-warning">Este email ya existe en la base de datos </div>');
				
				$("#nuevoEmail").val("");
			}
		}
	});
})

/*==================================
= ACTIVAR USUARIO      =
==================================*/
$(document).on("click", ".btnActivarAlumno", function(){

	var idAlumno = $(this).attr("idAlumno");

	var estadoAlumno = $(this).attr("estadoAlumno");
	
	var datos = new FormData();

	datos.append("idAlumnoActivar", idAlumno);
	
	datos.append("estadoAlumnoActivar", estadoAlumno);

	$.ajax({
		url: rutaOcultaServidor+"ajax/alumnos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

			if (window.matchMedia("(max-width:767px)").matches) {

				 swal({
			      	title: "El estado del alumno ha sido actualizado correctamente",
			      	type: "success",
			      	confirmButtonText: "¡Cerrar!"
			    	}).then(function(result) {
			        
			        	if (result.value) {

			        	window.location = "alumnos";

			        }

			      });

			}
		}
	})

	if (estadoAlumno == 0) {

		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		$(this).html("Inactivo");
		$(this).attr("estadoUsuario", 1);

	} else {

		$(this).removeClass("btn-danger");
		$(this).addClass("btn-success");
		$(this).html("Activo");
		$(this).attr("estadoUsuario", 0);

	}
});




/*===========================
= MOSTRAR GRUPOS POR CARRERA=
===========================*/
function mostrarGruposCarrera(valor, item, input, inputOculto){

	var datos = new FormData();

	datos.append(item, valor);

	$.ajax({
		url: rutaOcultaServidor+"ajax/grupos.ajax.php",
		data: datos,
		type: "POST",
		cache: false,
		processData: false,
		contentType: false,
		dataType: 'json',
		success: function(respuesta){
			
			respuesta.forEach(functionForEach);

			function functionForEach(item, index){

					$(inputOculto).removeClass("hidden");

				 	if (item.id != 0) {
				 		
				      	$(input).append(

				      		'<option value="'+item.id+'">'+item.nombre+'</option>' 
				        );

				 	} 
			 }
		}
	})

}


/*===============================
= GRUPOS POR CARRERA DE ALUMNOS =
===============================*/
$(document).on("change", "#nuevaCarreraAlumno", function(){

	$("#nuevoGrupoAlumno").html("");
	
	$(".grupoAlumno").addClass("hidden");

	var idCarrera = $(this).val();

	var item = "idCarrera";

	var input = "#nuevoGrupoAlumno";

	var inputOculto = ".grupoAlumno";

	mostrarGruposCarrera(idCarrera, item, input, inputOculto);

})


/*=====================
= EDITAR ALUMNO =
=====================*/
$(document).on("click", ".btnEditarAlumno", function(){

	$(".alert").remove();

	var idAlumno = $(this).attr("idAlumno");

	var datos = new FormData();

	datos.append("idAlumno", idAlumno);

	$.ajax({
		url: rutaOcultaServidor+"ajax/alumnos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			
			$("#editarNombre").val(respuesta["nombre"]);
			
			$("#editarApellidos").val(respuesta["apellidos"]);
			
			/*======================
			=  EDITAR TUTOR      =
			======================*/
			var idTutor = respuesta["id_tutor"];

			var datosTutor = new FormData();

			datosTutor.append("idUsuario", idTutor);

			$.ajax({
				url: rutaOcultaServidor+"ajax/usuarios.ajax.php",
				type: "POST",
				data: datosTutor, 
				cache: false,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(respuestaTutor){
					$("#editarTutorAlumno").val(respuestaTutor["id"]);
					$("#editarTutorAlumno").html(respuestaTutor["nombre"]+" "+respuestaTutor["apellidos"]);
				}
			})


			$("#editarNumeroControl").val(respuesta["numeroControl"]);

			$("#editarEmail").val(respuesta["email"]);

			$("#activo").val(respuesta["activo"]);

			$("#passwordActual").val(respuesta["password"]);

			$("#fotoActual").val(respuesta["foto"]);

			$("#idAlumnoEditar").val(respuesta["id"]);


			/*======================
			=  EDITAR CARRERA      =
			======================*/
			var datos1 = new FormData();

			datos1.append("valor", respuesta["id_carrera"]);
			datos1.append("item", "id");

			$.ajax({
				url: rutaOcultaServidor+"ajax/carreras.ajax.php",
				type: "POST",
				data: datos1, 
				cache: false,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(respuesta1){
					$("#editarCarreraVal").val(respuesta1["id"]);
					$("#editarCarreraVal").html(respuesta1["descripcion"]);
				}
			})


			/*==================
			= EDITAR GRUPO   =
			===================*/
			var datos2 = new FormData();

			datos2.append("idGrupo", respuesta["id_grupo"]);

			$.ajax({
				url: rutaOcultaServidor+"ajax/grupos.ajax.php",
				type: "POST",
				data: datos2, 
				cache: false,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(respuesta2){
					$("#editarGrupoVal").val(respuesta2["id"]);
					$("#editarGrupoVal").html(respuesta2["nombre"]);
				}
			})
		}
	});
})

$(document).on("change", "#editarCarreraAlumno", function(){

	$("#editarGrupo").html("");

	var idCarrera = $(this).val();

	var item = "idCarrera";

	var input = "#editarGrupo";

	var inputOculto = null;

	mostrarGruposCarrera(idCarrera, item, input, inputOculto);

})

/*==================================
= ACTIVIDADES DEL ALUMNO =
==================================*/
$(document).on("click", ".btnActividades", function(){

	var idAlumno = $(this).attr("idAlumno");

	window.location = rutaOcultaServidor+"index.php?ruta=alumno-actividades&idAlumnoActividades="+idAlumno;
		
})


/*==================================
= REVISIÓN DE ACTIVIDADES AL ALUMNO
==================================*/
$(document).on("click", ".actividadRevisada", function(){

	var actividadRevisada = $('.actividadRevisada');

	var id = $(this).attr("id");

	var estadoActividad = $(this).attr("estadoActividad");
	
	// CAMBIANDO EL ESTADO DE LA ACTIVIDAD
	if(estadoActividad == 0){
	
		estadoActividad = 1;
	
	} else {
	
		estadoActividad = 0;
	
	}

	//VARIABLES DEL AJAX
	var datos = new FormData();

	datos.append("idComentario", id);

	datos.append("estadoActividad", estadoActividad);

	$.ajax({
		url: rutaOcultaServidor+"ajax/alumnos.ajax.php",
		type: "POST",
		data: datos, 
		cache: false,
		processData: false,
		contentType: false,
		success: function(respuesta){
				
			 swal({
		      	title: "Ha usted revisado la actividad correspondiente del alumno, en breve sera informado",
		      	type: "success",
		      	confirmButtonText: "¡Cerrar!"
		    	}).then(function(result) {
	
			        if (result.value) {
			        	window.location = "alumnos";
			        }

		     });
				
		}
	})

})
