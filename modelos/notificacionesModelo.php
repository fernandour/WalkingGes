<?php
function get_amigos_pendientes($id) {
	//Conseguimos los amigos de un usuario Pendientes
	$amigos = get_amigos_pendientes_dao($id);
	return $amigos;
}
function aceptar_amigo() {
	$id1 = $_POST['id1'];
	$id2 = $_POST['id2'];
	date_default_timezone_set('Europe/Madrid');
	$fecha = date('Y-m-d H:i:s');
	actualizar_estado_amigos_dao($fecha, 'Aceptado', $id1, $id2);
}
function rechazar_amigo() {
	$id1 = $_POST['id1'];
	$id2 = $_POST['id2'];
	eliminar_amigo_dao($id1, $id2);
}