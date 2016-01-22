-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 22 Janvier 2016 à 03:32
-- Version du serveur :  10.0.17-MariaDB
-- Version de PHP :  5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zend`
--

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `plateforme` varchar(254) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jeux`
--

INSERT INTO `jeux` (`id`, `titre`, `type`, `plateforme`, `owner`) VALUES
(1, 'Assassin''s creed III', 'Action/Aventure', 'Xbox 360', 1),
(2, 'Starcraft II', 'Stratégie', 'PC', 1),
(3, 'The witcher II', 'RPG', 'PC', 2);

-- --------------------------------------------------------

--
-- Structure de la table `jeu_avis`
--

CREATE TABLE `jeu_avis` (
  `id` int(11) NOT NULL,
  `avis` varchar(254) NOT NULL,
  `titre` varchar(254) NOT NULL,
  `note` int(11) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jeu_avis`
--

INSERT INTO `jeu_avis` (`id`, `avis`, `titre`, `note`, `owner`) VALUES
(2, 'Très bon jeu', 'Assassin''s creed III', 18, 1),
(3, 'Bon jeu', 'The Witcher II', 14, 2);

-- --------------------------------------------------------

--
-- Structure de la table `screenshot`
--

CREATE TABLE `screenshot` (
  `id` int(11) NOT NULL,
  `jeu` varchar(254) NOT NULL,
  `url_image` varchar(254) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `screenshot`
--

INSERT INTO `screenshot` (`id`, `jeu`, `url_image`, `owner`) VALUES
(3, 'Assassin''s creed III', 'http://www.gameblog.fr/images/blogs/14357/118094.jpg', 1),
(4, 'The Witcher II', 'http://images.playfrance.com/5/19200/zoom/6635.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `real_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `real_name`) VALUES
(1, 'root', '63a9f0ea7bb98050796b649e85481845', 'root'),
(2, 'flo', '7e1e91156f7c4e1bd0831cf008ad5fdf', 'flo');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jeu_avis`
--
ALTER TABLE `jeu_avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `screenshot`
--
ALTER TABLE `screenshot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `jeu_avis`
--
ALTER TABLE `jeu_avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `screenshot`
--
ALTER TABLE `screenshot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
