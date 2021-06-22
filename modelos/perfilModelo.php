<?php
function get_publicaciones($id_usuario) {
	$privacidad = get_privacidad($id_usuario)['Publicaciones'];
	if($privacidad == 'Todos' || ($privacidad == 'SoloAmigos' && es_amigo($id_usuario, $_SESSION['WG_usuario_id']) == 'S') || $id_usuario == $_SESSION['WG_usuario_id']) {
		//Conseguimos las publicaciones de un usuario
		$publicaciones = get_publicaciones_perfil_usuario_dao($id_usuario);
		/*
		$sql = "SELECT
	                Publicaciones.id
	                , Publicaciones.Fecha
	                , Publicaciones.Titulo
	                , Publicaciones.Descripcion
					, Publicaciones.Ruta
					, Publicaciones.Estado
					, Usuarios.id AS id_usuario
					, AES_DECRYPT(Usuarios.Nombre, 'walkingges') AS Nombre
	                , AES_DECRYPT(Usuarios.Usuario, 'walkingges') AS Usuario
	            FROM
	              Publicaciones, Usuarios
	            WHERE
	                Publicaciones.Usuario = Usuarios.id
	                AND Usuarios.id = $id_usuario";
		if($id_usuario != $_SESSION['WG_usuario_id']) {
			$sql .= " AND Publicaciones.Estado = 'Publicada'";
		}
		$sql .= " ORDER BY
					Fecha DESC";
		$publicaciones = query_registros($sql);
		*/
		$publicaciones = construir_publicaciones($publicaciones);
	} else {
		$publicaciones = array();
	}
	return $publicaciones;
}

function add_amigo() {
	$id1 = $_POST['id1'];
	$id2 = $_POST['id2'];
	date_default_timezone_set('Europe/Madrid');
	$fecha = date('Y-m-d H:i:s');
	crear_amigos_dao($id1, $id2, 'Pendiente', $fecha);
}
function eliminar_amigo() {
	$id1 = $_POST['id1'];
	$id2 = $_POST['id2'];
	$registro = get_amigos_dao($id1, $id2);
	if(isset($registro)) {
		$id_borrar = $registro['id'];
	} else {
		$registro = get_amigos_dao($id2, $id1);
		if(isset($registro)) {
			$id_borrar = $registro['id'];
		}
	}
	
	eliminar_amigo_id_dao($id_borrar);
}
function crear_ruta() {
	$id_usuario = $_POST['id'];
	$titulo = recoger_texto($_POST['titulo']);
	$id_ruta = crear_ruta_dao($id_usuario, $titulo, '');
	return $id_ruta;
}
function eliminar_ruta() {
	$id_ruta = $_POST['id'];
	//Contamos las publicaciones con esa ruta
	$num_publicaciones_ruta = get_num_publicaciones_ruta_dao($id_ruta);
	if($num_publicaciones_ruta > 0) {
		return 'ruta_en_publicacion';
	} else {
		eliminar_ruta_dao($id_ruta);
		unlink('files/rutas/' . $id_ruta . '.gpx');
		return 'Ok';
	}
}
function subir_url() {
	$id_ruta = $_GET['id'];
	$nombre_archivo = "files/rutas/" . $id_ruta . ".gpx";
	if(move_uploaded_file($_FILES['archivo']['tmp_name'], $nombre_archivo)) {
		actualizar_url_ruta_dao($id_ruta, $nombre_archivo);
		return 'Ok';
	} else {
		return 'error';
	}
}