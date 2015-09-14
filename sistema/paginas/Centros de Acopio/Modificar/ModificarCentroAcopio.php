<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$centro_de_acopio 	= $_REQUEST['centro_de_acopio'];
$nombre_centro_acopio = $_POST['nombre_centro_acopio'];
$nombre_recolector 	= $_POST['nombre_recolector'];
$direccion			= $_POST['direccion'];
$departamento 		= $_POST['departamento'];
$telefono1			= $_POST['telefono1'];
$telefono2			= $_POST['telefono2'];

if($telefono1 <> NULL && $telefono2 <> NULL)
	$telefono = $telefono1."-".$telefono2;
else
	$telefono = NULL;

$instruccion_select = "
SELECT codigo_recolector FROM recolectores WHERE nombre_recolector = '$nombre_recolector'";
$consulta_recolector = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!! </SPAN>".mysql_error());
$recolectores = mysql_fetch_array($consulta_recolector);
$codigo_recolector = $recolectores[0];

$instruccion_update = "
UPDATE centros_de_acopio
SET
codigo_recolector = '$codigo_recolector',
nombre_centro_acopio = '$nombre_centro_acopio',
direccion = '$direccion',
departamento = '$departamento',
telefono = '$telefono'
WHERE codigo_centro_acopio = '$centro_de_acopio'";
$actualizar_centro_de_acopio = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_centro_de_acopio!!</SPAN>".mysql_error());

$instruccion_select = "
SELECT
centros_de_acopio.codigo_centro_acopio,
centros_de_acopio.nombre_centro_acopio,
centros_de_acopio.direccion,
centros_de_acopio.departamento,
centros_de_acopio.telefono,
recolectores.nombre_recolector
FROM centros_de_acopio
JOIN recolectores
WHERE centros_de_acopio.codigo_centro_acopio = '$centro_de_acopio'
AND recolectores.codigo_recolector = centros_de_acopio.codigo_recolector";
$consulta_centro_de_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!!</SPAN>".mysql_error());
$centros_de_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);
?>
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarCentroAcopio.php">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">MODIFICAR PROVEEDOR</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO EL PROVEEDOR EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="resultado centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Codigo:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["codigo_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Nombre:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Encargado:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_recolector"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["direccion"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Direccion:</td>
							<td><?php echo $centros_de_acopio["direccion"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Departamento:</td>
							<td><?php echo $centros_de_acopio["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["telefono"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["telefono"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>