<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$codigo_precio = $_REQUEST['modificar_precio'];

$instruccion_select = "SELECT precio_unitario FROM precios WHERE codigo_precio = '$codigo_precio'";
$consulta_precio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_precio!!</SPAN>".mysql_error());
$precio = mysql_fetch_array($consulta_precio);
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
		<script type="text/javascript" 	 src="../../../librerias/jquery/prototype.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript">
			function borrarMensaje(){
				var elemento;
				elemento = document.getElementById('mensaje'); elemento.removeClassName("visto");
			}
			function validarModificarPrecioUnitario(F){
				var elemento;
				borrarMensaje();
				if(F.precio_unitario.value == ""){elemento = document.getElementById('mensaje'); elemento.addClassName("visto");return false;}
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
					<h1 class="encabezado1">MODIFICAR PRECIO UNITARIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="modificar_precio_unitario" action="ModificarPrecioUnitario.php" method="post" enctype="multipart/form-data" onSubmit="return validarModificarPrecioUnitario(this);">
					<table class="marco centro">
						<!----------------------------PRECIO UNITARIO----------------------------->
						<tr>
							<td align="right" class="titulo1">Precio Unitario:</td>
							<td align="left">
								<input name="codigo_precio" class="oculto" value="<?php echo $codigo_precio;?>" type="text">
								<input name="precio_unitario" class="subtitulo1 fondo" value="<?php echo $precio['precio_unitario'];?>" type="text" size=4 onKeyPress="return soloNumerosFloat(event)" onBlur="borrarMensaje();" onClick="borrarMensaje();">&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!------------------------------------------------------------------------>
					<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../Consultar/frmConsultarPrecioUnitario.php')">
					<!------------------------------------------------------------------------>
					</form>
					<center>
						<div id="mensaje" class="oculto"><span class="alerta error">&nbsp;&nbsp;El campo Precio Unitario no puede quedar vacio!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>