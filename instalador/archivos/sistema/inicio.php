<!DOCTYPE html PUBLIC "-//WRC//DTD HTML 4.01 Transitional//EN">
<HTML> 
	<head>
		<title>SCYCPVES</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="Tito">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="imagenes/vical.ico" />
	</head>
	<frameset rows="*" cols="*,195" frameborder="no" border="0" framespacing="0">
		<frameset rows="30,*" cols="*" border="0" framespacing="0">
			<frame name="SOMBRA" src="interfaz/frame_sombra.html" noresize marginwidth="0" marginheight="0">
			<frame name="CONTENIDO" src="interfaz/frame_contenido.php" noresize marginwidth="0" marginheight="0">
		</frameset>
		<frameset rows="30,*" cols="*" frameborder="no" border="0" framespacing="0">
			<frame name="ESQUINA" src="interfaz/frame_esquina.html" scrolling="no" noresize marginwidth="0" marginheight="0">
			<frameset rows="*" cols="15,*" frameborder="no" border="0" framespacing="0">
				<frame name="DERECHA"src="interfaz/frame_derecha.html" scrolling="no" noresize marginwidth="0" marginheight="0">
				<?php
				$tipo_usuario = array(1=>"administrador",2=>"contador",3=>"recolector",);
				session_start();
				?>
				<frame name="MENU"src="interfaz/frame_menu_<?php echo $tipo_usuario[$_SESSION["tipo_usuario"]];?>.php" scrolling="no" noresize marginwidth="0" marginheight="0">
			</frameset>
		</frameset>
	</frameset>
</HTML>