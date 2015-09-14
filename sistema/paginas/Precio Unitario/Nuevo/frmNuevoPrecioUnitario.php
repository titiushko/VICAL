<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
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
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE PRECIO UNITARIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<form name="formulario_nuevo_precio" action="RegistrarPrecioUnitario.php" method="POST" onSubmit="return validarNuevoPrecioUnitario(this,2);">
						<table align="center" class="marco">
							<!--------------------------------PRECIO UNITARIO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Precio Unitario:</span></td>
								<td align="left">
									<input name="precio_unitario" id="id1" class="requiredo" type="text" size=4 onKeyPress="return soloNumerosFloat(event)" onBlur="borrarMensaje(2), elementosVacios(2);" onClick="borrarMensaje(2), elementosVacios(2);">
									<span class="obligatorio">*</span>&nbsp;&nbsp;
								</td>
							</tr>
							<!---------------------------------BOTONES----------------------------------->
							<tr>
								<td colspan=2 align="center">
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<span id="toolTipBox" width="50"></span>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
									<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje(2), elementosVacios(2);">
									<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
									<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroPrecioUnitario.php')">
								</td>
							</tr>
							<!------------------------------------------------------------------------>
						</table>
					</form>
					<center>
						<span class="obligatorio">* Datos requeridos</span>
						<div id="mensaje1" class="oculto"><br><br><span class="alerta error">&nbsp;&nbsp;El campo precio unitario no puede quedar vacio!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;El valor del precio unitario ya existe en el sistema!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>