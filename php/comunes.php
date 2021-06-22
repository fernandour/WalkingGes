<?php
function is_identificado() {
	if(isset($_SESSION["WG_identificacion"]) && $_SESSION["WG_identificacion"] == "S"){
		return 'S';
	} else {
		return 'N';
	}
}
function is_admin() {
	if(get_usuario($_SESSION["WG_usuario_id"])["Admin"] == 'S'){
		return 'S';
	} else {
		return 'N';
	}
}
function cerrar_sesion() {
	unset($_SESSION["WG_usuario_id"]);
	unset($_SESSION["WG_identificacion"]);
}
function cargar_inicio_sesion() {
	echo "<script language='javascript'> document.location = 'index.php'; </script>";
}
function get_usuario($id) {
	//Conseguimos los datos de un usuario
	$usuario = get_usuario_dao($id);
	return $usuario;
}
function get_amigos($id) {
	$privacidad = get_privacidad($id)['Amigos'];
	if($privacidad == 'Todos' || ($privacidad == 'SoloAmigos' && es_amigo($id, $_SESSION['WG_usuario_id']) == 'S') || $id == $_SESSION['WG_usuario_id']) {
		//Conseguimos los amigos de un usuario
		$registros1 = get_usuario2_amigos_dao($id);
		foreach($registros1 as &$registro) {
			$registro['Amigo'] = $registro['Usuario2'];
		}
		$registros2 = get_usuario1_amigos_dao($id);
		foreach($registros2 as &$registro) {
			$registro['Amigo'] = $registro['Usuario1'];
		}
		$registros = array_merge($registros1, $registros2);
	} else {
		$registros = array();
	}
	return $registros;
}
function get_imagen_perfil($id) {
	$usuario = get_usuario($id);
	$imagen_perfil = 'files/fotos_perfil/' . $id . '.jpg';
	if(!@file_get_contents($imagen_perfil)) {
		$imagen_perfil = 'files/fotos_perfil/' . $usuario['Genero'] . '.jpg';
	}
	return $imagen_perfil;
}
function get_genero($letra) {
	if($letra == 'h') {
		return 'hombre';
	} else if($letra == 'm') {
		return 'mujer';
	} else {
		return 'indefinido';
	}
}
function get_rutas($id_usuario) {
	//Conseguimos las rutas de un usuario
	$rutas = get_rutas_usuario_dao($id_usuario);
	return $rutas;
}

//Devuelve el estado de amigo (Amigos, no amigos, pendiente, pendiente de respuesta)
function es_amigo($id_usuario1, $id_usuario2) {
	$registro = get_amigos_estado_dao($id_usuario1, $id_usuario2);
	if(isset($registro)) {
		if($registro['Estado'] == 'Aceptado') {
			$estado = "S";
		} else if($registro['Estado'] == 'Pendiente') {
			$estado = "Pendiente";
		}
	} else {
		$registro = get_amigos_estado_dao($id_usuario2, $id_usuario1);
		if(isset($registro)) {
			if($registro['Estado'] == 'Aceptado') {
				$estado = "S";
			} else if($registro['Estado'] == 'Pendiente') {
				$estado = "NotificacionPendiente";
			}
		} else {
			$estado = "N";
		}
	}
	return $estado;
}

