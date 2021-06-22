<?php
function registrar() {
	$nombre = $_POST['f_nombre'];
    $usuario = strtolower($_POST['f_usuario']);
    $email = $_POST['f_email'];
    $password = $_POST['f_password'];
    $password2 = $_POST['f_password2'];
    $fecha_nacimiento = $_POST['f_fecha_nacimiento'];
    $genero = $_POST['f_genero'];
	
	$usuario_comprobar = get_id_usuario_nombre_usuario_dao($usuario);
	$email_comprobar = get_id_usuario_email_dao($email);
	
	date_default_timezone_set('Europe/Madrid');
	$fecha_comprobar = date('Y-m-d H:i:s');
	$fecha_comprobar = date("Y-m-d H:i:s", strtotime($fecha_comprobar . "- 14 years"));
	
    if(isset($usuario_comprobar['id'])) {
		echo "El nombre de usuario ya está registrado. Por favor utilice otro.";
	} else if($password != $password2) {
		echo "Las contraseñas deben coincidir.";
	} else if(strlen($password) < 4) {
		echo "La contraseña debe tener, al menos, 4 caracteres.";
	} else if($genero == "0") {
		echo "Debe seleccionar el género.";
	} else if(isset($email_comprobar['id'])) {
		echo "El email ya está registrado. Por favor utilice otro.";
	} else if($fecha_nacimiento > $fecha_comprobar) {
		echo "Solo se pueden registrar personas mayores de 14 años.";
	} else {
		$id_usuario = crear_usuario_dao($nombre, $usuario, $password, $genero, $fecha_nacimiento, $email, 'N');
		crear_privacidad_dao($id_usuario,  'SoloAmigos', 'Todos', 'SoloAmigos', 'Todos', 'S', 'Todos');
		echo "ok";
	}
}