<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";
//RECUPERRAR VALORES DEL FORMULARIO
$ano1		= $_POST['ano1'];
$mes1		= $_POST['mes1'];
$ano2		= $_POST['ano2'];
$mes2		= $_POST['mes2'];
$mostrar	= $_POST['mostrar'];
$sucursal 	= $_POST['sucursal'];

//VERIFICAR QUE NO SE HAN DEJADO ELEMENTOS SIN SELECCIONAR
if($ano1=="" || $mes1=="" || $ano2=="" || $mes2=="" || $mostrar=="" || $sucursal=="") header("Location: frmComparacionCompra.php");

//BUSCAR EL MES
$lista_meses = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
for($i=1;$i<=12;$i++){
	if($mes1 == $i) $nombre_mes1 = $lista_meses[$i];
	if($mes2 == $i) $nombre_mes2 = $lista_meses[$i];
}

//TITULO DE LA SUCURSAL
switch($sucursal){
	case 'VICESA':
	case 'VIGUA':	$Sucursal = "para ".$sucursal; break;
	case 'AMBAS':	$Sucursal = ""; break;
}

$no_valores_periodo1 = false; $no_valores_periodo2 = false;
$mensaje1 = "";	$mensaje2 = "";

if($mostrar == 'cantidad'){
	$titulo = "Cantidades";		$fila1 = "Cantidad";		$fila2 = "Monto";
	
	$Sumas = calcularSumaTotales(calcularSumaCompras($mes1,$ano1,$sucursal));
	$periodo1['cantidades'] = $Sumas[1] + $Sumas[3];	$periodo1['precios'] = $Sumas[2] + $Sumas[4];
	
	$Sumas = calcularSumaTotales(calcularSumaCompras($mes2,$ano2,$sucursal));
	$periodo2['cantidades'] = $Sumas[1] + $Sumas[3];	$periodo2['precios'] = $Sumas[2] + $Sumas[4];
	
	//verificar si hay valores
	if($periodo1['cantidades'] <> 0 || $periodo1['precios'] <> 0) $no_valores_periodo1 = true;
	else $mensaje1 = "en el 1er periodo $nombre_mes1 $ano1.";
	
	if($periodo2['cantidades'] <> 0 || $periodo2['precios'] <> 0) $no_valores_periodo2 = true;
	else $mensaje2 = "en el 2do periodo $nombre_mes2 $ano2.";
}

if($mostrar == 'tipo'){
	$titulo = "Tipo de Vidrio";	$filas = array(1 => "Botella", 2 => "Plano");
	
	$Sumas = calcularSumaTotales(calcularSumaCompras($mes1,$ano1,$sucursal));
	$periodo1[1]['cantidades'] = $Sumas[1];		$periodo1[2]['cantidades'] = $Sumas[3];
	
	$Sumas = calcularSumaTotales(calcularSumaCompras($mes2,$ano2,$sucursal));
	$periodo2[1]['cantidades'] = $Sumas[1];		$periodo2[2]['cantidades'] = $Sumas[3];
	
	//verificar si hay valores
	if($periodo1[1]['cantidades'] <> 0 && $periodo1[2]['cantidades'] <> 0) $no_valores_periodo1 = true;
	else $mensaje1 = "en el 1er periodo $nombre_mes1 $ano1.";
	
	if($periodo2[1]['cantidades'] <> 0 && $periodo2[2]['cantidades'] <> 0) $no_valores_periodo2 = true;
	else $mensaje2 = "en el 2do periodo $nombre_mes2 $ano2.";
}

