CREATE TABLE ciudad (
    id_ciudad INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    pais VARCHAR(100) NOT NULL
);

CREATE TABLE sucursal (
    id_sucursal INT PRIMARY KEY AUTO_INCREMENT,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    nombre Varchar(100) NOT NULL
);

CREATE TABLE empleado (
    dni VARCHAR(15) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    id_sucursal INT,
    puesto VARCHAR(30),
    e_username VARCHAR(10) UNIQUE,
    e_password VARCHAR(10),
    FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal)
);

CREATE TABLE cliente (
    dni VARCHAR(15) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    c_username VARCHAR(10) UNIQUE,
    c_password VARCHAR(10)
);

CREATE TABLE viaje (
    id_viaje INT PRIMARY KEY AUTO_INCREMENT,
    duracion INT,
    precio DECIMAL(10,2),
    dni_cliente VARCHAR(15),
    FOREIGN KEY (dni_cliente) REFERENCES cliente(dni)
);

CREATE TABLE reserva (
    id_reserva INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE NOT NULL,
    estado VARCHAR(50) NOT NULL,
    id_viaje INT,
    id_sucursal INT,
    dni_empleado VARCHAR(15),
    FOREIGN KEY (id_viaje) REFERENCES viaje(id_viaje),
    FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal),
    FOREIGN KEY (dni_empleado) REFERENCES empleado(dni)
);

CREATE TABLE pago (
    id_pago INT PRIMARY KEY AUTO_INCREMENT,
    monto DECIMAL(10,2) NOT NULL,
    fecha DATE NOT NULL,
    estado VARCHAR(50) NOT NULL,
    metodo_pago VARCHAR(50) NOT NULL,
    id_reserva INT,
    FOREIGN KEY (id_reserva) REFERENCES reserva(id_reserva)
);

CREATE TABLE hotel (
    id_hotel INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    categoria VARCHAR(50),
    telefono VARCHAR(20),
    precio_por_noche DECIMAL(10,2),
    id_ciudad INT,
    FOREIGN KEY (id_ciudad) REFERENCES ciudad(id_ciudad)
);

CREATE TABLE proveedor (
    id_proveedor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE proveedor_hotel (
    id_proveedor INT,
    id_hotel INT,
    PRIMARY KEY (id_proveedor, id_hotel),
    FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor),
    FOREIGN KEY (id_hotel) REFERENCES hotel(id_hotel)
);

CREATE TABLE servicio (
    id_servicio INT PRIMARY KEY AUTO_INCREMENT,
    id_proveedor INT,
    descripcion VARCHAR(100),
    costo DECIMAL(10,2),
    FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor)
);

CREATE TABLE vuelo (
    id_vuelo INT PRIMARY KEY AUTO_INCREMENT,
    num_vuelo VARCHAR(50),
    ciudad_origen INT,
    ciudad_destino INT,
    fecha_salida DATETIME,
    fecha_llegada DATETIME,
    precio DECIMAL(10,2),
    FOREIGN KEY (ciudad_origen) REFERENCES ciudad(id_ciudad),
    FOREIGN KEY (ciudad_destino) REFERENCES ciudad(id_ciudad)
);

CREATE TABLE viaje_vuelo (
    id_viaje INT,
    id_vuelo INT,
    PRIMARY KEY (id_viaje, id_vuelo),
    FOREIGN KEY (id_viaje) REFERENCES viaje(id_viaje),
    FOREIGN KEY (id_vuelo) REFERENCES vuelo(id_vuelo)
);

CREATE TABLE paquete_turistico (
    id_paquete INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2),
    id_ciudad INT,
    FOREIGN KEY (id_ciudad) REFERENCES ciudad(id_ciudad)
);




CREATE TABLE guia_turistico (
    id_guia INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    idioma VARCHAR(50),
    id_ciudad INT,
    FOREIGN KEY (id_ciudad) REFERENCES ciudad(id_ciudad)
);

CREATE TABLE promocion (
    id_promocion INT PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT,
    descuento DECIMAL(5,2),
    periodo_validez VARCHAR(50),
    id_empleado VARCHAR(15),
    FOREIGN KEY (id_empleado) REFERENCES empleado(dni)
);

CREATE TABLE transporte (
    id_transporte INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(50) NOT NULL,
    costo DECIMAL(10,2) NOT NULL,
    empresa VARCHAR(100) NOT NULL
);




/*AGREGAR FOREIGNS KEYS A vIAJES*/
ALTER TABLE viaje ADD COLUMN vuelo_ida INT;
ALTER TABLE viaje ADD COLUMN vuelo_regreso INT;
ALTER TABLE viaje ADD FOREIGN KEY (vuelo_ida) REFERENCES vuelo(id_vuelo);
ALTER TABLE viaje ADD FOREIGN KEY (vuelo_regreso) REFERENCES vuelo(id_vuelo);

ALTER TABLE viaje ADD COLUMN paquete_turistico INT;
ALTER TABLE viaje ADD FOREIGN KEY (paquete_turistico) REFERENCES paquete_turistico(id_paquete);

ALTER TABLE viaje ADD COLUMN hotel INT;
ALTER TABLE viaje ADD FOREIGN KEY (hotel) REFERENCES hotel(id_hotel);

ALTER TABLE viaje ADD COLUMN guia INT;
ALTER TABLE viaje ADD FOREIGN KEY (guia) REFERENCES guia_turistico(id_guia);

ALTER TABLE viaje ADD COLUMN servicio INT;
ALTER TABLE viaje ADD FOREIGN KEY (servicio) REFERENCES servicio(id_servicio);

ALTER TABLE viaje ADD COLUMN transporte INT;
ALTER TABLE viaje ADD FOREIGN KEY (transporte) REFERENCES transporte(id_transporte);

/*tRANSPORTE Y sERVICIO */

ALTER TABLE servicio ADD COLUMN ciudad_int INT;
ALTER TABLE servicio ADD FOREIGN KEY (ciudad_int) REFERENCES ciudad(id_ciudad);




INSERT INTO ciudad (nombre, pais) VALUES
-- Europa
('Madrid', 'España'),
('Barcelona', 'España'),
('París', 'Francia'),
('Londres', 'Inglaterra'),
('Roma', 'Italia'),
('Milán', 'Italia'),
('Berlín', 'Alemania'),
('Munich', 'Alemania'),
('Ámsterdam', 'Países Bajos'),
('Lisboa', 'Portugal'),
('Viena', 'Austria'),
('Praga', 'República Checa'),
('Atenas', 'Grecia'),
('Estocolmo', 'Suecia'),
('Oslo', 'Noruega'),
('Copenhague', 'Dinamarca'),
('Helsinki', 'Finlandia'),
('Varsovia', 'Polonia'),
('Budapest', 'Hungría'),
('Dubrovnik', 'Croacia'),

-- Perú
('Lima', 'Perú'),
('Cusco', 'Perú'),
('Arequipa', 'Perú'),
('Trujillo', 'Perú'),
('Iquitos', 'Perú'),
('Piura', 'Perú'),
('Puno', 'Perú'),

