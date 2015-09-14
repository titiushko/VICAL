<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$factura = $_REQUEST['modificar_factura'];
$select_factura = "
SELECT facturas.codigo_factura, facturas.fecha, recolectores.nombre_recolector, facturas.codigo_recolector, proveedores.nombre_proveedor, facturas.codigo_proveedor, facturas.sucursal, centros_de_acopio.nombre_centro_acopio, facturas.precio_compra
FROM facturas, recolectores, proveedores, centros_de_acopio
WHERE facturas.codigo_factura = '$factura'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
AND facturas.codigo_centro_acopio = centros_de_acopio.codigo_centro_acopio";
$consulta_factura = mysql_query($select_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
$facturas = mysql_fetch_assoc($consulta_factura);
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
		<link rel="stylesheet" 			 href="../../../librerias/calendario.css" type="text/css" media="screen"></link>
		<script type="text/javascript" 	 src="../../../librerias/calendario.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
		<script type="text/javascript">
			//vector con los precios unitarios
			var precios = new Array;
			<?php
			$consulta = mysql_query("SELECT precio_unitario FROM precios ORDER BY precio_unitario ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en precios!!</SPAN>".mysql_error());
			$n_precio = 0;
			$precios = array();
			while($opciones = mysql_fetch_array($consulta)){
				$precios[$n_precio] = $opciones[0];
				echo "precios[$n_precio] = ".$opciones[0].";";
				$n_precio++;
			}
			?>
			//precio default
			var precio = precios[0];										
			<?php
			//vectores con los centro_de_acopio
			$consulta_centro_de_acopio = mysql_query("SELECT codigo_centro_acopio, nombre_centro_acopio FROM centros_de_acopio ORDER BY nombre_centro_acopio ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
			$n_ca = 0;
			$codigos_centro_de_acopio = array();	$nombres_centro_de_acopio = array();
			while($opciones = mysql_fetch_array($consulta_centro_de_acopio)){
				$codigos_centro_de_acopio[$n_ca] = $opciones[0];
				$nombres_centro_de_acopio[$n_ca] = $opciones[1];
				$n_ca++;
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
					<h1 class="encabezado1">MODIFICAR COMPRA</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="formulario" action="ModificarCompra.php" method="post" onSubmit="return validarModificarCompra(this,2);">
					<table class="marco">
						<!--------------------------------FECHA/No---------------------------------->
						<tr>
							<td align="right" class="titulo1">Fecha:</td>
							<td align="left">
								<input name="fecha" class="subtitulo1 fondo1" type="text" readonly size=9 value="<?php echo $facturas['fecha'];?>">
								<img src="../../../imagenes/icono_calendario.png" onMouseOver="toolTip('Calendario',this)" onClick="displayCalendar(document.formulario.fecha,'yyyy-mm-dd',this),borrarMensaje(2);" onBlur="borrarMensaje(2);" class="manita">
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td align="right" class="titulo1">No:</td>
							<td align="left">
								<input name="factura" class="subtitulo1 fondo1" type="text" readonly size="2" value="<?php echo $facturas['codigo_factura'];?>">
							</td>
						</tr>
						<!--------------------------------RECOLECOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">Recolector:</td>
							<td align="left">
								<select name="codigo_recolector" class="subtitulo1 fondo lista nombre" size="1" onBlur="borrarMensaje(2);" onClick="borrarMensaje(2);">
								<?php
								$instruccion_recolector = "SELECT codigo_recolector, nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
								$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
								while($recolectores = mysql_fetch_array($consulta_recolector)){
									if($recolectores[1] == $facturas["nombre_recolector"])
										echo "<option selected value=\"".$recolectores[0]."\">".$recolectores[1]."</option>";
									else
										echo "<option value=\"".$recolectores[0]."\">".$recolectores[1]."</option>";												
								}
								?>
								</select>
							</td>
							<td colspan="3">&nbsp;</td>
						</tr>
						<!--------------------------------PROVEEDOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">Proveedor:</td>
							<td align="left">
								<select name="codigo_proveedor" class="subtitulo1 fondo lista nombre" size="1" onBlur="borrarMensaje(2);" onClick="borrarMensaje(2);">
								<?php
								$instruccion_proveedor = "SELECT codigo_proveedor, nombre_proveedor FROM proveedores ORDER BY nombre_proveedor ASC";
								$consulta_proveedor = mysql_query($instruccion_proveedor,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_proveedor!!</SPAN>".mysql_error());
								while($proveedores = mysql_fetch_array($consulta_proveedor)){
									if($proveedores[1] == $facturas["nombre_proveedor"])
										echo "<option selected value=\"".$proveedores[0]."\">".$proveedores[1]."</option>";
									else
										echo "<option value=\"".$proveedores[0]."\">".$proveedores[1]."</option>";
								}
								?>
								</select>
							</td>
							<td colspan="3">&nbsp;</td>
						</tr>
						<!--------------------------------PRECIO----------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">Precio:</td>
							<td align="left">
								<select name="precio_compra" class="subtitulo1 fondo lista opcion" size="1" onBlur="borrarMensaje(2);" onClick="borrarMensaje(2);">
									<?php
									for($i=0;$i<$n_precio;$i++){
										if($precios[$i] == $facturas["precio_compra"])
											echo "<option value=\"$precios[$i]\" onClick=\"cambiarPrecio($i);\" selected>$".number_format($precios[$i],2,'.',',')."</option>";
										else
											echo "<option value=\"$precios[$i]\" onClick=\"cambiarPrecio($i);\">$".number_format($precios[$i],2,'.',',')."</option>";
									}
									?>
								</select>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------VIDRIO------------------------------------>
						<tr>
							<td colspan="6">
							<table align="center" border class="rejilla" width="60%">
								<thead class="titulo2">
									<tr>
										<th rowspan=2 colspan=1></th>
										<th colspan=2>VERDE</th>
										<th colspan=2>CRISTALINO</th>
										<th colspan=2>CAFE</th>
										<th colspan=2>BRONCE</th>
										<th colspan=2>REFLECTIVO</th>
										<th colspan=2>TOTAL</th><!--total por tipo de vidrio-->
									</tr>
									<tr>
										<!--VERDE-->
										<th>QQ</th>
										<th>$$</th>
										<!--CRISTALINO-->
										<th>QQ</th>
										<th>$$</th>
										<!--CAFE-->
										<th>QQ</th>
										<th>$$</th>
										<!--BRONCE-->
										<th>QQ</th>
										<th>$$</th>
										<!--REFLECTIVO-->
										<th>QQ</th>
										<th>$$</th>
										<!--TOTAL-->
										<th>QQ</th>
										<th>$$</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="titulo2">BOTELLA</th>
										<?php
										$Compra = calcularSumaVidrio($factura);
										$Totales = calcularSumaTotales($Compra);
										for($i=1; $i<=5; $i++){
											if($Compra[$i][1] <> 0 && $Compra[$i][2] <> 0){
										?>
										<td><input name="Vc<?php echo $i;?>" class="fondo" type="text" size="4" value="<?php printf("%.2f",$Compra[$i][1]);?>" onBlur="calcularMonto(),borrarMensaje(2);" onKeyPress="return soloNumerosFloat(event)" onClick="borrarMensaje(2);"></td>
										<td><input name="Vp<?php echo $i;?>" class="fondo1" type="text" readonly size="4" value="<?php printf("%.2f",$Compra[$i][2]);?>"></td>
										<?php
											}
											else{
										?>
										<td><input name="Vc<?php echo $i;?>" class="fondo" type="text" size="4" onBlur="calcularMonto(),borrarMensaje(2);" onKeyPress="return soloNumerosFloat(event)" onClick="borrarMensaje(2);"></td>
										<td><input name="Vp<?php echo $i;?>" class="fondo1" type="text" readonly size="4"></td>
										<?php
											}
										}
										if($Totales[1] <> 0 && $Totales[2] <> 0){
										?>
										<td><input name="BTo1" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1]);?>"></td><!--total por tipo de vidrio-->
										<td><input name="BTo2" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2]);?>"></td><!--total por tipo de vidrio-->
										<?php
										}
										else{
										?>
										<td><input name="BTo1" class="fondo1" type="text" size="4" readonly></td>
										<td"><input name="BTo2" class="fondo1" type="text" size="4" readonly></td>
										<?php
										}
										?>
									</tr>
									<tr>
										<th class="titulo2">PLANO</th>
										<?php
										for($i=6; $i<=10; $i++){
											if($Compra[$i][1] <> 0 && $Compra[$i][2] <> 0){
										?>
										<td><input name="Vc<?php echo $i?>" class="fondo" type="text" size="4" value="<?php printf("%.2f",$Compra[$i][1]);?>" onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
										<td><input name="Vp<?php echo $i?>" class="fondo1" type="text" readonly size="4" value="<?php printf("%.2f",$Compra[$i][2]);?>"></td>
										<?php
											}
											else{
										?>
										<td><input name="Vc<?php echo $i?>" class="fondo" type="text" size="4" onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
										<td><input name="Vp<?php echo $i?>" class="fondo1" type="text" readonly size="4"></td>
										<?php
											}
										}
										if($Totales[3] <> 0 && $Totales[4] <> 0){
										?>
										<td><input name="PTo1" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[3]);?>"></td><!--total por tipo de vidrio-->
										<td><input name="PTo2" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[4]);?>"></td><!--total por tipo de vidrio-->
										<?php
										}
										else{
										?>
										<td><input name="PTo1" class="fondo1" type="text" size="4" readonly></td>
										<td><input name="PTo2" class="fondo1" type="text" size="4" readonly></td>
										<?php
										}
										?>
									</tr>
								</tbody>
							</table>
							</td>
						</tr>
						<!-----------------------------SUCURSAL Y CA--------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="center" colspan="4" class="titulo1">
								Sucursal:							
								<select name="sucursal" class="subtitulo1 fondo lista opcion" size="1" onBlur="borrarMensaje(2);" onClick="borrarMensaje(2);">
								<?php
								$sucursales = array('VICESA','VIGUA');
								for($i=0;$i<2;$i++){
									if($sucursales[$i] == $facturas["sucursal"])
										echo "<option selected>".$sucursales[$i]."</option>";
									else
										echo "<option>".$sucursales[$i]."</option>";
								}
								?>
								</select>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Sucursal:							
								<select name="codigo_centro_acopio" class="subtitulo1 fondo lista" size="1" onBlur="borrarMensaje(2);" onClick="borrarMensaje(2);">
								<?php
								for($i=0;$i<$n_ca;$i++){
									if($nombres_centro_de_acopio[$i] == $facturas["nombre_centro_acopio"])
										echo "<option value=\"$codigos_centro_de_acopio[$i]\" selected>".$nombres_centro_de_acopio[$i]."</option>";
									else
										echo "<option value=\"$codigos_centro_de_acopio[$i]\">".$nombres_centro_de_acopio[$i]."</option>";
								}
								?>
								</select>
							</td>
						</tr>
						<!---------------------------------BOTONES----------------------------------->
						<tr>
							<td align="center" colspan="6">
								<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
								<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('javascript:window.history.back()');">
							</td>
						</tr>
					</table>
					</form>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;No se pueden seleccionar fechas futuras!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Al menos se debe de modificar un tipo y color de vidrio!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>