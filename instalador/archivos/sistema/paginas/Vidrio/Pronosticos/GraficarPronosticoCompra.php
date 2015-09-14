<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../librerias/funciones.php";

$consulta = mysql_query("SELECT DISTINCT YEAR(fecha) AS ano FROM facturas ORDER BY fecha ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en consulta fecha!!</SPAN>".mysql_error());
$cantidad = mysql_num_rows($consulta);

$filas=1;
if($cantidad != 0){
	while($opciones = mysql_fetch_array($consulta)){
		$anos[$filas] = $opciones['ano'];
		$filas++;
	}
	for($ano=1; $ano<$filas; $ano++){
		$instruccion = "SELECT SUM(precio_vidrio) AS precio_vidrio FROM vidrio, facturas WHERE YEAR(facturas.fecha) = '$anos[$ano]' AND vidrio.codigo_factura = facturas.codigo_factura";
		$consulta = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en consulta precio_vidrios!!</SPAN>".mysql_error());
		$opciones = mysql_fetch_array($consulta);
		$precio_vidrios[$ano] = $opciones['precio_vidrio'];
	}
	//calculo de pronostico aplicando suavizamiento exponencial simple
	$ano_actual = $precio_vidrios[1];
	$alfha = 0.5;			//constante de suavisamiento
	$bandera = true;
	for($i=1; $i<=$filas; $i++){
		if($bandera){
			$ano_anterior = $precio_vidrios[1];
			$Ft = $ano_actual + ($alfha * ($ano_anterior - $ano_actual));
			$ano_actual = $Ft;
			$bandera = false;
		}
		else{
			$ano_anterior = $precio_vidrios[$i-1];
			$Ft = $ano_actual + ($alfha * ($ano_anterior - $ano_actual));
			$ano_actual = $Ft;
		}
		$pronosticos[$i] = $ano_actual;
	}
}
else{
}
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
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize.css" type="text/css">
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize-dark.css" type="text/css">
		<script type="text/javascript"	 src="../../../librerias/jquery/jquery.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/grafica/js/visualize.jQuery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#graficar_tabla').visualize({type:"area",parseDirection:'y',width:450,height:250});
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
				<h1 class="encabezado1">PRONOSTICOS DE COMPRAS</h1>
<!------------------------------------------------------------------------------------------------------------------------>
			<?php
			if($filas == 1){
			?>
					<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR EL PRONOSTICO!!</h2>
					<table align="center" class="alerta error centro">
						<tr>
							<td align="center" colspan="3">No hay valores que mostrar.<br>No hay compras de vidrio registrados en el sistema.</td>
							<meta http-equiv ="refresh"		 content="5;url=../Nueva/frmNuevaCompra.php<?php echo "?valor_nombre_recolector=nueva_compra";?>">
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
					<table class="marco">
<!------------------------------------------------------------------------------------------------------------------------>
						<tr>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="right">
								<table align="center" border bgcolor="white" width="80%">
									<caption><h1 class="encabezado2">A&Ntilde;OS BASES<h1></caption>
									<thead class="titulo2"><tr><th width="80">A&Ntilde;O</th><th width="100">precio_vidrio</th></tr></thead>
									<tbody align="center">
										<?php
										for($i=1; $i<$filas; $i++){
										?>
										<tr>
											<th class="titulo2" width="80"><?php echo $anos[$i];?></th>
											<td width="100"><?php echo "$".number_format($precio_vidrios[$i],2,'.',',');?></td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
								<span style="font-size:21px;color:#76a5d3;">no se ve</span><!--esto es para dejar una fila en blanco-->
							</td>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td>
							</td>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
							<td align="left">
								<table align="center" border bgcolor="white" width="80%">
									<caption><h1 class="encabezado2">PRONOSTICOS<h1></caption>
									<thead class="titulo2"><tr><th width="80">A&Ntilde;OS</th><th width="100">PRONOSTICO</th></tr></thead>
									<tbody align="center">
										<?php
										for($i=1; $i<$filas; $i++){
										?>
										<tr>
											<th class="titulo2" width="80"><?php echo $anos[$i];?></th>
											<td width="100"><?php echo "$".number_format($pronosticos[$i],2,'.',',');?></td>
										</tr>									
										<?php											
										}
										//imprimir pronostico del año siguiente
										$n_ano = $anos[$filas - 1] + 1;
										$n_precio_vidrio = $pronosticos[$filas];
										?>
										<tr>
											<th class="titulo2" width="80"><?php echo $n_ano;?></th>
											<td width="100"><?php echo "$".number_format($n_precio_vidrio,2,'.',',');?></td>
										</tr>
									</tbody>
								</table>
							</td>
							<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
						</tr>
<!------------------------------------------------------------------------------------------------------------------------>
						<tr>
							<td colspan="3">
								<table align="center" id="graficar_tabla" class="oculto">
									<caption><h1 class="encabezado2">PRONOSTICOS<h1></caption>
									<thead class="titulo2"><tr><td></td><th>A&Ntilde;OS BASES</th><th>PRONOSTICOS</th></tr></thead>
									<tbody align="center">
										<?php
										for($i=1; $i<$filas; $i++){
										?>
										<tr>
											<th class="titulo2" width="80"><?php echo $anos[$i];?></th>
											<td width="100"><?php printf("%.2f",$precio_vidrios[$i]);?></td>
											<td width="100"><?php printf("%.2f",$pronosticos[$i]);?></td>
										</tr>
										<?php
										}
										//imprimir pronostico del año siguiente
										$n_ano = $anos[$filas - 1] + 1;
										$n_precio_vidrio = $pronosticos[$filas];
										?>
										<tr>
											<th class="titulo2" width="80"><?php echo $n_ano;?></th>
											<td width="100"><?php echo printf("%.2f",$precio_vidrios[$i-1]);?></td>
											<td width="100"><?php echo printf("%.2f",$n_precio_vidrio);?></td>
										</tr>
									</tbody>
								</table>
								<div id="centrar"></div>
								<br><center><?php echo hoyEs();?></center>
							</td>
						</tr>
<!------------------------------------------------------------------------------------------------------------------------>
					</table>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<span id="toolTipBox" width="50"></span>
					<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
					<br>
					<img src="../../../imagenes/icono_volver.png" width="42" height="42" align="top" onMouseOver="toolTip('Regresar',this)" onClick="redireccionar('../../../interfaz/frame_contenido.php');" class="manita">
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		<?php
			}
		?>
<!------------------------------------------------------------------------------------------------------------------------>
		</TABLE>
	<hr><p><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center></p>
	</BODY>
</HTML>
<?phpinclude "../../../librerias/cerrar_conexion.php"; ?>