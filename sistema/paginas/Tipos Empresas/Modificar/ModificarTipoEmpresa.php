<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";

$codigo_tipo_empresa = $_REQUEST['codigo_tipo_empresa'];
$nombre_tipo_empresa = $_POST['nombre_tipo_empresa'];

$instruccion_update = "UPDATE tipos_empresas SET nombre_tipo_empresa = '$nombre_tipo_empresa' WHERE codigo_tipo_empresa = '$codigo_tipo_empresa'";
$actualizar_tipos_empresas = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_tipos_empresas!!</SPAN>".mysql_error());

$instruccion_select = "SELECT codigo_tipo_empresa, nombre_tipo_empresa FROM tipos_empresas WHERE codigo_tipo_empresa = '$codigo_tipo_empresa'";
$consulta_tipo_empresa = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_tipo_empresa!!</SPAN>".mysql_error());
$tipos_empresas = mysql_fetch_array($consulta_tipo_empresa);
?>
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarTipoEmpresa.php">
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
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">MODIFICAR TIPO DE EMPRESA</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO EL TIPO DE EMPRESA EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="resultado centro">
						<tr>
							<td align="right"><b>Codigo:</b></td>
							<td><?php echo $tipos_empresas["codigo_tipo_empresa"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Tipo de Empresa:</b></td>
							<td><?php echo $tipos_empresas["nombre_tipo_empresa"]; ?></td>
						</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>