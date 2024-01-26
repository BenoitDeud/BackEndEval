-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 jan. 2024 à 12:56
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ministore`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3AF34668727ACA70` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `nom`) VALUES
(1, NULL, 'Telephones'),
(2, NULL, 'Montres');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `adresse_livraison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_35D4282CAEA34913` (`reference`),
  KEY `IDX_35D4282CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `user_id`, `reference`, `created_at`, `adresse_livraison`) VALUES
(73, 2, '65afb2b1b1c8e', '2024-01-23 12:36:01', 'BEAUTY PHONE, 2 RUE DU FAUBOURG DES POSTES, 59000, LILLE'),
(74, 2, '65afd025bcfdd', '2024-01-23 14:41:41', 'DEUDON benoit, 123, 59174, La Sentinelle'),
(75, 5, '65afd39201fc4', '2024-01-23 14:56:18', 'Martin Matin, 60 avenue des lillas, 59300, Valenciennes'),
(76, 2, '65afd58d0a942', '2024-01-23 15:04:45', 'BEAUTY PHONE, 2 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(77, 2, '65afd89c7efa9', '2024-01-23 15:17:48', 'DEUDON benoit, 123, 59174, La Sentinelle'),
(78, 2, '65b11a918d7f9', '2024-01-24 14:11:29', 'UNIQUE COIN, 89 BOULEVARD MONTEBELLO null, 59000, LILLE'),
(79, 2, '65b120ef24096', '2024-01-24 14:38:39', 'SPAR VALENCIENNES, 189 RUE LOMPREZ null, 59300, VALENCIENNES'),
(80, 2, '65b212678a3da', '2024-01-25 07:48:55', 'BEAUTY PHONE, 2 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(81, 2, '65b235b7941ae', '2024-01-25 10:19:35', 'DIGITAL LOUNGE AND LABS, 35 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(83, 2, '65b23c81129d5', '2024-01-25 10:48:33', 'DEUDON benoit, 123, 59174, La Sentinelle'),
(85, 2, '65b36b959cc27', '2024-01-26 08:21:41', 'DIGITAL LOUNGE AND LABS, 35 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(86, 2, '65b3719aaae60', '2024-01-26 08:47:22', 'DESTOCK COMMERCE LILLE, 30 RUE GUSTAVE NADAUD null, 59000, LILLE'),
(87, 6, '65b374107f63d', '2024-01-26 08:57:52', 'DEUDON Gabriel, 60 avenue des lillas, 59300, Valenciennes'),
(88, 6, '65b378f9beca9', '2024-01-26 09:18:49', 'DEUDON Gabriel, 60 avenue d, 59300, Valencienne'),
(89, 6, '65b37914a9ea8', '2024-01-26 09:19:16', 'BEAUTY PHONE, 2 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(90, 6, '65b37bbfa8f9a', '2024-01-26 09:30:39', 'DEUDON Gabriel, 60 avenue d, 59300, Valencienne'),
(161, 2, '65b38d0d340e8', '2024-01-26 10:44:29', 'BEAUTY PHONE, 2 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(162, 2, '65b38d8b940c5', '2024-01-26 10:46:35', 'DESTOCK COMMERCE LILLE, 30 RUE GUSTAVE NADAUD null, 59000, LILLE'),
(163, 2, '65b38ef334f7f', '2024-01-26 10:52:35', 'DEUDON benoit, 123 de la poste toujours fermé, 59174, La Sentinelle'),
(164, 2, '65b3aa4b8823d', '2024-01-26 12:49:15', 'DEUDON benoit, 123 de la poste toujours fermé, 59174, La Sentinelle'),
(165, 2, '65b3abdc265fe', '2024-01-26 12:55:56', 'DEUDON benoit, 123 de la poste toujours fermé oui, 59174, La Sentinelle');

-- --------------------------------------------------------

--
-- Structure de la table `details_commandes`
--

DROP TABLE IF EXISTS `details_commandes`;
CREATE TABLE IF NOT EXISTS `details_commandes` (
  `commandes_id` int NOT NULL,
  `produits_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` int NOT NULL,
  PRIMARY KEY (`commandes_id`,`produits_id`),
  KEY `IDX_4FD424F78BF5C2E6` (`commandes_id`),
  KEY `IDX_4FD424F7CD11A2CF` (`produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `details_commandes`
--

