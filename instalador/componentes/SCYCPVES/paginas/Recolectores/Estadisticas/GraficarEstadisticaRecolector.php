<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";

//RECUPERRAR VALORES DEL FORMULARIO
$ano			= $_POST['seleccionar_ano'];
$recolector		= $_POST['seleccionar_recolector'];
$mostrar		= $_POST['mostrar'];
$vidrio			= $_POST['vidrio'];

//VERIFICAR QUE NO SE HAN DEJADO ELEMENTOS SIN SELECCIONAR
if($ano=="" || $recolector=="" || $mostrar=='' || $vidrio=='') header("Location: frmEstadisticaRecolector.php?valor=$recolector");

//PARA ASIGNARLE VALORES A LA CONSULTA
if($mostrar == "VIDRIO"){$valor = "cantidad_vidrio"; $titulo = "CANTIDAD (Quintales)";}
if($mostrar == "MONTO"){$valor = "precio_vidrio"; $titulo = "CANTIDAD ($)";}
if($vidrio == "BOTELLA") $tipo='TV-01';
if($vidrio == "PLANO") $tipo='TV-02';

//REALIZAR CONSULTA
$intruccion_recolector = "SELECT recolectores.codigo_recolector FROM recolectores WHERE recolectores.nombre_recolector = '$recolector'";
$consulta_recolector = mysql_query($intruccion_recolector, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
$datos = mysql_fetch_assoc($consulta_recolector);

$intruccion_vidrio = "
SELECT
DISTINCT MONTH(facturas.fecha) AS mes,
vidrio.cantidad_vidrio,
vidrio.precio_vidrio
FROM vidrio, facturas, recolectores
WHERE recolectores.nombre_recolector = '$recolector'
AND facturas.codigo_recolector = recolectores.codigo_recolector
AND facturas.codigo_factura = vidrio.codigo_factura
AND vidrio.codigo_tipo = '$tipo'
AND YEAR(facturas.fecha) = '$ano'
ORDER BY mes ASC";
$consulta_vidrio = mysql_query($intruccion_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());

$lista_mes = array(1 => "ENERO", 2 => "FEBRERO", 3 => "MARZO", 4 => "ABRIL", 5 => "MAYO", 6 => "JUNIO", 7 => "JULIO", 8 => "AGOSTO", 9 => "SEPTIEMBRE", 10 => "OCTUBRE", 11 => "NOVIEMBRE", 12 => "DICIEMBRE");
$abr_mes = array(1 => "Ene", 2 => "Feb", 3 => "Mar", 4 => "Abr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Sep", 10 => "Otc", 11 => "Nov", 12 => "Dic");
$suma_mes = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);
$i = 0;
while($datos_vidrio = mysql_fetch_assoc($consulta_vidrio)){
	if($datos_vidrio['mes'] == '1') $suma_mes[1] = $suma_mes[1] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '2') $suma_mes[2] = $suma_mes[2] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '3') $suma_mes[3] = $suma_mes[3] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '4') $suma_mes[4] = $suma_mes[4] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '5') $suma_mes[5] = $suma_mes[5] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '6') $suma_mes[6] = $suma_mes[6] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '7') $suma_mes[7] = $suma_mes[7] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '8') $suma_mes[8] = $suma_mes[8] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '9') $suma_mes[9] = $suma_mes[9] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '10') $suma_mes[10] = $suma_mes[10] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '11') $suma_mes[11] = $suma_mes[11] + (float)$datos_vidrio[$valor];
	if($datos_vidrio['mes'] == '12') $suma_mes[12] = $suma_mes[12] + (float)$datos_vidrio[$valor];
}

