<?php
session_start();
if($_SESSION["autenticado"] != "SI"){
	session_destroy();
	header("Location: ../../loggin/Denegado/CargarDenegado.php");
	exit();
}
?>