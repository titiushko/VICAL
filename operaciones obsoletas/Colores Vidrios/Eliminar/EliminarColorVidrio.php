<?php 
include "../../../librerias/abrir_conexion.php";

$codigo_color = $_REQUEST['codigo'];

$instruccion_select = "SELECT codigo_color AS colores_vidrio_codigo_color, nombre_color FROM colores_vidrio WHERE codigo_color = '$codigo_color'";
$consulta_color = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_color!!</SPAN>".mysql_error());
$colores_vidrio = mysql_fetch_array($consulta_color);

$instruccion_select = "
SELECT
colores_vidrio.codigo_color,
vidrio.codigo_color AS vidrio_codigo_color
FROM colores_vidrio, vidrio
WHERE colores_vidrio.codigo_color = '$codigo_color'
AND vidrio.codigo_color = colores_vidrio.codigo_color";
$consulta_proveedor = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedor!! </SPAN>".mysql_error());
$vidrio = mysql_fetch_array($consulta_proveedor);
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
					<h1 class="encabezado1">ELIMINAR COLOR DE VIDRIO</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			if( $colores_vidrio['colores_vidrio_codigo_color'] == $vidrio['vidrio_codigo_color'] ){
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_error.png">
						<br>
						NO SE PUDO ELIMINAR EL COLOR DE VIDRIO!!
					</h2>
					<table align="center" class="alerta centro">
						<tr>
							<td>
								No se puede eliminar el color de vidrio <?php echo $colores_vidrio["nombre_color"];?> 
								porque hay facturas registradas con este color de vidrio.
							</td>
						</tr>
					</table>
					<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarColorVidrio.php">
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			}
			else {
			//eliminar el registro de la tabla colores_vidrio con el codigo del color que se va eliminar
			$instruccion_delete = "DELETE FROM colores_vidrio WHERE codigo_color = '$codigo_color'";
			mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_color!! </SPAN>".mysql_error());
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL COLOR DE VIDRIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<tr>
							<td align="right"><b>Codigo:</b></td>
							<td><?php echo $colores_vidrio["colores_vidrio_codigo_color"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Color de Vidrio:</b></td>
							<td><?php echo $colores_vidrio["nombre_color"]; ?></td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
			<meta http-equiv ="refresh"		 content="3;url=../Consultar/frmConsultarColorVidrio.php">
			<?php
			}
			?>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2010</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>