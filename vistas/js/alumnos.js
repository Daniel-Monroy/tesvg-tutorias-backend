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

			console.log("respuesta", respuesta);

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


/*==================================
= EDITAR ALUMNO =
==================================*/
$(document).on("click", ".btnEditarAlumno", function(){

	$(".alert").remove();

	var idAlumno = $(this).attr("idAlumno");
	
	console.log("idAlumno", idAlumno);

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
			
			$("#editarNumeroControl").val(respuesta["numeroControl"]);

			$("#editarEmail").val(respuesta["email"]);

			$("#activo").val(respuesta["activo"]);

			$("#passwordActual").val(respuesta["password"]);

			$("#fotoActual").val(respuesta["foto"]);

			$("#idAlumnoEditar").val(respuesta["id"]);

			/*=========================================
			=            INGRESAR CARRERAS            =
			=========================================*/
			$("#editarCarrera").val(respuesta["carrera"]);
			
			$("#editarCarrera").html(respuesta["carrera"]);


			/*=========================================editarEmail
			=            INGRESAR GRUPO            =
			=========================================*/
			$("#editarGrupo").val(respuesta["grupo"]);
			
			$("#editarGrupo").html(respuesta["grupo"]);


		}
	});
})


$(document).on("click", ".btnActividades", function(){

	var idAlumno = $(this).attr("idAlumno");

	window.location = rutaOcultaServidor+"index.php?ruta=alumno-actividades&idAlumnoActividades="+idAlumno;
		
})

