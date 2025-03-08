-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 09:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `max_participants` varchar(20) NOT NULL DEFAULT 'unlimited',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `creator_id`, `title`, `description`, `location`, `start_date`, `end_date`, `max_participants`, `created_at`) VALUES
(82, 999, 'สงกรานต์', 'บาลๆๆๆๆๆ', 'มมส', '2025-04-13 08:03:00', '2025-04-16 08:03:00', 'unlimited', '2025-03-08 01:04:00'),
(83, 999, 'PubG Espot', 'การแข่งขัน เกมชื่อดังอย่าง พับจี PubG', 'คณะไอที', '2025-03-18 08:12:00', '2025-03-08 08:12:00', 'unlimited', '2025-03-08 01:13:13'),
(84, 999, 'party', 'i don\'t know', 'somewhere', '2025-04-08 08:14:00', '2025-04-25 08:14:00', 'unlimited', '2025-03-08 01:16:16'),
(85, 999, 'Rov Festival', 'Rov', 'ลานแปดเหลี่ยม', '2025-04-01 08:20:00', '2025-04-05 08:20:00', 'unlimited', '2025-03-08 01:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendance`
--

CREATE TABLE `event_attendance` (
  `attendance_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `otp_code` varchar(10) NOT NULL,
  `checked_in_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

CREATE TABLE `event_images` (
  `image_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_url2` varchar(255) NOT NULL,
  `image_url3` varchar(255) NOT NULL,
  `image_url4` varchar(255) NOT NULL,
  `image_url5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_images`
--

INSERT INTO `event_images` (`image_id`, `event_id`, `image_url`, `image_url2`, `image_url3`, `image_url4`, `image_url5`) VALUES
(118, 82, '1741395840_songkran-festival-phuket.jpg', '', '', '', ''),
(119, 82, '1741395840_songkran-day.jpg', '', '', '', ''),
(120, 83, '1741396393_wkqnnhjL.jpg', '', '', '', ''),
(121, 83, '1741396393_d16f5b2.jpg', '', '', '', ''),
(122, 83, '1741396393_capsule_616x353.jpg', '', '', '', ''),
(123, 84, '1741396576_pexels-photo-1105666.jpeg', '', '', '', ''),
(124, 84, '1741396576_Event-Organisers-For-Dance-Parties-1024x514.jpg', '', '', '', ''),
(125, 84, '1741396576_event-ideas-for-party-eventbookings.jpg', '', '', '', ''),
(126, 85, '1741396838_com.garena.game.kgth.sc0.2024-11-01-04-14-36_2x.jpg', '', '', '', ''),
(127, 85, '1741396838_attach-1484299023962.jpg', '', '', '', ''),
(128, 85, '1741396838_c9dde270-41c5-4b5d-85d6-b40085d7f7af.jpg', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `registration_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`registration_id`, `event_id`, `user_id`, `status`, `registered_at`) VALUES
(14, 82, 1, 'pending', '2025-03-08 01:21:48'),
(15, 83, 1, 'pending', '2025-03-08 01:21:55'),
(16, 84, 1, 'pending', '2025-03-08 01:22:01'),
(17, 85, 1, 'pending', '2025-03-08 01:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `event_statistics`
--

CREATE TABLE `event_statistics` (
  `stat_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `total_registered` int(11) DEFAULT 0,
  `total_approved` int(11) DEFAULT 0,
  `total_attended` int(11) DEFAULT 0,
  `male_count` int(11) DEFAULT 0,
  `female_count` int(11) DEFAULT 0,
  `other_count` int(11) DEFAULT 0,
  `avg_age` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `prefix`, `username`, `password`, `email`, `full_name`, `gender`, `birth_date`, `role`, `created_at`) VALUES
(1, '', 'john_doe', '$2y$10$aOzsFw9oSXv2RjBSEe7YOemfj4WjXbINEl54LsHEU94NnjGae93.6', 'john@example.com', 'John Doe', 'male', '1995-08-15', 'user', '2025-02-28 06:53:27'),
(7, '', 'jane_smith', '$2y$10$aOzsFw9oSXv2RjBSEe7YOemfj4WjXbINEl54LsHEU94NnjGae93.6', 'jane@example.com', 'Jane Smith', 'female', '1992-07-20', 'user', '2025-02-28 08:23:21'),
(8, '', 'mike_wang', '$2y$10$aOzsFw9oSXv2RjBSEe7YOemfj4WjXbINEl54LsHEU94NnjGae93.6', 'mike@example.com', 'Mike Wang', 'male', '1988-05-30', 'user', '2025-02-28 08:23:21'),
(9, '', 'sara_lee', '$2y$10$aOzsFw9oSXv2RjBSEe7YOemfj4WjXbINEl54LsHEU94NnjGae93.6', 'sara@example.com', 'Sara Lee', 'female', '1999-12-12', 'user', '2025-02-28 08:23:21'),
(222, 'นาย', 'GG', '$2y$10$XU66TX1oCmcoJD8PkZV0TO2RaB9d5Y4ps4YCkxdY26dK0ke/Q/TBS', 'VVV@V.com', 'A', 'ชาย', '0000-00-00', 'user', '2025-03-08 01:37:13'),
(555, 'นาย', 'สุดหล่อ', '$2y$10$1sl8qoktjTXDwU.cHGqLTO9kR2pMzZjXfc0a//jMe9SUx1QKr3xyK', 'handsome@h.com', 'ABC', 'ชาย', '2025-03-20', 'user', '2025-03-04 12:25:45'),
(999, 'นาย', 'Peter', '$2y$10$9yCFPRoktwIzr7kY3sTeselLFgR/TJReab0aBSBVIWyOwJkB6ZnRe', 'peter@gmail.com', 'sorayut mingnean', 'ชาย', '2004-07-14', 'admin', '2025-03-05 05:33:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `event_attendance`
--
ALTER TABLE `event_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_images`
--
ALTER TABLE `event_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_statistics`
--
ALTER TABLE `event_statistics`
  ADD PRIMARY KEY (`stat_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `event_attendance`
--
ALTER TABLE `event_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_images`
--
ALTER TABLE `event_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `event_statistics`
--
ALTER TABLE `event_statistics`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_attendance`
--
ALTER TABLE `event_attendance`
  ADD CONSTRAINT `event_attendance_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_attendance_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_images`
--
ALTER TABLE `event_images`
  ADD CONSTRAINT `event_images_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_statistics`
--
ALTER TABLE `event_statistics`
  ADD CONSTRAINT `event_statistics_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
