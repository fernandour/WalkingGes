<?php
function crear_ruta_dao($id_usuario, $nombre, $url) {
	$sql = "INSERT INTO
					Rutas (Usuario, Nombre, URL)
				VALUES
					('$id_usuario', $nombre, '$url')";
	error_log($sql);
	return query_ejecutar_id($sql);
}
function get_rutas_usuario_dao($id_usuario) {
	$sql = "SELECT
                Rutas.id
                , Rutas.Nombre
				, Rutas.URL
            FROM
              Rutas
            WHERE
                Rutas.Usuario = $id_usuario";
	$rutas = query_registros($sql);
	return $rutas;
}
function get_ruta_url_dao($id_ruta) {
	$sql = "SELECT
				URL
			FROM
				Rutas
			WHERE
				Rutas.id = " . $id_ruta;
	$ruta = query_registro($sql);
	return $ruta;
}
function eliminar_rutas_usuario_dao($id_usuario) {
	$sql = "DELETE FROM Rutas
			WHERE Usuario = $id_usuario";
	query_ejecutar($sql);
}
function eliminar_ruta_dao($id_ruta) {
	$sql = "DELETE FROM Rutas
			WHERE id = $id_ruta";
	query_ejecutar($sql);
}
function actualizar_url_ruta_dao($id_ruta, $url) {
	$sql = "UPDATE
				Rutas
			SET
				URL = '$url'
			WHERE
				id = $id_ruta";
	query_ejecutar($sql);
}