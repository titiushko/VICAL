<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$fecha_inicial 		  = $_REQUEST['valor_fecha_inicial'];
$fecha_final   		  = $_REQUEST['valor_fecha_final'];
$sucursal	   		  = $_REQUEST['valor_sucursal'];
$codigo_centro_acopio = $_REQUEST['valor_codigo_centro_acopio'];
if($fecha_inicial == '' || $fecha_final == '' || $sucursal == '' || $codigo_centro_acopio == '') header("Location: VerHistorialCompra_Periodo.php");

switch($sucursal){
	case 'VICESA':
	case 'VIGUA':	$Sucursal = "para ".$sucursal.""; break;
	case 'AMBAS':	$Sucursal = ""; break;
}

$seleccionar_factura = "
SELECT facturas.codigo_factura, proveedores.nombre_proveedor
FROM facturas, proveedores
WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
AND codigo_centro_acopio = '$codigo_centro_acopio'
ORDER BY facturas.codigo_factura ASC";
$consulta_factura = mysql_query($seleccionar_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());

$consulta = mysql_query("SELECT COUNT(codigo_factura) AS cantidad FROM facturas WHERE facturas.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta cantidad facturas!!</SPAN>".mysql_error());
$cantidad = mysql_fetch_assoc($consulta);

$consulta_centro_de_acopio = mysql_query("SELECT nombre_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
$nombre_centro_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);

function transformarFecha($fecha){
	$bandera = false;
	$nombre_fecha = '';
	for($i=0; $i<=strlen($fecha); $i++){
		$caracter = substr($fecha,$i,1);
		if($caracter == ' ')
			if(!$bandera) $bandera = true;
			else $nombre_fecha = $nombre_fecha.'_';
		else
			if($bandera) $nombre_fecha = $nombre_fecha.$caracter;
	}
	return strtoupper($nombre_fecha);
}

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=HISTORIAL_DE_COMPRAS_DEL_".transformarFecha(formatoFechaExtendida($fecha_inicial))."_AL_".transformarFecha(formatoFechaExtendida($fecha_final)).".doc");
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
	</head>
	<BODY>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center"><h1>HISTORIAL DE COMPRAS</h1></td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>							
				<td align="center">
					<br>
					<table align="center" border bgcolor="white">
						<caption><h1>Historial de vidrio comprado <?php echo $Sucursal." en el periodo del<br>".formatoFechaExtendida($fecha_inicial)." al ".formatoFechaExtendida($fecha_final);?> deposiotado en el centro de acopio de <?php echo $nombre_centro_acopio['nombre_centro_acopio'];?>.</h1></caption>
						<thead>
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
						<tbody align="center">
						<?php
						$contador = 1;
						$TotalesCantidades = 0;	$TotalesPrecios = 0;
						while($factura = mysql_fetch_assoc($consulta_factura)){
						?>
							<tr align="center">
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
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>