-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 07 mai 2023 à 14:00
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
-- Base de données : `bookflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `publicitee`
--

CREATE TABLE `publicitee` (
  `id` int(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `imagee` varchar(100) NOT NULL,
  `descriptions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `publicitee`
--

INSERT INTO `publicitee` (`id`, `nom`, `date1`, `date2`, `imagee`, `descriptions`) VALUES
(70, 'dshxs new', '2023-05-12', '2023-05-28', '888.jpg', 'xshjx'),
(71, 'dsh', '2023-05-19', '2023-05-31', '999.jpg', 'dshj');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `publicitee`
--
ALTER TABLE `publicitee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `publicitee`
--
ALTER TABLE `publicitee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
