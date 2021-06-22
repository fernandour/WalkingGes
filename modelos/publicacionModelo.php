<?php
function get_publicacion($id) {
	$id_usuario = get_id_usuario_publicacion_dao($id);
	//Comprobamos la privacidad
	$privacidad = get_privacidad($id_usuario)['Publicaciones'];
	if($privacidad == 'Todos' || ($privacidad == 'SoloAmigos' && es_amigo($id_usuario, $_SESSION['WG_usuario_id']) == 'S') || $id_usuario == $_SESSION['WG_usuario_id']) {
		//Conseguimos las publicaciones
		$publicaciones = get_publicaciones_id_dao($id);
		$publicaciones = construir_publicaciones($publicaciones);
	} else {
		$publicaciones = array();
	}
	return $publicaciones;
}