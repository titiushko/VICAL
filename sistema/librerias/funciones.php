<?php
$filas = 1;		//variable global
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma de las cantidades y precios de vidrio comprado por factura para un determinado mes y año
//scripts que la utilizan: GraficarEstadisticaCompra, GraficarComparacionCompra
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaCompras($mes,$ano){
	include "../../../librerias/abrir_conexion.php";
	$select_factura = "SELECT codigo_factura FROM facturas WHERE YEAR(fecha) = '$ano' AND MONTH(fecha) = '$mes' ORDER BY codigo_factura ASC";
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
	include "../../../librerias/cerrar_conexion.php";
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
function calcularSumaMes($tabla,$buscar){
	include "../../../librerias/abrir_conexion.php";
	switch($tabla){
		case 'tipo_vidrio':	$buscar_por = "AND vidrio.codigo_tipo = '$buscar'";	break;
		case 'proveedor':	$buscar_por = "AND facturas.codigo_proveedor = '$buscar'";	break;
	}
	$seleccionar_vidrio = "
	SELECT
	YEAR(fecha) AS ano,
	MONTH(fecha) AS mes,
	vidrio.cantidad_vidrio,
	vidrio.precio
	FROM facturas, vidrio
	WHERE facturas.codigo_factura = vidrio.codigo_factura
	$buscar_por
	ORDER BY facturas.fecha  ASC";
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
	include "../../../librerias/cerrar_conexion.php";
	return $comprasMes;		//devuelve un vector con [ano][mes][cantidad][precio] por cada año, matriz Nx4
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma de las cantidades y precios de vidrio comprado por factura
//scripts que la utilizan: verCompra, frmModificarCompra, frmEliminarCompra, EliminarCompra, HistorialCompra_Periodo
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaVidrio($codigo_factura){
	include "../../../librerias/abrir_conexion.php";
	$select_vidrio = "
	SELECT vidrio.codigo_tipo, vidrio.codigo_color, vidrio.cantidad_vidrio, vidrio.precio
	FROM vidrio, facturas
	WHERE facturas.codigo_factura = '$codigo_factura'
	AND facturas.codigo_factura = vidrio.codigo_factura
	ORDER BY codigo_vidrio ASC";
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
	include "../../../librerias/cerrar_conexion.php";
	return $SumaVidrios;	//devuelve una matriz 10x2, de la fila 1 a la 5 es botella, de la fila 1 a la 5 es plano, columna 1 es cantidad, columna 2 es precio
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma total de las cantidades y precios de cada factura por periodo
//scripts que la utilizan: VerReporteCompra_Periodo, ExportarReporteCompra_Periodo, ImprimirReporteCompra_Periodo,
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaFacturaPeriodo($mes,$ano){
	include "../../../librerias/abrir_conexion.php";
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
	include "../../../librerias/cerrar_conexion.php";
	return $facturasPeriodo;		//devuelve un vector con [factura][proveedor][cantidad][precio] por cada factura, matriz Nx4
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que calcula la suma total de las cantidades y precios de cada factura por proveedor
//scripts que la utilizan: VerReporteCompra_Proveedor, ExportarReporteCompra_Proveedor, ImprimirReporteCompra_Proveedor,
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function calcularSumaFacturaProveedor($proveedor){
	include "../../../librerias/abrir_conexion.php";
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
	include "../../../librerias/cerrar_conexion.php";
	return $facturasProveedor;		//devuelve un vector con [factura][fecha][cantidad][precio] por cada factura, matriz Nx4
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//funcion que muestra la fecha y hora actual
//scripts que la utilizan: frmReporteCompra_Periodo,
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function hoyEs(){
	$fecha = time();
	$ano = date('Y',$fecha);
	$mes = date('m',$fecha);
	$dia = date('d',$fecha);
	$dia_letra = date('w',$fecha);
	switch($dia_letra){
		case 0: $dia_letra = "Domingo"; break;
		case 1: $dia_letra = "Lunes"; break;
		case 2: $dia_letra = "Martes"; break;
		case 3: $dia_letra = "Miercoles"; break;
		case 4: $dia_letra = "Jueves"; break;
		case 5: $dia_letra = "Viernes"; break;
		case 6: $dia_letra = "Sabado"; break;
	}
	switch($mes) {
		case '01': $mes_letra = "Enero"; break;
		case '02': $mes_letra = "Febrero"; break;
		case '03': $mes_letra = "Marzo"; break;
		case '04': $mes_letra = "Abril"; break;
		case '05': $mes_letra = "Mayo"; break;
		case '06': $mes_letra = "Junio"; break;
		case '07': $mes_letra = "Julio"; break;
		case '08': $mes_letra = "Agosto"; break;
		case '09': $mes_letra = "Septiembre"; break;
		case '10': $mes_letra = "Octubre"; break;
		case '11': $mes_letra = "Noviembre"; break;
		case '12': $mes_letra = "Diciembre"; break;
	}    
	return "$dia_letra $dia de $mes_letra de $ano - ".date("g:i a");
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
?>