function construir_publicaciones($publicaciones) {
	foreach($publicaciones as &$publicacion) {
		//Añadimos la ruta a las publicaciones
		$ruta = get_ruta_url_dao($publicacion['Ruta']);
		$publicacion['Mapa'] = $ruta['URL'];
		
		//Añadimos las imagenes a las publicaciones
		$fotos = get_url_fotos_publicacion_dao($publicacion['id']);
		$publicacion['num_fotos'] = count($fotos);
		foreach($fotos as &$foto) {
			$foto = $foto['URL'];
		}
		$publicacion['Fotos'] = $fotos;
		$publicacion['ancho_carrusel'] = count($fotos) * 534;	
	}
	return $publicaciones;
}
function construir_publicaciones_mini($publicaciones) {
	foreach($publicaciones as &$publicacion) {
		//Añadimos la ruta a las publicaciones
		$ruta = get_ruta_url_dao($publicacion['Ruta']);
		$publicacion['Mapa'] = $ruta['URL'];
		
		//Añadimos las imagenes a las publicaciones
		$fotos = get_url_fotos_publicacion_dao($publicacion['id']);
		$publicacion['num_fotos'] = count($fotos);
		foreach($fotos as &$foto) {
			$foto = $foto['URL'];
		}
		$publicacion['Fotos'] = $fotos;
		$publicacion['ancho_carrusel'] = count($fotos) * 384;	
	}
	return $publicaciones;
}
function get_numero_notificaciones($id_usuario) {
	//Conseguimos el número de notificaciones pendientes
	$num_notificaciones = get_num_solicitudes_pendientes_usuario_dao($id_usuario);
	return $num_notificaciones;
}
function get_numero_publicaciones_pendientes() {
	//Conseguimos el número de publicaciones pendientes
	$num_publicaciones_pendientes = get_num_publicaciones_pendientes_dao();
	return $num_publicaciones_pendientes;
}
function mostrar_fecha($fecha_completa) {
	$fecha = explode(" ", $fecha_completa);
	$fecha_dias = explode("-", $fecha[0]);
	$fecha_horas = explode(":", $fecha[1]);
	
	if($fecha_dias[1] == '01') {
		$fecha_dias[1] = 'enero';
	} else if($fecha_dias[1] == '02') {
		$fecha_dias[1] = 'febrero';
	} else if($fecha_dias[1] == '03') {
		$fecha_dias[1] = 'marzo';
	} else if($fecha_dias[1] == '04') {
		$fecha_dias[1] = 'abril';
	} else if($fecha_dias[1] == '05') {
		$fecha_dias[1] = 'mayo';
	} else if($fecha_dias[1] == '06') {
		$fecha_dias[1] = 'junio';
	} else if($fecha_dias[1] == '07') {
		$fecha_dias[1] = 'julio';
	} else if($fecha_dias[1] == '08') {
		$fecha_dias[1] = 'agosto';
	} else if($fecha_dias[1] == '09') {
		$fecha_dias[1] = 'septiembre';
	} else if($fecha_dias[1] == '10') {
		$fecha_dias[1] = 'octubre';
	} else if($fecha_dias[1] == '11') {
		$fecha_dias[1] = 'noviembre';
	} else if($fecha_dias[1] == '12') {
		$fecha_dias[1] = 'diciembre';
	}
	
	return $fecha_dias[2] . ' de ' . $fecha_dias[1] . ' de ' . $fecha_dias[0] . ' a las ' . $fecha_horas[0] . ':' . $fecha_horas[1];
}
function mostrar_fecha_sin_hora($fecha_completa, $mostrar_año) {
	$fecha = explode(" ", $fecha_completa);
	$fecha_dias = explode("-", $fecha[0]);
	
	if($fecha_dias[1] == '01') {
		$fecha_dias[1] = 'enero';
	} else if($fecha_dias[1] == '02') {
		$fecha_dias[1] = 'febrero';
	} else if($fecha_dias[1] == '03') {
		$fecha_dias[1] = 'marzo';
	} else if($fecha_dias[1] == '04') {
		$fecha_dias[1] = 'abril';
	} else if($fecha_dias[1] == '05') {
		$fecha_dias[1] = 'mayo';
	} else if($fecha_dias[1] == '06') {
		$fecha_dias[1] = 'junio';
	} else if($fecha_dias[1] == '07') {
		$fecha_dias[1] = 'julio';
	} else if($fecha_dias[1] == '08') {
		$fecha_dias[1] = 'agosto';
	} else if($fecha_dias[1] == '09') {
		$fecha_dias[1] = 'septiembre';
	} else if($fecha_dias[1] == '10') {
		$fecha_dias[1] = 'octubre';
	} else if($fecha_dias[1] == '11') {
		$fecha_dias[1] = 'noviembre';
	} else if($fecha_dias[1] == '12') {
		$fecha_dias[1] = 'diciembre';
	}
	if($mostrar_año == 'S') {
		return $fecha_dias[2] . ' de ' . $fecha_dias[1] . ' de ' . $fecha_dias[0];
	} else {
		return $fecha_dias[2] . ' de ' . $fecha_dias[1];
	}
}

function get_privacidad($id_usuario) {
	$privacidad = get_privacidad_usuario_dao($id_usuario);
	return $privacidad;
}