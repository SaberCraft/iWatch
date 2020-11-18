-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 15 mai 2018 à 14:07
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `cat_id` smallint(6) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` text NOT NULL,
  `cat_country` varchar(255) NOT NULL,
  `cat_order` int(11) DEFAULT NULL,
  `cat_visibility` tinyint(4) NOT NULL DEFAULT '1',
  `cat_allow_comments` tinyint(4) NOT NULL DEFAULT '1',
  `cat_allow_ads` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`, `cat_country`, `cat_order`, `cat_visibility`, `cat_allow_comments`, `cat_allow_ads`) VALUES
(1, 'Swatch', 'Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch Swatch', '', 1, 1, 1, 1),
(2, 'Casio', 'Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio Casio 34', '', 2, 1, 0, 1),
(3, 'Secret', 'secret catégorie', '', 0, 0, 0, 0),
(4, 'Omega', '', '', 0, 0, 1, 1),
(5, 'Rolex', 'Fondée en 1905 par Hans Wilsdorf, est une entreprise suisse fabriquant, distribuant et vendant des montres de luxe. Son modèle phare Oyster («huître» en anglais)', '', 0, 1, 1, 1),
(7, 'Cartier', 'Cartier Cartier Cartier Cartier Cartier Cartier Cartier Cartier Cartier Cartier Cartier Cartier Cartier Cartier', '', 1, 0, 1, 0),
(8, 'Chanel', 'Chanel Chanel Chanel Chanel Chanel', '', 4, 0, 0, 0),
(9, 'Diesel', 'Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel Diesel', '', 4, 0, 1, 1),
(10, 'Alpina', 'have a good watches', '', 5, 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `cmt_id` int(11) NOT NULL,
  `parent_cmt_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `cmt_status` tinyint(4) NOT NULL DEFAULT '0',
  `cmt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`cmt_id`, `parent_cmt_id`, `comment`, `cmt_status`, `cmt_date`, `item_id`, `member_id`) VALUES
(8, 0, 'jQuery load() Method\r\nThe jQuery load() method is a simple, but powerful AJAX method.\r\n\r\nThe load() method loads data from a server and puts the returned data into the selected element.\r\n\r\nSyntax:\r\n\r\n$(selector).load(URL,data,callback);\r\nThe required URL parameter specifies the URL you wish to load.\r\n\r\nThe optional data parameter specifies a set of querystring key/value pairs to send along with the request.\r\n\r\nThe optional callback parameter is the name of a function to be executed after the load() method is completed.', 0, '2017-12-14 19:07:37', 1, 7),
(10, 0, 'The optional callback parameter specifies a callback function to run when the load() method is completed. The callback function can have different parameters:\r\n\r\nresponseTxt - contains the resulting content if the call succeeds\r\nstatusTxt - contains the status of the call\r\nxhr - contains the XMLHttpRequest object', 0, '2017-12-14 19:14:25', 1, 8),
(34, 0, 'nice', 0, '2018-01-02 02:53:19', 4, 1),
(35, 0, 'ساعة جميلة', 0, '2018-01-02 22:06:07', 1, 4),
(36, 35, 'نعم', 0, '2018-01-02 22:06:55', 1, 1),
(37, 34, 'yes', 0, '2018-01-02 22:59:15', 4, 4),
(39, 0, 'ما شاء الله', 0, '2018-01-03 03:18:52', 1, 1),
(40, 0, 'غالية يا بن عمي', 0, '2018-01-03 03:20:20', 3, 1),
(41, 40, 'هاك تشوف', 0, '2018-01-03 03:21:14', 3, 4),
(42, 0, 'السلام عليكم', 0, '2018-01-03 14:45:02', 1, 1),
(43, 0, 'nice watch', 0, '2018-01-05 21:21:38', 2, 1),
(44, 0, 'شكرا', 0, '2018-01-10 19:03:46', 1, 1),
(45, 44, 'العفو', 0, '2018-01-10 19:05:45', 1, 1),
(46, 42, 'وعليكم السلام', 0, '2018-01-10 19:06:02', 1, 1),
(47, 44, 'العفو', 0, '2018-01-11 21:20:20', 1, 1),
(48, 44, 'hg', 0, '2018-01-11 21:54:54', 1, 1),
(49, 35, 'شكرا', 0, '2018-01-11 21:56:42', 1, 4),
(50, 35, 'رائعة', 0, '2018-01-11 21:57:15', 1, 4),
(51, 10, 'thanks', 0, '2018-01-11 21:58:02', 1, 4),
(52, 0, 'nice', 0, '2018-01-13 13:30:40', 8, 1),
(53, 0, 'good', 0, '2018-01-14 12:29:36', 8, 1),
(54, 35, 'Raouf3D العفو', 0, '2018-01-16 13:52:56', 1, 1),
(56, 34, 'good', 0, '2018-01-17 19:51:46', 4, 1),
(57, 0, 'nice watch', 0, '2018-01-30 03:49:56', 6, 1),
(58, 0, 'top', 0, '2018-01-30 13:42:46', 3, 1),
(59, 58, 'ok', 0, '2018-01-30 13:42:56', 3, 1),
(60, 0, 'good watch', 0, '2018-02-09 15:57:23', 4, 1),
(61, 0, 'h', 0, '2018-02-09 15:57:28', 4, 1),
(62, 0, 'شكرا', 0, '2018-02-15 23:59:15', 5, 1),
(63, 0, 'تاعا', 0, '2018-03-16 02:34:13', 10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `country_made` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_tags` varchar(255) NOT NULL,
  `item_status` varchar(255) NOT NULL,
  `item_rating` tinyint(4) NOT NULL DEFAULT '0',
  `approve_status` tinyint(4) NOT NULL DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `cat_id` smallint(6) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_description`, `price`, `add_date`, `country_made`, `item_image`, `item_tags`, `item_status`, `item_rating`, `approve_status`, `views`, `cat_id`, `member_id`) VALUES
