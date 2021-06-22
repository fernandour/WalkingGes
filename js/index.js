function identificar() {
	var parametros = {
		'f_usuario' : $('#f_nombre_usuario').val(),
		'f_password' : $('#f_password').val()
	}

	$.ajax({
		data:  parametros,
		url:   'index.php?accion=identificar',
		type:  'post',
		success:  function (response) {
			if(response == "ok") {
				document.location = "inicio.php";
			} else {
				$('#error_identificacion').show();
				$('#caja_identificar').css('height', '250px');
			}
		}
	});
}