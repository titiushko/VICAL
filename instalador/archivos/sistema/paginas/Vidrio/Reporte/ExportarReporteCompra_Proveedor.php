<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$proveedor = $_REQUEST['valor_proveedor'];
if($proveedor == '') header("Location: VerReporteCompra_Proveedor.php");

$recibos = calcularSumaFacturaProveedor($proveedor);
$totales = array(1=>0,2=>0);

for($i=0; $i<=strlen($proveedor); $i++){
	$caracter = substr($proveedor,$i,1);
	if($caracter == ' ') $nombre_documento = $nombre_documento.'_';
	else $nombre_documento = $nombre_documento.$caracter;
}

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=REPORTE_DE_COMPRAS_A_".strtoupper($nombre_documento).".doc");
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
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado a <?php echo $proveedor; ?>"</h2>
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
								<th>FECHA</th>
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
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>