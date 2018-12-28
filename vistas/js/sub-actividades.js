/*========================================
= VALIDAR SUB-ACTIVIDAD REPETIDA           =
========================================*/
$(document).on("change", "#nuevaSubActividad", function(){

	$(".alert").remove();

	var subactividad  = $(this).val();

	var datos = new FormData();

	datos.append("subactividadValidar", subactividad);

	$.ajax({
		url : "ajax/subactividades.ajax.php",
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
  console.log("archivo", archivo);
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

