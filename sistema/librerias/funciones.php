<?php
$filas = 1;		//variable global
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma de las cantidades y precios de vidrio comprado por factura para un determinado mes y año
//scripts que la utilizan: GraficarEstadisticaCompra, GraficarComparacionCompra
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaCompras($mes,$ano,$sucursal){
	include "abrir_conexion.php";
	
	switch($sucursal){
		case 'VICESA':
		case 'VIGUA':	$select_factura = "SELECT codigo_factura FROM facturas WHERE YEAR(fecha) = '$ano' AND MONTH(fecha) = '$mes' AND sucursal = '$sucursal' ORDER BY codigo_factura ASC";
						break;
		case 'AMBAS':	$select_factura = "SELECT codigo_factura FROM facturas WHERE YEAR(fecha) = '$ano' AND MONTH(fecha) = '$mes' ORDER BY codigo_factura ASC";
						break;
	}
	$consulta_factura = mysql_query($select_factura, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_factura!!</SPAN>".mysql_error());

	$Bsuma_cantidad = 0;	$Bsuma_precio = 0;
	for($i=1; $i<=10; $i++)
		for($j=1; $j<=2; $j++)
			$Compras[$i][$j] = 0;
	while($facturas = mysql_fetch_assoc($consulta_factura)){
		$factura = $facturas['codigo_factura'];

		$select_vidrio = "
		SELECT vidrio.codigo_tipo, vidrio.codigo_color, vidrio.cantidad_vidrio, vidrio.precio
		FROM vidrio, facturas
		WHERE facturas.codigo_factura = '$factura'
		AND facturas.codigo_factura = vidrio.codigo_factura
		ORDER BY vidrio.codigo_factura ASC";
		$consulta_vidrio = mysql_query($select_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());
		
		while($vidrios = mysql_fetch_assoc($consulta_vidrio)){
			if($vidrios['codigo_tipo'] == 'TV-01'){
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-01'){$Compras[1][1] += $vidrios['cantidad_vidrio'];	$Compras[1][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-02'){$Compras[2][1] += $vidrios['cantidad_vidrio'];	$Compras[2][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-03'){$Compras[3][1] += $vidrios['cantidad_vidrio'];	$Compras[3][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-04'){$Compras[4][1] += $vidrios['cantidad_vidrio'];	$Compras[4][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-05'){$Compras[5][1] += $vidrios['cantidad_vidrio'];	$Compras[5][2] += $vidrios['precio'];}
			//-------------------------------------------------
			}
			if($vidrios['codigo_tipo'] == 'TV-02'){
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-01'){$Compras[6][1] += $vidrios['cantidad_vidrio'];	$Compras[6][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-02'){$Compras[7][1] += $vidrios['cantidad_vidrio'];	$Compras[7][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-03'){$Compras[8][1] += $vidrios['cantidad_vidrio'];	$Compras[8][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-04'){$Compras[9][1] += $vidrios['cantidad_vidrio'];	$Compras[9][2] += $vidrios['precio'];}
			//-------------------------------------------------
				if($vidrios['codigo_color'] == 'CV-05'){$Compras[10][1] += $vidrios['cantidad_vidrio'];	$Compras[10][2] += $vidrios['precio'];}
			//-------------------------------------------------
			}
		}
	}
	include "cerrar_conexion.php";
	return $Compras;	//devuelve una matriz 10x2
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma de los totales de cantida y precios de vidrio por tipo de vidrio
//scripts que la utilizan: GraficarEstadisticaCompra, GraficarComparacionCompra, HistorialCompra_Periodo
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaTotales($Compras){
	for($i=1; $i<=4; $i++)	$Totales[$i] = 0;
	for($i=1; $i<=5; $i++){$Totales[1] += $Compras[$i][1];	$Totales[2] += $Compras[$i][2];}
	for($i=6; $i<=10; $i++){$Totales[3] += $Compras[$i][1];	$Totales[4] += $Compras[$i][2];}
	return $Totales;	//devuelve un vector de cuatro elementos
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma total de las cantidades y precios de cada mes por tipo de vidrio o por proveedor
//scripts que la utilizan: HistorialCompra_Proveedor, HistorialCompra_TipoVidrio
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaMes($tabla,$buscar,$sucursal){
	include "abrir_conexion.php";
	switch($tabla){
		case 'tipo_vidrio':	$buscar_por = "AND vidrio.codigo_tipo = '$buscar'";	break;
		case 'proveedor':	$buscar_por = "AND facturas.codigo_proveedor = '$buscar'";	break;
	}
	switch($sucursal){
		case 'VICESA':
		case 'VIGUA':	$seleccionar_vidrio = "SELECT YEAR(fecha) AS ano, MONTH(fecha) AS mes, vidrio.cantidad_vidrio, vidrio.precio FROM facturas, vidrio WHERE facturas.codigo_factura = vidrio.codigo_factura $buscar_por AND sucursal = '$sucursal' ORDER BY facturas.fecha  ASC";
						break;
		case 'AMBAS':	$seleccionar_vidrio = "SELECT YEAR(fecha) AS ano, MONTH(fecha) AS mes, vidrio.cantidad_vidrio, vidrio.precio FROM facturas, vidrio WHERE facturas.codigo_factura = vidrio.codigo_factura $buscar_por ORDER BY facturas.fecha  ASC";
						break;
	}	
	$consulta_vidrio = mysql_query($seleccionar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());

	$lista_meses = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");

	for($i=1; $i<=100; $i++)
		for($j=1; $j<=4; $j++)
			$comprasMes[$i][$j] = '';
	global $filas; $bandera = true;
	while($vidrios = mysql_fetch_assoc($consulta_vidrio)){
		if($bandera){
			$comprasMes[$filas][1] = $vidrios['ano'];
			$comprasMes[$filas][2] = $lista_meses[$vidrios['mes']];
			$comprasMes[$filas][3] = $vidrios['cantidad_vidrio'];
			$comprasMes[$filas][4] = $vidrios['precio'];
			$bandera = false;
		}
		else if($comprasMes[$filas][2] == $lista_meses[$vidrios['mes']]){
				$comprasMes[$filas][3] += $vidrios['cantidad_vidrio'];
				$comprasMes[$filas][4] += $vidrios['precio'];
			}
			else{
				$filas++;
				$comprasMes[$filas][1] = $vidrios['ano'];
				$comprasMes[$filas][2] = $lista_meses[$vidrios['mes']];
				$comprasMes[$filas][3] += $vidrios['cantidad_vidrio'];
				$comprasMes[$filas][4] += $vidrios['precio'];
			}
	}
	include "cerrar_conexion.php";
	return $comprasMes;		//devuelve un vector con [ano][mes][cantidad][precio] por cada año, matriz Nx4
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma de las cantidades y precios de vidrio comprado por factura
//scripts que la utilizan: verCompra, frmModificarCompra, frmEliminarCompra, EliminarCompra
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaVidrio($codigo_factura){
	include "abrir_conexion.php";
	
	$select_vidrio = "SELECT vidrio.codigo_tipo, vidrio.codigo_color, vidrio.cantidad_vidrio, vidrio.precio FROM vidrio, facturas WHERE facturas.codigo_factura = '$codigo_factura' AND facturas.codigo_factura = vidrio.codigo_factura ORDER BY codigo_vidrio ASC";
	$consulta_vidrio = mysql_query($select_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());

	for($i=1; $i<=10; $i++)
		for($j=1; $j<=2; $j++)
			$SumaVidrios[$i][$j] = 0;
	while($vidrios = mysql_fetch_assoc($consulta_vidrio)){
		if($vidrios['codigo_tipo'] == 'TV-01'){
		//-------------------------------------------------
			if($vidrios['codigo_color'] == 'CV-01'){$SumaVidrios[1][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[1][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-02'){$SumaVidrios[2][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[2][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-03'){$SumaVidrios[3][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[3][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-04'){$SumaVidrios[4][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[4][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-05'){$SumaVidrios[5][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[5][2] += $vidrios['precio'];}
		//-------------------------------------------------
		}
		else
		if($vidrios['codigo_tipo'] == 'TV-02'){
		//-------------------------------------------------
			if($vidrios['codigo_color'] == 'CV-01'){$SumaVidrios[6][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[6][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-02'){$SumaVidrios[7][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[7][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-03'){$SumaVidrios[8][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[8][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-04'){$SumaVidrios[9][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[9][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-05'){$SumaVidrios[10][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[10][2] += $vidrios['precio'];}
		//-------------------------------------------------
		}
	}
	include "cerrar_conexion.php";
	return $SumaVidrios;	//devuelve una matriz 10x2, de la fila 1 a la 5 es botella, de la fila 1 a la 5 es plano, columna 1 es cantidad, columna 2 es precio
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma de las cantidades y precios de vidrio comprado por factura
//scripts que la utilizan: HistorialCompra_Periodo
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaTotalVidrio($codigo_factura,$sucursal){
	include "abrir_conexion.php";
	
	switch($sucursal){
		case 'VICESA':
		case 'VIGUA':	$select_vidrio = "SELECT vidrio.codigo_tipo, vidrio.codigo_color, vidrio.cantidad_vidrio, vidrio.precio FROM vidrio, facturas WHERE facturas.codigo_factura = '$codigo_factura' AND facturas.codigo_factura = vidrio.codigo_factura AND sucursal = '$sucursal' ORDER BY codigo_vidrio ASC";
						break;
		case 'AMBAS':	$select_vidrio = "SELECT vidrio.codigo_tipo, vidrio.codigo_color, vidrio.cantidad_vidrio, vidrio.precio FROM vidrio, facturas WHERE facturas.codigo_factura = '$codigo_factura' AND facturas.codigo_factura = vidrio.codigo_factura ORDER BY codigo_vidrio ASC";
						break;
	}
	$consulta_vidrio = mysql_query($select_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());

	for($i=1; $i<=10; $i++)
		for($j=1; $j<=2; $j++)
			$SumaVidrios[$i][$j] = 0;
	while($vidrios = mysql_fetch_assoc($consulta_vidrio)){
		if($vidrios['codigo_tipo'] == 'TV-01'){
		//-------------------------------------------------
			if($vidrios['codigo_color'] == 'CV-01'){$SumaVidrios[1][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[1][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-02'){$SumaVidrios[2][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[2][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-03'){$SumaVidrios[3][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[3][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-04'){$SumaVidrios[4][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[4][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-05'){$SumaVidrios[5][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[5][2] += $vidrios['precio'];}
		//-------------------------------------------------
		}
		else
		if($vidrios['codigo_tipo'] == 'TV-02'){
		//-------------------------------------------------
			if($vidrios['codigo_color'] == 'CV-01'){$SumaVidrios[6][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[6][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-02'){$SumaVidrios[7][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[7][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-03'){$SumaVidrios[8][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[8][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-04'){$SumaVidrios[9][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[9][2] += $vidrios['precio'];}
		//-------------------------------------------------
			else
			if($vidrios['codigo_color'] == 'CV-05'){$SumaVidrios[10][1] += $vidrios['cantidad_vidrio'];	$SumaVidrios[10][2] += $vidrios['precio'];}
		//-------------------------------------------------
		}
	}
	include "cerrar_conexion.php";
	return $SumaVidrios;	//devuelve una matriz 10x2, de la fila 1 a la 5 es botella, de la fila 1 a la 5 es plano, columna 1 es cantidad, columna 2 es precio
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma total de las cantidades y precios de cada factura por periodo
//scripts que la utilizan: VerReporteCompra_Periodo, ExportarReporteCompra_Periodo, ImprimirReporteCompra_Periodo,
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaFacturaPeriodo($mes,$ano){
	include "abrir_conexion.php";
	$instruccion = "
	SELECT facturas.codigo_factura, proveedores.nombre_proveedor, vidrio.cantidad_vidrio, vidrio.precio
	FROM facturas, proveedores, vidrio
	WHERE facturas.fecha LIKE '$ano-$mes%'
	AND facturas.codigo_proveedor = proveedores.codigo_proveedor
	AND facturas.codigo_factura = vidrio.codigo_factura
	ORDER BY facturas.codigo_factura ASC";
	$consulta_factura = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_factura!!</SPAN>".mysql_error());

	for($i=1; $i<=1000; $i++)
		for($j=1; $j<=4; $j++)
			$facturasPeriodo[$i][$j] = '';
	global $filas; $bandera = true;
	while($vidrios = mysql_fetch_assoc($consulta_factura)){
		if($bandera){
			$facturasPeriodo[$filas][1] = $vidrios['codigo_factura'];
			$facturasPeriodo[$filas][2] = $vidrios['nombre_proveedor'];
			$facturasPeriodo[$filas][3] = $vidrios['cantidad_vidrio'];
			$facturasPeriodo[$filas][4] = $vidrios['precio'];
			$bandera = false;
		}
		else if($facturasPeriodo[$filas][1] == $vidrios['codigo_factura']){
				$facturasPeriodo[$filas][3] += $vidrios['cantidad_vidrio'];
				$facturasPeriodo[$filas][4] += $vidrios['precio'];
			}
			else{
				$filas++;
				$facturasPeriodo[$filas][1] = $vidrios['codigo_factura'];
				$facturasPeriodo[$filas][2] = $vidrios['nombre_proveedor'];
				$facturasPeriodo[$filas][3] = $vidrios['cantidad_vidrio'];
				$facturasPeriodo[$filas][4] = $vidrios['precio'];
			}
	}
	include "cerrar_conexion.php";
	return $facturasPeriodo;		//devuelve un vector con [factura][proveedor][cantidad][precio] por cada factura, matriz Nx4
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma total de las cantidades y precios de cada factura por proveedor
//scripts que la utilizan: VerReporteCompra_Proveedor, ExportarReporteCompra_Proveedor, ImprimirReporteCompra_Proveedor,
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaFacturaProveedor($proveedor){
	include "abrir_conexion.php";
	$instruccion = "
	SELECT facturas.codigo_factura, facturas.fecha, vidrio.cantidad_vidrio, vidrio.precio
	FROM vidrio, facturas, proveedores
	WHERE proveedores.nombre_proveedor = '$proveedor'
	AND facturas.codigo_proveedor = proveedores.codigo_proveedor
	AND facturas.codigo_factura = vidrio.codigo_factura
	ORDER BY facturas.codigo_factura ASC";
	$consulta_factura = mysql_query($instruccion,$conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_factura!!</SPAN>".mysql_error());

	for($i=1; $i<=1000; $i++)
		for($j=1; $j<=4; $j++)
			$facturasProveedor[$i][$j] = '';
	global $filas; $bandera = true;
	while($vidrios = mysql_fetch_assoc($consulta_factura)){
		if($bandera){
			$facturasProveedor[$filas][1] = $vidrios['codigo_factura'];
			$facturasProveedor[$filas][2] = $vidrios['fecha'];
			$facturasProveedor[$filas][3] = $vidrios['cantidad_vidrio'];
			$facturasProveedor[$filas][4] = $vidrios['precio'];
			$bandera = false;
		}
		else if($facturasProveedor[$filas][1] == $vidrios['codigo_factura']){
				$facturasProveedor[$filas][3] += $vidrios['cantidad_vidrio'];
				$facturasProveedor[$filas][4] += $vidrios['precio'];
			}
			else{
				$filas++;
				$facturasProveedor[$filas][1] = $vidrios['codigo_factura'];
				$facturasProveedor[$filas][2] = $vidrios['fecha'];
				$facturasProveedor[$filas][3] = $vidrios['cantidad_vidrio'];
				$facturasProveedor[$filas][4] = $vidrios['precio'];
			}
	}
	include "cerrar_conexion.php";
	return $facturasProveedor;		//devuelve un vector con [factura][fecha][cantidad][precio] por cada factura, matriz Nx4
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que busca los colores de vidrios vendidos por un recolector
//scripts que la utilizan: VerReporteRecolector_CorteCaja
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function coloresVidrioComprado($codigo_factura){
	include "abrir_conexion.php";
	
	$select_vidrio = "SELECT codigo_color FROM vidrio, facturas WHERE facturas.codigo_factura = '$codigo_factura' AND facturas.codigo_factura = vidrio.codigo_factura ORDER BY codigo_color ASC";
	$consulta_vidrio = mysql_query($select_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_vidrio!!</SPAN>".mysql_error());

	for($i=1; $i<=5; $i++)	$coloresVidrio[$i] = 0;
	
	while($vidrios = mysql_fetch_assoc($consulta_vidrio)){
		switch($vidrios['codigo_color']){
			case 'CV-01':	if($coloresVidrio[1] == 0)	$coloresVidrio[1] = 1;	break;
			case 'CV-02':	if($coloresVidrio[2] == 0)	$coloresVidrio[2] = 1;	break;
			case 'CV-03':	if($coloresVidrio[3] == 0)	$coloresVidrio[3] = 1;	break;
			case 'CV-04':	if($coloresVidrio[4] == 0)	$coloresVidrio[4] = 1;	break;
			case 'CV-05':	if($coloresVidrio[5] == 0)	$coloresVidrio[5] = 1;	break;
		}
	}
		
	include "cerrar_conexion.php";
	return $coloresVidrio;
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que devuelve la fecha y hora actual en un String ("NOMBRE_DIA N_DIA de NOMBRE_MES de N_ANO - HORA:MINUTO am/pm")
//scripts que la utilizan: todos los Reportes
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function hoyEs(){
	$fecha = time();
	$ano = date('Y',$fecha);
	$mes = date('m',$fecha);
	$dia = date('d',$fecha);
	$dia_letra = date('w',$fecha);
	switch($dia_letra){
		case 0: $dia_letra = "Domingo"; 	break;
		case 1: $dia_letra = "Lunes"; 		break;
		case 2: $dia_letra = "Martes"; 		break;
		case 3: $dia_letra = "Miercoles"; 	break;
		case 4: $dia_letra = "Jueves"; 		break;
		case 5: $dia_letra = "Viernes"; 	break;
		case 6: $dia_letra = "Sabado"; 		break;
	}
	switch($mes){
		case '01': $mes_letra = "Enero"; 		break;
		case '02': $mes_letra = "Febrero"; 		break;
		case '03': $mes_letra = "Marzo"; 		break;
		case '04': $mes_letra = "Abril"; 		break;
		case '05': $mes_letra = "Mayo";			break;
		case '06': $mes_letra = "Junio"; 		break;
		case '07': $mes_letra = "Julio"; 		break;
		case '08': $mes_letra = "Agosto"; 		break;
		case '09': $mes_letra = "Septiembre"; 	break;
		case '10': $mes_letra = "Octubre"; 		break;
		case '11': $mes_letra = "Noviembre"; 	break;
		case '12': $mes_letra = "Diciembre"; 	break;
	}
	return "$dia_letra $dia de $mes_letra de $ano - ".date("g:i a");
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que devuelve la fecha actual en un Array ($fecha_hoy(0=>N_DIA, 1=>N_MES, 2=>N_ANO))
//scripts que la utilizan: VerReporteRecolector_CorteCaja
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function fechaHoy(){
	$mes = ARRAY('01' => "ENERO", '02' => "FEBRERO", '03' => "MARZO", '04' => "ABRIL", '05' => "MAYO", '06' => "JUNIO", '07' => "JULIO", '08' => "AGOSTO", '09' => "SEPTIEMBRE", 10 => "OCTUBRE", 11 => "NOVIEMBRE", 12 => "DICIEMBRE");
	$fecha = time();
	$fecha_hoy[0] = date('d',$fecha);
	$fecha_hoy[1] = $mes[date('m',$fecha)];
	$fecha_hoy[2] = date('Y',$fecha);
	return $fecha_hoy;
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que da un String con el formato de fecha compactada a la fecha que recibe como argumento ("NOMBRE_DIA N_DIA de NOMBRE_MES del N_ANO")
//scripts que la utilizan: VerHistorialCompra_Periodo, ImprimirHistorialCompra_Periodo, ExportarHistorialCompra_Periodo
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function formatoFechaExtendida($fecha){
	$fecha = strtotime($fecha);
	$ano = date('Y',$fecha);
	$mes = date('m',$fecha);
	$dia = date('d',$fecha);
	$dia_letra = date('w',$fecha);
	switch($dia_letra){
		case 0: $dia_letra = "Domingo"; 	break;
		case 1: $dia_letra = "Lunes"; 		break;
		case 2: $dia_letra = "Martes"; 		break;
		case 3: $dia_letra = "Miercoles"; 	break;
		case 4: $dia_letra = "Jueves"; 		break;
		case 5: $dia_letra = "Viernes"; 	break;
		case 6: $dia_letra = "Sabado"; 		break;
	}
	switch($mes){
		case '01': $mes_letra = "Enero"; 		break;
		case '02': $mes_letra = "Febrero"; 		break;
		case '03': $mes_letra = "Marzo"; 		break;
		case '04': $mes_letra = "Abril"; 		break;
		case '05': $mes_letra = "Mayo";			break;
		case '06': $mes_letra = "Junio"; 		break;
		case '07': $mes_letra = "Julio"; 		break;
		case '08': $mes_letra = "Agosto"; 		break;
		case '09': $mes_letra = "Septiembre"; 	break;
		case '10': $mes_letra = "Octubre"; 		break;
		case '11': $mes_letra = "Noviembre"; 	break;
		case '12': $mes_letra = "Diciembre"; 	break;
	}
	return "$dia_letra $dia de $mes_letra del $ano";
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que da un String con el formato de fecha compactada a la fecha que recibe como argumento ("N_DIA/NOMBRE_MES/N_ANO")
//scripts que la utilizan: VerHistorialCompra_Periodo, ImprimirHistorialCompra_Periodo, ExportarHistorialCompra_Periodo
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function formatoFechaCompactada($fecha){
	//date("d-m-Y",strtotime($fecha));
	//$dia   = substr($fecha, 0, 2);
	//$mes   = substr($fecha, 3, 2);
	//$ano   = substr($fecha, -4);
	//$fecha = $dia.'-'.$mes.'-'.$ano;
	$fechaCompactada = explode("-", $fecha);
	$dia = $fechaCompactada[2];
	$mes = $fechaCompactada[1];
	$ano = $fechaCompactada[0];
	return "$dia/$mes/$ano";	
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que busca el nombre de un proveedor con el codigo del proveedor
//scripts que la utilizan: frame_contenido
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function BuscarProveedor($codigo){
	include "abrir_conexion.php";
	$proveedores = mysql_query("SELECT nombre_proveedor FROM proveedores WHERE codigo_proveedor = '$codigo'",$conexion) or die ("<SPAN CLASS='error'>Fallo en proveedores!!</SPAN>".mysql_error());
	$proveedor = mysql_fetch_array($proveedores);
	include "cerrar_conexion.php";
	return $proveedor['nombre_proveedor'];
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula que proveedor vende mas vidrio
//scripts que la utilizan: frame_contenido
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function VendeMas(){
	include "abrir_conexion.php";
	$consulta_proveedores = mysql_query("SELECT codigo_factura, codigo_proveedor FROM facturas ORDER BY codigo_proveedor ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedores!!</SPAN>".mysql_error());
	$cantidad_proveedores = mysql_query("SELECT COUNT(codigo_proveedor) AS cantidad FROM proveedores",$conexion) or die ("<SPAN CLASS='error'>Fallo en cantidad_proveedores!!</SPAN>".mysql_error());
	$cantidad = mysql_fetch_array($cantidad_proveedores);

	for($i=1;$i<=$cantidad['cantidad'];$i++){$ventas_proveedores[$i][1] = 0;	$ventas_proveedores[$i][2] = "";}

	$valor_temporal = 0;	$bandera = true;	$i = 1;
	while($facturas_proveedores = mysql_fetch_array($consulta_proveedores)){
		if($bandera){
			$valor_temporal = $facturas_proveedores['codigo_proveedor'];
			$ventas_proveedores[$i][1]++;
			//$ventas_proveedores[$i][2] = BuscarProveedor($facturas_proveedores['codigo_proveedor']);
			$proveedores = mysql_query("SELECT nombre_proveedor FROM proveedores WHERE codigo_proveedor = '".$facturas_proveedores['codigo_proveedor']."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en proveedores!!</SPAN>".mysql_error());
			$proveedor = mysql_fetch_array($proveedores);
			$ventas_proveedores[$i][2] = $proveedor['nombre_proveedor'];
			$bandera = false;
		}
		else{
			if($valor_temporal == $facturas_proveedores['codigo_proveedor']){
				$ventas_proveedores[$i][1]++;
				//$ventas_proveedores[$i][2] = BuscarProveedor($facturas_proveedores['codigo_proveedor']);
				$proveedores = mysql_query("SELECT nombre_proveedor FROM proveedores WHERE codigo_proveedor = '".$facturas_proveedores['codigo_proveedor']."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en proveedores!!</SPAN>".mysql_error());
				$proveedor = mysql_fetch_array($proveedores);
				$ventas_proveedores[$i][2] = $proveedor['nombre_proveedor'];
			}
			else{
				$valor_temporal = $facturas_proveedores['codigo_proveedor'];
				$i++;
				$ventas_proveedores[$i][1]++;
				//$ventas_proveedores[$i][2] = BuscarProveedor($facturas_proveedores['codigo_proveedor']);
				$proveedores = mysql_query("SELECT nombre_proveedor FROM proveedores WHERE codigo_proveedor = '".$facturas_proveedores['codigo_proveedor']."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en proveedores!!</SPAN>".mysql_error());
				$proveedor = mysql_fetch_array($proveedores);
				$ventas_proveedores[$i][2] = $proveedor['nombre_proveedor'];
			}
		}
	}
	if($valor_temporal == 0 && $bandera == true && $i == 1)	return false;
	
	$aux_cant = 0;	$aux_nomb = 0;	$tamano = $cantidad['cantidad'];
	for($i=1; $i<$tamano; $i++){
		for($j=1; $j<$tamano-$i; $j++){
			if($ventas_proveedores[$j][1] < $ventas_proveedores[$j+1][1]){
				$aux_cant = $ventas_proveedores[$j][1];	$aux_nomb = $ventas_proveedores[$j][2];
				$ventas_proveedores[$j][1] = $ventas_proveedores[$j+1][1];	$ventas_proveedores[$j][2] = $ventas_proveedores[$j+1][2];
				$ventas_proveedores[$j+1][1] = $aux_cant;	$ventas_proveedores[$j+1][2] = $aux_nomb;
			}
		}
	}
	include "cerrar_conexion.php";
	return $ventas_proveedores;
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que busca el nombre de un recolector con el codigo del recolector
//scripts que la utilizan: frame_contenido
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function BuscarRecolector($codigo){
	include "abrir_conexion.php";
	$recolectores = mysql_query("SELECT nombre_recolector FROM recolectores WHERE codigo_recolector = '$codigo'",$conexion) or die ("<SPAN CLASS='error'>Fallo en recolectores!!</SPAN>".mysql_error());
	$recolector = mysql_fetch_array($recolectores);
	include "cerrar_conexion.php";
	return $recolector['nombre_recolector'];
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula que recolector vende mas vidrio
//scripts que la utilizan: frame_contenido
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function CompraMas(){
	include "abrir_conexion.php";
	$consulta_recolectores = mysql_query("SELECT codigo_factura, codigo_recolector FROM facturas ORDER BY codigo_recolector ASC",$conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_recolectores!!</SPAN>".mysql_error());
	$cantidad_recolectores = mysql_query("SELECT COUNT(codigo_recolector) AS cantidad FROM recolectores",$conexion) or die ("<SPAN CLASS='error'>Fallo en cantidad_recolectores!!</SPAN>".mysql_error());
	$cantidad = mysql_fetch_array($cantidad_recolectores);

	for($i=1;$i<=$cantidad['cantidad'];$i++){$ventas_recolectores[$i][1] = 0;	$ventas_recolectores[$i][2] = "";}

	$valor_temporal = 0;	$bandera = true;	$i=1;
	while($facturas_recolectores = mysql_fetch_array($consulta_recolectores)){
		if($bandera){
			$valor_temporal = $facturas_recolectores['codigo_recolector'];
			$ventas_recolectores[$i][1]++;
			//$ventas_recolectores[$i][2] = BuscarRecolector($facturas_recolectores['codigo_recolector']);
			$recolectores = mysql_query("SELECT nombre_recolector FROM recolectores WHERE codigo_recolector = '".$facturas_recolectores['codigo_recolector']."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en recolectores!!</SPAN>".mysql_error());
			$recolector = mysql_fetch_array($recolectores);
			$ventas_recolectores[$i][2] = $recolector['nombre_recolector'];
			$bandera = false;
		}
		else{
			if($valor_temporal == $facturas_recolectores['codigo_recolector']){
				$ventas_recolectores[$i][1]++;
				//$ventas_recolectores[$i][2] = BuscarRecolector($facturas_recolectores['codigo_recolector']);
				$recolectores = mysql_query("SELECT nombre_recolector FROM recolectores WHERE codigo_recolector = '".$facturas_recolectores['codigo_recolector']."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en recolectores!!</SPAN>".mysql_error());
				$recolector = mysql_fetch_array($recolectores);
				$ventas_recolectores[$i][2] = $recolector['nombre_recolector'];
			}
			else{
				$valor_temporal = $facturas_recolectores['codigo_recolector'];
				$i++;
				$ventas_recolectores[$i][1]++;
				//$ventas_recolectores[$i][2] = BuscarRecolector($facturas_recolectores['codigo_recolector']);
				$recolectores = mysql_query("SELECT nombre_recolector FROM recolectores WHERE codigo_recolector = '".$facturas_recolectores['codigo_recolector']."'",$conexion) or die ("<SPAN CLASS='error'>Fallo en recolectores!!</SPAN>".mysql_error());
				$recolector = mysql_fetch_array($recolectores);
				$ventas_recolectores[$i][2] = $recolector['nombre_recolector'];
			}
		}
	}
	if($valor_temporal == 0 && $bandera == true && $i == 1)	return false;

	$aux_cant = 0;	$aux_nomb = 0;	$tamano = $cantidad['cantidad'];
	for($i=1; $i<$tamano; $i++){
		for($j=1; $j<$tamano-$i; $j++){
			if($ventas_recolectores[$j][1] < $ventas_recolectores[$j+1][1]){
				$aux_cant = $ventas_recolectores[$j][1];	$aux_nomb = $ventas_recolectores[$j][2];
				$ventas_recolectores[$j][1] = $ventas_recolectores[$j+1][1];	$ventas_recolectores[$j][2] = $ventas_recolectores[$j+1][2];
				$ventas_recolectores[$j+1][1] = $aux_cant;	$ventas_recolectores[$j+1][2] = $aux_nomb;
			}
		}
	}
	include "cerrar_conexion.php";
	return $ventas_recolectores;
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//function:		convierte un numero a su lectura en letras, dado un numero lo devuelve escrito.
//parametros:	$num number - numero a convertir.
//				$fem bool - forma femenina (true) o no (false).
//				$dec bool - con decimales (true) o no (false).
//resultado:	string - devuelve el numero escrito en letra.
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 function numeroLetras($num, $fem = true, $dec = true){
//if (strlen($num) > 14) die("El numero introducido es demasiado grande");
   $matuni[2]  = "dos";
   $matuni[3]  = "tres";
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";
   $matuni[6]  = "seis";
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";
   $matuni[9]  = "nueve";
   $matuni[10] = "diez";
   $matuni[11] = "once";
   $matuni[12] = "doce";
   $matuni[13] = "trece";
   $matuni[14] = "catorce";
   $matuni[15] = "quince";
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";
   $matuni[18] = "dieciocho";
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte";
   $matunisub[2] = "dos";
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";
   $matunisub[5] = "quin";
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";
   $matunisub[8] = "ocho";
   $matunisub[9] = "nove";

   $matdec[2] = "veint";
   $matdec[3] = "treinta";
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";
   $matdec[6] = "sesenta";
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";
   $matdec[9] = "noventa";
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';
   $matsub[7]  = 'mill';
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';
   $matsub[13] = 'bill';
   $matsub[15] = 'mill';
   $matmil[4]  = 'millones';
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';

   $num = trim((string)@$num);
   if ($num[0] == '-'){
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++){
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)){
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)){
         if ($punt){
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros){
      $fin = ' punto';
      for ($n = 0; $n < strlen($fra); $n++){
         if (($s = $fra[$n]) == '0')
            $fin .= ' cero';
         elseif ($s == '1')
            $fin .= $fem ? ' una' : ' un';
         else
            $fin .= ' ' . $matuni[$s];
      }
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   while ( ($num = substr($ent, -3)) != '   '){
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem){
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00'){
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30){
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1){
         $t = ' ciento' . $t;
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
      if ($sub == 1){
      }elseif (! isset($matsub[$sub])){
         if ($num == 1){
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1){
         $t .= ' ' . $matsub[$sub] . '?n';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }
      if ($num == '000') $mils ++;
      elseif ($mils != 0){
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   return ucfirst($tex);
}
?>