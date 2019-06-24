-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2019 a las 16:29:21
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_proyecto_examen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(255) NOT NULL,
  `nombre_exam` varchar(255) NOT NULL,
  `dur_examen` int(11) NOT NULL,
  `cant_repeticiones` int(11) NOT NULL,
  `ver_res_correc` varchar(10) NOT NULL,
  `ver_res_incorrec` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id`, `nombre_exam`, `dur_examen`, `cant_repeticiones`, `ver_res_correc`, `ver_res_incorrec`) VALUES
(6, 'SIS-316', 5, 0, '', ''),
(7, 'SHC-134', 10, 0, '', ''),
(13, 'SIS-102', 20, 1, 'SI', 'SI'),
(17, 'prueba', 10, 2, 'si', 'si'),
(21, 'prueba 2', 10, 2, 'NO', 'NO'),
(23, 'testing', 10, 3, 'SI', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(255) NOT NULL,
  `examen` varchar(255) NOT NULL,
  `pregunta` text NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `obj1` varchar(255) NOT NULL,
  `obj2` varchar(255) NOT NULL,
  `obj3` varchar(255) NOT NULL,
  `obj4` varchar(255) NOT NULL,
  `v_f` varchar(255) NOT NULL,
  `una_palabra` varchar(255) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `puntaje` int(100) DEFAULT NULL,
  `puntaje_campos` double DEFAULT NULL,
  `penitencias` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `examen`, `pregunta`, `tipo`, `obj1`, `obj2`, `obj3`, `obj4`, `v_f`, `una_palabra`, `respuesta`, `puntaje`, `puntaje_campos`, `penitencias`) VALUES
(20, '21', 'jhonathan estudia en s', 'Una palabra', '', '', '', '', '', 'San francisco usfx', 'San francisco usfx', NULL, NULL, NULL),
(33, '7', 'que es software?', ' OpciÃ³n varias', 'web', 'deep learning', 'juegos', '!Os', '', '', 'web,juegos', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `password`, `nombre`, `apellido`, `emailid`) VALUES
(1, 'admin', 'admin', 'Jhonatan', 'Hurtado alias el chinin', 'admin@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
