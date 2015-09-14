<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
$precio = $_POST['precio'];
$instruccion_update = "UPDATE precio SET precio_unitario = '$precio'";
$actualizar_precio = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_precio!!</SPAN>".mysql_error());

$instruccion_select = "SELECT precio_unitario FROM precio";
$consulta_precio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_precio!!</SPAN>".mysql_error());
$precio = mysql_fetch_array($consulta_precio);
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/VerPrecioUnitario.php">
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
					<h1 class="encabezado1">MODIFICAR PRECIO DE COMPRA UNITARIO</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO EXITOSAMENTE EL PRECIO DE COMPRA UNITARIO!!
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
								<input name="precio" class="subtitulo1 fondo3" readonly value="<?php echo $precio['precio_unitario'];?>" type="text" size=4 maxLength=4 onKeyPress="return soloNumerosFloat(event)" onBlur="borrarMensaje();" onClick="borrarMensaje();">&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>