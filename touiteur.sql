-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 04 nov. 2026 à 11:22
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

-- --------------------------------------------------------

--
-- Structure de la table `Image`
--

CREATE TABLE `Image` (
  `DESCRIPTION` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL,
  `CHEMIN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Tags`
--

CREATE TABLE `Tags` (
  `LIBELLE` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `touite`
--

CREATE TABLE `touite` (
  `IDUSER` int(11) NOT NULL,
  `TEXTE` varchar(235) DEFAULT NULL,
  `DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `IDIMAGE` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Touitetags`
--

CREATE TABLE `Touitetags` (
  `IDUSER` int(11) NOT NULL,
  `TEXTE` varchar(235) DEFAULT NULL,
  `IDTAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `NOM` varchar(20) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `PRENOM` varchar(20) DEFAULT NULL,
  `MAIL` varchar(50) DEFAULT NULL,
  `NB` int(11) DEFAULT NULL,
  `USERNAME` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `touite`
--
ALTER TABLE `touite`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_image` (`IDIMAGE`),
  ADD KEY `fk_utilisateur` (`IDUSER`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Image`
--
ALTER TABLE `Image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `touite`
--
ALTER TABLE `touite`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `touite`
--
ALTER TABLE `touite`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`IDIMAGE`) REFERENCES `image` (`ID`),
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`IDUSER`) REFERENCES `utilisateur` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
