-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Décembre 2015 à 15:31
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `img`) VALUES
(1, 'PC', 'Ordinateurs de bureau', 'http://www.dinatec.mx/images/pc.jpg'),
(2, 'Jeux vidÃ©os', 'Jeux Playstation, jeux Microsoft, jeux Nintendo', 'http://img.over-blog-kiwi.com/400x260-ct/1/05/16/82/20151203/ob_19a320_jeux-video.jpeg'),
(3, 'DVD/Blu-ray', 'Films d''action, films d''aventure, documentaires', 'http://www.audiovideohd.fr/i/imgs/19061-2.jpg'),
(4, 'Accessoires', 'CÃ¢bles, Ã©crans, souris, claviers', 'http://www.idg.se/polopoly_fs/1.397569!imageManager/1601832906.jpg'),
(5, 'totocaca', 'C''est moi totocaca !', 'http://www.gorebrothers.co.uk/media/images/image001.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `id_sub_category`, `name`, `description`, `price`, `rate`, `img`, `stock`) VALUES
(1, 0, 'PC MSI', 'Ordinateur portable MSI', 999.99, 0, 'http://localhost/e-commerce/public/img/product1.JPG', 20),
(2, 0, 'Call of Duty', 'Jeu multi-joueur guerre', 59.99, 0, 'http://localhost/e-commerce/public/img/product2.JPG', 20),
(3, 0, 'Ecran OnTV', 'Ecran pour PC et TV', 499.99, 0, 'http://localhost/e-commerce/public/img/product3.JPG', 20),
(4, 0, 'MacBook Air', 'Tablette MacBook Air', 499.99, 0, 'http://localhost/e-commerce/public/img/product4.JPG', 20),
(5, 0, 'Smartphone', 'Smartphone pas cher', 119, 0, 'http://localhost/e-commerce/public/img/product5.JPG', 20),
(6, 0, 'Smartphone Samsung', 'Smartphone + montre', 170, 0, 'http://localhost/e-commerce/public/img/product6.JPG', 20),
(7, 0, 'Appareil photo LUMIX', 'Appareil photo + drone', 200, 0, 'http://localhost/e-commerce/public/img/product7.JPG', 20),
(8, 0, 'The Walking Dead', 'BD The Walking Dead', 25, 0, 'http://localhost/e-commerce/public/img/product8.JPG', 20);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

--
-- Contenu de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `id_category`, `name`, `description`, `img`) VALUES
(1, 1, 'PC de bureau', 'Ordinateurs pour bureau', 'http://images.ouedkniss.com/photos_annonces/7708654/Min_large.jpg'),
(2, 1, 'PC portables', 'Ordinateurs portables', 'http://ecx.images-amazon.com/images/I/41TohYfItFL.jpg'),
(3, 1, 'PC gamers', 'Ordinateurs pour jeux', 'http://constantin-blog.eu/wp-content/uploads/2013/01/Acergamer.jpg'),
(4, 1, 'UnitÃ©s centrales', 'Carcasses PC', 'http://m.gadzetomania.pl/esprimo-1-4138818d799786868163e2,630,0,0,0.jpg'),
(5, 1, 'Claviers, souris', 'PÃ©riphÃ©riques pour PC', 'http://static1.kabum.com.br/produtos/fotos/35801/35801_1357213334_g.jpg'),
(6, 2, 'Jeux PS4', 'Jeux pour PlayStation 4', 'http://i.blogs.es/4450e8/220714-playstation-plus/450_1000.jpg'),
(7, 2, 'Jeux Xbox One', 'Jeux pour console Xbox One', 'http://images.techels.com/articles/images/2014/10/Microsoft_Xbox_One_50_prices_cut_holiday_season_in_the_US_starting_November_2-2_thum.jpg'),
(8, 2, 'Jeux PS3', 'Jeux pour PlayStation 3', 'http://www.nikopik.com/wp-content/uploads/2011/09/3200884843_702cc9eb5d.jpg'),
(9, 2, 'Jeux Xbox 360', 'Jeux pour console Xbox 360', 'http://www.nolifeclub.org/wp-content/uploads/2009/12/Collection-Jeux-Xbox-360-2.JPG'),
(10, 2, 'Jeux Wii U', 'Jeux pour console Wii U', 'http://www.consoles-attitude.fr/c/46-category/jeux-wii-u.jpg'),
(11, 3, 'Blu-ray action', 'Films d''action en blu-ray', 'http://25.media.tumblr.com/tumblr_m5t4axnGff1r97oe4o1_400.jpg'),
(12, 3, 'Blu-ray aventures', 'Films d''aventures en blu-ray', 'http://media.insidepulse.com/zones/insidepulse/uploads/2014/04/The-LEGO-Movie-Everything-is-Awesome-Edition-3D-Blu-Ray-DVD-Set-500x277.jpg'),
(13, 3, 'DVD action', 'Films d''action en DVD', 'https://irinasustugova.files.wordpress.com/2014/11/olbmlg.jpg'),
(14, 3, 'DVD aventure', 'Films d''aventure en DVD', 'http://p2.pstatp.com/large/3374/861880871'),
(15, 3, 'Documentaires', 'Emissions TV', 'http://audrey-mee-kinesiologue.com/_media/img/small/documentaire.jpg'),
(16, 4, 'Connectiques', 'Connectiques pour PC', 'http://static.ccm2.net/www.commentcamarche.net/faq/images/30896331-yfFVFX14TBguzgjq-s-.png'),
(17, 4, 'Ecrans', 'Ecrans pour TV, PC', 'http://obrazki.elektroda.net/67_1244128247.jpg'),
(18, 4, 'Manettes', 'Manettes pour console de jeux', 'http://ecx.images-amazon.com/images/I/41Q%2BxXGfpeL.jpg'),
(19, 4, 'TÃ©lÃ©phones', 'Smartphones, phones', 'http://assets.bizjournals.com/orlando/news/office-phone-closeup*500.jpg?v=1'),
(20, 4, 'Tablettes', 'Tablettes Mac', 'http://images.enet.com.cn/2012/0810/57/5611396.jpg');

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