-- Resto de América
('Nueva York', 'Estados Unidos'),
('Miami', 'Estados Unidos'),
('Cancún', 'México'),
('Ciudad de México', 'México'),
('Buenos Aires', 'Argentina'),
('Rio de Janeiro', 'Brasil'),
('Santiago', 'Chile'),
('Toronto', 'Canadá');


-- sucursal
INSERT INTO sucursal (direccion, telefono, nombre) VALUES
('Av. Principal 123, Lima', '123456789', 'sucursal Central Lima'),
('Jr. Comercio 456, Arequipa', '987654321', 'sucursal Arequipa Centro'),
('Calle Turismo 789, Cusco', '456789123', 'sucursal Cusco Plaza'),
('Av. Libertad 234, Santiago', '789123456', 'sucursal Santiago Centro'),
('Calle Mayo 567, Buenos Aires', '321654987', 'sucursal Buenos Aires Norte');

-- cliente
INSERT INTO cliente (dni, nombre, apellidos, telefono, email, c_username, c_password) VALUES
('12345671', 'Luis', 'Rodríguez Pérez', '888777666', 'luis@email.com', 'lrodri', 'cpass123'),
('12345672', 'Carmen', 'Díaz García', '888777667', 'carmen@email.com', 'cdiaz', 'cpass124'),
('12345673', 'Jorge', 'Flores López', '888777668', 'jorge@email.com', 'jflores', 'cpass125'),
('12345674', 'Laura', 'Torres Ruiz', '888777669', 'laura@email.com', 'ltorres', 'cpass126'),
('12345675', 'Miguel', 'Castro Silva', '888777670', 'miguel@email.com', 'mcastro', 'cpass127'),
('12345676', 'Gabriel', 'Lopez Mendez', '888777670', 'gab@email.com', 'glopez', 'cpass127'),
('12345677', 'Luis', 'Fernandez Calapuja', '888777670', 'lucho@email.com', 'luchito', 'cpass127');

-- 2. Luego las que dependen de una tabla
-- empleado (depende de sucursal)
INSERT INTO empleado (dni, nombre, apellidos, telefono, id_sucursal, puesto, e_username, e_password) VALUES
('45678901', 'Juan', 'Pérez López', '999888777', 1, 'Gerente', 'jperez', 'pass123'),
('45678902', 'María', 'García Ruiz', '999888778', 2, 'Vendedor', 'mgarcia', 'pass124'),
('45678903', 'Carlos', 'López Torres', '999888779', 3, 'Vendedor', 'clopez', 'pass125'),
('45678904', 'Ana', 'Martínez Silva', '999888780', 4, 'Supervisor', 'amartinez', 'pass126'),
('45678905', 'Pedro', 'Sánchez Vega', '999888781', 5, 'Vendedor', 'psanchez', 'pass127');


-- 5. hotel (depende de ciudad)
INSERT INTO hotel (nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad) VALUES
('hotel Lima Plaza', 'Av. Lima 123', '4 estrellas', '111222333', 150.00, 1),
('hotel Arequipa Real', 'Calle Real 456', '3 estrellas', '222333444', 100.00, 2),
('hotel Cusco Imperial', 'Plaza Mayor 789', '5 estrellas', '333444555', 200.00, 3),
('hotel Santiago View', 'Av. Central 234', '4 estrellas', '444555666', 180.00, 4),
('hotel Buenos Aires Suites', 'Av. Mayo 567', '5 estrellas', '555666777', 220.00, 5);

-- 6. proveedor (independiente)
INSERT INTO proveedor (nombre, direccion, telefono, email) VALUES
('transportes Rápidos', 'Av. Transport 123', '666777888', 'transportes@email.com'),
('servicios Turísticos SA', 'Jr. Turismo 456', '777888999', 'servicios@email.com'),
('hoteles Unidos', 'Calle hotel 789', '888999000', 'hoteles@email.com'),
('viajes Express', 'Av. viajes 234', '999000111', 'viajes@email.com'),
('Tours & Más', 'Jr. Tours 567', '000111222', 'tours@email.com');

-- 7. servicio (independiente)
INSERT INTO servicio (id_proveedor, descripcion, costo) VALUES
(1, 'Cita en el spa', 50.00),
(2, 'Sesion e fotos', 80.00),
(3, 'Paseo en lancha', 65.00),
(4, 'Tour gastronomico', 100.00),
(5, 'Excursion ecologica', 120.00);


-- 9. paquete_turistico (independiente)
INSERT INTO paquete_turistico (nombre, descripcion, precio, id_ciudad) VALUES
('Paquete Básico', 'Tour básico por la ciudad', 200.00, 1),
('Paquete Premium', 'Tour completo con hotel 5 estrellas', 500.00, 2),
('Paquete Familiar', 'Tour para toda la familia', 800.00, 3),
('Paquete Aventura', 'Tour de deportes extremos', 400.00 ,1),
('Paquete Cultural', 'Tour por museos y sitios históricos', 300.00, 4);

-- 10. guia_turistico (depende de ciudad)
INSERT INTO guia_turistico (nombre, telefono, idioma, id_ciudad) VALUES
('Pablo Ruiz', '123123123', 'Español, Inglés', 1),
('Ana Torres', '234234234', 'Español, Portugués', 2),
('Carlos López', '345345345', 'Español, Francés', 3),
('María García', '456456456', 'Español, Alemán', 4),
('Juan Pérez', '567567567', 'Español, Italiano', 5);

-- 11. promocion (depende de empleado)
INSERT INTO promocion (descripcion, descuento, periodo_validez, id_empleado) VALUES
('descuento Verano', 15.00, 'Enero 2024', '45678901'),
('Oferta Familias', 20.00, 'Febrero 2024', '45678902'),
('Early Bird', 10.00, 'Marzo 2024', '45678903'),
('descuento Grupos', 25.00, 'Abril 2024', '45678904'),
('Oferta Flash', 30.00, 'Mayo 2024', '45678905');

-- 12. transporte (independiente)
INSERT INTO transporte (tipo, costo, empresa) VALUES
('Bus Turístico', 100.00, 'transportes Turísticos SA'),
('Minivan', 150.00, 'Mobility Tours'),
('Auto Privado', 200.00, 'Car Service Plus'),
('Bus Ejecutivo', 180.00, 'Executive Travel'),
('transporte VIP', 300.00, 'VIP Mobility');

-- 8. vuelo (depende de ciudad)
INSERT INTO vuelo (num_vuelo, ciudad_origen, ciudad_destino, fecha_salida, fecha_llegada, precio) VALUES
('VL001', 1, 2, '2024-01-20 08:00:00', '2024-01-20 09:30:00', 150.00),
('VL002', 2, 3, '2024-01-20 10:00:00', '2024-01-20 11:30:00', 180.00),
('VL003', 3, 4, '2024-01-20 13:00:00', '2024-01-20 15:30:00', 250.00),
('VL004', 4, 5, '2024-01-20 16:00:00', '2024-01-20 18:30:00', 300.00),
('VL005', 5, 1, '2024-01-20 19:00:00', '2024-01-20 21:30:00', 280.00);


