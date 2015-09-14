<?php
include "../../../librerias/abrir_conexion.php";

//oobtener variables para realizar la consulta
$codigo_tipo = $_POST['codigo_tipo'];
$nombre_tipo = $_POST['nombre_tipo'];
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
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
					<h1 class="encabezado1">REGISTRO DE TIPOS DE VIDRIO</h1>
				<?php
				$consulta_buscar = mysql_query("SELECT codigo_tipo FROM tipos_vidrio WHERE codigo_tipo = '$codigo_tipo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
				$buscar =  mysql_fetch_array($consulta_buscar);
				if($buscar[0] == $codigo_tipo){
				?>
						<h2 class="encabezado2">
							<img src="../../../imagenes/icono_error.png">
							<br>
							NO SE PUDO REGISTRAR EL TIPO DE VIDRIO!!
						</h2>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="alerta centro">
							<tr>
								<td align="center">
									El codigo <?php echo $codigo_tipo;?> del tipo de vidrio que quiere registrar ya ha sido asignado en otro tipo de vidrio.
								</td>
							</tr>
						</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoTipoVidrio.php">
					</td>
				</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
				<?php
				}
				else if($buscar[0] <> $codigo_tipo){
				$instruccion_insert = "
				INSERT INTO tipos_vidrio(CODIGO_tipo, NOMBRE_tipo)
				VALUES ('$codigo_tipo','$nombre_tipo')";
				mysql_query ($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_tipo!!</SPAN>".mysql_error());
				?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REGISTRO EL TIPO DE VIDRIO EXITOSAMENTE!!
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
							<td align="left"><input type="text" size=4 disabled="disabled" value="<?php echo $codigo_tipo;?>"></td>
						</tr>
						<!--------------------------------NOMBRE---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre Tipo de Vidrio:</span></td>
							<td align="left"><input type="text" size=39 disabled="disabled" value="<?php echo $nombre_tipo;?>"></td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
						<meta http-equiv ="refresh"		 content="3;url=frmNuevoTipoVidrio.php">
					</td>
				</tr>
				<?php
				}
				?>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2010</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>