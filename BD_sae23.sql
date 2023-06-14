-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 14 Juin 2023 à 10:32
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sae23`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administration`
--

CREATE TABLE IF NOT EXISTS `Administration` (
  `Login` varchar(30) NOT NULL,
  `MDP` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Administration`
--

INSERT INTO `Administration` (`Login`, `MDP`) VALUES
('Admin', 'passroot');

-- --------------------------------------------------------

--
-- Structure de la table `Batiment`
--

CREATE TABLE IF NOT EXISTS `Batiment` (
  `CodeBat` int(30) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `MDP` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Batiment`
--

INSERT INTO `Batiment` (`CodeBat`, `Nom`, `Login`, `MDP`) VALUES
(1, 'RT', 'Admin', 'Passroot');

-- --------------------------------------------------------

--
-- Structure de la table `Capteur`
--

CREATE TABLE IF NOT EXISTS `Capteur` (
  `CodeCapt` int(30) NOT NULL,
  `Salle` varchar(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `CodeBat` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Capteur`
--

INSERT INTO `Capteur` (`CodeCapt`, `Salle`, `Type`, `CodeBat`) VALUES
(1, 'E201', 'Température', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Mesure`
--

CREATE TABLE IF NOT EXISTS `Mesure` (
`CodeMes` int(30) NOT NULL,
  `Date` datetime DEFAULT CURRENT_TIMESTAMP,
  `Horaire` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Valeur` float NOT NULL,
  `CodeCapt` int(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `Mesure`
--

INSERT INTO `Mesure` (`CodeMes`, `Date`, `Horaire`, `Valeur`, `CodeCapt`) VALUES
(13, '2023-06-11 00:00:00', '2023-06-11 16:15:50', 5, 1),
(14, '2023-06-11 00:00:00', '2023-06-11 16:29:06', 5, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Batiment`
--
ALTER TABLE `Batiment`
 ADD PRIMARY KEY (`CodeBat`);

--
-- Index pour la table `Capteur`
--
ALTER TABLE `Capteur`
 ADD PRIMARY KEY (`CodeCapt`), ADD KEY `clef_CodeBat` (`CodeBat`);

--
-- Index pour la table `Mesure`
--
ALTER TABLE `Mesure`
 ADD PRIMARY KEY (`CodeMes`), ADD KEY `clef_CodeCapt` (`CodeCapt`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Mesure`
--
ALTER TABLE `Mesure`
MODIFY `CodeMes` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Capteur`
--
ALTER TABLE `Capteur`
ADD CONSTRAINT `clef_CodeBat` FOREIGN KEY (`CodeBat`) REFERENCES `Batiment` (`CodeBat`);

--
-- Contraintes pour la table `Mesure`
--
ALTER TABLE `Mesure`
ADD CONSTRAINT `clef_CodeCapt` FOREIGN KEY (`CodeCapt`) REFERENCES `Capteur` (`CodeCapt`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
