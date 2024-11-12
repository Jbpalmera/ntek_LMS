-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 07:41 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `adminEmail` varchar(120) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullName`, `adminEmail`, `userName`, `password`, `updationDate`) VALUES
(2, 'Clive Dela Cruz', 'clive@yahoo.com', 'admin', '$2y$10$aqIT6Aotzl.3w51n/NQu7.n1LyWyrG0ldJgMRb1EHKQK6ekGhJRkS', '2024-10-04 02:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblarea`
--

CREATE TABLE `tblarea` (
  `id` int(11) NOT NULL,
  `floor` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `slotNumber` int(11) DEFAULT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL,
  `minReserve` int(11) NOT NULL,
  `maxReserve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblarea`
--

INSERT INTO `tblarea` (`id`, `floor`, `room`, `slotNumber`, `openTime`, `closeTime`, `minReserve`, `maxReserve`) VALUES
(1, '2F', 'CYBER NOOK AREA', 10, '08:00:00', '17:00:00', 1, 3),
(2, '2F', 'CYBER NOOK AREA', 10, '08:00:00', '17:00:00', 1, 3),
(4, '3F', 'CONFERENCE ROOM', 10, '08:00:00', '17:00:00', 1, 8),
(5, '4F', 'STUDY AREA', 5, '08:00:00', '17:00:00', 1, 3),
(6, '5F', 'CONFERENCE ROOM', 4, '08:00:00', '17:00:00', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblattend`
--

CREATE TABLE `tblattend` (
  `id` int(11) NOT NULL,
  `category` varchar(10) NOT NULL,
  `qrcode` varchar(20) DEFAULT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `srcode` varchar(20) DEFAULT NULL, 
  `kiosk` varchar(11) DEFAULT NULL,
  `floor` varchar(5) DEFAULT NULL,
  `in_time` varchar(50) DEFAULT NULL,
  `out_time` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `building` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `authorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `authorName`, `creationDate`, `updationDate`) VALUES
(5, 'Peter Druckers', '2024-05-15 02:42:25', '2024-07-19 08:53:45'),
(6, 'John Steinbeck', '2024-05-15 02:42:41', NULL),
(7, 'Victor Hugo', '2024-05-15 02:42:52', '2024-05-21 04:39:22'),
(8, 'David Bodanis', '2024-05-15 02:43:03', '2024-05-15 03:20:29'),
(9, 'Peter Druckers', '2024-05-15 02:43:13', '2024-05-16 09:20:54'),
(10, 'Stephen Hawking', '2024-05-15 02:43:21', NULL),
(11, 'Earle Stanle Garner', '2024-05-15 02:43:38', NULL),
(12, 'Shashi Tharoor', '2024-05-15 02:57:47', NULL),
(13, 'Sam Harris', '2024-05-15 02:57:53', NULL),
(14, 'Bertrand Russel', '2024-05-15 02:58:04', NULL),
(15, 'John Steinbeck', '2024-05-15 02:58:16', NULL),
(16, 'Dominique Lapierre', '2024-05-15 02:58:36', NULL),
(17, 'V P Kale', '2024-05-15 02:58:54', NULL),
(18, 'Sanjay Garg', '2024-05-15 02:59:04', NULL),
(19, 'Jaideva Goswami', '2024-05-15 02:59:05', NULL),
(20, 'P L Deshpande', '2024-05-15 02:59:18', NULL),
(21, 'Various ', '2024-05-15 02:59:36', NULL),
(22, 'William Dalrymple', '2024-05-15 02:59:55', NULL),
(23, 'Sunita Deshpande', '2024-05-15 03:00:18', NULL),
(24, 'Kuldip Nayar', '2024-05-15 03:00:29', NULL),
(25, 'John Foreman', '2024-05-15 03:00:31', NULL),
(26, 'Bob Woordward', '2024-05-15 03:01:29', NULL),
(27, 'Lorraine Hansberry', '2024-05-15 03:01:43', NULL),
(28, 'Stephen Hawking', '2024-05-15 03:01:46', NULL),
(29, 'Amartya Sen', '2024-05-15 03:01:54', NULL),
(30, 'Amitav Ghosh', '2024-05-15 03:02:12', NULL),
(31, 'Amartya Sen', '2024-05-15 03:02:31', NULL),
(32, 'Dan Brown', '2024-05-15 03:02:45', NULL),
(33, 'Stephen Dubner', '2024-05-15 03:02:48', NULL),
(34, 'Fyodor Dostoevsky', '2024-05-15 03:03:19', NULL),
(35, 'Jonathan Stroud', '2024-05-15 03:03:30', NULL),
(36, 'Yashwant Kanetkar', '2024-05-15 03:03:52', NULL),
(37, 'Edward Said', '2024-05-15 03:03:53', NULL),
(38, 'Schilling Taub', '2024-05-15 03:04:06', NULL),
(39, 'Vladimir Vapnik', '2024-05-15 03:05:00', NULL),
(40, 'David Forsyth', '2024-05-15 03:05:26', NULL),
(41, 'V P Menon', '2024-05-15 03:06:15', NULL),
(42, 'Leonard Mlodinow', '2024-05-15 03:07:57', NULL),
(43, 'Frank Shih', '2024-05-15 03:08:55', NULL),
(44, 'Maria Konnikova', '2024-05-15 03:10:22', NULL),
(45, 'Sebastian Gutierez', '2024-05-15 03:11:32', NULL),
(46, 'Kurt Vonnegut', '2024-05-15 03:12:35', NULL),
(47, 'Cedric Villani', '2024-05-15 03:13:39', NULL),
(48, 'Gerald Sussman', '2024-05-15 03:14:48', NULL),
(49, 'Abraham Eraly', '2024-05-15 03:16:02', NULL),
(50, 'Frank Kafka', '2024-05-15 03:17:35', NULL),
(51, 'John Pratt', '2024-05-15 03:18:57', NULL),
(52, 'Robert Nisbet', '2024-05-15 03:19:53', NULL),
(53, 'H. G. Wells', '2024-05-15 03:20:52', NULL),
(54, 'Werner Heisenberg', '2024-05-15 03:21:59', NULL),
(55, 'Andy Oram', '2024-05-15 03:23:00', NULL),
(56, 'Terence Tao', '2024-05-15 03:24:17', NULL),
(57, 'Drew Conway', '2024-05-15 03:30:27', '2024-05-15 03:30:45'),
(58, 'Nate Silver', '2024-05-15 03:31:59', NULL),
(59, 'Wes McKinney', '2024-05-15 03:32:58', NULL),
(60, 'Thomas Cormen', '2024-05-15 03:33:48', NULL),
(61, 'Siddhartha Deb', '2024-05-15 03:35:20', NULL),
(62, 'Albert Camus', '2024-05-15 03:37:16', NULL),
(63, 'Arthur Conan Doyle', '2024-05-15 03:38:01', NULL),
(64, 'Adam Smith', '2024-05-15 03:40:03', NULL),
(65, 'Ken Follet', '2024-05-15 03:41:28', NULL),
(66, 'Fritjof Capra', '2024-05-15 03:42:33', NULL),
(67, 'Richard Feynman', '2024-05-15 03:44:07', NULL),
(68, 'Ernest Hemingway', '2024-05-15 03:45:37', NULL),
(69, 'Charles Franklin', '2024-05-15 03:45:48', NULL),
(70, 'Charles Franklin', '2024-05-15 03:45:48', NULL),
(71, 'Frederick Forsyth', '2024-05-15 03:46:53', NULL),
(72, 'Jeffrey Archer', '2024-05-15 03:47:47', NULL),
(73, 'Randy Pausch', '2024-05-15 03:48:56', NULL),
(74, 'Ayn Rand', '2024-05-15 03:49:49', NULL),
(75, 'Guy Routh', '2024-05-15 03:49:50', NULL),
(76, 'Guy Routh', '2024-05-15 03:49:50', NULL),
(77, 'Garg, Sanjay', '2024-05-15 03:51:08', NULL),
(78, 'Michael Crichton', '2024-05-15 03:51:17', NULL),
(79, 'John Steinbeck', '2024-05-15 03:52:17', NULL),
(80, 'Edgar Allen Poe', '2024-05-15 03:53:19', NULL),
(81, 'Will Durant', '2024-05-15 03:56:03', NULL),
(82, 'P L Deshpande', '2024-05-15 03:56:53', NULL),
(83, 'John Steinbeck', '2024-05-15 03:57:56', NULL),
(84, 'John Grisham', '2024-05-15 05:16:18', NULL),
(85, 'V. S. Naipaul', '2024-05-15 05:17:53', NULL),
(86, 'Joseph Heller', '2024-05-15 05:18:50', NULL),
(87, 'BBC', '2024-05-15 05:19:50', NULL),
(88, 'Bob Dylan', '2024-05-15 05:20:33', NULL),
(89, 'Madan Gupta', '2024-05-15 05:21:36', NULL),
(90, 'Alfred Stonier', '2024-05-15 05:22:54', NULL),
(91, 'W. H. Greene', '2024-05-15 05:23:58', NULL),
(92, 'Gary Bradsky', '2024-05-15 05:25:03', NULL),
(93, 'Andrew Tanenbaum', '2024-05-15 05:28:06', '2024-05-15 05:29:25'),
(94, 'Richard Bach', '2024-05-15 05:34:17', NULL),
(95, 'William S Maugham', '2024-05-15 05:35:09', NULL),
(96, 'Robert Pirsig', '2024-05-15 05:36:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `device` int(11) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `code_type` int(11) DEFAULT NULL,
  `code` varchar(30) DEFAULT NULL,
  `floor` varchar(20) DEFAULT NULL,
  `room` varchar(20) DEFAULT NULL,
  `slot_id` int(8) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` varchar(30) DEFAULT NULL,
  `end_time` varchar(30) DEFAULT NULL,
  `in_time` varchar(30) NOT NULL,
  `in_status` varchar(10) NOT NULL,
  `out_time` varchar(30) NOT NULL,
  `out_status` varchar(10) NOT NULL,
  `at_time` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `device`, `user_id`, `code_type`, `code`, `floor`, `room`, `slot_id`, `date`, `start_time`, `end_time`, `in_time`, `in_status`, `out_time`, `out_status`, `at_time`) VALUES
(1, 0, '1', 0, '01', 'GF', 'CYBER NOOK AREA', 1, '2024-07-18', '2', '3', '', '', '', '', '2024-07-18 00:00:00'),
(2, 0, '2', 0, '02', 'GF', 'CYBER NOOK AREA', 2, '2024-07-18', '2', '3', '', '', '', '', '2024-07-18 00:00:00'),
(3, 0, '5', 0, '05', 'GF', 'CYBER NOOK AREA', 5, '2024-07-18', '4', '6', '', '', '', '', '2024-07-18 00:00:00'),
(4, 0, '3', 0, '03', 'GF', 'CYBER NOOK AREA', 1, '2024-07-18', '3', '4', '', '', '', '', '2024-07-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `bookName` varchar(255) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  `authorID` int(11) DEFAULT NULL,
  `accessionNumber` int(255) DEFAULT NULL,
  `isbnNumber` int(255) DEFAULT NULL,
  `nfcTag` varchar(255) DEFAULT NULL,
  `publication` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `bookPrice` int(11) DEFAULT NULL,
  `bookStatus` int(10) NOT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `availability` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `bookName`, `catID`, `authorID`, `accessionNumber`, `isbnNumber`, `nfcTag`, `publication`, `publisher`, `bookPrice`, `bookStatus`, `regDate`, `updationDate`, `availability`) VALUES
(1, 'Fundamentals of Wavelets', 6, 19, 1925, 24752, '1dd6f800', '2019', 'Wiley', 29, 1, '2024-05-15 02:59:56', '2024-10-10 05:49:58', NULL),
(2, 'Data Smart', 7, 25, 1900, 24813, '07e4e800', '2011', 'Wiley', 18, 1, '2024-05-15 03:01:23', '2024-10-08 02:27:25', NULL),
(3, 'God Created the Integers', 8, 10, 1928, 24813, '1d49fa00', '2018', 'Penguin', 18, 1, '2024-05-15 03:02:22', '2024-09-05 05:29:39', NULL),
(4, 'Superfreakonomics', 1, 33, 1856, 24336, '07e2151e', '2016', 'HarperCollins', 18, 0, '2024-05-15 03:03:31', '2024-10-10 07:04:19', NULL),
(5, 'Orientalism', 1, 5, 1927, NULL, '02157863', '2019', 'Penguin', 16, 1, '2024-05-15 03:04:32', '2024-09-10 08:02:34', NULL),
(6, 'Nature of Statistical Learning Theory', 7, 39, 1972, 24946, '', '2004', 'Springer', 23, 1, '2024-05-15 03:06:01', '2024-06-03 00:50:37', NULL),
(7, 'Integration of the Indian States', 10, 41, 1866, 24047, '', '2009', 'Orient Blackwan', 21, 1, '2024-05-15 03:07:12', '2024-05-20 03:18:24', NULL),
(8, 'Drunkard\'s Walk', 2, 42, 2018, 23668, '', '2011', 'Penguin', 17, 1, '2024-05-15 03:08:40', '2024-05-21 02:00:24', NULL),
(9, 'Image Processing & Mathematical Morphology', 6, 43, 1902, 23971, '', '2015', 'CRC', 29, 1, '2024-05-15 03:09:38', '2024-09-04 02:07:29', NULL),
(10, 'How to Think Like Sherlock Holmes', 12, 44, 1863, 24283, '', '2017', 'Penguin', 19, 1, '2024-05-15 03:11:11', '2024-05-21 02:00:27', NULL),
(11, 'Data Scientists at Work', 7, 45, 1931, 24906, '', '2007', 'Apress', 28, 1, '2024-05-15 03:12:16', '2024-05-21 02:00:20', NULL),
(12, 'Slaughtherhouse Five', 4, 46, 1936, 23521, '', '2011', 'Random House', 18, 1, '2024-05-15 03:13:19', '2024-05-21 02:00:37', NULL),
(13, 'Birth of a Theorem', 8, 47, 1961, 23868, '', '2005', 'Bodley Head', 23, 1, '2024-05-15 03:14:16', NULL, NULL),
(14, 'The Age of Discontuinity', 1, 5, 2009, NULL, '', '2016', 'Random House', 23, 1, '2024-05-15 03:15:33', '2024-05-15 05:53:56', NULL),
(15, 'Structure & Interpretation of Computer Programs', 9, 48, 1966, 23935, '', '2012', 'MIT Press', 20, 1, '2024-05-15 03:15:36', NULL, NULL),
(16, 'Age of Wrath', 10, 49, 1916, 24123, '', '2018', 'Penguin', 26, 1, '2024-05-15 03:16:45', '2024-05-21 02:00:09', NULL),
(17, 'Bookless in Baghdad', 5, 12, 1950, 24515, '', '1997', 'Penguin', 69, 1, '2024-05-15 03:17:22', '2024-05-21 02:00:16', NULL),
(18, 'Burning Bright', 4, 6, 1992, NULL, '', '1998', 'Penguin', 32, 1, '2024-05-15 03:17:22', '2024-05-15 05:54:04', NULL),
(19, 'Trial', 4, 50, 1969, 24920, '', '2008', 'Random House', 18, 1, '2024-05-15 03:18:22', NULL, NULL),
(20, 'The Hunchback of Notre Dame', 4, 7, 2024, NULL, '', '1998', 'Random House', 23, 1, '2024-05-15 03:18:40', '2024-05-21 02:00:32', NULL),
(21, 'Statistical Decision Theory', 7, 51, 1966, 23935, '', '2015', 'MIT Press', 18, 1, '2024-05-15 03:19:37', NULL, NULL),
(22, 'Electric Universe', 2, 8, 1929, NULL, '', '1960', 'Penguin', 25, 1, '2024-05-15 03:20:05', '2024-05-15 05:54:18', NULL),
(23, 'Data Mining Handbook', 7, 52, 2003, 23964, '', '2013', 'Apress', 16, 1, '2024-05-15 03:20:26', NULL, NULL),
(24, 'New Machiavelli', 4, 53, 1953, 23609, '', '2014', 'Penguin', 16, 1, '2024-05-15 03:21:34', NULL, NULL),
(25, 'New Markets & Other Essays', 1, 5, 2034, NULL, '', '2016', 'Penguin', 26, 1, '2024-05-15 03:21:51', '2024-05-15 05:54:25', NULL),
(26, 'Physics and Philosopy', 2, 54, 1872, 23923, '', '2001', 'Penguin', 15, 1, '2024-05-15 03:22:49', '2024-05-28 07:22:40', NULL),
(27, 'Making Software', 9, 55, 1866, 23623, '', '2010', 'O\'Reilly', 17, 1, '2024-05-15 03:23:56', NULL, NULL),
(28, 'The Theory of Everything', 2, 10, 1918, NULL, '', '2015', 'Jaico', 27, 1, '2024-05-15 03:24:00', '2024-05-15 05:54:31', NULL),
(29, 'Analysis', 9, 56, 1920, 24563, '', '2019', 'HBA', 19, 1, '2024-05-15 03:26:21', '2024-05-15 03:30:11', NULL),
(30, 'The Case of the Lame Canary', 4, 11, 1836, NULL, '', '1830', 'None', 29, 1, '2024-05-15 03:27:36', '2024-05-15 05:54:36', NULL),
(31, 'Machine Learning for Hackers', 7, 57, 1958, 23458, '', '2018', 'O\'Reilly', 17, 1, '2024-05-15 03:31:36', NULL, NULL),
(32, 'Free Will', 3, 13, 1831, 24242, '', '1985', 'FreePress', 99, 1, '2024-05-15 03:32:16', NULL, NULL),
(33, 'Signal and the Noise', 7, 58, 1958, 23458, '', '2018', 'Penguin', 20, 1, '2024-05-15 03:32:46', NULL, NULL),
(34, 'Python for Data Analysis', 7, 59, 1891, 23463, '', '2014', 'O\'Reilly', 13, 1, '2024-05-15 03:33:36', NULL, NULL),
(35, 'On Education', 3, 14, 1890, 23839, '', '2007', 'Routledge', 50, 1, '2024-05-15 03:33:53', NULL, NULL),
(36, 'Introduction to Algorithms', 9, 60, 1855, 24424, '', '2011', 'MIT Press', 16, 1, '2024-05-15 03:34:53', NULL, NULL),
(37, 'The Winter of Our Discontent', 10, 6, 1827, NULL, '', '1900', 'Penguin', 35, 1, '2024-05-15 03:36:09', '2024-05-15 05:54:44', NULL),
(38, 'Beautiful and the Damned', 5, 61, 1868, 24015, '', '2018', 'Penguin', 15, 1, '2024-05-15 03:36:24', NULL, NULL),
(39, 'Freedom at Midnight', 10, 16, 1969, NULL, '', '1978', 'Vikas', 34, 1, '2024-05-15 03:37:42', '2024-05-15 05:54:52', NULL),
(40, 'Outsider', 4, 62, 1941, 23544, '', '2019', 'Penguin', 15, 1, '2024-05-15 03:37:46', NULL, NULL),
(41, 'Complete Sherlock Holmes', 4, 63, 1824, 24435, '', '2015', 'Random House', 15, 1, '2024-05-15 03:39:19', NULL, NULL),
(42, 'The City of Joy', 13, 6, 1982, 23484, '', '2015', 'Penguin', 85, 1, '2024-05-15 03:40:04', NULL, NULL),
(43, 'Wealth of Nations', 1, 64, 2014, 24546, '', '2018', 'Random House', 17, 1, '2024-05-15 03:41:02', NULL, NULL),
(44, 'Pillars of the Earth', 4, 65, 1889, 24652, '', '2019', 'Random House', 18, 1, '2024-05-15 03:42:03', NULL, NULL),
(45, 'O Jerusalem!', 10, 16, 1988, 24925, '', '1990', 'Vikas', 44, 1, '2024-05-15 03:42:38', NULL, NULL),
(46, 'Tao of Physics', 2, 66, 1936, 24628, '', '2012', 'Penguin', 21, 1, '2024-05-15 03:43:12', NULL, NULL),
(47, 'The Great Indian Novel', 13, 12, 1954, 23826, '', '1960', 'Penguin', 69, 1, '2024-05-15 03:43:47', NULL, NULL),
(48, 'Surely You\'re Joking Mr. Feynman', 2, 67, 1966, 24467, '', '2014', 'Random House', 15, 1, '2024-05-15 03:45:11', NULL, NULL),
(49, 'Farewell to Arms', 4, 68, 2010, 24954, '', '2011', 'Rupa', 18, 1, '2024-05-15 03:46:24', NULL, NULL),
(50, 'The World\'s  Greatest Trials', 10, 69, 1992, 24067, '', '2008', 'Prentice Hall Press', 99, 1, '2024-05-15 03:46:59', NULL, NULL),
(51, 'The Veteran', 4, 71, 1879, 23475, '', '2011', 'Transworld', 19, 1, '2024-05-15 03:47:37', NULL, NULL),
(52, 'India from Midnight to Milennium', 10, 12, 2033, 24916, '', '2004', 'Penguin', 44, 1, '2024-05-15 03:47:45', NULL, NULL),
(53, 'False Impressions', 4, 72, 1847, 24954, '', '2001', 'Pan', 28, 1, '2024-05-15 03:48:28', NULL, NULL),
(54, 'Manasa', 14, 17, 1988, NULL, '', '1990', 'Mauj', 28, 1, '2024-05-15 03:48:28', '2024-05-15 05:55:04', NULL),
(55, 'The Last Lecture', 5, 73, 1837, 24954, '', '2011', 'Hyperion', 29, 1, '2024-05-15 03:49:34', NULL, NULL),
(56, 'Beyond Degrees', 14, 75, 1995, NULL, '', '1996', 'Harper Collins', 23, 1, '2024-05-15 03:50:27', '2024-05-15 05:55:12', NULL),
(57, 'Return of the Primitive', 3, 74, 2004, 23627, '', '2001', 'Penguin', 23, 1, '2024-05-15 03:51:00', NULL, NULL),
(58, 'Jurrasic Park', 4, 78, 2006, 24671, '', '2019', 'Random House', 13, 1, '2024-05-15 03:51:54', NULL, NULL),
(59, 'A Russian Journal', 4, 6, 1881, 23646, '', '2019', 'Penguin', 13, 1, '2024-05-15 03:52:57', NULL, NULL),
(60, 'Maqta-e-Ghalib', 13, 77, 2013, 23737, '', '2015', 'Mauj', 66, 1, '2024-05-15 03:53:00', NULL, NULL),
(61, 'Tales of Mystery and Imagination', 4, 80, 1872, 24380, '', '2016', 'HarperCollins', 20, 1, '2024-05-15 03:54:25', NULL, NULL),
(62, 'Aghal Paghal', 14, 20, 1975, 23978, '', '1980', 'Mauj', 55, 1, '2024-05-15 03:54:45', NULL, NULL),
(63, 'The Hidden Connection', 2, 66, 1934, 23479, '', '2011', 'HarperCollins', 12, 1, '2024-05-15 03:55:25', NULL, NULL),
(64, 'Gun Gayin Awadi', 14, 20, 1951, NULL, '', '1951', 'Mauj', 22, 1, '2024-05-15 03:55:27', '2024-05-15 05:55:22', NULL),
(65, 'The Story of Philosopy', 3, 81, 1982, 24373, '', '2001', 'Pocket', 29, 1, '2024-05-15 03:56:37', NULL, NULL),
(66, 'Asami Asami', 4, 20, 2013, 23730, '', '2002', 'Mauj', 20, 1, '2024-05-15 03:57:26', NULL, NULL),
(67, 'Journal of a Novel', 4, 15, 1881, 24001, '', '2004', 'Penguin', 12, 1, '2024-05-15 03:58:27', NULL, NULL),
(68, 'Once There Was a War', 5, 6, 1891, 24315, '', '2005', 'Penguin', 12, 1, '2024-05-15 03:59:05', NULL, NULL),
(69, 'Radiowaril Bhashane & Shrutika', 14, 20, 1951, NULL, '', '1950', 'Mauj', 33, 1, '2024-05-15 05:12:38', '2024-05-15 05:55:29', NULL),
(70, 'Social Choice & Welfare, Vol 39 No. 1', 1, 21, 1948, NULL, '', '1944', 'Springer', 21, 1, '2024-05-15 05:13:32', '2024-05-15 05:55:37', NULL),
(71, 'The Last Mughal', 10, 22, 1971, NULL, '', '1969', 'Penguin', 26, 1, '2024-05-15 05:15:18', '2024-05-15 05:55:45', NULL),
(72, 'The Moon is Down', 4, 79, 1867, 24385, '', '2018', 'Penguin', 18, 1, '2024-05-15 05:16:00', NULL, NULL),
(73, 'Ahe Manohar Tari', 10, 22, 1833, NULL, '', '1969', 'Penguin', 22, 1, '2024-05-15 05:16:55', '2024-05-15 05:55:51', NULL),
(74, 'The Brethren', 4, 84, 1911, 23768, '', '2017', 'Random House', 20, 1, '2024-05-15 05:16:59', NULL, NULL),
(75, 'Scoop!', 10, 24, 1989, NULL, '', '1988', 'HarperCollins', 33, 1, '2024-05-15 05:17:37', '2024-05-15 05:56:04', NULL),
(76, 'Prisoner of Birth, A', 4, 72, 1949, 24372, '', '1950', 'Pan', 66, 1, '2024-05-15 05:18:24', NULL, NULL),
(77, 'In a Free State', 4, 85, 1920, 23638, '', '2019', 'Rupa', 12, 1, '2024-05-15 05:18:28', NULL, NULL),
(78, 'All the President\'s Men', 10, 26, 1946, NULL, '', '1946', 'Random House', 26, 1, '2024-05-15 05:19:08', '2024-05-15 05:55:57', NULL),
(79, 'Catch 22', 4, 86, 1979, 23889, '', '2015', 'Random House', 24, 1, '2024-05-15 05:19:33', NULL, NULL),
(80, 'Raisin in the Sun, A', 13, 27, 1954, NULL, '', '1952', 'Penguin', 21, 1, '2024-05-15 05:19:58', '2024-05-15 05:56:11', NULL),
(81, 'The Complete Mastermind', 5, 87, 1933, 24304, '', '2014', 'BBC', 19, 1, '2024-05-15 05:20:23', NULL, NULL),
(82, 'Idea of Justice, The', 14, 29, 1958, NULL, '', '1956', 'Penguin', 25, 1, '2024-05-15 05:21:04', '2024-05-15 05:56:17', NULL),
(83, 'Dylan on Dylan', 5, 88, 1860, 24719, '', '2018', 'Random House', 18, 1, '2024-05-15 05:21:25', NULL, NULL),
(84, 'Sea of Poppies', 13, 30, 1924, NULL, '', '1922', 'Penguin', 23, 1, '2024-05-15 05:21:53', '2024-05-15 05:56:26', NULL),
(85, 'Soft Computing & Intelligent Systems', 7, 89, 1902, 23936, '', '2017', 'Elsevier', 15, 1, '2024-05-15 05:22:33', NULL, NULL),
(86, 'The Argumentative Indian', 14, 29, 1977, NULL, '', '1976', 'Picador', 13, 1, '2024-05-15 05:22:48', '2024-05-15 05:56:36', NULL),
(87, 'Angels & Demons', 13, 32, 2017, NULL, '', '2017', 'Random House', 26, 1, '2024-05-15 05:23:33', '2024-05-15 05:56:42', NULL),
(88, 'Textbook of Economic Theory', 1, 90, 1833, 23759, '', '2016', 'Pearson', 25, 1, '2024-05-15 05:23:43', NULL, NULL),
(89, 'Crime and Punishment', 13, 34, 1979, NULL, '', '1978', 'Penguin', 23, 1, '2024-05-15 05:24:16', '2024-05-15 05:56:48', NULL),
(90, 'Econometric Analysis', 1, 91, 2025, 24765, '', '2012', 'Pearson', 19, 1, '2024-05-15 05:24:47', NULL, NULL),
(91, 'Amulet of Samarkand, The', 13, 35, 1895, NULL, '', '1895', 'Random House', 28, 1, '2024-05-15 05:25:07', '2024-05-15 05:57:17', NULL),
(92, 'Learning OpenCv', 7, 92, 1848, 24420, '', '2013', 'O\'Reilly', 18, 1, '2024-05-15 05:25:34', '2024-05-23 01:32:30', NULL),
(93, 'Let Us C', 9, 36, 1989, NULL, '', '1988', 'Prentice Hall', 26, 1, '2024-05-15 05:25:52', '2024-05-15 05:56:53', NULL),
(94, 'Principles of Communication Systems', 9, 38, 1951, NULL, '', '1950', 'TMH', 31, 1, '2024-05-15 05:26:35', '2024-05-15 05:56:58', NULL),
(95, 'Computer Vision, A Modern Approach', 7, 40, 1877, NULL, '', '1876', 'Pearson', 22, 1, '2024-05-15 05:27:21', '2024-05-15 05:57:02', NULL),
(96, 'Data Structures Using C & C++', 7, 93, 2006, NULL, '', '2006', 'Prentice Hall', 21, 1, '2024-05-15 05:28:45', '2024-05-15 05:57:08', NULL),
(97, 'We the Living', 4, 74, 2835, 37643, '', '2017', 'Penguin', 21, 1, '2024-05-15 05:33:58', NULL, NULL),
(98, 'One', 5, 94, 2262, 31136, '', '2011', 'Dell', 21, 1, '2024-05-15 05:34:38', NULL, NULL),
(99, 'Maugham\'s Collected Short Stories', 4, 95, 2259, 29513, '', '2007', 'Vintage', 17, 1, '2024-05-15 05:35:50', NULL, NULL),
(100, 'Zen & The Art of Motorcycle Maintenance', 3, 96, 2498, 27290, '', '2009', 'Vintage', 25, 1, '2024-05-15 05:37:03', NULL, NULL),
(103, 'Book of Lifes', 1, 5, 123456, NULL, '1d49fa008b00009000', '2019', 'Rex', 5, 1, '2024-07-19 08:48:58', '2024-07-31 08:49:29', NULL),
(104, 'Sample Book 1', 1, 5, 123456, NULL, NULL, 'Sample Publication 1', 'Sample Publisher 1', 1, 1, '2024-09-09 06:53:14', '2024-09-09 06:55:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `categoryName`, `status`, `creationDate`, `updationDate`) VALUES
(1, 'Economics', 1, '2024-05-15 02:39:08', NULL),
(2, 'Science', 1, '2024-05-15 02:39:21', NULL),
(3, 'Philosophy', 1, '2024-05-15 02:39:29', NULL),
(4, 'Fiction', 1, '2024-05-15 02:39:33', NULL),
(5, 'Nonfiction', 1, '2024-05-15 02:39:43', NULL),
(6, 'Signal Processing', 1, '2024-05-15 02:58:53', NULL),
(7, 'Data Science', 1, '2024-05-15 03:00:13', NULL),
(8, 'Mathematics', 1, '2024-05-15 03:01:32', NULL),
(9, 'Computer Science', 1, '2024-05-15 03:02:36', '2024-05-15 03:13:21'),
(10, 'History', 1, '2024-05-15 03:03:40', NULL),
(12, 'Psychology', 1, '2024-05-15 03:10:10', NULL),
(13, 'Fiction', 1, '2024-05-15 03:12:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `bookID` int(11) DEFAULT NULL,
  `studentID` varchar(150) DEFAULT NULL,
  `issuesDate` timestamp NULL DEFAULT current_timestamp(),
  `expectedReturnDate` timestamp NULL DEFAULT NULL,
  `returnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `returnStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `bookID`, `studentID`, `issuesDate`, `expectedReturnDate`, `returnDate`, `returnStatus`, `fine`) VALUES
(1, 1, 'SID001', '2024-04-16 09:19:48', '2024-05-18 09:19:48', '2024-07-22 02:57:28', 1, 2),
(2, 4, 'SID001', '2024-05-17 01:40:03', '2024-05-19 01:40:03', '2024-05-20 03:18:02', 1, 1),
(3, 7, 'SID001', '2024-03-17 01:41:45', '2024-05-19 01:41:45', '2024-05-20 08:22:15', 1, 2),
(4, 4, 'SID001', '2024-05-20 03:18:53', '2024-05-22 03:18:53', '2024-05-21 01:50:25', 1, 0),
(5, 16, 'SID002', '2024-05-20 03:35:37', '2024-05-22 03:35:37', '2024-05-21 02:00:09', 1, 1),
(6, 9, 'SID004', '2024-05-20 03:36:17', '2024-05-22 03:36:17', '2024-07-22 06:16:17', 1, 2),
(7, 17, 'SID006', '2024-05-20 03:36:32', '2024-05-22 03:36:32', '2024-05-21 02:00:16', 1, 1),
(8, 11, 'SID006', '2024-05-20 03:36:58', '2024-05-21 03:36:58', '2024-05-21 02:00:20', 1, 1),
(9, 8, 'SID002', '2024-05-20 03:37:14', '2024-05-22 03:37:14', '2024-05-21 02:00:24', 1, 1),
(10, 10, 'SID003', '2024-05-20 03:37:27', '2024-05-21 03:37:27', '2024-05-21 02:00:27', 1, 1),
(11, 1, 'SID002', '2024-05-20 03:37:38', '2024-05-22 03:37:38', '2024-05-20 03:49:40', 1, 2),
(12, 20, 'SID001', '2024-05-20 03:39:36', '2024-05-22 03:39:36', '2024-05-21 02:00:32', 1, 1),
(13, 12, 'SID004', '2024-05-20 08:56:00', '2024-05-22 08:56:00', '2024-05-21 02:00:37', 1, 2),
(14, 4, 'SID001', '2024-05-21 01:51:47', '2024-05-23 01:51:47', '2024-05-21 02:00:42', 1, 2),
(15, 1, 'SID006', '2024-05-21 01:56:59', '2024-05-23 01:56:59', '2024-07-22 02:57:28', 1, 2),
(16, 1, 'SID001', '2024-05-21 03:32:33', '2024-05-23 03:32:33', '2024-07-22 02:57:28', 1, 2),
(17, 1, 'SID001', '2024-05-24 07:40:28', '2024-05-26 07:40:28', '2024-07-22 02:57:28', 1, 2),
(18, 5, 'SID001', '2024-05-28 03:12:42', '2024-05-30 03:12:42', '2024-05-28 03:13:07', 1, 0),
(19, 5, 'SID001', '2024-05-28 03:13:52', '2024-05-30 03:13:52', '2024-05-28 07:40:32', 1, 1),
(20, 26, 'SID004', '2024-05-28 06:40:21', '2024-05-30 06:40:21', '2024-05-28 07:22:40', 1, 2),
(21, 6, 'SID010', '2024-05-29 06:59:22', '2024-05-31 06:59:22', '2024-06-03 00:50:37', 1, 2),
(22, 5, 'SID001', '2024-07-19 03:48:06', '2024-07-24 03:48:06', '2024-07-19 03:48:27', 1, 25),
(23, 1, 'SID001', '2024-07-22 02:57:01', '2024-07-24 02:57:01', '2024-07-22 02:57:28', 1, 2),
(24, 1, 'SID001', '2024-07-22 02:58:15', '2024-07-27 02:58:15', '2024-07-22 02:58:41', 1, 2),
(25, 1, 'SID001', '2024-07-22 02:59:27', '2024-07-27 02:59:27', '2024-07-22 05:44:48', 1, 2),
(26, 1, 'SID002', '2024-07-22 06:10:01', '2024-07-24 06:10:01', '2024-07-22 06:14:31', 1, 2),
(27, 9, 'SID005', '2024-07-22 06:15:20', '2024-07-24 06:15:20', '2024-07-22 06:16:17', 1, 2),
(28, 103, 'SID001', '2024-07-22 06:42:58', '2024-07-27 06:42:58', '2024-07-22 06:43:50', 1, 5),
(29, 9, 'SID002', '2024-07-22 06:44:54', '2024-07-24 06:44:54', '2024-07-22 06:45:03', 1, 2),
(30, 9, 'SID005', '2024-07-22 06:45:33', '2024-07-24 06:45:33', '2024-07-22 06:57:43', 1, 2),
(31, 103, 'SID002', '2024-07-22 06:46:31', '2024-07-24 06:46:31', '2024-07-22 07:13:19', 1, 0),
(32, 1, 'SID001', '2024-07-22 07:11:39', '2024-07-27 07:11:39', '2024-07-22 07:13:25', 1, 0),
(33, 103, 'SID001', '2024-07-22 07:13:48', '2024-07-24 07:13:48', '2024-07-22 07:14:41', 1, 0),
(34, 1, 'SID001', '2024-07-22 07:14:19', '2024-07-24 07:14:19', '2024-07-22 07:14:47', 1, 0),
(35, 103, 'SID001', '2024-07-22 07:49:50', '2024-07-27 07:49:50', '2024-07-23 01:32:30', 1, 0),
(36, 1, 'SID001', '2024-07-22 07:53:28', '2024-07-27 07:53:28', '2024-07-23 01:32:36', 1, 0),
(37, 1, 'SID001', '2024-07-23 01:38:45', '2024-07-23 01:38:45', '2024-07-23 03:58:36', 1, 0),
(38, 1, 'SID001', '2024-07-23 03:58:50', '2024-07-28 03:58:50', '2024-07-23 05:35:00', 1, 0),
(39, 103, 'SID001', '2024-07-23 05:56:37', '2024-07-25 05:56:37', '2024-07-23 06:03:31', 1, 0),
(40, 103, 'SID001', '2024-07-23 06:44:13', '2024-07-25 06:44:13', '2024-07-31 08:49:29', 1, 1),
(41, 1, 'SID001', '2024-07-31 08:49:01', '2024-08-02 08:49:01', '2024-07-31 08:49:21', 1, 2),
(42, 1, 'SID002', '2024-07-31 08:50:14', '2024-08-02 08:50:14', '2024-08-01 06:19:10', 1, 0),
(43, 1, 'SID001', '2024-08-01 06:19:33', '2024-08-26 06:19:33', '2024-08-16 08:05:31', 1, 0),
(44, 1, 'SID001', '2024-08-30 03:52:03', '2024-09-01 03:52:03', '2024-08-30 07:43:42', 1, 0),
(45, 2, 'SID001', '2024-08-30 05:21:43', '2024-09-01 05:21:43', '2024-08-30 05:48:25', 1, 0),
(46, 2, 'SID001', '2024-08-30 07:44:18', '2024-09-01 07:44:18', '2024-08-30 07:44:35', 1, 0),
(47, 2, 'SID001', '2024-08-30 07:45:07', '2024-09-01 07:45:07', '2024-08-30 07:54:40', 1, 0),
(48, 2, 'SID001', '2024-09-03 01:04:49', '2024-09-04 01:04:49', '2024-09-03 01:07:36', 1, 1),
(49, 1, 'SID001', '2024-09-03 01:05:22', '2024-09-05 01:05:22', '2024-09-03 01:07:29', 1, 1),
(50, 2, 'SID001', '2024-09-03 01:11:39', '2024-09-04 01:11:39', '2024-09-04 02:00:46', 1, 1),
(51, 1, 'SID001', '2024-09-03 01:24:40', '2024-09-05 01:24:40', '2024-09-04 02:00:53', 1, 1),
(52, 2, 'SID001', '2024-09-04 02:01:21', '2024-09-05 02:01:21', '2024-09-04 02:07:47', 1, 1),
(53, 1, 'SID002', '2024-09-04 02:05:30', '2024-09-06 02:05:30', '2024-09-04 02:07:42', 1, 1),
(54, 3, 'SID001', '2024-09-04 02:18:15', '2024-09-05 02:18:15', '2024-09-04 02:21:54', 1, 1),
(55, 4, 'SID001', '2024-09-04 02:18:33', '2024-09-05 02:18:33', '2024-09-04 02:23:39', 1, 1),
(56, 2, 'SID001', '2024-09-04 02:18:50', '2024-09-05 02:18:50', '2024-09-04 02:23:33', 1, 1),
(57, 2, 'SID001', '2024-09-04 02:24:12', '2024-09-05 02:24:12', '2024-09-04 02:37:07', 1, 0),
(58, 4, 'SID001', '2024-09-04 02:24:50', '2024-09-05 02:24:50', '2024-09-04 02:25:03', 1, 1),
(59, 1, 'SID001', '2024-09-04 02:26:30', '2024-09-05 02:26:30', '2024-09-09 01:34:59', 1, 2),
(60, 3, 'SID001', '2024-09-04 02:28:45', '2024-09-05 02:28:45', '2024-10-08 02:27:42', 1, 0),
(61, 4, 'SID001', '2024-09-04 02:29:34', '2024-09-05 02:29:34', '2024-10-08 02:27:34', 1, 0),
(62, 2, 'SID005', '2024-09-04 02:57:49', '2024-09-06 02:57:49', '2024-09-05 05:29:39', 1, 1),
(63, 2, 'SID006', '2024-09-05 05:29:53', '2024-09-07 05:29:53', '2024-10-08 02:27:25', 1, 0),
(64, 4, 'SID001', '2024-10-10 07:04:19', '2024-10-12 07:04:19', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbljournal`
--

CREATE TABLE `tbljournal` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `publicationDate` timestamp NULL DEFAULT current_timestamp(),
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblmembership`
--

CREATE TABLE `tblmembership` (
  `id` int(11) NOT NULL,
  `membershipType` varchar(255) DEFAULT NULL,
  `categoryID` int(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmembership`
--

INSERT INTO `tblmembership` (`id`, `membershipType`, `categoryID`) VALUES
(1, 'Admin', 1),
(2, 'Student', 2),
(3, 'Faculty', 3),
(4, 'Staff', 4),
(5, 'Guest', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblslot`
--

CREATE TABLE `tblslot` (
  `id` int(11) NOT NULL,
  `date` varchar(20) DEFAULT NULL,
  `floor` varchar(11) NOT NULL,
  `room` varchar(20) NOT NULL,
  `slot` int(11) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `uniqueid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblslot`
--

INSERT INTO `tblslot` (`id`, `date`, `floor`, `room`, `slot`, `status`, `uniqueid`) VALUES
(1, '2024-07-17', 'GF', 'CYBER NOOK AREA', 1, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(2, '2024-07-17', 'GF', 'CYBER NOOK AREA', 2, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(3, '2024-07-17', 'GF', 'CYBER NOOK AREA', 3, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(4, '2024-07-17', 'GF', 'CYBER NOOK AREA', 4, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(5, '2024-07-17', 'GF', 'CYBER NOOK AREA', 5, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(6, '2024-07-17', 'GF', 'CYBER NOOK AREA', 6, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(7, '2024-07-17', 'GF', 'CYBER NOOK AREA', 7, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(8, '2024-07-17', 'GF', 'CYBER NOOK AREA', 8, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(9, '2024-07-17', 'GF', 'CYBER NOOK AREA', 9, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(10, '2024-07-17', 'GF', 'CYBER NOOK AREA', 10, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(11, '2024-07-18', 'GF', 'CYBER NOOK AREA', 1, '[0,0,1,1,0,0,0,0,0,0,0]', ''),
(12, '2024-07-18', 'GF', 'CYBER NOOK AREA', 2, '[0,0,1,0,0,0,0,0,0,0,0]', ''),
(13, '2024-07-18', 'GF', 'CYBER NOOK AREA', 3, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(14, '2024-07-18', 'GF', 'CYBER NOOK AREA', 4, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(15, '2024-07-18', 'GF', 'CYBER NOOK AREA', 5, '[0,0,0,0,1,1,0,0,0,0,0]', ''),
(16, '2024-07-18', 'GF', 'CYBER NOOK AREA', 6, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(17, '2024-07-18', 'GF', 'CYBER NOOK AREA', 7, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(18, '2024-07-18', 'GF', 'CYBER NOOK AREA', 8, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(19, '2024-07-18', 'GF', 'CYBER NOOK AREA', 9, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(20, '2024-07-18', 'GF', 'CYBER NOOK AREA', 10, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(21, '2024-07-18', '4F', 'STUDY AREA', 1, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(22, '2024-07-18', '4F', 'STUDY AREA', 2, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(23, '2024-07-18', '4F', 'STUDY AREA', 3, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(24, '2024-07-18', '4F', 'STUDY AREA', 4, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(25, '2024-07-18', '4F', 'STUDY AREA', 5, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(26, '2024-07-18', '2F', 'CYBER NOOK AREA', 1, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(27, '2024-07-18', '2F', 'CYBER NOOK AREA', 2, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(28, '2024-07-18', '2F', 'CYBER NOOK AREA', 3, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(29, '2024-07-18', '2F', 'CYBER NOOK AREA', 4, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(30, '2024-07-18', '2F', 'CYBER NOOK AREA', 5, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(31, '2024-07-18', '2F', 'CYBER NOOK AREA', 6, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(32, '2024-07-18', '2F', 'CYBER NOOK AREA', 7, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(33, '2024-07-18', '2F', 'CYBER NOOK AREA', 8, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(34, '2024-07-18', '2F', 'CYBER NOOK AREA', 9, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(35, '2024-07-18', '2F', 'CYBER NOOK AREA', 10, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(36, '2024-07-18', '3F', 'CONFERENCE ROOM', 1, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(37, '2024-07-18', '3F', 'CONFERENCE ROOM', 2, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(38, '2024-07-18', '3F', 'CONFERENCE ROOM', 3, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(39, '2024-07-18', '3F', 'CONFERENCE ROOM', 4, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(40, '2024-07-18', '3F', 'CONFERENCE ROOM', 5, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(41, '2024-07-18', '3F', 'CONFERENCE ROOM', 6, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(42, '2024-07-18', '3F', 'CONFERENCE ROOM', 7, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(43, '2024-07-18', '3F', 'CONFERENCE ROOM', 8, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(44, '2024-07-18', '3F', 'CONFERENCE ROOM', 9, '[0,0,0,0,0,0,0,0,0,0,0]', ''),
(45, '2024-07-18', '3F', 'CONFERENCE ROOM', 10, '[0,0,0,0,0,0,0,0,0,0,0]', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `studentID` varchar(100) DEFAULT NULL,
  `fullName` varchar(120) DEFAULT NULL,
  `emailID` varchar(120) DEFAULT NULL,
  `qrcode` varchar(50) NOT NULL,
  `rfid` varchar(50) NOT NULL,
  `mobileNumber` char(11) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `membershipID` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `studentID`, `fullName`, `emailID`, `qrcode`, `rfid`, `mobileNumber`, `password`, `membershipID`, `status`, `regDate`, `updationDate`) VALUES
(5, 'SID005', 'Juan Dela Cruz', 'juan@gmail.com', '05', '005', '09123456123', '$2y$10$Ys0or4aZyYny/NgCl9Pzge9WRTHjZDi2zWl2umVadvN6HoG1OcY.y', '2', 1, '2024-05-17 02:55:39', '2024-09-04 05:09:51'),
(6, 'SID006', 'jerald', 'jerald@gmail.com', '06', '07e4e800', '09221168999', '$2y$10$gJd.yevYbakXGZMid0kFUOPkavAkRr1o0Pc1NBmjO/2I5ys0IvQFS', '2', 1, '2024-05-20 01:04:43', '2024-09-04 05:55:25'),
(7, 'SID007', 'Jerald', 'jerald.vedua0826@gmail.com', '07', '07e2151e', '099999999', '$2y$10$ygF9uG45FpcmFvMCtfEigO3lYiNFRIPOtzLx8t0aCgUflNq4rgysm', '2', 1, '2024-05-20 01:10:34', '2024-09-05 02:21:06'),
(9, 'SID009', 'Jerald  Vedua', 'jeraldvdua@gmail.com', '09', '009', '09222116999', '$2y$10$gX5sbrV2uufkOqQNkTKOX.11Az.ze0nbHIxIqHberQRcPI5rIuhJK', '2', 1, '2024-05-29 06:37:08', '2024-09-04 07:50:41'),
(10, 'SID010', 'Jerald France Vedua', 'jerald.vedua@gmail.com', '10', '010', '09221168999', '$2y$10$AlsgEKoC7eyBZBihodP9Eexd9AiKhwOOl3Uog/MsdRwASHXa554oC', '2', 1, '2024-05-29 06:39:08', '2024-09-04 07:50:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblarea`
--
ALTER TABLE `tblarea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblattend`
--
ALTER TABLE `tblattend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbljournal`
--
ALTER TABLE `tbljournal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmembership`
--
ALTER TABLE `tblmembership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblslot`
--
ALTER TABLE `tblslot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentID` (`studentID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblarea`
--
ALTER TABLE `tblarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblattend`
--
ALTER TABLE `tblattend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbljournal`
--
ALTER TABLE `tbljournal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmembership`
--
ALTER TABLE `tblmembership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblslot`
--
ALTER TABLE `tblslot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
