-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 mei 2024 om 16:54
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex_database`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminnaam` varchar(60) NOT NULL,
  `adminpass` varchar(255) NOT NULL,
  `adminemail` varchar(60) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `adminnaam`, `adminpass`, `adminemail`, `level`) VALUES
(1, 'Jan', '$2y$10$vAHDyTsdq1dY7HKMeqctW.InUPtsUyhMuDHlunxVs4ybCFgTaz.Ii', 'Koekenpan@gmail.com', 0),
(2, 'Pan', '$2y$10$I/iVpX/FrPuVokGl5PbrN.QX.2/9h5bAniRynVp/Ex/0WB/ePpfA2', 'Koekpan@gmail.com', 2),
(3, 'Pan', '$2y$10$6mGjKwzTTdtkLhftKJ45WO0he49SEWH8OVrdgH8u/GEuB9sExZPe2', 'Koekpan@gmail.com', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `id` int(11) NOT NULL,
  `naam` varchar(60) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `kleur` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`id`, `naam`, `wachtwoord`, `email`, `adres`, `kleur`, `level`) VALUES
(2, 'Mark', 'www', 'Mark@gmail.com', '', '', 0),
(3, 'Gangster Mike', '$2y$10$MPOVVXfl9sm.OYiS9xDPPu0JhLMy5Pxi8adyUyZ4.p1cz3D6wMjQa', 'TheRealGmike@gmail.com', 'Spinozaweg 21a', 'Zwart', 0),
(4, 'Vegeta', '$2y$10$rIxva3BEvxklFCVhr0aTS.3ZyiC3eQvnkGIRYuD2yXP66hfSq3lue', 'Princeofsaiyans@hotmail.com', '', '', 0),
(6, 'Sonic the hedgehog', '$2y$10$vbv1FFpV27w4ZKrQPz0tKOa/s5oNXYbSs.o2SaU0at4cyT69J3lGe', 'BlueBlur@gmail.com', '', '', 0),
(11, 'Kazuya', '$2y$10$a/x1NIdsvToM.4JIOBwR.OnfouAe0yRYcr8jNc5lhT7j1iPWnYSPC', 'Skibidi@skibidi.nl', 'Math Debate 21', 'Rood', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
