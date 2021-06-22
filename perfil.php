<?php
	session_start();
	$web = 'perfil';
	$mostrar_plantilla = true;
	
	require 'php/funciones.php';
	require 'php/comunes.php';
	require 'modelos/' . $web . 'Modelo.php';
	// DAO
	require 'database/amigosDAO.php';
	require 'database/fotosDAO.php';
	require 'database/privacidadDAO.php';
	require 'database/publicacionesDAO.php';
	require 'database/rutasDAO.php';
	require 'database/usuariosDAO.php';
	
	if(is_identificado() == 'N'){
		cargar_inicio_sesion();
	} else {
		if(!empty($_GET['accion'])) {
        		$accion = $_GET['accion'];
    	} else {
        		$accion = 'publicaciones';
    	}
		if(!empty($_GET['id'])) {
        		$id_usuario = $_GET['id'];
    	} else {
        		$id_usuario = $_SESSION['WG_usuario_id'];
    	}
		
		$usuario = get_usuario($id_usuario);
   		if($accion == 'publicaciones') {
			$publicaciones = get_publicaciones($usuario['id']);
		}
		if($accion == 'rutas') {
			$rutas = get_rutas($usuario['id']);
		}
		if($accion == 'ruta_nueva') {
			
		}
		if($accion == 'crear_ruta') {
			$mostrar_plantilla = false;
			echo crear_ruta();
		}
		if($accion == 'eliminar_ruta') {
			$mostrar_plantilla = false;
			echo eliminar_ruta();
		}
		if($accion == 'subir_url') {
			$mostrar_plantilla = false;
			echo subir_url();
		}
		if($accion == 'amigos') {
			$amigos = get_amigos($usuario['id']);
			$amigos_usuarios = array();
			foreach($amigos as &$amigo) {
				array_push($amigos_usuarios, get_usuario($amigo['Amigo']));
			}
		}
		if($accion == 'informacion') {
			$privacidad = get_privacidad($usuario['id']);
		}
		
		if($accion == 'add_amigo') {
			$mostrar_plantilla = false;
			add_amigo();
		}
		if($accion == 'eliminar_amigo') {
			$mostrar_plantilla = false;
			eliminar_amigo();
		}
	
		if($mostrar_plantilla == true) {
        	require_once 'vistas/plantilla.php';
		}
	}