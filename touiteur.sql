-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : ven. 13 nov. 2026 à 18:02
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
-- Structure de la table `Abonnement`
--

CREATE TABLE `Abonnement` (
  `IDUSER` int(11) NOT NULL,
  `IDFOLLOW` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Abonnement`
--

INSERT INTO `Abonnement` (`IDUSER`, `IDFOLLOW`) VALUES
(2, 1),
(3, 1),
(1, 3),
(4, 1),
(1, 3),
(4, 3),
(2, 3),
(5, 3),
(4, 6),
(1, 6);

--
-- Déclencheurs `Abonnement`
--
DELIMITER $$
CREATE TRIGGER `trigger_verif_auto_suivi` BEFORE INSERT ON `Abonnement` FOR EACH ROW BEGIN
    IF NEW.IDUSER = NEW.IDFOLLOW THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Action interdite : Un utilisateur ne peut pas se suivre lui-même.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `AboTag`
--

CREATE TABLE `AboTag` (
  `IDUSER` int(11) NOT NULL,
  `IDTAG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `AboTag`
--

INSERT INTO `AboTag` (`IDUSER`, `IDTAG`) VALUES
(3, 1),
(4, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Image`
--

CREATE TABLE `Image` (
  `DESCRIPTION` varchar(50) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `CHEMIN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Image`
--

INSERT INTO `Image` (`DESCRIPTION`, `ID`, `CHEMIN`) VALUES
('Robin', 1, 'img/Robin.jpeg'),
('sunna', 2, 'img/sunna.jpeg'),
('randomkid', 3, 'img/randomkid.gif');

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
('#randomkid', 1, 'poperidu type shi'),
('#test', 2, 'testing'),
('#t', 3, ''),
('#l', 4, ''),
('#i', 5, ''),
('#m', 6, '');

-- --------------------------------------------------------

--
-- Structure de la table `Touite`
--

CREATE TABLE `Touite` (
  `IDUSER` int(11) NOT NULL,
  `TEXTE` varchar(235) NOT NULL,
  `DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `IDIMAGE` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Touite`
--

INSERT INTO `Touite` (`IDUSER`, `TEXTE`, `DATE`, `IDIMAGE`, `ID`) VALUES
(1, 'where is sunna? #randomkid', '2026-11-10 09:30:14', 2, 5),
(3, 'met this lady on the bus', '2026-11-10 09:34:48', 1, 6),
(5, 'dqdq', '2026-11-10 13:46:06', 1, 12),
(5, 'tesst', '2026-11-10 13:46:26', 2, 13),
(1, 'count again', '2026-11-10 13:53:25', 1, 14),
(1, 'image test', '2026-11-10 14:02:58', NULL, 16),
(3, '#t #l #i #m', '2026-11-12 08:09:31', NULL, 17),
(6, 'this might be the best gif i have ever seen\r\n\r\n#randomkid', '2026-11-13 17:40:30', 3, 18);

--
-- Déclencheurs `Touite`
--
DELIMITER $$
CREATE TRIGGER `trigger_bloquer_changement_auteur` BEFORE UPDATE ON `Touite` FOR EACH ROW BEGIN
    IF OLD.IDUSER != NEW.IDUSER THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Action interdite : Un touite conserve son auteur initial.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_limite_touites_jour` BEFORE INSERT ON `Touite` FOR EACH ROW BEGIN
    DECLARE v_nb_touites INT DEFAULT 0;

    SELECT COUNT(*) INTO v_nb_touites
    FROM Touite
    WHERE IDUSER = NEW.IDUSER
      AND DATE(`DATE`) = CURRENT_DATE;

    IF v_nb_touites >= 50 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Limite atteinte : Vous ne pouvez pas publier plus de 50 touites par jour.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_maj_nb_touites` AFTER INSERT ON `Touite` FOR EACH ROW BEGIN
    UPDATE Utilisateur
    SET NBTOUITES = IFNULL(NBTOUITES, 0) + 1
    WHERE Utilisateur.ID = NEW.IDUSER;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `TouiteTags`
--

CREATE TABLE `TouiteTags` (
  `IDTAG` int(11) DEFAULT NULL,
  `IDTOUITE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TouiteTags`
--

INSERT INTO `TouiteTags` (`IDTAG`, `IDTOUITE`) VALUES
(1, 5),
(3, 17),
(4, 17),
(5, 17),
(6, 17),
(1, 18);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `NOM` varchar(20) DEFAULT NULL,
  `ID` int(11) NOT NULL,
  `PRENOM` varchar(20) DEFAULT NULL,
  `MAIL` varchar(50) DEFAULT NULL,
  `nbtouites` int(11) NOT NULL DEFAULT 0,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`NOM`, `ID`, `PRENOM`, `MAIL`, `nbtouites`, `username`) VALUES
(NULL, 1, NULL, NULL, 2, 'aria'),
(NULL, 2, NULL, NULL, 0, 'sonbringer'),
(NULL, 3, NULL, NULL, 1, 'sunna'),
(NULL, 4, NULL, NULL, 0, 'lycaon'),
(NULL, 5, NULL, NULL, 0, 'new guy'),
(NULL, 6, NULL, NULL, 1, 'PopEridu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Abonnement`
--
ALTER TABLE `Abonnement`
  ADD KEY `fk_abonnement_follow` (`IDUSER`),
  ADD KEY `fk_abonnement_following` (`IDFOLLOW`);

--
-- Index pour la table `AboTag`
--
ALTER TABLE `AboTag`
  ADD KEY `fk_tag` (`IDTAG`),
  ADD KEY `fk_usertag` (`IDUSER`);

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
-- Index pour la table `Touite`
--
ALTER TABLE `Touite`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_image` (`IDIMAGE`),
  ADD KEY `fk_utilisateur` (`IDUSER`);

--
-- Index pour la table `TouiteTags`
--
ALTER TABLE `TouiteTags`
  ADD KEY `fk_touite` (`IDTOUITE`),
  ADD KEY `fk_tags` (`IDTAG`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `un_utilisateur_username` (`username`),
  ADD UNIQUE KEY `un_utilisateur_id` (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Image`
--
ALTER TABLE `Image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Touite`
--
ALTER TABLE `Touite`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Abonnement`
--
ALTER TABLE `Abonnement`
  ADD CONSTRAINT `fk_abonnement_following` FOREIGN KEY (`IDFOLLOW`) REFERENCES `Utilisateur` (`ID`),
  ADD CONSTRAINT `fk_abonnement_user` FOREIGN KEY (`IDUSER`) REFERENCES `Utilisateur` (`ID`);

--
-- Contraintes pour la table `AboTag`
--
ALTER TABLE `AboTag`
  ADD CONSTRAINT `fk_tag` FOREIGN KEY (`IDTAG`) REFERENCES `Tags` (`ID`),
  ADD CONSTRAINT `fk_usertag` FOREIGN KEY (`IDUSER`) REFERENCES `Utilisateur` (`ID`);

--
-- Contraintes pour la table `Touite`
--
ALTER TABLE `Touite`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`IDIMAGE`) REFERENCES `Image` (`ID`),
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`IDUSER`) REFERENCES `Utilisateur` (`ID`);

--
-- Contraintes pour la table `TouiteTags`
--
ALTER TABLE `TouiteTags`
  ADD CONSTRAINT `fk_tags` FOREIGN KEY (`IDTAG`) REFERENCES `Tags` (`ID`),
  ADD CONSTRAINT `fk_touite` FOREIGN KEY (`IDTOUITE`) REFERENCES `Touite` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
