<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$nombre_recolector 	= $_REQUEST['valor_nombre_recolector'];
$nom_p 				= $_REQUEST['nom_p'];
$nom_ca				= $_REQUEST['nom_ca'];
$top				= $_SESSION["cuenta_compras"];

$instruccion_select = "
SELECT codigo_recolector, nombre_recolector, dui_recolector, nit_recolector, direccion_recolector, telefono_recolector
FROM recolectores 
WHERE nombre_recolector = '$nombre_recolector'";
$consulta_recolector = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_recolector!!</SPAN>".mysql_error());
$recolector = mysql_fetch_assoc($consulta_recolector);

$instruccion_select = "SELECT codigo_factura FROM compras ORDER BY codigo_compra DESC LIMIT $top";
$consulta_facturas = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_facturas!!</SPAN>".mysql_error());

for($i=1; $i<=100; $i++) $coloresVidrio[$i] = 0;
$i = 1;
$TotalesCantidades = 0;	$TotalesPrecios = 0;
while($facturas = mysql_fetch_assoc($consulta_facturas)){
	$Totales = calcularSumaTotales(calcularSumaTotalVidrio($facturas['codigo_factura'],'AMBAS'));
	$TotalesCantidades	+= $Totales[1] +  $Totales[3];
	$TotalesPrecios		+= $Totales[2] + $Totales[4];
	$coloresVidrio[$i] = coloresVidrioComprado($facturas['codigo_factura']);
	$i++;
}

for($j=1; $j<=5; $j++)	$coloresVidrioComprado[$j] = '';
for($k=1; $k<=$i; $k++){
	if($coloresVidrio[$k][1] == 1)	$coloresVidrioComprado[1] = 'VERDE';
	if($coloresVidrio[$k][2] == 1)	$coloresVidrioComprado[2] = 'CRISTALINO';
	if($coloresVidrio[$k][3] == 1)	$coloresVidrioComprado[3] = 'CAFE';
	if($coloresVidrio[$k][4] == 1)	$coloresVidrioComprado[4] = 'BRONCE';
	if($coloresVidrio[$k][5] == 1)	$coloresVidrioComprado[5] = 'REFLECTIVO';
}

$COLORES = "";
for($j=1; $j<=5; $j++)
	if($coloresVidrioComprado[$j] != ''){
		$COLORES = $COLORES.$coloresVidrioComprado[$j];
		if($j < 5)
			if($coloresVidrioComprado[$j+1] != '')
				$COLORES = $COLORES.", ";
	}

$honorarios = $TotalesPrecios;
$renta = $honorarios*0.10;
$total = $honorarios - $renta;
$fecha_hoy = fechaHoy();

