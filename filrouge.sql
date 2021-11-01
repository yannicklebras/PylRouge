-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 01 nov. 2021 à 21:31
-- Version du serveur :  8.0.27-0ubuntu0.21.04.1
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `filrouge`
--

-- --------------------------------------------------------

--
-- Structure de la table `CASTEST`
--

CREATE TABLE `CASTEST` (
  `id` int NOT NULL,
  `question` int NOT NULL,
  `entree` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `CLASSES`
--

CREATE TABLE `CLASSES` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enseignant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `DETAILSREPONSES`
--

CREATE TABLE `DETAILSREPONSES` (
  `id` int NOT NULL,
  `fil` int NOT NULL,
  `etudiant` int NOT NULL,
  `castest` int NOT NULL,
  `resultat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entree` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ELEVES`
--

CREATE TABLE `ELEVES` (
  `id` int NOT NULL,
  `nom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifiant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ENSEIGNANTS`
--

CREATE TABLE `ENSEIGNANTS` (
  `id` int NOT NULL,
  `nom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `FILSROUGES`
--

CREATE TABLE `FILSROUGES` (
  `id` int NOT NULL,
  `question` int NOT NULL,
  `datedebut` datetime NOT NULL,
  `datefin` datetime NOT NULL,
  `classe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONS`
--

CREATE TABLE `QUESTIONS` (
  `id` int NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enonce` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prerempli` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` int NOT NULL,
  `retour` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enseignant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `REPONSES`
--

CREATE TABLE `REPONSES` (
  `id` int NOT NULL,
  `filrouge` int NOT NULL,
  `eleve` int NOT NULL,
  `date` datetime NOT NULL,
  `etat` int NOT NULL DEFAULT '0',
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `TOKEN`
--

CREATE TABLE `TOKEN` (
  `id` int NOT NULL,
  `enseignant` int NOT NULL DEFAULT '-1',
  `etudiant` int NOT NULL DEFAULT '-1',
  `date` date NOT NULL,
  `jeton` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CASTEST`
--
ALTER TABLE `CASTEST`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `CLASSES`
--
ALTER TABLE `CLASSES`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `DETAILSREPONSES`
--
ALTER TABLE `DETAILSREPONSES`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ELEVES`
--
ALTER TABLE `ELEVES`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ENSEIGNANTS`
--
ALTER TABLE `ENSEIGNANTS`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `FILSROUGES`
--
ALTER TABLE `FILSROUGES`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `REPONSES`
--
ALTER TABLE `REPONSES`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `TOKEN`
--
ALTER TABLE `TOKEN`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CASTEST`
--
ALTER TABLE `CASTEST`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CLASSES`
--
ALTER TABLE `CLASSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `DETAILSREPONSES`
--
ALTER TABLE `DETAILSREPONSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ELEVES`
--
ALTER TABLE `ELEVES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ENSEIGNANTS`
--
ALTER TABLE `ENSEIGNANTS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `FILSROUGES`
--
ALTER TABLE `FILSROUGES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `REPONSES`
--
ALTER TABLE `REPONSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `TOKEN`
--
ALTER TABLE `TOKEN`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
