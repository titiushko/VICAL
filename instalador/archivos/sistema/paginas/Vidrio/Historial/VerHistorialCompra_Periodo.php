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

switch($sucursal){
	case 'VICESA':
	case 'VIGUA':	$Sucursal = "para ".$sucursal."";
					$consulta_canidad = "SELECT COUNT(codigo_factura) AS cantidad FROM facturas WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND sucursal = '$sucursal' AND codigo_centro_acopio = '$codigo_centro_acopio'";
					$seleccionar_factura = "SELECT facturas.codigo_factura, proveedores.nombre_proveedor FROM facturas, proveedores WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND facturas.codigo_proveedor = proveedores.codigo_proveedor AND sucursal = '$sucursal' AND codigo_centro_acopio = '$codigo_centro_acopio' ORDER BY facturas.codigo_factura ASC";
					break;
	case 'AMBAS':	$Sucursal = "";
					$consulta_canidad = "SELECT COUNT(codigo_factura) AS cantidad FROM facturas WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND codigo_centro_acopio = '$codigo_centro_acopio'";
					$seleccionar_factura = "SELECT facturas.codigo_factura, proveedores.nombre_proveedor FROM facturas, proveedores WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' AND facturas.codigo_proveedor = proveedores.codigo_proveedor AND codigo_centro_acopio = '$codigo_centro_acopio' ORDER BY facturas.codigo_factura ASC";
					break;
}
$consulta_factura = mysql_query($seleccionar_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
$consulta = mysql_query($consulta_canidad, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta cantidad facturas!!</SPAN>".mysql_error());
$cantidad = mysql_fetch_assoc($consulta);

$consulta_centro_de_acopio = mysql_query("SELECT nombre_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
$nombre_centro_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);
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
							<td align="center" colspan="3">No hay valores que mostrar.<br>No se a comprado vidrio <?php echo $Sucursal." en el periodo del<br>".formatoFechaExtendida($fecha_inicial)."<br>al<br>".formatoFechaExtendida($fecha_final);?> deposiotado para el centro de acopio de <?php echo $nombre_centro_acopio['nombre_centro_acopio'];?>.</td>
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
						<caption><h1 class="encabezado2">Historial de vidrio comprado <?php echo $Sucursal." en el periodo del<br>".formatoFechaExtendida($fecha_inicial)." al ".formatoFechaExtendida($fecha_final);?> deposiotado en el centro de acopio de <?php echo $nombre_centro_acopio['nombre_centro_acopio'];?>.</h1></caption>
						<thead class="titulo2">
							<tr><th rowspan=2 colspan=2></th><th colspan=10>BOTELLA</th><th colspan=10>PLANO</th><th rowspan=1 colspan=2></th></tr>
							<tr>
								<th colspan=2>VERDE</th><th colspan=2>CRISTALINO</th><th colspan=2>CAFE</th><th colspan=2>BRONCE</th><th colspan=2>REFLECTIVO</th>
								<th colspan=2>VERDE</th><th colspan=2>CRISTALINO</th><th colspan=2>CAFE</th><th colspan=2>BRONCE</th><th colspan=2>REFLECTIVO</th>
								<th colspan=2>TOTAL</th>
							</tr>
							<tr>
								<th>RECIBOS</th><th>PROVEEDORES</th>
								<th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th>
								<th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th><th>QQ</th><th>$$</th>
								<th>QQ</th><th>$$</th>
							</tr>
						</thead>
						<tbody align="center" class="subtitulo1">
						<?php
						$contador = 1;
						$TotalesCantidades = 0;	$TotalesPrecios = 0;
						while($factura = mysql_fetch_assoc($consulta_factura)){
						?>
							<tr onMouseOver="bgColor='#7cbfff'" onMouseOut="bgColor='#ffffff'">
								<td><?php echo $factura['codigo_factura'];?></td><td><?php echo $factura['nombre_proveedor'];?></td>
							<?php
							$vidrios = calcularSumaTotalVidrio($factura['codigo_factura'],$sucursal);
							//-------------------------------------------------------------------
							for($j=1; $j<=5; $j++){
								if($vidrios[$j][1] <> 0 && $vidrios[$j][2] <> 0){
							?>								
								<td><?php echo $vidrios[$j][1];?></td><td><?php echo $vidrios[$j][2];?></td>
							<?php
								}
								else{
							?>
								<td>&nbsp;</td><td>&nbsp;</td>
							<?php
								}
							}//fin botellas
							//-------------------------------------------------------------------
							for($j=6; $j<=10; $j++){
								if($vidrios[$j][1] <> 0 && $vidrios[$j][2] <> 0){
							?>								
								<td><?php echo $vidrios[$j][1];?></td><td><?php echo $vidrios[$j][2];?></td>
							<?php
								}
								else{
							?>
								<td>&nbsp;</td><td>&nbsp;</td>
							<?php
								}
							}//fin planos
							//-------------------------------------------------------------------
							$Totales = calcularSumaTotales(calcularSumaTotalVidrio($factura['codigo_factura'],$sucursal));
							$TotalesCantidades	+= $Totales[1] +  $Totales[3];
							$TotalesPrecios		+= $Totales[2] + $Totales[4];
							if($contador == 1){
							?>
								<td rowspan="<?php echo ($cantidad['cantidad']-1);?>" colspan="2">&nbsp;</td>
							</tr>
							<?php
							}
							if($contador < $cantidad['cantidad']){
							?>
								<!--<td><?php echo ($Totales[1] +  $Totales[3]);?></td><td><?php echo ($Totales[2] +  $Totales[4]);?></td>-->
							<!--</tr>-->
							<?php
							}
							else{									
							?>
								<th><?php echo number_format($TotalesCantidades,2,'.',',');?></th>
								<th><?php echo "$".number_format($TotalesPrecios,2,'.',',');?></th>
							</tr>
							<?php
							}
							//-------------------------------------------------------------------								
							$contador++;
						}//fin while que recorre los registros
						?>
						</tbody>
					</table>
					<br><center><?php echo hoyEs();?></center>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<table align="center">
						<tr>
							<td>
								<FORM ACTION="ExportarHistorialCompra_Periodo.php<?php echo "?valor_fecha_inicial=$fecha_inicial&valor_fecha_final=$fecha_final&valor_sucursal=$sucursal&valor_codigo_centro_acopio=$codigo_centro_acopio";?>" METHOD="post">
								<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar">
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
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>