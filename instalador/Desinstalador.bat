@echo off

echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo ::					       ::
echo ::  BIENVENIDO AL PROGRAMA DE DESINSTALACION   ::
echo ::   SISTEMA INFORMATICO PARA AYUDAR EN EL     ::
echo ::   REGISTRO DE COMPRAS DE VIDRIO Y EN EL     ::
echo ::      CONTROL DE PROVEEDORES DE VICAL        ::
echo ::          EL SALVADOR (COMVICONPRO)          ::
echo ::					       ::
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa desinstalara COMVICONPRO de su computadora.
echo .
echo .
echo Creando Respaldo de la Base de Datos, espere porfavor . . .
c:\wamp\bin\mysql\mysql5.5.16\bin\mysqldump.exe -uvidrio --password=ciclopentanoperhidrofenantreno --opt vical > respaldo_base_datos\respaldo_base_datos.sql
cls
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo ::					       ::
echo ::  BIENVENIDO AL PROGRAMA DE DESINSTALACION   ::
echo ::   SISTEMA INFORMATICO PARA AYUDAR EN EL     ::
echo ::   REGISTRO DE COMPRAS DE VIDRIO Y EN EL     ::
echo ::      CONTROL DE PROVEEDORES DE VICAL        ::
echo ::          EL SALVADOR (COMVICONPRO)          ::
echo ::					       ::
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa desinstalara COMVICONPRO de su computadora.
echo .
echo .
echo Respaldo de la Base de Datos creada con exito!
echo El Respaldo de la Base de Datos se creo en:
echo "Instalador COMVICONPRO\respaldo_base_datos\respaldo_base_datos.sql"
echo .
echo .
echo Desinstalando WampServer, espere porfavor . . .
c:\wamp\unins000.exe
cls
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo ::					       ::
echo ::  BIENVENIDO AL PROGRAMA DE DESINSTALACION   ::
echo ::   SISTEMA INFORMATICO PARA AYUDAR EN EL     ::
echo ::   REGISTRO DE COMPRAS DE VIDRIO Y EN EL     ::
echo ::      CONTROL DE PROVEEDORES DE VICAL        ::
echo ::          EL SALVADOR (COMVICONPRO)          ::
echo ::					       ::
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa desinstalara COMVICONPRO de su computadora.
echo .
echo .
echo Respaldo de la Base de Datos creada con exito!
echo El Respaldo de la Base de Datos se creo en:
echo "Instalador COMVICONPRO\respaldo_base_datos\respaldo_base_datos.sql"
echo .
echo .
echo WampServer se ha desinstalado con exito!
echo .
echo .
echo Desinstalando COMVICONPRO, espere porfavor . . .
rd c:\wamp\ /S /Q
cls
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo ::					       ::
echo ::  BIENVENIDO AL PROGRAMA DE DESINSTALACION   ::
echo ::   SISTEMA INFORMATICO PARA AYUDAR EN EL     ::
echo ::   REGISTRO DE COMPRAS DE VIDRIO Y EN EL     ::
echo ::      CONTROL DE PROVEEDORES DE VICAL        ::
echo ::          EL SALVADOR (COMVICONPRO)          ::
echo ::					       ::
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
echo Este programa desinstalara COMVICONPRO de su computadora.
echo .
echo .
echo Respaldo de la Base de Datos creada con exito!
echo El Respaldo de la Base de Datos se creo en:
echo "Instalador COMVICONPRO\respaldo_base_datos\respaldo_base_datos.sql"
echo .
echo .
echo WampServer se ha desinstalado con exito!
echo .
echo .
echo COMVICONPRO se ha desinstalado con exito!
echo .
echo .
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo ::					       ::
echo ::  EL PROGRAMA DE DESINSTALACION A TERMINADO  ::
echo ::					       ::
echo :::::::::::::::::::::::::::::::::::::::::::::::::
echo .
echo .
pause