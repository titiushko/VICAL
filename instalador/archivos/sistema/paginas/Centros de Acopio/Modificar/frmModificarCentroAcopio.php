<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$centro_de_acopio 	= $_REQUEST['modificar_centro_de_acopio'];
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
WHERE centros_de_acopio.codigo_centro_acopio = '$centro_de_acopio'
AND recolectores.codigo_recolector = centros_de_acopio.codigo_recolector";
$consulta_centro_de_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!!</SPAN>".mysql_error());
$centros_de_acopio = mysql_fetch_assoc($consulta_centro_de_acopio);

$telefono = $centros_de_acopio["telefono"];
$telefono1 = "";
$telefono2 = "";
if($telefono <> NULL){
	$bandera = 1;
	for($i=0;$i<strlen($telefono);$i++){
		if($telefono[$i] == "-"){
			$i++;
			$bandera = 2;
		}
		if($bandera == 1)
			$telefono1 = $telefono1."".$telefono[$i];
		if($bandera == 2)
			$telefono2 = $telefono2."".$telefono[$i];
	}
}
else{
	$telefono1 = NULL;
	$telefono2 = NULL;
}

$departamentos = array("Ahuachapan","Santa Ana","Sonsonate","Usulutan","San Miguel","Morazan","La Union","La Libertad","Chalatenango","Cuscatlan","San Salvador","La Paz","Caba&ntilde;as","San Vicente");
?>
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
			function borrarMensaje(){var elemento = document.getElementById('mensaje'); elemento.className = "oculto";}
			function validarNuevoCentroAcopio(F){
				borrarMensaje();
				//caja de texto del telefonico
				if(F.telefono1.value != "" || F.telefono2.value != ""){
					if(!(F.telefono1.value != "" && F.telefono2.value != "")){
						elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
						F.telefono1.focus();
						//F.telefono2.focus();
						return false;
					}
				}
				return true;
			}
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">MODIFICAR CENTRO DE ACOPIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="formulario" <?php echo "action=\"ModificarCentroAcopio.php?centro_de_acopio=$centro_de_acopio\"";?> method="post" enctype="multipart/form-data" onSubmit="return validarNuevoCentroAcopio(this);">
					<table class="marco centro">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1"><?php echo $centros_de_acopio["codigo_centro_acopio"]; ?></td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Nombre:</td>
							<td>
								<input name="nombre_centro_acopio" class="subtitulo1 fondo" size=39 <?php echo "value='".$centros_de_acopio["nombre_centro_acopio"]."'";?> onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
							</td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="right" class="titulo1">Encargado:</td>
							<td>
								<select name="nombre_recolector" class="subtitulo1 fondo lista nombre" size="1">
									<?php
									$instruccion = "SELECT nombre_recolector FROM recolectores ORDER BY nombre_recolector ASC";
									$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
									while($opciones = mysql_fetch_array($consulta)){
										if($opciones[0] == $centros_de_acopio["nombre_recolector"])
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
						if ($centros_de_acopio["direccion"]<>NULL){
						?>
							<td>
								<textarea name="direccion" class="subtitulo1 fondo" rows="3" cols="30" onKeyup="autoTab(event.keyCode,this.name,99);"><?php echo $centros_de_acopio["direccion"];?></textarea>
							</td>
						<?php
						}
						else{
						?>
							<td>
								<textarea name="direccion" class="subtitulo1 fondo" rows="3" cols="30" onKeyup="autoTab(event.keyCode,this.name,99);"></textarea>
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
										if($departamentos[$i] == $centros_de_acopio["departamento"])
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
						if ($centros_de_acopio["telefono"]<>NULL){
						?>
							<td>
								<input name="telefono1" class="subtitulo1 fondo" type="text" value="<?php echo $telefono1;?>" maxLength=4 size=2 onKeyPress="return soloNumeros(event)" onKeyup="autoTab(event.keyCode,this.name,3);" onClick="borrarMensaje();">
								<span class="subtitulo1">-</span>
								<input name="telefono2" class="subtitulo1 fondo" type="text" value="<?php echo $telefono2;?>" maxLength=4 size=2 onKeyPress="return soloNumeros(event)" onKeyup="autoTab(event.keyCode,this.name,3);" onClick="borrarMensaje();">
							</td>
						<?php
						}
						else{
						?>
							<td>
								<input name="telefono1" class="subtitulo1 fondo" type="text" maxLength=4 size=2 onKeyPress="return soloNumeros(event)" onKeyup="autoTab(event.keyCode,this.name,3);" onClick="borrarMensaje();">
								<span class="subtitulo1">-</span>
								<input name="telefono2" class="subtitulo1 fondo" type="text" maxLength=4 size=2 onKeyPress="return soloNumeros(event)" onKeyup="autoTab(event.keyCode,this.name,3);" onClick="borrarMensaje();">
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
					<?php
					if($direccion == "../Consultar/VerCentroAcopioDepartamento.php"){
						switch($centros_de_acopio["departamento"]){
							case "Ahuachapan": $centro_de_acopio = 1; break;
							case "Santa Ana": $centro_de_acopio = 2; break;
							case "Sonsonate": $centro_de_acopio = 3; break;
							case "Usulutan": $centro_de_acopio = 4; break;
							case "San Miguel": $centro_de_acopio = 5; break;
							case "Morazan": $centro_de_acopio = 6; break;
							case "La Union": $centro_de_acopio = 7; break;
							case "La Libertad": $centro_de_acopio = 8; break;
							case "Chalatenango": $centro_de_acopio = 9; break;
							case "Cuscatlan": $centro_de_acopio = 10; break;
							case "San Salvador": $centro_de_acopio = 11; break;
							case "La Paz": $centro_de_acopio = 12; break;
							case "Caba&ntilde;as": $centro_de_acopio = 13; break;
							case "San Vicente": $centro_de_acopio = 14; break;
						}
					}
					?>
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('$direccion?departamento=$centro_de_acopio')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
					<center>
						<div id="mensaje" class="oculto"><span class="alerta error">&nbsp;&nbsp;El numero telefonico esta incompleto!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>