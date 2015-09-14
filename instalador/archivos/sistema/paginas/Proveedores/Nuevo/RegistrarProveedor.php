<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_proveedor		= 	$_POST['codigo_proveedor'];
$nombre_proveedor		=	$_POST['nombre_proveedor'];
$nombre_tipo_empresa	= 	$_POST['nombre_tipo_empresa'];
$direccion_proveedor	= 	$_POST['direccion_proveedor'];
$departamento			= 	$_POST['departamento'];
$contacto				= 	$_POST['contacto'];
$telefono1_1			= 	$_POST['telefono1_1'];
$telefono1_2			= 	$_POST['telefono1_2'];
$telefono2_1			= 	$_POST['telefono2_1'];
$telefono2_2			= 	$_POST['telefono2_2'];
$estanon				= 	$_POST['estanon'];

$telefono_proveedor1 = $telefono1_1."-".$telefono1_2;
$telefono_proveedor2 = $telefono2_1."-".$telefono2_2;

if($nombre_proveedor == "") $nombre_proveedor = NULL;
if($direccion_proveedor == "") $direccion_proveedor = NULL;
if($departamento == "") $departamento = NULL;
if($contacto == "") $contacto = NULL;
if($telefono_proveedor1 == "-") $telefono_proveedor1 = NULL;
if($telefono_proveedor2 == "-") $telefono_proveedor2 = NULL;
if($estanon == "") $estanon = NULL;
?>
<!----------------------------------------------------------------------------------------------------------------->
<HTML>
	<head>
		<title>SCYCPVES</title>
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
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE PROVEEDORES</h1>
				<?php
				$consulta_buscar = mysql_query("SELECT codigo_proveedor FROM proveedores WHERE codigo_proveedor = '$codigo_proveedor'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
				$buscar =  mysql_fetch_array($consulta_buscar);
				if($buscar[0] == $codigo_proveedor){
				?>
						<h2 class="encabezado2">
							<img src="../../../imagenes/icono_error.png">
							<br>
							NO SE PUDO REGISTRAR EL PROVEEDOR!!
						</h2>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="alerta error centro">
							<tr>
								<td align="center">
									El codigo <?php echo $codigo_proveedor;?> del proveedor que quiere registrar ya ha sido asignado en otro proveedor.
								</td>
							</tr>
						</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoProveedor.php">
					</td>
				</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
				<?php
				}
				else if($buscar[0] <> $codigo_proveedor){
				$instruccion_select = "
				SELECT codigo_tipo_empresa FROM tipos_empresas WHERE nombre_tipo_empresa = '$nombre_tipo_empresa'";
				$consulta_tipo = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_vidrio!! </SPAN>".mysql_error());
				$tipo_empresa = mysql_fetch_array($consulta_tipo);
				$codigo_tipo_empresa = $tipo_empresa[0];
				
				$instruccion_insert = "
				INSERT INTO vical.proveedores (
				CODIGO_TIPO_EMPRESA,
				nombre_proveedor,
				DEPARTAMENTO,
				DIRECCION_PROVEEDOR,
				TELEFONO_PROVEEDOR1,
				TELEFONO_PROVEEDOR2,
				CONTACTO,
				ESTANON)
				VALUES (
				'$codigo_tipo_empresa',
				'$nombre_proveedor',
				'$departamento',
				'$direccion_proveedor',
				'$telefono_proveedor1',
				'$telefono_proveedor2',
				'$contacto',
				'$estanon')";
				mysql_query($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_proveedor!! </SPAN>".mysql_error());
				?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REGISTRO EL PROVEEDOR EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td>
					<table align="center" class="marco">
						<!--------------------------------CODIGO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Codigo:</span></td>
							<td align="left"><input type="text" size=4 disabled="disabled" value="<?php echo $codigo_proveedor;?>"></td>
						</tr>
						<!--------------------------------NOMBRE---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre Empresa:</span></td>
							<td align="left"><input type="text" size=39 disabled="disabled" value="<?php echo $nombre_proveedor;?>"></td>
						</tr>
						<!--------------------------------TIPO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Tipo Empresa:</span></td>
							<td align="left"><input type="text" size=15 disabled="disabled" value="<?php echo $nombre_tipo_empresa;?>"></td>
						</tr>
						<!--------------------------------DIRECCION---------------------------------->
						<?php
						if($direccion_proveedor <> NULL){
						?>
						<tr>
							<td align="right"><span class="titulo1">Direccion:</span></td>
							<td align="left"><textarea cols=30 rows=4 disabled="disabled"><?php echo $direccion_proveedor;?></textarea></td>
						</tr>
						<?php
						}
						?>
						<!--------------------------------DEPARTAMENTO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Departamento:</span></td>
							<td align="left"><input type="text" size=15 disabled="disabled" value="<?php echo $departamento;?>"></td>
						</tr>
						<!--------------------------------CONTACTO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre Representante:</span></td>
							<td align="left"><input type="text" size=39 disabled="disabled" value="<?php echo $contacto;?>"></td>
						</tr>
						<!--------------------------------TELEFONO1---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Telefono:</span></td>
							<td align="left"><input type="text" size=7 disabled="disabled" value="<?php echo $telefono_proveedor1;?>"></td>
						</tr>
						<!--------------------------------TELEFONO2---------------------------------->
						<?php
						if($telefono_proveedor2 <> NULL){
						?>
						<tr>
							<td align="right"><span class="titulo1">Telefono2:</span></td>
							<td align="left"><input type="text" size=7 disabled="disabled" value="<?php echo $telefono_proveedor2;?>"></td>
						</tr>
						<!--------------------------------ESTANON---------------------------------->
						<?php
						}
						if($estanon <> NULL){
						?>
						<tr>
							<td align="right"><span class="titulo1">Esta&ntilde;&oacute;n:</span></td>
							<td align="left"><input type="text" size=7 disabled="disabled" value="<?php echo $estanon;?>"></td>
						</tr>
						<?php
						}
						?>
					</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoProveedor.php">
					</td>
				</tr>
				<?php
				}
				?>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>