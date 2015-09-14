<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_proveedor 		= $_REQUEST['codigo_proveedor'];
$nombre_proveedor 		= $_POST['nombre_proveedor'];
$nombre_tipo_empresa	= $_POST['nombre_tipo_empresa'];
$direccion_proveedor 	= $_POST['direccion_proveedor'];
$departamento 			= $_POST['departamento'];
$telefono1_1			= $_POST['telefono1_1'];
$telefono1_2			= $_POST['telefono1_2'];
$telefono2_1			= $_POST['telefono2_1'];
$telefono2_2			= $_POST['telefono2_2'];
$contacto				= $_POST['contacto'];
$estanon				= $_POST['estanon'];


if($telefono1_1 <> NULL && $telefono1_2 <> NULL)
	$telefono_proveedor1 = $telefono1_1."-".$telefono1_2;
else
	$telefono_proveedor1 = NULL;

if($telefono2_1 <> NULL && $telefono2_2 <> NULL)
	$telefono_proveedor2 = $telefono2_1."-".$telefono2_2;
else
	$telefono_proveedor2 = NULL;

$instruccion_select = "
SELECT
codigo_tipo_empresa
FROM tipos_empresas
WHERE nombre_tipo_empresa = '$nombre_tipo_empresa'";
$consulta_tipos_empresa = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipos_empresa!!</SPAN>".mysql_error());
$tipos_empresas = mysql_fetch_assoc($consulta_tipos_empresa);
$codigo_tipo_empresa = $tipos_empresas['codigo_tipo_empresa'];

$instruccion_update = "
UPDATE proveedores
SET
nombre_proveedor = '$nombre_proveedor',
codigo_tipo_empresa = '$codigo_tipo_empresa',
direccion_proveedor = '$direccion_proveedor',
departamento = '$departamento',
telefono_proveedor1 = '$telefono_proveedor1',
telefono_proveedor2 = '$telefono_proveedor2',
contacto = '$contacto',
estanon = '$estanon'
WHERE codigo_proveedor = '$codigo_proveedor'";
$actualizar_proveedores = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_proveedores!!</SPAN>".mysql_error());

$instruccion_select = "
SELECT
proveedores.codigo_proveedor,
proveedores.nombre_proveedor,
proveedores.direccion_proveedor,
proveedores.departamento,
proveedores.telefono_proveedor1,
proveedores.telefono_proveedor2,
proveedores.contacto,
proveedores.estanon,
tipos_empresas.nombre_tipo_empresa
FROM proveedores
JOIN tipos_empresas
WHERE proveedores.codigo_proveedor = '$codigo_proveedor'
AND tipos_empresas.codigo_tipo_empresa = proveedores.codigo_tipo_empresa";
$consulta_proveedores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedores!!</SPAN>".mysql_error());
$proveedores = mysql_fetch_assoc($consulta_proveedores);
?>
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarProveedor.php">
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
							<td class="subtitulo1"><?php echo $proveedores["codigo_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Nombre:</td>
							<td class="subtitulo1"><?php echo $proveedores["nombre_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Tipo Empresa:</td>
							<td class="subtitulo1"><?php echo $proveedores["nombre_tipo_empresa"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($proveedores["direccion_proveedor"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Direccion:</td>
							<td><?php echo $proveedores["direccion_proveedor"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["departamento"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Departamento:</td>
							<td><?php echo $proveedores["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["telefono_proveedor1"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $proveedores["telefono_proveedor1"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["telefono_proveedor2"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono2:</td>
							<td class="subtitulo1"><?php echo $proveedores["telefono_proveedor2"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["contacto"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Contacto:</td>
							<td class="subtitulo1"><?php echo $proveedores["contacto"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						}
						if ($proveedores["estanon"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Esta&ntilde;on:</td>
							<td class="subtitulo1"><?php echo $proveedores["estanon"];?></td>
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