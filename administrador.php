<?php
	session_start();
	$web = 'administrador';
	$mostrar_plantilla = true;
	$acceso = 'S';
	
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
	} else if(is_admin() == 'N'){
		$acceso = 'N';
		require_once 'vistas/plantilla.php';
	} else {
		if(!empty($_GET['accion'])) {
        	$accion = $_GET['accion'];
    	} else {
        	$accion = '';
    	}
		
		if($accion == '') {
			$publicaciones = get_publicaciones_pendientes();
		}
		if($accion == 'aprobar_publicacion') {
			$mostrar_plantilla = false;
			aprobar_publicacion();
		}
		if($accion == 'rechazar_publicacion') {
			$mostrar_plantilla = false;
			rechazar_publicacion();
		}
		
		if($mostrar_plantilla == true) {
    	    require_once 'vistas/plantilla.php';
		}
	}