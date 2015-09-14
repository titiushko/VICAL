<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoContador.php";
include "../../../librerias/funciones.php";
$fecha_inicial		  = $_POST['fecha_inicial'];
$fecha_final		  = $_POST['fecha_final'];
$sucursal			  = $_POST['sucursal'];
$codigo_centro_acopio = $_POST['codigo_centro_acopio'];
if($fecha_inicial == '' || $fecha_final == '' || $sucursal == '' || $codigo_centro_acopio == '') header("Location: frmHistorialCompra.php");

if($codigo_centro_acopio == 'Todos los Centros de Acopio'){
	$lugar_deposiotado = $codigo_centro_acopio;
	$buscar_centro_acopio = "";
}
else{
	$consulta_centro_de_acopio = mysql_query("SELECT nombre_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
	$nombre_centro_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);
	$lugar_deposiotado = "el centro de acopio de ".$nombre_centro_acopio['nombre_centro_acopio'];
	$buscar_centro_acopio = "AND codigo_centro_acopio = '$codigo_centro_acopio'";
}

switch($sucursal){
	case 'VICESA':
	case 'VIGUA':	$Sucursal = "para ".$sucursal."";
					$consulta_canidad = "SELECT COUNT(codigo_factura) AS cantidad FROM facturas WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND sucursal = '$sucursal' $buscar_centro_acopio";
					$seleccionar_factura = "SELECT facturas.codigo_factura, proveedores.nombre_proveedor FROM facturas, proveedores WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND facturas.codigo_proveedor = proveedores.codigo_proveedor AND sucursal = '$sucursal' $buscar_centro_acopio ORDER BY facturas.codigo_factura ASC";
					break;
	case 'AMBAS':	$Sucursal = "";
					$consulta_canidad = "SELECT COUNT(codigo_factura) AS cantidad FROM facturas WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' $buscar_centro_acopio";
					$seleccionar_factura = "SELECT facturas.codigo_factura, proveedores.nombre_proveedor FROM facturas, proveedores WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND facturas.codigo_proveedor = proveedores.codigo_proveedor $buscar_centro_acopio ORDER BY facturas.codigo_factura ASC";
					break;
}
$consulta_factura = mysql_query($seleccionar_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
$consulta = mysql_query($consulta_canidad, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta cantidad facturas!!</SPAN>".mysql_error());
$cantidad = mysql_fetch_assoc($consulta);
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
		<script type="text/javascript" src="../../../librerias/funciones.js"></script>
		<style>.titulo2{font-size: 13px;}	.subtitulo1{font-size: 11px;}</style>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">HISTORIAL DE COMPRAS</h1>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			if($cantidad['cantidad'] == 0){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR EL HISTORIAL DE COMPRAS!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">No hay valores que mostrar.<br>No se a comprado vidrio <?php echo $Sucursal." en el periodo del<br>".formatoFechaExtendida($fecha_inicial)."<br>al<br>".formatoFechaExtendida($fecha_final);?> deposiotado para <?php echo $lugar_deposiotado;?>.</td>
							<meta http-equiv ="refresh"		 content="5;url=frmHistorialCompra.php">
						</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			}
			else {
			?>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>							
				<td align="center">
					<table align="center" border bgcolor="white">
						<caption><h1 class="encabezado2">Historial de vidrio comprado <?php echo $Sucursal." en el periodo del<br>".formatoFechaExtendida($fecha_inicial)." al ".formatoFechaExtendida($fecha_final);?> deposiotado en <?php echo $lugar_deposiotado;?>.</h1></caption>
						<thead class="titulo2">
							<tr>
								<th rowspan=2 colspan=2></th><th colspan=6>BOTELLA</th><th colspan=6>PLANO</th><th rowspan=1 colspan=2></th>
							</tr>
							<tr>
								<th colspan=2>CLARO</th><th colspan=2>VERDE</th><th colspan=2>CAFE</th>
								<th colspan=2>CLARO</th><th colspan=2>BRONCE</th><th colspan=2>REFLECTIVO</th>
								<th colspan=2>TOTAL POR RECIBO</th>
							</tr>
							<tr>
								<th>RECIBOS</th><th>PROVEEDORES</th>
								<th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th>
								<th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th>
								<th>QQ</th><th>$$</th>
							</tr>
						</thead>
						<tbody align="center" class="subtitulo1">
						<?php
						$TotalVidrioCantidad	  = 0;	$TotalVidrioPrecio 	 = 0;
						for($i=1; $i<=6; $i++){$TotalColumnaCantidad[$i] = 0;	$TotalColumnaPrecio[$i] = 0;}
						while($factura = mysql_fetch_assoc($consulta_factura)){
						?>
							<tr onMouseOver="bgColor='#7cbfff'" onMouseOut="bgColor='#ffffff'">
								<td><?php echo $factura['codigo_factura'];?></td><td><?php echo $factura['nombre_proveedor'];?></td>
							<?php
							$Vidrios   	 = calcularSumaVidrio($factura['codigo_factura'],$sucursal);
							$TotalVidrio = calcularSumaVidrioTotal($Vidrios);
							$TotalVidrioCantidad	+= $TotalVidrio[1] + $TotalVidrio[3];
							$TotalVidrioPrecio		+= $TotalVidrio[2] + $TotalVidrio[4];
							//-------------------------------------------------------------------
							for($i=1; $i<=3; $i++){
								if($Vidrios[$i][1] <> 0 && $Vidrios[$i][2] <> 0){
								$TotalColumnaCantidad[$i] += $Vidrios[$i][1];
								$TotalColumnaPrecio[$i]	  += $Vidrios[$i][2];
							?>								
								<td><?php echo number_format($Vidrios[$i][1],2,'.',',');?></td><td><?php echo number_format($Vidrios[$i][2],2,'.',',');?></td>
							<?php
								}
								else{
							?>
								<td>&nbsp;</td><td>&nbsp;</td>
							<?php
								}
							}//fin botellas
							//-------------------------------------------------------------------
							for($i=4; $i<=6; $i++){
								if($Vidrios[$i][1] <> 0 && $Vidrios[$i][2] <> 0){
								$TotalColumnaCantidad[$i] += $Vidrios[$i][1];
								$TotalColumnaPrecio[$i]	  += $Vidrios[$i][2];
							?>
								<td><?php echo number_format($Vidrios[$i][1],2,'.',',');?></td><td><?php echo number_format($Vidrios[$i][2],2,'.',',');?></td>
							<?php
								}
								else{
							?>
								<td>&nbsp;</td><td>&nbsp;</td>
							<?php
								}
							}//fin planos
							//-------------------------------------------------------------------
							?>
								<td><?php echo number_format(($TotalVidrio[1] +  $TotalVidrio[3]),2,'.',',');?></td><td><?php echo number_format(($TotalVidrio[2] +  $TotalVidrio[4]),2,'.',',');?></td>
							</tr>
						<?php
						}//fin while que recorre los registros
						?>
							<tr>
								<th align="right" colspan=2>TOTAL POR TIPO Y COLOR DE VIDRIO</th>
								<?php
								for($i=1; $i<=6; $i++){
									if($TotalColumnaCantidad[$i] != 0 && $TotalColumnaPrecio[$i] != 0){
								?>
								<th><?php echo number_format($TotalColumnaCantidad[$i],2,'.',',');?></th><th><?php echo "$".number_format($TotalColumnaPrecio[$i],2,'.',',');?></th>
								<?php
									}
									else{
								?>
								<td>&nbsp;</td><td>&nbsp;</td>
								<?php
									}
								}
								?>
								<th><?php echo number_format($TotalVidrioCantidad,2,'.',',');?></th><th><?php echo "$".number_format($TotalVidrioPrecio,2,'.',',');?></th>
							</tr>
							<tr>
								<th align="right" colspan=2>TOTAL EN TONELADAS</th>
								<?php
								for($i=1; $i<=6; $i++){
									if($TotalColumnaCantidad[$i] != 0 && $TotalColumnaPrecio[$i] != 0){
								?>
								<th><?php echo number_format($TotalColumnaCantidad[$i]/22,2,'.',',');?></th><th>&nbsp;</th>
								<?php
									}
									else{
								?>
								<td>&nbsp;</td><td>&nbsp;</td>
								<?php
									}
								}
								?>
								<th><?php echo number_format($TotalVidrioCantidad/22,2,'.',',');?></th><th>&nbsp;</th>
							</tr>
						</tbody>
					</table>
					<br><center><?php echo hoyEs();?></center>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<table align="center">
						<tr>
							<td>
								<FORM ACTION="ExportarWordHistorialCompra_Periodo.php<?php echo "?valor_fecha_inicial=$fecha_inicial&valor_fecha_final=$fecha_final&valor_sucursal=$sucursal&valor_codigo_centro_acopio=$codigo_centro_acopio";?>" METHOD="post">
								<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar_word">
								</FORM>
							</td>
							<td>
								<FORM ACTION="ExportarExcelHistorialCompra_Periodo.php<?php echo "?valor_fecha_inicial=$fecha_inicial&valor_fecha_final=$fecha_final&valor_sucursal=$sucursal&valor_codigo_centro_acopio=$codigo_centro_acopio";?>" METHOD="post">
								<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar_excel">
								</FORM>
							</td>
							<td>		
								<FORM ACTION="ImprimirHistorialCompra_Periodo.php<?php echo "?valor_fecha_inicial=$fecha_inicial&valor_fecha_final=$fecha_final&valor_sucursal=$sucursal&valor_codigo_centro_acopio=$codigo_centro_acopio";?>" METHOD="post">
								<input name="Imprimir" type="submit" value="Imprimir" onMouseOver="toolTip('Imprimir',this)" class="boton imprimir">
								</FORM>
							</td>
						</tr>
					</table>
					<?php } ?>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->					
					<span id="toolTipBox" width="50"></span>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita">
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
			<?php
			}
			?>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>