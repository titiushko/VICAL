@echo off

echo ::::::::::::::::::::::::::::::::::::::::::::::
echo ::					    ::
echo ::  BIENVENIDO AL PROGRAMA DE INSTALACION   ::
echo ::         DEL SISTEMA DE COMPRAS           ::
echo ::        Y CONTROL DE PROVEEDORES          ::
echo ::    DE LA EMPRESA VICAL DE EL SALVADOR    ::
echo ::              (SCYCPVES)                  ::
echo ::					    ::
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa instalara SCYCPVES en su computadora.
echo Se instalara previeamente los componentes necesarios para utilizar SCYCPVES.
echo .
echo .
echo Instalando Mozilla Firefox, espere porfavor . . .
componentes\firefox.exe -ms
cls
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo ::					    ::
echo ::  BIENVENIDO AL PROGRAMA DE INSTALACION   ::
echo ::         DEL SISTEMA DE COMPRAS           ::
echo ::        Y CONTROL DE PROVEEDORES          ::
echo ::    DE LA EMPRESA VICAL DE EL SALVADOR    ::
echo ::              (SCYCPVES)                  ::
echo ::					    ::
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa instalara SCYCPVES en su computadora.
echo Se instalara previeamente los componentes necesarios para utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo Instalando WampServer, espere porfavor . . .
componentes\wampserver.exe
cls
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo ::					    ::
echo ::  BIENVENIDO AL PROGRAMA DE INSTALACION   ::
echo ::         DEL SISTEMA DE COMPRAS           ::
echo ::        Y CONTROL DE PROVEEDORES          ::
echo ::    DE LA EMPRESA VICAL DE EL SALVADOR    ::
echo ::              (SCYCPVES)                  ::
echo ::					    ::
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa instalara SCYCPVES en su computadora.
echo Se instalara previeamente los componentes necesarios para utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo WampServer se ha instalado con exito!
echo .
echo .
echo Instalando SCYCPVES, espere porfavor . . .
del c:\wamp\www\*.php /S /Q
xcopy componentes\scycpves c:\wamp\www\ /E
cls
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo ::					    ::
echo ::  BIENVENIDO AL PROGRAMA DE INSTALACION   ::
echo ::         DEL SISTEMA DE COMPRAS           ::
echo ::        Y CONTROL DE PROVEEDORES          ::
echo ::    DE LA EMPRESA VICAL DE EL SALVADOR    ::
echo ::              (SCYCPVES)                  ::
echo ::					    ::
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa instalara SCYCPVES en su computadora.
echo Se instalara previeamente los componentes necesarios para utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo WampServer se ha instalado con exito!
echo .
echo .
echo SCYCPVES se ha instalado con exito!
echo .
echo .
echo Configurando SCYCPVES, espere porfavor . . .
copy componentes\configuracion\wampmanager.conf c:\wamp\
copy componentes\configuracion\config.inc.php c:\wamp\apps\phpmyadmin3.5.1\
copy componentes\configuracion\httpd-vhosts.conf c:\wamp\bin\apache\apache2.2.22\conf\original\extra\
copy componentes\configuracion\hosts c:\windows\system32\drivers\etc\
cls
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo ::					    ::
echo ::  BIENVENIDO AL PROGRAMA DE INSTALACION   ::
echo ::         DEL SISTEMA DE COMPRAS           ::
echo ::        Y CONTROL DE PROVEEDORES          ::
echo ::    DE LA EMPRESA VICAL DE EL SALVADOR    ::
echo ::              (SCYCPVES)                  ::
echo ::					    ::
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa instalara SCYCPVES en su computadora.
echo Se instalara previeamente los componentes necesarios para utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo WampServer se ha instalado con exito!
echo .
echo .
echo SCYCPVES se ha instalado con exito!
echo .
echo .
echo SCYCPVES se ha configurado con exito!
echo .
echo .
echo Creando la Base de Datos, espere porfavor . . .
c:\wamp\bin\mysql\mysql5.5.24\bin\mysql.exe -uroot --password= < componentes\configuracion\crear_usuario.sql
c:\wamp\bin\mysql\mysql5.5.24\bin\mysql.exe -uvidrio --password=ciclopentanoperhidrofenantreno < componentes\configuracion\crear_base_datos.sql
cls
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo ::					    ::
echo ::  BIENVENIDO AL PROGRAMA DE INSTALACION   ::
echo ::         DEL SISTEMA DE COMPRAS           ::
echo ::        Y CONTROL DE PROVEEDORES          ::
echo ::    DE LA EMPRESA VICAL DE EL SALVADOR    ::
echo ::              (SCYCPVES)                  ::
echo ::					    ::
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa instalara SCYCPVES en su computadora.
echo Se instalara previeamente los componentes necesarios para utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo WampServer se ha instalado con exito!
echo .
echo .
echo SCYCPVES se ha instalado con exito!
echo .
echo .
echo SCYCPVES se ha configurado con exito!
echo .
echo .
echo Base de Datos creada con exito!
echo .
echo .
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo ::					    ::
echo ::  EL PROGRAMA DE INSTALACION A TERMINADO  ::
echo ::					    ::
echo ::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
pause
"c:\program files\mozilla firefox\firefox.exe" SCYCPVES
exit