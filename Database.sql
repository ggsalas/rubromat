-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2016 at 03:34 PM
-- Server version: 5.7.10
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rubromatV2`
--

-- --------------------------------------------------------

--
-- Table structure for table `insumo`
--

CREATE TABLE `insumo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `unMetrica` int(11) NOT NULL,
  `unComercial` int(11) NOT NULL,
  `cantComercial` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `insumo`
--

INSERT INTO `insumo` (`id`, `nombre`, `unMetrica`, `unComercial`, `cantComercial`) VALUES
(4, 'Ladrillo hueco 12cm', 10, 6, '1.00'),
(5, 'Ladrillo hueco 18cm', 10, 6, '1.00'),
(17, 'Cal', 9, 9, '25.00'),
(18, 'Cemento', 9, 9, '50.00'),
(19, 'Arena', 7, 3, '1.00'),
(21, 'Piedra partida', 7, 3, '1.00'),
(22, 'Piedra granza', 7, 3, '1.00'),
(23, 'Hierro redondo aletaado de 8mm', 5, 6, '12.00'),
(24, 'Hierro redondo aletaado de 10mm', 5, 6, '12.00'),
(25, 'Hierro redondo aletaado de 12mm', 6, 6, '12.00'),
(30, 'Mano de Obra: Oficial albaÃ±il', 12, 8, '8.00'),
(31, 'Mano de Obra: Ayudante albaÃ±il', 12, 8, '8.00'),
(32, 'Ladrillo comÃºn', 10, 6, '1.00'),
(33, 'Ladrillo comÃºn visto', 10, 6, '1.00'),
(35, 'Ladrillo hueco 8 cm', 10, 6, '1.00'),
(44, 'Hierro redondo aletaado de 4,2mm', 5, 6, '12.00'),
(62, 'HidrÃ³fugo Sika1', 9, 11, '20.00'),
(63, 'Cascote', 7, 3, '1.00'),
(65, 'Mosaico de 50 x 50 cm', 10, 6, '1.00'),
(69, 'Madera techo 1" x 2"', 5, 1, '1.00'),
(70, 'Madera techo 2" x 2"', 5, 1, '1.00'),
(71, 'Lana de vidrio c/foil aluminio  5cm Isover', 6, 15, '21.60'),
(72, 'Lana de vidrio c/foil aluminio  8cm Isover', 6, 15, '14.40'),
(73, 'Lana de vidrio c/foil aluminio  10cm Isover', 6, 15, '13.20'),
(74, 'Clavo espiralado 1,5"', 10, 9, '120.00'),
(75, 'Clavo espiralado 3"', 10, 9, '100.00'),
(76, 'Clavo espiralado Cabeza de Plomo  3"', 10, 9, '100.00'),
(77, 'FenÃ³lico 18mm', 6, 6, '2.98'),
(78, 'Film polietileno 200 micrones', 6, 2, '1.00'),
(79, 'Ruberoid pesado', 6, 13, '40.00'),
(80, 'Madera techo 1/2" x 1"', 5, 1, '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `insumoXrubro`
--

CREATE TABLE `insumoXrubro` (
  `id_insumo` int(11) NOT NULL,
  `id_rubro` int(11) NOT NULL,
  `rendimiento` decimal(11,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `insumoXrubro`
--

INSERT INTO `insumoXrubro` (`id_insumo`, `id_rubro`, `rendimiento`) VALUES
(4, 29, '15.000'),
(5, 30, '15.000'),
(17, 28, '1.890'),
(17, 29, '2.830'),
(17, 30, '4.240'),
(17, 31, '16.280'),
(17, 32, '7.880'),
(17, 37, '3.600'),
(17, 43, '81.000'),
(17, 44, '5.900'),
(18, 28, '0.990'),
(18, 29, '1.480'),
(18, 30, '2.220'),
(18, 31, '8.510'),
(18, 32, '8.090'),
(18, 37, '1.850'),
(18, 38, '10.800'),
(18, 39, '10.800'),
(18, 40, '6.750'),
(18, 41, '9.000'),
(18, 42, '300.000'),
(18, 43, '38.400'),
(18, 44, '3.100'),
(18, 45, '2.700'),
(18, 47, '27.000'),
(19, 28, '0.010'),
(19, 29, '0.014'),
(19, 30, '0.021'),
(19, 31, '0.080'),
(19, 32, '0.038'),
(19, 37, '0.017'),
(19, 38, '0.024'),
(19, 39, '0.024'),
(19, 40, '0.015'),
(19, 41, '0.020'),
(19, 42, '0.650'),
(19, 43, '0.515'),
(19, 44, '0.030'),
(19, 45, '0.006'),
(19, 47, '0.059'),
(21, 33, '1.000'),
(22, 40, '0.015'),
(22, 41, '0.020'),
(22, 42, '0.650'),
(22, 47, '0.059'),
(23, 33, '50.000'),
(23, 40, '4.000'),
(23, 41, '4.000'),
(24, 47, '3.000'),
(30, 28, '0.400'),
(30, 29, '0.400'),
(30, 30, '0.400'),
(30, 31, '1.700'),
(30, 32, '0.850'),
(31, 28, '0.350'),
(31, 29, '0.350'),
(31, 30, '0.350'),
(31, 31, '1.700'),
(31, 32, '0.850'),
(32, 31, '120.000'),
(32, 32, '60.000'),
(32, 33, '9.000'),
(33, 33, '2.000'),
(35, 28, '15.000'),
(44, 40, '2.500'),
(44, 41, '3.000'),
(62, 39, '0.500'),
(62, 45, '0.250'),
(63, 43, '0.770'),
(65, 44, '4.000'),
(70, 46, '2.250'),
(71, 46, '1.000'),
(77, 46, '1.000'),
(79, 46, '1.000'),
(80, 46, '2.670');

-- --------------------------------------------------------

--
-- Table structure for table `obra`
--

CREATE TABLE `obra` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `obra`
--

INSERT INTO `obra` (`id`, `nombre`, `descripcion`) VALUES
(5, 'Nueva obra', 'Parece que todo funciona bien... habrÃ¡ que ver como sale'),
(6, 'Varios muros', 'Probando el funcionamiento con varios muros '),
(11, 'Quincho 8,66 x 4m', 'Un quincho al fondo del terreno');

-- --------------------------------------------------------

--
-- Table structure for table `rubro`
--

CREATE TABLE `rubro` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `unMetrica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `rubro`
--

INSERT INTO `rubro` (`id`, `nombre`, `unMetrica`) VALUES
(28, 'Mamposteria Lad. Hueco del 8', 6),
(29, 'Mamposteria Lad. Hueco del 12', 6),
(30, 'Mamposteria Lad. Hueco del 18', 6),
(31, 'Mamposteria ladrillo comÃºn de 30', 6),
(32, 'Mamposteria ladrillo comÃºn de 15', 6),
(33, 'zPrueba ', 6),
(37, 'Revoque grueso e=1.5cm', 6),
(38, 'Carpeta de cemento E=2cm', 6),
(39, 'Carpeta hidrÃ³fuga E=2cm (Sika1)', 6),
(40, 'Encadenado HÂ° AÂ° para "muros de 15"', 5),
(41, 'Encadenado HÂ° AÂ° para "muros de 20"', 5),
(42, 'HormigÃ³n', 7),
(43, 'Contrapiso de cascotes', 7),
(44, 'Piso de Mosaicos 50x50cm', 6),
(45, 'Azotado hidrÃ³fugo bajo revoque e=0,5cm', 6),
(46, 'Cubierta de chapa ondulada c/aisl. tÃ©rmica (no incluye estructura)', 6),
(47, 'Zapata corrida HÂ° AÂ° 30x30cm 3 (fe) del 10', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rubroXobra`
--

CREATE TABLE `rubroXobra` (
  `id_rubro` int(11) NOT NULL,
  `id_obra` int(11) NOT NULL,
  `cantidad` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `rubroXobra`
--

INSERT INTO `rubroXobra` (`id_rubro`, `id_obra`, `cantidad`) VALUES
(28, 5, '2.00'),
(30, 5, '9.00'),
(32, 5, '22.00'),
(33, 5, '77.00'),
(28, 6, '60.00'),
(30, 6, '10.00'),
(30, 11, '77.00'),
(37, 11, '140.00'),
(41, 11, '26.00'),
(43, 11, '30.52'),
(46, 11, '41.00'),
(47, 11, '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `unComercial`
--

CREATE TABLE `unComercial` (
  `id` int(11) NOT NULL,
  `unidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `unComercial`
--

INSERT INTO `unComercial` (`id`, `unidad`) VALUES
(1, 'm'),
(2, 'm2'),
(3, 'm3'),
(4, 'litro'),
(5, 'kg'),
(6, 'unidad'),
(7, 'global'),
(8, 'jornal'),
(9, 'bolsa'),
(10, 'bolson'),
(11, 'balde'),
(12, 'caja'),
(13, 'rollo'),
(14, 'varilla'),
(15, 'rollo'),
(16, 'varilla');

-- --------------------------------------------------------

--
-- Table structure for table `unMetrica`
--

CREATE TABLE `unMetrica` (
  `id` int(11) NOT NULL,
  `unidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `unMetrica`
--

INSERT INTO `unMetrica` (`id`, `unidad`) VALUES
(5, 'm'),
(6, 'm2'),
(7, 'm3'),
(8, 'litro'),
(9, 'kg'),
(10, 'unidad'),
(11, 'global'),
(12, 'hora');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unComercial` (`unComercial`),
  ADD KEY `unMetrica` (`unMetrica`);

--
-- Indexes for table `insumoXrubro`
--
ALTER TABLE `insumoXrubro`
  ADD PRIMARY KEY (`id_insumo`,`id_rubro`) USING BTREE,
  ADD UNIQUE KEY `insumoXrubro` (`id_insumo`,`id_rubro`) USING BTREE,
  ADD KEY `rubro` (`id_rubro`);

--
-- Indexes for table `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rubro`
--
ALTER TABLE `rubro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rubro` (`nombre`),
  ADD KEY `unMetrica` (`unMetrica`);

--
-- Indexes for table `rubroXobra`
--
ALTER TABLE `rubroXobra`
  ADD PRIMARY KEY (`id_obra`,`id_rubro`),
  ADD KEY `id_obra` (`id_obra`,`id_rubro`),
  ADD KEY `id_rubro` (`id_rubro`);

--
-- Indexes for table `unComercial`
--
ALTER TABLE `unComercial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unMetrica`
--
ALTER TABLE `unMetrica`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `insumo`
--
ALTER TABLE `insumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `obra`
--
ALTER TABLE `obra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `rubro`
--
ALTER TABLE `rubro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `unComercial`
--
ALTER TABLE `unComercial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `unMetrica`
--
ALTER TABLE `unMetrica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `insumo`
--
ALTER TABLE `insumo`
  ADD CONSTRAINT `insumo_ibfk_1` FOREIGN KEY (`unMetrica`) REFERENCES `unMetrica` (`id`),
  ADD CONSTRAINT `insumo_ibfk_2` FOREIGN KEY (`unComercial`) REFERENCES `unComercial` (`id`);

--
-- Constraints for table `insumoXrubro`
--
ALTER TABLE `insumoXrubro`
  ADD CONSTRAINT `insumoXrubro_ibfk_1` FOREIGN KEY (`id_insumo`) REFERENCES `insumo` (`id`),
  ADD CONSTRAINT `insumoXrubro_ibfk_2` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id`);

--
-- Constraints for table `rubro`
--
ALTER TABLE `rubro`
  ADD CONSTRAINT `rubro_ibfk_1` FOREIGN KEY (`unMetrica`) REFERENCES `unMetrica` (`id`);

--
-- Constraints for table `rubroXobra`
--
ALTER TABLE `rubroXobra`
  ADD CONSTRAINT `rubroXobra_ibfk_1` FOREIGN KEY (`id_obra`) REFERENCES `obra` (`id`),
  ADD CONSTRAINT `rubroXobra_ibfk_2` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
