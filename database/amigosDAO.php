<?php
function crear_amigos_dao($usuario1, $usuario2, $estado, $fecha) {
	$sql = "INSERT INTO Amigos (Usuario1, Usuario2, Estado, Fecha)
			VALUES ($usuario1, $usuario2, '$estado', '$fecha')";
	query_ejecutar($sql);
}
function get_amigos_dao($usuario1, $usuario2) {
	$sql = "SELECT
				id
			FROM
				Amigos
			WHERE
				Amigos.Usuario1 = $usuario1
				AND Amigos.Usuario2 = $usuario2";
	$registro = query_registro($sql);
	return $registro;
}
function get_usuario1_amigos_dao($id_usuario2) {
	$sql = "SELECT
				Usuario1
            FROM
              Amigos
            WHERE
				Amigos.Estado = 'Aceptado'
				AND Amigos.Usuario2 = $id_usuario2";
	$registros = query_registros($sql);
	return $registros;
}
function get_usuario2_amigos_dao($id_usuario1) {
	$sql = "SELECT
				Usuario2
            FROM
              Amigos
            WHERE
				Amigos.Estado = 'Aceptado'
				AND Amigos.Usuario1 = $id_usuario1";
	$registros = query_registros($sql);
	return $registros;
}
function get_amigos_estado_dao($id_usuario1, $id_usuario2) {
	$sql = "SELECT
				Amigos.Estado
			FROM
				Amigos
			WHERE
				Amigos.Usuario1 = $id_usuario1
				AND Amigos.Usuario2 = $id_usuario2";
	$registro = query_registro($sql);
	return $registro;
}
function get_amigos_pendientes_dao($id_usuario) {
	$sql = "SELECT
				id,
				Usuario1 as Amigo
            FROM
              Amigos
            WHERE
				Amigos.Estado = 'Pendiente'
				AND Amigos.Usuario2 = $id_usuario";
	$registros = query_registros($sql);
	return $registros;
}
function get_num_solicitudes_pendientes_usuario_dao($id_usuario) {
	$sql = "SELECT
				COUNT(*) AS Num_notificaciones
            FROM
              Amigos
            WHERE
				Amigos.Estado = 'Pendiente'
				AND Amigos.Usuario2 = $id_usuario";
	$registro = query_registro($sql);
	$num_notificaciones = $registro['Num_notificaciones'];
	return $num_notificaciones;
}
function eliminar_amigos_usuario_dao($id_usuario) {
	$sql = "DELETE FROM Amigos
			WHERE Usuario1 = $id_usuario OR Usuario2 = $id_usuario";
	query_ejecutar($sql);
}
function actualizar_estado_amigos_dao($fecha, $estado, $id_usuario1, $id_usuario2) {
	$sql = "UPDATE
				Amigos
			SET
				Fecha = '$fecha',
				Estado = '$estado'
			WHERE
				Usuario1 = $id_usuario1
				AND Usuario2 = $id_usuario2";
	query_ejecutar($sql);
}
function eliminar_amigo_dao($usuario1, $usuario2) {
	$sql = "DELETE FROM Amigos
			WHERE
				Usuario1 = $usuario1
				AND Usuario2 = $usuario2";
	query_ejecutar($sql);
}
function eliminar_amigo_id_dao($id_amigo) {
	$sql = "DELETE FROM Amigos
			WHERE id = $id_amigo";
	query_ejecutar($sql);
}