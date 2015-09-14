<?php
if($_SESSION["tipo_usuario"] != "1"){
	session_destroy();
	header("Location: ../../../loggin/Denegado/CargarDenegado.php");
	exit();
}
?>