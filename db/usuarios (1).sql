-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2019 a las 03:59:38
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u881670891_tuto1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` int(11) NOT NULL,
  `profesion` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `usuario`, `password`, `perfil`, `profesion`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(13, 'Daniel ', 'Monroy Dominguez', 'admin', '$2a$07$asxy54ahjppf45sd87a5aubt5jxL59S2nL.aWcAusiuidw1hJ.hWu', 1, 'Ingeniero en Sistemas', 'vistas/img/usuarios/admin/518.png', 1, '2019-01-11 19:31:28', '2019-01-12 02:47:04'),
(18, 'Diana Laura', 'Monroy Dominguez', 'coordinadora', '$2a$07$asxy54ahjppf45sd87a5aubt5jxL59S2nL.aWcAusiuidw1hJ.hWu', 2, 'Lic. en Informatica', 'vistas/img/usuarios/chamoys96/930.png', 1, '0000-00-00 00:00:00', '2019-01-12 02:47:09'),
(19, 'Ronaldo ', 'Monroy Domínguez', 'ronaldo2002', '$2a$07$asxy54ahjppf45sd87a5aubt5jxL59S2nL.aWcAusiuidw1hJ.hWu', 3, 'Ing. Electrico', 'vistas/img/usuarios/chamoys96/930.png', 1, '0000-00-00 00:00:00', '2019-01-12 02:47:16'),
(20, 'Maria del Carmen', 'Monroy Dominguez', 'carmen00', '$2a$07$asxy54ahjppf45sd87a5aubt5jxL59S2nL.aWcAusiuidw1hJ.hWu', 3, 'Ingeniero en Industrias Alimenticias', 'vistas/img/usuarios/carmen00/944.png', 1, '0000-00-00 00:00:00', '2019-01-12 02:47:21'),
(21, 'Israel', 'Monroy Dominguez', 'israelMD', '$2a$07$asxy54ahjppf45sd87a5aubt5jxL59S2nL.aWcAusiuidw1hJ.hWu', 3, 'Ingeniero en Electroníca', 'vistas/img/usuarios/israelMD/497.jpg', 1, '0000-00-00 00:00:00', '2019-01-12 02:47:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
