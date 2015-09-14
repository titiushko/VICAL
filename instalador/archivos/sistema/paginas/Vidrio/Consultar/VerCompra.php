<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../librerias/funciones.php";
$factura = $_REQUEST['valor'];
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
		<title>SCYCPVES</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">CONSULTAR COMPRA</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="marco">
					<tr>
					<td>
						<!--------------------------------FECHA/No---------------------------------->
						<tr>
							<td align="right" class="titulo1">Fecha:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['fecha'];?></td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td align="right" class="titulo1">No:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['codigo_factura'];?></td>
						</tr>
						<!--------------------------------RECOLECOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">Recolector:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['nombre_recolector'];?></td>
							<td align="right" class="titulo1">Codigo:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['codigo_recolector'];?></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PROVEEDOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">Proveedor:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['nombre_proveedor'];?></td>
							<td align="right" class="titulo1">Codigo:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['codigo_proveedor'];?></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PRECIO----------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><span class="titulo1">Precio:</span></td>
							<td align="left" class="subtitulo1"><?php echo "$".number_format($facturas['precio_compra'],2,'.',',');?></td>
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
											for($j=1; $j<=2; $j++){
												if($Compra[$i][$j] <> 0){
										?>
										<td><input class="fondo1" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td class="subtitulo1"><input class="fondo1" type="text" size="4" readonly></td>
										<?php
												}
											}
										}
										if($Totales[1] <> 0 && $Totales[2] <> 0){
										?>
										<td><input class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1]);?>"></td><!--total por tipo de vidrio-->
										<td><input class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2]);?>"></td><!--total por tipo de vidrio-->
										<?php
										}
										else{
										?>
										<td><input class="fondo1" type="text" size="4" readonly></td>
										<td><input class="fondo1" type="text" size="4" readonly></td>
										<?php
										}
										?>
									</tr>
									<tr>
										<th class="titulo2">PLANO</th>
										<?php
										for($i=6; $i<=10; $i++){
											for($j=1; $j<=2; $j++){
												if($Compra[$i][$j] <> 0){
										?>
										<td><input class="fondo1" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td class="subtitulo1"><input class="fondo1" type="text" size="4" readonly></td>
										<?php
												}
											}
										}
										if($Totales[3] <> 0 && $Totales[4] <> 0){
										?>
										<td><input class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[3]);?>"></td><!--total por tipo de vidrio-->
										<td><input class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[4]);?>"></td><!--total por tipo de vidrio-->
										<?php
										}
										else{
										?>
										<td><input class="fondo1" type="text" size="4" readonly></td>
										<td><input class="fondo1" type="text" size="4" readonly></td>
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
							<td align="center" colspan="4">
								<span class="titulo1">Sucursal:</span>
								<span class="subtitulo1"><?php echo $facturas['sucursal'];?></span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="titulo1">Centro de Acopio:</span>
								<span class="subtitulo1"><?php echo $facturas['nombre_centro_acopio'];?></span>
							</td>
						</tr>
					</td>
					</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<img src="../../../imagenes/icono_modificar.png" align="top" onMouseOver="toolTip('Modificar Compra de Vidrio',this);" <?php echo "onClick=\"redireccionar('../Modificar/frmModificarCompra.php?modificar_factura=$factura');\"";?> class="manita">
					<img src="../../../imagenes/icono_eliminar.png" align="top" onMouseOver="toolTip('Eliminar Compra de Vidrio',this);" <?php echo "onClick=\"redireccionar('../Eliminar/frmEliminarCompra.php?eliminar_factura=$factura');\"";?> class="manita">
					<hr width="270">
					<img src="../../../imagenes/icono_graficar.png" align="top" onMouseOver="toolTip('Ver Estadisticas',this)" onClick="redireccionar('../Estadisticas/frmEstadisticaCompra.php');" class="manita">
					<img src="../../../imagenes/icono_comparar.png" align="top" onMouseOver="toolTip('Ver Comparaciones',this)" onClick="redireccionar('../Comparacion/frmComparacionCompra.php');" class="manita">
					<?php } if($_SESSION["tipo_usuario"] == "1" || $_SESSION["tipo_usuario"] == "2"){ ?>
					<img src="../../../imagenes/icono_pronostico.png" align="top" onMouseOver="toolTip('Ver Pronosticos',this)" onClick="redireccionar('../Pronosticos/GraficarPronosticoCompra.php');" class="manita">
					<img src="../../../imagenes/icono_historial.png" align="top" onMouseOver="toolTip('Ver Historial',this)" onClick="redireccionar('../Historial/frmHistorialCompra.php');" class="manita">
					<?php } ?>
					<img src="../../../imagenes/icono_reporte.png" align="top" onMouseOver="toolTip('Ver Reportes',this)" onClick="redireccionar('../Reporte/frmReporteCompra.php');" class="manita">
					<br>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('frmConsultarCompra.php');" class="manita">
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>