<?php
session_start();
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
		<meta name="description"         content="Sistema de Informaci&oacute;n Gerencial para el Programa Nacional de Alfabetizaci&oacute;n">
		<link rel="shortcut icon" 		 href="../../imagenes/icono.ico">
		<link rel="stylesheet" 			 href="../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../librerias/funciones.js"></script>
		<style>
		.encabezado2{color: red;}
		a:link{text-decoration: none; color: #000;}
		a:visited{text-decoration: none; color: #000; font-weight: normal;}
		a:hover{text-decoration: none; color: #000; font-weight: normal;}
		</style>
	</head>
	<BODY style="background-color: #000;">
		<br><br><br><br>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<h1 class="encabezado1">ACCESO DENEGADO</h1>
					<h2 class="encabezado2">
						<img src="../../imagenes/icono_denegado.png">
						<br>
						ERROR AL INICIAR SESI&Oacute;N!!
					</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center">
								Actualmente la cuenta de usuario <font size="5"><b><?php echo $_SESSION["usuario"]; ?></b></font> se encuentra en uso en otro lugar.<br>
								De click en "Aceptar" para cerrar est&aacute; sesi&oacute;n y volver a la pagina de inicio e identificarse para cargar su cuenta de usuario.
							</td>
						</tr>
					</table>
					<br>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<a href="../Salir.php" target="_top" onMouseOver="toolTip('Aceptar, volver a la pagina de inicio de sesi&oacute;n',this)"><img src="../../imagenes/icono_aceptar.png"></a>
				</td>
			</tr>
		</table>
	</BODY>
</HTML>