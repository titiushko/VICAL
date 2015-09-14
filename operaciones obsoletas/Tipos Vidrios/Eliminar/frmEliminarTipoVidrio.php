<?php 
include "../../../librerias/abrir_conexion.php";

$codigo_tipo = $_REQUEST['eliminar_tipo'];

$instruccion_select = "SELECT codigo_tipo, nombre_tipo FROM tipos_vidrio WHERE codigo_tipo = '$codigo_tipo'";
$consulta_tipo = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipo!!</SPAN>".mysql_error());
$tipos_vidrio = mysql_fetch_array($consulta_tipo);
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
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_alerta.png">
						<br>
						REALMENTE DESEA ELIMINAR EL TIPO DE VIDRIO!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<form name="borrar_tipo" <?php echo "action=\"EliminarTipoVidrio.php?codigo=$codigo_tipo\"";?> method="post" enctype="multipart/form-data">
					<table align="center" class="alerta centro">
						<tr>
							<td align="right"><b>Codigo:</b></td>
							<td><?php echo $tipos_vidrio["codigo_tipo"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Tipo de Vidrio:</b></td>
							<td><?php echo $tipos_vidrio["nombre_tipo"]; ?></td>
						</tr>
					</table>
					<!------------------------------------------------------------------------>
					<input name="Eliminar" type="submit" value="Eliminar" onMouseOver="toolTip('Aceptar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/frmConsultarTipoVidrio.php?valor=$codigo_tipo')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2010</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>