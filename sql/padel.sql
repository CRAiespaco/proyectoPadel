-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 15-12-2022 a las 17:10:16
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `padel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `DNI` varchar(9) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `TELEFONO` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CORREOELECTRONICO` varchar(320) NOT NULL,
  `CONTRASENYA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`DNI`, `NOMBRE`, `APELLIDOS`, `TELEFONO`, `CORREOELECTRONICO`, `CONTRASENYA`) VALUES
('22555666A', 'Rocío', 'Martinez Rodriguez', NULL, 'rocio@gmail.com', '1234'),
('22555777A', 'Luisa', 'Martinez Rodriguez', '732685954', 'luisa@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pistas`
--

CREATE TABLE `pistas` (
  `idPista` int NOT NULL,
  `precio` float NOT NULL,
  `luz` tinyint(1) NOT NULL,
  `precioLuz` float DEFAULT NULL,
  `tipoPista` enum('individual','doble') NOT NULL,
  `cubierta` tinyint(1) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `reservasPistasMensuales` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pistas`
--

INSERT INTO `pistas` (`idPista`, `precio`, `luz`, `precioLuz`, `tipoPista`, `cubierta`, `disponible`, `reservasPistasMensuales`) VALUES
(1, 12, 0, NULL, 'individual', 0, 1, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ReservaParqueBolas`
--

CREATE TABLE `ReservaParqueBolas` (
  `fecha` datetime NOT NULL,
  `numHoras` int NOT NULL,
  `Clientes` varchar(9) NOT NULL,
  `costeHora` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ReservaParqueBolas`
--

INSERT INTO `ReservaParqueBolas` (`fecha`, `numHoras`, `Clientes`, `costeHora`) VALUES
('2022-11-15 00:00:00', 2, '35687895W', 3.5),
('2022-11-15 00:00:00', 2, '35687895W', 3.5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pistas`
--
ALTER TABLE `pistas`
  ADD PRIMARY KEY (`idPista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
