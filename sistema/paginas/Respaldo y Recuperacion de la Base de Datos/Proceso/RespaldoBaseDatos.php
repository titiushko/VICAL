<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
/*
nombre del backup historico de la base de datos: {fecha(dd-mm-yyy)hora(hh-mm)}BackupBaseDatosVical.sql	
	el backup historico se genera para tener un historial de los respaldos generados de la base de datos
	en caso de algun error o problema con la base de datos se podra recuperar la base de datos en una fecha determinada
*/

date_default_timezone_set('America/El_Salvador');
$fecha = date('Y/m/d G:i:s');	//formato fecha MySQL
$nombre = "{fecha(".date('d-m-Y').")hora(".date('G-i').")}BackupBaseDatosVical.sql";	//formato de la fecha y la hora del nombre del backup historico

//crea el backup historico de la base de datos
$ejecutar_comando = "c:\\wamp\\bin\\mysql\\mysql5.5.16\\bin\\mysqldump.exe -u$username --password=$password --opt vical > c:\\wamp\\www\\backup\\$nombre";
system($ejecutar_comando);
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
					<h1 class="encabezado1">RESPALDO DE LA BASE DE DATOS</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REALIZO EL RESPALDO DE LA BASE DE DATOS EXITOSAMENTE!!
					</h2>
					<table align="center" class="centro resultado">
						<tr>
							<td align="center" colspan="3">
								Se guardo exitosamente el <?php echo transformarFecha(date('Y/m/d G:i:s',filemtime("c:\\wamp\\www\\backup\\$nombre"))); ?> una copia de la base de datos del sistema en el estado que se encuentra actualmente.
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