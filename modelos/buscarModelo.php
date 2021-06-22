<?php
function buscar_usuarios() {
	$busqueda = $_GET['busqueda'];
	$todos_usuarios = get_usuarios_dao();
	$usuarios = array();
	foreach($todos_usuarios as $usuario) {
		if(stristr($usuario['Nombre'], $busqueda) != '' || stristr($usuario['Usuario'], $busqueda) != '') {
			array_push($usuarios, get_usuario($usuario['id']));
		}
	}
	return $usuarios;
}

function buscar_publicaciones($amigos) {
	$busqueda = $_GET['busqueda'];
	$id_usuario = $_SESSION['WG_usuario_id'];
	//Conseguimos las publicaciones verificadas de los amigos de un usuario que concuerden con el patrón
	$sql = "SELECT DISTINCT
                Publicaciones.id
                , Publicaciones.Fecha
                , Publicaciones.Titulo
                , Publicaciones.Descripcion
				, Publicaciones.Ruta
				, Usuarios.id AS id_usuario
                , AES_DECRYPT(Usuarios.Nombre,'walkingges') AS Nombre
				, AES_DECRYPT(Usuarios.Usuario,'walkingges') AS Usuario
            FROM
              Publicaciones, Usuarios, Privacidad
            WHERE
				Publicaciones.Estado = 'Publicada' AND
				(((Publicaciones.Usuario = $id_usuario
                AND Usuarios.id = $id_usuario)";
	foreach($amigos as &$amigo) {
		$id_amigo = $amigo['Amigo'];
		$sql .= " OR (Publicaciones.Usuario = $id_amigo AND Usuarios.id = $id_amigo)";
	}
	$sql .= ") OR (Publicaciones.Usuario = Usuarios.id AND Usuarios.id = Privacidad.Usuario AND Privacidad.Publicaciones = 'Todos')";
	$sql .= ") AND Publicaciones.Titulo LIKE '%$busqueda%'";
	$sql .= " ORDER BY Fecha DESC";
	$publicaciones = query_registros($sql);
	$publicaciones = construir_publicaciones_mini($publicaciones);
	return $publicaciones;
}