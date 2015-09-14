<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoContador.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$nombre_mes = $_POST['seleccionar_mes'];
$ano 		= $_POST['seleccionar_ano'];
if($nombre_mes == '' || $ano == '') header("Location: frmHistorialCompra.php");

$mes = '';
if($nombre_mes == 'Enero') 		$mes = '01';
if($nombre_mes == 'Febrero') 	$mes = '02';
if($nombre_mes == 'Marzo') 		$mes = '03';
if($nombre_mes == 'Abril') 		$mes = '04';
if($nombre_mes == 'Mayo') 		$mes = '05';
if($nombre_mes == 'Junio') 		$mes = '06';
if($nombre_mes == 'Julio') 		$mes = '07';
if($nombre_mes == 'Agosto') 	$mes = '08';
if($nombre_mes == 'Septiembre') $mes = '09';
if($nombre_mes == 'Octubre') 	$mes = '10';
if($nombre_mes == 'Noviembre') 	$mes = '11';
if($nombre_mes == 'Diciembre') 	$mes = '12';

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
							<td align="center" colspan="3">No hay valores que mostrar.<br>No se a comprado vidrio en <?php echo $nombre_mes." de ".$ano;?>.</td>
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
						<caption><h1 class="encabezado2">Historial de vidrio comprado en <?php echo $nombre_mes." de ".$ano; ?>.</h1></caption>
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
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<table align="center">
						<tr>
							<td>
								<FORM ACTION="ExportarHistorialCompra_Periodo.php<?php echo "?valor_ano=$ano&valor_mes=$nombre_mes";?>" METHOD="post">
								<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar">
								</FORM>
							</td>
							<td>		
								<FORM ACTION="ImprimirHistorialCompra_Periodo.php<?php echo "?valor_ano=$ano&valor_mes=$nombre_mes";?>" METHOD="post">
								<input name="Imprimir" type="submit" value="Imprimir" onMouseOver="toolTip('Imprimir',this)" class="boton imprimir">
								</FORM>
							</td>
						</tr>
					</table>
					<?php } ?>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<br>
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
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>