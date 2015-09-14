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
		<title>SCYCPVES</title>
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
			<img src="../imagenes/icono_administrador.png"><br>
			<?php echo $_SESSION["nombre"]."";?><br><font color="#ffff00">Administrador</font>
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
						<li class="primera"><a href="../paginas/Vidrio/Nueva/frmNuevaCompra.php?valor_nombre_recolector=nueva_compra" TARGET="CONTENIDO">Nueva Compra de Vidrio</a></li>
						<li><a href="../paginas/Vidrio/Consultar/frmConsultarCompra.php" TARGET="CONTENIDO">Consultar Compras</a></li>
						<li><a href="../paginas/Vidrio/Reporte/frmReporteCompra.php" TARGET="CONTENIDO">Reporte de Compras</a></li>
						<li><a href="../paginas/Vidrio/Estadisticas/frmEstadisticaCompra.php" TARGET="CONTENIDO">Estadisticas de Compras</a></li>
						<li><a href="../paginas/Vidrio/Historial/frmHistorialCompra.php" TARGET="CONTENIDO">Historial de Compras</a></li>
						<li><a href="../paginas/Vidrio/Comparacion/frmComparacionCompra.php" TARGET="CONTENIDO">Comparacion de Compras</a></li>
						<li><a href="../paginas/Vidrio/Pronosticos/GraficarPronosticoCompra.php" TARGET="CONTENIDO">Pronosticos de Compras</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~opcion2~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="nivel1" tabindex="3"><span class="nivel1">Proveedores</span>
					<ul>
						<li class="primera"><a href="../paginas/Proveedores/Nuevo/frmNuevoProveedor.php" TARGET="CONTENIDO">Nuevo Proveedor</a></li>
						<li><a href="../paginas/Proveedores/Consultar/frmConsultarProveedor.php" TARGET="CONTENIDO">Consultar Proveedores</a></li>
						<li><a href="../paginas/Proveedores/Reporte/VerReporteProveedor.php" TARGET="CONTENIDO">Reporte de Proveedores</a></li>
						<li><a href="../paginas/Proveedores/Estadisticas/frmEstadisticaProveedor.php?valor=estadisticas" TARGET="CONTENIDO">Estadisticas de Proveedores</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~opcion3~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="nivel1" tabindex="4"><span class="nivel1">Recolectores</span>
					<ul>
						<li class="primera"><a href="../paginas/Recolectores/Nuevo/frmNuevoRecolector.php" TARGET="CONTENIDO">Nuevo Recolector</a></li>
						<li><a href="../paginas/Recolectores/Consultar/frmConsultarRecolector.php" TARGET="CONTENIDO">Consultar Recolectores</a></li>
						<li><a href="../paginas/Recolectores/Reporte/frmReporteRecolector.php?valor=reporte" TARGET="CONTENIDO">Reporte de Recolectores</a></li>
						<li><a href="../paginas/Recolectores/Estadisticas/frmEstadisticaRecolector.php?valor=estadisticas" TARGET="CONTENIDO">Estadisticas de Recolectores</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~opcion4~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="nivel1" tabindex="5"><span class="nivel1">Administracion</span>
					<ul>
						<li class="primera"><a href="../paginas/Precio Unitario/Consultar/frmConsultarPrecioUnitario.php" TARGET="CONTENIDO">Precios Unitario</a></li>
						<li><a href="../paginas/Tipos Empresas/Consultar/frmConsultarTipoEmpresa.php" TARGET="CONTENIDO">Tipos de Empresa</a></li>
						<li><a href="../paginas/Centros de Acopio/Consultar/frmConsultarCentroAcopio.php" TARGET="CONTENIDO">Centros de Acopio</a></li>
						<li><a href="../paginas/Usuarios/Consultar/frmConsultarUsuario.php" TARGET="CONTENIDO">Usuarios</a></li>
						<li><a href="../paginas/Respaldo y Recuperacion de la Base de Datos/Proceso/frmRespaldoRecuperacionBaseDatos.php" TARGET="CONTENIDO">Respaldo y Recuperaci&oacute;n de la Base de Datos</a></li>
					</ul>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			</ul>
		</div>
	</body>
</html>