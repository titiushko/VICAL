<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
//echo "?codigo=".$_REQUEST['codigo']."&nuevo_centro_acopio=".$_POST['nuevo_centro_acopio']."&cheque_eliminar_compras=".$_POST['cheque_eliminar_compras'];
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv ="refresh"		 content="0;url=EliminarCentroAcopio&CompraVidrio.php<?php echo "?codigo=".$_REQUEST['codigo']."&nuevo_centro_acopio=".$_POST['nuevo_centro_acopio']."&cheque_eliminar_compras=".$_POST['cheque_eliminar_compras'];?>">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR CENTRO DE ACOPIO</h1>
				</td>
			<tr>
				<td align="center">
				<img src="../../../imagenes/cargando_sesion.gif" width="30%" height="30%">
				<br><br>Espere porfavor...<br><br>
				</td>
			</tr>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>