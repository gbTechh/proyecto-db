CREATE TABLE Ciudad (
    ID_Ciudad INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Tipo_Transporte VARCHAR(100),
    Pais VARCHAR(100) NOT NULL
);

CREATE TABLE Sucursal (
    ID_Sucursal INT PRIMARY KEY AUTO_INCREMENT,
    Direccion VARCHAR(255) NOT NULL,
    Telefono VARCHAR(20) NOT NULL,
    nombre Varchar(100) NOT NULL
);

CREATE TABLE Empleado (
    DNI VARCHAR(15) PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Telefono VARCHAR(20),
    ID_Sucursal INT,
    Puesto VARCHAR(30),
    e_username VARCHAR(10) UNIQUE,
    e_password VARCHAR(10),
    FOREIGN KEY (ID_Sucursal) REFERENCES Sucursal(ID_Sucursal)
);

CREATE TABLE Cliente (
    DNI VARCHAR(15) PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Telefono VARCHAR(20),
    Email VARCHAR(100) UNIQUE,
    c_username VARCHAR(10) UNIQUE,
    c_password VARCHAR(10)
);

CREATE TABLE Viaje (
    ID_Viaje INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    Duracion INT,
    Precio DECIMAL(10,2),
    DNI_Cliente VARCHAR(15),
    FOREIGN KEY (DNI_Cliente) REFERENCES Cliente(DNI)
);

CREATE TABLE Reserva (
    ID_Reserva INT PRIMARY KEY AUTO_INCREMENT,
    Fecha DATE NOT NULL,
    Estado VARCHAR(50) NOT NULL,
    ID_Viaje INT,
    ID_Sucursal INT,
    DNI_Empleado VARCHAR(15),
    FOREIGN KEY (ID_Viaje) REFERENCES Viaje(ID_Viaje),
    FOREIGN KEY (ID_Sucursal) REFERENCES Sucursal(ID_Sucursal),
    FOREIGN KEY (DNI_Empleado) REFERENCES Empleado(DNI)
);

CREATE TABLE Pago (
    ID_Pago INT PRIMARY KEY AUTO_INCREMENT,
    Monto DECIMAL(10,2) NOT NULL,
    Fecha DATE NOT NULL,
    Estado VARCHAR(50) NOT NULL,
    Metodo_Pago VARCHAR(50) NOT NULL,
    ID_Reserva INT,
    FOREIGN KEY (ID_Reserva) REFERENCES Reserva(ID_Reserva)
);

CREATE TABLE Hotel (
    ID_Hotel INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Direccion VARCHAR(255),
    Categoria VARCHAR(50),
    Telefono VARCHAR(20),
    Precio_Por_Noche DECIMAL(10,2),
    ID_Ciudad INT,
    FOREIGN KEY (ID_Ciudad) REFERENCES Ciudad(ID_Ciudad)
);

CREATE TABLE Proveedor (
    ID_Proveedor INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(20),
    Email VARCHAR(100)
);

CREATE TABLE Proveedor_Hotel (
    ID_Proveedor INT,
    ID_Hotel INT,
    PRIMARY KEY (ID_Proveedor, ID_Hotel),
    FOREIGN KEY (ID_Proveedor) REFERENCES Proveedor(ID_Proveedor),
    FOREIGN KEY (ID_Hotel) REFERENCES Hotel(ID_Hotel)
);

CREATE TABLE Servicio (
    ID_Servicio INT PRIMARY KEY AUTO_INCREMENT,
    Tipo_Transporte VARCHAR(100),
    Empresa VARCHAR(100),
    Costo DECIMAL(10,2)
);

CREATE TABLE Proveedor_Servicio (
    ID_Proveedor INT,
    ID_Servicio INT,
    PRIMARY KEY (ID_Proveedor, ID_Servicio),
    FOREIGN KEY (ID_Proveedor) REFERENCES Proveedor(ID_Proveedor),
    FOREIGN KEY (ID_Servicio) REFERENCES Servicio(ID_Servicio)
);

CREATE TABLE Vuelo (
    ID_Vuelo INT PRIMARY KEY AUTO_INCREMENT,
    Num_Vuelo VARCHAR(50),
    Ciudad_Origen INT,
    Ciudad_Destino INT,
    Fecha_Salida DATETIME,
    Fecha_Llegada DATETIME,
    Precio DECIMAL(10,2),
    FOREIGN KEY (Ciudad_Origen) REFERENCES Ciudad(ID_Ciudad),
    FOREIGN KEY (Ciudad_Destino) REFERENCES Ciudad(ID_Ciudad)
);

