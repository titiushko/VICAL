<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../librerias/validaciones.js"></script>
		<style>.encabezado2{color: red;}</style>
		<script>
			function mensaje(){
				var elemento = '';
				elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
				document.formulario.usuario.focus();
				//alert("ERROR!!");
			}
		</script>
	</head>
	<BODY class="cuerpo2">
		<br><br><br>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<h1 class="encabezado1">INICIAR SESIÓN</h1>					
					<span id="mensaje3" class="oculto"><h2 class="encabezado2"><img src="../imagenes/icono_error.png"><br>DATOS INCORRECTOS!!</h2></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<form name="formulario" action="Autentificacion.php" method="POST" onSubmit="return validarIniciarSesion(this,3);">
						<table align="center" class="marco centro" style="background:url(../imagenes/sesion.png); background-position:center; background-repeat:no-repeat;">
							<tr>
								<td align="right"><br><br><span class="titulo1">Nombre de Usuario:</span></td>
								<td align="left">
									<br><br>
									<input name="usuario" id="id1" class="requiredo" type="text" size=18		onBlur="borrarMensaje(3), elementosVacios(2);" onClick="borrarMensaje(3), elementosVacios(2);">
								</td>
							</tr>
							<tr>
								<td align="right"><br><br><span class="titulo1">Contrase&ntilde;a:</span></td>
								<td align="left">
									<br><br>
									<input name="password" id="id2" class="requiredo" type="password" size=18	onBlur="borrarMensaje(3), elementosVacios(2);" onClick="borrarMensaje(3), elementosVacios(2);">
								</td>
							</tr>
							<tr>
								<td colspan=2 align="center">
									<br><br>
									<span id="toolTipBox" width="50"></span>
									<input name="Ingresar" type="submit" value="Ingresar" onMouseOver="toolTip('Ingresar',this)" class="boton aceptar">
									<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(3), elementosVacios(2);">
									<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../paginas/Ayuda/AyudaIniciarSesion.php')">
								</td>
							</tr>
						</table>
					</form>
					<center>
						<div id="mensaje1" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta el nombre de usuario!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta la contrase&ntilde;a!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
		</table>
		<?php if ($_GET["error_usuario"] == "si"){ ?>
			<script>mensaje();</script>
		<?php } ?>
	</BODY>
</HTML>