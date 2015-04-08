-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 08 Avril 2015 à 12:45
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
  `date` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `checkbox` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `news`, `auteur`, `contenu`, `date`, `email`, `checkbox`) VALUES
(79, 13, 'gffg', 'jnomnnmvf', 0x323031352d30342d30372031313a33393a3136, 'toi@gmail.com', 1),
(78, 13, 'hey oui', 'lfdjufidhn', 0x323031352d30342d30372031313a33383a3536, 'moi@gmail.com', 1),
(77, 15, 'SuperAdmin', 'jiogf', 0x323031352d30342d30372031313a33383a3032, 'moi@gmail.com', 1),
(76, 12, 'hghj', 'jfgfdj,gv', 0x323031352d30342d30372031313a33373a3234, 'gfd@gmail.com', 1),
(75, 12, 'toiaf', 'fgkih,', 0x323031352d30342d30372031313a33363a3530, 'gfd@gmail.x', 1),
(74, 13, 'bjivf,d', 'bon comment', 0x323031352d30342d30372031313a33363a3234, 'a@gmail.com', 1),
(73, 13, 'bjivf,d', 'bon comment', 0x323031352d30342d30372031313a33363a3138, 'a@gmail.com', 0),
(72, 15, 'hjyu', 'kuikiu', 0x323031352d30342d30372031313a33353a3233, 'shi@gmail.com', 0),
(71, 15, 'moi', 'nfdjvfd', 0x323031352d30342d30372031313a33343a3534, 'toi@gmail.com', 0),
(70, 12, 'moi', 'jfd,fd', 0x323031352d30342d30372031313a33303a3332, 'moi@gmail.com', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `auteur`, `titre`, `contenu`, `dateAjout`, `dateModif`) VALUES
(15, 26, 'News4', 'jugfdpgisdg', 0x323031352d30342d30372031313a33313a3431, 0x323031352d30342d30372031313a33313a3431),
(14, 26, 'news3 ', 'fdjgod', 0x323031352d30342d30372031313a33313a3330, 0x323031352d30342d30372031313a33313a3330),
(13, 30, 'news2', 'gjiogmr;gfgfl;gg', 0x323031352d30342d30372031313a33313a3030, 0x323031352d30342d30372031313a34303a3235),
(12, 30, 'News1', 'gjufdgfkdgkk', 0x323031352d30342d30372031313a33303a3133, 0x323031352d30342d30372031313a34303a3137),
(16, 100, 'fdjg,fdl', ',fd,g', 0x323031352d30342d30312030303a30303a3030, 0x323031352d30342d30392030303a30303a3030);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
`id` int(11) NOT NULL,
  `descriptif` varchar(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id`, `descriptif`) VALUES
(1, 'Admin'),
(2, 'Writer'),
(3, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dateAjout` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `login`, `password`, `dateAjout`, `type`, `email`) VALUES
(30, 'user', 'user', 'user', '$2a$07$usesomesillystringforu.c7hoaFA0.DjjGrn8y2SlP6t9CqTxv6', 0x323031352d30342d30372031323a31393a3032, 2, 'user@user.com'),
(28, 'MBOU', 'Marvin', 'Marvin', '$2a$07$usesomesillystringforuEvkcHzkXe0Xcy8wkqgp3vUS5W9YWcWK', 0x323031352d30342d30372031313a34313a3233, 1, 'Marvin@gmail.com'),
(26, 'pass', 'pass', 'pass', '$2a$07$usesomesillystringforuh2gbRHbVp1exYMHxGHmxmHwcOwCliRq', 0x323031352d30342d30372031313a32343a3433, 1, 'pass@pass.pass'),
(29, 'writer', 'writer', 'writer', '$2a$07$usesomesillystringforuMXGI8nZpF210MJYV9PelTnO1yAfNcvW', 0x323031352d30342d30372031323a31363a3237, 2, 'writer@writer.com'),
(31, 'blowfish', 'blowfish', 'blowfish', '$2a$07$usesomesillystringforugtFZOQ8eZvxxihC4ZJnp2Uk2a5CdkXK', 0x323031352d30342d30372031323a35343a3339, 1, 'blowfish@gmail.com'),
(34, 'fd', 'gfdg', 'hgfj', '$2a$07$usesomesillystringforuIpWy07CS5bWJgeiJUCaziM6cj43wZIe', 0x323031352d30342d30382031323a34333a3130, 3, 'a@gmail.com');

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
-- Index pour la table `type`
--
ALTER TABLE `type`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_type` (`type`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
