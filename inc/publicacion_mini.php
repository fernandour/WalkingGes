<div class="cajon_publicaciones cajon_publicaciones_mini">
	<input type="hidden" id="semaforo" value="true">
	<?php if(count($publicaciones) == 0) { ?>
		<div class="info_pags">No hay publicaciones.</div>
	<?php } else { ?>
		<?php foreach($publicaciones as &$publicacion) { ?>
			<div class="publicacion" id="publicacion_<?php echo $publicacion['id']?>">
				<div class="cabecera">
					<div class="nombre" onclick="document.location='perfil.php?id=<?php echo $publicacion['id_usuario']?>'">
						<?php echo $publicacion['Nombre']?>
						(<span style="font-family: Times New Roman">@</span><?php echo $publicacion['Usuario']?>)
					</div>
					<div class="fecha">
						<?php echo mostrar_fecha($publicacion['Fecha']); ?>
					</div>
				</div>
				<?php if($web == 'perfil') { ?>
					<?php if($publicacion['id_usuario'] == $_SESSION['WG_usuario_id']) {?>
						<?php if($publicacion['Estado'] == 'Pendiente' || $publicacion['Estado'] == 'Rechazada') { ?>
							<div class="estado">
								<?php echo $publicacion['Estado']; ?>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<div class="opciones">
					<?php if($publicacion['id_usuario'] == $_SESSION['WG_usuario_id']) {?>
						<img class="borrar_publicacion" src="img/papelera.png" alt="Borrar publicación" title="Borrar publicación" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas borrar la publicación?','eliminar_publicacion(<?php echo $publicacion['id'] ?>);', 'N')"></img>
					<?php } ?>
					<img class="abrir_publicacion" src="img/flecha_abrir_publicacion.png" alt="Abrir publicación" title="Abrir publicación" onclick="document.location='publicacion.php?id=<?php echo $publicacion['id']; ?>'"></img>
				</div>
				<div class="texto">
					<div class="titulo">
						<?php echo $publicacion['Titulo']?>
					</div>
					<div class="descripcion">
						<?php echo nl2br($publicacion['Descripcion']);?>
					</div>
					<a class="link_ver_mas" href="publicacion.php?id=<?php echo $publicacion['id'];?>">Ver más</a>
				</div>
				<div class="imagenes">
					<div class="caja_carrusel">
						<div class="carrusel" id="carrusel_<?php echo $publicacion['id']?>" style="width: <?php echo $publicacion['ancho_carrusel']?>px">
							<?php foreach ($publicacion['Fotos'] as $imagen) {?>
								<div class="caja_imagen_carrusel">
									<img class="imagen_carrusel" src="<?php echo $imagen?>">
								</div>
							<?php }?>
						</div>
					</div>
					<img id="flecha_izquierda_<?php echo $publicacion['id']?>" class="flecha_izquierda" src="img/flecha_izquierda_azul.png" alt="Anterior" title="Anterior" onclick="javascript: desplazar_carrusel_mini('<?php echo $publicacion['id']?>', 'izquierda')">
					<img id="flecha_derecha_<?php echo $publicacion['id']?>" class="flecha_derecha" <?php if($publicacion['num_fotos'] == 1) echo 'style="display:none"'?> src="img/flecha_derecha_azul.png" alt="Siguiente" title="Siguiente" onclick="javascript: desplazar_carrusel_mini('<?php echo $publicacion['id']?>', 'derecha')">
				</div>
				<div class="mapa" id="mapa_<?php echo $publicacion['id']?>">
					<a class="mapa_descargar" href="<?php echo $publicacion['Mapa']?>" download="ruta.gpx">
						<img class="mapa_descargar" src="img/descargar.png" alt="Descargar gpx" title="Descargar gpx" >
					</a>
				</div>
				<script>
					var map_<?php echo $publicacion['id']?> = L.map('mapa_<?php echo $publicacion['id']?>', {
						fullscreenControl: true,
						fullscreenControlOptions: {
							position: 'topright',
							forceSeparateButton: true,
							title: 'Abrir pantalla completa', //Título para abrir pantalla completa
  							titleCancel: 'Cerrar pantalla completa' //Título para cerrar pantalla completa
						}
					});
					L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map_<?php echo $publicacion['id']?>);
					var url = '<?php echo $publicacion['Mapa']?>'; //URL al archivo GPX
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
						var gpx = e.target;
						map_<?php echo $publicacion['id']?>.fitBounds(gpx.getBounds());
					}).addTo(map_<?php echo $publicacion['id']?>);
				</script>
			</div>	
		<?php } ?>
	<?php } ?>
</div>