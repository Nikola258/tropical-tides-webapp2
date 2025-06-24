-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Gegenereerd op: 24 jun 2025 om 11:06
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
(1, NULL, 'gendt', 'mooie plaats in nederland', 6, 100.1, 'assets/img/plaats.png', 0, '2025-06-17'),
(2, NULL, 'new york', 'usa', 4, 99.9, 'assets/img/plaats.png', 0, '2025-06-04'),
(3, NULL, ' ja', '  us', 4, 3.5, '  ', 0, '2554-02-12'),
(5, NULL, 'yuwiudew', 'wytdbekjw', 6, 1200000, 'https://th.bing.com/th/id/OIP.u6gkB8KalTRnl2eMnqr7tQHaFj?o=7rm=3&rs=1&pid=ImgDetMain', 5, '2025-06-22'),
(6, NULL, 'beach', 'very nice beach ', 2, 1224, 'https://th.bing.com/th/id/OIP.YwEcNbqM98l7IZHtfw4QxAHaFQ?rs=1&pid=ImgDetMain', 0, '2025-06-24');

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
(1, 'gendt', 'root', 'root@gmail.com', 'ebfyej', 4, 'ebfyej', '2025-06-22 21:30:57'),
(2, 'yuwiudew', 'root', 'root@gmail.com', 'wow so nice', 5, 'wow so nice', '2025-06-22 21:31:14'),
(3, 'beach', 'root', 'root@gmail.com', 'so nice beach wooww', 4, 'so nice beach wooww', '2025-06-23 06:39:53'),
(4, ' ja', 'root', 'root@gmail.com', 'this vacation was bad', 1, 'this vacation was bad', '2025-06-23 06:40:13'),
(5, ' ja', 'root', ' root@gmail.com', '', 3, '', '2025-06-23 09:59:03');

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
(1, 'testuser', 'test@gmail.com', 'hello test', '2025-06-22 21:07:22'),
(2, 'ewe3fr43q', '34qr31e234q@gmail.com', '34qr43e', '2025-06-22 21:09:15'),
(3, 'root', 'root@gmail.com', 'hello this is a test message', '2025-06-24 10:11:23'),
(4, 'Root', 'root@gmail.com', 'hello again', '2025-06-24 10:12:49');

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
(1, 11, 'root', 'root@gmail.com', 'ja', '5362PZ', '06098765452', 4, '2025-06-29', '2025-06-29', '2025-06-22 21:40:22'),
(2, 11, 'root', 'root@gmail.com', 'ja', '5362PZ', '06098765452', 4, '2025-06-29', '2025-06-29', '2025-06-22 21:41:07'),
(3, 11, 'root', 'root@gmail.com', 'gendt', '2378PZ', '0687542696', 4, '2025-06-23', '2025-06-29', '2025-06-22 21:44:33'),
(4, 12, 'root', 'user@gmail.com', 'beach', 'y43874hri', '098765432', 2, '2025-06-23', '2025-07-03', '2025-06-23 07:15:31'),
(5, 14, 'test1', 'test123@gmail.com', 'yuwiudew', '2632PZ', '068263556', 3, '2025-06-25', '2025-06-27', '2025-06-24 09:17:46'),
(6, 14, 'test1', 'test123@gmail.com', ' ja', '4yu3jhk', '3414r314', 43, '2025-06-29', '2025-07-03', '2025-06-24 09:18:31'),
(7, 14, 'test1', 'test123@gmail.com', ' ja', 'ty3287', '/0987675432', 3, '2025-06-28', '2025-07-03', '2025-06-24 09:20:51'),
(8, 14, 'test1', 'test123@gmail.com', 'gendt', '4523PZ', '06836234266', 4, '2025-06-26', '2025-07-03', '2025-06-24 09:22:34'),
(9, 14, 'test1', 'test123@gmail.com', 'new york', '6355PZ', '06987654321', 1, '2025-06-27', '2025-07-03', '2025-06-24 09:27:39'),
(10, 11, 'root', ' root@gmail.com', 'gendt', '3646pPZ', '09876543', 1, '2025-06-27', '2025-07-03', '2025-06-24 09:34:45'),
(11, 11, 'root', ' root@gmail.com', 'yuwiudew', '8536PZ', '0698765431', 1, '2025-06-25', '2025-07-02', '2025-06-24 11:04:59');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `feedback_role`
--
ALTER TABLE `feedback_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `user_bookings`
--
ALTER TABLE `user_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