INSERT INTO viaje (duracion, precio, dni_cliente, vuelo_ida, vuelo_regreso, paquete_turistico, hotel, guia, transporte) VALUES
(7, 1200.00, '12345672', 1, 2, 1, 1, 1, 1),
(5, 900.00, '12345673', 2, null, 2, 2, 2, 2),
(3, 600.00, '12345674', 3, null, null, 3, null, 3),
(7, 1200.00, '12345675', 1, 2, 1, 1, 1, 1),
(5, 900.00, '12345677', 2, null, 2, 2, 2, 2),
(3, 600.00, '12345676', 3, null, null, 3, null, 3);




-- vuelos internacionales desde Lima (ID 1)
INSERT INTO vuelo (num_vuelo, ciudad_origen, ciudad_destino, fecha_salida, fecha_llegada, precio) VALUES
-- Enero 15
('LA2001', 1, 2, '2024-01-15 08:00:00', '2024-01-15 09:30:00', 150.00),
('LA2002', 1, 3, '2024-01-15 10:00:00', '2024-01-15 11:30:00', 180.00),
('IB3201', 1, 6, '2024-01-15 23:00:00', '2024-01-16 20:30:00', 950.00),
('AF2101', 1, 8, '2024-01-15 22:00:00', '2024-01-16 19:30:00', 980.00),
-- Enero 16
('LA2003', 1, 2, '2024-01-16 08:00:00', '2024-01-16 09:30:00', 155.00),
('LA2004', 1, 3, '2024-01-16 10:00:00', '2024-01-16 11:30:00', 185.00),
('IB3202', 1, 7, '2024-01-16 23:00:00', '2024-01-17 20:30:00', 955.00),
('AF2102', 1, 9, '2024-01-16 22:00:00', '2024-01-17 19:30:00', 985.00),

-- vuelos desde Madrid (ID 6)
-- Enero 15
('IB3301', 6, 7, '2024-01-15 07:00:00', '2024-01-15 08:30:00', 120.00),
('IB3302', 6, 8, '2024-01-15 10:00:00', '2024-01-15 12:00:00', 180.00),
('IB3303', 6, 9, '2024-01-15 14:00:00', '2024-01-15 15:30:00', 150.00),
('IB3304', 6, 10, '2024-01-15 17:00:00', '2024-01-15 19:00:00', 190.00),
-- Enero 16
('IB3305', 6, 7, '2024-01-16 07:00:00', '2024-01-16 08:30:00', 125.00),
('IB3306', 6, 8, '2024-01-16 10:00:00', '2024-01-16 12:00:00', 185.00),
('IB3307', 6, 9, '2024-01-16 14:00:00', '2024-01-16 15:30:00', 155.00),
('IB3308', 6, 10, '2024-01-16 17:00:00', '2024-01-16 19:00:00', 195.00),

-- vuelos desde París (ID 8)
-- Enero 15
('AF4401', 8, 6, '2024-01-15 08:00:00', '2024-01-15 10:00:00', 170.00),
('AF4402', 8, 7, '2024-01-15 11:30:00', '2024-01-15 13:00:00', 160.00),
('AF4403', 8, 9, '2024-01-15 15:00:00', '2024-01-15 16:15:00', 140.00),
('AF4404', 8, 10, '2024-01-15 18:00:00', '2024-01-15 19:30:00', 180.00),
-- Enero 16
('AF4405', 8, 6, '2024-01-16 08:00:00', '2024-01-16 10:00:00', 175.00),
('AF4406', 8, 7, '2024-01-16 11:30:00', '2024-01-16 13:00:00', 165.00),
('AF4407', 8, 9, '2024-01-16 15:00:00', '2024-01-16 16:15:00', 145.00),
('AF4408', 8, 10, '2024-01-16 18:00:00', '2024-01-16 19:30:00', 185.00),

-- vuelos desde Londres (ID 9)
-- Enero 15
('BA5501', 9, 6, '2024-01-15 07:30:00', '2024-01-15 09:30:00', 175.00),
('BA5502', 9, 7, '2024-01-15 11:00:00', '2024-01-15 12:30:00', 165.00),
('BA5503', 9, 8, '2024-01-15 14:30:00', '2024-01-15 15:45:00', 145.00),
('BA5504', 9, 10, '2024-01-15 17:30:00', '2024-01-15 19:00:00', 185.00),
-- Enero 16
('BA5505', 9, 6, '2024-01-16 07:30:00', '2024-01-16 09:30:00', 180.00),
('BA5506', 9, 7, '2024-01-16 11:00:00', '2024-01-16 12:30:00', 170.00),
('BA5507', 9, 8, '2024-01-16 14:30:00', '2024-01-16 15:45:00', 150.00),
('BA5508', 9, 10, '2024-01-16 17:30:00', '2024-01-16 19:00:00', 190.00);

-- Bloque 1 de 450 vuelos adicionales
INSERT INTO vuelo (num_vuelo, ciudad_origen, ciudad_destino, fecha_salida, fecha_llegada, precio) VALUES
-- Enero 17 - 20 (vuelos desde Lima)
('LA2005', 1, 2, '2024-01-17 08:00:00', '2024-01-17 09:30:00', 152.00),
('LA2006', 1, 3, '2024-01-17 10:00:00', '2024-01-17 11:30:00', 182.00),
('IB3203', 1, 6, '2024-01-17 23:00:00', '2024-01-18 20:30:00', 952.00),
('AF2103', 1, 8, '2024-01-17 22:00:00', '2024-01-18 19:30:00', 982.00),
('LA2007', 1, 2, '2024-01-18 08:00:00', '2024-01-18 09:30:00', 153.00),
('LA2008', 1, 3, '2024-01-18 10:00:00', '2024-01-18 11:30:00', 183.00),
('IB3204', 1, 6, '2024-01-18 23:00:00', '2024-01-19 20:30:00', 953.00),
('AF2104', 1, 8, '2024-01-18 22:00:00', '2024-01-19 19:30:00', 983.00),

-- Enero 17 - 20 (vuelos desde Madrid)
('IB3309', 6, 7, '2024-01-17 07:00:00', '2024-01-17 08:30:00', 122.00),
('IB3310', 6, 8, '2024-01-17 10:00:00', '2024-01-17 12:00:00', 182.00),
('IB3311', 6, 9, '2024-01-17 14:00:00', '2024-01-17 15:30:00', 152.00),
('IB3312', 6, 10, '2024-01-17 17:00:00', '2024-01-17 19:00:00', 192.00),
('IB3313', 6, 7, '2024-01-18 07:00:00', '2024-01-18 08:30:00', 123.00),
('IB3314', 6, 8, '2024-01-18 10:00:00', '2024-01-18 12:00:00', 183.00),

('IB3315', 6, 9, '2024-01-18 14:00:00', '2024-01-18 15:30:00', 153.00),
('IB3316', 6, 10, '2024-01-18 17:00:00', '2024-01-18 19:00:00', 193.00),
('IB3317', 6, 11, '2024-01-19 07:00:00', '2024-01-19 08:30:00', 124.00),
('IB3318', 6, 12, '2024-01-19 10:00:00', '2024-01-19 12:00:00', 184.00),
('IB3319', 6, 13, '2024-01-19 14:00:00', '2024-01-19 15:30:00', 154.00),
('IB3320', 6, 14, '2024-01-19 17:00:00', '2024-01-19 19:00:00', 194.00),

