<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";

if (!isset($_SESSION["cuenta_compras"])){
	$_SESSION["cuenta_compras"] = 1;
}

$nombre_recolector = $_REQUEST['valor_nombre_recolector'];
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico" />
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<link rel="stylesheet" 			 href="../../../librerias/calendario.css" type="text/css" media="screen"></link>
		<script type="text/javascript" 	 src="../../../librerias/calendario.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
		<script type="text/javascript">
			//obtener el precio unitario
			<?php
			$consulta_precio = mysql_query("SELECT precio_unitario FROM precio", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_precio!!</SPAN>".mysql_error());
			$precio = mysql_fetch_assoc($consulta_precio);
			?>
			var precio = <?php echo $precio['precio_unitario'];?>;
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
					<table class="marco"><tr><td>
					<form name="formulario" action="RegistrarCompra.php" method="POST" onSubmit="return validarNuevaCompra(this,7);">
						<table>
						<!--------------------------------FECHA/No---------------------------------->
							<tr>
								<td align="right"><span class="obligatorio">*</span><br><span class="titulo1">Fecha:</span></td>
								<td align="left">						
									<input name="fecha" id="id1" class="requerido" type="text" size=7 readonly value="<?php echo date("Y-m-d");?>" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
									<img src="../../../imagenes/icono_calendario.png" onMouseOver="toolTip('Calendario',this)" onClick="displayCalendar(document.formulario.fecha,'yyyy-mm-dd',this),borrarMensaje(7), elementosVacios(8);" class="manita">
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
								<td align="right">
									<span class="titulo1">No:</span>
								</td>
								<td align="left">
									<input name="factura" id="id2" class="requerido" type="text" maxLength=4 size=1 onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------RECOLECOR---------------------------------->
							<tr>
								<td></td>										
								<td align="right" class="titulo1">
									<img src="../../../imagenes/icono_agregar.png" width="20%" height="20%" align="top" onMouseOver="toolTip('Nuevo Recolector',this)" onClick="redireccionar('../../Recolectores/Nuevo/frmNuevoRecolector.php')" class="manita">
									Recolector:
								</td>
								<td align="left">
								<?php
								if($nombre_recolector == 'nueva_compra'){
								?>
									<select name="nombre_recolector" id="id3" class="requerido lista nombre" size="1" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
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
								<?php
								}
								else{
								?>
									<input name="nombre_recolector" id="id3" class="requerido lista nombre" readonly value="<?php echo $nombre_recolector;?>" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
								<?php
								}
								?>
								</td>
								<td align="right" class="titulo1">Codigo:</td>
								<td align="left">
								<?php
								if($nombre_recolector == 'nueva_compra'){
								?>
									<select name="codigo_recolector" id="id4" class="requerido lista codigo" size="1" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
										<option selected value=""></option>
										<?php
										$instruccion_recolector = "SELECT codigo_recolector FROM recolectores ORDER BY codigo_recolector ASC";
										$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
										while($codigos_recolectores = mysql_fetch_array($consulta_recolector)){
											echo "<option onClick=\"ponerNomRecolector(this.form);\">".$codigos_recolectores[0]."</option>";
										}
										?>
									</select>
									<span class="obligatorio">*</span>
								<?php
								}
								else{
									$instruccion_recolector = "SELECT codigo_recolector FROM recolectores ORDER BY codigo_recolector ASC";
									$consulta_recolector = mysql_query($instruccion_recolector,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_recolector!!</SPAN>".mysql_error());
									$codigos_recolectores = mysql_fetch_array($consulta_recolector);
								?>
									<input name="codigo_recolector" id="id4" class="requerido lista codigo" readonly value="<?php echo $codigos_recolectores['codigo_recolector'];?>" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
								<?php
								$_SESSION["cuenta_compras"] = $_SESSION["cuenta_compras"] + 1;
								}
								?>
								</td>
								<td></td>
							</tr>
							<!--------------------------------PROVEEDOR---------------------------------->
							<tr>
								<td></td>										
								<td align="right" class="titulo1">
									<img src="../../../imagenes/icono_agregar.png" width="20%" height="20%" align="top" onMouseOver="toolTip('Nuevo Proveedor',this)" onClick="redireccionar('../../Proveedores/Nuevo/frmNuevoProveedor.php')" class="manita">&nbsp;
									Proveedor:
								</td>
								<td align="left">
									<select name="nombre_proveedor" id="id5" class="requerido lista nombre" size="1" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
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
								<td align="right" class="titulo1">Codigo:</td>
								<td align="left">
									<select name="codigo_proveedor" id="id6" class="requerido lista codigo" size="1" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
										<option selected value=""></option>
										<?php
										$instruccion_proveedor = "SELECT codigo_proveedor FROM proveedores ORDER BY codigo_proveedor ASC";
										$consulta_proveedor = mysql_query($instruccion_proveedor,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_proveedor!!</SPAN>".mysql_error());
										while($codigos_proveedores = mysql_fetch_array($consulta_proveedor)){
											echo "<option onClick=\"ponerNomProveedor(this.form);\">".$codigos_proveedores[0]."</option>";
										}
										?>
									</select>
									<span class="obligatorio">*</span>
								</td>
								<td></td>
							</tr>
							<!--------------------------------SUCURSAL----------------------------------->
							<tr>
								<td></td>
								<td align="right" class="titulo1">Sucursal:</td>
								<td align="left">
									<select name="sucursal" id="id7" class="requerido lista opcion" size="1" onBlur="borrarMensaje(7), elementosVacios(8);" onClick="borrarMensaje(7), elementosVacios(8);">
										<option selected value="">.:Opciones:.</option>
										<option>VICESA</option>
										<option>VIGUA</option>
									</select>
									<span class="obligatorio">*</span>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<!--------------------------------------------------------------------------->
						</table>
						<!---->
						<table id="id8" class="requerido" align="center" border bgcolor="white" width="60%">
							<caption><h1></h1></caption>
							<thead class="titulo2">
								<tr>
									<th rowspan=2 colspan=1></th>
									<th colspan=2>VERDE</th>
									<th colspan=2>CRISTALINO</th>
									<th colspan=2>CAFE</th>
									<th colspan=2>BRONCE</th>
									<th colspan=2>REFLECTIVO</th>
									<th colspan=2>TOTAL</th><!--total por tipo de vidrio-->
								</tr>
								<tr>
									<!--VERDE-->
									<th>QQ</th>
									<th>$$</th>
									<!--CRISTALINO-->
									<th>QQ</th>
									<th>$$</th>
									<!--CAFE-->
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
									<th class="titulo2">BOTELLA</th>
									<td><input name="Vc1" class="compra" type="text" size=3 onBlur="calcularMonto(),borrarMensaje(7), elementosVacios(8);" onKeyPress="return soloNumerosFloat(event)" onClick="borrarMensaje(7), elementosVacios(8);" ></td>
									<td><input name="Vp1" type="text" size=3 readonly></td>
									<td><input name="Vc2" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp2" type="text" size=3 readonly></td>
									<td><input name="Vc3" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp3" type="text" size=3 readonly></td>
									<td><input name="Vc4" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp4" type="text" size=3 readonly></td>
									<td><input name="Vc5" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp5" type="text" size=3 readonly></td>
									<td><input name="BTo1" type="text" size=3 readonly></td><!--total por tipo de vidrio-->
									<td><input name="BTo2" type="text" size=3 readonly></td><!--total por tipo de vidrio-->
								</tr>
								<tr>
									<th class="titulo2">PLANO</th>
									<td><input name="Vc6" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp6" type="text" size=3 readonly></td>
									<td><input name="Vc7" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp7" type="text" size=3 readonly></td>
									<td><input name="Vc8" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp8" type="text" size=3 readonly></td>
									<td><input name="Vc9" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp9" type="text" size=3 readonly></td>
									<td><input name="Vc10" class="compra" type="text" size=3 onBlur="calcularMonto();" onKeyPress="return soloNumerosFloat(event)"></td>
									<td><input name="Vp10" type="text" size=3 readonly></td>
									<td><input name="PTo1" type="text" size=3 readonly></td><!--total por tipo de vidrio-->
									<td><input name="PTo2" type="text" size=3 readonly></td><!--total por tipo de vidrio-->
								</tr>
							</tbody>
						</table>
						<!---------------------------------BOTONES----------------------------------->
						<center>
							<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
							<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(7), elementosVacios(8);">
							<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
							<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroCompra.php')">
						</center>
					</form>
					</td></tr></table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<center>
						<br><span class="obligatorio">* Datos requeridos</span>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;No se pueden seleccionar fechas futuras!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el numero de factura!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;El numero de factura ya esta registrado!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el recolector!!&nbsp;&nbsp;</span></div>
						<div id="mensaje5" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el proveedor!!&nbsp;&nbsp;</span></div>
						<div id="mensaje6" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar la sucursal!!&nbsp;&nbsp;</span></div>
						<div id="mensaje7" class="oculto"><span class="alerta error">&nbsp;&nbsp;Al menos se debe de registrar un tipo y color de vidrio!!&nbsp;&nbsp;</span></div>
					</center>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>