<?php
	session_start();
	$web = 'inicio';
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
			$id_usuario = $_SESSION['WG_usuario_id'];
			$amigos = get_amigos($_SESSION['WG_usuario_id']);
			$publicaciones = get_publicaciones($amigos);
			$rutas = get_rutas($_SESSION['WG_usuario_id']);
			$ranking = get_personas_ranking();
		}
		
		if($accion == 'crear_publicacion') {
			$mostrar_plantilla = false;
			echo crear_publicacion();
		}
		if($accion == 'eliminar_publicacion') {
			$mostrar_plantilla = false;
			eliminar_publicacion();
		}
		
		if($accion == 'subir_fotos_publicacion') {
			$mostrar_plantilla = false;
			echo subir_fotos_publicacion($_GET['id']);
		}
		
		if($mostrar_plantilla == true) {
    	    require_once 'vistas/plantilla.php';
		}
	}