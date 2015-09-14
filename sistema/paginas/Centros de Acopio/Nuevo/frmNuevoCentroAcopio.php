<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
$departamento  = $_REQUEST['departamento'];
$departamentos = array("Ahuachapan","Santa Ana","Sonsonate","Usulutan","San Miguel","Morazan","La Union","La Libertad","Chalatenango","Cuscatlan","San Salvador","La Paz","Caba&ntilde;as","San Vicente");

//Obtener cantidad de datos
$consulta_centro_de_acopio = mysql_query("SELECT COUNT(codigo_centro_acopio) AS cantidad FROM centros_de_acopio", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!! </SPAN>".mysql_error());
$centro_de_acopio = mysql_fetch_array($consulta_centro_de_acopio);
$cantidad = $centro_de_acopio['cantidad'];
$cantidad++;

//Buscar y establecer codigo
$contador = 1;
while($contador <= $cantidad){
	if($contador < 10){
		$nuevo_codigo = "CA-00".$contador;
		$consulta_buscar = mysql_query("SELECT codigo_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$nuevo_codigo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
		$buscar =  mysql_fetch_array($consulta_buscar);
		if($buscar[0] <> $nuevo_codigo)	break;
	}
	else if($contador < 100){
		$nuevo_codigo = "CA-0".$contador;
		$consulta_buscar = mysql_query("SELECT codigo_centro_acopio FROM centros_de_acopio WHERE codigo_centro_acopio = '$nuevo_codigo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
		$buscar =  mysql_fetch_array($consulta_buscar);
		if($buscar[0] <> $nuevo_codigo)	break;
	}
	$contador++;
}
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
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/validaciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE CENTROS DE ACOPIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td>
					<form name="formulario" action="RegistrarCentroAcopio.php" method="POST" onSubmit="return validarNuevoCentroAcopio(this,4);">
						<table align="center" class="marco">
						<!--------------------------------CODIGO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Codigo:</span></td>
								<td align="left">
									<input name="codigo_centro_acopio" type="text" size=4 readonly value="<?php echo $nuevo_codigo;?>">
								</td>
							</tr>
							<!--------------------------------NOMBRE---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Nombre del Centro de Acopio:</span></td>
								<td align="left">						
									<input name="nombre_centro_acopio" id="id1" class="requiredo" type="text" size=39 onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(4),  elementosVacios(5);" onClick="borrarMensaje(4), elementosVacios(5);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------RECOLECOR---------------------------------->
							<tr>
								<td align="right">
									<img src="../../../imagenes/icono_agregar.png" width="10%" height="10%" align="top" onMouseOver="toolTip('Nuevo recolector',this)" onClick="redireccionar('../../recolectores/Nuevo/frmNuevorecolector.php')" class="manita">
									<span class="titulo1">Encargado:</span>
								</td>
								<td align="left">
									<select name="nombre_recolector" id="id2" class="requiredo lista nombre" size="1" onBlur="borrarMensaje(4), elementosVacios(5);" onClick="borrarMensaje(4), elementosVacios(5);">
										<option selected value="">.:Recolectores:.</option>
										<?php
										$instruccion = "SELECT nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
										$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
										while($opciones = mysql_fetch_array($consulta)){
											echo"
											<option>".$opciones[0]."</option>";
										}
										?>
									</select>
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------DIRECCION---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Direccion:</span></td>
								<td align="left">
									<textarea name="direccion" cols=30 rows=4 onKeyup="autoTab(event.keyCode,this.name,99);"></textarea>
								</td>
							</tr>
							<!--------------------------------DEPARTAMENTO---------------------------------->
							<tr>
								<td align="right">
									<span class="titulo1">Departamento:</span>
								</td>
								<td align="left">
									<?php
									if($departamento == "dep"){
									?>
									<select name="departamento" id="id3" class="requiredo lista opcion" onBlur="borrarMensaje(4), elementosVacios(5);" onClick="borrarMensaje(4), elementosVacios(5);">
										<option selected value="">.:Opciones:.</option>
										<?php
										for($contador=0;$contador<14;$contador++){
											echo "<option>".$departamentos[$contador]."</option>";
										}
									echo "</select>";
									}
									else{
									?>
									<input value="<?php echo $departamento;?>" readonly name="departamento" id="id2" class="requiredo lista opcion" onBlur="borrarMensaje(4), elementosVacios(5);" onClick="borrarMensaje(4), elementosVacios(5);">
									<?php
									}
									?>
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------TELEFONO---------------------------------->
							<tr>
								<td align="right">
									<span class="titulo1">Telefono:</span>
								</td>
								<td align="left">
									<input name="telefono1" id="id4" class="requiredo" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(5);" onClick="borrarMensaje(4), elementosVacios(5);">
									<span class="titulo1">-</span>
									<input name="telefono2" id="id5" class="requiredo" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(5);" onClick="borrarMensaje(4), elementosVacios(5);">
								</td>
							</tr>
							<!---------------------------------BOTONES----------------------------------->
							<tr>
								<td colspan=2 align="center">
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<span id="toolTipBox" width="50"></span>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
									<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(4), elementosVacios(5);">
									<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
									<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroCentroAcopio.php')">
								</td>
							</tr>
						<!------------------------------------------------------------------------>
						</table>
					</form>
					<center>
						<span class="obligatorio">* Datos requeridos</span>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta escribir el nombre del dentro de acopio!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el seleccionar el nombre del recolector!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta seleccionar el departamento!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;El numero telefonico esta incompleto!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>