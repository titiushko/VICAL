<?php
session_start();
if($_SESSION["autenticado"] != "SI"){
	session_destroy();
	header("Location: ../loggin/Denegado/CargarDenegado.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//WRC//DTD HTML 4.01 Transitional//EN">
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="Tito">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../imagenes/vical.ico" />
		<link rel="stylesheet"			 href="../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1">	
		<CENTER>
		<h1 class="encabezado1">SISTEMA DE COMPRAS Y CONTROL DE PROVEEDORES DE LA EMPRESA VICAL DE EL SALVADOR</h1>
		<h1 class="encabezado1">Bienvenid@ <font color="#ffff00"><?php echo $_SESSION["nombre"]."";?></font></h1>
		<br>
		<IMG SRC="../imagenes/vidrio.png">
		</CENTER>
		<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center></p>
	</BODY>
</HTML>