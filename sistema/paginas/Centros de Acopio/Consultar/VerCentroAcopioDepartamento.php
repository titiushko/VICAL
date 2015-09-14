<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
$dep		= $_REQUEST['departamento'];
$direccion 	= "../Consultar/VerCentroAcopioDepartamento.php";

$departamentos = array(1=>"Ahuachapan",2=>"Santa Ana",3=>"Sonsonate",4=>"Usulutan",5=>"San Miguel",6=>"Morazan",7=>"La Union",8=>"La Libertad",9=>"Chalatenango",10=>"Cuscatlan",11=>"San Salvador",12=>"La Paz",13=>"Cabañas",14=>"San Vicente");
$DEPARTAMENTOS = array(1=>"AHUACHAPAN",2=>"SANTA ANA",3=>"SONSONATE",4=>"USULUTAN",5=>"SAN MIGUEL",6=>"MORAZAN",7=>"LA UNION",8=>"LA LIBERTAD",9=>"CHALATENANGO",10=>"CUSCATLAN",11=>"SAN SALVADOR",12=>"LA PAZ",13=>"CABA&Ntilde;AS",14=>"SAN VICENTE");

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
WHERE centros_de_acopio.departamento = '$departamentos[$dep]'
AND recolectores.codigo_recolector = centros_de_acopio.codigo_recolector";
$consulta_centro_de_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!!</SPAN>".mysql_error());
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">CONSULTAR CENTROS DE ACOPIO EN <?php echo $DEPARTAMENTOS[$dep];?></h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
				<?php
				$cantidad_centros_de_acopio = mysql_query("SELECT count(codigo_centro_acopio) AS cantidad FROM centros_de_acopio WHERE centros_de_acopio.departamento = '$departamentos[$dep]'", $conexion) or die ("<SPAN CLASS='error'>Fallo en cantidad_centros_de_acopio!!</SPAN>".mysql_error());
				$cantidad = mysql_fetch_array($cantidad_centros_de_acopio);
				if($cantidad[0] <> 0){
				
				while($centros_de_acopio = mysql_fetch_assoc($consulta_centro_de_acopio)){ ?>
					<table class="marco centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["codigo_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Nombre:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Encargado:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_recolector"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["direccion"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1"><b>Direccion:</b>
							<td class="subtitulo1"><?php echo $centros_de_acopio["direccion"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Departamento:</td>
							<td><?php echo $centros_de_acopio["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["telefono"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Telefono:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["telefono"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>					
					<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
					<img src="../../../imagenes/icono_modificar.png" align="top" onMouseOver="toolTip('Modificar Centro de Acopio',this);" <?php echo "onClick=\"redireccionar('../Modificar/frmModificarCentroAcopio.php?modificar_centro_de_acopio=".$centros_de_acopio["codigo_centro_acopio"]."&direccion=$direccion');\"";?> class="manita">
					<img src="../../../imagenes/icono_eliminar.png" align="top" onMouseOver="toolTip('Eliminar Centro de Acopio',this);" <?php echo "onClick=\"redireccionar('../Eliminar/frmEliminarCentroAcopio.php?eliminar_centro_de_acopio=".$centros_de_acopio["codigo_centro_acopio"]."&direccion=$direccion');\"";?> class="manita">
					<br><br>
					<?php } if($_SESSION["tipo_usuario"] == "3"){echo "<br>";}
				}
				
				} else{ ?>
				<h2 align="center" class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO CONSULTAR LOS CENTROS DE ACOPIO EN <?php echo $DEPARTAMENTOS[$dep];?>!!</h2>
				<table align="center" class="alerta error centro">
					<tr>
						<td align="center" colspan="3">
							No hay centros de acopio en el departamento de <?php echo $departamentos[$dep];?> registrados en el sistema.<br><br>
							<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
							Desea realizar el Registro de un Nuevo Centro de Acopio en el departamento de <?php echo $departamentos[$dep];?>?.<br>
							<img src="../../../imagenes/icono_agregar.png" align="top" onClick="redireccionar('../Nuevo/frmNuevoCentroAcopio.php?departamento=<?php echo $departamentos[$dep];?>')" onMouseOver="toolTip('Agregar un nuevo Centro de Acopio',this)" class="manita">
							<?php } ?>
							<img src="../../../imagenes/icono_cancelar.png" align="top" onClick="redireccionar('../../../interfaz/frame_contenido.php')" onMouseOver="toolTip('Cancelra, volver al Inicio',this)" class="manita">
						</td>
					</tr>
				</table>
				<?php } ?>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('frmConsultarCentroAcopio.php');" class="manita">
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>