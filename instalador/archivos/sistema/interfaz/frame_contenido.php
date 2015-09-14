<?php
include "../librerias/funciones.php";
include "../librerias/abrir_conexion.php";
session_start();
if($_SESSION["autenticado"] != "SI"){
	session_destroy();
	header("Location: ../loggin/Denegado/CargarDenegado.php");
	exit();
}
//SELECT MAX(codigo_ultima_compra) AS ultima, codigo_factura FROM ultima_compra
$consultar_ultima_compra = mysql_query("SELECT codigo_factura FROM compras ORDER BY codigo_compra DESC", $conexion) or die ("<SPAN CLASS='error'>Fallo en consultar_ultima!!</SPAN>".mysql_error());
$ultima_factura = mysql_fetch_assoc($consultar_ultima_compra);
$codigo_factura = $ultima_factura['codigo_factura'];

$select_factura = "
SELECT facturas.codigo_factura, facturas.fecha, recolectores.nombre_recolector, facturas.codigo_recolector, proveedores.nombre_proveedor, facturas.codigo_proveedor, facturas.sucursal, centros_de_acopio.nombre_centro_acopio, facturas.precio_compra
FROM facturas, recolectores, proveedores, centros_de_acopio
WHERE facturas.codigo_factura = '$codigo_factura'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
AND facturas.codigo_centro_acopio = centros_de_acopio.codigo_centro_acopio";
$consulta_factura = mysql_query($select_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
$facturas = mysql_fetch_assoc($consulta_factura);

$cambio = $_SESSION["cambio"];

$ventas	= vendeMas();			$compras = compraMas();
for($i=1;$i<=5;$i++){
	if($ventas[$i][1] != 0 && $ventas[$i][2] != ""){$_SESSION["venta".$i][1]  = $ventas[$i][1];		$_SESSION["venta".$i][2]  = $ventas[$i][2];}
	else break;
	if($compras[$i][1] != 0 && $compras[$i][2] != ""){$_SESSION["compra".$i][1] = $compras[$i][1];	$_SESSION["compra".$i][2] = $compras[$i][2];}
	else break;
}
?>
<!DOCTYPE html PUBLIC "-//WRC//DTD HTML 4.01 Transitional//EN">
<HTML>
	<head>
		<title>SCYCPVES</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="Tito">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../imagenes/vical.ico"/>
		<link rel="stylesheet"			 href="../librerias/formato.css" type="text/css"></link>
		<link rel="stylesheet"			 href="../librerias/jquery/grafica/css/visualize.css" type="text/css">
		<link rel="stylesheet"			 href="../librerias/jquery/grafica/css/visualize-dark-contenido.css" type="text/css">
		<script type="text/javascript" 	 src="../librerias/funciones.js"></script>
		<script type="text/javascript"	 src="../librerias/jquery/jquery.js"></script>
		<script type="text/javascript"	 src="../librerias/jquery/grafica/js/visualize.jQuery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var colores = new Array('#009f3c','#00a8ec','#ea6b48','#724c21','#df0024');
				cambio = <?php echo $cambio;?>;
				if(cambio == 1){
					$('#graficar1').visualize({type:'bar',parseDirection:'x',width:230,height:150,colors:colores});
					$('#graficar2').visualize({type:'bar',parseDirection:'x',width:230,height:150,colors:colores});
				}
				else if(cambio == 2){
					$('#graficar1').visualize({type:'pie',parseDirection:'x',width:230,height:150,colors:colores,pieMargin:1});
					$('#graficar2').visualize({type:'pie',parseDirection:'x',width:230,height:150,colors:colores,pieMargin:1});
				}
			});
		</script>
	</head>
	<BODY class="cuerpo1">	
		<CENTER>
		<h1 class="encabezado1">SISTEMA DE COMPRAS Y CONTROL DE PROVEEDORES DE LA EMPRESA VICAL DE EL SALVADOR</h1>
		<h1 class="encabezado1">Bienvenid@ <font color="#ffff00"><?php echo $_SESSION["nombre"]."";?></font></h1>
		<br>
		<img SRC="../imagenes/vidrio.png">
		</CENTER>
		<?php if($ventas && $compras){ ?>
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td>					
					<table id="graficar1" class="oculto">
						<caption>Proveedores que mas se les ha comprado Vidrio</caption>
						<thead><tr><td>&nbsp;</td><th></th></tr></thead>
						<tbody>
						<?php for($i=1;$i<=5;$i++){ ?>
						<tr><th><?php echo $_SESSION["venta".$i][2];?></th><td><?php echo $_SESSION["venta".$i][1];?></td></tr>
						<?php } ?>
						</tbody>
					</table>
				</td>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<td>					
					<table id="graficar2" class="oculto">
						<caption>Recolectores que mas han comprado Vidrio</caption>
						<thead><tr><td>&nbsp;</td><th></th></tr></thead>
						<tbody>
						<?php for($i=1;$i<=5;$i++){ ?>
						<tr><th><?php echo $_SESSION["compra".$i][2];?></th><td><?php echo $_SESSION["compra".$i][1];?></td></tr>
						<?php } ?>
						</tbody>
					</table>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
			<tr>
				<td align="center" colspan="2">
					<br><span class="encabezado1"><b>Ultima Compra Registrada al Sistema</b></span>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="2" bgcolor="white">
					<table align="center">
						<!---------------------------------------------------------------------------------------------------------->
						<tr>
							<td align="right" class="titulo3">Fecha:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['fecha'];?></td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td align="right" class="titulo3">No:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['codigo_factura'];?></td>
						</tr>
						<!---------------------------------------------------------------------------------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo3">Recolector:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['nombre_recolector'];?></td>
							<td align="right" class="titulo3">Codigo:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['codigo_recolector'];?></td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------------------------------------------------------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo3">Proveedor:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['nombre_proveedor'];?></td>
							<td align="right" class="titulo3">Codigo:</td>
							<td align="left" class="subtitulo1"><?php echo $facturas['codigo_proveedor'];?></td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------------------------------------------------------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><span class="titulo3">Precio:</span></td>
							<td align="left" class="subtitulo1"><?php echo "$".number_format($facturas['precio_compra'],2,'.',',');?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------------------------------------------------------------------------------->
						<tr>
							<td colspan="6">
								<table align="center" border class="rejilla" width="60%">
									<thead class="titulo3">
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
											<th class="titulo3">BOTELLA</th>
											<?php
											$Compra = calcularSumaVidrio($codigo_factura);
											$Totales = calcularSumaTotales($Compra);
											for($i=1; $i<=5; $i++){
												for($j=1; $j<=2; $j++){
													if($Compra[$i][$j] <> 0){
											?>
											<td><input style="border: none;" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
											<?php
													}
													else{
											?>
											<td class="subtitulo1"><input style="border: none;" type="text" size="4" readonly></td>
											<?php
													}
												}
											}
											if($Totales[1] <> 0 && $Totales[2] <> 0){
											?>
											<td><input style="border: none;" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1]);?>"></td><!--total por tipo de vidrio-->
											<td><input style="border: none;" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2]);?>"></td><!--total por tipo de vidrio-->
											<?php
											}
											else{
											?>
											<td><input style="border: none;" type="text" size="4" readonly></td>
											<td><input style="border: none;" type="text" size="4" readonly></td>
											<?php
											}
											?>
										</tr>
										<tr>
											<th class="titulo3">PLANO</th>
											<?php
											for($i=6; $i<=10; $i++){
												for($j=1; $j<=2; $j++){
													if($Compra[$i][$j] <> 0){
											?>
											<td><input style="border: none;" type="text" size="4" readonly value="<?php printf("%.2f",$Compra[$i][$j]);?>"></td>
											<?php
													}
													else{
											?>
											<td class="subtitulo1"><input style="border: none;" type="text" size="4" readonly></td>
											<?php
													}
												}
											}
											if($Totales[3] <> 0 && $Totales[4] <> 0){
											?>
											<td><input style="border: none;" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[3]);?>"></td><!--total por tipo de vidrio-->
											<td><input style="border: none;" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[4]);?>"></td><!--total por tipo de vidrio-->
											<?php
											}
											else{
											?>
											<td><input style="border: none;" type="text" size="4" readonly></td>
											<td><input style="border: none;" type="text" size="4" readonly></td>
											<?php
											}
											?>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<!---------------------------------------------------------------------------------------------------------->
						<tr>
							<td align="center" colspan="6">
								<span class="titulo3">Sucursal:</span>
								<span class="subtitulo1"><?php echo $facturas['sucursal'];?></span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="titulo3">Centro de Acopio:</span>
								<span class="subtitulo1"><?php echo $facturas['nombre_centro_acopio'];?></span>
							</td>
						</tr>
						<!---------------------------------------------------------------------------------------------------------->
					</table>
				</td>				
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="2">
					<span id="toolTipBox" width="50"></span>
					<img src="../imagenes/icono_modificar.png" align="top" onMouseOver="toolTip('Modificar Compra de Vidrio',this);" onClick="redireccionar('../paginas/Vidrio/Modificar/frmModificarCompra.php<?php echo "?modificar_factura=".$facturas['codigo_factura'];?>');" class="manita">
					<img src="../imagenes/icono_eliminar.png" align="top" onMouseOver="toolTip('Eliminar Compra de Vidrio',this);" onClick="redireccionar('../paginas/Vidrio/Eliminar/frmEliminarCompra.php<?php echo "?eliminar_factura=".$facturas['codigo_factura'];?>');" class="manita">
				</td>
			</tr>
			<?php } ?>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		</table>
		<?php } ?>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center></p>
	</BODY>
</HTML>
<?php
if($cambio == 1){$_SESSION["cambio"] = 2;}
else if($cambio == 2){$_SESSION["cambio"] = 1;}
include "../librerias/cerrar_conexion.php";
?>