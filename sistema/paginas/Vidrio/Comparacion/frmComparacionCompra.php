<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
$lista_mes = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
	</head>
	<BODY class="cuerpo1">
	<div align="center" id="estilo1">
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">COMPARACION DE COMPRAS</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<FORM ACTION="GraficarComparacionCompra.php" METHOD="POST" onSubmit="return validarComparacionCompra(this,11);">
					<table align="center" class="marco">
					<!---------------------------------------------PERIODO1----------------------------------------------------->
						<tr>
							<td align="center" colspan="4"><span class="titulo1">1er Periodo de Comparacion</span></td>
						</tr>
						<tr>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mes~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="right"><span class="titulo1">Mes:</span></td>
							<td>
								<select name="mes1" class="lista opcion" size="1" onClick="borrarMensaje(11);">
									<option selected value="">.:Opciones:.</option>
									<?php
									for($i=1;$i<=12;$i++)
										echo "<option value='$i'>".$lista_mes[$i]."</option>";
									?>
								</select>
							</td>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~año~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="right"><span class="titulo1">A&ntilde;o:</span></td>
							<td>
								<select name="ano1" class="lista opcion" size="1" onClick="borrarMensaje(11);">
									<option selected value="">.:Opciones:.</option>
									<?php
									$instruccion = "SELECT DISTINCT YEAR(fecha) FROM facturas ORDER BY fecha ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta))
										echo"<option>".$opciones[0]."</option>";
									?>
								</select>
							</td>
						</tr>
						<tr><td colspan="4"><p>&nbsp;</p></td></tr>
					<!---------------------------------------------PERIODO2----------------------------------------------------->
						<tr>
							<td align="center" colspan="4"><span class="titulo1">2do Periodo de Comparacion</span></td>
						</tr>
						<tr>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mes~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="right"><span class="titulo1">Mes:</span></td>
							<td>
								<select name="mes2" class="lista opcion" size="1" onClick="borrarMensaje(11);">
									<option selected value="">.:Opciones:.</option>
									<?php
									for($i=1;$i<=12;$i++)
										echo "<option value='$i'>".$lista_mes[$i]."</option>";
									?>
								</select>
							</td>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~año~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="right"><span class="titulo1">A&ntilde;o:</span></td>
							<td>
								<select name="ano2" class="lista opcion" size="1" onClick="borrarMensaje(11);">
									<option selected value="">.:Opciones:.</option>
									<?php
									$instruccion = "SELECT DISTINCT YEAR(fecha) FROM facturas ORDER BY fecha ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta))
										echo"<option>".$opciones[0]."</option>";
									?>
								</select>
							</td>
						</tr>
						<tr><td colspan="4"><p>&nbsp;</p></td></tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mostrar~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="center" colspan="4"><span class="titulo1">Mostrar Por:</span></td>
						</tr>
						<tr>
							<td align="center" colspan="4" onClick="borrarMensaje(11);">
								<select name="mostrar" class="lista opcion">
									<option selected value="">.:Opciones:.</option>
									<option value="cantidad">Cantidad</option>
									<option value="tipo">Tipo Vidrio</option>
									<option value="color">Color Vidrio</option>
								</select>
							</td>
						</tr>
						<tr><td colspan="4"><p>&nbsp;</p></td></tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~sucursal~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~--><tr>
							<td align="center" colspan="4"><span class="titulo1">Sucursal:</span></td>
						</tr>
						<tr>
							<td align="center" colspan="4" onClick="borrarMensaje(11);">
								<select name="sucursal" class="lista opcion">
									<option>.:Opciones:.</option>
									<option>VICESA</option>
									<option>VIGUA</option>
									<option>AMBAS</option>
								</select>
							</td>
						</tr>
						<tr><td colspan="4"><p>&nbsp;</p></td></tr>
						<!---------------------------------BOTONES----------------------------------->
						<tr>
							<td align="center" colspan='4'>
								<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton graficar">
								<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(11);">
								<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
								<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaComparacionCompra.php')">
							</td>
						</tr>
						<!--------------------------------------------------------------------------->
					</table>
					</FORM>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el mes del primer periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el a&ntilde;o del primer periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el mes del segundo periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el a&ntilde;o del segundo periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje5" class="oculto"><span class="alerta error">&nbsp;&nbsp;EL primer periodo no debe ser igual a segundo periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje6" class="oculto"><span class="alerta error">&nbsp;&nbsp;EL primer periodo no debe ser mayor a segundo periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje7" class="oculto"><span class="alerta error">&nbsp;&nbsp;EL segundo periodo no debe ser menor a primer periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje8" class="oculto"><span class="alerta error">&nbsp;&nbsp;EL primer periodo no debe ser mayor a la fecha actual!!&nbsp;&nbsp;</span></div>
						<div id="mensaje9" class="oculto"><span class="alerta error">&nbsp;&nbsp;EL segundo periodo no debe ser mayor a la fecha actual!!&nbsp;&nbsp;</span></div>
						<div id="mensaje10" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar los elementos a mostrar!!&nbsp;&nbsp;</span></div>
						<div id="mensaje11" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar la sucursal!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</TABLE>
	</div>
	<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center></p>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>