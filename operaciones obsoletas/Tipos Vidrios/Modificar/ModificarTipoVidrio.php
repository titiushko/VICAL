<?php
include "../../../librerias/abrir_conexion.php";

$codigo_tipo = $_REQUEST['codigo_tipo'];
$nombre_tipo = $_POST['nombre_tipo'];

$instruccion_update = "UPDATE tipos_vidrio SET nombre_tipo = '$nombre_tipo' WHERE codigo_tipo = '$codigo_tipo'";
$actualizar_tipos_vidrio = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_tipos_vidrio!!</SPAN>".mysql_error());

$instruccion_select = "SELECT codigo_tipo, nombre_tipo FROM tipos_vidrio WHERE codigo_tipo = '$codigo_tipo'";
$consulta_tipo = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipo!!</SPAN>".mysql_error());
$tipos_vidrio = mysql_fetch_array($consulta_tipo);
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv ="refresh"		 content="3;url=../Consultar/frmConsultarTipoVidrio.php">
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
					<h1 class="encabezado1">MODIFICAR TIPO DE VIDRIO</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO EL TIPO DE VIDRIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="resultado centro">
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
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2010</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>