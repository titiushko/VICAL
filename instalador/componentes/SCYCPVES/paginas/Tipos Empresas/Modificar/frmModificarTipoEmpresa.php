<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_tipo_empresa = $_REQUEST['modificar_tipo_empresa'];

$instruccion_select = "SELECT codigo_tipo_empresa, nombre_tipo_empresa FROM tipos_empresas WHERE codigo_tipo_empresa = '$codigo_tipo_empresa'";
$consulta_tipo_empresa = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipo_empresa!!</SPAN>".mysql_error());
$tipos_empresas = mysql_fetch_array($consulta_tipo_empresa);
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript">
			function borrarMensaje(){var elemento = document.getElementById('mensaje'); elemento.className = "oculto";}
			function validarModificarTipoEmpresa(F){
				borrarMensaje();
				//campo caja de texto nombre tipo de empresa
				if(F.nombre_tipo_empresa.value == ""){
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
					<h1 class="encabezado1">MODIFICAR TIPO DE EMPRESA</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<form name="modificar_tipo_empresa" <?php echo "action=\"ModificarTipoEmpresa.php?codigo_tipo_empresa=$codigo_tipo_empresa\"";?> method="post" enctype="multipart/form-data" onSubmit="return validarModificarTipoEmpresa(this);">
					<table class="marco centro">
						<tr>
							<td align="right" class="titulo1">Codigo:</td>
							<td><?php echo $tipos_empresas["codigo_tipo_empresa"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo1">Tipo de Empresa:</td>
							<td><input name="nombre_tipo_empresa" class="subtitulo1 fondo" size=30 <?php echo "value='".$tipos_empresas["nombre_tipo_empresa"]."'";?> onKeyPress="return soloLetras(event)" onBlur="borrarMensaje();" onClick="borrarMensaje();"></td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<!------------------------------------------------------------------------>
					<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../Consultar/frmConsultarTipoEmpresa.php')">
					<!------------------------------------------------------------------------>
					</form>
					<center>
						<div id="mensaje" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nombre del tipo de empresa!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>