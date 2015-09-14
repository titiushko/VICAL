<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";

$codigo_recolector 		= $_REQUEST['codigo_recolector'];
$nombre_recolector 		= $_POST['nombre_recolector'];
$dui1			 		= $_POST['dui1'];
$dui2			 		= $_POST['dui2'];
$nit1			 		= $_POST['nit1'];
$nit2			 		= $_POST['nit2'];
$nit3			 		= $_POST['nit3'];
$nit4			 		= $_POST['nit4'];
$direccion_recolector 	= $_POST['direccion_recolector'];
$telefono1					= $_POST['telefono1'];
$telefono2					= $_POST['telefono2'];

$dui_recolector = $dui1."-".$dui2;
$nit_recolector = $nit1."-".$nit2."-".$nit3."-".$nit4;
$telefono_recolector = $telefono1."-".$telefono2;

$instruccion_update = "
UPDATE recolectores
SET
nombre_recolector = '$nombre_recolector',
dui_recolector = '$dui_recolector',
nit_recolector = '$nit_recolector',
direccion_recolector = '$direccion_recolector',
telefono_recolector = '$telefono_recolector'
WHERE codigo_recolector = '$codigo_recolector'";
$actualizar_recolectores = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_recolectores!!</SPAN>".mysql_error());

$instruccion_select = "
SELECT codigo_recolector, nombre_recolector, dui_recolector, nit_recolector, direccion_recolector, telefono_recolector
FROM recolectores 
WHERE recolectores.codigo_recolector = '$codigo_recolector'";
$consulta_recolectores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_recolectores!!</SPAN>".mysql_error());
$recolectores = mysql_fetch_assoc($consulta_recolectores);
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarRecolector.php">
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
					<h1 class="encabezado1">MODIFICAR RECOLECTOR</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO EL RECOLECTOR EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="resultado centro">
						<tr>
							<td align="right" class="titulo3">Codigo:</td>
							<td class="subtitulo1"><?php echo $recolectores["codigo_recolector"];?></td>
						</tr>
						<tr>
							<td align="right" class="titulo3">Nombre:</td>
							<td class="subtitulo1"><?php echo $recolectores["nombre_recolector"];?></td>
						</tr>
						<tr>
							<td align="right" class="titulo3">DUI:</td>
							<td class="subtitulo1"><?php echo $recolectores["dui_recolector"];?></td>
						</tr>
						<tr>
							<td align="right" class="titulo3">NIT:</td>
							<td class="subtitulo1"><?php echo $recolectores["nit_recolector"];?></td>
						</tr>
						<?php
						if ($recolectores["direccion_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Direccion:</td>
							<td><?php echo $recolectores["direccion_recolector"];?></td>
						</tr>
						<?php
						}
						if ($recolectores["telefono_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $recolectores["telefono_recolector"];?></td>
						</tr>
						<?php
						}
						?>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>