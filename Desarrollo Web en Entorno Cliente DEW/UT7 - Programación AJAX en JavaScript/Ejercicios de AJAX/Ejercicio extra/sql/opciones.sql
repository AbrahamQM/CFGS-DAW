-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2021 a las 21:09:50
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coches`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id_modelo` smallint(6) UNSIGNED NOT NULL,
  `id_marca` smallint(6) NOT NULL,
  `cod_opcion` int(11) NOT NULL COMMENT 'Código de opción DENTRO de la modelo, campo no único',
  `nombre` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id_modelo`, `id_marca`, `cod_opcion`, `nombre`) VALUES
(1, 1, 1, 'Climatización/Calefacción'),
(2, 1, 1, 'Climatización/Calefacción'),
(3, 1, 1, 'Climatización/Calefacción'),
(6, 2, 1, 'Climatización/Calefacción'),
(7, 2, 1, 'Climatización/Calefacción'),
(8, 2, 1, 'Climatización/Calefacción'),
(11, 3, 1, 'Climatización/Calefacción'),
(12, 3, 1, 'Climatización/Calefacción'),
(13, 3, 1, 'Climatización/Calefacción'),
(51, 4, 1, 'Climatización/Calefacción'),
(13, 4, 1, 'Climatización/Calefacción'),
(14, 4, 1, 'Climatización/Calefacción'),
(17, 5, 1, 'Climatización/Calefacción'),
(18, 5, 1, 'Climatización/Calefacción'),
(19, 5, 1, 'Climatización/Calefacción'),
(22, 6, 1, 'Climatización/Calefacción'),
(23, 6, 1, 'Climatización/Calefacción'),
(24, 6, 1, 'Climatización/Calefacción'),
(27, 7, 1, 'Climatización/Calefacción'),
(28, 7, 1, 'Climatización/Calefacción'),
(29, 7, 1, 'Climatización/Calefacción'),
(1, 1, 2, 'Sistema de Seguridad'),
(2, 1, 2, 'Sistema de Seguridad'),
(3, 1, 2, 'Sistema de Seguridad'),
(6, 2, 2, 'Sistema de Seguridad'),
(7, 2, 2, 'Sistema de Seguridad'),
(8, 2, 2, 'Sistema de Seguridad'),
(11, 3, 2, 'Sistema de Seguridad'),
(12, 3, 2, 'Sistema de Seguridad'),
(13, 3, 2, 'Sistema de Seguridad'),
(51, 4, 2, 'Sistema de Seguridad'),
(13, 4, 2, 'Sistema de Seguridad'),
(14, 4, 2, 'Sistema de Seguridad'),
(17, 5, 2, 'Sistema de Seguridad'),
(18, 5, 2, 'Sistema de Seguridad'),
(19, 5, 2, 'Sistema de Seguridad'),
(22, 6, 2, 'Sistema de Seguridad'),
(23, 6, 2, 'Sistema de Seguridad'),
(24, 6, 2, 'Sistema de Seguridad'),
(27, 7, 2, 'Sistema de Seguridad'),
(28, 7, 2, 'Sistema de Seguridad'),
(29, 7, 2, 'Sistema de Seguridad'),
(4, 1, 3, 'Cierre centralizado'),
(5, 1, 3, 'Cierre centralizado'),
(9, 2, 3, 'Cierre centralizado'),
(10, 2, 3, 'Cierre centralizado'),
(14, 3, 3, 'Cierre centralizado'),
(15, 3, 3, 'Cierre centralizado'),
(3, 4, 3, 'Cierre centralizado'),
(15, 4, 3, 'Cierre centralizado'),
(16, 4, 3, 'Cierre centralizado'),
(20, 5, 3, 'Cierre centralizado'),
(21, 5, 3, 'Cierre centralizado'),
(25, 6, 3, 'Cierre centralizado'),
(26, 6, 3, 'Cierre centralizado'),
(30, 7, 3, 'Cierre centralizado'),
(31, 7, 3, 'Cierre centralizado'),
(4, 1, 4, 'Sensor de lluvia'),
(5, 1, 4, 'Sensor de lluvia'),
(9, 2, 4, 'Sensor de lluvia'),
(10, 2, 4, 'Sensor de lluvia'),
(14, 3, 4, 'Sensor de lluvia'),
(15, 3, 4, 'Sensor de lluvia'),
(3, 4, 4, 'Sensor de lluvia'),
(15, 4, 4, 'Sensor de lluvia'),
(16, 4, 4, 'Sensor de lluvia'),
(20, 5, 4, 'Sensor de lluvia'),
(21, 5, 4, 'Sensor de lluvia'),
(25, 6, 4, 'Sensor de lluvia'),
(26, 6, 4, 'Sensor de lluvia'),
(30, 7, 4, 'Sensor de lluvia'),
(31, 7, 4, 'Sensor de lluvia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `opciones`
--
/*ALTER TABLE `opciones`
  ADD PRIMARY KEY (`cod_opcion`);*/

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `opciones`
--
/*ALTER TABLE `opciones`
  MODIFY `cod_opcion` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8117;
COMMIT;
*/
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
