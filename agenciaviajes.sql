-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 01:47:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ID_Ciudad` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Pais` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ID_Ciudad`, `Nombre`, `Pais`) VALUES
(1, 'Arequipa', 'Perú'),
(2, 'Lima', 'Perú'),
(3, 'Santiago', 'Chile'),
(4, 'Valparaíso', 'Chile'),
(5, 'Buenos Aires', 'Argentina'),
(6, 'San Pedro de Atacama', 'Chile'),
(7, 'Iguazú', 'Argentina'),
(8, 'Mendoza', 'Argentina'),
(9, 'Cancún', 'México'),
(10, 'México DF', 'México'),
(11, 'Patagonia', 'Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `DNI` varchar(15) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `c_username` varchar(10) DEFAULT NULL,
  `c_password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`DNI`, `Nombre`, `Apellidos`, `Telefono`, `Email`, `c_username`, `c_password`) VALUES
('00112233L', 'James', 'Walker', '6543219870', 'jameswalker@example.com', 'jwalker1', '1df0dc0efb'),
('01234567', 'Laura', 'Torres Herrera', '898765432', 'laura.torres@correo.com', 'ltorres10', 'torres321'),
('01234987', 'Silvia', 'Ruiz Méndez', '788765432', 'silvia.ruiz@gmail.com', 'sruiz20', 'ruiz_pw9'),
('11223344C', 'Bob', 'Martin', '5678901234', 'bobmartin@example.com', 'bmartin1', '5efc2b017d'),
('12345098', 'Fernando', 'Reyes Ortiz', '887654321', 'fernando.reyes@hotmail.com', 'freyes11', 'rey_pass1'),
('12345678', 'Carlos', 'Pérez Gómez', '987654321', 'carlos.perez@gmail.com', 'carlos01', 'pass1234'),
('12345678A', 'John', 'Doe', '1234567890', 'johndoe@example.com', 'jdoe1', 'ef92b778ba'),
('22334455D', 'Mary', 'Johnson', '1357924680', 'maryjohnson@example.com', 'mjohnson1', '5c773b22ea'),
('22334455M', 'Karen', 'Morris', '9876543210', 'karenmorris@example.com', 'kmorris1', '95fb0af625'),
('23456109', 'Patricia', 'Salazar Campos', '876543210', 'patricia.salazar@yahoo.com', 'psalaz12', 'patri987'),
('23456789', 'Ana', 'Martínez Ruiz', '976543210', 'ana.martinez@yahoo.com', 'anaM02', 'mypass01'),
('33445566E', 'Sam', 'Clark', '2468135790', 'samclark@example.com', 'sclark1', '3233c5e43b'),
('33445566N', 'David', 'Foster', '1112233445', 'davidfoster@example.com', 'dfoster1', '19cb0711df'),
('34567210', 'Andrés', 'Vargas Silva', '865432109', 'andres.vargas@gmail.com', 'andres13', 'vargas456'),
('34567890', 'Luis', 'González Ramírez', '965432109', 'luis.gonzalez@outlook.com', 'luisg03', 'password1'),
('44556677F', 'Laura', 'White', '1122334455', 'laurawhite@example.com', 'lwhite1', 'c14883c020'),
('44556677O', 'Diana', 'Scott', '4556677889', 'dianascott@example.com', 'dscott1', 'd46b5cd9c1'),
('45678321', 'Mónica', 'Herrera López', '854321098', 'monica.herrera@outlook.com', 'monica14', 'her_lo789'),
('45678901', 'María', 'López Fernández', '954321098', 'maria.lopez@hotmail.com', 'mlopez04', 'password2'),
('55667788G', 'Paul', 'Davis', '6677889900', 'pauldavis@example.com', 'pdavis1', '825242929f'),
('55667788P', 'Chris', 'Williams', '6677889900', 'chriswilliams@example.com', 'cwilliams1', 'aea8daf3a1'),
('56789012', 'Jorge', 'Ramírez Torres', '943210987', 'jorge.ramirez@correo.com', 'jorger05', 'pass3456'),
('56789432', 'Ricardo', 'Ortiz Moreno', '843210987', 'ricardo.ortiz@correo.com', 'ricard15', 'rortiz123'),
('66778899H', 'Anna', 'Jones', '3344556677', 'annajones@example.com', 'ajones1', 'bb10f0c847'),
('66778899Q', 'John', 'Taylor', '1234567890', 'johntaylor@example.com', 'jtaylor1', 'b9017426fe'),
('67890123', 'Sofía', 'Jiménez García', '932109876', 'sofia.jimenez@gmail.com', 'sofiaj06', 'secret07'),
('67890543', 'Gabriela', 'Muñoz Gutiérrez', '832109876', 'gabriela.munoz@gmail.com', 'gmunoz16', 'munoz456'),
('77889900I', 'Richard', 'Lee', '8877665544', 'richardlee@example.com', 'rlee1', '44130b0a20'),
('77889900R', 'Emily', 'Davis', '2233445566', 'emilydavis@example.com', 'edavis1', 'c5b0eb31b1'),
('78901234', 'Pedro', 'Sánchez Díaz', '921098765', 'pedro.sanchez@outlook.com', 'psanchez07', 'mypwd123'),
('78901654', 'Hernán', 'Vega Salinas', '821098765', 'hernan.vega@hotmail.com', 'herveg17', 'hvega789'),
('87654321B', 'Alice', 'Smith', '0987654321', 'alicesmith@example.com', 'asmith1', 'c6ba91b90d'),
('88990011J', 'Tom', 'Thompson', '5556667777', 'tomthompson@example.com', 'tthompson1', '3cd4e74734'),
('88990011S', 'Michael', 'Miller', '5566778899', 'michaelmiller@example.com', 'mmiller1', '252acd35e7'),
('89012345', 'Carmen', 'Díaz Vega', '910987654', 'carmen.diaz@yahoo.com', 'carmen08', 'diaz4567'),
('89012765', 'Paula', 'Navarro Peña', '810987654', 'paula.navarro@yahoo.com', 'paulan18', 'navarro1'),
('90123456', 'Rodrigo', 'Castillo Romero', '909876543', 'rodrigo.castillo@gmail.com', 'rodrig09', 'passw789'),
('90123876', 'Diego', 'Flores Ríos', '799876543', 'diego.flores@outlook.com', 'dflores19', 'flor_pass'),
('99001122K', 'Sarah', 'Roberts', '1239874560', 'sarahroberts@example.com', 'sroberts1', '2f17420c17'),
('99001122T', 'Sophia', 'Garcia', '6677889900', 'sophiagarcia@example.com', 'sophia1', '8c64014ba5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `DNI` varchar(15) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `ID_Sucursal` int(11) DEFAULT NULL,
  `puesto` varchar(30) DEFAULT NULL,
  `e_username` varchar(10) DEFAULT NULL,
  `e_password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`DNI`, `Nombre`, `Apellidos`, `Telefono`, `ID_Sucursal`, `puesto`, `e_username`, `e_password`) VALUES
('0000001', 'Juan', 'Pérez', '1122334455', NULL, 'Gerente', 'juanp', 'pass123'),
('0000002', 'Ana', 'García', '2233445566', NULL, 'Recepcionista', 'anag', 'pass456'),
('0000003', 'Carlos', 'Ruiz', '3344556677', NULL, 'Vendedor', 'carlosr', 'pass789'),
('0000004', 'Luisa', 'Martínez', '4455667788', NULL, 'Atención al cliente', 'luisam', 'pass101'),
('0000005', 'Pedro', 'López', '8899556677', NULL, 'Administrador', 'pedrol', 'pass202'),
('0000006', 'Jan', 'Rez', '4455112233', NULL, 'Gerente', 'juanp', 'pass123'),
('0000007', 'Anastacia', 'Gracia', '5566223344', NULL, 'Recepcionista', 'anag', 'pass456'),
('0000008', 'Carlos', 'Santos', '5566773344', NULL, 'Vendedor', 'carlosr', 'pass789'),
('0000009', 'Luis', 'Rodriguez', '6677884455', NULL, 'Atención al cliente', 'luisam', 'pass101'),
('0000010', 'Pedro', 'Ruan', '7788995566', NULL, 'Administrador', 'pedrol', 'pass202'),
('00112233L', 'Richard', 'Lee', '8877665544', 2, 'Gerente', 'rlee', '44130b0a20'),
('11223344C', 'Bob', 'Martin', '5678901234', 1, 'Recepcionista', 'bmartin1', '5efc2b017d'),
('12345678A', 'John', 'Doe', '1234567890', 1, 'Administrador', 'jdoe1', 'ef92b778ba'),
('22334455D', 'John', 'Doe', '1234567890', 3, 'Vendedor', 'jdoe2', 'ef92b778ba'),
('22334455M', 'Tom', 'Thompson', '5556667777', 5, 'Vendedor', 'tthompson', '3cd4e74734'),
('33445566E', 'Alice', 'Smith', '0987654321', 2, 'Administrador', 'asmith2', 'c6ba91b90d'),
('33445566N', 'Sarah', 'Roberts', '1239874560', 3, 'Recepcionista', 'sroberts', '2f17420c17'),
('44556677F', 'Bob', 'Martin', '5678901234', 1, 'Gerente', 'bmartin2', '5efc2b017d'),
('44556677O', 'James', 'Walker', '6543219870', 1, 'Cajero', 'jwalker', '1df0dc0efb'),
('55667788G', 'Mary', 'Johnson', '1357924680', 4, 'Cajero', 'mjohnson', '5c773b22ea'),
('55667788P', 'Karen', 'Morris', '9876543210', 4, 'Vendedor', 'kmorris', '95fb0af625'),
('66778899H', 'Sam', 'Clark', '2468135790', 5, 'Vendedor', 'sclark', '3233c5e43b'),
('66778899Q', 'David', 'Foster', '1112233445', 2, 'Vendedor', 'dfoster', '19cb0711df'),
('77889900I', 'Laura', 'White', '1122334455', 3, 'Recepcionista', 'lwhite', 'c14883c020'),
('77889900R', 'Diana', 'Scott', '4556677889', 3, 'Cajero', 'dscott', 'd46b5cd9c1'),
('87654321B', 'Alice', 'Smith', '0987654321', 2, 'Vendedor', 'asmith1', 'c6ba91b90d'),
('88990011J', 'Paul', 'Davis', '6677889900', 1, 'Cajero', 'pdavis', '825242929f'),
('88990011S', 'Chris', 'Williams', '6677889900', 1, 'Gerente', 'cwilliams', 'aea8daf3a1'),
('99001122K', 'Anna', 'Jones', '3344556677', 4, 'Vendedor', 'ajones', 'bb10f0c847');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_turistico`
--

CREATE TABLE `guia_turistico` (
  `ID_Guia` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Idioma` varchar(50) DEFAULT NULL,
  `ID_Ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guia_turistico`
--

INSERT INTO `guia_turistico` (`ID_Guia`, `Nombre`, `Telefono`, `Idioma`, `ID_Ciudad`) VALUES
(1, 'Carlos Perez', '1234567890', 'Español', 1),
(2, 'Ana Martinez', '2345678901', 'Español', 2),
(3, 'Luis Gonzalez', '3456789012', 'Inglés', 3),
(4, 'Maria Lopez', '4567890123', 'Español', 4),
(5, 'Jorge Ramírez', '5678901234', 'Portugués', 5),
(6, 'Sofía Jiménez', '6789012345', 'Español', 6),
(7, 'Pedro Sánchez', '7890123456', 'Inglés', 7),
(8, 'Carmen Diaz', '8901234567', 'Español', 8),
(9, 'Rodrigo Castillo', '9012345678', 'Francés', 9),
(10, 'Laura Torres', '0123456789', 'Español', 10),
(11, 'Fernando Reyes', '1023456789', 'Español', 11),
(12, 'Patricia Salazar', '1123456789', 'Inglés', 2),
(13, 'Andrés Vargas', '1223456789', 'Español', 3),
(14, 'Mónica Herrera', '1323456789', 'Francés', 5),
(15, 'Ricardo Ortiz', '1423456789', 'Español', 6),
(16, 'Gabriela Muñoz', '1523456789', 'Inglés', 7),
(17, 'Hernán Vega', '1623456789', 'Portugués', 8),
(18, 'Paula Navarro', '1723456789', 'Español', 9),
(19, 'Diego Flores', '1823456789', 'Español', 1),
(20, 'Silvia Ruiz', '1923456789', 'Inglés', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `ID_Hotel` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Categoria` varchar(50) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Precio_Por_Noche` decimal(10,2) DEFAULT NULL,
  `ID_Ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `ID_Pago` int(11) NOT NULL,
  `Monto` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Metodo_Pago` varchar(50) DEFAULT NULL,
  `ID_Reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_hotel`
--

CREATE TABLE `paquete_hotel` (
  `ID_Paquete` int(11) NOT NULL,
  `ID_Hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_servicio`
--

CREATE TABLE `paquete_servicio` (
  `ID_Paquete` int(11) NOT NULL,
  `ID_Servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_turistico`
--

CREATE TABLE `paquete_turistico` (
  `ID_Paquete` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `ID_Promocion` int(11) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Descuento` decimal(5,2) DEFAULT NULL,
  `Periodo_Validez` varchar(50) DEFAULT NULL,
  `ID_Empleado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID_Proveedor` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_hotel`
--

CREATE TABLE `proveedor_hotel` (
  `ID_Proveedor` int(11) NOT NULL,
  `ID_Hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_servicio`
--

CREATE TABLE `proveedor_servicio` (
  `ID_Proveedor` int(11) NOT NULL,
  `ID_Servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `ID_Reserva` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Num_Personas` int(11) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `ID_Cliente` varchar(15) DEFAULT NULL,
  `ID_Empleado` varchar(15) DEFAULT NULL,
  `ID_Viaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`ID_Reserva`, `Fecha`, `Num_Personas`, `Estado`, `ID_Cliente`, `ID_Empleado`, `ID_Viaje`) VALUES
(1, '0000-00-00', 2, 'Confirmado', NULL, NULL, NULL),
(2, '0000-00-00', 4, 'Pendiente', NULL, NULL, NULL),
(3, '0000-00-00', 3, 'Cancelado', NULL, NULL, NULL),
(4, '0000-00-00', 5, 'Confirmado', NULL, NULL, NULL),
(5, '0000-00-00', 1, 'Pendiente', NULL, NULL, NULL),
(6, '0000-00-00', 2, 'Confirmado', NULL, NULL, NULL),
(7, '0000-00-00', 4, 'Pendiente', NULL, NULL, NULL),
(8, '0000-00-00', 3, 'Cancelado', NULL, NULL, NULL),
(9, '0000-00-00', 5, 'Confirmado', NULL, NULL, NULL),
(10, '0000-00-00', 1, 'Pendiente', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `ID_Servicio` int(11) NOT NULL,
  `Tipo_Transporte` varchar(100) DEFAULT NULL,
  `Empresa` varchar(100) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `ID_Sucursal` int(11) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`ID_Sucursal`, `Direccion`, `Telefono`, `nombre`) VALUES
(1, 'Calle Principal 123', NULL, 'Sucursal Central'),
(2, 'Avenida Norte 456', NULL, 'Sucursal Norte'),
(3, 'Calle del Sur 789', NULL, 'Sucursal Sur'),
(4, 'Avenida Este 101', NULL, 'Sucursal Este'),
(5, 'Calle del Oeste 202', NULL, 'Sucursal Oeste'),
(6, 'Calle Pedro Paramo', '4567891123', 'S-283'),
(7, 'Street 98-1', '6543220987', 'S-081'),
(8, 'Calle Sao Pablo', '3344531122', 'S-28'),
(9, '18 Distrito Bajo', '4455642233', 'S-832'),
(10, 'Derfield RD 01', '5566753344', 'S-849'),
(11, 'Calle Maria 100', '1234567890', 'S-203'),
(12, 'Miguel Grau 230', '0987654321', 'S-031'),
(13, 'Cayma 2-923', '1122334455', 'S-239'),
(14, 'Cerro Colorado 2', '2233445566', 'S-232'),
(15, 'Alfonso Ugarte', '3344556677', 'S-149');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `ID_transporte` int(11) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `empresa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte_paquete`
--

CREATE TABLE `transporte_paquete` (
  `ID_transporte` int(11) NOT NULL,
  `ID_Paquete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `ID_Viaje` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Duracion` int(11) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`ID_Viaje`, `Nombre`, `Descripcion`, `Duracion`, `Precio`) VALUES
(1, 'Fiesta de playa', 'Un viaje emocionante a la playa', 5, 300.00),
(2, 'Escalada', 'Aventura en la montaña', 5, 500.00),
(3, 'Por las calles', 'Exploración urbana', 2, 200.00),
(4, 'Escapada Rural', 'Descanso en el campo', 4, 400.00),
(5, 'Naveguemos', 'Recorrido costero', 7, 700.00),
(6, 'Dinosaurios', 'Un viaje en el tiempo', 5, 340.00),
(7, 'Viaje espacial', 'Observemos las estrellas', 5, 510.00),
(8, 'Por la historia', 'Viaje por las ruinas', 2, 300.00),
(9, 'Volcan', 'Pompeya cuidad historica', 4, 490.00),
(10, 'Poderosos Vientos', 'Traigan sus cometas', 4, 200.00),
(11, 'Con la naturaleza', 'Descansa junto a los koalas', 7, 800.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje_vuelo`
--

CREATE TABLE `viaje_vuelo` (
  `ID_Viaje` int(11) NOT NULL,
  `ID_Vuelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE `vuelo` (
  `ID_Vuelo` int(11) NOT NULL,
  `Num_Vuelo` varchar(50) DEFAULT NULL,
  `Ciudad_Origen` int(11) DEFAULT NULL,
  `Ciudad_Destino` int(11) DEFAULT NULL,
  `Fecha_Salida` datetime DEFAULT NULL,
  `Fecha_Llegada` datetime DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`ID_Vuelo`, `Num_Vuelo`, `Ciudad_Origen`, `Ciudad_Destino`, `Fecha_Salida`, `Fecha_Llegada`, `Precio`) VALUES
(1, 'Latam LA-1001', 1, 2, '2023-12-01 08:00:00', '2023-12-01 09:30:00', 150.00),
(2, 'Avianca AV-1002', 1, 3, '2023-12-01 10:00:00', '2023-12-01 13:00:00', 300.00),
(3, 'Aeroméxico AM-1003', 1, 4, '2023-12-01 11:00:00', '2023-12-01 12:30:00', 200.00),
(4, 'Latam LA-1004', 1, 5, '2023-12-01 14:00:00', '2023-12-01 17:00:00', 350.00),
(5, 'Avianca AV-1005', 1, 6, '2023-12-01 09:00:00', '2023-12-01 13:30:00', 400.00),
(6, 'Aeroméxico AM-1006', 1, 7, '2023-12-01 15:00:00', '2023-12-01 19:00:00', 280.00),
(7, 'Latam LA-1007', 1, 8, '2023-12-01 07:00:00', '2023-12-01 10:00:00', 320.00),
(8, 'Avianca AV-1008', 1, 9, '2023-12-01 06:00:00', '2023-12-01 12:00:00', 500.00),
(9, 'Aeroméxico AM-1009', 1, 10, '2023-12-01 05:00:00', '2023-12-01 11:00:00', 600.00),
(10, 'Latam LA-1010', 1, 11, '2023-12-01 13:00:00', '2023-12-01 22:00:00', 750.00),
(11, 'Avianca AV-1011', 2, 3, '2023-12-01 09:00:00', '2023-12-01 12:00:00', 280.00),
(12, 'Aeroméxico AM-1012', 2, 4, '2023-12-01 12:00:00', '2023-12-01 14:30:00', 220.00),
(13, 'Latam LA-1013', 2, 5, '2023-12-01 07:00:00', '2023-12-01 11:00:00', 350.00),
(14, 'Avianca AV-1014', 2, 6, '2023-12-01 08:30:00', '2023-12-01 13:30:00', 400.00),
(15, 'Aeroméxico AM-1015', 2, 7, '2023-12-01 10:00:00', '2023-12-01 14:00:00', 300.00),
(16, 'Latam LA-1016', 2, 8, '2023-12-01 15:00:00', '2023-12-01 18:30:00', 330.00),
(17, 'Avianca AV-1017', 2, 9, '2023-12-01 06:00:00', '2023-12-01 10:30:00', 520.00),
(18, 'Aeroméxico AM-1018', 2, 10, '2023-12-01 14:00:00', '2023-12-01 20:30:00', 620.00),
(19, 'Latam LA-1019', 2, 11, '2023-12-01 09:00:00', '2023-12-01 17:30:00', 770.00),
(20, 'Avianca AV-1020', 3, 4, '2023-12-01 08:00:00', '2023-12-01 09:30:00', 120.00),
(21, 'Aeroméxico AM-1021', 3, 5, '2023-12-01 11:00:00', '2023-12-01 15:00:00', 380.00),
(22, 'Latam LA-1022', 3, 6, '2023-12-01 06:00:00', '2023-12-01 10:30:00', 420.00),
(23, 'Avianca AV-1023', 3, 7, '2023-12-01 13:00:00', '2023-12-01 17:30:00', 290.00),
(24, 'Aeroméxico AM-1024', 3, 8, '2023-12-01 09:00:00', '2023-12-01 12:30:00', 340.00),
(25, 'Latam LA-1025', 3, 9, '2023-12-01 07:30:00', '2023-12-01 14:00:00', 540.00),
(26, 'Avianca AV-1026', 3, 10, '2023-12-01 10:00:00', '2023-12-01 16:30:00', 640.00),
(27, 'Aeroméxico AM-1027', 3, 11, '2023-12-01 15:00:00', '2023-12-01 22:30:00', 790.00),
(28, 'Latam LA-1028', 4, 5, '2023-12-01 10:30:00', '2023-12-01 14:00:00', 330.00),
(29, 'Avianca AV-1029', 4, 6, '2023-12-01 09:00:00', '2023-12-01 14:00:00', 440.00),
(30, 'Aeroméxico AM-1030', 4, 7, '2023-12-01 11:00:00', '2023-12-01 15:30:00', 320.00),
(31, 'Latam LA-1031', 4, 8, '2023-12-01 08:00:00', '2023-12-01 11:30:00', 380.00),
(32, 'Avianca AV-1032', 4, 9, '2023-12-01 13:00:00', '2023-12-01 19:00:00', 550.00),
(33, 'Aeroméxico AM-1033', 4, 10, '2023-12-01 06:00:00', '2023-12-01 12:30:00', 650.00),
(34, 'Latam LA-1034', 4, 11, '2023-12-01 12:00:00', '2023-12-01 21:30:00', 800.00),
(35, 'Avianca AV-1035', 5, 6, '2023-12-01 05:30:00', '2023-12-01 11:30:00', 470.00),
(36, 'Aeroméxico AM-1036', 5, 7, '2023-12-01 13:30:00', '2023-12-01 18:00:00', 330.00),
(37, 'Latam LA-1037', 5, 8, '2023-12-01 08:30:00', '2023-12-01 13:00:00', 390.00),
(38, 'Avianca AV-1038', 5, 9, '2023-12-01 07:00:00', '2023-12-01 14:00:00', 570.00),
(39, 'Aeroméxico AM-1039', 5, 10, '2023-12-01 16:00:00', '2023-12-01 22:00:00', 660.00),
(40, 'Latam LA-1040', 5, 11, '2023-12-01 10:00:00', '2023-12-01 19:00:00', 810.00),
(41, 'Avianca AV-1041', 6, 7, '2023-12-01 14:00:00', '2023-12-01 18:30:00', 330.00),
(42, 'Aeroméxico AM-1042', 6, 8, '2023-12-01 11:00:00', '2023-12-01 14:30:00', 380.00),
(43, 'Latam LA-1043', 6, 9, '2023-12-01 09:30:00', '2023-12-01 15:00:00', 500.00),
(44, 'Avianca AV-1044', 6, 10, '2023-12-01 12:00:00', '2023-12-01 16:00:00', 600.00),
(45, 'Aeroméxico AM-1045', 6, 11, '2023-12-01 07:00:00', '2023-12-01 14:30:00', 650.00),
(46, 'Latam LA-1046', 7, 8, '2023-12-01 15:00:00', '2023-12-01 19:00:00', 350.00),
(47, 'Avianca AV-1047', 7, 9, '2023-12-01 08:30:00', '2023-12-01 13:00:00', 450.00),
(48, 'Aeroméxico AM-1048', 7, 10, '2023-12-01 14:00:00', '2023-12-01 20:30:00', 580.00),
(49, 'Latam LA-1049', 7, 11, '2023-12-01 13:00:00', '2023-12-01 21:00:00', 700.00),
(50, 'Avianca AV-1050', 8, 9, '2023-12-01 06:30:00', '2023-12-01 11:00:00', 400.00),
(51, 'Aeroméxico AM-1051', 8, 10, '2023-12-01 11:30:00', '2023-12-01 17:00:00', 590.00),
(52, 'Latam LA-1052', 8, 11, '2023-12-01 12:00:00', '2023-12-01 19:30:00', 710.00),
(53, 'Avianca AV-1053', 9, 10, '2023-12-01 10:00:00', '2023-12-01 15:30:00', 520.00),
(54, 'Aeroméxico AM-1054', 9, 11, '2023-12-01 15:00:00', '2023-12-01 22:00:00', 750.00),
(55, 'Latam LA-1055', 10, 11, '2023-12-01 07:30:00', '2023-12-01 14:00:00', 800.00),
(56, 'Latam LA-1001', 2, 1, '2023-12-01 08:15:00', '2023-12-01 09:45:00', 145.00),
(57, 'Avianca AV-1002', 3, 1, '2023-12-01 10:30:00', '2023-12-01 13:30:00', 295.00),
(58, 'Aeroméxico AM-1003', 4, 1, '2023-12-01 11:20:00', '2023-12-01 12:50:00', 205.00),
(59, 'Latam LA-1004', 5, 1, '2023-12-01 14:45:00', '2023-12-01 17:30:00', 340.00),
(60, 'Avianca AV-1005', 6, 1, '2023-12-01 09:30:00', '2023-12-01 14:00:00', 380.00),
(61, 'Aeroméxico AM-1006', 7, 1, '2023-12-01 15:20:00', '2023-12-01 19:10:00', 275.00),
(62, 'Latam LA-1007', 8, 1, '2023-12-01 06:40:00', '2023-12-01 09:40:00', 315.00),
(63, 'Avianca AV-1008', 9, 1, '2023-12-01 05:50:00', '2023-12-01 11:30:00', 495.00),
(64, 'Aeroméxico AM-1009', 10, 1, '2023-12-01 04:30:00', '2023-12-01 10:40:00', 590.00),
(65, 'Latam LA-1010', 11, 1, '2023-12-01 13:45:00', '2023-12-01 22:15:00', 740.00),
(66, 'Avianca AV-1011', 3, 2, '2023-12-01 09:45:00', '2023-12-01 12:15:00', 275.00),
(67, 'Aeroméxico AM-1012', 4, 2, '2023-12-01 12:30:00', '2023-12-01 15:00:00', 215.00),
(68, 'Latam LA-1013', 5, 2, '2023-12-01 07:30:00', '2023-12-01 11:30:00', 345.00),
(69, 'Avianca AV-1014', 6, 2, '2023-12-01 08:15:00', '2023-12-01 13:45:00', 395.00),
(70, 'Aeroméxico AM-1015', 7, 2, '2023-12-01 10:30:00', '2023-12-01 14:30:00', 295.00),
(71, 'Latam LA-1016', 8, 2, '2023-12-01 15:15:00', '2023-12-01 18:45:00', 325.00),
(72, 'Avianca AV-1017', 9, 2, '2023-12-01 06:30:00', '2023-12-01 10:00:00', 510.00),
(73, 'Aeroméxico AM-1018', 10, 2, '2023-12-01 14:30:00', '2023-12-01 21:00:00', 615.00),
(74, 'Latam LA-1019', 11, 2, '2023-12-01 09:30:00', '2023-12-01 17:45:00', 765.00),
(75, 'Avianca AV-1020', 4, 3, '2023-12-01 08:15:00', '2023-12-01 09:45:00', 115.00),
(76, 'Aeroméxico AM-1021', 5, 3, '2023-12-01 11:30:00', '2023-12-01 15:30:00', 370.00),
(77, 'Latam LA-1022', 6, 3, '2023-12-01 06:10:00', '2023-12-01 10:40:00', 410.00),
(78, 'Avianca AV-1023', 7, 3, '2023-12-01 12:40:00', '2023-12-01 17:00:00', 280.00),
(79, 'Aeroméxico AM-1024', 8, 3, '2023-12-01 08:10:00', '2023-12-01 12:00:00', 330.00),
(80, 'Latam LA-1025', 9, 3, '2023-12-01 07:00:00', '2023-12-01 13:30:00', 530.00),
(81, 'Avianca AV-1026', 10, 3, '2023-12-01 09:30:00', '2023-12-01 16:10:00', 635.00),
(82, 'Aeroméxico AM-1027', 11, 3, '2023-12-01 15:30:00', '2023-12-01 22:00:00', 780.00),
(83, 'Latam LA-1028', 5, 4, '2023-12-01 10:15:00', '2023-12-01 13:45:00', 325.00),
(84, 'Avianca AV-1029', 6, 4, '2023-12-01 08:30:00', '2023-12-01 13:15:00', 435.00),
(85, 'Aeroméxico AM-1030', 7, 4, '2023-12-01 11:20:00', '2023-12-01 15:00:00', 315.00),
(86, 'Latam LA-1031', 8, 4, '2023-12-01 07:30:00', '2023-12-01 11:00:00', 375.00),
(87, 'Avianca AV-1032', 9, 4, '2023-12-01 13:30:00', '2023-12-01 19:10:00', 545.00),
(88, 'Aeroméxico AM-1033', 10, 4, '2023-12-01 06:10:00', '2023-12-01 12:10:00', 645.00),
(89, 'Latam LA-1034', 11, 4, '2023-12-01 12:30:00', '2023-12-01 21:50:00', 795.00),
(90, 'Avianca AV-1035', 6, 5, '2023-12-01 05:40:00', '2023-12-01 11:20:00', 465.00),
(91, 'Aeroméxico AM-1036', 7, 5, '2023-12-01 13:50:00', '2023-12-01 18:30:00', 325.00),
(92, 'Latam LA-1037', 8, 5, '2023-12-01 08:45:00', '2023-12-01 13:10:00', 385.00),
(93, 'Avianca AV-1038', 9, 5, '2023-12-01 06:40:00', '2023-12-01 13:30:00', 565.00),
(94, 'Aeroméxico AM-1039', 10, 5, '2023-12-01 15:20:00', '2023-12-01 21:10:00', 695.00),
(95, 'Latam LA-1040', 11, 5, '2023-12-01 11:50:00', '2023-12-01 19:30:00', 845.00),
(96, 'Avianca AV-1041', 7, 6, '2023-12-01 10:30:00', '2023-12-01 15:00:00', 415.00),
(97, 'Aeroméxico AM-1042', 8, 6, '2023-12-01 08:00:00', '2023-12-01 12:30:00', 460.00),
(98, 'Latam LA-1043', 9, 6, '2023-12-01 14:15:00', '2023-12-01 20:00:00', 555.00),
(99, 'Avianca AV-1044', 10, 6, '2023-12-01 05:30:00', '2023-12-01 12:00:00', 625.00),
(100, 'Aeroméxico AM-1045', 11, 6, '2023-12-01 13:00:00', '2023-12-01 19:45:00', 765.00),
(101, 'Latam LA-1046', 8, 7, '2023-12-01 06:50:00', '2023-12-01 11:10:00', 395.00),
(102, 'Avianca AV-1047', 9, 7, '2023-12-01 12:20:00', '2023-12-01 17:00:00', 470.00),
(103, 'Aeroméxico AM-1048', 10, 7, '2023-12-01 09:40:00', '2023-12-01 15:30:00', 530.00),
(104, 'Latam LA-1049', 11, 7, '2023-12-01 10:10:00', '2023-12-01 16:40:00', 600.00),
(105, 'Avianca AV-1050', 9, 8, '2023-12-01 06:00:00', '2023-12-01 12:00:00', 420.00),
(106, 'Aeroméxico AM-1051', 10, 8, '2023-12-01 09:15:00', '2023-12-01 14:45:00', 550.00),
(107, 'Latam LA-1052', 11, 8, '2023-12-01 07:30:00', '2023-12-01 13:30:00', 680.00),
(108, 'Avianca AV-1053', 10, 9, '2023-12-01 12:10:00', '2023-12-01 17:50:00', 530.00),
(109, 'Aeroméxico AM-1054', 11, 9, '2023-12-01 08:30:00', '2023-12-01 14:00:00', 600.00),
(110, 'Latam LA-1055', 11, 10, '2023-12-01 13:45:00', '2023-12-01 20:15:00', 750.00),
(111, 'Avianca AV-1102', 1, 3, '2023-12-02 10:00:00', '2023-12-02 13:00:00', 312.00),
(112, 'Aeroméxico AM-1103', 1, 4, '2023-12-02 11:00:00', '2023-12-02 12:30:00', 212.00),
(113, 'Latam LA-1104', 1, 5, '2023-12-02 14:00:00', '2023-12-02 17:00:00', 362.00),
(114, 'Avianca AV-1105', 1, 6, '2023-12-02 09:00:00', '2023-12-02 13:30:00', 412.00),
(115, 'Aeroméxico AM-1106', 1, 7, '2023-12-02 15:00:00', '2023-12-02 19:00:00', 292.00),
(116, 'Latam LA-1107', 1, 8, '2023-12-02 07:00:00', '2023-12-02 10:00:00', 332.00),
(117, 'Avianca AV-1108', 1, 9, '2023-12-02 06:00:00', '2023-12-02 12:00:00', 512.00),
(118, 'Aeroméxico AM-1109', 1, 10, '2023-12-02 05:00:00', '2023-12-02 11:00:00', 612.00),
(119, 'Latam LA-1110', 1, 11, '2023-12-02 13:00:00', '2023-12-02 22:00:00', 762.00),
(120, 'Avianca AV-1111', 2, 3, '2023-12-02 09:00:00', '2023-12-02 12:00:00', 292.00),
(121, 'Aeroméxico AM-1112', 2, 4, '2023-12-02 12:00:00', '2023-12-02 14:30:00', 232.00),
(122, 'Latam LA-1113', 2, 5, '2023-12-02 07:00:00', '2023-12-02 11:00:00', 362.00),
(123, 'Avianca AV-1114', 2, 6, '2023-12-02 08:30:00', '2023-12-02 13:30:00', 412.00),
(124, 'Aeroméxico AM-1115', 2, 7, '2023-12-02 10:00:00', '2023-12-02 14:00:00', 312.00),
(125, 'Latam LA-1116', 2, 8, '2023-12-02 15:00:00', '2023-12-02 18:30:00', 342.00),
(126, 'Avianca AV-1117', 2, 9, '2023-12-02 06:00:00', '2023-12-02 10:30:00', 532.00),
(127, 'Aeroméxico AM-1118', 2, 10, '2023-12-02 14:00:00', '2023-12-02 20:30:00', 632.00),
(128, 'Latam LA-1119', 2, 11, '2023-12-02 09:00:00', '2023-12-02 17:30:00', 782.00),
(129, 'Avianca AV-1120', 3, 4, '2023-12-02 08:00:00', '2023-12-02 09:30:00', 132.00),
(130, 'Aeroméxico AM-1121', 3, 5, '2023-12-02 11:00:00', '2023-12-02 15:00:00', 392.00),
(131, 'Latam LA-1122', 3, 6, '2023-12-02 06:00:00', '2023-12-02 10:30:00', 432.00),
(132, 'Avianca AV-1123', 3, 7, '2023-12-02 13:00:00', '2023-12-02 17:30:00', 302.00),
(133, 'Aeroméxico AM-1124', 3, 8, '2023-12-02 09:00:00', '2023-12-02 12:30:00', 352.00),
(134, 'Latam LA-1125', 3, 9, '2023-12-02 07:30:00', '2023-12-02 14:00:00', 552.00),
(135, 'Avianca AV-1126', 3, 10, '2023-12-02 10:00:00', '2023-12-02 16:30:00', 652.00),
(136, 'Aeroméxico AM-1127', 3, 11, '2023-12-02 15:00:00', '2023-12-02 22:30:00', 802.00),
(137, 'Latam LA-1128', 4, 5, '2023-12-02 10:30:00', '2023-12-02 14:00:00', 342.00),
(138, 'Avianca AV-1129', 4, 6, '2023-12-02 09:00:00', '2023-12-02 14:00:00', 452.00),
(139, 'Aeroméxico AM-1130', 4, 7, '2023-12-02 11:00:00', '2023-12-02 15:30:00', 332.00),
(140, 'Latam LA-1131', 4, 8, '2023-12-02 08:00:00', '2023-12-02 11:30:00', 392.00),
(141, 'Avianca AV-1132', 4, 9, '2023-12-02 13:00:00', '2023-12-02 19:00:00', 562.00),
(142, 'Aeroméxico AM-1133', 4, 10, '2023-12-02 06:00:00', '2023-12-02 12:30:00', 662.00),
(143, 'Latam LA-1134', 4, 11, '2023-12-02 12:00:00', '2023-12-02 21:30:00', 812.00),
(144, 'Avianca AV-1135', 5, 6, '2023-12-02 05:30:00', '2023-12-02 11:30:00', 482.00),
(145, 'Aeroméxico AM-1136', 5, 7, '2023-12-02 13:30:00', '2023-12-02 18:00:00', 342.00),
(146, 'Latam LA-1137', 5, 8, '2023-12-02 08:30:00', '2023-12-02 13:00:00', 402.00),
(147, 'Avianca AV-1138', 5, 9, '2023-12-02 07:00:00', '2023-12-02 14:00:00', 582.00),
(148, 'Aeroméxico AM-1139', 5, 10, '2023-12-02 16:00:00', '2023-12-02 21:30:00', 652.00),
(149, 'Latam LA-1140', 5, 11, '2023-12-02 12:00:00', '2023-12-02 19:30:00', 802.00),
(150, 'Avianca AV-1141', 6, 7, '2023-12-02 08:30:00', '2023-12-02 14:00:00', 392.00),
(151, 'Aeroméxico AM-1142', 6, 8, '2023-12-02 10:00:00', '2023-12-02 15:30:00', 442.00),
(152, 'Latam LA-1143', 6, 9, '2023-12-02 07:30:00', '2023-12-02 13:00:00', 522.00),
(153, 'Avianca AV-1144', 6, 10, '2023-12-02 12:00:00', '2023-12-02 18:00:00', 622.00),
(154, 'Aeroméxico AM-1145', 6, 11, '2023-12-02 09:30:00', '2023-12-02 16:00:00', 672.00),
(155, 'Latam LA-1146', 7, 8, '2023-12-02 05:30:00', '2023-12-02 11:00:00', 352.00),
(156, 'Avianca AV-1147', 7, 9, '2023-12-02 15:00:00', '2023-12-02 19:30:00', 522.00),
(157, 'Aeroméxico AM-1148', 7, 10, '2023-12-02 10:00:00', '2023-12-02 15:30:00', 622.00),
(158, 'Latam LA-1149', 7, 11, '2023-12-02 14:30:00', '2023-12-02 20:00:00', 772.00),
(159, 'Avianca AV-1150', 8, 9, '2023-12-02 13:30:00', '2023-12-02 19:00:00', 562.00),
(160, 'Aeroméxico AM-1151', 8, 10, '2023-12-02 07:30:00', '2023-12-02 13:00:00', 642.00),
(161, 'Latam LA-1152', 8, 11, '2023-12-02 08:00:00', '2023-12-02 15:30:00', 792.00),
(162, 'Avianca AV-1153', 9, 10, '2023-12-02 14:00:00', '2023-12-02 18:00:00', 652.00),
(163, 'Aeroméxico AM-1154', 9, 11, '2023-12-02 12:30:00', '2023-12-02 18:30:00', 722.00),
(164, 'Latam LA-1155', 10, 11, '2023-12-02 09:00:00', '2023-12-02 16:30:00', 872.00),
(165, 'Avianca AV-1156', 11, 2, '2023-12-03 10:00:00', '2023-12-03 14:00:00', 362.00),
(166, 'Aeroméxico AM-1157', 11, 3, '2023-12-03 12:00:00', '2023-12-03 16:00:00', 422.00),
(167, 'Latam LA-1158', 11, 4, '2023-12-03 07:00:00', '2023-12-03 12:30:00', 472.00),
(168, 'Avianca AV-1159', 11, 5, '2023-12-03 15:00:00', '2023-12-03 19:00:00', 522.00),
(169, 'Aeroméxico AM-1160', 11, 6, '2023-12-03 09:30:00', '2023-12-03 14:30:00', 572.00),
(170, 'Latam LA-1161', 11, 7, '2023-12-03 06:00:00', '2023-12-03 10:30:00', 622.00),
(171, 'Avianca AV-1162', 11, 8, '2023-12-03 08:00:00', '2023-12-03 12:00:00', 672.00),
(172, 'Aeroméxico AM-1163', 11, 9, '2023-12-03 14:00:00', '2023-12-03 20:00:00', 722.00),
(173, 'Latam LA-1164', 1, 10, '2023-12-03 13:00:00', '2023-12-03 18:30:00', 772.00),
(174, 'Avianca AV-1165', 1, 11, '2023-12-03 11:00:00', '2023-12-03 18:00:00', 822.00),
(175, 'Aeroméxico AM-1166', 2, 3, '2023-12-03 07:30:00', '2023-12-03 11:00:00', 332.00),
(176, 'Latam LA-1167', 2, 4, '2023-12-03 10:00:00', '2023-12-03 13:00:00', 392.00),
(177, 'Avianca AV-1168', 2, 5, '2023-12-03 06:30:00', '2023-12-03 11:30:00', 442.00),
(178, 'Aeroméxico AM-1169', 2, 6, '2023-12-03 14:00:00', '2023-12-03 18:00:00', 492.00),
(179, 'Latam LA-1170', 2, 7, '2023-12-03 08:30:00', '2023-12-03 12:30:00', 542.00),
(180, 'Avianca AV-1171', 2, 8, '2023-12-03 12:00:00', '2023-12-03 16:30:00', 592.00),
(181, 'Aeroméxico AM-1172', 2, 9, '2023-12-03 09:00:00', '2023-12-03 13:30:00', 642.00),
(182, 'Latam LA-1173', 2, 10, '2023-12-03 10:30:00', '2023-12-03 15:30:00', 692.00),
(183, 'Avianca AV-1174', 2, 11, '2023-12-03 11:30:00', '2023-12-03 18:00:00', 742.00),
(184, 'Aeroméxico AM-1175', 3, 4, '2023-12-03 08:00:00', '2023-12-03 12:30:00', 282.00),
(185, 'Latam LA-1176', 3, 5, '2023-12-03 07:00:00', '2023-12-03 11:30:00', 342.00),
(186, 'Avianca AV-1177', 3, 6, '2023-12-03 10:00:00', '2023-12-03 13:30:00', 392.00),
(187, 'Aeroméxico AM-1178', 3, 7, '2023-12-03 09:00:00', '2023-12-03 13:30:00', 442.00),
(188, 'Latam LA-1179', 3, 8, '2023-12-03 14:00:00', '2023-12-03 17:30:00', 492.00),
(189, 'Avianca AV-1180', 3, 9, '2023-12-03 11:30:00', '2023-12-03 15:30:00', 542.00),
(190, 'Aeroméxico AM-1181', 11, 10, '2023-12-03 15:30:00', '2023-12-03 19:30:00', 592.00),
(191, 'Latam LA-1182', 3, 11, '2023-12-03 08:30:00', '2023-12-03 12:00:00', 642.00),
(192, 'Avianca AV-1183', 4, 5, '2023-12-03 07:00:00', '2023-12-03 11:30:00', 492.00),
(193, 'Aeroméxico AM-1184', 4, 6, '2023-12-03 13:30:00', '2023-12-03 17:30:00', 542.00),
(194, 'Latam LA-1185', 4, 7, '2023-12-03 09:30:00', '2023-12-03 13:00:00', 592.00),
(195, 'Avianca AV-1186', 4, 8, '2023-12-03 12:00:00', '2023-12-03 16:30:00', 642.00),
(196, 'Aeroméxico AM-1187', 4, 9, '2023-12-03 08:00:00', '2023-12-03 12:00:00', 692.00),
(197, 'Latam LA-1188', 4, 10, '2023-12-03 11:00:00', '2023-12-03 14:30:00', 742.00),
(198, 'Avianca AV-1189', 4, 11, '2023-12-03 14:30:00', '2023-12-03 18:00:00', 792.00),
(199, 'Aeroméxico AM-1190', 5, 6, '2023-12-03 07:00:00', '2023-12-03 11:30:00', 442.00),
(200, 'Latam LA-1191', 5, 7, '2023-12-03 13:00:00', '2023-12-03 16:30:00', 502.00),
(201, 'Avianca AV-1192', 5, 8, '2023-12-03 12:00:00', '2023-12-03 16:30:00', 552.00),
(202, 'Aeroméxico AM-1193', 5, 9, '2023-12-03 14:00:00', '2023-12-03 18:30:00', 602.00),
(203, 'Latam LA-1194', 5, 10, '2023-12-03 10:30:00', '2023-12-03 14:00:00', 652.00),
(204, 'Avianca AV-1195', 5, 11, '2023-12-03 13:30:00', '2023-12-03 17:30:00', 702.00),
(205, 'Aeroméxico AM-1196', 6, 7, '2023-12-03 15:00:00', '2023-12-03 19:30:00', 542.00),
(206, 'Latam LA-1197', 6, 8, '2023-12-03 08:00:00', '2023-12-03 12:30:00', 602.00),
(207, 'Avianca AV-1198', 6, 9, '2023-12-03 10:30:00', '2023-12-03 14:30:00', 652.00),
(208, 'Aeroméxico AM-1199', 6, 10, '2023-12-03 11:00:00', '2023-12-03 15:30:00', 702.00),
(209, 'Latam LA-1200', 6, 11, '2023-12-03 12:30:00', '2023-12-03 17:00:00', 752.00),
(210, 'Avianca AV-1201', 7, 8, '2023-12-03 09:00:00', '2023-12-03 13:00:00', 602.00),
(211, 'Aeroméxico AM-1202', 7, 9, '2023-12-03 12:00:00', '2023-12-03 16:00:00', 662.00),
(212, 'Latam LA-1203', 11, 10, '2023-12-03 14:30:00', '2023-12-03 18:00:00', 712.00),
(213, 'Avianca AV-1204', 7, 11, '2023-12-03 08:30:00', '2023-12-03 12:30:00', 762.00),
(214, 'Aeroméxico AM-1205', 8, 9, '2023-12-03 13:00:00', '2023-12-03 17:00:00', 682.00),
(215, 'Latam LA-1206', 8, 10, '2023-12-03 10:00:00', '2023-12-03 14:30:00', 742.00),
(216, 'Avianca AV-1207', 8, 11, '2023-12-03 11:00:00', '2023-12-03 15:30:00', 792.00),
(217, 'Aeroméxico AM-1208', 9, 10, '2023-12-03 12:30:00', '2023-12-03 17:00:00', 742.00),
(218, 'Latam LA-1209', 9, 11, '2023-12-03 07:00:00', '2023-12-03 12:30:00', 802.00),
(219, 'Avianca AV-1210', 10, 11, '2023-12-03 08:30:00', '2023-12-03 13:00:00', 852.00),
(220, 'Aeroméxico AM-1211', 11, 2, '2023-12-03 10:00:00', '2023-12-03 13:30:00', 392.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ID_Ciudad`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `ID_Sucursal` (`ID_Sucursal`);

--
-- Indices de la tabla `guia_turistico`
--
ALTER TABLE `guia_turistico`
  ADD PRIMARY KEY (`ID_Guia`),
  ADD KEY `ID_Ciudad` (`ID_Ciudad`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`ID_Hotel`),
  ADD KEY `ID_Ciudad` (`ID_Ciudad`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`ID_Pago`),
  ADD KEY `ID_Reserva` (`ID_Reserva`);

--
-- Indices de la tabla `paquete_hotel`
--
ALTER TABLE `paquete_hotel`
  ADD PRIMARY KEY (`ID_Paquete`,`ID_Hotel`),
  ADD KEY `ID_Hotel` (`ID_Hotel`);

--
-- Indices de la tabla `paquete_servicio`
--
ALTER TABLE `paquete_servicio`
  ADD PRIMARY KEY (`ID_Paquete`,`ID_Servicio`),
  ADD KEY `ID_Servicio` (`ID_Servicio`);

--
-- Indices de la tabla `paquete_turistico`
--
ALTER TABLE `paquete_turistico`
  ADD PRIMARY KEY (`ID_Paquete`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`ID_Promocion`),
  ADD KEY `ID_Empleado` (`ID_Empleado`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `proveedor_hotel`
--
ALTER TABLE `proveedor_hotel`
  ADD PRIMARY KEY (`ID_Proveedor`,`ID_Hotel`),
  ADD KEY `ID_Hotel` (`ID_Hotel`);

--
-- Indices de la tabla `proveedor_servicio`
--
ALTER TABLE `proveedor_servicio`
  ADD PRIMARY KEY (`ID_Proveedor`,`ID_Servicio`),
  ADD KEY `ID_Servicio` (`ID_Servicio`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`ID_Reserva`),
  ADD KEY `ID_Cliente` (`ID_Cliente`),
  ADD KEY `ID_Empleado` (`ID_Empleado`),
  ADD KEY `ID_Viaje` (`ID_Viaje`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`ID_Servicio`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`ID_Sucursal`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`ID_transporte`);

--
-- Indices de la tabla `transporte_paquete`
--
ALTER TABLE `transporte_paquete`
  ADD KEY `transporte_paquete_ibfk_1` (`ID_transporte`),
  ADD KEY `transporte_paquete_ibfk_2` (`ID_Paquete`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`ID_Viaje`);

--
-- Indices de la tabla `viaje_vuelo`
--
ALTER TABLE `viaje_vuelo`
  ADD PRIMARY KEY (`ID_Viaje`,`ID_Vuelo`),
  ADD KEY `ID_Vuelo` (`ID_Vuelo`);

--
-- Indices de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`ID_Vuelo`),
  ADD KEY `Ciudad_Origen` (`Ciudad_Origen`),
  ADD KEY `Ciudad_Destino` (`Ciudad_Destino`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`ID_Sucursal`) REFERENCES `sucursal` (`ID_Sucursal`);

--
-- Filtros para la tabla `guia_turistico`
--
ALTER TABLE `guia_turistico`
  ADD CONSTRAINT `guia_turistico_ibfk_1` FOREIGN KEY (`ID_Ciudad`) REFERENCES `ciudad` (`ID_Ciudad`);

--
-- Filtros para la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`ID_Ciudad`) REFERENCES `ciudad` (`ID_Ciudad`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`ID_Reserva`) REFERENCES `reserva` (`ID_Reserva`);

--
-- Filtros para la tabla `paquete_hotel`
--
ALTER TABLE `paquete_hotel`
  ADD CONSTRAINT `paquete_hotel_ibfk_1` FOREIGN KEY (`ID_Paquete`) REFERENCES `paquete_turistico` (`ID_Paquete`),
  ADD CONSTRAINT `paquete_hotel_ibfk_2` FOREIGN KEY (`ID_Hotel`) REFERENCES `hotel` (`ID_Hotel`);

--
-- Filtros para la tabla `paquete_servicio`
--
ALTER TABLE `paquete_servicio`
  ADD CONSTRAINT `paquete_servicio_ibfk_1` FOREIGN KEY (`ID_Paquete`) REFERENCES `paquete_turistico` (`ID_Paquete`),
  ADD CONSTRAINT `paquete_servicio_ibfk_2` FOREIGN KEY (`ID_Servicio`) REFERENCES `servicio` (`ID_Servicio`);

--
-- Filtros para la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `promocion_ibfk_1` FOREIGN KEY (`ID_Empleado`) REFERENCES `empleado` (`DNI`);

--
-- Filtros para la tabla `proveedor_hotel`
--
ALTER TABLE `proveedor_hotel`
  ADD CONSTRAINT `proveedor_hotel_ibfk_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedor` (`ID_Proveedor`),
  ADD CONSTRAINT `proveedor_hotel_ibfk_2` FOREIGN KEY (`ID_Hotel`) REFERENCES `hotel` (`ID_Hotel`);

--
-- Filtros para la tabla `proveedor_servicio`
--
ALTER TABLE `proveedor_servicio`
  ADD CONSTRAINT `proveedor_servicio_ibfk_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedor` (`ID_Proveedor`),
  ADD CONSTRAINT `proveedor_servicio_ibfk_2` FOREIGN KEY (`ID_Servicio`) REFERENCES `servicio` (`ID_Servicio`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`DNI`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`ID_Empleado`) REFERENCES `empleado` (`DNI`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`ID_Viaje`) REFERENCES `viaje` (`ID_Viaje`);

--
-- Filtros para la tabla `transporte_paquete`
--
ALTER TABLE `transporte_paquete`
  ADD CONSTRAINT `transporte_paquete_ibfk_1` FOREIGN KEY (`ID_transporte`) REFERENCES `transporte` (`ID_transporte`),
  ADD CONSTRAINT `transporte_paquete_ibfk_2` FOREIGN KEY (`ID_Paquete`) REFERENCES `paquete_turistico` (`ID_Paquete`);

--
-- Filtros para la tabla `viaje_vuelo`
--
ALTER TABLE `viaje_vuelo`
  ADD CONSTRAINT `viaje_vuelo_ibfk_1` FOREIGN KEY (`ID_Viaje`) REFERENCES `viaje` (`ID_Viaje`),
  ADD CONSTRAINT `viaje_vuelo_ibfk_2` FOREIGN KEY (`ID_Vuelo`) REFERENCES `vuelo` (`ID_Vuelo`);

--
-- Filtros para la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`Ciudad_Origen`) REFERENCES `ciudad` (`ID_Ciudad`),
  ADD CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`Ciudad_Destino`) REFERENCES `ciudad` (`ID_Ciudad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