-- vuelos desde París (Enero 17-20)
('AF4409', 8, 6, '2024-01-17 08:00:00', '2024-01-17 10:00:00', 172.00),
('AF4410', 8, 7, '2024-01-17 11:30:00', '2024-01-17 13:00:00', 162.00),
('AF4411', 8, 9, '2024-01-17 15:00:00', '2024-01-17 16:15:00', 142.00),
('AF4412', 8, 10, '2024-01-17 18:00:00', '2024-01-17 19:30:00', 182.00),
('AF4413', 8, 6, '2024-01-18 08:00:00', '2024-01-18 10:00:00', 173.00),
('AF4414', 8, 7, '2024-01-18 11:30:00', '2024-01-18 13:00:00', 163.00),
('AF4415', 8, 9, '2024-01-18 15:00:00', '2024-01-18 16:15:00', 143.00),
('AF4416', 8, 10, '2024-01-18 18:00:00', '2024-01-18 19:30:00', 183.00),

-- vuelos desde Londres (Enero 17-20)
('BA5509', 9, 6, '2024-01-17 07:30:00', '2024-01-17 09:30:00', 177.00),
('BA5510', 9, 7, '2024-01-17 11:00:00', '2024-01-17 12:30:00', 167.00),
('BA5511', 9, 8, '2024-01-17 14:30:00', '2024-01-17 15:45:00', 147.00),
('BA5512', 9, 10, '2024-01-17 17:30:00', '2024-01-17 19:00:00', 187.00),
('BA5513', 9, 6, '2024-01-18 07:30:00', '2024-01-18 09:30:00', 178.00),
('BA5514', 9, 7, '2024-01-18 11:00:00', '2024-01-18 12:30:00', 168.00),
('BA5515', 9, 8, '2024-01-18 14:30:00', '2024-01-18 15:45:00', 148.00),
('BA5516', 9, 10, '2024-01-18 17:30:00', '2024-01-18 19:00:00', 188.00),

-- vuelos desde Roma (Enero 17-20)
('AZ6601', 10, 6, '2024-01-17 08:30:00', '2024-01-17 10:30:00', 165.00),
('AZ6602', 10, 7, '2024-01-17 12:00:00', '2024-01-17 13:30:00', 155.00),
('AZ6603', 10, 8, '2024-01-17 15:30:00', '2024-01-17 16:45:00', 135.00),
('AZ6604', 10, 9, '2024-01-17 18:30:00', '2024-01-17 20:00:00', 175.00),
('AZ6605', 10, 6, '2024-01-18 08:30:00', '2024-01-18 10:30:00', 166.00),
('AZ6606', 10, 7, '2024-01-18 12:00:00', '2024-01-18 13:30:00', 156.00),
('AZ6607', 10, 8, '2024-01-18 15:30:00', '2024-01-18 16:45:00', 136.00),
('AZ6608', 10, 9, '2024-01-18 18:30:00', '2024-01-18 20:00:00', 176.00),

-- vuelos desde Berlín (Enero 17-20)
('LH7701', 11, 6, '2024-01-17 07:00:00', '2024-01-17 09:00:00', 158.00),
('LH7702', 11, 7, '2024-01-17 10:30:00', '2024-01-17 12:00:00', 148.00),
('LH7703', 11, 8, '2024-01-17 14:00:00', '2024-01-17 15:15:00', 128.00),
('LH7704', 11, 9, '2024-01-17 17:00:00', '2024-01-17 18:30:00', 168.00),
('LH7705', 11, 6, '2024-01-18 07:00:00', '2024-01-18 09:00:00', 159.00),
('LH7706', 11, 7, '2024-01-18 10:30:00', '2024-01-18 12:00:00', 149.00),
('LH7707', 11, 8, '2024-01-18 14:00:00', '2024-01-18 15:15:00', 129.00),
('LH7708', 11, 9, '2024-01-18 17:00:00', '2024-01-18 18:30:00', 169.00),

-- vuelos desde Amsterdam (Enero 17-20)
('KL8801', 12, 6, '2024-01-17 08:15:00', '2024-01-17 10:15:00', 162.00),
('KL8802', 12, 7, '2024-01-17 11:45:00', '2024-01-17 13:15:00', 152.00),
('KL8803', 12, 8, '2024-01-17 15:15:00', '2024-01-17 16:30:00', 132.00),
('KL8804', 12, 9, '2024-01-17 18:15:00', '2024-01-17 19:45:00', 172.00),
('KL8805', 12, 6, '2024-01-18 08:15:00', '2024-01-18 10:15:00', 163.00),
('KL8806', 12, 7, '2024-01-18 11:45:00', '2024-01-18 13:15:00', 153.00),
('KL8807', 12, 8, '2024-01-18 15:15:00', '2024-01-18 16:30:00', 133.00),
('KL8808', 12, 9, '2024-01-18 18:15:00', '2024-01-18 19:45:00', 173.00),

-- Continuando con más fechas...
('LA2009', 1, 2, '2024-01-19 08:00:00', '2024-01-19 09:30:00', 154.00),
('LA2010', 1, 3, '2024-01-19 10:00:00', '2024-01-19 11:30:00', 184.00),
('IB3205', 1, 6, '2024-01-19 23:00:00', '2024-01-20 20:30:00', 954.00),
('AF2105', 1, 8, '2024-01-19 22:00:00', '2024-01-20 19:30:00', 984.00),
-- Bloque 2 (Continuación de vuelos)
-- vuelos desde Lisboa (Enero 17-20)
('TP9901', 13, 6, '2024-01-17 07:45:00', '2024-01-17 09:45:00', 145.00),
('TP9902', 13, 7, '2024-01-17 11:15:00', '2024-01-17 12:45:00', 135.00),
('TP9903', 13, 8, '2024-01-17 14:45:00', '2024-01-17 16:00:00', 115.00),
('TP9904', 13, 9, '2024-01-17 17:45:00', '2024-01-17 19:15:00', 155.00),
('TP9905', 13, 6, '2024-01-18 07:45:00', '2024-01-18 09:45:00', 146.00),
('TP9906', 13, 7, '2024-01-18 11:15:00', '2024-01-18 12:45:00', 136.00),
('TP9907', 13, 8, '2024-01-18 14:45:00', '2024-01-18 16:00:00', 116.00),
('TP9908', 13, 9, '2024-01-18 17:45:00', '2024-01-18 19:15:00', 156.00),

-- vuelos desde Viena (Enero 17-20)
('OS1001', 14, 6, '2024-01-17 08:30:00', '2024-01-17 10:30:00', 175.00),
('OS1002', 14, 7, '2024-01-17 12:00:00', '2024-01-17 13:30:00', 165.00),
('OS1003', 14, 8, '2024-01-17 15:30:00', '2024-01-17 16:45:00', 145.00),
('OS1004', 14, 9, '2024-01-17 18:30:00', '2024-01-17 20:00:00', 185.00),
('OS1005', 14, 6, '2024-01-18 08:30:00', '2024-01-18 10:30:00', 176.00),
('OS1006', 14, 7, '2024-01-18 12:00:00', '2024-01-18 13:30:00', 166.00),
('OS1007', 14, 8, '2024-01-18 15:30:00', '2024-01-18 16:45:00', 146.00),
('OS1008', 14, 9, '2024-01-18 18:30:00', '2024-01-18 20:00:00', 186.00),

