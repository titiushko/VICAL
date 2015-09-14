<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
//oobtener variables para realizar la consulta
$nombre		= $_POST['nombre'];
$usuario	= $_POST['usuario'];
$password	= $_POST['password'];
$nivel		= $_POST['nivel'];
$tipos_usuarios = array(1=>"Administrador",2=>"Contador",3=>"Recolector");
$instruccion_insert = "
INSERT INTO usuarios(NOMBRE,USUARIO,PASSWORD,NIVEL,ESTADO)
VALUES ('$nombre','$usuario','$password','$nivel','offline')";
mysql_query ($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_usuario!!</SPAN>".mysql_error());
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
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE USUARIOS</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE REGISTRO EL USUARIO EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td>
					<table align="center" class="marco">
						<!--------------------------------NOMBRE---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre Completo:</span></td>
							<td align="left"><input type="text" size=25 disabled="disabled" value="<?php echo $nombre;?>"></td>
						</tr>
						<!--------------------------------UEUARIO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Nombre de Usuario:</span></td>
							<td align="left"><input type="text" size=18 disabled="disabled" value="<?php echo $usuario;?>"></td>
						</tr>
						<!--------------------------------PASSWORD---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Contrase&ntilde;a:</span></td>
							<td align="left"><input type="password" size=18 disabled="disabled" value="<?php echo $password;?>"></td>
						</tr>
						<!--------------------------------TIPO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Tipo de Usuario:</span></td>
							<td align="left"><input type="text" size=18 disabled="disabled" value="<?php echo $tipos_usuarios[$nivel];?>"></td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoUsuario.php">
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>