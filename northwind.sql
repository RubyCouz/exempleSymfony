-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 07 juil. 2020 à 14:50
-- Version du serveur :  8.0.18
-- Version de PHP :  7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `northwind`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `edit` datetime DEFAULT NULL,
  `id_product_id` int(11) DEFAULT NULL,
  `id_user_id` int(11) DEFAULT NULL,
  `editing` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962AE00EE68D` (`id_product_id`),
  KEY `IDX_5F9E962A79F37AE5` (`id_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date`, `edit`, `id_product_id`, `id_user_id`, `editing`) VALUES
(2, 'blabla', '2020-06-18 00:00:00', NULL, 7, 2, 0),
(4, 'fdgh dfgh df', '2020-06-18 00:00:00', NULL, 2, 1, 0),
(6, 'test modif', '2020-06-18 00:00:00', NULL, 4, 2, 0),
(8, 'bla', '2020-06-19 00:00:00', '2020-06-29 14:20:52', 2, 1, 0),
(18, 'wesh', '2020-06-24 00:00:00', NULL, 1, 1, 0),
(19, 'wesh', '2020-06-24 00:00:00', NULL, 1, 1, 0),
(20, 'wesh', '2020-06-24 00:00:00', NULL, 7, 1, 0),
(21, 'wesh', '2020-06-24 00:00:00', NULL, 7, 1, 0),
(22, 'wesh', '2020-06-24 00:00:00', NULL, 7, 1, 0),
(23, 'wesh', '2020-06-24 00:00:00', NULL, 7, 1, 0),
(24, 'wesh', '2020-06-24 00:00:00', NULL, 7, 1, 0),
(25, 'wesh', '2020-06-24 00:00:00', NULL, 7, 1, 0),
(26, 'bonsoir', '2020-06-24 00:00:00', NULL, 7, 2, 0),
(27, 'bonsoir', '2020-06-24 00:00:00', NULL, 7, 2, 0),
(28, 'test ajout', '2020-07-07 00:00:00', NULL, 4, 2, 0),
(29, 'retest', '2020-07-07 07:25:34', NULL, 4, 2, 0),
(30, 'reretest modif', '2020-07-07 07:26:56', NULL, 4, 2, 0),
(37, 'bonsoir', '2020-06-24 00:00:00', NULL, 7, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compagny_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_title` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200507131728', '2020-06-02 14:39:33'),
('20200511101058', '2020-06-02 14:39:33'),
('20200511104215', '2020-06-02 14:39:33'),
('20200604111641', '2020-06-04 11:17:08'),
('20200604134643', '2020-06-04 13:47:06'),
('20200610100705', '2020-06-10 10:07:26'),
('20200611081849', '2020-06-11 08:19:15'),
('20200618123647', '2020-06-18 12:37:07'),
('20200618124117', '2020-06-18 12:41:23'),
('20200618132019', '2020-06-18 13:20:27'),
('20200618134632', '2020-06-18 13:46:51');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `required_date` datetime DEFAULT NULL,
  `shipped_date` datetime DEFAULT NULL,
  `ship_via` int(11) DEFAULT NULL,
  `freight` double NOT NULL,
  `ship_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_city` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_region` int(11) DEFAULT NULL,
  `ship_postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_country` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `quantity_per_unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double NOT NULL,
  `units_in_stock` int(11) NOT NULL,
  `units_on_order` int(11) NOT NULL,
  `redorder_level` int(11) NOT NULL,
  `discontinued` int(11) NOT NULL,
  `supplier_id_id` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5AA65F9C7D` (`supplier_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `quantity_per_unit`, `unit_price`, `units_in_stock`, `units_on_order`, `redorder_level`, `discontinued`, `supplier_id_id`, `picture`, `description`) VALUES
(1, 'ghjfghj', 5, '5', 5, 5, 5, 5, 5, NULL, '1.jpeg', NULL),
(2, 'fghfdgh', 5, '8', 8, 8, 8, 8, 0, NULL, '2.jpeg', NULL),
(3, 'jghjgfhj', 6, '5', 7, 78, 87, 6, 7, NULL, '3.jpeg', NULL),
(4, 'jgfhj', 5, '654', 546, 45, 45, 45, 1, NULL, '4.jpeg', NULL),
(5, 'hgfjhg', 4, '4', 4, 4, 4, 4, 4, NULL, '5.jpeg', NULL),
(6, 'hgfjhg', 4, '4', 4, 4, 4, 4, 4, NULL, '6.png', NULL),
(7, 'jhkghjkghj', 5, '6', 9, 4, 8, 6, 4, NULL, '7.jpeg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_title` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homepage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(1, 'toto@toto.com', '$2y$12$FsPdRw7RT40dgwlIFqg.IubADC7Ew87b.vQXiIVCMxeLc3hrYlqn2', 'administrateur'),
(2, 'azerty@aze.rty', '$2y$12$H00UgKxVL5wsbLygE3W3VulHr/fxSbyVZ40mjIEjXx/N70y5/IUkm', 'client');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5F9E962AE00EE68D` FOREIGN KEY (`id_product_id`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_B3BA5A5AA65F9C7D` FOREIGN KEY (`supplier_id_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
