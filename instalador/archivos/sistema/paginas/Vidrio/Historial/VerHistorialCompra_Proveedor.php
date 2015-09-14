<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoContador.php";
include "../../../librerias/funciones.php";
switch($_GET['pagina']){
	case 'historial':	$proveedor = $_POST['seleccionar_proveedor'];	$sucursal  = $_POST['sucursal']; break;
	case 'proveedor':	$proveedor = $_GET['seleccionar_proveedor'];	$sucursal  = $_GET['sucursal'];  break;
}
if($proveedor == '' || $sucursal == '') header("Location: frmHistorialCompra.php");

switch($sucursal){
	case 'VICESA':
	case 'VIGUA':	$Sucursal = "para ".$sucursal.""; break;
	case 'AMBAS':	$Sucursal = ""; break;
}

$select_proveedores = "
SELECT
proveedores.codigo_proveedor,
proveedores.nombre_proveedor,
proveedores.direccion_proveedor,
proveedores.telefono_proveedor1,
proveedores.telefono_proveedor2,
proveedores.contacto,
proveedores.estanon,
tipos_empresas.nombre_tipo_empresa
FROM proveedores
JOIN tipos_empresas
WHERE proveedores.codigo_proveedor = '$proveedor'
AND tipos_empresas.codigo_tipo_empresa = proveedores.codigo_tipo_empresa";
$consulta_proveedores = mysql_query($select_proveedores, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedores!!</SPAN>".mysql_error());
$proveedores = mysql_fetch_assoc($consulta_proveedores);
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
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" src="../../../librerias/funciones.js"></script>
		<style>.centro{width: 70%;}</style>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">HISTORIAL DE COMPRAS</h1>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			$consulta = mysql_query("SELECT COUNT(codigo_proveedor) AS cantidad FROM facturas WHERE codigo_proveedor = '$proveedor'", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta cantidad proveedores!!</SPAN>".mysql_error());
			$cantidad = mysql_fetch_assoc($consulta);
			if($cantidad['cantidad'] == 0){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR EL HISTORIAL DE COMPRAS!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">No hay valores que mostrar.<br>No se a comprado vidrio <?php echo $Sucursal." a ".$proveedores["nombre_proveedor"];?>.</td>
							<meta http-equiv ="refresh"		 content="5;url=frmHistorialCompra.php">
						</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			}
			else {
			?>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table class="marco centro">
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["codigo_proveedor"]."<br>"; ?></td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Nombre:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["nombre_proveedor"]."<br>"; ?></td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Tipo Empresa:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["nombre_tipo_empresa"]; ?></td>
						</tr>
						<?php
						if ($proveedores["direccion_proveedor"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Direccion:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["direccion_proveedor"]; ?></td>
						</tr>
						<?php
						}
						if ($proveedores["telefono_proveedor1"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Telefono:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["telefono_proveedor1"]; ?></td>
						</tr>
						<?php
						}
						if ($proveedores["telefono_proveedor2"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Telefono 2:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["telefono_proveedor2"]; ?></td>
						</tr>
						<?php
						}
						if ($proveedores["contacto"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Contacto:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["contacto"]; ?></td>
						</tr>
						<?php
						}
						if ($proveedores["estanon"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Cantiad de Barriles:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["estanon"]; ?></td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td colspan="2" align="center">
							<h2 class="encabezado2">Historial de vidrio comprado <?php echo $Sucursal;?> a<br><?php echo $proveedores["nombre_proveedor"];?>.</h2>
							<?php
							$bandera = true;
							$historial = calcularSumaMes('proveedor',$proveedor,$sucursal);
							for($i=1; $i<=$filas; $i++){
							?>
								<table align="center" class="rejilla" border bgcolor="white" width="50%">
							<?php
								if($bandera){
							?>
									<thead class="titulo2">
										<tr><th colspan="3"><span class="encabezado2"><?php echo $historial[$i][1];?></span></th></tr>
										<tr><th width="89">MES</th><th width="85">CANTIDAD</th><th width="85">MONTO</th></tr>
									</thead>
									<tbody align="center">
										<tr align="center">
											<th width="89" class="subtitulo1"><?php echo $historial[$i][2];?></th>
											<td width="85" class="subtitulo1"><?php echo number_format($historial[$i][3],2,'.',','); ?></td>
											<td width="85" class="subtitulo1"><?php echo "$".number_format($historial[$i][4],2,'.',','); ?></td>
										</tr>
							<?php
									$temp = $historial[$i][1];
									$bandera = false;
								}
								else if($temp == $historial[$i][1]){
							?>
										<tr align="center">
											<th width="89" class="subtitulo1"><?php echo$historial[$i][2];?></th>
											<td width="85" class="subtitulo1"><?php echo number_format($historial[$i][3],2,'.',','); ?></td>
											<td width="85" class="subtitulo1"><?php echo "$".number_format($historial[$i][4],2,'.',','); ?></td>
										</tr>
							<?php
									}
									else{
							?>
									</tbody>
								</table>
								<br>
							<?php
										$bandera = true;
									}
							}
							?>
							</td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<center><?php echo hoyEs();?></center>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita">
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->						
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