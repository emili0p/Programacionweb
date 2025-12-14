-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2025 at 10:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiendalinux`
--

-- --------------------------------------------------------

--
-- Table structure for table `Compatibilidad`
--

CREATE TABLE `Compatibilidad` (
  `id_compatibilidad` int(11) NOT NULL,
  `id_laptop` int(11) DEFAULT NULL,
  `id_distribucion` int(11) DEFAULT NULL,
  `nivel` enum('Excelente','Buena','Parcial','No Compatible') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Compatibilidad`
--

INSERT INTO `Compatibilidad` (`id_compatibilidad`, `id_laptop`, `id_distribucion`, `nivel`) VALUES
(3, 3, 4, 'Excelente');

-- --------------------------------------------------------

--
-- Table structure for table `DistribucionLinux`
--

CREATE TABLE `DistribucionLinux` (
  `id_distribucion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `sitio_oficial` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DistribucionLinux`
--

INSERT INTO `DistribucionLinux` (`id_distribucion`, `nombre`, `version`, `tipo`, `sitio_oficial`) VALUES
(3, 'Arch', '2025.12.01', 'Rolling', 'https://archlinux.org/'),
(4, 'Ejemplo\"', '2.0', 'Rolling', 'https://www.google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `Laptop`
--

CREATE TABLE `Laptop` (
  `id_laptop` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `procesador` varchar(100) DEFAULT NULL,
  `memoria_ram` varchar(50) DEFAULT NULL,
  `almacenamiento` varchar(100) DEFAULT NULL,
  `pantalla` varchar(100) DEFAULT NULL,
  `estado_libreboot` enum('Sí','No') DEFAULT 'No',
  `descripcion` text DEFAULT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Laptop`
--

INSERT INTO `Laptop` (`id_laptop`, `nombre`, `marca`, `modelo`, `precio`, `procesador`, `memoria_ram`, `almacenamiento`, `pantalla`, `estado_libreboot`, `descripcion`, `imagen_principal`) VALUES
(1, 'Thinkpad', 'IBM', 'x220', 2200.00, 'i7 3700k ', ' 8GB DDR3', '240 GB SDD', 'LCD 14\"', 'Sí', 'Hermosa thinkpad librebooteda lista para un sistema operativo libre ', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrlY7H9oeoRdh93pswAX4-HVVIHa6GQ5jHVw&s'),
(2, 'HP EliteBook', 'HP', '840 G11', 5000.00, 'i7 7700k', '16', '240 GB SDD', 'LCD 14\"', 'No', 'Lista para trabajar', 'https://kaas.hpcloud.hp.com/PROD/v2/renderbinary/13318573/10277024/com-win-nb-p-elitebook-840-g11-baymax14-product-specification/com-nb-elitebook-g11-baymax-product-image'),
(3, 'HP', 'HP', 'ProBook', 4000.00, 'i5 14000', '8GB DDR3', '512 GB SSD', 'LCD 16\"', 'No', 'Bonita laptop', '');

-- --------------------------------------------------------

--
-- Table structure for table `Pedido`
--

CREATE TABLE `Pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_laptop` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` enum('Pendiente','En proceso','Enviado','Entregado','Cancelado') NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Pedido`
--

INSERT INTO `Pedido` (`id_pedido`, `id_usuario`, `id_laptop`, `fecha`, `estado`) VALUES
(1, 1, 1, '2022-12-09', 'Entregado'),
(4, 4, 2, '2025-12-11', 'Pendiente'),
(6, 4, 1, '2025-12-11', 'Pendiente');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`id_usuario`, `nombre`, `correo`, `telefono`, `password`) VALUES
(1, 'Emilio Izquierdo Montero', 'cucusneitor@hotmail.com', '4888853864', ''),
(2, 'JSON', 'json@example.com', '984984309', ''),
(4, 'luisoliva', 'luiscorreo@hotmail.com', '1234567890', '$2y$12$e33vbsEp.RNsuV55MFJnyuJwZpTQfzSnD2i3YO8ufnj9xBGfNPLEC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Compatibilidad`
--
ALTER TABLE `Compatibilidad`
  ADD PRIMARY KEY (`id_compatibilidad`),
  ADD KEY `id_laptop` (`id_laptop`),
  ADD KEY `id_distribucion` (`id_distribucion`);

--
-- Indexes for table `DistribucionLinux`
--
ALTER TABLE `DistribucionLinux`
  ADD PRIMARY KEY (`id_distribucion`);

--
-- Indexes for table `Laptop`
--
ALTER TABLE `Laptop`
  ADD PRIMARY KEY (`id_laptop`);

--
-- Indexes for table `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_laptop` (`id_laptop`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Compatibilidad`
--
ALTER TABLE `Compatibilidad`
  MODIFY `id_compatibilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `DistribucionLinux`
--
ALTER TABLE `DistribucionLinux`
  MODIFY `id_distribucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Laptop`
--
ALTER TABLE `Laptop`
  MODIFY `id_laptop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Compatibilidad`
--
ALTER TABLE `Compatibilidad`
  ADD CONSTRAINT `Compatibilidad_ibfk_1` FOREIGN KEY (`id_laptop`) REFERENCES `Laptop` (`id_laptop`) ON DELETE CASCADE,
  ADD CONSTRAINT `Compatibilidad_ibfk_2` FOREIGN KEY (`id_distribucion`) REFERENCES `DistribucionLinux` (`id_distribucion`) ON DELETE CASCADE;

--
-- Constraints for table `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `Pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `Pedido_ibfk_2` FOREIGN KEY (`id_laptop`) REFERENCES `Laptop` (`id_laptop`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
