<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$fecha					= $_POST['fecha'];
$codigo_factura			= $_POST['factura'];
$nombre_recolector		= $_POST['nombre_recolector'];
$codigo_recolector		= $_POST['codigo_recolector'];
$nombre_proveedor		= $_POST['nombre_proveedor'];
$codigo_proveedor		= $_POST['codigo_proveedor'];
$precio_compra			= $_POST['precio_compra'];
$sucursal				= $_POST['sucursal'];
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" type="text/css" href="../../../librerias/formato.css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<style>.tamano{width:40;}</style>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE COMPRAS</h1>
			<?php
			$consulta_buscar = mysql_query("SELECT codigo_factura FROM facturas WHERE codigo_factura = '$codigo_factura'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
			$buscar =  mysql_fetch_array($consulta_buscar);
			if($buscar[0] == $codigo_factura){
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_error.png">
						<br>
						NO SE PUDO REGISTRAR LA COMPRA!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center">
								El codigo <?php echo $codigo_factura;?> de la factura que quiere registrar ya ha sido asignado en otra factura.
							</td>
						</tr>
					</table>
					<meta http-equiv ="refresh"		 content="5;url=frmNuevaCompra.php<?php echo "?valor_nombre_recolector=nueva_compra";?>">
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			}
			else if($buscar[0] <> $codigo_factura){
			//registrar una nueva factura
			mysql_query("INSERT INTO vical.facturas (CODIGO_FACTURA,CODIGO_PROVEEDOR,CODIGO_RECOLECTOR,SUCURSAL,CODIGO_CENTRO_ACOPIO,PRECIO_COMPRA,FECHA) VALUES ('$codigo_factura','$codigo_proveedor','$codigo_recolector','$sucursal','$codigo_centro_acopio','$precio_compra','$fecha')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_factura!! </SPAN>".mysql_error());
			//guardar el numero de compra
			mysql_query("INSERT INTO vical.compras (CODIGO_FACTURA) VALUES ('$codigo_factura')", $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_ultima_compra!! </SPAN>".mysql_error());
			//registrar en la tabla vidrio
			//botella
			if($Bcompra[1][1] != 0 && $Bcompra[1][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-01','CV-01','$codigo_factura','".$Bcompra[1][1]."','".$Bcompra[1][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_botella_claro!! </SPAN>".mysql_error());}
			if($Bcompra[2][1] != 0 && $Bcompra[2][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-01','CV-02','$codigo_factura','".$Bcompra[2][1]."','".$Bcompra[2][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_botella_verde!! </SPAN>".mysql_error());}
			if($Bcompra[3][1] != 0 && $Bcompra[3][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-01','CV-03','$codigo_factura','".$Bcompra[3][1]."','".$Bcompra[3][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_botella_cafe!! </SPAN>".mysql_error());}
			//plano
			if($Pcompra[1][1] != 0 && $Pcompra[1][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-02','CV-01','$codigo_factura','".$Pcompra[1][1]."','".$Pcompra[1][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_plano_claro!! </SPAN>".mysql_error());}
			if($Pcompra[2][1] != 0 && $Pcompra[2][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-02','CV-04','$codigo_factura','".$Pcompra[2][1]."','".$Pcompra[2][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_plano_bronce!! </SPAN>".mysql_error());}
			if($Pcompra[3][1] != 0 && $Pcompra[3][2] != 0){mysql_query("INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO) VALUES ('TV-02','CV-05','$codigo_factura','".$Pcompra[3][1]."','".$Pcompra[3][2]."')", $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio_plano_reflectivo!! </SPAN>".mysql_error());}
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REGISTRO LA COMPRA EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table class="marco">
					<tr>
					<td>
						<!--------------------------------FECHA/No---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Fecha:</span></td>
							<td align="left"><input type="text" size=7 disabled="disabled" value="<?php echo $fecha;?>"></td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td align="right"><span class="titulo1">No:</span></td>
							<td align="left"><input type="text" size=1 disabled="disabled" value="<?php echo $codigo_factura;?>"></td>
						</tr>
						<!--------------------------------RECOLECOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><span class="titulo1">Recolector:</span></td>
							<td align="left"><input type="text" size=37 disabled="disabled" value="<?php echo $nombre_recolector;?>"></td>
							<td align="right"><span class="titulo1">Codigo:</span></td>
							<td align="left"><input type="text" size=3 disabled="disabled" value="<?php echo $codigo_recolector;?>"></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PROVEEDOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><span class="titulo1">Proveedor:</span></td>
							<td align="left"><input type="text" size=37 disabled="disabled" value="<?php echo $nombre_proveedor;?>"></td>
							<td align="right"><span class="titulo1">Codigo:</span></td>
							<td align="left"><input type="text" size=3 disabled="disabled" value="<?php echo $codigo_proveedor;?>"></td>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PRECIO----------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right"><span class="titulo1">Precio:</span></td>
							<td align="left"><input type="text" size=17 disabled="disabled" value="<?php echo "$".number_format($precio_compra,2,'.',',');?>"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------VIDRIO------------------------------------>
						<tr>
							<td colspan="6">
							<table align="center" border bgcolor="white" width="60%">
								<thead class="titulo2">
									<tr>
										<th rowspan=2></th>
										<th colspan=2>CLARO</th>
										<th colspan=2>VERDE</th>
										<th colspan=2>CAFE</th>
										<th colspan=2>TOTAL</th>
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
										<th class="titulo2">BOTELLA</th>
										<?php
										for($i=1; $i<=3; $i++){
											for($j=1; $j<=2; $j++){
												if($Bcompra[$i][$j] <> 0){
										?>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled" value="<?php echo $Bcompra[$i][$j];?>"></td>
										<?php
												}
												else{
										?>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled"></td>
										<?php
												}
											}
										}
										?>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled" value="<?php echo $Totales[1][1];?>"></td>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled" value="<?php echo $Totales[1][2];?>"></td>
									</tr>
								</tbody>
							</table>
							</td>
						</tr>									
						<tr>
							<td colspan="6">
							<table align="center" border bgcolor="white" width="60%">
								<thead class="titulo2">
									<tr>
										<th rowspan=2></th>
										<th colspan=2>CLARO</th>
										<th colspan=2>BRONCE</th>
										<th colspan=2>REFLECTIVO</th>
										<th colspan=2>TOTAL</th>
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
										<th class="titulo2">PLANO</th>
										<?php
										for($i=1; $i<=3; $i++){
											for($j=1; $j<=2; $j++){
												if($Pcompra[$i][$j] <> 0){
										?>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled" value="<?php echo $Pcompra[$i][$j];?>"></td>
										<?php
												}
												else{
										?>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled"></td>
										<?php
												}
											}
										}
										?>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled" value="<?php echo $Totales[2][1];?>"></td>
										<td align="center"><input type="text" class="tamano" size=3 disabled="disabled" value="<?php echo $Totales[2][2];?>"></td>
									</tr>
								</tbody>
							</table>
							</td>
						</tr>
						<!-----------------------------SUCURSAL Y CA--------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="center" colspan="4">
								<span class="titulo1">Sucursal:</span>
								<input type="text" size=17 disabled="disabled" value="<?php echo $sucursal;?>">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="titulo1">Centro de Acopio:</span>
								<?php
								$consulta_centro_de_acopio = mysql_query("SELECT nombre_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
								$centro_de_acopio = mysql_fetch_array($consulta_centro_de_acopio);
								?>
								<input type="text" size=17 disabled="disabled" value="<?php echo $centro_de_acopio[0];?>">
							</td>
						</tr>
						<!---------------------------------MENSAJE----------------------------------->
						<tr>
							<td colspan="6">
								<table align="center" class="resultado centro">
								<tr>
									<td align="center">
										Desea registrar otra compra de vidrio siempre realizada por <?php echo $nombre_recolector;?>?<br><br>
										<img src="../../../imagenes/icono_aceptar.png" onMouseOver="toolTip('Si, Continuar',this)" class="manita" onClick="redireccionar('frmNuevaCompra.php<?php echo "?valor_nombre_recolector=$nombre_recolector"; ?>')">
										<img src="../../../imagenes/icono_cancelar.png" onMouseOver="toolTip('No, Registrar Nueva Compra con otro Recolector',this)" class="manita" onClick="redireccionar('frmNuevaCompra.php<?php echo "?valor_nombre_recolector=nueva_compra"; ?>')"><br>
										<img src="../../../imagenes/icono_reporte.png" onMouseOver="toolTip('Terminar y Generar Reporte',this)" class="manita" onClick="redireccionar('../../Recolectores/Reporte/VerReporteRecolector_CorteCaja.php<?php echo "?valor_nombre_recolector=$nombre_recolector&valor_centro_acopio=$centro_de_acopio[0]"; ?>')">
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<span id="toolTipBox" width="50"></span>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</td>
					</tr>
					</table>
				</td>
			</tr>
			<?php
			}
			?>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>