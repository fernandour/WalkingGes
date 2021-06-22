<?php if($usuario['id'] == $_SESSION['WG_usuario_id']) {?>
	<div id="imagen_cabecera" class="cursor_pointer" style="background-image: url(<?php echo get_imagen_perfil($usuario['id'])?>)" title="Cambiar foto de perfil" onclick="document.location='ajustes.php?accion=foto_perfil'"></div>
<?php } else { ?>
	<div id="imagen_cabecera" style="background-image: url(<?php echo get_imagen_perfil($usuario['id'])?>)"></div>
<?php } ?>
<div id="nombre_cabecera">
	<?php echo $usuario['Nombre']?><br>
	<span style="font-family: Times New Roman">@</span><?php echo $usuario['Usuario']?>
</div>
<div id="add_amigos">
	<?php if($usuario['id'] != $_SESSION['WG_usuario_id']) {?>
		<?php if(es_amigo($_SESSION['WG_usuario_id'], $usuario['id']) == "S") {?>
			<div class="boton" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas eliminarle de tus amigos?', 'eliminar_amigo(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $usuario['id'] ?>);', 'N');">Eliminar amigo</div>
		<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $usuario['id']) == "Pendiente") { ?>
			<div class="boton" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas cancelar la solicitud?', 'eliminar_solicitud(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $usuario['id'] ?>);', 'N');">Cancelar solicitud</div>
		<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $usuario['id']) == "NotificacionPendiente") { ?>
			<div class="boton" onclick="document.location='notificaciones.php'">Responder solicitud</div>
		<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $usuario['id']) == "N") { ?>
			<div class="boton" onclick="javascript: add_amigo(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $usuario['id'] ?>);">Añadir amigo</div>
		<?php } ?>
	<?php } ?>
</div>
<div id="menu">
	<?php if($accion == 'publicaciones') { ?>
		<div class="opcion opcion_activa" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="width: calc(33.33% - 1px);" <?php }?> id="opcion_publicaciones">PUBLICACIONES</div>
	<?php } else { ?>
		<div class="opcion" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="width: calc(33.33% - 1px);" <?php }?> id="opcion_publicaciones" onclick="document.location='perfil.php?accion=publicaciones&id=<?php echo $id_usuario?>';">PUBLICACIONES</div>
	<?php } ?>
	<?php if($accion == 'rutas') { ?>
		<div class="opcion opcion_activa" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="display:none;" <?php }?> id="opcion_rutas">
			RUTAS
			<div class="add_ruta" title="Añadir ruta" onclick="document.location='perfil.php?accion=ruta_nueva'">+</div>
		</div>
	<?php } else { ?>
		<div class="opcion" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="display:none;" <?php }?> id="opcion_rutas" onclick="document.location='perfil.php?accion=rutas&id=<?php echo $id_usuario?>';">
			RUTAS
			<?php if($accion != 'ruta_nueva' && $accion == 'rutas') { ?>
				<div class="add_ruta" title="Añadir ruta" onclick="document.location='perfil.php?accion=ruta_nueva'">+</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if($accion == 'amigos') { ?>
		<div class="opcion opcion_activa" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="width: calc(33.33% - 1px);" <?php }?> id="opcion_amigos">AMIGOS</div>
	<?php } else { ?>
		<div class="opcion" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="width: calc(33.33% - 1px);" <?php }?> id="opcion_amigos" onclick="document.location='perfil.php?accion=amigos&id=<?php echo $id_usuario?>';">AMIGOS</div>
	<?php } ?>
	<?php if($accion == 'informacion') { ?>
		<div class="opcion opcion_activa" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="width: calc(33.33% - 1px);" <?php }?> id="opcion_informacion">INFORMACIÓN</div>
	<?php } else { ?>
		<div class="opcion" <?php if($id_usuario != $_SESSION['WG_usuario_id']) {?> style="width: calc(33.33% - 1px);" <?php }?> id="opcion_informacion" onclick="document.location='perfil.php?accion=informacion&id=<?php echo $id_usuario?>';">INFORMACIÓN</div>
	<?php } ?>
