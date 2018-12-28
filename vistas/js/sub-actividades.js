/*=============================================
= VARIABLES LOCAL STORAGE            =
=============================================*/
if (localStorage.getItem("filtroActividad") != null) {

	$(".cancelarBusqueda").removeClass("hidden");
	/*============================================
	=            OBTENER LA ACTIVIDAD            =
	============================================*/
	var datos = new FormData();

	var idActividad = localStorage.getItem("filtroActividad");

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
	
			$(".subActividades").html(respuesta["categoria"]);
	
		}
	 
	 });

	$("#busquedaActividad").val(localStorage.getItem("filtroActividad"));

} else {

	$("#busquedaActividad").html('Seleccionar Actividad');
}


$(document).on("change", ".filtroActividad", function(){

    var idFiltroBusqueda = $(".filtroActividad").val();

    localStorage.setItem("filtroActividad", idFiltroBusqueda);

    window.location = "index.php?ruta=sub-actividades&idActividad="+idFiltroBusqueda;

})


$(document).on("click", ".cancelarBusqueda", function(){

    localStorage.removeItem("filtroActividad");

	localStorage.clear();

	window.location = "sub-actividades";

})

/*========================================
= VALIDAR SUB-ACTIVIDAD REPETIDA           =
========================================*/
$(document).on("change", "#nuevaSubActividad", function(){

	$(".alert").remove();

	var subactividad  = $(this).val();

	var datos = new FormData();

	datos.append("subactividadValidar", subactividad);

	$.ajax({
		url : rutaOcultaServidor+"ajax/subactividades.ajax.php",
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
				$("#nuevaSubActividad").parent().after('<br> <div class="alert alert-warning">Esta actividad ya existe en la base de datos </div>');
				
				$("#nuevaSubActividad").val("");
			}
		}
	})

})


/*==================================
=            SUBIR FOTO            =
==================================*/
$(document).on("change", ".nuevaImagen", function(){

	var imagen = this.files[0];
	/*===========================
	=  VALIDAR FORMATO           =
	============================*/
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaImagen").val("");

		swal({
			title: "Error al subir la imagen",
			text: "!La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "!Cerrar¡"
		});

	} else if(imagen["size"] > 2000000) {

		$(".nuevaImagen").val("");

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
=       SUBIR PDF O WORD         =
==================================*/
$(document).on("change", ".nuevoArchivo", function(){

  var archivo = this.files[0];
  /*===========================
  =  VALIDAR FORMATO           =
  ============================*/
  if (archivo["type"] != "application/pdf" && archivo["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {

    $(".nuevoArchivo").val("");

    swal({
      title: "Error al subir el archivo",
      text: "Este debe estar en formato PDF O DOCX!",
      type: "error",
      confirmButtonText: "!Cerrar¡"
    });

   } 

});


/*==================================
=       EDITAR SUB-ACTIVIDAD       =
==================================*/
$(document).on("click", ".btnEditarSubActividad", function(){
	
	var idSubActividad = $(this).attr("idSubActividad");

	var datos = new FormData();

	datos.append("idSubActividad", idSubActividad);
	$.ajax({
		url : rutaOcultaServidor+"ajax/subactividades.ajax.php",
		data: datos, 
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){



			/*============================================
			=            OBTENER LA ACTIVIDAD            =
			============================================*/
			var datos1 = new FormData();

			var idActividad = respuesta["id_actividad"];

			datos1.append("idActividad", idActividad);

			$.ajax({
				url : rutaOcultaServidor+"ajax/actividades.ajax.php",
				data: datos1, 
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				success: function(respuesta1){
					$("#editarActividad").html(respuesta1["categoria"]);
					$("#editarActividad").val(respuesta1["id"]);
				}
			 });	

			$("#editarSubActividad").val(respuesta["nombre"]);
			$("#editarRuta").val(respuesta["ruta"]);
			$("#editarObjetivo").val(respuesta["objetivo"]);
			$("#editarTextoAyuda").val(respuesta["textoAyuda"]);
			$("#editarActividades").val(respuesta["actividades"]);
			$("#fotoActual").val(respuesta["imagen"]);
			$("#id").val(respuesta["id"]);


			if (respuesta["imagen"] != "") {
	
				$(".previzualizarImagen").attr("src", respuesta["imagen"]);

			}

			if (respuesta["ruta_archivo"] != "") {
	
				$(".editarArchivo").val(respuesta["ruta_archivo"]);
				$("#descargarArchivo").attr("href", respuesta["ruta_archivo"]);

			}
	
		}

	})
	
})