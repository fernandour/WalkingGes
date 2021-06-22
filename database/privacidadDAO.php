<?php
function crear_privacidad_dao($id_usuario, $publicaciones, $amigos, $email, $fecha_nacimiento, $año_nacimiento, $genero) {
	$sql = "INSERT INTO
				Privacidad (Usuario, Publicaciones, Amigos, Email, FechaNacimiento, AñoNacimiento, Genero)
			VALUES
				('$id_usuario', '$publicaciones', '$amigos', '$email', '$fecha_nacimiento', '$año_nacimiento', '$genero')";
	query_ejecutar($sql);
}
function get_privacidad_usuario_dao($id_usuario) {
	$sql = "SELECT
				*
			FROM
				Privacidad
			WHERE
				Usuario = $id_usuario";
	$privacidad = query_registro($sql);
	return $privacidad;
}
function actualizar_privacidad_dao($id_usuario, $publicaciones, $amigos, $email, $fecha_nacimiento, $año_nacimiento, $genero) {
	$sql = "UPDATE
				Privacidad 
			SET
				Publicaciones = '$publicaciones'
				, Amigos = '$amigos'
				, Email = '$email'
				, FechaNacimiento = '$fecha_nacimiento'
				, AñoNacimiento = '$año_nacimiento'
				, Genero = '$genero'
			WHERE
				Usuario = '$id_usuario'";
	query_ejecutar($sql);
}
function eliminar_privacidad_usuario_dao($id_usuario) {
	$sql = "DELETE FROM Privacidad
			WHERE Usuario = $id_usuario";
	query_ejecutar($sql);
}