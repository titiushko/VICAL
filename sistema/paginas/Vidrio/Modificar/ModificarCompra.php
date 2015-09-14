<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
$fecha 			   = $_POST['fecha'];
$codigo_factura    = $_POST['factura'];
$nombre_recolector = $_POST['nombre_recolector'];
$codigo_recolector = $_POST['codigo_recolector'];
$nombre_proveedor  = $_POST['nombre_proveedor'];
$codigo_proveedor  = $_POST['codigo_proveedor'];

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
$instruccion_insert = "
UPDATE vical.facturas
SET codigo_proveedor = '$codigo_proveedor', codigo_recolector = '$codigo_recolector', fecha = '$fecha'
WHERE codigo_factura = '$codigo_factura'";
$actualizar_factura = mysql_query($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_factura!! </SPAN>".mysql_error());

//contar los codigos de los registros a modificar de la tabla vidrio
$instruccion_select = "SELECT codigo_vidrio FROM vidrio WHERE codigo_factura = '$codigo_factura' ORDER BY codigo_vidrio ASC";
$consulta_vidrio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_vidrio!! </SPAN>".mysql_error());
$vidrio = mysql_fetch_array($consulta_vidrio);
$codigo_vidrio = $vidrio[0];

for($i=1; $i<=10; $i++){	//$i --> colores
	if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){
		$actualizar_vidrio = "
		UPDATE vical.vidrio
		SET cantidad_vidrio = '".$Compras[$i][1]."', precio = '".$Compras[$i][2]."'
		WHERE codigo_vidrio = '$codigo_vidrio'";
		mysql_query($actualizar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_vidrio!! </SPAN>".mysql_error());
		$codigo_vidrio++;
	}
}
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
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
								<table align="center">
									<!--------------------------------FECHA/No---------------------------------->
									<tr>
										<td align="right"><b>Fecha:</b></td>
										<td align="left" class="subtitulo1"><?php echo $fecha;?></td>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
										<td align="right"><b>No:</b></td>
										<td align="left" class="subtitulo1"><?php echo $codigo_factura;?></td>
									</tr>
									<caption><h1></h1></caption>
									<!--------------------------------RECOLECOR---------------------------------->
									<tr>
										<td></td>
										<td align="right"><b>Recolector:</b></td>
										<td align="left" class="subtitulo1"><?php echo $nombre_recolector;?></td>
										<td align="right"><b>Codigo:</b></td>
										<td align="left" class="subtitulo1"><?php echo $codigo_recolector;?></td>
										<td></td>
									</tr>
									<!--------------------------------PROVEEDOR---------------------------------->
									<tr>
										<td></td>
										<td align="right"><b>Proveedor:</b></td>
										<td align="left" class="subtitulo1"><?php echo $nombre_proveedor;?></td>
										<td align="right"><b>Codigo:</b></td>
										<td align="left" class="subtitulo1"><?php echo $codigo_proveedor;?></td>
										<td></td>
									</tr>
									<!--------------------------------------------------------------------------->
								</table>
								<!---->
								<table align="center" border class="rejilla" width="60%">
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
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>