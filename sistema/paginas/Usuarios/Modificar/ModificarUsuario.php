<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$id 		= $_POST['id'];
$nombre  	= $_POST['nombre'];
$usuario 	= $_POST['usuario'];
$password 	= $_POST['password'];
$nivel 		= $_POST['nivel'];
$instruccion_update = "UPDATE usuarios SET nombre = '$nombre', usuario = '$usuario', password = '$password', nivel = '$nivel' WHERE id = '$id'";
$actualizar_usuario = mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo en actualizar_usuario!!</SPAN>".mysql_error());

$instruccion_select = "SELECT id, nombre, usuario, password, nivel FROM usuarios WHERE id = '$id'";
$consulta_usuario = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_usuario!!</SPAN>".mysql_error());
$usuarios = mysql_fetch_array($consulta_usuario);
$tipos_usuarios = array(1=>"Administrador",2=>"Contador",3=>"Recolector");
?>
<HTML>
	<head>
		<title>.:SCYCPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarUsuario.php">
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
					<h1 class="encabezado1">MODIFICAR USUARIO</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE MODIFICO EL USUARIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
			<tr>
				<td align="center">
					<table class="resultado centro">
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Nombre Completo:</b></td>
							<td><?php echo $usuarios["nombre"]; ?></td>
						</tr>
						<tr>
							<td align="right"><b>Nombre de Usuario:</b></td>
							<td><?php echo $usuarios["usuario"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Contrase&ntilde;a:</b></td>
							<td><input class="subtitulo1 fondo3" type="password" readonly value="<?php echo $usuarios['password'];?>"></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right"><b>Tipo de Usuario:</b></td>
							<td><?php echo $tipos_usuarios[$usuarios["nivel"]]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>