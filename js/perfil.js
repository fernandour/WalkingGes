function crear_ruta(id_usuario) {
	var parametros = {
		'id' : id_usuario,
		'titulo' : $('#f_titulo').val()
	}
	var fd = new FormData(),
		myFile = document.getElementById("f_archivo").files[0];
	fd.append('archivo',  myFile);
	
	
	//Comprobamos que se ha añadido un archivo con formato gpx
	if(myFile == undefined || myFile.name.substring(myFile.name.lastIndexOf('.')+1, myFile.name.length) != 'gpx') {
		if(myFile == undefined) {
			mostrar_mensaje("Debe añadir un archivo con formato gpx", 'N');
		} else if(myFile.name.substring(myFile.name.lastIndexOf('.')+1, myFile.name.length) != 'gpx') {
			mostrar_mensaje("El archivo tiene que estar en formato gpx", 'N');
		}
	} else {
		//Subimos la ruta
		$.ajax({
			url: 'perfil.php?accion=crear_ruta',
			data: parametros,
			type: 'POST',
			success: function(response){
				var ruta = response;
				//Añadimos la url a la ruta
				$.ajax({
					url: 'perfil.php?accion=subir_url&id='+ruta,
					data: fd,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function(response){
						if(response == 'Ok') {
							mostrar_ok();
							setTimeout("document.location='perfil.php?accion=rutas';", 2000);
						} else if(response == 'error') {
							mostrar_mensaje("Ha habido algún error al subir su archivo. Intentelo de nuevo", 'N');
						}
					}
				});
			}
		});
	}
}
function eliminar_ruta(id_ruta) {
	var parametros = {
		'id' : id_ruta
	}	
	$.ajax({
		url: 'perfil.php?accion=eliminar_ruta',
		data: parametros,
		type: 'POST',
		success: function(response){
			if(response == 'ruta_en_publicacion') {
				mostrar_mensaje("No se puede borrar está ruta porque se está utilizando en alguna publicación. Borre primero las publicaciones que usen esta ruta", 'N');
			} else if (response == 'Ok') {
				mostrar_mensaje("Ruta borrada", 'S');
			}
		}
	});
}