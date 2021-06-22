<?php
function get_url_fotos_publicacion_dao($id_publicacion) {
	$sql = "SELECT
				Fotos.URL
			FROM
				Fotos
			WHERE
				Fotos.Publicacion = " . $id_publicacion;
	$fotos = query_registros($sql);
	return $fotos;
}
function crear_fotos_dao($id_publicacion, $nombre_archivo) {
	$sql = "INSERT INTO
				Fotos (Publicacion, URL)
			VALUES
				('" . $id_publicacion . "','" . $nombre_archivo . "')";
	query_ejecutar($sql);
}
function eliminar_fotos_publicacion_dao($id_publicacion) {
	$sql = "DELETE FROM Fotos
			WHERE Publicacion = " . $id_publicacion;
	query_ejecutar($sql);
}