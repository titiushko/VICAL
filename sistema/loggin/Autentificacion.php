<?php
include "../librerias/funciones.php";
include "../librerias/abrir_conexion.php";
$usuario  = $_POST['usuario'];
$password = $_POST['password'];

$consulta_usuario = mysql_query("SELECT id, nombre, nivel FROM usuarios WHERE usuario = '$usuario' AND password = '$password'", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_usuario!!</SPAN>".mysql_error());
$cantidad = mysql_num_rows($consulta_usuario);

$_SESSION["autenticado"]= "NO";
if($cantidad != 0){
	session_start();
	$_SESSION["autenticado"] = "SI";
	
	$usuarios = mysql_fetch_array($consulta_usuario);
	$_SESSION["nombre"] = $usuarios["nombre"];
	$_SESSION["nivel"] = $usuarios["nivel"];
	
	header ("Location: CargarSesion.php");
}
else{
	header ("Location: frmLoggin.php?error_usuario=si");
}
include "../librerias/cerrar_conexion.php";
?>