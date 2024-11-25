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
    e_username VARCHAR(50) UNIQUE,
    e_password VARCHAR(255),
    FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal)
);

CREATE TABLE cliente (
    dni VARCHAR(15) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    c_username VARCHAR(50) UNIQUE,
    c_password VARCHAR(255) NOT NULL
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
    imagen varchar(255),
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


CREATE TABLE promocion (
    id_promocion INT PRIMARY KEY AUTO_INCREMENT,
    descripcion TEXT,
    descuento DECIMAL(5,2)
);

CREATE TABLE paquete_turistico (
    id_paquete INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2),
    id_ciudad INT,
    id_promocion INT DEFAULT 1,
    precio_base DECIMAL(10,2),
    imagen VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (id_ciudad) REFERENCES ciudad(id_ciudad),
    FOREIGN KEY (id_promocion) REFERENCES promocion(id_promocion)
);




CREATE TABLE guia_turistico (
    id_guia INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    idioma VARCHAR(255),
    id_ciudad INT,
    FOREIGN KEY (id_ciudad) REFERENCES ciudad(id_ciudad)
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
('Lima','Peru'),
('Arequipa','Peru'),
('Sao Paulo','Brasil'),
('Brasilia','Brasil'),
('Santiago de chile','Chile'),
('Arica','Chile'),
('Bogota','Colombia'),
('Medellin','Colombia'),
('Buenos Aires','Argentina'),
('Córdoba','Argentina');


-- sucursal
INSERT INTO sucursal (direccion, telefono, nombre) VALUES
('Av. Principal 123, Lima', '123456789', 'Sucursal Central Lima'),
('Jr. Comercio 456, Arequipa', '987654321', 'Sucursal Arequipa Centro'),
('Calle Turismo 789, Lima', '456789123', 'Sucursal Lima provincia'),
('Av. Libertad 234, Lima', '789123456', 'Sucursal Lima Este'),
('Calle Mayo 567, Arequipa', '321654987', 'Sucursal Arequipa Norte');



-- 2. Luego las que dependen de una tabla
-- empleado (depende de sucursal)
INSERT INTO empleado (dni, nombre, apellidos, telefono, id_sucursal, puesto, e_username, e_password) VALUES
('45678901', 'Juan', 'Pérez López', '999888777', 1, 'Gerente', 'jperez', 'pass123'),
('45678902', 'María', 'García Ruiz', '999888778', 2, 'Vendedor', 'mgarcia', 'pass124'),
('45678903', 'Carlos', 'López Torres', '999888779', 3, 'Vendedor', 'clopez', 'pass125'),
('45678904', 'Ana', 'Martínez Silva', '999888780', 4, 'Administrador', 'amartinez', 'pass126'),
('45678905', 'Pedro', 'Sánchez Vega', '999888781', 5, 'Vendedor', 'psanchez', 'pass127');


INSERT INTO empleado (dni, nombre, apellidos, telefono,id_sucursal, puesto, e_username, e_password)
VALUES 
('0000001', 'Juan', 'Pérez', '1122334455', 2, 'Gerente', 'juanxp', 'pass123'),
('0000002', 'Ana', 'García', '2233445566', 2, 'Administrador', 'aqnag', 'pass456'),
('0000003', 'Carlos', 'Ruiz', '3344556677', 1, 'Vendedor', 'carloxsr', 'pass789'),
('0000004', 'Luisa', 'Martínez', '4455667788', 3, 'Vendedor', 'luissam', 'pass101'),
('0000005', 'Pedro', 'López', '8899556677', 4,'Administrador', 'pedqwrol', 'pass202'),
('0000006', 'Jan', 'Rez', '4455112233', 1, 'Gerente', 'juansp', 'pawss123'),
('0000007', 'Anastacia', 'Gracia', '5566223344', 2, 'Vendedor', 'ancag', 'pass456'),
('0000008', 'Carlos', 'Santos', '5566773344', 3, 'Vendedor', 'carlossr', 'pass789'),
('0000009', 'Luis', 'Rodriguez', '6677884455', 2, 'Vendedor', 'luisam', 'pass101'),
('0000010', 'Pedro', 'Ruan', '7788995566', 1, 'Administrador', 'pedroxl', 'pass202');



INSERT INTO hotel (nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad, imagen) VALUES
-- Hoteles en Lima
('The Westin Lima Hotel', 'Av. Principal 123, Lima', '5 estrellas', '511-1234567', 90.50, 1, 'hotel_lima_1.jpg'),
('Hotel Hampton', 'Calle Secundaria 456, Lima', '4 estrellas', '511-7654321', 80.75, 1, 'hotel_lima_2.jpg'),

-- Hoteles en Arequipa
('Hotel Arequipa Colonial', 'Plaza de Armas 789, Arequipa', '4 estrellas', '5154-9876543', 80.00, 2, 'hotel_arequipa_1.jpg'),
('Hotel Misti Vista', 'Calle Volcanes 321, Arequipa', '3 estrellas', '5154-1237890', 60.30, 2, 'hotel_arequipa_2.jpg'),

-- Hoteles en Sao Paulo
('Hotel Paulista Palace', 'Av. Paulista 987, Sao Paulo', '5 estrellas', '5511-8765432', 150.00, 3, 'hotel_saopaulo_1.jpg'),
('Hotel Ibirapuera', 'Rua Jardins 654, Sao Paulo', '4 estrellas', '5511-2345678', 110.00, 3, 'hotel_saopaulo_2.jpg'),

-- Hoteles en Brasilia
('Hotel Brasilia Lux', 'Esplanada 123, Brasilia', '5 estrellas', '5561-1122334', 135.00, 4, 'hotel_brasilia_1.jpg'),
('Hotel Planalto', 'Av. Monumental 456, Brasilia', '3 estrellas', '5561-9988776', 90.50, 4, 'hotel_brasilia_2.jpg'),

-- Hoteles en Santiago de Chile
('Hotel Andes', 'Calle Central 123, Santiago de Chile', '4 estrellas', '562-3344556', 120.00, 5, 'hotel_santiagodechile_1.jpg'),
('Hotel Mapocho', 'Av. Alameda 456, Santiago de Chile', '3 estrellas', '562-7766554', 85.00, 5, 'hotel_santiagodechile_2.jpg'),

-- Hoteles en Arica
('Hotel Morro', 'Calle Pacífico 789, Arica', '3 estrellas', '569-5544332', 70.00, 6, 'hotel_arica_1.jpg'),
('Hotel Arica', 'Av. Playa 321, Arica', '4 estrellas', '569-1122334', 95.50, 6, 'hotel_arica_2.jpg'),

-- Hoteles en Bogotá
('Hotel Monserrate', 'Calle 26 123, Bogotá', '5 estrellas', '571-8877665', 125.75, 7, 'hotel_bogota_1.jpg'),
('Hotel Candelaria', 'Av. Circunvalar 456, Bogotá', '4 estrellas', '571-3344556', 100.00, 7, 'hotel_bogota_2.jpg'),

-- Hoteles en Medellín
('Hotel Poblado Plaza', 'Calle Loma 789, Medellín', '5 estrellas', '574-9988775', 110.00, 8, 'hotel_medellin_1.jpg'),
('Hotel Primavera', 'Av. Florida 321, Medellín', '4 estrellas', '574-7766554', 95.00, 8, 'hotel_medellin_2.jpg'),

-- Hoteles en Buenos Aires
('Hotel Obelisco', 'Av. 9 de Julio 123, Buenos Aires', '5 estrellas', '5411-2233445', 140.00, 9, 'hotel_buenosaires_1.jpg'),
('Hotel Tango', 'Calle Corrientes 456, Buenos Aires', '4 estrellas', '5411-6677889', 110.00, 9, 'hotel_buenosaires_2.jpg'),

-- Hoteles en Córdoba
('Hotel Córdoba Capital', 'Av. Colón 789, Córdoba', '4 estrellas', '54351-1234567', 105.00, 10, 'hotel_cordoba_1.jpg'),
('Hotel Serrano', 'Calle Montaña 321, Córdoba', '3 estrellas', '54351-7654321', 85.50, 10, 'hotel_cordoba_2.jpg');

-- 6. proveedor (independiente)
INSERT INTO proveedor (nombre, direccion, telefono, email) VALUES
('Transportes Rápidos', 'Av. Transport 123', '666777888', 'transportes@email.com'),
('Servicios Turísticos SA', 'Jr. Turismo 456', '777888999', 'servicios@email.com'),
('Hoteles Unidos', 'Calle hotel 789', '888999000', 'hoteles@email.com'),
('viajes Express', 'Av. viajes 234', '999000111', 'viajes@email.com'),
('Tours & Más', 'Jr. Tours 567', '000111222', 'tours@email.com');

-- 7. servicio (independiente)
INSERT INTO servicio (id_proveedor, descripcion, costo, ciudad_int) VALUES
(1, 'Cita en el spa', 50.00, 1),
(2, 'Sesión de fotos en el centro histórico', 80.00, 2),
(3, 'Paseo en lancha por el río Tieté', 65.00, 3),
(4, 'Tour gastronómico por Brasilia', 100.00, 4),
(5, 'Excursión ecológica en viñedos', 120.00, 5),
(1, 'Cita en el spa frente al Morro de Arica', 50.00, 6),
(3, 'Tour gastronómico en Bogotá', 100.00, 7),
(4, 'Sesión de fotos en Comuna 13', 80.00, 8),
(2, 'Paseo en lancha por el Delta del Tigre', 65.00, 9),
(3, 'Excursión ecológica en las Sierras de Córdoba', 120.00, 10);
INSERT INTO servicio (id_proveedor, descripcion, costo, ciudad_int) VALUES
(1, 'Masaje relajante en el spa', 60.00, 1),
(2, 'Tour histórico con guía local', 85.00, 2),
(3, 'Paseo en bote por el río Tieté', 70.00, 3),
(4, 'Degustación de platos típicos de Brasilia', 95.00, 4),
(5, 'Ruta de viñedos en bicicleta', 125.00, 5),
(1, 'Excursión al Morro de Arica al amanecer', 55.00, 6),
(2, 'Cena gourmet en Bogotá', 110.00, 7),
(3, 'Recorrido cultural en Comuna 13', 90.00, 8),
(4, 'Tour ecológico por el Delta del Tigre', 75.00, 9),
(5, 'Senderismo en las Sierras de Córdoba', 130.00, 10);

-- 8. promocion 
INSERT INTO promocion (descripcion, descuento) VALUES ('sin descuento', 0.00);
INSERT INTO promocion (descripcion, descuento) VALUES
('descuento Verano', 15.00),
('Oferta Familias', 20.00),
('Early Bird', 10.00),
('descuento Grupos', 25.00),
('Oferta Flash', 30.00);




-- 9. paquete_turistico (independiente)
INSERT INTO paquete_turistico (nombre, descripcion, precio, id_ciudad, id_promocion, precio_base) VALUES
('Paquete Básico', 'Tour básico por la ciudad', 200.00, 1, 1, 200.00),
('Paquete Premium', 'Tour completo con hotel 5 estrellas', 500.00, 2, 2, 500.00),
('Paquete Familiar', 'Tour para toda la familia', 800.00, 3, 3, 800.00),
('Paquete Aventura', 'Tour de deportes extremos', 400.00 ,1, 2, 400.00),
('Paquete Cultural', 'Tour por museos y sitios históricos', 300.00, 4, 1, 300.00),
('Colca Full Day', 'Disfruta del vuelo de Cóndor', 200.00, 2, 1, 200.00),
('Cañon de Cotahuasi', 'Disfruta del cañon mas profundo del Peru', 250.00, 2, 2, 250.00),
('Laguna Salinas', 'Disfruta de la laguna', 150.00, 2, 3, 150.00);




-- 12. transporte (independiente)
INSERT INTO transporte (tipo, costo, empresa) VALUES
('Bus Turístico', 100.00, 'transportes Turísticos SA'),
('Minivan', 150.00, 'Mobility Tours'),
('Auto Privado', 200.00, 'Car Service Plus'),
('Bus Ejecutivo', 180.00, 'Executive Travel'),
('transporte VIP', 300.00, 'VIP Mobility');

INSERT INTO vuelo (num_vuelo, ciudad_origen, ciudad_destino, fecha_salida, fecha_llegada, precio) 
WITH RECURSIVE fechas AS ( 
    SELECT CAST('2025-01-01' AS DATE) AS fecha 
    UNION ALL 
    SELECT DATE_ADD(fecha, INTERVAL 1 DAY) 
    FROM fechas 
    WHERE fecha < '2025-01-31' 
),
horarios AS ( 
    SELECT 1 as id, '08:00:00' as hora_salida, '11:00:00' as hora_llegada 
    UNION ALL 
    SELECT 2, '14:00:00', '17:00:00' 
),
ciudades_origen AS ( 
    SELECT id_ciudad, nombre 
    FROM ciudad 
),
ciudades_destino AS ( 
    SELECT id_ciudad, nombre 
    FROM ciudad 
)
SELECT 
    CONCAT('FL', LPAD(FLOOR(RAND() * 9999), 4, '0')),
    co.id_ciudad,
    cd.id_ciudad,
    TIMESTAMP(f.fecha, h.hora_salida),
    TIMESTAMP(f.fecha, h.hora_llegada),
    ROUND(RAND() * (500-100) + 100, 2)
FROM fechas f
CROSS JOIN horarios h
CROSS JOIN ciudades_origen co
CROSS JOIN ciudades_destino cd
WHERE co.id_ciudad != cd.id_ciudad
ORDER BY f.fecha, h.hora_salida;





-- Guías Turísticos para estas ciudades
INSERT INTO guia_turistico (nombre, telefono, idioma, id_ciudad) VALUES
('Carlos Martínez', '946111111', 'Español, Inglés', 1),
('Ana García', '946222222', 'Español, Francés, Inglés', 1),
('Pierre Dubois', '996333333', 'Francés, Inglés, Español', 2),
('John Smith', '946444444', 'Inglés, Español, Francés', 2),
('Marco Rossi', '996555555', 'Italiano, Inglés, Español', 3),
('Giuseppe Verdi', '996666666', 'Italiano, Inglés, Alemán', 3),
('Hans Weber', '996777777', 'Alemán, Inglés, Español', 4),
('Franz Mueller', '996888888', 'Alemán, Inglés, Francés', 4),
('Jan van der Berg', '916999999', 'Holandés, Inglés, Alemán', 5),
('João Silva', '9516111111', 'Portugués, Inglés, Español', 5),
('Klaus Wagner', '936222222', 'Alemán, Inglés, Italiano', 6),
('Pavel Novak', '9206333333', 'Checo, Inglés, Alemán', 6),
('Nikos Papadopoulos', '906444444', 'Griego, Inglés, Francés', 7),
('Erik Andersson', '966555555', 'Sueco, Inglés, Alemán', 7),
('Magnus Olsen', '976666666', 'Noruego, Inglés, Alemán', 8),
('Lars Hansen', '956777777', 'Danés, Inglés, Alemán', 8),
('Mikko Virtanen', '9586888888', 'Finés, Inglés, Sueco', 9),
('Adam Kowalski', '986999999', 'Polaco, Inglés, Alemán', 9),
('István Nagy', '966111111', 'Húngaro, Inglés, Alemán', 10),
('Marko Kovačić', '9856222222', 'Croata, Inglés, Italiano', 10);


INSERT INTO guia_turistico (nombre, telefono, idioma, id_ciudad) VALUES
('Pablo Ruiz', '923123123', 'Español', 1),
('Ana Torres', '934234234', 'Portugués', 2),
('Carlos López', '945345345', 'Francés', 3),
('María García', '956456456', 'Alemán', 4),
('Juan Pérez', '967567567', 'Italiano', 5);



-- 13. Tablas de relación (muchos a muchos)
INSERT INTO proveedor_hotel (id_proveedor, id_hotel) VALUES
(1, 1), (1, 2), (2, 3), (3, 4), (3, 5);



/**********+procedimientos:********/





/**PROCEDURREEES*/
DELIMITER //
CREATE PROCEDURE InsertCliente(
    IN p_nombre VARCHAR(50),
    IN p_apellido VARCHAR(50),
    IN p_username VARCHAR(50),
    IN p_password VARCHAR(255),
    IN p_dni VARCHAR(20),
    IN p_telefono VARCHAR(20),
    IN p_email VARCHAR(50)
)
BEGIN
    INSERT INTO cliente (nombre, apellidos, c_username, c_password, dni, telefono, email)
    VALUES (p_nombre, p_apellido, p_username, p_password, p_dni, p_telefono, p_email);
END //
DELIMITER ;

DELIMITER //

CREATE PROCEDURE VerificarUsuario(
    IN input_username VARCHAR(50)
)
BEGIN
    SELECT 
        nombre, apellidos, dni, telefono, email, c_password 
    FROM 
        cliente
    WHERE 
        c_username = input_username;
END //

DELIMITER ;


/*TRIGGERRS**/

DELIMITER //
CREATE TRIGGER create_reserva AFTER INSERT ON viaje FOR EACH ROW BEGIN INSERT INTO reserva (id_viaje, fecha, estado) VALUES (NEW.id_viaje, CURDATE(), 'Pendiente'); END; //
DELIMITER;


DELIMITER //
CREATE TRIGGER create_pago AFTER INSERT ON reserva FOR EACH ROW BEGIN DECLARE precio DECIMAL(10,2); SELECT v.precio INTO precio FROM viaje v WHERE v.id_viaje = NEW.id_viaje; INSERT INTO pago (id_reserva, fecha, monto, estado) VALUES (NEW.id_reserva, CURDATE(), precio, 'Pendiente'); END//
DELIMITER;


DELIMITER //
CREATE TRIGGER update_pago_estado
AFTER UPDATE ON reserva
FOR EACH ROW
BEGIN
    -- Verifica si el estado cambia a 'Confirmado'
    IF NEW.estado = 'Confirmado' THEN
        -- Actualiza el estado en la tabla pago correspondiente
        UPDATE pago
        SET estado = 'Completado'
        WHERE id_reserva = NEW.id_reserva;
    END IF;
END;
//
DELIMITER ;


/**PROMOCION**/



DELIMITER $$

CREATE FUNCTION calcular_precio_con_descuento(precio DECIMAL(10, 2), descuento DECIMAL(5, 2))
RETURNS DECIMAL(5, 2)
DETERMINISTIC
BEGIN
    RETURN precio - (precio * (descuento / 100));
END$$

DELIMITER ;




DELIMITER //
CREATE TRIGGER aplicar_descuento_a_paquete
BEFORE UPDATE ON paquete_turistico
FOR EACH ROW
BEGIN
 
    IF NEW.id_promocion IS NOT NULL AND NEW.id_promocion <> OLD.id_promocion THEN

        SET NEW.precio = calcular_precio_con_descuento(NEW.precio, (
            SELECT descuento
            FROM promocion
            WHERE id_promocion = NEW.id_promocion
        ));
    END IF;
END;
//
DELIMITER ;


-- cliente
-- INSERT INTO cliente (dni, nombre, apellidos, telefono, email, c_username, c_password) VALUES
-- ('12345671', 'Luis', 'Rodríguez Pérez', '998777666', 'luis@email.com', 'lrodri', 'cpass123'),
-- ('12345672', 'Carmen', 'Díaz García', '998777667', 'carmen@email.com', 'cdiaz', 'cpass124'),
-- ('12345673', 'Jorge', 'Flores López', '998777668', 'jorge@email.com', 'jflores', 'cpass125'),
-- ('12345674', 'Laura', 'Torres Ruiz', '998777669', 'laura@email.com', 'ltorres', 'cpass126'),
-- ('12345675', 'Miguel', 'Castro Silva', '998777670', 'miguel@email.com', 'mcastro', 'cpass127'),
-- ('12345676', 'Gabriel', 'Lopez Mendez', '998777670', 'gab@email.com', 'glopez', 'cpass127'),
-- ('12345677', 'Luis', 'Fernandez Calapuja', '998777670', 'lucho@email.com', 'luchito', 'cpass127');
INSERT INTO cliente (dni, nombre, apellidos, telefono, email, c_username, c_password) VALUES
('12345671', 'Luis', 'Rodríguez Pérez', '998777666', 'luis@email.com', 'lrodri', 'cpass123'),
('12345672', 'Carmen', 'Díaz García', '998777667', 'carmen@email.com', 'cdiaz', 'cpass124'),
('12345673', 'Jorge', 'Flores López', '998777668', 'jorge@email.com', 'jflores', 'cpass125'),
('12345674', 'Laura', 'Torres Ruiz', '998777669', 'laura@email.com', 'ltorres', 'cpass126'),
('12345675', 'Miguel', 'Castro Silva', '998777670', 'miguel@email.com', 'mcastro', 'cpass127'),
('12345676', 'Gabriel', 'Lopez Mendez', '998777670', 'gab@email.com', 'glopez', 'cpass127'),
('12345677', 'Luis', 'Fernandez Calapuja', '998777670', 'lucho@email.com', 'luchito', 'cpass127');

INSERT INTO viaje (duracion, precio, dni_cliente, vuelo_ida, vuelo_regreso, paquete_turistico, hotel, guia, transporte) VALUES
(7, 1200.00, '12345672', 1, 2, 1, 1, 1, 1),
(5, 900.00, '12345673', 2, null, 2, 2, 2, 2),
(3, 600.00, '12345674', 3, null, null, 3, null, 3),
(7, 1200.00, '12345675', 1, 2, 1, 1, 1, 1),
(5, 900.00, '12345677', 2, null, 2, 2, 2, 2),
(3, 600.00, '12345676', 3, null, null, 3, null, 3);


-- 3. Ahora sí podemos insertar reserva (depende de viaje, sucursal y empleado)
INSERT INTO reserva (fecha, estado, id_viaje, id_sucursal, dni_empleado) VALUES
('2024-11-15', 'Confirmado', 1, 1, '45678901'),
('2024-11-16', 'Pendiente', 2, 2, '45678902'),
('2024-11-17', 'Confirmado', 3, 3, '45678903'),
('2024-11-18', 'Cancelada', 4, 4, '45678904'),
('2024-11-19', 'Confirmado', 5, 5, '45678905');

-- 4. pago (depende de reserva)
INSERT INTO pago (monto, fecha, estado, id_reserva) VALUES
(1500.00, '2024-11-15', 'Completado', 1),
(800.00, '2024-11-16', 'Pendiente', 2),
(100.00, '2024-11-17', 'Pendiente', 3),
(200.00, '2024-11-18', 'Reembolsado', 4),
(300.00, '2024-11-19', 'Completado', 5);

