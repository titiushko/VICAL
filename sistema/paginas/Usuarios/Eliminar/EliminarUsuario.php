<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$id = $_REQUEST['codigo'];
$instruccion_select = "SELECT id, nombre, usuario, password, nivel FROM usuarios WHERE id = '$id'";
$consulta_usuario = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_usuario!!</SPAN>".mysql_error());
$usuarios = mysql_fetch_array($consulta_usuario);
$tipos_usuarios = array(1=>"Administrador",2=>"Contador",3=>"Recolector");

$bandera = true;
if($usuarios["id"] == $_SESSION["id"])	$bandera = false;
?>
<!----------------------------------------------------------------------------------------------------------------->
<HTML>
	<head>
		<title>COMVICONPRO</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarUsuario.php">
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR USUARIO</h1>
<!------------------------------------------------------------------------------------------------------------------------>
<?php
if(!$bandera){
?>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_error.png">
						<br>
						NO SE PUDO ELIMINAR EL USUARIO!!
					</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="justify">
								No se puede eliminar el usuario <?php echo $usuarios["nombre"]; ?> por que este usuario a iniciado sesion y se encuentra actualmente en uso.<br>
								Inicie sesion en el sistema con otra cuenta de administrador para poder eliminar al usuario <?php echo $usuarios["nombre"]; ?>.
							</td>
						</tr>
					</table>
				</td>
<?php
}
else{
//eliminar usuario
mysql_query("DELETE FROM usuarios WHERE id = '$id'", $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_usuario!! </SPAN>".mysql_error());
?>
<!------------------------------------------------------------------------------------------------------------------------>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL USUARIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<tr>
							<td align="right"><b>Nombre Completo:</b></td>
							<td><?php echo $usuarios["nombre"]; ?></td>
						</tr>
						<tr>
							<td align="right"><b>Nombre de Usuario:</b></td>
							<td><?php echo $usuarios["usuario"]; ?></td>
						</tr>
						<tr>
							<td align="right"><b>Contrase&ntilde;a:</b></td>
							<td><input class="subtitulo1 fondo3" type="password" readonly value="<?php echo $usuarios['password'];?>"></td>
						</tr>
						<tr>
							<td align="right"><b>Tipo de Usuario:</b></td>
							<td><?php echo $tipos_usuarios[$usuarios["nivel"]];?></td>
						</tr>
					</table>
					<span id="toolTipBox" width="50"></span>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
<?php
}
?>
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>