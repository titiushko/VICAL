<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";

$instruccion_select = "
SELECT facturas.codigo_factura, facturas.fecha, recolectores.nombre_recolector, proveedores.nombre_proveedor, facturas.sucursal, centros_de_acopio.nombre_centro_acopio, facturas.precio_compra
FROM facturas, recolectores, proveedores, centros_de_acopio
WHERE facturas.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
AND facturas.codigo_centro_acopio = centros_de_acopio.codigo_centro_acopio";
$consulta_factura = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());
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
		<style>.tinytable{width: 100%;}</style>
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">CONSULTAR COMPRAS</h1>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td>
					<?php					
					$cantidad_facturas = mysql_query("SELECT count(codigo_factura) cantidad FROM facturas", $conexion) or die ("<SPAN CLASS='error'>Fallo en cantidad_facturas!!</SPAN>".mysql_error());
					$cantidad = mysql_fetch_array($cantidad_facturas);
					if($cantidad[0] <> 0){
					?>
					<table align="center" class="marco">
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
											<th onMouseOver="toolTip('Ordenar por factura',this)" width="125"><h3>Factura</h3></th>
											<th onMouseOver="toolTip('Ordenar por fecha',this)" width="120"><h3>Fecha</h3></th>
											<th onMouseOver="toolTip('Ordenar por recolector',this)" width="285"><h3>Recolector</h3></th>
											<th onMouseOver="toolTip('Ordenar por proveedor',this)" width="285"><h3>Proveedor</h3></th>
											<th onMouseOver="toolTip('Ordenar por sucursal',this)" width="125"><h3>Sucursal</h3></th>
											<th onMouseOver="toolTip('Ordenar por c. acopio',this)" width="200"><h3>C. Acopio</h3></th>
											<th onMouseOver="toolTip('Ordenar por precio',this)" width="125"><h3>Precio</h3></th>
										</tr>
									</thead>
									<tbody class="subtitulo2">
										<?php
										while ($facturas = mysql_fetch_array($consulta_factura)){
										?>
										<tr align="center" title="Click para ver la factura" onClick="redireccionar('VerCompra.php?valor=<?php echo $facturas[0]?>');">
											<td><span class="manita"><?php echo $facturas[0];?></span></td>
											<td><span class="manita"><?php echo $facturas[1];?></span></td>
											<td><span class="manita"><?php echo $facturas[2];?></span></td>
											<td><span class="manita"><?php echo $facturas[3];?></span></td>
											<td><span class="manita"><?php echo $facturas[4];?></span></td>
											<td><span class="manita"><?php echo $facturas[5];?></span></td>
											<td><span class="manita"><?php echo "$".number_format($facturas[6],2,'.',',');?></span></td>
										</tr>
										<?php
										}
										?>
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
								<img src="../../../imagenes/icono_agregar.png" align="top" onClick="redireccionar('../Nueva/frmNuevaCompra.php<?php echo "?valor_nombre_recolector=nueva_compra";?>')" onMouseOver="toolTip('Agregar una nueva Compra de Vidrio',this)" class="manita">
								<?php } ?>
								<img src="../../../imagenes/icono_recargar.png" align="top" onClick="redireccionar('frmConsultarCompra.php');" onMouseOver="toolTip('Actualizar',this)" class="manita">
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
					<?php } else{ ?>
					<h2 align="center" class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO GENERAR LA LISTA DE COMPRAS DE VIDRIO!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">
								No hay compras de vidrio registradas en el sistema.<br><br>
								<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
								Desea realizar el Registro de una Nueva Compra de Vidrio?.<br>
								<img src="../../../imagenes/icono_agregar.png" align="top" onClick="redireccionar('../Nueva/frmNuevaCompra.php<?php echo "?valor_nombre_recolector=nueva_compra";?>')" onMouseOver="toolTip('Agregar una nueva Compra de Vidrio',this)" class="manita">
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
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>				
		</table>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>