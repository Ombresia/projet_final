-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 11 Juin 2017 à 19:05
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `edc`
--
DROP DATABASE `edc`;
CREATE DATABASE IF NOT EXISTS `edc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci;
USE `edc`;

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `region` varchar(100) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `country` varchar(30) NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_artist` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `id_addr` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `e-mail` varchar(100) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `artist`
--

INSERT INTO `artist` (`id`, `id_addr`, `firstname`, `lastname`, `phone_number`, `e-mail`, `bio`) VALUES
(1, 1, 'Christine', 'Ngoy', ' 438 925 3844 ', 'kristine78@hotmail.ca', 'Originaire du Cameroun, c’est à l’âge de dix ans que j’ai gagné ma première poupée lors d’un concours de dessin. Ce jour-là, j’ai dit à ma mère que dessiner serait mon métier, c’est pourquoi j’ai étudié la mode et la décoration d’intérieur. La cuisine et la pâtisserie, deux autres formes d’art à mes yeux, vinrent s’ajouter par la suite, comme tant de cordes à mon arc.\r\n\r\nC’est en 2011 que j’ai vraiment commencé à explorer les arts en commençant à peindre sur différentes matières, telles que la toile, l’acier, le bois puis la vitre. J’ai également touché à la sculpture sur bois, acier et textile, puis à la pierre et l’argile. Finalement, c’est sur la vitre que mon choix s\'est arrêté.\r\n\r\nPour réduire les coûts et pousser plus loin mes nombreuses idées, j’ai appris à fabriquer mes propres couleurs et à les adapter à la peinture sur vitre. J’ai alors commencé par peindre l’Afrique d’autrefois. Je souhaitais montrer le peuple africain tel qu’il était avant l’influence européenne, avec les nombreuses traditions qui le définisse.\r\n\r\nÀ l’époque, je vivais dans une petite ville où mes enfants n’avaient pas d’amis à cause de leurs différences. Un jour, mon fils est rentré de l’école et m’a dit :\r\n\r\n« Maman, personne ne m’aime. »\r\n\r\nÀ partir de ce jour, j’ai commencé à peindre le présent, et non plus le passé, en utilisant toutes les couleurs possibles et inimaginables, car c’est ainsi que je souhaite voir le monde.');

-- --------------------------------------------------------

--
-- Structure de la table `artwork`
--

