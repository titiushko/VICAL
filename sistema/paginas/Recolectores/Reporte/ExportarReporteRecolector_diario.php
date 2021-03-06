<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$recolcetor = $_REQUEST['valor_recolector'];

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Reporte-Recolector.doc");

$instruccion = "
SELECT
facturas.fecha,
centros_de_acopio.departamento,
proveedores.nombre_proveedor,
vidrio.cantidad_vidrio,
vidrio.precio_vidrio
FROM
facturas,
vidrio,
recolectores,
centros_de_acopio,
proveedores
WHERE
nombre_recolector = '$recolcetor'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND centros_de_acopio.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
AND facturas.codigo_factura = vidrio.codigo_factura
ORDER BY fecha ASC";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$recolectores = mysql_fetch_array($consulta);
?>
<HTML>
	<head>
		<title><?php echo$recolectores['nombre_recolector'];?></title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
	</head>
	<BODY class="cuerpo1">
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<h1 align='center' class='encabezado1'>&quot;Reporte de <?php echo $recolcetor; ?>&quot;</h1>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead>
							<tr>
								<th><h3>Fecha</h3></th>
								<th><h3>Centro de Acopio</h3></th>
								<th><h3>Proveedor</h3></th>
								<th><h3>Cantidad</h3></th>
								<th><h3>Monto</h3></th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($registros = mysql_fetch_array($consulta)){
							?>
							<tr align="center">
								<td><?php echo $registros[0];?></td>
								<td><?php echo $registros[1];?></td>
								<td><?php echo $registros[2];?></td>
								<td><?php echo $registros[3];?></td>
								<td><?php echo $registros[4];?></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</td>
			</tr>
		</table>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>