<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";

$recolector = $_REQUEST['valor'];

$instruccion_select = "
SELECT codigo_recolector, nombre_recolector, dui_recolector, nit_recolector, direccion_recolector, telefono_recolector
FROM recolectores 
WHERE recolectores.codigo_recolector = '$recolector'";
$consulta_recolectores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_recolectores!!</SPAN>".mysql_error());
$recolectores = mysql_fetch_assoc($consulta_recolectores);
?>
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
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
					<h1 class="encabezado1">CONSULTAR RECOLECTOR</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="marco centro">
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1"><?php echo $recolectores["codigo_recolector"];?></td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Nombre:</td>
							<td class="subtitulo1"><?php echo $recolectores["nombre_recolector"];?></td>
						</tr>
						<tr>
							<td align="right" class="titulo1">DUI:</td>
							<td class="subtitulo1"><?php echo $recolectores["dui_recolector"];?></td>
						</tr>
						<tr>
							<td align="right" class="titulo1">NIT:</td>
							<td class="subtitulo1"><?php echo $recolectores["nit_recolector"];?></td>
						</tr>
						<?php
						if ($recolectores["direccion_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Direccion:</td>
							<td><?php echo $recolectores["direccion_recolector"];?></td>
						</tr>
						<?php
						}
						if ($recolectores["telefono_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Telefono:</td>
							<td class="subtitulo1"><?php echo $recolectores["telefono_recolector"];?></td>
						</tr>
						<?php
						}
						?>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<img src="../../../imagenes/icono_modificar.png" align="top" <?php echo "onMouseOver=\"toolTip('Modificar ".$recolectores["nombre_recolector"]."',this)\" onClick=\"redireccionar('../Modificar/frmModificarRecolector.php?modificar_recolector=$recolector');\"";?> class="manita">
					<img src="../../../imagenes/icono_eliminar.png" align="top" <?php echo "onMouseOver=\"toolTip('Eliminar ".$recolectores["nombre_recolector"]."',this)\" onClick=\"redireccionar('../Eliminar/frmEliminarRecolector.php?eliminar_recolector=$recolector');\"";?> class="manita">
					<hr width="270">
					<img src="../../../imagenes/icono_graficar.png" align="bottom" <?php echo "onMouseOver=\"toolTip('Ver Estadisticas de ".$recolectores["nombre_recolector"]."',this)\" onClick=\"redireccionar('../Estadisticas/frmEstadisticaRecolector.php?valor=".$recolectores['nombre_recolector']."');\"";?> class="manita">
					<?php } ?>
					<img src="../../../imagenes/icono_reporte.png" align="top" <?php echo "onMouseOver=\"toolTip('Ver Reporte de ".$recolectores["nombre_recolector"]."',this)\" onClick=\"redireccionar('../Reporte/frmReporteRecolector.php?valor=".$recolectores['nombre_recolector']."');\"";?> class="manita">
					<br>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('frmConsultarRecolector.php');" class="manita">
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>