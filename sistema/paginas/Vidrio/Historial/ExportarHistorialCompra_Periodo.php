<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$nombre_mes = $_REQUEST['valor_mes'];
$ano 		= $_REQUEST['valor_ano'];
if($nombre_mes== '' || $ano == '') header("Location: VerHistorialCompra_Periodo.php");

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Historial-Compra-$nombre_mes$ano.doc");

$mes = '';
if($nombre_mes == 'Enero') $mes = '01';
if($nombre_mes == 'Febrero') $mes = '02';
if($nombre_mes == 'Marzo') $mes = '03';
if($nombre_mes == 'Abril') $mes = '04';
if($nombre_mes == 'Mayo') $mes = '05';
if($nombre_mes == 'Junio') $mes = '06';
if($nombre_mes == 'Julio') $mes = '07';
if($nombre_mes == 'Agosto') $mes = '08';
if($nombre_mes == 'Septiembre') $mes = '09';
if($nombre_mes == 'Octubre') $mes = '10';
if($nombre_mes == 'Noviembre') $mes = '11';
if($nombre_mes == 'Diciembre') $mes = '12';

$seleccionar_factura = "
SELECT facturas.codigo_factura, proveedores.nombre_proveedor
FROM facturas, proveedores
WHERE facturas.fecha LIKE '$ano-$mes%'
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
ORDER BY facturas.codigo_factura ASC";
$consulta_factura = mysql_query($seleccionar_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());

$consulta = mysql_query("SELECT COUNT(codigo_factura) AS cantidad FROM facturas WHERE facturas.fecha LIKE '$ano-$mes%'", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta cantidad facturas!!</SPAN>".mysql_error());
$cantidad = mysql_fetch_assoc($consulta);
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
						<caption><h1>Historial de vidrio comprado en <?php echo $nombre_mes." de ".$ano; ?>.</h1></caption>
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
							$vidrios = calcularSumaVidrio($factura['codigo_factura']);
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
							$Totales = calcularSumaTotales(calcularSumaVidrio($factura['codigo_factura']));
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
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>