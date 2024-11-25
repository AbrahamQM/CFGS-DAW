-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2021 a las 21:09:32
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
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_marca` tinyint(4) NOT NULL,
  `id_modelo` smallint(6) DEFAULT NULL,
  `modelo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id_marca`, `id_modelo`, `modelo`) VALUES
(1, 1, 'A1'),
(1, 2, 'A2'),
(1, 3, 'A3'),
(1, 4, 'A4'),
(1, 5, 'A5'),
(2, 6, '1 Series'),
(2, 7, '2 Series'),
(2, 8, '3 Series'),
(2, 9, '4 Series'),
(2, 10, '5 Series'),
(3, 11, '124'),
(3, 12, 'Brava'),
(3, 13, 'Bravo'),
(3, 14, 'Croma'),
(3, 15, 'Regata'),
(4, 51, 'Atos'),
(4, 13, 'Bayon'),
(4, 14, 'Custo'),
(4, 15, 'Excel'),
(4, 16, 'Tucson'),
(5, 17, 'Alhambra'),
(5, 18, 'Altea'),
(5, 19, 'Córdoba'),
(5, 20, 'Panda'),
(5, 21, 'Toledo'),
(6, 22, 'Auris'),
(6, 23, 'Aygo'),
(6, 24, 'Corolla'),
(6, 25, 'Pixis'),
(6, 26, 'Sienna'),
(7, 27, 'Atlas'),
(7, 28, 'Bora'),
(7, 29, 'Golf'),
(7, 30, 'Polo'),
(7, 31, 'Tiguan');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