-- vuelos desde Zurich (Enero 17-20)
('LX1101', 15, 6, '2024-01-17 07:15:00', '2024-01-17 09:15:00', 185.00),
('LX1102', 15, 7, '2024-01-17 10:45:00', '2024-01-17 12:15:00', 175.00),
('LX1103', 15, 8, '2024-01-17 14:15:00', '2024-01-17 15:30:00', 155.00),
('LX1104', 15, 9, '2024-01-17 17:15:00', '2024-01-17 18:45:00', 195.00),
('LX1105', 15, 6, '2024-01-18 07:15:00', '2024-01-18 09:15:00', 186.00),
('LX1106', 15, 7, '2024-01-18 10:45:00', '2024-01-18 12:15:00', 176.00),
('LX1107', 15, 8, '2024-01-18 14:15:00', '2024-01-18 15:30:00', 156.00),
('LX1108', 15, 9, '2024-01-18 17:15:00', '2024-01-18 18:45:00', 196.00),

-- vuelos desde Oslo (Enero 17-20)
('SK1201', 16, 6, '2024-01-17 09:00:00', '2024-01-17 11:00:00', 195.00),
('SK1202', 16, 7, '2024-01-17 12:30:00', '2024-01-17 14:00:00', 185.00),
('SK1203', 16, 8, '2024-01-17 16:00:00', '2024-01-17 17:15:00', 165.00),
('SK1204', 16, 9, '2024-01-17 19:00:00', '2024-01-17 20:30:00', 205.00),
('SK1205', 16, 6, '2024-01-18 09:00:00', '2024-01-18 11:00:00', 196.00),
('SK1206', 16, 7, '2024-01-18 12:30:00', '2024-01-18 14:00:00', 186.00),
('SK1207', 16, 8, '2024-01-18 16:00:00', '2024-01-18 17:15:00', 166.00),
('SK1208', 16, 9, '2024-01-18 19:00:00', '2024-01-18 20:30:00', 206.00),

-- vuelos desde Estocolmo (Enero 17-20)
('SK1301', 17, 6, '2024-01-17 08:45:00', '2024-01-17 10:45:00', 198.00),
('SK1302', 17, 7, '2024-01-17 12:15:00', '2024-01-17 13:45:00', 188.00),
('SK1303', 17, 8, '2024-01-17 15:45:00', '2024-01-17 17:00:00', 168.00),
('SK1304', 17, 9, '2024-01-17 18:45:00', '2024-01-17 20:15:00', 208.00),
('SK1305', 17, 6, '2024-01-18 08:45:00', '2024-01-18 10:45:00', 199.00),
('SK1306', 17, 7, '2024-01-18 12:15:00', '2024-01-18 13:45:00', 189.00),
('SK1307', 17, 8, '2024-01-18 15:45:00', '2024-01-18 17:00:00', 169.00),
('SK1308', 17, 9, '2024-01-18 18:45:00', '2024-01-18 20:15:00', 209.00),

-- Continuando con más fechas y rutas...
-- Bloque 3 (Continuación de vuelos)
-- vuelos desde Copenhague (Enero 17-20)
('SK1401', 18, 6, '2024-01-17 07:30:00', '2024-01-17 09:30:00', 192.00),
('SK1402', 18, 7, '2024-01-17 11:00:00', '2024-01-17 12:30:00', 182.00),
('SK1403', 18, 8, '2024-01-17 14:30:00', '2024-01-17 15:45:00', 162.00),
('SK1404', 18, 9, '2024-01-17 17:30:00', '2024-01-17 19:00:00', 202.00),
('SK1405', 18, 6, '2024-01-18 07:30:00', '2024-01-18 09:30:00', 193.00),
('SK1406', 18, 7, '2024-01-18 11:00:00', '2024-01-18 12:30:00', 183.00),
('SK1407', 18, 8, '2024-01-18 14:30:00', '2024-01-18 15:45:00', 163.00),
('SK1408', 18, 9, '2024-01-18 17:30:00', '2024-01-18 19:00:00', 203.00),

-- vuelos desde Helsinki (Enero 17-20)
('AY1501', 19, 6, '2024-01-17 08:15:00', '2024-01-17 10:15:00', 205.00),
('AY1502', 19, 7, '2024-01-17 11:45:00', '2024-01-17 13:15:00', 195.00),
('AY1503', 19, 8, '2024-01-17 15:15:00', '2024-01-17 16:30:00', 175.00),
('AY1504', 19, 9, '2024-01-17 18:15:00', '2024-01-17 19:45:00', 215.00),
('AY1505', 19, 6, '2024-01-18 08:15:00', '2024-01-18 10:15:00', 206.00),
('AY1506', 19, 7, '2024-01-18 11:45:00', '2024-01-18 13:15:00', 196.00),
('AY1507', 19, 8, '2024-01-18 15:15:00', '2024-01-18 16:30:00', 176.00),
('AY1508', 19, 9, '2024-01-18 18:15:00', '2024-01-18 19:45:00', 216.00),

-- vuelos intercontinentales desde Lima (Enero 19-22)
('LA2011', 1, 6, '2024-01-19 23:30:00', '2024-01-20 20:00:00', 958.00),
('LA2012', 1, 7, '2024-01-19 22:30:00', '2024-01-20 19:00:00', 948.00),
('LA2013', 1, 8, '2024-01-20 23:30:00', '2024-01-21 20:00:00', 968.00),
('LA2014', 1, 9, '2024-01-20 22:30:00', '2024-01-21 19:00:00', 978.00),
('LA2015', 1, 10, '2024-01-21 23:30:00', '2024-01-22 20:00:00', 988.00),
('LA2016', 1, 11, '2024-01-21 22:30:00', '2024-01-22 19:00:00', 998.00),

-- vuelos desde Madrid a Sudamérica (Enero 19-22)
('IB3321', 6, 1, '2024-01-19 23:00:00', '2024-01-20 19:30:00', 962.00),
('IB3322', 6, 2, '2024-01-19 22:00:00', '2024-01-20 18:30:00', 942.00),
('IB3323', 6, 3, '2024-01-20 23:00:00', '2024-01-21 19:30:00', 952.00),
('IB3324', 6, 4, '2024-01-20 22:00:00', '2024-01-21 18:30:00', 972.00),
('IB3325', 6, 5, '2024-01-21 23:00:00', '2024-01-22 19:30:00', 982.00),

-- vuelos internos Europa (Enero 19-22)
('AF4417', 8, 11, '2024-01-19 08:30:00', '2024-01-19 10:30:00', 168.00),
('AF4418', 8, 12, '2024-01-19 12:00:00', '2024-01-19 13:30:00', 158.00),
('AF4419', 8, 13, '2024-01-19 15:30:00', '2024-01-19 16:45:00', 148.00),
('AF4420', 8, 14, '2024-01-19 18:30:00', '2024-01-19 20:00:00', 178.00),
('AF4421', 8, 15, '2024-01-20 08:30:00', '2024-01-20 10:30:00', 169.00),
('AF4422', 8, 16, '2024-01-20 12:00:00', '2024-01-20 13:30:00', 159.00),
('AF4423', 8, 17, '2024-01-20 15:30:00', '2024-01-20 16:45:00', 149.00),
('AF4424', 8, 18, '2024-01-20 18:30:00', '2024-01-20 20:00:00', 179.00),

