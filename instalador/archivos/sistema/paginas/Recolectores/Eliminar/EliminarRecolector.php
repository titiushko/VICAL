<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_recolector = $_REQUEST['codigo'];

$instruccion_select = "
SELECT
recolectores.codigo_recolector AS recolectores_codigo_recolector,
recolectores.nombre_recolector,
recolectores.dui_recolector,
recolectores.nit_recolector,
recolectores.direccion_recolector,
recolectores.telefono_recolector
FROM recolectores
WHERE recolectores.codigo_recolector = '$codigo_recolector'";
$consulta_recolector = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_recolector!! </SPAN>".mysql_error());
$recolectores = mysql_fetch_array($consulta_recolector);

$instruccion_select = "
SELECT
COUNT(centros_de_acopio.codigo_centro_acopio) AS cantidad_centros_acopio,
centros_de_acopio.codigo_recolector AS centros_de_acopio_codigo_recolector
FROM centros_de_acopio
JOIN recolectores
WHERE recolectores.codigo_recolector = '$codigo_recolector'
AND centros_de_acopio.codigo_recolector = recolectores.codigo_recolector";
$consulta_centro_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_acopio!! </SPAN>".mysql_error());
$centros_de_acopio = mysql_fetch_array($consulta_centro_acopio);

$instruccion_select = "
SELECT
recolectores.codigo_recolector,
facturas.codigo_recolector AS facturas_codigo_recolector
FROM recolectores, facturas
WHERE recolectores.codigo_recolector = '$codigo_recolector'
AND facturas.codigo_recolector = recolectores.codigo_recolector";
$consulta_factura = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!! </SPAN>".mysql_error());
$facturas = mysql_fetch_array($consulta_factura);

if($centros_de_acopio["cantidad_centros_acopio"] > 1) {$mensaje1 = "&nbsp;centros de acopio."; $mensaje2 = "estos centros de acopio?.";}
else {$mensaje1 = "&nbsp;centro de acopio."; $mensaje2 = "este centro de acopio?.";}

