-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 11:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corememories`
--

-- --------------------------------------------------------

--
-- Table structure for table `islandcontents`
--

CREATE TABLE `islandcontents` (
  `islandContentID` int(4) NOT NULL,
  `islandOfPersonalityID` int(4) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `color` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandcontents`
--

INSERT INTO `islandcontents` (`islandContentID`, `islandOfPersonalityID`, `image`, `content`, `color`) VALUES
(1, 1, 'assets/img/dance.jpeg', 'Since I was a kid, dancing has been a significant part of my life. Whether it\'s grooving to the latest beats or expressing emotions through movement, dance has always been a source of joy and creativity for me. ', NULL),
(2, 1, NULL, 'It’s not just a hobby; it’s a way to connect with myself and others, to feel the rhythm, and to share moments that are both personal and universal.', '#82C293'),
(3, 1, NULL, 'Over the years, it has become a form of self-expression, allowing me to convey what words sometimes cannot capture. Whether performing on stage or dancing in the comfort of my room, dancing has been a constant companion, bringing happiness and growth to my life.', NULL),
(4, 2, 'assets/img/makeup.jpg', 'Since I discovered the art of makeup, it has been more than just a sideline—it’s become a cherished hobby and a form of self-expression.', NULL),
(5, 2, NULL, ' From experimenting with vibrant colors to perfecting subtle, natural looks, I find joy in creating beauty through brushes and palettes. ', NULL),
(6, 2, NULL, 'Makeup allows me to showcase creativity and transform ideas into reality, whether enhancing someone’s confidence or preparing them for a special moment. It’s a craft I’ve loved nurturing, blending my passion for artistry with the happiness of helping others feel their best.', NULL),
(7, 3, 'assets/img/family.jpg', 'Family has always been the heart of my life, providing love, support, and inspiration in everything I do. Spending time with my loved ones is not just a routine but a cherished hobby that strengthens our bond.', NULL),
(8, 3, NULL, 'Whether it’s sharing laughter over meals, creating traditions, or simply enjoying each other’s company, these moments bring warmth and joy to my days.', NULL),
(9, 3, NULL, 'My family is my foundation, and being with them reminds me of what truly matters in life—love, connection, and togetherness.', NULL),
(10, 4, 'assets/img/gamer.jpeg', 'Gaming has been one of my favorite hobbies, offering me a thrilling escape and a way to connect with others who share the same passion.', NULL),
(11, 4, NULL, 'It’s more than just playing—it’s about the stories, the challenges, and the sense of accomplishment that comes with every win or new discovery.', NULL),
(12, 4, NULL, 'Gaming fuels my imagination and keeps my competitive spirit alive, making it an essential part of my downtime.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `islandsofpersonality`
--

CREATE TABLE `islandsofpersonality` (
  `islandOfPersonalityID` int(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `shortDescription` varchar(300) DEFAULT NULL,
  `longDescription` varchar(900) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandsofpersonality`
--

INSERT INTO `islandsofpersonality` (`islandOfPersonalityID`, `name`, `shortDescription`, `longDescription`, `color`, `image`, `status`) VALUES
(1, 'Dance', 'Dancing Island', '', '#82C293', 'assets/img/dance.jpeg', NULL),
(2, 'Makeup', 'Makeup Island', NULL, '#FF85A5', NULL, NULL),
(3, 'Family', 'Family Island', NULL, '#655C9E', 'assets/img/family.jpeg', NULL),
(4, 'Gamer', 'Gamer Island', NULL, '#AA6FBF', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `islandcontents`
--
ALTER TABLE `islandcontents`
  ADD PRIMARY KEY (`islandContentID`);

--
-- Indexes for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  ADD PRIMARY KEY (`islandOfPersonalityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `islandcontents`
--
ALTER TABLE `islandcontents`
  MODIFY `islandContentID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  MODIFY `islandOfPersonalityID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
