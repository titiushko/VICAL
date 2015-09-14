<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoContador.php";
include "../../../librerias/abrir_conexion.php";
$lista_mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
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
		<link rel="stylesheet" 			 href="../../../librerias/calendario.css" type="text/css" media="screen"></link>
		<script type="text/javascript" 	 src="../../../librerias/calendario.js"></script>
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
						<h1 class="encabezado1">HISTORIAL DE COMPRAS</h1>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="marco">
							<!--------------------------------CRITERIO---------------------------------->
							<tr><td align="center"><span class="titulo1">Seleccionar Criterio</span></td></tr>
							<tr>
								<td align="center">
								<div id="main">
									<!--------------------------------CRITERIOS---------------------------------->
									<ul id="criterios" class="subsection_tabs" onClick="borrarMensaje(10);">
										<li class="tab"><a class="" href="#periodo">Por Periodo</a></li>
										<li class="tab"><a class="active" href="#tipo">Por Tipo de Vidrio</a></li>
										<li class="tab"><a class="active" href="#proveedor">Por Proveedor</a></li>
									</ul>
									<!--------------------------------PERIODO------------------------------------>
									<div style="display: none; width: 650px; height: 130px;" id="periodo">
										<form name="VerHistorialCompra_Periodo" action="VerHistorialCompra_Periodo.php" method="post" onSubmit="return validarHistorialCompra(this,10,'periodo');">
											<table style="width: 650px; height: 50px;">
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~periodo inicial~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
												<tr>
													<td align="right" class="titulo1">
														<br>Periodo Inicial:
													</td>
													<td align="left">						
														<input name="fecha_inicial" id="id1" class="requerido" type="text" size=7 readonly onBlur="borrarMensaje(10), elementosVacios(2);" onClick="borrarMensaje(10), elementosVacios(2);">
														<img src="../../../imagenes/icono_calendario.png" onMouseOver="toolTip('Calendario',this)" onClick="displayCalendar(document.VerHistorialCompra_Periodo.fecha_inicial,'yyyy-mm-dd',this),borrarMensaje(10), elementosVacios(2);" class="manita"><span class="obligatorio">*</span>
													</td>
													<td>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													</td>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~periodo final~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
													<td align="right" class="titulo1">
														<br>Periodo Final:
													</td>
													<td align="left">						
														<input name="fecha_final" id="id2" class="requerido" type="text" size=7 readonly onBlur="borrarMensaje(10), elementosVacios(2);" onClick="borrarMensaje(10), elementosVacios(2);">
														<img src="../../../imagenes/icono_calendario.png" onMouseOver="toolTip('Calendario',this)" onClick="displayCalendar(document.VerHistorialCompra_Periodo.fecha_final,'yyyy-mm-dd',this),borrarMensaje(10), elementosVacios(2);" class="manita"><span class="obligatorio">*</span>
													</td>
												</tr>
												<tr>
													<td align="right" class="titulo1">
														Sucursal:
													</td>
													<td align="left">						
														<select name="sucursal" class="lista opcion" size="1" onBlur="borrarMensaje(10);" onClick="borrarMensaje(10);">
															<option>.:Opciones:.</option>
															<option>VICESA</option>
															<option>VIGUA</option>
															<option>AMBAS</option>
														</select>
													</td>
													<td>
														&nbsp;
													</td>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~centro acopio~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
													<td align="right" class="titulo1">
														Centro de Acopio:
													</td>
													<td align="left">						
														<select name="codigo_centro_acopio" class="lista" size="1" onBlur="borrarMensaje(10);" onClick="borrarMensaje(10);">
															<option selected value="">.:Opciones:.</option>
															<?php
															$consulta_centro_de_acopio = mysql_query("SELECT codigo_centro_acopio, nombre_centro_acopio FROM centros_de_acopio ORDER BY nombre_centro_acopio ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
															while($centros_de_acopios = mysql_fetch_array($consulta_centro_de_acopio)){
																echo "<option value=\"$centros_de_acopios[0]\">".$centros_de_acopios[1]."</option>";
															}
															?>
														</select>
													</td>
												</tr>
											</table>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<div style="top: 10px;">
												<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton aceptar">
												<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(10), elementosVacios(2);">
												<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
												<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaHistorialCompra.php')">
											</div>
										</form>
									</div>
									<!--------------------------------VIDRIO------------------------------------>
									<div style="display: none; width: 650px; height: 130px;" id="tipo">
										<form action="VerHistorialCompra_TipoVidrio.php" method="post" onSubmit="return validarHistorialCompra(this,10,'tipo');">
											<table style="width: 650px; height: 50px;">
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~tipo~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
												<tr>
													<td width="270" align="right" class="titulo1">
														<br>
														Tipo Vidrio:
													</td>
													<td align="left">
														<br>						
														<select name="seleccionar_tipo" class="lista opcion" size="1" onClick="borrarMensaje(10);">
															<option selected value="">.:Opciones:.</option>
															<option>Botella</option>
															<option>Plano</option>
														</select>
													</td>
												</tr>
												<!--~~~~~~~~~~~~~~~~~~~~~~~~~~sucursal~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
												<tr>
													<td width="270" align="right" class="titulo1">
														Sucursal:
													</td>
													<td align="left">						
														<select name="sucursal" class="lista opcion" size="1" onBlur="borrarMensaje(10);" onClick="borrarMensaje(10);">
															<option>.:Opciones:.</option>
															<option>VICESA</option>
															<option>VIGUA</option>
															<option>AMBAS</option>
														</select>
													</td>
												</tr>
											</table>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<div style="top: 10px;">
												<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton aceptar">
												<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(10), elementosVacios(2);">
												<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
												<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaHistorialCompra.php')">
											</div>
										</form>
									</div>
									<!--------------------------------PROVEEDOR---------------------------------->
									<div style="display: none; width: 650px; height: 130px;" id="proveedor">
										<form action="VerHistorialCompra_Proveedor.php<?php echo "?pagina=historial";?>" method="post" onSubmit="return validarHistorialCompra(this,10,'proveedor');">
											<table style="width: 650px; height: 50px;">
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~tipo~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
												<tr>
													<td width="270" align="right" class="titulo1">
														<br>
														Proveedor:
													</td>
													<td align="left">
														<br>						
														<select name="seleccionar_proveedor" class="lista nombre" size="1" onClick="borrarMensaje(10);">
															<option selected value="">.:Proveedores:.</option>
															<?php
															$instruccion = "SELECT codigo_proveedor, nombre_proveedor FROM proveedores ORDER BY nombre_proveedor ASC";
															$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
															while($opciones = mysql_fetch_array($consulta)){
															echo "<option value=\"$opciones[0]\">".$opciones[1]."</option>";
															}
															?>
														</select>
													</td>
												</tr>
												<!--~~~~~~~~~~~~~~~~~~~~~~~~~~sucursal~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
												<tr>
													<td width="270" align="right" class="titulo1">
														Sucursal:
													</td>
													<td align="left">						
														<select name="sucursal" class="lista opcion" size="1" onBlur="borrarMensaje(10);" onClick="borrarMensaje(10);">
															<option>.:Opciones:.</option>
															<option>VICESA</option>
															<option>VIGUA</option>
															<option>AMBAS</option>
														</select>
													</td>
												</tr>
											</table>
											<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
											<div style="top: 10px;">
												<input name="Mostrar" type="submit" value="Mostrar" onMouseOver="toolTip('Mostrar',this)" class="boton aceptar">
												<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(10), elementosVacios(2);">
												<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
												<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaHistorialCompra.php')">
											</div>
										</form>
									</div>
									<!---------------------------------------------------------------------------------------------------------------->
								</div>
								</td>
							</tr>
						</table>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<center>
							<div id="mensaje1" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar la fecha inicial!!&nbsp;&nbsp;</span></div>
							<div id="mensaje2" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar la fecha final!!&nbsp;&nbsp;</span></div>
							<div id="mensaje3" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;La fecha inicial no debe ser igual a fecha final!!&nbsp;&nbsp;</span></div>
							<div id="mensaje4" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;La fecha inicial no debe ser mayor a fecha final!!&nbsp;&nbsp;</span></div>
							<div id="mensaje5" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;La fecha final no debe ser menor a fecha inicial!!&nbsp;&nbsp;</span></div>
							<div id="mensaje6" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;La fecha inicial no debe ser mayor ni igual a la fecha actual!!&nbsp;&nbsp;</span></div>
							<div id="mensaje7" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;La fecha final no debe ser mayor a la fecha actual!!&nbsp;&nbsp;</span></div>
							<div id="mensaje8" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el tipo de vidrio!!&nbsp;&nbsp;</span></div>
							<div id="mensaje9" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el proveedor!!&nbsp;&nbsp;</span></div>
							<div id="mensaje10" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar la sucursal!!&nbsp;&nbsp;</span></div>
							<div id="mensaje10" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el centro de acopio!!&nbsp;&nbsp;</span></div>
						</center>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<span id="toolTipBox" width="50"></span>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			</table>
		</div>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>