-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2024 a las 05:12:56
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
-- Base de datos: `billingapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cant_prod_ven`
--

CREATE TABLE `cant_prod_ven` (
  `id_cant_prod_ven` int(11) NOT NULL,
  `prod_ven` varchar(200) NOT NULL,
  `prod_prec_unid` double NOT NULL,
  `cant_ven` int(11) NOT NULL,
  `id_fac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cant_prod_ven`
--

INSERT INTO `cant_prod_ven` (`id_cant_prod_ven`, `prod_ven`, `prod_prec_unid`, `cant_ven`, `id_fac`) VALUES
(10, 'paracetamol', 19.99, 5, 4),
(30, 'paracetamol', 19.99, 2, 1),
(47, 'Acetaminofen', 14.5, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cli` int(11) NOT NULL,
  `nom_cli` varchar(200) NOT NULL,
  `ced_rif_cli` varchar(25) NOT NULL,
  `tel_cli` varchar(15) NOT NULL,
  `dir_cli` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cli`, `nom_cli`, `ced_rif_cli`, `tel_cli`, `dir_cli`) VALUES
(1, 'Pepe', '4452343454', '45452324554', 'Los Teques'),
(2, 'Manolo', '234875434', '09876467823', 'José Gregorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_fac` int(11) NOT NULL,
  `serial_fac` varchar(80) NOT NULL,
  `fec_fac` datetime NOT NULL,
  `nom_cli` varchar(200) NOT NULL,
  `ced_rif_cli` varchar(25) NOT NULL,
  `tel_cli` varchar(15) NOT NULL,
  `dir_cli` text NOT NULL,
  `nom_usu` varchar(200) NOT NULL,
  `met_pago` varchar(50) NOT NULL,
  `monto_fac` double NOT NULL,
  `iva_fac` float NOT NULL,
  `total_fac` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_fac`, `serial_fac`, `fec_fac`, `nom_cli`, `ced_rif_cli`, `tel_cli`, `dir_cli`, `nom_usu`, `met_pago`, `monto_fac`, `iva_fac`, `total_fac`) VALUES
(1, '4534dwwsa22', '2024-05-30 09:24:48', 'Manolo', '234875434', '09876467823', 'José Gregorio', 'Luis', 'Efectivo', 39.98, 16, 46.38),
(4, '342d2evfrve443', '2024-05-31 02:05:00', 'Pepe', '4452343454', '45452324554', 'Los Teques', 'Paco', 'Divisa', 172.45, 16, 205.22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_prod` int(11) NOT NULL,
  `cod_prod` varchar(100) NOT NULL,
  `nom_prod` varchar(200) NOT NULL,
  `prec_comp_prod` double NOT NULL,
  `prec_ven_prod` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_prod`, `cod_prod`, `nom_prod`, `prec_comp_prod`, `prec_ven_prod`) VALUES
(1, '543232', 'paracetamol', 15.99, 19.99),
(2, '543256', 'Acetaminofen', 10.25, 14.5),
(5, '6cewd4444434feds', 'Escoba', 30.45, 35.25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usu` int(11) NOT NULL,
  `nom_usu` varchar(200) NOT NULL,
  `ced_usu` varchar(25) NOT NULL,
  `contra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usu`, `nom_usu`, `ced_usu`, `contra`) VALUES
(1, 'Luis', '29850292', '1234'),
(18, 'Paco', '285678656', 'Pac20$'),
(24, 'Manfred', '323234534', 'Bat24#');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cant_prod_ven`
--
ALTER TABLE `cant_prod_ven`
  ADD PRIMARY KEY (`id_cant_prod_ven`),
  ADD KEY `id_fact` (`id_fac`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cli`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_fac`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_prod`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cant_prod_ven`
--
ALTER TABLE `cant_prod_ven`
  MODIFY `id_cant_prod_ven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_fac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cant_prod_ven`
--
ALTER TABLE `cant_prod_ven`
  ADD CONSTRAINT `cant_prod_ven_ibfk_1` FOREIGN KEY (`id_fac`) REFERENCES `facturas` (`id_fac`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
