<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
$archivos = informacionArchivo("c:\\wamp\\www\\backup\\");
$cantidad = count($archivos);
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/subsection tabs.prototype.js"></script>
		<script>
			document.observe('dom:loaded',function(){
				new Control.Tabs('criterios');
			});
		</script>
		<style>.tinytable{width: 80%;}</style>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">RESPALDO Y RECUPERACION DE LA BASE DE DATOS</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table id="main" class="marco" width="100%">
						<tr>
							<td align="center">
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<br>
								<ul id="criterios" class="subsection_tabs">
									<li class="tab"><a class="active" href="#respaldo">Respaldo</a></li>
									<li class="tab"><a class="" href="#recuperacion">Recuperacion</a></li>
								</ul>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<div style="display: none;" id="respaldo">
									<br>
									<span class="titulo1"><b>Hacer un Respaldo de la Base de Datos</b></span>
									<br><br>
									<a href="CargarRespaldoRecuperacionBaseDatos.php?nombre_respaldo=Recuperacion" onMouseOver="toolTip('Respaldo de la Base de Datos',this)"><img src="../../../imagenes/icono_basedatos_respaldo.png"></a>
									<br>
									<br>
								</div>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<div style="display: none;" id="recuperacion">
									<br>
									<span class="titulo1"><b>Hacer una Recuperaci&oacute;n de la Base de Datos</b></span>
									<br><br>
									<?php if($archivos == 0){ ?>
									<table align="center" class="alerta error centro">
										<tr>
											<td align="center">
												No hay Respaldos de la Base de Datos del sistema.
												<br>
												Desea realizar un Respaldo de la Base de Datos?.
												<br>
												<br>
												<a href="CargarRespaldoRecuperacionBaseDatos.php?nombre_respaldo=Recuperacion" onMouseOver="toolTip('Respaldo de la Base de Datos',this)"><img src="../../../imagenes/icono_basedatos_respaldo.png"></a>
												<img src="../../../imagenes/icono_cancelar.png" align="top" onClick="redireccionar('../../../interfaz/frame_contenido.php')" onMouseOver="toolTip('Cancelra, volver al Inicio',this)" class="manita">
											</td>
										</tr>
									</table>
									<br>
									<?php
									}
									else{
									?>
									<table align="center">
										<tr>
											<td>
												<span class="subtitulo2">Buscar</span>
												<select id="columns" onchange="sorter.search('query')"></select>
												<input type="text" id="query" onkeyup="sorter.search('query')"/>
											</td>
											<td>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
											<td align="right" class="subtitulo2">
												Registros
												<span id="startrecord"></span>-<span id="endrecord"></span> de <span id="totalrecords"></span>
											</td>
										</tr>
										<tr>
											<td align="center" colspan="3">
												<table cellpadding="0" cellspacing="0" id="table" class="tinytable">
													<thead class="titulo1">
														<tr>
															<th onMouseOver="toolTip('Ordenar por fecha de creaci&oacute;n',this)"><h3>Fecha de Creaci&oacute;n</h3></th>
															<th onMouseOver="toolTip('Ordenar por tama&ntilde;o',this)"><h3>Tama&ntilde;o</h3></th>
															<th class="nosort"><h3></h3></th>
														</tr>
													</thead>
													<tbody class="subtitulo2">
														<?php for($i=1; $i<=$cantidad; $i++){ ?>
														<tr align="center">
															<td><?php echo $archivos[$i]['fecha'];?></td>
															<td><?php echo $archivos[$i]['tamano'];?></td>
															<td>
																<img src="../../../imagenes/icono_basedatos_recuperar.png" align="top" onMouseOver="toolTip('Recuperar este respaldo de la base de datos',this)" <?php echo "onClick=\"redireccionar('CargarRespaldoRecuperacionBaseDatos.php?nombre_respaldo=".$archivos[$i]['nombre']."');\"";?> class="manita">
																<img src="../../../imagenes/icono_basedatos_eliminar.png" align="top" onMouseOver="toolTip('Eliminar este respaldo de la base de datos',this)" <?php echo "onClick=\"redireccionar('EliminarRespaldoBaseDatos.php?nombre_respaldo=".$archivos[$i]['nombre']."');\"";?> class="manita">
															</td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td>
												<span id="tablenav">
													<img src="../../../imagenes/mostrar_primero.png" width="6%" height="6%" alt="Primera Pagina" onMouseOver="toolTip('Ir a la primera pagina',this)" onClick="sorter.move(-1,true)" class="manita">
													<img src="../../../imagenes/mostrar_anterior.png" width="6%" height="6%" alt="Anterior Pagina" onMouseOver="toolTip('Ir a la pagina anterior',this)" onClick="sorter.move(-1)" class="manita">
													<img src="../../../imagenes/mostrar_siguiente.png" width="6%" height="6%" alt="Siguiente Pagina" onMouseOver="toolTip('Ir a la pagina siguiente',this)" onClick="sorter.move(1)" class="manita">
													<img src="../../../imagenes/mostrar_ultimo.png" width="6%" height="6%" align="top" alt="Ultima Pagina" onMouseOver="toolTip('Ir a la ultima pagina',this)" onClick="sorter.move(1,true)" class="manita">								
													<select id="pagedropdown" onMouseOver="toolTip('Seleccionar pagina',this)"></select>
													<span class="subtitulo2"><a href="javascript:sorter.showall()" onMouseOver="toolTip('Ver todos los registros',this)">Ver todos</a></span>
												</span>
											</td>
											<td>
												<img src="../../../imagenes/icono_recargar.png" align="top" onClick="redireccionar('frmRespaldoRecuperacionBaseDatos.php');" onMouseOver="toolTip('Actualizar',this)" class="manita">
												<img src="../../../imagenes/icono_cancelar.png" align="top" onClick="redireccionar('../../../interfaz/frame_contenido.php')" onMouseOver="toolTip('Cancelra, volver al Inicio',this)" class="manita">
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											</td>
											<td id="tablelocation">
												<span class="subtitulo2">Entradas por pagina</span>
												<select onchange="sorter.size(this.value)" onMouseOver="toolTip('Cantidad de registros a mostrar',this)">
													<option value="5">5</option>
													<option value="10" selected="selected">10</option>
													<option value="20">20</option>
													<option value="50">50</option>
													<option value="100">100</option>
												</select>
												<span class="subtitulo2">
													Pagina <span id="currentpage"></span> de <span id="totalpages"></span>
												</span>
											</td>
										</tr>
									</table>
									<?php
									}
									?>
								</div>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							</td>
						</tr>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<script type="text/javascript" src="../../../librerias/jquery/tinytable.js"></script>
					<script type="text/javascript" src="../../../librerias/jquery/tinytable.options.js"></script>
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>