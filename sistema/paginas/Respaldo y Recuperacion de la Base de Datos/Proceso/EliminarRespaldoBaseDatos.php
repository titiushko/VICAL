<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$nombre = $_REQUEST['nombre_respaldo'];

date_default_timezone_set('America/El_Salvador');
$fecha = transformarFecha(date('Y/m/d G:i:s',filemtime("c:\\wamp\\www\\backup\\$nombre")));

unlink("c:\\wamp\\www\\backup\\$nombre");	//elimina el archivo en la rura especificada
?>
<HTML>
	<head>
		<title>COMVICONPRO</title>
		<meta http-equiv ="refresh"		 content="5;url=frmRespaldoRecuperacionBaseDatos.php">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINACION DE RESPALDO DE LA BASE DE DATOS</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL RESPALDO DE LA BASE DE DATOS EXITOSAMENTE!!
					</h2>
					<table align="center" class="centro resultado">
						<tr>
							<td align="center" colspan="3">
								Se elimino exitosamente el respaldo la base de datos del sistema creado el <?php echo $fecha; ?>.
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>