CREATE TABLE Viaje_Vuelo (
    ID_Viaje INT,
    ID_Vuelo INT,
    PRIMARY KEY (ID_Viaje, ID_Vuelo),
    FOREIGN KEY (ID_Viaje) REFERENCES Viaje(ID_Viaje),
    FOREIGN KEY (ID_Vuelo) REFERENCES Vuelo(ID_Vuelo)
);

CREATE TABLE Paquete_Turistico (
    ID_Paquete INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    Precio DECIMAL(10,2),
    ID_Ciudad INT,
    FOREIGN KEY (ID_Ciudad) REFERENCES Ciudad(ID_Ciudad)
);

CREATE TABLE Paquete_Hotel (
    ID_Paquete INT,
    ID_Hotel INT,
    PRIMARY KEY (ID_Paquete, ID_Hotel),
    FOREIGN KEY (ID_Paquete) REFERENCES Paquete_Turistico(ID_Paquete),
    FOREIGN KEY (ID_Hotel) REFERENCES Hotel(ID_Hotel)
);

CREATE TABLE Paquete_Servicio (
    ID_Paquete INT,
    ID_Servicio INT,
    PRIMARY KEY (ID_Paquete, ID_Servicio),
    FOREIGN KEY (ID_Paquete) REFERENCES Paquete_Turistico(ID_Paquete),
    FOREIGN KEY (ID_Servicio) REFERENCES Servicio(ID_Servicio)
);

CREATE TABLE Guia_Turistico (
    ID_Guia INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Telefono VARCHAR(20),
    Idioma VARCHAR(50),
    ID_Ciudad INT,
    FOREIGN KEY (ID_Ciudad) REFERENCES Ciudad(ID_Ciudad)
);

CREATE TABLE Promocion (
    ID_Promocion INT PRIMARY KEY AUTO_INCREMENT,
    Descripcion TEXT,
    Descuento DECIMAL(5,2),
    Periodo_Validez VARCHAR(50),
    ID_Empleado VARCHAR(15),
    FOREIGN KEY (ID_Empleado) REFERENCES Empleado(DNI)
);

CREATE TABLE Transporte (
    ID_Transporte INT PRIMARY KEY AUTO_INCREMENT,
    Tipo VARCHAR(50) NOT NULL,
    Costo DECIMAL(10,2) NOT NULL,
    Empresa VARCHAR(100) NOT NULL
);

CREATE TABLE Paq_Turistico_Transporte (
    ID_Paquete INT,
    ID_Transporte INT,
    PRIMARY KEY (ID_Paquete, ID_Transporte),
    FOREIGN KEY (ID_Paquete) REFERENCES Paquete_Turistico(ID_Paquete),
    FOREIGN KEY (ID_Transporte) REFERENCES Transporte(ID_Transporte)
);

-- 1. Primero las tablas independientes
-- Ciudad
INSERT INTO Ciudad (Nombre, Pais, Tipo_Transporte) VALUES
('Lima', 'Perú', 'Terrestre y Aéreo'),
('Arequipa', 'Perú', 'Terrestre y Aéreo'),
('Cusco', 'Perú', 'Terrestre y Aéreo'),
('Santiago', 'Chile', 'Terrestre y Aéreo'),
('Buenos Aires', 'Argentina', 'Terrestre y Aéreo');

-- Sucursal
INSERT INTO Sucursal (Direccion, Telefono, nombre) VALUES
('Av. Principal 123, Lima', '123456789', 'Sucursal Central Lima'),
('Jr. Comercio 456, Arequipa', '987654321', 'Sucursal Arequipa Centro'),
('Calle Turismo 789, Cusco', '456789123', 'Sucursal Cusco Plaza'),
('Av. Libertad 234, Santiago', '789123456', 'Sucursal Santiago Centro'),
('Calle Mayo 567, Buenos Aires', '321654987', 'Sucursal Buenos Aires Norte');

-- Cliente
INSERT INTO Cliente (DNI, Nombre, Apellidos, Telefono, Email, c_username, c_password) VALUES
('12345671', 'Luis', 'Rodríguez Pérez', '888777666', 'luis@email.com', 'lrodri', 'cpass123'),
('12345672', 'Carmen', 'Díaz García', '888777667', 'carmen@email.com', 'cdiaz', 'cpass124'),
('12345673', 'Jorge', 'Flores López', '888777668', 'jorge@email.com', 'jflores', 'cpass125'),
('12345674', 'Laura', 'Torres Ruiz', '888777669', 'laura@email.com', 'ltorres', 'cpass126'),
('12345675', 'Miguel', 'Castro Silva', '888777670', 'miguel@email.com', 'mcastro', 'cpass127');

