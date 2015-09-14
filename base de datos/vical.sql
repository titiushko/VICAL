DROP DATABASE IF EXISTS VICAL;
-- -------------------------------------------------------------------------------------
CREATE DATABASE VICAL DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE VICAL;
-- -------------------------------------------------------------------------------------

/*==============================================================*/
/* Table: CENTROS_DE_ACOPIO                                     */
/*==============================================================*/
create table CENTROS_DE_ACOPIO
(
   CODIGO_CENTRO_ACOPIO char(6) not null,
   CODIGO_RECOLECTOR    char(5) not null,
   DEPARTAMENTO            varchar(50),
   TELEFONO             varchar(10),
   primary key (CODIGO_CENTRO_ACOPIO)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8; 

/*==============================================================*/
/* Table: COLORES_VIDRIO                                        */
/*==============================================================*/
create table COLORES_VIDRIO
(
   CODIGO_COLOR         char(5) not null,
   NOMBRE_COLOR         varchar(10),
   primary key (CODIGO_COLOR)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8; 

/*==============================================================*/
/* Table: PROVEEDORES                                           */
/*==============================================================*/
create table PROVEEDORES
(
   CODIGO_PROVEEDOR     	int(5) auto_increment not null,
   CODIGO_TIPO_EMPRESA  	char(5) not null,
   NOMBRE_PROVEEDOR       	varchar(50),
   DEPARTAMENTO         	varchar(50),
   DIRECCION_PROVEEDOR  	varchar(100),
   TELEFONO_PROVEEDOR1  	varchar(10),
   TELEFONO_PROVEEDOR2  	varchar(10),
   CONTACTO             	varchar(50),
   primary key (CODIGO_PROVEEDOR)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8; 

/*==============================================================*/
/* Table: RECOLECTORES                                          */
/*==============================================================*/
create table RECOLECTORES
(
   CODIGO_RECOLECTOR    	char(5) not null,
   NOMBRE_RECOLECTOR    	varchar(50),
   TELEFONO_RECOLECTOR  	varchar(10),
   DUI_RECOLECTOR                      varchar(10),
   NIT_RECOLECTOR                      varchar(17),
   DIRECCION_RECOLECTOR                varchar(100),
   primary key (CODIGO_RECOLECTOR)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: TIPOS_EMPRESAS                                        */
/*==============================================================*/
create table TIPOS_EMPRESAS
(
   CODIGO_TIPO_EMPRESA  char(5) not null,
   NOMBRE_TIPO_EMPRESA  varchar(50),
   primary key (CODIGO_TIPO_EMPRESA)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8; 

/*==============================================================*/
/* Table: FACTURAS                                       */
/*==============================================================*/
create table FACTURAS
(
   CODIGO_FACTURA    	char(5) not null,
   CODIGO_PROVEEDOR     int(5) not null,
   CODIGO_RECOLECTOR    char(5) not null,
   FECHA                date,
   primary key (CODIGO_FACTURA)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: TIPOS_VIDRIO                                          */
/*==============================================================*/
create table TIPOS_VIDRIO
(
   CODIGO_TIPO          varchar(5) not null,
   NOMBRE_TIPO          varchar(50),
   primary key (CODIGO_TIPO)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: USUARIOS                                               */
/*==============================================================*/
create table USUARIOS
(
   USUARIO              varchar(15) not null,
   PASSWORD             varchar(15) not null,
   TIPO_USUARIO          varchar(15) not null,
   primary key (USUARIO)
 )
ENGINE=InnoDB DEFAULT CHARSET=utf8; 

/*==============================================================*/
/* Table: VIDRIO                                                */
/*==============================================================*/
create table VIDRIO
(
   CODIGO_VIDRIO        	char(5) not null,
   CODIGO_TIPO          	varchar(5) not null,
   CODIGO_COLOR         	char(5) not null,
   CODIGO_FACTURA       	char(5) not null,
   CANTIDAD_VIDRIO      	float(2),
   PRECIO               	float(2),
   primary key (CODIGO_VIDRIO)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8; 

/*==============================================================*/
/* Relaciones                                                                                                         */
/*==============================================================*/
alter table CENTROS_DE_ACOPIO add constraint FK_ADMINISTRA foreign key (CODIGO_RECOLECTOR)
      references RECOLECTORES (CODIGO_RECOLECTOR) on delete restrict on update restrict;

alter table PROVEEDORES add constraint FK_ESPECIFICA foreign key (CODIGO_TIPO_EMPRESA)
      references TIPOS_EMPRESAS (CODIGO_TIPO_EMPRESA) on delete restrict on update restrict;

alter table FACTURAS add constraint FK_REGISTRA foreign key (CODIGO_RECOLECTOR)
      references RECOLECTORES (CODIGO_RECOLECTOR) on delete restrict on update restrict;

alter table FACTURAS add constraint FK_GUARDA foreign key (CODIGO_PROVEEDOR)
      references PROVEEDORES (CODIGO_PROVEEDOR) on delete restrict on update restrict;

alter table VIDRIO add constraint FK_DETALLA foreign key (CODIGO_COLOR)
      references COLORES_VIDRIO (CODIGO_COLOR) on delete restrict on update restrict;

alter table VIDRIO add constraint FK_INCLUYE foreign key (CODIGO_TIPO)
      references TIPOS_VIDRIO (CODIGO_TIPO) on delete restrict on update restrict;

alter table VIDRIO add constraint FK_POSEE foreign key (CODIGO_FACTURA)
      references FACTURAS (CODIGO_FACTURA) on delete restrict on update restrict;
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*==============================================================*/
/* Table: RECOLECTORES                                          */
/*==============================================================*/
INSERT INTO `vical`.`recolectores` (`CODIGO_RECOLECTOR`,`NOMBRE_RECOLECTOR`,`TELEFONO_RECOLECTOR`,`DUI_RECOLECTOR`,`NIT_RECOLECTOR`, `DIRECCION_RECOLECTOR`)
VALUES
('R-001','William Sanchez','7301-9840','03694568-1','0613-030488-103-5','Col. Milagro final 1 c ote San Marcos casa #12'),
('R-002','Ricardo Ramos','7944-5603','02658745-4','0512-311278-103-7','Col. Tierra Virgen, pje 5#10.San Martin.S.S'),
('R-003','Jorgue Hernandez','7286-0741','04587965-8','0514-120488-103-4','2 av sur # 609 San salvador'),
('R-004','Ernesto Perez','7521-8498','04789632-9','0613-110573-103-7','Col. La Esperanza, pje-2,block C.San Marcos'),
('R-005','Walter Ponce','7326-7882','03647154-5','0245-100184-103-3','Col Santa Teresa, pje9-C#25.San Martín'),
('R-006','Guillermo Soto','7315-2474','04785469-4','0215-010472-103-2','10 C OTE # 306 pje 7-C.San Salvador '),
('R-007','Carlos Galdamez','7248-7988','01024754-3','0325-150477-103-4','Col. Jerusalen Av. Monseñor pje 2-"A" #14'),
('R-008','Alfredo Fernandez','7124-4712','07458798-4','0963-280280-103-5','Col. Santa fe calle #180 San Marcos'),
('R-009','Miguel Rosales','7410-2563','04789632-1','0147-210569-103-8','8 c ote #632 Barrio la vega'),
('R-010','Marvin Pacheco','7745-9687','04212142-7','0154-181071-103-2','28 c poniente 49 av sur # 2523 san salvador');
-- -------------------------------------------------------------------------------------
/*==============================================================*/
/* Table: TIPOS_EMPRESAS                                        */
/*==============================================================*/
INSERT INTO `vical`.`tipos_empresas` (`CODIGO_TIPO_EMPRESA`,`NOMBRE_TIPO_EMPRESA`)
VALUES
('TE-01','Alcaldia'),
('TE-02','Club Nocturno'),
('TE-03','Discoteca'),
('TE-04','Empresa Varia'),
('TE-05','Hotel'),
('TE-06','Laboratorio'),
('TE-07','Licoreria'),
('TE-08','Relleno Sanitario'),
('TE-09','Restaurante'),
('TE-10','Vidriera');
-- -------------------------------------------------------------------------------------
/*==============================================================*/
/* Table: PROVEEDORES                                           */
/*==============================================================*/

-- -------------------------------------------------------------------------------------1

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('1','TE-10','YOHANA','San Salvador','Av monsenor Romero 10 calle oriente por ex - cine Plaza San salvador','2271-5813','2502-9742','Luis Cardoza'),
('2','TE-10','ESTRELLA','San Salvador','Av monsenor romero # 525 frente a ex- cine plaza san salvador','2249-7048','2281-5764','Julio Ungo'),
('3','TE-10','FRANCIA','San Salvador','Av monsenor romero # 506 frente a ex- cine plaza san salvador','2271-8449',NULL,'Irma Chacon'),
('4','TE-10','VENECIA','San Salvador','2 av sur # 609 San salvador','2222-8019','2100-3036','Mario Venitez'),
('5','TE-10','HENRIQUEZ','San Salvador','10 C OTE # 306 Mercado Belloso ','2520-8836',NULL,'Enrique Rivera'),
('6','TE-10','ALUMICENTRO','San Salvador','25 av Nte S.S Frente a Hospital Bloom','2226-9800',NULL,'Jacob Cuellar'),
('7','TE-10','SOLAIRE ','San Salvador','21 av sur y 4 c pte S.S Atras de didea','2275-2100',NULL,'Elmer Cruz'),
('9','TE-10','ROSTRAN','San Salvador','Col. Milagro final 1 c ote San Marcos','2103-3605',NULL,'Celia Perez');

-- -------------------------------------------------------------------------------------2

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('10','TE-10','DISCOA ','San Salvador','Final 25 av Sur y pje 3 casa # 4 col santa Ursula San salvador','2242-3681','2242-0441','Jose Villegas'),
('11','TE-10','VIDRIO CENTROAMERICANO','San Salvador','Av cuzcatlan #614  frente a la roca','2222-3325',NULL,'Susana mejia'),
('12','TE-10','BONILLA','San Salvador','Col San antonio abad #721 col america','2208-0322',NULL,'Oscar Bonilla'),
('13','TE-10','INSTALUM','San Salvador','Final 1 c ote col milagro san Marcos','2556-8547','2220-1589','Mario rRivera'),
('14','TE-10','PROALVI','San Salvador','29 av nte frente a teatro de camaras','2234-7895','7980-8786','Empleados'),
('15','TE-10','LA ROCA','San Salvador','Av cuzcatlan #530  mercado belloso','2221-3891','2222-0840','Susana Barrientos'),
('16','TE-10','LUZ AIRE','San Salvador','C cuzcatlan esquina opuesta a banco Agricola','2249-7367',NULL,'Aleida nunez'),
('17','TE-10','INDUSTRIAL','San Salvador','2 av nte y 33 c ote local 1804 mejicanos','2226-7118',NULL,'Benjamin Orantes');

-- -------------------------------------------------------------------------------------3

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('18','TE-10','VIDRERIA PINEDA','San Salvador','Calle modelo #349 San Salvador','2270-1304',NULL,'Sr. Elmer'),
('19','TE-10','INDUSTRIAS PANOAMERICANAS','San Salvador','Final 27 Av sur y calle central #1426 Col. Cucumacayan san salvador','2221-8686',NULL,'trabajadores'),
('20','TE-10','PRISMA','San Salvador','C chiltiupan pol. E ciudad merliot','2221-1257','71182056','Roxana de Noyola'),
('21','TE-10','ALU ARQ','San Salvador','35 Av sur # 633 entre 6 y decima y 12 calle poniente Col. Flor Blanca','2298-8147','7851-8750','Jesus de guevara'),
('22','TE-10','INCO','San Salvador','Final 1 av norte 2 cuadras abajo de la alcaldia de Soyapango','2251-6000',NULL,'Jaime Eduardo Argueta'),
('23','TE-10','ALUMINARTE','San Salvador','Col. Santa fe calle #180 San Marcos','2213-0337',NULL,'leonardo Recinos'),
('24','TE-10','PENIEL','San Salvador','C chiltiupan frente a colegio espiritu santo','2269-4200',NULL,'Carlos Miranda'),
('25','TE-10','INCO UNIVERSITARIA','San Salvador','Bodega universitaria','2235-3905',NULL,'Sr Pineda'),
('26','TE-10','MARTINEZ','San Salvador','Av catro moran local 16 mejicanos','2317-3225',NULL,'Cesar Martinez');

-- -------------------------------------------------------------------------------------4

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('27','TE-10','VITRA','San Salvador','Atras de iglesia el rosario San salvador','2221-4542','7887-2723','Alicia Mendez'),
('28','TE-10','INSTACIELO','San Salvador','12 c oriente # 317 mercado Belloso','2249-7048','2221-1786','Ernesto Quintanilla'),
('29','TE-10','INCO BELLOSO','San Salvador','2 av sur # 520 mercado belloso','2221-0758',NULL,'Luisa Moreno'),
('30','TE-10','NATANAEL','San Salvador','mercado belloso   ','2532-5280',NULL,'Sr.Solorsano'),
('31','TE-10','LEMUS','San Salvador','10 c ote # 12 Mercado Belloso','2281-1000',NULL,'Saul lemus'),
('32','TE-10','UNIVERSALES','San Salvador','2 Av sur local 629 belloso','2222-3470',NULL,'Fredy figueroa'),
('33','TE-10','DIVENTANAS','San Salvador','4 c ote y 19 av sur local 304','2223-2688',NULL,'Carlos Molina'),
('34','TE-09','LA BOCANA','Libertad','Carretera litoral contiguo a Roca zunzal playa el tunco','7888-8067',NULL,'Luis Alonso delgado'),
('35','TE-09','EL PASIFICO','Libertad','Carretera litoral playa el majahualy frente a hotel santa fe','2310-6504',NULL,'Nelson figueroa');

-- -------------------------------------------------------------------------------------5

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('36','TE-09','ROCA ZUMZAL','Libertad','Carretera litoral playa el Zunzal','2389-6126',NULL,'Oscar miranda'),
('37','TE-09','SANTA FE','Libertad','Carretera litoral playa el majahualt','2389-5489',NULL,'Orlando Jimenes'),
('38','TE-09','DOLCE VITA','Libertad','Carretera litoral Siguiendo playa san diego ctgo a curva de don gere','2335-3592',NULL,'Maria rodriguez'),
('39','TE-09','CURVA DE DON GERE','Libertad','Carretera litoral siguiendo playa san diego ctgo a dolce vita','2335-3436','7927-2730','Miguel sibrian'),
('40','TE-09','LA OLA VETOS','San Salvador','Col. Miramonte atras de hotel intercontinental','7898-9751',NULL,'Sr. Carmen'),
('41','TE-09','DISCO SKEY','San Salvador','Prolongacion juan pablo 2 por colegio lavalle Lc 313a y 307a San salvador','2261-0724',NULL,'Pedro Antonio Arevalo'),
('42','TE-09','SOPON ZACAMIL','San Salvador','Col zacamil pje 3 #2 frente a pnc.','2272-5198',NULL,'Nelson Martinez'),
('43','TE-09','RANCHOS EL SALVADOR','San Salvador','Zona Rosa por Restauran Cancun.','2264-5858',NULL,'Sr. Carlos'),
('44','TE-10','INSTALACINES INTERIANO','Soyapango','Col los alpes pje 3 lote 69','2277-8238',NULL,'Elena Henriquez');

-- -------------------------------------------------------------------------------------6

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('45','TE-10','LUNA SOL','San Jacinto','Av los diplomaticos 1336 por ex casa Presidencial','2270-1639',NULL,'Dspachador'),
('46','TE-05','HILTON PRINSES','San Salvador','1c poniente Zona Rosa Esquina opuesta a Jala La Jarra','2268-4545','7325-8708','Alexander Arevalo'),
('47','TE-05','SHERATON P.','San Salvador','Final av revolucion san benito','2283-4078',NULL,'Silvia Madrid'),
('48','TE-04','MULTIPROYECTOS (TITAC)','San Salvador','8 c ote #632 Barrio la vega','2221-6201',NULL,'Mauricio Calderon'),
('49','TE-10','SAN GERARDO','San Salvador',' cl concepcion 513 por la tiendona','2222-5154',NULL,'Jaime Abarca'),
('50','TE-06','ANCALMO ','San Salvador','Antiguo Cuzcatlan','2243-0100',NULL,'Elga de olmedo'),
('51','TE-06','ARSAL ','San Salvador','Ca san jacinto frente al Zoologico Nacional','2231-1335',NULL,'Lic Paty'),
('52','TE-04','COMAGUI','San Salvador','28 c poniente 49 av sur # 2523 san salvador','2510-0518',NULL,'William vazques'),
('53','TE-04','RECIPLAS','San Salvador','Alameda roosevelt y 55 av norte edificio Ipsfa 4 planta San salvador','2290-6606','2260-6607','Mauricio Saravia');

-- -------------------------------------------------------------------------------------7

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('54','TE-04','ESC. AMERICANA','San Salvador','San Benito','2528-8275','7859-4322','Celina Aguirreurreta'),
('55','TE-04','DILICO','San Salvador','Carretera a sonsonate desvio del cria aves','2298-7845','7433-0495','Rafael'),
('56','TE-04','MC CORMIC','San Salvador','Antiguo Cuzcatlan','2212-8579',NULL,'Fatima de Chavez'),
('57','TE-04','ECOSEVICIOS','San Salvador','C antigua a tonacatepeque #125 Soyapango San salvador','2227-0029','7986-6870','Romel Castro'),
('58','TE-04','SHELTERS','San Salvador','Blvd los proceres centro de oficinas la sultana L110 Antiguo cuzcatlan','2434-6892','2439-7222','Ricardo Mejia'),
('59','TE-04','COCA COLA','San Salvador','Carretera Panoamericana Nejapa','2239-4527','7844-4229','Alejandro acevedo'),
('60','TE-04','CERVECERIA','San Salvador','Av independencia Frente a reloj de Flores','2231-5239','7745-7885','Edwin Lemus'),
('61','TE-04','INVERSIONES MONTECARLOS','San Salvador','Final av san martin # 4-7 santa tecla','2241-0470',NULL,'Rene villalobos'),
('62','TE-10','NASARETH','Santa Tecla','7 av sur 4-6','2531-1433',NULL,'Cristian Sanchez');

-- -------------------------------------------------------------------------------------8

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('63','TE-10','ADECORAVI','Soyapango','C roosvelt poniente  #27','7002-3675',NULL,'Elida de Monterrosa'),
('64','TE-10','V. 911','San Salvador','49 av sur contiguo a 911 de pnc.','2275-9631',NULL,'Sr. Luis'),
('65','TE-10','ELIM','San Salvador','Bulevard constitucion 504 ','2262-4865',NULL,'Sr. Elim Garcia'),
('66','TE-10','V: ROCA','San Salvador','79 av sur col escalon #6','2264-0238',NULL,'Empleados'),
('67','TE-10','TECNICIELO','Lourdes','Col las delicias #6','2318-0393',NULL,'Armando Arcia'),
('68','TE-10','JERUSALEN','San Salvador','Alameda juan Pablo 2 y 2 av nte 502','2222-6438',NULL,'Santos Portillo'),
('69','TE-10','LAS BRISAS','Lourdes','Km 24 y medio frente a castano','2318-6464',NULL,'Sr. Jorge'),
('70','TE-04','ECOSANTE','Santa Tecla','Col Quesaltepec final pje 1 contiguo a bomba de anda','7270-2618',NULL,'Carlos Rivara'),
('71','TE-10','TARCIS','Santa Tecla','7 av nte 11 c ote bis plg 33 #3','2288-2561',NULL,'Roxana Bonilla');

-- -------------------------------------------------------------------------------------9

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('72','TE-10','JOEL','Santa Tecla','4 cl pte #2-4 b','2100-2188',NULL,'Carlos Diaz'),
('73','TE-10','INCO','Santa Tecla','4 cl pte#3-5 b barrio candelaria','7850-9207',NULL,'Jose cruz'),
('74','TE-04','UNIVERSIDAD NACIONAL','San Salvador','Autopista nte Universidad Nacional','7160-5966',NULL,'LIC. De Soriano'),
('75','TE-04','AMAR','San Salvador','Constitucion pje francisco #540','2262-1152',NULL,'Francisco Rivas'),
('76','TE-03','CERO GRADOS','San Salvador','Paseo General Escalon ','7983-3344',NULL,'Chino'),
('77','TE-03','JUNGLE','San Salvador','Zona Rosa frente a mac donals','7701-7187',NULL,'Xiomara'),
('78','TE-10','LUZ AIRE','San Salvador','20 c pte 2501 col. Luz','2298-1860',NULL,'Juan Miranda'),
('79','TE-10','EUSAl','San Salvador','Av Olimpica Por estadio Flor Blanca','2276-4567',NULL,'Yovanny'),
('80','TE-07','CORDONCILLO','San Salvador','SECTOR SAN JUAN BOSCO 1 CANTON SAN ANDRES LIBERTAD','2455-5086',NULL,'Mauricio Saravia');

-- -------------------------------------------------------------------------------------10

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('81','TE-10','VEDECOR','San Jacinto','Col.santa carlota2 pje san francisco 14 Barrio san jacinto','2275-6340',NULL,'Carlos Regalado'),
('82','TE-07','SAN MARINO','San Jacinto','10 av sur 553 barrio la vega ex administracion de renta',NULL,NULL,'Marbelly Flores'),
('83','TE-08','SUCHITOTO','Cuzcatlan','Carretera a suchitoto relleno sanitario','7786-5882',NULL,'Nery Amaya'),
('84','TE-09','LOS RINCONCITOS','San Salvador','Zona Rosa frente a Banco City',NULL,NULL,'Vigilante'),
('85','TE-10','COMERCIAL GALDAMEZ','San Salvador','12 c ote 217 a el centro mercado Belloso.','2271-3760',NULL,'Alfonso Galdamez'),
('86','TE-10','VENTANAS SAN PEDRO','San Salvador','2 av sur monsenor arnulfo romero 617 mercado belloso','2222-3466',NULL,'Juan Mena'),
('87','TE-10','VENTANAS CASTILLO','San Salvador','4 av surblvd venezuela y 12 c ote frente a parqueo belloso','2249-7717','2222-8161','Leonardo Castillo'),
('88','TE-10','PENIEL SOYAPANGO','San Salvador','Col. Guadalupe c principal y c franklin roosevelt  2 soyapango','2277-5971',NULL,'Jonathan Miranda'),
('89','TE-10','VIDRIERIA SANCHEZ','San Salvador','Av cuzcatlan mercado belloso.','2222-6437',NULL,'Veronica Sanchez');

-- -------------------------------------------------------------------------------------11

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('90','TE-09','WILLYS','San Salvador','Final 5 Cl pte y 11 av nte frente a indes Alameda Juan pablo 2','2281-1519',NULL,'Beatriz Pleitez'),
('91','TE-02','QUESSON','San Salvador','C 5 de Noviembre 5 San Salvador','7789-4512',NULL,'Vigilante'),
('92','TE-10','INDUSTRIAS EL EXITO','San Salvador','C al volcan pje palacios col. Zacamil mejicanos 5.','2272-7522',NULL,'Nelson Montenegro'),
('93','TE-04','CORPORACION BONIMA','San Salvador','Blvad el ejercito frente a aeropuerto de ilopango.','2224-1022',NULL,'Oscar Mendoza'),
('94','TE-09','LA GUITARRA','Libertad','Km 42 Carretera el Litoral playa el tunco','2389-6398',NULL,'Vigilante'),
('95','TE-09','KAYU','Libertad','Km 44 playa el tunco','2389-6135',NULL,'Vigilante'),
('96','TE-05','HOTEL MOPELIA','Libertad','Km 42 carretera litoral tamanique','2389-6265',NULL,'Patricia guerra'),
('97','TE-10','TORNOLARA','San Salvador','27 c pte # 106 san Miguelito','2235-3755',NULL,'Jose luis Lara'),
('98','TE-04','NONI TAHITI','San Salvador','Final 83 av sur cerca del centro espanol.','7894-0539',NULL,'Ana gloria palomo');

-- -------------------------------------------------------------------------------------12

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('99','TE-09','CEFE DON PEDRO merliot','Merliot','17 av nte c chiultiupan esquina opuesta a plaza merliot','2288-4334',NULL,'Maria de los angeles'),
('100','TE-09','CAFE DON PEDRO autopista nte',NULL,NULL,NULL,NULL,NULL),
('101','TE-10','LEO','San Salvador','10 c  120 Mercado Belloso.','2271-4071','7597-7343','Israel Lemus'),
('102','TE-04','COPERATIVA AVACHAZ','San Salvador','Col. Zacamil ( punto de buses de la 44)',NULL,NULL,'Carmen v. de Aguirre'),
('103','TE-10','VID. MOLDURAS MELENDEZ','San Salvador','8 Av sur y 4c ote atras de iglesia rosario','2222-0454','7730-9552','Jose leonardo perla'),
('104','TE-10','ALUMANT','San Salvador','c modelo frente a comercial chacon.','71241309',NULL,'Rigoberto Lopez'),
('105','TE-10','CUZCATLAN','San Salvador',NULL,NULL,NULL,NULL),
('106','TE-10','DELUXE','San Salvador','Av. Cuzcatlan mercado belloso',NULL,NULL,NULL),
('107','TE-06','TE-06 FARDEL','San Jacinto','1 av nte # 412 pje gloria col. San jacinto',NULL,NULL,'Lic. Guardado');

-- -------------------------------------------------------------------------------------13

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('108','TE-04','ERMINDA DE RAMIREZ','San Salvador','11 av sur n 309 sobre 4 c pte detras del parque bolivar frente comercial isnan.',NULL,NULL,'(MONSIRAMI)'),
('109','TE-07','ILOPANIA','San Salvador','10 av sur 553 barrio la vega ex administracion de renta','2271-5957',NULL,'Jorge manzzini'),
('110','TE-10','MOLDURAS PICASO','San Salvador','59 av nte 334 San Salvador prolongacion juan pablo 2','2261-0768',NULL,NULL),
('111','TE-04','YORECICLO','San Salvador','a la par de los juzgados de santa tecla y cementerio del lugar','7321-4521',NULL,'FRANCISCO GARCIA'),
('112','TE-10','RAPI VIDRIO','San Salvador','C antigua a huizucar pje san rafael local 3 la cima san salvador.','2273-2488',NULL,'JORGE CASTRO'),
('113','TE-05','INTERCONTINENTAL','San Salvador','BLVD LOS HEROES FRENTE A METROCENTRO.','7895-1605',NULL,'RENE PEREZ'),
('114','TE-08','ALC. SAN ANTONIO PAJONAL','SANTA ANA','SANTA ANA SAN ANTONIO PAJONAL.',NULL,NULL,'CARLOS HENRIQUES'),
('115','TE-08','ALC. DE TALNIQUE','Sonsonate','CARRETERA A SONSONATE  ',NULL,NULL,'MOISES'),
('116','TE-10','FERRETERIA AZ','San Salvador','CONTIGUO AL MAYESTIC',NULL,NULL,'ENCARGADO DE BODEGA');

-- -------------------------------------------------------------------------------------14

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`)
VALUES
('117','TE-10','CIELOS Y VENTANAS HERNANDEZ','San Salvador','REPARTO XOCHILIT 12 CALLE MONSERRAT FRENTE A TAMINSAL','2131-6955','7890-0523','JOSE MARIO HERNANDEZ'),
('118','TE-08','MEANGUERA','Morazan','carretera a perquin','2680/6430','7904/5593','NOE PEREIRA');
-- -------------------------------------------------------------------------------------
/*==============================================================*/
/* Table: TIPOS_VIDRIO                                          */
/*==============================================================*/
INSERT INTO `vical`.`tipos_vidrio` (`CODIGO_TIPO`,`NOMBRE_TIPO`)
VALUES
('TV-01','BOTELLA'),
('TV-02','PLANO');
-- -------------------------------------------------------------------------------------
/*==============================================================*/
/* Table: COLORES_VIDRIO                                        */
/*==============================================================*/
INSERT INTO `vical`.`colores_vidrio` (`CODIGO_COLOR`,`NOMBRE_COLOR`)
VALUES
('CV-01','VERDE'),
('CV-02','CRISTALINO'),
('CV-03','CAFE'),
('CV-04','BRONCE'),
('CV-05','REFLECTIVO');
-- -------------------------------------------------------------------------------------
/*==============================================================*/
/* Table: CENTROS_DE_ACOPIO                                     */
/*==============================================================*/
INSERT INTO `vical`.`centros_de_acopio` (`CODIGO_CENTRO_ACOPIO`,`CODIGO_RECOLECTOR`,`DEPARTAMENTO`,`TELEFONO`)
VALUES
('CA-001','R-001','Ahuchapan','2560-5731'),
('CA-002','R-001','Sonsonate','2200-5700'),
('CA-003','R-001','Santa Ana','2304-8938'),
('CA-004','R-002','San Salvador','2697-0364'),
('CA-005','R-002','La Libertad','2591-0976'),
('CA-006','R-002','Chalatenango','2200-3698'),
('CA-007','R-003','Morazan','2397-8889'),
('CA-008','R-003','La Union','2368-7100'),
('CA-009','R-003','San Miguel','2306-4749'),
('CA-010','R-002','Usulutan','2345-4749');
-- -------------------------------------------------------------------------------------
/*==============================================================*/
/* Table: FACTURAS                                             */
/*==============================================================*/
INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1529','57','R-002','2010-06-14'),
('1530','56','R-002','2010-06-14'),
('1531','72','R-002','2010-06-14'),
('1532','1','R-002','2010-06-15'),
('1533','44','R-002','2010-06-15'),
('1534','6','R-002','2010-06-16'),
('1394','41','R-002','2010-07-02'),
('1388','26','R-002','2010-07-02'),
('1387','54','R-002','2010-07-02'),
('1386','18','R-002','2010-07-03'),
('1389','99','R-002','2010-07-03'),
('1390','84','R-002','2010-07-08'),
('1392','46','R-002','2010-07-09'),
('1393','47','R-002','2010-07-09'),
('1525','23','R-002','2010-07-10'),
('1526','78','R-002','2010-07-11'),
('1527','2','R-002','2010-07-13'),
('1528','115','R-002','2010-07-12'),
('1558','105','R-001','2010-07-04'),
('1559','65','R-001','2010-07-04'),
('1560','14','R-001','2010-07-04'),
('1565','93','R-003','2010-06-04'),
('1566','107','R-003','2010-06-05'),
('1567','3','R-003','2010-06-06'),
('1568','70','R-003','2010-06-07'),
('1569','117','R-003','2010-06-08'),
('1570','80','R-003','2010-06-09'),
('1571','78','R-003','2010-06-09'),
('1572','79','R-003','2010-06-09'),
('1573','84','R-003','2010-06-12'),
('1574','85','R-003','2010-06-12'),
('1575','83','R-003','2010-06-12'),
('1576','102','R-003','2010-06-13'),
('1577','101','R-003','2010-06-13'),
('1578','106','R-003','2010-06-13'),
('1579','13','R-003','2010-06-13'),
('1514','15','R-001','2010-05-07'),
('1515','80','R-001','2010-05-07'),
('1516','73','R-002','2010-05-15'),
('1517','28','R-002','2010-05-15'),
('1518','12','R-002','2010-05-15'),
('1519','2','R-002','2010-05-20'),
('1523','7','R-001','2010-05-24'),
('1524','69','R-003','2010-05-30'),
('1535','96','R-002','2010-07-01'),
('1536','38','R-002','2010-07-01'),
('1537','19','R-001','2010-07-01'),
('1538','60','R-002','2010-07-05'),
('1539','44','R-003','2010-07-12'),
('1540','75','R-002','2010-08-07'),
('1541','23','R-001','2010-08-08'),
('1542','88','R-003','2010-09-20'),
('1543','12','R-002','2010-09-25'),
('1544','90','R-002','2010-09-30');
-- -------------------------------------------------------------------------------------

/*==============================================================*/
/* Table: VIDRIO                                                */
/*==============================================================*/
INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('01','TV-01','CV-02','1529','6.66','7.99'),
('02','TV-01','CV-02','1530','2.21','2.52'),
('03','TV-01','CV-02','1531','4.03','4.83'),
('04','TV-01','CV-02','1532','4.14','4.96'),
('05','TV-01','CV-02','1533','5.97','7.16'),
('06','TV-01','CV-02','1534','1.90','2.28'),
('07','TV-01','CV-02','1394','6.35','7.62'),
('08','TV-02','CV-02','1388','8.75','10.5'),
('09','TV-02','CV-02','1387','13.68','16.41'),
('10','TV-02','CV-02','1386','5.13','6.15'),
('11','TV-02','CV-02','1389','21.63','25.95'),
('12','TV-01','CV-02','1390','7.12','8.54'),
('13','TV-01','CV-02','1392','5.12','6.14'),
('14','TV-01','CV-02','1393','3.97','4.76'),
('15','TV-01','CV-01','1525','15.80','18.96'),
('16','TV-01','CV-03','1526','43.20','51.84'),
('17','TV-02','CV-02','1527','13.47','16.16'),
('18','TV-01','CV-02','1528','7.14','8.56'),
('19','TV-02','CV-02','1558','5.78','6.93'),
('20','TV-01','CV-03','1559','2.94','3.52'),
('21','TV-01','CV-01','1560','53.02','63.62'),
('22','TV-01','CV-02','1565','46.54','55.84'),
('23','TV-02','CV-02','1566','80.60','96.72'),
('24','TV-01','CV-02','1567','1.71','2.05'),
('25','TV-01','CV-02','1568','3.32','3.98'),
('26','TV-01','CV-03','1569','13.67','16.40'),
('27','TV-01','CV-02','1570','6.23','7.47'),
('28','TV-01','CV-02','1571','3.50','4.20'),
('29','TV-01','CV-02','1572','3.01','3.61'),
('30','TV-01','CV-02','1573','24.89','29.86'),
('31','TV-01','CV-02','1574','16.25','19.50'),
('32','TV-01','CV-03','1575','5.03','6.0'),
('33','TV-02','CV-02','1576','8.65','10.38'),
('34','TV-01','CV-03','1577','3.07','3.68'),
('35','TV-01','CV-01','1578','1.03','1.23'),
('36','TV-01','CV-01','1579','12.10','14.52'),
('37','TV-01','CV-01','1514','9.24','11.08'),
('38','TV-01','CV-01','1515','1.15','1.38'),
('39','TV-01','CV-01','1516','3.57','4.28'),
('40','TV-01','CV-01','1517','6.35','7.62'),
('41','TV-02','CV-02','1518','2.10','2.52'),
('42','TV-02','CV-02','1519','1.44','1.72'),
('43','TV-01','CV-03','1523','3.29','3.94'),
('44','TV-02','CV-02','1524','9.31','11.17'),
('45','TV-01','CV-02','1535','7.23','8.67'),
('46','TV-01','CV-02','1536','4.30','5.16'),
('47','TV-01','CV-02','1537','7.14','8.56'),
('48','TV-02','CV-02','1538','2.02','2.42'),
('49','TV-01','CV-02','1539','14.57','17.48'),
('50','TV-01','CV-02','1540','3.15','3.78'),
('51','TV-01','CV-02','1541','4.28','5.13'),
('52','TV-01','CV-02','1542','1.63','1.95'),
('53','TV-02','CV-02','1543','6.97','8.36'),
('54','TV-02','CV-02','1544','4.80','5.76');
-- -------------------------------------------------------------------------------------

/*==============================================================*/
/* Table: USUARIOS                                               */
/*==============================================================*/
INSERT INTO `vical`.`usuarios` (`USUARIO`,`PASSWORD`,`TIPO_USUARIO`)
VALUES
('Erick','erick','admin');
-- -------------------------------------------------------------------------------------