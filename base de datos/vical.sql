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
   ESTANON                  varchar(5),
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

alter table VIDRIO add constraint FK_DETALLA foreign key (CODIGO_COLOR)
      references COLORES_VIDRIO (CODIGO_COLOR) on delete restrict on update restrict;

alter table VIDRIO add constraint FK_INCLUYE foreign key (CODIGO_TIPO)
      references TIPOS_VIDRIO (CODIGO_TIPO) on delete restrict on update restrict;

alter table FACTURAS add constraint FK_GUARDA foreign key (CODIGO_PROVEEDOR)
      references PROVEEDORES (CODIGO_PROVEEDOR) on delete restrict on update restrict;

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

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('1','TE-10','YOHANA','San Salvador','Av monsenor Romero 10 calle oriente por ex - cine Plaza San salvador','2271-5813','2502-9742','Luis Cardoza','3'),
('2','TE-10','ESTRELLA','San Salvador','Av monsenor romero # 525 frente a ex- cine plaza san salvador','2249-7048','2281-5764','Julio Ungo','4'),
('3','TE-10','FRANCIA','San Salvador','Av monsenor romero # 506 frente a ex- cine plaza san salvador','2271-8449',NULL,'Irma Chacon','2'),
('4','TE-10','VENECIA','San Salvador','2 av sur # 609 San salvador','2222-8019','2100-3036','Mario Venitez','4'),
('5','TE-10','HENRIQUEZ','San Salvador','10 C OTE # 306 Mercado Belloso ','2520-8836',NULL,'Enrique Rivera',NULL),
('6','TE-10','ALUMICENTRO','San Salvador','25 av Nte S.S Frente a Hospital Bloom','2226-9800',NULL,'Jacob Cuellar','6'),
('7','TE-10','SOLAIRE ','San Salvador','21 av sur y 4 c pte S.S Atras de didea','2275-2100',NULL,'Elmer Cruz','10'),
('9','TE-10','ROSTRAN','San Salvador','Col. Milagro final 1 c ote San Marcos','2103-3605',NULL,'Celia Perez','4');

-- -------------------------------------------------------------------------------------2

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('10','TE-10','DISCOA ','San Salvador','Final 25 av Sur y pje 3 casa # 4 col santa Ursula San salvador','2242-3681','2242-0441','Jose Villegas','2'),
('11','TE-10','VIDRIO CENTROAMERICANO','San Salvador','Av cuzcatlan #614  frente a la roca','2222-3325',NULL,'Susana mejia',NULL),
('12','TE-10','BONILLA','San Salvador','Col San antonio abad #721 col america','2208-0322',NULL,'Oscar Bonilla','4'),
('13','TE-10','INSTALUM','San Salvador','Final 1 c ote col milagro san Marcos','2556-8547','2220-1589','Mario Rivera',NULL),
('14','TE-10','PROALVI','San Salvador','29 av nte frente a teatro de camaras','2234-7895','7980-8786','Empleados','3'),
('15','TE-10','LA ROCA','San Salvador','Av cuzcatlan #530  mercado belloso','2221-3891','2222-0840','Susana Barrientos','4'),
('16','TE-10','LUZ AIRE','San Salvador','C cuzcatlan esquina opuesta a banco Agricola','2249-7367',NULL,'Aleida nunez','2'),
('17','TE-10','INDUSTRIAL','San Salvador','2 av nte y 33 c ote local 1804 mejicanos','2226-7118',NULL,'Benjamin Orantes','4');

-- -------------------------------------------------------------------------------------3

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('18','TE-10','VIDRERIA PINEDA','San Salvador','Calle modelo #349 San Salvador','2270-1304',NULL,'Sr. Elmer','5'),
('19','TE-10','INDUSTRIAS PANOAMERICANAS','San Salvador','Final 27 Av sur y calle central #1426 Col. Cucumacayan san salvador','2221-8686',NULL,'trabajadores','4'),
('20','TE-10','PRISMA','San Salvador','C chiltiupan pol. E ciudad merliot','2221-1257','71182056','Roxana de Noyola','4'),
('21','TE-10','ALU ARQ','San Salvador','35 Av sur # 633 entre 6 y decima y 12 calle poniente Col. Flor Blanca','2298-8147','7851-8750','Jesus de guevara','3'),
('22','TE-10','INCO','San Salvador','Final 1 av norte 2 cuadras abajo de la alcaldia de Soyapango','2251-6000',NULL,'Jaime Eduardo Argueta',NULL),
('23','TE-10','ALUMINARTE','San Salvador','Col. Santa fe calle #180 San Marcos','2213-0337',NULL,'leonardo Recinos','2'),
('24','TE-10','PENIEL','San Salvador','C chiltiupan frente a colegio espiritu santo','2269-4200',NULL,'Carlos Miranda',NULL),
('25','TE-10','INCO UNIVERSITARIA','San Salvador','Bodega universitaria','2235-3905',NULL,'Sr Pineda','1R'),
('26','TE-10','MARTINEZ','San Salvador','Av catro moran local 16 mejicanos','2317-3225',NULL,'Cesar Martinez','1');

-- -------------------------------------------------------------------------------------4

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('27','TE-10','VITRA','San Salvador','Atras de iglesia el rosario San salvador','2221-4542','7887-2723','Alicia Mendez','1R'),
('28','TE-10','INSTACIELO','San Salvador','12 c oriente # 317 mercado Belloso','2249-7048','2221-1786','Ernesto Quintanilla','3'),
('29','TE-10','INCO BELLOSO','San Salvador','2 av sur # 520 mercado belloso','2221-0758',NULL,'Luisa Moreno','2'),
('30','TE-10','NATANAEL','San Salvador','mercado belloso   ','2532-5280',NULL,'Sr.Solorsano',NULL),
('31','TE-10','LEMUS','San Salvador','10 c ote # 12 Mercado Belloso','2281-1000',NULL,'Saul lemus','2'),
('32','TE-10','UNIVERSALES','San Salvador','2 Av sur local 629 belloso','2222-3470',NULL,'Fredy figueroa',NULL),
('33','TE-10','DIVENTANAS','San Salvador','4 c ote y 19 av sur local 304','2223-2688',NULL,'Carlos Molina',NULL),
('34','TE-09','LA BOCANA','Libertad','Carretera litoral contiguo a Roca zunzal playa el tunco','7888-8067',NULL,'Luis Alonso delgado','3'),
('35','TE-09','EL PASIFICO','Libertad','Carretera litoral playa el majahualy frente a hotel santa fe','2310-6504',NULL,'Nelson figueroa','3');

-- -------------------------------------------------------------------------------------5

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('36','TE-09','ROCA ZUMZAL','Libertad','Carretera litoral playa el Zunzal','2389-6126',NULL,'Oscar miranda','3'),
('37','TE-09','SANTA FE','Libertad','Carretera litoral playa el majahualt','2389-5489',NULL,'Orlando Jimenes','3'),
('38','TE-09','DOLCE VITA','Libertad','Carretera litoral Siguiendo playa san diego ctgo a curva de don gere','2335-3592',NULL,'Maria rodriguez','3'),
('39','TE-09','CURVA DE DON GERE','Libertad','Carretera litoral siguiendo playa san diego ctgo a dolce vita','2335-3436','7927-2730','Miguel sibrian','3'),
('40','TE-09','LA OLA VETOS','San Salvador','Col. Miramonte atras de hotel intercontinental','7898-9751',NULL,'Sr. Carmen','3'),
('41','TE-09','DISCO SKEY','San Salvador','Prolongacion juan pablo 2 por colegio lavalle Lc 313a y 307a San salvador','2261-0724',NULL,'Pedro Antonio Arevalo','3'),
('42','TE-09','SOPON ZACAMIL','San Salvador','Col zacamil pje 3 #2 frente a pnc.','2272-5198',NULL,'Nelson Martinez','2'),
('43','TE-09','RANCHOS EL SALVADOR','San Salvador','Zona Rosa por Restauran Cancun.','2264-5858',NULL,'Sr. Carlos',NULL),
('44','TE-10','INSTALACINES INTERIANO','Soyapango','Col los alpes pje 3 lote 69','2277-8238',NULL,'Elena Henriquez',NULL);

-- -------------------------------------------------------------------------------------6

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('45','TE-10','LUNA SOL','San Jacinto','Av los diplomaticos 1336 por ex casa Presidencial','2270-1639',NULL,'Despachador',NULL),
('46','TE-05','HILTON PRINSES','San Salvador','1c poniente Zona Rosa Esquina opuesta a Jala La Jarra','2268-4545','7325-8708','Alexander Arevalo','3'),
('47','TE-05','SHERATON P.','San Salvador','Final av revolucion san benito','2283-4078',NULL,'Silvia Madrid','6'),
('48','TE-04','MULTIPROYECTOS (TITAC)','San Salvador','8 c ote #632 Barrio la vega','2221-6201',NULL,'Mauricio Calderon',NULL),
('49','TE-10','SAN GERARDO','San Salvador',' cl concepcion 513 por la tiendona','2222-5154',NULL,'Jaime Abarca',NULL),
('50','TE-06','ANCALMO ','San Salvador','Antiguo Cuzcatlan','2243-0100',NULL,'Elga de olmedo',NULL),
('51','TE-06','ARSAL ','San Salvador','Ca san jacinto frente al Zoologico Nacional','2231-1335',NULL,'Lic Paty','3'),
('52','TE-04','COMAGUI','San Salvador','28 c poniente 49 av sur # 2523 san salvador','2510-0518',NULL,'William vazques','3'),
('53','TE-04','RECIPLAS','San Salvador','Alameda roosevelt y 55 av norte edificio Ipsfa 4 planta San salvador','2290-6606','2260-6607','Mauricio Saravia','12');

-- -------------------------------------------------------------------------------------7

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('54','TE-04','ESC. AMERICANA','San Salvador','San Benito','2528-8275','7859-4322','Celina Aguirreurreta','3'),
('55','TE-04','DILICO','San Salvador','Carretera a sonsonate desvio del cria aves','2298-7845','7433-0495','Rafael',NULL),
('56','TE-04','MC CORMIC','San Salvador','Antiguo Cuzcatlan','2212-8579',NULL,'Fatima de Chavez','2'),
('57','TE-04','ECOSEVICIOS','San Salvador','C antigua a tonacatepeque #125 Soyapango San salvador','2227-0029','7986-6870','Romel Castro',NULL),
('58','TE-04','SHELTERS','San Salvador','Blvd los proceres centro de oficinas la sultana L110 Antiguo cuzcatlan','2434-6892','2439-7222','Ricardo Mejia',NULL),
('59','TE-04','COCA COLA','San Salvador','Carretera Panoamericana Nejapa','2239-4527','7844-4229','Alejandro acevedo',NULL),
('60','TE-04','CERVECERIA','San Salvador','Av independencia Frente a reloj de Flores','2231-5239','7745-7885','Edwin Lemus',NULL),
('61','TE-04','INVERSIONES MONTECARLOS','San Salvador','Final av san martin # 4-7 santa tecla','2241-0470',NULL,'Rene villalobos','10'),
('62','TE-10','NASARETH','Santa Tecla','7 av sur 4-6','2531-1433',NULL,'Cristian Sanchez',NULL);

-- -------------------------------------------------------------------------------------8

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('63','TE-10','ADECORAVI','Soyapango','C roosvelt poniente  #27','7002-3675',NULL,'Elida de Monterrosa',NULL),
('64','TE-10','V. 911','San Salvador','49 av sur contiguo a 911 de pnc.','2275-9631',NULL,'Sr. Luis',NULL),
('65','TE-10','ELIM','San Salvador','Bulevard constitucion 504 ','2262-4865',NULL,'Sr. Elim Garcia',NULL),
('66','TE-10','V: ROCA','San Salvador','79 av sur col escalon #6','2264-0238',NULL,'Empleados',NULL),
('67','TE-10','TECNICIELO','Lourdes','Col las delicias #6','2318-0393',NULL,'Armando Arcia',NULL),
('68','TE-10','JERUSALEN','San Salvador','Alameda juan Pablo 2 y 2 av nte 502','2222-6438',NULL,'Santos Portillo',NULL),
('69','TE-10','LAS BRISAS','Lourdes','Km 24 y medio frente a castano','2318-6464',NULL,'Sr. Jorge',NULL),
('70','TE-04','ECOSANTE','Santa Tecla','Col Quesaltepec final pje 1 contiguo a bomba de anda','7270-2618',NULL,'Carlos Rivara','5'),
('71','TE-10','TARCIS','Santa Tecla','7 av nte 11 c ote bis plg 33 #3','2288-2561',NULL,'Roxana Bonilla',NULL);

-- -------------------------------------------------------------------------------------9

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('72','TE-10','JOEL','Santa Tecla','4 cl pte #2-4 b','2100-2188',NULL,'Carlos Diaz',NULL),
('73','TE-10','INCO','Santa Tecla','4 cl pte#3-5 b barrio candelaria','7850-9207',NULL,'Jose cruz',NULL),
('74','TE-04','UNIVERSIDAD NACIONAL','San Salvador','Autopista nte Universidad Nacional','7160-5966',NULL,'LIC. De Soriano',NULL),
('75','TE-04','AMAR','San Salvador','Constitucion pje francisco #540','2262-1152',NULL,'Francisco Rivas','3'),
('76','TE-03','CERO GRADOS','San Salvador','Paseo General Escalon ','7983-3344',NULL,'Chino','3'),
('77','TE-03','JUNGLE','San Salvador','Zona Rosa frente a mac donals','7701-7187',NULL,'Xiomara','3'),
('78','TE-10','LUZ AIRE','San Salvador','20 c pte 2501 col. Luz','2298-1860',NULL,'Juan Miranda',NULL),
('79','TE-10','EUSAl','San Salvador','Av Olimpica Por estadio Flor Blanca','2276-4567',NULL,'Yovanny',NULL),
('80','TE-07','CORDONCILLO','San Salvador','SECTOR SAN JUAN BOSCO 1 CANTON SAN ANDRES LIBERTAD','2455-5086',NULL,'Mauricio Saravia','3');

-- -------------------------------------------------------------------------------------10

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('81','TE-10','VEDECOR','San Jacinto','Col.santa carlota2 pje san francisco 14 Barrio san jacinto','2275-6340',NULL,'Carlos Regalado','2'),
('82','TE-07','SAN MARINO','San Jacinto','10 av sur 553 barrio la vega ex administracion de renta',NULL,NULL,'Marbelly Flores','3'),
('83','TE-08','SUCHITOTO','Cuzcatlan','Carretera a suchitoto relleno sanitario','7786-5882',NULL,'Nery Amaya','3'),
('84','TE-09','LOS RINCONCITOS','San Salvador','Zona Rosa frente a Banco City',NULL,NULL,'Vigilante',NULL),
('85','TE-10','COMERCIAL GALDAMEZ','San Salvador','12 c ote 217 a el centro mercado Belloso.','2271-3760',NULL,'Alfonso Galdamez',NULL),
('86','TE-10','VENTANAS SAN PEDRO','San Salvador','2 av sur monsenor arnulfo romero 617 mercado belloso','2222-3466',NULL,'Juan Mena',NULL),
('87','TE-10','VENTANAS CASTILLO','San Salvador','4 av surblvd venezuela y 12 c ote frente a parqueo belloso','2249-7717','2222-8161','Leonardo Castillo',NULL),
('88','TE-10','PENIEL SOYAPANGO','San Salvador','Col. Guadalupe c principal y c franklin roosevelt  2 soyapango','2277-5971',NULL,'Jonathan Miranda','2J'),
('89','TE-10','VIDRIERIA SANCHEZ','San Salvador','Av cuzcatlan mercado belloso.','2222-6437',NULL,'Veronica Sanchez','1');

-- -------------------------------------------------------------------------------------11

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('90','TE-09','WILLYS','San Salvador','Final 5 Cl pte y 11 av nte frente a indes Alameda Juan pablo 2','2281-1519',NULL,'Beatriz Pleitez','3'),
('91','TE-02','QUESSON','San Salvador','C 5 de Noviembre 5 San Salvador','7789-4512',NULL,'Vigilante','2'),
('92','TE-10','INDUSTRIAS EL EXITO','San Salvador','C al volcan pje palacios col. Zacamil mejicanos 5.','2272-7522',NULL,'Nelson Montenegro','6'),
('93','TE-04','CORPORACION BONIMA','San Salvador','Blvad el ejercito frente a aeropuerto de ilopango.','2224-1022',NULL,'Oscar Mendoza',NULL),
('94','TE-09','LA GUITARRA','Libertad','Km 42 Carretera el Litoral playa el tunco','2389-6398',NULL,'Vigilante','2'),
('95','TE-09','KAYU','Libertad','Km 44 playa el tunco','2389-6135',NULL,'Vigilante','1B'),
('96','TE-05','HOTEL MOPELIA','Libertad','Km 42 carretera litoral tamanique','2389-6265',NULL,'Patricia guerra','2'),
('97','TE-10','TORNOLARA','San Salvador','27 c pte # 106 san Miguelito','2235-3755',NULL,'Jose luis Lara','1'),
('98','TE-04','NONI TAHITI','San Salvador','Final 83 av sur cerca del centro espanol.','7894-0539',NULL,'Ana gloria palomo',NULL);

-- -------------------------------------------------------------------------------------12

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('99','TE-09','CEFE DON PEDRO merliot','Merliot','17 av nte c chiultiupan esquina opuesta a plaza merliot','2288-4334',NULL,'Maria de los angeles','3'),
('100','TE-09','CAFE DON PEDRO autopista nte',NULL,NULL,NULL,NULL,NULL,NULL),
('101','TE-10','LEO','San Salvador','10 c  120 Mercado Belloso.','2271-4071','7597-7343','Israel Lemus',NULL),
('102','TE-04','COPERATIVA AVACHAZ','San Salvador','Col. Zacamil ( punto de buses de la 44)',NULL,NULL,'Carmen v. de Aguirre',NULL),
('103','TE-10','VID. MOLDURAS MELENDEZ','San Salvador','8 Av sur y 4c ote atras de iglesia rosario','2222-0454','7730-9552','Jose Leonardo Perla',NULL),
('104','TE-10','ALUMANT','San Salvador','c modelo frente a comercial chacon.','71241309',NULL,'Rigoberto Lopez',NULL),
('105','TE-10','CUZCATLAN','San Salvador',NULL,NULL,NULL,NULL,'1'),
('106','TE-10','DELUXE','San Salvador','Av. Cuzcatlan mercado belloso',NULL,NULL,NULL,'1'),
('107','TE-06','TE-06 FARDEL','San Jacinto','1 av nte # 412 pje gloria col. San jacinto',NULL,NULL,'Lic. Guardado',NULL);

-- -------------------------------------------------------------------------------------13

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('108','TE-04','ERMINDA DE RAMIREZ','San Salvador','11 av sur n 309 sobre 4 c pte detras del parque bolivar frente comercial isnan.',NULL,NULL,'(MONSIRAMI)',NULL),
('109','TE-07','ILOPANIA','San Salvador','10 av sur 553 barrio la vega ex administracion de renta','2271-5957',NULL,'Jorge manzzini',NULL),
('110','TE-10','MOLDURAS PICASO','San Salvador','59 av nte 334 San Salvador prolongacion juan pablo 2','2261-0768',NULL,NULL,NULL),
('111','TE-04','YORECICLO','San Salvador','a la par de los juzgados de santa tecla y cementerio del lugar','7321-4521',NULL,'FRANCISCO GARCIA',NULL),
('112','TE-10','RAPI VIDRIO','San Salvador','C antigua a huizucar pje san rafael local 3 la cima san salvador.','2273-2488',NULL,'JORGE CASTRO',NULL),
('113','TE-05','INTERCONTINENTAL','San Salvador','BLVD LOS HEROES FRENTE A METROCENTRO.','7895-1605',NULL,'RENE PEREZ',NULL),
('114','TE-08','ALC. SAN ANTONIO PAJONAL','SANTA ANA','SANTA ANA SAN ANTONIO PAJONAL.',NULL,NULL,'CARLOS HENRIQUES',NULL),
('115','TE-08','ALC. DE TALNIQUE','Sonsonate','CARRETERA A SONSONATE  ',NULL,NULL,'MOISES',NULL),
('116','TE-10','FERRETERIA AZ','San Salvador','CONTIGUO AL MAYESTIC',NULL,NULL,'ENCARGADO DE BODEGA',NULL);

-- -------------------------------------------------------------------------------------14

