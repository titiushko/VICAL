<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$factura = $_REQUEST['eliminar_factura'];

$select_factura = "
SELECT facturas.codigo_factura, facturas.fecha, recolectores.nombre_recolector, facturas.codigo_recolector, proveedores.nombre_proveedor, facturas.codigo_proveedor
FROM facturas, recolectores, proveedores
WHERE facturas.codigo_factura = '$factura'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor";
$consulta_factura = mysql_query($select_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
$facturas = mysql_fetch_assoc($consulta_factura);
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
						<img src="../../../imagenes/icono_alerta.png">
						<br>
						REALMENTE DESEA ELIMINAR LA COMPRA!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="borrar_proveedor" <?php echo "action=\"EliminarCompra.php?codigo=$factura\"";?> method="post" enctype="multipart/form-data">
					<table class="alerta">
						<tr>
							<td>
								<table class="error" align="center">
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
									<caption><h1></h1></caption>
									<!--------------------------------RECOLECOR---------------------------------->
									<tr>
										<td></td>
										<td align="right"><b>Recolector:</b></td>
										<td align="left"><?php echo $facturas['nombre_recolector'];?></td>
										<td align="right"><b>Codigo:</b></td>
										<td align="left"><?php echo $facturas['codigo_recolector'];?></td>
										<td></td>
									</tr>
									<!--------------------------------PROVEEDOR---------------------------------->
									<tr>
										<td></td>
										<td align="right"><b>Proveedor:</b></td>
										<td align="left"><?php echo $facturas['nombre_proveedor'];?></td>
										<td align="right"><b>Codigo:</b></td>
										<td align="left"><?php echo $facturas['codigo_proveedor'];?></td>
										<td></td>
									</tr>
									<!--------------------------------------------------------------------------->
								</table>
								<!---->
								<table align="center" border class="error rejilla" width="60%">
									<caption><h1></h1></caption>
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
											$Compra = calcularSumaVidrio($factura);
											$Totales = calcularSumaTotales($Compra);
											for($i=1; $i<=5; $i++){
												for($j=1; $j<=2; $j++){
													if($Compra[$i][$j] <> 0){
											?>
											<td><input class="error fondo2" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
											<?php
													}
													else{
											?>
											<td><input class="error fondo2" type="text" size="4" readonly></td>
											<?php
													}
												}
											}
											if($Totales[1] <> 0 && $Totales[2] <> 0){
											?>
											<td><input class="error fondo2" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1]);?>"></td><!--total por tipo de vidrio-->
											<td><input class="error fondo2" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2]);?>"></td><!--total por tipo de vidrio-->
											<?php
											}
											else{
											?>
											<td><input class="error fondo2" type="text" size="4" readonly></td>
											<td><input class="error fondo2" type="text" size="4" readonly></td>
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
											<td><input class="error fondo2" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
											<?php
													}
													else{
											?>
											<td><input class="error fondo2" type="text" size="4" readonly></td>
											<?php
													}
												}
											}
											if($Totales[3] <> 0 && $Totales[4] <> 0){
											?>
											<td><input class="error fondo2" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[3]);?>"></td><!--total por tipo de vidrio-->
											<td><input class="error fondo2" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[4]);?>"></td><!--total por tipo de vidrio-->
											<?php
											}
											else{
											?>
											<td><input class="error fondo2" type="text" size="4" readonly></td>
											<td><input class="error fondo2" type="text" size="4" readonly></td>
											<?php
											}
											?>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!------------------------------------------------------------------------>
					<input name="Eliminar" type="submit" value="Eliminar" onMouseOver="toolTip('Aceptar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/VerCompra.php?valor=$factura')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>