-- vuelos desde Londres a Europa (Enero 19-22)
('BA5517', 9, 11, '2024-01-19 07:45:00', '2024-01-19 09:45:00', 172.00),
('BA5518', 9, 12, '2024-01-19 11:15:00', '2024-01-19 12:45:00', 162.00),
('BA5519', 9, 13, '2024-01-19 14:45:00', '2024-01-19 16:00:00', 152.00),
('BA5520', 9, 14, '2024-01-19 17:45:00', '2024-01-19 19:15:00', 182.00),
('BA5521', 9, 15, '2024-01-20 07:45:00', '2024-01-20 09:45:00', 173.00),
('BA5522', 9, 16, '2024-01-20 11:15:00', '2024-01-20 12:45:00', 163.00),
('BA5523', 9, 17, '2024-01-20 14:45:00', '2024-01-20 16:00:00', 153.00),
('BA5524', 9, 18, '2024-01-20 17:45:00', '2024-01-20 19:15:00', 183.00),

-- Conexiones desde Roma (Enero 19-22)
('AZ6609', 10, 11, '2024-01-19 08:00:00', '2024-01-19 10:00:00', 165.00),
('AZ6610', 10, 12, '2024-01-19 11:30:00', '2024-01-19 13:00:00', 155.00),
('AZ6611', 10, 13, '2024-01-19 15:00:00', '2024-01-19 16:15:00', 145.00),
('AZ6612', 10, 14, '2024-01-19 18:00:00', '2024-01-19 19:30:00', 175.00),
('AZ6613', 10, 15, '2024-01-20 08:00:00', '2024-01-20 10:00:00', 166.00),
('AZ6614', 10, 16, '2024-01-20 11:30:00', '2024-01-20 13:00:00', 156.00),
('AZ6615', 10, 17, '2024-01-20 15:00:00', '2024-01-20 16:15:00', 146.00),
('AZ6616', 10, 18, '2024-01-20 18:00:00', '2024-01-20 19:30:00', 176.00);





-- hoteles correspondientes a estas ciudades
INSERT INTO hotel (nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad) VALUES
('Madrid Grand hotel', 'Gran Vía 123', '5 estrellas', '34912345678', 250.00, 6),
('Barcelona Plaza', 'Las Ramblas 456', '4 estrellas', '34934567890', 200.00, 7),
('Paris Luxe', 'Champs-Élysées 789', '5 estrellas', '33123456789', 300.00, 8),
('London Royal', 'Baker Street 221', '5 estrellas', '44123456789', 280.00, 9),
('Roma Imperial', 'Via Veneto 123', '4 estrellas', '39123456789', 220.00, 10),
('Milano Modern', 'Via Monte Napoleone 45', '4 estrellas', '39234567890', 190.00, 11),
('Berlin Central', 'Unter den Linden 67', '4 estrellas', '49123456789', 180.00, 12),
('Munich Luxury', 'Karlsplatz 89', '5 estrellas', '49234567890', 250.00, 13),
('Amsterdam Canal', 'Prinsengracht 123', '4 estrellas', '31123456789', 210.00, 14),
('Lisboa Bay', 'Av. da Liberdade 45', '4 estrellas', '351123456789', 170.00, 15),
('Vienna Classic', 'Ringstrasse 67', '5 estrellas', '43123456789', 240.00, 16),
('Prague Old Town', 'Staroměstské náměstí 89', '4 estrellas', '420123456789', 160.00, 17),
('Athens View', 'Acropolis Road 12', '4 estrellas', '30123456789', 180.00, 18),
('Stockholm Water', 'Gamla Stan 34', '4 estrellas', '46123456789', 220.00, 19),
('Oslo Fjord', 'Karl Johans gate 56', '5 estrellas', '47123456789', 260.00, 20),
('Copenhagen Design', 'Nyhavn 78', '4 estrellas', '45123456789', 230.00, 21),
('Helsinki Modern', 'Senate Square 90', '4 estrellas', '358123456789', 200.00, 22),
('Warsaw Royal', 'Old Town Market 12', '4 estrellas', '48123456789', 150.00, 23),
('Budapest River', 'Andrássy út 34', '5 estrellas', '36123456789', 190.00, 24),
('Dubrovnik Sea', 'Old Town 56', '4 estrellas', '385123456789', 170.00, 25);

-- Guías Turísticos para estas ciudades
INSERT INTO guia_turistico (nombre, telefono, idioma, id_ciudad) VALUES
('Carlos Martínez', '34611111111', 'Español, Inglés', 6),
('Ana García', '34622222222', 'Español, Francés, Inglés', 7),
('Pierre Dubois', '33633333333', 'Francés, Inglés, Español', 8),
('John Smith', '44644444444', 'Inglés, Español, Francés', 9),
('Marco Rossi', '39655555555', 'Italiano, Inglés, Español', 10),
('Giuseppe Verdi', '39666666666', 'Italiano, Inglés, Alemán', 11),
('Hans Weber', '49677777777', 'Alemán, Inglés, Español', 12),
('Franz Mueller', '49688888888', 'Alemán, Inglés, Francés', 13),
('Jan van der Berg', '31699999999', 'Holandés, Inglés, Alemán', 14),
('João Silva', '351611111111', 'Portugués, Inglés, Español', 15),
('Klaus Wagner', '43622222222', 'Alemán, Inglés, Italiano', 16),
('Pavel Novak', '420633333333', 'Checo, Inglés, Alemán', 17),
('Nikos Papadopoulos', '30644444444', 'Griego, Inglés, Francés', 18),
('Erik Andersson', '46655555555', 'Sueco, Inglés, Alemán', 19),
('Magnus Olsen', '47666666666', 'Noruego, Inglés, Alemán', 20),
('Lars Hansen', '45677777777', 'Danés, Inglés, Alemán', 21),
('Mikko Virtanen', '358688888888', 'Finés, Inglés, Sueco', 22),
('Adam Kowalski', '48699999999', 'Polaco, Inglés, Alemán', 23),
('István Nagy', '36611111111', 'Húngaro, Inglés, Alemán', 24),
('Marko Kovačić', '385622222222', 'Croata, Inglés, Italiano', 25);


INSERT INTO hotel (nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad) VALUES
-- Madrid (ID 6)
('Gran Vía Palace', 'Gran Vía 234', '5 estrellas', '+34913456789', 280.00, 6),
('Retiro Suites', 'Calle Alcalá 567', '4 estrellas', '+34914567890', 220.00, 6),
('Sol Premium', 'Puerta del Sol 123', '4 estrellas', '+34915678901', 200.00, 6),
('Salamanca Luxury', 'Calle Serrano 89', '5 estrellas', '+34916789012', 300.00, 6),
('Madrid Rivers', 'Paseo del Prado 45', '3 estrellas', '+34917890123', 150.00, 6),

