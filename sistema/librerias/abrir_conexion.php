<?PHP
//En el archivo abrir_conexion.php deben ser configuradas un par de variables correspondientes a nuestro servidor:
//el host, usuario y password para acceder al MySQL, ademas indicar que base se utilizara en la conexion.

$vical_hostname = "localhost";	// host del MySQL (generalmente localhost)
$vical_username = "root"; 		// aqui debes ingresar el nombre de usuario
								// para acceder a la base
$vical_password = "";			// password de acceso para el usuario de la
								// linea anterior
$vical_database="vical";        // Seleccionamos la base con la cual trabajar
$conexion = mysql_connect($vical_hostname, $vical_username, $vical_password) or die ("<SPAN CLASS='error'>No se puede conectar con el servidor!!</SPAN>".mysql_error());
$abrebase = mysql_select_db($vical_database, $conexion) or die ("<SPAN CLASS='error'>No se puede seleccionar la base de datos!!</SPAN>".mysql_error());

//Con este archivo creado podemos empezar a trabajar con la base desde nuestros siguientes scripts.
?>