$nombre_documento = '';
for($i=0; $i<=strlen($nombre_recolector); $i++){
	$caracter = substr($nombre_recolector,$i,1);
	if($caracter == ' ') $nombre_documento = $nombre_documento.'_';
	else $nombre_documento = $nombre_documento.$caracter;
}
?>
<HTML>
	<head>
		<title><?php echo "HOJA_DE_FLETE_PARA_".strtoupper($nombre_documento)."_AL_".$fecha_hoy[0]."_DE_".$fecha_hoy[1]."_DEL_".$fecha_hoy[2];?></title>
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
	<BODY class="cuerpo1" onLoad="window.print()">
		<table align="center" border="0">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center">
					<img src="../../../imagenes/logo VICAL.png">
					<h1 align='center' class='encabezado1'>REPORTE DE RECOLECTOR, CORTE DE CAJA</h1>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" bgcolor="white" style="border: solid 2px;">
					<table border="0">
						<tr><td colspan="6">&nbsp;</td></tr>
						<tr>
							<td align="center" colspan="6" class="subtitulo1">
								POR $&nbsp;
								<input class="subtitulo3 sublin" value="<?php echo number_format($TotalesPrecios,2,'.',',');?>" readonly size="10">
							</td>
						</tr>
						<tr><td colspan="6">&nbsp;</td></tr>
						<tr>
							<td align="left" colspan="6" class="subtitulo1">
								RECIBI DE&nbsp;
								<input class="subtitulo3 sublin" value="<?php echo $nom_p;?>" readonly size="70">&nbsp;
								LA CANTIDAD DE:<br>
								<input class="subtitulo3 sublin" value="<?php echo numeroLetras($TotalesPrecios);?>" readonly size="80">&nbsp;
								($&nbsp;
								<input class="subtitulo3 sublin" value="<?php echo number_format($TotalesPrecios,2,'.',',');?>" readonly size="10">
								)<br>
								EN CONCEPTO DE CANCELACON DE TRANSPORTE DE DERECHOS DE VIDRIO<br>
								PROCEDENTES DE PROVEEDORES, A CENTROS DE ACOPIO DE:<br>
								<input class="subtitulo3 sublin" value="<?php echo $nom_ca;?>" readonly size="30">&nbsp;
								COLOR&nbsp;
								<input class="subtitulo3 sublin" value="<?php echo $COLORES;?>" readonly size="55"><br>
								POR LA CANTIDAD DE:&nbsp;
								<input class="subtitulo3 sublin" value="<?php echo number_format($TotalesCantidades,2,'.',',');?>" readonly size="10">&nbsp;
								QUINTALES SEGUN DETALLE:
							</td>
						</tr>
						<tr><td colspan="6">&nbsp;</td></tr>
						<tr>
							<td align="left" class="subtitulo1" colspan="2" width="60">
								HONORARIOS
							</td>
							<td align="center">
								$&nbsp;
								<input value="<?php echo number_format($honorarios,2,'.',',');?>" class="subtitulo3 sublin" readonly size="10">
							</td>
							<td align="left" colspan="3" width="110">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td align="left" class="subtitulo1" colspan="2" width="60">
								(-) RETENCION DE RENTA
							</td>
							<td align="center">
								$&nbsp;
								<input value="<?php echo number_format($renta,2,'.',',');?>" class="subtitulo3 sublin" readonly size="10">
							</td>
							<td align="left" colspan="3" width="110">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td align="left" class="subtitulo1" colspan="2" width="60">
								TOTAL A PAGAR
							</td>
							<td align="center" style="border: solid 2px;">
								$&nbsp;
								<input value="<?php echo number_format($total,2,'.',',');?>" class="subtitulo3 sinsublin" style="text-align: center;" readonly size="10">
							</td>
							<td align="left" colspan="3" width="110">
								&nbsp;
							</td>
						</tr>
						<tr><td colspan="6">&nbsp;</td></tr>
						<tr>
							<td align="left" class="subtitulo1">
								SAN SALVADOR
							</td>
							<td align="center">
								<input class="subtitulo3 sublin" value="<?php echo $fecha_hoy[0];?>" readonly size="10">
							</td>
							<td align="center" class="subtitulo1">
								DE
							</td>
							<td align="center">
								<input class="subtitulo3 sublin" value="<?php echo $fecha_hoy[1];?>" readonly size="10">
							</td>
							<td align="center" class="subtitulo1">
								DEL
							</td>
							<td align="center">
								<input class="subtitulo3 sublin" value="<?php echo $fecha_hoy[2];?>" readonly size="10">
							</td>
						</tr>
						<tr><td colspan="6">&nbsp;</td></tr>
						<tr>
							<td align="left" class="subtitulo1">
								NOMBRE
							</td>
							<td align="left" colspan="5">
								<input class="subtitulo3 sinsublin" value="<?php echo $recolector['nombre_recolector'];?>" readonly size="70">
							</td>
						</tr>
						<tr>
							<td align="left" class="subtitulo1">
								DUI
							</td>
							<td align="left" colspan="5">
								<input class="subtitulo3 sinsublin" value="<?php echo $recolector['dui_recolector'];?>" readonly size="70">
							</td>
						</tr>
						<tr>
							<td align="left" class="subtitulo1">
								NIT
							</td>
							<td align="left" colspan="5">
								<input class="subtitulo3 sinsublin" value="<?php echo $recolector['nit_recolector'];?>" readonly size="70">
							</td>
						</tr>
						<tr>
							<td align="left" class="subtitulo1">
								DIRECCION
							</td>
							<td align="left" colspan="5">
								<input class="subtitulo3 sinsublin" value="<?php echo $recolector['direccion_recolector'];?>" readonly size="70">
							</td>
						</tr>
						<tr><td colspan="6">&nbsp;</td></tr>
					</table>
				</td>
			</tr>
		</table>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>