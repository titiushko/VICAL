<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$fecha 			   		= $_POST['fecha'];
$codigo_factura    		= $_POST['factura'];
$codigo_recolector		= $_POST['codigo_recolector']; $consulta =  mysql_fetch_array(mysql_query("SELECT nombre_recolector FROM recolectores WHERE codigo_recolector = '$codigo_recolector'", $conexion));
$nombre_recolector		= $consulta[0];
$codigo_proveedor		= $_POST['codigo_proveedor']; $consulta =  mysql_fetch_array(mysql_query("SELECT nombre_proveedor FROM proveedores WHERE codigo_proveedor = '$codigo_proveedor'", $conexion));
$nombre_proveedor		= $consulta[0];
$sucursal		   		= $_POST['sucursal'];
$precio_compra			= $_POST['precio_compra'];
$codigo_centro_acopio	= $_POST['codigo_centro_acopio'];

$Compras[1][1] = $_POST['Vc1'];		$Compras[1][2] = $_POST['Vp1'];	//botella verde
$Compras[2][1] = $_POST['Vc2'];		$Compras[2][2] = $_POST['Vp2'];	//botella cristalino
$Compras[3][1] = $_POST['Vc3'];		$Compras[3][2] = $_POST['Vp3'];	//botella cafe
$Compras[4][1] = $_POST['Vc4'];		$Compras[4][2] = $_POST['Vp4'];	//botella bronce
$Compras[5][1] = $_POST['Vc5'];		$Compras[5][2] = $_POST['Vp5'];	//botella reflectivo

$Compras[6][1] = $_POST['Vc6'];		$Compras[6][2] = $_POST['Vp6'];	//plano verde
$Compras[7][1] = $_POST['Vc7'];		$Compras[7][2] = $_POST['Vp7'];	//plano cristalino
$Compras[8][1] = $_POST['Vc8'];		$Compras[8][2] = $_POST['Vp8'];	//plano cafe
$Compras[9][1] = $_POST['Vc9'];		$Compras[9][2] = $_POST['Vp9'];	//plano bronce
$Compras[10][1] = $_POST['Vc10'];	$Compras[10][2] = $_POST['Vp10'];	//plano reflectivo

$Totales[1][1] = $_POST['BTo1'];	$Totales[1][2] = $_POST['BTo2'];
$Totales[2][1] = $_POST['PTo1'];	$Totales[2][2] = $_POST['PTo2'];

//actualizar una nueva factura
$instruccion_update = "
UPDATE vical.facturas
SET codigo_proveedor = '$codigo_proveedor', codigo_recolector = '$codigo_recolector', fecha = '$fecha', sucursal = '$sucursal', precio_compra = '$precio_compra', codigo_centro_acopio = '$codigo_centro_acopio'
WHERE codigo_factura = '$codigo_factura'";
$actualizar_factura = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_factura!! </SPAN>".mysql_error());

//instruccion para seleccionar los codigos de los registros a modificar de la tabla vidrio
$instruccion_select = "SELECT codigo_vidrio FROM vidrio WHERE codigo_factura = '$codigo_factura' ORDER BY codigo_vidrio ASC";
$consulta_vidrio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_vidrio!! </SPAN>".mysql_error());

$registros = 1;
while($vidrio = mysql_fetch_array($consulta_vidrio)){
	$codigos_vidrio[$registros] = $vidrio[0];
	$registros++;
}

$codigo_vidrio = $codigos_vidrio[1];	$indice = 1;
for($i=1; $i<=10; $i++){
	for($j=1; $j<$registros; $j++){
		if($codigo_vidrio == $codigos_vidrio[$j]){
			if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){$cantidad_vidrio = $Compras[$i][1];	$precio_vidrio = $Compras[$i][2];}
			else if($Compras[$i][1] == 0 && $Compras[$i][2] == 0){$cantidad_vidrio = 0;	$precio_vidrio = 0;}
			$actualizar_vidrio = "UPDATE vical.vidrio SET cantidad_vidrio = '$cantidad_vidrio', precio_vidrio = '$precio_vidrio' WHERE codigo_vidrio = '$codigo_vidrio'";
			mysql_query($actualizar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_vidrio!! </SPAN>".mysql_error());
			$j = $registros + 1;
		}
		else{
			if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){
				if($i >= 1 && $i <= 5){
					$codigo_tipo = 'TV-01';
					if($indice == 5) $indice = 1;	else $indice++;
				}
				if($i >= 6 && $i <= 10){
					$codigo_tipo = 'TV-02';
					if($indice == 5) $indice = 1;	else $indice++;
				}
				$insertar_vidrio = "
				INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO_VIDRIO)
				VALUES ('$codigo_tipo','CV-0$indice','$codigo_factura','".$Compras[$i][1]."','".$Compras[$i][2]."')";
				mysql_query($insertar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la insertar_vidrio!! </SPAN>".mysql_error());
				$j = $registros + 1;
			}
		}
	}
	//echo "<script>alert('$codigo_vidrio');</script>";
	$codigo_vidrio++;
}
?>
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
												if($Compras[$i][$j] <> 0){
										?>
										<td><input class="fondo3" type="text" size="4" readonly value="<?php printf("%.2f",$Compras[$i][$j]);?>"></td>
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
									<tr>
										<th>PLANO</th>
										<?php
										for($i=6; $i<=10; $i++){
											for($j=1; $j<=2; $j++){
												if($Compras[$i][$j] <> 0){
										?>
										<td><input class="fondo3" type="text" size="4" readonly value="<?php printf("%.2f",$Compras[$i][$j]);?>"></td>
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
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>