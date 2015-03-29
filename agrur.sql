-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 29 Mars 2015 à 13:12
-- Version du serveur :  5.5.38
-- Version de PHP :  5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `vdev-agrur`
--

-- --------------------------------------------------------

--
-- Structure de la table `certification`
--

CREATE TABLE `certification` (
`id_certif` int(11) NOT NULL,
  `libelle_certif` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
`num_client` int(11) NOT NULL COMMENT 'Clé primaire',
  `nom_client` varchar(250) COLLATE utf8_bin NOT NULL,
  `adresse_client` varchar(250) COLLATE utf8_bin NOT NULL,
  `nom_responsable_achat` varchar(250) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Identifiant unique'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`num_client`, `nom_client`, `adresse_client`, `nom_responsable_achat`, `token`) VALUES
(1, '', '15 rue du Berger Gaffeur', 'Michel Pitoulatchi', 'qsdfghjklm');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
`num_commande` int(11) NOT NULL COMMENT 'Clé primaire',
  `num_prod` int(11) NOT NULL,
  `num_client` int(11) NOT NULL,
  `id_conditionnement` int(11) NOT NULL,
  `date_commande` date NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`num_commande`, `num_prod`, `num_client`, `id_conditionnement`, `date_commande`, `quantite`) VALUES
(1, 1, 1, 10, '2015-03-13', 5);

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
`id_commune` int(11) NOT NULL,
  `nom_commune` varchar(250) COLLATE utf8_bin NOT NULL,
  `commune_aoc` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `commune`
--

INSERT INTO `commune` (`id_commune`, `nom_commune`, `commune_aoc`) VALUES
(1, 'Grenoble', 1);

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE `composer` (
  `id_lot` int(11) NOT NULL,
  `id_livraison` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `conditionnement`
--

CREATE TABLE `conditionnement` (
`id_conditionnement` int(11) NOT NULL,
  `libelle_conditionnement` varchar(250) COLLATE utf8_bin NOT NULL,
  `poids_conditionnement` int(11) NOT NULL,
  `id_lot` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `gestionnaire` (
`num_gestionnaire` int(11) NOT NULL COMMENT 'Clé primaire',
  `token` varchar(255) NOT NULL COMMENT 'Identifiant unique'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gestionnaire`
--

INSERT INTO `gestionnaire` (`num_gestionnaire`, `token`) VALUES
(1, 'wxcvbn');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
`id_livraison` int(11) NOT NULL,
  `date_livraison` date NOT NULL,
  `num_prod` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lot_production`
--

CREATE TABLE `lot_production` (
  `calibre` int(11) NOT NULL,
  `type_produit` varchar(250) COLLATE utf8_bin NOT NULL,
`id_lot` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE `posseder` (
  `id_certif` int(11) NOT NULL,
  `num_prod` int(11) NOT NULL,
  `date_obtention` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `producteur`
--

CREATE TABLE `producteur` (
`num_prod` int(11) NOT NULL,
  `adresse_prod` varchar(250) COLLATE utf8_bin NOT NULL,
  `nom_representant_prod` varchar(250) COLLATE utf8_bin NOT NULL,
  `prenom_representant_prod` varchar(250) COLLATE utf8_bin NOT NULL,
  `societe` varchar(250) COLLATE utf8_bin NOT NULL,
  `date_adhesion` date DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Identifiant unique'
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `producteur`
--

INSERT INTO `producteur` (`num_prod`, `adresse_prod`, `nom_representant_prod`, `prenom_representant_prod`, `societe`, `date_adhesion`, `token`) VALUES
(1, '13 rue du 14 Juillet', 'Bourichon', 'Michel', 'Société Bourichon&Fils', '2015-03-02', 'azertyuiop');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
`num` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Nom de l''utilisateur',
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Prénom de l''utilisateur',
  `mail` varchar(250) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(16) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL COMMENT 'Type d''utilisateur(1 producteur, 2 client, 3 gestionnaire)',
  `token` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Identifiant unique de l''utilisateur'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `variete` (
`id_variete` int(11) NOT NULL,
  `libelle_variete` varchar(250) COLLATE utf8_bin NOT NULL,
  `AOC` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `verger` (
`id_verger` int(11) NOT NULL COMMENT 'Clé primaire',
  `nom_verger` varchar(250) COLLATE utf8_bin NOT NULL,
  `superficie` int(11) NOT NULL,
  `nbr_arbre` int(11) NOT NULL,
  `id_commune` int(11) NOT NULL,
  `num_prod` int(11) NOT NULL,
  `id_variete` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `verger`
--

INSERT INTO `verger` (`id_verger`, `nom_verger`, `superficie`, `nbr_arbre`, `id_commune`, `num_prod`, `id_variete`) VALUES
(5, 'Robert', 12345, 50, 1, 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `certification`
--
ALTER TABLE `certification`
 ADD PRIMARY KEY (`id_certif`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
 ADD UNIQUE KEY `num_client` (`num_client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
 ADD PRIMARY KEY (`num_commande`), ADD UNIQUE KEY `id_conditionnement` (`id_conditionnement`), ADD UNIQUE KEY `num_client` (`num_client`), ADD KEY `num_prod` (`num_prod`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
 ADD PRIMARY KEY (`id_commune`);

--
-- Index pour la table `composer`
--
ALTER TABLE `composer`
 ADD UNIQUE KEY `id_lot` (`id_lot`), ADD UNIQUE KEY `id_livraison` (`id_livraison`);

--
-- Index pour la table `conditionnement`
--
ALTER TABLE `conditionnement`
 ADD PRIMARY KEY (`id_conditionnement`), ADD KEY `id_lot` (`id_lot`);

--
-- Index pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
 ADD PRIMARY KEY (`num_gestionnaire`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
 ADD PRIMARY KEY (`id_livraison`);

--
-- Index pour la table `lot_production`
--
ALTER TABLE `lot_production`
 ADD PRIMARY KEY (`id_lot`);

--
-- Index pour la table `posseder`
--
ALTER TABLE `posseder`
 ADD UNIQUE KEY `id_certif` (`id_certif`), ADD UNIQUE KEY `num_prod` (`num_prod`);

--
-- Index pour la table `producteur`
--
ALTER TABLE `producteur`
 ADD UNIQUE KEY `num_prod` (`num_prod`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`num`);

--
-- Index pour la table `variete`
--
ALTER TABLE `variete`
 ADD PRIMARY KEY (`id_variete`);

--
-- Index pour la table `verger`
--
ALTER TABLE `verger`
 ADD PRIMARY KEY (`id_verger`), ADD KEY `id_commune` (`id_commune`), ADD KEY `id_variete` (`id_variete`), ADD KEY `num_prod` (`num_prod`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `certification`
--
ALTER TABLE `certification`
MODIFY `id_certif` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
MODIFY `num_client` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
MODIFY `num_commande` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `commune`
--
ALTER TABLE `commune`
MODIFY `id_commune` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `conditionnement`
--
ALTER TABLE `conditionnement`
MODIFY `id_conditionnement` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `gestionnaire`
--
ALTER TABLE `gestionnaire`
MODIFY `num_gestionnaire` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
MODIFY `id_livraison` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lot_production`
--
ALTER TABLE `lot_production`
MODIFY `id_lot` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `producteur`
--
ALTER TABLE `producteur`
MODIFY `num_prod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `num` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `variete`
--
ALTER TABLE `variete`
MODIFY `id_variete` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `verger`
--
ALTER TABLE `verger`
MODIFY `id_verger` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire',AUTO_INCREMENT=6;