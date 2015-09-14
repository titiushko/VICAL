<?php
$autorisacion = false;
if($_SESSION["tipo_usuario"] == "1" || $_SESSION["tipo_usuario"] == "2")	$autorisacion = true;
if(!$autorisacion){
	//session_destroy();
	header("Location: ../../../login/Denegado/CargarDenegado.php");
	exit();
}
?>