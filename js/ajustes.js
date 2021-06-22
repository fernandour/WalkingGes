function guardar_datos_usuario(id_usuario) {
	var parametros = {
		'id' : id_usuario,
		'nombre' : $('#nombre').val(),
		'nombre_usuario' : $('#nombre_usuario').val(),
		'email' : $('#email').val(),
		'password1' : $('#password1').val(),
		'password2' : $('#password2').val(),
		'fecha_nacimiento' : $('#fecha_nacimiento').val(),
		'genero' : $('#genero').val()
	}
	$.ajax({
		data:  parametros,
		url:   'ajustes.php?accion=guardar_datos_usuario',
		type:  'post',
		success:  function (response) {
			if(response == 'ok') {
				//Si los datos se modifican, mostramos verificación
				if($('#password1').val() != '' && $('#password2').val() != '') {
					$('#password').val($('#password1').val());
				}
				$('#password1').val('');
				$('#password2').val('');
				mostrar_ok();
			} else {
				//Si los datos no son correctos, mostramos el error
				$('#error_datos_usuario').html(response);
				$('#error_datos_usuario').show();
			}
		}
	});
}
function subir_imagen(id) {
	var fd = new FormData(),
		myFile = document.getElementById("archivo").files[0];
	fd.append('archivo',  myFile);
	if(myFile == undefined) {
		mostrar_mensaje("Debe seleccionar una imagen", 'N');
	} else {
		$.ajax({
			url: 'ajustes.php?accion=subir_foto_perfil&id='+id,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(response){
				if(response == "Formato erroneo"){
					mostrar_mensaje("El formato del archivo no está permitido, inserte una imagen", 'N');
				} else if (response == "Error") {
					mostrar_mensaje("Ha habido algún fallo. Compruebe que el archivo es una imagen", 'N');
				} else if (response == "Ok") {
					mostrar_ok();
				}
			}
		});
	}
}
function guardar_privacidad(id_usuario) {
	var rb_publicaciones = $('[name="rb_publicaciones"]');
	for (var i = 0; i < rb_publicaciones.length; i++) {
		if(rb_publicaciones[i].checked == true) {
			var publicaciones = rb_publicaciones[i].value;
		}
	}
	var rb_amigos = $('[name="rb_amigos"]');
	for (var i = 0; i < rb_amigos.length; i++) {
		if(rb_amigos[i].checked == true) {
			var amigos = rb_amigos[i].value;
		}
	}
	var rb_email = $('[name="rb_email"]');
	for (var i = 0; i < rb_email.length; i++) {
		if(rb_email[i].checked == true) {
			var email = rb_email[i].value;
		}
	}
	var rb_fecha_nacimiento = $('[name="rb_fecha_nacimiento"]');
	for (var i = 0; i < rb_fecha_nacimiento.length; i++) {
		if(rb_fecha_nacimiento[i].checked == true) {
			var fecha_nacimiento = rb_fecha_nacimiento[i].value;
		}
	}
	var cb_año_nacimiento = $('#cb_año_nacimiento');
	if(cb_año_nacimiento[0].checked == true) {
		var año_nacimiento = 'S';
	} else {
		var año_nacimiento = 'N';
	}
	var rb_genero = $('[name="rb_genero"]');
	for (var i = 0; i < rb_genero.length; i++) {
		if(rb_genero[i].checked == true) {
			var genero = rb_genero[i].value;
		}
	}
	
	var parametros = {
		'id_usuario' : id_usuario,
		'publicaciones' : publicaciones,
		'amigos' : amigos,
		'email' : email,
		'fecha_nacimiento' : fecha_nacimiento,
		'año_nacimiento' : año_nacimiento,
		'genero' : genero
	}
	$.ajax({
		data:  parametros,
		url:   'ajustes.php?accion=guardar_privacidad',
		type:  'post',
		success:  function (response) {
			mostrar_ok();
		}
	});
}
function eliminar_cuenta(id_usuario) {
	var parametros = {
		'id_usuario' : id_usuario
	}
	$.ajax({
		data:  parametros,
		url:   'ajustes.php?accion=eliminar_cuenta',
		type:  'post',
		success:  function () {
			mostrar_mensaje("Tu cuenta ha sido eliminada con éxito", "N");
			setTimeout("document.location = 'index.php';", 3000);
		}
	});
}