-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-salimata00.alwaysdata.net
-- Generation Time: May 19, 2024 at 10:45 PM
-- Server version: 10.6.16-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salimata00_khaaliss`
--

-- --------------------------------------------------------

--
-- Table structure for table `addclient`
--

CREATE TABLE `addclient` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `statut` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addclient`
--

INSERT INTO `addclient` (`id`, `prenom`, `nom`, `email`, `statut`) VALUES
(13, 'Marie', 'ND', 'marie@gmail.com', 'actif'),
(14, 'Tima', 'ND', 'tima@gmail.com', 'inactif'),
(15, 'Abi', 'Koné', 'abikone@gmail.com', 'actif'),
(16, 'Fatou', 'Sylla', 'fatou@gmail.com', 'inactif');

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `pwd` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`id`, `prenom`, `nom`, `email`, `numero`, `pwd`) VALUES
(5, 'Salima', 'Ndiaye', 'salimandiaye@gmail.com', '558652355', 'sali');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `prenom`, `nom`, `email`, `numero`, `pwd`) VALUES
(30, 'Timaa', 'ND', 'tima@gmail.com', '770101010', '$2y$10$ebf1SAC..mjS3LXDndetJ.4wJs04nd1udNvyVmnlFpLJV/6VxZdVG'),
(31, 'Abi', 'Koné', 'abikone@gmail.com', '78522365', '$2y$10$S9sktm/P4fjripYSigEZAOSQIG3PZOyvYf.qbq/dqcV3M0W7YYY7m'),
(32, 'Fatou', 'Sylla', 'fatou@gmail.com', '555632', '$2y$10$zcHV5X0tRqMfGSJDC9UgNuRsoDxrAnAPNI1rSMKtMk0Xdn5bvkEVS');

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `solde` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id`, `idClient`, `solde`) VALUES
(119, 29, 0),
(120, 30, 50000),
(121, 31, 5500),
(122, 32, 24500),
(123, 33, 4492393);

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
  `idOperation` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idCompte` int(11) NOT NULL,
  `solde` double NOT NULL,
  `nomOperation` varchar(50) NOT NULL,
  `montantOperation` float NOT NULL,
  `dateOperation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` (`idOperation`, `idClient`, `idCompte`, `solde`, `nomOperation`, `montantOperation`, `dateOperation`) VALUES
(12, 30, 120, 50000, 'DEPOT', 50000, '2024-05-19'),
(13, 30, 120, 40000, 'RETRAIT', 10000, '2024-05-19'),
(14, 30, 120, 30000, 'RETRAIT', 10000, '2024-05-19'),
(15, 30, 120, 50000, 'DEPOT', 20000, '2024-05-19'),
(16, 31, 121, 5000, 'DEPOT', 5000, '2024-05-19'),
(17, 31, 121, 4500, 'RETRAIT', 500, '2024-05-19'),
(18, 31, 121, 5500, 'DEPOT', 1000, '2024-05-19'),
(19, 32, 122, 10000, 'DEPOT', 10000, '2024-05-19'),
(20, 32, 122, 9500, 'RETRAIT', 500, '2024-05-19'),
(21, 32, 122, 24500, 'DEPOT', 15000, '2024-05-19'),
(22, 33, 123, 4555554, 'DEPOT', 4555550, '2024-05-19'),
(23, 33, 123, 4560076, 'DEPOT', 4522, '2024-05-19'),
(24, 33, 123, 4491511, 'RETRAIT', 68565, '2024-05-19'),
(25, 33, 123, 4491763, 'DEPOT', 252, '2024-05-19'),
(26, 33, 123, 4491541, 'RETRAIT', 222, '2024-05-19'),
(27, 33, 123, 4492393, 'DEPOT', 852, '2024-05-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addclient`
--
ALTER TABLE `addclient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`idOperation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addclient`
--
ALTER TABLE `addclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `operation`
--
ALTER TABLE `operation`
  MODIFY `idOperation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
