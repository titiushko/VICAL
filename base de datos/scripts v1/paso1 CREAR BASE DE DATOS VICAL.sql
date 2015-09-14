DROP DATABASE IF EXISTS VICAL;
-- -------------------------------------------------------------------------------------
CREATE DATABASE VICAL DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE VICAL;
-- -------------------------------------------------------------------------------------
/*==============================================================*/
/* Table: PRECIO			                                    */
/*==============================================================*/
create table PRECIOS (
   CODIGO_PRECIO				int(5) auto_increment not null,
   PRECIO_UNITARIO 				float(4) not null default '1.2',
   primary key (CODIGO_PRECIO)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8;
/*==============================================================*/
/* Table: CENTROS_DE_ACOPIO                                     */
/*==============================================================*/
create table CENTROS_DE_ACOPIO
(
   CODIGO_CENTRO_ACOPIO			char(6) not null,
   CODIGO_RECOLECTOR			char(5) not null,
   NOMBRE_CENTRO_ACOPIO			varchar(50),
   DIRECCION			     	varchar(100),
   DEPARTAMENTO					varchar(50),
   TELEFONO						varchar(10),
   primary key (CODIGO_CENTRO_ACOPIO)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8; 
/*==============================================================*/
/* Table: COLORES_VIDRIO                                        */
/*==============================================================*/
create table COLORES_VIDRIO
(
   CODIGO_COLOR         		char(5) not null,
   NOMBRE_COLOR         		varchar(10),
   primary key (CODIGO_COLOR)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8; 
/*==============================================================*/
/* Table: PROVEEDORES                                           */
/*==============================================================*/
create table PROVEEDORES
(
   CODIGO_PROVEEDOR     		int(5) auto_increment not null,
   CODIGO_TIPO_EMPRESA  		char(5) not null,
   NOMBRE_PROVEEDOR       		varchar(50),
   DEPARTAMENTO         		varchar(50),
   DIRECCION_PROVEEDOR  		varchar(100),
   TELEFONO_PROVEEDOR1  		varchar(10),
   TELEFONO_PROVEEDOR2  		varchar(10),
   CONTACTO             		varchar(50),
   ESTANON                  	varchar(5),
   primary key (CODIGO_PROVEEDOR)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8; 
/*==============================================================*/
/* Table: RECOLECTORES                                          */
/*==============================================================*/
create table RECOLECTORES
(
   CODIGO_RECOLECTOR    		char(5) not null,
   NOMBRE_RECOLECTOR    		varchar(50),
   TELEFONO_RECOLECTOR  		varchar(10),
   DUI_RECOLECTOR           	varchar(10),
   NIT_RECOLECTOR           	varchar(17),
   DIRECCION_RECOLECTOR     	varchar(100),
   primary key (CODIGO_RECOLECTOR)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8;
/*==============================================================*/
/* Table: TIPOS_EMPRESAS                                        */
/*==============================================================*/
create table TIPOS_EMPRESAS
(
   CODIGO_TIPO_EMPRESA  		char(5) not null,
   NOMBRE_TIPO_EMPRESA  		varchar(50),
   primary key (CODIGO_TIPO_EMPRESA)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8; 
/*==============================================================*/
/* Table: FACTURAS                                     			*/
/*==============================================================*/
create table FACTURAS
(
   CODIGO_FACTURA    			char(5) not null,
   CODIGO_PROVEEDOR     		int(5) not null,
   CODIGO_RECOLECTOR    		char(5) not null,
   SUCURSAL			    		varchar(6) not null,
   CODIGO_CENTRO_ACOPIO			char(6) not null,
   PRECIO_COMPRA         		float(2),
   FECHA                		date,
   primary key (CODIGO_FACTURA)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8;
/*==============================================================*/
/* Table: COMPRAS                           	     			*/
/*==============================================================*/
create table COMPRAS
(
   CODIGO_COMPRA				int(5) auto_increment not null,
   CODIGO_FACTURA       		char(5) not null,
   primary key (CODIGO_COMPRA)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8;
/*==============================================================*/
/* Table: TIPOS_VIDRIO                                          */
/*==============================================================*/
create table TIPOS_VIDRIO
(
   CODIGO_TIPO					varchar(5) not null,
   NOMBRE_TIPO					varchar(50),
   primary key (CODIGO_TIPO)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8;
/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS
(
   ID	              			int(5) auto_increment not null,
   NOMBRE	           			varchar(50) not null,
   USUARIO              		varchar(15) not null,
   PASSWORD             		varchar(15) not null,
   NIVEL						int(5) not null,
   primary key (ID)
 )
ENGINE=InnoDB DEFAULT CHAR SET=utf8; 
/*==============================================================*/
/* Table: VIDRIO                                                */
/*==============================================================*/
create table VIDRIO
(
   CODIGO_VIDRIO        		int(5) auto_increment not null,
   CODIGO_TIPO          		varchar(5) not null,
   CODIGO_COLOR         		char(5) not null,
   CODIGO_FACTURA       		char(5) not null,
   CANTIDAD_VIDRIO      		float(2),
   PRECIO_VIDRIO          		float(2),
   primary key (CODIGO_VIDRIO)
)
ENGINE=InnoDB DEFAULT CHAR SET=utf8; 
/*==============================================================*/
/* Relaciones                                                   */
/*==============================================================*/
ALTER TABLE CENTROS_DE_ACOPIO ADD CONSTRAINT FK_ADMINISTRA FOREIGN KEY (CODIGO_RECOLECTOR) REFERENCES RECOLECTORES (CODIGO_RECOLECTOR) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE PROVEEDORES ADD CONSTRAINT FK_ESPECIFICA FOREIGN KEY (CODIGO_TIPO_EMPRESA) REFERENCES TIPOS_EMPRESAS (CODIGO_TIPO_EMPRESA) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE FACTURAS ADD CONSTRAINT FK_REGISTRA FOREIGN KEY (CODIGO_RECOLECTOR) REFERENCES RECOLECTORES (CODIGO_RECOLECTOR) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE FACTURAS ADD CONSTRAINT FK_PERTENECE FOREIGN KEY (CODIGO_PROVEEDOR) REFERENCES PROVEEDORES (CODIGO_PROVEEDOR) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE FACTURAS ADD CONSTRAINT FK_GUARDA FOREIGN KEY (CODIGO_CENTRO_ACOPIO) REFERENCES CENTROS_DE_ACOPIO (CODIGO_CENTRO_ACOPIO) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE COMPRAS ADD CONSTRAINT FK_REALIZA FOREIGN KEY (CODIGO_FACTURA) REFERENCES FACTURAS (CODIGO_FACTURA) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE VIDRIO ADD CONSTRAINT FK_DETALLA FOREIGN KEY (CODIGO_COLOR) REFERENCES COLORES_VIDRIO (CODIGO_COLOR) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE VIDRIO ADD CONSTRAINT FK_INCLUYE FOREIGN KEY (CODIGO_TIPO) REFERENCES TIPOS_VIDRIO (CODIGO_TIPO) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE VIDRIO ADD CONSTRAINT FK_POSEE FOREIGN KEY (CODIGO_FACTURA) REFERENCES FACTURAS (CODIGO_FACTURA) ON DELETE RESTRICT ON UPDATE RESTRICT;