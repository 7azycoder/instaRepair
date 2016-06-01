-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2016 at 06:46 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instaRepair`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', ''),
(2, 'Administrator', '{\r\n"admin": 1,\r\n"moderator": 1\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `shopkeeper`
--

CREATE TABLE `shopkeeper` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `contactNo` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `join` datetime NOT NULL,
  `group` int(11) NOT NULL,
  `profileImage` varchar(100) NOT NULL DEFAULT 'default.png',
  `address` varchar(150) NOT NULL,
  `shopNo` varchar(10) DEFAULT NULL,
  `shopName` varchar(100) DEFAULT NULL,
  `shopDescription` varchar(200) DEFAULT NULL,
  `shopCategory` varchar(20) DEFAULT NULL,
  `shopLevel` varchar(10) DEFAULT NULL,
  `shopAddress` varchar(150) DEFAULT NULL,
  `shopEmail` varchar(50) DEFAULT NULL,
  `shopContactNo` varchar(13) DEFAULT NULL,
  `shopImage` varchar(100) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopkeeper`
--

INSERT INTO `shopkeeper` (`id`, `username`, `firstName`, `lastName`, `contactNo`, `email`, `password`, `salt`, `join`, `group`, `profileImage`, `address`, `shopNo`, `shopName`, `shopDescription`, `shopCategory`, `shopLevel`, `shopAddress`, `shopEmail`, `shopContactNo`, `shopImage`) VALUES
(1, 'Lovepreet_7', 'Lovepreet', 'Singh', '9560925110', 'dev.lovepreetsingh@gmail.com', 'a10de196881a7130cfcd7325b02cda8bcb0b0b8703f0f714eba94216ef7980d9', 'öš"_ïÉãFí°¡´}qr…ÏËJ@Î¦Bf(œ', '2016-04-16 11:47:06', 1, 'Lovepreet_7.jpg', 'Room No 323 , JCB Hostel', '1', 'lovepreet enterprises', 'A computer services provider', 'mobiles', 'low', 'Delhi', 'sss@gmail.com', '292992929292', 'Lovepreet_7.png'),
(2, 'Youvraaj', 'Youvi', 'Singh', '7878787878', 'youvi@gmail.com', 'a013408e1736e6076bed64e9b433b9eba8b7ff624bfacb16e3797713809884a5', 'UõÄ	I»ïTN"¸Ö³6?Û"Ò)Z(â-qÊ9ÀC', '2016-04-16 18:28:07', 1, 'Youvraaj.png', 'Mumbai', '11', 'Youvi Toys', 'This is our  big firmware shop ', 'electronics', 'medium', 'Bangalore', 'ssss@gmail.com', '8875889009', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `shopkeeper_session`
--

CREATE TABLE `shopkeeper_session` (
  `id` int(11) NOT NULL,
  `shopkeeperId` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopkeeper_session`
--

INSERT INTO `shopkeeper_session` (`id`, `shopkeeperId`, `hash`) VALUES
(5, 2, 'dc6d8967b5d282110f763ea6868ed03359d4e85697cbb61f013a008bc56b1b09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopkeeper_session`
--
ALTER TABLE `shopkeeper_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shopkeeper_session`
--
ALTER TABLE `shopkeeper_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