-- 2. Luego las que dependen de una tabla
-- Empleado (depende de Sucursal)
INSERT INTO Empleado (DNI, Nombre, Apellidos, Telefono, ID_Sucursal, Puesto, e_username, e_password) VALUES
('45678901', 'Juan', 'Pérez López', '999888777', 1, 'Gerente', 'jperez', 'pass123'),
('45678902', 'María', 'García Ruiz', '999888778', 2, 'Vendedor', 'mgarcia', 'pass124'),
('45678903', 'Carlos', 'López Torres', '999888779', 3, 'Vendedor', 'clopez', 'pass125'),
('45678904', 'Ana', 'Martínez Silva', '999888780', 4, 'Supervisor', 'amartinez', 'pass126'),
('45678905', 'Pedro', 'Sánchez Vega', '999888781', 5, 'Vendedor', 'psanchez', 'pass127');

-- Viaje (depende de Cliente)
INSERT INTO Viaje (Nombre, Descripcion, Duracion, Precio, DNI_Cliente) VALUES
('Tour Machu Picchu', 'Visita a la ciudad inca', 5, 1500.00, '12345671'),
('Tour Valle Sagrado', 'Recorrido por el valle sagrado de los incas', 3, 800.00, '12345672'),
('City Tour Lima', 'Conoce la ciudad de los reyes', 1, 100.00, '12345673'),
('Tour Vinicola', 'Recorrido por viñedos de Santiago', 2, 200.00, '12345674'),
('Tour Buenos Aires', 'Conoce la ciudad del tango', 3, 300.00, '12345675');

-- 3. Ahora sí podemos insertar Reserva (depende de Viaje, Sucursal y Empleado)
INSERT INTO Reserva (Fecha, Estado, ID_Viaje, ID_Sucursal, DNI_Empleado) VALUES
('2024-01-15', 'Confirmado', 1, 1, '45678901'),
('2024-01-16', 'Pendiente', 2, 2, '45678902'),
('2024-01-17', 'Confirmado', 3, 3, '45678903'),
('2024-01-18', 'Cancelada', 4, 4, '45678904'),
('2024-01-19', 'Confirmado', 5, 5, '45678905');

-- 4. Pago (depende de Reserva)
INSERT INTO Pago (Monto, Fecha, Estado, Metodo_Pago, ID_Reserva) VALUES
(1500.00, '2024-01-15', 'Completado', 'Tarjeta', 1),
(800.00, '2024-01-16', 'Pendiente', 'Transferencia', 2),
(100.00, '2024-01-17', 'Completado', 'Efectivo', 3),
(200.00, '2024-01-18', 'Reembolsado', 'Tarjeta', 4),
(300.00, '2024-01-19', 'Completado', 'Transferencia', 5);

-- 5. Hotel (depende de Ciudad)
INSERT INTO Hotel (Nombre, Direccion, Categoria, Telefono, Precio_Por_Noche, ID_Ciudad) VALUES
('Hotel Lima Plaza', 'Av. Lima 123', '4 estrellas', '111222333', 150.00, 1),
('Hotel Arequipa Real', 'Calle Real 456', '3 estrellas', '222333444', 100.00, 2),
('Hotel Cusco Imperial', 'Plaza Mayor 789', '5 estrellas', '333444555', 200.00, 3),
('Hotel Santiago View', 'Av. Central 234', '4 estrellas', '444555666', 180.00, 4),
('Hotel Buenos Aires Suites', 'Av. Mayo 567', '5 estrellas', '555666777', 220.00, 5);

-- 6. Proveedor (independiente)
INSERT INTO Proveedor (Nombre, Direccion, Telefono, Email) VALUES
('Transportes Rápidos', 'Av. Transport 123', '666777888', 'transportes@email.com'),
('Servicios Turísticos SA', 'Jr. Turismo 456', '777888999', 'servicios@email.com'),
('Hoteles Unidos', 'Calle Hotel 789', '888999000', 'hoteles@email.com'),
('Viajes Express', 'Av. Viajes 234', '999000111', 'viajes@email.com'),
('Tours & Más', 'Jr. Tours 567', '000111222', 'tours@email.com');