$error1 = "No se puede eliminar a ".$recolectores["nombre_recolector"]." porque: ";
$error2 = "hay compras de vidrio registradas que a realizado este recolector.";
$error3 = "es encargado de ".$centros_de_acopio["cantidad_centros_acopio"].$mensaje1;
$error4 = "Si elimina a ".$recolectores["nombre_recolector"]." tenga en cuenta que tambi&eacute;n se perder&aacute; la informaci&oacute;n de compras de vidrio que a realizado este recolector.";
$error5 = "O prefiere eliminar a ".$recolectores["nombre_recolector"]." y trasnferir a otro recolector ".$mensaje2;
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript">
		function borrarMensaje(){
			var elemento = document.getElementById('mensaje'); elemento.className = "oculto";
		}
		function ValidarListaRecolector(F){
			borrarMensaje();
			if (F.nuevo_recolector.selectedIndex == 0){
				var elemento = document.getElementById('mensaje'); elemento.className = "visto";
				return false;
			}
			return true;
		}
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR RECOLECTOR</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			if( $recolectores['recolectores_codigo_recolector'] == $facturas['facturas_codigo_recolector'] && $recolectores['recolectores_codigo_recolector'] == $centros_de_acopio['centros_de_acopio_codigo_recolector'] ){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO ELIMINAR EL RECOLECTOR!!</h2>
					<form name="borrar_recolector" <?php echo "action=\"CargarEliminarRecolector.php?codigo=$codigo_recolector&tipo1=1&tipo2=2\"";?> method="post" enctype="multipart/form-data" onSubmit="return ValidarListaRecolectores(this);">
					<table align="center" class="alerta error centro">
						<tr>
							<td>
								<?php echo $error1.$error2." Y tambien ".$error3."<br><br>".$error4."<br><br>".$error5;?>
								<div align="center">
								Transferir a:
								<select name="nuevo_recolector" class="lista nombre" size="1" onClick="borrarMensaje();" onBlur="borrarMensaje();">
									<option selected value="">.:Opciones:.</option>
									<?php
									$instruccion = "SELECT codigo_recolector, nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta)){
										if($opciones[0] == $codigo_recolector)
											echo "<option class=\"oculto\">".$opciones[1]."</option>";
										else
											echo "<option value=\"$opciones[0]\">".$opciones[1]."</option>";
									}
									?>
								</select>
								</div>
							</td>
						</tr>
					</table>
					<input name="Continuar" type="submit" value="Continuar" onMouseOver="toolTip('Continuar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Regresar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/VerRecolector.php?valor=$codigo_recolector')\"";?>>
					</form>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
					<div id="mensaje" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el recolector para hacer trasnferencia!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			}
			else if( $recolectores['recolectores_codigo_recolector'] == $facturas['facturas_codigo_recolector'] ){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO ELIMINAR EL RECOLECTOR!!</h2>
					<form name="borrar_recolector" <?php echo "action=\"CargarEliminarRecolector.php?codigo=$codigo_recolector&tipo1=1&tipo2=0\"";?> method="post" enctype="multipart/form-data">
					<table align="center" class="alerta error centro">
						<tr><td><?php echo $error1.$error2."<br><br>".$error4;?></td></tr>
					</table>
					<input name="nuevo_recolector" type="text" class="oculto" value="falso">
					<input name="Continuar" type="submit" value="Continuar" onMouseOver="toolTip('Continuar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Regresar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/VerRecolector.php?valor=$codigo_recolector')\"";?>>
					</form>
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			}
			else if( $recolectores['recolectores_codigo_recolector'] == $centros_de_acopio['centros_de_acopio_codigo_recolector'] ){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO ELIMINAR EL RECOLECTOR!!</h2>
					<form name="borrar_recolector" <?php echo "action=\"CargarEliminarRecolector.php?codigo=$codigo_recolector&tipo1=1&tipo2=2\"";?> method="post" enctype="multipart/form-data" onSubmit="return ValidarListaRecolectores(this);">
					<table align="center" class="alerta error centro">
						<tr>
							<td>
								<?php echo $error1.$error3."<br><br>".$error5;?>
								<div align="center">
								Transferir a:
								<select name="nuevo_recolector" class="lista nombre" size="1" onClick="borrarMensaje();" onBlur="borrarMensaje();">
									<option selected value="">.:Opciones:.</option>
									<?php
									$instruccion = "SELECT codigo_recolector, nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta)){
										if($opciones[0] == $codigo_recolector)
											echo "<option class=\"oculto\">".$opciones[1]."</option>";
										else
											echo "<option value=\"$opciones[0]\">".$opciones[1]."</option>";
									}
									?>
								</select>
								</div>
							</td>
						</tr>
					</table>
					<input name="Continuar" type="submit" value="Continuar" onMouseOver="toolTip('Continuar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Regresar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/VerRecolector.php?valor=$codigo_recolector')\"";?>>
					</form>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
					<div id="mensaje" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el recolector para hacer trasnferencia!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			}
			else{
			//eliminar el registro de la tabla recolectores con el codigo del recolector que se va eliminar
			$instruccion_delete = "DELETE FROM recolectores WHERE codigo_recolector = '$codigo_recolector'";
			mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_recolector!! </SPAN>".mysql_error());
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_informacion.png"><br>SE ELIMINO EL RECOLECTOR EXITOSAMENTE!!</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<!------------------------------------------------------------------------>						
						<tr>
							<td align="right" class="titulo3">Codigo:</td>
							<td class="subtitulo1"><?php echo $recolectores["recolectores_codigo_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo3">Nombre:</td>
							<td class="subtitulo1"><?php echo $recolectores["nombre_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo3">DUI:</td>
							<td class="subtitulo1"><?php echo $recolectores["dui_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo3">NIT:</td>
							<td class="subtitulo1"><?php echo $recolectores["nit_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<?php
						if ($recolectores["direccion_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Direccion:</td>
							<td class="subtitulo1"><?php echo $recolectores["direccion_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<?php
						}
						if ($recolectores["telefono_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $recolectores["telefono_recolector"]; ?></td>
						</tr>
						<?php
						}
						?>
						<!------------------------------------------------------------------------>
					</table>
				</td>
			</tr>
			<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarRecolector.php">
			<?php
			}
			?>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>