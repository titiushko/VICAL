<?php include "VerificarAcceso.php"; ?>
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
		<link rel="shortcut icon" 		 href="../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../imagenes/ayuda.png" width="12%" height="5%">
					<h1 class="encabezado1">AYUDA ESTADISTICA DE PROVEEDORES POR TIPO DE VIDRIO</h1>
					<h2 class="encabezado2">Como Seleccionar los Criterios para generar las Estad&iacute;sticas de Proveedores</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2" align="center">
					<table align="center" class="marco" width="95%">
						<!--------------------------------CODIGO---------------------------------->
						<tr>
							<td align="center">
								<table>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;" width="160">A&ntilde;o:</td>
										<td align="justify" class="subtitulo1">
											Seleccione el a&ntilde;o del periodo de an&aacute;lisis para generar la estad&iacute;stica.<br>
											Este campo no lo puede dejar sin llenar.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;">Proveedor:</td>
										<td align="justify" class="subtitulo1">
											Seleccione de la lista el proveedor para hacer el an&aacute;lisis de estad&iacute;sticas de vidrio comprado al proveedor.<br>
											Consejo: puede ir digitando el nombre la empresa para buscar mas r&aacute;pido al proveedor.<br>
											No puede dejar sin seleccionar el proveedor.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;">Cantidad a Mostrar:</td>
										<td align="justify" class="subtitulo1">
											Entre estas opciones puede elegir ver las estad&iacute;sticas del vidrio comprado al proveedor seleccionado por cantidad en quinatales contra el periodo de an&aacute;lisis o las estad&iacute;sticas del vidrio comprado en cantidad de efectivo del monto invertido al proveedor seleccionado contra el periodo de an&aacute;lisis.<br>
											Este campo no lo puede dejar sin llenar.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;">Tipo de Vidrio:</td>
										<td align="justify" class="subtitulo1">
											Seleccione de la lista el tipo de vidrio que desea ver, comprado al proveedor, para generar la grafica de la estad&iacute;stica.<br>
											Estas opciones son para ver que tipo de vidrio se le compra mas a un determinado proveedor.<br>
											No puede dejar sin seleccionar el tipo de vidrio.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;" width="160">Mostrar Estadistica:</td>
										<td align="justify" class="subtitulo1">
											Cuando haya terminado de seleccionar los elementos para ver las estad&iacute;sticas, haga click en el bot&oacute;n Mostrar <img src="../../imagenes/icono_graficar.png" width="3%" height="4%"> para graficar las estad&iacute;sticas del proveedor por tipo de vidrio.<br>
											Si desea reestablecer todos los campos del formulario de click en el bot&oacute;n Limpiar <img src="../../imagenes/icono_limpiar.png" width="3%" height="4%"> o click al bot&oacute;n Cancelar <img src="../../imagenes/icono_cancelar.png" width="3%" height="4%"> para salir del formulario.
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								</table>
							</td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
					<span id="toolTipBox" width="50"></span>
					<img src="../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita">
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>