-- 7. Servicio (independiente)
INSERT INTO Servicio (Tipo_Transporte, Empresa, Costo) VALUES
('Bus', 'Transportes Rápidos', 50.00),
('Van', 'Servicios Turísticos SA', 80.00),
('Minibus', 'Viajes Express', 65.00),
('Auto Privado', 'Tours & Más', 100.00),
('Bus Ejecutivo', 'Transportes Rápidos', 120.00);

-- 8. Vuelo (depende de Ciudad)
INSERT INTO Vuelo (Num_Vuelo, Ciudad_Origen, Ciudad_Destino, Fecha_Salida, Fecha_Llegada, Precio) VALUES
('VL001', 1, 2, '2024-01-20 08:00:00', '2024-01-20 09:30:00', 150.00),
('VL002', 2, 3, '2024-01-20 10:00:00', '2024-01-20 11:30:00', 180.00),
('VL003', 3, 4, '2024-01-20 13:00:00', '2024-01-20 15:30:00', 250.00),
('VL004', 4, 5, '2024-01-20 16:00:00', '2024-01-20 18:30:00', 300.00),
('VL005', 5, 1, '2024-01-20 19:00:00', '2024-01-20 21:30:00', 280.00);

-- 9. Paquete_Turistico (independiente)
INSERT INTO Paquete_Turistico (Nombre, Descripcion, Precio) VALUES
('Paquete Básico', 'Tour básico por la ciudad', 200.00),
('Paquete Premium', 'Tour completo con hotel 5 estrellas', 500.00),
('Paquete Familiar', 'Tour para toda la familia', 800.00),
('Paquete Aventura', 'Tour de deportes extremos', 400.00),
('Paquete Cultural', 'Tour por museos y sitios históricos', 300.00);

-- 10. Guia_Turistico (depende de Ciudad)
INSERT INTO Guia_Turistico (Nombre, Telefono, Idioma, ID_Ciudad) VALUES
('Pablo Ruiz', '123123123', 'Español, Inglés', 1),
('Ana Torres', '234234234', 'Español, Portugués', 2),
('Carlos López', '345345345', 'Español, Francés', 3),
('María García', '456456456', 'Español, Alemán', 4),
('Juan Pérez', '567567567', 'Español, Italiano', 5);

-- 11. Promocion (depende de Empleado)
INSERT INTO Promocion (Descripcion, Descuento, Periodo_Validez, ID_Empleado) VALUES
('Descuento Verano', 15.00, 'Enero 2024', '45678901'),
('Oferta Familias', 20.00, 'Febrero 2024', '45678902'),
('Early Bird', 10.00, 'Marzo 2024', '45678903'),
('Descuento Grupos', 25.00, 'Abril 2024', '45678904'),
('Oferta Flash', 30.00, 'Mayo 2024', '45678905');

-- 12. Transporte (independiente)
INSERT INTO Transporte (Tipo, Costo, Empresa) VALUES
('Bus Turístico', 100.00, 'Transportes Turísticos SA'),
('Minivan', 150.00, 'Mobility Tours'),
('Auto Privado', 200.00, 'Car Service Plus'),
('Bus Ejecutivo', 180.00, 'Executive Travel'),
('Transporte VIP', 300.00, 'VIP Mobility');

-- 13. Tablas de relación (muchos a muchos)
INSERT INTO Proveedor_Hotel (ID_Proveedor, ID_Hotel) VALUES
(1, 1), (1, 2), (2, 3), (3, 4), (3, 5);

INSERT INTO Proveedor_Servicio (ID_Proveedor, ID_Servicio) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5);

INSERT INTO Viaje_Vuelo (ID_Viaje, ID_Vuelo) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5);

INSERT INTO Paquete_Hotel (ID_Paquete, ID_Hotel) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5);

INSERT INTO Paquete_Servicio (ID_Paquete, ID_Servicio) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5);

INSERT INTO Paq_Turistico_Transporte (ID_Paquete, ID_Transporte) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5);

