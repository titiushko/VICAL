<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$nombre_recolector 		= $_REQUEST['valor_nombre_recolector'];
$nombre_centro_acopio 	= $_REQUEST['valor_centro_acopio'];
$top					= $_SESSION["cuenta_compras"];	$_SESSION["cuenta_compras"] = 1;

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
	if($coloresVidrio[$k][1] == 1)	$coloresVidrioComprado[1] = 'CLARO';
	if($coloresVidrio[$k][2] == 1)	$coloresVidrioComprado[2] = 'VERDE';
	if($coloresVidrio[$k][3] == 1)	$coloresVidrioComprado[3] = 'CAFE';
	if($coloresVidrio[$k][4] == 1)	$coloresVidrioComprado[4] = 'BRONCE';
	if($coloresVidrio[$k][5] == 1)	$coloresVidrioComprado[5] = 'REFLECTIVO';
}

$COLORES = "";
for($j=1; $j<=5; $j++)
	if($coloresVidrioComprado[$j] != ''){
		$COLORES = $COLORES.$coloresVidrioComprado[$j];
		if($j < 5)
			//if($coloresVidrioComprado[$j+1] != '')
				$COLORES = $COLORES.", ";
	}

$honorarios = $TotalesPrecios;
$renta = $honorarios*0.10;
$total = $honorarios - $renta;
$fecha_hoy = fechaHoy();
?>
<HTML>
	<head>
		<title>COMVICONPRO</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" src="../../../librerias/funciones.js"></script>
		<script type="text/javascript">
		var nom_p = '', nom_ca = '';		
		function devolver(elemento){return elemento;}
		function obtenerP(elemento){nom_p = elemento.value;}
		function obtenerCA(elemento){nom_ca = elemento.value;}
		function verificar(){
			if(nom_p == '' || nom_p == '.:Proveedor:.') {alert("Falta seleccionar el proveedor!!"); return false;}
			if(nom_ca == '' || nom_ca == '.:Centro de Acopio:.') {alert("Falta seleccionar el centro de acopio!!"); return false;}
			return true;
		}
		</script>		
	</head>
	<BODY class="cuerpo1">
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
								<input class="subtitulo3 sublin" value="<?php echo "COMERCIAL AGUIRREURRETA, S.A DE C.V";?>" readonly size="70">&nbsp;
								LA CANTIDAD DE:<br>
								<input class="subtitulo3 sublin" value="<?php echo numeroLetras($TotalesPrecios);?>" readonly size="82">&nbsp;
								($&nbsp;
								<input class="subtitulo3 sublin" value="<?php echo number_format($TotalesPrecios,2,'.',',');?>" readonly size="10">
								)<br>
								EN CONCEPTO DE CANCELACON DE TRANSPORTE DE DERECHOS DE VIDRIO PROCEDENTES DE<br>
								PROVEEDORES, A CENTROS DE ACOPIO DE:<br>								
								<input class="subtitulo3 sublin" value="<?php echo $nombre_centro_acopio;?>" readonly size="85"><br>
								COLOR&nbsp;
								<input class="subtitulo3 sublin" value="<?php echo $COLORES;?>" readonly size="75"><br>
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
								<span class="subtitulo3"><?php echo $recolector['nombre_recolector'];?></span>
							</td>
						</tr>
						<?php
						if($recolector['dui_recolector']<>'-'){
						?>
						<tr>
							<td align="left" class="subtitulo1">
								DUI
							</td>
							<td align="left" colspan="5">
								<span class="subtitulo3"><?php echo $recolector['dui_recolector'];?></span>
							</td>
						</tr>
						<?php
						}
						if($recolector['nit_recolector']<>'---'){
						?>
						<tr>
							<td align="left" class="subtitulo1">
								NIT
							</td>
							<td align="left" colspan="5">
								<span class="subtitulo3"><?php echo $recolector['nit_recolector'];?></span>
							</td>
						</tr>
						<?php
						}
						if($recolector['direccion_recolector']<>NULL){
						?>
						<tr>
							<td align="left" class="subtitulo1">
								DIRECCION
							</td>
							<td align="left" colspan="5">
								<span class="subtitulo3"><?php echo $recolector['direccion_recolector'];?></span>
							</td>
						</tr>
						<?php
						}
						?>
						<tr><td colspan="6">&nbsp;</td></tr>
					</table>
				</td>
			</tr>
		</table>
		<!----------------------------------------------------------------------------------------------------->
		<br><center><?php echo hoyEs();?></center><br>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
		<table align="center">
			<tr>
				<td>
					<FORM ACTION="ExportarReporteRecolector_CorteCaja.php<?php echo "?valor_nombre_recolector=".$recolector['nombre_recolector']."&valor_nombre_centro_acopio=$nombre_centro_acopio"; ?>" METHOD="post">
					<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar_word">
					</FORM>
				</td>
				<td>		
					<FORM ACTION="ImprimirReporteRecolector_CorteCaja.php<?php echo "?valor_nombre_recolector=".$recolector['nombre_recolector']."&valor_nombre_centro_acopio=$nombre_centro_acopio"; ?>" METHOD="post">
					<input name="Imprimir" type="submit" value="Imprimir" onMouseOver="toolTip('Imprimir',this)" class="boton imprimir">
					</FORM>
				</td>
			</tr>
		</table>
		<?php } ?>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<span id="toolTipBox" width="50"></span>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<table align="center" class="resultado centro">
		<tr>
			<td align="center">
				Desea registrar una nueva compra de vidrio?<br><br>
				<img src="../../../imagenes/icono_aceptar.png" onMouseOver="toolTip('Aceptar',this)" class="manita" onClick="redireccionar('../../Vidrio/Nueva/frmNuevaCompra.php<?php echo "?valor_nombre_recolector=nueva_compra"; ?>')">
				<img src="../../../imagenes/icono_cancelar.png" onMouseOver="toolTip('Cancelar',this)" class="manita" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
			</td>
		</tr>
		</table>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>