<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$codigo_precio = $_REQUEST['codigo_precio'];
$precio_unitario  = $_POST['precio_unitario'];

$instruccion_update = "UPDATE precios SET precio_unitario = '$precio_unitario' WHERE codigo_precio = '$codigo_precio'";
$actualizar_precio = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_precio!!</SPAN>".mysql_error());

$instruccion_select = "SELECT precio_unitario FROM precios WHERE codigo_precio = '$codigo_precio'";
$consulta_precio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_precio!!</SPAN>".mysql_error());
$precio = mysql_fetch_array($consulta_precio);
?>
<HTML>
	<head>
		<title>SCYCPVES</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarPrecioUnitario.php">
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
					<h1 class="encabezado1">MODIFICAR PRECIO UNITARIO</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO EL PRECIO UNITARIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="resultado centro">
						<tr>
							<td align="right"><b>Precio Unitario:</b></td>
							<td align="left">						
								<input name="precio_unitario" class="subtitulo1 fondo3" readonly value="<?php echo "$".number_format($precio['precio_unitario'],2,'.',',');?>" type="text" size=4 maxLength=4>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>