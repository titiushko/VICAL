<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$fecha 			   		= $_POST['fecha'];
$codigo_factura    		= $_POST['factura'];
$nombre_recolector		= $_POST['nombre_recolector'];
$codigo_recolector		= $_POST['codigo_recolector'];
$nombre_proveedor		= $_POST['nombre_proveedor'];
$codigo_proveedor		= $_POST['codigo_proveedor'];
$sucursal		   		= $_POST['sucursal'];
$precio_compra			= $_POST['precio_compra'];
$codigo_centro_acopio	= $_POST['codigo_centro_acopio'];

//					cantidad						precio
$Bcompra[1][1] = $_POST['Vc1'];	$Bcompra[1][2] = $_POST['Vp1'];	//botella claro
$Bcompra[2][1] = $_POST['Vc2'];	$Bcompra[2][2] = $_POST['Vp2'];	//botella verde
$Bcompra[3][1] = $_POST['Vc3'];	$Bcompra[3][2] = $_POST['Vp3'];	//botella cafe
$Pcompra[1][1] = $_POST['Vc4'];	$Pcompra[1][2] = $_POST['Vp4'];	//plano claro
$Pcompra[2][1] = $_POST['Vc5'];	$Pcompra[2][2] = $_POST['Vp5'];	//plano bronce
$Pcompra[3][1] = $_POST['Vc6'];	$Pcompra[3][2] = $_POST['Vp6'];	//plano reflectivo
$Totales[1][1] = $_POST['BTc'];	$Totales[1][2] = $_POST['BTp'];	//botella total
$Totales[2][1] = $_POST['PTc'];	$Totales[2][2] = $_POST['PTp'];	//plano total

//actualizar una nueva factura
$actualizar_factura = mysql_query("UPDATE vical.facturas SET codigo_proveedor = '$codigo_proveedor', codigo_recolector = '$codigo_recolector', fecha = '$fecha', sucursal = '$sucursal', precio_compra = '$precio_compra', codigo_centro_acopio = '$codigo_centro_acopio' WHERE codigo_factura = '$codigo_factura'", $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_factura!! </SPAN>".mysql_error());

//instruccion para eliminar los codigos de los registros a modificar de la tabla vidrio
$eliminar_vidrio = mysql_query("DELETE FROM vidrio WHERE codigo_factura = '$codigo_factura'", $conexion) or die ("<SPAN CLASS='error'>Fallo en la eliminar_vidrio!! </SPAN>".mysql_error());

//registrar en la tabla vidrio los cambios realizados
if($Bcompra[1][1] != 0 && $Bcompra[1][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-01','CV-01','$codigo_factura','".$Bcompra[1][1]."','".$Bcompra[1][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_botella_claro!! </SPAN>".mysql_error());}
if($Bcompra[2][1] != 0 && $Bcompra[2][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-01','CV-02','$codigo_factura','".$Bcompra[2][1]."','".$Bcompra[2][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_botella_verde!! </SPAN>".mysql_error());}
if($Bcompra[3][1] != 0 && $Bcompra[3][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-01','CV-03','$codigo_factura','".$Bcompra[3][1]."','".$Bcompra[3][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_botella_cafe!! </SPAN>".mysql_error());}
if($Pcompra[1][1] != 0 && $Pcompra[1][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-02','CV-01','$codigo_factura','".$Pcompra[1][1]."','".$Pcompra[1][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_plano_claro!! </SPAN>".mysql_error());}
if($Pcompra[2][1] != 0 && $Pcompra[2][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-02','CV-04','$codigo_factura','".$Pcompra[2][1]."','".$Pcompra[2][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_plano_bronce!! </SPAN>".mysql_error());}
if($Pcompra[3][1] != 0 && $Pcompra[3][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-02','CV-05','$codigo_factura','".$Pcompra[3][1]."','".$Pcompra[3][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_plano_reflectivo!! </SPAN>".mysql_error());}
?>
<HTML>
	<head>
		<title>COMVICONPRO</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarCompra.php">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
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
					<h1 class="encabezado1">MODIFICAR COMPRA</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO LA COMPRA EXITOSAMENTE!! 
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
							<td align="left"><?php echo $fecha;?></td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td align="right"><b>No:</b></td>
							<td align="left"><?php echo $codigo_factura;?></td>
						</tr>
						<!--------------------------------RECOLECOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><b>Recolector:</b></td>
							<td align="left"><?php echo $nombre_recolector;?></td>
							<td align="right"><b>Codigo:</b></td>
							<td align="left"><?php echo $codigo_recolector;?></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PROVEEDOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><b>Proveedor:</b></td>
							<td align="left"><?php echo $nombre_proveedor;?></td>
							<td align="right"><b>Codigo:</b></td>
							<td align="left"><?php echo $codigo_proveedor;?></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PRECIO----------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><span><b>Precio:</span></td>
							<td align="left"><?php echo "$".number_format($precio_compra,2,'.',',');?></td>
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
										<th colspan=2>CLARO</th>
										<th colspan=2>VERDE</th>
										<th colspan=2>CAFE</th>
								<th colspan=2>TOTAL</th><!--total por tipo de vidrio-->
									</tr>
									<tr>
										<!--CLARO-->
										<th>QQ</th>
										<th>$$</th>
										<!--VERDE-->
										<th>QQ</th>
										<th>$$</th>
										<!--CAFE-->
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
										for($i=1; $i<=3; $i++){
											for($j=1; $j<=2; $j++){
												if($Bcompra[$i][$j] <> 0){
										?>
										<td><input class="fondo3" type="text" size="4" readonly value="<?php printf("%.2f",$Bcompra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<?php
												}
											}
										}
										if($Totales[1][1] <> 0 && $Totales[1][2] <> 0){
										?>
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1][1]);?>"></td><!--total por tipo de vidrio-->
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[1][2]);?>"></td><!--total por tipo de vidrio-->
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
						<tr>
							<td colspan="6">
							<table align="center" border class="rejilla" width="60%">
								<thead>
									<tr>
										<th rowspan=2 colspan=1></th>
										<th colspan=2>CLARO</th>
										<th colspan=2>BRONCE</th>
										<th colspan=2>REFLECTIVO</th>
								<th colspan=2>TOTAL</th><!--total por tipo de vidrio-->
									</tr>
									<tr>
										<!--CLARO-->
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
										<th>PLANO</th>
										<?php
										for($i=1; $i<=3; $i++){
											for($j=1; $j<=2; $j++){
												if($Pcompra[$i][$j] <> 0){
										?>
										<td><input class="fondo3" type="text" size="4" readonly value="<?php printf("%.2f",$Pcompra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td><input class="fondo3" type="text" size="4" readonly></td>
										<?php
												}
											}
										}
										if($Totales[2][1] <> 0 && $Totales[2][2] <> 0){
										?>
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2][1]);?>"></td><!--total por tipo de vidrio-->
										<td><input class="fondo3" type="text" size=3 readonly value="<?php printf("%.2f",$Totales[2][2]);?>"></td><!--total por tipo de vidrio-->
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
								<?php echo $sucursal;?>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Centro de Acopio:</b>
								<?php
								$consulta_centro_de_acopio = mysql_query("SELECT nombre_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
								$centro_de_acopio = mysql_fetch_array($consulta_centro_de_acopio);
								?>
								<?php echo $centro_de_acopio[0];?>
							</td>
						</tr>
					</td>
					</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>