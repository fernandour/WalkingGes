<?php
function crear_usuario_dao($nombre, $usuario, $password, $genero, $fecha_nacimiento, $email, $admin) {
	$sql = "INSERT INTO
				Usuarios (Nombre, Usuario, Password, Genero, FechaNacimiento, Email, Admin)
			VALUES
				(AES_ENCRYPT('$nombre', 'walkingges'), AES_ENCRYPT('$usuario', 'walkingges'), SHA('$password'), '$genero', '$fecha_nacimiento', AES_ENCRYPT('$email', 'walkingges'), '$admin')";
	$id_usuario = query_ejecutar_id($sql);
	return $id_usuario;
}
function get_usuarios_dao() {
	$sql = "SELECT
				id,
				AES_DECRYPT(Nombre, 'walkingges') AS Nombre,
				AES_DECRYPT(Usuario, 'walkingges') AS Usuario
			FROM
				Usuarios";
	$usuarios = query_registros($sql);
	return $usuarios;
}
function get_usuario_dao($id_usuario) {
	$sql = "SELECT
				id,
				AES_DECRYPT(Nombre, 'walkingges') AS Nombre,
				AES_DECRYPT(Usuario, 'walkingges') AS Usuario,
				Genero,
				FechaNacimiento,
				AES_DECRYPT(Email, 'walkingges') AS Email,
				Admin
            FROM
              Usuarios
            WHERE
                id = $id_usuario";
	$usuario = query_registro($sql);
	return $usuario;
}
function get_usuario_identificar_dao($usuario, $password) {
	$sql = "SELECT
                id
            FROM
              Usuarios
            WHERE
                Usuario = AES_ENCRYPT('$usuario', 'walkingges')
                AND Password = SHA('$password')";
    $registro = query_registro($sql);
	return $registro;
}
function actualizar_usuario_dao($id_usuario, $nombre, $nombre_usuario, $password, $email, $fecha_nacimiento, $genero) {
	$sql = "UPDATE Usuarios 
			SET
				Nombre = AES_ENCRYPT('$nombre','walkingges'),
				Usuario = AES_ENCRYPT('$nombre_usuario','walkingges'),
				Password = SHA('$password'),
				Email = AES_ENCRYPT('$email','walkingges'),
				FechaNacimiento = '$fecha_nacimiento',
				Genero = '$genero'
			WHERE id = '$id_usuario'";
	query_ejecutar($sql);
}
function actualizar_usuario_sin_password_dao($id_usuario, $nombre, $nombre_usuario, $email, $fecha_nacimiento, $genero) {
	$sql = "UPDATE Usuarios 
			SET
				Nombre = AES_ENCRYPT('$nombre','walkingges'),
				Usuario = AES_ENCRYPT('$nombre_usuario','walkingges'),
				Email = AES_ENCRYPT('$email','walkingges'),
				FechaNacimiento = '$fecha_nacimiento',
				Genero = '$genero'
			WHERE id = '$id_usuario'";
	query_ejecutar($sql);
}
function eliminar_usuario_dao($id_usuario) {
	$sql = "DELETE FROM Usuarios
			WHERE id = $id_usuario";
	query_ejecutar($sql);
}
function get_usuarios_ranking_dao() {
	date_default_timezone_set('Europe/Madrid');
	$fecha1 = date('Y-m-d H:i:s');
	$fecha1 = date("Y-m-d H:i:s", strtotime($fecha1 . "- 30 days"));
	$fecha2 = date('Y-m-d H:i:s');
	$sql = "SELECT
				Usuarios.id
				, AES_DECRYPT(Usuarios.Nombre, 'walkingges') AS Nombre
				, COUNT(Publicaciones.id) AS Num_publicaciones
			FROM
				Usuarios, Publicaciones
			WHERE
				Publicaciones.Usuario = Usuarios.id
				AND Publicaciones.Estado = 'Publicada'
				AND Publicaciones.Fecha BETWEEN '$fecha1' AND '$fecha2'
			GROUP BY
				Usuarios.id
			ORDER BY
				Num_publicaciones DESC,
				AES_DECRYPT(Usuarios.Nombre, 'walkingges') ASC
			LIMIT 5";
	$usuarios_ranking = query_registros($sql);
	return $usuarios_ranking;
}
function get_id_usuario_nombre_usuario_dao($usuario) {
	 $sql = "SELECT
                id
            FROM
              Usuarios
            WHERE
                Usuario = AES_ENCRYPT('$usuario', 'walkingges')";
    $usuario = query_registro($sql);
	return $usuario;
}
function get_id_usuario_email_dao($email) {
	$sql = "SELECT
                id
            FROM
              Usuarios
            WHERE
                Email = AES_ENCRYPT('$email', 'walkingges')";
    $usuario = query_registro($sql);
	return $usuario;
}