-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2024 at 08:05 AM
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
(8, 'test', 'test@gmail.test', '9cf95dacd226dcf43da376cdb6cbba7035218921', 0);

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
(1, 'level1', '{\"matrix\": \"[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]\", \"fleche_e\": \"0\", \"fleche_n\": \"1\", \"fleche_o\": \"0\", \"fleche_s\": \"0\"}', 'admin', 1),
(2, 'test2', '{\"matrix\": \"[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]\", \"fleche_e\": \"0\", \"fleche_n\": \"0\", \"fleche_o\": \"0\", \"fleche_s\": \"0\"}', 'aymane ', 2),
(3, 'testbdd', '{\"matrix\": \"[[0,0,0,0,0],[0,0,3,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]\", \"fleche_e\": \"0\", \"fleche_n\": \"0\", \"fleche_o\": \"0\", \"fleche_s\": \"0\"}', '2', 2),
(4, 'test 5', '{\"matrix\": \"[[1,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,12]]\", \"fleche_e\": \"0\", \"fleche_n\": \"0\", \"fleche_o\": \"0\", \"fleche_s\": \"0\"}', 'community', 2),
(5, 'matteo trop nul a fifa', '{\"matrix\": \"[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]\", \"fleche_e\": \"2\", \"fleche_n\": \"2\", \"fleche_o\": \"4\", \"fleche_s\": \"1\"}', 'matheo', 2),
(6, 'test', '{\"matrix\": \"[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]\", \"fleche_e\": \"0\", \"fleche_n\": \"0\", \"fleche_o\": \"0\", \"fleche_s\": \"0\"}', 'haricotcoquin', 2),
(7, 'test', '{\"matrix\": \"[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]\", \"fleche_e\": \"0\", \"fleche_n\": \"0\", \"fleche_o\": \"0\", \"fleche_s\": \"0\"}', 'haricotcoquin', 2);

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
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id_niveau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
