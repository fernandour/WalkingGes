<?php
	session_start();
	$web = 'buscar';
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
        		$accion = 'busqueda';
    	}
		
		if($accion == 'busqueda') {
			$usuarios = buscar_usuarios();
			$amigos = get_amigos($_SESSION['WG_usuario_id']);
			$publicaciones = buscar_publicaciones($amigos);
		}
		
		if($mostrar_plantilla == true) {
    	    require_once 'vistas/plantilla.php';
		}
	}