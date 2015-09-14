<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$mes		= $_REQUEST['valor_mes'];
$anio 		= $_REQUEST['valor_ano'];
$recolcetor = $_REQUEST['valor_recolector'];

if($mes=='01')	$nombre_mes="Enero"; 		else
if($mes=='02')	$nombre_mes="Febrero";		else
if($mes=='03')	$nombre_mes="Marzo";		else
if($mes=='04')	$nombre_mes="Abril";		else
if($mes=='05')	$nombre_mes="Mayo";			else
if($mes=='06')	$nombre_mes="Junio";		else
if($mes=='07')	$nombre_mes="Julio";		else
if($mes=='08')	$nombre_mes="Agosto";		else
if($mes=='09')	$nombre_mes="Septiembre";	else
if($mes=='10')	$nombre_mes="Octubre";		else
if($mes=='11')	$nombre_mes="Noviembre";	else
if($mes=='12')	$nombre_mes="Diciembre";

//obtener el codigo del recolector
$instruccion = "SELECT codigo_recolector FROM recolectores WHERE nombre_recolector='$recolcetor'";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$cod_recolec=$obtener[0];	//almacena el total de vidrio claro

$nombre_documento = '';
for($i=0; $i<=strlen($recolcetor); $i++){
	$caracter = substr($recolcetor,$i,1);
	if($caracter == ' ') $nombre_documento = $nombre_documento.'_';
	else $nombre_documento = $nombre_documento.$caracter;
}
?>
<HTML>
	<head>
		<title><?php echo "REPORTE_DE_COMPRAS_SEMANAL_DE_".strtoupper($nombre_documento)."_EN_EL_MES_DE_".strtoupper($nombre_mes)."_DEL_".$anio;?></title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1" onLoad="window.print();">
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<img src="../../../imagenes/logo VICAL.png">
					<h1 align='center' class='encabezado1'>REPORTE DE COMPRAS POR RECOLECTORES</h1>
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado Semanalmente por <?php echo $recolcetor;?> en el mes de <?php echo $nombre_mes." de ".$anio; ?>"</h2>
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
						<tbody align="center">
<?php
//generar las consultas que devuelven las suma de precio_vidrios de vidrio comprado por semanas
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
$instruccion = "SELECT SUM(precio_vidrio) AS precio_vidrio FROM vidrio WHERE codigo_tipo='TV-01' AND codigo_color='CV-02' AND codigo_factura IN 
				(SELECT codigo_factura FROM facturas WHERE codigo_recolector='$cod_recolec' AND fecha BETWEEN '$anio-$mes-$inicio' AND '$anio-$mes-$final')";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$vidrio_claro=number_format($obtener[0],2,'.',',');	//almacena el total de vidrio claro	
$v_claro += $vidrio_claro;	

//para tipo de vidrio Botella Ambar
$instruccion = "SELECT SUM(precio_vidrio) AS precio_vidrio FROM vidrio WHERE codigo_tipo='TV-01' AND codigo_color='CV-03' AND codigo_factura IN 
				(SELECT codigo_factura FROM facturas WHERE codigo_recolector='$cod_recolec' AND fecha BETWEEN '$anio-$mes-$inicio' AND '$anio-$mes-$final')";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$vidrio_ambar=number_format($obtener[0],2,'.',',');	//almacena el total de vidrio claro		
$v_ambar += $vidrio_ambar;				

//para tipo de vidrio Botella Verde
$instruccion = "SELECT SUM(precio_vidrio) AS precio_vidrio FROM vidrio WHERE codigo_tipo='TV-01' AND codigo_color='CV-01' AND codigo_factura IN 
				(SELECT codigo_factura FROM facturas WHERE codigo_recolector='$cod_recolec' AND fecha BETWEEN '$anio-$mes-$inicio' AND '$anio-$mes-$final')";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$obtener = mysql_fetch_array($consulta);
$vidrio_verde=number_format($obtener[0],2,'.',',');	//almacena el total de vidrio claro	
$v_verde += $vidrio_verde;

//para tipo de vidrio Plano Claro
$instruccion = "SELECT SUM(precio_vidrio) AS precio_vidrio FROM vidrio WHERE codigo_tipo='TV-02' AND codigo_color='CV-02' AND codigo_factura IN 
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
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>