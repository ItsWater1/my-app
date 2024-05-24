-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 24 Mai 2024 à 08:34
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

-- --------------------------------------------------------

--
-- Structure de la table `t_image_avoir_lieu`
--

CREATE TABLE `t_image_avoir_lieu` (
  `id_image_avoir_lieu` int(11) NOT NULL,
  `fk_image` int(11) NOT NULL,
  `fk_lieuimage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_image_avoir_user`
--

CREATE TABLE `t_image_avoir_user` (
  `id_image_avoir_user` int(11) NOT NULL,
  `fk_imageUser` int(11) NOT NULL,
  `fk_userImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_lieu`
--

CREATE TABLE `t_lieu` (
  `id_lieu` int(11) NOT NULL,
  `NomLieu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_lieu`
--

INSERT INTO `t_lieu` (`id_lieu`, `NomLieu`) VALUES
(1, 'Treycovagnes'),
(2, 'Chamblon'),
(3, 'Champagne'),
(4, 'Agiez'),
(5, 'Arnex'),
(6, 'Baulmes'),
(7, 'Bavois'),
(8, 'Belmont-sur-Yverdon'),
(9, 'Bofflens'),
(10, 'Bonvillars'),
(11, 'Bretonnieres'),
(12, 'Bullet'),
(13, 'Champvent'),
(14, 'Chavornay'),
(15, 'Concise'),
(16, 'Corcelles-Pres-Concise'),
(17, 'Corcelles-sur-Chavornay'),
(18, 'Cronay'),
(19, 'Croy'),
(20, 'Cuarny'),
(21, 'Ependes'),
(22, 'Essertines-sur-Yverdon'),
(23, 'Fontaines'),
(24, 'Juriens - La Praz'),
(25, 'L\'Auberson'),
(26, 'La Mauguettaz'),
(27, 'Les Charbonnieres'),
(28, 'Lignerolle'),
(29, 'Mathod'),
(30, 'Suscevaz'),
(31, 'Molondin'),
(32, 'Montagny'),
(33, 'Montcherand'),
(34, 'Onnens'),
(35, 'Orny'),
(36, 'Orzens - Gossens'),
(37, 'Pomy'),
(38, 'Provence - Mutrux'),
(39, 'Rances'),
(40, 'Romainmotier'),
(41, 'Rovray'),
(42, 'Suchy'),
(43, 'Ursins'),
(44, 'Valeyres-sous-Rances'),
(45, 'Vallorbe'),
(46, 'Vaulion'),
(47, 'Vuarrens'),
(48, 'Vugelles - Orges'),
(49, 'Vuiteboeuf'),
(50, 'Yvonand');

-- --------------------------------------------------------

--
-- Structure de la table `t_manif`
--

CREATE TABLE `t_manif` (
  `id_manif` int(11) NOT NULL,
  `Nom` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  `Benefice` float(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `t_manif`
--

INSERT INTO `t_manif` (`id_manif`, `Nom`, `Date`, `Benefice`) VALUES
(1, 'AG', '2024-01-12', NULL),
(2, 'Volley', '2024-03-16', NULL),
(3, 'Apero nouveaux', '2024-06-30', NULL),
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
-- Index pour la table `t_image_avoir_user`
--
ALTER TABLE `t_image_avoir_user`
  ADD PRIMARY KEY (`id_image_avoir_user`),
  ADD KEY `fk_image` (`fk_imageUser`),
  ADD KEY `fk_user` (`fk_userImage`);

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
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `t_image_avoir_lieu`
--
ALTER TABLE `t_image_avoir_lieu`
  MODIFY `id_image_avoir_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `t_image_avoir_user`
--
ALTER TABLE `t_image_avoir_user`
  MODIFY `id_image_avoir_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `t_lieu`
--
ALTER TABLE `t_lieu`
  MODIFY `id_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `t_manif`
--
ALTER TABLE `t_manif`
  MODIFY `id_manif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `t_manif_avoir_lieu`
--
ALTER TABLE `t_manif_avoir_lieu`
  MODIFY `id_manif_avoir_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `t_manif_avoir_type`
--
ALTER TABLE `t_manif_avoir_type`
  MODIFY `id_manif_avoir_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `t_type`
--
ALTER TABLE `t_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- Contraintes pour la table `t_image_avoir_user`
--
ALTER TABLE `t_image_avoir_user`
  ADD CONSTRAINT `fk_imageUser` FOREIGN KEY (`fk_imageUser`) REFERENCES `t_image` (`id_image`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_userImage` FOREIGN KEY (`fk_userImage`) REFERENCES `t_utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

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
