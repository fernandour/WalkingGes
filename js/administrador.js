function aprobar_publicacion(id_publicacion) {
	var parametros = {
		'id' : id_publicacion
	}
	
	$.ajax({
		url: 'administrador.php?accion=aprobar_publicacion',
		data: parametros,
		type: 'POST',
		success: function(response){
			mostrar_mensaje("La publicación ha sido aprobada", 'S');
		}
	});
}

function rechazar_publicacion(id_publicacion) {
	var parametros = {
		'id' : id_publicacion
	}
	
	$.ajax({
		url: 'administrador.php?accion=rechazar_publicacion',
		data: parametros,
		type: 'POST',
		success: function(response){
			mostrar_mensaje("La publicación ha sido rechazada", 'S');
		}
	});
}