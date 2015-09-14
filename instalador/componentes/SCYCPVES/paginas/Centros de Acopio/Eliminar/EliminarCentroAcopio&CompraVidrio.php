<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$codigo_centro_acopio = $_REQUEST['codigo'];
$cheque				  = $_REQUEST['cheque_eliminar_compras'];
$nuevo_centro_acopio  = $_REQUEST['nuevo_centro_acopio'];

//hacer una consulta en la tabla centros_de_acopio con el codigo del centro_acopio a eliminar y guardar este registro en el vector $centros_de_acopio
//para luego mostrar en pantalla como resultado el registro que se acaba de eliminar
$instruccion_select = "
SELECT
centros_de_acopio.codigo_centro_acopio,
recolectores.nombre_recolector,
centros_de_acopio.nombre_centro_acopio,
centros_de_acopio.direccion,
centros_de_acopio.departamento,
centros_de_acopio.telefono
FROM centros_de_acopio
JOIN recolectores
WHERE centros_de_acopio.codigo_centro_acopio = '$codigo_centro_acopio'
AND recolectores.codigo_recolector = centros_de_acopio.codigo_recolector";
$consulta_centro_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo consulta_centro_acopio!! </SPAN>".mysql_error());
$centros_de_acopio = mysql_fetch_array($consulta_centro_acopio);

//hacer una consulta en la tabla facturas con el codigo del centro_acopio a eliminar y guardar este registro en el vector $facturas
//para conocer el codigo de la factura que se va eliminar de la tabla facturas
$instruccion_select = "
SELECT
facturas.codigo_factura,
facturas.codigo_centro_acopio,
centros_de_acopio.codigo_centro_acopio
FROM facturas, centros_de_acopio
WHERE centros_de_acopio.codigo_centro_acopio = '$codigo_centro_acopio'
AND facturas.codigo_centro_acopio = centros_de_acopio.codigo_centro_acopio";
$consulta_factura = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!! </SPAN>".mysql_error());

if($cheque == 'eliminar'){
	//recorer la tabla facturas con el codigo de la factura que se va eliminar
	//para encontrar el codigo del vidrio de los registros que se van a eliminar de la tabla vidrios
	while($facturas = mysql_fetch_array($consulta_factura)){
			eliminarVidrios_y_Compras($facturas['codigo_factura']);
		}

	//eliminar el registro de la tabla facturas con el codigo del centro_acopio que se va eliminar
	$instruccion_delete = "DELETE FROM facturas WHERE codigo_centro_acopio = '$codigo_centro_acopio'";
	mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_factura!! </SPAN>".mysql_error());
}
if($cheque == 'actualizar'){
	//actualiza el registro de la tabla facturas con el codigo del nuevo centro de acopio
	while($facturas = mysql_fetch_assoc($consulta_factura)){
		$instruccion_update = "UPDATE facturas SET codigo_centro_acopio = '$nuevo_centro_acopio' WHERE codigo_centro_acopio = '$codigo_centro_acopio'";
		mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo actualizar_centro_de_acopio!! </SPAN>".mysql_error());	
	}
}

//eliminar el registro de la tabla centros_de_acopio con el codigo del centro_acopio que se va eliminar
$instruccion_delete = "DELETE FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'";
mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_centro_acopio!! </SPAN>".mysql_error());
?>
<!----------------------------------------------------------------------------------------------------------------->
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarCentroAcopio.php">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR CENTRO DE ACOPIO</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL CENTRO DE ACOPIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Codigo:</td>
							<td class="subtitulo1"><?php echo $codigo_centro_acopio;?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Nombre:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Encargado:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_recolector"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["direccion"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Direccion:</b>
							<td><?php echo $centros_de_acopio["direccion"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Departamento:</td>
							<td><?php echo $centros_de_acopio["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["telefono"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["telefono"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
				</td>
			</tr>
			<?php
			if($nuevo_centro_acopio <> ""){
			?>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr><td><br></td></tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<!------------------------------------------------------------------------>
						<tr>
							<td align="center" class="subtitulo1">
								<?php
								$consulta = mysql_query("SELECT nombre_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$nuevo_centro_acopio'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_acopio!!</SPAN>".mysql_error());
								$nombre_nuevo_centro_acopio = mysql_fetch_array($consulta);
								echo "Las compras registradas en ".$centros_de_acopio["nombre_centro_acopio"]." se trasladaron al centro de acopio de ".$nombre_nuevo_centro_acopio[0];
								?>
							</td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
				</td>
			</tr>
			<?php
			}
			?>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>