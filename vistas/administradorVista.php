<?php if($acceso == 'N') { ?>
	<div class="info_pags">No tienes autorización para entrar aquí. No eres administrador en el sistema.</div>
<?php } else if(count($publicaciones) == 0) { ?>
	<div class="info_pags">No hay publicaciones pendientes.</div>
<?php } else { ?>
	<!-- Para crear las publicaciones necesitamos $publicaciones -->
	<?php include 'inc/publicacion.php'; ?>
<?php } ?>