-- Barcelona (ID 7)
('Sagrada hotel', 'Sagrada Familia 456', '5 estrellas', '+34931234567', 270.00, 7),
('Gothic Quarter Inn', 'Gothic Quarter 78', '4 estrellas', '+34932345678', 210.00, 7),
('Beach Resort BCN', 'Barceloneta 90', '4 estrellas', '+34933456789', 230.00, 7),
('Passeig Premium', 'Passeig de Gracia 123', '5 estrellas', '+34934567890', 290.00, 7),
('Catalonia Plaza', 'Plaza Catalunya 45', '3 estrellas', '+34935678901', 160.00, 7),

-- París (ID 8)
('Eiffel Elegance', 'Avenue Eiffel 123', '5 estrellas', '+33123456789', 350.00, 8),
('Louvre Luxury', 'Rue de Rivoli 456', '5 estrellas', '+33123456790', 320.00, 8),
('Seine View', 'Quai des Grands Augustins 78', '4 estrellas', '+33123456791', 280.00, 8),
('Montmartre Charm', 'Rue Lepic 90', '3 estrellas', '+33123456792', 180.00, 8),
('Opera House', 'Boulevard Haussmann 123', '4 estrellas', '+33123456793', 250.00, 8),

-- Londres (ID 9)
('Westminster Palace', 'Westminster Bridge Rd 123', '5 estrellas', '+44207123456', 380.00, 9),
('Piccadilly Grand', 'Piccadilly Circus 45', '4 estrellas', '+44207123457', 290.00, 9),
('Tower Bridge View', 'Tower Bridge Rd 67', '4 estrellas', '+44207123458', 270.00, 9),
('Hyde Park hotel', 'Hyde Park Corner 89', '5 estrellas', '+44207123459', 350.00, 9),
('Covent Garden Inn', 'Covent Garden 123', '3 estrellas', '+44207123460', 190.00, 9),

-- Roma (ID 10)
('Colosseum View', 'Via dei Fori Imperiali 123', '5 estrellas', '+39061234567', 300.00, 10),
('Vatican Luxury', 'Via della Conciliazione 45', '5 estrellas', '+39061234568', 320.00, 10),
('Trevi Fountain', 'Via del Tritone 67', '4 estrellas', '+39061234569', 250.00, 10),
('Spanish Steps', 'Via Condotti 89', '4 estrellas', '+39061234570', 270.00, 10),
('Roman Forum', 'Via Cavour 123', '3 estrellas', '+39061234571', 180.00, 10),

-- Milán (ID 11)
('Duomo Plaza', 'Piazza del Duomo 123', '5 estrellas', '+39021234567', 280.00, 11),
('Fashion District', 'Via Montenapoleone 45', '5 estrellas', '+39021234568', 300.00, 11),
('Scala Theatre', 'Via Filodrammatici 67', '4 estrellas', '+39021234569', 240.00, 11),
('Navigli Canal', 'Naviglio Grande 89', '3 estrellas', '+39021234570', 170.00, 11),
('Central Station', 'Via Pisani 123', '4 estrellas', '+39021234571', 220.00, 11),

-- Berlín (ID 12)
('Brandenburg Gate', 'Pariser Platz 123', '5 estrellas', '+49301234567', 260.00, 12),
('Checkpoint Charlie', 'Friedrichstraße 45', '4 estrellas', '+49301234568', 220.00, 12),
('East Side Gallery', 'Mühlenstraße 67', '3 estrellas', '+49301234569', 160.00, 12),
('Potsdamer Plaza', 'Potsdamer Platz 89', '5 estrellas', '+49301234570', 280.00, 12),
('Alexanderplatz', 'Karl-Liebknecht-Straße 123', '4 estrellas', '+49301234571', 240.00, 12),

-- Munich (ID 13)
('Marienplatz View', 'Marienplatz 123', '5 estrellas', '+49891234567', 270.00, 13),
('English Garden', 'Prinzregentenstraße 45', '4 estrellas', '+49891234568', 230.00, 13),
('Olympic Park', 'Spiridon-Louis-Ring 67', '4 estrellas', '+49891234569', 220.00, 13),
('BMW World', 'Am Olympiapark 89', '5 estrellas', '+49891234570', 290.00, 13),
('Viktualienmarkt', 'Viktualienmarkt 123', '3 estrellas', '+49891234571', 180.00, 13),

-- Amsterdam (ID 14)
('Canal Ring', 'Herengracht 123', '5 estrellas', '+31201234567', 290.00, 14),
('Museum Quarter', 'Museumplein 45', '4 estrellas', '+31201234568', 250.00, 14),
('Jordaan District', 'Jordaan 67', '4 estrellas', '+31201234569', 230.00, 14),
('Royal Palace', 'Dam Square 89', '5 estrellas', '+31201234570', 310.00, 14),
('Vondelpark View', 'Vondelpark 123', '3 estrellas', '+31201234571', 190.00, 14),

-- Lisboa (ID 15)
('Belem Tower', 'Belem 123', '5 estrellas', '+351211234567', 240.00, 15),
('Alfama View', 'Alfama 45', '4 estrellas', '+351211234568', 200.00, 15),
('Chiado Luxury', 'Chiado 67', '4 estrellas', '+351211234569', 220.00, 15),
('Bairro Alto', 'Bairro Alto 89', '3 estrellas', '+351211234570', 160.00, 15),
('Rossio Plaza', 'Rossio 123', '5 estrellas', '+351211234571', 250.00, 15);


INSERT INTO hotel (nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad) VALUES
-- Viena (ID 16)
('Schönbrunn Palace', 'Schönbrunner Schlossstraße 123', '5 estrellas', '+43123457890', 310.00, 16),
('Opera House View', 'Opernring 45', '4 estrellas', '+43123457891', 260.00, 16),
('Belvedere Art', 'Prinz-Eugen-Straße 67', '5 estrellas', '+43123457892', 290.00, 16),
('Stephansdom Plaza', 'Stephansplatz 89', '4 estrellas', '+43123457893', 240.00, 16),
('Prater Park', 'Prater 123', '3 estrellas', '+43123457894', 180.00, 16),

-- Praga (ID 17)
('Charles Bridge View', 'Karlův most 123', '5 estrellas', '+420234567890', 250.00, 17),
('Old Town Square', 'Staroměstské náměstí 45', '4 estrellas', '+420234567891', 220.00, 17),
('Prague Castle', 'Hradčany 67', '5 estrellas', '+420234567892', 280.00, 17),
('Jewish Quarter', 'Josefov 89', '4 estrellas', '+420234567893', 210.00, 17),
('Wenceslas Square', 'Václavské náměstí 123', '3 estrellas', '+420234567894', 170.00, 17),

-- Atenas (ID 18)
('Acropolis View', 'Acropolis 123', '5 estrellas', '+30234567890', 270.00, 18),
('Plaka Boutique', 'Plaka 45', '4 estrellas', '+30234567891', 230.00, 18),
('Syntagma Square', 'Syntagma 67', '4 estrellas', '+30234567892', 220.00, 18),
('Temple Zeus', 'Olympieion 89', '5 estrellas', '+30234567893', 260.00, 18),
('Monastiraki Market', 'Monastiraki 123', '3 estrellas', '+30234567894', 180.00, 18),

