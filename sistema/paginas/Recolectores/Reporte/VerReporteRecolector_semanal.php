<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$nombre_recolector	= $_POST['seleccionar_recolector'];
$ano				= $_POST['seleccionar_ano'];
$mes				= $_POST['seleccionar_mes'];

$consulta_codigo_recolector = mysql_query("SELECT codigo_recolector FROM recolectores WHERE nombre_recolector='$nombre_recolector'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_codigo_recolector!!</SPAN>".mysql_error());
$resultado = mysql_fetch_array($consulta_codigo_recolector);
$codigo_recolector = $resultado[0];

switch($mes){
	case 1:		$nombre_mes="Enero";		$mes='01';	break;
	case 2:		$nombre_mes="Febrero";		$mes='02';	break;
	case 3:		$nombre_mes="Marzo";		$mes='03';	break;
	case 4:		$nombre_mes="Abril";		$mes='04';	break;
	case 5:		$nombre_mes="Mayo";			$mes='05';	break;
	case 6:		$nombre_mes="Junio";		$mes='06';	break;
	case 7:		$nombre_mes="Julio";		$mes='07';	break;
	case 8:		$nombre_mes="Agosto";		$mes='08';	break;
	case 9:		$nombre_mes="Septiembre";	$mes='09';	break;
	case 10:	$nombre_mes="Octubre";		$mes='10';	break;
	case 11:	$nombre_mes="Noviembre";	$mes='11';	break;
	case 12:	$nombre_mes="Diciembre";	$mes='12';	break;
}
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" src="../../../librerias/funciones.js"></script>		
	</head>
	<BODY class="cuerpo1">
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<img src="../../../imagenes/logo VICAL.png">
					<h1 align='center' class='encabezado1'>REPORTE DE COMPRAS POR RECOLECTOR</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<?php
