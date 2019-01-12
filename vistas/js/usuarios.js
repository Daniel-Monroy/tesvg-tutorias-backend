/*==================================
=            SUBIR FOTO            =
==================================*/
$(document).on("change", ".nuevaFoto", function(){

	var imagen = this.files[0];
	/*===========================
	=  VALIDAR FORMATO           =
	============================*/
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "!La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "!Cerrar¡"
		});

	} else if(imagen["size"] > 2000000) {

		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "!La imagen no debe superar los 2MB en su tamaño!",
			type: "error",
			confirmButtonText: "!Cerrar¡"
		});


	} else {

		var datosImagen = new FileReader;

		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			$(".previsualizarImagen").attr("src", rutaImagen);

		});

	}
});


/*==================================
= EDITAR USUARIO      =
==================================*/
$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();

	datos.append("idUsuario", idUsuario);

	$.ajax({
		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#idTutor").val(respuesta["id"]);

			$("#editarNombre").val(respuesta["nombre"]);
			
			$("#editarApellidos").val(respuesta["apellidos"]);

			// CARRERA DEL USUARIO
			var idCarrera = respuesta["id_carrera"];

			var datosCarrera = new FormData();

			datosCarrera.append("item", "id");

			datosCarrera.append("valor", idCarrera);

			$.ajax({
				url: "ajax/carreras.ajax.php",
				method: "POST",
				data: datosCarrera,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuestaCarrera){
					$("#editarCarrera").val(respuestaCarrera["id"]);
					$("#editarCarrera").html(respuestaCarrera["descripcion"]);
				}

			});	


			$("#editarUsuario").val(respuesta["usuario"]);

			$("#passwordActual").val(respuesta["password"]);

			$("#editarProfesion").val(respuesta["profesion"]);


			// PERFIL DEL USUARIO
			var idPerfil = respuesta["perfil"];
	
			var datosPerfil = new FormData();

			datosPerfil.append("idPerfil", idPerfil);

			$.ajax({
				url: "ajax/usuarios.ajax.php",
				method: "POST",
				data: datosPerfil,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuestaPerfil){
					$("#editarPerfil").val(respuestaPerfil["id"]);
					$("#editarPerfil").html(respuestaPerfil["descripcion"]);
				}

			});	

			$("#fotoActual").val(respuesta["foto"]);

			if (respuesta["foto"] != "") {

				$(".previsualizarImagen").attr("src", respuesta["foto"]);

			}
		}
	});
});



/*==================================
= ACTIVAR USUARIO      =
==================================*/
$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();

	datos.append("idUsuarioActivar", idUsuario);
	
	datos.append("estadoUsuarioActivar", estadoUsuario);

	$.ajax({
		url: rutaOcultaServidor+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

			if (window.matchMedia("(max-width:767px)").matches) {

				 swal({
			      	title: "El estado del usuario ha sido actualizado correctamente",
			      	type: "success",
			      	confirmButtonText: "¡Cerrar!"
			    	}).then(function(result) {
			        
			        	if (result.value) {

			        	window.location = "usuarios";

			        }

			      });

			}
		}
	})

	if (estadoUsuario == 0) {

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
= EVITAR USUARIO REPETIDO      =
==================================*/
$(document).on("change", "#nuevoUsuario", function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();

	datos.append("validarUsuario", usuario);

	$.ajax({
		url: rutaOcultaServidor+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){
			if (!respuesta) {

			} else {
				$("#nuevoUsuario").parent().after('<br> <div class="alert alert-warning">Este usuario ya existe en la base de datos </div>');
				
				$("#nuevoUsuario").val("");
			}
		}
	});
})


/*==================================
= ELIMINAR USUARIO      =
==================================*/
$(document).on("click", ".btnEliminarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var usuario = $(this).attr("usuario");
	
	swal({
		title: '¿Está seguro de borrar el usuario?',
		text: '¡Si no lo ésta puede dar click en cancelar!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085b6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario'
	}).then((result)=>{

		if (result.value) {

      		window.location = rutaOcultaServidor+"index.php?ruta=tutores&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
		
		}

	})

});