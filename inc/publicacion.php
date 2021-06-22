<div class="cajon_publicaciones">
	<input type="hidden" id="semaforo" value="true">
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
			<?php if($web == 'publicacion') { ?>
				<?php if($publicacion['id_usuario'] == $_SESSION['WG_usuario_id']) {?>
					<?php if($publicacion['Estado'] == 'Pendiente' || $publicacion['Estado'] == 'Rechazada') { ?>
						<div class="estado">
							<?php echo $publicacion['Estado']; ?>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<div class="opciones">
				<?php if($web == 'administrador') { ?>
					<img class="aprobar_publicacion" src="img/aprobar.png" alt="Aprobar publicación" title="Aprobar publicación" onclick="javascript: aprobar_publicacion(<?php echo $publicacion['id'] ?>);"></img>
					<img class="rechazar_publicacion" src="img/rechazar.png" alt="Rechazar publicación" title="Rechazar publicación" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas rechazar esta publicación?','rechazar_publicacion(<?php echo $publicacion['id'] ?>);', 'N')"></img>
				<?php } else { ?>
					<?php if($publicacion['id_usuario'] == $_SESSION['WG_usuario_id']) {?>
						<img class="borrar_publicacion" src="img/papelera.png" alt="Borrar publicación" title="Borrar publicación" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas borrar la publicación?','eliminar_publicacion(<?php echo $publicacion['id'] ?>);', 'N')"></img>
					<?php } ?>
				<?php } ?>
			</div>
			<div class="texto">
				<div class="titulo">
					<?php echo $publicacion['Titulo']?>
				</div>
				<div class="descripcion">
					<?php echo nl2br($publicacion['Descripcion'])?>
				</div>
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
				<img id="flecha_izquierda_<?php echo $publicacion['id']?>" class="flecha_izquierda" src="img/flecha_izquierda_azul.png" alt="Anterior" title="Anterior" onclick="javascript: desplazar_carrusel('<?php echo $publicacion['id']?>', 'izquierda')">
				<img id="flecha_derecha_<?php echo $publicacion['id']?>" class="flecha_derecha" src="img/flecha_derecha_azul.png" alt="Siguiente" title="Siguiente" onclick="javascript: desplazar_carrusel('<?php echo $publicacion['id']?>', 'derecha')">
			</div>
			<div class="mapa" id="mapa_<?php echo $publicacion['id']?>">
				<img class="mapa_descargar" src="img/descargar.png" alt="Descargar gpx" title="Descargar gpx">
			</div>
			<div class="ver_datos_mapa" onclick="javascript: ver_datos_mapa(<?php echo $publicacion['id']?>);">
				<div class="flechas">
					<img id="ver_datos_mapa_<?php echo $publicacion['id']?>_flecha1" src="img/flecha_desplegar_dorado.png">
					<img id="ver_datos_mapa_<?php echo $publicacion['id']?>_flecha2" src="img/flecha_desplegar_dorado.png">
					<img id="ver_datos_mapa_<?php echo $publicacion['id']?>_flecha3" src="img/flecha_desplegar_dorado.png">
				</div>
				<div class="texto">
					Datos de la ruta
				</div>
				<div class="flechas">
					<img id="ver_datos_mapa_<?php echo $publicacion['id']?>_flecha4" src="img/flecha_desplegar_dorado.png">
					<img id="ver_datos_mapa_<?php echo $publicacion['id']?>_flecha5" src="img/flecha_desplegar_dorado.png">
					<img id="ver_datos_mapa_<?php echo $publicacion['id']?>_flecha6" src="img/flecha_desplegar_dorado.png">
				</div>
			</div>
			<div class="datos_mapa" id="datos_mapa_<?php echo $publicacion['id']?>">
				<div class="dato" id="mapa_comienzo">
					<div class="dato_nombre">Comienzo:</div>
					<div class="dato_texto" id="mapa_comienzo_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_distancia">
					<div class="dato_nombre">Distancia:</div>
					<div class="dato_texto" id="mapa_distancia_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_velocidad_media">
					<div class="dato_nombre">Velocidad media:</div>
					<div class="dato_texto" id="mapa_velocidad_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_tiempo_movimiento">
					<div class="dato_nombre">Tiempo en movimiento:</div>
					<div class="dato_texto" id="mapa_tiempo_movimiento_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_altitud_max">
					<div class="dato_nombre">Altitud máxima:</div>
					<div class="dato_texto" id="mapa_altitud_max_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_desnivel_subida">
					<div class="dato_nombre">Desnivel subida:</div>
					<div class="dato_texto" id="mapa_desnivel_subida_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_tiempo_total">
					<div class="dato_nombre">Tiempo total:</div>
					<div class="dato_texto" id="mapa_tiempo_total_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_altitud_min">
					<div class="dato_nombre">Altitud mínima:</div>
					<div class="dato_texto" id="mapa_altitud_min_<?php echo $publicacion['id']?>"></div>
				</div>
				<div class="dato" id="mapa_desnivel_bajada">
					<div class="dato_nombre">Desnivel bajada:</div>
					<div class="dato_texto" id="mapa_desnivel_bajada_<?php echo $publicacion['id']?>"></div>
				</div>
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
					//Comienzo
					var start_time = (gpx.get_start_time());
					var comienzo = mostrar_fecha(start_time);
					document.getElementById("mapa_comienzo_<?php echo $publicacion['id']?>").innerHTML = comienzo;
					//Distancia
					var distance = (gpx.get_distance()); //Distancia, en metros
					distance = distance / 1000; //Convertimos a kms
					var distancia = parseFloat(Math.round(distance * 100) / 100).toFixed(2); //Redondeamos con dos decimales y fijamos que aparezcan dos decimales siempre
					document.getElementById("mapa_distancia_<?php echo $publicacion['id']?>").innerHTML = distancia + " km";
					//Velocidad media
					var total_speed = (gpx.get_total_speed()); //Velocidad media, en km/h
					var velocidad_total = parseFloat(Math.round(total_speed * 100) / 100).toFixed(2); //Redondeamos con dos decimales y fijamos que aparezcan dos decimales siempre
					document.getElementById("mapa_velocidad_<?php echo $publicacion['id']?>").innerHTML = velocidad_total + " km/h";
					//Tiempo en movimiento
					var moving_time = (gpx.get_moving_time()); //Tiempo, en milisegundos
					var tiempo_movimiento =  mostrar_tiempo(moving_time);
					document.getElementById("mapa_tiempo_movimiento_<?php echo $publicacion['id']?>").innerHTML = tiempo_movimiento;
					//Altitud maxima
					var elevation_max = (gpx.get_elevation_max()); //Altitud máxima, en metros
					var altitud_max = Math.round(elevation_max);
					document.getElementById("mapa_altitud_max_<?php echo $publicacion['id']?>").innerHTML = altitud_max + " m";
					//Desnivel subida
					var elevation_gain = (gpx.get_elevation_gain()); //Altitud ganada, en metros
					var desnivel_subida = Math.round(elevation_gain);
					document.getElementById("mapa_desnivel_subida_<?php echo $publicacion['id']?>").innerHTML = desnivel_subida + " m";
					//Tiempo total
					var total_time = (gpx.get_total_time()); //Tiempo, en milisegundos
					var tiempo_total =  mostrar_tiempo(total_time);
					document.getElementById("mapa_tiempo_total_<?php echo $publicacion['id']?>").innerHTML = tiempo_total;
					//Altitud mínima
					var elevation_min = (gpx.get_elevation_min()); //Altitud mínima, en metros
					var altitud_min = Math.round(elevation_min);
					document.getElementById("mapa_altitud_min_<?php echo $publicacion['id']?>").innerHTML = altitud_min + " m";
					//Desnivel bajada
					var elevation_loss = (gpx.get_elevation_loss()); //Altitud perdida, en metros
					var desnivel_bajada = Math.round(elevation_loss);
					document.getElementById("mapa_desnivel_bajada_<?php echo $publicacion['id']?>").innerHTML = desnivel_bajada + " m";
				}).addTo(map_<?php echo $publicacion['id']?>);
			</script>
		</div>	
	<?php } ?>
</div>