$no_hay_valores = false;
for($i=1;$i<=12;$i++)
	if($suma_mes[$i] <> 0)
		$no_hay_valores = true;
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
		<meta name="description"         content="Sistema de Compras y Control de recolectores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico">
		<link rel="stylesheet"			 href="../../../librerias/formato.css" type="text/css"></link>
		<script type="text/javascript"	 src="../../../librerias/funciones.js"></script>
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize.css" type="text/css">
		<link rel="stylesheet"			 href="../../../librerias/jquery/grafica/css/visualize-dark.css" type="text/css">
		<script type="text/javascript"	 src="../../../librerias/jquery/jquery.js"></script>
		<script type="text/javascript"	 src="../../../librerias/jquery/grafica/js/visualize.jQuery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#graficar_tabla').visualize({type:"bar",width:450,height:450});
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
				<h1 class="encabezado1">ESTADISTICA DE RECOLECTORES POR TIPO DE VIDRIO</h1>
<!------------------------------------------------------------------------------------------------------------------------>
		<?php
		if(!$no_hay_valores){
		?>
				<h2 class="encabezado2"><img src="../../../imagenes/icono_error.png"><br>NO SE PUDO MOSTRAR LA GRAFICA!!</h2>
				<table align="center" class="alerta error centro">
					<tr>
						<td align="center" colspan="3">
							No hay valores que mostrar.<br>
							En el <?php echo $ano." ".$recolector;?> no compro vidrio <?php echo $vidrio;?>.
						</td>
						<meta http-equiv ="refresh"		 content="<?php echo "5;url=frmEstadisticaRecolector.php?valor=estadisticas";?>">
					</tr>
				</table>
			</td>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		<?php
		}
		else {
		?>
			</td>
		</tr>
<!------------------------------------------------------------------------------------------------------------------------>
		<tr>
			<td align="center">
				<table align="center" class="marco">
					<tr>
						<td>
							<center>
							<table>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~recolector~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<tr>
									<td align="right" class="titulo1">Recolector:</td>
									<td class="subtitulo1"><?php echo $recolector;?></td>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~codigo~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->	
									<td align="right" class="titulo1">Codigo:</td>
									<td class="subtitulo1"><?php echo $datos['codigo_recolector'];?></td>
								</tr>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~tipo~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->	
								<tr>
									<td align="right" class="titulo1">Tipo Vidrio:</td>
									<td class="subtitulo1"><?php echo $vidrio;?></td>
									<!--~~~~~~~~~~~~~~~~~~~~~~~~~~codigo~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
									<td align="right" class="titulo1">Codigo:</td>
									<td class="subtitulo1"><?php echo $tipo;?></td>
								</tr>
								<!--~~~~~~~~~~~~~~~~~~~~~~~~~~año~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
								<tr>
									<td align="center" colspan="2">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="titulo1">A&ntilde;o:</span>&nbsp;<span class="subtitulo1"><?php echo $ano;?></span>
									</td>
								</tr>
							</table>
							<!------------------------------------------------------------------------------------------------------------------------>
							<table border bgcolor="white">
								<caption><h1 class="encabezado2"><?php echo $mostrar;?><h1></caption>
								<thead class="titulo2">
									<tr>
										<td></td>
										<th><?php echo $titulo;?></th>
									</tr>
								</thead>
								<tbody align="center">
									<?php
									for($i=1;$i<=12;$i++){
									if($suma_mes[$i] != 0){
									?>
									<tr>
										<th class="titulo2"><?php echo $lista_mes[$i];?></th>
										<td><?php echo $suma_mes[$i];?></td>
									</tr>
									<?php
									}
									}
									?>
								</tbody>
							</table>
							<!------------------------------------------------------------------------------------------------------------------------>
							<table id="graficar_tabla" class="oculto">
								<caption><h1 class="encabezado2"><?php echo $mostrar;?><h1></caption>
								<thead class="titulo2">
									<tr>
										<td></td>
										<th><?php echo $titulo;?></th>
									</tr>
								</thead>
								<tbody align="center">
									<?php
									for($i=1;$i<=12;$i++){
									if($suma_mes[$i] != 0){
									?>
									<tr>
										<th class="titulo2"><?php echo $abr_mes[$i];?></th>
										<td><?php echo $suma_mes[$i];?></td>
									</tr>
									<?php
									}
									}
									?>
								</tbody>
							</table>
							</center>
							<div id="centrar"></div>
				<!------------------------------------------------------------------------------------------------------------------------>
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
	<hr><p><center>Sistema de Compras y Control de recolectores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center></p>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>