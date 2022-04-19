-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 09:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `naive_bayes`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_testing`
--

CREATE TABLE `tbl_data_testing` (
  `id` int(3) NOT NULL,
  `hari` int(3) NOT NULL,
  `cuaca` varchar(10) NOT NULL,
  `suhu` varchar(10) NOT NULL,
  `tingkat_malas` varchar(10) NOT NULL,
  `bangun_siang` varchar(10) NOT NULL,
  `kuliah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_data_testing`
--

INSERT INTO `tbl_data_testing` (`id`, `hari`, `cuaca`, `suhu`, `tingkat_malas`, `bangun_siang`, `kuliah`) VALUES
(2, 14, 'Mendung', 'Dingin', 'Tinggi', 'Tidak', '??'),
(3, 15, 'Mendung', 'Dingin', 'Normal', 'Ya', '??'),
(4, 16, 'Cerah', 'Sejuk', 'Tinggi', 'Tidak', '??'),
(5, 17, 'Hujan', 'Dingin', 'Tinggi', 'Ya', '??'),
(6, 18, 'Hujan', 'Sejuk', 'Normal', 'Ya', '??'),
(7, 18, 'Hujan', 'Dingin', 'Tinggi', 'Ya', '??');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_training`
--

CREATE TABLE `tbl_data_training` (
  `id` int(3) NOT NULL,
  `hari` int(3) NOT NULL,
  `cuaca` varchar(10) NOT NULL,
  `suhu` varchar(10) NOT NULL,
  `tingkat_malas` varchar(10) NOT NULL,
  `bangun_siang` varchar(10) NOT NULL,
  `kuliah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_data_training`
--

INSERT INTO `tbl_data_training` (`id`, `hari`, `cuaca`, `suhu`, `tingkat_malas`, `bangun_siang`, `kuliah`) VALUES
(1, 0, 'Hujan', 'Panas', 'Tinggi', 'Tidak', 'Bolos'),
(2, 1, 'Hujan', 'Panas', 'Tinggi', 'Ya', 'Bolos'),
(3, 2, 'Mendung', 'Panas', 'Tinggi', 'Tidak', 'Masuk'),
(4, 3, 'Cerah', 'Sejuk', 'Tinggi', 'Tidak', 'Masuk'),
(5, 4, 'Cerah', 'Dingin', 'Normal', 'Tidak', 'Masuk'),
(6, 5, 'Cerah', 'Dingin', 'Normal', 'Ya', 'Bolos'),
(7, 6, 'Mendung', 'Dingin', 'Normal', 'Ya', 'Masuk'),
(8, 7, 'Hujan', 'Sejuk', 'Tinggi', 'Tidak', 'Bolos'),
(9, 8, 'Hujan', 'Dingin', 'Normal', 'Tidak', 'Masuk'),
(10, 9, 'Cerah', 'Sejuk', 'Normal', 'Tidak', 'Masuk'),
(11, 10, 'Hujan', 'Sejuk', 'Normal', 'Ya', 'Masuk'),
(12, 11, 'Mendung', 'Sejuk', 'Tinggi', 'Ya', 'Masuk'),
(13, 12, 'Mendung', 'Panas', 'Normal', 'Tidak', 'Masuk'),
(14, 13, 'Cerah', 'Sejuk', 'Tinggi', 'Ya', 'Bolos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_data_testing`
--
ALTER TABLE `tbl_data_testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_data_training`
--
ALTER TABLE `tbl_data_training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_data_testing`
--
ALTER TABLE `tbl_data_testing`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_data_training`
--
ALTER TABLE `tbl_data_training`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
