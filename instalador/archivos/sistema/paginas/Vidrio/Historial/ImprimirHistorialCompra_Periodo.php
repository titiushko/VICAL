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

$consulta_centro_de_acopio = mysql_query("SELECT nombre_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
$nombre_centro_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);

function cambiarFecha($fecha){
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
$nombre_documento = "HISTORIAL_DE_COMPRAS_DEL_".cambiarFecha(formatoFechaExtendida($fecha_inicial))."_AL_".cambiarFecha(formatoFechaExtendida($fecha_final));
?>
<HTML>
	<head>
		<title><?php echo $nombre_documento; ?></title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
	</head>
	<BODY onLoad="window.print();">
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
						<caption><h1 class="encabezado2">Historial de vidrio comprado <?php echo $Sucursal." en el periodo del<br>".formatoFechaExtendida($fecha_inicial)." al ".formatoFechaExtendida($fecha_final);?> deposiotado en el centro de acopio de <?php echo $nombre_centro_acopio['nombre_centro_acopio'];?>.</h1></caption>
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
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>