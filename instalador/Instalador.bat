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
echo Se instalara previeamente los componentes necesarios
echo para poder utilizar SCYCPVES.
echo .
echo .
echo Instalando Mozilla Firefox, espere porfavor . . .
archivos\componentes\mozillafirefox.exe -ms
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
echo Se instalara previeamente los componentes necesarios
echo para poder utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo Instalando Flash Player, espere porfavor . . .
archivos\componentes\flashplayer.exe /install
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
echo Se instalara previeamente los componentes necesarios
echo para poder utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo Flash Player se ha instalado con exito!
echo .
echo .
echo Instalando WampServer, espere porfavor . . .
archivos\componentes\wampserver.exe
regedit.exe /s archivos\configuracion\wampserver.reg
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
echo Se instalara previeamente los componentes necesarios
echo para poder utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo Flash Player se ha instalado con exito!
echo .
echo .
echo WampServer se ha instalado con exito!
echo .
echo .
echo Instalando SCYCPVES, espere porfavor . . .
del c:\wamp\www\*.php /S /Q
xcopy archivos\sistema c:\wamp\www\ /E
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
echo Se instalara previeamente los componentes necesarios
echo para poder utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo Flash Player se ha instalado con exito!
echo .
echo .
echo WampServer se ha instalado con exito!
echo .
echo .
echo SCYCPVES se ha instalado con exito!
echo .
echo .
echo Configurando SCYCPVES, espere porfavor . . .
copy archivos\configuracion\wampmanager.conf c:\wamp\
copy archivos\configuracion\config.inc.php c:\wamp\apps\phpmyadmin3.4.5\
copy archivos\configuracion\httpd-vhosts.conf c:\wamp\bin\apache\apache2.2.21\conf\original\extra\
copy archivos\configuracion\hosts c:\windows\system32\drivers\etc\
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
echo Se instalara previeamente los componentes necesarios
echo para poder utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo Flash Player se ha instalado con exito!
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
c:\wamp\bin\mysql\mysql5.5.16\bin\mysql.exe -uroot --password= < archivos\basedatos\crear_usuario.sql
c:\wamp\bin\mysql\mysql5.5.16\bin\mysql.exe -uvidrio --password=ciclopentanoperhidrofenantreno < archivos\basedatos\crear_base_datos.sql
c:\wamp\bin\mysql\mysql5.5.16\bin\mysql.exe -uvidrio --password=ciclopentanoperhidrofenantreno < respaldo_base_datos\respaldo_base_datos.sql
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
echo Se instalara previeamente los componentes necesarios
echo para poder utilizar SCYCPVES.
echo .
echo .
echo Mozilla Firefox se ha instalado con exito!
echo .
echo .
echo Flash Player se ha instalado con exito!
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
echo Precione una tecla para salir del programa de instalacion
echo y abrir SCYCPVES para empezar a usarlo . . .
pause >nul
"c:\program files\mozilla firefox\firefox.exe" SCYCPVES
exit