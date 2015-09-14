<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$nombre = $_REQUEST['nombre_respaldo'];
/*
nombre del backup historico de la base de datos: {fecha(dd-mm-yyy)hora(hh-mm)}BackupBaseDatosVical.sql	
	el backup historico se genera para tener un historial de los respaldos generados de la base de datos
	en caso de algun error o problema con la base de datos se podra recuperar la base de datos en una fecha determinada
*/

//recupera el backup historico de la base de datos
$ejecutar_comando = "c:\\wamp\\bin\\mysql\\mysql5.5.24\\bin\\mysql.exe -u$username --password=$password vical < c:\\wamp\\www\\backup\\$nombre";
system($ejecutar_comando);

date_default_timezone_set('America/El_Salvador');
?>
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=frmRespaldoRecuperacionBaseDatos.php">
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
					<h1 class="encabezado1">RECUPERACION DE LA BASE DE DATOS</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REALIZO LA RECUPERACION DE LA BASE DE DATOS EXITOSAMENTE!!
					</h2>
					<table align="center" class="centro resultado">
						<tr>
							<td align="center" colspan="3">
								Se cargo exitosamente el respaldo la base de datos del sistema creado el <?php echo transformasFecha(date('Y/m/d G:i:s',filemtime("c:\\wamp\\www\\backup\\$nombre"))); ?> reemplazando el estado en el que se econtraba actualmente la base de datos del sistema.
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>