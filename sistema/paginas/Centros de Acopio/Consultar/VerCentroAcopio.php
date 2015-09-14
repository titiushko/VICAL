<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../librerias/abrir_conexion.php";
$centro_de_acopio 	= $_REQUEST['departamento'];
$direccion 			= "../Consultar/VerCentroAcopio.php";

$instruccion_select = "
SELECT
centros_de_acopio.codigo_centro_acopio,
centros_de_acopio.nombre_centro_acopio,
centros_de_acopio.direccion,
centros_de_acopio.departamento,
centros_de_acopio.telefono,
recolectores.nombre_recolector
FROM centros_de_acopio
JOIN recolectores
WHERE centros_de_acopio.codigo_centro_acopio = '$centro_de_acopio'
AND recolectores.codigo_recolector = centros_de_acopio.codigo_recolector";
$consulta_centro_de_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!!</SPAN>".mysql_error());
$centros_de_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);
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
					<h1 class="encabezado1">CONSULTAR CENTROS DE ACOPIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="marco centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["codigo_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Nombre:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Encargado:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_recolector"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["direccion"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1"><b>Direccion:</b>
							<td class="subtitulo1"><?php echo $centros_de_acopio["direccion"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Departamento:</td>
							<td><?php echo $centros_de_acopio["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["telefono"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Telefono:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["telefono"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<img src="../../../imagenes/icono_modificar.png" align="top" onMouseOver="toolTip('Modificar Centro de Acopio',this);" <?php echo "onClick=\"redireccionar('../Modificar/frmModificarCentroAcopio.php?modificar_centro_de_acopio=$centro_de_acopio&direccion=$direccion');\"";?> class="manita">
					<img src="../../../imagenes/icono_eliminar.png" align="top" onMouseOver="toolTip('Eliminar Centro de Acopio',this);" <?php echo "onClick=\"redireccionar('../Eliminar/frmEliminarCentroAcopio.php?eliminar_centro_de_acopio=$centro_de_acopio&direccion=$direccion');\"";?> class="manita">
					<br>
					<?php } ?>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('frmConsultarCentroAcopio.php');" class="manita">
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>