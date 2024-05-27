-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 mai 2024 à 00:18
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'admin2', 'a@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(10, 'Mrabet med', 'mrabet@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 26.90, 'payé', 17, 623149857, 'Oujda', 'N* 57, Rue Laayoune, Hay Chohadae, Oujda', '2024-05-26 12:51:18'),
(2, 9.00, 'impayé', 17, 623149857, 'Oujda', 'N* 57, Rue Laayoune, Hay Chohadae, Oujda', '2024-05-26 12:52:14'),
(3, 24.35, 'payé', 17, 623149857, 'Oujda', 'N* 57, Rue Laayoune, Hay Chohadae, Oujda', '2024-05-26 12:52:40'),
(4, 7.99, 'payé', 17, 623149857, 'Oujda', 'N* 57, Rue Laayoune, Hay Chohadae, Oujda', '2024-05-26 13:12:46'),
(5, 23.45, 'impayé', 17, 623149857, 'Oujda', 'N* 57, Rue Laayoune, Hay Chohadae, Oujda', '2024-05-26 13:26:17'),
(117, 50.35, 'impayé', 10, 1234567890, 'casa', 'bv medvii casa', '2024-05-26 16:19:46');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, 7, 'Manteau', 'clothes5.png', 26.00, 1, 17, '2024-05-26 12:51:18'),
(2, 2, 8, 'Pantalon de sport', 'clothes2.png', 9.00, 1, 17, '2024-05-26 12:52:14'),
(3, 3, 16, 'Monteau homme', 'Montaux0.png', 12.00, 1, 17, '2024-05-26 12:52:40'),
(4, 3, 15, 'Sac a dos', 'Gray bug1.png', 12.00, 1, 17, '2024-05-26 12:52:40'),
(5, 5, 4, 'Sac de voyage', 'featured5.png', 23.00, 1, 17, '2024-05-26 13:26:17'),
(172, 117, 4, 'Sac de voyage', 'featured5.png', 23.00, 1, 10, '2024-05-26 16:19:46'),
(173, 117, 7, 'Manteau', 'clothes5.png', 26.00, 1, 10, '2024-05-26 16:19:46');

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
(1, 16, 1, '7L4897603G7534706', '2024-04-17 19:57:11'),
(2, 15, 1, '3W784090A8572554K', '2024-04-17 20:35:07'),
(3, 20, 1, '1AG64435BT185263K', '2024-04-17 23:11:38'),
(4, 21, 4, '6V4321442E440604J', '2024-04-18 12:56:44'),
(5, 23, 5, '5GE19468XP053882R', '2024-04-23 16:19:57'),
(6, 32, 1, '3XB85213TD211254A', '2024-04-25 13:08:55'),
(7, 32, 1, '50X21283G3521691A', '2024-04-25 16:45:50'),
(8, 34, 8, '9R500548P8094311K', '2024-05-04 00:38:16'),
(9, 36, 9, '9DP18950J4477703E', '2024-05-07 17:14:01'),
(10, 38, 9, '5X129338C5593835T', '2024-05-07 17:22:26'),
(11, 42, 9, '7XR12275LV728463W', '2024-05-07 18:31:57'),
(12, 44, 9, '5EW02825YY9995538', '2024-05-07 18:43:55'),
(13, 45, 9, '8E155965B70627419', '2024-05-07 18:47:29'),
(14, 46, 9, '26663981H23579125', '2024-05-07 18:56:22'),
(15, 47, 9, '9T683895DY0947224', '2024-05-07 19:00:33'),
(16, 48, 9, '49L746416C6601122', '2024-05-07 19:01:52'),
(17, 49, 9, '0LK5938495681222B', '2024-05-07 19:03:43'),
(18, 50, 9, '65Y09081V7079040C', '2024-05-07 19:16:19'),
(19, 51, 9, '64Y86865WR9156114', '2024-05-07 19:18:37'),
(20, 52, 9, '0GJ85253JP857144K', '2024-05-07 19:19:23'),
(21, 53, 9, '8T253618YR778704D', '2024-05-07 19:28:38'),
(22, 54, 9, '1NY497473R5479013', '2024-05-07 19:38:24'),
(23, 55, 9, '7K202925JE895872H', '2024-05-07 19:40:44'),
(24, 56, 9, '2JK61506PM1137139', '2024-05-07 19:42:03'),
(25, 57, 9, '71V47891B85125156', '2024-05-07 19:42:59'),
(26, 58, 9, '2RT90527VA840281P', '2024-05-07 19:44:50'),
(27, 59, 9, '0VS28065NN075132H', '2024-05-07 19:48:08'),
(28, 60, 9, '867109083B2207900', '2024-05-07 19:59:56'),
(29, 61, 9, '5JG10559EF9311412', '2024-05-07 20:01:00'),
(30, 62, 9, '7F743715DT533563L', '2024-05-07 20:02:11'),
(31, 63, 9, '8KR11365333952918', '2024-05-07 20:03:29'),
(32, 64, 9, '2S398681XJ355551W', '2024-05-07 20:04:20'),
(33, 65, 9, '0J317916K79529435', '2024-05-07 20:05:24'),
(34, 66, 9, '1R0795306R341843L', '2024-05-07 20:07:03'),
(35, 67, 9, '8XX31024NK3293107', '2024-05-07 20:28:23'),
(36, 68, 9, '8MU94208UK7425015', '2024-05-07 20:39:36'),
(37, 69, 9, '32J72533P4236064F', '2024-05-07 20:51:31'),
(38, 70, 9, '6RM30799F7673554M', '2024-05-07 20:54:26'),
(39, 71, 9, '7AF13854J9620115A', '2024-05-08 13:35:15'),
(40, 72, 9, '7C505831E98294504', '2024-05-08 13:39:01'),
(41, 73, 9, '40S75507VS080840K', '2024-05-08 13:40:06'),
(42, 74, 9, '80S48663WA718921K', '2024-05-08 13:44:56'),
(43, 75, 9, '6R151640XY065790F', '2024-05-08 13:50:34'),
(44, 76, 9, '5UL15349DL1669607', '2024-05-08 13:52:36'),
(45, 77, 9, '15G69093V6315943J', '2024-05-08 13:58:08'),
(46, 78, 9, '8B00307393015062C', '2024-05-08 13:59:21'),
(47, 79, 9, '3YW143190K863523D', '2024-05-08 14:00:33'),
(48, 80, 9, '98S691535G5620803', '2024-05-08 14:03:25'),
(49, 81, 9, '8HJ97236YV7101702', '2024-05-08 14:05:02'),
(50, 82, 9, '0KT03130GX177712F', '2024-05-08 15:29:14'),
(51, 83, 9, '717477225S3317519', '2024-05-09 01:29:44'),
(52, 84, 9, '0BG44603BR8272537', '2024-05-09 01:32:23'),
(53, 101, 16, '67961821YJ8497115', '2024-05-25 20:01:51'),
(54, 102, 16, '0C195375BL961873Y', '2024-05-25 20:03:36'),
(55, 103, 16, '7WA7319216715034G', '2024-05-25 20:04:13'),
(56, 107, 17, '6N6262222M992413D', '2024-05-26 12:58:13'),
(57, 105, 17, '8HP52134F18747212', '2024-05-26 13:04:16'),
(58, 108, 17, '02D504098U0394034', '2024-05-26 13:13:33');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(108) NOT NULL,
  `quantite` int(11) UNSIGNED NOT NULL,
  `nbreVisite` int(10) UNSIGNED NOT NULL,
  `nbreClick` int(10) UNSIGNED NOT NULL,
  `nbreVendu` int(11) UNSIGNED NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image1` varchar(255) DEFAULT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  `product_price` decimal(6,2) UNSIGNED NOT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(108) DEFAULT NULL,
  `date_appro` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `quantite`, `nbreVisite`, `nbreClick`, `nbreVendu`, `product_description`, `product_image`, `product_image1`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`, `date_appro`) VALUES
