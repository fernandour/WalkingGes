<?php
	session_start();
	$web = 'notificaciones';
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
        		$accion = 'inicio';
    	}
		
		if($accion == 'inicio') {
			$id_amigos_pendientes = get_amigos_pendientes($_SESSION['WG_usuario_id']);
			$amigos_pendientes = array();
			foreach($id_amigos_pendientes as &$amigo) {
				array_push($amigos_pendientes, get_usuario($amigo['Amigo']));
			}
		}
		
		if($accion == 'aceptar_amigo') {
			$mostrar_plantilla = false;
			aceptar_amigo();
		}
		if($accion == 'rechazar_amigo') {
			$mostrar_plantilla = false;
			rechazar_amigo();
		}
		
		if($mostrar_plantilla == true) {
    	    require_once 'vistas/plantilla.php';
		}
	}