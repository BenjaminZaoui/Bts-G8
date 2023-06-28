-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : mer. 28 juin 2023 à 17:19
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `HelpOrt`
--

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `ID` int NOT NULL,
  `Matiere` varchar(20) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Nature` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `id_assistant` varchar(20) NOT NULL,
  `id_assiste` varchar(20) NOT NULL,
  `etat` varchar(30) NOT NULL,
  `Intitule` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`ID`, `Matiere`, `Description`, `Nature`, `Date`, `Heure`, `id_assistant`, `id_assiste`, `etat`, `Intitule`) VALUES
(1, 'français', 'blabla 1', 'jsp', '2023-06-12', '18:40:24', '5', '1', 'en cours de traitement ', 'le Poulet'),
(7, 'math', 'lknljhg', 'jsp', '2023-06-29', '20:48:00', '0', '1', 'en attante d\'un assistant', 'pedidosYa'),
(12, 'math', '--->--->--->--->', 'jsp', '2023-07-01', '06:46:00', '0', '1', 'en attante d\'un assistant', 'OUROBOROS '),
(13, 'math', 'MI GUSTAS Y MANANAS ', 'jsp', '2023-06-30', '00:46:00', '0', '1', 'en attante d\'un assistant', 'AMIGOS');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `NOM` varchar(20) NOT NULL,
  `PRENOM` varchar(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `ROLE` varchar(20) NOT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `Niveau` varchar(20) NOT NULL,
  `MotDePasse` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `DateDeCreation` date NOT NULL,
  `DateMiseAJour` text NOT NULL,
  `typeCompte` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `NOM`, `PRENOM`, `EMAIL`, `ROLE`, `Pseudo`, `Niveau`, `MotDePasse`, `DateDeCreation`, `DateMiseAJour`, `typeCompte`) VALUES
(1, 'ZAOUI', 'Benjamin', 'benjaminzaoui6@gmail.com', '', 'Bzaoui', '1TSSIOB', 'f0b661755f30bea0000b01e18c4fe28248c76dc77013355377cc0ea420c7ffd044dc7683deb3bd44b610b9c6ed92de37662209eaa60a82b91eb1e5915690cd4e', '2023-06-28', '', 'E');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
