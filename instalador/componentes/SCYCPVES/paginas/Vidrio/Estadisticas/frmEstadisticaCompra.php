<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$lista_mes = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
?>
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
	</head>
	<BODY class="cuerpo1">
	<div align="center" id="estilo1">
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ESTADISTICA DE COMPRAS</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<FORM ACTION="GraficarEstadisticaCompra.php" METHOD="POST" onSubmit="return validarEstadisticaVidrio(this,4);">
					<table align="center" class="marco">
						<tr><td colspan="3"><p>&nbsp;</p></td></tr>
						<tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mes~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="right"><span class="titulo1">Mes:</span></td>
							<td>
								<select name="seleccionar_mes" class="lista opcion" size="1" onClick="borrarMensaje(4);">
									<option selected value="">.:Opciones:.</option>
									<?php
									for($i=1;$i<=12;$i++){
										echo "<option value='$i'>".$lista_mes[$i]."</option>";
									}
									?>
								</select>
							</td>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~año~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="right"><span class="titulo1">A&ntilde;o:</span></td>
							<td>
								<select name="seleccionar_ano" class="lista opcion" size="1" onClick="borrarMensaje(4);">
									<option selected value="">.:Opciones:.</option>
									<?php
									$instruccion = "SELECT DISTINCT YEAR(fecha) FROM facturas ORDER BY fecha ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta)){
										echo"
										<option>".$opciones[0]."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr><td colspan="3"><p>&nbsp;</p></td></tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mostrar~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td colspan="2" align="right"><span class="titulo1">Mostrar Estadistica en:</span></td>
							<td colspan="2">
								<input type="radio" name="mostrar" value="Graficas" onClick="borrarMensaje(4);"><span class="subtitulo1">Graficas</span>
								<input type="radio" name="mostrar" value="Detalles" onClick="borrarMensaje(4);"><span class="subtitulo1">Detalles</span>
							</td>
						</tr>
						<tr><td colspan="3"><p>&nbsp;</p></td></tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~sucursal~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td colspan="2" align="right"><span class="titulo1">Sucursal:</span></td>
							<td colspan="2">
								<select name="sucursal" class="lista opcion" size="1" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
									<option>.:Opciones:.</option>
									<option>VICESA</option>
									<option>VIGUA</option>
									<option>AMBAS</option>
								</select>
							</td>
						</tr>
						<tr><td colspan="3"><p>&nbsp;</p></td></tr>
						<!---------------------------------BOTONES----------------------------------->
						<tr>
							<td align="center" colspan="4">
								<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton graficar">
								<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(4);">
								<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
								<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaEstadisticaCompra.php')">
							</td>
						</tr>
						<!--------------------------------------------------------------------------->
					</table>
					</FORM>
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el mes del periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el a&ntilde;o del periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el tipo de estadistica!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar la sucursal!!&nbsp;&nbsp;</span></div>
					</center>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</TABLE>
	</div>
	<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center></p>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>