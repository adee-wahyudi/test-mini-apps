-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 05:27 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `klasemen`
--

CREATE TABLE `klasemen` (
  `id` int(11) NOT NULL,
  `id_klub` int(11) NOT NULL,
  `main` int(3) NOT NULL,
  `menang` int(3) NOT NULL,
  `seri` int(3) NOT NULL,
  `kalah` int(3) NOT NULL,
  `goal_menang` int(3) NOT NULL,
  `goal_kalah` int(3) NOT NULL,
  `point` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasemen`
--

INSERT INTO `klasemen` (`id`, `id_klub`, `main`, `menang`, `seri`, `kalah`, `goal_menang`, `goal_kalah`, `point`) VALUES
(1, 1, 2, 2, 0, 0, 4, 0, 6),
(2, 2, 2, 1, 0, 1, 2, 2, 3),
(3, 3, 2, 0, 0, 2, 0, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `klub`
--

CREATE TABLE `klub` (
  `id` int(11) NOT NULL,
  `nama_klub` varchar(32) NOT NULL,
  `kota` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klub`
--

INSERT INTO `klub` (`id`, `nama_klub`, `kota`) VALUES
(1, 'Persib', 'Bandung'),
(2, 'Arema', 'Malang'),
(3, 'Persija', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `pertandingan`
--

CREATE TABLE `pertandingan` (
  `id` int(11) NOT NULL,
  `id_klub1` int(11) NOT NULL,
  `score1` int(3) NOT NULL,
  `id_klub2` int(11) NOT NULL,
  `score2` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertandingan`
--

INSERT INTO `pertandingan` (`id`, `id_klub1`, `score1`, `id_klub2`, `score2`) VALUES
(1, 1, 2, 2, 0),
(2, 3, 0, 2, 2),
(3, 3, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '$2y$10$Zc.Z3NmlvSFklyuZzrS6/eAmHL4MGfYK3fVu0mQGZ5o8.J7P9l54m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klasemen`
--
ALTER TABLE `klasemen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Klub` (`id_klub`);

--
-- Indexes for table `klub`
--
ALTER TABLE `klub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Klub1` (`id_klub1`),
  ADD KEY `FK_Klub2` (`id_klub2`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klasemen`
--
ALTER TABLE `klasemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `klub`
--
ALTER TABLE `klub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pertandingan`
--
ALTER TABLE `pertandingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `klasemen`
--
ALTER TABLE `klasemen`
  ADD CONSTRAINT `FK_Klub` FOREIGN KEY (`id_klub`) REFERENCES `klub` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD CONSTRAINT `FK_Klub1` FOREIGN KEY (`id_klub1`) REFERENCES `klub` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Klub2` FOREIGN KEY (`id_klub2`) REFERENCES `klub` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
