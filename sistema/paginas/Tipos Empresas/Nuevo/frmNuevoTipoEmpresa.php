<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
//Obtener cantidad de datos
$consulta_tipo_empresa = mysql_query("SELECT COUNT(codigo_tipo_empresa) AS cantidad FROM tipos_empresas", $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipo_empresa!! </SPAN>".mysql_error());
$tipo_empresa = mysql_fetch_array($consulta_tipo_empresa);
$cantidad = $tipo_empresa['cantidad'];
$cantidad++;

//Buscar y establecer codigo
$contador = 1;
while($contador <= $cantidad){
	if($contador < 10){
		$nuevo_codigo = "TE-0".$contador;
		$consulta_buscar = mysql_query("SELECT codigo_tipo_empresa FROM tipos_empresas WHERE codigo_tipo_empresa = '$nuevo_codigo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
		$buscar =  mysql_fetch_array($consulta_buscar);
		if($buscar[0] <> $nuevo_codigo)	break;
	}
	else if($contador < 100){
		$nuevo_codigo = "TE-".$contador;
		$consulta_buscar = mysql_query("SELECT codigo_tipo_empresa FROM tipos_empresas WHERE codigo_tipo_empresa = '$nuevo_codigo'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/jquery.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/validador.jquery.js"></script>
		<script type="text/javascript">		
			jQuery(document).ready(function(){
				jQuery('form').validador();
			});
			function borrarMensaje(){var elemento = document.getElementById('mensaje'); elemento.className = "oculto";}
			function validarNuevoTipoEmpresa(F){
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
					<h1 class="encabezado1">REGISTRO DE TIPOS DE EMPRESAS</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2">
					<form name="formulario" action="RegistrarTipoEmpresa.php" method="POST" onSubmit="return validarNuevoTipoEmpresa(this);">
						<table align="center" class="marco">
							<!--------------------------------CODIGO---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Codigo:</span></td>
								<td align="left">
									<input name="codigo_tipo_empresa" type="text" size=4 readonly value="<?php echo $nuevo_codigo;?>">
								</td>
							</tr>
							<!--------------------------------NOMBRE---------------------------------->
							<tr>
								<td align="right"><span class="titulo1">Nombre Tipo de Empresa:</span></td>
								<td align="left">						
									<input name="nombre_tipo_empresa" id="nombre_tipo_empresa" class="requiredo" type="text" size=30 onKeyPress="return soloLetras(event)" onBlur="borrarMensaje();" onClick="borrarMensaje();">
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
									<input name="Limpiar" type="reset" value="Limpiar" onMouseOver="toolTip('Limpiar',this)" class="boton limpiar" onClick="borrarMensaje();">
									<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../../../interfaz/frame_contenido.php')">
									<input type="button" onMouseOver="toolTip('Ayuda',this)" class="boton ayuda" onClick="redireccionar('../../Ayuda/AyudaRegistroTipoEmpresa.php')">
								</td>
							</tr>
							<!------------------------------------------------------------------------>
						</table>
					</form>
					<center>
						<span class="obligatorio">* Datos requeridos</span>
						<div id="mensaje" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nombre del tipo de empresa!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>