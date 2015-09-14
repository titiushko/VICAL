<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";
//oobtener variables para realizar la consulta
$id			= $_POST['id'];
$nombre		= $_POST['nombre'];
$usuario	= $_POST['usuario'];
$password	= $_POST['password'];
$nivel		= $_POST['nivel'];
$tipos_usuarios = array(1=>"Administrador",2=>"Contador",3=>"Recolector");
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
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">REGISTRO DE USUARIOS</h1>
				<?php
				$consulta_buscar = mysql_query("SELECT id FROM usuarios WHERE id = '$id'", $conexion) or die ("<SPAN CLASS='error'>Fallo en buscar!! </SPAN>".mysql_error());
				$buscar =  mysql_fetch_array($consulta_buscar);
				if($buscar[0] == $id){
				?>
						<h2 class="encabezado2">
							<img src="../../../imagenes/icono_error.png">
							<br>
							NO SE PUDO REGISTRAR EL USUARIO!!
						</h2>
					</td>
				</tr>
<!------------------------------------------------------------------------------------------------------------------------>
				<tr>
					<td>
						<table align="center" class="alerta error centro">
							<tr>
								<td align="center">
									El codigo <?php echo $id;?> del usuario que quiere registrar ya ha sido asignado en otro usuario.
								</td>
							</tr>
						</table>
						<meta http-equiv ="refresh"		 content="5;url=frmNuevoUsuario.php">
					</td>
				</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
				<?php
				}
				else if($buscar[0] <> $id){
				$instruccion_insert = "
				INSERT INTO usuarios(NOMBRE,USUARIO,PASSWORD,nivel)
				VALUES ('$nombre','$usuario','$password','$nivel')";
				mysql_query ($instruccion_insert, $conexion) or die ("<SPAN CLASS='error'>Fallo en registrar_usuario!!</SPAN>".mysql_error());
				?>
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
						<!--------------------------------CODIGO---------------------------------->
						<tr>
							<td align="right"><span class="titulo1">Codigo:</span></td>
							<td align="left"><input type="text" size=4 disabled="disabled" value="<?php echo $id;?>"></td>
						</tr>
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
				<?php
				}
				?>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>