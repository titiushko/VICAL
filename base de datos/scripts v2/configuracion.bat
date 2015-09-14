@echo off

echo Configurando SCYCPVES, espere porfavor . . .
copy archivos\configuracion\wampmanager.conf c:\wamp\
copy archivos\configuracion\config.inc.php c:\wamp\apps\phpmyadmin3.4.5\
copy archivos\configuracion\httpd-vhosts.conf c:\wamp\bin\apache\apache2.2.21\conf\original\extra\
copy archivos\configuracion\hosts c:\windows\system32\drivers\etc\
cls
echo SCYCPVES se ha configurado con exito!
echo .
echo .
pause