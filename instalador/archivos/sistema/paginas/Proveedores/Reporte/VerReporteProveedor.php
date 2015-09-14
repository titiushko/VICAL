<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoRecolector.php";
include "../../../librerias/funciones.php";

$instruccion_select = "
SELECT
codigo_proveedor,
nombre_proveedor,
tipos_empresas.nombre_tipo_empresa,
departamento,
direccion_proveedor,
telefono_proveedor1,
telefono_proveedor2,
contacto,
estanon
FROM
proveedores
JOIN
tipos_empresas
WHERE tipos_empresas.codigo_tipo_empresa = proveedores.codigo_tipo_empresa
ORDER BY codigo_proveedor ASC";
$consulta_proveedores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedores!!</SPAN>".mysql_error());
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
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico"></link>
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript"	 src="../../../librerias/funciones.js"></script>
	</head>
	<BODY class="cuerpo1">
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr class="oculto">
				<td>
					<span>Buscar</span>
					<select id="columns" onchange="sorter.search('query')"></select>
					<input type="text" id="query" onkeyup="sorter.search('query')"/>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<img src="../../../imagenes/logo VICAL.png">
					<br>
					<h1 align='center' class='encabezado1'>REPORTE DE PROVEEDORES</h1>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead class="manita">
							<tr>
								<th onMouseOver="toolTip('Ordenar por codigo',this)"><h3>Codigo</h3></th>
								<th onMouseOver="toolTip('Ordenar por nombre',this)"><h3>Nombre Empresa</h3></th>
								<th onMouseOver="toolTip('Ordenar por tipo',this)"><h3>Tipo Empresa</h3></th>
								<th onMouseOver="toolTip('Ordenar por departamento',this)"><h3>Departamento</h3></th>
								<th onMouseOver="toolTip('Ordenar por direccion',this)"><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direccion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></th>
								<th onMouseOver="toolTip('Ordenar por telefono1',this)"><h3>Telefono1</h3></th>
								<th onMouseOver="toolTip('Ordenar por telefono2',this)"><h3>Telefono2</h3></th>
								<th onMouseOver="toolTip('Ordenar por contacto',this)"><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contacto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></th>
								<th><h3>Esta&ntilde;on</h3></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$registros = 1;	$paginas = 1;
							while ($proveedores = mysql_fetch_array($consulta_proveedores)){
							?>
							<tr align="center">
							<!--==================================-->
							<?php if($proveedores[0] <> NULL){ ?>
								<td><?php echo $proveedores[0];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[1] <> NULL){ ?>
								<td><?php echo $proveedores[1];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[2] <> NULL){ ?>
								<td><?php echo $proveedores[2];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[3] <> NULL){ ?>
								<td><?php echo $proveedores[3];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[4] <> NULL){ ?>
								<td><?php echo $proveedores[4];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[5] <> NULL){ ?>
								<td><?php echo $proveedores[5];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[6] <> NULL){ ?>
								<td><?php echo $proveedores[6];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[7] <> NULL){ ?>
								<td><?php echo $proveedores[7];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[8] <> NULL){ ?>
								<td><?php echo $proveedores[8];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							</tr>
							<?php
								if($registros == 30){$registros = 1;	$paginas++;} else{$registros++;}
							}
							?>
						</tbody>
					</table>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center">
					<span id="tablenav">
						<img src="../../../imagenes/mostrar_primero.png" width="6%" height="6%" alt="Primera Pagina" onMouseOver="toolTip('Ir a la primera pagina',this)" onClick="sorter.move(-1,true)" class="manita">
						<img src="../../../imagenes/mostrar_anterior.png" width="6%" height="6%" alt="Anterior Pagina" onMouseOver="toolTip('Ir a la pagina anterior',this)" onClick="sorter.move(-1)" class="manita">
						<img src="../../../imagenes/mostrar_siguiente.png" width="6%" height="6%" alt="Siguiente Pagina" onMouseOver="toolTip('Ir a la pagina siguiente',this)" onClick="sorter.move(1)" class="manita">
						<img src="../../../imagenes/mostrar_ultimo.png" width="6%" height="6%" align="top" alt="Ultima Pagina" onMouseOver="toolTip('Ir a la ultima pagina',this)" onClick="sorter.move(1,true)" class="manita">								
						<span class="subtitulo2">Ir a la Pagina</span>
						<select id="pagedropdown" onMouseOver="toolTip('Seleccionar pagina',this)"></select>
					</span>
				</td>
				<td align="right" class="subtitulo2">
					Registros
					<span id="startrecord"></span>-<span id="endrecord"></span> de <span id="totalrecords"></span>
					/
				</td>
				<td id="tablelocation">
					<span class="subtitulo2">
						Pagina <span id="currentpage"></span> de <span id="totalpages"></span>
					</span>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<script type="text/javascript" src="../../../librerias/jquery/tinytable.js"></script>
			<script type="text/javascript">
				var sorter = new TINY.table.sorter('sorter','registros',{
					paginate:true,
					size:10,
					colddid:'columns',
					currentid:'currentpage',
					totalid:'totalpages',
					startingrecid:'startrecord',
					endingrecid:'endrecord',
					totalrecid:'totalrecords',
					pageddid:'pagedropdown',
					navid:'tablenav',
					hoverid:'fila',
					sortcolumn:0,
					sortdir:1,
					init:true
				});
			</script>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		</table>
		<!----------------------------------------------------------------------------------------------------->
		<br><center><?php echo hoyEs();?></center>
		<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
		<table align="center">
			<tr>
				<td>
					<FORM ACTION="ExportarReporteProveedor.php" METHOD="post">
						<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar">
					</FORM>
				</td>
				<td>
					<FORM ACTION="ImprimirReporteProveedor.php" METHOD="post">
						<input name="Imprimir" type="submit" value="Imprimir" onMouseOver="toolTip('Imprimir',this)" class="boton imprimir">
					</FORM>
				</td>
			</tr>		
		</table>
		<?php } ?>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<span id="toolTipBox" width="50"></span>
		<center><img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('../../../interfaz/frame_contenido.html');" class="manita"></center>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php
$_SESSION["total_paginas"] = $paginas;
include "../../../librerias/cerrar_conexion.php";
?>