$ver = mysql_query("SELECT COUNT(codigo_factura) AS cantidad FROM facturas WHERE fecha LIKE '$ano-$mes%' AND codigo_recolector = '$codigo_recolector'",$conexion) or die ("<span class='error'>fallo en cantidad!!</span>".mysql_error());
$cantidad = mysql_fetch_array($ver);
if($cantidad[0] == 0){
?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR EL REPORTE DE COMPRAS POR RECOLECTORES!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">No hay valores que mostrar.<br> <?php echo $nombre_recolector; ?> no ha realizado ninguna de compra de vidrio en el mes de <?php echo $nombre_mes." de ".$ano; ?>.</td>
							<!--<meta http-equiv ="refresh"		 content="5;url=frmReporteRecolector.php<?php echo "?valor=reporte";?>">-->
						</tr>
					</table>
				</td>
			</tr>
		</table>
<?php
}
else{
?>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado Semanalmente por <?php echo $nombre_recolector; ?> en el mes de <?php echo $nombre_mes." de ".$ano; ?>"</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead>
							<tr>
								<th><h3>SEMANAS</h3></th>
								<th><h3>BOTELLA VERDE</h3></th>
								<th><h3>BOTELLA CLARO</h3></th>
								<th><h3>BOTELLA AMBAR</h3></th>
								<th><h3>PLANO CLARO</h3></th>
								<th><h3>TOTAL</h3></th>
								<th><h3>ACUMULADO</h3></th>
							</tr>
						</thead>
						<tbody>
						<?php
						for($i=1;$i<=4;$i++)	$total_vidrio[$i] = 0;
						$total_acumulado = 0;
						$semana = 1;	$vacio="&nbsp;";
						for($inicio_semana=1; $inicio_semana<=31; $inicio_semana+=7){
							if($inicio_semana == 1)	$fin_semana = 7;	else	$fin_semana = $inicio_semana + 6;
							?>
							<tr>
								<td>Semana-<?php echo $semana;?></td>
							<?php
							for($i=1;$i<=4;$i++)	$suma_vidrios[$i] = 0;
							$total_factura = 0;
							$consulta_codigo_factura_recolector = mysql_query("SELECT codigo_factura FROM facturas WHERE fecha BETWEEN '$ano-$mes-$inicio_semana' AND '$ano-$mes-$fin_semana' AND codigo_recolector = '$codigo_recolector'",$conexion) or die ("<span class='error'>fallo en consulta_codigo_factura_recolector!!</span>".mysql_error());
							while($codigo_factura_recolector = mysql_fetch_assoc($consulta_codigo_factura_recolector)){
								$vidrios = calcularSumaTotalVidrio($codigo_factura_recolector['codigo_factura'],'AMBAS');
								$suma_vidrios[1] += $vidrios[1][2];
								$suma_vidrios[2] += $vidrios[2][2];
								$suma_vidrios[3] += $vidrios[3][2];
								$suma_vidrios[4] += $vidrios[7][2];
							}
							$total_factura += $suma_vidrios[1]+$suma_vidrios[2]+$suma_vidrios[3]+$suma_vidrios[4];
							$total_acumulado += $total_factura;
							?>
								<td><?php if($suma_vidrios[1] == 0) echo $vacio; else echo "$".number_format($suma_vidrios[1],2,'.',',');?></td>
								<td><?php if($suma_vidrios[2] == 0) echo $vacio; else echo "$".number_format($suma_vidrios[2],2,'.',',');?></td>
								<td><?php if($suma_vidrios[3] == 0) echo $vacio; else echo "$".number_format($suma_vidrios[3],2,'.',',');?></td>
								<td><?php if($suma_vidrios[4] == 0) echo $vacio; else echo "$".number_format($suma_vidrios[4],2,'.',',');?></td>
								<td><?php if($total_factura   == 0) echo $vacio; else echo "$".number_format($total_factura,2,'.',',');?></td>
								<td><?php if($total_acumulado == 0) echo $vacio; else echo "$".number_format($total_acumulado,2,'.',',');?></td>
							</tr>
							<?php
							$total_vidrio[1] += $suma_vidrios[1];
							$total_vidrio[2] += $suma_vidrios[2];
							$total_vidrio[3] += $suma_vidrios[3];
							$total_vidrio[4] += $suma_vidrios[4];
							$semana++;
						}
						?>
						</tbody>
						<tfoot>
							<tr>
								<td>Total</td>
								<td><?php if($total_vidrio[1] == 0) echo $vacio; else echo "$".number_format($total_vidrio[1],2,'.',',');?></td>
								<td><?php if($total_vidrio[2] == 0) echo $vacio; else echo "$".number_format($total_vidrio[2],2,'.',',');?></td>
								<td><?php if($total_vidrio[3] == 0) echo $vacio; else echo "$".number_format($total_vidrio[3],2,'.',',');?></td>
								<td><?php if($total_vidrio[4] == 0) echo $vacio; else echo "$".number_format($total_vidrio[4],2,'.',',');?></td>
								<td><?php if($total_factura   == 0) echo $vacio; else echo "$".number_format($total_factura,2,'.',',');?></td>
								<td><?php if($total_acumulado == 0) echo $vacio; else echo "$".number_format($total_acumulado,2,'.',',');?></td>
							</tr>
						</tfoot>
					</table>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		</table>
		<!----------------------------------------------------------------------------------------------------->
		<br><center><?php echo hoyEs();?></center>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<span id="toolTipBox" width="50"></span>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
		<table align="center">
			<tr>
				<td>
					<?php echo"<FORM ACTION='ExportarReporteRecolector_semanal.php?valor_nombre_recolector=$nombre_recolector&valor_mes=$mes&valor_ano=$ano' METHOD='post'>"; ?>
					<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar">
					</FORM>
				</td>
				<td>		
					<?php echo"<FORM ACTION='ImprimirReporteRecolector_semanal.php?valor_nombre_recolector=$nombre_recolector&valor_mes=$mes&valor_ano=$ano' METHOD='post'>"; ?>
					<input name="Imprimir" type="submit" value="Imprimir" onMouseOver="toolTip('Imprimir',this)" class="boton imprimir">
					</FORM>
				</td>
			</tr>		
		</table>
		<?php } ?>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<center><img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita"></center>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<?php
}
?>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>