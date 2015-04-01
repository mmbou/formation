-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 31 Mars 2015 à 18:57
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `news`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` mediumint(9) NOT NULL,
  `news` smallint(6) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `news`, `auteur`, `contenu`, `date`) VALUES
(1, 2, 'writer', 'the comment', 0x323031352d30332d33312031343a30373a3434);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` smallint(5) NOT NULL,
  `auteur` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `auteur`, `titre`, `contenu`, `dateAjout`, `dateModif`) VALUES
(2, 0, 'News2', 'ghjgfhjgf', 0x323031352d30332d33312031333a30363a3539, 0x323031352d30332d33312031333a30363a3539),
(3, 0, 'hgf', 'hhgfh', 0x323031352d30332d33312031363a31313a3530, 0x323031352d30332d33312031363a31313a3530),
(4, 6, 'hgf', 'hgfhgfjhgj', 0x323031352d30332d33312031363a32343a3530, 0x323031352d30332d33312031363a32353a3437),
(6, 2, 'hgfh', 'kjhkhjhgj', 0x323031352d30332d33312031363a32373a3033, 0x323031352d30332d33312031363a32373a3039);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `dateAjout` datetime NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `login`, `password`, `dateAjout`, `type`) VALUES
(1, 'MBOU', 'Marvin', 'writer', 'mdp', 0x323031352d30332d33312031333a30353a3337, 0),
(2, 'admin1', 'admin1', 'admin', 'mdp', 0x323031352d30332d33312031333a30353a3337, 1),
(3, 'superadmin', 'superadmin', 'superadmin', 'mdp', 0x323031352d30332d33312031333a30373a3436, 1),
(6, 'test', 'test', 'test', 'mdp', 0x323031352d30332d33312031353a35383a3135, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_auteur` (`auteur`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