</div>

<?php if($accion == 'publicaciones') { ?>
	<div class="contenido_publicaciones" id="contenido_publicaciones">
		<!-- Para crear las publicaciones necesitamos $publicaciones -->
		<?php include 'inc/publicacion_mini.php'; ?>
	</div>
<?php } ?>

<?php if($accion == 'rutas') { ?>
<div class="cajon_rutas">
	<?php if($id_usuario == $_SESSION['WG_usuario_id']) {?>
		<?php if(count($rutas) == 0) { ?>
			<div class="info_pags">Aún no has añadido ninguna ruta.</div>
		<?php } else { ?>
			<?php foreach($rutas as &$ruta) {?>
				<div class="ruta" id="ruta_<?php echo $ruta['id']?>">
					<div class="titulo">
						<?php echo $ruta['Nombre']?>
					</div>
					<div class="opciones">
						<img class="borrar_ruta" src="img/papelera.png" alt="Borrar ruta" title="Borrar ruta" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas borrar esta ruta?', 'eliminar_ruta(<?php echo $ruta['id']; ?>);', 'N');"></img>
				</div>
					<div class="mapa" id="mapa_ruta_<?php echo $ruta['id']?>">
						<a class="mapa_descargar" href="<?php echo $ruta['URL']?>" download="ruta.gpx">
							<img class="mapa_descargar" src="img/descargar.png" alt="Descargar gpx" title="Descargar gpx" >
						</a>
					</div>
					<script>
						var map_ruta_<?php echo $ruta['id']?> = L.map('mapa_ruta_<?php echo $ruta['id']?>', {
							fullscreenControl: true,
							fullscreenControlOptions: {
								position: 'topright',
								forceSeparateButton: true,
								title: 'Abrir pantalla completa', //Título para abrir pantalla completa
	  							titleCancel: 'Cerrar pantalla completa' //Título para cerrar pantalla completa
							}
						});
						L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map_ruta_<?php echo $ruta['id']?>);
						var url = '<?php echo $ruta['URL']?>'; //URL al archivo GPX
						new L.GPX(url, {
							async: true,
							marker_options: {
								startIconUrl: 'img/icn_start_ruta.png',
							    endIconUrl: 'img/icn_end_ruta.png',
								shadowUrl: 'img/icn_waypoint.png',
								wptIconUrls : {
									'': 'img/icn_waypoint.png',
								},
								iconSize: [20, 30],
								shadowSize: [0, 0],
								iconAnchor: [10, 30],
								shadowAnchor: [0, 0],
								popupAnchor:  [0, -30]
		  				}}).on('loaded', function(e) {
							map_ruta_<?php echo $ruta['id']?>.fitBounds(e.target.getBounds());
						}).addTo(map_ruta_<?php echo $ruta['id']?>);
					</script>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } else { ?>
		<div class="info_pags">Cada usuario solo puede ver sus rutas.</div>
	<?php } ?>
</div>
<?php } ?>

<?php if($accion == 'ruta_nueva') { ?>
	<div id="panel_crear_ruta">
		<div class="titulo">Nueva ruta</div>
		<form action="javascript: crear_ruta(<?php echo $_SESSION['WG_usuario_id']?>);" autocomplete="off">
			<div class="opcion">
				<div class="nombre">Título: </div>
				<input type="text" id="f_titulo" required>
			</div>
			<div class="opcion">
				<div class="nombre">Archivo (gpx): </div>
				<input type="file" id="f_archivo" accept=".gpx">
			</div>
			<div class="opcion" style="text-align: center;">
				<input type="submit" id="bt_subir_ruta" value="Subir ruta">
			</div>
		</form>
	</div>
<?php } ?>

<?php if($accion == 'amigos') { ?>
<div class="cajon_amigos">
	<?php if(count($amigos_usuarios) == 0) { ?>
		<?php if($usuario['id'] == $_SESSION['WG_usuario_id']) { ?>
			<div class="info_pags">Aún no has añadido ningún amigo. Busca personas conocidas y agregalas.</div>
		<?php } else { ?>
			<div class="info_pags">No hay amigos.</div>
		<?php } ?>
	<?php } else { ?>
		<?php foreach($amigos_usuarios as &$persona) { ?>
			<div class="amigo" id="amigo_<?php echo $persona['id']?>">
				<div class="imagen_perfil" style="background-image: url(<?php echo get_imagen_perfil($persona['id'])?>)" onclick="document.location='perfil.php?id=<?php echo $persona['id']?>'"></div>
				<div class="nombre" onclick="document.location='perfil.php?id=<?php echo $persona['id']?>'"><?php echo $persona['Nombre']?></div>
				<div class="info_amigos">
					<?php if($persona['id'] != $_SESSION['WG_usuario_id']) {?>
						<?php if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "S") {?>
							<div class="boton" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas eliminarle de tus amigos?', 'eliminar_amigo(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $persona['id'] ?>);', 'N');">Eliminar amigo</div>
						<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "Pendiente") { ?>
							<div class="boton" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas cancelar la solicitud?', 'eliminar_solicitud(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $persona['id'] ?>);', 'N');">Cancelar solicitud</div>
						<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "NotificacionPendiente") { ?>
							<div class="boton" onclick="document.location='notificaciones.php'">Responder solicitud</div>
						<?php } else if(es_amigo($_SESSION['WG_usuario_id'], $persona['id']) == "N") { ?>
							<div class="boton" onclick="javascript: add_amigo(<?php echo $_SESSION['WG_usuario_id'] ?>, <?php echo $persona['id'] ?>);">Añadir amigo</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<?php } ?>
<?php if($accion == 'informacion') { ?>
<div class="contenido_informacion">
	<div class="cajon_informacion">
		<div class="dato">
			<div class="dato_nombre">Nombre:</div>
			<div class="dato_texto"><?php echo $usuario['Nombre']?></div>
		</div>
		<div class="dato">
			<div class="dato_nombre">Nombre de usuario:</div>
			<div class="dato_texto"><?php echo $usuario['Usuario']?></div>
		</div>
		<?php if($privacidad['Email'] == 'Todos' || ($privacidad['Email'] == 'SoloAmigos' && es_amigo($usuario['id'], $_SESSION['WG_usuario_id']) == 'S') || $usuario['id'] == $_SESSION['WG_usuario_id']) { ?>
			<div class="dato">
				<div class="dato_nombre">Email:</div>
				<div class="dato_texto"><?php echo $usuario['Email']?></div>
			</div>
		<?php } ?>
		<?php if($privacidad['FechaNacimiento'] == 'Todos' || ($privacidad['FechaNacimiento'] == 'SoloAmigos' && es_amigo($usuario['id'], $_SESSION['WG_usuario_id']) == 'S') || $usuario['id'] == $_SESSION['WG_usuario_id']) { ?>
			<div class="dato">
				<div class="dato_nombre">Fecha de nacimiento:</div>
				<?php if($usuario['id'] == $_SESSION['WG_usuario_id']) { ?>
					<div class="dato_texto"><?php echo mostrar_fecha_sin_hora($usuario['FechaNacimiento'], 'S')?></div>
				<?php } else { ?>
					<div class="dato_texto"><?php echo mostrar_fecha_sin_hora($usuario['FechaNacimiento'], $privacidad['AñoNacimiento'])?></div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if($privacidad['Genero'] == 'Todos' || ($privacidad['Genero'] == 'SoloAmigos' && es_amigo($usuario['id'], $_SESSION['WG_usuario_id']) == 'S') || $usuario['id'] == $_SESSION['WG_usuario_id']) { ?>
			<div class="dato">
				<div class="dato_nombre">Género:</div>
				<div class="dato_texto"><?php echo get_genero($usuario['Genero'])?></div>
			</div>
		<?php } ?>
	</div>
</div>
<?php } ?>