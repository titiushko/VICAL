<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoContador.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$nombre_tipo = $_POST['seleccionar_tipo'];
$sucursal  	 = $_POST['sucursal'];
if($nombre_tipo == '' || $sucursal == '') header("Location: frmHistorialCompra.php");

if($nombre_tipo == 'Botella') 	$tipo = 'TV-01';
if($nombre_tipo == 'Plano') 	$tipo = 'TV-02';

switch($sucursal){
	case 'VICESA':
	case 'VIGUA':	$Sucursal = " para ".$sucursal."."; break;
	case 'AMBAS':	$Sucursal = "."; break;
}

$seleccionar_vidrio = "
SELECT
YEAR(fecha) AS ano,
MONTH(fecha) AS mes,
vidrio.cantidad_vidrio,
vidrio.precio
FROM facturas, vidrio
WHERE facturas.codigo_factura = vidrio.codigo_factura
AND vidrio.codigo_tipo = '$tipo'
ORDER BY facturas.fecha  ASC";
$consulta_vidrio = mysql_query($seleccionar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<style>.centro{width: 70%;}</style>
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
			$consulta = mysql_query("SELECT COUNT(codigo_tipo) AS cantidad FROM vidrio WHERE codigo_tipo = '$tipo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta cantidad proveedores!!</SPAN>".mysql_error());
			$cantidad = mysql_fetch_assoc($consulta);
			if($cantidad['cantidad'] == 0){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR EL HISTORIAL DE COMPRAS!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">No hay valores que mostrar.<br>No se a comprado vidrio <?php echo $nombre_tipo.$Sucursal;?></td>
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
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<table class="marco centro">
						<tr>
							<td align="center">
								<h2 class="encabezado2">Historial de vidrio <?php echo $nombre_tipo;?> comprado<?php echo $Sucursal;?></h2>
							<?php
							$bandera = true;
							$historial = calcularSumaMes('tipo_vidrio',$tipo,$sucursal);
							for($i=1; $i<=$filas; $i++){
							?>
								<table align="center" class="rejilla" border bgcolor="white" width="50%">
							<?php
								if($bandera){
							?>
									<thead class="titulo2">
										<tr><th colspan="3"><span class="encabezado2"><?php echo $historial[$i][1];?></span></th></tr>
										<tr><th width="90">MES</th><th width="85">CANTIDAD</th><th width="85">MONTO</th></tr>
									</thead>
									<tbody align="center">
										<tr align="center">
											<th width="90" class="subtitulo1"><?php echo $historial[$i][2];?></th>
											<td width="87" class="subtitulo1"><?php echo number_format($historial[$i][3],2,'.',','); ?></td>
											<td width="87" class="subtitulo1"><?php echo "$".number_format($historial[$i][4],2,'.',','); ?></td>
										</tr>
							<?php
									$temp = $historial[$i][1];
									$bandera = false;
								}
								else if($temp == $historial[$i][1]){
							?>
										<tr align="center">
											<th width="90" class="subtitulo1"><?php echo$historial[$i][2];?></th>
											<td width="87" class="subtitulo1"><?php echo number_format($historial[$i][3],2,'.',','); ?></td>
											<td width="87" class="subtitulo1"><?php echo "$".number_format($historial[$i][4],2,'.',','); ?></td>
										</tr>
							<?php
									}
									else{
							?>
									</tbody>
								</table>
								<br>
							<?php
										$bandera = true;
									}
							}
							?>
							</td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<center><?php echo hoyEs();?></center>
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