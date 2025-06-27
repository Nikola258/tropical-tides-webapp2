-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Gegenereerd op: 25 jun 2025 om 06:44
-- Serverversie: 11.7.2-MariaDB-ubu2404
-- PHP-versie: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epic-vacationsdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`, `created_at`) VALUES
(8, 'admin@tropical-tides.com', 'admin', 'Admin', '2025-06-11 10:03:47'),
(11, 'neil', 'neil', 'Admin', '2025-06-17 08:39:17');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plaats` varchar(50) NOT NULL,
  `beschrijving` varchar(250) NOT NULL,
  `personen` int(25) NOT NULL,
  `prijs` double NOT NULL,
  `img` varchar(100) NOT NULL,
  `rating` double NOT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `plaats`, `beschrijving`, `personen`, `prijs`, `img`, `rating`, `datum`) VALUES
(8, NULL, 'Bora Bora', 'Beautiful beach.', 5, 3600, 'https://cdn.wallpapersafari.com/28/56/LGPgu3.jpg', 3.3, '2025-06-24');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `plaats` varchar(255) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_description` text DEFAULT NULL,
  `user_rating` int(100) NOT NULL,
  `user_review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `feedback`
--

INSERT INTO `feedback` (`id`, `plaats`, `user_name`, `user_email`, `user_description`, `user_rating`, `user_review`, `created_at`) VALUES
(6, 'Bora bora', 'root', ' root@gmail.com', 'amazing beach', 5, 'amazing beach', '2025-06-24 20:28:59'),
(8, 'bora bora', 'root', 'user@gmail.com', 'it was alright', 4, 'to be honest i didnt really like it', '2025-06-24 20:59:03'),
(9, 'bora bora', 'test1', 'test123@gmail.com', 'dw', 1, 'dw', '2025-06-24 21:18:22');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback_role`
--

CREATE TABLE `feedback_role` (
  `id` int(11) NOT NULL,
  `travel_agency` int(11) NOT NULL,
  `booking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(9, 'root', ' root@gmail.com', 'ferghfvb3kjq,', '2025-06-24 20:12:11'),
(12, 'root', ' root@gmail.com', 'test', '2025-06-24 20:12:26');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `created_at`) VALUES
(8, 'admin@tropical-tides.com', 'admin', 'Admin', '2025-06-11 10:03:47'),
(11, ' root@gmail.com', '$2y$10$vCkWnRPq4eVJ4YAkjDFfeO8VCngEVKfb3kFFbK1QRxtWHsvWI7KCm', 'root', '2025-06-22 20:49:04'),
(12, 'user@gmail.com', '$2y$10$D9YWHWLn.famf3JlSkaio.g7.CAC3fuF/upKMG.k.9eDhqDt.DD1a', 'root', '2025-06-23 07:15:00'),
(13, 'user', 'user', 'user', '2025-06-23 07:46:16'),
(14, 'test123@gmail.com', '$2y$10$/Kf5OtXX6372SXoM811QhORi7BVXTDLKYafDRLgpOfYCgpNUH4F62', 'test1', '2025-06-24 09:08:05');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_bookings`
--

CREATE TABLE `user_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `plaats` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `telefoonnummer` varchar(20) NOT NULL,
  `personen` int(11) NOT NULL,
  `arrivals_date` date NOT NULL,
  `leaving_date` date NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_bookings`
--

INSERT INTO `user_bookings` (`id`, `user_id`, `naam`, `email`, `plaats`, `adres`, `telefoonnummer`, `personen`, `arrivals_date`, `leaving_date`, `booking_date`) VALUES
(4, 12, 'root', 'user@gmail.com', 'beach', 'y43874hri', '098765432', 2, '2025-06-23', '2025-07-03', '2025-06-23 07:15:31'),
(12, 11, 'root', ' root@gmail.com', ' ja', '2542PZ', '0698765432456', 1, '2025-06-24', '2025-07-01', '2025-06-24 18:40:26'),
(16, 11, 'root', ' root@gmail.com', 'Bora Bora', '8373PZ', '068273633', 1, '2025-06-24', '2025-07-01', '2025-06-24 21:09:51');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `admin` varchar(1000) NOT NULL,
  `user` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_roles`
--

INSERT INTO `user_roles` (`id`, `admin`, `user`) VALUES
(1, 'admin', 'user');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_booking_user` (`user_id`);

--
-- Indexen voor tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `feedback_role`
--
ALTER TABLE `feedback_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `user_bookings`
--
ALTER TABLE `user_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `feedback_role`
--
ALTER TABLE `feedback_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `user_bookings`
--
ALTER TABLE `user_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `user_bookings`
--
ALTER TABLE `user_bookings`
  ADD CONSTRAINT `fk_user_bookings_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