INSERT INTO `vical`.`proveedores` (`CODIGO_PROVEEDOR`,`CODIGO_TIPO_EMPRESA`,`NOMBRE_PROVEEDOR`,`DEPARTAMENTO`,`DIRECCION_PROVEEDOR`,`TELEFONO_PROVEEDOR1`,`TELEFONO_PROVEEDOR2`,`CONTACTO`,`ESTANON`)
VALUES
('117','TE-10','CIELOS Y VENTANAS HERNANDEZ','San Salvador','REPARTO XOCHILIT 12 CALLE MONSERRAT FRENTE A TAMINSAL','2131-6955','7890-0523','JOSE MARIO HERNANDEZ',NULL),
('118','TE-08','MEANGUERA','Morazan','carretera a perquin','2680/6430','7904/5593','NOE PEREIRA',NULL);
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
/* Table: FACTURAS                                              */
/*==============================================================*/
INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1000','63','R-001','2008-09-01'),
('1001','44','R-001','2008-09-01'),
('1002','115','R-001','2008-09-01'),
('1003','73','R-001','2008-09-01'),
('1004','72','R-001','2008-09-01'),
('1005','71','R-001','2008-09-02'),
('1006','70','R-001','2008-09-02'),
('1007','62','R-001','2008-09-02'),
('1008','114','R-001','2008-09-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1009','117','R-001','2008-09-02'),
('1010','116','R-001','2008-09-03'),
('1011','113','R-002','2008-09-03'),
('1012','112','R-002','2008-09-03'),
('1013','111','R-002','2008-09-03'),
('1014','110','R-002','2008-09-03'),
('1015','109','R-002','2008-09-04'),
('1016','108','R-002','2008-09-04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1017','106','R-002','2008-09-04'),
('1018','105','R-002','2008-09-04'),
('1019','104','R-002','2008-09-04'),
('1020','103','R-002','2008-09-05'),
('1021','102','R-003','2008-09-05'),
('1022','101','R-003','2008-09-05'),
('1023','98','R-003','2008-09-05'),
('1024','97','R-003','2008-09-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1025','93','R-003','2008-09-06'),
('1026','92','R-003','2008-09-06'),
('1027','91','R-003','2008-09-06'),
('1028','90','R-003','2008-09-06'),
('1029','89','R-003','2008-09-06'),
('1030','88','R-003','2008-09-07'),
('1031','87','R-004','2008-09-07'),
('1032','86','R-004','2008-09-07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1033','85','R-004','2008-09-07'),
('1034','84','R-004','2008-09-07'),
('1035','80','R-004','2008-09-15'),
('1036','79','R-004','2008-09-15'),
('1037','78','R-004','2008-09-15'),
('1038','77','R-004','2008-09-15'),
('1039','76','R-004','2008-09-17'),
('1040','74','R-004','2008-09-17'),
('1041','68','R-005','2008-09-17');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1042','66','R-005','2008-09-17'),
('1043','65','R-005','2008-09-17'),
('1044','64','R-005','2008-09-20'),
('1045','61','R-005','2008-09-20'),
('1046','60','R-005','2008-09-20'),
('1047','59','R-005','2008-09-20'),
('1048','58','R-005','2008-09-25'),
('1049','57','R-005','2008-09-25');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1050','56','R-005','2008-09-25'),
('1051','55','R-006','2008-09-25'),
('1052','54','R-006','2008-10-02'),
('1053','53','R-006','2008-10-02'),
('1054','52','R-006','2008-10-02'),
('1055','51','R-006','2008-10-02'),
('1056','50','R-006','2008-10-05'),
('1057','49','R-006','2008-10-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1058','48','R-006','2008-10-05'),
('1059','47','R-006','2008-10-05'),
('1060','46','R-006','2008-10-05'),
('1061','43','R-007','2008-10-06'),
('1062','42','R-007','2008-10-06'),
('1063','41','R-007','2008-10-06'),
('1064','40','R-007','2008-10-06'),
('1065','33','R-007','2008-10-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1066','32','R-007','2008-10-08'),
('1067','31','R-007','2008-10-08'),
('1068','30','R-007','2008-10-08'),
('1069','29','R-007','2008-10-09'),
('1070','28','R-007','2008-10-09'),
('1071','27','R-008','2008-10-09'),
('1072','26','R-008','2008-10-09'),
('1073','25','R-008','2008-10-10');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1074','24','R-008','2008-10-10'),
('1075','23','R-008','2008-10-10'),
('1076','22','R-008','2008-10-10'),
('1077','21','R-008','2008-10-11'),
('1078','20','R-008','2008-10-11'),
('1079','19','R-008','2008-10-11'),
('1080','18','R-008','2008-10-11'),
('1081','17','R-009','2008-11-03');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1082','16','R-009','2008-11-03'),
('1083','15','R-009','2008-11-03'),
('1084','14','R-009','2008-11-03'),
('1085','13','R-009','2008-11-03'),
('1086','12','R-009','2008-11-08'),
('1087','11','R-009','2008-11-08'),
('1088','10','R-009','2008-11-08'),
('1089','9','R-009','2008-11-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1090','10','R-009','2008-11-08'),
('1091','7','R-010','2008-11-08'),
('1092','6','R-010','2008-11-09'),
('1093','5','R-010','2008-11-09'),
('1094','4','R-010','2008-11-09'),
('1095','3','R-010','2008-11-09'),
('1096','2','R-010','2008-11-09'),
('1097','1','R-010','2008-11-10');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1098','107','R-010','2008-11-10'),
('1099','82','R-010','2008-11-10'),
('1100','81','R-010','2008-11-10'),
('1101','45','R-001','2008-11-10'),
('1102','118','R-001','2008-11-11'),
('1103','99','R-001','2008-11-11'),
('1104','69','R-001','2008-11-11'),
('1105','67','R-001','2008-11-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1106','96','R-001','2008-11-12'),
('1107','95','R-001','2008-11-12'),
('1108','94','R-001','2008-11-12'),
('1109','39','R-001','2008-11-12'),
('1110','38','R-001','2008-11-20'),
('1111','37','R-001','2008-11-20'),
('1112','36','R-002','2008-11-20'),
('1113','35','R-002','2008-11-20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1114','34','R-002','2008-11-24'),
('1115','83','R-002','2008-11-24'),
('1116','100','R-002','2008-11-24'),
('1117','63','R-002','2008-11-24'),
('1118','44','R-002','2008-12-01'),
('1119','115','R-002','2008-12-01'),
('1120','73','R-002','2008-12-01'),
('1121','72','R-002','2008-12-01');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1122','71','R-003','2009-01-01'),
('1123','70','R-003','2009-01-01'),
('1124','62','R-003','2009-01-01'),
('1125','114','R-003','2009-01-01'),
('1126','117','R-003','2009-01-01'),
('1127','116','R-003','2009-01-02'),
('1128','113','R-003','2009-01-02'),
('1129','112','R-003','2009-01-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1130','111','R-003','2009-01-02'),
('1131','110','R-003','2009-01-02'),
('1132','109','R-004','2009-01-03'),
('1133','108','R-004','2009-01-03'),
('1134','106','R-004','2009-01-03'),
('1135','105','R-004','2009-01-03'),
('1136','104','R-004','2009-01-03'),
('1137','103','R-004','2009-01-04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1138','102','R-004','2009-01-04'),
('1139','101','R-004','2009-01-04'),
('1140','98','R-004','2009-01-04'),
('1141','97','R-004','2009-01-04'),
('1142','93','R-005','2009-01-05'),
('1143','92','R-005','2009-01-05'),
('1144','91','R-005','2009-01-05'),
('1145','90','R-005','2009-01-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1146','89','R-005','2009-01-05'),
('1147','88','R-005','2009-01-06'),
('1148','87','R-005','2009-01-06'),
('1149','86','R-005','2009-01-06'),
('1150','85','R-005','2009-01-06'),
('1151','84','R-005','2009-01-06'),
('1152','80','R-006','2009-01-07'),
('1153','79','R-006','2009-01-07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1154','78','R-006','2009-01-07'),
('1155','77','R-006','2009-01-07'),
('1156','76','R-006','2009-01-07'),
('1157','74','R-006','2009-01-15'),
('1158','68','R-006','2009-01-15'),
('1159','66','R-006','2009-01-15'),
('1160','65','R-006','2009-01-15'),
('1161','64','R-006','2009-01-17');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1162','61','R-007','2009-01-17'),
('1163','60','R-007','2009-01-17'),
('1164','59','R-007','2009-01-17'),
('1165','58','R-007','2009-01-17'),
('1166','57','R-007','2009-01-20'),
('1167','56','R-007','2009-01-20'),
('1168','55','R-007','2009-01-20'),
('1169','54','R-007','2009-01-20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1170','53','R-007','2009-01-25'),
('1171','52','R-007','2009-01-25'),
('1172','51','R-008','2009-01-25'),
('1173','50','R-008','2009-01-25'),
('1174','49','R-008','2009-02-02'),
('1175','48','R-008','2009-02-02'),
('1176','47','R-008','2009-02-02'),
('1177','46','R-008','2009-02-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1178','43','R-008','2009-02-05'),
('1179','42','R-008','2009-02-05'),
('1180','41','R-008','2009-02-05'),
('1181','40','R-008','2009-02-05'),
('1182','33','R-009','2009-02-05'),
('1183','32','R-009','2009-02-06'),
('1184','31','R-009','2009-02-06'),
('1185','30','R-009','2009-02-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1186','29','R-009','2009-02-06'),
('1187','28','R-009','2009-02-08'),
('1188','27','R-009','2009-02-08'),
('1189','26','R-009','2009-02-08'),
('1190','25','R-009','2009-02-08'),
('1191','24','R-009','2009-02-09'),
('1192','23','R-010','2009-02-09'),
('1193','22','R-010','2009-02-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1194','21','R-010','2009-02-09'),
('1195','20','R-010','2009-02-10'),
('1196','19','R-010','2009-02-10'),
('1197','18','R-010','2009-02-10'),
('1198','17','R-010','2009-02-10'),
('1199','16','R-010','2009-02-11'),
('1200','15','R-010','2009-02-11'),
('1201','14','R-010','2009-02-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1202','13','R-001','2009-02-11'),
('1203','12','R-001','2009-03-03'),
('1204','11','R-001','2009-03-03'),
('1205','10','R-001','2009-03-03'),
('1206','9','R-001','2009-03-03'),
('1207','15','R-001','2009-03-03'),
('1208','7','R-001','2009-03-08'),
('1209','6','R-001','2009-03-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1210','5','R-001','2009-03-08'),
('1211','4','R-001','2009-03-08'),
('1212','3','R-001','2009-03-08'),
('1213','2','R-002','2009-03-08'),
('1214','1','R-002','2009-03-09'),
('1215','107','R-002','2009-03-09'),
('1216','82','R-002','2009-03-09'),
('1217','81','R-002','2009-03-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1218','45','R-002','2009-03-09'),
('1219','118','R-002','2009-03-10'),
('1220','99','R-002','2009-03-10'),
('1221','69','R-002','2009-03-10'),
('1222','67','R-002','2009-03-10'),
('1223','96','R-003','2009-03-10'),
('1224','95','R-003','2009-03-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1225','94','R-003','2009-03-11'),
('1226','39','R-003','2009-03-11'),
('1227','38','R-003','2009-03-11'),
('1228','37','R-003','2009-03-12'),
('1229','36','R-003','2009-03-12'),
('1230','35','R-003','2009-03-12'),
('1231','34','R-003','2009-03-12'),
('1232','83','R-003','2009-03-20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1233','100','R-004','2009-03-20'),
('1234','63','R-004','2009-03-20'),
('1235','44','R-004','2009-03-20'),
('1236','115','R-004','2009-03-24'),
('1237','73','R-004','2009-03-24'),
('1238','72','R-004','2009-03-24'),
('1239','71','R-004','2009-03-24'),
('1240','70','R-004','2009-04-01');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1241','62','R-004','2009-04-01'),
('1242','114','R-004','2009-04-01'),
('1243','117','R-005','2009-04-01'),
('1244','116','R-005','2009-04-05'),
('1245','113','R-005','2009-04-05'),
('1246','112','R-005','2009-04-05'),
('1247','111','R-005','2009-04-05'),
('1248','110','R-005','2009-04-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1249','109','R-005','2009-04-06'),
('1250','108','R-005','2009-04-06'),
('1251','106','R-005','2009-04-06'),
('1252','105','R-005','2009-04-06'),
('1253','104','R-006','2009-04-07'),
('1254','103','R-006','2009-04-07'),
('1255','102','R-006','2009-04-07'),
('1256','101','R-006','2009-04-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1257','98','R-006','2009-04-08'),
('1258','97','R-006','2009-04-08'),
('1259','93','R-006','2009-04-09'),
('1260','92','R-006','2009-04-09'),
('1261','91','R-006','2009-04-09'),
('1262','90','R-006','2009-04-09'),
('1263','89','R-007','2009-05-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1264','88','R-007','2009-05-02'),
('1265','87','R-007','2009-05-02'),
('1266','86','R-007','2009-05-02'),
('1267','85','R-007','2009-05-09'),
('1268','84','R-007','2009-05-09'),
('1269','80','R-007','2009-05-09'),
('1270','79','R-007','2009-05-09'),
('1271','78','R-007','2009-05-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1272','77','R-007','2009-05-12'),
('1273','76','R-008','2009-05-12'),
('1274','74','R-008','2009-05-12'),
('1275','68','R-008','2009-05-12'),
('1276','66','R-008','2009-06-05'),
('1277','65','R-008','2009-06-05'),
('1278','64','R-008','2009-06-05'),
('1279','61','R-008','2009-06-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1280','60','R-008','2009-06-07'),
('1281','59','R-008','2009-06-07'),
('1282','58','R-008','2009-06-07'),
('1283','57','R-009','2009-06-07'),
('1284','56','R-009','2009-06-09'),
('1285','55','R-009','2009-06-09'),
('1286','54','R-009','2009-06-09'),
('1287','53','R-009','2009-06-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1288','52','R-009','2009-06-11'),
('1289','51','R-009','2009-06-11'),
('1290','50','R-009','2009-06-13'),
('1291','49','R-009','2009-06-13'),
('1292','48','R-009','2009-06-13'),
('1293','47','R-010','2009-07-03'),
('1294','46','R-010','2009-07-07'),
('1295','43','R-010','2009-07-25');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1296','42','R-010','2009-07-28'),
('1297','41','R-010','2009-08-01'),
('1298','40','R-010','2009-08-08'),
('1299','33','R-010','2009-08-15'),
('1300','32','R-010','2009-08-21'),
('1301','31','R-010','2009-08-28'),
('1302','30','R-010','2009-09-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1303','29','R-001','2009-09-15'),
('1304','28','R-001','2009-09-20'),
('1305','27','R-001','2009-09-21'),
('1306','26','R-001','2009-09-23'),
('1307','25','R-001','2009-09-23'),
('1308','24','R-001','2009-10-11'),
('1309','23','R-001','2009-10-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1310','22','R-001','2009-10-13'),
('1311','21','R-001','2009-10-14'),
('1312','20','R-001','2009-10-15'),
('1313','19','R-001','2009-10-16'),
('1314','18','R-002','2009-10-17'),
('1315','17','R-002','2009-10-18'),
('1316','16','R-002','2009-10-19'),
('1317','15','R-002','2009-10-20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1318','14','R-002','2009-11-07'),
('1319','13','R-002','2009-11-08'),
('1320','12','R-002','2009-11-09'),
('1321','11','R-002','2009-11-10'),
('1322','10','R-002','2009-11-11'),
('1323','9','R-002','2009-11-17'),
('1324','17','R-003','2009-11-18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1325','7','R-003','2009-11-19'),
('1326','6','R-003','2009-11-20'),
('1327','5','R-003','2009-12-05'),
('1328','4','R-003','2009-12-09'),
('1329','3','R-003','2009-12-13'),
('1330','2','R-003','2009-12-17'),
('1331','1','R-003','2009-12-21'),
('1332','107','R-003','2010-01-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1333','82','R-003','2010-01-08'),
('1334','81','R-004','2010-01-08'),
('1335','45','R-004','2010-01-08'),
('1336','118','R-004','2010-01-08'),
('1337','99','R-004','2010-02-01'),
('1338','69','R-004','2010-02-01'),
('1339','67','R-004','2010-02-01'),
('1340','96','R-004','2010-02-01');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1341','95','R-004','2010-02-01'),
('1342','94','R-004','2010-02-05'),
('1343','39','R-004','2010-02-05'),
('1344','38','R-005','2010-02-05'),
('1345','37','R-005','2010-02-05'),
('1346','36','R-005','2010-02-05'),
('1347','35','R-005','2010-02-05'),
('1348','34','R-005','2010-02-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1349','83','R-005','2010-02-06'),
('1350','100','R-005','2010-02-06'),
('1351','63','R-005','2010-02-06'),
('1352','44','R-005','2010-02-06'),
('1353','115','R-005','2010-02-06'),
('1354','73','R-006','2010-02-07'),
('1355','72','R-006','2010-02-07'),
('1356','71','R-006','2010-02-07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1357','70','R-006','2010-02-07'),
('1358','62','R-006','2010-02-07'),
('1359','114','R-006','2010-02-07'),
('1360','117','R-006','2010-02-07'),
('1361','116','R-006','2010-02-08'),
('1362','113','R-006','2010-02-08'),
('1363','112','R-006','2010-02-08'),
('1364','111','R-007','2010-02-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1365','110','R-007','2010-02-08'),
('1366','109','R-007','2010-02-08'),
('1367','108','R-007','2010-02-08'),
('1368','106','R-007','2010-02-09'),
('1369','105','R-007','2010-02-09'),
('1370','104','R-007','2010-02-09'),
('1371','103','R-007','2010-02-09'),
('1372','102','R-007','2010-02-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1373','101','R-007','2010-02-13'),
('1374','98','R-008','2010-02-13'),
('1375','97','R-008','2010-02-13'),
('1376','93','R-008','2010-02-13'),
('1377','92','R-008','2010-02-13'),
('1378','91','R-008','2010-02-14'),
('1379','90','R-008','2010-02-14'),
('1380','89','R-008','2010-02-14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1381','88','R-008','2010-02-14'),
('1382','87','R-008','2010-02-14'),
('1383','86','R-008','2010-02-14'),
('1384','85','R-009','2010-02-15'),
('1385','84','R-009','2010-02-15'),
('1386','80','R-009','2010-02-15'),
('1387','79','R-009','2010-02-15'),
('1388','78','R-009','2010-02-15');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1389','77','R-009','2010-02-15'),
('1390','76','R-009','2010-02-16'),
('1391','74','R-009','2010-02-16'),
('1392','68','R-009','2010-02-16'),
('1393','66','R-009','2010-02-16'),
('1394','65','R-010','2010-02-16'),
('1395','64','R-010','2010-02-16'),
('1396','61','R-010','2010-02-16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1397','60','R-010','2010-02-16'),
('1398','59','R-010','2010-03-10'),
('1399','58','R-010','2010-03-10'),
('1400','57','R-010','2010-03-10'),
('1401','56','R-010','2010-03-10'),
('1402','55','R-010','2010-03-10'),
('1403','54','R-010','2010-03-10'),
('1404','53','R-001','2010-03-10');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1405','52','R-001','2010-03-11'),
('1406','51','R-001','2010-03-11'),
('1407','50','R-001','2010-03-11'),
('1408','49','R-001','2010-03-11'),
('1409','48','R-001','2010-03-11'),
('1410','47','R-001','2010-03-12'),
('1411','46','R-001','2010-03-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1412','43','R-001','2010-03-12'),
('1413','42','R-001','2010-03-12'),
('1414','41','R-001','2010-03-12'),
('1415','40','R-002','2010-03-23'),
('1416','33','R-002','2010-03-23'),
('1417','32','R-002','2010-03-23'),
('1418','31','R-002','2010-03-23');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1419','30','R-002','2010-03-23'),
('1420','29','R-002','2010-03-23'),
('1421','28','R-002','2010-04-04'),
('1422','27','R-002','2010-04-04'),
('1423','26','R-002','2010-04-04'),
('1424','25','R-002','2010-04-04'),
('1425','24','R-003','2010-04-04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1426','23','R-003','2010-04-05'),
('1427','22','R-003','2010-04-05'),
('1428','21','R-003','2010-04-05'),
('1429','20','R-003','2010-04-05'),
('1430','19','R-003','2010-04-06'),
('1431','18','R-003','2010-04-06'),
('1432','17','R-003','2010-04-06'),
('1433','16','R-003','2010-04-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1434','15','R-003','2010-04-06'),
('1435','14','R-004','2010-04-07'),
('1436','13','R-004','2010-04-07'),
('1437','12','R-004','2010-04-07'),
('1438','11','R-004','2010-04-07'),
('1439','10','R-004','2010-04-07'),
('1440','9','R-004','2010-04-08'),
('1441','21','R-004','2010-04-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1442','7','R-004','2010-04-08'),
('1443','6','R-004','2010-04-08'),
('1444','5','R-004','2010-04-08'),
('1445','4','R-005','2010-04-09'),
('1446','3','R-005','2010-04-09'),
('1447','2','R-005','2010-04-09'),
('1448','1','R-005','2010-04-09'),
('1449','107','R-005','2010-04-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1450','82','R-005','2010-04-09'),
('1451','81','R-005','2010-04-10'),
('1452','45','R-005','2010-04-10'),
('1453','118','R-005','2010-04-10'),
('1454','99','R-005','2010-04-10'),
('1455','69','R-006','2010-04-10'),
('1456','67','R-006','2010-04-11'),
('1457','96','R-006','2010-04-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1458','95','R-006','2010-04-11'),
('1459','94','R-006','2010-04-11'),
('1460','39','R-006','2010-04-11'),
('1461','38','R-006','2010-04-12'),
('1462','37','R-006','2010-04-12'),
('1463','36','R-006','2010-04-12'),
('1464','35','R-006','2010-04-12'),
('1465','34','R-007','2010-04-13');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1466','83','R-007','2010-04-13'),
('1467','100','R-007','2010-04-13'),
('1468','63','R-007','2010-04-13'),
('1469','44','R-007','2010-04-13'),
('1470','115','R-007','2010-04-14'),
('1471','73','R-007','2010-04-14'),
('1472','72','R-007','2010-04-14'),
('1473','71','R-007','2010-04-14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1474','70','R-007','2010-04-14'),
('1475','62','R-008','2010-04-15'),
('1476','114','R-008','2010-04-15'),
('1477','117','R-008','2010-04-15'),
('1478','116','R-008','2010-04-16'),
('1479','113','R-008','2010-04-16'),
('1480','112','R-008','2010-04-16'),
('1481','111','R-008','2010-04-16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1482','110','R-008','2010-04-17'),
('1483','109','R-008','2010-04-17'),
('1484','108','R-008','2010-04-17'),
('1485','106','R-009','2010-04-17'),
('1486','105','R-009','2010-04-18'),
('1487','104','R-009','2010-04-18'),
('1488','103','R-009','2010-04-18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1489','102','R-009','2010-05-03'),
('1490','101','R-009','2010-05-03'),
('1491','98','R-009','2010-05-03'),
('1492','97','R-009','2010-05-03'),
('1493','93','R-009','2010-05-04'),
('1494','92','R-009','2010-05-04'),
('1495','91','R-010','2010-05-04'),
('1496','90','R-010','2010-05-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1497','89','R-010','2010-05-05'),
('1498','88','R-010','2010-05-05'),
('1499','87','R-010','2010-05-05'),
('1500','86','R-010','2010-05-06'),
('1501','85','R-010','2010-05-06'),
('1502','84','R-010','2010-05-06'),
('1503','80','R-010','2010-05-06'),
('1504','79','R-010','2010-05-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1505','78','R-001','2010-05-07'),
('1506','77','R-001','2010-05-07'),
('1507','76','R-001','2010-05-07'),
('1508','74','R-001','2010-05-07'),
('1509','68','R-001','2010-05-07'),
('1510','66','R-001','2010-05-07'),
('1511','65','R-001','2010-05-08'),
('1512','64','R-001','2010-05-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1513','61','R-001','2010-05-08'),
('1514','60','R-001','2010-05-08'),
('1515','59','R-001','2010-05-08'),
('1516','58','R-002','2010-05-09'),
('1517','57','R-002','2010-05-09'),
('1518','56','R-002','2010-05-09'),
('1519','55','R-002','2010-05-09'),
('1520','54','R-002','2010-05-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1521','53','R-002','2010-05-09'),
('1522','52','R-002','2010-05-09'),
('1523','51','R-002','2010-05-10'),
('1524','50','R-002','2010-05-10'),
('1525','49','R-002','2010-05-10'),
('1526','48','R-003','2010-05-10'),
('1527','47','R-003','2010-05-11'),
('1528','46','R-003','2010-05-11'),
('1529','43','R-003','2010-05-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1530','42','R-003','2010-05-12'),
('1531','41','R-003','2010-05-12'),
('1532','40','R-003','2010-05-12'),
('1533','33','R-003','2010-05-13'),
('1534','32','R-003','2010-05-13'),
('1535','31','R-003','2010-05-13'),
('1536','30','R-004','2010-05-13'),
('1537','29','R-004','2010-05-13'),
('1538','28','R-004','2010-06-01');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1539','27','R-004','2010-06-01'),
('1540','26','R-004','2010-06-01'),
('1541','25','R-004','2010-06-01'),
('1542','24','R-004','2010-06-01'),
('1543','23','R-004','2010-06-01'),
('1544','22','R-004','2010-06-01'),
('1545','21','R-004','2010-06-01'),
('1546','20','R-005','2010-06-01');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1547','19','R-005','2010-06-01'),
('1548','18','R-005','2010-06-02'),
('1549','17','R-005','2010-06-02'),
('1550','16','R-005','2010-06-02'),
('1551','15','R-005','2010-06-02'),
('1552','14','R-005','2010-06-02'),
('1553','13','R-005','2010-06-02'),
('1554','12','R-005','2010-06-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1555','11','R-005','2010-06-02'),
('1556','10','R-006','2010-06-02'),
('1557','9','R-006','2010-06-02'),
('1558','23','R-006','2010-06-03'),
('1559','7','R-006','2010-06-03'),
('1560','6','R-006','2010-06-03'),
('1561','5','R-006','2010-06-03'),
('1562','4','R-006','2010-06-03');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1563','3','R-006','2010-06-03'),
('1564','2','R-006','2010-06-03'),
('1565','1','R-006','2010-06-03'),
('1566','107','R-007','2010-06-04'),
('1567','82','R-007','2010-06-04'),
('1568','81','R-007','2010-06-04'),
('1569','45','R-007','2010-06-04'),
('1570','118','R-007','2010-06-04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1571','99','R-007','2010-06-04'),
('1572','69','R-007','2010-06-04'),
('1573','67','R-007','2010-06-05'),
('1574','96','R-007','2010-06-06'),
('1575','95','R-007','2010-06-06'),
('1576','94','R-008','2010-06-06'),
('1577','39','R-008','2010-06-06'),
('1578','38','R-008','2010-06-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1579','37','R-008','2010-06-06'),
('1580','36','R-008','2010-06-06'),
('1581','35','R-008','2010-06-06'),
('1582','34','R-008','2010-06-06'),
('1583','83','R-008','2010-06-06'),
('1584','100','R-008','2010-06-06'),
('1585','63','R-008','2010-06-06'),
('1586','44','R-009','2010-06-07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1587','115','R-009','2010-06-07'),
('1588','73','R-009','2010-06-07'),
('1589','72','R-009','2010-06-07'),
('1590','71','R-009','2010-06-07'),
('1591','70','R-009','2010-06-07'),
('1592','62','R-009','2010-06-07'),
('1593','114','R-009','2010-06-07'),
('1594','117','R-009','2010-06-07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1595','116','R-009','2010-06-07'),
('1596','113','R-010','2010-06-07'),
('1597','112','R-010','2010-06-07'),
('1598','111','R-010','2010-06-07'),
('1599','110','R-010','2010-06-07'),
('1600','109','R-010','2010-06-07'),
('1601','108','R-010','2010-06-07'),
('1602','106','R-010','2010-06-07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1603','105','R-010','2010-06-07'),
('1604','104','R-010','2010-06-07'),
('1605','103','R-010','2010-06-07'),
('1606','102','R-001','2010-06-08'),
('1607','101','R-001','2010-06-08'),
('1608','98','R-001','2010-06-08'),
('1609','97','R-001','2010-06-08'),
('1610','93','R-001','2010-06-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1611','92','R-001','2010-06-08'),
('1612','91','R-001','2010-06-08'),
('1613','90','R-001','2010-06-08'),
('1614','89','R-001','2010-06-08'),
('1615','88','R-001','2010-06-08'),
('1616','87','R-001','2010-06-09'),
('1617','86','R-002','2010-06-09'),
('1618','85','R-002','2010-06-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1619','84','R-002','2010-06-09'),
('1620','80','R-002','2010-06-09'),
('1621','79','R-002','2010-06-09'),
('1622','78','R-002','2010-06-09'),
('1623','77','R-002','2010-06-10'),
('1624','76','R-002','2010-06-10'),
('1625','74','R-002','2010-06-10'),
('1626','68','R-002','2010-06-10');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1627','66','R-003','2010-06-10'),
('1628','65','R-003','2010-06-10'),
('1629','64','R-003','2010-06-10'),
('1630','61','R-003','2010-06-10'),
('1631','60','R-003','2010-06-10'),
('1632','59','R-003','2010-06-10'),
('1633','58','R-003','2010-06-10'),
('1634','57','R-003','2010-06-10');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1635','56','R-003','2010-06-10'),
('1636','55','R-003','2010-06-10'),
('1637','54','R-004','2010-06-10'),
('1638','53','R-004','2010-06-10'),
('1639','52','R-004','2010-06-11'),
('1640','51','R-004','2010-06-11'),
('1641','50','R-004','2010-06-11'),
('1642','49','R-004','2010-06-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1643','48','R-004','2010-06-11'),
('1644','47','R-004','2010-06-11'),
('1645','46','R-004','2010-06-11'),
('1646','43','R-004','2010-06-11'),
('1647','42','R-005','2010-06-11'),
('1648','41','R-005','2010-06-11'),
('1649','40','R-005','2010-06-11'),
('1650','33','R-005','2010-06-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1651','32','R-005','2010-06-11'),
('1652','31','R-005','2010-06-12'),
('1653','30','R-005','2010-06-12'),
('1654','29','R-005','2010-06-12'),
('1655','28','R-005','2010-06-12'),
('1656','27','R-005','2010-06-12'),
('1657','26','R-006','2010-06-12'),
('1658','25','R-006','2010-06-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1659','24','R-006','2010-06-12'),
('1660','23','R-006','2010-06-12'),
('1661','22','R-006','2010-06-12'),
('1662','21','R-006','2010-06-12'),
('1663','20','R-006','2010-06-12'),
('1664','19','R-006','2010-06-12'),
('1665','18','R-006','2010-06-12'),
('1666','17','R-006','2010-06-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1667','16','R-007','2010-06-12'),
('1668','15','R-007','2010-06-12'),
('1669','14','R-007','2010-06-13'),
('1670','13','R-007','2010-06-13'),
('1671','12','R-007','2010-06-13'),
('1672','11','R-007','2010-06-13'),
('1673','10','R-007','2010-06-13'),
('1674','9','R-007','2010-06-13');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1675','25','R-007','2010-06-13'),
('1676','7','R-007','2010-06-13'),
('1677','6','R-008','2010-07-01'),
('1678','5','R-008','2010-07-01'),
('1679','4','R-008','2010-07-01'),
('1680','3','R-008','2010-07-01'),
('1681','2','R-008','2010-07-01'),
('1682','1','R-008','2010-07-01');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1683','107','R-008','2010-07-01'),
('1684','82','R-008','2010-07-02'),
('1685','81','R-008','2010-07-02'),
('1686','45','R-008','2010-07-02'),
('1687','118','R-009','2010-07-02'),
('1688','99','R-009','2010-07-03'),
('1689','69','R-009','2010-07-03'),
('1690','67','R-009','2010-07-03');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1691','96','R-009','2010-07-03'),
('1692','95','R-009','2010-07-03'),
('1693','94','R-009','2010-07-03'),
('1694','39','R-009','2010-07-03'),
('1695','38','R-009','2010-07-03'),
('1696','37','R-009','2010-07-04'),
('1697','36','R-010','2010-07-04'),
('1698','35','R-010','2010-07-04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1699','34','R-010','2010-07-04'),
('1700','83','R-010','2010-07-05'),
('1701','100','R-010','2010-07-05'),
('1702','63','R-010','2010-07-05'),
('1703','44','R-010','2010-07-05'),
('1704','115','R-010','2010-07-05'),
('1705','73','R-010','2010-07-05'),
('1706','72','R-010','2010-07-05');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1707','71','R-001','2010-07-05'),
('1708','70','R-001','2010-07-05'),
('1709','62','R-001','2010-07-05'),
('1710','114','R-001','2010-07-05'),
('1711','117','R-001','2010-07-06'),
('1712','116','R-001','2010-07-06'),
('1713','113','R-001','2010-07-06'),
('1714','112','R-001','2010-07-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1715','111','R-001','2010-07-06'),
('1716','110','R-001','2010-07-06'),
('1717','109','R-001','2010-07-06'),
('1718','108','R-002','2010-07-06'),
('1719','106','R-002','2010-07-07'),
('1720','105','R-002','2010-07-07'),
('1721','104','R-002','2010-07-07'),
('1722','103','R-002','2010-07-07'),
('1723','102','R-002','2010-07-07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1724','101','R-002','2010-07-08'),
('1725','98','R-002','2010-07-08'),
('1726','97','R-002','2010-07-08'),
('1727','93','R-002','2010-07-08'),
('1728','92','R-003','2010-07-08'),
('1729','91','R-003','2010-07-08'),
('1730','90','R-003','2010-07-08'),
('1731','89','R-003','2010-07-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1732','88','R-003','2010-07-09'),
('1733','87','R-003','2010-07-09'),
('1734','86','R-003','2010-07-09'),
('1735','85','R-003','2010-07-09'),
('1736','84','R-003','2010-07-09'),
('1737','80','R-003','2010-07-09'),
('1738','79','R-004','2010-07-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1739','78','R-004','2010-07-10'),
('1740','77','R-004','2010-07-10'),
('1741','76','R-004','2010-07-10'),
('1742','74','R-004','2010-07-10'),
('1743','68','R-004','2010-07-10'),
('1744','66','R-004','2010-07-10'),
('1745','65','R-004','2010-07-10'),
('1746','64','R-004','2010-07-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1747','61','R-004','2010-07-11'),
('1748','60','R-005','2010-07-11'),
('1749','59','R-005','2010-07-11'),
('1750','58','R-005','2010-07-11'),
('1751','57','R-005','2010-07-11'),
('1752','56','R-005','2010-07-11'),
('1753','55','R-005','2010-07-11'),
('1754','54','R-005','2010-07-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1755','53','R-005','2010-07-12'),
('1756','52','R-005','2010-07-12'),
('1757','51','R-005','2010-07-12'),
('1758','50','R-006','2010-07-12'),
('1759','49','R-006','2010-07-12'),
('1760','48','R-006','2010-07-12'),
('1761','47','R-006','2010-07-12'),
('1762','46','R-006','2010-07-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1763','43','R-006','2010-07-12'),
('1764','42','R-006','2010-07-12'),
('1765','41','R-006','2010-07-12'),
('1766','40','R-006','2010-07-12'),
('1767','33','R-006','2010-07-12'),
('1768','32','R-007','2010-07-13'),
('1769','31','R-007','2010-07-13'),
('1770','30','R-007','2010-07-13');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1771','29','R-007','2010-07-13'),
('1772','28','R-007','2010-07-13'),
('1773','27','R-007','2010-07-13'),
('1774','26','R-007','2010-07-14'),
('1775','25','R-007','2010-07-14'),
('1776','24','R-007','2010-07-14'),
('1777','23','R-007','2010-07-14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1778','22','R-008','2010-07-14'),
('1779','21','R-008','2010-07-14'),
('1780','20','R-008','2010-07-14'),
('1781','19','R-008','2010-07-14'),
('1782','18','R-008','2010-07-14'),
('1783','17','R-008','2010-07-14'),
('1784','16','R-008','2010-07-14'),
('1785','15','R-008','2010-07-14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1786','14','R-008','2010-07-14'),
('1787','13','R-008','2010-07-14'),
('1788','12','R-009','2010-07-14'),
('1789','11','R-009','2010-07-14'),
('1790','10','R-009','2010-07-14'),
('1791','9','R-009','2010-07-14'),
('1792','27','R-009','2010-07-14'),
('1793','7','R-009','2010-07-14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1794','6','R-009','2010-07-14'),
('1795','5','R-009','2010-07-15'),
('1796','4','R-009','2010-07-15'),
('1797','3','R-009','2010-07-15'),
('1798','2','R-010','2010-07-15'),
('1799','1','R-010','2010-07-15'),
('1800','107','R-010','2010-07-15'),
('1801','82','R-010','2010-07-15');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1802','81','R-010','2010-07-15'),
('1803','45','R-010','2010-07-15'),
('1804','118','R-010','2010-07-15'),
('1805','99','R-010','2010-07-15'),
('1806','69','R-010','2010-07-15'),
('1807','67','R-010','2010-07-15'),
('1808','96','R-001','2010-07-15'),
('1809','95','R-001','2010-07-15');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1810','94','R-001','2010-07-15'),
('1811','39','R-001','2010-07-15'),
('1812','38','R-001','2010-07-15'),
('1813','37','R-001','2010-07-15'),
('1814','36','R-001','2010-07-16'),
('1815','35','R-001','2010-07-16'),
('1816','34','R-001','2010-07-16'),
('1817','83','R-001','2010-07-16'),
('1818','100','R-001','2010-07-16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1819','63','R-002','2010-07-16'),
('1820','44','R-002','2010-08-05'),
('1821','115','R-002','2010-08-05'),
('1822','73','R-002','2010-08-05'),
('1823','72','R-002','2010-08-05'),
('1824','71','R-002','2010-08-05'),
('1825','70','R-002','2010-08-05'),
('1826','62','R-002','2010-08-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1827','114','R-002','2010-08-06'),
('1828','117','R-002','2010-08-06'),
('1829','116','R-003','2010-08-06'),
('1830','113','R-003','2010-08-06'),
('1831','112','R-003','2010-08-06'),
('1832','111','R-003','2010-08-06'),
('1833','110','R-003','2010-08-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1834','109','R-003','2010-08-07'),
('1835','108','R-003','2010-08-07'),
('1836','106','R-003','2010-08-07'),
('1837','105','R-003','2010-08-07'),
('1838','104','R-003','2010-08-08'),
('1839','103','R-004','2010-08-08'),
('1840','102','R-004','2010-08-08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1841','101','R-004','2010-08-08'),
('1842','98','R-004','2010-08-09'),
('1843','97','R-004','2010-08-09'),
('1844','93','R-004','2010-08-09'),
('1845','92','R-004','2010-08-09'),
('1846','91','R-004','2010-08-09'),
('1847','90','R-004','2010-08-09'),
('1848','89','R-004','2010-08-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1849','88','R-005','2010-08-09'),
('1850','87','R-005','2010-08-09'),
('1851','86','R-005','2010-08-09'),
('1852','85','R-005','2010-08-09'),
('1853','84','R-005','2010-08-09'),
('1854','80','R-005','2010-08-10'),
('1855','79','R-005','2010-08-10'),
('1856','78','R-005','2010-08-10');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1857','77','R-005','2010-08-10'),
('1858','76','R-005','2010-08-10'),
('1859','74','R-006','2010-08-10'),
('1860','68','R-006','2010-08-10'),
('1861','66','R-006','2010-08-10'),
('1862','65','R-006','2010-08-11'),
('1863','64','R-006','2010-08-11'),
('1864','61','R-006','2010-08-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1865','60','R-006','2010-08-11'),
('1866','59','R-006','2010-08-12'),
('1867','58','R-006','2010-08-12'),
('1868','57','R-006','2010-08-12'),
('1869','56','R-007','2010-08-12'),
('1870','55','R-007','2010-08-12'),
('1871','54','R-007','2010-08-12'),
('1872','53','R-007','2010-08-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1873','52','R-007','2010-08-12'),
('1874','51','R-007','2010-08-12'),
('1875','50','R-007','2010-09-09'),
('1876','49','R-007','2010-09-09'),
('1877','48','R-007','2010-09-09'),
('1878','47','R-007','2010-09-09'),
('1879','46','R-008','2010-09-09'),
('1880','43','R-008','2010-09-09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1881','42','R-008','2010-09-09'),
('1882','41','R-008','2010-09-09'),
('1883','40','R-008','2010-09-10'),
('1884','33','R-008','2010-09-10'),
('1885','32','R-008','2010-09-10'),
('1886','31','R-008','2010-09-10'),
('1887','30','R-008','2010-09-10'),
('1888','29','R-008','2010-09-10');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1889','28','R-009','2010-09-10'),
('1890','27','R-009','2010-09-10'),
('1891','26','R-009','2010-09-10'),
('1892','25','R-009','2010-09-11'),
('1893','24','R-009','2010-09-11'),
('1894','23','R-009','2010-09-11'),
('1895','22','R-009','2010-09-11'),
('1896','21','R-009','2010-09-11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1897','20','R-009','2010-09-11'),
('1898','19','R-009','2010-09-11'),
('1899','18','R-010','2010-09-17'),
('1900','17','R-010','2010-09-17'),
('1901','16','R-010','2010-09-17'),
('1902','15','R-010','2010-09-17'),
('1903','14','R-010','2010-09-17'),
('1904','13','R-010','2010-09-17');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1905','12','R-010','2010-09-18'),
('1906','11','R-010','2010-09-18'),
('1907','10','R-010','2010-09-18'),
('1908','9','R-010','2010-09-18'),
('1909','30','R-001','2010-09-18'),
('1910','7','R-001','2010-09-18'),
('1911','6','R-001','2010-09-18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1912','5','R-001','2010-09-18'),
('1913','4','R-001','2010-09-20'),
('1914','3','R-001','2010-09-20'),
('1915','2','R-001','2010-09-20'),
('1916','1','R-001','2010-09-20'),
('1917','107','R-001','2010-09-20'),
('1918','82','R-001','2010-09-20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1919','81','R-001','2010-09-20'),
('1920','45','R-002','2010-09-20'),
('1921','118','R-002','2010-10-06'),
('1922','99','R-002','2010-10-06'),
('1923','69','R-002','2010-10-06'),
('1924','67','R-002','2010-10-06'),
('1925','96','R-002','2010-10-06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1926','95','R-002','2010-10-09'),
('1927','94','R-002','2010-10-09'),
('1928','39','R-002','2010-10-09'),
('1929','38','R-002','2010-10-09'),
('1930','37','R-003','2010-10-09'),
('1931','36','R-003','2010-10-12'),
('1932','35','R-003','2010-10-12');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1933','34','R-003','2010-10-12'),
('1934','83','R-003','2010-10-12'),
('1935','100','R-003','2010-10-12'),
('1936','63','R-003','2010-10-12'),
('1937','44','R-003','2010-10-18'),
('1938','115','R-003','2010-10-18'),
('1939','73','R-003','2010-10-18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1940','72','R-004','2010-10-18'),
('1941','71','R-004','2010-10-18'),
('1942','70','R-004','2010-10-18'),
('1943','62','R-004','2010-10-19'),
('1944','114','R-004','2010-10-19'),
('1945','117','R-004','2010-10-19'),
('1946','116','R-004','2010-10-19');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1947','113','R-004','2010-10-19'),
('1948','112','R-004','2010-10-19'),
('1949','111','R-004','2010-10-19'),
('1950','110','R-005','2010-10-19'),
('1951','109','R-005','2010-10-20'),
('1952','108','R-005','2010-10-20'),
('1953','106','R-005','2010-10-20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1954','105','R-005','2010-10-20'),
('1955','104','R-005','2010-10-20'),
('1956','103','R-005','2010-10-20'),
('1957','102','R-005','2010-10-20'),
('1958','101','R-005','2010-11-01'),
('1959','98','R-005','2010-11-01'),
('1960','97','R-006','2010-11-01');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1961','93','R-006','2010-11-01'),
('1962','92','R-006','2010-11-01'),
('1963','91','R-006','2010-11-01'),
('1964','90','R-006','2010-11-01'),
('1965','89','R-006','2010-11-01'),
('1966','88','R-006','2010-11-01'),
('1967','87','R-006','2010-11-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1968','86','R-006','2010-11-02'),
('1969','85','R-006','2010-11-02'),
('1970','84','R-007','2010-11-02'),
('1971','80','R-007','2010-11-02'),
('1972','79','R-007','2010-11-02'),
('1973','78','R-007','2010-11-02'),
('1974','77','R-007','2010-11-02'),
('1975','76','R-007','2010-11-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1976','74','R-007','2010-11-02'),
('1977','68','R-007','2010-11-02'),
('1978','66','R-007','2010-11-02'),
('1979','65','R-007','2010-11-02'),
('1980','64','R-008','2010-11-02'),
('1981','61','R-008','2010-11-02'),
('1982','60','R-008','2010-11-02');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1983','59','R-008','2010-11-02'),
('1984','58','R-008','2010-11-02'),
('1985','57','R-008','2010-11-02'),
('1986','56','R-008','2010-11-02'),
('1987','55','R-008','2010-11-02'),
('1988','54','R-008','2010-11-03'),
('1989','53','R-008','2010-11-03');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1990','52','R-009','2010-11-03'),
('1991','51','R-009','2010-11-03'),
('1992','50','R-009','2010-11-03'),
('1993','49','R-009','2010-11-03'),
('1994','48','R-009','2010-12-10'),
('1995','47','R-009','2010-12-12'),
('1996','46','R-009','2010-12-13'),
('1997','43','R-009','2010-12-14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`facturas` (`CODIGO_FACTURA`,`CODIGO_PROVEEDOR`,`CODIGO_RECOLECTOR`,`FECHA`)
VALUES
('1998','42','R-009','2010-12-15'),
('1999','41','R-009','2010-12-16'),
('2000','40','R-010','2010-12-17');

/*==============================================================*/
/* Table: VIDRIO                                                */
/*==============================================================*/
INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1','TV-01','CV-02','1000','1.00','1.20'),
('2','TV-01','CV-02','1000','2.00','2.40'),
('3','TV-01','CV-02','1000','3.00','3.60'),
('4','TV-01','CV-02','1000','4.00','4.80'),
('5','TV-01','CV-02','1000','5.00','6.00'),
('6','TV-01','CV-02','1000','6.00','7.20'),
('7','TV-01','CV-01','1000','7.00','8.40'),
('8','TV-01','CV-01','1000','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('9','TV-01','CV-01','1000','3.60','4.32'),
('10','TV-01','CV-01','1000','1.80','2.16'),
('11','TV-01','CV-01','1000','1.90','2.28'),
('12','TV-01','CV-01','1000','5.30','6.36'),
('13','TV-01','CV-01','1001','3.60','4.32'),
('14','TV-01','CV-02','1001','4.32','5.18'),
('15','TV-02','CV-01','1001','2.40','2.88'),
('16','TV-02','CV-02','1001','2.88','3.46');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('17','TV-02','CV-01','1001','1.20','1.44'),
('18','TV-02','CV-02','1001','1.44','1.73'),
('19','TV-01','CV-01','1001','1.72','2.06'),
('20','TV-01','CV-02','1001','20.60','24.72'),
('21','TV-01','CV-01','1001','2.06','2.47'),
('22','TV-02','CV-02','1001','1.50','1.80'),
('23','TV-02','CV-01','1001','1.80','2.16'),
('24','TV-02','CV-02','1001','1.09','1.31');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('25','TV-02','CV-01','1001','1.05','1.26'),
('26','TV-01','CV-02','1001','1.26','1.51'),
('27','TV-01','CV-01','1001','1.31','1.57'),
('28','TV-01','CV-02','1001','1.51','1.81'),
('29','TV-01','CV-03','1001','2.57','3.08'),
('30','TV-01','CV-03','1001','3.08','3.70'),
('31','TV-01','CV-03','1001','7.30','8.76'),
('32','TV-02','CV-04','1001','1.60','1.92');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('33','TV-02','CV-05','1001','2.90','3.48'),
('34','TV-02','CV-02','1001','4.80','5.76'),
('35','TV-02','CV-02','1001','1.05','1.26'),
('36','TV-02','CV-02','1001','1.07','1.28'),
('37','TV-02','CV-02','1001','2.08','2.50'),
('38','TV-01','CV-02','1001','2.09','2.51'),
('39','TV-01','CV-02','1001','20.70','24.84'),
('40','TV-01','CV-01','1002','20.60','24.72');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('41','TV-01','CV-01','1002','2.06','2.47'),
('42','TV-01','CV-01','1002','2.08','2.50'),
('43','TV-01','CV-01','1002','1.06','1.27'),
('44','TV-01','CV-01','1002','1.05','1.26'),
('45','TV-01','CV-01','1002','1.59','1.91'),
('46','TV-01','CV-01','1002','1.48','1.78'),
('47','TV-01','CV-02','1002','1.49','1.79'),
('48','TV-01','CV-01','1002','1.90','2.28'),
('49','TV-01','CV-02','1002','1.49','1.79');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('50','TV-01','CV-01','1002','1.13','1.36'),
('51','TV-01','CV-02','1002','1.49','1.79'),
('52','TV-01','CV-01','1002','1.89','2.27'),
('53','TV-01','CV-02','1002','1.82','2.18'),
('54','TV-01','CV-01','1002','1.36','1.63'),
('55','TV-02','CV-02','1002','1.78','2.14'),
('56','TV-02','CV-01','1003','1.79','2.15'),
('57','TV-02','CV-02','1003','1.65','1.98');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('58','TV-01','CV-01','1003','1.50','1.80'),
('59','TV-02','CV-02','1003','1.41','1.69'),
('60','TV-01','CV-01','1003','1.10','1.32'),
('61','TV-02','CV-02','1003','1.15','1.38'),
('62','TV-01','CV-03','1003','1.38','1.66'),
('63','TV-02','CV-03','1003','1.66','1.99'),
('64','TV-01','CV-03','1003','1.99','2.39'),
('65','TV-02','CV-04','1003','2.39','2.87');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('66','TV-01','CV-05','1004','2.87','3.44'),
('67','TV-02','CV-02','1004','4.40','5.28'),
('68','TV-01','CV-02','1004','4.60','5.52'),
('69','TV-02','CV-02','1004','4.85','5.82'),
('70','TV-01','CV-02','1004','1.90','2.28'),
('71','TV-01','CV-02','1005','1.98','2.38'),
('72','TV-01','CV-02','1005','1.49','1.79'),
('73','TV-01','CV-01','1005','2.49','2.99');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('74','TV-01','CV-01','1005','1.19','1.43'),
('75','TV-02','CV-01','1005','2.57','3.08'),
('76','TV-02','CV-01','1005','2.40','2.88'),
('77','TV-02','CV-01','1005','3.48','4.18'),
('78','TV-01','CV-01','1005','0.50','0.60'),
('79','TV-02','CV-01','1005','0.54','0.65'),
('80','TV-01','CV-02','1005','0.78','0.94'),
('81','TV-02','CV-01','1006','0.49','0.59');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('82','TV-01','CV-02','1006','1.56','1.87'),
('83','TV-02','CV-01','1006','1.94','2.33'),
('84','TV-01','CV-02','1006','0.89','1.07'),
('85','TV-02','CV-01','1006','1.06','1.27'),
('86','TV-01','CV-02','1006','1.08','1.30'),
('87','TV-02','CV-01','1006','1.59','1.91'),
('88','TV-01','CV-02','1006','2.59','3.11'),
('89','TV-02','CV-01','1006','2.20','2.64');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('90','TV-01','CV-02','1006','3.19','3.83'),
('91','TV-01','CV-01','1007','4.20','5.04'),
('92','TV-01','CV-02','1007','5.19','6.23'),
('93','TV-01','CV-01','1007','6.18','7.42'),
('94','TV-01','CV-02','1007','7.19','8.63'),
('95','TV-01','CV-03','1007','8.09','9.71'),
('96','TV-01','CV-03','1007','9.02','10.82'),
('97','TV-01','CV-03','1007','10.90','13.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('98','TV-01','CV-04','1007','11.19','13.43'),
('99','TV-01','CV-05','1007','12.50','15.00'),
('100','TV-01','CV-02','1007','13.89','16.67'),
('101','TV-01','CV-02','1008','14.19','17.03'),
('102','TV-01','CV-02','1008','15.19','18.23'),
('103','TV-01','CV-02','1008','16.09','19.31'),
('104','TV-01','CV-02','1008','1.00','1.20'),
('105','TV-02','CV-02','1008','2.00','2.40');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('106','TV-02','CV-01','1008','3.00','3.60'),
('107','TV-02','CV-01','1008','4.00','4.80'),
('108','TV-02','CV-01','1008','5.00','6.00'),
('109','TV-01','CV-01','1008','6.00','7.20'),
('110','TV-01','CV-01','1008','7.00','8.40'),
('111','TV-01','CV-01','1009','1.50','1.80'),
('112','TV-02','CV-01','1009','3.60','4.32'),
('113','TV-02','CV-02','1009','1.80','2.16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('114','TV-02','CV-01','1009','1.90','2.28'),
('115','TV-02','CV-02','1009','5.30','6.36'),
('116','TV-01','CV-01','1009','3.60','4.32'),
('117','TV-01','CV-02','1009','4.32','5.18'),
('118','TV-01','CV-01','1009','2.40','2.88'),
('119','TV-01','CV-02','1009','2.88','3.46'),
('120','TV-01','CV-01','1009','1.20','1.44'),
('121','TV-01','CV-02','1010','1.44','1.73');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('122','TV-02','CV-01','1010','1.72','2.06'),
('123','TV-02','CV-02','1010','20.60','24.72'),
('124','TV-02','CV-01','1010','2.06','2.47'),
('125','TV-02','CV-02','1010','1.50','1.80'),
('126','TV-02','CV-01','1011','1.80','2.16'),
('127','TV-02','CV-02','1011','1.09','1.31'),
('128','TV-01','CV-03','1011','1.05','1.26'),
('129','TV-01','CV-03','1011','1.26','1.51');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('130','TV-01','CV-03','1011','1.31','1.57'),
('131','TV-01','CV-04','1012','1.51','1.81'),
('132','TV-01','CV-05','1012','2.57','3.08'),
('133','TV-01','CV-01','1012','3.08','3.70'),
('134','TV-01','CV-01','1012','7.30','8.76'),
('135','TV-01','CV-01','1012','1.60','1.92'),
('136','TV-01','CV-01','1013','2.90','3.48'),
('137','TV-01','CV-01','1013','4.80','5.76');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('138','TV-01','CV-01','1013','1.05','1.26'),
('139','TV-01','CV-01','1013','1.07','1.28'),
('140','TV-01','CV-01','1013','2.08','2.50'),
('141','TV-01','CV-01','1014','2.09','2.51'),
('142','TV-01','CV-01','1014','20.70','24.84'),
('143','TV-01','CV-01','1014','20.60','24.72'),
('144','TV-01','CV-01','1014','2.06','2.47'),
('145','TV-02','CV-01','1014','2.08','2.50');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('146','TV-02','CV-01','1016','1.06','1.27'),
('147','TV-02','CV-01','1016','1.05','1.26'),
('148','TV-01','CV-02','1016','1.59','1.91'),
('149','TV-02','CV-02','1016','1.48','1.78'),
('150','TV-01','CV-02','1016','1.49','1.79'),
('151','TV-02','CV-02','1017','1.90','2.28'),
('152','TV-01','CV-02','1017','1.49','1.79'),
('153','TV-02','CV-02','1017','1.13','1.36');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('154','TV-01','CV-01','1017','1.49','1.79'),
('155','TV-02','CV-01','1017','1.89','2.27'),
('156','TV-01','CV-01','1018','1.82','2.18'),
('157','TV-02','CV-01','1018','1.36','1.63'),
('158','TV-01','CV-01','1018','1.78','2.14'),
('159','TV-02','CV-01','1018','1.79','2.15'),
('160','TV-01','CV-01','1018','1.65','1.98'),
('161','TV-01','CV-02','1019','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('162','TV-01','CV-01','1019','1.41','1.69'),
('163','TV-01','CV-02','1019','1.10','1.32'),
('164','TV-01','CV-01','1019','1.15','1.38'),
('165','TV-02','CV-02','1019','1.38','1.66'),
('166','TV-02','CV-01','1020','1.66','1.99'),
('167','TV-02','CV-02','1020','1.99','2.39'),
('168','TV-01','CV-01','1020','2.39','2.87'),
('169','TV-02','CV-02','1020','2.87','3.44');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('170','TV-01','CV-01','1020','4.40','5.28'),
('171','TV-02','CV-02','1021','4.60','5.52'),
('172','TV-01','CV-01','1021','4.85','5.82'),
('173','TV-02','CV-02','1021','1.90','2.28'),
('174','TV-01','CV-01','1021','1.98','2.38'),
('175','TV-02','CV-02','1021','1.49','1.79'),
('176','TV-01','CV-03','1022','2.49','2.99'),
('177','TV-02','CV-03','1022','1.19','1.43');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('178','TV-01','CV-03','1022','2.57','3.08'),
('179','TV-02','CV-04','1022','2.40','2.88'),
('180','TV-01','CV-05','1022','3.48','4.18'),
('181','TV-01','CV-02','1023','0.50','0.60'),
('182','TV-01','CV-02','1023','0.54','0.65'),
('183','TV-01','CV-02','1023','0.78','0.94'),
('184','TV-01','CV-02','1023','0.49','0.59'),
('185','TV-01','CV-02','1023','1.56','1.87');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('186','TV-01','CV-02','1024','1.94','2.33'),
('187','TV-01','CV-01','1024','0.89','1.07'),
('188','TV-01','CV-01','1024','1.06','1.27'),
('189','TV-01','CV-01','1024','1.08','1.30'),
('190','TV-01','CV-01','1024','1.59','1.91'),
('191','TV-01','CV-01','1025','2.59','3.11'),
('192','TV-01','CV-01','1025','2.20','2.64'),
('193','TV-01','CV-01','1025','3.19','3.83');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('194','TV-01','CV-02','1025','4.20','5.04'),
('195','TV-02','CV-01','1025','5.19','6.23'),
('196','TV-02','CV-02','1026','6.18','7.42'),
('197','TV-02','CV-01','1026','7.19','8.63'),
('198','TV-02','CV-02','1026','8.09','9.71'),
('199','TV-01','CV-01','1026','9.02','10.82'),
('200','TV-01','CV-02','1026','10.90','13.08'),
('201','TV-01','CV-01','1027','11.19','13.43');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('202','TV-02','CV-02','1027','12.50','15.00'),
('203','TV-02','CV-01','1027','13.89','16.67'),
('204','TV-02','CV-02','1027','14.19','17.03'),
('205','TV-02','CV-01','1027','15.19','18.23'),
('206','TV-01','CV-02','1027','16.09','19.31'),
('207','TV-01','CV-01','1027','1.00','1.20'),
('208','TV-01','CV-02','1028','2.00','2.40'),
('209','TV-01','CV-03','1028','3.00','3.60');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('210','TV-01','CV-03','1028','4.00','4.80'),
('211','TV-01','CV-03','1028','5.00','6.00'),
('212','TV-02','CV-04','1028','6.00','7.20'),
('213','TV-02','CV-05','1029','7.00','8.40'),
('214','TV-02','CV-02','1029','1.50','1.80'),
('215','TV-02','CV-02','1029','3.60','4.32'),
('216','TV-02','CV-02','1029','1.80','2.16'),
('217','TV-02','CV-02','1029','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('218','TV-01','CV-02','1029','5.30','6.36'),
('219','TV-01','CV-02','1029','3.60','4.32'),
('220','TV-01','CV-01','1029','4.32','5.18'),
('221','TV-01','CV-01','1030','2.40','2.88'),
('222','TV-01','CV-01','1030','2.88','3.46'),
('223','TV-01','CV-01','1030','1.20','1.44'),
('224','TV-01','CV-01','1030','1.44','1.73'),
('225','TV-01','CV-01','1030','1.72','2.06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('226','TV-01','CV-01','1031','20.60','24.72'),
('227','TV-01','CV-02','1031','2.06','2.47'),
('228','TV-01','CV-01','1031','1.50','1.80'),
('229','TV-01','CV-02','1031','1.80','2.16'),
('230','TV-01','CV-01','1031','1.09','1.31'),
('231','TV-01','CV-02','1031','1.05','1.26'),
('232','TV-01','CV-01','1032','1.26','1.51'),
('233','TV-01','CV-02','1032','1.31','1.57');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('234','TV-01','CV-01','1032','1.51','1.81'),
('235','TV-02','CV-02','1032','2.57','3.08'),
('236','TV-02','CV-01','1032','3.08','3.70'),
('237','TV-02','CV-02','1032','7.30','8.76'),
('238','TV-01','CV-01','1033','1.60','1.92'),
('239','TV-02','CV-02','1033','2.90','3.48'),
('240','TV-01','CV-01','1033','4.80','5.76'),
('241','TV-02','CV-02','1033','1.05','1.26');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('242','TV-01','CV-03','1033','1.07','1.28'),
('243','TV-02','CV-03','1033','2.08','2.50'),
('244','TV-01','CV-03','1034','2.09','2.51'),
('245','TV-02','CV-04','1034','20.70','24.84'),
('246','TV-01','CV-05','1034','20.60','24.72'),
('247','TV-02','CV-02','1034','2.06','2.47'),
('248','TV-01','CV-02','1034','2.08','2.50'),
('249','TV-02','CV-02','1034','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('250','TV-01','CV-02','1034','1.05','1.26'),
('251','TV-01','CV-02','1035','1.59','1.91'),
('252','TV-01','CV-02','1036','1.48','1.78'),
('253','TV-01','CV-01','1037','1.49','1.79'),
('254','TV-01','CV-01','1038','1.90','2.28'),
('255','TV-02','CV-01','1039','1.49','1.79'),
('256','TV-02','CV-01','1040','1.13','1.36'),
('257','TV-02','CV-01','1041','1.49','1.79'),
('258','TV-01','CV-01','1042','1.89','2.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('259','TV-02','CV-01','1043','1.82','2.18'),
('260','TV-01','CV-02','1044','1.36','1.63'),
('261','TV-02','CV-01','1045','1.78','2.14'),
('262','TV-01','CV-02','1046','1.79','2.15'),
('263','TV-02','CV-01','1047','1.65','1.98'),
('264','TV-01','CV-02','1048','1.50','1.80'),
('265','TV-02','CV-01','1049','1.41','1.69'),
('266','TV-01','CV-02','1050','1.10','1.32');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('267','TV-02','CV-01','1051','1.15','1.38'),
('268','TV-01','CV-02','1052','1.38','1.66'),
('269','TV-02','CV-01','1053','1.66','1.99'),
('270','TV-01','CV-02','1054','1.99','2.39'),
('271','TV-01','CV-01','1055','2.39','2.87'),
('272','TV-01','CV-02','1056','2.87','3.44'),
('273','TV-01','CV-01','1057','4.40','5.28'),
('274','TV-01','CV-02','1058','4.60','5.52');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('275','TV-01','CV-03','1059','4.85','5.82'),
('276','TV-01','CV-03','1060','1.90','2.28'),
('277','TV-01','CV-03','1061','1.98','2.38'),
('278','TV-01','CV-04','1062','1.49','1.79'),
('279','TV-01','CV-05','1063','2.49','2.99'),
('280','TV-01','CV-01','1064','1.19','1.43'),
('281','TV-01','CV-01','1065','2.57','3.08'),
('282','TV-01','CV-01','1066','2.40','2.88');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('283','TV-01','CV-01','1067','3.48','4.18'),
('284','TV-01','CV-01','1068','0.50','0.60'),
('285','TV-02','CV-01','1069','0.54','0.65'),
('286','TV-02','CV-01','1070','0.78','0.94'),
('287','TV-02','CV-01','1071','0.49','0.59'),
('288','TV-02','CV-01','1072','1.56','1.87'),
('289','TV-01','CV-01','1073','1.94','2.33'),
('290','TV-01','CV-01','1074','0.89','1.07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('291','TV-01','CV-01','1075','1.06','1.27'),
('292','TV-02','CV-01','1076','1.08','1.30'),
('293','TV-02','CV-01','1077','1.59','1.91'),
('294','TV-02','CV-01','1078','2.59','3.11'),
('295','TV-02','CV-02','1079','2.20','2.64'),
('296','TV-01','CV-03','1080','3.19','3.83'),
('297','TV-01','CV-04','1081','4.20','5.04'),
('298','TV-01','CV-05','1082','5.19','6.23');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('299','TV-01','CV-02','1083','6.18','7.42'),
('300','TV-01','CV-01','1084','7.19','8.63'),
('301','TV-01','CV-02','1085','8.09','9.71'),
('302','TV-02','CV-03','1086','9.02','10.82'),
('303','TV-02','CV-03','1087','10.90','13.08'),
('304','TV-02','CV-03','1088','11.19','13.43'),
('305','TV-02','CV-04','1089','12.50','15.00'),
('306','TV-02','CV-05','1090','13.89','16.67');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('307','TV-02','CV-01','1091','14.19','17.03'),
('308','TV-01','CV-01','1092','15.19','18.23'),
('309','TV-01','CV-01','1093','16.09','19.31'),
('310','TV-01','CV-01','1094','1.00','1.20'),
('311','TV-01','CV-01','1095','2.00','2.40'),
('312','TV-01','CV-01','1096','3.00','3.60'),
('313','TV-01','CV-01','1097','4.00','4.80'),
('314','TV-01','CV-01','1098','5.00','6.00');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('315','TV-01','CV-01','1099','6.00','7.20'),
('316','TV-01','CV-01','1100','7.00','8.40'),
('317','TV-01','CV-01','1101','1.50','1.80'),
('318','TV-01','CV-01','1102','3.60','4.32'),
('319','TV-01','CV-01','1103','1.80','2.16'),
('320','TV-01','CV-01','1104','1.90','2.28'),
('321','TV-01','CV-01','1105','5.30','6.36'),
('322','TV-01','CV-02','1106','3.60','4.32');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('323','TV-01','CV-03','1107','4.32','5.18'),
('324','TV-01','CV-04','1108','2.40','2.88'),
('325','TV-02','CV-05','1109','2.88','3.46'),
('326','TV-02','CV-02','1110','1.20','1.44'),
('327','TV-02','CV-01','1111','1.44','1.73'),
('328','TV-01','CV-02','1112','1.72','2.06'),
('329','TV-02','CV-03','1113','20.60','24.72'),
('330','TV-01','CV-03','1114','2.06','2.47');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('331','TV-02','CV-03','1115','1.50','1.80'),
('332','TV-01','CV-04','1116','1.80','2.16'),
('333','TV-02','CV-05','1117','1.09','1.31'),
('334','TV-01','CV-01','1118','1.05','1.26'),
('335','TV-02','CV-01','1119','1.26','1.51'),
('336','TV-01','CV-01','1120','1.31','1.57'),
('337','TV-02','CV-01','1121','1.51','1.81'),
('338','TV-01','CV-01','1122','2.57','3.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('339','TV-02','CV-01','1123','3.08','3.70'),
('340','TV-01','CV-01','1124','7.30','8.76'),
('341','TV-01','CV-01','1125','1.60','1.92'),
('342','TV-01','CV-01','1126','2.90','3.48'),
('343','TV-01','CV-01','1127','4.80','5.76'),
('344','TV-01','CV-01','1128','1.05','1.26'),
('345','TV-02','CV-01','1129','1.07','1.28'),
('346','TV-02','CV-01','1130','2.08','2.50');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('347','TV-02','CV-01','1131','2.09','2.51'),
('348','TV-01','CV-01','1132','20.70','24.84'),
('349','TV-02','CV-02','1133','20.60','24.72'),
('350','TV-01','CV-03','1134','2.06','2.47'),
('351','TV-02','CV-04','1135','2.08','2.50'),
('352','TV-01','CV-05','1136','1.06','1.27'),
('353','TV-02','CV-02','1137','1.05','1.26'),
('354','TV-01','CV-02','1138','1.59','1.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('355','TV-02','CV-02','1139','1.48','1.78'),
('356','TV-01','CV-02','1140','1.49','1.79'),
('357','TV-02','CV-02','1141','1.90','2.28'),
('358','TV-01','CV-02','1142','1.49','1.79'),
('359','TV-02','CV-01','1143','1.13','1.36'),
('360','TV-01','CV-01','1144','1.49','1.79'),
('361','TV-01','CV-01','1145','1.89','2.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('362','TV-01','CV-01','1146','1.82','2.18'),
('363','TV-01','CV-01','1147','1.36','1.63'),
('364','TV-01','CV-01','1148','1.78','2.14'),
('365','TV-01','CV-01','1149','1.79','2.15'),
('366','TV-01','CV-02','1150','1.65','1.98'),
('367','TV-01','CV-01','1151','1.50','1.80'),
('368','TV-01','CV-02','1152','1.41','1.69'),
('369','TV-01','CV-01','1153','1.10','1.32');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('370','TV-01','CV-02','1154','1.15','1.38'),
('371','TV-01','CV-01','1155','1.38','1.66'),
('372','TV-01','CV-02','1156','1.66','1.99'),
('373','TV-01','CV-01','1157','1.99','2.39'),
('374','TV-01','CV-02','1158','2.39','2.87'),
('375','TV-02','CV-01','1159','2.87','3.44'),
('376','TV-02','CV-02','1160','4.40','5.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('377','TV-02','CV-01','1161','4.60','5.52'),
('378','TV-02','CV-02','1162','4.85','5.82'),
('379','TV-01','CV-01','1163','1.90','2.28'),
('380','TV-01','CV-02','1164','1.98','2.38'),
('381','TV-01','CV-03','1165','1.49','1.79'),
('382','TV-02','CV-03','1166','2.49','2.99'),
('383','TV-02','CV-03','1167','1.19','1.43');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('384','TV-02','CV-04','1168','2.57','3.08'),
('385','TV-02','CV-05','1169','2.40','2.88'),
('386','TV-01','CV-02','1170','3.48','4.18'),
('387','TV-01','CV-02','1171','0.50','0.60'),
('388','TV-01','CV-02','1172','0.54','0.65'),
('389','TV-01','CV-02','1173','0.78','0.94'),
('390','TV-01','CV-02','1174','0.49','0.59'),
('391','TV-01','CV-02','1175','1.56','1.87');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('392','TV-02','CV-01','1176','1.94','2.33'),
('393','TV-02','CV-01','1177','0.89','1.07'),
('394','TV-02','CV-01','1178','1.06','1.27'),
('395','TV-02','CV-01','1179','1.08','1.30'),
('396','TV-02','CV-01','1180','1.59','1.91'),
('397','TV-02','CV-01','1181','2.59','3.11'),
('398','TV-01','CV-01','1182','2.20','2.64'),
('399','TV-01','CV-02','1183','3.19','3.83');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('400','TV-01','CV-01','1184','4.20','5.04'),
('401','TV-01','CV-02','1185','5.19','6.23'),
('402','TV-01','CV-01','1186','6.18','7.42'),
('403','TV-01','CV-02','1187','7.19','8.63'),
('404','TV-01','CV-01','1188','8.09','9.71'),
('405','TV-01','CV-02','1189','9.02','10.82'),
('406','TV-01','CV-01','1190','10.90','13.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('407','TV-01','CV-02','1191','11.19','13.43'),
('408','TV-01','CV-01','1192','12.50','15.00'),
('409','TV-01','CV-02','1193','13.89','16.67'),
('410','TV-01','CV-01','1194','14.19','17.03'),
('411','TV-01','CV-02','1195','15.19','18.23'),
('412','TV-01','CV-01','1196','16.09','19.31'),
('413','TV-01','CV-02','1197','4.13','4.96');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('414','TV-01','CV-03','1198','13.40','16.08'),
('415','TV-02','CV-03','1199','2.49','2.99'),
('416','TV-02','CV-03','1200','1.50','1.80'),
('417','TV-02','CV-04','1201','1.49','1.79'),
('418','TV-01','CV-05','1202','1.90','2.28'),
('419','TV-02','CV-02','1203','1.99','2.39'),
('420','TV-01','CV-02','1204','2.09','2.51');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('421','TV-02','CV-02','1205','0.79','0.95'),
('422','TV-01','CV-02','1206','0.98','1.18'),
('423','TV-02','CV-02','1207','0.70','0.84'),
('424','TV-01','CV-02','1208','1.19','1.43'),
('425','TV-02','CV-01','1209','1.98','2.38'),
('426','TV-01','CV-01','1210','1.89','2.27'),
('427','TV-02','CV-01','1211','8.19','9.83'),
('428','TV-01','CV-01','1212','0.89','1.07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('429','TV-02','CV-01','1213','1.45','1.74'),
('430','TV-01','CV-01','1214','1.05','1.26'),
('431','TV-01','CV-01','1215','1.50','1.80'),
('432','TV-01','CV-02','1216','1.98','2.38'),
('433','TV-01','CV-01','1217','1.89','2.27'),
('434','TV-01','CV-02','1218','1.89','2.27'),
('435','TV-02','CV-01','1219','1.98','2.37'),
('436','TV-02','CV-02','1220','1.40','1.68');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('437','TV-02','CV-01','1221','1.20','1.44'),
('438','TV-01','CV-02','1222','1.89','2.27'),
('439','TV-02','CV-01','1223','1.80','2.16'),
('440','TV-01','CV-02','1224','1.50','1.80'),
('441','TV-02','CV-01','1225','1.50','1.80'),
('442','TV-01','CV-02','1226','1.79','2.15'),
('443','TV-02','CV-01','1227','2.49','2.99'),
('444','TV-01','CV-02','1228','1.98','2.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('445','TV-02','CV-01','1229','1.49','1.79'),
('446','TV-01','CV-02','1230','2.08','2.50'),
('447','TV-02','CV-03','1231','3.09','3.70'),
('448','TV-01','CV-03','1232','5.07','6.08'),
('449','TV-02','CV-03','1233','5.09','6.11'),
('450','TV-01','CV-04','1234','2.09','2.51'),
('451','TV-01','CV-05','1235','3.81','4.57'),
('452','TV-02','CV-02','1236','4.09','4.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('453','TV-01','CV-02','1237','1.08','1.30'),
('454','TV-01','CV-02','1238','1.48','1.78'),
('455','TV-02','CV-02','1239','1.78','2.14'),
('456','TV-01','CV-02','1240','1.90','2.28'),
('457','TV-02','CV-02','1241','1.09','1.31'),
('458','TV-01','CV-01','1242','2.90','3.48'),
('459','TV-02','CV-01','1243','2.79','3.35'),
('460','TV-01','CV-01','1244','3.80','4.56');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('461','TV-02','CV-01','1245','2.98','3.58'),
('462','TV-01','CV-01','1246','3.98','4.78'),
('463','TV-02','CV-01','1247','1.74','2.09'),
('464','TV-01','CV-01','1248','1.50','1.80'),
('465','TV-02','CV-02','1249','1.30','1.56'),
('466','TV-01','CV-01','1250','1.01','1.21'),
('467','TV-02','CV-02','1251','1.02','1.22');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('468','TV-01','CV-01','1252','1.03','1.24'),
('469','TV-02','CV-02','1253','1.04','1.25'),
('470','TV-01','CV-01','1254','1.05','1.26'),
('471','TV-01','CV-02','1255','1.06','1.27'),
('472','TV-01','CV-01','1256','1.07','1.28'),
('473','TV-01','CV-02','1257','1.08','1.30'),
('474','TV-01','CV-01','1258','1.09','1.31'),
('475','TV-01','CV-02','1259','1.10','1.32');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('476','TV-01','CV-01','1260','1.00','1.20'),
('477','TV-01','CV-02','1261','2.00','2.40'),
('478','TV-01','CV-01','1262','3.00','3.60'),
('479','TV-01','CV-02','1263','4.00','4.80'),
('480','TV-01','CV-03','1264','5.00','6.00'),
('481','TV-01','CV-03','1265','6.00','7.20'),
('482','TV-01','CV-03','1266','7.00','8.40');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('483','TV-01','CV-04','1267','1.50','1.80'),
('484','TV-01','CV-05','1268','3.60','4.32'),
('485','TV-01','CV-01','1269','1.80','2.16'),
('486','TV-02','CV-01','1270','1.90','2.28'),
('487','TV-02','CV-01','1271','5.30','6.36'),
('488','TV-02','CV-01','1272','3.60','4.32'),
('489','TV-02','CV-01','1273','4.32','5.18'),
('490','TV-01','CV-01','1274','2.40','2.88');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('491','TV-01','CV-01','1275','2.88','3.46'),
('492','TV-01','CV-01','1276','1.20','1.44'),
('493','TV-02','CV-01','1277','1.44','1.73'),
('494','TV-02','CV-01','1278','1.72','2.06'),
('495','TV-02','CV-01','1279','20.60','24.72'),
('496','TV-02','CV-01','1280','2.06','2.47'),
('497','TV-01','CV-01','1281','1.50','1.80'),
('498','TV-01','CV-01','1281','1.80','2.16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('499','TV-01','CV-01','1281','1.09','1.31'),
('500','TV-01','CV-02','1281','1.05','1.26'),
('501','TV-01','CV-02','1281','1.26','1.51'),
('502','TV-01','CV-02','1281','1.31','1.57'),
('503','TV-02','CV-02','1281','1.51','1.81'),
('504','TV-02','CV-02','1281','2.57','3.08'),
('505','TV-02','CV-02','1281','3.08','3.70');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('506','TV-02','CV-01','1282','7.30','8.76'),
('507','TV-02','CV-01','1282','1.60','1.92'),
('508','TV-02','CV-01','1282','2.90','3.48'),
('509','TV-01','CV-01','1282','4.80','5.76'),
('510','TV-01','CV-01','1282','1.05','1.26'),
('511','TV-01','CV-01','1282','1.07','1.28'),
('512','TV-01','CV-01','1282','2.08','2.50'),
('513','TV-01','CV-02','1282','2.09','2.51');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('514','TV-01','CV-01','1282','20.70','24.84'),
('515','TV-01','CV-02','1282','20.60','24.72'),
('516','TV-01','CV-01','1283','2.06','2.47'),
('517','TV-01','CV-02','1283','2.08','2.50'),
('518','TV-01','CV-01','1283','1.06','1.27'),
('519','TV-01','CV-02','1283','1.05','1.26'),
('520','TV-01','CV-01','1283','1.59','1.91'),
('521','TV-01','CV-02','1283','1.48','1.78');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('522','TV-01','CV-01','1283','1.49','1.79'),
('523','TV-01','CV-02','1283','1.90','2.28'),
('524','TV-01','CV-01','1283','1.49','1.79'),
('525','TV-01','CV-02','1284','1.13','1.36'),
('526','TV-02','CV-01','1284','1.49','1.79'),
('527','TV-02','CV-02','1284','1.89','2.27'),
('528','TV-02','CV-03','1284','1.82','2.18'),
('529','TV-01','CV-03','1284','1.36','1.63');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('530','TV-02','CV-03','1284','1.78','2.14'),
('531','TV-01','CV-04','1284','1.79','2.15'),
('532','TV-02','CV-05','1284','1.65','1.98'),
('533','TV-01','CV-02','1284','1.50','1.80'),
('534','TV-02','CV-02','1284','1.41','1.69'),
('535','TV-01','CV-02','1284','1.10','1.32'),
('536','TV-02','CV-02','1284','1.15','1.38'),
('537','TV-01','CV-02','1285','1.38','1.66');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('538','TV-02','CV-02','1285','1.66','1.99'),
('539','TV-01','CV-01','1285','1.99','2.39'),
('540','TV-02','CV-01','1285','2.39','2.87'),
('541','TV-01','CV-01','1285','2.87','3.44'),
('542','TV-01','CV-01','1285','4.40','5.28'),
('543','TV-01','CV-01','1285','4.60','5.52'),
('544','TV-01','CV-01','1285','4.85','5.82'),
('545','TV-01','CV-01','1285','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('546','TV-02','CV-02','1285','1.98','2.38'),
('547','TV-02','CV-01','1285','1.49','1.79'),
('548','TV-02','CV-02','1285','2.49','2.99'),
('549','TV-01','CV-01','1285','1.19','1.43'),
('550','TV-02','CV-02','1285','2.57','3.08'),
('551','TV-01','CV-01','1285','2.40','2.88'),
('552','TV-02','CV-02','1285','3.48','4.18'),
('553','TV-01','CV-01','1286','0.50','0.60');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('554','TV-02','CV-02','1286','0.54','0.65'),
('555','TV-01','CV-01','1286','0.78','0.94'),
('556','TV-02','CV-02','1286','0.49','0.59'),
('557','TV-01','CV-01','1286','1.56','1.87'),
('558','TV-02','CV-02','1286','1.94','2.33'),
('559','TV-01','CV-01','1287','0.89','1.07'),
('560','TV-02','CV-02','1287','1.06','1.27'),
('561','TV-01','CV-03','1287','1.08','1.30');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('562','TV-01','CV-03','1287','1.59','1.91'),
('563','TV-02','CV-03','1287','2.59','3.11'),
('564','TV-01','CV-04','1287','2.20','2.64'),
('565','TV-01','CV-05','1287','3.19','3.83'),
('566','TV-02','CV-02','1288','4.20','5.04'),
('567','TV-01','CV-02','1288','5.19','6.23'),
('568','TV-02','CV-02','1288','6.18','7.42'),
('569','TV-01','CV-02','1288','7.19','8.63');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('570','TV-02','CV-02','1288','8.09','9.71'),
('571','TV-01','CV-02','1288','9.02','10.82'),
('572','TV-02','CV-01','1288','10.90','13.08'),
('573','TV-01','CV-01','1288','11.19','13.43'),
('574','TV-02','CV-01','1289','12.50','15.00'),
('575','TV-01','CV-01','1289','13.89','16.67'),
('576','TV-02','CV-01','1289','14.19','17.03'),
('577','TV-01','CV-01','1289','15.19','18.23');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('578','TV-02','CV-01','1289','16.09','19.31'),
('579','TV-01','CV-02','1289','1.00','1.20'),
('580','TV-02','CV-01','1289','2.00','2.40'),
('581','TV-01','CV-02','1290','3.00','3.60'),
('582','TV-01','CV-01','1290','4.00','4.80'),
('583','TV-01','CV-02','1290','5.00','6.00'),
('584','TV-01','CV-01','1290','6.00','7.20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('585','TV-01','CV-02','1290','7.00','8.40'),
('586','TV-01','CV-01','1290','1.50','1.80'),
('587','TV-01','CV-02','1291','3.60','4.32'),
('588','TV-01','CV-01','1291','1.80','2.16'),
('589','TV-01','CV-02','1291','1.90','2.28'),
('590','TV-01','CV-01','1291','5.30','6.36'),
('591','TV-01','CV-02','1291','3.60','4.32'),
('592','TV-01','CV-01','1291','4.32','5.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('593','TV-01','CV-02','1292','2.40','2.88'),
('594','TV-01','CV-03','1292','2.88','3.46'),
('595','TV-01','CV-03','1292','1.20','1.44'),
('596','TV-01','CV-03','1292','1.44','1.73'),
('597','TV-02','CV-04','1292','1.72','2.06'),
('598','TV-02','CV-05','1292','20.60','24.72'),
('599','TV-02','CV-02','1292','2.06','2.47'),
('600','TV-02','CV-02','1292','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('601','TV-01','CV-02','1292','1.80','2.16'),
('602','TV-01','CV-02','1293','1.09','1.31'),
('603','TV-01','CV-02','1293','1.05','1.26'),
('604','TV-02','CV-02','1293','1.26','1.51'),
('605','TV-02','CV-01','1293','1.31','1.57'),
('606','TV-02','CV-01','1293','1.51','1.81'),
('607','TV-02','CV-01','1294','2.57','3.08'),
('608','TV-01','CV-01','1294','3.08','3.70');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('609','TV-01','CV-01','1294','7.30','8.76'),
('610','TV-01','CV-01','1294','1.60','1.92'),
('611','TV-01','CV-01','1294','2.90','3.48'),
('612','TV-01','CV-02','1294','4.80','5.76'),
('613','TV-01','CV-01','1295','1.05','1.26'),
('614','TV-02','CV-02','1295','1.07','1.28'),
('615','TV-02','CV-01','1295','2.08','2.50');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('616','TV-02','CV-02','1295','2.09','2.51'),
('617','TV-02','CV-01','1295','20.70','24.84'),
('618','TV-02','CV-02','1295','20.60','24.72'),
('619','TV-02','CV-01','1295','2.06','2.47'),
('620','TV-01','CV-02','1295','2.08','2.50'),
('621','TV-01','CV-01','1296','1.06','1.27'),
('622','TV-01','CV-02','1296','1.05','1.26'),
('623','TV-01','CV-01','1296','1.59','1.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('624','TV-01','CV-02','1296','1.48','1.78'),
('625','TV-01','CV-01','1296','1.49','1.79'),
('626','TV-01','CV-02','1296','1.90','2.28'),
('627','TV-01','CV-03','1296','1.49','1.79'),
('628','TV-01','CV-03','1296','1.13','1.36'),
('629','TV-01','CV-03','1297','1.49','1.79'),
('630','TV-01','CV-04','1297','1.89','2.27'),
('631','TV-01','CV-05','1297','1.82','2.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('632','TV-01','CV-01','1297','1.36','1.63'),
('633','TV-01','CV-01','1297','1.78','2.14'),
('634','TV-01','CV-01','1297','1.79','2.15'),
('635','TV-01','CV-01','1297','1.65','1.98'),
('636','TV-01','CV-01','1297','1.50','1.80'),
('637','TV-02','CV-01','1297','1.41','1.69'),
('638','TV-02','CV-01','1297','1.10','1.32'),
('639','TV-02','CV-01','1298','1.15','1.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('640','TV-01','CV-01','1298','1.38','1.66'),
('641','TV-02','CV-01','1298','1.66','1.99'),
('642','TV-01','CV-01','1298','1.99','2.39'),
('643','TV-02','CV-01','1298','2.39','2.87'),
('644','TV-01','CV-01','1298','2.87','3.44'),
('645','TV-02','CV-01','1299','4.40','5.28'),
('646','TV-01','CV-01','1299','4.60','5.52'),
('647','TV-02','CV-02','1299','4.85','5.82'),
('648','TV-01','CV-03','1299','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('649','TV-02','CV-04','1299','1.98','2.38'),
('650','TV-01','CV-05','1299','1.49','1.79'),
('651','TV-02','CV-02','1299','2.49','2.99'),
('652','TV-01','CV-01','1299','1.19','1.43'),
('653','TV-01','CV-02','1299','2.57','3.08'),
('654','TV-01','CV-03','1300','2.40','2.88'),
('655','TV-01','CV-03','1300','3.48','4.18'),
('656','TV-01','CV-03','1300','0.50','0.60'),
('657','TV-02','CV-04','1300','0.54','0.65');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('658','TV-02','CV-05','1300','0.78','0.94'),
('659','TV-02','CV-01','1300','0.49','0.59'),
('660','TV-01','CV-01','1300','1.56','1.87'),
('661','TV-02','CV-01','1300','1.94','2.33'),
('662','TV-01','CV-01','1300','0.89','1.07'),
('663','TV-02','CV-01','1300','1.06','1.27'),
('664','TV-01','CV-01','1301','1.08','1.30'),
('665','TV-02','CV-01','1302','1.59','1.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('666','TV-01','CV-01','1303','2.59','3.11'),
('667','TV-02','CV-01','1304','2.20','2.64'),
('668','TV-01','CV-01','1305','3.19','3.83'),
('669','TV-02','CV-01','1306','4.20','5.04'),
('670','TV-01','CV-01','1307','5.19','6.23'),
('671','TV-02','CV-01','1308','6.18','7.42'),
('672','TV-01','CV-01','1309','7.19','8.63'),
('673','TV-01','CV-01','1310','8.09','9.71'),
('674','TV-02','CV-02','1311','9.02','10.82');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('675','TV-01','CV-03','1312','10.90','13.08'),
('676','TV-01','CV-04','1313','11.19','13.43'),
('677','TV-02','CV-05','1314','12.50','15.00'),
('678','TV-01','CV-02','1315','13.89','16.67'),
('679','TV-02','CV-01','1316','14.19','17.03'),
('680','TV-01','CV-02','1317','15.19','18.23'),
('681','TV-02','CV-03','1318','16.09','19.31'),
('682','TV-01','CV-03','1319','1.00','1.20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('683','TV-02','CV-03','1320','2.00','2.40'),
('684','TV-01','CV-04','1321','3.00','3.60'),
('685','TV-02','CV-05','1322','4.00','4.80'),
('686','TV-01','CV-01','1323','5.00','6.00'),
('687','TV-02','CV-01','1324','6.00','7.20'),
('688','TV-01','CV-01','1325','7.00','8.40'),
('689','TV-02','CV-01','1326','1.50','1.80'),
('690','TV-01','CV-01','1327','3.60','4.32'),
('691','TV-02','CV-01','1328','1.80','2.16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('692','TV-01','CV-01','1329','1.90','2.28'),
('693','TV-01','CV-01','1330','5.30','6.36'),
('694','TV-01','CV-01','1331','3.60','4.32'),
('695','TV-01','CV-01','1332','4.32','5.18'),
('696','TV-01','CV-01','1333','2.40','2.88'),
('697','TV-01','CV-01','1334','2.88','3.46'),
('698','TV-01','CV-01','1335','1.20','1.44'),
('699','TV-01','CV-01','1336','1.44','1.73');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('700','TV-01','CV-01','1337','1.72','2.06'),
('701','TV-01','CV-02','1338','20.60','24.72'),
('702','TV-01','CV-03','1339','2.06','2.47'),
('703','TV-01','CV-04','1340','1.50','1.80'),
('704','TV-01','CV-05','1341','1.80','2.16'),
('705','TV-01','CV-02','1342','1.09','1.31'),
('706','TV-01','CV-02','1343','1.05','1.26'),
('707','TV-02','CV-02','1344','1.26','1.51');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('708','TV-02','CV-02','1345','1.31','1.57'),
('709','TV-02','CV-02','1346','1.51','1.81'),
('710','TV-02','CV-02','1347','2.57','3.08'),
('711','TV-01','CV-01','1348','3.08','3.70'),
('712','TV-01','CV-01','1349','7.30','8.76'),
('713','TV-01','CV-01','1350','1.60','1.92'),
('714','TV-02','CV-01','1351','2.90','3.48'),
('715','TV-02','CV-01','1352','4.80','5.76');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('716','TV-02','CV-01','1353','1.05','1.26'),
('717','TV-02','CV-01','1354','1.07','1.28'),
('718','TV-01','CV-02','1355','2.08','2.50'),
('719','TV-01','CV-01','1356','2.09','2.51'),
('720','TV-01','CV-02','1357','20.70','24.84'),
('721','TV-01','CV-01','1358','20.60','24.72'),
('722','TV-01','CV-02','1359','2.06','2.47'),
('723','TV-01','CV-01','1360','2.08','2.50'),
('724','TV-02','CV-02','1361','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('725','TV-02','CV-01','1362','1.05','1.26'),
('726','TV-02','CV-02','1363','1.59','1.91'),
('727','TV-02','CV-01','1364','1.48','1.78'),
('728','TV-02','CV-02','1365','1.49','1.79'),
('729','TV-02','CV-01','1366','1.90','2.28'),
('730','TV-01','CV-02','1367','1.49','1.79'),
('731','TV-01','CV-01','1368','1.13','1.36'),
('732','TV-01','CV-02','1369','1.49','1.79');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('733','TV-01','CV-03','1370','1.89','2.27'),
('734','TV-01','CV-03','1371','1.82','2.18'),
('735','TV-01','CV-03','1372','1.36','1.63'),
('736','TV-01','CV-04','1373','1.78','2.14'),
('737','TV-01','CV-05','1374','1.79','2.15'),
('738','TV-01','CV-02','1375','1.65','1.98'),
('739','TV-01','CV-02','1376','1.50','1.80'),
('740','TV-01','CV-02','1377','1.41','1.69');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('741','TV-01','CV-02','1378','1.10','1.32'),
('742','TV-01','CV-02','1379','1.15','1.38'),
('743','TV-01','CV-02','1380','1.38','1.66'),
('744','TV-01','CV-02','1381','1.66','1.99'),
('745','TV-01','CV-02','1382','1.99','2.39'),
('746','TV-01','CV-02','1383','2.39','2.87'),
('747','TV-02','CV-02','1384','2.87','3.44'),
('748','TV-02','CV-02','1385','4.40','5.28'),
('749','TV-02','CV-02','1386','4.60','5.52');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('750','TV-01','CV-01','1387','4.85','5.82'),
('751','TV-02','CV-01','1388','1.90','2.28'),
('752','TV-01','CV-01','1389','1.98','2.38'),
('753','TV-02','CV-01','1390','1.49','1.79'),
('754','TV-01','CV-01','1391','2.49','2.99'),
('755','TV-02','CV-01','1392','1.19','1.43'),
('756','TV-01','CV-01','1393','2.57','3.08'),
('757','TV-02','CV-02','1394','2.40','2.88'),
('758','TV-01','CV-01','1395','3.48','4.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('759','TV-02','CV-02','1396','0.50','0.60'),
('760','TV-01','CV-01','1397','0.54','0.65'),
('761','TV-02','CV-02','1398','0.78','0.94'),
('762','TV-01','CV-01','1399','0.49','0.59'),
('763','TV-01','CV-02','1400','1.56','1.87'),
('764','TV-01','CV-01','1401','1.94','2.33'),
('765','TV-01','CV-02','1402','0.89','1.07'),
('766','TV-01','CV-01','1403','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('767','TV-02','CV-02','1404','1.08','1.30'),
('768','TV-02','CV-01','1405','1.59','1.91'),
('769','TV-02','CV-02','1406','2.59','3.11'),
('770','TV-01','CV-01','1407','2.20','2.64'),
('771','TV-02','CV-02','1408','3.19','3.83'),
('772','TV-01','CV-03','1409','4.20','5.04'),
('773','TV-02','CV-03','1410','5.19','6.23'),
('774','TV-01','CV-03','1411','6.18','7.42');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('775','TV-02','CV-04','1412','7.19','8.63'),
('776','TV-01','CV-05','1413','8.09','9.71'),
('777','TV-02','CV-02','1414','9.02','10.82'),
('778','TV-01','CV-02','1415','10.90','13.08'),
('779','TV-02','CV-02','1416','11.19','13.43'),
('780','TV-01','CV-02','1417','12.50','15.00'),
('781','TV-02','CV-02','1418','13.89','16.67'),
('782','TV-01','CV-02','1419','14.19','17.03');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('783','TV-01','CV-02','1420','15.19','18.23'),
('784','TV-01','CV-02','1421','16.09','19.31'),
('785','TV-01','CV-02','1422','1.00','1.20'),
('786','TV-01','CV-02','1423','2.00','2.40'),
('787','TV-01','CV-02','1424','3.00','3.60'),
('788','TV-01','CV-02','1425','4.00','4.80'),
('789','TV-01','CV-01','1426','5.00','6.00'),
('790','TV-01','CV-01','1427','6.00','7.20');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('791','TV-01','CV-01','1428','7.00','8.40'),
('792','TV-01','CV-01','1429','1.50','1.80'),
('793','TV-01','CV-01','1430','3.60','4.32'),
('794','TV-01','CV-01','1431','1.80','2.16'),
('795','TV-01','CV-01','1432','1.90','2.28'),
('796','TV-01','CV-02','1433','5.30','6.36'),
('797','TV-02','CV-01','1434','3.60','4.32'),
('798','TV-02','CV-02','1435','4.32','5.18'),
('799','TV-02','CV-01','1436','2.40','2.88');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('800','TV-02','CV-02','1437','2.88','3.46'),
('801','TV-01','CV-01','1438','1.20','1.44'),
('802','TV-01','CV-02','1439','1.44','1.73'),
('803','TV-01','CV-01','1440','1.72','2.06'),
('804','TV-02','CV-02','1441','20.60','24.72'),
('805','TV-02','CV-01','1442','2.06','2.47'),
('806','TV-02','CV-02','1443','1.50','1.80'),
('807','TV-02','CV-01','1444','1.80','2.16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('808','TV-01','CV-02','1445','1.09','1.31'),
('809','TV-01','CV-01','1446','1.05','1.26'),
('810','TV-01','CV-02','1447','1.26','1.51'),
('811','TV-01','CV-03','1448','1.31','1.57'),
('812','TV-01','CV-03','1449','1.51','1.81'),
('813','TV-01','CV-03','1450','2.57','3.08'),
('814','TV-02','CV-04','1451','3.08','3.70'),
('815','TV-02','CV-05','1452','7.30','8.76');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('816','TV-02','CV-02','1453','1.60','1.92'),
('817','TV-02','CV-02','1454','2.90','3.48'),
('818','TV-02','CV-02','1455','4.80','5.76'),
('819','TV-02','CV-02','1456','1.05','1.26'),
('820','TV-01','CV-02','1457','1.07','1.28'),
('821','TV-01','CV-02','1458','2.08','2.50'),
('822','TV-01','CV-01','1459','2.09','2.51'),
('823','TV-01','CV-01','1460','20.70','24.84'),
('824','TV-01','CV-01','1461','20.60','24.72');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('825','TV-01','CV-01','1462','2.06','2.47'),
('826','TV-01','CV-01','1463','2.08','2.50'),
('827','TV-01','CV-01','1464','1.06','1.27'),
('828','TV-01','CV-01','1465','1.05','1.26'),
('829','TV-01','CV-02','1466','1.59','1.91'),
('830','TV-01','CV-01','1467','1.48','1.78'),
('831','TV-01','CV-02','1468','1.49','1.79');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('832','TV-01','CV-01','1469','1.90','2.28'),
('833','TV-01','CV-02','1470','1.49','1.79'),
('834','TV-01','CV-01','1471','1.13','1.36'),
('835','TV-01','CV-02','1472','1.49','1.79'),
('836','TV-01','CV-01','1473','1.89','2.27'),
('837','TV-02','CV-02','1474','1.82','2.18'),
('838','TV-02','CV-01','1475','1.36','1.63');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('839','TV-02','CV-02','1476','1.78','2.14'),
('840','TV-01','CV-01','1477','1.79','2.15'),
('841','TV-02','CV-02','1478','1.65','1.98'),
('842','TV-01','CV-01','1479','1.50','1.80'),
('843','TV-02','CV-02','1480','1.41','1.69'),
('844','TV-01','CV-03','1481','1.10','1.32'),
('845','TV-02','CV-03','1482','1.15','1.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('846','TV-01','CV-03','1483','1.38','1.66'),
('847','TV-02','CV-04','1484','1.66','1.99'),
('848','TV-01','CV-05','1485','1.99','2.39'),
('849','TV-02','CV-02','1486','2.39','2.87'),
('850','TV-01','CV-02','1487','2.87','3.44'),
('851','TV-02','CV-02','1488','4.40','5.28'),
('852','TV-01','CV-02','1489','4.60','5.52'),
('853','TV-01','CV-02','1490','4.85','5.82');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('854','TV-01','CV-02','1491','1.90','2.28'),
('855','TV-01','CV-01','1492','1.98','2.38'),
('856','TV-01','CV-01','1493','1.49','1.79'),
('857','TV-02','CV-01','1494','2.49','2.99'),
('858','TV-02','CV-01','1495','1.19','1.43'),
('859','TV-02','CV-01','1496','2.57','3.08'),
('860','TV-01','CV-01','1497','2.40','2.88'),
('861','TV-02','CV-01','1498','3.48','4.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('862','TV-01','CV-02','1499','0.50','0.60'),
('863','TV-02','CV-01','1500','0.54','0.65'),
('864','TV-01','CV-02','1501','0.78','0.94'),
('865','TV-02','CV-01','1501','0.49','0.59'),
('866','TV-01','CV-02','1501','1.56','1.87'),
('867','TV-02','CV-01','1501','1.94','2.33'),
('868','TV-01','CV-02','1501','0.89','1.07'),
('869','TV-02','CV-01','1501','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('870','TV-01','CV-02','1501','1.08','1.30'),
('871','TV-02','CV-01','1501','1.59','1.91'),
('872','TV-01','CV-02','1501','2.59','3.11'),
('873','TV-01','CV-01','1502','2.20','2.64'),
('874','TV-01','CV-02','1502','3.19','3.83'),
('875','TV-01','CV-01','1502','4.20','5.04'),
('876','TV-01','CV-02','1502','5.19','6.23'),
('877','TV-01','CV-03','1502','6.18','7.42'),
('878','TV-01','CV-03','1502','7.19','8.63');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('879','TV-01','CV-03','1502','8.09','9.71'),
('880','TV-01','CV-04','1503','9.02','10.82'),
('881','TV-01','CV-05','1503','10.90','13.08'),
('882','TV-01','CV-02','1503','11.19','13.43'),
('883','TV-01','CV-02','1503','12.50','15.00'),
('884','TV-01','CV-02','1503','13.89','16.67'),
('885','TV-01','CV-02','1503','14.19','17.03'),
('886','TV-01','CV-02','1503','15.19','18.23');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('887','TV-02','CV-02','1504','16.09','19.31'),
('888','TV-02','CV-01','1504','4.13','4.96'),
('889','TV-02','CV-01','1504','13.40','16.08'),
('890','TV-02','CV-01','1504','2.49','2.99'),
('891','TV-01','CV-01','1504','1.50','1.80'),
('892','TV-01','CV-01','1504','1.49','1.79'),
('893','TV-01','CV-01','1504','1.90','2.28'),
('894','TV-02','CV-01','1504','1.99','2.39');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('895','TV-02','CV-02','1505','2.09','2.51'),
('896','TV-02','CV-01','1505','0.79','0.95'),
('897','TV-02','CV-02','1505','0.98','1.18'),
('898','TV-01','CV-01','1505','0.70','0.84'),
('899','TV-01','CV-02','1505','1.19','1.43'),
('900','TV-01','CV-01','1505','1.98','2.38'),
('901','TV-01','CV-02','1505','1.89','2.27'),
('902','TV-01','CV-01','1505','8.19','9.83'),
('903','TV-01','CV-02','1505','0.89','1.07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('904','TV-02','CV-01','1506','1.45','1.74'),
('905','TV-02','CV-02','1506','1.05','1.26'),
('906','TV-02','CV-01','1506','1.50','1.80'),
('907','TV-02','CV-02','1506','1.98','2.38'),
('908','TV-02','CV-01','1506','1.89','2.27'),
('909','TV-02','CV-02','1506','1.89','2.27'),
('910','TV-01','CV-03','1506','1.98','2.37'),
('911','TV-01','CV-03','1506','1.40','1.68');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('912','TV-01','CV-03','1506','1.20','1.44'),
('913','TV-01','CV-04','1506','1.89','2.27'),
('914','TV-01','CV-05','1507','1.80','2.16'),
('915','TV-01','CV-01','1507','1.50','1.80'),
('916','TV-01','CV-01','1507','1.50','1.80'),
('917','TV-01','CV-01','1507','1.79','2.15'),
('918','TV-01','CV-01','1507','2.49','2.99'),
('919','TV-01','CV-01','1507','1.98','2.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('920','TV-01','CV-01','1507','1.49','1.79'),
('921','TV-01','CV-01','1507','2.08','2.50'),
('922','TV-01','CV-01','1507','3.09','3.70'),
('923','TV-01','CV-01','1507','5.07','6.08'),
('924','TV-01','CV-01','1508','5.09','6.11'),
('925','TV-01','CV-01','1508','2.09','2.51'),
('926','TV-01','CV-01','1508','3.81','4.57'),
('927','TV-02','CV-01','1508','4.09','4.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('928','TV-02','CV-01','1508','1.08','1.30'),
('929','TV-02','CV-01','1509','1.48','1.78'),
('930','TV-01','CV-02','1509','1.78','2.14'),
('931','TV-02','CV-02','1509','1.90','2.28'),
('932','TV-01','CV-02','1509','1.09','1.31'),
('933','TV-02','CV-02','1510','2.90','3.48'),
('934','TV-01','CV-02','1510','2.79','3.35'),
('935','TV-02','CV-02','1510','3.80','4.56');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('936','TV-01','CV-01','1510','2.98','3.58'),
('937','TV-02','CV-01','1510','3.98','4.78'),
('938','TV-01','CV-01','1510','1.74','2.09'),
('939','TV-02','CV-01','1511','1.50','1.80'),
('940','TV-01','CV-01','1511','1.30','1.56'),
('941','TV-02','CV-01','1511','1.01','1.21'),
('942','TV-01','CV-01','1511','1.02','1.22'),
('943','TV-01','CV-02','1511','1.03','1.24'),
('944','TV-01','CV-01','1512','1.04','1.25');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('945','TV-01','CV-02','1512','1.05','1.26'),
('946','TV-01','CV-01','1512','1.06','1.27'),
('947','TV-02','CV-02','1512','1.07','1.28'),
('948','TV-02','CV-01','1512','1.08','1.30'),
('949','TV-02','CV-02','1513','1.09','1.31'),
('950','TV-01','CV-01','1513','1.10','1.32'),
('951','TV-02','CV-02','1513','1.00','1.20'),
('952','TV-01','CV-01','1513','2.00','2.40'),
('953','TV-02','CV-02','1513','3.00','3.60');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('954','TV-01','CV-01','1514','4.00','4.80'),
('955','TV-02','CV-02','1514','5.00','6.00'),
('956','TV-01','CV-01','1514','6.00','7.20'),
('957','TV-02','CV-02','1514','7.00','8.40'),
('958','TV-01','CV-03','1514','1.50','1.80'),
('959','TV-02','CV-03','1515','3.60','4.32'),
('960','TV-01','CV-03','1515','1.80','2.16'),
('961','TV-02','CV-04','1515','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('962','TV-01','CV-05','1515','5.30','6.36'),
('963','TV-01','CV-02','1516','3.60','4.32'),
('964','TV-01','CV-02','1516','4.32','5.18'),
('965','TV-01','CV-02','1516','2.40','2.88'),
('966','TV-01','CV-02','1516','2.88','3.46'),
('967','TV-01','CV-02','1516','1.20','1.44'),
('968','TV-01','CV-02','1516','1.44','1.73'),
('969','TV-01','CV-01','1517','1.72','2.06'),
('970','TV-01','CV-01','1517','20.60','24.72');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('971','TV-01','CV-01','1517','2.06','2.47'),
('972','TV-01','CV-01','1517','1.50','1.80'),
('973','TV-01','CV-01','1517','1.80','2.16'),
('974','TV-01','CV-01','1518','1.09','1.31'),
('975','TV-01','CV-01','1518','1.05','1.26'),
('976','TV-01','CV-02','1518','1.26','1.51'),
('977','TV-02','CV-01','1518','1.31','1.57'),
('978','TV-02','CV-02','1519','1.51','1.81'),
('979','TV-02','CV-01','1519','2.57','3.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('980','TV-02','CV-02','1519','3.08','3.70'),
('981','TV-01','CV-01','1519','7.30','8.76'),
('982','TV-01','CV-02','1519','1.60','1.92'),
('983','TV-01','CV-01','1520','2.90','3.48'),
('984','TV-02','CV-02','1520','4.80','5.76'),
('985','TV-02','CV-01','1520','1.05','1.26'),
('986','TV-02','CV-02','1520','1.07','1.28'),
('987','TV-02','CV-01','1521','2.08','2.50');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('988','TV-01','CV-02','1521','2.09','2.51'),
('989','TV-01','CV-01','1521','20.70','24.84'),
('990','TV-01','CV-02','1521','20.60','24.72'),
('991','TV-01','CV-03','1522','2.06','2.47'),
('992','TV-01','CV-03','1522','2.08','2.50'),
('993','TV-01','CV-03','1522','1.06','1.27'),
('994','TV-02','CV-04','1522','1.05','1.26'),
('995','TV-02','CV-05','1524','1.59','1.91'),
('996','TV-02','CV-02','1524','1.48','1.78');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('997','TV-02','CV-02','1524','1.49','1.79'),
('998','TV-02','CV-02','1524','1.90','2.28'),
('999','TV-02','CV-02','1525','1.49','1.79'),
('1000','TV-01','CV-02','1525','1.13','1.36'),
('1001','TV-01','CV-02','1525','1.49','1.79'),
('1002','TV-01','CV-01','1525','1.89','2.27'),
('1003','TV-01','CV-01','1525','1.82','2.18'),
('1004','TV-01','CV-01','1526','1.36','1.63');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1005','TV-01','CV-01','1526','1.78','2.14'),
('1006','TV-01','CV-01','1526','1.79','2.15'),
('1007','TV-01','CV-01','1526','1.65','1.98'),
('1008','TV-01','CV-01','1527','1.50','1.80'),
('1009','TV-01','CV-02','1527','1.41','1.69'),
('1010','TV-01','CV-01','1527','1.10','1.32'),
('1011','TV-01','CV-02','1527','1.15','1.38'),
('1012','TV-01','CV-01','1528','1.38','1.66'),
('1013','TV-01','CV-02','1528','1.66','1.99');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1014','TV-01','CV-01','1528','1.99','2.39'),
('1015','TV-01','CV-02','1528','2.39','2.87'),
('1016','TV-01','CV-01','1528','2.87','3.44'),
('1017','TV-02','CV-02','1529','4.40','5.28'),
('1018','TV-02','CV-01','1529','4.60','5.52'),
('1019','TV-02','CV-02','1529','4.85','5.82'),
('1020','TV-01','CV-01','1529','1.90','2.28'),
('1021','TV-02','CV-02','1529','1.98','2.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1022','TV-01','CV-01','1530','1.49','1.79'),
('1023','TV-02','CV-02','1530','2.49','2.99'),
('1024','TV-01','CV-03','1530','1.19','1.43'),
('1025','TV-02','CV-03','1530','2.57','3.08'),
('1026','TV-01','CV-03','1531','2.40','2.88'),
('1027','TV-02','CV-04','1531','3.48','4.18'),
('1028','TV-01','CV-05','1531','0.50','0.60'),
('1029','TV-02','CV-02','1531','0.54','0.65');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1030','TV-01','CV-02','1532','0.78','0.94'),
('1031','TV-02','CV-02','1532','0.49','0.59'),
('1032','TV-01','CV-02','1532','1.56','1.87'),
('1033','TV-01','CV-02','1532','1.94','2.33'),
('1034','TV-01','CV-02','1532','0.89','1.07'),
('1035','TV-01','CV-01','1533','1.06','1.27'),
('1036','TV-01','CV-01','1533','1.08','1.30'),
('1037','TV-02','CV-01','1533','1.59','1.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1038','TV-02','CV-01','1533','2.59','3.11'),
('1039','TV-02','CV-01','1533','2.20','2.64'),
('1040','TV-01','CV-01','1533','3.19','3.83'),
('1041','TV-02','CV-01','1534','4.20','5.04'),
('1042','TV-01','CV-02','1534','5.19','6.23'),
('1043','TV-02','CV-01','1534','6.18','7.42'),
('1044','TV-01','CV-02','1534','7.19','8.63'),
('1045','TV-02','CV-01','1534','8.09','9.71');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1046','TV-01','CV-02','1535','9.02','10.82'),
('1047','TV-02','CV-01','1535','10.90','13.08'),
('1048','TV-01','CV-02','1535','11.19','13.43'),
('1049','TV-02','CV-01','1535','12.50','15.00'),
('1050','TV-01','CV-02','1535','13.89','16.67'),
('1051','TV-02','CV-01','1536','14.19','17.03'),
('1052','TV-01','CV-02','1536','15.19','18.23'),
('1053','TV-01','CV-01','1536','16.09','19.31');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1054','TV-01','CV-02','1536','1.00','1.20'),
('1055','TV-01','CV-01','1536','2.00','2.40'),
('1056','TV-01','CV-02','1537','3.00','3.60'),
('1057','TV-01','CV-03','1537','4.00','4.80'),
('1058','TV-01','CV-03','1537','5.00','6.00'),
('1059','TV-01','CV-03','1537','6.00','7.20'),
('1060','TV-01','CV-04','1538','7.00','8.40'),
('1061','TV-01','CV-05','1538','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1062','TV-01','CV-01','1538','3.60','4.32'),
('1063','TV-01','CV-01','1538','1.80','2.16'),
('1064','TV-01','CV-01','1539','1.90','2.28'),
('1065','TV-01','CV-01','1539','5.30','6.36'),
('1066','TV-01','CV-01','1539','3.60','4.32'),
('1067','TV-02','CV-01','1539','4.32','5.18'),
('1068','TV-02','CV-01','1539','2.40','2.88');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1069','TV-02','CV-01','1539','2.88','3.46'),
('1070','TV-02','CV-01','1539','1.20','1.44'),
('1071','TV-01','CV-01','1540','1.44','1.73'),
('1072','TV-01','CV-01','1540','1.72','2.06'),
('1073','TV-01','CV-01','1540','20.60','24.72'),
('1074','TV-02','CV-01','1540','2.06','2.47'),
('1075','TV-02','CV-01','1540','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1076','TV-02','CV-01','1541','1.80','2.16'),
('1077','TV-02','CV-02','1541','1.09','1.31'),
('1078','TV-01','CV-03','1541','1.05','1.26'),
('1079','TV-01','CV-04','1541','1.26','1.51'),
('1080','TV-01','CV-05','1541','1.31','1.57'),
('1081','TV-01','CV-02','1542','1.51','1.81'),
('1082','TV-01','CV-01','1542','2.57','3.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1083','TV-01','CV-02','1542','3.08','3.70'),
('1084','TV-02','CV-03','1542','7.30','8.76'),
('1085','TV-02','CV-03','1542','1.60','1.92'),
('1086','TV-02','CV-03','1542','2.90','3.48'),
('1087','TV-02','CV-04','1543','4.80','5.76'),
('1088','TV-02','CV-05','1543','1.05','1.26'),
('1089','TV-02','CV-01','1543','1.07','1.28'),
('1090','TV-01','CV-01','1543','2.08','2.50');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1091','TV-01','CV-01','1543','2.09','2.51'),
('1092','TV-01','CV-01','1544','20.70','24.84'),
('1093','TV-01','CV-01','1544','20.60','24.72'),
('1094','TV-01','CV-01','1544','2.06','2.47'),
('1095','TV-01','CV-01','1545','2.08','2.50'),
('1096','TV-01','CV-01','1545','1.06','1.27'),
('1097','TV-01','CV-01','1545','1.05','1.26'),
('1098','TV-01','CV-01','1546','1.59','1.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1099','TV-01','CV-01','1546','1.48','1.78'),
('1100','TV-01','CV-01','1546','1.49','1.79'),
('1101','TV-01','CV-01','1547','1.90','2.28'),
('1102','TV-01','CV-01','1547','1.49','1.79'),
('1103','TV-01','CV-01','1547','1.13','1.36'),
('1104','TV-01','CV-02','1548','1.49','1.79'),
('1105','TV-01','CV-03','1548','1.89','2.27'),
('1106','TV-01','CV-04','1548','1.82','2.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1107','TV-02','CV-05','1549','1.36','1.63'),
('1108','TV-02','CV-02','1549','1.78','2.14'),
('1109','TV-02','CV-01','1549','1.79','2.15'),
('1110','TV-01','CV-02','1549','1.65','1.98'),
('1111','TV-02','CV-03','1550','1.50','1.80'),
('1112','TV-01','CV-03','1550','1.41','1.69'),
('1113','TV-02','CV-03','1550','1.10','1.32');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1114','TV-01','CV-04','1551','1.15','1.38'),
('1115','TV-02','CV-05','1551','1.38','1.66'),
('1116','TV-01','CV-01','1551','1.66','1.99'),
('1117','TV-02','CV-01','1552','1.99','2.39'),
('1118','TV-01','CV-01','1552','2.39','2.87'),
('1119','TV-02','CV-01','1552','2.87','3.44'),
('1120','TV-01','CV-01','1553','4.40','5.28'),
('1121','TV-02','CV-01','1553','4.60','5.52');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1122','TV-01','CV-01','1553','4.85','5.82'),
('1123','TV-01','CV-01','1553','1.90','2.28'),
('1124','TV-01','CV-01','1554','1.98','2.38'),
('1125','TV-01','CV-01','1554','1.49','1.79'),
('1126','TV-01','CV-01','1554','2.49','2.99'),
('1127','TV-02','CV-01','1555','1.19','1.43'),
('1128','TV-02','CV-01','1555','2.57','3.08'),
('1129','TV-02','CV-01','1555','2.40','2.88');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1130','TV-01','CV-01','1556','3.48','4.18'),
('1131','TV-02','CV-02','1556','0.50','0.60'),
('1132','TV-01','CV-03','1556','0.54','0.65'),
('1133','TV-02','CV-04','1557','0.78','0.94'),
('1134','TV-01','CV-05','1557','0.49','0.59'),
('1135','TV-02','CV-02','1557','1.56','1.87'),
('1136','TV-01','CV-02','1557','1.94','2.33'),
('1137','TV-02','CV-02','1558','0.89','1.07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1138','TV-01','CV-02','1558','1.06','1.27'),
('1139','TV-02','CV-02','1558','1.08','1.30'),
('1140','TV-01','CV-02','1558','1.59','1.91'),
('1141','TV-02','CV-01','1559','2.59','3.11'),
('1142','TV-01','CV-01','1559','2.20','2.64'),
('1143','TV-01','CV-01','1559','3.19','3.83'),
('1144','TV-02','CV-01','1560','4.20','5.04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1145','TV-01','CV-01','1560','5.19','6.23'),
('1146','TV-01','CV-01','1560','6.18','7.42'),
('1147','TV-02','CV-01','1560','7.19','8.63'),
('1148','TV-01','CV-02','1560','8.09','9.71'),
('1149','TV-02','CV-01','1561','9.02','10.82'),
('1150','TV-01','CV-02','1561','10.90','13.08'),
('1151','TV-02','CV-01','1561','11.19','13.43'),
('1152','TV-01','CV-02','1561','12.50','15.00');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1153','TV-02','CV-01','1561','13.89','16.67'),
('1154','TV-01','CV-02','1562','14.19','17.03'),
('1155','TV-02','CV-01','1562','15.19','18.23'),
('1156','TV-01','CV-02','1562','16.09','19.31'),
('1157','TV-02','CV-01','1562','1.00','1.20'),
('1158','TV-01','CV-02','1562','2.00','2.40'),
('1159','TV-02','CV-01','1563','3.00','3.60'),
('1160','TV-01','CV-02','1563','4.00','4.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1161','TV-02','CV-01','1563','5.00','6.00'),
('1162','TV-01','CV-02','1564','6.00','7.20'),
('1163','TV-01','CV-03','1564','7.00','8.40'),
('1164','TV-01','CV-03','1564','1.50','1.80'),
('1165','TV-01','CV-03','1565','3.60','4.32'),
('1166','TV-01','CV-04','1565','1.80','2.16'),
('1167','TV-01','CV-05','1565','1.90','2.28'),
('1168','TV-01','CV-02','1566','5.30','6.36');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1169','TV-01','CV-02','1566','3.60','4.32'),
('1170','TV-01','CV-02','1566','4.32','5.18'),
('1171','TV-01','CV-02','1567','2.40','2.88'),
('1172','TV-01','CV-02','1567','2.88','3.46'),
('1173','TV-01','CV-02','1567','1.20','1.44'),
('1174','TV-01','CV-01','1568','1.44','1.73'),
('1175','TV-01','CV-01','1568','1.72','2.06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1176','TV-01','CV-01','1568','20.60','24.72'),
('1177','TV-01','CV-01','1569','2.06','2.47'),
('1178','TV-02','CV-01','1569','1.50','1.80'),
('1179','TV-02','CV-01','1569','1.80','2.16'),
('1180','TV-02','CV-01','1570','1.09','1.31'),
('1181','TV-02','CV-02','1570','1.05','1.26'),
('1182','TV-01','CV-01','1570','1.26','1.51'),
('1183','TV-01','CV-02','1571','1.31','1.57');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1184','TV-01','CV-01','1571','1.51','1.81'),
('1185','TV-02','CV-02','1572','2.57','3.08'),
('1186','TV-02','CV-01','1572','3.08','3.70'),
('1187','TV-02','CV-02','1573','7.30','8.76'),
('1188','TV-02','CV-01','1573','1.60','1.92'),
('1189','TV-01','CV-02','1574','2.90','3.48'),
('1190','TV-01','CV-01','1574','4.80','5.76'),
('1191','TV-01','CV-02','1575','1.05','1.26');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1192','TV-01','CV-01','1575','1.07','1.28'),
('1193','TV-01','CV-02','1576','2.08','2.50'),
('1194','TV-01','CV-01','1576','2.09','2.51'),
('1195','TV-02','CV-02','1577','20.70','24.84'),
('1196','TV-02','CV-03','1577','20.60','24.72'),
('1197','TV-02','CV-03','1578','2.06','2.47'),
('1198','TV-02','CV-03','1578','2.08','2.50'),
('1199','TV-02','CV-04','1579','1.06','1.27'),
('1200','TV-02','CV-05','1579','1.05','1.26');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1201','TV-01','CV-02','1580','1.59','1.91'),
('1202','TV-01','CV-02','1580','1.48','1.78'),
('1203','TV-01','CV-02','1581','1.49','1.79'),
('1204','TV-01','CV-02','1581','1.90','2.28'),
('1205','TV-01','CV-02','1582','1.49','1.79'),
('1206','TV-01','CV-02','1582','1.13','1.36'),
('1207','TV-01','CV-01','1583','1.49','1.79'),
('1208','TV-01','CV-01','1583','1.89','2.27'),
('1209','TV-01','CV-01','1583','1.82','2.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1210','TV-01','CV-01','1584','1.36','1.63'),
('1211','TV-01','CV-01','1584','1.78','2.14'),
('1212','TV-01','CV-01','1584','1.79','2.15'),
('1213','TV-01','CV-01','1585','1.65','1.98'),
('1214','TV-01','CV-02','1585','1.50','1.80'),
('1215','TV-01','CV-01','1585','1.41','1.69'),
('1216','TV-01','CV-02','1586','1.10','1.32'),
('1217','TV-01','CV-01','1586','1.15','1.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1218','TV-02','CV-02','1586','1.38','1.66'),
('1219','TV-02','CV-01','1587','1.66','1.99'),
('1220','TV-02','CV-02','1587','1.99','2.39'),
('1221','TV-01','CV-01','1587','2.39','2.87'),
('1222','TV-02','CV-02','1588','2.87','3.44'),
('1223','TV-01','CV-01','1588','4.40','5.28'),
('1224','TV-02','CV-02','1588','4.60','5.52'),
('1225','TV-01','CV-01','1589','4.85','5.82');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1226','TV-02','CV-02','1589','1.90','2.28'),
('1227','TV-01','CV-01','1589','1.98','2.38'),
('1228','TV-02','CV-02','1590','1.49','1.79'),
('1229','TV-01','CV-03','1590','2.49','2.99'),
('1230','TV-02','CV-03','1590','1.19','1.43'),
('1231','TV-01','CV-03','1591','2.57','3.08'),
('1232','TV-02','CV-04','1591','2.40','2.88'),
('1233','TV-01','CV-05','1591','3.48','4.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1234','TV-01','CV-02','1592','0.50','0.60'),
('1235','TV-01','CV-02','1592','0.54','0.65'),
('1236','TV-01','CV-02','1592','0.78','0.94'),
('1237','TV-01','CV-02','1593','0.49','0.59'),
('1238','TV-02','CV-02','1593','1.56','1.87'),
('1239','TV-02','CV-02','1593','1.94','2.33'),
('1240','TV-02','CV-01','1594','0.89','1.07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1241','TV-01','CV-01','1594','1.06','1.27'),
('1242','TV-02','CV-01','1594','1.08','1.30'),
('1243','TV-01','CV-01','1595','1.59','1.91'),
('1244','TV-02','CV-01','1595','2.59','3.11'),
('1245','TV-01','CV-01','1595','2.20','2.64'),
('1246','TV-02','CV-01','1596','3.19','3.83'),
('1247','TV-01','CV-02','1596','4.20','5.04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1248','TV-02','CV-01','1596','5.19','6.23'),
('1249','TV-01','CV-02','1597','6.18','7.42'),
('1250','TV-02','CV-01','1597','7.19','8.63'),
('1251','TV-01','CV-02','1597','8.09','9.71'),
('1252','TV-02','CV-01','1598','9.02','10.82'),
('1253','TV-01','CV-02','1598','10.90','13.08'),
('1254','TV-01','CV-01','1598','11.19','13.43');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1255','TV-02','CV-02','1599','12.50','15.00'),
('1256','TV-01','CV-01','1599','13.89','16.67'),
('1257','TV-01','CV-02','1599','14.19','17.03'),
('1258','TV-02','CV-01','1600','15.19','18.23'),
('1259','TV-01','CV-02','1600','16.09','19.31'),
('1260','TV-02','CV-01','1600','1.00','1.20'),
('1261','TV-01','CV-02','1600','2.00','2.40'),
('1262','TV-02','CV-03','1601','3.00','3.60');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1263','TV-01','CV-03','1602','4.00','4.80'),
('1264','TV-02','CV-03','1603','5.00','6.00'),
('1265','TV-01','CV-04','1604','6.00','7.20'),
('1266','TV-02','CV-05','1605','7.00','8.40'),
('1267','TV-01','CV-01','1606','1.50','1.80'),
('1268','TV-02','CV-01','1607','3.60','4.32'),
('1269','TV-01','CV-01','1608','1.80','2.16'),
('1270','TV-02','CV-01','1609','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1271','TV-01','CV-01','1610','5.30','6.36'),
('1272','TV-02','CV-01','1611','3.60','4.32'),
('1273','TV-01','CV-01','1612','4.32','5.18'),
('1274','TV-01','CV-01','1613','2.40','2.88'),
('1275','TV-01','CV-01','1614','2.88','3.46'),
('1276','TV-01','CV-01','1615','1.20','1.44'),
('1277','TV-01','CV-01','1616','1.44','1.73'),
('1278','TV-01','CV-01','1617','1.72','2.06');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1279','TV-01','CV-01','1618','20.60','24.72'),
('1280','TV-01','CV-01','1619','2.06','2.47'),
('1281','TV-01','CV-01','1620','1.50','1.80'),
('1282','TV-01','CV-02','1621','1.80','2.16'),
('1283','TV-01','CV-02','1622','1.09','1.31'),
('1284','TV-01','CV-02','1623','1.05','1.26'),
('1285','TV-01','CV-02','1624','1.26','1.51'),
('1286','TV-01','CV-02','1625','1.31','1.57');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1287','TV-01','CV-02','1626','1.51','1.81'),
('1288','TV-01','CV-01','1627','2.57','3.08'),
('1289','TV-02','CV-01','1628','3.08','3.70'),
('1290','TV-02','CV-01','1629','7.30','8.76'),
('1291','TV-02','CV-01','1630','1.60','1.92'),
('1292','TV-02','CV-01','1631','2.90','3.48'),
('1293','TV-01','CV-01','1632','4.80','5.76'),
('1294','TV-01','CV-01','1633','1.05','1.26');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1295','TV-01','CV-02','1634','1.07','1.28'),
('1296','TV-02','CV-01','1635','2.08','2.50'),
('1297','TV-02','CV-02','1636','2.09','2.51'),
('1298','TV-02','CV-01','1637','20.70','24.84'),
('1299','TV-02','CV-02','1638','20.60','24.72'),
('1300','TV-01','CV-01','1639','2.06','2.47'),
('1301','TV-01','CV-02','1640','2.08','2.50'),
('1302','TV-01','CV-01','1641','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1303','TV-01','CV-02','1642','1.05','1.26'),
('1304','TV-01','CV-01','1643','1.59','1.91'),
('1305','TV-01','CV-02','1644','1.48','1.78'),
('1306','TV-02','CV-01','1645','1.49','1.79'),
('1307','TV-02','CV-02','1646','1.90','2.28'),
('1308','TV-02','CV-01','1647','1.49','1.79'),
('1309','TV-02','CV-02','1648','1.13','1.36');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1310','TV-02','CV-03','1649','1.49','1.79'),
('1311','TV-02','CV-03','1650','1.89','2.27'),
('1312','TV-01','CV-03','1651','1.82','2.18'),
('1313','TV-01','CV-04','1652','1.36','1.63'),
('1314','TV-01','CV-05','1653','1.78','2.14'),
('1315','TV-01','CV-02','1654','1.79','2.15'),
('1316','TV-01','CV-02','1655','1.65','1.98'),
('1317','TV-01','CV-02','1656','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1318','TV-01','CV-02','1657','1.41','1.69'),
('1319','TV-01','CV-02','1658','1.10','1.32'),
('1320','TV-01','CV-02','1659','1.15','1.38'),
('1321','TV-01','CV-01','1660','1.38','1.66'),
('1322','TV-01','CV-01','1661','1.66','1.99'),
('1323','TV-01','CV-01','1662','1.99','2.39'),
('1324','TV-01','CV-01','1663','2.39','2.87'),
('1325','TV-01','CV-01','1664','2.87','3.44');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1326','TV-01','CV-01','1665','4.40','5.28'),
('1327','TV-01','CV-01','1666','4.60','5.52'),
('1328','TV-01','CV-02','1667','4.85','5.82'),
('1329','TV-02','CV-01','1668','1.90','2.28'),
('1330','TV-02','CV-02','1669','1.98','2.38'),
('1331','TV-02','CV-01','1670','1.49','1.79'),
('1332','TV-01','CV-02','1671','2.49','2.99'),
('1333','TV-02','CV-01','1672','1.19','1.43');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1334','TV-01','CV-02','1673','2.57','3.08'),
('1335','TV-02','CV-01','1674','2.40','2.88'),
('1336','TV-01','CV-02','1675','3.48','4.18'),
('1337','TV-02','CV-01','1676','0.50','0.60'),
('1338','TV-01','CV-02','1677','0.54','0.65'),
('1339','TV-02','CV-01','1678','0.78','0.94'),
('1340','TV-01','CV-02','1679','0.49','0.59');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1341','TV-02','CV-01','1680','1.56','1.87'),
('1342','TV-01','CV-02','1681','1.94','2.33'),
('1343','TV-02','CV-03','1682','0.89','1.07'),
('1344','TV-01','CV-03','1683','1.06','1.27'),
('1345','TV-01','CV-03','1684','1.08','1.30'),
('1346','TV-01','CV-04','1685','1.59','1.91'),
('1347','TV-01','CV-05','1686','2.59','3.11'),
('1348','TV-01','CV-02','1687','2.20','2.64');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1349','TV-02','CV-02','1688','3.19','3.83'),
('1350','TV-02','CV-02','1689','4.20','5.04'),
('1351','TV-02','CV-02','1690','5.19','6.23'),
('1352','TV-01','CV-02','1691','6.18','7.42'),
('1353','TV-02','CV-02','1692','7.19','8.63'),
('1354','TV-01','CV-01','1693','8.09','9.71'),
('1355','TV-02','CV-01','1694','9.02','10.82');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1356','TV-01','CV-01','1695','10.90','13.08'),
('1357','TV-02','CV-01','1696','11.19','13.43'),
('1358','TV-01','CV-01','1697','12.50','15.00'),
('1359','TV-02','CV-01','1698','13.89','16.67'),
('1360','TV-01','CV-01','1699','14.19','17.03'),
('1361','TV-02','CV-02','1700','15.19','18.23'),
('1362','TV-01','CV-01','1701','16.09','19.31'),
('1363','TV-02','CV-02','1702','4.13','4.96');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1364','TV-01','CV-01','1703','13.40','16.08'),
('1365','TV-01','CV-02','1704','2.49','2.99'),
('1366','TV-02','CV-01','1705','1.50','1.80'),
('1367','TV-01','CV-02','1706','1.49','1.79'),
('1368','TV-01','CV-01','1707','1.90','2.28'),
('1369','TV-02','CV-02','1708','1.99','2.39'),
('1370','TV-01','CV-01','1709','2.09','2.51'),
('1371','TV-02','CV-02','1710','0.79','0.95');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1372','TV-01','CV-01','1711','0.98','1.18'),
('1373','TV-02','CV-02','1712','0.70','0.84'),
('1374','TV-01','CV-01','1713','1.19','1.43'),
('1375','TV-02','CV-02','1714','1.98','2.38'),
('1376','TV-01','CV-03','1715','1.89','2.27'),
('1377','TV-02','CV-03','1716','8.19','9.83'),
('1378','TV-01','CV-03','1717','0.89','1.07'),
('1379','TV-02','CV-04','1718','1.45','1.74');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1380','TV-01','CV-05','1719','1.05','1.26'),
('1381','TV-02','CV-02','1720','1.50','1.80'),
('1382','TV-01','CV-02','1721','1.98','2.38'),
('1383','TV-02','CV-02','1722','1.89','2.27'),
('1384','TV-01','CV-02','1723','1.89','2.27'),
('1385','TV-01','CV-02','1724','1.98','2.37'),
('1386','TV-01','CV-02','1725','1.40','1.68'),
('1387','TV-01','CV-01','1726','1.20','1.44');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1388','TV-01','CV-01','1727','1.89','2.27'),
('1389','TV-01','CV-01','1728','1.80','2.16'),
('1390','TV-01','CV-01','1729','1.50','1.80'),
('1391','TV-01','CV-01','1730','1.50','1.80'),
('1392','TV-01','CV-01','1731','1.79','2.15'),
('1393','TV-01','CV-01','1732','2.49','2.99'),
('1394','TV-01','CV-02','1733','1.98','2.38'),
('1395','TV-01','CV-01','1734','1.49','1.79');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1396','TV-01','CV-02','1735','2.08','2.50'),
('1397','TV-01','CV-01','1736','3.09','3.70'),
('1398','TV-01','CV-02','1737','5.07','6.08'),
('1399','TV-02','CV-01','1738','5.09','6.11'),
('1400','TV-02','CV-02','1739','2.09','2.51'),
('1401','TV-02','CV-01','1740','3.81','4.57'),
('1402','TV-02','CV-02','1741','4.09','4.91'),
('1403','TV-01','CV-01','1742','1.08','1.30');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1404','TV-01','CV-02','1743','1.48','1.78'),
('1405','TV-01','CV-01','1744','1.78','2.14'),
('1406','TV-02','CV-02','1745','1.90','2.28'),
('1407','TV-02','CV-01','1746','1.09','1.31'),
('1408','TV-02','CV-02','1747','2.90','3.48'),
('1409','TV-02','CV-03','1748','2.79','3.35'),
('1410','TV-01','CV-03','1749','3.80','4.56'),
('1411','TV-01','CV-03','1750','2.98','3.58'),
('1412','TV-01','CV-04','1751','3.98','4.78');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1413','TV-01','CV-05','1752','1.74','2.09'),
('1414','TV-01','CV-01','1753','1.50','1.80'),
('1415','TV-01','CV-01','1754','1.30','1.56'),
('1416','TV-02','CV-01','1755','1.01','1.21'),
('1417','TV-02','CV-01','1756','1.02','1.22'),
('1418','TV-02','CV-01','1757','1.03','1.24'),
('1419','TV-02','CV-01','1758','1.04','1.25'),
('1420','TV-02','CV-01','1759','1.05','1.26'),
('1421','TV-02','CV-01','1760','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1422','TV-01','CV-01','1761','1.07','1.28'),
('1423','TV-01','CV-01','1762','1.08','1.30'),
('1424','TV-01','CV-01','1763','1.09','1.31'),
('1425','TV-01','CV-01','1764','1.10','1.32'),
('1426','TV-01','CV-01','1765','1.00','1.20'),
('1427','TV-01','CV-01','1766','2.00','2.40'),
('1428','TV-01','CV-01','1767','3.00','3.60'),
('1429','TV-01','CV-02','1768','4.00','4.80'),
('1430','TV-01','CV-03','1769','5.00','6.00');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1431','TV-01','CV-04','1770','6.00','7.20'),
('1432','TV-01','CV-05','1771','7.00','8.40'),
('1433','TV-01','CV-02','1772','1.50','1.80'),
('1434','TV-01','CV-01','1773','3.60','4.32'),
('1435','TV-01','CV-02','1774','1.80','2.16'),
('1436','TV-01','CV-03','1775','1.90','2.28'),
('1437','TV-01','CV-03','1776','5.30','6.36'),
('1438','TV-01','CV-03','1777','3.60','4.32');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1439','TV-02','CV-04','1778','4.32','5.18'),
('1440','TV-02','CV-05','1779','2.40','2.88'),
('1441','TV-02','CV-01','1780','2.88','3.46'),
('1442','TV-01','CV-01','1781','1.20','1.44'),
('1443','TV-02','CV-01','1782','1.44','1.73'),
('1444','TV-01','CV-01','1783','1.72','2.06'),
('1445','TV-02','CV-01','1784','20.60','24.72'),
('1446','TV-01','CV-01','1785','2.06','2.47');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1447','TV-02','CV-01','1786','1.50','1.80'),
('1448','TV-01','CV-01','1787','1.80','2.16'),
('1449','TV-02','CV-01','1788','1.09','1.31'),
('1450','TV-01','CV-01','1789','1.05','1.26'),
('1451','TV-02','CV-01','1790','1.26','1.51'),
('1452','TV-01','CV-01','1791','1.31','1.57'),
('1453','TV-02','CV-01','1792','1.51','1.81'),
('1454','TV-01','CV-01','1793','2.57','3.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1455','TV-01','CV-01','1794','3.08','3.70'),
('1456','TV-01','CV-02','1795','7.30','8.76'),
('1457','TV-01','CV-03','1796','1.60','1.92'),
('1458','TV-01','CV-04','1797','2.90','3.48'),
('1459','TV-02','CV-05','1798','4.80','5.76'),
('1460','TV-02','CV-02','1799','1.05','1.26'),
('1461','TV-02','CV-01','1800','1.07','1.28'),
('1462','TV-01','CV-02','1801','2.08','2.50');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1463','TV-02','CV-03','1801','2.09','2.51'),
('1464','TV-01','CV-03','1801','20.70','24.84'),
('1465','TV-02','CV-03','1801','20.60','24.72'),
('1466','TV-01','CV-04','1801','2.06','2.47'),
('1467','TV-02','CV-05','1801','2.08','2.50'),
('1468','TV-01','CV-01','1801','1.06','1.27'),
('1469','TV-02','CV-01','1801','1.05','1.26'),
('1470','TV-01','CV-01','1801','1.59','1.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1471','TV-02','CV-01','1802','1.48','1.78'),
('1472','TV-01','CV-01','1802','1.49','1.79'),
('1473','TV-02','CV-01','1802','1.90','2.28'),
('1474','TV-01','CV-01','1802','1.49','1.79'),
('1475','TV-01','CV-01','1802','1.13','1.36'),
('1476','TV-01','CV-01','1802','1.49','1.79'),
('1477','TV-01','CV-01','1802','1.89','2.27'),
('1478','TV-01','CV-01','1803','1.82','2.18');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1479','TV-01','CV-01','1803','1.36','1.63'),
('1480','TV-01','CV-01','1803','1.78','2.14'),
('1481','TV-01','CV-01','1803','1.79','2.15'),
('1482','TV-01','CV-01','1803','1.65','1.98'),
('1483','TV-01','CV-02','1803','1.50','1.80'),
('1484','TV-01','CV-03','1803','1.41','1.69'),
('1485','TV-01','CV-04','1804','1.10','1.32'),
('1486','TV-01','CV-05','1804','1.15','1.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1487','TV-01','CV-02','1804','1.38','1.66'),
('1488','TV-01','CV-02','1804','1.66','1.99'),
('1489','TV-02','CV-02','1804','1.99','2.39'),
('1490','TV-02','CV-02','1804','2.39','2.87'),
('1491','TV-02','CV-02','1804','2.87','3.44'),
('1492','TV-02','CV-02','1804','4.40','5.28'),
('1493','TV-01','CV-01','1805','4.60','5.52');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1494','TV-01','CV-01','1805','4.85','5.82'),
('1495','TV-01','CV-01','1805','1.90','2.28'),
('1496','TV-02','CV-01','1805','1.98','2.38'),
('1497','TV-02','CV-01','1805','1.49','1.79'),
('1498','TV-02','CV-01','1805','2.49','2.99'),
('1499','TV-02','CV-01','1805','1.19','1.43'),
('1500','TV-01','CV-02','1805','2.57','3.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1501','TV-01','CV-01','1805','2.40','2.88'),
('1502','TV-01','CV-02','1806','3.48','4.18'),
('1503','TV-01','CV-01','1806','0.50','0.60'),
('1504','TV-01','CV-02','1806','0.54','0.65'),
('1505','TV-01','CV-01','1806','0.78','0.94'),
('1506','TV-02','CV-02','1806','0.49','0.59'),
('1507','TV-02','CV-01','1806','1.56','1.87'),
('1508','TV-02','CV-02','1806','1.94','2.33');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1509','TV-02','CV-01','1806','0.89','1.07'),
('1510','TV-02','CV-02','1806','1.06','1.27'),
('1511','TV-02','CV-01','1806','1.08','1.30'),
('1512','TV-01','CV-02','1807','1.59','1.91'),
('1513','TV-01','CV-01','1807','2.59','3.11'),
('1514','TV-01','CV-02','1807','2.20','2.64'),
('1515','TV-01','CV-03','1807','3.19','3.83'),
('1516','TV-01','CV-03','1807','4.20','5.04');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1517','TV-01','CV-03','1807','5.19','6.23'),
('1518','TV-01','CV-04','1807','6.18','7.42'),
('1519','TV-01','CV-05','1807','7.19','8.63'),
('1520','TV-01','CV-02','1807','8.09','9.71'),
('1521','TV-01','CV-02','1807','9.02','10.82'),
('1522','TV-01','CV-02','1808','10.90','13.08'),
('1523','TV-01','CV-02','1808','11.19','13.43'),
('1524','TV-01','CV-02','1808','12.50','15.00');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1525','TV-01','CV-02','1808','13.89','16.67'),
('1526','TV-01','CV-02','1808','14.19','17.03'),
('1527','TV-01','CV-02','1809','15.19','18.23'),
('1528','TV-01','CV-02','1809','16.09','19.31'),
('1529','TV-02','CV-02','1809','1.00','1.20'),
('1530','TV-02','CV-02','1809','2.00','2.40'),
('1531','TV-02','CV-02','1810','3.00','3.60');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1532','TV-01','CV-01','1810','4.00','4.80'),
('1533','TV-02','CV-01','1810','5.00','6.00'),
('1534','TV-01','CV-01','1810','6.00','7.20'),
('1535','TV-02','CV-01','1810','7.00','8.40'),
('1536','TV-01','CV-01','1810','1.50','1.80'),
('1537','TV-02','CV-01','1811','3.60','4.32'),
('1538','TV-01','CV-01','1811','1.80','2.16'),
('1539','TV-02','CV-02','1811','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1540','TV-01','CV-01','1811','5.30','6.36'),
('1541','TV-02','CV-02','1811','3.60','4.32'),
('1542','TV-01','CV-01','1812','4.32','5.18'),
('1543','TV-02','CV-02','1812','2.40','2.88'),
('1544','TV-01','CV-01','1812','2.88','3.46'),
('1545','TV-01','CV-02','1812','1.20','1.44'),
('1546','TV-01','CV-01','1812','1.44','1.73');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1547','TV-01','CV-02','1813','1.72','2.06'),
('1548','TV-01','CV-01','1813','20.60','24.72'),
('1549','TV-02','CV-02','1813','2.06','2.47'),
('1550','TV-02','CV-01','1813','1.50','1.80'),
('1551','TV-02','CV-02','1813','1.80','2.16'),
('1552','TV-01','CV-01','1814','1.09','1.31'),
('1553','TV-02','CV-02','1814','1.05','1.26');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1554','TV-01','CV-03','1814','1.26','1.51'),
('1555','TV-02','CV-03','1814','1.31','1.57'),
('1556','TV-01','CV-03','1814','1.51','1.81'),
('1557','TV-02','CV-04','1815','2.57','3.08'),
('1558','TV-01','CV-05','1815','3.08','3.70'),
('1559','TV-02','CV-02','1815','7.30','8.76'),
('1560','TV-01','CV-02','1815','1.60','1.92');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1561','TV-02','CV-02','1816','2.90','3.48'),
('1562','TV-01','CV-02','1816','4.80','5.76'),
('1563','TV-02','CV-02','1816','1.05','1.26'),
('1564','TV-01','CV-02','1816','1.07','1.28'),
('1565','TV-01','CV-02','1816','2.08','2.50'),
('1566','TV-01','CV-02','1816','2.09','2.51'),
('1567','TV-01','CV-02','1817','20.70','24.84'),
('1568','TV-01','CV-02','1817','20.60','24.72');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1569','TV-01','CV-02','1817','2.06','2.47'),
('1570','TV-01','CV-02','1817','2.08','2.50'),
('1571','TV-01','CV-01','1817','1.06','1.27'),
('1572','TV-01','CV-01','1818','1.05','1.26'),
('1573','TV-01','CV-01','1818','1.59','1.91'),
('1574','TV-01','CV-01','1818','1.48','1.78'),
('1575','TV-01','CV-01','1818','1.49','1.79'),
('1576','TV-01','CV-01','1819','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1577','TV-01','CV-01','1819','1.49','1.79'),
('1578','TV-01','CV-02','1819','1.13','1.36'),
('1579','TV-02','CV-01','1819','1.49','1.79'),
('1580','TV-02','CV-02','1819','1.89','2.27'),
('1581','TV-02','CV-01','1820','1.82','2.18'),
('1582','TV-02','CV-02','1820','1.36','1.63'),
('1583','TV-01','CV-01','1820','1.78','2.14'),
('1584','TV-01','CV-02','1820','1.79','2.15');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1585','TV-01','CV-01','1821','1.65','1.98'),
('1586','TV-02','CV-02','1821','1.50','1.80'),
('1587','TV-02','CV-01','1821','1.41','1.69'),
('1588','TV-02','CV-02','1821','1.10','1.32'),
('1589','TV-02','CV-01','1822','1.15','1.38'),
('1590','TV-01','CV-02','1822','1.38','1.66'),
('1591','TV-01','CV-01','1822','1.66','1.99'),
('1592','TV-01','CV-02','1822','1.99','2.39');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1593','TV-01','CV-03','1824','2.39','2.87'),
('1594','TV-01','CV-03','1824','2.87','3.44'),
('1595','TV-01','CV-03','1824','4.40','5.28'),
('1596','TV-02','CV-04','1824','4.60','5.52'),
('1597','TV-02','CV-05','1825','4.85','5.82'),
('1598','TV-02','CV-02','1825','1.90','2.28'),
('1599','TV-02','CV-02','1825','1.98','2.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1600','TV-02','CV-02','1825','1.49','1.79'),
('1601','TV-02','CV-02','1825','2.49','2.99'),
('1602','TV-01','CV-02','1826','1.19','1.43'),
('1603','TV-01','CV-02','1826','2.57','3.08'),
('1604','TV-01','CV-01','1826','2.40','2.88'),
('1605','TV-01','CV-01','1826','3.48','4.18'),
('1606','TV-01','CV-01','1827','0.50','0.60');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1607','TV-01','CV-01','1827','0.54','0.65'),
('1608','TV-01','CV-01','1827','0.78','0.94'),
('1609','TV-01','CV-01','1827','0.49','0.59'),
('1610','TV-01','CV-01','1828','1.56','1.87'),
('1611','TV-01','CV-02','1828','1.94','2.33'),
('1612','TV-01','CV-01','1828','0.89','1.07'),
('1613','TV-01','CV-02','1828','1.06','1.27'),
('1614','TV-01','CV-01','1828','1.08','1.30');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1615','TV-01','CV-02','1829','1.59','1.91'),
('1616','TV-01','CV-01','1829','2.59','3.11'),
('1617','TV-01','CV-02','1829','2.20','2.64'),
('1618','TV-01','CV-01','1829','3.19','3.83'),
('1619','TV-02','CV-02','1829','4.20','5.04'),
('1620','TV-02','CV-01','1830','5.19','6.23'),
('1621','TV-02','CV-02','1830','6.18','7.42'),
('1622','TV-01','CV-01','1830','7.19','8.63');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1623','TV-02','CV-02','1830','8.09','9.71'),
('1624','TV-01','CV-01','1831','9.02','10.82'),
('1625','TV-02','CV-02','1831','10.90','13.08'),
('1626','TV-01','CV-03','1831','11.19','13.43'),
('1627','TV-02','CV-03','1831','12.50','15.00'),
('1628','TV-01','CV-03','1832','13.89','16.67'),
('1629','TV-02','CV-04','1832','14.19','17.03'),
('1630','TV-01','CV-05','1832','15.19','18.23');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1631','TV-02','CV-02','1832','16.09','19.31'),
('1632','TV-01','CV-02','1832','1.00','1.20'),
('1633','TV-02','CV-02','1833','2.00','2.40'),
('1634','TV-01','CV-02','1833','3.00','3.60'),
('1635','TV-01','CV-02','1833','4.00','4.80'),
('1636','TV-01','CV-02','1833','5.00','6.00'),
('1637','TV-01','CV-01','1833','6.00','7.20'),
('1638','TV-01','CV-01','1833','7.00','8.40');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1639','TV-02','CV-01','1834','1.50','1.80'),
('1640','TV-02','CV-01','1834','3.60','4.32'),
('1641','TV-02','CV-01','1834','1.80','2.16'),
('1642','TV-01','CV-01','1834','1.90','2.28'),
('1643','TV-02','CV-01','1834','5.30','6.36'),
('1644','TV-01','CV-02','1835','3.60','4.32'),
('1645','TV-02','CV-01','1835','4.32','5.18'),
('1646','TV-01','CV-02','1835','2.40','2.88');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1647','TV-02','CV-01','1835','2.88','3.46'),
('1648','TV-01','CV-02','1835','1.20','1.44'),
('1649','TV-02','CV-01','1836','1.44','1.73'),
('1650','TV-01','CV-02','1836','1.72','2.06'),
('1651','TV-02','CV-01','1836','20.60','24.72'),
('1652','TV-01','CV-02','1836','2.06','2.47'),
('1653','TV-02','CV-01','1836','1.50','1.80'),
('1654','TV-01','CV-02','1837','1.80','2.16');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1655','TV-01','CV-01','1837','1.09','1.31'),
('1656','TV-01','CV-02','1837','1.05','1.26'),
('1657','TV-01','CV-01','1837','1.26','1.51'),
('1658','TV-01','CV-02','1838','1.31','1.57'),
('1659','TV-01','CV-03','1838','1.51','1.81'),
('1660','TV-01','CV-03','1838','2.57','3.08'),
('1661','TV-01','CV-03','1838','3.08','3.70'),
('1662','TV-01','CV-04','1839','7.30','8.76');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1663','TV-01','CV-05','1839','1.60','1.92'),
('1664','TV-01','CV-02','1839','2.90','3.48'),
('1665','TV-01','CV-02','1839','4.80','5.76'),
('1666','TV-01','CV-02','1839','1.05','1.26'),
('1667','TV-01','CV-02','1839','1.07','1.28'),
('1668','TV-01','CV-02','1839','2.08','2.50'),
('1669','TV-02','CV-02','1840','2.09','2.51'),
('1670','TV-02','CV-01','1840','20.70','24.84');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1671','TV-02','CV-01','1840','20.60','24.72'),
('1672','TV-02','CV-01','1840','2.06','2.47'),
('1673','TV-01','CV-01','1840','2.08','2.50'),
('1674','TV-01','CV-01','1841','1.06','1.27'),
('1675','TV-01','CV-01','1841','1.05','1.26'),
('1676','TV-02','CV-01','1841','1.59','1.91'),
('1677','TV-02','CV-02','1841','1.48','1.78'),
('1678','TV-02','CV-01','1841','1.49','1.79');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1679','TV-02','CV-02','1842','1.90','2.28'),
('1680','TV-01','CV-01','1842','1.49','1.79'),
('1681','TV-01','CV-02','1842','1.13','1.36'),
('1682','TV-01','CV-01','1842','1.49','1.79'),
('1683','TV-01','CV-02','1842','1.89','2.27'),
('1684','TV-01','CV-01','1842','1.82','2.18'),
('1685','TV-01','CV-02','1843','1.36','1.63'),
('1686','TV-02','CV-01','1843','1.78','2.14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1687','TV-02','CV-02','1843','1.79','2.15'),
('1688','TV-02','CV-01','1843','1.65','1.98'),
('1689','TV-02','CV-02','1843','1.50','1.80'),
('1690','TV-02','CV-01','1844','1.41','1.69'),
('1691','TV-02','CV-02','1844','1.10','1.32'),
('1692','TV-01','CV-03','1844','1.15','1.38'),
('1693','TV-01','CV-03','1845','1.38','1.66'),
('1694','TV-01','CV-03','1845','1.66','1.99');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1695','TV-01','CV-04','1845','1.99','2.39'),
('1696','TV-01','CV-05','1846','2.39','2.87'),
('1697','TV-01','CV-01','1846','2.87','3.44'),
('1698','TV-01','CV-01','1846','4.40','5.28'),
('1699','TV-01','CV-01','1847','4.60','5.52'),
('1700','TV-01','CV-01','1847','4.85','5.82'),
('1701','TV-01','CV-01','1847','1.90','2.28'),
('1702','TV-01','CV-01','1848','1.98','2.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1703','TV-01','CV-01','1848','1.49','1.79'),
('1704','TV-01','CV-01','1848','2.49','2.99'),
('1705','TV-01','CV-01','1849','1.19','1.43'),
('1706','TV-01','CV-01','1849','2.57','3.08'),
('1707','TV-01','CV-01','1849','2.40','2.88'),
('1708','TV-01','CV-01','1849','3.48','4.18'),
('1709','TV-02','CV-01','1850','0.50','0.60'),
('1710','TV-02','CV-01','1850','0.54','0.65');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1711','TV-02','CV-01','1850','0.78','0.94'),
('1712','TV-01','CV-02','1851','0.49','0.59'),
('1713','TV-02','CV-02','1851','1.56','1.87'),
('1714','TV-01','CV-02','1851','1.94','2.33'),
('1715','TV-02','CV-02','1852','0.89','1.07'),
('1716','TV-01','CV-02','1852','1.06','1.27'),
('1717','TV-02','CV-02','1852','1.08','1.30'),
('1718','TV-01','CV-01','1853','1.59','1.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1719','TV-02','CV-01','1853','2.59','3.11'),
('1720','TV-01','CV-01','1853','2.20','2.64'),
('1721','TV-02','CV-01','1853','3.19','3.83'),
('1722','TV-01','CV-01','1854','4.20','5.04'),
('1723','TV-02','CV-01','1854','5.19','6.23'),
('1724','TV-01','CV-01','1854','6.18','7.42'),
('1725','TV-01','CV-02','1855','7.19','8.63'),
('1726','TV-01','CV-01','1855','8.09','9.71');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1727','TV-01','CV-02','1855','9.02','10.82'),
('1728','TV-01','CV-01','1856','10.90','13.08'),
('1729','TV-02','CV-02','1856','11.19','13.43'),
('1730','TV-02','CV-01','1856','12.50','15.00'),
('1731','TV-02','CV-02','1857','13.89','16.67'),
('1732','TV-01','CV-01','1857','14.19','17.03'),
('1733','TV-02','CV-02','1857','15.19','18.23'),
('1734','TV-01','CV-01','1857','16.09','19.31');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1735','TV-02','CV-02','1858','1.00','1.20'),
('1736','TV-01','CV-01','1858','2.00','2.40'),
('1737','TV-02','CV-02','1858','3.00','3.60'),
('1738','TV-01','CV-01','1858','4.00','4.80'),
('1739','TV-02','CV-02','1859','5.00','6.00'),
('1740','TV-01','CV-03','1859','6.00','7.20'),
('1741','TV-02','CV-03','1859','7.00','8.40'),
('1742','TV-01','CV-03','1860','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1743','TV-02','CV-04','1860','3.60','4.32'),
('1744','TV-01','CV-05','1860','1.80','2.16'),
('1745','TV-01','CV-02','1860','1.90','2.28'),
('1746','TV-01','CV-02','1860','5.30','6.36'),
('1747','TV-01','CV-02','1861','3.60','4.32'),
('1748','TV-01','CV-02','1861','4.32','5.18'),
('1749','TV-01','CV-02','1861','2.40','2.88'),
('1750','TV-01','CV-02','1861','2.88','3.46');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1751','TV-01','CV-01','1861','1.20','1.44'),
('1752','TV-01','CV-01','1862','1.44','1.73'),
('1753','TV-01','CV-01','1862','1.72','2.06'),
('1754','TV-01','CV-01','1862','20.60','24.72'),
('1755','TV-01','CV-01','1862','2.06','2.47'),
('1756','TV-01','CV-01','1862','1.50','1.80'),
('1757','TV-01','CV-01','1863','1.80','2.16'),
('1758','TV-01','CV-02','1863','1.09','1.31'),
('1759','TV-02','CV-01','1863','1.05','1.26');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1760','TV-02','CV-02','1864','1.26','1.51'),
('1761','TV-02','CV-01','1864','1.31','1.57'),
('1762','TV-02','CV-02','1864','1.51','1.81'),
('1763','TV-01','CV-01','1865','2.57','3.08'),
('1764','TV-01','CV-02','1865','3.08','3.70'),
('1765','TV-01','CV-01','1865','7.30','8.76'),
('1766','TV-02','CV-02','1866','1.60','1.92');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1767','TV-02','CV-01','1866','2.90','3.48'),
('1768','TV-02','CV-02','1866','4.80','5.76'),
('1769','TV-02','CV-01','1867','1.05','1.26'),
('1770','TV-01','CV-02','1867','1.07','1.28'),
('1771','TV-01','CV-01','1867','2.08','2.50'),
('1772','TV-01','CV-02','1868','2.09','2.51'),
('1773','TV-01','CV-03','1868','20.70','24.84'),
('1774','TV-01','CV-03','1868','20.60','24.72');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1775','TV-01','CV-03','1869','2.06','2.47'),
('1776','TV-02','CV-04','1869','2.08','2.50'),
('1777','TV-02','CV-05','1869','1.06','1.27'),
('1778','TV-02','CV-02','1870','1.05','1.26'),
('1779','TV-02','CV-02','1870','1.59','1.91'),
('1780','TV-02','CV-02','1870','1.48','1.78'),
('1781','TV-02','CV-02','1871','1.49','1.79'),
('1782','TV-01','CV-02','1871','1.90','2.28');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1783','TV-01','CV-02','1872','1.49','1.79'),
('1784','TV-01','CV-01','1872','1.13','1.36'),
('1785','TV-01','CV-01','1873','1.49','1.79'),
('1786','TV-01','CV-01','1873','1.89','2.27'),
('1787','TV-01','CV-01','1874','1.82','2.18'),
('1788','TV-01','CV-01','1874','1.36','1.63'),
('1789','TV-01','CV-01','1875','1.78','2.14'),
('1790','TV-01','CV-01','1875','1.79','2.15');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1791','TV-01','CV-02','1876','1.65','1.98'),
('1792','TV-01','CV-01','1876','1.50','1.80'),
('1793','TV-01','CV-02','1877','1.41','1.69'),
('1794','TV-01','CV-01','1877','1.10','1.32'),
('1795','TV-01','CV-02','1878','1.15','1.38'),
('1796','TV-01','CV-01','1878','1.38','1.66'),
('1797','TV-01','CV-02','1879','1.66','1.99'),
('1798','TV-01','CV-01','1879','1.99','2.39');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1799','TV-02','CV-02','1880','2.39','2.87'),
('1800','TV-02','CV-01','1880','2.87','3.44'),
('1801','TV-02','CV-02','1881','4.40','5.28'),
('1802','TV-01','CV-01','1881','4.60','5.52'),
('1803','TV-02','CV-02','1882','4.85','5.82'),
('1804','TV-01','CV-01','1882','1.90','2.28'),
('1805','TV-02','CV-02','1883','1.98','2.38'),
('1806','TV-01','CV-03','1883','1.49','1.79');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1807','TV-02','CV-03','1883','2.49','2.99'),
('1808','TV-01','CV-03','1884','1.19','1.43'),
('1809','TV-02','CV-04','1884','2.57','3.08'),
('1810','TV-01','CV-05','1884','2.40','2.88'),
('1811','TV-02','CV-02','1885','3.48','4.18'),
('1812','TV-01','CV-02','1885','0.50','0.60'),
('1813','TV-02','CV-02','1885','0.54','0.65');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1814','TV-01','CV-02','1886','0.78','0.94'),
('1815','TV-01','CV-02','1886','0.49','0.59'),
('1816','TV-01','CV-02','1886','1.56','1.87'),
('1817','TV-01','CV-01','1887','1.94','2.33'),
('1818','TV-01','CV-01','1887','0.89','1.07'),
('1819','TV-02','CV-01','1887','1.06','1.27'),
('1820','TV-02','CV-01','1888','1.08','1.30'),
('1821','TV-02','CV-01','1888','1.59','1.91'),
('1822','TV-01','CV-01','1888','2.59','3.11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1823','TV-02','CV-01','1889','2.20','2.64'),
('1824','TV-01','CV-02','1889','3.19','3.83'),
('1825','TV-02','CV-01','1889','4.20','5.04'),
('1826','TV-01','CV-02','1890','5.19','6.23'),
('1827','TV-02','CV-01','1890','6.18','7.42'),
('1828','TV-01','CV-02','1890','7.19','8.63'),
('1829','TV-02','CV-01','1891','8.09','9.71'),
('1830','TV-01','CV-02','1891','9.02','10.82');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1831','TV-02','CV-01','1891','10.90','13.08'),
('1832','TV-01','CV-02','1892','11.19','13.43'),
('1833','TV-02','CV-01','1892','12.50','15.00'),
('1834','TV-01','CV-02','1892','13.89','16.67'),
('1835','TV-01','CV-01','1893','14.19','17.03'),
('1836','TV-02','CV-02','1893','15.19','18.23'),
('1837','TV-01','CV-01','1893','16.09','19.31');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1838','TV-01','CV-02','1894','4.13','4.96'),
('1839','TV-02','CV-03','1894','13.40','16.08'),
('1840','TV-01','CV-03','1894','2.49','2.99'),
('1841','TV-02','CV-03','1895','1.50','1.80'),
('1842','TV-01','CV-04','1895','1.49','1.79'),
('1843','TV-02','CV-05','1895','1.90','2.28'),
('1844','TV-01','CV-01','1896','1.99','2.39'),
('1845','TV-02','CV-01','1896','2.09','2.51');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1846','TV-01','CV-01','1896','0.79','0.95'),
('1847','TV-02','CV-01','1897','0.98','1.18'),
('1848','TV-01','CV-01','1897','0.70','0.84'),
('1849','TV-02','CV-01','1897','1.19','1.43'),
('1850','TV-01','CV-01','1898','1.98','2.38'),
('1851','TV-02','CV-01','1898','1.89','2.27'),
('1852','TV-01','CV-01','1898','8.19','9.83'),
('1853','TV-02','CV-01','1899','0.89','1.07');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1854','TV-01','CV-01','1899','1.45','1.74'),
('1855','TV-01','CV-01','1899','1.05','1.26'),
('1856','TV-01','CV-01','1900','1.50','1.80'),
('1857','TV-01','CV-01','1900','1.98','2.38'),
('1858','TV-01','CV-01','1900','1.89','2.27'),
('1859','TV-01','CV-02','1900','1.89','2.27'),
('1860','TV-01','CV-03','1900','1.98','2.37'),
('1861','TV-01','CV-04','1900','1.40','1.68');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1862','TV-01','CV-05','1900','1.20','1.44'),
('1863','TV-01','CV-02','1901','1.89','2.27'),
('1864','TV-01','CV-01','1901','1.80','2.16'),
('1865','TV-01','CV-02','1901','1.50','1.80'),
('1866','TV-01','CV-03','1901','1.50','1.80'),
('1867','TV-01','CV-03','1901','1.79','2.15'),
('1868','TV-01','CV-03','1902','2.49','2.99'),
('1869','TV-01','CV-04','1902','1.98','2.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1870','TV-02','CV-05','1902','1.49','1.79'),
('1871','TV-02','CV-01','1902','2.08','2.50'),
('1872','TV-02','CV-01','1902','3.09','3.70'),
('1873','TV-02','CV-01','1903','5.07','6.08'),
('1874','TV-01','CV-01','1903','5.09','6.11'),
('1875','TV-01','CV-01','1903','2.09','2.51'),
('1876','TV-01','CV-01','1903','3.81','4.57'),
('1877','TV-02','CV-01','1903','4.09','4.91');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1878','TV-02','CV-01','1903','1.08','1.30'),
('1879','TV-02','CV-01','1903','1.48','1.78'),
('1880','TV-02','CV-01','1903','1.78','2.14'),
('1881','TV-01','CV-01','1903','1.90','2.28'),
('1882','TV-01','CV-01','1904','1.09','1.31'),
('1883','TV-01','CV-01','1904','2.90','3.48'),
('1884','TV-01','CV-01','1904','2.79','3.35'),
('1885','TV-01','CV-01','1904','3.80','4.56');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1886','TV-01','CV-02','1904','2.98','3.58'),
('1887','TV-02','CV-03','1904','3.98','4.78'),
('1888','TV-02','CV-04','1905','1.74','2.09'),
('1889','TV-02','CV-05','1905','1.50','1.80'),
('1890','TV-02','CV-02','1905','1.30','1.56'),
('1891','TV-02','CV-01','1905','1.01','1.21'),
('1892','TV-02','CV-02','1905','1.02','1.22'),
('1893','TV-01','CV-03','1905','1.03','1.24');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1894','TV-01','CV-03','1906','1.04','1.25'),
('1895','TV-01','CV-03','1906','1.05','1.26'),
('1896','TV-01','CV-04','1906','1.06','1.27'),
('1897','TV-01','CV-05','1906','1.07','1.28'),
('1898','TV-01','CV-01','1906','1.08','1.30'),
('1899','TV-01','CV-01','1906','1.09','1.31'),
('1900','TV-01','CV-01','1906','1.10','1.32');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1901','TV-01','CV-01','1907','1.74','2.09'),
('1902','TV-01','CV-01','1907','1.50','1.80'),
('1903','TV-01','CV-01','1907','1.30','1.56'),
('1904','TV-01','CV-01','1907','1.01','1.21'),
('1905','TV-01','CV-01','1908','1.02','1.22'),
('1906','TV-01','CV-01','1908','1.03','1.24'),
('1907','TV-01','CV-01','1908','1.04','1.25');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1908','TV-01','CV-01','1908','1.05','1.26'),
('1909','TV-01','CV-01','1908','1.06','1.27'),
('1910','TV-02','CV-01','1908','1.07','1.28'),
('1911','TV-02','CV-01','1909','1.08','1.30'),
('1912','TV-02','CV-01','1909','1.09','1.31'),
('1913','TV-01','CV-02','1909','1.10','1.32'),
('1914','TV-02','CV-03','1909','4.13','4.96');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1915','TV-01','CV-04','1909','13.40','16.08'),
('1916','TV-02','CV-05','1909','2.49','2.99'),
('1917','TV-01','CV-02','1909','1.50','1.80'),
('1918','TV-02','CV-02','1909','1.49','1.79'),
('1919','TV-01','CV-02','1909','1.90','2.28'),
('1920','TV-02','CV-02','1910','1.99','2.39'),
('1921','TV-01','CV-02','1910','2.09','2.51');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1922','TV-02','CV-02','1910','0.79','0.95'),
('1923','TV-01','CV-01','1910','0.98','1.18'),
('1924','TV-02','CV-01','1910','0.70','0.84'),
('1925','TV-01','CV-01','1910','1.19','1.43'),
('1926','TV-01','CV-01','1910','1.98','2.38'),
('1927','TV-01','CV-01','1911','1.89','2.27'),
('1928','TV-01','CV-01','1911','8.19','9.83');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1929','TV-01','CV-01','1911','0.89','1.07'),
('1930','TV-02','CV-02','1911','1.45','1.74'),
('1931','TV-02','CV-01','1911','1.05','1.26'),
('1932','TV-02','CV-02','1911','1.50','1.80'),
('1933','TV-01','CV-01','1911','1.98','2.38'),
('1934','TV-02','CV-02','1912','1.89','2.27'),
('1935','TV-01','CV-01','1912','1.89','2.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1936','TV-02','CV-02','1912','1.98','2.37'),
('1937','TV-01','CV-01','1912','1.40','1.68'),
('1938','TV-02','CV-02','1913','1.20','1.44'),
('1939','TV-01','CV-01','1913','1.89','2.27'),
('1940','TV-02','CV-02','1913','1.80','2.16'),
('1941','TV-01','CV-01','1913','1.50','1.80'),
('1942','TV-02','CV-02','1914','1.50','1.80'),
('1943','TV-01','CV-01','1914','1.79','2.15');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1944','TV-02','CV-02','1914','2.49','2.99'),
('1945','TV-01','CV-03','1915','1.98','2.38'),
('1946','TV-01','CV-03','1915','1.49','1.79'),
('1947','TV-02','CV-03','1915','2.08','2.50'),
('1948','TV-01','CV-04','1915','3.09','3.70'),
('1949','TV-01','CV-05','1915','5.07','6.08'),
('1950','TV-02','CV-02','1915','5.09','6.11');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1951','TV-01','CV-02','1916','2.09','2.51'),
('1952','TV-02','CV-02','1916','3.81','4.57'),
('1953','TV-01','CV-02','1916','4.09','4.91'),
('1954','TV-02','CV-02','1916','1.08','1.30'),
('1955','TV-01','CV-02','1916','1.48','1.78'),
('1956','TV-02','CV-01','1917','1.78','2.14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1957','TV-01','CV-01','1917','1.90','2.28'),
('1958','TV-02','CV-01','1917','1.09','1.31'),
('1959','TV-01','CV-01','1917','2.90','3.48'),
('1960','TV-02','CV-01','1917','2.79','3.35'),
('1961','TV-01','CV-01','1917','3.80','4.56'),
('1962','TV-02','CV-01','1918','2.98','3.58');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1963','TV-01','CV-02','1918','3.98','4.78'),
('1964','TV-02','CV-01','1918','1.74','2.09'),
('1965','TV-01','CV-02','1918','1.50','1.80'),
('1966','TV-01','CV-01','1918','1.30','1.56'),
('1967','TV-01','CV-02','1918','1.01','1.21'),
('1968','TV-01','CV-01','1919','1.02','1.22'),
('1969','TV-01','CV-02','1919','1.03','1.24');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1970','TV-01','CV-01','1919','1.04','1.25'),
('1971','TV-01','CV-02','1919','1.05','1.26'),
('1972','TV-01','CV-01','1919','1.06','1.27'),
('1973','TV-01','CV-02','1919','1.07','1.28'),
('1974','TV-01','CV-01','1919','1.08','1.30'),
('1975','TV-01','CV-02','1919','1.09','1.31'),
('1976','TV-01','CV-01','1919','1.10','1.32'),
('1977','TV-01','CV-02','1919','1.74','2.09');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1978','TV-01','CV-03','1920','1.50','1.80'),
('1979','TV-01','CV-03','1920','1.30','1.56'),
('1980','TV-01','CV-03','1920','1.01','1.21'),
('1981','TV-02','CV-04','1920','1.02','1.22'),
('1982','TV-02','CV-05','1920','1.03','1.24'),
('1983','TV-02','CV-02','1920','1.04','1.25'),
('1984','TV-02','CV-02','1920','1.05','1.26'),
('1985','TV-01','CV-02','1921','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1986','TV-01','CV-02','1921','1.07','1.28'),
('1987','TV-01','CV-02','1921','1.08','1.30'),
('1988','TV-02','CV-02','1921','1.09','1.31'),
('1989','TV-02','CV-01','1921','1.10','1.32'),
('1990','TV-02','CV-01','1922','4.13','4.96'),
('1991','TV-02','CV-01','1922','13.40','16.08'),
('1992','TV-01','CV-01','1922','2.49','2.99'),
('1993','TV-01','CV-01','1922','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('1994','TV-01','CV-01','1922','1.49','1.79'),
('1995','TV-01','CV-01','1922','1.90','2.28'),
('1996','TV-01','CV-02','1923','1.99','2.39'),
('1997','TV-01','CV-01','1923','2.09','2.51'),
('1998','TV-02','CV-02','1923','0.79','0.95'),
('1999','TV-02','CV-01','1924','0.98','1.18'),
('2000','TV-02','CV-02','1925','0.70','0.84'),
('2001','TV-02','CV-01','1926','1.19','1.43');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2002','TV-02','CV-02','1927','1.98','2.38'),
('2003','TV-02','CV-01','1928','1.89','2.27'),
('2004','TV-01','CV-02','1929','8.19','9.83'),
('2005','TV-01','CV-01','1930','0.89','1.07'),
('2006','TV-01','CV-02','1931','1.45','1.74'),
('2007','TV-01','CV-01','1932','1.05','1.26'),
('2008','TV-01','CV-02','1933','1.50','1.80'),
('2009','TV-01','CV-01','1934','1.98','2.38');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2010','TV-01','CV-02','1935','1.89','2.27'),
('2011','TV-01','CV-03','1936','1.89','2.27'),
('2012','TV-01','CV-03','1937','1.98','2.37'),
('2013','TV-01','CV-03','1938','1.40','1.68'),
('2014','TV-01','CV-04','1939','1.20','1.44'),
('2015','TV-01','CV-05','1940','1.89','2.27'),
('2016','TV-01','CV-02','1941','1.80','2.16'),
('2017','TV-01','CV-02','1942','1.50','1.80');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2018','TV-01','CV-02','1943','1.50','1.80'),
('2019','TV-01','CV-02','1944','1.79','2.15'),
('2020','TV-01','CV-02','1945','2.49','2.99'),
('2021','TV-02','CV-02','1946','1.98','2.38'),
('2022','TV-02','CV-01','1947','1.49','1.79'),
('2023','TV-02','CV-01','1948','2.08','2.50'),
('2024','TV-01','CV-01','1949','3.09','3.70'),
('2025','TV-02','CV-01','1950','5.07','6.08');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2026','TV-01','CV-01','1951','5.09','6.11'),
('2027','TV-02','CV-01','1952','2.09','2.51'),
('2028','TV-01','CV-01','1953','3.81','4.57'),
('2029','TV-02','CV-02','1954','4.09','4.91'),
('2030','TV-01','CV-01','1955','1.08','1.30'),
('2031','TV-02','CV-02','1956','1.48','1.78'),
('2032','TV-01','CV-01','1957','1.78','2.14');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2033','TV-02','CV-02','1958','1.90','2.28'),
('2034','TV-01','CV-01','1959','1.09','1.31'),
('2035','TV-02','CV-02','1960','2.90','3.48'),
('2036','TV-01','CV-01','1961','2.79','3.35'),
('2037','TV-01','CV-02','1962','3.80','4.56'),
('2038','TV-01','CV-01','1963','2.98','3.58'),
('2039','TV-01','CV-02','1964','3.98','4.78');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2040','TV-01','CV-01','1965','1.74','2.09'),
('2041','TV-02','CV-02','1966','1.50','1.80'),
('2042','TV-02','CV-01','1967','1.30','1.56'),
('2043','TV-02','CV-02','1968','1.01','1.21'),
('2044','TV-01','CV-03','1969','1.02','1.22'),
('2045','TV-02','CV-03','1970','1.03','1.24'),
('2046','TV-01','CV-03','1971','1.04','1.25'),
('2047','TV-02','CV-04','1972','1.05','1.26');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2048','TV-01','CV-05','1973','1.06','1.27'),
('2049','TV-02','CV-01','1974','1.07','1.28'),
('2050','TV-01','CV-01','1975','1.08','1.30'),
('2051','TV-02','CV-01','1976','1.09','1.31'),
('2052','TV-01','CV-01','1977','1.10','1.32'),
('2053','TV-02','CV-01','1978','1.74','2.09'),
('2054','TV-01','CV-01','1979','1.50','1.80'),
('2055','TV-02','CV-01','1980','1.30','1.56');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2056','TV-01','CV-01','1981','1.01','1.21'),
('2057','TV-01','CV-01','1982','1.02','1.22'),
('2058','TV-02','CV-01','1983','1.03','1.24'),
('2059','TV-01','CV-01','1984','1.04','1.25'),
('2060','TV-01','CV-01','1985','1.05','1.26'),
('2061','TV-02','CV-01','1986','1.06','1.27'),
('2062','TV-01','CV-01','1987','1.07','1.28'),
('2063','TV-02','CV-01','1988','1.08','1.30');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2064','TV-01','CV-02','1989','1.09','1.31'),
('2065','TV-02','CV-02','1990','1.10','1.32'),
('2066','TV-01','CV-02','1991','1.01','1.21'),
('2067','TV-02','CV-02','1992','1.02','1.22'),
('2068','TV-01','CV-02','1993','1.03','1.24'),
('2069','TV-02','CV-02','1994','1.04','1.25'),
('2070','TV-02','CV-01','1996','1.06','1.27');

-- -------------------------------------------------------------------------------------

INSERT INTO `vical`.`vidrio` (`CODIGO_VIDRIO`,`CODIGO_TIPO`,`CODIGO_COLOR`,`CODIGO_FACTURA`,`CANTIDAD_VIDRIO`,`PRECIO`)
VALUES
('2071','TV-01','CV-01','1997','1.07','1.28'),
('2072','TV-02','CV-01','1998','1.08','1.30'),
('2073','TV-01','CV-01','1999','1.09','1.31'),
('2074','TV-02','CV-01','2000','1.10','1.32'),
('2075','TV-01','CV-01','2000','1.10','1.32');

/*==============================================================*/
/* Table: USUARIOS                                               */
/*==============================================================*/
INSERT INTO `vical`.`usuarios` (`USUARIO`,`PASSWORD`,`TIPO_USUARIO`)
VALUES
('Erick','erick','admin');
-- -------------------------------------------------------------------------------------