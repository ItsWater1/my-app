-- OM 2021.02.17
-- FICHIER MYSQL POUR FAIRE FONCTIONNER LES EXEMPLES
-- DE REQUETES MYSQL
-- Database: WUTHRICH_ARTHUR_INFO1A_JEUNESSE_164_2022

-- Détection si une autre base de donnée du même nom existe

DROP DATABASE IF EXISTS module151_jeunesse;

-- Création d'un nouvelle base de donnée

CREATE DATABASE IF NOT EXISTS module151_jeunesse;

-- Utilisation de cette base de donnée

USE module151_jeunesse;

-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 27 Mars 2024 à 10:59
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `module151_jeunesse`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_image`
--

CREATE TABLE `t_image` (
  `id_image` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_image`
--

INSERT INTO `t_image` (`id_image`, `filename`, `date`) VALUES
(8, '6603f30062cb2_Shunsui.jpg', '2024-03-02');

-- --------------------------------------------------------

--
-- Structure de la table `t_image_avoir_lieu`
--

CREATE TABLE `t_image_avoir_lieu` (
  `id_image_avoir_lieu` int(11) NOT NULL,
  `fk_image` int(11) NOT NULL,
  `fk_lieuimage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_image_avoir_lieu`
--

INSERT INTO `t_image_avoir_lieu` (`id_image_avoir_lieu`, `fk_image`, `fk_lieuimage`) VALUES
(8, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_lieu`
--

CREATE TABLE `t_lieu` (
  `id_lieu` int(11) NOT NULL,
  `NomLieu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_lieu`
--

INSERT INTO `t_lieu` (`id_lieu`, `NomLieu`) VALUES
(1, 'Treycovagnes'),
(2, 'Chamblon'),
(3, 'Champagne');

-- --------------------------------------------------------

--
-- Structure de la table `t_manif`
--

CREATE TABLE `t_manif` (
  `id_manif` int(11) NOT NULL,
  `Nom` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  `Benefice` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_manif`
--

INSERT INTO `t_manif` (`id_manif`, `Nom`, `Date`, `Benefice`) VALUES
(1, 'AG', '2024-01-12', NULL),
(2, 'Volley', '2024-03-16', NULL),
(3, 'Apero nouveaux', '2024-06-29', NULL),
(4, 'Repas soutient', '2024-10-11', NULL),
(5, 'Bal', '2024-11-16', NULL),
(6, 'Assemblee', '2024-01-24', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_manif_avoir_lieu`
--

CREATE TABLE `t_manif_avoir_lieu` (
  `id_manif_avoir_lieu` int(11) NOT NULL,
  `fk_manif` int(11) NOT NULL,
  `fk_lieu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_manif_avoir_lieu`
--

INSERT INTO `t_manif_avoir_lieu` (`id_manif_avoir_lieu`, `fk_manif`, `fk_lieu`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_manif_avoir_type`
--

CREATE TABLE `t_manif_avoir_type` (
  `id_manif_avoir_type` int(11) NOT NULL,
  `fk_manif` int(11) NOT NULL,
  `fk_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_manif_avoir_type`
--

INSERT INTO `t_manif_avoir_type` (`id_manif_avoir_type`, `fk_manif`, `fk_type`) VALUES
(1, 1, 3),
(2, 2, 1),
(3, 3, 4),
(4, 4, 2),
(5, 5, 5),
(6, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_type`
--

CREATE TABLE `t_type` (
  `id_type` int(11) NOT NULL,
  `TypeManif` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_type`
--

INSERT INTO `t_type` (`id_type`, `TypeManif`) VALUES
(1, 'Sport'),
(2, 'Repas'),
(3, 'Assemblee'),
(4, 'Apero'),
(5, 'Bal');

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

CREATE TABLE `t_utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `Mdp` varchar(100) NOT NULL,
  `Level` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`id_utilisateur`, `user`, `Mdp`, `Level`) VALUES
(1, 'admin', 'edb0ae31b7c16790842d4fc5aeb11b93c6353fba35e34609418265a97663bb48', 1),
(3, 'angelo.rogeiro@eduvaud.ch', '0dd92ed8e5681b5e75e5b04e2a2e517ba6ec1c4eba0834743d0d224cad16914e', 1),
(4, 'user', 'e9fa5be04a0299bef88a7f89d4489a070aa298894cfdf8a4ef47f599592d0450', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_image`
--
ALTER TABLE `t_image`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `t_image_avoir_lieu`
--
ALTER TABLE `t_image_avoir_lieu`
  ADD PRIMARY KEY (`id_image_avoir_lieu`),
  ADD KEY `fk_image` (`fk_image`),
  ADD KEY `fk_lieuimage` (`fk_lieuimage`);

--
-- Index pour la table `t_lieu`
--
ALTER TABLE `t_lieu`
  ADD PRIMARY KEY (`id_lieu`);

--
-- Index pour la table `t_manif`
--
ALTER TABLE `t_manif`
  ADD PRIMARY KEY (`id_manif`);

--
-- Index pour la table `t_manif_avoir_lieu`
--
ALTER TABLE `t_manif_avoir_lieu`
  ADD PRIMARY KEY (`id_manif_avoir_lieu`),
  ADD KEY `fk_manif` (`fk_manif`),
  ADD KEY `fk_lieu` (`fk_lieu`);

--
-- Index pour la table `t_manif_avoir_type`
--
ALTER TABLE `t_manif_avoir_type`
  ADD PRIMARY KEY (`id_manif_avoir_type`),
  ADD KEY `fk_manif` (`fk_manif`),
  ADD KEY `fk_type` (`fk_type`);

--
-- Index pour la table `t_type`
--
ALTER TABLE `t_type`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_image`
--
ALTER TABLE `t_image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_image_avoir_lieu`
--
ALTER TABLE `t_image_avoir_lieu`
  MODIFY `id_image_avoir_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_lieu`
--
ALTER TABLE `t_lieu`
  MODIFY `id_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `t_manif`
--
ALTER TABLE `t_manif`
  MODIFY `id_manif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_manif_avoir_lieu`
--
ALTER TABLE `t_manif_avoir_lieu`
  MODIFY `id_manif_avoir_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_manif_avoir_type`
--
ALTER TABLE `t_manif_avoir_type`
  MODIFY `id_manif_avoir_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_type`
--
ALTER TABLE `t_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_image_avoir_lieu`
--
ALTER TABLE `t_image_avoir_lieu`
  ADD CONSTRAINT `fk_image` FOREIGN KEY (`fk_image`) REFERENCES `t_image` (`id_image`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lieuimage` FOREIGN KEY (`fk_lieuimage`) REFERENCES `t_lieu` (`id_lieu`) ON DELETE CASCADE;

--
-- Contraintes pour la table `t_manif_avoir_lieu`
--
ALTER TABLE `t_manif_avoir_lieu`
  ADD CONSTRAINT `fk_manif` FOREIGN KEY (`fk_manif`) REFERENCES `t_manif` (`id_manif`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_manif_avoir_lieu_ibfk_1` FOREIGN KEY (`fk_manif`) REFERENCES `t_manif` (`id_manif`),
  ADD CONSTRAINT `t_manif_avoir_lieu_ibfk_2` FOREIGN KEY (`fk_lieu`) REFERENCES `t_lieu` (`id_lieu`);

--
-- Contraintes pour la table `t_manif_avoir_type`
--
ALTER TABLE `t_manif_avoir_type`
  ADD CONSTRAINT `t_manif_avoir_type_ibfk_1` FOREIGN KEY (`fk_manif`) REFERENCES `t_manif` (`id_manif`),
  ADD CONSTRAINT `t_manif_avoir_type_ibfk_2` FOREIGN KEY (`fk_type`) REFERENCES `t_type` (`id_type`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
