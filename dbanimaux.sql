-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 21 jan. 2024 à 11:38
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbanimaux`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `animal_id` int NOT NULL AUTO_INCREMENT,
  `animal_nom` varchar(250) NOT NULL,
  `animal_description` text NOT NULL,
  `animal_image` varchar(250) NOT NULL,
  `famille_id` int NOT NULL,
  PRIMARY KEY (`animal_id`),
  KEY `FK_ANIMAL_FAMILLE` (`famille_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_nom`, `animal_description`, `animal_image`, `famille_id`) VALUES
(1, 'Chien', 'Un animal domestique', 'chien.png', 1),
(2, 'Cochon', 'Un animal de la ferme', 'cochon.png', 1),
(3, 'Serpent', 'Un animal dangereux', 'serpent.png', 2),
(4, 'Crocodile', 'Un animal très dangereux', 'croco.png', 2),
(5, 'Requin', 'Un animal marin très dangereux', 'requin.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `animal_continent`
--

DROP TABLE IF EXISTS `animal_continent`;
CREATE TABLE IF NOT EXISTS `animal_continent` (
  `animal_id` int NOT NULL,
  `continent_id` int NOT NULL,
  PRIMARY KEY (`animal_id`,`continent_id`),
  KEY `FK_CONTINENT_ANIMAL_CONTINENT` (`continent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `animal_continent`
--

INSERT INTO `animal_continent` (`animal_id`, `continent_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(5, 2),
(1, 3),
(3, 3),
(4, 3),
(1, 4),
(3, 4),
(4, 4),
(1, 5),
(2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

DROP TABLE IF EXISTS `continent`;
CREATE TABLE IF NOT EXISTS `continent` (
  `continent_id` int NOT NULL AUTO_INCREMENT,
  `continent_libelle` varchar(250) NOT NULL,
  PRIMARY KEY (`continent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `continent`
--

INSERT INTO `continent` (`continent_id`, `continent_libelle`) VALUES
(1, 'Europe'),
(2, 'Asie'),
(3, 'Afrique'),
(4, 'Océanie'),
(5, 'Amérique');

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

DROP TABLE IF EXISTS `famille`;
CREATE TABLE IF NOT EXISTS `famille` (
  `famille_id` int NOT NULL AUTO_INCREMENT,
  `famille_libelle` varchar(250) NOT NULL,
  `famille_description` text NOT NULL,
  PRIMARY KEY (`famille_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`famille_id`, `famille_libelle`, `famille_description`) VALUES
(1, 'mammifères', 'Animaux vertébrés nourrissant leurs petits avec du lait'),
(2, 'reptiles', 'animaux vertébrés qui rampent'),
(3, 'poissons', 'Animaux invertébrés du monde aquatique');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `FK_ANIMAL_FAMILLE` FOREIGN KEY (`famille_id`) REFERENCES `famille` (`famille_id`);

--
-- Contraintes pour la table `animal_continent`
--
ALTER TABLE `animal_continent`
  ADD CONSTRAINT `FK_ANIMAL_ANIMAL_CONTINENT` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `FK_CONTINENT_ANIMAL_CONTINENT` FOREIGN KEY (`continent_id`) REFERENCES `continent` (`continent_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
