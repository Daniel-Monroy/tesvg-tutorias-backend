function validadCarreraCrear(item, valor, input, mensaje){

	$(".alert").remove();
	
	var datos = new FormData();

	datos.append("item", item);

	datos.append("valor", valor);

	$.ajax({
		url: rutaOcultaServidor+"ajax/carreras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			if (!respuesta) {

			} else {
				$(input).parent().after('<br> <div class="alert alert-warning">'+mensaje+'</div>');
				
				$(input).val("");
			}
		}
	});

}
/*==================
= VALIDAR CREACIÓN DE LA CARRERA =
==================*/
$(document).on("change", "#nuevaCarrera", function(){

	var valor = $(this).val();

	var item = "carrera";

	var input = "#nuevaCarrera";

	var mensaje = "Esta carrera ya existe en la base de datos";

	validadCarreraCrear(item, valor, input, mensaje);
});
/*==================
= VALIDAR CREACIÓN DEL JEFE =
==================*/
$(document).on("change", "#nuevoJefeCarrera", function(){

	var valor = $(this).val();

	var item = "id_jefe";

	var input = "#nuevoJefeCarrera";

	var mensaje = "Este Jefe de División ya ha sido asignado a alguna carrera en la base de datos";

	validadCarreraCrear(item, valor, input, mensaje);

});
/*==================
= VALIDAR CREACIÓN DEL COORDINADOR=
==================*/
$(document).on("change", "#nuevoCoordinadorCarrera", function(){

	var valor = $(this).val();

	var item = "id_coordinador";

	var input = "#nuevoCoordinadorCarrera";

	var mensaje = "Este Coordinador ya ha sido asignado a alguna carrera en la base de datos";

	validadCarreraCrear(item, valor, input, mensaje);

});


/*==================
= EDITAR CARRERA   =
==================*/
$(document).on("click", ".btnEditarCarrera", function(){

	var idEditarCarrera = $(this).attr("idCarrera");

	var datos = new FormData();

	datos.append("idEditarCarrera", idEditarCarrera);

	$.ajax({
		url: rutaOcultaServidor+"ajax/carreras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			
			$("#idCarrera").val(respuesta["id"]);
			
			//Carrera
			$("#editarCarrera").val(respuesta["carrera"]);
			$("#carreraActual").val(respuesta["carrera"]);
			
			$("#editarDescripcionCarrera").val(respuesta["descripcion"]);


			/*==================
			= JEFE DE DIVICIÓN =
			==================*/
			var idJefeDivicion = respuesta["id_jefe"];

			var datos1 = new FormData();

			datos1.append("idUsuario", idJefeDivicion);

			$.ajax({
				url: rutaOcultaServidor+"ajax/usuarios.ajax.php",
				method: "POST",
				data: datos1,
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				success: function(respuesta1){	
					$("#editarJefeCarreraVal").val(respuesta1["id"]);
					$("#editarJefeCarreraVal").html(respuesta1["nombre"]+" "+respuesta1["apellidos"]);
				
					//OCULTOS
					$("#editarJefeCarreraValHidden").val(respuesta1["id"]);
					$("#editarJefeCarreraHtmlHidden").val(respuesta1["nombre"]+" "+respuesta1["apellidos"]);

				}

			})


			/*==================
			= JEFE DE COORDINADOR =
			==================*/
			var idCoordinador = respuesta["id_coordinador"];

			var datos2 = new FormData();

			datos2.append("idUsuario", idCoordinador);

			$.ajax({
				url: rutaOcultaServidor+"ajax/usuarios.ajax.php",
				method: "POST",
				data: datos2,
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				success: function(respuesta2){	
					
					$("#editarCoordinadorCarreraVal").val(respuesta2["id"]);
					$("#editarCoordinadorCarreraVal").html(respuesta2["nombre"]+" "+respuesta2["apellidos"]);

					//OCULTOS
					$("#editarCoordinadorCarreraValHidden").val(respuesta2["id"]);
					$("#editarCoordinadorCarreraHTMLHidden").val(respuesta2["nombre"]+" "+respuesta2["apellidos"]);


				}

			})

		}
	})	

});


