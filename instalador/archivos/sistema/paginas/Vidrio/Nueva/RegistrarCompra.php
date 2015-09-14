<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$fecha					= $_POST['fecha'];
$codigo_factura			= $_POST['factura'];
$codigo_recolector		= $_POST['codigo_recolector']; $consulta =  mysql_fetch_array(mysql_query("SELECT nombre_recolector FROM recolectores WHERE codigo_recolector = '$codigo_recolector'", $conexion));
$nombre_recolector		= $consulta[0];
$codigo_proveedor		= $_POST['codigo_proveedor']; $consulta =  mysql_fetch_array(mysql_query("SELECT nombre_proveedor FROM proveedores WHERE codigo_proveedor = '$codigo_proveedor'", $conexion));
$nombre_proveedor		= $consulta[0];
$sucursal				= $_POST['sucursal'];
$precio_compra			= $_POST['precio_compra'];
$codigo_centro_acopio	= $_POST['codigo_centro_acopio'];

$Bcompra[1][1] = $_POST['Vc1'];	$Bcompra[1][2] = $_POST['Vp1'];	//botella verde
$Bcompra[2][1] = $_POST['Vc2'];	$Bcompra[2][2] = $_POST['Vp2'];	//botella cristalino
$Bcompra[3][1] = $_POST['Vc3'];	$Bcompra[3][2] = $_POST['Vp3'];	//botella cafe
$Bcompra[4][1] = $_POST['Vc4'];	$Bcompra[4][2] = $_POST['Vp4'];	//botella bronce
$Bcompra[5][1] = $_POST['Vc5'];	$Bcompra[5][2] = $_POST['Vp5'];	//botella reflectivo

$Pcompra[1][1] = $_POST['Vc6'];	$Pcompra[1][2] = $_POST['Vp6'];	//plano verde
$Pcompra[2][1] = $_POST['Vc7'];	$Pcompra[2][2] = $_POST['Vp7'];	//plano cristalino
$Pcompra[3][1] = $_POST['Vc8'];	$Pcompra[3][2] = $_POST['Vp8'];	//plano cafe
$Pcompra[4][1] = $_POST['Vc9'];	$Pcompra[4][2] = $_POST['Vp9'];	//plano bronce
$Pcompra[5][1] = $_POST['Vc10'];	$Pcompra[5][2] = $_POST['Vp10'];	//plano reflectivo

$Totales[1][1] = $_POST['BTo1'];	$Totales[1][2] = $_POST['BTo2'];
$Totales[2][1] = $_POST['PTo1'];	$Totales[2][2] = $_POST['PTo2'];
?>
<HTML>
	<head>
		<title>SCYCPVES</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" type="text/css" href="../../../librerias/formato.css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
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
			$instruccion_insert = "
			INSERT INTO vical.facturas (CODIGO_FACTURA,CODIGO_PROVEEDOR,CODIGO_RECOLECTOR,SUCURSAL,CODIGO_CENTRO_ACOPIO,PRECIO_COMPRA,FECHA)
			VALUES ('$codigo_factura','$codigo_proveedor','$codigo_recolector','$sucursal','$codigo_centro_acopio','$precio_compra','$fecha')";
			mysql_query($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_factura!! </SPAN>".mysql_error());
			
			mysql_query("INSERT INTO vical.compras (CODIGO_FACTURA) VALUES ('$codigo_factura')", $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_ultima_compra!! </SPAN>".mysql_error());
			
			for($i=1; $i<=5; $i++){	//$i --> colores
				//registrar vidrios tipo botella
				if($Bcompra[$i][1] <> 0 && $Bcompra[$i][2] <> 0){
					$registrar_vidrio = "
					INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO)
					VALUES ('TV-01','CV-0$i','$codigo_factura','".$Bcompra[$i][1]."','".$Bcompra[$i][2]."')";
					mysql_query($registrar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio!! </SPAN>".mysql_error());
				}
				//registrar vidrios tipo plano
				if($Pcompra[$i][1] <> 0 && $Pcompra[$i][2] <> 0){
					$registrar_vidrio = "
					INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO)
					VALUES ('TV-02','CV-0$i','$codigo_factura','".$Pcompra[$i][1]."','".$Pcompra[$i][2]."')";
					mysql_query($registrar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_vidrio!! </SPAN>".mysql_error());
				}
			}
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
										for($i=1; $i<=5; $i++){
											for($j=1; $j<=2; $j++){
												if($Bcompra[$i][$j] <> 0){
										?>
										<td><input type="text" size=3 disabled="disabled" value="<?php printf("%.2f",$Bcompra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td><input type="text" size=3 disabled="disabled"></td>
										<?php
												}
											}
										}
										?>
										<td><input type="text" size=3 disabled="disabled" value="<?php printf("%.2f",$Totales[1][1]);?>"></td><!--total por tipo de vidrio-->
										<td><input type="text" size=3 disabled="disabled" value="<?php printf("%.2f",$Totales[1][2]);?>"></td><!--total por tipo de vidrio-->
									</tr>
									<tr>
										<th class="titulo2">PLANO</th>
										<?php
										for($i=1; $i<=5; $i++){
											for($j=1; $j<=2; $j++){
												if($Pcompra[$i][$j] <> 0){
										?>
										<td><input type="text" size=3 disabled="disabled" value="<?php printf("%.2f",$Pcompra[$i][$j]);?>"></td>
										<?php
												}
												else{
										?>
										<td><input type="text" size=3 disabled="disabled"></td>
										<?php
												}
											}
										}
										?>
										<td><input type="text" size=3 disabled="disabled" value="<?php printf("%.2f",$Totales[2][1]);?>"></td><!--total por tipo de vidrio-->
										<td><input type="text" size=3 disabled="disabled" value="<?php printf("%.2f",$Totales[2][2]);?>"></td><!--total por tipo de vidrio-->
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
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>