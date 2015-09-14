<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";

//RECUPERRAR VALORES DEL FORMULARIO
$numero_ano = $_POST['seleccionar_ano'];
$numero_mes = $_POST['seleccionar_mes'];
$mostrar 	= $_POST['mostrar'];
$sucursal 	= $_POST['sucursal'];

//VERIFICAR QUE NO SE HAN DEJADO ELEMENTOS SIN SELECCIONAR
if($numero_ano=="" || $numero_mes=="" || $mostrar=='' || $sucursal=="") header("Location: frmEstadisticaCompra.php");

//BUSCAR EL MES
$lista_meses = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
for($i=1;$i<=12;$i++) if($numero_mes == $i) $nombre_mes = $lista_meses[$i];

//CALCULAR LAS SUMAS DE VIDRIO DE LAS FACTURAS
$SumaCompras = calcularSumaCompras($numero_mes,$numero_ano,$sucursal);
$SumasTotales = calcularSumaTotales($SumaCompras);
$Bsuma_cantidad = $SumasTotales[1];	$Bsuma_precio = $SumasTotales[2];
$Psuma_cantidad = $SumasTotales[3];	$Psuma_precio = $SumasTotales[4];

//TITULO DE LA SUCURSAL
switch($sucursal){
	case 'VICESA':
	case 'VIGUA':	$sucursal = "para ".$sucursal; break;
	case 'AMBAS':	$sucursal = ""; break;
}
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
		<link rel="stylesheet"			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript"	 src="../../../librerias/funciones.js"></script>
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize.css" type="text/css">
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize-dark.css" type="text/css">
		<script type="text/javascript"	 src="../../../librerias/jquery/jquery.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/grafica/js/visualize.jQuery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#graficar_tabla').visualize({type:"bar",parseDirection:'y',width:450,height:450});
				var centrar = $("div.visualize");
				$("div.visualize").remove();
				$("#centrar").append(centrar);
			});
		</script>
	</head>
	<BODY class="cuerpo1">
	<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
<!------------------------------------------------------------------------------------------------------------------------>
		<tr>
			<td align="center">
				<img src="../../../imagenes/vical.png" width="25%" height="25%">
				<h1 class="encabezado1">ESTADISTICAS DE COMPRAS</h1>
