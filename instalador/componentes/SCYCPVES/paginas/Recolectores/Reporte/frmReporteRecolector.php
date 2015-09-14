<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
$nombre_recolector = $_REQUEST['valor'];
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
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
						<h1 class="encabezado1">REPORTE DE COMPRAS POR RECOLECTOR</h1>
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
										<li class="tab"><a class="" href="#semanal">Semanal</a></li>
										<li class="tab"><a class="active" href="#diario">Diario</a></li>
									</ul>
									<!--------------------------------SEMANAL------------------------------------>
									<div style="display: none;" id="semanal">
										<form action="VerReporteRecolector_semanal.php" method="post" onSubmit="return validarReporteRecolector(this,3);">
											<br><br>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~proveedor~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<span class="titulo1">Recolector:</span>
											<?php
											if($nombre_recolector == "reporte"){
											?>
											<select name="seleccionar_recolector" class="lista nombre" size="1" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
												<option selected value="">.:Recolectores:.</option>
												<?php
												$instruccion_recolector = "SELECT nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
												$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
												while($nombres_recolectores = mysql_fetch_array($consulta_recolector)){
													echo "<option>".$nombres_recolectores[0]."</option>";
												}
												?>
											</select>
											<?php
											}
											else if($nombre_recolector <> ""){
											?>
												<input name="seleccionar_recolector" class="lista nombre" type="text" value="<?php echo $nombre_recolector;?>" readonly>
											<?php
											}
											?>
											<br><br>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mes~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<span class="titulo1">Mes:</span>
											<select name="seleccionar_mes" class="lista opcion" size="1" onClick="borrarMensaje(3);">
												<option selected value="">.:Opciones:.</option>
												<?php
												for($i=1;$i<=12;$i++){
												echo "<option value=\"$i\">".$lista_mes[$i]."</option>";
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
									        <input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaReporteRecolector.php')">
								            </center>
										</form>
									</div>
									<!--------------------------------DIARIO------------------------------------>
									<div style="display: none;" id="diario">
										<form action="VerReporteRecolector_diario.php" method="post" onSubmit="return validarReporteRecolector(this,3);">
											<br><br>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~recolector~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<span class="titulo1">Recolector:</span>
											<?php
											if($nombre_recolector == "reporte"){
											?>
											<select name="seleccionar_recolector" class="lista nombre" size="1" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
												<option selected value="">.:Recolectores:.</option>
												<?php
												$instruccion_recolector = "SELECT nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
												$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
												while($nombres_recolectores = mysql_fetch_array($consulta_recolector)){
													echo "<option>".$nombres_recolectores[0]."</option>";
												}
												?>
											</select>
											<?php
											}
											else if($nombre_recolector <> ""){
											?>
												<input name="seleccionar_recolector" class="lista nombre" type="text" value="<?php echo $nombre_recolector;?>" readonly>
											<?php
											}
											?>
											<br><br>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mes~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<span class="titulo1">Mes:</span>
											<select name="seleccionar_mes" class="lista opcion" size="1" onClick="borrarMensaje(3);">
												<option selected value="">.:Opciones:.</option>
												<?php
												for($i=1;$i<12;$i++){
												echo "<option value=\"$i\">".$lista_mes[$i]."</option>";
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
									        <input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaReporteRecolector.php')">
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
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
						<div id="mensaje1" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el recolector!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el mes del periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el a&ntilde;o del periodo!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>