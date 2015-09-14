<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../librerias/abrir_conexion.php";
$proveedor = $_REQUEST['valor'];

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
WHERE proveedores.codigo_proveedor = '$proveedor'
AND tipos_empresas.codigo_tipo_empresa = proveedores.codigo_tipo_empresa";
$consulta_proveedores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedores!!</SPAN>".mysql_error());
$proveedores = mysql_fetch_assoc($consulta_proveedores);
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">CONSULTAR PROVEEDOR</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="marco centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1"><?php echo $proveedores["codigo_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Nombre Empresa:</td>
							<td class="subtitulo1"><?php echo $proveedores["nombre_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Tipo Empresa:</td>
							<td class="subtitulo1"><?php echo $proveedores["nombre_tipo_empresa"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($proveedores["direccion_proveedor"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Direccion:</td>
							<td><?php echo $proveedores["direccion_proveedor"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Departamento:</td>
							<td><?php echo $proveedores["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($proveedores["telefono_proveedor1"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Telefono Contacto:</td>
							<td class="subtitulo1"><?php echo $proveedores["telefono_proveedor1"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["telefono_proveedor2"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Telefono Contacto2:</td>
							<td class="subtitulo1"><?php echo $proveedores["telefono_proveedor2"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["contacto"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Contacto:</td>
							<td class="subtitulo1"><?php echo $proveedores["contacto"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["estanon"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Esta&ntilde;on:</td>
							<td class="subtitulo1"><?php echo $proveedores["estanon"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<img src="../../../imagenes/icono_modificar.png" align="top" <?php echo "onMouseOver=\"toolTip('Modificar ".$proveedores["nombre_proveedor"]."',this)\" onClick=\"redireccionar('../Modificar/frmModificarProveedor.php?modificar_proveedor=$proveedor');\"";?> class="manita">
					<img src="../../../imagenes/icono_eliminar.png" align="top" <?php echo "onMouseOver=\"toolTip('Eliminar ".$proveedores["nombre_proveedor"]."',this)\" onClick=\"redireccionar('../Eliminar/frmEliminarProveedor.php?eliminar_proveedor=$proveedor');\"";?> class="manita">
					<hr width="270">
					<img src="../../../imagenes/icono_graficar.png" align="bottom" <?php echo "onMouseOver=\"toolTip('Ver Estadisticas de ".$proveedores["nombre_proveedor"]."',this)\" onClick=\"redireccionar('../Estadisticas/frmEstadisticaProveedor.php?valor=".$proveedores['nombre_proveedor']."');\"";?> class="manita">
					<?php } if($_SESSION["tipo_usuario"] == "1" || $_SESSION["tipo_usuario"] == "2"){ ?>
					<img src="../../../imagenes/icono_historial.png" align="top" <?php echo "onMouseOver=\"toolTip('Ver Historial de ".$proveedores["nombre_proveedor"]."',this)\" onClick=\"redireccionar('../../Vidrio/Historial/VerHistorialCompra_Proveedor.php?seleccionar_proveedor=".$proveedores['codigo_proveedor']."');\"";?> class="manita">
					<?php } ?>
					<img src="../../../imagenes/icono_reporte.png" align="top" <?php echo "onMouseOver=\"toolTip('Ver Reporte de ".$proveedores["nombre_proveedor"]."',this)\" onClick=\"redireccionar('../../Vidrio/Reporte/VerReporteCompra_Proveedor.php?seleccionar_proveedor=".$proveedores['nombre_proveedor']."');\"";?> class="manita">
					<br>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('frmConsultarProveedor.php');" class="manita">
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>