<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";

$tipo_eliminar1 		= $_GET['tipo1'];
$tipo_eliminar2 		= $_GET['tipo2'];
$codigo_recolector 		= $_REQUEST['codigo'];
$nuevo_recolector 		= $_REQUEST['nuevo_recolector'];

//recolector a eliminar
$instruccion_recolector = "
SELECT
COUNT(centros_de_acopio.codigo_centro_acopio) AS cantidad_centros_acopio,
recolectores.codigo_recolector,
recolectores.nombre_recolector,
recolectores.dui_recolector,
recolectores.nit_recolector,
recolectores.direccion_recolector,
recolectores.telefono_recolector
FROM recolectores, centros_de_acopio
WHERE recolectores.codigo_recolector = '$codigo_recolector'
AND centros_de_acopio.codigo_recolector = recolectores.codigo_recolector";
$consulta_recolector = mysql_query($instruccion_recolector, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_recolector!! </SPAN>".mysql_error());
$recolectores = mysql_fetch_array($consulta_recolector);

//centro de acopio a reasignar recolector
$instruccion_centro_de_acopio = "
SELECT
centros_de_acopio.codigo_centro_acopio,
centros_de_acopio.departamento,
centros_de_acopio.telefono,
recolectores.nombre_recolector
FROM centros_de_acopio
JOIN recolectores
WHERE recolectores.codigo_recolector = '$codigo_recolector'
AND centros_de_acopio.codigo_recolector = recolectores.codigo_recolector";

//factura a eliminar
$instruccion_factura = "
SELECT
facturas.codigo_factura,
facturas.codigo_recolector,
recolectores.codigo_recolector
FROM facturas, recolectores
WHERE recolectores.codigo_recolector = '$codigo_recolector'
AND facturas.codigo_recolector = recolectores.codigo_recolector";

/*eliminar facturas/vidrios y centros de acopio*/
if($tipo_eliminar1 == 1 && $tipo_eliminar2 == 2){
	$consulta_factura = mysql_query($instruccion_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!! </SPAN>".mysql_error());	
	while($facturas = mysql_fetch_array($consulta_factura)){
		$codigo_factura = $facturas['codigo_factura'];
		
		//buscar con el codigo de factura en la tabla vidrios el codigo del vidrio del registro que se va eliminar de la tabla vidrios
		$instruccion_vidrio = "
		SELECT vidrio.codigo_vidrio, facturas.codigo_factura
		FROM vidrio, facturas
		WHERE vidrio.codigo_factura = '$codigo_factura'
		AND facturas.codigo_factura = vidrio.codigo_factura";
		$consultar_vidrio = mysql_query($instruccion_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo consultar_vidrio!! </SPAN>".mysql_error());
		
		while($vidrios = mysql_fetch_array($consultar_vidrio)){		
			$codigo_vidrio = $vidrios['codigo_vidrio'];
			
			//eliminar el registro de la tabla vidrios con el codigo del vidrio que se acaba de encontrar
			$instruccion_delete = "DELETE FROM vidrio WHERE codigo_vidrio = '$codigo_vidrio'";
			mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_vidrio!! </SPAN>".mysql_error());
		}
	}
	
	//eliminar el registro de la tabla facturas con el codigo del recolector que se va eliminar
	$instruccion_delete = "DELETE FROM facturas WHERE codigo_recolector = '$codigo_recolector'";
	mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_factura!! </SPAN>".mysql_error());
	
	$consulta_centro_de_acopio = mysql_query($instruccion_centro_de_acopio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!!</SPAN>".mysql_error());
	while($centros_de_acopio = mysql_fetch_assoc($consulta_centro_de_acopio)){
		$centro_acopio = $centros_de_acopio['codigo_centro_acopio'];
		
		//actualiza el registro de la tabla centros de acopio con el codigo del centro de acopio que se acaba de encontrar
		$instruccion_update = "UPDATE centros_de_acopio SET codigo_recolector = '$nuevo_recolector' WHERE codigo_centro_acopio = '$centro_acopio'";
		mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo actualizar_centro_de_acopio!! </SPAN>".mysql_error());
	}
}

/*eliminar facturas/vidrios*/
if($tipo_eliminar1 == 1){
	$consulta_factura = mysql_query($instruccion_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!! </SPAN>".mysql_error());	
	while($facturas = mysql_fetch_array($consulta_factura)){
		$codigo_factura = $facturas['codigo_factura'];
		
		//buscar con el codigo de factura en la tabla vidrios el codigo del vidrio del registro que se va eliminar de la tabla vidrios
		$instruccion_vidrio = "
		SELECT vidrio.codigo_vidrio, facturas.codigo_factura
		FROM vidrio, facturas
		WHERE vidrio.codigo_factura = '$codigo_factura'
		AND facturas.codigo_factura = vidrio.codigo_factura";
		$consultar_vidrio = mysql_query($instruccion_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo consultar_vidrio!! </SPAN>".mysql_error());
		
		while($vidrios = mysql_fetch_array($consultar_vidrio)){		
			$codigo_vidrio = $vidrios['codigo_vidrio'];
			
			//eliminar el registro de la tabla vidrios con el codigo del vidrio que se acaba de encontrar
			$instruccion_delete = "DELETE FROM vidrio WHERE codigo_vidrio = '$codigo_vidrio'";
			mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_vidrio!! </SPAN>".mysql_error());
		}
	}
	
	//eliminar el registro de la tabla facturas con el codigo del recolector que se va eliminar
	$instruccion_delete = "DELETE FROM facturas WHERE codigo_recolector = '$codigo_recolector'";
	mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_factura!! </SPAN>".mysql_error());
}

/*eliminar centros de acopio*/
if($tipo_eliminar2 == 2){
	$consulta_centro_de_acopio = mysql_query($instruccion_centro_de_acopio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_centro_de_acopio!!</SPAN>".mysql_error());
	while($centros_de_acopio = mysql_fetch_assoc($consulta_centro_de_acopio)){
		$centro_acopio = $centros_de_acopio['codigo_centro_acopio'];
		
		//actualiza el registro de la tabla centros de acopio con el codigo del centro de acopio que se acaba de encontrar
		$instruccion_update = "UPDATE centros_de_acopio SET codigo_recolector = '$nuevo_recolector' WHERE codigo_centro_acopio = '$centro_acopio'";
		mysql_query($instruccion_update, $conexion) or die ("<SPAN CLASS='error'>Fallo actualizar_centro_de_acopio!! </SPAN>".mysql_error());
	}	
}

//eliminar el registro de la tabla recolectores con el codigo del recolector que se va eliminar
$instruccion_delete = "DELETE FROM recolectores WHERE codigo_recolector = '$codigo_recolector'";
mysql_query($instruccion_delete, $conexion) or die ("<SPAN CLASS='error'>Fallo eliminar_recolector!! </SPAN>".mysql_error());
?>
<!----------------------------------------------------------------------------------------------------------------->
<HTML>
	<head>
		<title>.:SC&CPVES:.</title>
		<meta http-equiv ="refresh"		 content="5;url=../Consultar/frmConsultarRecolector.php">
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
	</head>
	<BODY class="cuerpo1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
			<tr>
				<td align="center">
					<img src="../../../imagenes/vical.png" width="25%" height="25%">
					<h1 class="encabezado1">ELIMINAR RECOLECTOR</h1>
					<h2 class="encabezado2">
						<img src="../../../imagenes/icono_informacion.png">
						<br>
						SE ELIMINO EL RECOLECTOR EXITOSAMENTE!!
					</h2>
				</td>
			</tr>
<!------------------------------------------------------------------------------------------------------------------------>
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo3">Codigo:</td>
							<td class="subtitulo1"><?php echo $recolectores["codigo_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo3">Nombre:</td>
							<td class="subtitulo1"><?php echo $recolectores["nombre_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo3">DUI:</td>
							<td class="subtitulo1"><?php echo $recolectores["dui_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<tr>
							<td align="right" class="titulo3">NIT:</td>
							<td class="subtitulo1"><?php echo $recolectores["nit_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<?php
						if ($recolectores["direccion_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Direccion:</td>
							<td class="subtitulo1"><?php echo $recolectores["direccion_recolector"]; ?></td>
						</tr>
						<!------------------------------------------------------------------------>
						<?php
						}
						if ($recolectores["telefono_recolector"]<>NULL){
						?>
						<tr>
							<td align="right" class="titulo3">Telefono:</td>
							<td class="subtitulo1"><?php echo $recolectores["telefono_recolector"]; ?></td>
						</tr>
						<?php
						}
						?>
						<!------------------------------------------------------------------------>						
					</table>
				</td>
			</tr>
			<?php
			if($nuevo_recolector <> "falso"){
			?>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr><td><br></td></tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center">
					<table align="center" class="resultado centro">
						<!------------------------------------------------------------------------>
						<tr>
							<td align="center" class="subtitulo1">
								<?php
								$consulta = mysql_query("SELECT nombre_recolector FROM recolectores WHERE codigo_recolector = '$nuevo_recolector'",$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta!!</SPAN>".mysql_error());
								$opciones = mysql_fetch_array($consulta);
								echo "Se reasigno a ".$opciones [0]." como encargado ";
								if($recolectores["cantidad_centros_acopio"] > 1) echo "de los Centros de Acopio.";
								else echo "del Centros de Acopio.";
								?>
							</td>
						</tr>
						<!------------------------------------------------------------------------>
					</table>
				</td>
			</tr>
			<?php
			}
			?>
<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		</table>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>