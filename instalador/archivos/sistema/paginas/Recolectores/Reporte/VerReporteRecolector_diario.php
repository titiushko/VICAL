<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../librerias/funciones.php";
$recolcetor = $_REQUEST['seleccionar_recolector'];
$anio=$_REQUEST['seleccionar_ano'];
$mes=$_REQUEST['seleccionar_mes'];
if($mes==1){ 	$nombre_mes="Enero"; 		$mes='01';}else
if($mes==2){	$nombre_mes="Febrero";		$mes='02';}else
if($mes==3){	$nombre_mes="Marzo";		$mes='03';}else
if($mes==4){	$nombre_mes="Abril";		$mes='04';}else
if($mes==5){	$nombre_mes="Mayo";			$mes='05';}else
if($mes==6){	$nombre_mes="Junio";		$mes='06';}else
if($mes==7){	$nombre_mes="Julio";		$mes='07';}else
if($mes==8){	$nombre_mes="Agosto";		$mes='08';}else
if($mes==9){	$nombre_mes="Septiembre";	$mes='09';}else
if($mes==10)	$nombre_mes="Octubre";		else
if($mes==11)	$nombre_mes="Noviembre";	else
if($mes==12)	$nombre_mes="Diciembre";

$instruccion = "
SELECT
facturas.fecha,
centros_de_acopio.departamento,
proveedores.nombre_proveedor,
vidrio.cantidad_vidrio,
vidrio.precio_vidrio
FROM
facturas,
vidrio,
recolectores,
centros_de_acopio,
proveedores
WHERE
nombre_recolector = '$recolcetor'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND centros_de_acopio.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_proveedor = proveedores.codigo_proveedor
AND facturas.codigo_factura = vidrio.codigo_factura
ORDER BY fecha ASC";
$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$recolectores = mysql_fetch_array($consulta);
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
		<script type="text/javascript" src="../../../librerias/funciones.js"></script>
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
					<h1 align='center' class='encabezado1'>REPORTE DE COMPRAS POR RECOLECTORES</h1>
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado al Dia por <?php echo $recolcetor; ?> en el mes de <?php echo $nombre_mes." de ".$anio; ?>"</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead class="manita">
							<tr>
								<th onMouseOver="toolTip('Ordenar por codigo',this)"><h3>Fecha</h3></th>
								<th onMouseOver="toolTip('Ordenar por departamento',this)"><h3>Centro de Acopio</h3></th>
								<th onMouseOver="toolTip('Ordenar por proveedor',this)"><h3>Proveedor</h3></th>
								<th onMouseOver="toolTip('Ordenar por cantidad',this)"><h3>Cantidad</h3></th>
								<th onMouseOver="toolTip('Ordenar por monto',this)"><h3>Monto</h3></th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($registros = mysql_fetch_array($consulta)){
							?>
							<tr align="center">
								<td><?php echo $registros[0];?></td>
								<td><?php echo $registros[1];?></td>
								<td><?php echo $registros[2];?></td>
								<td><?php echo $registros[3];?></td>
								<td><?php echo $registros[4];?></td>
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
					sortcolumn:0,
					sortdir:1,
					avg:[6,7,8,9],
					columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
					init:true
				});
			</script>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		</table>
		<!----------------------------------------------------------------------------------------------------->
		<br><center><?php echo hoyEs();?></center>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<span id="toolTipBox" width="50"></span>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<?php if($_SESSION["tipo_usuario"] == "1"){ ?>
		<table align="center">
			<tr>
				<td>
					<?php echo"<FORM ACTION='ExportarReporteRecolector_diario.php?valor_recolector=$recolcetor' METHOD='post'>"; ?>
					<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar">
					</FORM>
				</td>
				<td>		
					<?php echo"<FORM ACTION='ImprimirReporteRecolector_diario.php?valor_recolector=$recolcetor' METHOD='post'>"; ?>
					<input name="Imprimir" type="submit" value="Imprimir" onMouseOver="toolTip('Imprimir',this)" class="boton imprimir">
					</FORM>
				</td>
			</tr>		
		</table>
		<?php } ?>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<center><img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita"></center>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>