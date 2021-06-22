function panel(nombre_panel, accion) {
	if(accion == 'abrir') {
		if(nombre_panel == 'buscar') {
			var nombre_panel_2 = 'crear_publicacion';
		} else {
			var nombre_panel_2 = 'buscar';
		}
		panel(nombre_panel_2, 'cerrar');
		$('#panel_' + nombre_panel).show("slow");
		$('#opcion_' + nombre_panel).attr("onclick", "javascript: panel('" + nombre_panel + "', 'cerrar');");
	} else {
		$('#panel_' + nombre_panel).hide("slow");
		$('#opcion_' + nombre_panel).attr("onclick", "javascript: panel('" + nombre_panel + "', 'abrir');");
	}
}
function crear_publicacion(id_usuario) {
	var parametros = {
		'id' : id_usuario,
		'titulo' : $('#f_titulo').val(),
		'descripcion' : $('#f_descripcion').val(),
		'ruta' : $('#f_ruta').val()
	}
	var fd = new FormData(),
		myFiles = document.getElementById("f_imagenes");
	
	//Comprobamos que se ha seleccionado ruta y que se han añadido imágenes
	if(($('#f_ruta').val() == '0') || (myFiles.files.length == 0 || myFiles.files.length > 30)){
		if($('#f_ruta').val() == '0') {
			mostrar_mensaje("Debe elegir una ruta", 'N');
		} else if (myFiles.files.length == 0){
			mostrar_mensaje("Debe añadir, al menos, una imagen", 'N');
		} else if (myFiles.files.length > 30){
			mostrar_mensaje("No se pueden subir más de 30 fotos por publicación", 'N');
		}
	} else {
		//Creamos la publicación
		$.ajax({
			url: 'inicio.php?accion=crear_publicacion',
			data: parametros,
			type: 'POST',
			success: function(response){
				var publicacion = response;
				for (var i = 0; i < myFiles.files.length; i++) {
					fd.append('myFiles[' + i + ']', myFiles.files[i]);
				}
				//Añadimos las imágenes a la publicación
				$.ajax({
					url: 'inicio.php?accion=subir_fotos_publicacion&id='+publicacion,
					data: fd,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function(response){
						if(response == "Formato erroneo"){
							mostrar_mensaje("El formato del archivo no está permitido, inserte imagenes en un formato valido", 'N');
						} else if (response == "Error") {
							mostrar_mensaje("Ha habido algún fallo. Compruebe que los archivos son imágenes", 'N');
						} else if (response == "Ok") {
							mostrar_mensaje("Tu publicación ha sido enviada para revisión", 'S');
						}
					}
				});
			}
		});
	}
}