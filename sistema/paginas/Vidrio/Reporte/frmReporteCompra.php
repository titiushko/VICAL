<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
$lista_mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/subsection tabs.prototype.js"></script>
		<script>
			document.observe('dom:loaded',function(){
				new Control.Tabs('criterios');
			});
		</script>
	</head>
	<BODY class="cuerpo1">
		<div align="center" id="estilo1">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td align="center">
						<img src="../../../imagenes/vical.png" width="25%" height="25%">
						<h1 class="encabezado1">REPORTE DE COMPRAS</h1>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="marco centro">
							<!--------------------------------CRITERIO---------------------------------->
							<tr><td align="center"><span class="titulo1">Seleccionar Criterio</span></td></tr>
							<tr>
								<td align="center">
								<div id="main">
									<!--------------------------------CRITERIOS---------------------------------->
									<ul id="criterios" class="subsection_tabs" onClick="borrarMensaje(3);">
										<li class="tab"><a class="" href="#periodo">Por Periodo</a></li>
										<li class="tab"><a class="active" href="#proveedor">Por Proveedor</a></li>
									</ul>
									<!--------------------------------PERIODO------------------------------------>
									<div style="display: none;" id="periodo">
										<form action="VerReporteCompra_Periodo.php" method="post" onSubmit="return validarReporteVidrio(this,3,'periodo');">
											<br><br>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mes~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<span class="titulo1">Mes:</span>
											<select name="seleccionar_mes" class="lista opcion" size="1" onClick="borrarMensaje(3);">
												<option selected value="">.:Opciones:.</option>
												<?php
												for($i=0;$i<12;$i++){
												echo "<option>".$lista_mes[$i]."</option>";
												}
												?>
											</select>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~año~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<span class="titulo1">&nbsp;&nbsp;A&ntilde;o:</span>
											<select name="seleccionar_ano" class="lista opcion" size="1" onClick="borrarMensaje(3);">
												<option selected value="">.:Opciones:.</option>
												<?php
												$instruccion = "SELECT DISTINCT YEAR(fecha) FROM facturas ORDER BY fecha ASC";
												$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
												while($opciones = mysql_fetch_array($consulta)){
												echo "<option>".$opciones[0]."</option>";
												}
												?>
											</select>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<br><br>
											<center>
												<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton aceptar">
												<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(3);">
												<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
												<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaReporteCompra.php')">
											</center>
										</form>
									</div>
									<!--------------------------------PROVEEDOR---------------------------------->
									<div style="display: none;" id="proveedor">
										<form action="VerReporteCompra_Proveedor.php" method="post" onSubmit="return validarReporteVidrio(this,3,'proveedor');">
											<br><br>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~proveedor~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<span class="titulo1">Proveedor:</span>
											<select name="seleccionar_proveedor" class="lista nombre" size="1" onClick="borrarMensaje(3);">
												<option selected value="">.:Proveedores:.</option>
												<?php
												$instruccion = "SELECT nombre_proveedor FROM proveedores ORDER BY nombre_proveedor ASC";
												$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
												while($opciones = mysql_fetch_array($consulta)){
												echo "<option>".$opciones[0]."</option>";
												}
												?>
											</select>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<br><br>
											<center>
												<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton aceptar">
												<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(3);">
												<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
												<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaReporteCompra.php')">
											</center>
										</form>
									</div>
									<!--------------------------------------------------------------------------->
								</div>
								</td>
							</tr>
							<!--------------------------------------------------------------------------->
						</table>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<center>
							<div id="mensaje1" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el mes!!&nbsp;&nbsp;</span></div>
							<div id="mensaje2" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el a&ntilde;o!!&nbsp;&nbsp;</span></div>
							<div id="mensaje3" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el proveedor!!&nbsp;&nbsp;</span></div>
						</center>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<span id="toolTipBox" width="50"></span>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			</table>
		</div>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>