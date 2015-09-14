<?php
include "../librerias/abrir_conexion.php";
session_start();
$update = "UPDATE usuarios SET estado = 'offline' WHERE id = '".$_SESSION["id"]."'";
$actualizar_usuario = mysql_query($update,$conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_usuario!!</SPAN>".mysql_error());
session_destroy();
include "../librerias/cerrar_conexion.php";
?>
<!DOCTYPE html PUBLIC "-//WRC//DTD HTML 4.01 Transitional//EN">
<HTML>
	<head>
		<title>MINED</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="Tito">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../imagenes/icono.ico" />
	</head>
	<BODY style="background-color: #246fb9;" onLoad="window.open('../index.php','_top');">
	</BODY>
</HTML>