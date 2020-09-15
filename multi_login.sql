-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2020 at 09:02 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `urltable1`
--

CREATE TABLE `urltable1` (
  `url_id` int(11) NOT NULL,
  `orig_url` varchar(255) NOT NULL,
  `short_url` varchar(50) NOT NULL,
  `rand_str` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `urltable1`
--

INSERT INTO `urltable1` (`url_id`, `orig_url`, `short_url`, `rand_str`) VALUES
(1, 'https://www.youtube.com/watch?v=5K84l19KLz4&t=1476s', '', '099');

-- --------------------------------------------------------

--
-- Table structure for table `urltable2`
--

CREATE TABLE `urltable2` (
  `url_id` int(11) NOT NULL,
  `orig_url` varchar(255) NOT NULL,
  `short_url` varchar(50) NOT NULL,
  `rand_str` varchar(50) NOT NULL,
  `txt` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `urltable2`
--

INSERT INTO `urltable2` (`url_id`, `orig_url`, `short_url`, `rand_str`, `txt`, `user_id`) VALUES
(4, 'https://www.instagram.com/', 'home.php?l=100', '100', 'social media', 23),
(5, 'https://www.timeout.com/things-to-do/best-things-to-do-in-the-world', 'home.php?l=ba6', 'ba6', 'misc', 23),
(8, 'https://www.youtube.com/watch?v=5K84l19KLz4&t=1476s', 'localhost/shortener/home.php?l=6e8', '6e8', '', 23),
(9, 'https://1337x.to/', 'home.php?l=432', '432', 'torrent site', 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `user_type`, `password`) VALUES
(8, 'dcsushil0', 'dcsushil0@gmail.com', 'admin', 'd8feaacf1f56357525fdcb6b7158fd3d'),
(21, 'dcsushil00', 'dcsushil00@gmail.com', 'user', 'd8feaacf1f56357525fdcb6b7158fd3d'),
(23, 'melu', 'melu@gmail.com', 'user', 'd8feaacf1f56357525fdcb6b7158fd3d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urltable1`
--
ALTER TABLE `urltable1`
  ADD PRIMARY KEY (`url_id`);

--
-- Indexes for table `urltable2`
--
ALTER TABLE `urltable2`
  ADD PRIMARY KEY (`url_id`),
  ADD KEY `fr_key` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `urltable1`
--
ALTER TABLE `urltable1`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `urltable2`
--
ALTER TABLE `urltable2`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `urltable2`
--
ALTER TABLE `urltable2`
  ADD CONSTRAINT `fr_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
