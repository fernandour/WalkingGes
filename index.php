<?php
	session_start();
	$web = 'index';
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

	if($accion == 'salir') {
		cerrar_sesion();
	}

	if(is_identificado() == 'S') {
		echo "<script language='javascript'> location.href = 'inicio.php'; </script>";
	}
	
	if($accion == 'identificar') {
		identificar();
		$mostrar_plantilla = false;
	}
	
	if($mostrar_plantilla == true) {
		require_once 'vistas/plantilla.php';
	}