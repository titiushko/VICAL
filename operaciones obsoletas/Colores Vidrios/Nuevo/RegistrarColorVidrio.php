<?php
include "../../../librerias/abrir_conexion.php";

//oobtener variables para realizar la consulta
$codigo_color = $_POST['codigo_color'];
$nombre_color = $_POST['nombre_color'];
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
					<h1 class="encabezado1">REGISTRO DE COLORES DE VIDRIO</h1>
				<?php
				$consulta_buscar = mysql_query("SELECT codigo_color FROM colores_vidrio WHERE codigo_color = '$codigo_color'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
				$buscar =  mysql_fetch_array($consulta_buscar);
				if($buscar[0] == $codigo_color){
				?>
						<h2 class="encabezado2">
							<img src="../../../imagenes/icono_error.png">
							<br>
							NO SE PUDO REGISTRAR EL COLOR DE VIDRIO!!
						</h2>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="alerta centro">
							<tr>
								<td align="center">
									El codigo <?php echo $codigo_color;?> del color de vidrio que quiere registrar ya ha sido asignado en otro color de vidrio.
								</td>
							</tr>
						</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoColorVidrio.php">
					</td>
				</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
				<?php
				}
				else if($buscar[0] <> $codigo_color){
				$instruccion_insert = "
				INSERT INTO colores_vidrio(CODIGO_color, NOMBRE_color)
				VALUES ('$codigo_color','$nombre_color')";
				mysql_query ($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_color!!</SPAN>".mysql_error());
				?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REGISTRO EL COLOR DE VIDRIO EXITOSAMENTE!!
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
							<td align="left"><input type="text" size=4 disabled="disabled" value="<?php echo $codigo_color;?>"></td>
						</tr>
						<!--------------------------------NOMBRE---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre Color de Vidrio:</span></td>
							<td align="left"><input type="text" size=39 disabled="disabled" value="<?php echo $nombre_color;?>"></td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
						<meta http-equiv ="refresh"		 content="3;url=frmNuevoColorVidrio.php">
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