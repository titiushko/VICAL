USE VICAL;
INSERT INTO TIPOS_EMPRESAS (CODIGO_TIPO_EMPRESA,NOMBRE_TIPO_EMPRESA) VALUES
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
INSERT INTO TIPOS_VIDRIO (CODIGO_TIPO,NOMBRE_TIPO) VALUES
('TV-01','BOTELLA'),
('TV-02','PLANO');
INSERT INTO COLORES_VIDRIO (CODIGO_COLOR,NOMBRE_COLOR) VALUES
('CV-01','VERDE'),
('CV-02','CRISTALINO'),
('CV-03','CAFE'),
('CV-04','BRONCE'),
('CV-05','REFLECTIVO');
INSERT INTO USUARIOS (NOMBRE,USUARIO,PASSWORD,NIVEL) VALUES
('Super Usuario','super','super','1'),
('William Sanchez','william','william','1'),
('Carlos Lopez','carlos','carlos','2'),
('Alfredo Fernande','alfredo','alfredo','3');
INSERT INTO PRECIOS (CODIGO_PRECIO, PRECIO_UNITARIO)
VALUES ('1','1.2');