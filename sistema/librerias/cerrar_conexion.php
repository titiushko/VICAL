<?
//Seria correcto cerrar la conexion abierta al terminar de trabajar con la base

mysql_close($conexion);

//Esta linea cierra la conexión con el motor MySQL abierta en el archivo conexion.php, este archivo sera 
//incluido en el final de todos los scripts siguientes.
?>