-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 13 Mars 2015 à 12:12
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `agrur`
--

-- --------------------------------------------------------

--
-- Structure de la table `certification`
--

CREATE TABLE IF NOT EXISTS `certification` (
  `id_certif` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_certif` varchar(250) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_certif`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `num_client` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',
  `nom_client` varchar(250) COLLATE utf8_bin NOT NULL,
  `adresse_client` varchar(250) COLLATE utf8_bin NOT NULL,
  `nom_responsable_achat` varchar(250) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Identifiant unique',
  UNIQUE KEY `num_client` (`num_client`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`num_client`, `nom_client`, `adresse_client`, `nom_responsable_achat`, `token`) VALUES
(1, '', '15 rue du Berger Gaffeur', 'Michel Pitoulatchi', 'qsdfghjklm');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `num_commande` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',
  `num_prod` int(11) NOT NULL,
  `num_client` int(11) NOT NULL,
  `id_conditionnement` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`num_commande`),
  UNIQUE KEY `id_conditionnement` (`id_conditionnement`),
  UNIQUE KEY `num_client` (`num_client`),
  KEY `num_prod` (`num_prod`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`num_commande`, `num_prod`, `num_client`, `id_conditionnement`, `date_commande`, `quantite`) VALUES
(1, 1, 1, 10, '2015-03-13', 5);

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE IF NOT EXISTS `commune` (
  `id_commune` int(11) NOT NULL AUTO_INCREMENT,
  `nom_commune` varchar(250) COLLATE utf8_bin NOT NULL,
  `commune_aoc` int(1) NOT NULL,
  PRIMARY KEY (`id_commune`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commune`
--

INSERT INTO `commune` (`id_commune`, `nom_commune`, `commune_aoc`) VALUES
(1, 'Grenoble', 1);

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE IF NOT EXISTS `composer` (
  `id_lot` int(11) NOT NULL,
  `id_livraison` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  UNIQUE KEY `id_lot` (`id_lot`),
  UNIQUE KEY `id_livraison` (`id_livraison`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `conditionnement`
--

CREATE TABLE IF NOT EXISTS `conditionnement` (
  `id_conditionnement` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_conditionnement` varchar(250) COLLATE utf8_bin NOT NULL,
  `poids_conditionnement` int(11) NOT NULL,
  `id_lot` int(11) NOT NULL,
  PRIMARY KEY (`id_conditionnement`),
  KEY `id_lot` (`id_lot`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Contenu de la table `conditionnement`
--

INSERT INTO `conditionnement` (`id_conditionnement`, `libelle_conditionnement`, `poids_conditionnement`, `id_lot`) VALUES
(11, 'Sachet', 500, 0),
(12, 'Sachet', 1000, 0),
(10, 'Sachet', 250, 0),
(13, 'Filet', 1000, 0),
(14, 'Filet', 5000, 0),
(15, 'Filet', 10000, 0),
(16, 'Filet', 25000, 0),
(17, 'Carton', 10000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaire`
--

CREATE TABLE IF NOT EXISTS `gestionnaire` (
  `num_gestionnaire` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',
  `token` varchar(255) NOT NULL COMMENT 'Identifiant unique',
  PRIMARY KEY (`num_gestionnaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`num_gestionnaire`, `token`) VALUES
(1, 'wxcvbn');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE IF NOT EXISTS `livraison` (
  `id_livraison` int(11) NOT NULL AUTO_INCREMENT,
  `date_livraison` date NOT NULL,
  `num_prod` int(11) NOT NULL,
  PRIMARY KEY (`id_livraison`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lot_production`
--

CREATE TABLE IF NOT EXISTS `lot_production` (
  `calibre` int(11) NOT NULL,
  `type_produit` varchar(250) COLLATE utf8_bin NOT NULL,
  `id_lot` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_lot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE IF NOT EXISTS `posseder` (
  `id_certif` int(11) NOT NULL,
  `num_prod` int(11) NOT NULL,
  `date_obtention` date DEFAULT NULL,
  UNIQUE KEY `id_certif` (`id_certif`),
  UNIQUE KEY `num_prod` (`num_prod`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `producteur`
--

CREATE TABLE IF NOT EXISTS `producteur` (
  `num_prod` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_prod` varchar(250) COLLATE utf8_bin NOT NULL,
  `nom_representant_prod` varchar(250) COLLATE utf8_bin NOT NULL,
  `prenom_representant_prod` varchar(250) COLLATE utf8_bin NOT NULL,
  `societe` varchar(250) COLLATE utf8_bin NOT NULL,
  `date_adhesion` date DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Identifiant unique',
  UNIQUE KEY `num_prod` (`num_prod`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Contenu de la table `producteur`
--

INSERT INTO `producteur` (`num_prod`, `adresse_prod`, `nom_representant_prod`, `prenom_representant_prod`, `societe`, `date_adhesion`, `token`) VALUES
(1, '13 rue du 14 Juillet', 'Bourichon', 'Michel', 'Société Bourichon&Fils', '2015-03-02', 'azertyuiop');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Nom de l''utilisateur',
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Prénom de l''utilisateur',
  `mail` varchar(250) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(16) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL COMMENT 'Type d''utilisateur(1 producteur, 2 client, 3 gestionnaire)',
  `token` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Identifiant unique de l''utilisateur',
  PRIMARY KEY (`num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`num`, `nom`, `prenom`, `mail`, `mdp`, `type`, `token`) VALUES
(1, 'Parker', 'Peter', 'peterparker@agrur.fr', 'tvn595', 1, 'azertyuiop'),
(2, 'Banner', 'Bruce', 'brucebanner@agrur.fr', 'tvn595', 2, 'qsdfghjklm'),
(3, 'Rogers', 'Steve', 'steverogers@agrur.fr', 'tvn595', 3, 'wxcvbn'),
(4, 'Stark', 'Tony', 'tonystark@agrur.fr', 'tvn595', 1, 'shoottothrill');

-- --------------------------------------------------------

--
-- Structure de la table `variete`
--

CREATE TABLE IF NOT EXISTS `variete` (
  `id_variete` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_variete` varchar(250) COLLATE utf8_bin NOT NULL,
  `AOC` int(1) NOT NULL,
  PRIMARY KEY (`id_variete`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Contenu de la table `variete`
--

INSERT INTO `variete` (`id_variete`, `libelle_variete`, `AOC`) VALUES
(1, 'Franquette', 1),
(2, 'Mayette', 1),
(3, 'Parisienne', 1);

-- --------------------------------------------------------

--
-- Structure de la table `verger`
--

CREATE TABLE IF NOT EXISTS `verger` (
  `id_verger` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',
  `nom_verger` varchar(250) COLLATE utf8_bin NOT NULL,
  `superficie` int(11) NOT NULL,
  `nbr_arbre` int(11) NOT NULL,
  `id_commune` int(11) NOT NULL,
  `num_prod` int(11) NOT NULL,
  `id_variete` int(11) NOT NULL,
  PRIMARY KEY (`id_verger`),
  KEY `id_commune` (`id_commune`),
  KEY `id_variete` (`id_variete`),
  KEY `num_prod` (`num_prod`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `verger`
--

INSERT INTO `verger` (`id_verger`, `nom_verger`, `superficie`, `nbr_arbre`, `id_commune`, `num_prod`, `id_variete`) VALUES
(1, 'Verger du Berger', 45515, 5, 1, 1, 2),
(2, 'Verger des Ancêtres', 1458, 5, 1, 1, 3),
(4, 'Verger du clot fleuri', 14587, 15, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
