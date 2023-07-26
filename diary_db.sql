-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 02:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `user_id`) VALUES
(83, 'Travel Itinerary', 'Destination: Paris, France\r\nDay 1: Eiffel Tower, Louvre Museum\r\nDay 2: Notre-Dame Cathedral, Montmartre, Seine River Cruise\r\nDay 3: Versailles Palace, Sainte-Chapelle', 11),
(97, 'Meeting with Client', 'Today, I had a productive meeting with the client to discuss the project requirements. We went over the scope, timeline, and budget. The client seemed satisfied with the proposed plan, and we are all set to move forward with the development phase.', 11),
(99, 'Grocery List', 'Milk, eggs, bread, vegetables, and fruits are the items I need to buy from the grocery store. Don\'t forget to pick up some snacks for the movie night this weekend. Also, check for any discounts or deals available for the items on the list.', 11),
(100, 'Workout Routine', 'Today\'s workout routine includes 30 minutes of cardio, followed by weight training for arms and legs. Don\'t forget to stretch properly before and after the workout to prevent injuries. Stay hydrated throughout the session!', 11),
(101, 'Book Recommendations', 'I recently read \'The Alchemist\' by Paulo Coelho, and it was a captivating journey of self-discovery. Highly recommend it to anyone seeking inspiration and purpose. Next, I plan to read \'Educated\' by Tara Westover', 11),
(123, 'Test Note', 'This is a test note to check if the app is working properly. Everything seems to be working fine so far. This is just some random content to fill the note. Feel free to add more notes and test other features of the app!', 20),
(124, 'Test 2', 'This is a test note to check if the app is working properly. Everything seems to be working fine so far. This is just some random content to fill the note. Feel free to add more notes and test other features of the app!', 20),
(125, 'Test 3', 'This is a test note to check if the app is working properly. Everything seems to be working fine so far. This is just some random content to fill the note. Feel free to add more notes and test other features of the app!', 20),
(148, 'Longest Word', 'pneumonoultramicroscopicsilicovolcanoconiosis', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(11, 'jhean', '$2y$10$0H34S7om3phiMsaM7djI/eMquSraiG4VEndx.L5MxZdh4XcjUtNpi'),
(20, 'Khen', '$2y$10$V6m0zePoCz.y3mWMHMFshu2.xmXXKGEHkISR0yGcRZdCZdX9PO8d2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
