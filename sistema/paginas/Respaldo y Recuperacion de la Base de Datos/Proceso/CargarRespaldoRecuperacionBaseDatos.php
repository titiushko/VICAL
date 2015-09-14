<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$nombre_respaldo = $_REQUEST['nombre_respaldo'];
if($nombre_respaldo == "Recuperacion"){
	$url = "RespaldoBaseDatos.php";
	$accion = "RESPALDO";
}
else{
	$url = "RecuperacionBaseDatos.php?nombre_respaldo=$nombre_respaldo";
	$accion = "RECUPERACION";
}
?>
<HTML>
	<head>
		<title>COMVICONPRO</title>
		<meta http-equiv ="refresh"		 content="0;url=<?php echo $url; ?>">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REALIZANDO <?php echo $accion; ?> DE LA BASE DE DATOS</h1>
				</td>
			<tr>
				<td align="center">
				<img src="../../../imagenes/cargando_sesion.gif" width="30%" height="30%">
				<br><br>Espere porfavor...<br><br>
				</td>
			</tr>
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>