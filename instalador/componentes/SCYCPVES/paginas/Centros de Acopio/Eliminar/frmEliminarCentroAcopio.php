<?php 
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$codigo_centro_acopio = $_REQUEST['eliminar_centro_de_acopio'];
$direccion			= $_REQUEST['direccion'];

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
WHERE centros_de_acopio.codigo_centro_acopio = '$codigo_centro_acopio'
AND recolectores.codigo_recolector = centros_de_acopio.codigo_recolector";
$consulta_centro_de_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!!</SPAN>".mysql_error());
$centros_de_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);
?>
<!----------------------------------------------------------------------------------------------------------------->
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
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
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR CENTRO DE ACOPIO</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_alerta.png">
						<br>
						REALMENTE DESEA ELIMINAR EL CENTRO DE ACOPIO!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<form name="borrar_centro_de_acopio" <?php echo "action=\"EliminarCentroAcopio.php?codigo=$codigo_centro_acopio&direccion=$direccion\"";?> method="post" enctype="multipart/form-data">
					<table align="center" class="alerta error centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Codigo:</b>
							<td><?php echo $centros_de_acopio["codigo_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Nombre:</b></td>
							<td>
								<?php echo $centros_de_acopio["nombre_centro_acopio"];?>
							</td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Encargado:</b>
							<td><?php echo $centros_de_acopio["nombre_recolector"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["direccion"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Direccion:</b>
							<td><?php echo $centros_de_acopio["direccion"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right"><b>Departamento:</b>
							<td><?php echo $centros_de_acopio["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["telefono"]<>NULL){
						?>
						<tr>
							<td align="right"><b>Telefono:</b>
							<td><?php echo $centros_de_acopio["telefono"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
					<!------------------------------------------------------------------------>
					<input name="Eliminar" type="submit" value="Eliminar" onMouseOver="toolTip('Aceptar',this)" class="boton aceptar">
					<?php
					if($direccion == "../Consultar/VerCentroAcopioDepartamento.php"){
						switch($centros_de_acopio["departamento"]){
							case "Ahuachapan": $codigo_centro_acopio = 1; break;
							case "Santa Ana": $codigo_centro_acopio = 2; break;
							case "Sonsonate": $codigo_centro_acopio = 3; break;
							case "Usulutan": $codigo_centro_acopio = 4; break;
							case "San Miguel": $codigo_centro_acopio = 5; break;
							case "Morazan": $codigo_centro_acopio = 6; break;
							case "La Union": $codigo_centro_acopio = 7; break;
							case "La Libertad": $codigo_centro_acopio = 8; break;
							case "Chalatenango": $codigo_centro_acopio = 9; break;
							case "Cuscatlan": $codigo_centro_acopio = 10; break;
							case "San Salvador": $codigo_centro_acopio = 11; break;
							case "La Paz": $codigo_centro_acopio = 12; break;
							case "Caba&ntilde;as": $codigo_centro_acopio = 13; break;
							case "San Vicente": $codigo_centro_acopio = 14; break;
						}
					}
					?>
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/$direccion?departamento=$codigo_centro_acopio')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>