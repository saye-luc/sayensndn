-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 juil. 2022 à 13:29
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vol`
--

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `num_piece` varchar(30) NOT NULL,
  `nom_passager` varchar(50) NOT NULL,
  `prenom_passager` varchar(50) NOT NULL,
  `sexe` varchar(15) NOT NULL,
  `choix_class` varchar(20) NOT NULL,
  `code_vol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`num_piece`, `nom_passager`, `prenom_passager`, `sexe`, `choix_class`, `code_vol`) VALUES
('', '', '', '', '', ''),
('112', 'VNBC', 'VCXCX', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `secret`
--

CREATE TABLE `secret` (
  `login` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `secret`
--

INSERT INTO `secret` (`login`, `id`, `password`) VALUES
('soya', 2, '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Structure de la table `vol`
--

CREATE TABLE `vol` (
  `code_vol` varchar(20) NOT NULL,
  `date_depart` date NOT NULL,
  `heure_depart` varchar(20) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `nb_classe_a` int(6) NOT NULL,
  `nb_classe_b` int(6) NOT NULL,
  `prix_classe_a` int(11) NOT NULL,
  `prix_classe_b` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vol`
--

INSERT INTO `vol` (`code_vol`, `date_depart`, `heure_depart`, `destination`, `nb_classe_a`, `nb_classe_b`, `prix_classe_a`, `prix_classe_b`) VALUES
('V123', '2022-07-21', '13:01', 'Paris', 10, 20, 1000000, 123000),
('V15', '2022-06-22', '15:02', 'New york', 154, 20, 100000, 100000);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`num_piece`);

--
-- Index pour la table `secret`
--
ALTER TABLE `secret`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vol`
--
ALTER TABLE `vol`
  ADD PRIMARY KEY (`code_vol`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `secret`
--
ALTER TABLE `secret`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
