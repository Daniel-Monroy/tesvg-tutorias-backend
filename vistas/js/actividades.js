/*========================================
= EDITAR ACTIVIDADES            =
========================================*/
$(document).on("click", ".btnEditarActividad", function(){

	var idActividad = $(this).attr("idActividad");
	
	var datos = new FormData();

	datos.append("idActividad", idActividad);
	$.ajax({
		url : rutaOcultaServidor+"ajax/actividades.ajax.php",
		data: datos, 
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){
			console.log("respuesta", respuesta);
			
			$("#editarActividad").val(respuesta["categoria"]);

			$("#editarActividadRuta").val(respuesta["ruta"]);
			
			$("#idActividad").val(respuesta["id"]);
		}
	})

});

/*========================================
= ELIMINAR ACTIVIDAD            =
========================================*/
$(document).on("click", ".btnEliminarActividad", function(){

	var idActividad = $(this).attr("idActividad");

	swal({
		title : '¿Está seguro de borrar la actividad?',
		text: '¡Si no lo está puede cancelar la acción!', 
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonText: 'Cancelar',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, borrar categoria!'
	}).then((result)=>{
		if (result.value) {
			window.location = rutaOcultaServidor+"index.php?ruta=actividades&borrarActividad="+idActividad;
		}
	})

});


/*========================================
= VALIDAR ACTIVIDAD REPETIDA           =
========================================*/
$(document).on("change", "#nuevaActividad", function(){

	$(".alert").remove();

	var actividad  = $(this).val();

	var datos = new FormData();

	datos.append("actividadValidar", actividad);

	$.ajax({
		url : rutaOcultaServidor+"ajax/actividades.ajax.php",
		data: datos, 
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){
			console.log("respuesta", respuesta);

			if (!respuesta) {

			} else {
				$("#nuevaActividad").parent().after('<br> <div class="alert alert-warning">Esta actividad ya existe en la base de datos </div>');
				
				$("#nuevaActividad").val("");
			}
		}
	})

})