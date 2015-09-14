<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

if (!isset($_SESSION["cuenta_compras"])){
	$_SESSION["cuenta_compras"] = 1;
}

$nombre_recolector = $_REQUEST['valor_nombre_recolector'];

date_default_timezone_set('America/El_Salvador');
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<link rel="stylesheet" 			 href="../../../librerias/calendario.css" type="text/css" media="screen"></link>
		<script type="text/javascript" 	 src="../../../librerias/calendario.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
		<script type="text/javascript">
			//vector con los precios unitarios
			var precios = new Array;
			<?php
			$consulta = mysql_query("SELECT precio_unitario FROM precios ORDER BY precio_unitario ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en precios!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "precios[$contador] = ".$opciones[0].";";
				$contador++;
			}
			?>
			//precio default
			var precio = precios[0];
			//vector con las facturas
			var facturas = new Array;
			<?php
			$consulta = mysql_query("SELECT codigo_factura FROM facturas ORDER BY codigo_factura ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en facturas!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "facturas[$contador] = '".$opciones[0]."';";
				$contador++;
			}
			?>
			//vector con los recolectores
			var recolectores = new Array;
			<?php
			$consulta = mysql_query("SELECT codigo_recolector, nombre_recolector FROM recolectores ORDER BY codigo_recolector ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en recolectores!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "recolectores[$contador] = new Array ('".$opciones[0]."','".$opciones[1]."');";
				$contador++;
			}
			?>
			//vectores con los proveedores
			var proveedores = new Array;
			<?php
			$consulta = mysql_query("SELECT codigo_proveedor, nombre_proveedor FROM proveedores ORDER BY codigo_proveedor ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en proveedores!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "proveedores[$contador] = new Array ('".$opciones[0]."','".$opciones[1]."');";
				$contador++;
			}
			?>
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE COMPRAS</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table class="marco">
					<form name="formulario" action="RegistrarCompra.php" method="POST" onSubmit="return validarNuevaCompra(this,9);">
						<!--------------------------------FECHA/No---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Fecha:</span></td>
							<td align="left">						
								<input name="fecha" id="id1" class="requerido" type="text" size=7 readonly value="<?php echo date("Y-m-d");?>" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
								<img src="../../../imagenes/icono_calendario.png" onMouseOver="toolTip('Calendario',this)" onClick="displayCalendar(document.formulario.fecha,'yyyy-mm-dd',this),borrarMensaje(9), elementosVacios(10);" class="manita">
								<span class="obligatorio">*</span>
							</td>
							<td>&nbsp;</td>
							<td align="right" colspan="2">
								<span class="titulo1">No:</span>
							</td>
							<td align="left">
								<input name="factura" id="id2" class="requerido" type="text" maxLength=4 size=1 onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
								<span class="obligatorio">*</span>
							</td>
						</tr>
						<!--------------------------------RECOLECOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">
								<img src="../../../imagenes/icono_agregar.png" width="20" height="20" align="top" onMouseOver="toolTip('Nuevo Recolector',this)" onClick="redireccionar('../../Recolectores/Nuevo/frmNuevoRecolector.php')" class="manita">
								Recolector:
							</td>
							<?php
							if($nombre_recolector == 'nueva_compra'){
							?>
							<td align="left">
								<select name="nombre_recolector" id="id3" class="requerido lista nombre" size="1" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
									<option selected value="">.:Recolectores:.</option>
									<?php
									$instruccion_recolector = "SELECT nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
									$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
									while($nombres_recolectores = mysql_fetch_array($consulta_recolector)){
										echo "<option onClick=\"ponerCodRecolector(this.form);\">".$nombres_recolectores[0]."</option>";												
									}
									?>
								</select>
								<span class="obligatorio">*</span>
							</td>
							<td align="right" class="titulo1">
								Codigo:
							</td>
							<td align="left">
								<input name="codigo_recolector" id="id4" class="requerido lista codigo" readonly onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
							</td>
							<?php
							}
							else{
							$instruccion_recolector = "SELECT codigo_recolector FROM recolectores WHERE nombre_recolector = '$nombre_recolector'";
							$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
							$codigo_recolector = mysql_fetch_array($consulta_recolector);
							?>
							<td align="left">
								<input name="nombre_recolector" id="id3" class="requerido lista nombre" readonly value="<?php echo $nombre_recolector;?>" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
							</td>
							<td align="right" class="titulo1">
								Codigo:
							</td>
							<td align="left">
								<input name="codigo_recolector" id="id4" class="requerido lista codigo" readonly value="<?php echo $codigo_recolector[0];?>" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
							</td>
							<?php
							}
							?>
							<td>&nbsp;</td>
						</tr>
						<!--------------------------------PROVEEDOR---------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">
								<img src="../../../imagenes/icono_agregar.png" width="20" height="20" align="top" onMouseOver="toolTip('Nuevo proveedor',this)" onClick="redireccionar('../../proveedores/Nuevo/frmNuevoproveedor.php')" class="manita">
								Proveedor:
							</td>
							<td align="left">
								<select name="nombre_proveedor" id="id5" class="requerido lista nombre" size="1" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
									<option selected value="">.:Proveedores:.</option>
									<?php
									$instruccion_proveedor = "SELECT nombre_proveedor FROM proveedores ORDER BY nombre_proveedor ASC";
									$consulta_proveedor = mysql_query($instruccion_proveedor,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_proveedor!!</SPAN>".mysql_error());
									while($nombres_proveedores = mysql_fetch_array($consulta_proveedor)){
										echo "<option onClick=\"ponerCodProveedor(this.form);\">".$nombres_proveedores[0]."</option>";												
									}
									?>
								</select>
								<span class="obligatorio">*</span>
							</td>
							<td align="right" class="titulo1">
								Codigo:
							</td>
							<td align="left">
								<input name="codigo_proveedor" id="id6" class="requerido lista codigo" readonly onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
							</td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------PRECIO------------------------------------>
						<tr>
							<td>&nbsp;</td>
							<td align="right" class="titulo1">
								Precio:
							</td>
							<td align="left">
								<select name="precio_compra" class="lista opcion" size="1" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
									<?php
									$consulta_precio = mysql_query("SELECT codigo_precio, precio_unitario FROM precios ORDER BY precio_unitario ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_precio!!</SPAN>".mysql_error());
									$contador = 0;
									while($precios = mysql_fetch_array($consulta_precio)){
										echo "<option value=\"$precios[1]\" onClick=\"cambiarPrecio($contador);\">$".number_format($precios[1],2,'.',',')."</option>";
										$contador++;
									}
									?>
								</select>
							</td>
							<td colspan="3">&nbsp;</td>
						</tr>
						<!---------------------------------VIDRIO------------------------------------>
						<tr>
							<td colspan="6">
							<table id="id7" class="requerido" align="center" border bgcolor="white" width="60%">
								<thead id="id_b0" class="titulo2">
									<tr>
										<th rowspan=2></th>
										<th colspan=2>CLARO</th>
										<th colspan=2>VERDE</th>
										<th colspan=2>CAFE</th>
										<th colspan=2>TOTAL</th><!--total por tipo de vidrio-->
									</tr>
									<tr>
										<!--CLARO-->
										<th>QQ</th>
										<th>$$</th>
										<!--VERDE-->
										<th>QQ</th>
										<th>$$</th>
										<!--CAFE-->
										<th>QQ</th>
										<th>$$</th>
										<!--TOTAL-->
										<th>QQ</th>
										<th>$$</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th id="id_b1" class="titulo2">BOTELLA</th>
										<td align="center"><input id="id_b2" name="Bc1" class="compra fondo4" 	  type="text" size=3 onBlur="calcularMonto(), borrarMensaje(9), elementosVacios(10);" onKeyPress="return soloNumerosFloat(event)" onClick="borrarMensaje(9), elementosVacios(10);"><input name="Vc1" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_b3" name="Bp1" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="Vp1" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_b4" name="Bc2" class="compra fondo4" 	  type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"><input name="Vc2" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_b5" name="Bp2" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="Vp2" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_b6" name="Bc3" class="compra fondo4" 	  type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"><input name="Vc3" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_b7" name="Bp3" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="Vp3" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_b8" name="TBc" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="BTc" class="oculto" type="text" size=3></td><!--total cantidad botella-->
										<td align="center"><input id="id_b9" name="TBp" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="BTp" class="oculto" type="text" size=3></td><!--total precio botella-->
									</tr>
								</tbody>
							</table>
							</td>
						</tr>						
						<tr>
							<td colspan="6">
							<table id="id8" class="requerido" align="center" border bgcolor="white" width="60%">
								<thead id="id_p0" class="titulo2">
									<tr>
										<th rowspan=2></th>
										<th colspan=2>CLARO</th>
										<th colspan=2>BRONCE</th>
										<th colspan=2>REFLECTIVO</th>
										<th colspan=2>TOTAL</th><!--total por tipo de vidrio-->
									</tr>
									<tr>
										<!--CLARO-->
										<th>QQ</th>
										<th>$$</th>
										<!--BRONCE-->
										<th>QQ</th>
										<th>$$</th>
										<!--REFLECTIVO-->
										<th>QQ</th>
										<th>$$</th>
										<!--TOTAL-->
										<th>QQ</th>
										<th>$$</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th id="id_p1" class="titulo2">PLANO</th>
										<td align="center"><input id="id_p2" name="Pc1" class="compra fondo4" 	  type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"><input name="Vc4" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_p3" name="Pp1" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="Vp4" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_p4" name="Pc2" class="compra fondo4" 	  type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"><input name="Vc5" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_p5" name="Pp2" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="Vp5" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_p6" name="Pc3" class="compra fondo4" 	  type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"><input name="Vc6" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_p7" name="Pp3" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="Vp6" class="oculto" type="text" size=3></td>
										<td align="center"><input id="id_p8" name="TPc" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="PTc" class="oculto" type="text" size=3></td><!--total cantidad plano-->
										<td align="center"><input id="id_p9" name="TPp" class="subtitulo4 fondo4" type="text" size=3 disabled="disabled"><input name="PTp" class="oculto" type="text" size=3></td><!--total precio plano-->
									</tr>
								</tbody>
							</table>
							</td>
						</tr>
						<!-----------------------------SUCURSAL Y CA--------------------------------->
						<tr>
							<td>&nbsp;</td>
							<td align="center" class="titulo1" colspan="4">
								Sucursal:
								<select name="sucursal" id="id9" class="requerido lista opcion" size="1" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
									<option selected value="">.:Opciones:.</option>
									<option>VICESA</option>
									<option>VIGUA</option>
								</select>
								<span class="obligatorio">*</span>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img src="../../../imagenes/icono_agregar.png" width="20" height="20" align="top" onMouseOver="toolTip('Nuevo Centro de Acopio',this)" onClick="redireccionar('../../Centros de Acopio/Nuevo/frmNuevoCentroAcopio.php?departamento=dep')" class="manita">
								Centro de Acopio:
								<select name="codigo_centro_acopio" id="id10" class="requerido lista" style="width: 160px;" size="1" onBlur="borrarMensaje(9), elementosVacios(10);" onClick="borrarMensaje(9), elementosVacios(10);">
									<option selected value="">.:Opciones:.</option>
									<?php
									$consulta_centro_de_acopio = mysql_query("SELECT codigo_centro_acopio, nombre_centro_acopio FROM centros_de_acopio ORDER BY nombre_centro_acopio ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_centro_de_acopio!!</SPAN>".mysql_error());
									while($centros_de_acopios = mysql_fetch_array($consulta_centro_de_acopio)){
										echo "<option value=\"$centros_de_acopios[0]\">".$centros_de_acopios[1]."</option>";
									}
									?>
								</select>
								<span class="obligatorio">*</span>
							</td>
							<td>&nbsp;</td>
						</tr>
						<!---------------------------------BOTONES----------------------------------->
						<tr>
							<td align="center" colspan="6">
								<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
								<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(9), elementosVacios(10);">
								<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
								<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroCompra.php')">
							</td>
						</tr>
					</form>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
						<span class="obligatorio">* Datos requeridos</span><br>
						<div id="mensaje1" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;No se pueden seleccionar fechas futuras!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta el numero de factura!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Faltan digitos en el numero de factura!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;El numero de factura ya esta registrado!!&nbsp;&nbsp;</span></div>
						<div id="mensaje5" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el recolector!!&nbsp;&nbsp;</span></div>
						<div id="mensaje6" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el proveedor!!&nbsp;&nbsp;</span></div>
						<div id="mensaje7" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Al menos se debe de registrar un tipo y color de vidrio!!&nbsp;&nbsp;</span></div>
						<div id="mensaje8" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar la sucursal!!&nbsp;&nbsp;</span></div>
						<div id="mensaje9" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el centro de acopio!!&nbsp;&nbsp;</span></div>
					</center>
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