/*==================
= VALIDAR EDICION DE LA CARRERA =
==================*/
function validadEditarCarrera(item, valor, input, inputMensaje, mensaje, valorActualVal, valorActualHtml){

	$(".alert").remove();
	
	var datos = new FormData();

	datos.append("item", item);

	datos.append("valor", valor);

	$.ajax({
		url: rutaOcultaServidor+"ajax/carreras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){		
			if (!respuesta) {
				
			} else {

				if (valorActualVal != respuesta[item]) {

					$(input).val(valorActualVal);

					if (valorActualHtml != null) {

						$(input).html(valorActualHtml);
						$(input).attr("selected", true);
					}

					$(inputMensaje).parent().after('<br> <div class="alert alert-warning">'+mensaje+'</div>');

				}
			}
		}
	});
}

$(document).on("change", "#editarCarrera", function(){

	//DATOS ACTUALES
	var valorActualVal = $("#carreraActual").val();
	var valorActualHtml = null;
	
	//PARA EL MENSAJE
	var input = "#editarCarrera";
	var inputMensaje = "#editarCarrera";
	var mensaje = "Esta carrera ya ha sido creada en la base de datos";
	
	//DATOS PARA LA BASE
	var item = "carrera";
	var valor = $("#editarCarrera").val();

	validadEditarCarrera(item, valor, input, inputMensaje, mensaje, valorActualVal, valorActualHtml);
})


/*==================
= VALIDAR EDICION DEl JEFE =
==================*/
$(document).on("change", "#editarJefeCarrera", function(){
	$("#editarJefeCarreraVal").attr("selected", false);
	//DATOS ACTUALES
	var valorActualVal = $("#editarJefeCarreraValHidden").val();
	var valorActualHtml = $("#editarJefeCarreraHtmlHidden").val();
	
	//PARA EL MENSAJE
	var input = "#editarJefeCarreraVal";
	var inputMensaje = "#editarJefeCarrera";
	var mensaje = "Este Jefe de Divición ya ha sido asignado a alguna carrera en la base de datos";
	
	//DATOS PARA LA BASE
	var item = "id_jefe";
	var valor = $("#editarJefeCarrera").val();

	validadEditarCarrera(item, valor, input, inputMensaje, mensaje, valorActualVal, valorActualHtml);

})




/*==================
= VALIDAR EDICION DEl COORDINADOR =
==================*/
$(document).on("change", "#editarCoordinadorCarrera", function(){
	
	$("#editarCoordinadorCarreraVal").attr("selected", false);
	
	//DATOS ACTUALES
	var valorActualVal = $("#editarCoordinadorCarreraValHidden").val();
	var valorActualHtml = $("#editarCoordinadorCarreraHTMLHidden").val();
	
	//PARA EL MENSAJE
	var input = "#editarCoordinadorCarreraVal";
	var inputMensaje = "#editarCoordinadorCarrera";
	var mensaje = "Este Jefe de Coordinador ya ha sido asignado a alguna carrera en la base de datos";
	
	//DATOS PARA LA BASE
	var item = "id_coordinador";
	var valor = $("#editarCoordinadorCarrera").val();

	validadEditarCarrera(item, valor, input, inputMensaje, mensaje, valorActualVal, valorActualHtml);

})





/*==================================
= ELIMINAR CARRERA     =
==================================*/
$(document).on("click", ".btnEliminarCarrera", function(){

	var idCarrera = $(this).attr("idCarrera");
	console.log("idCarrera", idCarrera);
	
	swal({
		title: '¿Está seguro de borrar la carrera?',
		text: '¡Si no lo ésta puede dar click en cancelar!',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085b6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar carrera'
		}).then((result)=>{

			if (result.value) {

	      		window.location = rutaOcultaServidor+"index.php?ruta=carreras&idCarreraEliminar="+idCarrera;
			
			}

		})

})