INSERT INTO `details_commandes` (`commandes_id`, `produits_id`, `quantite`, `prix`) VALUES
(73, 1, 2, 2800),
(73, 2, 4, 9999),
(74, 2, 1, 9999),
(75, 2, 1, 9999),
(76, 2, 1, 9999),
(77, 1, 1, 2800),
(77, 2, 1, 9999),
(78, 1, 2, 2800),
(78, 4, 1, 350),
(79, 1, 1, 2800),
(80, 1, 1, 2800),
(80, 4, 1, 350),
(81, 1, 2, 2800),
(81, 4, 1, 350),
(83, 1, 2, 2800),
(83, 4, 1, 350),
(85, 1, 1, 2800),
(86, 3, 1, 3000),
(87, 3, 1, 3000),
(87, 5, 1, 999),
(88, 1, 1, 2800),
(88, 3, 1, 3000),
(89, 1, 1, 2800),
(90, 1, 1, 2800),
(161, 1, 1, 2800),
(162, 1, 1, 2800),
(162, 2, 1, 9999),
(163, 1, 1, 2800),
(163, 2, 1, 9999),
(163, 6, 1, 9999),
(164, 1, 1, 2800),
(165, 1, 1, 2800);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240103145207', '2024-01-03 14:52:15', 50),
('DoctrineMigrations\\Version20240104081224', '2024-01-04 08:12:45', 78),
('DoctrineMigrations\\Version20240104083956', '2024-01-04 08:40:01', 15),
('DoctrineMigrations\\Version20240104084422', '2024-01-04 08:44:26', 23),
('DoctrineMigrations\\Version20240111092901', '2024-01-11 09:29:48', 293),
('DoctrineMigrations\\Version20240116130311', '2024-01-16 13:03:27', 58),
('DoctrineMigrations\\Version20240122124143', '2024-01-22 12:41:58', 46),
('DoctrineMigrations\\Version20240122125643', '2024-01-22 12:56:48', 93),
('DoctrineMigrations\\Version20240125081944', '2024-01-25 08:20:00', 63),
('DoctrineMigrations\\Version20240125131734', '2024-01-25 13:18:50', 58);

-- --------------------------------------------------------

--
-- Structure de la table `logo`
--

DROP TABLE IF EXISTS `logo`;
CREATE TABLE IF NOT EXISTS `logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logo_store` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `logo`
--

INSERT INTO `logo` (`id`, `logo_store`) VALUES
(1, 'sono3000.png');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `navbar`
--

DROP TABLE IF EXISTS `navbar`;
CREATE TABLE IF NOT EXISTS `navbar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `navbar`
--

INSERT INTO `navbar` (`id`, `nom`, `lien`) VALUES
(3, 'Home', '/'),
(5, 'Produits', '/produits');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categories_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BE2DDF8CA21214B7` (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `categories_id`, `nom`, `description`, `prix`, `stock`, `created_at`, `image`) VALUES
(1, 1, 'Ifone', 'trop chère', 2800, 163, '2024-01-11 10:57:08', 'cart-item1.jpg'),
(2, 2, 'Rolex', 'le cadran n\'est pas garantie', 9999, 5, '2024-01-11 10:59:17', 'insta-item2.jpg'),
(3, 1, 'Ifone s30', 'l\'appareil photo à 3px de plus que le précèdent', 3000, 79, '2024-01-11 11:01:12', 'product-item5.jpg'),
(4, 2, 'Iswatch', 'une montre avec une autonomie de 12h juste pour regarder l\'heure', 350, 27, '2024-01-11 11:02:19', 'cart-item2.jpg'),
(5, 2, 'raul-ex', 'la version wish', 999, 35, '2024-01-12 08:49:40', 'product-item10.jpg'),
(6, 2, 'Rolexlex', 'trop chère vraiment', 9999, 0, '2024-01-26 09:52:47', 'sono3000.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `tel` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_fav` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_fav` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville_fav` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `image_user`, `nom_user`, `prenom_user`, `pseudo_user`, `created_at`, `tel`, `adresse`, `code_postal`, `ville`, `adresse_fav`, `code_fav`, `ville_fav`) VALUES
(2, 'jesuidds@outlook.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$SxglgvbfyleqKJdEaANkgux5BblfIPY.1ZFmvaG9QdWmdsYm32916', '572d5d7dddf8.jpg', 'DEUDON', 'benoit', 'MoiAdmin', '2024-01-04 12:48:05', '0102030405', '123 de la poste toujours fermé oui', '59174', 'La Sentinelle', '123 de la poste toujours fermé', '59174', 'La Sentinelle'),
(5, 'raton@gmail.com', '[\"ROLE_USER\"]', '$2y$13$COoYk/JcmtQBlII1qs1a5OQmOx/5y/yzAM55xoFe7BnY0ESEd4DM2', 'sono2.png', 'Martin', 'Matin', 'Raton-laveur', '2024-01-23 14:55:24', '0601020304', '60 avenue des lillas', '59300', 'Valenciennes', NULL, NULL, NULL),
(6, 'jesuid@outlook.fr', '[\"ROLE_USER\"]', '$2y$13$uWZ.xY5wEPtRE7DwAObCt.JNmygJ3S/XYp20Xnfuwbsq5Ih0COvJW', '0d3540a96164.png', 'DEUDON', 'Gabriel', 'moiMoch', '2024-01-26 08:56:20', '0102030405', '60 avenue d', '59300', 'Valencienne', '60 avenue des lilla', '59300', 'Valenciennes');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_3AF34668727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `details_commandes`
--
ALTER TABLE `details_commandes`
  ADD CONSTRAINT `FK_4FD424F78BF5C2E6` FOREIGN KEY (`commandes_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `FK_4FD424F7CD11A2CF` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8CA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
