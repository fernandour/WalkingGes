<?php
function get_publicaciones($amigos) {
	$id_usuario = $_SESSION['WG_usuario_id'];
	//Conseguimos las publicaciones verificadas de los amigos de un usuario
	$sql = "SELECT
                Publicaciones.id
                , Publicaciones.Fecha
                , Publicaciones.Titulo
                , Publicaciones.Descripcion
				, Publicaciones.Ruta
				, Usuarios.id AS id_usuario
                , AES_DECRYPT(Usuarios.Nombre, 'walkingges') AS Nombre
				, AES_DECRYPT(Usuarios.Usuario, 'walkingges') AS Usuario
            FROM
              Publicaciones, Usuarios
            WHERE
				Publicaciones.Estado = 'Publicada' AND
				((Publicaciones.Usuario = $id_usuario
                AND Usuarios.id = $id_usuario)";
	foreach($amigos as &$amigo) {
		$id_amigo = $amigo['Amigo'];
		$sql .= " OR (Publicaciones.Usuario = $id_amigo AND Usuarios.id = $id_amigo)";
	}
	$sql .= ") ORDER BY Fecha DESC";
	$publicaciones = query_registros($sql);
	$publicaciones = construir_publicaciones_mini($publicaciones);
	return $publicaciones;
}

function crear_publicacion() {
	$id_usuario = $_POST['id'];
	$titulo = recoger_texto($_POST['titulo']);
	$descripcion = recoger_texto($_POST['descripcion']);
	$ruta = $_POST['ruta'];
	date_default_timezone_set('Europe/Madrid');
	$fecha = date('Y-m-d H:i:s');
	
	$id_publicacion = crear_publicacion_dao($id_usuario, $fecha, $titulo, $descripcion, $ruta, 'Pendiente');
	return $id_publicacion;
}

function eliminar_publicacion(){
	$id = $_POST['id'];
	//Borramos las fotos de esa publicacion
	eliminar_fotos_publicacion_dao($id);
	//Borramos la publicacion
	eliminar_publicacion_dao($id);
	//Borramos los archivos
	$hay_foto = 'S';
	$num_foto = 0;
	for ($num_foto = 0; $hay_foto == 'S'; $num_foto++) {
		if(file_exists('files/fotos_publicaciones/' . $id . '_' . $num_foto . '.jpg')) {
			unlink('files/fotos_publicaciones/' . $id . '_' . $num_foto . '.jpg');
		} else {
			$hay_foto = 'N';
		}
	}
	
}

function subir_fotos_publicacion($id_publicacion) {
	$error = 'N';
	$subidavalida = 'S';
	$count = count($_FILES['myFiles']['tmp_name']);
	for ($i = 0; $i < $count; $i++) {
		$nombre_archivo = "files/fotos_publicaciones/" . $id_publicacion . "_" . $i . ".jpg";
		if(move_uploaded_file($_FILES['myFiles']['tmp_name'][$i], $nombre_archivo)) {
			crear_fotos_dao($id_publicacion, $nombre_archivo);
		} else {
			$subidavalida = 'N';
		}
	}
	if($subidavalida == 'N') {
		return 'Error';
	} else {
		return 'Ok';
	}
}
function get_personas_ranking() {
	$usuarios_ranking = get_usuarios_ranking_dao();
	return $usuarios_ranking;
}