<div id="menu">
	<div class="opcion" id="opcion_crear_publicacion" onclick="javascript: panel('crear_publicacion', 'abrir');">CREAR PUBLICACIÓN</div>
	<div class="buscador">
		<input type="text" id="cuadro_busqueda" placeholder="Introduzca su búsqueda">
		<img id="icn_buscar" src="img/icn_lupa.png" alt="Buscar" title="Buscar" onclick="javascript: buscar();">
	</div>
</div>
<div id="panel_crear_publicacion">
	<div class="titulo">Nueva publicación</div>
	<form action="javascript: crear_publicacion(<?php echo $id_usuario?>);" autocomplete="off">
		<div class="opcion">
			<div class="nombre">Título: </div>
			<input type="text" id="f_titulo" required>
		</div>
		<div class="opcion">
			<div class="nombre">Descripción: </div>
			<textarea id="f_descripcion" required></textarea>
		</div>
		<div class="opcion">
			<div class="nombre">Ruta: </div>
			<select id="f_ruta">
				<option value="0" selected disabled>Seleccione una ruta</option>
				<?php foreach($rutas as &$ruta) { ?>
					<option value="<?php echo $ruta['id']?>"><?php echo $ruta['Nombre'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="opcion">
			<div class="mensaje_ruta" onclick="document.location='perfil.php?accion=ruta_nueva'">¿Aún no has subido la ruta que deseas añadir a tu publicación? <span style="text-decoration: underline">Añadela</span></div>
		</div>
		<div class="opcion">
			<div class="nombre">Imágenes: </div>
			<input type="file" id="f_imagenes" accept="image/*" multiple>
		</div>
		<div class="opcion" style="text-align: center;">
			<input type="submit" id="bt_crear_publicacion" value="Publicar">
		</div>
	</form>
</div>

	<!-- Para crear las publicaciones necesitamos $publicaciones -->
	<?php include 'inc/publicacion_mini.php'; ?>

<div class="cajon_top_personas">
	<div class="titulo">
		Ranking
	</div>
	<div class="informacion">
		<div class="tooltip"><img id="info" src="img/info.png">
			<span class="tooltiptext">Personas con más publicaciones en los últimos 30 días</span>
		</div>
	</div>
	<div class="cajon_tarjetas">
		<?php foreach($ranking as &$persona) {?>
			<div class="tarjeta">
				<div class="imagen_perfil" style="background-image: url(<?php echo get_imagen_perfil($persona['id'])?>)" onclick="document.location='perfil.php?id=<?php echo $persona['id']; ?>'"></div>
				<div class="nombre" onclick="document.location='perfil.php?id=<?php echo $persona['id']; ?>'"><?php echo $persona['Nombre'];?></div>
				<div class="num_publicaciones">
					<?php if($persona['Num_publicaciones'] == '1') { ?>
						<div class="numero" style="width: 40px;"><?php echo $persona['Num_publicaciones'];?></div>
						<div class="texto" style="width: calc(100% - 50px);">publicación en los últimos 30 días</div>
					<?php } else if($persona['Num_publicaciones'] > '1' && $persona['Num_publicaciones'] < '10'){ ?>
						<div class="numero" style="width: 40px;"><?php echo $persona['Num_publicaciones'];?></div>
						<div class="texto" style="width: calc(100% - 50px);">publicaciones en los últimos 30 días</div>
					<?php } else if($persona['Num_publicaciones'] > '9' && $persona['Num_publicaciones'] < '100'){ ?>
						<div class="numero" style="width: 50px;"><?php echo $persona['Num_publicaciones'];?></div>
						<div class="texto" style="width: calc(100% - 60px);">publicaciones en los últimos 30 días</div>
					<?php } else if($persona['Num_publicaciones'] > '99') { ?>
						<div class="numero">99+</div>
						<div class="texto">publicaciones en los últimos 30 días</div>
					<?php } ?>
				</div>
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
					<?php } else { ?>
						<div class="texto_enhorabuena">
							¡Enhorabuena!
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>