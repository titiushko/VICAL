@echo off

echo Descargando la Base de Datos, espere porfavor . . .
c:\wamp\bin\mysql\mysql5.5.16\bin\mysqldump.exe -uroot --password= --opt vical > "BASE DE DATOS VICAL (respaldo).sql"
cls
echo Precione una tecla para salir del programa de instalacion
echo y abrir SCYCPVES para empezar a usarlo . . .
pause >nul