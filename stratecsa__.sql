-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2016 at 12:52 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stratecsa%%`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes_stra`
--

CREATE TABLE `clientes_stra` (
  `Client_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Client_nomb` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Client_tel` int(10) NOT NULL,
  `Client_ext` int(3) NOT NULL,
  `Client_dire` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Client_tipo` enum('Natural','Empresa') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contrato`
--

CREATE TABLE `contrato` (
  `Id_contrat` int(11) NOT NULL,
  `Contra_id_client` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Contra_id_contr` int(11) NOT NULL,
  `Contra_stado` enum('Activo','No') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalles_fact`
--

CREATE TABLE `detalles_fact` (
  `Deta_id` int(11) NOT NULL,
  `Deta_id_fact` int(10) NOT NULL,
  `Deta_id_serv` int(11) NOT NULL,
  `Deta_cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factura_stra`
--

CREATE TABLE `factura_stra` (
  `Fact_id` int(11) NOT NULL,
  `Fact_id_client` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Fact_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fact_fecha_final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Fact_cancelado` enum('SI','NO') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servicios_prestado`
--

CREATE TABLE `servicios_prestado` (
  `Servi_id` int(11) NOT NULL,
  `Servi_id_tip` int(11) NOT NULL,
  `Servi_nomb` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Servi_cost` decimal(10,0) NOT NULL,
  `Servi_tiem` enum('dia','mes','trimestre','semestre','año') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servicio_contratado`
--

CREATE TABLE `servicio_contratado` (
  `Servi_id` int(11) NOT NULL,
  `Servi_tipo` int(11) NOT NULL,
  `Servi_prestad` int(11) NOT NULL,
  `Servi_fech_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Servi_fech_final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `Tipo_id` int(11) NOT NULL,
  `Tipo_nomb` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes_stra`
--
ALTER TABLE `clientes_stra`
  ADD PRIMARY KEY (`Client_id`);

--
-- Indexes for table `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`Id_contrat`),
  ADD KEY `Contra_id_client` (`Contra_id_client`),
  ADD KEY `Contra_id_contr` (`Contra_id_contr`);

--
-- Indexes for table `detalles_fact`
--
ALTER TABLE `detalles_fact`
  ADD PRIMARY KEY (`Deta_id`),
  ADD KEY `Deta_id_serv` (`Deta_id_serv`),
  ADD KEY `Deta_id_fact` (`Deta_id_fact`),
  ADD KEY `Deta_id_serv_2` (`Deta_id_serv`);

--
-- Indexes for table `factura_stra`
--
ALTER TABLE `factura_stra`
  ADD PRIMARY KEY (`Fact_id`),
  ADD KEY `Fact_id_client` (`Fact_id_client`);

--
-- Indexes for table `servicios_prestado`
--
ALTER TABLE `servicios_prestado`
  ADD PRIMARY KEY (`Servi_id`);

--
-- Indexes for table `servicio_contratado`
--
ALTER TABLE `servicio_contratado`
  ADD PRIMARY KEY (`Servi_id`);

--
-- Indexes for table `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`Tipo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contrato`
--
ALTER TABLE `contrato`
  MODIFY `Id_contrat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detalles_fact`
--
ALTER TABLE `detalles_fact`
  MODIFY `Deta_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factura_stra`
--
ALTER TABLE `factura_stra`
  MODIFY `Fact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servicios_prestado`
--
ALTER TABLE `servicios_prestado`
  MODIFY `Servi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servicio_contratado`
--
ALTER TABLE `servicio_contratado`
  MODIFY `Servi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `Tipo_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
