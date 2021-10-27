-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 28 oct. 2021 à 00:44
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
-- Création : mar. 19 oct. 2021 à 15:16
-- Dernière modification : mer. 27 oct. 2021 à 20:21
--

CREATE TABLE `CASTEST` (
  `id` int NOT NULL,
  `question` int NOT NULL,
  `entree` text NOT NULL,
  `sortie` text NOT NULL,
  `type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `CASTEST`
--

INSERT INTO `CASTEST` (`id`, `question`, `entree`, `sortie`, `type`) VALUES
(75, 1, 'fact(-7)', '-1', 1),
(76, 1, 'fact(8)', '40320', 1),
(77, 1, 'fact(6)', '720', 2),
(78, 1, 'fact(34)', '295232799039604140847618609643520000000', 2),
(79, 1, 'fact(2)', '2', 3),
(80, 1, 'fact(15)', '1307674368000', 3),
(81, 3, 'nombreE(\"aertuiaz zaoEi apz\")', '2', 0),
(82, 3, 'nombreE(\"Vive la prepa\")', '2', 0),
(83, 3, 'nombreE(\"\")', '0', 0),
(84, 3, 'nombreE(\"aeaertuEEarEEre\")', '7', 0),
(85, 3, 'nombreE(\"Et alors et alors\")', '2', 0),
(86, 4, 'u(5)', '485', 0),
(87, 4, 'u(0)', '1', 0),
(88, 4, 'u(10)', '118097', 0),
(89, 4, 'u(3)', '53', 0),
(90, 4, 'u(8)', '13121', 0),
(91, 4, 'u(12)', '1062881', 0),
(93, 5, 'division_euclidienne(37,3)', '[12, 1]', 1);

-- --------------------------------------------------------

--
-- Structure de la table `CLASSES`
--
-- Création : Dim 17 oct. 2021 à 18:37
--

CREATE TABLE `CLASSES` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `enseignant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `CLASSES`
--

INSERT INTO `CLASSES` (`id`, `nom`, `enseignant`) VALUES
(1, 'MP*', 1),
(2, 'PCSIA', 1),
(6, 'MPSI', 1);

-- --------------------------------------------------------

--
-- Structure de la table `DETAILSREPONSES`
--
-- Création : mer. 27 oct. 2021 à 21:57
--

CREATE TABLE `DETAILSREPONSES` (
  `id` int NOT NULL,
  `fil` int NOT NULL,
  `etudiant` int NOT NULL,
  `castest` int NOT NULL,
  `resultat` text NOT NULL,
  `entree` text NOT NULL,
  `sortie` text NOT NULL,
  `type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `DETAILSREPONSES`
--

INSERT INTO `DETAILSREPONSES` (`id`, `fil`, `etudiant`, `castest`, `resultat`, `entree`, `sortie`, `type`) VALUES
(11, 3, 6, 81, '2', 'nombreE(\"aertuiaz zaoEi apz\")', '2', 0),
(12, 3, 6, 82, '2', 'nombreE(\"Vive la prepa\")', '2', 0),
(13, 3, 6, 83, '0', 'nombreE(\"\")', '0', 0),
(14, 3, 6, 84, '7', 'nombreE(\"aeaertuEEarEEre\")', '7', 0),
(15, 3, 6, 85, '2', 'nombreE(\"Et alors et alors\")', '2', 0),
(16, 10, 6, 86, '17', 'u(5)', '485', 0),
(17, 10, 6, 87, '1', 'u(0)', '1', 0),
(18, 10, 6, 88, '17', 'u(10)', '118097', 0),
(19, 10, 6, 89, '17', 'u(3)', '53', 0),
(20, 10, 6, 90, '17', 'u(8)', '13121', 0),
(21, 10, 6, 91, '17', 'u(12)', '1062881', 0),
(46, 12, 6, 75, '-1', 'fact(-7)', '-1', 1),
(47, 12, 6, 76, '40320', 'fact(8)', '40320', 1),
(48, 12, 6, 77, '720', 'fact(6)', '720', 2),
(49, 12, 6, 78, '295232799039604140847618609643520000000', 'fact(34)', '295232799039604140847618609643520000000', 2),
(50, 12, 6, 79, '2', 'fact(2)', '2', 3),
(51, 12, 6, 80, '1307674368000', 'fact(15)', '1307674368000', 3);

-- --------------------------------------------------------

--
-- Structure de la table `ELEVES`
--
-- Création : lun. 18 oct. 2021 à 13:21
--

CREATE TABLE `ELEVES` (
  `id` int NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `identifiant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `classe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ELEVES`
--

INSERT INTO `ELEVES` (`id`, `nom`, `prenom`, `identifiant`, `mdp`, `classe`) VALUES
(2, 'Duval', 'Pierre', '', '', 2),
(3, 'Durant', 'Renault', '', '', 2),
(6, 'Dupond', 'Martin', 'mdupond', 'bef57ec7f53a6d40beb640a780a639c83bc29ac8a9816f1fc6c5c6dcd93c4721', 1),
(7, 'Durant', 'Martin', 'mdurant', '3d5c3f5671f1c9e6f29f834d99a80cb36b976ed008c4f25f407ae9cd6411f128', 1),
(9, 'Michel', 'Thibault', 'tmichel', '89e11efbcc9e9392e062678588b7f7bfd6500e71e889f1a6b6311d86d81afc82', 1),
(10, 'Steiner', 'Villier', 'vsteiner', '189d1854c373c13804c0d9cd8107ba04798b5b3a17fa5405532a44f12306ade4', 1),
(11, 'Dupond', 'martine', 'mdupond', '36bbe50ed96841d10443bcb670d6554f0a34b761be67ec9c4a8ad2c0c44ca42c', 2);

-- --------------------------------------------------------

--
-- Structure de la table `ENSEIGNANTS`
--
-- Création : sam. 16 oct. 2021 à 20:47
-- Dernière modification : mer. 27 oct. 2021 à 15:16
--

CREATE TABLE `ENSEIGNANTS` (
  `id` int NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `login` text NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ENSEIGNANTS`
--

INSERT INTO `ENSEIGNANTS` (`id`, `nom`, `prenom`, `login`, `mdp`) VALUES
(1, 'Le Bras', 'Yannick', 'ylebras', 'f91fcc67b26e83f3a0b62737d7b66ea596b0b9d8e324f09208d668a0047a752c'),
(2, 'Monnom', 'Monprenom', 'utest', 'bef57ec7f53a6d40beb640a780a639c83bc29ac8a9816f1fc6c5c6dcd93c4721');

-- --------------------------------------------------------

--
-- Structure de la table `FILSROUGES`
--
-- Création : Dim 24 oct. 2021 à 05:07
-- Dernière modification : mar. 26 oct. 2021 à 14:13
--

CREATE TABLE `FILSROUGES` (
  `id` int NOT NULL,
  `question` int NOT NULL,
  `datedebut` datetime NOT NULL,
  `datefin` datetime NOT NULL,
  `classe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `FILSROUGES`
--

INSERT INTO `FILSROUGES` (`id`, `question`, `datedebut`, `datefin`, `classe`) VALUES
(3, 3, '2021-10-25 12:00:00', '2021-10-26 05:59:00', 1),
(4, 1, '2021-10-27 12:00:00', '2021-10-29 11:59:00', 6),
(10, 4, '2021-10-26 06:00:00', '2021-10-29 11:59:00', 1),
(11, 3, '2021-10-26 12:00:00', '2021-10-26 11:59:00', 2),
(12, 1, '2021-10-27 12:00:00', '2021-10-30 11:59:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONS`
--
-- Création : mar. 19 oct. 2021 à 03:56
-- Dernière modification : mer. 27 oct. 2021 à 20:21
--

CREATE TABLE `QUESTIONS` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `enonce` text NOT NULL,
  `prerempli` text NOT NULL,
  `correction` text NOT NULL,
  `niveau` int NOT NULL,
  `retour` text NOT NULL,
  `enseignant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `QUESTIONS`
--

INSERT INTO `QUESTIONS` (`id`, `titre`, `enonce`, `prerempli`, `correction`, `niveau`, `retour`, `enseignant`) VALUES
(1, 'Factorielle itérative', 'Écrire une fonction `fact(n)` qui prend en entrée un entier naturel `n` et qui renvoie la valeur de `n!`. Si `n` est négatif, elle renverra $-1$.', 'def fact(n):\r\n    \r\n    return(resultat)', 'def fact(n):\r\n    \"\"\" renvoie la valeur de n! \"\"\"\r\n    if n<0 :\r\n        res = -1\r\n    else :\r\n        res = 1\r\n        for i in range(1,n+1) :\r\n            res = res * i\r\n    return res', 2, 'Le test initial permet d\'isoler le cas négatif. Dans le cas général, on calcule le produit $1\\times2\\times3\\times\\dots\\times n$.', 1),
(3, 'Nombre de E', 'Écrire une fonction `nombreE(texte)` qui **prend** en entrée une chaîne de caractères `texte` et qui retourne le nombre de `e` et de `E` contenus dans cette chaîne. On utilisera obligatoirement une boucle $\\frac ab$.', 'def nombreE(texte) :\r\n  \r\n  return nbE	', 'def nombreE(texte) :\r\n  nbE = 0\r\n  for lettre in texte :\r\n    if lettre==\"e\" or lettre==\"E\" :\r\n      nbE += 1\r\n  return nbE', 2, 'La boule peut être traitée de différentes manières. On pourra par exemple écrire aussi :\r\n```Python\r\ndef nombreE(texte) :\r\n	n=len(texte)\r\n    nbE=0\r\n    for i in range(n) :\r\n    	if texte[i]==\"e\" or texte[i]==\"E\" :\r\n        	nbE +=1\r\n    return nbE\r\n```\r\n', 1),
(4, 'Suite définie par récurrence', 'On définit la suite $u$ par $u_0=1$ et $u_{n+1}=3u_n+2$. Écrire une fonction `u(n)` qui prend en entrée un entier naturel $n$ (on supposera la fonction bien utilisée) et qui retourne le $n+1$-ième terme de la suite, c\'est à dire le terme d\'indice $n$. Le calcul devra se faire avec une boucle, pas en ayant recours à la formule mathématique.', 'def u(n) :\r\n  \r\n  return terme', 'def u(n) :\r\n  terme = 1\r\n  for i in range (0,n) :\r\n    terme = 3*terme+2\r\n  return terme', 2, 'Il faut ici faire attention aux indices de la boucle for.', 1),
(5, '', '', '', 'def division_euclidienne(a,b) :\r\n  r = a\r\n  q = 0\r\n  while r>b :\r\n    r = r - b\r\n    q = q + 1  \r\n  return [q,r]\r\n\r\n\r\n', 4, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `REPONSES`
--
-- Création : mer. 27 oct. 2021 à 22:30
--

CREATE TABLE `REPONSES` (
  `id` int NOT NULL,
  `filrouge` int NOT NULL,
  `eleve` int NOT NULL,
  `date` datetime NOT NULL,
  `etat` int NOT NULL DEFAULT '0',
  `code` text NOT NULL,
  `commentaire` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `REPONSES`
--

INSERT INTO `REPONSES` (`id`, `filrouge`, `eleve`, `date`, `etat`, `code`, `commentaire`) VALUES
(4, 3, 6, '2021-10-25 21:10:13', 1, 'def nombreE(texte) :\r\n  nbE = 0\r\n  for lettre in texte :\r\n    if lettre == \'e\' or lettre == \'E\' :\r\n      nbE+=1\r\n  return nbE	', 'Bien'),
(5, 10, 6, '2021-10-26 07:07:55', 0, 'def u(n) :\r\n  if n==0 :\r\n    terme=1\r\n  elif n==1 :\r\n    terme=5\r\n  else :\r\n    terme=17\r\n  \r\n  return terme', ''),
(7, 12, 6, '2021-10-28 00:37:27', 1, 'def fact(n):\r\n  if n<0 :\r\n    resultat=-1\r\n  else :\r\n    resultat=1\r\n    for i in range(1,n+1):\r\n      resultat *= i\r\n  return(resultat)', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `TOKEN`
--
-- Création : Dim 24 oct. 2021 à 20:09
-- Dernière modification : mer. 27 oct. 2021 à 21:21
--

CREATE TABLE `TOKEN` (
  `id` int NOT NULL,
  `enseignant` int NOT NULL DEFAULT '-1',
  `etudiant` int NOT NULL DEFAULT '-1',
  `date` date NOT NULL,
  `jeton` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `TOKEN`
--

INSERT INTO `TOKEN` (`id`, `enseignant`, `etudiant`, `date`, `jeton`) VALUES
(1, 1, -1, '2021-10-17', '32d2b414b4226fe8ec6c0a7463cfc09d'),
(2, 1, -1, '2021-10-17', 'b9ea1cf9a51fc2eee9c9cd80dad21ca6'),
(3, 1, -1, '2021-10-17', '3ebc29c29bf5880fa92f1d75fdf02699'),
(4, 1, -1, '2021-10-17', 'ea925d96e9608110a6d711757a3feb25'),
(5, 1, -1, '2021-10-17', '4a51d2d0fa6ba8daf168bdc9700310c9'),
(6, 1, -1, '2021-10-17', 'c95c30e4e3b548a9a2fe2036397b2b8e'),
(7, 1, -1, '2021-10-17', 'ab41bb0f8877044e51d0519a915798ce'),
(8, 1, -1, '2021-10-17', 'aca9915673e0dddabbeddb805724ab3a'),
(9, 1, -1, '2021-10-17', 'f7c2f8108e9ed8ce25ffa9b1873bdea7'),
(10, 1, -1, '2021-10-17', 'c4cc5c3ecde3cd70e2c0364fabbab420'),
(11, 1, -1, '2021-10-17', '1bac7f3d7e8250aadf82f2f47118fd4e'),
(12, 1, -1, '2021-10-17', 'fb932e0640318ae483b46bfa72d9eb1b'),
(13, 1, -1, '2021-10-17', 'bd8114b9b36271e328c4eba7f832ab7f'),
(14, 1, -1, '2021-10-17', 'ede9f3f12c6ee60e64884ecb80b31325'),
(15, 1, -1, '2021-10-17', '74cfab2555101b5a85a4f9db568765b8'),
(16, 1, -1, '2021-10-17', 'd19ec37613c864a58ef8762ba4090981'),
(17, 1, -1, '2021-10-17', '37a88678ce32174ace736600ee9f8b70'),
(18, 1, -1, '2021-10-17', '4cc15c312fa5a5b9d79607884fbeec06'),
(19, 1, -1, '2021-10-17', '9c83929f782b82533abd6bdf7c63328b'),
(20, 1, -1, '2021-10-18', 'b9ff4afcf58ce50544b606409c4bbff0'),
(21, 1, -1, '2021-10-18', '6a4dd061efc06ed38b3e96685a8d5fc9'),
(22, 1, -1, '2021-10-18', '391a3f5683d4bd4e409a4ae96ebfd5b4'),
(23, 1, -1, '2021-10-18', '7577906640869d5ab2d349744803baa1'),
(24, 1, -1, '2021-10-18', '6a3fe95955a106fdf5eea2e061a2a0bc'),
(25, 1, -1, '2021-10-18', '92e13dff9c7e448ac9246c90a06e1ff5'),
(26, 1, -1, '2021-10-19', '2f3b53c75d514d294cd3ea4ca3f6aad1'),
(27, 1, -1, '2021-10-19', '19677a5010351138b1140f8bad66c169'),
(28, 1, -1, '2021-10-19', '29ba7a4db473088335ac38af0ac6c4b2'),
(29, 1, -1, '2021-10-19', 'c1a5ba1301093c802d2f5ed1079fdf95'),
(30, 1, -1, '2021-10-19', '95a5be61afefa41e6ceaf9c81d23be58'),
(31, 1, -1, '2021-10-19', '522c9a43b6055b28ec44ed7ddc3810da'),
(32, 1, -1, '2021-10-19', 'dc1fa95ac7f5fe06860dcf0774535d50'),
(33, 1, -1, '2021-10-19', 'b6a7a0779677b8e697dafedec4f1f894'),
(34, 1, -1, '2021-10-19', '65497238532e913fd4d0d32bcc340cae'),
(35, 1, -1, '2021-10-20', '2fa0a34a048e8ade4a494e75a991dea0'),
(36, 1, -1, '2021-10-20', '9fb47bb319bd342598a6fbdbb04462c8'),
(37, 1, -1, '2021-10-20', 'ab7f746aad113a0134b8f8fa65cb4eda'),
(38, 1, -1, '2021-10-20', '5f1e84b27a0e18ac5e8cff122d3c460f'),
(39, 1, -1, '2021-10-20', '419374ffa054cecf3bf0ba43b2c195c6'),
(40, 1, -1, '2021-10-20', 'ddfe01fe83478f3efbe1affc9d535e3b'),
(41, 1, -1, '2021-10-20', 'd3d3dad1c8deddc6d217b85f907db9ea'),
(42, 1, -1, '2021-10-20', '95bdd6c2259a6d76003c56da0498d20a'),
(43, 1, -1, '2021-10-20', '160ede93dc21a419888821c34312b0f0'),
(44, 1, -1, '2021-10-21', 'aed7cd5a7862e024c310a575c546aec7'),
(45, 1, -1, '2021-10-21', '04d084e30fb270c88938778259332fec'),
(46, 1, -1, '2021-10-21', '0cfbb30948130593580a501de9feebf4'),
(47, 1, -1, '2021-10-21', '923611dbf15de469523d7ebc4b9456b6'),
(48, 1, -1, '2021-10-22', '90da470252af5341c892d53b84cf3c90'),
(49, 1, -1, '2021-10-22', '8422b72ce32b7b484f8ea299d554c718'),
(50, 1, -1, '2021-10-23', '86d1f18ffbcad26c63cfa4635252a28c'),
(51, 1, -1, '2021-10-23', '65f77f3d2dbfcd24535bdb0569b327e6'),
(52, 1, -1, '2021-10-23', '4662c673985071bff86621a745534613'),
(53, 1, -1, '2021-10-23', '00f7f2423b35af26ae5c3a4a3627f9e8'),
(54, 1, -1, '2021-10-23', '04385c80f1a28340c8194b47f5d70451'),
(55, 1, -1, '2021-10-23', '8f2bab137b05e21ce8f0b6384201d905'),
(56, 1, -1, '2021-10-24', '3e2bdca5d2cb9465be50dbfb5207d74e'),
(57, 1, -1, '2021-10-24', '8ab6a996d4cb7361bfa8712b4dcd2f48'),
(58, 1, -1, '2021-10-24', '624762a045c6fc0ee5cdd1f7d32900f9'),
(59, 1, -1, '2021-10-24', 'e8f7ab37e80d6857bcfa902795553b67'),
(60, -1, 6, '2021-10-25', 'c115f63a2fbbb2712845fecbcb63bdf9'),
(61, -1, 6, '2021-10-25', '5f30177ae8933b39e5778cd3bd232e0b'),
(62, -1, 6, '2021-10-25', '0ca897ab8359eb0c9b5a4fff7926e595'),
(63, -1, 6, '2021-10-25', '8cf40b264a9daeb730db5a6718c0e47e'),
(64, -1, 6, '2021-10-25', '2d0e44571951b9bf6fd515a13cde63df'),
(65, -1, 6, '2021-10-25', '0532f6dfd9ffc8f713c96374b72eba02'),
(66, -1, 6, '2021-10-25', 'aee9a9707f31834060b31bf3545d4d45'),
(67, -1, 6, '2021-10-25', '7b4f034985d7d7ae08b70d0c6518256a'),
(68, -1, 6, '2021-10-25', 'dc30f8fdf648c06d3c0b981834fa1f3b'),
(69, -1, 6, '2021-10-25', '41c00aa31dfe235cbd0769d223241217'),
(70, -1, 6, '2021-10-25', 'ee80c3ad9cf4db9121e55b87d4dd879d'),
(71, -1, 6, '2021-10-25', '6bbb1fc9e24bc8ab58879e15852c79e0'),
(72, -1, 6, '2021-10-25', '4c55f746cfbe67ef65f2cc6bb5b39c76'),
(73, -1, 6, '2021-10-25', 'cf5be7f9eab36074f61ed387956d11a1'),
(74, -1, 6, '2021-10-25', '118a5df9b09d07fd2695319564a6fa09'),
(75, -1, 6, '2021-10-25', '542ee9dd88cb33e143b261c034f9c564'),
(76, -1, 6, '2021-10-25', '7e2185f7895c45a88a9b0bf07810677c'),
(77, 1, -1, '2021-10-25', 'b7b8672a5dc9662c14e2aa48054ca0d8'),
(78, 1, -1, '2021-10-25', 'c70c38be3213791426395329520c3d2d'),
(79, -1, 6, '2021-10-25', 'c4a1d5494e64df0da16f8179217dd728'),
(80, 1, -1, '2021-10-25', '5d691558b082bafb6c68501d0891165e'),
(81, -1, 6, '2021-10-25', '23e19417029ae3d5b2067ade29cccbca'),
(82, -1, 6, '2021-10-26', '7d19196ba27e6257277261311f1b9cb2'),
(83, 1, -1, '2021-10-26', 'd8f279d38e5a37941bd50ea6497253a6'),
(84, -1, 6, '2021-10-26', 'b08df9afa083ad3de8cbcd586ed30734'),
(85, -1, 6, '2021-10-26', '3801bb1947570aea591a90027e47c14c'),
(86, 1, -1, '2021-10-26', '6e43185c0261e28b9c1f3a9803adddd8'),
(87, 1, -1, '2021-10-26', '294d4ed6faf57b80ad4747cfa3b288be'),
(88, 1, -1, '2021-10-26', '12ff9d9d7d0cf87531ebe920803f7cc7'),
(89, 1, -1, '2021-10-26', '4a200d9c83ff25d1f35b6891972201f2'),
(90, -1, 6, '2021-10-26', 'e60c09d58ab753c153d45813caca2b4d'),
(91, -1, 6, '2021-10-26', '023d1935c42be461c13c17868d0d694e'),
(92, 1, -1, '2021-10-26', '6a2e136957ccc060a14b45ae48bc4482'),
(93, 1, -1, '2021-10-26', '7d1a5f23f33750c92d617abdb2312802'),
(94, -1, 6, '2021-10-26', '6ff1bf61953ddca9bc783ea08a38dfc1'),
(95, -1, 6, '2021-10-26', '81f64f2676afb6b64bf6610947dff8e5'),
(96, 1, -1, '2021-10-26', '382c7cb026b03e0477f9a0d827c8907a'),
(97, 1, -1, '2021-10-26', '20ca17af1cc2a3646b777ca1c97d92bc'),
(98, 1, -1, '2021-10-27', '8f03cc6e69d0ad95a2fe90bb982b7c4e'),
(99, 1, -1, '2021-10-27', '9135302a2263a53be86690b758408c18'),
(100, -1, 6, '2021-10-27', 'ed83e58a430f72049f989894e36f9e19'),
(101, 1, -1, '2021-10-27', '0ced0cdf645cbcb25470c2154162ab92'),
(102, 1, -1, '2021-10-27', '92a179f17d20b1790549ec193e10e912'),
(103, 1, -1, '2021-10-27', '2370c5a25fe87c703b6f508671d9acc7'),
(104, 1, -1, '2021-10-27', 'd0078ef4aca459ce2d865a8f73e53b8d'),
(105, 1, -1, '2021-10-27', 'b2843920be7ecf6b3a14d9652652cf11'),
(106, 1, -1, '2021-10-27', '5dff61692be39ba2a4cbf8e927bed399'),
(107, 1, -1, '2021-10-27', '32c4093d3250d274ce4894d65ef5b4e4'),
(108, 1, -1, '2021-10-27', 'c28263ead7ba7c47d49e6563167a4a71'),
(109, -1, 6, '2021-10-27', 'dba21b98b59fbd598c8a46064cbcff04'),
(110, 1, -1, '2021-10-27', '914728e1fc014e8c687eeac2015a1921'),
(111, 1, -1, '2021-10-27', '5ad81672aad2b13c4deb6ce6387f5468'),
(112, -1, 6, '2021-10-27', '5562b37e27b058954742c9a15a4a1bbe'),
(113, -1, 6, '2021-10-28', 'd35ea6a4ae08f871c0322c082b1ec892'),
(114, 1, -1, '2021-10-28', '9a04bbd66e19f95ae24a368c60b0c9fe'),
(115, -1, 6, '2021-10-28', '310960934355f2317362020819dbecfa'),
(116, 1, -1, '2021-10-28', 'aa4a9da31adab22f514dea4c7c5af1f3'),
(117, 1, -1, '2021-10-28', '4c0850d9466debf2a0dfd9b21589242e'),
(118, -1, 6, '2021-10-28', '7e56bc4b98eaff2b338db618d6ee1894');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `CLASSES`
--
ALTER TABLE `CLASSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `DETAILSREPONSES`
--
ALTER TABLE `DETAILSREPONSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `ELEVES`
--
ALTER TABLE `ELEVES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `ENSEIGNANTS`
--
ALTER TABLE `ENSEIGNANTS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `FILSROUGES`
--
ALTER TABLE `FILSROUGES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `QUESTIONS`
--
ALTER TABLE `QUESTIONS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `REPONSES`
--
ALTER TABLE `REPONSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `TOKEN`
--
ALTER TABLE `TOKEN`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
