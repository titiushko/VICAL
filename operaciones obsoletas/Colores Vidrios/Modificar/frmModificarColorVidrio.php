<?php
include "../../../librerias/abrir_conexion.php";

$codigo_color = $_REQUEST['modificar_color'];

$instruccion_select = "SELECT codigo_color, nombre_color FROM colores_vidrio WHERE codigo_color = '$codigo_color'";
$consulta_color = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_color!!</SPAN>".mysql_error());
$colores_vidrio = mysql_fetch_array($consulta_color);
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
				<td align="center"><!--bgcolor="#B8CEF6"-->
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">MODIFICAR COLOR DE VIDRIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="modificar_color" <?php echo "action=\"ModificarColorVidrio.php?codigo_color=$codigo_color\"";?> method="post" enctype="multipart/form-data">
					<table class="marco centro">
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td><?php echo $colores_vidrio["codigo_color"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo1">Color de Vidrio:</td>
							<td><input name="nombre_color" class="subtitulo1 fondo" size=20 <?php echo "value='".$colores_vidrio["nombre_color"]."'";?> onKeyPress="return soloLetras(event)"></td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!------------------------------------------------------------------------>
					<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/frmConsultarColorVidrio.php?valor=$codigo_color')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2010</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>