(1, 'CA 86', 'Super powerful watch make with love', '60000', '2018-01-26 21:24:32', 'suisse', '27116.jpg', 'sabercraft,casio', '1', 5, 1, 0, 2, 1),
(2, 'SWATCH SYS', 'very good swatch watch very good', '25000', '2018-01-27 18:26:23', 'suisse', '-blue-watch-suon708.jpg', 'sabercraft ,Swatch,new and mod', '1', 5, 1, 0, 1, 1),
(3, 'CA 98', 'Perfect Watch Perfect Watch', '45000', '2018-01-26 22:53:12', 'suisse', '51S+jxwFl2L.jpg', 'new', '1', 4, 1, 0, 2, 7),
(4, 'SWATCH CORO', 'nice watch nice watch nice watch nice watch nice watch nice watch nice watch ', '15000', '2018-01-26 22:51:40', 'suisse', 'swatch-skinotte-svob100m-.jpg', 'sabercraft,swatch', '1', 4, 1, 0, 1, 1),
(5, 'Sw 16', 'Great Rolex Watch', '35000', '2017-12-17 23:00:00', 'germany', 'rolex6.jpg', '', '2', 3, 1, 0, 1, 7),
(6, 'rolex luxury', 'Awesome rolex watch', '50000', '2017-12-25 23:00:00', 'suisse', 'rolex4.jpg', '', '1', 4, 1, 0, 5, 7),
(7, 'Rolex1', 'nice watch', '20000', '2017-12-20 23:00:00', 'suisse', 'rolex1.jpg', '', '1', 2, 1, 0, 5, 13),
(8, 'Rolex2', 'RolexRolex', '25000', '2018-01-26 20:57:42', 'suisse', 'rolex2.jpg', 'sabercraft', '2', 3, 1, 0, 5, 1),
(9, 'Rolex3', 'RolexRolex', '31000', '2017-12-20 23:00:00', 'suisse', 'rolex3.jpg', '', '3', 4, 1, 0, 5, 7),
(10, 'Rolex4', 'RolexRolex', '46000', '2017-12-20 23:00:00', 'suisse', 'rolex5.jpg', '', '1', 4, 1, 0, 5, 13),
(13, 'rolex 5', 'good rolex', '30000', '2017-12-26 23:00:00', 'suisse', 'rolex7.jpg', '', '1', 0, 1, 0, 5, 4),
(14, 'Swatch san5', 'hjgkgiugkv', '35000', '2017-12-26 23:00:00', 'hglh', 'rolex8.jpg', '', '2', 0, 1, 0, 1, 4),
(24, 'Rolex 6 ', 'good watch', '40000', '2017-12-26 23:00:00', 'suisse', 'rolex9.jpg', '', '1', 0, 1, 0, 5, 4),
(25, 'CA 125', 'nice watch', '35000', '2018-01-30 13:45:46', 'suisse', 'rolex10.jpg', 'sabercraft,casio', '2', 0, 1, 0, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_total` varchar(255) NOT NULL,
  `order_paid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

CREATE TABLE `order_details` (
  `od_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'pour identifier l''utilisateur',
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `full_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT 'identifier le groupe de l''utilisateur',
  `trust_status` int(11) NOT NULL DEFAULT '0' COMMENT 'Classement du vendeur',
  `reg_status` int(11) NOT NULL DEFAULT '0' COMMENT 'approbation de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_image`, `full_name`, `date`, `group_id`, `trust_status`, `reg_status`) VALUES
(1, 'SaberCraft', '7c269d45e17c15a6defc8e36c2f9a95852bfa188', 'sabermac2534@gmail.com', 'Saber-zerguineé.png', 'Saber ZERIGUINE', '2017-11-01', 1, 1, 1),
(4, 'Raouf3D', 'a963fb74b0b9d46527e8250fb64408b031ff2683', 'raouf@gmail.com', 'raouf.png', 'MBARKIYA Raouf', '2017-11-08', 0, 0, 1),
(7, 'OussamaGD', 'ce86478c369649b3a09ce9f5278b10c962736d9f', 'oussama@gmail.com', 'oussama.png', 'NUIOUA Oussama', '2017-11-25', 0, 0, 1),
(8, 'YounesHacker', 'c7329b36a0495cf910391ad2e5f975504b63b59e', 'younes@gmail.com', 'avatar.png', 'DRISSI YOUNES', '2017-11-26', 0, 0, 1),
(13, 'YasinDesign', 'ef689fe51082a4fb5c7fa9122e8fff4ca6b17532', 'yasinGD@gmail.com', 'yasine.png', 'HARRICHE Yasin', '2017-11-27', 0, 0, 1),
(14, 'TaherAlg', 'f70de0e2d1f353c8ae55bdf55d5bee7b1f80565e', 'tahar@gmail.com', 'avatar.png', 'MHAMEL Tahar', '2017-11-29', 0, 0, 0),
(15, 'moha', '9517e4957aac995ccc075fbe352e16d4e60a1087', 'moha@gmail.com', 'avatar.png', 'MOUNA Muhammed', '2017-12-25', 0, 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmt_id`),
  ADD KEY `item_comment` (`item_id`),
  ADD KEY `member_comment` (`member_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `member_1` (`member_id`),
  ADD KEY `cat_1` (`cat_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_user` (`customer_id`);

--
-- Index pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `order_item` (`order_id`),
  ADD KEY `order_details_item` (`item_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pour identifier l''utilisateur', AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `item_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_comment` FOREIGN KEY (`member_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`member_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
