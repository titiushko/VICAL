<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_recolector = $_REQUEST['modificar_recolector'];

$instruccion_select = "
SELECT codigo_recolector, nombre_recolector, dui_recolector, nit_recolector, direccion_recolector, telefono_recolector
FROM recolectores 
WHERE recolectores.codigo_recolector = '$codigo_recolector'";
$consulta_recolectores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo consulta!!</SPAN>".mysql_error());
$recolectores = mysql_fetch_assoc($consulta_recolectores);

$dui = $recolectores["dui_recolector"];
$dui1 = "";
$dui2 = "";
if($dui != "-"){
	$bandera = 1;
	for($i=0;$i<strlen($dui);$i++){
		if($dui[$i] == "-"){
			$i++;
			$bandera = 2;
		}
		if($bandera == 1)
			$dui1 = $dui1."".$dui[$i];
		if($bandera == 2)
			$dui2 = $dui2."".$dui[$i];
	}
}
$nit = $recolectores["nit_recolector"];
$nit1 = "";
$nit2 = "";
$nit3 = "";
$nit4 = "";
if($nit != "---"){
	$bandera = 1;
	for($i=0;$i<strlen($nit);$i++){
		if($nit[$i] == "-" && $bandera == 1){
			$i++;
			$bandera = 2;
		}
		if($nit[$i] == "-" && $bandera == 2){
			$i++;
			$bandera = 3;
		}
		if($nit[$i] == "-" && $bandera == 3){
			$i++;
			$bandera = 4;
		}
		if($bandera == 1)
			$nit1 = $nit1."".$nit[$i];
		if($bandera == 2)
			$nit2 = $nit2."".$nit[$i];
		if($bandera == 3)
			$nit3 = $nit3."".$nit[$i];
		if($bandera == 4)
			$nit4 = $nit4."".$nit[$i];
	}
}
$telefono = $recolectores["telefono_recolector"];
$telefono1 = "";
$telefono2 = "";
if($telefono != "-"){
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
					<h1 class="encabezado1">MODIFICAR RECOLECTOR</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="formulario" <?php echo "action=\"ModificarRecolector.php?codigo_recolector=$codigo_recolector\"";?> method="post" enctype="multipart/form-data" onSubmit="return validarNuevoRecolector(this,4);">
					<table class="marco centro">
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td class="subtitulo1"><?php echo $recolectores["codigo_recolector"]; ?></td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Nombre:</td>
							<td>
								<input name="nombre_recolector" id="id1" class="subtitulo1 fondo" size=39 <?php echo "value='".$recolectores["nombre_recolector"]."'";?> onKeyPress="return soloLetras(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">DUI:</td>
							<td>
								<input name="dui1" id="id2" class="subtitulo1 fondo" type="text" value="<?php echo $dui1;?>" maxLength=8 size=7 onKeyup="autoTab(event.keyCode,this.name,7);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
								<span class="subtitulo1">-</span>
								<input name="dui2" id="id3" class="subtitulo1 fondo" type="text" value="<?php echo $dui2;?>" maxLength=1 size=1 onKeyup="autoTab(event.keyCode,this.name,2);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">NIT:</td>
							<td>
								<input name="nit1" id="id4" class="subtitulo1 fondo" type="text" value="<?php echo $nit1;?>" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
								<span class="subtitulo1">-</span>
								<input name="nit2" id="id5" class="subtitulo1 fondo" type="text" value="<?php echo $nit2;?>" maxLength=6 size=4 onKeyup="autoTab(event.keyCode,this.name,5);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
								<span class="subtitulo1">-</span>
								<input name="nit3" id="id6" class="subtitulo1 fondo" type="text" value="<?php echo $nit3;?>" maxLength=3 size=1 onKeyup="autoTab(event.keyCode,this.name,2);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
								<span class="subtitulo1">-</span>
								<input name="nit4" id="id7" class="subtitulo1 fondo" type="text" value="<?php echo $nit4;?>" maxLength=1 size=1 onKeyup="autoTab(event.keyCode,this.name,2);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
							</td>
						</tr>
						<?php
						if ($recolectores["direccion_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo1">Direccion:</td>
							<td>
								<textarea name="direccion_recolector" class="subtitulo1 fondo" rows="3" cols="30" onKeyup="autoTab(event.keyCode,this.name,99);"><?php echo $recolectores["direccion_recolector"];?></textarea>
							</td>
						</tr>
						<?php
						}
						else{
						?>
						<tr>
							<td align="right" class="titulo1">Direccion:</td>
							<td>
								<textarea name="direccion_recolector" class="subtitulo1 fondo" rows="3" cols="30" onKeyup="autoTab(event.keyCode,this.name,99);"></textarea>
							</td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td align="right" class="titulo1">Telefono:</td>
							<td>
								<input name="telefono1" id="id8" class="subtitulo1 fondo" type="text" value="<?php echo $telefono1;?>" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
								<span class="subtitulo1">-</span>
								<input name="telefono2" id="id9" class="subtitulo1 fondo" type="text" value="<?php echo $telefono2;?>" maxLength=4 size=2 onKeyup="autoTab(event.keyCode,this.name,3);" onKeyPress="return soloNumeros(event)" onBlur="borrarMensaje(4);" onClick="borrarMensaje(4);">
							</td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!------------------------------------------------------------------------>
					<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" <?php echo "onClick=\"redireccionar('../Consultar/VerRecolector.php?valor=$codigo_recolector')\"";?>>
					<!------------------------------------------------------------------------>
					</form>
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nombre del recolector!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el dui!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nit!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nuemero telefonico!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>