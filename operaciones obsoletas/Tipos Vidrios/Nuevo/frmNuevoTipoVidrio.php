<?php
include "../../../librerias/abrir_conexion.php";
$instruccion_select = "SELECT COUNT(codigo_tipo) AS cantidad FROM tipos_vidrio ORDER BY codigo_tipo DESC";
$consulta_tipo = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!! </SPAN>".mysql_error());
$tipo = mysql_fetch_array($consulta_tipo);
$cantidad = $tipo['cantidad'];
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/jquery.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/validador.jquery.js"></script>
		<script type="text/javascript">		
		jQuery(document).ready(function(){
			jQuery('form').validador();
		});
		</script>
		<script type="text/javascript">
			function borrarMensaje(){var elemento = document.getElementById('mensaje'); elemento.className = "oculto";}
			function validarNuevoTipoVidrio(F){
				borrarMensaje();
				//campo caja de texto nombre tipo de vidrio
				if(F.nombre_tipo.value == ""){
					var elemento = document.getElementById('mensaje'); elemento.className = "visto";
					return false;
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
					<h1 class="encabezado1">REGISTRO DE TIPOS DE VIDRIO</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<form name="formulario" action="RegistrarTipoVidrio.php" method="POST" onSubmit="return validarNuevoTipoVidrio(this);">
						<table align="center" class="marco">
							<!--------------------------------CODIGO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Codigo:</span></td>
								<td align="left">
									<input name="codigo_tipo" type="text" size=4 readonly value="<?php echo "TV-0".($cantidad+1);?>">
								</td>
							</tr>
							<!--------------------------------NOMBRE---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Nombre Tipo de Vidrio:</span></td>
								<td align="left">						
									<input name="nombre_tipo" id="nombre_tipo" class="requiredo" type="text" size=39 onKeyPress="return soloLetras(event)" onBlur="borrarMensaje();" onClick="borrarMensaje();">
								</td>
							</tr>
							<!---------------------------------BOTONES----------------------------------->
							<tr>
								<td colspan=2 align="center">
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<span id="toolTipBox" width="50"></span>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<input name="Registrar" type="submit" value="Registrar" onMouseOver="toolTip('Registrar',this)" class="boton aceptar">
									<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje();">
									<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.html')">
									<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('')">
								</td>
							</tr>
							<!------------------------------------------------------------------------>
						</table>
					</form>
					<center>
						<div id="mensaje" class="oculto"><span class="alerta">&nbsp;&nbsp;Falta el nombre del tipo de vidrio!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2010</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>