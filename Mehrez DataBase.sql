-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 07 mai 2023 à 19:17
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` blob DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`id`, `idAdmin`, `description`, `picture`, `date`) VALUES
(9, 17, 'You have updated your information', '', '2023-04-13 23:25:35'),
(10, 17, 'You have Added a new Admin :Mahmoud Abid', '', '2023-04-14 00:48:33'),
(11, 17, 'You have Added a new Admin :Mahmoud Abid', '', '2023-04-14 00:49:03'),
(20, 17, 'You have updated your Picture ', '', '2023-04-14 01:17:52'),
(21, 17, 'You have updated your Picture ', '', '2023-04-14 01:18:00'),
(22, 17, 'You have updated your Responsibility to : Product Management', '', '2023-04-14 01:23:03'),
(23, 17, 'You have updated your information', '', '2023-04-14 09:57:21'),
(24, 17, 'You have updated your information', '', '2023-04-14 09:57:25'),
(25, 17, 'You have updated your Responsibility to : zaeazfzef', '', '2023-04-16 15:47:31'),
(26, 17, 'You have updated your Picture ', '', '2023-04-16 15:47:37'),
(27, 17, 'You have updated your Picture ', '', '2023-04-16 15:47:42'),
(28, 17, 'You have updated your information', '', '2023-04-16 15:47:51'),
(29, 17, 'You have updated your Picture ', '', '2023-04-17 10:31:32'),
(30, 3, 'You have updated your Picture ', '', '2023-04-18 13:06:52'),
(31, 3, 'You have updated your Responsibility to : ClientManagment', '', '2023-04-18 13:06:57'),
(32, 3, 'You have updated your information', '', '2023-04-18 13:07:07'),
(33, 17, 'You have updated your Responsibility to : v', '', '2023-04-19 11:44:09'),
(34, 3, 'You have updated your Responsibility to : Promotion', '', '2023-05-07 17:52:58'),
(35, 3, 'You have updated your Responsibility to : Promotion', '', '2023-05-07 17:53:00'),
(36, 3, 'You have updated your Responsibility to : Promotion', '', '2023-05-07 17:53:03'),
(37, 3, 'You have Add the delivery person : ', '', '2023-05-07 18:22:57'),
(38, 3, 'You have Add the delivery person : ', '', '2023-05-07 18:24:38'),
(39, 3, 'You have Add the delivery person : mehrez', '', '2023-05-07 18:26:36'),
(40, 3, 'You have Add the delivery person : mehrez', '', '2023-05-07 18:27:40'),
(41, 3, 'You have updateted the delivery person to : liwa', '', '2023-05-07 18:31:56'),
(42, 3, 'You have assign Mr to the Commande 2', '', '2023-05-07 18:41:20'),
(43, 3, 'You have assign Mr azizto the Commande 2', '', '2023-05-07 18:41:32'),
(44, 3, 'You have add a new CosPlay named :liwa<br> Color : Blue<br> the reference: ezfezf', '', '2023-05-07 19:03:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