-- Primero actualizamos las ciudades (desde ID 6)
INSERT INTO Ciudad (Nombre, Pais, Tipo_Transporte) VALUES
('Madrid', 'España', 'Terrestre y Aéreo'),
('Barcelona', 'España', 'Terrestre y Aéreo'),
('París', 'Francia', 'Terrestre y Aéreo'),
('Londres', 'Inglaterra', 'Terrestre y Aéreo'),
('Roma', 'Italia', 'Terrestre y Aéreo'),
('Milán', 'Italia', 'Terrestre y Aéreo'),
('Berlín', 'Alemania', 'Terrestre y Aéreo'),
('Munich', 'Alemania', 'Terrestre y Aéreo'),
('Ámsterdam', 'Países Bajos', 'Terrestre y Aéreo'),
('Lisboa', 'Portugal', 'Terrestre y Aéreo'),
('Viena', 'Austria', 'Terrestre y Aéreo'),
('Praga', 'República Checa', 'Terrestre y Aéreo'),
('Atenas', 'Grecia', 'Terrestre y Aéreo'),
('Estocolmo', 'Suecia', 'Terrestre y Aéreo'),
('Oslo', 'Noruega', 'Terrestre y Aéreo'),
('Copenhague', 'Dinamarca', 'Terrestre y Aéreo'),
('Helsinki', 'Finlandia', 'Terrestre y Aéreo'),
('Varsovia', 'Polonia', 'Terrestre y Aéreo'),
('Budapest', 'Hungría', 'Terrestre y Aéreo'),
('Dubrovnik', 'Croacia', 'Terrestre y Aéreo');


-- Vuelos internacionales desde Lima (ID 1)
INSERT INTO Vuelo (Num_Vuelo, Ciudad_Origen, Ciudad_Destino, Fecha_Salida, Fecha_Llegada, Precio) VALUES
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

-- Vuelos desde Madrid (ID 6)
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

-- Vuelos desde París (ID 8)
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

-- Vuelos desde Londres (ID 9)
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
INSERT INTO Vuelo (Num_Vuelo, Ciudad_Origen, Ciudad_Destino, Fecha_Salida, Fecha_Llegada, Precio) VALUES
-- Enero 17 - 20 (Vuelos desde Lima)
('LA2005', 1, 2, '2024-01-17 08:00:00', '2024-01-17 09:30:00', 152.00),
('LA2006', 1, 3, '2024-01-17 10:00:00', '2024-01-17 11:30:00', 182.00),
('IB3203', 1, 6, '2024-01-17 23:00:00', '2024-01-18 20:30:00', 952.00),
('AF2103', 1, 8, '2024-01-17 22:00:00', '2024-01-18 19:30:00', 982.00),
('LA2007', 1, 2, '2024-01-18 08:00:00', '2024-01-18 09:30:00', 153.00),
('LA2008', 1, 3, '2024-01-18 10:00:00', '2024-01-18 11:30:00', 183.00),
('IB3204', 1, 6, '2024-01-18 23:00:00', '2024-01-19 20:30:00', 953.00),
('AF2104', 1, 8, '2024-01-18 22:00:00', '2024-01-19 19:30:00', 983.00),

-- Enero 17 - 20 (Vuelos desde Madrid)
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

-- Vuelos desde París (Enero 17-20)
('AF4409', 8, 6, '2024-01-17 08:00:00', '2024-01-17 10:00:00', 172.00),
('AF4410', 8, 7, '2024-01-17 11:30:00', '2024-01-17 13:00:00', 162.00),
('AF4411', 8, 9, '2024-01-17 15:00:00', '2024-01-17 16:15:00', 142.00),
('AF4412', 8, 10, '2024-01-17 18:00:00', '2024-01-17 19:30:00', 182.00),
('AF4413', 8, 6, '2024-01-18 08:00:00', '2024-01-18 10:00:00', 173.00),
('AF4414', 8, 7, '2024-01-18 11:30:00', '2024-01-18 13:00:00', 163.00),
('AF4415', 8, 9, '2024-01-18 15:00:00', '2024-01-18 16:15:00', 143.00),
('AF4416', 8, 10, '2024-01-18 18:00:00', '2024-01-18 19:30:00', 183.00),

-- Vuelos desde Londres (Enero 17-20)
('BA5509', 9, 6, '2024-01-17 07:30:00', '2024-01-17 09:30:00', 177.00),
('BA5510', 9, 7, '2024-01-17 11:00:00', '2024-01-17 12:30:00', 167.00),
('BA5511', 9, 8, '2024-01-17 14:30:00', '2024-01-17 15:45:00', 147.00),
('BA5512', 9, 10, '2024-01-17 17:30:00', '2024-01-17 19:00:00', 187.00),
('BA5513', 9, 6, '2024-01-18 07:30:00', '2024-01-18 09:30:00', 178.00),
('BA5514', 9, 7, '2024-01-18 11:00:00', '2024-01-18 12:30:00', 168.00),
('BA5515', 9, 8, '2024-01-18 14:30:00', '2024-01-18 15:45:00', 148.00),
('BA5516', 9, 10, '2024-01-18 17:30:00', '2024-01-18 19:00:00', 188.00),

