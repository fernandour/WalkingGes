function registrar() {
	var parametros = {
		'f_nombre' : $('#f_nombre').val(),
		'f_usuario' : $('#f_nombre_usuario').val(),
		'f_email' : $('#f_email').val(),
		'f_password' : $('#f_password').val(),
		'f_password2' : $('#f_password2').val(),
		'f_fecha_nacimiento' : $('#f_fecha_nacimiento').val(),
		'f_genero' : $('#f_genero').val()
	}
	$.ajax({
		data:  parametros,
		url:   'registro.php?accion=registrar',
		type:  'post',
		success:  function (response) {
			if(response == "ok") {
				//Si los datos del registro son correctos, iniciamos sesión
				$.ajax({
					data:  parametros,
					url:   'index.php?accion=identificar',
					type:  'post',
					success:  function (response2) {
						if(response2 == "ok") {
							mostrar_ok();
							setTimeout('document.location = "inicio.php";', 2000);
						}
					}
				});
			} else {
				//Si los datos del registro no son correctos, mostramos el error
				$('#error_registro').html(response);
				$('#error_registro').show();
				$('#caja_registro').css('height', '410px');
			}
		}
	});
}