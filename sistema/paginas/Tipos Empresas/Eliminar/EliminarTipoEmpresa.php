<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";

$codigo_tipo_empresa = $_REQUEST['codigo'];

$instruccion_select = "SELECT codigo_tipo_empresa AS tipos_empresas_codigo_tipo_empresa, nombre_tipo_empresa FROM tipos_empresas WHERE codigo_tipo_empresa = '$codigo_tipo_empresa'";
$consulta_tipo_empresa = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipo_empresa!!</SPAN>".mysql_error());
$tipos_empresas = mysql_fetch_array($consulta_tipo_empresa);

$instruccion_select = "
SELECT
tipos_empresas.codigo_tipo_empresa,
proveedores.codigo_tipo_empresa AS proveedores_codigo_tipo_empresa
FROM tipos_empresas, proveedores
WHERE tipos_empresas.codigo_tipo_empresa = '$codigo_tipo_empresa'
AND proveedores.codigo_tipo_empresa = tipos_empresas.codigo_tipo_empresa";
$consulta_proveedor = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedor!! </SPAN>".mysql_error());
$proveedores = mysql_fetch_array($consulta_proveedor);
?>
<!----------------------------------------------------------------------------------------------------------------->
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
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR TIPO DE EMPRESA</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			if( $tipos_empresas['tipos_empresas_codigo_tipo_empresa'] == $proveedores['proveedores_codigo_tipo_empresa'] ){
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_error.png">
						<br>
						NO SE PUDO ELIMINAR EL TIPO DE EMPRESA!!
					</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td>
								No se puede eliminar el tipo de empresa <?php echo $tipos_empresas["nombre_tipo_empresa"];?> 
								porque hay proveedores registrados con este tipo de empresa.
							</td>
						</tr>
					</table>
					<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarTipoEmpresa.php">
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<?php
			}
			else {
			//eliminar el registro de la tabla tipos_empresas con el codigo del tipo_empresa que se va eliminar
			$instruccion_delete = "DELETE FROM tipos_empresas WHERE codigo_tipo_empresa = '$codigo_tipo_empresa'";
			mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_tipo_empresa!! </SPAN>".mysql_error());
			?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL TIPO DE EMPRESA EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<tr>
							<td align="right"><b>Codigo:</b></td>
							<td><?php echo $tipos_empresas["tipos_empresas_codigo_tipo_empresa"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Tipo de Empresa:</b></td>
							<td><?php echo $tipos_empresas["nombre_tipo_empresa"]; ?></td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
			<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarTipoEmpresa.php">
			<?php
			}
			?>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>