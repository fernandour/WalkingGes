<?php
function get_publicaciones_pendientes() {
	//Conseguimos las publicaciones pendientes
	$publicaciones = get_publicaciones_pendientes_dao();
	$publicaciones = construir_publicaciones($publicaciones);
	return $publicaciones;
}
function aprobar_publicacion() {
	$id = $_POST['id'];
	aprobar_publicacion_dao($id);
}
function rechazar_publicacion() {
	$id = $_POST['id'];
	rechazar_publicacion_dao($id);
}