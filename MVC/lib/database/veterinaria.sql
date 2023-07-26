-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2023 a las 17:44:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idadmin` int(11) NOT NULL COMMENT 'Numero identificador del administrador',
  `nomadmin` varchar(255) NOT NULL COMMENT 'Nombre del administrador',
  `emaadmin` varchar(255) NOT NULL COMMENT 'Correo electronico del administrador',
  `passadmin` varchar(255) NOT NULL COMMENT 'Contraseña del administrador',
  `diradmin` varchar(255) NOT NULL COMMENT 'Direccion del administrador',
  `teladmin` varchar(255) NOT NULL COMMENT 'Numero de telefono del administrador',
  `fileadmin` varchar(255) NOT NULL COMMENT 'Imagen de perfil del administrador',
  `apeadmin` varchar(50) NOT NULL COMMENT 'apellido del administrador',
  `teladmin2` varchar(50) NOT NULL COMMENT 'confirmacion de telefono'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idadmin`, `nomadmin`, `emaadmin`, `passadmin`, `diradmin`, `teladmin`, `fileadmin`, `apeadmin`, `teladmin2`) VALUES
(1, 'Arturo', 'rrss@hotmial.com', 'arturito123', 'vereda', '', '', 'Cuellar', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idcit` int(11) NOT NULL COMMENT 'Numero identificador de cada cita',
  `feccit` date NOT NULL COMMENT 'Fecha en que se agenda la cita',
  `nomclicit` varchar(255) NOT NULL COMMENT 'Nombre del dueño de la mascota',
  `telcit` varchar(255) NOT NULL COMMENT 'Numero de telefono del dueño de la mascota',
  `emacit` varchar(255) NOT NULL COMMENT 'Correo electronico del cuidador de la mascota',
  `nommascit` varchar(255) NOT NULL COMMENT 'Nombre de la mascota',
  `espmascit` varchar(255) NOT NULL COMMENT 'Especie de la mascota',
  `edadmascit` varchar(255) NOT NULL COMMENT 'Edad de la mascota',
  `genmascit` varchar(255) NOT NULL COMMENT 'Genero de la mascota',
  `motcit` varchar(255) NOT NULL COMMENT 'Motivo de la cita',
  `observcit` varchar(255) DEFAULT NULL COMMENT 'Observaciones',
  `idmas` int(11) NOT NULL COMMENT 'FK de mascota(idmas)',
  `idcli` int(11) NOT NULL COMMENT 'FK de cliente(idcli)',
  `idcol` int(11) NOT NULL COMMENT 'FK de colaborador(idcol)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcli` int(11) NOT NULL COMMENT 'Numero Identificador del cliente',
  `dnicli` int(11) NOT NULL COMMENT 'Numero de Identificacion del cliente',
  `nomcli` varchar(255) NOT NULL COMMENT 'Nombre del cliente',
  `emacli` varchar(255) NOT NULL COMMENT 'Correo Electronico del cliente',
  `usercli` varchar(255) NOT NULL COMMENT 'Nombre de Usuario dentro del sistema',
  `passcli` varchar(255) NOT NULL COMMENT 'Contraseña del Cliente',
  `dircli` varchar(255) NOT NULL COMMENT 'Direccion del cliente',
  `tzonecli` int(11) NOT NULL COMMENT 'Zona en la cual se encuentra ubicado el cliente',
  `telcli` varchar(255) NOT NULL COMMENT 'Numero de Telefono del cliente',
  `telaltcli` varchar(255) NOT NULL COMMENT 'Numero de telefono alternativo del cliente',
  `filecli` varchar(255) DEFAULT NULL COMMENT 'Imagen de peril del cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcli`, `nomcli`, `emacli`, `usercli`, `passcli`, `dircli`, `tzonecli`, `telcli`, `telaltcli`, `filecli`) VALUES
(1, 'Jose Alejandro Cuellar', 'jcuellarmenza@gmail.com', 'alejo', 'alejo123', 'Calle 8 #6-87', 0, '3133215141', '0', 'img/alejo.png'),
(2, 'pepito perez', 'pepe@gmail.com', 'pepe07', 'pepe07', 'calle 5 sur #c-40', 0, '573164567894', '573164567893', NULL),
(3, '6 6', '6@6', '6', '6', 'calle 5 sur #c-40', 0, '6', '', NULL),
(4, '6 6', '6@6', '6', '6', 'calle 5 sur #c-40', 0, '6', '', NULL),
(5, '6 6', '6@6', '6', '6', 'calle 5 sur #c-40', 0, '6', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `idcol` int(11) NOT NULL COMMENT 'Numero identificador del colaborador',
  `dnicol` int(10) NOT NULL COMMENT 'Numero de identificacion del colaborador',
  `nomcol` varchar(255) NOT NULL COMMENT 'Nombre del colaborador',
  `emacol` varchar(255) NOT NULL COMMENT 'Correo electrnico del colaborador',
  `passcol` varchar(255) NOT NULL COMMENT 'Contraseña del colaborador',
  `dircol` varchar(255) NOT NULL COMMENT 'Direccion del colaborador',
  `telcol` varchar(255) NOT NULL COMMENT 'Numero de telefono del colaborador',
  `rolcol` varchar(255) NOT NULL COMMENT 'Rol que cupa el colaborador en el sistema',
  `filecol` varchar(255) NOT NULL COMMENT 'Imagen de perfil del colaborador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`idcol`, `dnicol`, `nomcol`, `emacol`, `passcol`, `dircol`, `telcol`, `rolcol`, `filecol`) VALUES
(1, 0, 'Manuel ', 'marpex@gmail.com', 'mar123', 'Calle 4 #12-34 La Plata-Huila', '3124569878', 'veterinario', 'img/vet1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `iddiag` int(11) NOT NULL COMMENT 'Numero identificador del diagnostico',
  `docdiag` varchar(255) NOT NULL COMMENT 'Documento que contiene el diagnostico',
  `idcit` int(11) NOT NULL COMMENT 'FK de cita(idcit)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `idlog` int(11) NOT NULL COMMENT 'Numero identificador del login',
  `feciniciolog` date NOT NULL COMMENT 'Fecha en la que se realizo el inicio de sesion',
  `fecfinlog` date NOT NULL COMMENT 'Fecha en la que se finalizo dicha sesion',
  `dnicli` int(11) NOT NULL COMMENT 'FK de cliente(dnicli)',
  `dnicol` int(11) NOT NULL COMMENT 'FK de colaborador(dnicol)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `idmas` int(11) NOT NULL COMMENT 'Numero identificador de la mascota',
  `nommas` varchar(255) NOT NULL COMMENT 'Nombre de la mascota',
  `edadmas` varchar(255) NOT NULL COMMENT 'Edad de la mascota',
  `genmas` varchar(255) NOT NULL COMMENT 'Genero de la mascota',
  `espmas` varchar(255) NOT NULL COMMENT 'Especie de la mascota',
  `dnicli` int(11) NOT NULL COMMENT 'FK de cliente(dnicli)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idprod` int(11) NOT NULL COMMENT 'Numero identificador del producto',
  `nomprod` varchar(255) NOT NULL COMMENT 'Nombre del prodcuto',
  `desprod` varchar(255) NOT NULL COMMENT 'Descripcion del producto',
  `imgprod` varchar(255) NOT NULL COMMENT 'Ruta de la imagen del producto',
  `precprod` int(11) NOT NULL COMMENT 'Costo de adquision del producto',
  `precvenprod` int(11) NOT NULL COMMENT 'Precio de venta al publico',
  `stockprod` int(11) NOT NULL COMMENT 'Numero de productos existentes',
  `catprod` varchar(255) NOT NULL COMMENT 'Categoria del producto',
  `idprov` int(11) NOT NULL COMMENT 'FK de proveedor(idprov)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idprov` int(11) NOT NULL COMMENT 'Numero Identificador del Proveedor',
  `nomprov` varchar(255) NOT NULL,
  `dirprov` varchar(255) NOT NULL COMMENT 'Direccion del Proveedor',
  `emaprov` varchar(255) NOT NULL COMMENT 'Correo electronico del proveedor',
  `telprov` varchar(255) NOT NULL COMMENT 'Numero de telefono del proveedor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroxservicios`
--

CREATE TABLE `registroxservicios` (
  `idreg` int(11) NOT NULL,
  `fecexpreg` date NOT NULL,
  `rsocempreg` varchar(255) NOT NULL,
  `nitempreg` varchar(255) NOT NULL,
  `dirempreg` varchar(255) NOT NULL,
  `nommasreg` varchar(255) NOT NULL,
  `nomclireg` varchar(255) NOT NULL,
  `descreg` varchar(255) NOT NULL,
  `recreg` varchar(255) NOT NULL,
  `valorreg` int(11) NOT NULL,
  `dnicli` int(11) NOT NULL,
  `idmas` int(11) NOT NULL,
  `iddiag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idven` int(11) NOT NULL COMMENT 'Numero identificador de la venta',
  `fecexpven` date NOT NULL COMMENT 'Fecha de expedicion de la venta',
  `nitven` varchar(255) NOT NULL COMMENT 'NIT de la empresa ',
  `rsocven` varchar(255) NOT NULL COMMENT 'Nombre de la empresa',
  `dirven` varchar(255) NOT NULL COMMENT 'Direccion de la empresa',
  `prodven` varchar(255) NOT NULL COMMENT 'Productos vendidos',
  `valorven` int(11) NOT NULL COMMENT 'Preci total de la venta',
  `ivaven` varchar(255) NOT NULL COMMENT 'Porcentaje de IVA para mne ',
  `metpagoven` varchar(255) NOT NULL COMMENT 'Metodo de pago de la compra',
  `dnicli` int(11) NOT NULL COMMENT 'FK de cliente(dnicli)',
  `idprod` int(11) NOT NULL COMMENT 'FK de producto(idprod)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcit`),
  ADD KEY `idmas` (`idmas`),
  ADD KEY `dnicli` (`dnicli`),
  ADD KEY `dnicol` (`dnicol`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`dnicli`);

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`dnicol`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`iddiag`),
  ADD KEY `idcit` (`idcit`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `idcli` (`idcli`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`idmas`),
  ADD KEY `idcli` (`idcli`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idprod`),
  ADD KEY `idprov` (`idprov`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idprov`);

--
-- Indices de la tabla `registroxservicios`
--
ALTER TABLE `registroxservicios`
  ADD PRIMARY KEY (`idreg`),
  ADD KEY `idmas` (`idmas`),
  ADD KEY `dnicli` (`dnicli`),
  ADD KEY `iddiag` (`iddiag`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idven`),
  ADD KEY `idprod` (`idprod`),
  ADD KEY `dnicli` (`dnicli`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador del administrador', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idcit` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador de cada cita';

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcli` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero Identificador del cliente', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `idcol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador del colaborador', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `iddiag` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador del diagnostico';

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador del login';

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `idmas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador de la mascota', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador del producto', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idprov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero Identificador del Proveedor', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `registroxservicios`
--
ALTER TABLE `registroxservicios`
  MODIFY `idreg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idven` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero identificador de la venta';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`idmas`) REFERENCES `mascota` (`idmas`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`dnicli`) REFERENCES `cliente` (`dnicli`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`dnicol`) REFERENCES `colaborador` (`dnicol`);

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `diagnostico_ibfk_1` FOREIGN KEY (`idcit`) REFERENCES `cita` (`idcit`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`dnicli`) REFERENCES `cliente` (`dnicli`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`dnicli`) REFERENCES `cliente` (`dnicli`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idprov`) REFERENCES `proveedor` (`idprov`);

--
-- Filtros para la tabla `registroxservicios`
--
ALTER TABLE `registroxservicios`
  ADD CONSTRAINT `registroxservicios_ibfk_1` FOREIGN KEY (`idmas`) REFERENCES `mascota` (`idmas`),
  ADD CONSTRAINT `registroxservicios_ibfk_2` FOREIGN KEY (`dnicli`) REFERENCES `cliente` (`dnicli`),
  ADD CONSTRAINT `registroxservicios_ibfk_3` FOREIGN KEY (`iddiag`) REFERENCES `diagnostico` (`iddiag`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idprod`) REFERENCES `producto` (`idprod`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`dnicli`) REFERENCES `cliente` (`dnicli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
