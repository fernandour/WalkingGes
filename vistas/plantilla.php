<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta name="author" content="Fernando Urbón Domínguez"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>

        <title>WalkingGes</title>

		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
		<link rel="manifest" href="img/favicon/site.webmanifest">
		<link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="img/favicon/favicon.ico">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-config" content="img/favicon/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		
		<!-- css, fuentes y jquery -->
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
        <?php if(file_exists('css/' . $web . '.css')) { ?>
            <link rel="stylesheet" type="text/css" href="css/<?php echo $web?>.css" media="screen"/>
        <?php } ?>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
        <?php if(file_exists('js/' . $web . '.js')) { ?>
            <script type="text/javascript" src="js/<?php echo $web ?>.js"></script>
        <?php } ?>
		
		<!-- mapa -->
		<?php if($web == 'inicio' || $web == 'perfil' || $web == 'usuario' || $web == 'administrador' || $web == 'buscar' || $web == 'publicacion') { ?>
			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
			integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
			crossorigin=""/>
			<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
			integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
			crossorigin=""></script>
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.4.0/gpx.min.js"></script>
			<!-- pantalla completa -->
			<script src="https://unpkg.com/leaflet.fullscreen@1.5.1/Control.FullScreen.js"></script>
			<style type="text/css">
				.fullscreen-icon { background-image: url(img/icn_fullscreen.png); }
			</style>
		<?php } ?>
    </head>
    <body>
		<!-- barra superior -->
	    <div id="barra_superior">
			<div id="contenido">
				<div id="bt_inicio" onclick="document.location='inicio.php'" style="width:220px">
					<img id="logo" src="img/favicon.png" onmouseover="$('#texto_logo').addClass('hover_logo');" onmouseout="$('#texto_logo').removeClass('hover_logo');">
					<div id="texto_logo" class="">WalkingGes</div>
				</div>
				<div id="menu">
					<?php if($web == 'index' or $web == 'registro') { ?>
						<div class="opcion borde_dcha" style="width:150px;" id="opcion_iniciar_sesion" onclick="document.location='index.php'">Iniciar sesión</div>
						<div class="opcion" style="width: 150px;" id="opcion_registrarse" onclick="document.location='registro.php'">Registrarse</div>
					<?php } else { ?>
						<div class="opcion borde_dcha" id="opcion_inicio" onclick="document.location='inicio.php'">Inicio</div>
						<div class="opcion borde_dcha" id="opcion_perfil" onclick="document.location='perfil.php'">Perfil</div>
						<?php if(get_usuario($_SESSION["WG_usuario_id"])["Admin"] == 'S') { ?>
							<div class="opcion borde_dcha" id="opcion_admin" onclick="document.location='administrador.php'">
								Administrador
								<?php if(get_numero_publicaciones_pendientes() > 0) { ?>
									<div id="publicaciones_pendientes"></div>
								<?php } ?>
							</div>
						<?php } ?>
						<div class="opcion borde_dcha" id="opcion_notificaciones" onclick="document.location='notificaciones.php'">
							<img id="img_notificaciones" alt="Notificaciones" title="Notificaciones" src="img/notificaciones.png">
							<?php if(get_numero_notificaciones($_SESSION['WG_usuario_id']) > 0) { ?>
								<div id="num_notificaciones"><?php echo get_numero_notificaciones($_SESSION['WG_usuario_id'])?></div>
							<?php } ?>
						</div>
						<div class="opcion borde_dcha" id="opcion_ajustes" onclick="document.location='ajustes.php'">
							<img id="img_ajustes" alt="Ajustes" title="Ajustes" src="img/ajustes.png">
						</div>
						<div class="opcion" id="opcion_salir" onclick="document.location='index.php?accion=salir'">Salir</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- contenido de la página -->
		<div id="contenido_pagina">
	        <?php include "vistas/" . $web . 'Vista.php';?>
	    </div>
		
		<!-- popups -->
		<div id="contenedor_popup">
			<div id="popup_ok">
				<img src="img/ok.png"/>
			</div>
			<div class="popup_mensaje" id="popup_mensaje">
				<div class="popup_mensaje_cerrar" id="popup_mensaje_cerrar" onclick="javascript: cerrar_mensaje('N')">X</div>
				<div class="popup_mensaje_mensaje" id="popup_mensaje_mensaje"></div>
			</div>
			<div class="popup_mensaje" id="popup_mensaje_confirmacion">
				<div class="popup_mensaje_cerrar" onclick="javascript: cerrar_mensaje_confirmacion('S');">X</div>
				<div class="popup_mensaje_mensaje" id="popup_mensaje_confirmacion_mensaje"></div>
				<div class="popup_mensaje_confirmacion_respuesta" id="popup_mensaje_confirmacion_si" onclick="">Sí</div>
				<div class="popup_mensaje_confirmacion_respuesta" id="popup_mensaje_confirmacion_no" onclick="javascript: cerrar_mensaje_confirmacion('S');">No</div>
			</div>
		</div>
    </body>
</html>