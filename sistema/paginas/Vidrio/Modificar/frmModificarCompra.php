<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
include "../../../librerias/funciones.php";
$factura = $_REQUEST['modificar_factura'];
$select_factura = "
SELECT facturas.codigo_factura, facturas.sucursal, facturas.fecha, recolectores.nombre_recolector, facturas.codigo_recolector, proveedores.nombre_proveedor, facturas.codigo_proveedor
FROM facturas, recolectores, proveedores
WHERE facturas.codigo_factura = '$factura'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor";
$consulta_factura = mysql_query($select_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
$facturas = mysql_fetch_assoc($consulta_factura);

$instruccion_select = "SELECT precio_unitario FROM precio";
$consulta_precio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_precio!!</SPAN>".mysql_error());
$precio = mysql_fetch_assoc($consulta_precio);
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
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
		<script type="text/javascript">
			var precio = <?php echo $precio['precio_unitario'];?>;	//precio unitario
			//vector con los recolectores
			var recolectores = new Array;										
			<?php
			$consulta = mysql_query("SELECT codigo_recolector, nombre_recolector FROM recolectores ORDER BY codigo_recolector ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en recolectores!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "recolectores[$contador] = new Array ('".$opciones[0]."','".$opciones[1]."');";
				$contador++;
			}
			?>
			//vectores con los proveedores
			var proveedores = new Array;										
			<?php
			$consulta = mysql_query("SELECT codigo_proveedor, nombre_proveedor FROM proveedores ORDER BY codigo_proveedor ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en proveedores!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "proveedores[$contador] = new Array ('".$opciones[0]."','".$opciones[1]."');";
				$contador++;
			}
			?>
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">MODIFICAR COMPRA</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="formulario" action="ModificarCompra.php" method="post" onSubmit="return validarModificarCompra(this,2);">
					<table class="marco">
						<tr>
							<td>
								<table align="center">
									<!--------------------------------FECHA/No---------------------------------->
									<tr>
										<td align="right" class="titulo1">Fecha:</td>
										<td align="left">
											<input name="fecha" class="subtitulo1 fondo1" type="text" readonly size=7 value="<?php echo $facturas['fecha'];?>">
											<img src="../../../imagenes/icono_calendario.png" onMouseOver="toolTip('Calendario',this)" onClick="displayCalendar(document.formulario.fecha,'yyyy-mm-dd',this),borrarMensaje(2);" class="manita">
										</td>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
										<td align="right" class="titulo1">No:</td>
										<td align="left">
											<input name="factura" class="subtitulo1 fondo1" type="text" readonly size="2" value="<?php echo $facturas['codigo_factura'];?>">
										</td>
									</tr>
									<!--------------------------------RECOLECOR---------------------------------->
									<tr>
										<td></td>
										<td align="right" class="titulo1">Recolector:</td>
										<td align="left">
											<select name="nombre_recolector" class="subtitulo1 fondo lista nombre" size="1">
											<?php
											$instruccion_recolector = "SELECT codigo_recolector, nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
											$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
											while($nombres_recolectores = mysql_fetch_array($consulta_recolector)){
												if($nombres_recolectores[1] == $facturas["nombre_recolector"])
													echo "<option selected onClick=\"ponerCodRecolector(this.form);\">".$nombres_recolectores[1]."</option>";
												else
													echo "<option onClick=\"ponerCodRecolector(this.form);\">".$nombres_recolectores[1]."</option>";												
											}
											?>
											</select>
										</td>
										<td align="right" class="titulo1">Codigo:</td>
										<td align="left">
											<select name="codigo_recolector" class="subtitulo1 fondo lista codigo" size="1">
											<?php
											$instruccion_recolector = "SELECT codigo_recolector, nombre_recolector FROM recolectores ORDER BY codigo_recolector ASC";
											$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
											while($codigos_recolectores = mysql_fetch_array($consulta_recolector)){
												if($codigos_recolectores[0] == $facturas["codigo_recolector"])
													echo "<option selected onClick=\"ponerNomRecolector(this.form);\">".$codigos_recolectores[0]."</option>";
												else
													echo "<option onClick=\"ponerNomRecolector(this.form);\">".$codigos_recolectores[0]."</option>";
											}
											?>
											</select>
										</td>
										<td></td>
									</tr>
									<!--------------------------------PROVEEDOR---------------------------------->
									<tr>
										<td></td>
										<td align="right" class="titulo1">Proveedor:</td>
										<td align="left">
											<select name="nombre_proveedor" class="subtitulo1 fondo lista nombre" size="1">
											<?php
											$instruccion_proveedor = "SELECT codigo_proveedor, nombre_proveedor FROM proveedores ORDER BY nombre_proveedor ASC";
											$consulta_proveedor = mysql_query($instruccion_proveedor,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_proveedor!!</SPAN>".mysql_error());
											while($nombres_proveedores = mysql_fetch_array($consulta_proveedor)){
												if($nombres_proveedores[1] == $facturas["nombre_proveedor"])
													echo "<option selected onClick=\"ponerCodProveedor(this.form);\">".$nombres_proveedores[1]."</option>";
												else
													echo "<option onClick=\"ponerCodProveedor(this.form);\">".$nombres_proveedores[1]."</option>";
											}
											?>
											</select>
										</td>
										<td align="right" class="titulo1">Codigo:</td>
										<td align="left">
											<select name="codigo_proveedor" class="subtitulo1 fondo lista codigo" size="1">
											<?php
											$instruccion_proveedor = "SELECT codigo_proveedor, nombre_proveedor FROM proveedores ORDER BY codigo_proveedor ASC";
											$consulta_proveedor = mysql_query($instruccion_proveedor,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_proveedor!!</SPAN>".mysql_error());
											while($codigos_proveedores = mysql_fetch_array($consulta_proveedor)){
												if($codigos_proveedores[0] == $facturas["codigo_proveedor"])
													echo "<option selected onClick=\"ponerNomProveedor(this.form);\">".$codigos_proveedores[0]."</option>";
												else
													echo "<option onClick=\"ponerNomProveedor(this.form);\">".$codigos_proveedores[0]."</option>";
											}
											?>
											</select>
										</td>
										<td></td>
									</tr>
									<!--------------------------------SUCURSAL----------------------------------->
									<tr>
										<td></td>
										<td align="right" class="titulo1">Sucursal:</td>
										<td align="left">
											<select name="sucursal" id="id7" class="subtitulo1 fondo lista opcion" size="1" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
											<?php
											$sucursales = array('VICESA','VIGUA');
											for($i=0;$i<2;$i++){
												if($sucursales[$i] == $facturas["sucursal"])
													echo "<option selected>".$sucursales[$i]."</option>";
												else
													echo "<option>".$sucursales[$i]."</option>";
											}
											?>
											</select>
										</td>
										<td></td>
										<td></td>
									</tr>
									<!--------------------------------------------------------------------------->
								</table>
								<!---->
								<table align="center" border class="rejilla" width="60%">
									<caption><h1></h1></caption>
									<thead class="titulo2">
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
											<th class="titulo2">BOTELLA</th>
											<?php
											$Compra = calcularSumaVidrio($factura);
											$Totales = calcularSumaTotales($Compra);
											for($i=1; $i<=5; $i++){
												if($Compra[$i][1] <> 0 && $Compra[$i][2] <> 0){
											?>
											<td><input name="Vc<?php echo $i;?>" class="fondo" type="text" size="4" value="<?php printf("%.2f",$Compra[$i][1]);?>" onBlur="calcularMonto(),borrarMensaje(2);" onKeyPress="return soloNumerosFloat(event)" onClick="borrarMensaje(2);"></td>
											<td><input name="Vp<?php echo $i;?>" class="fondo1" type="text" readonly size="4" value="<?php printf("%.2f",$Compra[$i][2]);?>"></td>
											<?php
												}
												else{
											?>
											<td><input name="Vc<?php echo $i;?>" class="fondo" type="text" size="4" onBlur="calcularMonto(),borrarMensaje(2);" onKeyPress="return soloNumerosFloat(event)" onClick="borrarMensaje(2);"></td>
											<td><input name="Vp<?php echo $i;?>" class="fondo1" type="text" readonly size="4"></td>
											<?php
												}
											}
											if($Totales[1] <> 0 && $Totales[2] <> 0){
											?>
											<td><input name="BTo1" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1]);?>"></td><!--total por tipo de vidrio-->
											<td><input name="BTo2" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2]);?>"></td><!--total por tipo de vidrio-->
											<?php
											}
											else{
											?>
											<td><input name="BTo1" class="fondo1" type="text" size="4" readonly></td>
											<td"><input name="BTo2" class="fondo1" type="text" size="4" readonly></td>
											<?php
											}
											?>
										</tr>
										<tr>
											<th class="titulo2">PLANO</th>
											<?php
											for($i=6; $i<=10; $i++){
												if($Compra[$i][1] <> 0 && $Compra[$i][2] <> 0){
											?>
											<td><input name="Vc<?php echo $i?>" class="fondo" type="text" size="4" value="<?php printf("%.2f",$Compra[$i][1]);?>" onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
											<td><input name="Vp<?php echo $i?>" class="fondo1" type="text" readonly size="4" value="<?php printf("%.2f",$Compra[$i][2]);?>"></td>
											<?php
												}
												else{
											?>
											<td><input name="Vc<?php echo $i?>" class="fondo" type="text" size="4" onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
											<td><input name="Vp<?php echo $i?>" class="fondo1" type="text" readonly size="4"></td>
											<?php
												}
											}
											if($Totales[3] <> 0 && $Totales[4] <> 0){
											?>
											<td><input name="PTo1" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[3]);?>"></td><!--total por tipo de vidrio-->
											<td><input name="PTo2" class="fondo1" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[4]);?>"></td><!--total por tipo de vidrio-->
											<?php
											}
											else{
											?>
											<td><input name="PTo1" class="fondo1" type="text" size="4" readonly></td>
											<td><input name="PTo2" class="fondo1" type="text" size="4" readonly></td>
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
					<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('javascript:window.history.back()');">
					</form>
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;No se pueden seleccionar fechas futuras!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Al menos se debe de modificar un tipo y color de vidrio!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>