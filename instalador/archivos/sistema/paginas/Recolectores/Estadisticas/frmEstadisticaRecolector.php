<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$nombre_recolector = $_REQUEST['valor'];
?>
<HTML>
	<head>
		<title>SCYCPVES</title>
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
		<script type="text/javascript" 	 src="../../../librerias/jquery/autosuggest.js"></script>
	</head>
	<BODY class="cuerpo1">
	<div align="center" id="estilo1">
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ESTADISTICA DE RECOLECTORES POR TIPO DE VIDRIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<FORM ACTION="GraficarEstadisticaRecolector.php" METHOD="POST" onSubmit="return validarEstadisticaRecolector(this,4);">
					<table align="center" class="marco">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~año~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><span class="titulo1">A&ntilde;o:</span></td>
							<td colspan="2">
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
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~recolector~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><span class="titulo1">Recolector:</span></td>
							<td colspan="2">
								<?php
								if($nombre_recolector == "estadisticas"){
								?>						
								<select name="seleccionar_recolector" class="lista nombre" size="1" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
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
							</td>
						</tr>
						<tr><td colspan="3"><p>&nbsp;</p></td></tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~mostrar~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><span class="titulo1">Cantidad a Mostrar:</span></td>
							<td>
								<input type="radio" name="mostrar" value="VIDRIO" onClick="borrarMensaje(4);"><span class="subtitulo1">Vidrio Comprado</span>
							</td>
							<td>
								<input type="radio" name="mostrar" value="MONTO" onClick="borrarMensaje(4);"><span class="subtitulo1">Monto Canselado</span>
							</td>
						</tr>
						<tr><td colspan="3"><p>&nbsp;</p></td></tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~vidrio~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><span class="titulo1">Tipo de Vidrio:</span></td>
							<td>
								<input type="radio" name="vidrio" value="BOTELLA" onClick="borrarMensaje(4);"><span class="subtitulo1">Botella</span>
							</td>
							<td>
								<input type="radio" name="vidrio" value="PLANO" onClick="borrarMensaje(4);"><span class="subtitulo1">Plano</span>
							</td>
						</tr>
						<!---------------------------------BOTONES----------------------------------->
						<tr>
							<td align="center" colspan='3'>
								<br>
								<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton graficar">
								<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(4);">
								<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
								<input type="button"onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaEstadisticaRecolector.php')">
							</td>
						</tr>
					</table>
					</FORM>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el a&ntilde;o del periodo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el recolector a mostrar!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el tipo de cantidad a mostrar!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el tipo de vidrio!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</TABLE>
	</div>
	<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center></p>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>