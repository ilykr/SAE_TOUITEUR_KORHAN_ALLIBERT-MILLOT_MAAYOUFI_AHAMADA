-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 03 nov. 2026 à 15:02
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Touiteur`
--
CREATE DATABASE IF NOT EXISTS `Touiteur` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Touiteur`;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `description` varchar(50) NOT NULL,
  `chemin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` varchar(10) NOT NULL,
  `libelle` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `touite`
--

CREATE TABLE `touite` (
  `utilisateur` varchar(20) NOT NULL,
  `texte` varchar(235) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `touitetag`
--

CREATE TABLE `touitetag` (
  `utilisateur` varchar(20) NOT NULL,
  `texte` varchar(235) NOT NULL,
  `id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `nb` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`chemin`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `touite`
--
ALTER TABLE `touite`
  ADD PRIMARY KEY (`utilisateur`,`texte`),
  ADD KEY `fk_image` (`image`);

--
-- Index pour la table `touitetag`
--
ALTER TABLE `touitetag`
  ADD PRIMARY KEY (`utilisateur`,`texte`,`id`),
  ADD KEY `fk_tags` (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`mail`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `touite`
--
ALTER TABLE `touite`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`image`) REFERENCES `image` (`chemin`),
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`mail`);

--
-- Contraintes pour la table `touitetag`
--
ALTER TABLE `touitetag`
  ADD CONSTRAINT `fk_tags` FOREIGN KEY (`id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `fk_touite` FOREIGN KEY (`utilisateur`,`texte`) REFERENCES `TOUITE` (`utilisateur`, `texte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
