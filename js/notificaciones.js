function aceptar_amigo(id_usuario1, id_usuario2) {
	var parametros = {
		'id1' : id_usuario1,
		'id2' : id_usuario2
	}
	
	$.ajax({
		url: 'notificaciones.php?accion=aceptar_amigo',
		data: parametros,
		type: 'POST',
		success: function(response){
			mostrar_ok();
		}
	});
}

function rechazar_amigo(id_usuario1, id_usuario2) {
	var parametros = {
		'id1' : id_usuario1,
		'id2' : id_usuario2
	}
	
	$.ajax({
		url: 'notificaciones.php?accion=rechazar_amigo',
		data: parametros,
		type: 'POST',
		success: function(response){
			mostrar_mensaje("La solicitud de amistad ha sido rechazada", 'S');
		}
	});
}