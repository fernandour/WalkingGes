<?php
	session_start();
	$web = 'registro';
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
	
	if(!empty($_GET['accion'])) {
		$accion = $_GET['accion'];
	} else {
		$accion = '';
	}
	
	if($accion == 'registrar') {
		$mostrar_plantilla = false;
		registrar();
	}

	if($mostrar_plantilla == true) {
   	    require_once 'vistas/plantilla.php';
	}