(4, 'Sac de voyage', 'bags', 10, 1, 29, 6, 'Sac a dos  en plusieurs couleurs :rouge, noir, blanc et bleu pour étudiants garcons et filles', 'Sac de voyage0.png', 'Sac de voyage1.png', 'Sac de voyage2.png', 'Sac de voyage3.png', 'Sac de voyage4.png', 23.45, 0, 'Rouge', '2024-02-18 07:02:25'),
(6, 'Manteau sportif', 'coats', 6, 2, 27, 21, 'Manteau de mmeilleur qualité en plusieurs couleurs :noir, blanc,.. pour les garcons', 'Manteau sportif0.png', 'Manteau sportif1.png', 'Manteau sportif2.png', 'Manteau sportif3.png', 'Manteau sportif4.png', 7.99, 0, 'Noir', '2024-04-20 10:07:31'),
(7, 'Manteau', 'coats', 11, 2, 36, 9, 'Manteau blue pour les garcons', 'Manteau0.png', 'Manteau1.png', 'Manteau2.png', 'Manteau3.png', 'Manteau4.png', 26.90, 0, 'Blue', '2024-04-22 23:02:07'),
(8, 'generic-survetement', 'coats', 9, 2, 50, 17, 'Partagez ce produit Survêtement noir sweatacapcuhe/pantalon simple unisex femme/homme haute qualité', 'generic-survetement0.png', 'generic-survetement1.png', 'generic-survetement2.png', 'generic-survetement3.png', 'generic-survetement4.png', 19.99, 20, NULL, '2024-04-23 16:02:33'),
(15, 'Sac a dos', 'bags', 5, 1, 6, 4, 'Sac à dos gris moderne en RPET 600D résistant et en plastique recyclé pour aider la durabilité de la planète.  Ce sac à dos moderne est idéal pour les garçons et est livré avec une fermeture zippée et une poche avant. Les coins sont renforcés pour lui don', 'Sac a dos0.png', 'Sac a dos1.png', 'Sac a dos2.png', 'Sac a dos3.png', 'Sac a dos4.png', 12.00, 18, 'Gray', '2024-05-08 13:25:06'),
(16, 'Monteau homme', 'coats', 16, 2, 12, 1, 'manteau pour homme belle Allthemen Manteau Homme Hiver Mi-Long Trench Coat en Laine Chaud Veste Slim Parka Couleur Unie Pardessus Coupe Vent', 'Montaux0.png', 'Montaux1.png', 'Montaux2.png', 'Montaux3.png', 'Montaux4.png', 12.35, 20, 'Gris', '2024-05-26 04:34:40'),
(17, 'Veste homme', 'coats', 11, 0, 6, 0, 'Notre Veste est d\'haut qualitée et de plusieur couleur tel que le bleu et le noir..', 'Veste rose0.png', 'Veste rose1.png', 'Veste rose2.png', 'Veste rose3.png', 'Veste rose4.png', 16.95, 30, NULL, '2024-05-26 17:04:22');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_city`, `user_address`) VALUES
(10, 'yassine', 'yassine@gmail.com', 'e19d5cd5af0378da05f63f891c7467af', 1234567890, 'casa', 'bv medvii casa'),
(15, 'Alaoui Yassine', 'alaouiyass24@gmail.com', 'e19d5cd5af0378da05f63f891c7467af', 645791203, 'fes', 'hay chohadae fes city'),
(17, 'Benali Ahmed', 'benali.a@gmail.com', '0369d98a00ba1ca13f51239278d7c2ce', 623149857, 'Oujda', 'N* 57, Rue Laayoune, Hay Chohadae, Oujda'),
(18, 'Mrabet Mohammed', 'mrabet@gmail.com', '0369d98a00ba1ca13f51239278d7c2ce', 658710390, 'Berkane', 'N* 21, Rue 330, Hay Elmoukaouama, Berkane'),
(19, 'BOUAZZA ABDERHMAN', 'bouazza@gmai.com', '0369d98a00ba1ca13f51239278d7c2ce', 623458910, 'Oujda', 'N* 65, Rue Alhikmae, Hay Essalam, Oujda');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
