-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2024 at 08:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hyperlightandsound`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint UNSIGNED NOT NULL,
  `Uuid` varchar(255) NOT NULL,
  `PDFId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PDFName` varchar(250) NOT NULL,
  `BillDate` date DEFAULT (curdate())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `events` (
  `id` int NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_date`, `event_time`, `event_name`, `event_type`, `location`) VALUES
(2, '2024-02-09', '09:00:00', 'Zomer Festival', 'Online', 'Lisa, Utrecht'),
(3, '2024-02-09', '10:00:00', 'Techniek Workshop', 'Online', 'Mark, Rotterdam'),
(4, '2024-02-10', '08:00:00', 'Geluidstechniek Seminar', 'Fysiek', 'Sophie, Den Haag'),
(5, '2024-02-10', '09:00:00', 'Lichtshow Spectaculair', 'Online', 'Jan, Amsterdam'),
(6, '2024-02-10', '10:00:00', 'Zomer Festival', 'Online', 'Lisa, Utrecht'),
(7, '2024-02-11', '08:00:00', 'Techniek Workshop', 'Fysiek', 'Sophie, Den Haag'),
(8, '2024-02-11', '09:00:00', 'Lichtshow Spectaculair', 'Online', 'Jan, Amsterdam');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `aantal` int DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categorie`, `naam`, `aantal`, `foto`) VALUES
(62, 'Geluid', 'davis artis 12', 7, '670e223ec1cd7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Uuid` varchar(255) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Uuid`, `Admin`, `Name`, `Password`, `Email`) VALUES
('03be6aa8-ea68-42b3-9220-4a2973492d4c', 2, 'jeff', '$2y$10$JyWIizy/MCS7YDDQYf7kHe4YELzXNVQrXAHaCtEwcT2H8lshuAA5e', 'Jeff@gmail.com'),
('5c0533a0-7afa-4d94-ab08-a7a03b6af94b', 1, 'Kjenno', '$2y$10$usYr7XJizkB7IZRIwkUsUOOYn40qNoYK6u70CZTgJ2YmHSIJ5Mu5W', 'Kjennoa@gmail.com'),
('6704f24d29ed64.46567885', 2, 'kjenno', '$2y$10$Hy4Tu1S1.mEFb.2VHDoocuFs0EA5CRimtOl1DJa5u5xQiH4JzhnbC', 'kjenno@gmail.com'),
('6721fdefd65e90.08604886', 2, 'elise van broeckhuijsen', '$2y$10$T4dw8/QlW.MHk3W.8Okl7upCY3sDj.ewxsYpUhyEjnf/U3Jnqu6p2', 'elise.v.br@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_uuid_foreign` (`Uuid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_uuid_foreign` FOREIGN KEY (`Uuid`) REFERENCES `user` (`Uuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
