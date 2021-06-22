<div id="caja_registro">
	<div id="panel_registro">
		<div class="titulo_grande azul">
			Registro
		</div>
		<div class="mensaje_error" id="error_registro" hidden></div>
		<form id="form_registro" action="javascript: registrar();" autocomplete="off">
		   	<input type="text" id="f_nombre" placeholder="Nombre" required/>
		   	<input type="text" id="f_nombre_usuario" placeholder="Nombre de usuario" required/>
		   	<input type="email" id="f_email" placeholder="Email" maxlength="254" required/>
			<input type="password" id="f_password" placeholder="Contraseña" maxlength="15" required/>
			<input type="password" id="f_password2" placeholder="Repita la contraseña" required/>
			<input placeholder="Fecha de nacimiento" id="f_fecha_nacimiento" type="text" onfocusin="(this.type='date')" required>
		   	<select id="f_genero">
				<option value="0" selected disabled>Género</option>
				<option value="h">Hombre</option>
				<option value="m">Mujer</option>
			</select>
			<input type="submit" id="f_registro" value="Crear cuenta"/>
		</form>
	</div>
</div>