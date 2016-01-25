--
-- Database: `cupumanik_guesthouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
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
  `categoryname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryname`) VALUES
(1, 'Rumah'),
(2, 'Kamar');

-- --------------------------------------------------------

--
-- Stand-in structure for view `gh_allorderswithcategory`
--
CREATE TABLE `gh_allorderswithcategory` (
`roomid` int(11)
,`roomname` varchar(1000)
,`description` varchar(2000)
,`categoryname` varchar(100)
,`categoryid` int(11)
,`ordercount` bigint(21)
,`orderid` bigint(11)
,`startdate` varchar(19)
,`enddate` varchar(19)
,`name` varchar(500)
,`address` varchar(1000)
,`phone` varchar(100)
,`email` varchar(200)
,`information` varchar(500)
,`isapproved` tinyint(1)
,`tanggalpesan` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `gh_roomslist`
--
CREATE TABLE `gh_roomslist` (
`roomid` int(11)
,`roomname` varchar(1000)
,`description` varchar(2000)
,`categoryname` varchar(100)
,`categoryid` int(11)
,`ordercount` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `information` varchar(500) NOT NULL,
  `roomid` int(11) NOT NULL,
  `isapproved` tinyint(1) NOT NULL,
  `tanggalpesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `startdate`, `enddate`, `name`, `address`, `phone`, `email`, `information`, `roomid`, `isapproved`, `tanggalpesan`) VALUES
(1, '2016-01-01 09:00:00', '2016-01-02 12:00:00', 'Isyana', 'Jakarta', '081111111', 'isyana@rasajeruk.com', 'Siapkan red carpet', 2, 1, '0000-00-00 00:00:00'),
(2, '2016-01-03 09:00:00', '2016-01-04 12:00:00', 'Raisa', 'Jakarta', '081111111', 'raisa@rasajeruk.com', 'Siapkan makan pagi', 2, 1, '0000-00-00 00:00:00'),
(3, '2016-01-05 09:00:00', '2016-01-06 12:00:00', 'Afgan', 'Jakarta', '081111111', 'afgan@rasajeruk.com', 'Siapkan makan pagi', 2, 1, '0000-00-00 00:00:00'),
(4, '2016-01-07 09:00:00', '2016-01-08 12:00:00', 'Random Person', 'Yogyakarta', '081111111', 'randomperson@rasajeruk.com', 'Siapkan makan pagi', 1, 0, '0000-00-00 00:00:00'),
(5, '2016-01-09 09:00:00', '2016-01-10 09:00:00', 'Sonny', 'Jalan Tamsis', '08111111', 'sonny@tampil.in', 'Tidak ada info', 3, 1, '0000-00-00 00:00:00'),
(11, '2016-01-22 00:00:00', '2016-01-23 00:00:00', 'Theodorus Yoga Mahendraputra', 'Jalan Kaliurang', '+6281229392999', 'thezerothe000@gmail.com', 'undefined', 1, 0, '0000-00-00 00:00:00'),
(12, '2016-01-21 00:00:00', '2016-01-31 00:00:00', 'Theodorus Yoga Mahendraputra', 'Jalan Kaliurang', '+6281229392999', 'thezerothe000@gmail.com', 'undefined', 3, 0, '0000-00-00 00:00:00'),
(13, '2016-01-24 00:00:00', '2016-01-29 00:00:00', 'Theodorus Yoga Mahendraputra', 'Jalan Tamsis', '+6281229392999', 'thezerothe000@gmail.com', 'undefined', 2, 0, '0000-00-00 00:00:00'),
(14, '2016-01-26 00:00:00', '2016-01-27 00:00:00', 'Theodorus Yoga Mahendraputra', 'Jl AM Sangaji 90A', '+6281229392999', 'thezerothe000@gmail.com', 'ini pertama informasi', 15, 0, '0000-00-00 00:00:00'),
(15, '2016-01-26 00:00:00', '2016-01-27 00:00:00', 'Theodorus Yoga Mahendraputra', 'tes', '+6281229392999', 'thezerothe000@gmail.com', 'tes', 1, 0, '0000-00-00 00:00:00'),
(16, '2016-01-25 00:00:00', '2016-01-26 00:00:00', 'Sonny', 'ABC', 'DEF', 'GHI', 'JKL', 21, 0, '2016-01-25 07:52:07'),
(17, '2016-01-25 00:00:00', '2016-01-25 00:00:00', 'Theo', 'Jalan AM Sangaji No 90A', '+6281229392999', 'thezerothe000@gmail.com', '', 1, 0, '2016-01-25 07:52:32'),
(18, '2016-01-25 00:00:00', '2016-01-25 00:00:00', 'Theodorus Yoga Mahendraputra', 'Jalan AM Sangaji No 90A', '+6281229392999', 'thezerothe000@gmail.com', '', 18, 0, '2016-01-25 07:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomid` int(11) NOT NULL,
  `roomname` varchar(1000) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomid`, `roomname`, `description`, `categoryid`) VALUES
(1, 'Kamar 1 (Extended)', 'Kamar di Kavling 1 yang penuh warna', 2),
(2, 'Rumah Kavling 1', 'Rumah ke-1 dari jalan utama', 1),
(3, 'Rumah Kavling 2', 'Rumah kedua dari jalan utama', 1),
(13, 'Rumah Kavling 3', 'Rumah ketiga dari jalan utama', 1),
(15, 'Rumah Kavling 4', 'Rumah keempat dari jalan utama', 1),
(18, 'Kamar 2', 'Kamar lantai dua di rumah pertama', 2),
(21, 'Kamar 4', 'Kamar di rooftop dari rumah pertama', 2);

-- --------------------------------------------------------

--
-- Structure for view `gh_allorderswithcategory`
--
DROP TABLE IF EXISTS `gh_allorderswithcategory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `gh_allorderswithcategory`  AS  select `roomslist`.`roomid` AS `roomid`,`roomslist`.`roomname` AS `roomname`,`roomslist`.`description` AS `description`,`roomslist`.`categoryname` AS `categoryname`,`roomslist`.`categoryid` AS `categoryid`,`roomslist`.`ordercount` AS `ordercount`,ifnull(`orders`.`id`,0) AS `orderid`,ifnull(`orders`.`startdate`,'0000-00-00 00:00') AS `startdate`,ifnull(`orders`.`enddate`,'0000-00-00 00:00') AS `enddate`,`orders`.`name` AS `name`,`orders`.`address` AS `address`,`orders`.`phone` AS `phone`,`orders`.`email` AS `email`,`orders`.`information` AS `information`,`orders`.`isapproved` AS `isapproved`,`orders`.`tanggalpesan` AS `tanggalpesan` from (`gh_roomslist` `roomslist` left join `orders` on((`orders`.`roomid` = `roomslist`.`roomid`))) order by `roomslist`.`roomname` ;

-- --------------------------------------------------------

--
-- Structure for view `gh_roomslist`
--
DROP TABLE IF EXISTS `gh_roomslist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `gh_roomslist`  AS  select `rooms`.`roomid` AS `roomid`,`rooms`.`roomname` AS `roomname`,`rooms`.`description` AS `description`,`categories`.`categoryname` AS `categoryname`,`categories`.`id` AS `categoryid`,count(`orders`.`id`) AS `ordercount` from ((`rooms` left join `categories` on((`rooms`.`categoryid` = `categories`.`id`))) left join `orders` on((`orders`.`roomid` = `rooms`.`roomid`))) group by `rooms`.`roomid`,`rooms`.`roomname`,`rooms`.`description`,`categories`.`categoryname` ;

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomid` (`roomid`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `rooms` (`roomid`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
