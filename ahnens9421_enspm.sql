-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 25 Août 2025 à 01:51
-- Version du serveur :  5.7.27-0ubuntu0.18.04.1
-- Version de PHP :  7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ahnens9421_enspm`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'departement ahn', '1234'),
(2, 'admin', '1234'),
(3, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ami_id` int(11) NOT NULL,
  `statut` enum('en_attente','accepte','refuse') DEFAULT 'accepte',
  `date_ajout` datetime DEFAULT CURRENT_TIMESTAMP,
  `photo_profil` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id`, `user_id`, `ami_id`, `statut`, `date_ajout`, `photo_profil`) VALUES
(18, 13, 23, 'accepte', '2025-08-12 16:33:32', 'default.jpg'),
(19, 23, 13, 'accepte', '2025-08-12 16:38:36', 'default.jpg'),
(20, 13, 27, 'accepte', '2025-08-16 11:33:41', 'default.jpg'),
(21, 27, 13, 'accepte', '2025-08-16 11:34:03', 'default.jpg'),
(23, 13, 13, 'accepte', '2025-08-17 02:03:54', 'default.jpg'),
(24, 13, 13, 'accepte', '2025-08-17 02:03:58', 'default.jpg'),
(25, 23, 27, 'en_attente', '2025-08-19 12:49:04', 'default.jpg'),
(26, 23, 17, 'en_attente', '2025-08-19 12:49:15', 'default.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `nom`, `prenom`, `photo`, `message`, `created_at`) VALUES
(61, 13, 'BEIDI', 'SAMUEL', '1754436857_sammmmm.png', 'Bonjour j\'ai déjà corrigé certains problèmes, aidez moi à détecter d\'autres.', '2025-08-09 08:31:21'),
(62, 23, 'FEHEM ', 'BENJAMIN ', '1754686213_Screenshot_20250803-202452.png', 'Au niveau de l\'annonce il y\'a toujours les lignes d\'erreur', '2025-08-09 18:12:55'),
(63, 13, 'BEIDI', 'SAMUEL', '1754436857_sammmmm.png', 'D\'accord, j\'ai ajouté une nouvelle fonctionnalité, AMIS allez tester', '2025-08-11 01:23:11'),
(64, 27, 'Nlam kigoue ', 'Steve terence ', 'default.jpg', 'Bonjour', '2025-08-16 11:34:56'),
(65, 27, 'Nlam kigoue ', 'Steve terence ', '1755340568_IMG-20250722-WA0013.jpg', 'Yo', '2025-08-16 11:38:04'),
(66, 13, 'BEIDI', 'SAMUEL', '1754436857_sammmmm.png', 'Résolution de l\'écran effectuée', '2025-08-17 01:32:58'),
(67, 23, 'FEHEM ', 'BENJAMIN ', '1755603794_FB_IMG_1755500283738.jpg', 'Salut la team 👋', '2025-08-19 12:47:16');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(11, 14, 13, 'premier commentaire', '2025-08-09 07:27:13'),
(12, 14, 13, 'http://ahn-enspm.camoo.net/post.php?id=14', '2025-08-17 00:17:04'),
(13, 16, 13, 'Tu n\'as plus travaillé sur l\'affiche là ?', '2025-08-24 20:36:33');

-- --------------------------------------------------------

--
-- Structure de la table `department_news`
--

CREATE TABLE `department_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `department_news`
--

INSERT INTO `department_news` (`id`, `title`, `content`, `created_at`) VALUES
(22, 'Résultats ', 'Les résultats de la session normale et rattrapage sont disponibles sur la page résultats.', '2025-08-08 16:28:13'),
(23, 'Rentrée académique 2025-2026', 'La rentrée académique est programmée pour le 11 septembre', '2025-08-08 19:09:06'),
(30, 'Rentrée académique', 'La rentrée est programmée pour le 11 octobre', '2025-08-08 20:46:59');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `filiere` varchar(100) DEFAULT NULL,
  `bio` text,
  `email` varchar(150) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `nom`, `prenom`, `matricule`, `numero`, `filiere`, `bio`, `email`, `mot_de_passe`, `photo_profil`) VALUES
(13, 'BEIDI', 'SAMUEL', '18A1093FS', '697241071', 'INFORMATIQUE ', 'Ingénieur réseaux et systèmes ', 'beidisamuel11@gmail.com', '$2y$10$ydoOh301Ba7qkoPGQW/yYe8Q1d5IqCNRYkl5onPZez7DzQvQJYBtK', '1754436857_sammmmm.png'),
(17, 'Matchinda', 'Anelka', '24ENSPM284', '670653411', 'IHN', NULL, 'anelkafabiola7@gmail.com', '$2y$10$b8xMOuIDe0pQttDTJXMAOe2Y6rqKONSe9sI6zjOb25d9gN1j/pAP.', 'default.jpg'),
(18, 'Namekong', 'Ivanelle', '24ENSPM186', '689666604', 'IHN', NULL, 'ivanellenamakong@gmail.com', '$2y$10$6i9wnlfHpWvRqd5RRLp/DOjCVJ1lnYmHbxAWzfxaeJgOYVbHkT8AW', 'default.jpg'),
(19, 'Abdou', 'Abdoulaye Wirngo', '24ENSPM178', '621419409', 'IAN', 'Never Give Up\r\n', 'abdoulatifwirngo02@gmail.com', '$2y$10$uMdMLZyg0U8ZkunW16p52.ybyexlApxw2.qD830115MgCriN833DO', '1754681878_1727559455126.jpg'),
(23, 'FEHEM ', 'BENJAMIN ', '24ENSPM017', '678993543', 'IAN', 'Focus 🧠', 'benjaminfehem@gmail.com', '$2y$10$/rrTEYt5czgYSTQ8GETAhulm8baxTGAAdrPvL5X2D1LJ3Fear.BAG', '1755603794_FB_IMG_1755500283738.jpg'),
(27, 'Nlam kigoue ', 'Steve terence ', '24ENSPM280 ', '688283514', 'IAN ', '', 'nsteveterence@gmail.com', '$2y$10$OG1RaApHHA34kiAXXLS7sOiyTgOaePC1A25X9YSxRCPKgvkjMUqj2', '1755340834_a068fbdcee3d4f0599268ce466fedfc2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(279, 16, 14, '2025-08-09 11:06:48'),
(281, 27, 14, '2025-08-16 10:32:05'),
(312, 13, 14, '2025-08-17 00:26:03'),
(314, 13, 15, '2025-08-17 01:02:34'),
(315, 19, 14, '2025-08-18 18:44:59'),
(316, 23, 16, '2025-08-19 11:45:07'),
(317, 23, 14, '2025-08-19 11:45:33'),
(318, 13, 16, '2025-08-24 20:34:30');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `file_path`, `created_at`) VALUES
(14, 13, 'Juste envie de poster', '6896f773431b8.jpeg', '2025-08-09 07:23:31'),
(15, 13, 'Le développement de l\'app se passe bien 😅', NULL, '2025-08-17 00:25:34'),
(16, 23, 'Affiche wajonautes', '68a463b23fc75.png', '2025-08-19 11:44:50');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `filiere` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ami_id` (`ami_id`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `department_news`
--
ALTER TABLE `department_news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`user_id`,`post_id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `department_news`
--
ALTER TABLE `department_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `etudiants` (`id`),
  ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`ami_id`) REFERENCES `etudiants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
