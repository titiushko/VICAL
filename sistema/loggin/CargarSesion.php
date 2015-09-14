<?php
include "../librerias/funciones.php";
session_start();

$_SESSION["cambio"] = 1;
/*
$ventas	= vendeMas();	$compras = compraMas();
for($i=1;$i<=5;$i++){
	$_SESSION["venta".$i][1]  = $ventas[$i][1];		$_SESSION["venta".$i][2]  = $ventas[$i][2];
	$_SESSION["compra".$i][1] = $compras[$i][1];	$_SESSION["compra".$i][2] = $compras[$i][2];
}
*/
if($_SESSION["nivel"] == 1){
	$_SESSION["tipo_usuario"] = "1"; 
	//header ("Location: ../inicio.php");
}
if($_SESSION["nivel"] == 2){
	$_SESSION["tipo_usuario"] = "2";  
	//header ("Location: ../inicio.php");
}
if($_SESSION["nivel"] == 3){
	$_SESSION["tipo_usuario"] = "3";
	//header ("Location: ../inicio.php");
}
?>
<!DOCTYPE html PUBLIC "-//WRC//DTD HTML 4.01 Transitional//EN">
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv ="refresh"		 content="1;url=../inicio.php">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="Tito">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../imagenes/vical.ico"/>
		<link rel="stylesheet"			 href="../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1">	
		<CENTER>
		<h1 class="encabezado1">CARGANDO SESION</h1>
		<img src="../imagenes/cargando_sesion.gif" width="30%" height="30%">
		<br><br>Espere porfavor...<br><br>
		</CENTER>
		<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center></p>
	</BODY>
</HTML>