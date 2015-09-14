<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
$direccion = "../Consultar/frmConsultarCentroAcopio.php";
$instruccion_select = "
SELECT
codigo_centro_acopio,
nombre_centro_acopio,
departamento,
recolectores.nombre_recolector
FROM
centros_de_acopio
JOIN recolectores
WHERE centros_de_acopio.codigo_recolector = recolectores.codigo_recolector";
$consulta_centros_de_acopio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centros_de_acopio!!</SPAN>".mysql_error());
?>
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
		<script type="text/javascript" 	 src="../../../librerias/jquery/subsection tabs.prototype.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/dw_tooltips/dw_event.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/dw_tooltips/dw_viewport.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/dw_tooltips/dw_tooltip.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/dw_tooltips/dw_tooltip_aux.js"></script>
		<script>
			document.observe('dom:loaded',function(){
				new Control.Tabs('criterios');
			});
			
			dw_Tooltip.content_vars = {
				L1: 'Ahuachapan',	L2: 'Santa Ana',	L3: 'Sonsonate',	L4: 'Usulutan',	L5: 'San Miguel',	L6: 'Morazan',	L7: 'La Union',
				L8: 'La Libertad',	L9: 'Chalatenango',	L10: 'Cuscatlan',	L11: 'San Salvador',	L12: 'La Paz',	L13: 'Caba&ntilde;as',	L14: 'San Vicente'
			}
		</script>
		<style>.tinytable{width: 80%;}</style>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">CONSULTAR CENTROS DE ACOPIO</h1>
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<tr>
				<td align="center">
				<?php
				$cantidad_centros_de_acopio = mysql_query("SELECT count(codigo_centro_acopio) cantidad FROM centros_de_acopio", $conexion) or die ("<SPAN CLASS='error'>Fallo en cantidad_centros_de_acopio!!</SPAN>".mysql_error());
				$cantidad = mysql_fetch_array($cantidad_centros_de_acopio);
				if($cantidad[0] <> 0){
				?>
<!---------------------------------------------------------------------------------------------------------------------------------->
				<table id="main" class="marco" width="100%"><tr><td>
<!---------------------------------------------------------------------------------------------------------------------------------->
					<br>
					<ul id="criterios" class="subsection_tabs">
						<li class="tab"><a class="" href="#lista">Lista</a></li>
						<li class="tab"><a class="active" href="#mapa">Mapa</a></li>
					</ul>					
<!---------------------------------------------------------------------------------------------------------------------------------->
					<div style="display: none;" id="lista">
					<table align="center">
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
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
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<tr>
							<td align="center" colspan="3">
								<table cellpadding="0" cellspacing="0" id="table" class="tinytable">
									<thead class="titulo1">
										<tr>
											<th onMouseOver="toolTip('Ordenar por codigo',this)" width="120"><h3>Codigo</h3></th>
											<th onMouseOver="toolTip('Ordenar por nombre',this)" width="280"><h3>Nombre</h3></th>
											<th onMouseOver="toolTip('Ordenar por departamento',this)" width="180"><h3>Departamento</h3></th>
											<th onMouseOver="toolTip('Ordenar por encargado',this)" width="280"><h3>Encargado</h3></th>
											<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
											<th class="nosort" width="100"><h3></h3></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody class="subtitulo2">
										<?php while ($centros_de_acopio = mysql_fetch_array($consulta_centros_de_acopio)){ ?>
										<tr align="center">
											<td><?php echo "<a title='Ver' style='color: black;'href='VerCentroAcopio.php?departamento=$centros_de_acopio[0]'>".$centros_de_acopio[0]."</a>";?></td>
											<td><?php echo "<a title='Ver' style='color: black;'href='VerCentroAcopio.php?departamento=$centros_de_acopio[0]'>".$centros_de_acopio[1]."</a>";?></td>
											<td><?php echo "<a title='Ver' style='color: black;'href='VerCentroAcopio.php?departamento=$centros_de_acopio[0]'>".$centros_de_acopio[2]."</a>";?></td>
											<td><?php echo "<a title='Ver' style='color: black;'href='VerCentroAcopio.php?departamento=$centros_de_acopio[0]'>".$centros_de_acopio[3]."</a>";?></td>
											<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
											<td>
												<img src="../../../imagenes/icono_modificar.png" align="top" title="Modificar" <?php echo "onClick=\"redireccionar('../Modificar/frmModificarCentroAcopio.php?modificar_centro_de_acopio=$centros_de_acopio[0]&direccion=$direccion');\"";?> class="manita">
												<img src="../../../imagenes/icono_eliminar.png" align="top" title="Eliminar" <?php echo "onClick=\"redireccionar('../Eliminar/frmEliminarCentroAcopio.php?eliminar_centro_de_acopio=$centros_de_acopio[0]&direccion=$direccion');\"";?> class="manita">
											</td>
											<?php } ?>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</td>
						</tr>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
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
								<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
								<img src="../../../imagenes/icono_agregar.png" align="top" onClick="redireccionar('../Nuevo/frmNuevoCentroAcopio.php?departamento=dep')" onMouseOver="toolTip('Agregar un nuevo Centro de Acopio',this)" class="manita">
								<?php } ?>
								<img src="../../../imagenes/icono_recargar.png" align="top" onClick="redireccionar('frmConsultarCentroAcopio.php');" onMouseOver="toolTip('Actualizar',this)" class="manita">
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
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<script type="text/javascript" src="../../../librerias/jquery/tinytable.js"></script>
						<script type="text/javascript" src="../../../librerias/jquery/tinytable.options.js"></script>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						<span id="toolTipBox" width="50"></span>
						<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					</table>
					</div>
