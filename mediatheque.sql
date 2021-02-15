-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 15 fév. 2021 à 08:46
-- Version du serveur :  8.0.23-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnes`
--

CREATE TABLE `abonnes` (
  `id_abonne` int NOT NULL,
  `nom_abonne` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `mail_abonne` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `abonnes`
--

INSERT INTO `abonnes` (`id_abonne`, `nom_abonne`, `mail_abonne`) VALUES
(1, 'Cédric', 'ced@mail.com'),
(2, 'Pierre', 'pierrot@mail.com'),
(3, 'Marie', 'ma@mail.com');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `id_emprunt` int NOT NULL,
  `debut_emprunt` date NOT NULL,
  `fin_emprunt` date NOT NULL,
  `film_id` int NOT NULL,
  `abonne_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id_emprunt`, `debut_emprunt`, `fin_emprunt`, `film_id`, `abonne_id`) VALUES
(5, '2021-02-01', '2021-02-28', 16, 1),
(6, '2021-02-09', '2021-02-14', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id_film` int NOT NULL,
  `titre_film` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `affiche_film` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `acteurs_film` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `sortie_film` date NOT NULL,
  `synopsis_film` text COLLATE utf8mb4_bin NOT NULL,
  `realisateur_film` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id_film`, `titre_film`, `affiche_film`, `acteurs_film`, `sortie_film`, `synopsis_film`, `realisateur_film`) VALUES
(1, 'Vicky Cristina Barcelona', 'https://images-na.ssl-images-amazon.com/images/I/71IIJomFjyL._AC_SY445_.jpg', 'Scarlett Johansson, Rebecca Hall, Javier Bardem', '2008-10-08', 'Vicky et Cristina sont d\'excellentes amies, avec des visions diamétralement opposées de l\'amour : la première est une femme de raison, fiancée à un jeune homme respectable ; la seconde, une créature d\'instincts, dénuée d\'inhibitions et perpétuellement à la recherche de nouvelles expériences sexuelles et passionnelles.\r\n', 'Woody Allen'),
(2, 'Minuit à Paris', 'https://fr.web.img2.acsta.net/c_310_420/medias/nmedia/18/83/07/18/19702766.jpg', ' Owen Wilson, Rachel McAdams, Michael Sheen', '2011-05-12', 'Un jeune couple d’américains dont le mariage est prévu à l’automne se rend pour quelques jours à Paris. La magie de la capitale ne tarde pas à opérer, tout particulièrement sur le jeune homme amoureux de la Ville-lumière et qui aspire à une autre vie que la sienne. ', 'Woody Allen'),
(3, 'Whatever Works', 'https://fr.web.img4.acsta.net/c_310_420/medias/nmedia/18/69/41/76/19133665.jpg', 'Larry David, Evan Rachel Wood, Ed Begley Jr.', '2009-07-01', 'Boris Yellnikoff est un génie de la physique qui a raté son mariage, son prix Nobel et même son suicide. Désormais, ce brillant misanthrope vit seul, jusqu\'au soir où une jeune fugueuse, Melody, se retrouve affamée et transie de froid devant sa porte. Boris lui accorde l\'asile pour quelques nuits. Rapidement, Melody s\'installe. ', 'Woody Allen'),
(16, 'Les Minions ', 'https://fr.web.img5.acsta.net/c_310_420/pictures/15/06/11/09/20/080813.jpg', 'Marion Cotillard, Guillaume Canet, Christian Gonon', '2015-07-08', 'A l\'origine de simples organismes monocellulaires de couleur jaune, les Minions ont évolué au cours des âges au service de maîtres plus abjectes les uns que les autres. Les disparitions répétitives de ceux-ci, des tyrannosaures à Napoléon, ont plongé les Minions dans une profonde dépression. Mais l\'un d\'eux, prénommé Kevin, a une idée. Flanqué de Stuart, l\'adolescent rebelle et de l\'adorable petit Bob, Kevin part à la recherche d\'un nouveau patron malfaisant pour guider les siens. Nos trois Minions se lancent dans un palpitant voyage qui va les conduire à leur nouveau maître : Scarlet Overkill, la première superméchante de l\'histoire. De l\'Antarctique au New York des années 60, nos trois compères arrivent finalement à Londres, où ils vont devoir faire face à la plus terrible menace de leur existence : l\'annihilation de leur espèce.', 'Pierre Coffin, Kyle Balda');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnes`
--
ALTER TABLE `abonnes`
  ADD PRIMARY KEY (`id_abonne`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD KEY `abonne_id` (`abonne_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnes`
--
ALTER TABLE `abonnes`
  MODIFY `id_abonne` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `id_emprunt` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`abonne_id`) REFERENCES `abonnes` (`id_abonne`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `films` (`id_film`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