-- Estocolmo (ID 19)
('Gamla Stan Palace', 'Gamla Stan 123', '5 estrellas', '+46234567890', 290.00, 19),
('Vasa Museum', 'Djurgården 45', '4 estrellas', '+46234567891', 250.00, 19),
('Royal Palace', 'Slottsbacken 67', '5 estrellas', '+46234567892', 280.00, 19),
('Södermalm Hip', 'Södermalm 89', '4 estrellas', '+46234567893', 230.00, 19),
('Nordic Museum', 'Djurgårdsvägen 123', '3 estrellas', '+46234567894', 190.00, 19),

-- Oslo (ID 20)
('Royal Palace Oslo', 'Karl Johans gate 123', '5 estrellas', '+47234567890', 300.00, 20),
('Opera House View', 'Operallmenningen 45', '4 estrellas', '+47234567891', 260.00, 20),
('Viking Ship', 'Bygdøy 67', '4 estrellas', '+47234567892', 240.00, 20),
('Munch Museum', 'Tøyen 89', '5 estrellas', '+47234567893', 280.00, 20),
('Vigeland Park', 'Frogner 123', '3 estrellas', '+47234567894', 200.00, 20),

-- Copenhague (ID 21)
('Tivoli Gardens', 'Vesterbrogade 123', '5 estrellas', '+45234567890', 280.00, 21),
('Nyhavn Waterfront', 'Nyhavn 45', '4 estrellas', '+45234567891', 250.00, 21),
('Little Mermaid', 'Langelinie 67', '4 estrellas', '+45234567892', 230.00, 21),
('Christiansborg Palace', 'Christiansborg 89', '5 estrellas', '+45234567893', 270.00, 21),
('Strøget Shopping', 'Strøget 123', '3 estrellas', '+45234567894', 190.00, 21),

-- Helsinki (ID 22)
('Senate Square', 'Senaatintori 123', '5 estrellas', '+358234567890', 270.00, 22),
('Market Square', 'Kauppatori 45', '4 estrellas', '+358234567891', 240.00, 22),
('Design District', 'Design District 67', '4 estrellas', '+358234567892', 220.00, 22),
('Cathedral View', 'Tuomiokirkko 89', '5 estrellas', '+358234567893', 260.00, 22),
('Suomenlinna Fort', 'Suomenlinna 123', '3 estrellas', '+358234567894', 180.00, 22),

-- Varsovia (ID 23)
('Old Town Square', 'Rynek Starego Miasta 123', '5 estrellas', '+48234567890', 240.00, 23),
('Royal Castle', 'plac Zamkowy 45', '4 estrellas', '+48234567891', 220.00, 23),
('Lazienki Park', 'Łazienki 67', '4 estrellas', '+48234567892', 200.00, 23),
('Palace Culture', 'plac Defilad 89', '5 estrellas', '+48234567893', 230.00, 23),
('Copernicus Science', 'Wybrzeże Kościuszkowskie 123', '3 estrellas', '+48234567894', 170.00, 23),

-- Budapest (ID 24)
('Parliament View', 'Kossuth Lajos tér 123', '5 estrellas', '+36234567890', 260.00, 24),
('Fisherman Bastion', 'Szentháromság tér 45', '4 estrellas', '+36234567891', 230.00, 24),
('Chain Bridge', 'Széchenyi lánchíd 67', '4 estrellas', '+36234567892', 220.00, 24),
('Thermal Bath', 'Széchenyi fürdő 89', '5 estrellas', '+36234567893', 250.00, 24),
('Ruin Pub District', 'Kazinczy utca 123', '3 estrellas', '+36234567894', 180.00, 24),

-- Dubrovnik (ID 25)
('Old City Walls', 'Stradun 123', '5 estrellas', '+385234567890', 280.00, 25),
('Adriatic Beach', 'Ploče 45', '4 estrellas', '+385234567891', 250.00, 25),
('Game of Thrones', 'Pile Gate 67', '4 estrellas', '+385234567892', 230.00, 25),
('Lokrum Island View', 'Frana Supila 89', '5 estrellas', '+385234567893', 270.00, 25),
('Cable Car View', 'Srđ 123', '3 estrellas', '+385234567894', 190.00, 25);



INSERT INTO empleado (dni, nombre, apellidos, telefono, puesto, e_username, e_password)
VALUES 
('0000001', 'Juan', 'Pérez', '1122334455', 'Gerente', 'juanxp', 'pass123'),
('0000002', 'Ana', 'García', '2233445566', 'Recepcionista', 'aqnag', 'pass456'),
('0000003', 'Carlos', 'Ruiz', '3344556677', 'Vendedor', 'carloxsr', 'pass789'),
('0000004', 'Luisa', 'Martínez', '4455667788', 'Atención al cliente', 'luissam', 'pass101'),
('0000005', 'Pedro', 'López', '8899556677', 'Administrador', 'pedqwrol', 'pass202'),
('0000006', 'Jan', 'Rez', '4455112233', 'Gerente', 'juansp', 'pawss123'),
('0000007', 'Anastacia', 'Gracia', '5566223344', 'Recepcionista', 'ancag', 'pass456'),
('0000008', 'Carlos', 'Santos', '5566773344', 'Vendedor', 'carlossr', 'pass789'),
('0000009', 'Luis', 'Rodriguez', '6677884455', 'Atención al cliwente', 'luisam', 'pass101'),
('0000010', 'Pedro', 'Ruan', '7788995566', 'Administrador', 'pedroxl', 'pass202');

/* INSERTANDO MAS PAQUETES */
INSERT INTO paquete_turistico (nombre, descripcion, precio, id_ciudad) VALUES  
('Colca Full Day', 'Disfruta del vuelo de Cóndor', 200.00, 2),
('Cañon de Cotahuasi', 'Disfruta del cañon mas profundo del Peru', 250.00, 2),
('Laguna Salinas', 'Disfruta de la laguna', 150.00, 2);



-- 13. Tablas de relación (muchos a muchos)
INSERT INTO proveedor_hotel (id_proveedor, id_hotel) VALUES
(1, 1), (1, 2), (2, 3), (3, 4), (3, 5);

INSERT INTO viaje_vuelo (id_viaje, id_vuelo) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5);



-- 3. Ahora sí podemos insertar reserva (depende de viaje, sucursal y empleado)
INSERT INTO reserva (fecha, estado, id_viaje, id_sucursal, dni_empleado) VALUES
('2024-01-15', 'Confirmado', 1, 1, '45678901'),
('2024-01-16', 'Pendiente', 2, 2, '45678902'),
('2024-01-17', 'Confirmado', 3, 3, '45678903'),
('2024-01-18', 'Cancelada', 4, 4, '45678904'),
('2024-01-19', 'Confirmado', 5, 5, '45678905');

-- 4. pago (depende de reserva)
INSERT INTO pago (monto, fecha, estado, metodo_pago, id_reserva) VALUES
(1500.00, '2024-01-15', 'Completado', 'Tarjeta', 1),
(800.00, '2024-01-16', 'Pendiente', 'Transferencia', 2),
(100.00, '2024-01-17', 'Completado', 'Efectivo', 3),
(200.00, '2024-01-18', 'Reembolsado', 'Tarjeta', 4),
(300.00, '2024-01-19', 'Completado', 'Transferencia', 5);
