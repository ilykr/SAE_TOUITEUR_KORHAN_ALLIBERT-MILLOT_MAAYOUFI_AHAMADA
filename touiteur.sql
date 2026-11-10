-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 10 nov. 2026 à 07:17
-- Version du serveur : 12.3.3-MariaDB-ubu2404
-- Version de PHP : 8.3.33

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
  `CHEMIN` varchar(235) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Image`
--

INSERT INTO `Image` (`DESCRIPTION`, `ID`, `CHEMIN`) VALUES
('sunna', 4, 'img/sunna.jpeg'),
('Robin', 5, 'img/Robin.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `Tags`
--

CREATE TABLE `Tags` (
  `LIBELLE` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Tags`
--

INSERT INTO `Tags` (`LIBELLE`, `ID`, `DESCRIPTION`) VALUES
('#test', 16, 'test mais c\'est mieux'),
('#try', 17, 'essai'),
('#randomkid', 18, '');

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

--
-- Déchargement des données de la table `touite`
--

INSERT INTO `touite` (`IDUSER`, `TEXTE`, `DATE`, `IDIMAGE`, `ID`) VALUES
(3, 'ahaaha', '2026-11-04 10:35:36', NULL, 1),
(3, 'dude are you real?', '2026-11-05 14:59:08', NULL, 2),
(4, 'dude, i think i am?', '2026-11-05 14:59:33', NULL, 3),
(5, 'that\'s actually some pretty solid evidence', '2026-11-05 15:00:09', NULL, 4),
(4, 'René Descartes???!', '2026-11-05 15:00:29', NULL, 5),
(3, 'René Descartes???!', '2026-11-05 15:00:47', NULL, 6),
(6, 'has anyone seen sunna?', '2026-11-07 22:48:29', NULL, 7),
(6, 'Stop saying I\'m a clanker, it\'s very inappropriate', '2026-11-08 17:36:52', NULL, 8),
(7, 'lod#l', '2026-11-08 18:10:06', NULL, 9),
(7, 'idk bro #try', '2026-11-08 18:33:48', NULL, 10),
(8, 'wat about now #try', '2026-11-09 15:28:53', NULL, 12),
(9, 'i am inside of a bus rn #randomkid', '2026-11-09 15:30:27', NULL, 13),
(10, 'who is this random kid????? #randomkid', '2026-11-09 16:59:25', 4, 14),
(10, 'who is this random kid????? #randomkid', '2026-11-09 17:00:23', 4, 15);

-- --------------------------------------------------------

--
-- Structure de la table `Touitetags`
--

CREATE TABLE `Touitetags` (
  `IDTOUITE` int(11) NOT NULL,
  `IDTAG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Touitetags`
--

INSERT INTO `Touitetags` (`IDTOUITE`, `IDTAG`) VALUES
(10, 17),
(12, 17),
(13, 18),
(14, 18),
(15, 18);

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
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`NOM`, `ID`, `PRENOM`, `MAIL`, `NB`, `USERNAME`) VALUES
(NULL, 3, NULL, NULL, NULL, 'mld'),
(NULL, 4, NULL, NULL, NULL, 'mlb'),
(NULL, 5, NULL, NULL, NULL, 'René Descartes'),
(NULL, 6, NULL, NULL, NULL, 'Aria'),
(NULL, 7, NULL, NULL, NULL, 'unwise'),
(NULL, 8, NULL, NULL, NULL, 'john doe'),
(NULL, 9, NULL, NULL, NULL, 'sunna'),
(NULL, 10, NULL, NULL, NULL, 'robin');

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
-- Index pour la table `Touitetags`
--
ALTER TABLE `Touitetags`
  ADD KEY `fk_tags` (`IDTAG`),
  ADD KEY `fk_touites` (`IDTOUITE`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `touite`
--
ALTER TABLE `touite`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `touite`
--
ALTER TABLE `touite`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`IDIMAGE`) REFERENCES `Image` (`ID`),
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`IDUSER`) REFERENCES `Utilisateur` (`ID`);

--
-- Contraintes pour la table `Touitetags`
--
ALTER TABLE `Touitetags`
  ADD CONSTRAINT `fk_tags` FOREIGN KEY (`IDTAG`) REFERENCES `Tags` (`ID`),
  ADD CONSTRAINT `fk_touites` FOREIGN KEY (`IDTOUITE`) REFERENCES `touite` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
