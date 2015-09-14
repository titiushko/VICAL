<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
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

$recibos = calcularSumaFacturaPeriodo($mes,$ano);
$totales = array(1=>0,2=>0);

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=REPORTE_DE_COMPRAS_EN_".strtoupper($nombre_mes)."_DEL_".$ano.".doc");
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico"></link>
	</head>
	<BODY>
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<h1 align='center'>
						<font size="7">VICAL</font><br><font size="5">GRUPO VIDRIERO CENTROAMERICANO</font>
					</h1>
					<br>
					<h1 align='center'>REPORTE DE COMPRAS</h1>
					<h2 align='center'>&quot;Vidrio Comprado en <?php echo $nombre_mes." de ".$ano; ?>"</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<?php
					$total_paginas = $_SESSION["total_paginas"];
					$registros = 1;	$paginas = 1;	$reiniciar = true;					
					for($i=1; $i<=$filas; $i++){
						if($reiniciar){
					?>
					<table border="1" width="550">
						<thead align="center">
							<tr>
								<th>RECIBO</th>
								<th>PROVEEDOR</th>
								<th>QUINTALES</th>
								<th>MONTO</th>
							</tr>
						</thead>
					<?php
						}
						if($registros == 30){
					?>
						</tbody>
					</table>
					<b>Pagina <?php echo $paginas;?> de <?php echo $total_paginas;?></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b><?php echo hoyEs();?></b>
					<br><br>
					<?php
							$registros = 1;	$paginas++;	$reiniciar = true;
						}
						else{
					?>
						<tbody align="center">
							<tr align="center">
								<td><?php echo $recibos[$i][1];?></td>
								<td><?php echo $recibos[$i][2];?></td>
								<td><?php echo $recibos[$i][3];?></td>
								<td>$<?php echo $recibos[$i][4];?></td>
							</tr>
					<?php
							$reiniciar = false;
						}
						$registros++;
						$totales[1] += $recibos[$i][3];
						$totales[2] += $recibos[$i][4];
					}
					?>
							<tr>
								<td>&nbsp;</td><td>&nbsp;</td>
								<th><?php echo $totales[1];?></th>
								<th>$<?php echo $totales[2];?></th>
							</tr>
						</tbody>
					</table>
					<?php
					if($paginas <= $total_paginas){
					?>
					<b>Pagina <?php echo $paginas;?> de <?php echo $total_paginas;?></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b><?php echo hoyEs();?></b>
					<?php
					}
					?>
				</td>
			</tr>
		</table>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>