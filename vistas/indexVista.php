<div id="caja_identificar">
	<div id="panel_identificar">
		<div class="titulo_grande azul">
			Inicio de sesión
		</div>
		<div class="mensaje_error" id="error_identificacion" hidden>Error. Usuario o contraseña incorrectos.</div>
		<form id="form_identificar" action="javascript: identificar();" autocomplete="off">
		   	<input type="text" id="f_nombre_usuario" placeholder="Nombre de usuario" required/>
			<input type="password" id="f_password" placeholder="Contraseña" required/>
			<input type="submit" id="f_iniciar_sesion" value="Iniciar sesión"/>
		</form>
		<div class="mensaje_registro" onclick="document.location='registro.php'">¿Aún no tienes cuenta? <span style="text-decoration: underline">Regístrate</span></div>
	</div>
</div>