<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
//oobtener variables para realizar la consulta
$precio_unitario = $_POST['precio_unitario'];

$instruccion_insert = "INSERT INTO precios(PRECIO_UNITARIO) VALUES ('$precio_unitario')";
mysql_query ($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_precio!!</SPAN>".mysql_error());
?>
<HTML>
	<head>
		<title>SCYCPVES</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE PRECIO UNITARIO</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REGISTRO EL PRECIO UNITARIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td>
					<table align="center" class="marco">
						<tr>
							<td align="right"><span class="titulo1">Precio Unitario:</span></td>
							<td align="left"><input type="text" size=4 disabled="disabled" value="<?php echo "$".number_format($precio_unitario,2,'.',',');?>"></td>
						</tr>
					</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoPrecioUnitario.php">
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>