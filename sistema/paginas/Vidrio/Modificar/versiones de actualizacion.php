<?php
//VERSION 1
//contar los codigos de los registros a modificar de la tabla vidrio
$instruccion_select = "SELECT codigo_vidrio FROM vidrio WHERE codigo_factura = '$codigo_factura' ORDER BY codigo_vidrio ASC";
$consulta_vidrio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_vidrio!! </SPAN>".mysql_error());
$vidrio = mysql_fetch_array($consulta_vidrio);
$codigo_vidrio = $vidrio[0];

for($i=1; $i<=10; $i++){	//$i --> colores
	if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){
		$actualizar_vidrio = "
		UPDATE vical.vidrio
		SET cantidad_vidrio = '".$Compras[$i][1]."', precio = '".$Compras[$i][2]."'
		WHERE codigo_vidrio = '$codigo_vidrio'";
		mysql_query($actualizar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_vidrio!! </SPAN>".mysql_error());
		$codigo_vidrio++;
	}
}
//VERSION 2
//instruccion para seleccionar los codigos de los registros a modificar de la tabla vidrio
$instruccion_select = "SELECT codigo_vidrio FROM vidrio WHERE codigo_factura = '$codigo_factura' ORDER BY codigo_vidrio ASC";
$consulta_vidrio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_vidrio!! </SPAN>".mysql_error());

$registros = 1;
while($vidrio = mysql_fetch_array($consulta_vidrio)){
	$codigos_vidrio[$registros] = $vidrio[0];
	$registros++;
}

$codigo_vidrio = $codigos_vidrio[1];	$indice = 1;
for($i=1; $i<=10; $i++){
	if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){
		for($j=1; $j<$registros; $j++){
			if($codigo_vidrio == $codigos_vidrio[$j]){
				$actualizar_vidrio = "
				UPDATE vical.vidrio SET cantidad_vidrio = '".$Compras[$i][1]."', precio = '".$Compras[$i][2]."'
				WHERE codigo_vidrio = '$codigo_vidrio'";
				mysql_query($actualizar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_vidrio!! </SPAN>".mysql_error());
				$j = $registros + 1;
			}
			else{
				if($i >= 1 && $i <= 5){
					$codigo_tipo = 'TV-01';
					if($indice == 5) $indice = 1;
					else $indice++;
				}
				if($i >= 6 && $i <= 10){
					$codigo_tipo = 'TV-02';
					if($indice == 5) $indice = 1;
					else $indice++;
				}
				$insertar_vidrio = "
				INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO)
				VALUES ('$codigo_tipo','CV-0$indice','$codigo_factura','".$Compras[$i][1]."','".$Compras[$i][2]."')";
				mysql_query($insertar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la insertar_vidrio!! </SPAN>".mysql_error());
				$j = $registros + 1;
			}
		}
		$codigo_vidrio++;
	}
}
//VERSION 3
//instruccion para seleccionar los codigos de los registros a modificar de la tabla vidrio
$instruccion_select = "SELECT codigo_vidrio FROM vidrio WHERE codigo_factura = '$codigo_factura' ORDER BY codigo_vidrio ASC";
$consulta_vidrio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_vidrio!! </SPAN>".mysql_error());

$registros = 1;
while($vidrio = mysql_fetch_array($consulta_vidrio)){
	$codigos_vidrio[$registros] = $vidrio[0];
	$registros++;
}

$codigo_vidrio = $codigos_vidrio[1];	$indice = 1;
for($i=1; $i<=10; $i++){
	for($j=1; $j<$registros; $j++){
		if($codigo_vidrio == $codigos_vidrio[$j]){
			if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){$cantidad_vidrio = $Compras[$i][1];	$precio = $Compras[$i][2];}
			else if($Compras[$i][1] == 0 && $Compras[$i][2] == 0){$cantidad_vidrio = 0;	$precio = 0;}
			$actualizar_vidrio = "UPDATE vical.vidrio SET cantidad_vidrio = '$cantidad_vidrio', precio = '$precio' WHERE codigo_vidrio = '$codigo_vidrio'";
			mysql_query($actualizar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_vidrio!! </SPAN>".mysql_error());
			$j = $registros + 1;
		}
		else{
			if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){
				if($i >= 1 && $i <= 5){
					$codigo_tipo = 'TV-01';
					if($indice == 5) $indice = 1;	else $indice++;
				}
				if($i >= 6 && $i <= 10){
					$codigo_tipo = 'TV-02';
					if($indice == 5) $indice = 1;	else $indice++;
				}
				$insertar_vidrio = "
				INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO)
				VALUES ('$codigo_tipo','CV-0$indice','$codigo_factura','".$Compras[$i][1]."','".$Compras[$i][2]."')";
				mysql_query($insertar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la insertar_vidrio!! </SPAN>".mysql_error());
				$j = $registros + 1;
			}
		}
	}
	$codigo_vidrio++;
}
//VERSION 4
//instruccion para seleccionar los codigos de los registros a modificar de la tabla vidrio
$instruccion_select = "SELECT codigo_vidrio FROM vidrio WHERE codigo_factura = '$codigo_factura' ORDER BY codigo_vidrio ASC";
$consulta_vidrio = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en la consulta_vidrio!! </SPAN>".mysql_error());

$registros = 1;
while($vidrio = mysql_fetch_array($consulta_vidrio)){
	$codigos_vidrio[$registros] = $vidrio[0];
	$registros++;
}

$codigo_vidrio = $codigos_vidrio[1];	$indice = 1;
for($i=1; $i<=10; $i++){
	if($Compras[$i][1] <> 0 && $Compras[$i][2] <> 0){
		for($j=1; $j<$registros; $j++){
			if($codigo_vidrio == $codigos_vidrio[$j]){
				$actualizar_vidrio = "
				UPDATE vical.vidrio SET cantidad_vidrio = '".$Compras[$i][1]."', precio = '".$Compras[$i][2]."'
				WHERE codigo_vidrio = '$codigo_vidrio'";
				mysql_query($actualizar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_vidrio!! </SPAN>".mysql_error());
				$j = $registros + 1;
			}
			else{
				if($i >= 1 && $i <= 5){
					$codigo_tipo = 'TV-01';
					if($indice == 5) $indice = 1;
					else $indice++;
				}
				if($i >= 6 && $i <= 10){
					$codigo_tipo = 'TV-02';
					if($indice == 5) $indice = 1;
					else $indice++;
				}
				$insertar_vidrio = "
				INSERT INTO vical.vidrio (CODIGO_TIPO,CODIGO_COLOR,CODIGO_FACTURA,CANTIDAD_VIDRIO,PRECIO)
				VALUES ('$codigo_tipo','CV-0$indice','$codigo_factura','".$Compras[$i][1]."','".$Compras[$i][2]."')";
				mysql_query($insertar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la insertar_vidrio!! </SPAN>".mysql_error());
				$j = $registros + 1;
			}
		}
		$codigo_vidrio++;
	}
	else if($Compras[$i][1] == 0 && $Compras[$i][2] == 0){
		for($j=1; $j<$registros; $j++){
			if($codigo_vidrio == $codigos_vidrio[$j]){
				$actualizar_vidrio = "
				UPDATE vical.vidrio SET cantidad_vidrio = NULL, precio = NULL
				WHERE codigo_vidrio = '$codigo_vidrio'";
				mysql_query($actualizar_vidrio, $conexion) or die ("<SPAN CLASS='error'>Fallo en la actualizar_vidrio!! </SPAN>".mysql_error());
				$j = $registros + 1;
			}
		}
		$codigo_vidrio++;
	}
}
?>