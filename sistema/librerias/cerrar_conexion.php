<!--Seria correcto cerrar la conexión abierta al terminar de trabajar con la base-->
<? mysql_close($conexion); ?>
<!--Esta línea cierra la conexión con el motor MySQL abierta en el archivo conexion.php, este archivo será 
incluido en el final de todos los scripts siguientes.-->