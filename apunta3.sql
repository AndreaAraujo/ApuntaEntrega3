-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2017 a las 14:01:53
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apunta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `IdNota` bigint(5) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `contenido` varchar(300) CHARACTER SET utf8 NOT NULL,
  `Usuario_idUsuario` bigint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`IdNota`, `nombre`, `contenido`, `Usuario_idUsuario`) VALUES
(43, 'Entrenamiento', 'Abdominales: 3 series de 30 repeticiones********* Sentadillas: 5 series de 20 repeticionesliva virgen extra**********   Press banca: 4 series de 25 repeticiones', 11),
(44, 'CumpleaÃ±os', 'FÃ¡tima: 23/9  ,  Mario: 01/12  ', 11),
(45, 'Ingredientes croquetas para 6 personas', '200g de jamÃ³n serrano ,1 cebolleta , 1 diente de ajo , 100g de harina , 100g de mantequilla (o 100ml de aceite de oliva virgen extra) , 1L de leche , perejil', 12),
(47, 'Llamadas pendientes', 'Maite de Linasa , Talleres Gumerjo', 10),
(48, 'Reuniones', 'Jueves 02/11/2017 a las 10:00', 10),
(49, 'NataciÃ³n', '400m estilos , 500m x 2 crol', 10),
(53, 'Lista de la compra', 'SalmÃ³n , Macarrones , AzÃºcar moreno , AtÃºn ,Calamares', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_compartidas`
--

CREATE TABLE `notas_compartidas` (
  `idUsu` bigint(5) NOT NULL,
  `idNota` bigint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas_compartidas`
--

INSERT INTO `notas_compartidas` (`idUsu`, `idNota`) VALUES
(11, 53),
(12, 44),
(12, 53),
(13, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` bigint(5) NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `login`, `password`, `email`) VALUES
(10, 'pepe', '926e27eecdbc7a18858b3798ba99bddd', 'pepe@gmail.com'),
(11, 'maria', '263bce650e68ab4e23f28263760b9fa5', 'maria@gmail.com'),
(12, 'juan', 'a94652aa97c7211ba8954dd15a3cf838', 'juan@gmail.com'),
(13, 'mario', 'de2f15d014d40b93578d255e6221fd60', 'mario@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`IdNota`),
  ADD KEY `Usuario_idUsuario` (`Usuario_idUsuario`);

--
-- Indices de la tabla `notas_compartidas`
--
ALTER TABLE `notas_compartidas`
  ADD PRIMARY KEY (`idUsu`,`idNota`),
  ADD KEY `idUsu` (`idUsu`),
  ADD KEY `idNota` (`idNota`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `IdNota` bigint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` bigint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas_compartidas`
--
ALTER TABLE `notas_compartidas`
  ADD CONSTRAINT `notas_compartidas_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_compartidas_ibfk_2` FOREIGN KEY (`idNota`) REFERENCES `nota` (`IdNota`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
