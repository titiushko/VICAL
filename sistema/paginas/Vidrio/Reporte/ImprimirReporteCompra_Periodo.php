<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$nombre_mes = $_REQUEST['valor_mes'];
$ano 		= $_REQUEST['valor_ano'];
if($nombre_mes== '' || $ano == '') header("Location: VerReporteCompra_Periodo.php");

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
?>
<HTML>
	<head>
		<title><?php echo "REPORTE_DE_COMPRAS_EN_".strtoupper($nombre_mes)."_DEL_".$ano; ?></title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico"></link>
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1" onLoad="window.print();">
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<img src="../../../imagenes/logo VICAL.png">
					<br>
					<h1 align='center' class='encabezado1'>REPORTE DE COMPRAS</h1>
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado en <?php echo $nombre_mes." de ".$ano; ?>"</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead>
							<tr>
								<th><h3>Recibo</h3></th>
								<th><h3>Proveedor</h3></th>
								<th><h3>Quintales</h3></th>
								<th><h3>Monto</h3></th>
							</tr>
						</thead>
						<tbody align="center">
							<?php
							$recibos = calcularSumaFacturaPeriodo($mes,$ano);
							$totales = array(1=>0,2=>0);
							for($i=1; $i<=$filas; $i++){
							?>
							<tr>
								<td><?php echo $recibos[$i][1];?></td>
								<td><?php echo $recibos[$i][2];?></td>
								<td><?php echo $recibos[$i][3];?></td>
								<td>$<?php echo $recibos[$i][4];?></td>
							</tr>
							<?php
								$totales[1] += $recibos[$i][3];
								$totales[2] += $recibos[$i][4];
							}
							?>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td>
								<td><b><?php echo $totales[1];?></b></th>
								<td><b>$<?php echo $totales[2];?></b></th>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>