-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2022 at 06:45 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planillas`
--

-- --------------------------------------------------------

--
-- Table structure for table `anticipo`
--

CREATE TABLE `anticipo` (
  `id` int(11) NOT NULL,
  `monto` decimal(6,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anticipo`
--

INSERT INTO `anticipo` (`id`, `monto`, `fecha`, `estado`, `id_empleado`) VALUES
(1, '120.41', '2022-11-20', 'aprobado', 5);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `nom_area` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `nom_area`) VALUES
(1, 'Departamento de finanzas'),
(2, 'Departamento técnico y de obra'),
(3, 'Departamento de administración'),
(4, 'Dirección de proyectos'),
(5, 'Departamento de recursos humanos');

-- --------------------------------------------------------

--
-- Table structure for table `bono`
--

CREATE TABLE `bono` (
  `id` int(11) NOT NULL,
  `id_tipoBono` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bono`
--

INSERT INTO `bono` (`id`, `id_tipoBono`, `id_empleado`) VALUES
(6, 1, 5),
(8, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nom_Cargo` varchar(45) DEFAULT NULL,
  `id_area` int(4) DEFAULT NULL,
  `sueldo` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`id`, `nom_Cargo`, `id_area`, `sueldo`) VALUES
(1, 'Contador', 1, '2500.00'),
(15, 'Maestro de obra', 4, '1698.00'),
(21, 'Tesorero', 1, '1605.00'),
(27, 'Arquitecto', 1, '2536.00');

-- --------------------------------------------------------

--
-- Table structure for table `descuento`
--

CREATE TABLE `descuento` (
  `id` int(11) NOT NULL,
  `id_tipoDescuento` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `descuento`
--

INSERT INTO `descuento` (`id`, `id_tipoDescuento`, `id_empleado`) VALUES
(5, 40, 5),
(8, 2, 5),
(9, 46, 5);

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `DNI` varchar(8) DEFAULT NULL,
  `P_nombre` varchar(20) DEFAULT NULL,
  `S_nombre` varchar(20) DEFAULT NULL,
  `P_apellido` varchar(20) DEFAULT NULL,
  `S_apellido` varchar(20) DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`id`, `DNI`, `P_nombre`, `S_nombre`, `P_apellido`, `S_apellido`, `edad`, `fecha_nacimiento`, `direccion`, `id_cargo`) VALUES
(1, '34557645', 'Pedro', 'Lucas', 'Hervas', 'Saez', 28, '1957-08-08', 'Polígono Real, 17', 15),
(2, '07250502', 'Maria', 'Mar', 'Cardona', 'Murillo', 23, '2022-02-02', 'Jardins De España, 47, 09628, Villafranca Montes De Oca(burgos)', 1),
(4, '31457653', 'Adelina', 'Laura', 'Espinosa', 'Costa', 24, '2029-02-03', 'Carrer Iglesia, 97, 31047, Obanos(navarra)', 27),
(5, '33360373', 'Gonzalo', '--', 'Prado', 'Moran', 32, '1961-02-09', 'Avinguda Real, 77, 26030, Herce(rioja, La)', 27);

-- --------------------------------------------------------

--
-- Table structure for table `planillas`
--

CREATE TABLE `planillas` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `sueldo_bruto` decimal(7,2) DEFAULT NULL,
  `sueldo_neto` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `telefonoempleado`
--

CREATE TABLE `telefonoempleado` (
  `id` int(11) NOT NULL,
  `numero` varchar(9) DEFAULT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipobono`
--

CREATE TABLE `tipobono` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `monto` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipobono`
--

INSERT INTO `tipobono` (`id`, `descripcion`, `monto`) VALUES
(1, 'Gratificacion Familiar', '73.00'),
(3, 'Bono por Fiestas Patrias', '98.00');

-- --------------------------------------------------------

--
-- Table structure for table `tipodescuento`
--

CREATE TABLE `tipodescuento` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `monto` decimal(4,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipodescuento`
--

INSERT INTO `tipodescuento` (`id`, `descripcion`, `monto`) VALUES
(1, 'Aporte a EsSalud', '0.0900'),
(2, 'Aporte a AFP', '0.1245'),
(39, 'IR / 0-5 UIT', '0.0800'),
(40, 'IR / 5-20 UIT', '0.1400'),
(41, 'IR / 20-35 UIT', '0.1700'),
(42, 'IR / 35-45 UIT', '0.2000'),
(43, 'IR / 45+', '0.3000'),
(46, 'Aporte a la ONP', '0.1300');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `estado` int(2) DEFAULT 1,
  `telefono` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `correo`, `pass`, `estado`, `telefono`) VALUES
(1, 'admin', 'hamer', 'ham@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, NULL),
(3, 'admin2', 'joel', 'ffgv@gamil.com', '123', 0, NULL),
(4, 'ssd', 'ddd', 'sgdg@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, '123456789'),
(5, 'hamjo', 'Hame4', 'hamer12@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, '983866371'),
(6, 'isban', 'reyes', 'iban12@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, '1234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anticipo`
--
ALTER TABLE `anticipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bono`
--
ALTER TABLE `bono`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipoBono` (`id_tipoBono`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idArea` (`id_area`);

--
-- Indexes for table `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipoDescuento` (`id_tipoDescuento`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indexes for table `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indexes for table `planillas`
--
ALTER TABLE `planillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empleado` (`id_empleado`);

--
-- Indexes for table `telefonoempleado`
--
ALTER TABLE `telefonoempleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indexes for table `tipobono`
--
ALTER TABLE `tipobono`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipodescuento`
--
ALTER TABLE `tipodescuento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anticipo`
--
ALTER TABLE `anticipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bono`
--
ALTER TABLE `bono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `descuento`
--
ALTER TABLE `descuento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `planillas`
--
ALTER TABLE `planillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telefonoempleado`
--
ALTER TABLE `telefonoempleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipobono`
--
ALTER TABLE `tipobono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tipodescuento`
--
ALTER TABLE `tipodescuento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anticipo`
--
ALTER TABLE `anticipo`
  ADD CONSTRAINT `anticipo_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);

--
-- Constraints for table `bono`
--
ALTER TABLE `bono`
  ADD CONSTRAINT `bono_ibfk_1` FOREIGN KEY (`id_tipoBono`) REFERENCES `tipobono` (`id`),
  ADD CONSTRAINT `bono_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);

--
-- Constraints for table `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `fk_idArea` FOREIGN KEY (`id_area`) REFERENCES `area` (`id`);

--
-- Constraints for table `descuento`
--
ALTER TABLE `descuento`
  ADD CONSTRAINT `descuento_ibfk_1` FOREIGN KEY (`id_tipoDescuento`) REFERENCES `tipodescuento` (`id`),
  ADD CONSTRAINT `descuento_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);

--
-- Constraints for table `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`);

--
-- Constraints for table `planillas`
--
ALTER TABLE `planillas`
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);

--
-- Constraints for table `telefonoempleado`
--
ALTER TABLE `telefonoempleado`
  ADD CONSTRAINT `telefonoempleado_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
