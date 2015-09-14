<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_proveedor = $_REQUEST['modificar_proveedor'];

$instruccion_select = "
SELECT
proveedores.codigo_proveedor,
proveedores.nombre_proveedor,
proveedores.direccion_proveedor,
proveedores.departamento,
proveedores.telefono_proveedor1,
proveedores.telefono_proveedor2,
proveedores.contacto,
proveedores.estanon,
tipos_empresas.nombre_tipo_empresa
FROM proveedores
JOIN tipos_empresas
WHERE proveedores.codigo_proveedor = '$codigo_proveedor'
AND tipos_empresas.codigo_tipo_empresa = proveedores.codigo_tipo_empresa";
$consulta_proveedores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedores!!</SPAN>".mysql_error());
$proveedores = mysql_fetch_assoc($consulta_proveedores);

$telefono = $proveedores["telefono_proveedor1"];
$telefono1_1 = "";
$telefono1_2 = "";
if($telefono <> NULL){
	$bandera = 1;
	for($i=0;$i<strlen($telefono);$i++){
		if($telefono[$i] == "-"){
			$i++;
			$bandera = 2;
		}
		if($bandera == 1)
			$telefono1_1 = $telefono1_1."".$telefono[$i];
		if($bandera == 2)
			$telefono1_2 = $telefono1_2."".$telefono[$i];
	}
}
else{
	$telefono1_1 = NULL;
	$telefono1_2 = NULL;
}

$telefono = $proveedores["telefono_proveedor2"];
$telefono2_1 = "";
$telefono2_2 = "";
if($telefono <> NULL){	
	$bandera = 1;
	for($i=0;$i<strlen($telefono);$i++){
		if($telefono[$i] == "-"){
			$i++;
			$bandera = 2;
		}
		if($bandera == 1)
			$telefono2_1 = $telefono2_1."".$telefono[$i];
		if($bandera == 2)
			$telefono2_2 = $telefono2_2."".$telefono[$i];
	}
}
else{
	$telefono2_1 = NULL;
	$telefono2_2 = NULL;
}

$departamentos = array("Ahuachapan","Santa Ana","Sonsonate","Usulutan","San Miguel","Morazan","La Union","La Libertad","Chalatenango","Cuscatlan","San Salvador","La Paz","Caba&ntilde;as","San Vicente");
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
					<h1 class="encabezado1">MODIFICAR PROVEEDOR</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="formulario" <?php echo "action=\"ModificarProveedor.php?codigo_proveedor=$codigo_proveedor\"";?> method="post" enctype="multipart/form-data" onSubmit="return validarModificarProveedor(this,3);">
					<table class="marco centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1">&nbsp;<?php echo $proveedores["codigo_proveedor"]."<br>"; ?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Nombre:</td>
							<td>
								<input name="nombre_proveedor" class="subtitulo1 fondo" size=39 <?php echo "value='".$proveedores["nombre_proveedor"]."'";?> onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
							</td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Tipo Empresa:</td>
							<td align="left">
								<select name="nombre_tipo_empresa" class="subtitulo1 fondo lista opcion" size="1">
									<?php
									$instruccion = "SELECT nombre_tipo_empresa FROM tipos_empresas ORDER BY nombre_tipo_empresa ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!! </SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta)){
										if($opciones[0] == $proveedores["nombre_tipo_empresa"])
											echo "<option selected>".$opciones[0]."</option>";
										else
											echo "<option>".$opciones[0]."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Direccion:</td>
						<?php
						if ($proveedores["direccion_proveedor"]<>NULL){
						?>
							<td>
								<textarea name="direccion_proveedor" class="subtitulo1 fondo" rows="3" cols="30" onKeyup="autoTab(event.keyCode,this.name,99);"><?php echo $proveedores["direccion_proveedor"];?></textarea>
							</td>
						<?php
						}
						else{
						?>
							<td>
								<textarea name="direccion_proveedor" class="subtitulo1 fondo" rows="3" cols="30" onKeyup="autoTab(event.keyCode,this.name,99);"></textarea>
							</td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Departamento:</td>
							<td align="left">
								<select name="departamento" class="subtitulo1 fondo lista opcion">
									<?php
									for($i=0;$i<14;$i++){
										if($departamentos[$i] == $proveedores["departamento"])
												echo "<option selected>".$departamentos[$i]."</option>";
											else
												echo "<option>".$departamentos[$i]."</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Telefono:</td>
						<?php
						if ($proveedores["telefono_proveedor1"]<>NULL){
						?>
							<td>
								<input name="telefono1_1" class="subtitulo1 fondo" type="text" value="<?php echo $telefono1_1;?>" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
								<span class="subtitulo1">-</span>
								<input name="telefono1_2" class="subtitulo1 fondo" type="text" value="<?php echo $telefono1_2;?>" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
							</td>
						<?php
						}
						else{
						?>
							<td>
								<input name="telefono1_1" class="subtitulo1 fondo" type="text" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
								<span class="subtitulo1">-</span>
								<input name="telefono1_2" class="subtitulo1 fondo" type="text" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
							</td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Telefono2:</td>
						<?php
						if ($proveedores["telefono_proveedor2"]<>NULL){
						?>
							<td>
								<input name="telefono2_1" class="subtitulo1 fondo" type="text" value="<?php echo $telefono2_1;?>" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)">
								<span class="subtitulo1">-</span>
								<input name="telefono2_2" class="subtitulo1 fondo" type="text" value="<?php echo $telefono2_2;?>" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)">
							</td>
						<?php
						}
						else{
						?>
							<td>
								<input name="telefono2_1" class="subtitulo1 fondo" type="text" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)">
								<span class="subtitulo1">-</span>
								<input name="telefono2_2" class="subtitulo1 fondo" type="text" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)">
							</td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Contacto:</td>
						<?php
						if ($proveedores["contacto"]<>NULL){
						?>
							<td>
								<input name="contacto" class="subtitulo1 fondo" size=39 <?php echo "value='".$proveedores["contacto"]."'";?> onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
							</td>
						<?php
						}
						else{
						?>
							<td>
								<input name="contacto" class="subtitulo1 fondo" size=39 onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(3);" onClick="borrarMensaje(3);">
							</td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Esta&ntilde;on:</td>
						<?php
						if ($proveedores["estanon"]<>NULL){
						?>
							<td>
								<input name="estanon" class="subtitulo1 fondo" maxLength=10 size=9 <?php echo "value='".$proveedores["estanon"]."'";?> >
							</td>
						<?php
						}
						else{
						?>
							<td>
								<input name="estanon" class="subtitulo1 fondo" maxLength=10 size=9>
							</td>
						</tr>
						<?php
						}
						?>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!------------------------------------------------------------------------>
					<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
					<input type="button"  onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/Verproveedor.php?valor=$codigo_proveedor')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nombre de la empresa!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta al menos un numero telefonico!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nombre del representante!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>