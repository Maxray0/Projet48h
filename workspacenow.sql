-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 avr. 2023 à 12:36
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `workspacenow`
--

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Dates` text NOT NULL,
  `SchoolId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`Id`, `Name`, `Dates`, `SchoolId`) VALUES
(1, 'Salle 1', '2023-04-15 16:00:00/2023-04-15 18:00:00', 1),
(2, 'Salle 2', '2023-04-15 12:00:00/2023-04-15 14:00:00', 1),
(3, 'Salle 3', '2023-04-16 16:00:00/2023-04-16 18:00:00', 1),
(4, 'Salle 4', '2023-04-16 12:00:00/2023-04-16 14:00:00', 1),
(5, 'Salle 5', '2023-04-17 18:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `SchoolName` varchar(255) NOT NULL,
  `Rooms` text NOT NULL,
  `Code` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `school`
--

INSERT INTO `school` (`Id`, `SchoolName`, `Rooms`, `Code`) VALUES
(1, 'Ynov-Lyon', '1/2/3/4/5', 'A1B2C3');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `EncryptedPassword` varchar(255) NOT NULL,
  `SchoolId` int(11) NOT NULL,
  `UserType` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id`, `Email`, `EncryptedPassword`, `SchoolId`, `UserType`) VALUES
(1, 'admin@gmail.com', 'admin', 0, 1),
(2, 'directeur@gmail.com', 'directeur', 1, 2),
(3, 'eleve1@gmail.com', 'eleve1', 1, 3),
(4, 'eleve2@gmail.com', 'eleve2', 1, 3),
(5, 'eleve3@gmail.com', 'eleve3', 1, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
