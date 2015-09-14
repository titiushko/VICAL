<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$factura = $_REQUEST['codigo'];

$select_factura = "
SELECT facturas.codigo_factura, facturas.fecha, recolectores.nombre_recolector, facturas.codigo_recolector, proveedores.nombre_proveedor, facturas.codigo_proveedor, facturas.sucursal, centros_de_acopio.nombre_centro_acopio, facturas.precio_compra
FROM facturas, recolectores, proveedores, centros_de_acopio
WHERE facturas.codigo_factura = '$factura'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
AND facturas.codigo_centro_acopio = centros_de_acopio.codigo_centro_acopio";
$consulta_factura = mysql_query($select_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
$facturas = mysql_fetch_assoc($consulta_factura);

$Compra = calcularSumaVidrio($factura);
$Totales = calcularSumaTotales($Compra);

$select_vidrio = "
SELECT codigo_vidrio, vidrio.codigo_tipo, vidrio.codigo_color, vidrio.cantidad_vidrio, vidrio.precio_vidrio
FROM vidrio, facturas
WHERE facturas.codigo_factura = '$factura'
AND facturas.codigo_factura = vidrio.codigo_factura
ORDER BY codigo_vidrio ASC";
$consulta_vidrio = mysql_query($select_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());	

while($vidrios = mysql_fetch_array($consulta_vidrio)){
	$codigo_vidrio = $vidrios['codigo_vidrio'];
	
	//eliminar el registro de la tabla vidrios con el codigo del vidrio que se acaba de encontrar
	$instruccion_delete = "DELETE FROM vidrio WHERE codigo_vidrio = '$codigo_vidrio'";
	mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_vidrio!! </SPAN>".mysql_error());
}

//buscar con el codigo de factura en la tabla compras el codigo de la compra del registro que se va eliminar de la tabla compras
$instruccion_compra = "
SELECT compras.codigo_compra, facturas.codigo_factura
FROM compras, facturas
WHERE compras.codigo_factura = '$factura'
AND facturas.codigo_factura = compras.codigo_factura";
$consultar_compra = mysql_query($instruccion_compra, $conexion) or die ("<SPAN CLASS='error'>Fallo consultar_compra!! </SPAN>".mysql_error());
		
//eliminar el registro de la tabla compras con el codigo de la factura que se va eliminar
$instruccion_delete = "DELETE FROM compras WHERE compras.codigo_factura = '$factura'";
mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_compra!! </SPAN>".mysql_error());

//eliminar el registro de la tabla facturas con el codigo de la factura que se va eliminar
$instruccion_delete = "DELETE FROM facturas WHERE facturas.codigo_factura = '$factura'";
mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_factura!! </SPAN>".mysql_error());
?>
<!----------------------------------------------------------------------------------------------------------------->
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarCompra.php">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<link rel="stylesheet" 			 href="../../../librerias/calendario.css" type="text/css" media="screen"></link>
		<script type="text/javascript" 	 src="../../../librerias/calendario.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR COMPRA</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO LA COMPRA EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="resultado">
					<tr>
					<td>
						<!--------------------------------FECHA/No---------------------------------->
						<tr>
							<td align="right"><b>Fecha:</b></td>
							<td align="left"><?php echo $facturas['fecha'];?></td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td align="right"><b>No:</b></td>
							<td align="left"><?php echo $facturas['codigo_factura'];?></td>
						</tr>
						<!--------------------------------RECOLECOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><b>Recolector:</b></td>
							<td align="left"><?php echo $facturas['nombre_recolector'];?></td>
							<td align="right"><b>Codigo:</b></td>
							<td align="left"><?php echo $facturas['codigo_recolector'];?></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PROVEEDOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><b>Proveedor:</b></td>
							<td align="left"><?php echo $facturas['nombre_proveedor'];?></td>
							<td align="right"><b>Codigo:</b></td>
							<td align="left"><?php echo $facturas['codigo_proveedor'];?></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PRECIO----------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><span><b>Precio:</span></td>
							<td align="left"><?php echo "$".number_format($facturas['precio_compra'],2,'.',',');?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------VIDRIO------------------------------------>
						<tr>
							<td colspan="6">
							<table align="center" border class="rejilla" width="60%">
								<thead>
									<tr>
										<th rowspan=2 colspan=1></th>
										<th colspan=2>VERDE</th>
										<th colspan=2>CRISTALINO</th>
										<th colspan=2>CAFE</th>
										<th colspan=2>BRONCE</th>
										<th colspan=2>REFLECTIVO</th>
								<th colspan=2>TOTAL</th><!--total por tipo de vidrio-->
									</tr>
									<tr>
										<!--VERDE-->
										<th>QQ</th>
										<th>$$</th>
										<!--CRISTALINO-->
										<th>QQ</th>
										<th>$$</th>
										<!--CAFE-->
										<th>QQ</th>
										<th>$$</th>
										<!--BRONCE-->
										<th>QQ</th>
										<th>$$</th>
										<!--REFLECTIVO-->
										<th>QQ</th>
										<th>$$</th>
										<!--TOTAL-->
										<th>QQ</th>
										<th>$$</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>BOTELLA</th>
										<?php
										for($i=1; $i<=5; $i++){
											for($j=1; $j<=2; $j++){
												if($Compra[$i][$j] <> 0){
										?>
										<td><input class="fondo3" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<?php
												}
											}
										}
										if($Totales[1] <> 0 && $Totales[2] <> 0){
										?>
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1]);?>"></td><!--total por tipo de vidrio-->
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2]);?>"></td><!--total por tipo de vidrio-->
										<?php
										}
										else{
										?>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<?php
										}
										?>
									</tr>
									<tr>
										<th>PLANO</th>
										<?php
										for($i=6; $i<=10; $i++){
											for($j=1; $j<=2; $j++){
												if($Compra[$i][$j] <> 0){
										?>
										<td><input class="fondo3" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<?php
												}
											}
										}
										if($Totales[3] <> 0 && $Totales[4] <> 0){
										?>
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[3]);?>"></td><!--total por tipo de vidrio-->
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[4]);?>"></td><!--total por tipo de vidrio-->
										<?php
										}
										else{
										?>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<?php
										}
										?>
									</tr>
								</tbody>
							</table>
							</td>
						</tr>
						<!-----------------------------SUCURSAL Y CA--------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="center" colspan="4">
								<b>Sucursal:</b>
								<?php echo $facturas['sucursal'];?>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Centro de Acopio:</b>
								<?php echo $facturas['nombre_centro_acopio'];?>
							</td>
						</tr>
					</td>
					</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>