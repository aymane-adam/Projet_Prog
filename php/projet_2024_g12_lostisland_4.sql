-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2024 at 07:57 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_2024_g12_lostisland`
--

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(11) NOT NULL,
  `pseudo` varchar(64) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `progression` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `pseudo`, `mail`, `mdp`, `progression`) VALUES
(7, 'haricotcoquin', 'flavien@lepd.frein', '2621a8ffabcf6369a97e9b692b1a9ec00be798f5', 0),
(8, 'test', 'test@gmail.test', '9cf95dacd226dcf43da376cdb6cbba7035218921', 0),
(9, 'haricotcoquin', 'oui@gmai', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

-- --------------------------------------------------------

--
-- Table structure for table `niveaux`
--

CREATE TABLE `niveaux` (
  `id_niveau` int(11) NOT NULL,
  `nom_niveau` varchar(64) NOT NULL,
  `contenu` json NOT NULL,
  `createur` varchar(64) NOT NULL,
  `type_niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `niveaux`
--

INSERT INTO `niveaux` (`id_niveau`, `nom_niveau`, `contenu`, `createur`, `type_niveau`) VALUES
(1, 'Level1', '{\"matrix\": \"[[1,0,0,0],[0,0,0,0],[0,0,0,0],[0,0,0,12]]\", \"fleche_e\": \"2\", \"fleche_n\": \"2\", \"fleche_o\": \"1\", \"fleche_1\": \"2\"}', 'admin', 1),
(2, 'Level2', '{\"matrix\": \"[[1,11,0,0,6],[0,3,0,0,0],[4,0,0,0,0],[12,0,0,5,0],[0,6,0,0,7]]\", \"fleche_e\": \"1\", \"fleche_n\": \"1\", \"fleche_o\": \"2\", \"fleche_s\": \"2\"}', 'admin', 1),
(3, 'Level3', '{\"matrix\": \"[[0,0,3,0,4,0],[12,0,0,0,0,4],[0,0,0,6,0,0],[0,2,0,0,0,0],[5,0,0,0,10,1],[0,0,6,0,0,0]]\", \"fleche_e\": \"1\", \"fleche_n\": \"2\", \"fleche_o\": \"2\", \"fleche_s\": \"1\"}', 'admin', 1),
(4, 'Level4', '{\"matrix\": \"[[2,0,0,0,0,0,7],[0,0,3,0,0,0,0],[0,0,0,5,0,0,4],[0,0,12,0,7,1,0],[0,0,6,0,0,9,0],[0,0,0,0,0,0,3],[4,0,0,2,0,0,0]]\", \"fleche_e\": \"1\", \"fleche_n\": \"1\", \"fleche_o\": \"2\", \"fleche_s\": \"1\"}', 'admin', 1),
(5, 'Level5', '{\"matrix\": \"[[0,0,0,0,0,0,0,12],[0,6,6,6,6,6,6,6],[0,6,6,6,7,7,7,7],[0,6,1,11,0,0,4,0],[0,6,0,0,0,0,0,0],[0,3,7,7,6,0,3,0],[0,0,0,0,0,0,0,0],[0,0,0,0,6,6,0,0]]\", \"fleche_e\": \"1\", \"fleche_n\": \"1\", \"fleche_o\": \"1\", \"fleche_s\": \"1\"}', 'admin', 1),
(6, 'Level6', '{\"matrix\": \"[[6,0,1,11,0,0,0,0],[0,0,6,0,0,0,0,0],[0,2,0,0,0,4,0,0],[0,0,0,4,0,0,0,0],[0,0,0,0,5,0,0,0],[2,0,7,0,0,0,0,0],[0,0,0,6,0,0,0,7],[0,12,0,0,3,0,0,0]]\", \"fleche_e\": \"1\", \"fleche_n\": \"2\", \"fleche_o\": \"3\", \"fleche_s\": \"4\"}', 'admin', 1),
(7, 'Level7', '{\"matrix\": \"[[0,0,0,0,0,7,0,12,0],[0,2,0,0,0,0,7,0,0],[0,0,0,0,0,0,0,0,4],[0,0,0,7,0,0,0,0,0],[0,0,5,0,0,6,0,0,0],[0,0,0,0,3,0,6,6,6],[0,5,0,0,0,0,0,0,0],[0,4,0,0,8,0,0,0,0],[0,0,0,0,1,0,0,0,0]]\", \"fleche_e\": \"3\", \"fleche_n\": \"1\", \"fleche_o\": \"3\", \"fleche_s\": \"4\"}', 'admin', 1),
(8, 'Level8', '{\"matrix\": \"[[0,0,0,1,5,7,3,2,0],[0,0,5,9,0,2,0,3,2],[0,0,3,0,3,0,0,0,0],[3,3,0,0,4,4,5,0,0],[0,3,3,0,0,0,0,3,0],[0,0,0,0,0,0,0,0,0],[5,0,2,0,6,0,0,7,7],[12,0,3,0,0,0,0,4,0],[0,4,0,0,0,7,5,6,5]]\", \"fleche_e\": 3, \"fleche_n\": 2, \"fleche_o\": 2, \"fleche_s\": 1}', 'admin', 1),
(9, 'Level9', '{\"matrix\": \"[[0,0,5,8,0,5,0,0,6,2],[2,0,6,1,0,0,0,2,0,12],[0,0,0,0,0,0,0,2,0,0],[4,0,0,0,5,0,5,7,0,3],[0,7,4,5,0,0,0,0,0,0],[0,0,0,4,7,6,6,6,0,0],[0,7,2,3,0,0,7,0,2,0],[0,2,4,0,3,3,0,0,4,0],[0,0,0,3,6,0,4,4,0,0],[0,4,0,2,0,3,0,2,0,0]]\", \"fleche_e\": 3, \"fleche_n\": 2, \"fleche_o\": 1, \"fleche_s\": 3}', 'admin', 1),
(10, 'Level10', '{\"matrix\": \"[[0,6,0,7,0,0,4,2,0,0,0],[6,0,2,0,0,0,3,0,0,0,0],[0,0,0,0,0,0,7,6,0,0,6],[3,7,0,4,0,4,0,7,0,5,4],[3,2,0,0,2,6,0,0,0,0,0],[0,6,5,0,0,0,2,6,2,0,0],[8,0,0,0,0,0,7,7,4,0,2],[1,5,6,3,0,7,0,0,0,5,0],[0,6,0,0,0,3,0,0,2,0,3],[0,6,0,0,5,0,0,7,0,0,2],[3,6,0,0,0,0,0,0,12,0,0]]\", \"fleche_e\": 2, \"fleche_n\": 1, \"fleche_o\": 2, \"fleche_s\": 3}', 'admin', 1),
(11, 'Level11', '{\"matrix\": \"[[0,0,0,0,0,0,0,0,0,0,5,0],[0,3,7,0,3,0,12,7,4,0,3,0],[0,5,3,7,2,2,6,0,0,0,5,6],[0,0,0,0,0,0,6,0,0,0,0,0],[0,0,0,6,4,0,0,2,2,7,4,0],[0,0,0,0,0,0,0,0,0,0,5,6],[0,0,0,3,0,7,3,2,0,4,7,2],[0,0,6,4,0,2,7,0,0,0,0,6],[3,0,0,0,5,3,0,6,4,0,6,0],[0,0,0,0,0,0,0,6,0,1,7,0],[5,0,2,0,0,0,0,5,0,9,3,0],[0,2,0,0,4,0,0,0,5,0,0,0]]\", \"fleche_e\": 1, \"fleche_n\": 3, \"fleche_o\": 2, \"fleche_s\": 1}', 'admin', 1),
(12, 'Level12', '{\"matrix\": \"[[0,3,0,0,0,7,5,0,0,7,2,0,0],[7,0,0,0,0,0,0,0,0,0,0,0,0],[0,6,0,0,3,3,0,2,5,2,0,0,7],[0,6,0,0,0,5,0,3,2,0,6,0,5],[5,0,0,0,0,7,7,4,0,4,5,0,0],[0,0,0,0,0,3,0,0,0,5,0,2,12],[0,0,0,6,6,7,2,0,7,2,0,2,0],[0,5,0,0,0,2,2,0,5,0,2,0,2],[5,7,0,0,0,0,6,0,7,3,5,0,0],[0,0,0,0,0,0,2,0,6,0,5,0,2],[7,0,0,0,0,0,0,0,5,6,6,7,4],[0,0,0,7,5,1,11,0,0,4,4,0,2],[6,0,0,0,0,0,0,0,0,0,4,6,3]]\", \"fleche_e\": 3, \"fleche_n\": 4, \"fleche_o\": 2, \"fleche_s\": 3}', 'admin', 1),
(13, 'Level13', '{\"matrix\": \"[[0,0,0,6,6,6,0,0,6,6,6,0,3,0],[0,0,12,0,0,0,6,6,0,0,0,6,0,0],[0,0,6,0,0,0,6,6,0,0,0,6,0,0],[0,2,6,0,0,0,0,6,0,0,0,0,0,0],[4,0,0,6,6,6,0,0,0,6,6,0,0,0],[0,0,0,0,0,6,0,0,6,0,0,0,0,5],[0,0,0,0,0,6,0,0,6,0,0,0,0,0],[0,0,0,0,0,6,0,0,6,0,0,0,0,0],[6,0,0,0,0,6,0,0,6,0,3,0,0,0],[0,0,0,0,0,6,6,6,6,0,0,0,0,0],[0,0,0,0,0,0,0,8,6,0,0,0,0,0],[0,0,0,0,0,6,0,1,6,0,0,0,0,0],[0,4,0,0,0,0,6,6,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0]]\", \"fleche_e\": \"2\", \"fleche_n\": \"3\", \"fleche_o\": \"5\", \"fleche_s\": \"3\"}', 'admin', 1),
(14, 'Level14', '{\"matrix\": \"[[0,0,0,0,0,0,0,0,0,5,6,5,0,0],[0,7,0,0,7,0,0,0,0,7,0,7,0,0],[7,6,2,0,6,12,0,7,0,5,0,0,6,0],[6,0,0,4,4,0,0,3,7,7,0,5,4,0],[3,0,4,0,0,2,0,0,0,0,7,0,7,7],[2,0,0,0,0,4,0,0,2,3,6,0,4,4],[3,0,2,7,5,0,0,0,0,5,0,2,0,4],[2,0,3,0,2,7,0,2,0,7,5,5,4,0],[0,0,0,0,4,3,5,0,0,0,0,0,4,0],[0,0,0,0,10,1,6,0,7,4,0,5,7,0],[5,6,3,3,2,0,0,7,0,5,0,4,0,0],[0,0,0,2,0,0,0,7,3,0,0,5,0,6],[0,0,6,0,0,6,5,6,0,2,0,6,0,0],[3,0,3,2,0,0,0,0,0,0,0,0,4,0]]\", \"fleche_e\": 3, \"fleche_n\": 3, \"fleche_o\": 5, \"fleche_s\": 3}', 'admin', 1),
(15, 'Level15', '{\"matrix\": \"[[4,5,2,0,0,0,0,0,4,0,2,0,4,7,0],[0,0,3,4,0,0,6,0,0,0,0,0,4,4,4],[0,2,0,7,0,5,0,5,6,0,4,0,6,0,4],[0,2,7,0,0,4,0,0,7,6,0,0,0,0,0],[0,0,0,0,7,6,0,0,0,0,6,2,3,0,0],[0,0,0,5,0,0,0,0,6,0,3,0,2,0,0],[5,0,0,2,3,0,3,0,0,2,0,2,7,3,0],[2,0,0,0,3,0,5,0,0,0,0,0,0,0,0],[6,0,3,2,0,3,3,7,7,0,0,5,0,0,6],[7,0,0,0,0,0,4,7,0,4,0,12,0,7,6],[0,0,0,3,8,3,7,7,2,0,0,3,0,0,0],[0,0,4,0,1,0,3,0,0,0,0,0,2,4,0],[2,5,0,0,3,0,5,7,0,0,0,2,0,0,4],[0,6,7,0,6,0,0,6,0,7,0,0,5,0,0],[0,7,0,0,0,0,6,2,7,0,4,0,3,7,0]]\", \"fleche_e\": 7, \"fleche_n\": 4, \"fleche_o\": 4, \"fleche_s\": 5}', 'admin', 1),
(16, 'Level16', '{\"matrix\": \"[[0,6,3,0,0,3,7,7,0,2,0,0,3,0,7],[0,0,0,0,4,0,2,7,0,2,2,0,0,4,0],[2,0,3,0,6,6,0,5,6,0,0,0,0,6,0],[0,0,2,0,6,0,0,0,0,0,7,0,0,0,0],[0,0,0,4,0,0,4,5,0,0,0,0,3,0,3],[5,4,0,4,0,0,0,4,0,0,0,0,6,3,3],[0,0,6,0,0,4,0,3,7,0,7,0,0,6,0],[0,0,0,0,0,3,0,0,0,0,2,3,7,0,0],[2,0,4,0,0,0,4,0,0,0,4,5,0,0,2],[2,7,0,0,4,3,2,4,0,0,2,0,7,0,0],[0,0,3,0,3,0,0,2,0,0,0,0,0,0,0],[0,0,0,0,12,2,4,0,0,6,0,0,0,0,0],[0,0,6,7,5,0,0,0,0,7,3,4,0,6,4],[6,4,0,6,0,2,3,8,0,0,0,3,0,0,0],[0,0,0,5,0,5,0,1,6,0,4,3,0,6,2]]\", \"fleche_e\": 2, \"fleche_n\": 2, \"fleche_o\": 3, \"fleche_s\": 2}', 'admin', 1),
(17, 'Level17', '{\"matrix\": \"[[0,6,5,4,0,3,0,5,0,0,5,0,3,3,0,7],[0,0,5,4,0,5,0,0,0,0,0,0,0,4,1,11],[7,0,0,7,0,7,0,6,6,0,12,4,5,7,2,0],[0,0,7,4,6,0,0,6,0,2,0,0,7,0,0,0],[0,7,0,6,0,0,0,0,0,5,2,7,4,0,2,2],[7,0,5,3,0,7,2,2,3,0,2,7,5,0,6,0],[5,0,0,0,0,0,7,0,4,0,0,0,5,0,3,6],[3,0,5,0,0,0,0,0,0,6,6,0,0,0,3,0],[0,0,0,4,2,0,0,0,7,0,0,4,0,0,0,0],[5,3,0,0,6,7,0,6,3,0,2,3,0,5,0,0],[0,0,0,3,7,0,0,0,6,0,2,0,0,0,4,0],[7,0,0,0,0,0,0,0,6,2,2,0,0,4,0,6],[0,7,0,3,0,0,2,0,0,0,0,0,5,0,0,6],[0,0,0,2,0,0,7,5,0,0,4,0,3,0,0,7],[6,2,0,6,7,0,4,5,6,0,6,0,4,0,5,0],[0,0,7,0,7,0,0,2,0,0,0,6,0,4,0,0]]\", \"fleche_e\": 2, \"fleche_n\": 4, \"fleche_o\": 6, \"fleche_s\": 5}', 'admin', 1),
(18, 'Level18', '{\"matrix\": \"[[0,0,0,0,0,0,12,0,4,5,4,0,2,0,0,0],[2,0,4,0,0,0,0,0,0,3,0,0,7,0,0,7],[0,0,0,7,0,0,0,4,0,2,3,0,0,0,6,6],[0,6,0,0,0,0,7,0,3,5,3,0,2,2,0,5],[0,0,0,3,6,0,0,0,0,0,0,0,0,2,0,0],[0,0,0,6,7,0,0,7,6,5,0,6,7,5,6,5],[0,2,0,6,2,6,0,0,0,7,0,0,0,0,0,0],[6,0,3,4,0,3,3,0,0,0,4,4,6,0,0,0],[7,5,0,5,0,0,0,0,0,0,0,0,0,0,2,0],[2,0,3,4,3,6,0,0,0,0,0,0,2,0,7,3],[0,4,0,4,2,0,0,0,0,2,6,0,6,0,0,0],[6,7,0,6,2,0,0,0,4,7,0,6,0,7,0,7],[0,0,0,0,5,4,0,0,6,0,0,0,0,0,0,0],[0,4,7,2,0,0,6,0,5,5,0,2,0,6,0,0],[2,6,0,0,0,7,0,0,0,0,0,0,2,0,7,6],[3,0,0,0,10,1,0,0,4,3,7,0,5,0,0,5]]\", \"fleche_e\": 5, \"fleche_n\": 6, \"fleche_o\": 3, \"fleche_s\": 0}', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id_joueur` int(11) NOT NULL,
  `id_niveau` int(11) NOT NULL,
  `score_prec` int(11) NOT NULL,
  `best_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`);

--
-- Indexes for table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`id_niveau`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD KEY `id_joueur` (`id_joueur`),
  ADD KEY `id_niveau` (`id_niveau`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id_niveau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveaux` (`id_niveau`),
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`id_joueur`) REFERENCES `comptes` (`id_compte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
