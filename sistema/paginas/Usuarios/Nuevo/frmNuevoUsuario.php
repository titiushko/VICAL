<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
		<script type="text/javascript">
			//vector con los nombres de usuarios
			var usuarios = new Array;										
			<?php
			$consulta = mysql_query("SELECT usuario FROM usuarios ORDER BY id ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en facturas!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "usuarios[$contador] = '".$opciones[0]."';";
				$contador++;
			}
			?>
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE USUARIOS</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<form name="formulario" action="RegistrarUsuario.php" method="POST" onSubmit="return validarNuevoUsuario(this,5);">
						<table align="center" class="marco">
							<!--------------------------------NOMBRE---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Nombre Completo:</span></td>
								<td align="left">						
									<input name="nombre" id="id1" class="requiredo" type="text" size=25 onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(5), elementosVacios(4);" onClick="borrarMensaje(5), elementosVacios(4);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------USUARIO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Nombre de Usuario:</span></td>
								<td align="left">						
									<input name="usuario" id="id2" class="requiredo" type="text" size=18 onBlur="borrarMensaje(5), elementosVacios(4);" onClick="borrarMensaje(5), elementosVacios(4);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------PASSWORD---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Contrase&ntilde;a:</span></td>
								<td align="left">						
									<input name="password" id="id3" class="requiredo" type="password" size=18 onBlur="borrarMensaje(5), elementosVacios(4);" onClick="borrarMensaje(5), elementosVacios(4);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------TIPO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Tipo de Usuario:</span></td>
								<td align="left">						
									<select name="nivel" id="id4" class="requiredo lista opcion" onBlur="borrarMensaje(5), elementosVacios(4);" onClick="borrarMensaje(5), elementosVacios(4);">
										<option selected value="">.:Opciones:.</option>
									<?php
									$tipos_usuarios = array(1=>"Administrador",2=>"Contador",3=>"Recolector");
									for($i=1;$i<=3;$i++){
										echo "<option value=\"$i\">".$tipos_usuarios[$i]."</option>";
									}
									?>
									</select>
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!---------------------------------BOTONES----------------------------------->
							<tr>
								<td colspan=2 align="center">
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<span id="toolTipBox" width="50"></span>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
									<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(5), elementosVacios(4);">
									<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
									<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroUsuario.php')">
								</td>
							</tr>
							<!------------------------------------------------------------------------>
						</table>
					</form>
					<center>
						<span class="obligatorio">* Datos requeridos</span>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta llenar el nombre completo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nombre de usuario!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Ese nombre de usuario ya esta registrado!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta la contrase&ntilde;a!!&nbsp;&nbsp;</span></div>
						<div id="mensaje5" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el tipo de usuario!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>