<div class="menu">
	<div class="opcion" onclick="document.location='ajustes.php?accion=datos_personales'">
		Datos personales
	</div>
	<div class="opcion" onclick="document.location='ajustes.php?accion=foto_perfil'">
		Foto de perfil
	</div>
	<div class="opcion" onclick="document.location='ajustes.php?accion=privacidad'">
		Privacidad
	</div>
</div>
<?php if($accion == 'datos_personales') {?>
	<div class="ajuste">
		<div class="titulo">Datos personales</div>
		<div id="error_datos_usuario"></div>
		<form action="javascript: guardar_datos_usuario(<?php echo $usuario['id']?>);" autocomplete="off">
			<div class="opcion">
				<div class="nombre">Nombre:</div>
				<input type="text" id="nombre" value="<?php echo $usuario['Nombre']?>" required>
			</div>
			<div class="opcion">
				<div class="nombre">Nombre usuario:</div>
				<input type="text" id="nombre_usuario" value="<?php echo $usuario['Usuario']?>" required>
			</div>
			<div class="opcion">
				<div class="nombre">Email:</div>
				<input type="email" id="email" value="<?php echo $usuario['Email']?>" maxlength="254" required>
			</div>
			<div class="opcion">
				<div class="nombre">Contraseña:</div>
				<input type="password" id="password" value="contraseñaoculta" disabled>
			</div>
			<div class="opcion">
				<div class="nombre">Nueva contraseña:</div>
				<input type="password" id="password1" maxlength="15">
			</div>
			<div class="opcion">
				<div class="nombre">Repita la contraseña:</div>
				<input type="password" id="password2" maxlength="15">
			</div>
			<div class="opcion">
				<div class="nombre">Fecha de nacimiento:</div>
				<input type="date" id="fecha_nacimiento" value="<?php echo $usuario['FechaNacimiento']?>" required>
			</div>
			<div class="opcion">
				<div class="nombre">Género:</div>
				<select id="genero">
					<option value="h" <?php if($usuario['Genero'] == 'h') echo 'selected' ?>>Hombre</option>
					<option value="m" <?php if($usuario['Genero'] == 'm') echo 'selected' ?>>Mujer</option>
				</select>
			</div>
			<div class="opcion">
				<input type="submit" value="Guardar cambios">
			</div>
			<div class="opcion">
				<div class="nombre_eliminar">¿Deseas eliminar tu cuenta?</div>
				<div class="boton_eliminar" onclick="javascript: mostrar_mensaje_confirmacion('¿Estás seguro que deseas eliminar tu cuenta? Se eliminarán todas tus rutas y publicaciones y no podrás recuperar tu información.', 'javascript: eliminar_cuenta(<?php echo $usuario['id']?>);', 'S');">Eliminar cuenta</div>
			</div>
		</form>
	</div>
<?php } ?>
<?php if($accion == 'foto_perfil') {?>
	<div class="ajuste">
		<div class="titulo">Foto de perfil</div>
		<div id="imagen_perfil" style="background-image: url(<?php echo get_imagen_perfil($usuario['id'])?>)"></div>
		<div id="caja_subir_archivo">	
			<div id="subir_archivo">
				<input type="file" id="archivo" accept="image/*">
				<input type="button" value="Cambiar imagen" onclick="javascript: subir_imagen(<?php echo $usuario['id']?>)">
			</div>
		</div>
	</div>
<?php } ?>
<?php if($accion == 'privacidad') {?>
	<div class="ajuste">
		<div class="titulo">Privacidad</div>
		<div class="subtitulo">¿Quién puede ver las siguientes opciones de tu perfil?</div>
		<form action="javascript: guardar_privacidad(<?php echo $usuario['id']?>);" autocomplete="off">
			<div class="opcion">
				<div class="nombre">Publicaciones:</div>
				<input type="radio" name="rb_publicaciones" value="SoloAmigos" <?php if($privacidad['Publicaciones'] == 'SoloAmigos') echo 'checked' ?>> <div class="value_radio">Solo amigos</div>
				<input type="radio" name="rb_publicaciones" value="Todos" <?php if($privacidad['Publicaciones'] == 'Todos') echo 'checked' ?>> <div class="value_radio">Todos</div>
			</div>
			<div class="opcion">
				<div class="nombre">Amigos:</div>
				<input type="radio" name="rb_amigos" value="SoloAmigos" <?php if($privacidad['Amigos'] == 'SoloAmigos') echo 'checked' ?>> <div class="value_radio">Solo amigos</div>
				<input type="radio" name="rb_amigos" value="Todos" <?php if($privacidad['Amigos'] == 'Todos') echo 'checked' ?>> <div class="value_radio">Todos</div>
			</div>
			<div class="opcion">
				<div class="nombre">Email:</div>
				<input type="radio" name="rb_email" value="Nadie" <?php if($privacidad['Email'] == 'Nadie') echo 'checked' ?>> <div class="value_radio">Nadie</div>
				<input type="radio" name="rb_email" value="SoloAmigos" <?php if($privacidad['Email'] == 'SoloAmigos') echo 'checked' ?>> <div class="value_radio">Solo amigos</div>
				<input type="radio" name="rb_email" value="Todos" <?php if($privacidad['Email'] == 'Todos') echo 'checked' ?>> <div class="value_radio">Todos</div>
			</div>
			<div class="opcion">
				<div class="nombre">Fecha de nacimiento:</div>
				<input type="radio" name="rb_fecha_nacimiento" value="Nadie" <?php if($privacidad['FechaNacimiento'] == 'Nadie') echo 'checked' ?>> <div class="value_radio">Nadie</div>
				<input type="radio" name="rb_fecha_nacimiento" value="SoloAmigos" <?php if($privacidad['FechaNacimiento'] == 'SoloAmigos') echo 'checked' ?>> <div class="value_radio">Solo amigos</div>
				<input type="radio" name="rb_fecha_nacimiento" value="Todos" <?php if($privacidad['FechaNacimiento'] == 'Todos') echo 'checked' ?>> <div class="value_radio">Todos</div>
			</div>
			<div class="sub_opcion">
				<input type="checkbox" id="cb_año_nacimiento" <?php if($privacidad['AñoNacimiento'] == 'S') echo 'checked' ?>> <div class="value_radio">Mostrar año</div>
			</div>
			<div class="opcion">
				<div class="nombre">Género:</div>
				<input type="radio" name="rb_genero" value="Nadie" <?php if($privacidad['Genero'] == 'Nadie') echo 'checked' ?>> <div class="value_radio">Nadie</div>
				<input type="radio" name="rb_genero" value="SoloAmigos" <?php if($privacidad['Genero'] == 'SoloAmigos') echo 'checked' ?>> <div class="value_radio">Solo amigos</div>
				<input type="radio" name="rb_genero" value="Todos" <?php if($privacidad['Genero'] == 'Todos') echo 'checked' ?>> <div class="value_radio">Todos</div>
			</div>
			<div class="opcion">
				<input type="submit" value="Guardar cambios">
			</div>
		</form>
	</div>
<?php } ?>