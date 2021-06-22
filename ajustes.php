<?php
	session_start();
	$web = 'ajustes';
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
        		$accion = 'datos_personales';
    	}
		
		$usuario = get_usuario($_SESSION['WG_usuario_id']);
		if($accion == 'datos_personales') {
		
		}
		
		if($accion == 'foto_perfil') {
			
		}
		if($accion == 'privacidad') {
			$privacidad = get_privacidad($usuario['id']);
		}
		if($accion == 'guardar_datos_usuario') {
			$mostrar_plantilla = false;
			echo guardar_datos_usuario();
		}
		if($accion == 'guardar_privacidad') {
			$mostrar_plantilla = false;
			guardar_privacidad();
		}
		if($accion == 'subir_foto_perfil') {
			$mostrar_plantilla = false;
			subir_foto_perfil($_GET['id']);
		}
		if($accion == 'eliminar_cuenta') {
			$mostrar_plantilla = false;
			eliminar_cuenta();
		}
		
		if($mostrar_plantilla == true) {
        	require_once 'vistas/plantilla.php';
		}
	}