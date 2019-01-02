/*==================================
= EVITAR REPETIR GRUPO AL CREARLO  =
==================================*/
function validarCrearGrupo(){

	$(".alert").remove();

	var idCarrera = $(".nuevaCarreraGrupo").val();

	var nombreGrupo = $(".nuevoGrupo").val();
	
	var datos = new FormData();

	datos.append("idCarrera", idCarrera);

	datos.append("nombreGrupo", nombreGrupo);

	$.ajax({
		url: rutaOcultaServidor+"ajax/grupos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			if (!respuesta) {

			} else {
				$(".nuevaCarreraGrupo").parent().after('<br> <div class="alert alert-warning">Este grupos ya ha sido creado en esta carrera</div>');
				
				$(".nuevaCarreraGrupo").val("");

				$(".nuevaCarreraValue").html("Seleccionar Carrera");

				$(".nombreGrupo").val("");

				$(".selectCarrera").addClass("hidden");
			}
		}
	});	
}

$(document).on("change", ".nuevaCarreraGrupo", function(){
	validarCrearGrupo();
})

$(document).on("change", ".nuevoGrupo", function(){

	$(".selectCarrera").removeClass("hidden");

	validarCrearGrupo();
})


/*==================================
= EVITAR REPETIR GRUPO AL EDITARLO =
==================================*/
function validarEditarGrupo(){

	$(".alert").remove();

	var idCarrera = $(".editarCarrera").val();

	var nombreGrupo = $(".editarGrupo").val();
	
	var datos = new FormData();

	datos.append("idCarrera", idCarrera);

	datos.append("nombreGrupo", nombreGrupo);

	$.ajax({
		url: rutaOcultaServidor+"ajax/grupos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			if (!respuesta) {

			} else {
				$(".editarCarrera").parent().after('<br> <div class="alert alert-warning">Este grupos ya ha sido creado en esta carrera</div>');
				
				$("#editarCarrera").val($("#valorCarreraActual").val());

				$("#editarCarrera").html($("#htmlCarreraActual").val());

				$(".editarGrupo").val($("#editarGrupoActual").val());
			}
		}
	});	
}

$(document).on("change", ".editarGrupo", function(){

	validarEditarGrupo();

})

$(document).on("change", ".editarCarrera", function(){

	validarEditarGrupo();

})

/*==================================
= EDITAR GRUPO     =
==================================*/
$(document).on("click", ".btnEditarGrupo", function(){

	var idGrupo = $(this).attr("idGrupo");
	
	var datos = new FormData();

	datos.append("idGrupo", idGrupo);

	$.ajax({
		url: rutaOcultaServidor+"ajax/grupos.ajax.php",
		data: datos,
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'JSON',
		success: function(respuesta){
			
			$("#idGrupo").val(respuesta["id"]);
			
			$(".editarGrupo").val(respuesta["nombre"]);


			/*==================
			= CARRERA    =
			===================*/
			var datos1 = new FormData();

			var idCarrera = respuesta["id_carrera"];

			datos1.append("idEditarCarrera", idCarrera);

			$.ajax({
				
				url: rutaOcultaServidor+"ajax/carreras.ajax.php",
				data: datos1,
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'JSON',
				success: function(respuesta1){
					$("#editarCarrera").val(respuesta1["id"]);
					$("#editarCarrera").html(respuesta1["descripcion"]);

					//VALORES ACTUALES
					$("#htmlCarreraActual").val(respuesta1["descripcion"]);
					$("#valorCarreraActual").val(respuesta1["id"]);
				

				}

			})
			
			//VALORES ACTUALES
			$("#editarGrupoActual").val(respuesta["nombre"]);
			
		}
	})
});



/*====================
= ELIMINAR GRUPO     =
=====================*/
$(document).on("click", ".btnEliminarGrupo", function(){

	var idGrupo = $(this).attr("idGrupo");
	
	swal({
		title: '¿Está seguro de borrar el Grupo?',
		text: '¡Si no lo ésta puede dar click en cancelar!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085b6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar grupo'
	}).then((result)=>{

		if (result.value) {

      		window.location = rutaOcultaServidor+"index.php?ruta=grupos&idGrupoEliminar="+idGrupo;
		
		}

	})

})


/*====================
= ELIMINAR GRUPO     =
=====================*/
$(document).on("click", ".btnActividadesGrupo", function(){

	var idGrupo = $(this).attr("idGrupo");
	
	window.location = rutaOcultaServidor+"index.php?ruta=sub-actividades&idGrupo="+idGrupo;
		

})
