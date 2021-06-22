<?php if(count($publicaciones) > 0) { ?>
	<!-- Para crear las publicaciones necesitamos $publicaciones -->
	<?php include 'inc/publicacion.php'; ?>
<?php } else { ?>
	<div class="info_pags">No puede ver la publicación solicitada.</div>
<?php } ?>