<?php
function identificar() {
    $usuario = $_POST['f_usuario'];
    $password = $_POST['f_password'];
	$registro = get_usuario_identificar_dao($usuario, $password);
    if(isset($registro['id'])) {
    	$_SESSION["WG_identificacion"] = "S";
		$_SESSION["WG_usuario_id"] = $registro['id'];
        echo "ok";
    }
}