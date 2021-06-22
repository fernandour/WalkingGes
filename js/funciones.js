function mostrar_ok() {
	$('#contenedor_popup').show();
	$('#popup_ok').show();
	document.getElementsByTagName("body")[0].style = "overflow: hidden";
	setTimeout('$("#popup_ok").fadeOut(500);', 1500);
	setTimeout('$("#contenedor_popup").fadeOut(500);', 1500);
	setTimeout('document.getElementsByTagName("body")[0].style = "overflow: auto";', 2000);
	setTimeout('location.reload();', 2000);
}
function mostrar_mensaje(mensaje, recargar) {
	$('#contenedor_popup').show();
	$('#popup_mensaje_mensaje').html(mensaje);
	$('#popup_mensaje').show();
	document.getElementsByTagName("body")[0].style = "overflow: hidden";
	setTimeout('$("#popup_mensaje").fadeOut(500);', 4500);
	setTimeout('$("#contenedor_popup").fadeOut(500);', 4500);
	setTimeout('document.getElementsByTagName("body")[0].style = "overflow: auto";', 5000);
	if(recargar == 'S') {
		$('#popup_mensaje_cerrar').attr("onclick", "javascript: cerrar_mensaje('S');");
		setTimeout('location.reload();', 5000);
	}
}
function cerrar_mensaje(recargar) {
	$("#popup_mensaje").hide();
	$("#contenedor_popup").hide();
	document.getElementsByTagName("body")[0].style = "overflow: auto";
	if(recargar == 'S') {
		location.reload();
	}
}
function mostrar_mensaje_confirmacion(mensaje, link_si, cerrar_contenedor_popup) {
	$('#contenedor_popup').show();
	$('#popup_mensaje_confirmacion_mensaje').html(mensaje);
	$('#popup_mensaje_confirmacion_si').attr("onclick", link_si + " cerrar_mensaje_confirmacion('" + cerrar_contenedor_popup + "');");
	$('#popup_mensaje_confirmacion').show();
	document.getElementsByTagName("body")[0].style = "overflow: hidden";
}
function cerrar_mensaje_confirmacion(cerrar_contenedor_popup) {
	$("#popup_mensaje_confirmacion").hide();
	if(cerrar_contenedor_popup == 'S') {
		$("#contenedor_popup").hide();
		document.getElementsByTagName("body")[0].style = "overflow: auto";
	}
}
function desplazar_carrusel(id, direccion) {
	if(direccion == 'derecha'){
		if($('#semaforo').val() == 'true') {
			$('#semaforo').val('false');
			izq_actual = parseInt($('#carrusel_' + id).css("left"));
			izq_final = izq_actual - 534;
			ancho = parseInt($('#carrusel_' + id).width()) - 534;
			izq_positivo = izq_final * (-1);
			if(izq_positivo <= ancho) {
				$('#flecha_izquierda_' + id).show("medium");
			} 
			if(izq_positivo >= ancho) {
				$('#flecha_derecha_' + id).hide("medium");
			}
			$('#carrusel_' + id).animate({'left': izq_final}, "fast");
			setTimeout("$('#semaforo').val('true')", 300);
		}
	} else if(direccion == 'izquierda'){
		if($('#semaforo').val() == 'true') {
			$('#semaforo').val('false');
			izq_actual = parseInt($('#carrusel_' + id).css("left"));
				izq_final = izq_actual + 534;
			if(izq_final >= 0) {
				izq_final = 0;
				$('#flecha_izquierda_' + id).hide("medium");
			}
			if(izq_final <= 0) {
				$('#flecha_derecha_' + id).show("medium");
			}
			$('#carrusel_' + id).animate({'left': izq_final}, "fast");
			setTimeout("$('#semaforo').val('true')", 300);
		}
	}
}
function desplazar_carrusel_mini(id, direccion) {
	if(direccion == 'derecha'){
		if($('#semaforo').val() == 'true') {
			$('#semaforo').val('false');
			izq_actual = parseInt($('#carrusel_' + id).css("left"));
			izq_final = izq_actual - 384;
			ancho = parseInt($('#carrusel_' + id).width()) - 384;
			izq_positivo = izq_final * (-1);
			if(izq_positivo <= ancho) {
				$('#flecha_izquierda_' + id).show("medium");
			} 
			if(izq_positivo >= ancho) {
				$('#flecha_derecha_' + id).hide("medium");
			}
			$('#carrusel_' + id).animate({'left': izq_final}, "fast");
			setTimeout("$('#semaforo').val('true')", 300);
		}
	} else if(direccion == 'izquierda'){
		if($('#semaforo').val() == 'true') {
			$('#semaforo').val('false');
			izq_actual = parseInt($('#carrusel_' + id).css("left"));
				izq_final = izq_actual + 384;
			if(izq_final >= 0) {
				izq_final = 0;
				$('#flecha_izquierda_' + id).hide("medium");
			}
			if(izq_final <= 0) {
				$('#flecha_derecha_' + id).show("medium");
			}
			$('#carrusel_' + id).animate({'left': izq_final}, "fast");
			setTimeout("$('#semaforo').val('true')", 300);
		}
	}
}

