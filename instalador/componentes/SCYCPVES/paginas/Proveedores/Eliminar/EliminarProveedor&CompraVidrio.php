<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_proveedor = $_REQUEST['codigo'];

//hacer una consulta en la tabla proveedores con el codigo del proveedor a eliminar y guardar este registro en el vector $proveedores
//para luego mostrar en pantalla como resultado el registro que se acaba de eliminar
$instruccion_select = "
SELECT
proveedores.codigo_proveedor,
proveedores.nombre_proveedor,
proveedores.direccion_proveedor,
proveedores.departamento,
proveedores.telefono_proveedor1,
proveedores.telefono_proveedor2,
proveedores.contacto,
proveedores.estanon,
tipos_empresas.nombre_tipo_empresa
FROM proveedores
JOIN tipos_empresas
WHERE proveedores.codigo_proveedor = '$codigo_proveedor'
AND tipos_empresas.codigo_tipo_empresa = proveedores.codigo_tipo_empresa";
$consulta_proveedor = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo consulta_proveedor!! </SPAN>".mysql_error());
$proveedores = mysql_fetch_array($consulta_proveedor);
//--

//hacer una consulta en la tabla facturas con el codigo del proveedor a eliminar y guardar este registro en el vector $facturas
//para conocer el codigo de la factura que se va eliminar de la tabla facturas
$instruccion_select = "
SELECT
facturas.codigo_factura,
facturas.codigo_proveedor,
proveedores.codigo_proveedor
FROM facturas, proveedores
WHERE proveedores.codigo_proveedor = '$codigo_proveedor'
AND facturas.codigo_proveedor = proveedores.codigo_proveedor";
$consulta_factura = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!! </SPAN>".mysql_error());
//--

//recorer la tabla facturas con el codigo de la factura que se va eliminar
//para encontrar el codigo del vidrio de los registros que se van a eliminar de la tabla vidrios
while($facturas = mysql_fetch_array($consulta_factura)){
	$codigo_factura = $facturas['codigo_factura'];
	
	//buscar con el codigo de factura en la tabla vidrios el codigo del vidrio del registro que se va eliminar de la tabla vidrios
	$instruccion_vidrio = "
	SELECT vidrio.codigo_vidrio, facturas.codigo_factura
	FROM vidrio, facturas
	WHERE vidrio.codigo_factura = '$codigo_factura'
	AND facturas.codigo_factura = vidrio.codigo_factura";
	$consultar_vidrio = mysql_query($instruccion_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo consultar_vidrio!! </SPAN>".mysql_error());
	
	while($vidrios = mysql_fetch_array($consultar_vidrio)){		
		$codigo_vidrio = $vidrios['codigo_vidrio'];
		
		//eliminar el registro de la tabla vidrios con el codigo del vidrio que se acaba de encontrar
		$instruccion_delete = "DELETE FROM vidrio WHERE codigo_vidrio = '$codigo_vidrio'";
		mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_vidrio!! </SPAN>".mysql_error());
	}
	
	//buscar con el codigo de factura en la tabla compras el codigo de la compra del registro que se va eliminar de la tabla compras
	$instruccion_compra = "
	SELECT compras.codigo_compra, facturas.codigo_factura
	FROM compras, facturas
	WHERE compras.codigo_factura = '$codigo_factura'
	AND facturas.codigo_factura = compras.codigo_factura";
	$consultar_compra = mysql_query($instruccion_compra, $conexion) or die ("<SPAN CLASS='error'>Fallo consultar_compra!! </SPAN>".mysql_error());
	
	while($compras = mysql_fetch_array($consultar_compra)){		
		$codigo_compra = $compras['codigo_compra'];
		
		//eliminar el registro de la tabla compras con el codigo del compra que se acaba de encontrar
		$instruccion_delete = "DELETE FROM compras WHERE codigo_compra = '$codigo_compra'";
		mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_compra!! </SPAN>".mysql_error());
	}

}
//--

//eliminar el registro de la tabla facturas con el codigo del proveedor que se va eliminar
$instruccion_delete = "DELETE FROM facturas WHERE codigo_proveedor = '$codigo_proveedor'";
mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_factura!! </SPAN>".mysql_error());

//eliminar el registro de la tabla proveedores con el codigo del proveedor que se va eliminar
$instruccion_delete = "DELETE FROM proveedores WHERE codigo_proveedor = '$codigo_proveedor'";
mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_proveedor!! </SPAN>".mysql_error());
?>
<!----------------------------------------------------------------------------------------------------------------->
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarProveedor.php">
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
					<h1 class="encabezado1">ELIMINAR PROVEEDOR</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL PROVEEDOR EXITOSAMENTE!!
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
							<td class="subtitulo1"><?php echo $proveedores["codigo_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Nombre Empresa:</td>
							<td class="subtitulo1"><?php echo $proveedores["nombre_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Tipo Empresa:</td>
							<td class="subtitulo1"><?php echo $proveedores["nombre_tipo_empresa"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($proveedores["direccion_proveedor"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Direccion:</td>
							<td><?php echo $proveedores["direccion_proveedor"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Departamento:</td>
							<td><?php echo $proveedores["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($proveedores["telefono_proveedor1"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $proveedores["telefono_proveedor1"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["telefono_proveedor2"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono2:</td>
							<td class="subtitulo1"><?php echo $proveedores["telefono_proveedor2"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["contacto"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Contacto:</td>
							<td class="subtitulo1"><?php echo $proveedores["contacto"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["estanon"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Esta&ntilde;on:</td>
							<td class="subtitulo1"><?php echo $proveedores["estanon"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>