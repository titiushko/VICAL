<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
$id = $_REQUEST['modificar_usuario'];
$instruccion_select = "SELECT id, nombre, usuario, password, nivel FROM usuarios WHERE id = '$id'";
$consulta_usuario = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_usuario!!</SPAN>".mysql_error());
$usuarios = mysql_fetch_array($consulta_usuario);
$tipos_usuarios = array(1=>"Administrador",2=>"Contador",3=>"Recolector");
?>
<HTML>
	<head>
		<title>SCYCPVES</title>
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
		<script type="text/javascript">
			//vector con los usuarios
			var usuarios = new Array;
			<?php
			$consulta = mysql_query("SELECT id, usuario FROM usuarios ORDER BY id ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en usuarios!!</SPAN>".mysql_error());
			$contador = 0;
			while($opciones = mysql_fetch_array($consulta)){
				echo "usuarios[$contador] = new Array ('".$opciones[0]."','".$opciones[1]."');\n";
				$contador++;
			}
			?>
			function borrarMensaje(){
				var elemento;
				for(i=1; i<=4; i++){elemento = document.getElementById('mensaje'+i); elemento.removeClassName("visto");}
			}
			//var value_usuario = "<?php echo $usuarios['usuario'];?>";
			function validarModificarUsuario(F){
				var elemento;
				borrarMensaje();
				if(F.nombre.value == ""){elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");return false;}
				if(F.usuario.value == ""){elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");return false;}
				if(F.password.value == ""){elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");return false;}
				//for(i=0; i<usuarios.length; i++)
					//if(!(F.id.value == usuarios[i][0] && F.usuario.value == usuarios[i][1])){elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");return false;}
					//if(F.usuario.value == usuarios[i][1]){elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");return false;}
					//if(F.usuario.value != value_usuario){alert(value_usuario);elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");return false;}
				return true;
			}
		</script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">MODIFICAR USUARIO</h1>
				</td>
			</tr>
			<tr>
				<td align="center">
					<form name="modificar_usuario" action="ModificarUsuario.php" method="post" enctype="multipart/form-data" onSubmit="return validarModificarUsuario(this);">
<?php
if($id != 1){
?>
<!------------------------------------------------------------------------------------------------------------------------>
					<table class="marco centro">
						<input name="id" class="oculto" type="text" value="<?php echo $id;?>">
						<tr>
							<td align="right" class="titulo1">Nombre Completo:</td>
							<td align="left">
								<input name="nombre" class="subtitulo1 fondo" value="<?php echo $usuarios['nombre'];?>" type="text" size=25 onKeyPress="return soloLetras(event)" onBlur="borrarMensaje();" onClick="borrarMensaje();">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Nombre de Usuario:</td>
							<td align="left">						
								<input name="usuario" class="subtitulo1 fondo" value="<?php echo $usuarios['usuario'];?>" type="text" size=18 onBlur="borrarMensaje();" onClick="borrarMensaje();">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Contrase&ntilde;a:</td>
							<td align="left">						
								<input name="password" class="subtitulo1 fondo" value="<?php echo $usuarios['password'];?>" type="password" size=18 onBlur="borrarMensaje();" onClick="borrarMensaje();">
								<input name="cambiar" type="checkbox" onClick="cambiarTypeTextPassword(this.form);" onMouseOver="toolTip('Mostrar la contrase&ntilde;a',this)">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Tipo de Usuario:</td>
							<td align="left">						
								<select name="nivel" class="subtitulo1 fondo lista opcion" onBlur="borrarMensaje();" onClick="borrarMensaje();">
									<?php
									for($i=1;$i<=3;$i++){
										if($i == $usuarios["nivel"])
											echo "<option selected value=\"$i\">".$tipos_usuarios[$i]."</option>";
										else
											echo "<option value=\"$i\">".$tipos_usuarios[$i]."</option>";
									}
									?>
								</select>
							</td>
						</tr>
					</table>
<!------------------------------------------------------------------------------------------------------------------------>
<?php
}
else{
?>
<!------------------------------------------------------------------------------------------------------------------------>
					<table class="marco centro">
						<input name="id" class="oculto" type="text" value="<?php echo $id;?>">
						<tr>
							<td align="right" class="titulo1">Nombre Completo:</td>
							<td align="left">
								Super Usuario
								<input name="nombre" class="oculto" type="text" value="Super Usuario">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Nombre de Usuario:</td>
							<td align="left">						
								<input name="usuario" class="subtitulo1 fondo" value="<?php echo $usuarios['usuario'];?>" type="text" size=18 onBlur="borrarMensaje();" onClick="borrarMensaje();">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Contrase&ntilde;a:</td>
							<td align="left">						
								<input name="password" class="subtitulo1 fondo" value="<?php echo $usuarios['password'];?>" type="password" size=18 onBlur="borrarMensaje();" onClick="borrarMensaje();">
								<input name="cambiar" type="checkbox" onClick="cambiarTypeTextPassword(this.form);" onMouseOver="toolTip('Mostrar la contrase&ntilde;a',this)">
							</td>
						</tr>
						<tr>
							<td align="right" class="titulo1">Tipo de Usuario:</td>
							<td align="left">
								Administrador
								<input name="nivel" class="oculto" type="text" value="1">
								</select>
							</td>
						</tr>
					</table>
<!------------------------------------------------------------------------------------------------------------------------>
<?php
}
?>
					<span id="toolTipBox" width="50"></span>
					<input name="Modificar" type="submit" value="Modificar" onMouseOver="toolTip('Modificar',this)" class="boton aceptar">
					<input type="button" onMouseOver="toolTip('Cancelar',this)" class="boton cancelar" onClick="redireccionar('../Consultar/frmConsultarUsuario.php')">
					</form>
					<center>
						<div id="mensaje1" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta llenar el nombre completo!!&nbsp;&nbsp;</span></div>
						<div id="mensaje2" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta el nombre de usuario!!&nbsp;&nbsp;</span></div>
						<div id="mensaje3" class="oculto"><span class="alerta error">&nbsp;&nbsp;Falta la contrase&ntilde;a!!&nbsp;&nbsp;</span></div>
						<div id="mensaje4" class="oculto"><span class="alerta error">&nbsp;&nbsp;Ese nombre de usuario ya esta registrado!!&nbsp;&nbsp;</span></div>
					</center>
				</td>
			</tr>
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>