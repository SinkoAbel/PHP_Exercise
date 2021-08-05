-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 09:46 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greensys`
--

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(11) NOT NULL,
  `teljes_nev` text NOT NULL,
  `email` text NOT NULL,
  `jelszo` text NOT NULL,
  `regisztracio` datetime NOT NULL,
  `visszaigazolva` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `teljes_nev`, `email`, `jelszo`, `regisztracio`, `visszaigazolva`) VALUES
(5, 'John Doe', 'johndoe@random.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '2021-08-05 18:39:08', 'igen');

-- --------------------------------------------------------

--
-- Table structure for table `leadott_rendeles`
--

CREATE TABLE `leadott_rendeles` (
  `id` int(11) NOT NULL,
  `megrendeles_id` int(11) NOT NULL,
  `termek_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leadott_rendeles`
--

INSERT INTO `leadott_rendeles` (`id`, `megrendeles_id`, `termek_id`) VALUES
(5, 4, 2),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `megrendeles`
--

CREATE TABLE `megrendeles` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `rendeles_idopontja` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `megrendeles`
--

INSERT INTO `megrendeles` (`id`, `felhasznalo_id`, `rendeles_idopontja`) VALUES
(4, 5, '2021-08-05 21:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `termek`
--

CREATE TABLE `termek` (
  `id` int(11) NOT NULL,
  `gyarto` text NOT NULL,
  `nev` text NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `termek`
--

INSERT INTO `termek` (`id`, `gyarto`, `nev`, `ar`) VALUES
(1, 'Brembo', 'Féktárcsa', 11500),
(2, 'Valeo', 'Ablaktörlő', 3000),
(3, 'Brembo', 'Fékbetét', 6500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leadott_rendeles`
--
ALTER TABLE `leadott_rendeles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `megrendeles`
--
ALTER TABLE `megrendeles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termek`
--
ALTER TABLE `termek`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leadott_rendeles`
--
ALTER TABLE `leadott_rendeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `megrendeles`
--
ALTER TABLE `megrendeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `termek`
--
ALTER TABLE `termek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
