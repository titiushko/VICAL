<?php
//en este script php se verifica en mysql si existe la base de datos "vical"
//este proceso solo se ejecuta la primera vez que se usa el sistema (por lo tanto no existe la base de datos)

$hostname = "localhost";
$username = "root";
$password = "";
$database = "vical";
$conexion = mysql_connect($hostname,$username,$password) or die ("<SPAN CLASS='error'>No se puede conectar con el servidor!!</SPAN>".mysql_error());
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
	//si la base de datos "vical" existe, redireccionar normalmente al formulario de inicio de sesion
	header ("Location: ../login/CargarLogin.php");
}
else{
	//si la base de datos "vical" no existe, crear la base de datos y redireccionar al formulario de inicio de sesion
	$ejecutar_comando = "c:\\wamp\\bin\\mysql\\mysql5.5.24\\bin\\mysql.exe -uroot --password= < c:\\wamp\\www\\SCyCPVES\\instalador\\BaseDatosVical.sql";
	system($ejecutar_comando,$resultado);
	if(!$resultado){header ("Location: ../login/CargarLogin.php");}
}
?>