function add_amigo(id_usuario1, id_usuario2) {
	var parametros = {
		'id1' : id_usuario1,
		'id2' : id_usuario2
	}
	
	$.ajax({
		url: 'perfil.php?accion=add_amigo',
		data: parametros,
		type: 'POST',
		success: function(response){
			mostrar_mensaje("Tu solicitud de amistad ha sido enviada", 'S');
		}
	});
}

function eliminar_amigo_funcion(id_usuario1, id_usuario2) {
	var parametros = {
		'id1' : id_usuario1,
		'id2' : id_usuario2
	}
	
	$.ajax({
		url: 'perfil.php?accion=eliminar_amigo',
		data: parametros,
		type: 'POST',
		success: function(){
		}
	});
}

function eliminar_amigo(id_usuario1, id_usuario2) {
	eliminar_amigo_funcion(id_usuario1, id_usuario2);
	mostrar_mensaje("Ya no sois amigos", 'S');
}
function eliminar_solicitud(id_usuario1, id_usuario2) {
	eliminar_amigo_funcion(id_usuario1, id_usuario2);
	mostrar_mensaje("Solicitud de amistad cancelada", 'S');
}
function buscar() {
	if($('#cuadro_busqueda').val().length > 2) {
		document.location = "buscar.php?busqueda=" + $('#cuadro_busqueda').val();
	} else {
		mostrar_mensaje("Debe introducir al menos tres caracteres para realizar la búsqueda", 'S');
	}
}
function eliminar_publicacion(id_publicacion) {
	var parametros = {
		'id' : id_publicacion
	}
	
	$.ajax({
		url: 'inicio.php?accion=eliminar_publicacion',
		data: parametros,
		type: 'POST',
		success: function(response){
			mostrar_mensaje("La publicación ha sido borrada", 'S');
		}
	});
}
function mostrar_fecha(fecha) {
	var fecha_final = '';
	//Día
	fecha_final = fecha_final + fecha.getDate() + ' ';
	//Mes
	var mes = fecha.getMonth();
	if(mes == 0) {
		fecha_final = fecha_final + 'enero ';
	} else if(mes == 1) {
		fecha_final = fecha_final + 'febrero ';
	} else if(mes == 2) {
		fecha_final = fecha_final + 'marzo ';
	} else if(mes == 3) {
		fecha_final = fecha_final + 'abril ';
	} else if(mes == 4) {
		fecha_final = fecha_final + 'mayo ';
	} else if(mes == 5) {
		fecha_final = fecha_final + 'junio ';
	} else if(mes == 6) {
		fecha_final = fecha_final + 'julio ';
	} else if(mes == 7) {
		fecha_final = fecha_final + 'agosto ';
	} else if(mes == 8) {
		fecha_final = fecha_final + 'septiembre ';
	} else if(mes == 9) {
		fecha_final = fecha_final + 'octubre ';
	} else if(mes == 10) {
		fecha_final = fecha_final + 'noviembre ';
	} else if(mes == 11) {
		fecha_final = fecha_final + 'diciembre ';
	}
	//Año
	fecha_final = fecha_final + fecha.getFullYear() + ' a las ';
	
	//Hora
	var hora = fecha.getHours();
	if(hora > 9) {
		fecha_final = fecha_final + hora + ':';
	} else {
		fecha_final = fecha_final + '0' + hora + ':';
	}
	
	//Minutos
	var minutos = fecha.getMinutes();
	if(minutos > 9) {
		fecha_final = fecha_final + minutos;
	} else {
		fecha_final = fecha_final + '0' + minutos;
	}
	return fecha_final;
}
function mostrar_tiempo(tiempo) {
	var horas = 0;
	var minutos = 0;
	var segundos = 0;
	//Calculamos los segundos
	segundos = tiempo / 1000;
	
	//Calculamos los minutos
	while(segundos > 59) {
		minutos = minutos + 1;
		segundos = segundos - 60;
	}
	
	//Calculamos las horas
	while(minutos > 59) {
		horas = horas + 1;
		minutos = minutos - 60;
	}
	
	if(minutos < 10) {
		minutos = '0' + minutos;
	}
	if(segundos < 10) {
		segundos = '0' + segundos;
	}
	if(horas > 1) {
		return horas + ':' + minutos + ':' + segundos;
	} else {
		return minutos + ':' + segundos;
	}
}
function ver_datos_mapa(id_publicacion) {
	if($('#datos_mapa_' + id_publicacion).is(":visible")) {
		$('#datos_mapa_' + id_publicacion).hide("medium");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha1").css("transform", "rotate(0deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha2").css("transform", "rotate(0deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha3").css("transform", "rotate(0deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha4").css("transform", "rotate(0deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha5").css("transform", "rotate(0deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha6").css("transform", "rotate(0deg)");
	} else {
		$('#datos_mapa_' + id_publicacion).show("medium");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha1").css("transform", "rotate(180deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha2").css("transform", "rotate(180deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha3").css("transform", "rotate(180deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha4").css("transform", "rotate(180deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha5").css("transform", "rotate(180deg)");
		$("#ver_datos_mapa_" + id_publicacion + "_flecha6").css("transform", "rotate(180deg)");
	}
}