<!---------------------------------------------------------------------------------------------------------------------------------->
					<div style="display: none;" id="mapa" align="center">
						<br>
						<map name="el_salvador" id="el_salvador">
							<area class="showTip L1" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=1";?>"		shape="circle" 	coords="74,268,40"/>
							<area class="showTip L2" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=2";?>"		shape="circle" 	coords="186,204,40"/>
							<area class="showTip L3" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=3";?>"		shape="circle" 	coords="154,313,40"/>
							<area class="showTip L4" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=4";?>"		shape="circle" 	coords="511,393,40"/>
							<area class="showTip L5" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=5";?>"		shape="circle" 	coords="615,386,40"/>
							<area class="showTip L6" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=6";?>"		shape="circle" 	coords="647,289,40"/>
							<area class="showTip L7" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=7";?>"		shape="circle" 	coords="704,367,40"/>
							<area class="showTip L8" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=8";?>" 		shape="circle" 	coords="244,329,40"/>
							<area class="showTip L9" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=9";?>"		shape="circle" 	coords="332,152,40"/>
							<area class="showTip L10" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=10";?>" 	shape="circle" 	coords="370,288,30"/>
							<area class="showTip L11" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=11";?>" 	shape="circle" 	coords="311,302,30"/>
							<area class="showTip L12" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=12";?>" 	shape="circle" 	coords="371,376,40"/>
							<area class="showTip L13" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=13";?>"	shape="circle" 	coords="467,248,40"/>
							<area class="showTip L14" href="VerCentroAcopioDepartamento.php<?php echo "?departamento=14";?>" 	shape="circle" 	coords="447,327,40"/>
						</map>
						<img src="../../../imagenes/mapa.png" width="780" height="580" usemap="#el_salvador"/>
						<!--<a href="/cgi-bin/imagemap/mimapa"><img src="../../../imagenes/mapa.png" width="790" height="590" ismap></a>-->
					</div>
					<br>
<!---------------------------------------------------------------------------------------------------------------------------------->
				</td></tr></table>
				<?php } else{ ?>
				<h2 align="center" class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO GENERAR LA LISTA DE CENTROS DE ACOPIO!!</h2>
				<table align="center" class="alerta error centro">
					<tr>
						<td align="center" colspan="3">
							No hay centros de acopio registrados en el sistema.<br><br>
							<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
							Desea realizar el Registro de un Nuevo Centro de Acopio?.<br>
							<img src="../../../imagenes/icono_agregar.png" align="top" onClick="redireccionar('../Nuevo/frmNuevoCentroAcopio.php?departamento=dep')" onMouseOver="toolTip('Agregar un nuevo Centro de Acopio',this)" class="manita">
							<?php } ?>
							<img src="../../../imagenes/icono_cancelar.png" align="top" onClick="redireccionar('../../../interfaz/frame_contenido.php')" onMouseOver="toolTip('Cancelra, volver al Inicio',this)" class="manita">
						</td>
					</tr>
				</table>
				<?php } ?>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<script type="text/javascript" src="../../../librerias/jquery/tinytable.js"></script>
				<script type="text/javascript" src="../../../librerias/jquery/tinytable.options.js"></script>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<span id="toolTipBox" width="50"></span>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!---------------------------------------------------------------------------------------------------------------------------------->
				</td>
			</tr>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>