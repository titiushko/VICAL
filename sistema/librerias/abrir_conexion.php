<?PHP
$hostname 	  = "localhost";
$username 	  = "root";
$password 	  = "";
$database 	  = "vical";
$conexion = mysql_connect($hostname, $username, $password) or die ("<SPAN CLASS='error'>No se puede conectar con el servidor!!</SPAN>".mysql_error());

$consulta_bd = mysql_query("SHOW DATABASES",$conexion) or die ("<SPAN CLASS='error'>Fallo en consultar bases de datos!!</SPAN>".mysql_error());
$existe = false; $bandera = false;
while($bases_datos = mysql_fetch_array($consulta_bd)){
	if(!$bandera){
		if($bases_datos[0] == $database){
			$existe = true;
			$bandera = true;
		}
	}
}

if($existe){
	//si la base de datos "vical" existe, selecciona la base de datos
	$abrebase = mysql_select_db($database, $conexion) or die ("<SPAN CLASS='error'>No se puede seleccionar la base de datos vical!!</SPAN>".mysql_error());
	set_time_limit(0);
}
else{
	//si la base de datos "vical" no existe, crear la base de datos y la selecciona
	$ejecutar_comando = "c:\\wamp\\bin\\mysql\\mysql5.5.24\\bin\\mysql.exe -uroot --password= < c:\\wamp\\www\\SCyCPVES\\instalador\\BaseDatosVical.sql";
	system($ejecutar_comando,$resultado);
	if(!$resultado){
		$abrebase = mysql_select_db($database, $conexion) or die ("<SPAN CLASS='error'>No se puede seleccionar la base de datos vical!!</SPAN>".mysql_error());
		set_time_limit(0);
	}
}
?>