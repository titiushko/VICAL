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
<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$recolcetor = $_REQUEST['seleccionar_recolector'];
$anio=$_REQUEST['seleccionar_ano'];
$mes=$_REQUEST['seleccionar_mes'];
if($mes==1){ 	$nombre_mes="Enero"; 		$mes='01';}else
if($mes==2){	$nombre_mes="Febrero";		$mes='02';}else
if($mes==3){	$nombre_mes="Marzo";		$mes='03';}else
if($mes==4){	$nombre_mes="Abril";		$mes='04';}else
if($mes==5){	$nombre_mes="Mayo";			$mes='05';}else
if($mes==6){	$nombre_mes="Junio";		$mes='06';}else
if($mes==7){	$nombre_mes="Julio";		$mes='07';}else
if($mes==8){	$nombre_mes="Agosto";		$mes='08';}else
if($mes==9){	$nombre_mes="Septiembre";	$mes='09';}else
if($mes==10)	$nombre_mes="Octubre";		else
if($mes==11)	$nombre_mes="Noviembre";	else
if($mes==12)	$nombre_mes="Diciembre";

//obtener el codigo del recolector
$instruccion = "SELECT codigo_recolector FROM recolectores WHERE nombre_recolector='$recolcetor'";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$cod_recolec=$obtener[0];	//almacena el total de vidrio claro		


$VER = mysql_query("SELECT COUNT(CODIGO_FACTURA) AS CANTIDAD FROM FACTURAS WHERE FECHA LIKE '$anio-$mes%' AND CODIGO_RECOLECTOR = '$cod_recolec'",$conexion) or die ("<SPAN CLASS='error'>Fallo en CANTIDAD!!</SPAN>".mysql_error());
$CANTIDAD = mysql_fetch_array($VER);
$permino = false;
if($CANTIDAD[0] <> 0)	$permino = true;
?>
	<BODY class="cuerpo1">
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<img src="../../../imagenes/logo VICAL.png">
					<h1 align='center' class='encabezado1'>REPORTE DE COMPRAS POR RECOLECTORES</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<?php
