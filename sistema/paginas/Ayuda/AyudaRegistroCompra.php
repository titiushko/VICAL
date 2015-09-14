<?php include "VerificarAcceso.php"; ?>
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
					<h1 class="encabezado1">AYUDA REGISTRO DE COMPRAS</h1>
					<h2 class="encabezado2">Como Registrar una Nueva Compra de Vidrio</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td colspan="2" align="center">
					<table align="center" class="marco" width="95%">
						<tr>
							<td align="center">
								<table>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;">Fecha:</td>
										<td align="justify" class="subtitulo1">
											Aqu&iacute; podr&aacute; seleccionar la fecha en la que se realizo la compra del vidrio.<br>
											De click en el icono <img src="../../imagenes/icono_calendario.png" width="3%" height="4%"> para mostrar un peque&ntilde;o calendario y buscar la fecha que el comprobante de compras tiene marcado.<br>
											Seleccione el mes y el a&ntilde;o de las listas que muestra el calendario y a continuacion seleccion el dia. Si no selecciona ninguna fecha, de click en el icono <img src="../../imagenes/close_over.gif"> para cerrar el calendario.<br>
											Este campo no lo puede dejar sin llenar.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;" width="160">No (Numero de Factura):</td>
										<td align="justify" class="subtitulo1">
											Digite aqu&iacute; el n&uacute;mero de factura correlativo del comprobante de compra que registrara en el sistema. Este campo no admite n&uacute;meros de facturas repetidos, que ya han sido registrados anteriormente al sistema.<br>
											Este campo no lo puede dejar sin llenar.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;">Recolector:</td>
										<td align="justify" class="subtitulo1">
											Seleccione de la lista el nombre del recolector quien realizo la compra de vidrio, expresado en el comprobante de compras, para registrar la compra en el sistema.<br>
											Al seleccionar un recolector, el codigo de este aparecer&aacute; seleccionado en el campo <font color="white"><b>Codigo.</b></font><br>
											Si prefiere buscar el recolector por codigo, se presenta un listado con los codigos de los recolectores. Al seleccionar un codigo de recolector, el nombre de este aparecer&aacute; seleccionado en el campo <font color="white"><b>Recolector.</b></font><br><br>
											Si el recolector que busca no aparece en el listado, puede registrar el recolector como nuevo dando click en el icono agregar <img src="../../imagenes/icono_agregar.png" width="3%" height="4%"> para dirigirse al formulario <font color="white"><b>Registro de Recolector.</b></font><br>
											Este campo no lo puede dejar sin llenar.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;">Proveedor:</td>
										<td align="justify" class="subtitulo1">
											Seleccione de la lista el nombre del proveedor al que se le realizo la compra de vidrio, expresado en el comprobante de compras, para registrar la compra en el sistema.<br>
											Al seleccionar un proveedor, el codigo de este aparecer&aacute; seleccionado en el campo <font color="white"><b>Codigo.</b></font><br>
											Si prefiere buscar el proveedor por codigo, se presenta un listado con los codigos de los proveedores. Al seleccionar un codigo de proveedor, el nombre de este aparecer&aacute; seleccionado en el campo <font color="white"><b>Proveedor.</b></font><br><br>
											Si el proveedor que busca no aparece en el listado, puede registrar el proveedor como nuevo dando click en el icono agregar <img src="../../imagenes/icono_agregar.png" width="3%" height="4%"> para dirigirse al formulario <font color="white"><b>Registro de Proveedor.</b></font><br>
											Este campo no lo puede dejar sin llenar.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;" width="160">Sucursal:</td>
										<td align="justify" class="subtitulo1">
											Seleccione de la lista la sucursal a la que se le realizo la compra de vidrio.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;" width="160">Vidrio Comprado:</td>
										<td align="justify" class="subtitulo1">
											En la tabla se muestra dividido por tipos de vidrio y por colores de vidrio en la cual usted solo debe digitar la cantidad en qu&iacute;tales del detalle de la compra que se realizo. El monto de la compra ser&aacute; calculado por el sistema.<br>
											En esta tabla al menos debe digitar una cantidad de vidrio para registrar la compra de vidrio exitosamente.
											<hr>
										</td>
									</tr>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<tr>
										<td align="right" class="titulo1" style="vertical-align:text-top;" width="160">Registrar la Compra:</td>
										<td align="justify" class="subtitulo1">
											Cuando haya terminado de llenar los campos del formulario que se requieren, haga click en el bot&oacute;n Registrar <img src="../../imagenes/icono_aceptar.png" width="3%" height="4%"> para terminar con el registro de una nueva compra de vidrio.<br>
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
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>