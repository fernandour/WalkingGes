<div class="cajon_amigos">
	<div class="titulo"> Solicitudes de amistad </div>
	<?php if(count($amigos_pendientes) > 0) {?>
		<?php foreach($amigos_pendientes as &$persona) {?>
			<div class="amigo" id="amigo_<?php echo $persona['id']?>">
				<div class="imagen_perfil" style="background-image: url(<?php echo get_imagen_perfil($persona['id'])?>)" onclick="document.location='perfil.php?id=<?php echo $persona['id']?>'"></div>
				<div class="nombre" onclick="document.location='perfil.php?id=<?php echo $persona['id']?>'"><?php echo $persona['Nombre']?></div>
				<div class="info_amigos">
					<div class="aceptar">
						<div class="boton" onclick="javascript: aceptar_amigo(<?php echo $persona['id'] ?>, <?php echo $_SESSION['WG_usuario_id'] ?>);">Aceptar</div>
					</div>
					<div class="rechazar">
						<div class="boton" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas rechazar la solicitud de amistad?', 'rechazar_amigo(<?php echo $persona['id'] ?>, <?php echo $_SESSION['WG_usuario_id'] ?>);', 'N');">Rechazar</div>
					</div>
				</div>
			</div>
		<?php }?>
	<?php } else { ?>
		<div class="info_pags">No tienes solicitudes de amistad pendientes.</div>
	<?php } ?>
</div>