if(!$permino){
?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR EL REPORTE DE COMPRAS POR RECOLECTORES!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">No hay valores que mostrar.<br> <?php echo $recolcetor; ?> no ha realizado ninguna de compra de vidrio en el mes de <?php echo $nombre_mes." de ".$anio; ?>.</td>
							<meta http-equiv ="refresh"		 content="5;url=frmReporteRecolector.php<?php echo "?valor=reporte";?>">
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
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado Semanalmente por <?php echo $recolcetor; ?> en el mes de <?php echo $nombre_mes." de ".$anio; ?>"</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead>
							<tr>
								<th><h3>Semanas</h3></th>
								<th><h3>Botella Claro</h3></th>
								<th><h3>Botella Ambar </h3></th>
								<th><h3>Botella Verde</h3></th>
								<th><h3>Plano Claro</h3></th>
								<th><h3>Total</h3></th>
							</tr>
						</thead>
						<tbody>
<?php
//generar las consultas que devuelven las suma de precios de vidrio comprado por semanas
$i=1;$posicion="&nbsp;";$semana=1;$v_claro=$v_ambar=$v_verde=$p_claro=0;
while($i <= 31)
{
	if($i==1)
	  $final=7;
	else
	  $final= $i+6;
$inicio=$i;
$vidrio_claro=$vidrio_ambar=$vidrio_verde=$plano_claro=0;

//para tipo de vidrio Botella Claro
$instruccion = "SELECT SUM(precio) AS precio FROM vidrio WHERE codigo_tipo='TV-01' AND codigo_color='CV-02' AND codigo_factura IN 
				(SELECT codigo_factura FROM facturas WHERE codigo_recolector='$cod_recolec' AND fecha BETWEEN '$anio-$mes-$inicio' AND '$anio-$mes-$final')";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$vidrio_claro=number_format($obtener[0],2,'.',',');	//almacena el total de vidrio claro	
$v_claro += $vidrio_claro;	

//para tipo de vidrio Botella Ambar
$instruccion = "SELECT SUM(precio) AS precio FROM vidrio WHERE codigo_tipo='TV-01' AND codigo_color='CV-03' AND codigo_factura IN 
				(SELECT codigo_factura FROM facturas WHERE codigo_recolector='$cod_recolec' AND fecha BETWEEN '$anio-$mes-$inicio' AND '$anio-$mes-$final')";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$vidrio_ambar=number_format($obtener[0],2,'.',',');	//almacena el total de vidrio claro		
$v_ambar += $vidrio_ambar;				

//para tipo de vidrio Botella Verde
$instruccion = "SELECT SUM(precio) AS precio FROM vidrio WHERE codigo_tipo='TV-01' AND codigo_color='CV-01' AND codigo_factura IN 
				(SELECT codigo_factura FROM facturas WHERE codigo_recolector='$cod_recolec' AND fecha BETWEEN '$anio-$mes-$inicio' AND '$anio-$mes-$final')";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$vidrio_verde=number_format($obtener[0],2,'.',',');	//almacena el total de vidrio claro	
$v_verde += $vidrio_verde;

//para tipo de vidrio Plano Claro
$instruccion = "SELECT SUM(precio) AS precio FROM vidrio WHERE codigo_tipo='TV-02' AND codigo_color='CV-02' AND codigo_factura IN 
				(SELECT codigo_factura FROM facturas WHERE codigo_recolector='$cod_recolec' AND fecha BETWEEN '$anio-$mes-$inicio' AND '$anio-$mes-$final')";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$plano_claro=number_format($obtener[0],2,'.',',');	//almacena el total de vidrio claro	
$p_claro += $plano_claro;

$total_horizontal=$vidrio_claro + $vidrio_ambar + $vidrio_verde + $plano_claro;

//imprimir valores obtenidos de las consultas										
?>
							<tr align="center">
								<td>semana-<?php echo $semana;?></td>
								<td><?php if($vidrio_claro==0) echo $posicion; else echo $vidrio_claro; ?></td>
								<td><?php if($vidrio_ambar==0) echo $posicion; else echo $vidrio_ambar; ?></td>
								<td><?php if($vidrio_verde==0) echo $posicion; else echo $vidrio_verde; ?></td>
								<td><?php if($plano_claro==0)  echo $posicion; else echo $plano_claro;  ?></td>
								<td><?php if($total_horizontal==0) echo $posicion; else echo "$".number_format($total_horizontal,2,'.',','); ?></td>
							</tr>
			<?php							
				//variables que controlan las posiciones de los vectoresa
				$i=$i + 7;
				$semana=$semana + 1;
				}//fin de while
					//contiene el total de totales
				$t_total = $v_claro + $v_ambar + $v_verde + $p_claro;
			?>
							<tr style="font-weight: bold;">
								<td>Total</td>
								<td><?php if($v_claro==0) echo $posicion; else echo "$".number_format($v_claro,2,'.',','); ?></td>
								<td><?php if($v_ambar==0) echo $posicion; else echo "$".number_format($v_ambar,2,'.',','); ?></td>
								<td><?php if($v_verde==0) echo $posicion; else echo "$".number_format($v_verde,2,'.',','); ?></td>
								<td><?php if($p_claro==0) echo $posicion; else echo "$".number_format($p_claro,2,'.',','); ?></td>
								<td><?php if($t_total==0) echo $posicion; else echo "$".number_format($t_total,2,'.',','); ?></td>
							</tr>
						</tbody>
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
					<?php echo"<FORM ACTION='ExportarReporteRecolector_semanal.php?valor_recolector=$recolcetor&valor_mes=$mes&valor_ano=$anio' METHOD='post'>"; ?>
					<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar">
					</FORM>
				</td>
				<td>		
					<?php echo"<FORM ACTION='ImprimirReporteRecolector_semanal.php?valor_recolector=$recolcetor&valor_mes=$mes&valor_ano=$anio' METHOD='post'>"; ?>
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