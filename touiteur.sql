-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2026 at 03:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Touiteur`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `description` varchar(50) NOT NULL,
  `chemin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` varchar(10) NOT NULL,
  `libelle` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `touite`
--

CREATE TABLE `touite` (
  `utilisateur` varchar(20) NOT NULL,
  `texte` varchar(235) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `touitetag`
--

CREATE TABLE `touitetag` (
  `utilisateur` varchar(20) NOT NULL,
  `texte` varchar(235) NOT NULL,
  `id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `nb` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`chemin`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `touite`
--
ALTER TABLE `touite`
  ADD PRIMARY KEY (`utilisateur`,`texte`),
  ADD KEY `fk_image` (`image`);

--
-- Indexes for table `touitetag`
--
ALTER TABLE `touitetag`
  ADD PRIMARY KEY (`utilisateur`,`texte`,`id`),
  ADD KEY `fk_tags` (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`mail`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `touite`
--
ALTER TABLE `touite`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`image`) REFERENCES `image` (`chemin`),
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`mail`);

--
-- Constraints for table `touitetag`
--
ALTER TABLE `touitetag`
  ADD CONSTRAINT `fk_tags` FOREIGN KEY (`id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `fk_utilisateurtexte` FOREIGN KEY (`utilisateur`,`texte`) REFERENCES `touite` (`utilisateur`, `texte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