DROP TABLE IF EXISTS `artwork`;
CREATE TABLE `artwork` (
  `id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_artist` int(11) NOT NULL,
  `art_title` varchar(100) NOT NULL,
  `art_description` text,
  `width` float DEFAULT NULL,
  `heigth` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `artwork`
--

INSERT INTO `artwork` (`id`, `id_cat`, `id_artist`, `art_title`, `art_description`, `width`, `heigth`, `price`, `date_published`, `date_created`) VALUES
(1, 2, 1, 'Série Afrique d\'autrefois', 'En souvenir de mon père', 50.8, 40.64, NULL, '2017-06-07', NULL),
(2, 2, 1, 'Série Afrique d\'autrefois', 'En souvenir de mon père', 50.8, 40.64, NULL, '2017-06-07', NULL),
(3, 2, 1, 'Série Afrique d\'autrefois', 'En souvenir de mon père', 50.8, 40.64, NULL, '2017-06-07', NULL),
(4, 2, 1, 'Série Afrique d\'autrefois', 'En souvenir de mon père', 50.8, 40.64, NULL, '2017-06-07', NULL),
(5, 2, 1, 'Série Afrique d\'autrefois', 'En souvenir de mon père', 50.8, 40.64, NULL, '2017-06-07', NULL),
(6, 2, 1, 'Série Afrique d\'autrefois', 'En souvenir de mon père', 50.8, 40.64, NULL, '2017-06-07', NULL),
(7, 2, 1, 'Série Afrique d\'autrefois', 'En souvenir de mon père', 50.8, 40.64, NULL, '2017-06-07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `cat_description` text,
  `cat_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `cat_title`, `cat_description`, `cat_type`) VALUES
(2, 'Faux-vitrail', 'Peinture sur vitre', 'artworks'),
(3, 'Peinture sur bois', 'Peinture à l`huile sur du bois', 'artworks');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `fk_id` int(11) NOT NULL,
  `com_username` varchar(30) NOT NULL,
  `com_title` varchar(100) NOT NULL,
  `com_body` text,
  `com_date` date NOT NULL,
  `approved` varchar(1) NOT NULL DEFAULT 'N',
  `com_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `id_addr` int(11) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `fk_id` int(11) NOT NULL,
  `image_path` varchar(1000) COLLATE utf8_general_mysql500_ci NOT NULL,
  `image_type` varchar(30) COLLATE utf8_general_mysql500_ci NOT NULL,
  `data_size` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `content_type` varchar(30) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `fk_id`, `image_path`, `image_type`, `data_size`, `content_type`) VALUES
(1, 1, 'images/original/28.jpg', 'original', '740x610', 'artworks'),
(3, 1, 'images/thumbs/28.jpg', 'thumbs', NULL, 'artworks'),
(4, 2, 'images/original/36.jpg', 'original', '715x602', 'artworks'),
(6, 2, 'images/thumbs/36.jpg', 'thumbs', NULL, 'artworks'),
(8, 3, 'images/original/37.jpg', 'original', '765x607', 'artworks'),
(9, 3, 'images/thumbs/37.jpg', 'thumbs', NULL, 'artworks'),
(10, 4, 'images/original/38.jpg', 'original', '784x610', 'artworks'),
(11, 4, 'images/thumbs/38.jpg', 'thumbs', NULL, 'artworks'),
(12, 5, 'images/original/39.jpg', 'original', '766x602', 'artworks'),
(13, 5, 'images/thumbs/39.jpg', 'thumbs', NULL, 'artworks'),
(14, 6, 'images/original/29.jpg', 'original', '755x600', 'artworks'),
(15, 6, 'images/thumbs/29.jpg', 'thumbs', NULL, 'artworks'),
(17, 7, 'images/original/40.jpg', 'original', '752x605', 'artworks'),
(18, 7, 'images/thumbs/40.jpg', 'thumbs', NULL, 'artworks');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` varchar(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(2, 'admin', '$2y$10$9th2FRop.CLyO9N3Js3TCehh3WGKyYbLz/xaZo3oZ9vBGu7PxHZkS', 'Y');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ARTIST_ID` (`id_artist`) USING BTREE,
  ADD KEY `FK_CAT_ID` (`id_cat`) USING BTREE;
ALTER TABLE `articles` ADD FULLTEXT KEY `IDX_ART_BODY` (`title`,`body`);

--
-- Index pour la table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_ADDRESS_ID` (`id_addr`) USING BTREE;

--
-- Index pour la table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_CATEGORY_ID` (`id_cat`) USING BTREE,
  ADD KEY `FK_ARTIST_ID` (`id_artist`) USING BTREE;
ALTER TABLE `artwork` ADD FULLTEXT KEY `IDX_ART_DESC` (`art_title`,`art_description`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `IDX_CAT_TITLE` (`cat_title`) USING BTREE;

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`) USING BTREE,
  ADD KEY `FK_ARTICLE_ID` (`fk_id`) USING BTREE,
  ADD KEY `IDX_COM_TYPE` (`com_type`) USING BTREE;
ALTER TABLE `comments` ADD FULLTEXT KEY `IDX_TITLE_BODY` (`com_title`,`com_body`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`) USING BTREE,
  ADD KEY `FK_ADDRESS_ID` (`id_addr`) USING BTREE;

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `IDX_CONTENT_TYPE` (`content_type`) USING BTREE,
  ADD KEY `FK_ID_IDX` (`fk_id`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;