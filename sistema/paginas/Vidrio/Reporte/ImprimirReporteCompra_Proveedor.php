<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$proveedor = $_REQUEST['valor_proveedor'];
if($proveedor == '') header("Location: VerReporteCompra_Proveedor.php");

$nombre_documento = '';
for($i=0; $i<=strlen($proveedor); $i++){
	$caracter = substr($proveedor,$i,1);
	if($caracter == ' ') $nombre_documento = $nombre_documento.'_';
	else $nombre_documento = $nombre_documento.$caracter;
}
?>
<HTML>
	<head>
		<title><?php echo "REPORTE_DE_COMPRAS_A_".strtoupper($nombre_documento); ?></title>
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
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado a <?php echo $proveedor; ?>"</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead>
							<tr>
								<th><h3>Recibo</h3></th>
								<th><h3>Fecha</h3></th>
								<th><h3>Quintales</h3></th>
								<th><h3>Monto</h3></th>
							</tr>
						</thead>
						<tbody align="center">
							<?php
							$recibos = calcularSumaFacturaProveedor($proveedor);
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
								<td><b><?php echo $totales[1];?></b></td>
								<td><b>$<?php echo $totales[2];?></b></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>