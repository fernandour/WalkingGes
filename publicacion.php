<?php
	session_start();
	$web = 'publicacion';
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
        		$accion = '';
    	}
		
		if($accion == '') {
			$publicaciones = get_publicacion($_GET['id']);
		}
		
		if($mostrar_plantilla == true) {
    	    require_once 'vistas/plantilla.php';
		}
	}