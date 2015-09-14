@echo off

echo Cargando la Base de Datos, espere porfavor . . .
c:\wamp\bin\mysql\mysql5.5.16\bin\mysql.exe -uvidrio --password=ciclopentanoperhidrofenantreno < "BASE DE DATOS VICAL (datos prueba).sql"
cls
echo Precione una tecla para salir del programa de instalacion
echo y abrir SCYCPVES para empezar a usarlo . . .
pause >nul