<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

//oobtener variables para realizar la consulta
$codigo_recolector	  =	$_POST['codigo_recolector'];	//CODIGO DEL RECOLECTOR
$nombre_recolector	  =	$_POST['nombre_recolector'];	//nombre del recolector
$dui1				  =	$_POST['dui1'];					//primer caja del dui
$dui2				  =	$_POST['dui2'];					//segunda caja del dui
$nit1				  =	$_POST['nit1'];					//primer caja del nit
$nit2				  =	$_POST['nit2'];					//segunda caja del nit
$nit3				  =	$_POST['nit3'];					//tercera caja del nit
$nit4				  =	$_POST['nit4'];					//cuarta caja del nit
$direccion_recolector =	$_POST['direccion'];			//direccion del proveedor
$telefono1			  =	$_POST['telefono1'];			//telefono caja 1
$telefono2			  =	$_POST['telefono2'];			//telefono caja 2

$dui_recolector = $dui1."-".$dui2;
$nit_recolector = $nit1."-".$nit2."-".$nit3."-".$nit4;
$telefono_recolector = $telefono1."-".$telefono2;

if($nombre_recolector == "") $nombre_recolector = NULL;
if($dui_recolector == "-") $dui_recolector = NULL;
if($nit_recolector == "---") $nit_recolector = NULL;
if($direccion_recolector == "") $direccion_recolector = NULL;
if($telefono_recolector == "-") $telefono_recolector = NULL;
?>
<HTML>
	<head>
		<title>COMVICONPRO</title>
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
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE RECOLECTORES</h1>
				<?php
				$consulta_buscar = mysql_query("SELECT codigo_recolector FROM recolectores WHERE codigo_recolector = '$codigo_recolector'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
				$buscar =  mysql_fetch_array($consulta_buscar);
				if($buscar[0] == $codigo_recolector){
				?>
						<h2 class="encabezado2">
							<img src="../../../imagenes/icono_error.png">
							<br>
							NO SE PUDO REGISTRAR EL RECOLECTOR!!
						</h2>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="alerta error centro">
							<tr>
								<td align="center">
									El codigo <?php echo $codigo_recolector;?> del recolector que quiere registrar ya ha sido asignado en otro recolector.
								</td>
							</tr>
						</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoRecolector.php">
					</td>
				</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
				<?php
				}
				else if($buscar[0] <> $codigo_recolector){
				$instruccion_insert = "
				INSERT INTO recolectores(CODIGO_RECOLECTOR,NOMBRE_RECOLECTOR,TELEFONO_RECOLECTOR,DUI_RECOLECTOR,NIT_RECOLECTOR,DIRECCION_RECOLECTOR)
				VALUES ('$codigo_recolector','$nombre_recolector','$telefono_recolector','$dui_recolector','$nit_recolector','$direccion_recolector')";
				mysql_query ($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_recolector!!</SPAN>".mysql_error());
				?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REGISTRO EL RECOLECTOR RECOLECTOR!!
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
							<td align="left"><input type="text" size=4 disabled="disabled" value="<?php echo $codigo_recolector;?>"></td>
						</tr>
						<!--------------------------------NOMBRE---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre Recolector:</span></td>
							<td align="left"><input type="text" size=39 disabled="disabled" value="<?php echo $nombre_recolector;?>"></td>
						</tr>
						<!--------------------------------DUI---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">DUI:</span></td>
							<td align="left"><input type="text" size=8 disabled="disabled" value="<?php echo $dui_recolector;?>"></td>
						</tr>
						<!--------------------------------NIT---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">NIT:</span></td>
							<td align="left"><input type="text" size=15 disabled="disabled" value="<?php echo $nit_recolector;?>"></td>
						</tr>
						<!--------------------------------DIRECCION---------------------------------->
						<?php
						if($direccion_recolector <> NULL){
						?>
						<tr>
							<td align="right"><span class="titulo1">Direccion:</span></td>
							<td align="left"><textarea cols=30 rows=4 disabled="disabled"><?php echo $direccion_recolector;?></textarea></td>
						</tr>
						<?php
						}
						?>
						<!--------------------------------TELEFONO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Telefono:</span></td>
							<td align="left"><input type="text" size=7 disabled="disabled" value="<?php echo $telefono_recolector;?>"></td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoRecolector.php">
					</td>
				</tr>
				<?php
				}
				?>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>