-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2021 a las 06:12:40
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `IdCurso` int(11) NOT NULL,
  `CodigoCurso` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Horas` decimal(10,0) NOT NULL,
  `IdDocente` int(11) NOT NULL,
  `Estado` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`IdCurso`, `CodigoCurso`, `Descripcion`, `Horas`, `IdDocente`, `Estado`) VALUES
(1, 'C001', 'Natacion', '2', 1, 'Habilitado'),
(2, 'C002', 'Basket', '2', 2, 'Habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `IdDocente` int(11) NOT NULL,
  `CodigoDocente` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `Nombres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Estado` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`IdDocente`, `CodigoDocente`, `Nombres`, `Apellidos`, `Estado`) VALUES
(1, 'E105', 'Mario', 'Vargas Llosa', 'Habilitado'),
(2, 'D306', 'Ricardo', 'Reyes Basoalto', 'Habilitado'),
(3, 'P895', 'Lucila', 'Godoy Alcayaga', 'Inhabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE `escuela` (
  `IdEscuela` int(11) NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Nivel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Estado` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`IdEscuela`, `Descripcion`, `Nivel`, `Direccion`, `Estado`) VALUES
(1, 'I.E.N San Martin de Porres', 'Primario', 'Calle NI', 'Habilitado'),
(2, 'I.E.P Mario Vargas Llosa', 'Secundario', 'Calle JLO', 'Habilitado'),
(3, 'I.E.P Carmelitas', 'Primario y Secundario', 'Calle Grau', 'Habilitado'),
(4, 'I.E.N Santa Rosa de Lima', 'Primario', 'Calle Bolegnesi', 'Habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `IdEstudiante` int(11) NOT NULL,
  `NumeroDocumento` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `Codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Nombres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `IdEscuela` int(11) NOT NULL,
  `Estado` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`IdEstudiante`, `NumeroDocumento`, `Codigo`, `Nombres`, `Apellidos`, `IdEscuela`, `Estado`) VALUES
(1, '89895656', 'ad2f20', 'Gabriel ', 'Otero Rios', 3, 'Habilitado'),
(2, '89562312', 'd847bd', 'Fabiane', 'Guerra Paz', 2, 'Habilitado'),
(3, '78787878', '44481c', 'Amy', 'Lopez Lopez', 4, 'Habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `IdMatricula` int(11) NOT NULL,
  `IdEstudiante` int(11) NOT NULL,
  `IdCurso` int(11) NOT NULL,
  `Estado` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`IdMatricula`, `IdEstudiante`, `IdCurso`, `Estado`) VALUES
(1, 1, 1, 'Habilitado'),
(2, 1, 2, 'Habilitado'),
(3, 2, 2, 'Habilitado'),
(4, 3, 1, 'Habilitado'),
(5, 3, 2, 'Habilitado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`IdCurso`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`IdDocente`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`IdEscuela`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`IdEstudiante`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`IdMatricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `IdCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `IdDocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `escuela`
--
ALTER TABLE `escuela`
  MODIFY `IdEscuela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `IdEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `IdMatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