if($mostrar == 'color'){
	$titulo = "Color de Vidrio";	$filas = array(1 => "Verde", 2 => "Cristalino", 3 => "Cafe", 4 => "Bronce", 5 => "Reflectivo");
	
	$Sumas = calcularSumaCompras($mes1,$ano1,$sucursal);
	for($i=1; $i<=5; $i++)	$periodo1[$i]['cantidades'] = $Sumas[$i][1] + $Sumas[$i+5][1];
	
	$Sumas = calcularSumaCompras($mes2,$ano2,$sucursal);
	for($i=1; $i<=5; $i++)	$periodo2[$i]['cantidades'] = $Sumas[$i][1] + $Sumas[$i+5][1];
	
	//verificar si hay valores
	if($periodo1[1]['cantidades'] <> 0) $no_valores_periodo1 = true;
	else $mensaje1 = "en el 1er periodo $nombre_mes1 $ano1.";
	
	if($periodo2[1]['cantidades'] <> 0) $no_valores_periodo2 = true;
	else $mensaje2 = "en el 2do periodo $nombre_mes2 $ano2.";
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
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript"	 src="../../../librerias/funciones.js"></script>
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize.css" type="text/css">
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize-dark.css" type="text/css">
		<script type="text/javascript"	 src="../../../librerias/jquery/jquery.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/grafica/js/visualize.jQuery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#graficar_tabla').visualize({type:"bar",parseDirection:'x',width:450,height:450});
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
					<h1 class="encabezado1">COMPARACION DE COMPRAS</h1>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			if(!($no_valores_periodo1 && $no_valores_periodo2)){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR LA GRAFICA!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">
							No hay valores que mostrar.<br>No hay compras de vidrio realizadas 
							<?php
							echo $Sucursal." ";
							if($mensaje1 <> "" && $mensaje2 <> "") echo $mensaje1." y ".$mensaje2;
							else if($mensaje1 <> "") echo $mensaje1;
							else if($mensaje2 <> "") echo $mensaje2;
							?>
							</td>
							<meta http-equiv ="refresh"		 content="5;url=frmComparacionCompra.php">
						</tr>
					</table>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			}
			else{
			?>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table align="center" class="marco">
						<tr>
							<td>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<!--			esta tabla no se grafica porque tiene caracteres en las sumas de vidrio			 -->
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<h2 align="center" class="encabezado2">Comparacion de compras de vidrio <?php echo $Sucursal." por ".$titulo;?>.</h2>
								<table align="center" border bgcolor="white">
									<thead class="titulo2">
										<tr>
											<td></td>
											<th><?php echo $nombre_mes1."<br>".$ano1;?></th>
											<th><?php echo $nombre_mes2."<br>".$ano2;?></th>
										</tr>
									</thead>
									<tbody align="center">
										<?php
										if($mostrar == 'cantidad'){
										?>
										<tr>
											<th class="titulo2"><?php echo $fila1;?></th>
											<td><?php echo number_format($periodo1['cantidades'],2,'.',',')." quintales";?></td>
											<td><?php echo number_format($periodo2['cantidades'],2,'.',',')." quintales";?></td>
										</tr>
										<tr>
											<th class="titulo2"><?php echo $fila2;?></th>
											<td><?php echo "$".number_format($periodo1['precios'],2,'.',',');?></td>
											<td><?php echo "$".number_format($periodo2['precios'],2,'.',',');?></td>
										</tr>
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<?php
										}
										if($mostrar == 'tipo'){
											for($i=1;$i<=2;$i++){
										?>
										<tr>
											<th class="titulo2"><?php echo $filas[$i];?></th>
											<td><?php echo number_format($periodo1[$i]['cantidades'],2,'.',',')." quintales";?></td>
											<td><?php echo number_format($periodo2[$i]['cantidades'],2,'.',',')." quintales";?></td>
										</tr>
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<?php
											}
										}
										if($mostrar == 'color'){
											for($i=1;$i<=5;$i++){
										?>
										<tr>
											<th class="titulo2"><?php echo $filas[$i];?></th>
											<td><?php echo number_format($periodo1[$i]['cantidades'],2,'.',',')." quintales";?></td>
											<td><?php echo number_format($periodo2[$i]['cantidades'],2,'.',',')." quintales";?></td>
										</tr>
										<?php
											}
										}
										?>
									</tbody>
								</table>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<!--				duplico la misma tabla pero que no se vea, para graficar esta tabla			 -->
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<table id="graficar_tabla" class="oculto" align="center">
									<caption><?php echo $titulo;?></caption>
									<thead class="titulo2">
										<tr>
											<td></td>
											<th><?php echo $nombre_mes1."<br>".$ano1;?></th>
											<th><?php echo $nombre_mes2."<br>".$ano2;?></th>
										</tr>
									</thead>
									<tbody align="center">
										<?php
										if($mostrar == 'cantidad'){
										?>
										<tr>
											<th class="titulo2"><?php echo $fila1;?></th>
											<td><?php printf("%.2f",$periodo1['cantidades']);?></td>
											<td><?php printf("%.2f",$periodo2['cantidades']);?></td>
										</tr>
										<tr>
											<th class="titulo2"><?php echo $fila2;?></th>
											<td><?php printf("%.2f",$periodo1['precios']);?></td>
											<td><?php printf("%.2f",$periodo2['precios']);?></td>
										</tr>
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<?php
										}
										if($mostrar == 'tipo'){
											for($i=1;$i<=2;$i++){
										?>
										<tr>
											<th class="titulo2"><?php echo $filas[$i];?></th>
											<td><?php printf("%.2f",$periodo1[$i]['cantidades']);?></td>
											<td><?php printf("%.2f",$periodo2[$i]['cantidades']);?></td>
										</tr>
										<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
										<?php
											}
										}
										if($mostrar == 'color'){
											for($i=1;$i<=5;$i++){
										?>
										<tr>
											<th class="titulo2"><?php echo $filas[$i];?></th>
											<td><?php printf("%.2f",$periodo1[$i]['cantidades']);?></td>
											<td><?php printf("%.2f",$periodo2[$i]['cantidades']);?></td>
										</tr>
										<?php
											}
										}
										?>
									</tbody>
								</table>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<div id="centrar"></div>
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
			?>
<!------------------------------------------------------------------------------------------------------------------------>
		</TABLE>
	<hr><p><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2012</center></p>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>