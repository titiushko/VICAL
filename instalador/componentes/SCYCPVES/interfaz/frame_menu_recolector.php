<?php
session_start();
if($_SESSION["autenticado"] != "SI"){
	session_destroy();
	header("Location: ../loggin/Denegado/CargarDenegado.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="Tito">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../imagenes/vical.ico" />
		<link rel="stylesheet" 			 href="../librerias/menu_acordeon.css" type="text/css" media="screen"/>
		<link rel="stylesheet" 			 href="../librerias/formato.css" type="text/css" media="screen"/>
		<script type="text/javascript" 	 src="../librerias/funciones.js"></script>
	</head>
	<body>
		<center>
		<div class="texto3">
			<img src="../imagenes/icono_recolector.png"><br>
			<?php echo $_SESSION["nombre"]."";?><br><font color="#ffff00">Recolector</font>
		</div>
		<input onClick="redireccionar('../login/Salir.php')" type="submit" value="Salir" onMouseOver="toolTip('Salir',this)" class="boton salir">
		</center>
		<span id="toolTipBox" width="50"></span>
		<div id="menu">
			<ul>
				<li class="nivel1 primera" tabindex="1">
						<a href="frame_contenido.php" TARGET="CONTENIDO">Inicio</a>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~opcion1~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="nivel1" tabindex="2"><span class="nivel1">Vidrio</span>
					<ul>
						<li class="primera"><a href="../paginas/Vidrio/Consultar/frmConsultarCompra.php" TARGET="CONTENIDO">Consultar Compras</a></li>
						<li><a href="../paginas/Vidrio/Reporte/frmReporteCompra.php" TARGET="CONTENIDO">Reporte de Compras</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~opcion2~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="nivel1" tabindex="3"><span class="nivel1">Proveedores</span>
					<ul>
						<li class="primera"><a href="../paginas/Proveedores/Consultar/frmConsultarProveedor.php" TARGET="CONTENIDO">Consultar Proveedores</a></li>
						<li><a href="../paginas/Proveedores/Reporte/VerReporteProveedor.php" TARGET="CONTENIDO">Reporte de Proveedores</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~opcion3~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="nivel1" tabindex="4"><span class="nivel1">Recolectores</span>
					<ul>
						<li class="primera"><a href="../paginas/Recolectores/Consultar/frmConsultarRecolector.php" TARGET="CONTENIDO">Consultar Recolectores</a></li>
						<li><a href="../paginas/Recolectores/Reporte/frmReporteRecolector.php?valor=reporte" TARGET="CONTENIDO">Reporte de Recolectores</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~opcion4~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="nivel1" tabindex="5"><span class="nivel1">Centros de Acopio</span>
					<ul>
						<li class="primera"><a href="../paginas/Centros de Acopio/Consultar/frmConsultarCentroAcopio.php" TARGET="CONTENIDO">Consultar Centros de Acopio</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			</ul>
		</div>
	</body>
</html>