-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2015 at 06:21 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cupumanik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(200) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', '29821b0e714352428d6bc19a9cb595ad');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryname` varchar(100) NOT NULL DEFAULT 'Kosong',
  `uniquelink` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryname`, `uniquelink`) VALUES
(1, 'Sunda 1', '/category/batik'),
(7, 'Jawa', '/category/Jawa'),
(8, 'Kalimantan', '/category/Kalimantan'),
(11, 'Maluku', '/category/Maluku');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `associatedorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `productid`, `amount`, `associatedorder`) VALUES
(7, 23, 5, 4),
(8, 1, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `information` varchar(5000) DEFAULT NULL,
  `date` datetime NOT NULL,
  `isprocessed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `phone`, `email`, `information`, `date`, `isprocessed`) VALUES
(4, 'Raisa', 'Jalanku tak seindah jalanmu', '08111111111', 'raisa@mail.com', 'jangan lupa bonusnya kakak :3', '2015-12-30 06:19:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(10000) NOT NULL DEFAULT 'NONAME',
  `image` varchar(10000) DEFAULT NULL,
  `description` varchar(20000) DEFAULT NULL,
  `categoryid` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `image`, `description`, `categoryid`, `stock`, `price`) VALUES
(1, 'Batik 1 ubah', '/images/batik_logo_resized.jpg', 'deskripsi', 7, 10, 1200000),
(6, 'Batik 2', '/images/11850688_1609808479275111_1105225009019675090_o_resized.jpg', 'desc', 1, 8, 50000),
(22, 'BATIK ANAK (TES RESET)', '/images/park_8-wallpaper-2560x1440_resized.jpg', 'RESET KEREN', 1, 122, 1200000),
(23, 'Batik Termahal', '/images/eiffel_tower_hd_wallpaper_resized.jpg', 'Desk', 1, 100, 5000000),
(24, 'Batik Jawa ', '/images/1366x768_resized.jpg', 'Turunan dari...', 1, 3, 10000000),
(25, 'Kalimantanku', '/images/1366x768_resized.jpg', 'DESKRIPSI', 8, 100, 100000),
(26, 'MALUKU', '/images/VAIO_BrightColor_1600x1200_resized.jpg', 'DESKRIPSI', 11, 100, 250000);

-- --------------------------------------------------------

--
-- Table structure for table `randomnumbers`
--

CREATE TABLE `randomnumbers` (
  `id` int(11) NOT NULL,
  `associatedorder` int(11) NOT NULL,
  `randomnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `randomnumbers`
--

INSERT INTO `randomnumbers` (`id`, `associatedorder`, `randomnumber`) VALUES
(3, 4, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `associatedorder` (`associatedorder`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `randomnumbers`
--
ALTER TABLE `randomnumbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `associatedorder` (`associatedorder`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `randomnumbers`
--
ALTER TABLE `randomnumbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`associatedorder`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`id`);

--
-- Constraints for table `randomnumbers`
--
ALTER TABLE `randomnumbers`
  ADD CONSTRAINT `randomnumbers_ibfk_1` FOREIGN KEY (`associatedorder`) REFERENCES `orders` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
