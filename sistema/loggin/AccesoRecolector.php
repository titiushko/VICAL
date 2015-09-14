<?php
$autorisacion = false;
if($_SESSION["tipo_usuario"] == "1" || $_SESSION["tipo_usuario"] == "3")	$autorisacion = true;
if(!$autorisacion){
	session_destroy();
	header("Location: ../../../loggin/Denegado/CargarDenegado.php");
	exit();
}
?>