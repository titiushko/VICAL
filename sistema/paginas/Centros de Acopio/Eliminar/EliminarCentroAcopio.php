<?php 
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
$direccion			  = $_REQUEST['direccion'];
$codigo_centro_acopio = $_REQUEST['codigo'];

$instruccion_select = "
SELECT
centros_de_acopio.codigo_centro_acopio AS centros_de_acopio_codigo_centro_acopio,
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

$instruccion_select = "
SELECT
centros_de_acopio.codigo_centro_acopio,
facturas.codigo_centro_acopio AS facturas_codigo_centro_acopio
FROM centros_de_acopio, facturas
WHERE centros_de_acopio.codigo_centro_acopio = '$codigo_centro_acopio'
AND facturas.codigo_centro_acopio = centros_de_acopio.codigo_centro_acopio";
$consulta_factura = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!! </SPAN>".mysql_error());
$facturas = mysql_fetch_array($consulta_factura);
?>
<!----------------------------------------------------------------------------------------------------------------->
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript">
		var contador = 0;
		function borrarMensaje(){
			var elemento;
			elemento = document.getElementById('mensaje1'); elemento.className = "oculto";
			elemento = document.getElementById('mensaje2'); elemento.className = "oculto";
		}
		function ValidarListaCentrosAcopio(F){
			var elemento;
			borrarMensaje();
			contador++;
			if (F.cheque_eliminar_compras.checked){
				if (contador == 3){
					elemento = document.getElementById('mensaje1'); elemento.className = "visto";
					contador = 0;
					return false;
				}
				if (F.nuevo_centro_acopio.selectedIndex == 0){
					elemento = document.getElementById('mensaje2'); elemento.className = "visto";
					return false;
				}
			}
			F.cheque_eliminar_compras.checked = true;
			return true;
		}
		function HabilitarListaCentrosAcopio(F){
			var elemento;
			if (F.checked){
				elemento = document.getElementById('mostrar'); elemento.className = "visto";
				F.value = "actualizar";
				//F.cheque_eliminar_compras.checked = false;
			}
			else{
				elemento = document.getElementById('mostrar'); elemento.className = "oculto";
				F.value = "eliminar";
				//F.cheque_eliminar_compras.checked = true;
			}
		}
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR CENTRO DE ACOPIO</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			if( $centros_de_acopio['centros_de_acopio_codigo_centro_acopio'] == $facturas['facturas_codigo_centro_acopio'] ){
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_error.png">
						<br>
						NO SE PUDO ELIMINAR EL CENTRO DE ACOPIO!!
					</h2>
					<form name="borrar_centro_de_acopio" <?php echo "action=\"CargarEliminarCentroAcopio.php?codigo=$codigo_centro_acopio\"";?> method="post" onSubmit="return ValidarListaCentrosAcopio(this);" enctype="multipart/form-data">
					<table align="center" class="alerta error centro">
						<tr>
							<td>
								No se puede eliminar a <?php echo $centros_de_acopio["nombre_centro_acopio"];?> 
								porque hay compras de vidrio registradas en este centro de acopio.
								<br>
								Si elimina a <?php echo $centros_de_acopio["nombre_centro_acopio"];?> 
								tenga en cuenta que tambi&eacute;n se perder&aacute; la informaci&oacute;n de compras de vidrio realizadas a este centro de acopio.
								<br><br>
								O prefiere eliminar a el centro de acopio y trasladar las compras registradas en <?php echo $centros_de_acopio["nombre_centro_acopio"];?> a otro centro de acopio?
								<br>&nbsp;&nbsp;
								<input name="cheque_eliminar_compras" type="checkbox" value="eliminar" onClick="HabilitarListaCentrosAcopio(this),borrarMensaje();" onBlur="borrarMensaje();">
								<span id="mostrar" class="oculto">
								Trasladar a:
								<select name="nuevo_centro_acopio" class="lista nombre" size="1" onClick="borrarMensaje();" onBlur="borrarMensaje();">
									<option selected value="">.:Opciones:.</option>
									<?php
									$consulta_centro_de_acopio = mysql_query("SELECT codigo_centro_acopio, nombre_centro_acopio FROM centros_de_acopio ORDER BY nombre_centro_acopio ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
									while($centros_de_acopios = mysql_fetch_array($consulta_centro_de_acopio)){
										if($centros_de_acopios[0] == $codigo_centro_acopio)
											echo "<option class=\"oculto\">".$centros_de_acopios[1]."</option>";
										else
											echo "<option value=\"$centros_de_acopios[0]\">".$centros_de_acopios[1]."</option>";
									}
									?>
								</select>
								</span>
							</td>
						</tr>
					</table>
					<input name="Continuar" type="submit" value="Continuar" onMouseOver="toolTip('Continuar',this)" class="boton aceptar">
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
					</form>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Si no desea hacer el traslado desmarque el cheque!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el centro de acopio para trasladar las compras!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
			<?php
			}
			else{
			?>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->			
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL CENTRO DE ACOPIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			$instruccion_delete = "DELETE FROM centros_de_acopio WHERE codigo_centro_acopio = '$codigo_centro_acopio'";
			$eliminar_centro_de_acopio = mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_centro_de_acopio!! </SPAN>".mysql_error());			
			?>
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Codigo:</td>
							<td class="subtitulo1"><?php echo $codigo_centro_acopio;?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Nombre:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_centro_acopio"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo3">Encargado:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["nombre_recolector"];?></td>
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
							<td align="right" class="titulo3">Departamento:</td>
							<td><?php echo $centros_de_acopio["departamento"];?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<?php
						if ($centros_de_acopio["telefono"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["telefono"];?></td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
				</td>
			</tr>
			<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarCentroAcopio.php">
			<?php
			}
			?>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>