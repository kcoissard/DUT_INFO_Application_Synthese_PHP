-- phpMyAdmin SQL Dump
-- version 4.0.10.15
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 20 Mai 2016 à 10:55
-- Version du serveur: 5.1.73
-- Version de PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `p1502716`
--

-- --------------------------------------------------------

--
-- Structure de la table `AS_arbitre`
--

CREATE TABLE IF NOT EXISTS `AS_arbitre` (
  `id_arbitre` smallint(3) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_arbitre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Contenu de la table `AS_arbitre`
--

INSERT INTO `AS_arbitre` (`id_arbitre`, `nom`, `prenom`) VALUES
(1, 'Atkinson', 'Martin'),
(2, 'Brych', 'Felix'),
(3, 'Cakir', 'Cuneyt'),
(4, 'Clattenburg', 'Mark'),
(5, 'Královec', 'Pavel'),
(6, 'Mažić ', 'Milorad'),
(7, 'Skomina', 'Damir'),
(8, 'Turpin', 'Clément'),
(9, 'Collum', 'William'),
(10, 'Eriksson', 'Jonas'),
(11, 'Hategan', 'Ovidiu'),
(12, 'Karasev', 'Sergey'),
(13, 'Guillot', 'Jeremie'),
(14, 'Coissard', 'Kévin'),
(15, 'Fonta', 'Jean-Séba'),
(16, 'Craipeau', 'Marion'),
(17, 'Méneroud', 'Guillaume');

-- --------------------------------------------------------

--
-- Structure de la table `AS_championnat`
--

CREATE TABLE IF NOT EXISTS `AS_championnat` (
  `id_championnat` smallint(3) NOT NULL AUTO_INCREMENT,
  `id_division` tinyint(1) NOT NULL,
  `id_pays` smallint(3) NOT NULL,
  `id_saison` smallint(3) NOT NULL,
  `libelle_championnat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_championnat`),
  KEY `id_division` (`id_division`),
  KEY `id_pays` (`id_pays`),
  KEY `id_saison` (`id_saison`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `AS_championnat`
--

INSERT INTO `AS_championnat` (`id_championnat`, `id_division`, `id_pays`, `id_saison`, `libelle_championnat`) VALUES
(1, 1, 1, 1, 'Ligue 1 France 2014-2015'),
(4, 1, 2, 1, 'Ligue 1 Espagne 2014-2015'),
(6, 2, 1, 1, 'Ligue 2 France 2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `AS_division`
--

CREATE TABLE IF NOT EXISTS `AS_division` (
  `id_division` tinyint(1) NOT NULL AUTO_INCREMENT,
  `libelle_division` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_division`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `AS_division`
--

INSERT INTO `AS_division` (`id_division`, `libelle_division`) VALUES
(1, 'Division_1'),
(2, 'Division_2');

-- --------------------------------------------------------

--
-- Structure de la table `AS_equipe`
--

CREATE TABLE IF NOT EXISTS `AS_equipe` (
  `id_equipe` smallint(2) NOT NULL AUTO_INCREMENT,
  `libelle_equipe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_championnat` smallint(2) NOT NULL,
  PRIMARY KEY (`id_equipe`),
  KEY `id_championnat` (`id_championnat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Contenu de la table `AS_equipe`
--

INSERT INTO `AS_equipe` (`id_equipe`, `libelle_equipe`, `id_championnat`) VALUES
(41, 'Paris-SG', 1),
(42, 'Lyon', 1),
(43, 'Monaco', 1),
(44, 'Marseille', 1),
(45, 'Saint-Étienne', 1),
(46, 'Bordeaux', 1),
(47, 'Montpellier', 1),
(48, 'Lille', 1),
(49, 'Rennes', 1),
(50, 'Guingamp', 1),
(51, 'Nice', 1),
(52, 'Bastia', 1),
(53, 'Caen', 1),
(54, 'Nantes', 1),
(55, 'Reims', 1),
(56, 'Lorient', 1),
(57, 'Toulouse', 1),
(58, 'Evian-TG', 1),
(59, 'Metz', 1),
(60, 'Lens', 1),
(61, 'FC Barcelone', 4),
(62, 'Atlético de Madrid', 4),
(63, 'Real Madrid', 4),
(64, 'Villarreal', 4),
(65, 'Celta Vigo', 4),
(66, 'Athletic Bilbao', 4),
(67, 'Séville FC', 4),
(68, 'Valence CF', 4),
(69, 'Las Palmas', 4),
(70, 'Malaga', 4),
(71, 'Eibar', 4),
(72, 'Real Sociedad', 4),
(73, 'Betis Séville', 4),
(74, 'Deportivo La Corogne', 4),
(75, 'Espanyol Barcelone', 4),
(76, 'Rayo Vallecano', 4),
(77, 'Granada CF', 4),
(78, 'Sporting Gijon', 4),
(79, 'Getafe', 4),
(80, 'Levante', 4);

-- --------------------------------------------------------

--
-- Structure de la table `AS_groupe`
--

CREATE TABLE IF NOT EXISTS `AS_groupe` (
  `id_groupe` smallint(3) NOT NULL AUTO_INCREMENT,
  `libelle_groupe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `AS_groupe`
--

INSERT INTO `AS_groupe` (`id_groupe`, `libelle_groupe`) VALUES
(1, 'Groupe A'),
(2, 'Groupe B'),
(3, 'Groupe C'),
(4, 'Groupe D'),
(5, 'Groupe E'),
(6, 'Groupe F'),
(7, 'Groupe G'),
(8, 'Groupe H');

-- --------------------------------------------------------

--
-- Structure de la table `AS_match_championnat`
--

CREATE TABLE IF NOT EXISTS `AS_match_championnat` (
  `id_match_championnat` smallint(3) NOT NULL AUTO_INCREMENT,
  `id_equipe_visiteur` smallint(3) NOT NULL,
  `id_equipe_domicile` smallint(3) NOT NULL,
  `id_championnat` smallint(3) NOT NULL,
  `date_championnat` date NOT NULL,
  `buts_equipe_visiteur` tinyint(2) NOT NULL,
  `buts_equipe_domicile` tinyint(2) NOT NULL,
  `id_arbitre1` smallint(3) NOT NULL,
  `id_arbitre2` smallint(3) NOT NULL,
  `id_arbitre3` smallint(3) NOT NULL,
  `id_arbitre4` smallint(3) NOT NULL,
  `id_remplacant` smallint(3) NOT NULL,
  PRIMARY KEY (`id_match_championnat`),
  KEY `id_equipe1` (`id_equipe_visiteur`),
  KEY `id_equipe2` (`id_equipe_domicile`),
  KEY `id_arbitre1` (`id_arbitre1`),
  KEY `id_arbitre2` (`id_arbitre2`),
  KEY `id_arbitre3` (`id_arbitre3`),
  KEY `id_arbitre4` (`id_arbitre4`),
  KEY `id_remplacant` (`id_remplacant`),
  KEY `date_championnat` (`date_championnat`),
  KEY `fk_match_championnat_id_championnat` (`id_championnat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `AS_match_tournoi`
--

CREATE TABLE IF NOT EXISTS `AS_match_tournoi` (
  `id_match_tournoi` smallint(3) NOT NULL AUTO_INCREMENT,
  `id_equipe_visiteur` smallint(3) NOT NULL,
  `id_equipe_domicile` smallint(3) NOT NULL,
  `id_groupe` smallint(3) NOT NULL,
  `id_tournoi` smallint(3) NOT NULL,
  `buts_equipe1` tinyint(2) NOT NULL,
  `buts_equipe2` tinyint(2) NOT NULL,
  `date_tournoi` date NOT NULL,
  `id_arbitre1` smallint(3) NOT NULL,
  `id_arbitre2` smallint(3) NOT NULL,
  `id_arbitre3` smallint(3) NOT NULL,
  `id_arbitre4` smallint(3) NOT NULL,
  `id_remplacant` smallint(3) NOT NULL,
  PRIMARY KEY (`id_match_tournoi`),
  KEY `id_equipe1` (`id_equipe_visiteur`),
  KEY `id_equipe2` (`id_equipe_domicile`),
  KEY `id_groupe` (`id_groupe`),
  KEY `id_tournoi` (`id_tournoi`),
  KEY `id_arbitre1` (`id_arbitre1`),
  KEY `id_remplacant` (`id_remplacant`),
  KEY `id_arbitre2` (`id_arbitre2`),
  KEY `id_arbitre3` (`id_arbitre3`),
  KEY `id_arbitre4` (`id_arbitre4`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `AS_pays`
--

CREATE TABLE IF NOT EXISTS `AS_pays` (
  `id_pays` smallint(3) NOT NULL AUTO_INCREMENT,
  `libelle_pays` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `AS_pays`
--

INSERT INTO `AS_pays` (`id_pays`, `libelle_pays`) VALUES
(1, 'France'),
(2, 'Espagne'),
(3, 'Allemagne'),
(4, 'Angleterre'),
(5, 'Italie'),
(6, 'Portugal'),
(7, 'Russie'),
(8, 'Ukraine'),
(9, 'Belgique'),
(10, 'Pays-Bas'),
(11, 'Turquie'),
(12, 'Suisse'),
(13, 'République Tchèque'),
(14, 'Grèce'),
(15, 'Roumanie'),
(16, 'Autriche');

-- --------------------------------------------------------

--
-- Structure de la table `AS_saison`
--

CREATE TABLE IF NOT EXISTS `AS_saison` (
  `id_saison` smallint(3) NOT NULL AUTO_INCREMENT,
  `date_debut` year(4) NOT NULL,
  `date_fin` year(4) NOT NULL,
  PRIMARY KEY (`id_saison`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `AS_saison`
--

INSERT INTO `AS_saison` (`id_saison`, `date_debut`, `date_fin`) VALUES
(1, 2014, 2015),
(2, 2015, 2016),
(3, 2016, 2017),
(4, 2017, 2018);

-- --------------------------------------------------------

--
-- Structure de la table `AS_tournoi`
--

CREATE TABLE IF NOT EXISTS `AS_tournoi` (
  `id_tournoi` smallint(11) NOT NULL AUTO_INCREMENT,
  `id_saison` smallint(3) NOT NULL,
  `libelle_tournoi` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_tournoi`),
  KEY `id_saison` (`id_saison`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `AS_tournoi`
--

INSERT INTO `AS_tournoi` (`id_tournoi`, `id_saison`, `libelle_tournoi`) VALUES
(1, 1, 'Ligue des Champions'),
(2, 2, 'Ligue des Champions');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `AS_championnat`
--
ALTER TABLE `AS_championnat`
  ADD CONSTRAINT `fk_championnat_id_division` FOREIGN KEY (`id_division`) REFERENCES `AS_division` (`id_division`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_championnat_id_pays` FOREIGN KEY (`id_pays`) REFERENCES `AS_pays` (`id_pays`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_championnat_id_saison` FOREIGN KEY (`id_saison`) REFERENCES `AS_saison` (`id_saison`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `AS_equipe`
--
ALTER TABLE `AS_equipe`
  ADD CONSTRAINT `fk_equipe_id_championnat` FOREIGN KEY (`id_championnat`) REFERENCES `AS_championnat` (`id_championnat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `AS_match_championnat`
--
ALTER TABLE `AS_match_championnat`
  ADD CONSTRAINT `fk_match_championnat_id_arbitre1` FOREIGN KEY (`id_arbitre1`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_championnat_id_arbitre2` FOREIGN KEY (`id_arbitre2`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_championnat_id_arbitre3` FOREIGN KEY (`id_arbitre3`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_championnat_id_arbitre4` FOREIGN KEY (`id_arbitre4`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_championnat_id_championnat` FOREIGN KEY (`id_championnat`) REFERENCES `AS_championnat` (`id_championnat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_championnat_id_equipe_domicile` FOREIGN KEY (`id_equipe_domicile`) REFERENCES `AS_equipe` (`id_equipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_championnat_id_equipe_visiteur` FOREIGN KEY (`id_equipe_visiteur`) REFERENCES `AS_equipe` (`id_equipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_championnat_id_remplacant` FOREIGN KEY (`id_remplacant`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `AS_match_tournoi`
--
ALTER TABLE `AS_match_tournoi`
  ADD CONSTRAINT `fk_match_tournoi_id_arbitre1` FOREIGN KEY (`id_arbitre1`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_arbitre2` FOREIGN KEY (`id_arbitre2`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_arbitre3` FOREIGN KEY (`id_arbitre3`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_arbitre4` FOREIGN KEY (`id_arbitre4`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_equipe_domicile` FOREIGN KEY (`id_equipe_domicile`) REFERENCES `AS_equipe` (`id_equipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_equipe_visiteur` FOREIGN KEY (`id_equipe_visiteur`) REFERENCES `AS_equipe` (`id_equipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_groupe` FOREIGN KEY (`id_groupe`) REFERENCES `AS_groupe` (`id_groupe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_remplacant` FOREIGN KEY (`id_remplacant`) REFERENCES `AS_arbitre` (`id_arbitre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_tournoi_id_tournoi` FOREIGN KEY (`id_tournoi`) REFERENCES `AS_tournoi` (`id_tournoi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `AS_tournoi`
--
ALTER TABLE `AS_tournoi`
  ADD CONSTRAINT `fk_tournoi_id_saison` FOREIGN KEY (`id_saison`) REFERENCES `AS_saison` (`id_saison`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