-- Vuelos desde Roma (Enero 17-20)
('AZ6601', 10, 6, '2024-01-17 08:30:00', '2024-01-17 10:30:00', 165.00),
('AZ6602', 10, 7, '2024-01-17 12:00:00', '2024-01-17 13:30:00', 155.00),
('AZ6603', 10, 8, '2024-01-17 15:30:00', '2024-01-17 16:45:00', 135.00),
('AZ6604', 10, 9, '2024-01-17 18:30:00', '2024-01-17 20:00:00', 175.00),
('AZ6605', 10, 6, '2024-01-18 08:30:00', '2024-01-18 10:30:00', 166.00),
('AZ6606', 10, 7, '2024-01-18 12:00:00', '2024-01-18 13:30:00', 156.00),
('AZ6607', 10, 8, '2024-01-18 15:30:00', '2024-01-18 16:45:00', 136.00),
('AZ6608', 10, 9, '2024-01-18 18:30:00', '2024-01-18 20:00:00', 176.00),

-- Vuelos desde Berlín (Enero 17-20)
('LH7701', 11, 6, '2024-01-17 07:00:00', '2024-01-17 09:00:00', 158.00),
('LH7702', 11, 7, '2024-01-17 10:30:00', '2024-01-17 12:00:00', 148.00),
('LH7703', 11, 8, '2024-01-17 14:00:00', '2024-01-17 15:15:00', 128.00),
('LH7704', 11, 9, '2024-01-17 17:00:00', '2024-01-17 18:30:00', 168.00),
('LH7705', 11, 6, '2024-01-18 07:00:00', '2024-01-18 09:00:00', 159.00),
('LH7706', 11, 7, '2024-01-18 10:30:00', '2024-01-18 12:00:00', 149.00),
('LH7707', 11, 8, '2024-01-18 14:00:00', '2024-01-18 15:15:00', 129.00),
('LH7708', 11, 9, '2024-01-18 17:00:00', '2024-01-18 18:30:00', 169.00),

-- Vuelos desde Amsterdam (Enero 17-20)
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
-- Vuelos desde Lisboa (Enero 17-20)
('TP9901', 13, 6, '2024-01-17 07:45:00', '2024-01-17 09:45:00', 145.00),
('TP9902', 13, 7, '2024-01-17 11:15:00', '2024-01-17 12:45:00', 135.00),
('TP9903', 13, 8, '2024-01-17 14:45:00', '2024-01-17 16:00:00', 115.00),
('TP9904', 13, 9, '2024-01-17 17:45:00', '2024-01-17 19:15:00', 155.00),
('TP9905', 13, 6, '2024-01-18 07:45:00', '2024-01-18 09:45:00', 146.00),
('TP9906', 13, 7, '2024-01-18 11:15:00', '2024-01-18 12:45:00', 136.00),
('TP9907', 13, 8, '2024-01-18 14:45:00', '2024-01-18 16:00:00', 116.00),
('TP9908', 13, 9, '2024-01-18 17:45:00', '2024-01-18 19:15:00', 156.00),

-- Vuelos desde Viena (Enero 17-20)
('OS1001', 14, 6, '2024-01-17 08:30:00', '2024-01-17 10:30:00', 175.00),
('OS1002', 14, 7, '2024-01-17 12:00:00', '2024-01-17 13:30:00', 165.00),
('OS1003', 14, 8, '2024-01-17 15:30:00', '2024-01-17 16:45:00', 145.00),
('OS1004', 14, 9, '2024-01-17 18:30:00', '2024-01-17 20:00:00', 185.00),
('OS1005', 14, 6, '2024-01-18 08:30:00', '2024-01-18 10:30:00', 176.00),
('OS1006', 14, 7, '2024-01-18 12:00:00', '2024-01-18 13:30:00', 166.00),
('OS1007', 14, 8, '2024-01-18 15:30:00', '2024-01-18 16:45:00', 146.00),
('OS1008', 14, 9, '2024-01-18 18:30:00', '2024-01-18 20:00:00', 186.00),

