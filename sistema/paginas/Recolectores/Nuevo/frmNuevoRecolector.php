<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
//Obtener cantidad de datos
$consulta_recolector = mysql_query("SELECT COUNT(codigo_recolector) AS cantidad FROM recolectores", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_recolector!! </SPAN>".mysql_error());
$recolector = mysql_fetch_array($consulta_recolector);
$cantidad = $recolector['cantidad'];
$cantidad++;

//Buscar y establecer codigo
$contador = 1;
while($contador <= $cantidad){
	if($contador < 10){
		$nuevo_codigo = "R-00".$contador;
		$consulta_buscar = mysql_query("SELECT codigo_recolector FROM recolectores WHERE codigo_recolector = '$nuevo_codigo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
		$buscar =  mysql_fetch_array($consulta_buscar);
		if($buscar[0] <> $nuevo_codigo)	break;
	}
	if($contador >= 10 && $contador < 100){
		$nuevo_codigo = "R-0".$contador;
		$consulta_buscar = mysql_query("SELECT codigo_recolector FROM recolectores WHERE codigo_recolector = '$nuevo_codigo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
		$buscar =  mysql_fetch_array($consulta_buscar);
		if($buscar[0] <> $nuevo_codigo)	break;
	}
	else if($contador >= 100){
		$nuevo_codigo = "R-".$contador;
		$consulta_buscar = mysql_query("SELECT codigo_recolector FROM recolectores WHERE codigo_recolector = '$nuevo_codigo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
		$buscar =  mysql_fetch_array($consulta_buscar);
		if($buscar[0] <> $nuevo_codigo)	break;
	}
	$contador++;
}
?>
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
					<h1 class="encabezado1">REGISTRO DE RECOLECTORES</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<form name="formulario" action="RegistrarRecolector.php" method="POST" onSubmit="return validarNuevoRecolector(this,4);">
						<table align="center" class="marco">
							<!--------------------------------CODIGO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Codigo:</span></td>
								<td align="left">
									<input name="codigo_recolector" type="text" size=4 readonly value="<?php echo $nuevo_codigo;?>">
								</td>
							</tr>
							<!--------------------------------NOMBRE---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Nombre del Recolector:</span></td>
								<td align="left">						
									<input name="nombre_recolector" id="id1" class="requiredo" type="text" size=39 onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------DUI---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">DUI:</span></td>
								<td align="left">
									<input name="dui1" id="id2" class="requiredo" type="text" maxLength=8 size=6 onKeyup="autoTab(event.keyCode,this.name,7);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="titulo1">-</span>
									<input name="dui2" id="id3" class="requiredo" type="text" maxLength=1 size=1 onKeyup="autoTab(event.keyCode,this.name,1);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------NIT---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">NIT:</span></td>
								<td align="left">
									<input name="nit1" id="id4" class="requiredo" class="requiredo" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="titulo1">-</span>
									<input name="nit2" id="id5" class="requiredo" type="text" maxLength=6 size=4 onKeyup="autoTab(event.keyCode,this.name,5);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="titulo1">-</span>
									<input name="nit3" id="id6" class="requiredo" type="text" maxLength=3 size=1 onKeyup="autoTab(event.keyCode,this.name,2);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="titulo1">-</span>
									<input name="nit4" id="id7" class="requiredo" type="text" maxLength=1 size=1 onKeyup="autoTab(event.keyCode,this.name,1);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!--------------------------------DIRECCION---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Direccion:</span></td>
								<td align="left">
									<textarea name="direccion" cols=30 rows=4 onKeyup="autoTab(event.keyCode,this.name,99);" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);"></textarea>
								</td>
							</tr>
							<!--------------------------------TELEFONO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Telefono:</span></td>
								<td align="left">
									<input name="telefono1" id="id8" class="requiredo" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="titulo1">-</span>
									<input name="telefono2" id="id9" class="requiredo" type="text" maxLength=4 size=1 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4), elementosVacios(9);" onClick="borrarMensaje(4), elementosVacios(9);">
									<span class="obligatorio">*</span>
								</td>
							</tr>
							<!---------------------------------BOTONES----------------------------------->
							<tr>
								<td colspan=2 align="center">
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<span id="toolTipBox" width="50"></span>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
									<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(4), elementosVacios(9);">
									<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
									<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroRecolector.php')">
								</td>
							</tr>
						<!------------------------------------------------------------------------>
						</table>
					</form>
					<center>
						<span class="obligatorio">* Datos requeridos</span>
						<div id="mensaje1" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;Falta el nombre del recolector!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;Falta el dui!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta el nit!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><br><span class="alerta error">&nbsp;&nbsp;Falta el nuemero telefonico!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>