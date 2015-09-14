<?php 
include "../../../librerias/abrir_conexion.php";

$codigo_tipo = $_REQUEST['codigo'];

$instruccion_select = "SELECT codigo_tipo AS tipos_vidrio_codigo_tipo, nombre_tipo FROM tipos_vidrio WHERE codigo_tipo = '$codigo_tipo'";
$consulta_tipo = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipo!!</SPAN>".mysql_error());
$tipos_vidrio = mysql_fetch_array($consulta_tipo);

$instruccion_select = "
SELECT
tipos_vidrio.codigo_tipo,
vidrio.codigo_tipo AS vidrio_codigo_tipo
FROM tipos_vidrio, vidrio
WHERE tipos_vidrio.codigo_tipo = '$codigo_tipo'
AND vidrio.codigo_tipo = tipos_vidrio.codigo_tipo";
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
					<h1 class="encabezado1">ELIMINAR TIPO DE VIDRIO</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			if( $tipos_vidrio['tipos_vidrio_codigo_tipo'] == $vidrio['vidrio_codigo_tipo'] ){
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_error.png">
						<br>
						NO SE PUDO ELIMINAR EL TIPO DE VIDRIO!!
					</h2>
					<table align="center" class="alerta centro">
						<tr>
							<td>
								No se puede eliminar el tipo de vidrio <?php echo $tipos_vidrio["nombre_tipo"];?> 
								porque hay facturas registradas con este tipo de vidrio.
							</td>
						</tr>
					</table>
					<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarTipoVidrio.php">
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			}
			else {
			//eliminar el registro de la tabla tipos_vidrio con el codigo del tipo que se va eliminar
			$instruccion_delete = "DELETE FROM tipos_vidrio WHERE codigo_tipo = '$codigo_tipo'";
			mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_tipo!! </SPAN>".mysql_error());
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL TIPO DE VIDRIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<tr>
							<td align="right"><b>Codigo:</b></td>
							<td><?php echo $tipos_vidrio["tipos_vidrio_codigo_tipo"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Tipo de Vidrio:</b></td>
							<td><?php echo $tipos_vidrio["nombre_tipo"]; ?></td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
			<meta http-equiv ="refresh"		 content="3;url=../Consultar/frmConsultarTipoVidrio.php">
			<?php
			}
			?>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2010</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>