<!------------------------------------------------------------------------------------------------------------------------>
		<?php
		$Cantidades = $Bsuma_cantidad+$Psuma_cantidad;
		$Montos = $Bsuma_precio+$Psuma_precio;
		if($Cantidades == 0 && $Montos == 0){
		?>
				<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR LA ESTADISTICA!!</h2>
				<table align="center" class="alerta error centro">
					<tr>
						<td align="center" colspan="3">No hay valores que mostrar.<br>No se a comprado vidrio <?php echo $sucursal." en ".$nombre_mes." ".$numero_ano;?>.</td>
						<meta http-equiv ="refresh"		 content="5;url=frmEstadisticaCompra.php">
					</tr>
				</table>
			</td>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		<?php
		}
		else {
			//SELECCIONAR EL TIPO DE ESTADISTICA
			if($mostrar == "Graficas"){
		?>
			</td>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		<tr>
			<td align="center">
				<table align="center" class="marco">
					<!---------------------------------------------------------------------------------------------------->
					<tr>
						<td align="center">
							<h2 class="encabezado2">Grafica de estadistica de vidrio comprado <?php echo $sucursal." en ".$nombre_mes." ".$numero_ano;?>.<h2>
							<table align="center" border bgcolor="white">
								<thead class="titulo2">
									<tr>
										<td></td>
										<th>TOTAL CANTIDAD</th>
										<th>TOTAL MONTO</th>
									</tr>
								</thead>
								<tbody align="center">
									<tr>
										<th class="titulo2">BOTELLA</th>
										<td><?php echo number_format($Bsuma_cantidad,2,'.',',');?></td>
										<td><?php echo "$".number_format($Bsuma_precio,2,'.',',');?></td>
									</tr>
									<tr>
										<th class="titulo2">PLANO</th>
										<td><?php echo number_format($Psuma_cantidad,2,'.',',');?></td>
										<td><?php echo "$".number_format($Psuma_precio,2,'.',',');?></td>
									</tr>
									<tr>
										<th class="titulo2">TOTALES</th>
										<td><?php echo number_format($Bsuma_cantidad+$Psuma_cantidad,2,'.',',');?></td>
										<td><?php echo "$".number_format($Bsuma_precio+$Psuma_precio,2,'.',',');?></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<!---------------------------------------------------------------------------------------------------->
					<tr>
						<td>
							<table align="center" class="oculto" id="graficar_tabla" border bgcolor="white">
								<caption><h1 class="encabezado2"><?php echo $nombre_mes." ".$numero_ano;?><h1></caption>
								<thead class="titulo2">
									<tr>
										<td></td>
										<th>TOTAL CANTIDAD</th>
										<th>TOTAL MONTO</th>
									</tr>
								</thead>
								<tbody align="center">
									<tr>
										<th class="titulo2">BOTELLA</th>
										<td><?php printf("%.2f",$Bsuma_cantidad);?></td>
										<td><?php printf("%.2f",$Bsuma_precio);?></td>
									</tr>
									<tr>
										<th class="titulo2">PLANO</th>
										<td><?php printf("%.2f",$Psuma_cantidad);?></td>
										<td><?php printf("%.2f",$Psuma_precio);?></td>
									</tr>
								</tbody>
							</table>
							<div id="centrar"></div>
							<br><center><?php echo hoyEs();?></center>
						</td>
					</tr>
					<!---------------------------------------------------------------------------------------------------->
				</table>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<span id="toolTipBox" width="50"></span>
				<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita">					
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			</td>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		<?php
			}
			if($mostrar == "Detalles"){
		?>
		<tr>
			<td align="center">
				<table align="center" class="marco">
					<tr>
						<td align="center">
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<h2 class="encabezado2">Detalle de estadistica de vidrio comprado <?php echo $sucursal." en ".$nombre_mes." ".$numero_ano;?>.</h2>
							<table border bgcolor="white">
								<thead class="titulo2">
									<tr>
										<th>CODIGO VIDRIO</th>
										<th>TIPO VIDRIO</th>
										<th>CODIGO COLOR</th>
										<th>COLOR VIDRIO</th>
										<th>CANTIDAD VIDRIO</th>
										<th>MONTO INVERTIDO</th>
										<th>TOTAL CANTIDAD</th>
										<th>TOTAL MONTO</th>
									</tr>
								</thead>
								<tbody class="subtitulo1" align="center">
									<!----------------------------------->
									<tr>
										<td rowspan="5">TV-01</td><td rowspan="5">BOTELLA</td>
										<td>CV-01</td><td>VERDE</td>
										<?php
										if($SumaCompras[1][1] <> 0 && $SumaCompras[1][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[1][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[1][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
										<td rowspan="5"><?php echo number_format($Bsuma_cantidad,2,'.',',');?></td>
										<td rowspan="5"><?php echo "$".number_format($Bsuma_precio,2,'.',',');?></td>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-02</td><td>CRISTALINO</td>
										<?php
										if($SumaCompras[2][1] <> 0 && $SumaCompras[2][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[2][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[2][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-03</td><td>CAFE</td>
										<?php
										if($SumaCompras[3][1] <> 0 && $SumaCompras[3][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[3][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[3][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-04</td><td>BRONCE</td>
										<?php
										if($SumaCompras[4][1] <> 0 && $SumaCompras[4][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[4][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[4][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-05</td><td>REFLECTIVO</td>
										<?php
										if($SumaCompras[5][1] <> 0 && $SumaCompras[5][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[5][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[5][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!---------------------------------------------------------------------------->
									<tr><td colspan="8" style="background-color: #76a5d3;">&nbsp;</td></tr>
									<!---------------------------------------------------------------------------->
									<tr>
										<td rowspan="5">TV-02</td><td rowspan="5">PLANO</td>
										<td>CV-01</td><td>VERDE</td>
										<?php
										if($SumaCompras[1][1] <> 0 && $SumaCompras[1][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[1][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[1][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
										<td rowspan="5"><?php echo number_format($Psuma_cantidad);?></td>
										<td rowspan="5"><?php echo "$".number_format($Psuma_precio);?></td>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-02</td><td>CRISTALINO</td>
										<?php
										if($SumaCompras[2][1] <> 0 && $SumaCompras[2][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[2][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[2][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-03</td><td>CAFE</td>
										<?php
										if($SumaCompras[3][1] <> 0 && $SumaCompras[3][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[3][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[3][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-04</td><td>BRONCE</td>
										<?php
										if($SumaCompras[4][1] <> 0 && $SumaCompras[4][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[4][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[4][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!----------------------------------->
									<tr>
										<td>CV-05</td><td>REFLECTIVO</td>
										<?php
										if($SumaCompras[5][1] <> 0 && $SumaCompras[5][2] <>0){
										?>
										<td><?php echo number_format($SumaCompras[5][1],2,'.',',');?></td>
										<td><?php echo "$".number_format($SumaCompras[5][2],2,'.',',');?></td>
										<?php
										}
										else{
										?>
										<td>&nbsp;</td><td>&nbsp;</td>
										<?php
										}
										?>
									</tr>
									<!---------------------------------------------------------------------------->
									<tr>
										<td colspan="5" style="background-color: #76a5d3;">&nbsp;</td>
										<th class="titulo2">TOTALES</th>
										<th><?php echo number_format($Bsuma_cantidad+$Psuma_cantidad,2,'.',',');?></th>
										<th><?php echo "$".number_format($Bsuma_precio+$Psuma_precio,2,'.',',');?></th>
									</tr>
									<!----------------------------------->
								</tbody>
							</table>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<br><center><?php echo hoyEs();?></center>
						</td>
					</tr>
				</table>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<span id="toolTipBox" width="50"></span>
				<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('javascript:window.history.back()');" class="manita">
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			</td>
		</tr>
		<?php
			}
		}
		?>
<!------------------------------------------------------------------------------------------------------------------------>
	</TABLE>
	<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center></p>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>