-- Vuelos desde Zurich (Enero 17-20)
('LX1101', 15, 6, '2024-01-17 07:15:00', '2024-01-17 09:15:00', 185.00),
('LX1102', 15, 7, '2024-01-17 10:45:00', '2024-01-17 12:15:00', 175.00),
('LX1103', 15, 8, '2024-01-17 14:15:00', '2024-01-17 15:30:00', 155.00),
('LX1104', 15, 9, '2024-01-17 17:15:00', '2024-01-17 18:45:00', 195.00),
('LX1105', 15, 6, '2024-01-18 07:15:00', '2024-01-18 09:15:00', 186.00),
('LX1106', 15, 7, '2024-01-18 10:45:00', '2024-01-18 12:15:00', 176.00),
('LX1107', 15, 8, '2024-01-18 14:15:00', '2024-01-18 15:30:00', 156.00),
('LX1108', 15, 9, '2024-01-18 17:15:00', '2024-01-18 18:45:00', 196.00),

-- Vuelos desde Oslo (Enero 17-20)
('SK1201', 16, 6, '2024-01-17 09:00:00', '2024-01-17 11:00:00', 195.00),
('SK1202', 16, 7, '2024-01-17 12:30:00', '2024-01-17 14:00:00', 185.00),
('SK1203', 16, 8, '2024-01-17 16:00:00', '2024-01-17 17:15:00', 165.00),
('SK1204', 16, 9, '2024-01-17 19:00:00', '2024-01-17 20:30:00', 205.00),
('SK1205', 16, 6, '2024-01-18 09:00:00', '2024-01-18 11:00:00', 196.00),
('SK1206', 16, 7, '2024-01-18 12:30:00', '2024-01-18 14:00:00', 186.00),
('SK1207', 16, 8, '2024-01-18 16:00:00', '2024-01-18 17:15:00', 166.00),
('SK1208', 16, 9, '2024-01-18 19:00:00', '2024-01-18 20:30:00', 206.00),

-- Vuelos desde Estocolmo (Enero 17-20)
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
-- Vuelos desde Copenhague (Enero 17-20)
('SK1401', 18, 6, '2024-01-17 07:30:00', '2024-01-17 09:30:00', 192.00),
('SK1402', 18, 7, '2024-01-17 11:00:00', '2024-01-17 12:30:00', 182.00),
('SK1403', 18, 8, '2024-01-17 14:30:00', '2024-01-17 15:45:00', 162.00),
('SK1404', 18, 9, '2024-01-17 17:30:00', '2024-01-17 19:00:00', 202.00),
('SK1405', 18, 6, '2024-01-18 07:30:00', '2024-01-18 09:30:00', 193.00),
('SK1406', 18, 7, '2024-01-18 11:00:00', '2024-01-18 12:30:00', 183.00),
('SK1407', 18, 8, '2024-01-18 14:30:00', '2024-01-18 15:45:00', 163.00),
('SK1408', 18, 9, '2024-01-18 17:30:00', '2024-01-18 19:00:00', 203.00),

-- Vuelos desde Helsinki (Enero 17-20)
('AY1501', 19, 6, '2024-01-17 08:15:00', '2024-01-17 10:15:00', 205.00),
('AY1502', 19, 7, '2024-01-17 11:45:00', '2024-01-17 13:15:00', 195.00),
('AY1503', 19, 8, '2024-01-17 15:15:00', '2024-01-17 16:30:00', 175.00),
('AY1504', 19, 9, '2024-01-17 18:15:00', '2024-01-17 19:45:00', 215.00),
('AY1505', 19, 6, '2024-01-18 08:15:00', '2024-01-18 10:15:00', 206.00),
('AY1506', 19, 7, '2024-01-18 11:45:00', '2024-01-18 13:15:00', 196.00),
('AY1507', 19, 8, '2024-01-18 15:15:00', '2024-01-18 16:30:00', 176.00),
('AY1508', 19, 9, '2024-01-18 18:15:00', '2024-01-18 19:45:00', 216.00),

-- Vuelos intercontinentales desde Lima (Enero 19-22)
('LA2011', 1, 6, '2024-01-19 23:30:00', '2024-01-20 20:00:00', 958.00),
('LA2012', 1, 7, '2024-01-19 22:30:00', '2024-01-20 19:00:00', 948.00),
('LA2013', 1, 8, '2024-01-20 23:30:00', '2024-01-21 20:00:00', 968.00),
('LA2014', 1, 9, '2024-01-20 22:30:00', '2024-01-21 19:00:00', 978.00),
('LA2015', 1, 10, '2024-01-21 23:30:00', '2024-01-22 20:00:00', 988.00),
('LA2016', 1, 11, '2024-01-21 22:30:00', '2024-01-22 19:00:00', 998.00),

