<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
$codigo_proveedor = $_REQUEST['eliminar_proveedor'];

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
?>
<!----------------------------------------------------------------------------------------------------------------->
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
						<img src="../../../imagenes/icono_alerta.png">
						<br>
						REALMENTE DESEA ELIMINAR EL PROVEEDOR!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<form name="borrar_proveedor" <?php echo "action=\"EliminarProveedor.php?codigo=$codigo_proveedor\"";?> method="post" enctype="multipart/form-data">
					<table align="center" class="alerta error centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Codigo:</b></td>
							<td><?php echo$proveedores["codigo_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Nombre Empresa:</b></td>
							<td><?php echo$proveedores["nombre_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Tipo Empresa:</b></td>
							<td><?php echo$proveedores["nombre_tipo_empresa"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($proveedores["direccion_proveedor"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Direccion:</b></td>
							<td><?php echo$proveedores["direccion_proveedor"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Departamento:</b></td>
							<td><?php echo $proveedores["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($proveedores["telefono_proveedor1"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Telefono:</b></td>
							<td><?php echo$proveedores["telefono_proveedor1"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["telefono_proveedor2"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Telefono2:</b></td>
							<td><?php echo$proveedores["telefono_proveedor2"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["contacto"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Contacto:</b></td>
							<td><?php echo$proveedores["contacto"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["estanon"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Esta&ntilde;on:</b></td>
							<td><?php echo$proveedores["estanon"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!------------------------------------------------------------------------>
					<input name="Eliminar" type="submit" value="Eliminar" onMouseOver="toolTip('Aceptar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/VerProveedor.php?valor=$codigo_proveedor')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>