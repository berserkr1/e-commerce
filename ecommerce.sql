-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Décembre 2015 à 09:15
-- Version du serveur: 5.5.44-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `ship_address` varchar(64) COLLATE utf8_bin NOT NULL,
  `ship_city` varchar(32) COLLATE utf8_bin NOT NULL,
  `ship_postal_code` varchar(8) COLLATE utf8_bin NOT NULL,
  `ship_region` varchar(16) COLLATE utf8_bin NOT NULL,
  `ship_country` varchar(32) COLLATE utf8_bin NOT NULL,
  `bill_address` varchar(64) COLLATE utf8_bin NOT NULL,
  `bill_city` varchar(32) COLLATE utf8_bin NOT NULL,
  `bill_postal_code` varchar(8) COLLATE utf8_bin NOT NULL,
  `bill_country` varchar(32) COLLATE utf8_bin NOT NULL,
  `bill_region` varchar(16) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `address`
--

INSERT INTO `address` (`id`, `id_user`, `ship_address`, `ship_city`, `ship_postal_code`, `ship_region`, `ship_country`, `bill_address`, `bill_city`, `bill_postal_code`, `bill_country`, `bill_region`) VALUES
(6, 8, '10 grand rue', 'Strasbourg', '67000', 'Alsace', 'France', '10 grand rue', 'Strasbourg', '67000', 'France', 'Alsace');

-- --------------------------------------------------------

--
-- Structure de la table `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `description` varchar(1024) COLLATE utf8_bin NOT NULL,
  `img` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `img`) VALUES
(1, 'PC', 'Ordinateurs de bureau', 'http://www.dinatec.mx/images/pc.jpg'),
(2, 'Jeux vidÃ©os', 'Jeux Playstation, jeux Microsoft, jeux Nintendo', 'http://img.over-blog-kiwi.com/400x260-ct/1/05/16/82/20151203/ob_19a320_jeux-video.jpeg'),
(3, 'DVD/Blu-ray', 'Films d''action, films d''aventure, documentaires', 'http://www.audiovideohd.fr/i/imgs/19061-2.jpg'),
(4, 'Accessoires', 'CÃ¢bles, Ã©crans, souris, claviers', 'http://www.idg.se/polopoly_fs/1.397569!imageManager/1601832906.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `content` varchar(2048) COLLATE utf8_bin NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_ship` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub_category` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `description` varchar(2048) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `rate` float NOT NULL,
  `img` varchar(512) COLLATE utf8_bin NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `description` varchar(1024) COLLATE utf8_bin NOT NULL,
  `img` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(16) COLLATE utf8_bin NOT NULL,
  `password` varchar(512) COLLATE utf8_bin NOT NULL,
  `status` int(11) NOT NULL,
  `email` varchar(32) COLLATE utf8_bin NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `surname` varchar(32) COLLATE utf8_bin NOT NULL,
  `date_birth` datetime NOT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `status`, `email`, `name`, `surname`, `date_birth`, `date_register`) VALUES
(1, 'caille88', '$2y$10$dA9ZuNl84sWXpIyfrvgG6OuQCaCQM5ddYQ647p0EoXAFYNT.GVbxu', 1, 'pascal@3wa.fr', 'aaaaaa', 'aaaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'caille88', '$2y$10$e2kqj38mS9Ida19DK69ur.fFOGuZAn9g4BCxoCD6ipbgIS4B9ZPJW', 1, 'pascal@3wa.fr', 'aaaaaa', 'aaaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'caille88', '$2y$10$CtTVuzQm1.T8Scu4K/JCWu7svhKa6utcTFMs1EVksyBDz9Yr4x2dy', 1, 'pascal@3wa.fr', 'aaaaaa', 'aaaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'caille88', '$2y$10$Ebs3oqvRT7qlELo5tZkLLu2XWUeKfSDMDg/ktgAuPnQ/g6iBi3V.C', 1, 'pascal@3wa.fr', 'aaaaaa', 'aaaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'caille88', '$2y$10$Wnv1tm3QS7u.ghfrWSkE..L2O21pbmVID7AalENpdOq4ZrLawVZIC', 1, 'pascal@3wa.fr', 'aaaaaa', 'aaaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'caille88', '$2y$10$e3Ebg1Dze8TnwSf23aDA9..RL/zz1/HehYMtIkNTCdzrn5YfzKxi6', 1, 'pascal@3wa.fr', 'aaaaaa', 'aaaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'caille88', '$2y$10$.A2ZtIdodwEtQRx3pd694.k9REgWIJkr0eQu/PcFzvqBkIP5wAIyi', 1, 'pascal@3wa.fr', 'aaaaaa', 'aaaaaa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'lucminarro', '$2y$10$GUISWW/QV.RLW4I3m3cZ2ejLiG5/elIP9lcJ66oDscLD/1Cn25T4S', 1, 'luc@minarro.com', 'minarro', 'luc', '0000-00-00 00:00:00', '2015-12-09 14:39:25'),
(11, 'Somewhere', '$2y$10$zcK7EuVsNTdwcG8qNVjL9eKYVSjRsTTw6p6b0HK3sHe5VEhp4xDFG', 2, 'tchat@tchat.tchat', 'tchat', 'tchat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'totocaca', '$2y$10$pzRKMdNS.dTouORPyJEgJuJ65PJ8TPpDx2C4X6Hn6t5kbdJtx.Mei', 2, 'toto.caca@gmail.com', 'toto', 'caca', '0000-00-00 00:00:00', '2015-12-10 10:17:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