-- Vuelos desde Madrid a Sudamérica (Enero 19-22)
('IB3321', 6, 1, '2024-01-19 23:00:00', '2024-01-20 19:30:00', 962.00),
('IB3322', 6, 2, '2024-01-19 22:00:00', '2024-01-20 18:30:00', 942.00),
('IB3323', 6, 3, '2024-01-20 23:00:00', '2024-01-21 19:30:00', 952.00),
('IB3324', 6, 4, '2024-01-20 22:00:00', '2024-01-21 18:30:00', 972.00),
('IB3325', 6, 5, '2024-01-21 23:00:00', '2024-01-22 19:30:00', 982.00),

-- Vuelos internos Europa (Enero 19-22)
('AF4417', 8, 11, '2024-01-19 08:30:00', '2024-01-19 10:30:00', 168.00),
('AF4418', 8, 12, '2024-01-19 12:00:00', '2024-01-19 13:30:00', 158.00),
('AF4419', 8, 13, '2024-01-19 15:30:00', '2024-01-19 16:45:00', 148.00),
('AF4420', 8, 14, '2024-01-19 18:30:00', '2024-01-19 20:00:00', 178.00),
('AF4421', 8, 15, '2024-01-20 08:30:00', '2024-01-20 10:30:00', 169.00),
('AF4422', 8, 16, '2024-01-20 12:00:00', '2024-01-20 13:30:00', 159.00),
('AF4423', 8, 17, '2024-01-20 15:30:00', '2024-01-20 16:45:00', 149.00),
('AF4424', 8, 18, '2024-01-20 18:30:00', '2024-01-20 20:00:00', 179.00),

-- Vuelos desde Londres a Europa (Enero 19-22)
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





-- Hoteles correspondientes a estas ciudades
INSERT INTO Hotel (Nombre, Direccion, Categoria, Telefono, Precio_Por_Noche, ID_Ciudad) VALUES
('Madrid Grand Hotel', 'Gran Vía 123', '5 estrellas', '34912345678', 250.00, 6),
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
INSERT INTO Guia_Turistico (Nombre, Telefono, Idioma, ID_Ciudad) VALUES
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


INSERT INTO Hotel (Nombre, Direccion, Categoria, Telefono, Precio_Por_Noche, ID_Ciudad) VALUES
-- Madrid (ID 6)
('Gran Vía Palace', 'Gran Vía 234', '5 estrellas', '+34913456789', 280.00, 6),
('Retiro Suites', 'Calle Alcalá 567', '4 estrellas', '+34914567890', 220.00, 6),
('Sol Premium', 'Puerta del Sol 123', '4 estrellas', '+34915678901', 200.00, 6),
('Salamanca Luxury', 'Calle Serrano 89', '5 estrellas', '+34916789012', 300.00, 6),
('Madrid Rivers', 'Paseo del Prado 45', '3 estrellas', '+34917890123', 150.00, 6),

-- Barcelona (ID 7)
('Sagrada Hotel', 'Sagrada Familia 456', '5 estrellas', '+34931234567', 270.00, 7),
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
('Hyde Park Hotel', 'Hyde Park Corner 89', '5 estrellas', '+44207123459', 350.00, 9),
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


INSERT INTO Hotel (Nombre, Direccion, Categoria, Telefono, Precio_Por_Noche, ID_Ciudad) VALUES
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

INSERT INTO Viaje (Nombre, Descripcion, Duracion, Precio)
VALUES 
('Fiesta de playa', 'Un viaje emocionante a la playa', 5, 300.00),
('Escalada', 'Aventura en la montaña', 5, 500.00),
('Por las calles', 'Exploración urbana', 2, 200.00),
('Escapada Rural', 'Descanso en el campo', 4, 400.00),
('Naveguemos', 'Recorrido costero', 7, 700.00),
('Dinosaurios', 'Un viaje en el tiempo', 5, 340.00),
('Viaje espacial', 'Observemos las estrellas', 5, 510.00),
('Por la historia', 'Viaje por las ruinas', 2, 300.00),
('Volcan', 'Pompeya cuidad historica', 4, 490.00),
('Poderosos Vientos', 'Traigan sus cometas', 4, 200.00),
('Con la naturaleza', 'Descansa junto a los koalas', 7, 800.00);



INSERT INTO Empleado (DNI, Nombre, Apellidos, Telefono, puesto, e_username, e_password)
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
