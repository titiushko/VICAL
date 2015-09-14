<?php
include "../../librerias/abrir_conexion.php";
session_start();
$consulta_usuario = mysql_query("SELECT estado FROM usuarios WHERE id = '".$_SESSION["id"]."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_usuario!!</SPAN>".mysql_error());
$usuarios = mysql_fetch_array($consulta_usuario);
$autorisacion = false;
if($_SESSION["autenticado"] == "SI" && $usuarios["estado"] == "online")	$autorisacion = true;
if(!$autorisacion){
	//session_destroy();
	header("Location: ../../login/Denegado/CargarDenegado.php");
	exit();
}
include "../../librerias/cerrar_conexion.php";
?>