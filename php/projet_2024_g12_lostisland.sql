-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2024 at 08:26 AM
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
(1, 'Firsal', '', '', 0),
(2, '1', '2@gmail.com', '$2y$10$wwERyTAX7fTmSBomhY8qCed00QmIckFTjUghTeHnWTuWppy482YJ.', 0),
(3, '1', '3@gmail.com', '$2y$10$6XWxTP3irDGyOjXda.8W2ep.WQ0yCmsarvqL30lcXr9ka497CCaLq', 0),
(4, '2', '4@gmail.com', '$2y$10$mubYYIg/KXle6SM049nn4OYAq4OkMhA1d5Xd9Tbw6jRbjZE3q.8BC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `niveaux`
--

CREATE TABLE `niveaux` (
  `id_niveau` int(11) NOT NULL,
  `nom_niveau` varchar(64) NOT NULL,
  `contenu` json NOT NULL,
  `createur` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id_niveau` int(11) NOT NULL AUTO_INCREMENT;

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