-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2021 at 01:55 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservi`
--

-- --------------------------------------------------------

--
-- Table structure for table `genusuario`
--

CREATE TABLE `genusuario` (
  `oid` int(11) NOT NULL COMMENT 'campo atuincremental',
  `genrol` int(11) NOT NULL COMMENT 'campo de rol de usuario por defeto en 1 para los recien creados',
  `usunombre` text NOT NULL COMMENT 'numero de documento del usuario',
  `usudescrip` text NOT NULL COMMENT 'nombre completo del usuario',
  `usuclave` text NOT NULL COMMENT 'clave encriptada',
  `usuemail` text NOT NULL COMMENT 'correo electronico',
  `usuemailen` text COMMENT 'correo encriptado',
  `usuverific` int(11) NOT NULL COMMENT 'verificacion de correo electronico',
  `usufoto` text COMMENT 'foto del usuario',
  `usutelefon` text COMMENT 'telefono del usuario',
  `usufirma` text COMMENT 'firma del usuario para futuro reporte',
  `usufecha` timestamp NULL DEFAULT NULL COMMENT 'fecha stamp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genusuario`
--

INSERT INTO `genusuario` (`oid`, `genrol`, `usunombre`, `usudescrip`, `usuclave`, `usuemail`, `usuemailen`, `usuverific`, `usufoto`, `usutelefon`, `usufirma`, `usufecha`) VALUES
(5, 1, '1121883909', 'HEDIER ALVAREZ OVALLE', '$2a$07$asxx54ahjppf17sd87a5au2F6SsAPP4MaLXa287K/xJLPpYQpmgMS', 'hedier.alvarez@gmail.com', '67688843ba933cc550ee060a79f1fdda', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `codigo_reserva` text NOT NULL,
  `descripcion_reserva` text NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genusuario`
--
ALTER TABLE `genusuario`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genusuario`
--
ALTER TABLE `genusuario`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'campo atuincremental', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
