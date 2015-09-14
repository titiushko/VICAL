<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_centro_acopio = $_POST['codigo_centro_acopio'];
$nombre_centro_acopio = $_POST['nombre_centro_acopio'];
$nombre_recolector	  = $_POST['nombre_recolector'];
$direccion			  = $_POST['direccion'];
$departamento		  = $_POST['departamento'];
$telefono1			  = $_POST['telefono1'];
$telefono2			  = $_POST['telefono2'];

$instruccion_select = "SELECT codigo_recolector FROM recolectores WHERE nombre_recolector = '$nombre_recolector'";
$consulta_recolector = mysql_query($instruccion_select, $conexion);
$tipo_recolector = mysql_fetch_array($consulta_recolector) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!! </SPAN>".mysql_error());
$codigo_recolector = $tipo_recolector[0];

$telefono = $telefono1."-".$telefono2;
if($telefono == "-") $telefono = NULL;
if($direccion == "") $direccion = NULL;
?>
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1">
		<div align="center" id="estilo1">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td align="center">
						<img src="../../../imagenes/vical.png" width="25%" height="25%">
						<h1 class="encabezado1">REGISTRO DE CENTROS DE ACOPIO</h1>
				<?php
				$consulta_buscar = mysql_query("SELECT codigo_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
				$buscar =  mysql_fetch_array($consulta_buscar);
				if($buscar[0] == $codigo_centro_acopio){
				?>
						<h2 class="encabezado2">
							<img src="../../../imagenes/icono_error.png">
							<br>
							NO SE PUDO REGISTRAR EL CENTRO DE ACOPIO!!
						</h2>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="alerta error centro">
							<tr>
								<td align="center">
									El codigo <?php echo $codigo_centro_acopio;?> del centro de acopio que quiere registrar ya ha sido asignado en otro centro de acopio.
								</td>
							</tr>
						</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoCentroAcopio.php?departamento=dep">
					</td>
				</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
				<?php
				}
				else if($buscar[0] <> $codigo_centro_acopio){
				$instruccion_insert = "
				INSERT INTO vical.centros_de_acopio (CODIGO_CENTRO_ACOPIO,NOMBRE_CENTRO_ACOPIO,CODIGO_RECOLECTOR,DIRECCION,DEPARTAMENTO,TELEFONO)
				VALUES ('$codigo_centro_acopio','$nombre_centro_acopio','$codigo_recolector','$direccion','$departamento','$telefono')";
				$registrar_centro_acopio = mysql_query($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en la registrar_centro_acopio!! </SPAN>".mysql_error());
				?>
						<h2 class="encabezado2">
							<img src="../../../imagenes/icono_informacion.png">
							<br>
							SE REGISTRO EL CENTRO DE ACOPIO EXITOSAMENTE!!
						</h2>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="marco">
							<!--------------------------------CODIGO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Codigo:</span>
								</td>
								<td align="left"><input type="text" size=4 disabled="disabled" value="<?php echo $codigo_centro_acopio;?>"></td>
							</tr>
							<!--------------------------------RECOLECOR---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Nombre del Centro de Acopio:</span></td>
								<td align="left"><input type="text" size=37 disabled="disabled" value="<?php echo $nombre_centro_acopio;?>"></td>
							</tr>
							<!--------------------------------RECOLECOR---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Encargado:</span></td>
								<td align="left"><input type="text" size=37 disabled="disabled" value="<?php echo $nombre_recolector;?>"></td>
							</tr>
							<!--------------------------------DEPARTAMENTO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Departamento:</span></td>
								<td align="left"><input type="text" size=15 disabled="disabled" value="<?php echo $departamento;?>"></td>
							</tr>
							<!--------------------------------DIRECCION---------------------------------->
							<?php
							if($direccion <> NULL){
							?>
							<tr>
								<td align="right"><span class="titulo1">Direccion:</span></td>
								<td align="left"><textarea cols=30 rows=4 disabled="disabled"><?php echo $direccion;?></textarea></td>
							</tr>
							<?php
							}
							?>
							<!--------------------------------TELEFONO---------------------------------->
							<?php
							if($telefono <> NULL){
							?>
							<tr>
								<td align="right"><span class="titulo1">Telefono:</span></td>
								<td align="left"><input type="text" size=7 disabled="disabled" value="<?php echo $telefono;?>"></td>
							</tr>
							<?php
							}
							?>
							<!------------------------------------------------------------------------>
						</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoCentroAcopio.php?departamento=dep">
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