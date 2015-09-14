<?php
include "../librerias/abrir_conexion.php";
include "../librerias/funciones.php";
session_start();
$consulta_usuario = mysql_query("SELECT estado FROM usuarios WHERE id = '".$_SESSION["id"]."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_usuario!!</SPAN>".mysql_error());
$usuarios = mysql_fetch_array($consulta_usuario);
if($usuarios["estado"] == "offline"){
	$update = "UPDATE usuarios SET estado = 'online' WHERE id = '".$_SESSION["id"]."'";
	$actualizar_usuario = mysql_query($update,$conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_usuario!!</SPAN>".mysql_error());
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
	header("Location: ../inicio.php");
}
else{
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
	<frameset rows="*" cols="*,195" frameborder="no" border="0" framespacing="0">
		<frameset rows="30,*" cols="*" border="0" framespacing="0">
			<frame name="DENEGADO_SOMBRA" src="Denegado/Denegado_sombra.php" noresize marginwidth="0" marginheight="0">
			<frame name="DENEGADO_CONTENIDO" src="Denegado/Denegado_sesion.php" noresize marginwidth="0" marginheight="0">
		</frameset>
		<frameset rows="30,*" cols="*" frameborder="no" border="0" framespacing="0">
			<frame name="DENEGADO_ESQUINA" src="Denegado/Denegado_esquina.php" scrolling="no" noresize marginwidth="0" marginheight="0">
			<frameset rows="*" cols="15,*" frameborder="no" border="0" framespacing="0">
				<frame name="DENEGADO_DERECHA"src="Denegado/Denegado_derecha.php" scrolling="no" noresize marginwidth="0" marginheight="0">
				<frame name="DENEGADO_MENU"src="Denegado/Denegado_menu.php" scrolling="no" noresize marginwidth="0" marginheight="0">
			</frameset>
		</frameset>
	</frameset>
</HTML>
<?php
}
include "../librerias/cerrar_conexion.php";
?>