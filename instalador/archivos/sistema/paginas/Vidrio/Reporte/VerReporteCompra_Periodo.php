<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../librerias/funciones.php";
$nombre_mes = $_REQUEST['seleccionar_mes'];
$ano 		= $_REQUEST['seleccionar_ano'];
if($nombre_mes== '' || $ano == '') header("Location: frmReporteCompra.php");

$mes = '';
if($nombre_mes == 'Enero') $mes = '01';
if($nombre_mes == 'Febrero') $mes = '02';
if($nombre_mes == 'Marzo') $mes = '03';
if($nombre_mes == 'Abril') $mes = '04';
if($nombre_mes == 'Mayo') $mes = '05';
if($nombre_mes == 'Junio') $mes = '06';
if($nombre_mes == 'Julio') $mes = '07';
if($nombre_mes == 'Agosto') $mes = '08';
if($nombre_mes == 'Septiembre') $mes = '09';
if($nombre_mes == 'Octubre') $mes = '10';
if($nombre_mes == 'Noviembre') $mes = '11';
if($nombre_mes == 'Diciembre') $mes = '12';

$registros = 1;	$paginas = 1;
$recibos = calcularSumaFacturaPeriodo($mes,$ano);
$permino = false;
if($recibos[1][3] <> 0 && $recibos[1][4] <> 0)	$permino = true;
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
		<script type="text/javascript" 	 src="../../../librerias/funciones.js"></script>
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
				<td></td><td></td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<img src="../../../imagenes/logo VICAL.png">
					<br>
					<h1 align='center' class='encabezado1'>REPORTE DE COMPRAS</h1>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<?php
if(!$permino){
?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR EL REPORTE DE COMPRAS!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">No hay valores que mostrar.<br>No se a comprado vidrio en <?php echo $nombre_mes." de ".$ano; ?>.</td>
							<meta http-equiv ="refresh"		 content="5;url=frmReporteCompra.php">
						</tr>
					</table>
				</td>
			</tr>
		</table>
<?php
}
else{
?>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
					<h2 align='center' class='encabezado2'>&quot;Vidrio Comprado en <?php echo $nombre_mes." de ".$ano; ?>"</h2>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead  class="manita">
							<tr>
								<th onMouseOver="toolTip('Ordenar por recibo',this)"><h3>Recibo</h3></th>
								<th onMouseOver="toolTip('Ordenar por proveedor',this)"><h3>Proveedor</h3></th>
								<th onMouseOver="toolTip('Ordenar por quintales',this)"><h3>Quintales</h3></th>
								<th onMouseOver="toolTip('Ordenar por monto',this)"><h3>Monto</h3></th>
							</tr>
						</thead>
						<tbody align="center">
							<?php							
							for($i=1; $i<=$filas; $i++){
							?>
							<tr>
								<td><?php echo $recibos[$i][1];?></td>
								<td><?php echo $recibos[$i][2];?></td>
								<td><?php echo $recibos[$i][3];?></td>
								<td>$<?php echo $recibos[$i][4];?></td>
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
					sum:[2,3],
					columns:[{index:2,format:'',decimals:2},{index:3,format:'$',decimals:2}],
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
					<FORM ACTION="ExportarReporteCompra_Periodo.php<?php echo "?valor_ano=$ano&valor_mes=$nombre_mes";?>" METHOD="post">
					<input name="Exportar" type="submit" value="Exportar" onMouseOver="toolTip('Exportar',this)" class="boton exportar">
					</FORM>
				</td>
				<td>		
					<FORM ACTION="ImprimirReporteCompra_Periodo.php<?php echo "?valor_ano=$ano&valor_mes=$nombre_mes";?>" METHOD="post">
					<input name="Imprimir" type="submit" value="Imprimir" onMouseOver="toolTip('Imprimir',this)" class="boton imprimir">
					</FORM>
				</td>
			</tr>
		</table>
		<?php } ?>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<center><img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita"></center>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<?php
}
?>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php $_SESSION["total_paginas"] = $paginas; ?>
<?php include "../../../librerias/cerrar_conexion.php"; ?>