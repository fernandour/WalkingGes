<?php
function guardar_datos_usuario() {
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$nombre_usuario = $_POST['nombre_usuario'];
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$genero = $_POST['genero'];
	$sql = "SELECT
                id
            FROM
              Usuarios
            WHERE
                Usuario = AES_ENCRYPT('$nombre_usuario', 'walkingges')";
    $registro = query_registro($sql);
    if(isset($registro['id']) && $registro['id'] != $id) {
		echo "El nombre de usuario ya está registrado. Por favor utilice otro.";
	} else if($password1 != $password2) {
		echo "Las contraseñas deben coincidir.";
	} else {
		if($password1 == '' && $password2 == '') {
			actualizar_usuario_sin_password_dao($id, $nombre, $nombre_usuario, $email, $fecha_nacimiento, $genero);
		} else {
			actualizar_usuario_dao($id, $nombre, $nombre_usuario, $password1, $email, $fecha_nacimiento, $genero);
		}
		return 'ok';
	}
}
function subir_foto_perfil($id) {
	$nombre_archivo = "files/fotos_perfil/" . $id . ".jpg";
	if(move_uploaded_file($_FILES['archivo']['tmp_name'], $nombre_archivo)) { 
		echo 'Ok';
	} else {
		echo 'Error';
	}
}
function guardar_privacidad() {
	$id_usuario = $_POST['id_usuario'];
	$publicaciones = $_POST['publicaciones'];
	$amigos = $_POST['amigos'];
	$email = $_POST['email'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$año_nacimiento = $_POST['año_nacimiento'];
	$genero = $_POST['genero'];
	actualizar_privacidad_dao($id_usuario, $publicaciones, $amigos, $email, $fecha_nacimiento, $año_nacimiento, $genero);
}
function eliminar_cuenta() {
	$id_usuario = $_POST['id_usuario'];
	$publicaciones = get_publicaciones_usuario_dao($id_usuario);
	foreach($publicaciones as $publicacion) {
		eliminar_fotos_publicacion_dao($publicacion['id']);
	}
	eliminar_rutas_usuario_dao($id_usuario);
	eliminar_publicaciones_usuario_dao($id_usuario);
	eliminar_privacidad_usuario_dao($id_usuario);
	eliminar_amigos_usuario_dao($id_usuario);
	eliminar_usuario_dao($id_usuario);
	cerrar_sesion();
}