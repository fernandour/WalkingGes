<?php
function crear_publicacion_dao($id_usuario, $fecha, $titulo, $descripcion, $ruta, $estado) {
	$sql = "INSERT INTO
					Publicaciones (Usuario, Fecha, Titulo, Descripcion, Ruta, Estado)
				VALUES
					('$id_usuario', '$fecha', $titulo, $descripcion, '$ruta', 'Pendiente')";
	return query_ejecutar_id($sql);
}
function get_publicaciones_id_dao($id_publicacion) {
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
					Publicaciones.id = $id_publicacion AND
					Publicaciones.Usuario = Usuarios.id";
		$publicaciones = query_registros($sql);
		return $publicaciones;
}
function get_id_usuario_publicacion_dao($id_publicacion) {
	$sql = "SELECT
				Usuario
			FROM
				Publicaciones
			WHERE
				id = $id_publicacion";
	$id_usuario = query_registro($sql)['Usuario'];
	return $id_usuario;
}
function get_publicaciones_pendientes_dao() {
	//Conseguimos las publicaciones pendientes
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
				Publicaciones.Estado = 'Pendiente'
				AND Publicaciones.Usuario = Usuarios.id
			ORDER BY
				Fecha ASC";
	$publicaciones = query_registros($sql);
	return $publicaciones;
}
function aprobar_publicacion_dao($id) {
	$sql = "UPDATE Publicaciones
			SET Estado = 'Publicada'
			WHERE id = $id";
	query_ejecutar($sql);
}
function rechazar_publicacion_dao($id) {
	$sql = "UPDATE Publicaciones
			SET Estado = 'Rechazada'
			WHERE id = $id";
	query_ejecutar($sql);
}
function get_num_publicaciones_pendientes_dao() {
	$sql = "SELECT
				COUNT(*) as Num_publicaciones_pendientes
            FROM
              Publicaciones
            WHERE
				Publicaciones.Estado = 'Pendiente'";
	$registro = query_registro($sql);
	$num_publicaciones_pendientes = $registro['Num_publicaciones_pendientes'];
	return $num_publicaciones_pendientes;
}
function get_publicaciones_usuario_dao($id_usuario) {
	$sql = "SELECT
				id
			FROM
				Publicaciones
			WHERE
				Usuario = $id_usuario";
	$publicaciones = query_registros($sql);
	return $publicaciones;
}
function get_publicaciones_perfil_usuario_dao($id_usuario) {
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
	return $publicaciones;
}
function eliminar_publicaciones_usuario_dao($id_usuario) {
	$sql = "DELETE FROM Publicaciones
			WHERE Usuario = $id_usuario";
	query_ejecutar($sql);
}
function eliminar_publicacion_dao($id_publicacion) {
	$sql = "DELETE FROM
				Publicaciones
			WHERE
				id = $id_publicacion";
	query_ejecutar($sql);
}
function get_num_publicaciones_ruta_dao($id_ruta) {
	$sql = "SELECT
				COUNT(*) AS Num_publicaciones
			FROM
				Publicaciones
			WHERE
				Ruta = $id_ruta";
	$registro = query_registro($sql);
	return $registro['Num_publicaciones'];
}