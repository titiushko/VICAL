create database VICAL default character set latin1 collate latin1_bin;
use VICAL;
-- -------------------------------------------------------------------------------------
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
/* Table: FACTURAS                                     			*/
/*==============================================================*/
create table FACTURAS
(
   CODIGO_FACTURA    			char(5) not null,
   CODIGO_PROVEEDOR     		int(5) not null,
   CODIGO_RECOLECTOR    		char(5) not null,
   CODIGO_CENTRO_ACOPIO			char(6) not null,
   PRECIO_COMPRA         		float(2),
   SUCURSAL			    		varchar(6) not null,
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
/* Table: PRECIO			                                    */
/*==============================================================*/
create table PRECIOS (
   CODIGO_PRECIO				int(5) auto_increment not null,
   PRECIO_UNITARIO 				float(4) not null default '1.2',
   primary key (CODIGO_PRECIO)
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
   ESTADO 						varchar(7) not null,
   primary key (ID)
 )
ENGINE=InnoDB DEFAULT CHAR SET=utf8;
/*==============================================================*/
/* Relaciones                                                   */
/*==============================================================*/
ALTER TABLE CENTROS_DE_ACOPIO ADD CONSTRAINT FK_ADMINISTRA FOREIGN KEY (CODIGO_RECOLECTOR) REFERENCES RECOLECTORES (CODIGO_RECOLECTOR) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE PROVEEDORES ADD CONSTRAINT FK_ESPECIFICA FOREIGN KEY (CODIGO_TIPO_EMPRESA) REFERENCES TIPOS_EMPRESAS (CODIGO_TIPO_EMPRESA) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE FACTURAS ADD CONSTRAINT FK_REGISTRA FOREIGN KEY (CODIGO_RECOLECTOR) REFERENCES RECOLECTORES (CODIGO_RECOLECTOR) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE FACTURAS ADD CONSTRAINT FK_PERTENECE FOREIGN KEY (CODIGO_PROVEEDOR) REFERENCES PROVEEDORES (CODIGO_PROVEEDOR) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE FACTURAS ADD CONSTRAINT FK_GUARDA FOREIGN KEY (CODIGO_CENTRO_ACOPIO) REFERENCES CENTROS_DE_ACOPIO (CODIGO_CENTRO_ACOPIO) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE COMPRAS ADD CONSTRAINT FK_REALIZA FOREIGN KEY (CODIGO_FACTURA) REFERENCES FACTURAS (CODIGO_FACTURA) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE VIDRIO ADD CONSTRAINT FK_DETALLA FOREIGN KEY (CODIGO_COLOR) REFERENCES COLORES_VIDRIO (CODIGO_COLOR) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE VIDRIO ADD CONSTRAINT FK_INCLUYE FOREIGN KEY (CODIGO_TIPO) REFERENCES TIPOS_VIDRIO (CODIGO_TIPO) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE VIDRIO ADD CONSTRAINT FK_POSEE FOREIGN KEY (CODIGO_FACTURA) REFERENCES FACTURAS (CODIGO_FACTURA) ON DELETE CASCADE ON UPDATE CASCADE;
-- ALTER TABLE VIDRIO ADD CONSTRAINT FK_POSEE FOREIGN KEY (CODIGO_FACTURA) REFERENCES FACTURAS (CODIGO_FACTURA) ON DELETE CASCADE ON UPDATE CASCADE;
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*==============================================================*/
/* Table: TIPOS_EMPRESAS                                        */
/*==============================================================*/
INSERT INTO TIPOS_EMPRESAS (CODIGO_TIPO_EMPRESA, NOMBRE_TIPO_EMPRESA) VALUES
('TE-01', 'Alcaldia'),
('TE-02', 'Club Nocturno'),
('TE-03', 'Discoteca'),
('TE-04', 'Empresa Varia'),
('TE-05', 'Hotel'),
('TE-06', 'Laboratorio'),
('TE-07', 'Licoreria'),
('TE-08', 'Relleno Sanitario'),
('TE-09', 'Restaurante'),
('TE-10', 'Vidriera'),
('TE-11', 'Persona Comun');
/*==============================================================*/
/* Table: TIPOS_VIDRIO                                          */
/*==============================================================*/
INSERT INTO TIPOS_VIDRIO (CODIGO_TIPO, NOMBRE_TIPO) VALUES
('TV-01', 'BOTELLA'),
('TV-02', 'PLANO');
/*==============================================================*/
/* Table: COLORES_VIDRIO                                        */
/*==============================================================*/
INSERT INTO COLORES_VIDRIO (CODIGO_COLOR, NOMBRE_COLOR) VALUES
('CV-01', 'CLARO'),
('CV-02', 'VERDE'),
('CV-03', 'CAFE'),
('CV-04', 'BRONCE'),
('CV-05', 'REFLECTIVO');
/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
INSERT INTO USUARIOS (NOMBRE, USUARIO, PASSWORD, NIVEL, ESTADO) VALUES
('Super Usuario', 'super', 'super', '1', 'offline');
/*==============================================================*/
/* Table: PRECIO			                                    */
/*==============================================================*/
INSERT INTO PRECIOS (CODIGO_PRECIO, PRECIO_UNITARIO) VALUES
(1, 0.9);
/*==============================================================*/
/* Table: PROVEEDORES                                           */
/*==============================================================*/
INSERT INTO PROVEEDORES (CODIGO_PROVEEDOR, CODIGO_TIPO_EMPRESA, NOMBRE_PROVEEDOR, DEPARTAMENTO, DIRECCION_PROVEEDOR, TELEFONO_PROVEEDOR1, TELEFONO_PROVEEDOR2, CONTACTO, ESTANON) VALUES
(1, 'TE-10', 'YOHANA', 'San Salvador', 'Av monsenor Romero 10 calle oriente por ex - cine Plaza San salvador', '2271-5813', '2502-9742', 'Luis Cardoza', '3'),
(2, 'TE-10', 'ESTRELLA', 'San Salvador', 'Av monsenor romero # 525 frente a ex- cine plaza san salvador', '2249-7048', '2281-5764', 'Julio Ungo', '4'),
(3, 'TE-10', 'FRANCIA', 'San Salvador', 'Av monsenor romero # 506 frente a ex- cine plaza san salvador', '2271-8449', NULL, 'Irma Chacon', '2'),
(4, 'TE-10', 'VENECIA', 'San Salvador', '2 av sur # 609 San salvador', '2222-8019', '2100-3036', 'Mario Venitez', '4'),
(5, 'TE-10', 'HENRIQUEZ', 'San Salvador', '10 C OTE # 306 Mercado Belloso ', '2520-8836', NULL, 'Enrique Rivera', NULL),
(6, 'TE-10', 'ALUMICENTRO', 'San Salvador', '25 av Nte S.S Frente a Hospital Bloom', '2226-9800', NULL, 'Jacob Cuellar', '6'),
(7, 'TE-10', 'SOLAIRE ', 'San Salvador', '21 av sur y 4 c pte S.S Atras de didea', '2275-2100', NULL, 'Elmer Cruz', '10'),
(8, 'TE-08', 'MEANGUERA', 'Morazan', 'carretera a perquin', '2680/6430', '7904/5593', 'NOE PEREIRA', NULL),
(9, 'TE-10', 'ROSTRAN', 'San Salvador', 'Col. Milagro final 1 c ote San Marcos', '2103-3605', NULL, 'Celia Perez', '4'),
(10, 'TE-10', 'DISCOA ', 'San Salvador', 'Final 25 av Sur y pje 3 casa # 4 col santa Ursula San salvador', '2242-3681', '2242-0441', 'Jose Villegas', '2'),
(11, 'TE-10', 'VIDRIO CENTROAMERICANO', 'San Salvador', 'Av cuzcatlan #614  frente a la roca', '2222-3325', NULL, 'Susana mejia', NULL),
(12, 'TE-10', 'BONILLA', 'San Salvador', 'Col San antonio abad #721 col america', '2208-0322', NULL, 'Oscar Bonilla', '4'),
(13, 'TE-10', 'INSTALUM', 'San Salvador', 'Final 1 c ote col milagro san Marcos', '2556-8547', '2220-1589', 'Mario Rivera', NULL),
(14, 'TE-10', 'PROALVI', 'San Salvador', '29 av nte frente a teatro de camaras', '2234-7895', '7980-8786', 'Empleados', '3'),
(15, 'TE-10', 'LA ROCA', 'San Salvador', 'Av cuzcatlan #530  mercado belloso', '2221-3891', '2222-0840', 'Susana Barrientos', '4'),
(16, 'TE-10', 'LUZ AIRE', 'San Salvador', 'C cuzcatlan esquina opuesta a banco Agricola', '2249-7367', NULL, 'Aleida nunez', '2'),
(17, 'TE-10', 'INDUSTRIAL', 'San Salvador', '2 av nte y 33 c ote local 1804 mejicanos', '2226-7118', NULL, 'Benjamin Orantes', '4'),
(18, 'TE-10', 'VIDRERIA PINEDA', 'San Salvador', 'Calle modelo #349 San Salvador', '2270-1304', NULL, 'Sr. Elmer', '5'),
(19, 'TE-10', 'INDUSTRIAS PANOAMERICANAS', 'San Salvador', 'Final 27 Av sur y calle central #1426 Col. Cucumacayan san salvador', '2221-8686', NULL, 'trabajadores', '4'),
(20, 'TE-10', 'PRISMA', 'San Salvador', 'C chiltiupan pol. E ciudad merliot', '2221-1257', '71182056', 'Roxana de Noyola', '4'),
(21, 'TE-10', 'ALU ARQ', 'San Salvador', '35 Av sur # 633 entre 6 y decima y 12 calle poniente Col. Flor Blanca', '2298-8147', '7851-8750', 'Jesus de guevara', '3'),
(22, 'TE-10', 'INCO', 'San Salvador', 'Final 1 av norte 2 cuadras abajo de la alcaldia de Soyapango', '2251-6000', NULL, 'Jaime Eduardo Argueta', NULL),
(23, 'TE-10', 'ALUMINARTE', 'San Salvador', 'Col. Santa fe calle #180 San Marcos', '2213-0337', NULL, 'leonardo Recinos', '2'),
(24, 'TE-10', 'PENIEL', 'San Salvador', 'C chiltiupan frente a colegio espiritu santo', '2269-4200', NULL, 'Carlos Miranda', NULL),
(25, 'TE-10', 'INCO UNIVERSITARIA', 'San Salvador', 'Bodega universitaria', '2235-3905', NULL, 'Sr Pineda', '1R'),
(26, 'TE-10', 'MARTINEZ', 'San Salvador', 'Av catro moran local 16 mejicanos', '2317-3225', NULL, 'Cesar Martinez', '1'),
(27, 'TE-10', 'VITRA', 'San Salvador', 'Atras de iglesia el rosario San salvador', '2221-4542', '7887-2723', 'Alicia Mendez', '1R'),
(28, 'TE-10', 'INSTACIELO', 'San Salvador', '12 c oriente # 317 mercado Belloso', '2249-7048', '2221-1786', 'Ernesto Quintanilla', '3'),
(29, 'TE-10', 'INCO BELLOSO', 'San Salvador', '2 av sur # 520 mercado belloso', '2221-0758', NULL, 'Luisa Moreno', '2'),
(30, 'TE-10', 'NATANAEL', 'San Salvador', 'mercado belloso   ', '2532-5280', NULL, 'Sr.Solorsano', NULL),
(31, 'TE-10', 'LEMUS', 'San Salvador', '10 c ote # 12 Mercado Belloso', '2281-1000', NULL, 'Saul lemus', '2'),
(32, 'TE-10', 'UNIVERSALES', 'San Salvador', '2 Av sur local 629 belloso', '2222-3470', NULL, 'Fredy figueroa', NULL),
(33, 'TE-10', 'DIVENTANAS', 'San Salvador', '4 c ote y 19 av sur local 304', '2223-2688', NULL, 'Carlos Molina', NULL),
(34, 'TE-09', 'LA BOCANA', 'Libertad', 'Carretera litoral contiguo a Roca zunzal playa el tunco', '7888-8067', NULL, 'Luis Alonso delgado', '3'),
(35, 'TE-09', 'EL PASIFICO', 'Libertad', 'Carretera litoral playa el majahualy frente a hotel santa fe', '2310-6504', NULL, 'Nelson figueroa', '3'),
(36, 'TE-09', 'ROCA ZUMZAL', 'Libertad', 'Carretera litoral playa el Zunzal', '2389-6126', NULL, 'Oscar miranda', '3'),
(37, 'TE-09', 'SANTA FE', 'Libertad', 'Carretera litoral playa el majahualt', '2389-5489', NULL, 'Orlando Jimenes', '3'),
(38, 'TE-09', 'DOLCE VITA', 'Libertad', 'Carretera litoral Siguiendo playa san diego ctgo a curva de don gere', '2335-3592', NULL, 'Maria rodriguez', '3'),
(39, 'TE-09', 'CURVA DE DON GERE', 'Libertad', 'Carretera litoral siguiendo playa san diego ctgo a dolce vita', '2335-3436', '7927-2730', 'Miguel sibrian', '3'),
(40, 'TE-09', 'LA OLA VETOS', 'San Salvador', 'Col. Miramonte atras de hotel intercontinental', '7898-9751', NULL, 'Sr. Carmen', '3'),
(41, 'TE-09', 'DISCO SKEY', 'San Salvador', 'Prolongacion juan pablo 2 por colegio lavalle Lc 313a y 307a San salvador', '2261-0724', NULL, 'Pedro Antonio Arevalo', '3'),
(42, 'TE-09', 'SOPON ZACAMIL', 'San Salvador', 'Col zacamil pje 3 #2 frente a pnc.', '2272-5198', NULL, 'Nelson Martinez', '2'),
(43, 'TE-09', 'RANCHOS EL SALVADOR', 'San Salvador', 'Zona Rosa por Restauran Cancun.', '2264-5858', NULL, 'Sr. Carlos', NULL),
(44, 'TE-10', 'INSTALACINES INTERIANO', 'Soyapango', 'Col los alpes pje 3 lote 69', '2277-8238', NULL, 'Elena Henriquez', NULL),
(45, 'TE-10', 'LUNA SOL', 'San Jacinto', 'Av los diplomaticos 1336 por ex casa Presidencial', '2270-1639', NULL, 'Despachador', NULL),
(46, 'TE-05', 'HILTON PRINSES', 'San Salvador', '1c poniente Zona Rosa Esquina opuesta a Jala La Jarra', '2268-4545', '7325-8708', 'Alexander Arevalo', '3'),
(47, 'TE-05', 'SHERATON P.', 'San Salvador', 'Final av revolucion san benito', '2283-4078', NULL, 'Silvia Madrid', '6'),
(48, 'TE-04', 'MULTIPROYECTOS (TITAC)', 'San Salvador', '8 c ote #632 Barrio la vega', '2221-6201', NULL, 'Mauricio Calderon', NULL),
(49, 'TE-10', 'SAN GERARDO', 'San Salvador', ' cl concepcion 513 por la tiendona', '2222-5154', NULL, 'Jaime Abarca', NULL),
(50, 'TE-06', 'ANCALMO ', 'San Salvador', 'Antiguo Cuzcatlan', '2243-0100', NULL, 'Elga de olmedo', NULL),
(51, 'TE-06', 'ARSAL ', 'San Salvador', 'Ca san jacinto frente al Zoologico Nacional', '2231-1335', NULL, 'Lic Paty', '3'),
(52, 'TE-04', 'COMAGUI', 'San Salvador', '28 c poniente 49 av sur # 2523 san salvador', '2510-0518', NULL, 'William vazques', '3'),
(53, 'TE-04', 'RECIPLAS', 'San Salvador', 'Alameda roosevelt y 55 av norte edificio Ipsfa 4 planta San salvador', '2290-6606', '2260-6607', 'Mauricio Saravia', '12'),
(54, 'TE-04', 'ESC. AMERICANA', 'San Salvador', 'San Benito', '2528-8275', '7859-4322', 'Celina Aguirreurreta', '3'),
(55, 'TE-04', 'DILICO', 'San Salvador', 'Carretera a sonsonate desvio del cria aves', '2298-7845', '7433-0495', 'Rafael', NULL),
(56, 'TE-04', 'MC CORMIC', 'San Salvador', 'Antiguo Cuzcatlan', '2212-8579', NULL, 'Fatima de Chavez', '2'),
(57, 'TE-04', 'ECOSEVICIOS', 'San Salvador', 'C antigua a tonacatepeque #125 Soyapango San salvador', '2227-0029', '7986-6870', 'Romel Castro', NULL),
(58, 'TE-04', 'SHELTERS', 'San Salvador', 'Blvd los proceres centro de oficinas la sultana L110 Antiguo cuzcatlan', '2434-6892', '2439-7222', 'Ricardo Mejia', NULL),
(59, 'TE-04', 'COCA COLA', 'San Salvador', 'Carretera Panoamericana Nejapa', '2239-4527', '7844-4229', 'Alejandro acevedo', NULL),
(60, 'TE-04', 'CERVECERIA', 'San Salvador', 'Av independencia Frente a reloj de Flores', '2231-5239', '7745-7885', 'Edwin Lemus', NULL),
(61, 'TE-04', 'INVERSIONES MONTECARLOS', 'San Salvador', 'Final av san martin # 4-7 santa tecla', '2241-0470', NULL, 'Rene villalobos', '10'),
(62, 'TE-10', 'NASARETH', 'Santa Tecla', '7 av sur 4-6', '2531-1433', NULL, 'Cristian Sanchez', NULL),
(63, 'TE-10', 'ADECORAVI', 'Soyapango', 'C roosvelt poniente  #27', '7002-3675', NULL, 'Elida de Monterrosa', NULL),
(64, 'TE-10', 'V. 911', 'San Salvador', '49 av sur contiguo a 911 de pnc.', '2275-9631', NULL, 'Sr. Luis', NULL),
(65, 'TE-10', 'ELIM', 'San Salvador', 'Bulevard constitucion 504 ', '2262-4865', NULL, 'Sr. Elim Garcia', NULL),
(66, 'TE-10', 'V: ROCA', 'San Salvador', '79 av sur col escalon #6', '2264-0238', NULL, 'Empleados', NULL),
(67, 'TE-10', 'TECNICIELO', 'Lourdes', 'Col las delicias #6', '2318-0393', NULL, 'Armando Arcia', NULL),
(68, 'TE-10', 'JERUSALEN', 'San Salvador', 'Alameda juan Pablo 2 y 2 av nte 502', '2222-6438', NULL, 'Santos Portillo', NULL),
(69, 'TE-10', 'LAS BRISAS', 'Lourdes', 'Km 24 y medio frente a castano', '2318-6464', NULL, 'Sr. Jorge', NULL),
(70, 'TE-04', 'ECOSANTE', 'Santa Tecla', 'Col Quesaltepec final pje 1 contiguo a bomba de anda', '7270-2618', NULL, 'Carlos Rivara', '5'),
(71, 'TE-10', 'TARCIS', 'Santa Tecla', '7 av nte 11 c ote bis plg 33 #3', '2288-2561', NULL, 'Roxana Bonilla', NULL),
(72, 'TE-10', 'JOEL', 'Santa Tecla', '4 cl pte #2-4 b', '2100-2188', NULL, 'Carlos Diaz', NULL),
(73, 'TE-10', 'INCO', 'Santa Tecla', '4 cl pte#3-5 b barrio candelaria', '7850-9207', NULL, 'Jose cruz', NULL),
(74, 'TE-04', 'UNIVERSIDAD NACIONAL', 'San Salvador', 'Autopista nte Universidad Nacional', '7160-5966', NULL, 'LIC. De Soriano', NULL),
(75, 'TE-04', 'AMAR', 'San Salvador', 'Constitucion pje francisco #540', '2262-1152', NULL, 'Francisco Rivas', '3'),
(76, 'TE-03', 'CERO GRADOS', 'San Salvador', 'Paseo General Escalon ', '7983-3344', NULL, 'Chino', '3'),
(77, 'TE-03', 'JUNGLE', 'San Salvador', 'Zona Rosa frente a mac donals', '7701-7187', NULL, 'Xiomara', '3'),
(78, 'TE-10', 'LUZ AIRE', 'San Salvador', '20 c pte 2501 col. Luz', '2298-1860', NULL, 'Juan Miranda', NULL),
(79, 'TE-10', 'EUSAl', 'San Salvador', 'Av Olimpica Por estadio Flor Blanca', '2276-4567', NULL, 'Yovanny', NULL),
(80, 'TE-07', 'CORDONCILLO', 'San Salvador', 'SECTOR SAN JUAN BOSCO 1 CANTON SAN ANDRES LIBERTAD', '2455-5086', NULL, 'Mauricio Saravia', '3'),
(81, 'TE-10', 'VEDECOR', 'San Jacinto', 'Col.santa carlota2 pje san francisco 14 Barrio san jacinto', '2275-6340', NULL, 'Carlos Regalado', '2'),
(82, 'TE-07', 'SAN MARINO', 'San Jacinto', '10 av sur 553 barrio la vega ex administracion de renta', NULL, NULL, 'Marbelly Flores', '3'),
(83, 'TE-08', 'SUCHITOTO', 'Cuzcatlan', 'Carretera a suchitoto relleno sanitario', '7786-5882', NULL, 'Nery Amaya', '3'),
(84, 'TE-09', 'LOS RINCONCITOS', 'San Salvador', 'Zona Rosa frente a Banco City', NULL, NULL, 'Vigilante', NULL),
(85, 'TE-10', 'COMERCIAL GALDAMEZ', 'San Salvador', '12 c ote 217 a el centro mercado Belloso.', '2271-3760', NULL, 'Alfonso Galdamez', NULL),
(86, 'TE-10', 'VENTANAS SAN PEDRO', 'San Salvador', '2 av sur monsenor arnulfo romero 617 mercado belloso', '2222-3466', NULL, 'Juan Mena', NULL),
(87, 'TE-10', 'VENTANAS CASTILLO', 'San Salvador', '4 av surblvd venezuela y 12 c ote frente a parqueo belloso', '2249-7717', '2222-8161', 'Leonardo Castillo', NULL),
(88, 'TE-10', 'PENIEL SOYAPANGO', 'San Salvador', 'Col. Guadalupe c principal y c franklin roosevelt  2 soyapango', '2277-5971', NULL, 'Jonathan Miranda', '2J'),
(89, 'TE-10', 'VIDRIERIA SANCHEZ', 'San Salvador', 'Av cuzcatlan mercado belloso.', '2222-6437', NULL, 'Veronica Sanchez', '1'),
(90, 'TE-09', 'WILLYS', 'San Salvador', 'Final 5 Cl pte y 11 av nte frente a indes Alameda Juan pablo 2', '2281-1519', NULL, 'Beatriz Pleitez', '3'),
(91, 'TE-02', 'QUESSON', 'San Salvador', 'C 5 de Noviembre 5 San Salvador', '7789-4512', NULL, 'Vigilante', '2'),
(92, 'TE-10', 'INDUSTRIAS EL EXITO', 'San Salvador', 'C al volcan pje palacios col. Zacamil mejicanos 5.', '2272-7522', NULL, 'Nelson Montenegro', '6'),
(93, 'TE-04', 'CORPORACION BONIMA', 'San Salvador', 'Blvad el ejercito frente a aeropuerto de ilopango.', '2224-1022', NULL, 'Oscar Mendoza', NULL),
(94, 'TE-09', 'LA GUITARRA', 'Libertad', 'Km 42 Carretera el Litoral playa el tunco', '2389-6398', NULL, 'Vigilante', '2'),
(95, 'TE-09', 'KAYU', 'Libertad', 'Km 44 playa el tunco', '2389-6135', NULL, 'Vigilante', '1B'),
(96, 'TE-05', 'HOTEL MOPELIA', 'Libertad', 'Km 42 carretera litoral tamanique', '2389-6265', NULL, 'Patricia guerra', '2'),
(97, 'TE-10', 'TORNOLARA', 'San Salvador', '27 c pte # 106 san Miguelito', '2235-3755', NULL, 'Jose luis Lara', '1'),
(98, 'TE-04', 'NONI TAHITI', 'San Salvador', 'Final 83 av sur cerca del centro espanol.', '7894-0539', NULL, 'Ana gloria palomo', NULL),
(99, 'TE-09', 'CEFE DON PEDRO merliot', 'Merliot', '17 av nte c chiultiupan esquina opuesta a plaza merliot', '2288-4334', NULL, 'Maria de los angeles', '3'),
(100, 'TE-09', 'CAFE DON PEDRO autopista nte', NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'TE-10', 'LEO', 'San Salvador', '10 c  120 Mercado Belloso.', '2271-4071', '7597-7343', 'Israel Lemus', NULL),
(102, 'TE-04', 'COPERATIVA AVACHAZ', 'San Salvador', 'Col. Zacamil ( punto de buses de la 44)', NULL, NULL, 'Carmen v. de Aguirre', NULL),
(103, 'TE-10', 'VID. MOLDURAS MELENDEZ', 'San Salvador', '8 Av sur y 4c ote atras de iglesia rosario', '2222-0454', '7730-9552', 'Jose Leonardo Perla', NULL),
(104, 'TE-10', 'ALUMANT', 'San Salvador', 'c modelo frente a comercial chacon.', '71241309', NULL, 'Rigoberto Lopez', NULL),
(105, 'TE-10', 'CUZCATLAN', 'San Salvador', NULL, NULL, NULL, NULL, '1'),
(106, 'TE-10', 'DELUXE', 'San Salvador', 'Av. Cuzcatlan mercado belloso', NULL, NULL, NULL, '1'),
(107, 'TE-06', 'TE-06 FARDEL', 'San Jacinto', '1 av nte # 412 pje gloria col. San jacinto', NULL, NULL, 'Lic. Guardado', NULL),
(108, 'TE-04', 'ERMINDA DE RAMIREZ', 'San Salvador', '11 av sur n 309 sobre 4 c pte detras del parque bolivar frente comercial isnan.', NULL, NULL, '(MONSIRAMI)', NULL),
(109, 'TE-07', 'ILOPANIA', 'San Salvador', '10 av sur 553 barrio la vega ex administracion de renta', '2271-5957', NULL, 'Jorge manzzini', NULL),
(110, 'TE-10', 'MOLDURAS PICASO', 'San Salvador', '59 av nte 334 San Salvador prolongacion juan pablo 2', '2261-0768', NULL, NULL, NULL),
(111, 'TE-04', 'YORECICLO', 'San Salvador', 'a la par de los juzgados de santa tecla y cementerio del lugar', '7321-4521', NULL, 'FRANCISCO GARCIA', NULL),
(112, 'TE-10', 'RAPI VIDRIO', 'San Salvador', 'C antigua a huizucar pje san rafael local 3 la cima san salvador.', '2273-2488', NULL, 'JORGE CASTRO', NULL),
(113, 'TE-05', 'INTERCONTINENTAL', 'San Salvador', 'BLVD LOS HEROES FRENTE A METROCENTRO.', '7895-1605', NULL, 'RENE PEREZ', NULL),
(114, 'TE-08', 'ALC. SAN ANTONIO PAJONAL', 'SANTA ANA', 'SANTA ANA SAN ANTONIO PAJONAL.', NULL, NULL, 'CARLOS HENRIQUES', NULL),
(115, 'TE-08', 'ALC. DE TALNIQUE', 'Sonsonate', 'CARRETERA A SONSONATE  ', NULL, NULL, 'MOISES', NULL),
(116, 'TE-10', 'FERRETERIA AZ', 'San Salvador', 'CONTIGUO AL MAYESTIC', NULL, NULL, 'ENCARGADO DE BODEGA', NULL),
(117, 'TE-10', 'CIELOS Y VENTANAS HERNANDEZ', 'San Salvador', 'REPARTO XOCHILIT 12 CALLE MONSERRAT FRENTE A TAMINSAL', '2131-6955', '7890-0523', 'JOSE MARIO HERNANDEZ', NULL),
(118, 'TE-11', 'JORGE HERNANDEZ', 'San Salvador', 'APOPA', '2323-2323', '', 'Jorge Hernandez', ''),
(119, 'TE-11', 'BASURERO DE SANTA ANA', 'Santa Ana', 'carretera a metapan ', '7272-6375', '7444-9629', 'Ana', 'Sacos'),
(120, 'TE-11', 'RICARDO RAMOS', 'San Salvador', 'COL. MILAGRO 1 CALLE OTE N° 41 SAN MARCOS', '7751-8690', '', 'RICARDO RAMOS', NULL);