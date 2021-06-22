<div id="menu">
	<div class="buscador">
		<input type="text" id="cuadro_busqueda" placeholder="Introduzca su búsqueda" value="<?php echo $_GET['busqueda'] ?>">
		<img id="icn_buscar" src="img/icn_lupa.png" alt="Buscar" title="Buscar" onclick="javascript: buscar();">
	</div>
</div>
<div class="resultados_busqueda">
	<div class="resultados_personas">
		<div class="titulo azul">
			Personas
		</div>
		<div class="cajon_amigos">
			<?php if(count($usuarios) == 0) { ?>
				<div class="info_pags">Ninguna persona coincide con la búsqueda.</div>
			<?php } else { ?>
				<?php foreach($usuarios as &$persona) { ?>
					<div class="amigo" id="persona_<?php echo $persona['id']?>">
						<div class="imagen_perfil" style="background-image: url(<?php echo get_imagen_perfil($persona['id'])?>)" onclick="document.location='perfil.php?id=<?php echo $persona['id']?>'"></div>
						<div class="nombre" onclick="document.location='perfil.php?id=<?php echo $persona['id']?>'"><?php echo $persona['Nombre']?></div>
						<div class="info_amigos">
							<?php if($persona['id'] != $_SESSION['WG_usuario_id']) {?>
								<?php if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "S") {?>
									<div class="boton" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas eliminarle de tus amigos?', 'eliminar_amigo(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $persona['id'] ?>);', 'N');">Eliminar amigo</div>
								<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "Pendiente") { ?>
									<div class="boton" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas cancelar la solicitud?', 'eliminar_solicitud(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $persona['id'] ?>);', 'N');">Cancelar solicitud</div>
								<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "NotificacionPendiente") { ?>
									<div class="boton" onclick="javascript: ir_notificaciones();">Responder solicitud</div>
								<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "N") { ?>
									<div class="boton" onclick="javascript: add_amigo(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $persona['id'] ?>);">Añadir amigo</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
	<div class="resultados_publicaciones">
		<div class="titulo azul">
			Publicaciones
		</div>
		<?php if(count($publicaciones) == 0) { ?>
			<div class="info_pags">Ninguna publicación coincide con la búsqueda.</div>
		<?php } else { ?>
			<!-- Para crear las publicaciones necesitamos $publicaciones -->
			<?php include 'inc/publicacion_mini.php'; ?>
		<?php } ?>
	</div>
</div>