

------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ID_Ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Pais` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('11223344C', 'Bob', 'Martin', '5678901234', 'bobmartin@example.com', 'bmartin1', '5efc2b017d'),
('12345678A', 'John', 'Doe', '1234567890', 'johndoe@example.com', 'jdoe1', 'ef92b778ba'),
('22334455D', 'Mary', 'Johnson', '1357924680', 'maryjohnson@example.com', 'mjohnson1', '5c773b22ea'),
('22334455M', 'Karen', 'Morris', '9876543210', 'karenmorris@example.com', 'kmorris1', '95fb0af625'),
('33445566E', 'Sam', 'Clark', '2468135790', 'samclark@example.com', 'sclark1', '3233c5e43b'),
('33445566N', 'David', 'Foster', '1112233445', 'davidfoster@example.com', 'dfoster1', '19cb0711df'),
('44556677F', 'Laura', 'White', '1122334455', 'laurawhite@example.com', 'lwhite1', 'c14883c020'),
('44556677O', 'Diana', 'Scott', '4556677889', 'dianascott@example.com', 'dscott1', 'd46b5cd9c1'),
('55667788G', 'Paul', 'Davis', '6677889900', 'pauldavis@example.com', 'pdavis1', '825242929f'),
('55667788P', 'Chris', 'Williams', '6677889900', 'chriswilliams@example.com', 'cwilliams1', 'aea8daf3a1'),
('66778899H', 'Anna', 'Jones', '3344556677', 'annajones@example.com', 'ajones1', 'bb10f0c847'),
('66778899Q', 'John', 'Taylor', '1234567890', 'johntaylor@example.com', 'jtaylor1', 'b9017426fe'),
('77889900I', 'Richard', 'Lee', '8877665544', 'richardlee@example.com', 'rlee1', '44130b0a20'),
('77889900R', 'Emily', 'Davis', '2233445566', 'emilydavis@example.com', 'edavis1', 'c5b0eb31b1'),
('87654321B', 'Alice', 'Smith', '0987654321', 'alicesmith@example.com', 'asmith1', 'c6ba91b90d'),
('88990011J', 'Tom', 'Thompson', '5556667777', 'tomthompson@example.com', 'tthompson1', '3cd4e74734'),
('88990011S', 'Michael', 'Miller', '5566778899', 'michaelmiller@example.com', 'mmiller1', '252acd35e7'),
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
  `ID_Guia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Idioma` varchar(50) DEFAULT NULL,
  `ID_Ciudad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `ID_Hotel` int(11) NOT NULL AUTO_INCREMENT,
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
  `ID_Pago` int(11) NOT NULL AUTO_INCREMENT,
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
  `ID_Paquete` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `ID_Promocion` int(11) NOT NULL AUTO_INCREMENT,
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
  `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT,
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
  `ID_Reserva` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `Num_Personas` int(11) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `ID_Cliente` varchar(15) DEFAULT NULL,
  `ID_Empleado` varchar(15) DEFAULT NULL,
  `ID_Viaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `ID_Servicio` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_Transporte` varchar(100) DEFAULT NULL,
  `Empresa` varchar(100) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `ID_Sucursal` int(11) NOT NULL AUTO_INCREMENT,
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
(5, 'Calle del Oeste 202', NULL, 'Sucursal Oeste');

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
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`ID_Viaje`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`ID_transporte`);

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
-- Filtros para la tabla `transporte_paquete`
--
ALTER TABLE `transporte_paquete`
  ADD CONSTRAINT `transporte_paquete_ibfk_1` FOREIGN KEY (`ID_transporte`) REFERENCES `transporte` (`ID_transporte`),
  ADD CONSTRAINT `transporte_paquete_ibfk_2` FOREIGN KEY (`ID_Paquete`) REFERENCES `paquete_turistico` (`ID_Paquete`);

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
