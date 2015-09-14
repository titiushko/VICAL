<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$departamentos = array("Ahuachapan","Santa Ana","Sonsonate","Usulutan","San Miguel","Morazan","La Union","La Libertad","Chalatenango","Cuscatlan","San Salvador","La Paz","Caba&ntilde;as","San Vicente");
$consulta_proveedor = mysql_query("SELECT MAX(codigo_proveedor) AS maximo FROM proveedores", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedor!! </SPAN>".mysql_error());
$proveedor = mysql_fetch_array($consulta_proveedor);
$cantidad = $proveedor['maximo'];
?>
<HTML>
	<head>
		<title>COMVICONPRO</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE PROVEEDORES</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<form name="formulario" action="RegistrarProveedor.php" method="POST" onSubmit="return validarNuevoProveedor(this,5);">
					<table align="center" class="marco">
						<!--------------------------------CODIGO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Codigo:</span></td>
							<td align="left">
								<input name="codigo_proveedor" type="text" size=4 readonly value="<?php echo ($cantidad+1);?>">
							</td>
						</tr>
						<!--------------------------------NOMBRE---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre de la Empresa:</span></td>
							<td align="left">
								<input name="nombre_proveedor" id="id1" class="requiredo" type="text" size=39 onKeyPress="return soloLetras(event);" onBlur="borrarMensaje(5), elementosVacios(6);" onClick="borrarMensaje(5), elementosVacios(6);">
								<span class="obligatorio">*</span>
							</td>
						</tr>
						<!--------------------------------TIPO---------------------------------->
						<tr><td colspan="2"></td></tr>
						<tr>
							<td align="right">
								<img src="../../../imagenes/icono_agregar.png" width="10%" height="10%" align="top" onMouseOver="toolTip('Nuevo Tipo de Empresa',this)" onClick="redireccionar('../../Tipos Empresas/Nuevo/frmNuevoTipoEmpresa.php')" class="manita">
								<span class="titulo1">Tipo de Empresa:</span>
							</td>
							<td align="left">
								<select name="nombre_tipo_empresa" id="id2" class="requiredo lista opcion" size="1" onBlur="borrarMensaje(5), elementosVacios(6);" onClick="borrarMensaje(5), elementosVacios(6);">
									<option selected>.:Opciones:.</option>
									<?php
									$instruccion = "SELECT nombre_tipo_empresa FROM tipos_empresas ORDER BY nombre_tipo_empresa ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!! </SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta)){
										echo"
										<option>".$opciones[0]."</option>";
									}
									?>
								</select>
								<span class="obligatorio">*</span>
							</td>
						</tr>
						<tr><td colspan="2"></td></tr>
						<!--------------------------------DIRECCION---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Direccion:</span></td>
							<td align="left">
								<textarea name="direccion_proveedor" cols=30 rows=4 onKeyup="autoTab(event.keyCode,this.name,99);"></textarea>
							</td>
						</tr>
						<!--------------------------------DEPARTAMENTO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Departamento:</span></td>
							<td align="left">
								<select name="departamento" id="id3" class="requiredo lista opcion" onBlur="borrarMensaje(5), elementosVacios(6);" onClick="borrarMensaje(5), elementosVacios(6);">
									<option selected>.:Opciones:.</option>
									<?php
									for($i=0;$i<14;$i++){
										echo "<option>".$departamentos[$i]."</option>";
									}
									?>
								</select>
								<span class="obligatorio">*</span>
							</td>
						</tr>
						<!--------------------------------CONTACTO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre del Representante:</span></td>
							<td align="left">						
								<input name="contacto" id="id4" class="requiredo" type="text" size=39 onKeyPress="return soloLetras(event);" onBlur="borrarMensaje(5), elementosVacios(6);" onClick="borrarMensaje(5), elementosVacios(6);">
								<span class="obligatorio">*</span>
							</td>
						</tr>
						<!--------------------------------TELEFONO1---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Telefono:</span></td>
							<td align="left">
								<input name="telefono1_1" id="id5" class="requiredo" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event);" onBlur="borrarMensaje(5), elementosVacios(6);" onClick="borrarMensaje(5), elementosVacios(6);">
								<span class="titulo1">-</span>
								<input name="telefono1_2" id="id6" class="requiredo" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event);" onBlur="borrarMensaje(5), elementosVacios(6);" onClick="borrarMensaje(5), elementosVacios(6);">
								<span class="obligatorio">*</span>
							</td>
						</tr>
						<!--------------------------------TELEFONO2---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Telefono2:</span></td>
							<td align="left">
								<input name="telefono2_1" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)">
								<span class="titulo1">-</span>
								<input name="telefono2_2" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)">
							</td>
						</tr>
						<!--------------------------------ESTANON---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Esta&ntilde;&oacute;n:</span></td>
							<td align="left">						
								<input name="estanon" id="estanon" type="text" maxLength=10 size=9  onBlur="borrarMensaje(5), elementosVacios(6);" onClick="borrarMensaje(5), elementosVacios(6);">
							</td>
						</tr>
						
						<!---------------------------------BOTONES----------------------------------->
						<tr>
							<td colspan=2 align="center">
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<span id="toolTipBox" width="50"></span>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
								<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(5), elementosVacios(6);">
								<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
								<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroProveedor.php')">
							</td>
						</tr>
					<!------------------------------------------------------------------------>
					</table>
					</form>
					<center>
						<span class="obligatorio">* Datos requeridos</span>
						<div id="mensaje1" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;Falta el nombre de la empresa!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el tipo de empresa!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el departamento!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;Falta el nombre del representante!!&nbsp;&nbsp;</span></div>
						<div id="mensaje5" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;Falta al menos un numero telefonico!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>