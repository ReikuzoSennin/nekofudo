-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 13, 2021 at 08:46 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nekofudo`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(30) NOT NULL,
  `itemPrice` int(11) NOT NULL,
  `shopID` int(11) NOT NULL,
  `itemImg` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `itemName`, `itemPrice`, `shopID`, `itemImg`) VALUES
(1, 'Ikan Siakap', 25, 1, 'fish.png'),
(2, 'Takoyaki', 8, 1, 'takoyaki.png'),
(21, 'Maggi', 2, 1, 'maggi.png'),
(22, 'Dutch Lady Chocolate Milk', 10, 7, 'dutchlady.jpg'),
(23, 'Mi Sedap', 7, 7, 'misedap.jpeg'),
(24, 'Nasi Goreng Pataya', 5, 8, 'nasi pataya.jpg'),
(25, 'Paprik Campur', 3, 8, 'paprik.jpg'),
(26, 'Sate Ayam (10 pcs)', 7, 8, 'Sate.png'),
(27, 'Seafood', 12, 8, 'seafood.jpg'),
(28, 'Sup Daging', 6, 8, 'sup daging.jpg'),
(29, 'Tomyam Campur', 7, 8, 'tomyam.jpg'),
(30, 'Air Kosong', 1, 9, 'airkosong.jpg'),
(31, 'Jus Epal', 3, 9, 'applejuice.jpg'),
(32, 'Jus Tembikai', 3, 9, 'justembikai.jpg'),
(33, 'Milo Ais', 2, 9, 'Milo.jpg'),
(34, 'Teh Ais', 2, 9, 'teh.jpeg'),
(35, 'Nasi Putih', 1, 10, 'nasi-putih-1.jpg'),
(36, 'Ayam Buttermilk', 3, 10, 'ayamButtermilk.jpg'),
(37, 'Ayam Masak Merah', 3, 10, 'ayamMasakMerah.jpg'),
(38, 'Ikan Goreng', 2, 10, 'ikanGoreng.jpg'),
(39, 'Sambal Sotong', 3, 10, 'sambalSotong.jpg'),
(40, 'Telur Dadar', 1, 10, 'telurDadar.jpg'),
(41, 'Chicken Chop', 5, 11, 'chickenChop.jpg'),
(42, 'Lamb Chop', 5, 11, 'lambChop.jpg'),
(43, 'Lasagna', 5, 11, 'lasagna.jpg'),
(44, 'Spaghetti Cabonara', 5, 11, 'sphagettiCabonara.jpg'),
(45, 'Cheesy Wedges', 3, 11, 'cheeseWedges.jpg'),
(46, 'Burger Ayam', 3, 12, 'burgerAyam.jpg'),
(47, 'Burger Daging', 3, 12, 'burgerDaging.jpg'),
(48, 'Waffle Coklat', 3, 12, 'waffleCoklat.jpg'),
(49, 'Waffle Peanut Butter', 3, 12, 'wafflePeanutButter.jpg'),
(50, 'Jagung Manis (susu)', 2, 12, 'sweetCorn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `shopID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(11) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `shopID`, `userID`, `item`, `quantity`, `timestamp`, `status`) VALUES
(1, 1, 3, 'Ikan Siakap', 1, '2021-07-10 15:26:50', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shopID` int(11) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `shopImg` varchar(45) NOT NULL,
  `userID` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopID`, `shopName`, `shopImg`, `userID`, `timestamp`) VALUES
(1, 'Macam-Macam', 'sushiking.jpg', 2, '2021-05-25 08:59:30'),
(7, 'Kedai Serbaneka Pak Samad', 'paksamadcrop.jpg', 10, '2021-06-19 07:05:42'),
(8, 'Gerai 01 - Selera Thailand', 'vendor.png', 17, '2021-06-22 07:29:56'),
(9, 'Gerai 02 - Minuman', 'vendor.png', 18, '2021-06-22 07:34:01'),
(10, 'Gerai 03 - Lauk Campur', 'vendor.png', 19, '2021-06-22 07:36:22'),
(11, 'Gerai 04 - Western House', 'vendor.png', 20, '2021-06-22 07:39:06'),
(12, 'Gerai 05 - Burger dan Snek', 'vendor.png', 21, '2021-06-22 07:41:54'),
(14, 'New Shop', 'vendor.png', 27, '2021-07-01 13:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `userType` varchar(6) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `userType`, `timestamp`) VALUES
(1, 'root', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2021-07-09 08:41:12'),
(2, 'vendor1', 'ccfbef9bf08c11d5b804bec11bcea215', 'vendor', '2021-05-25 08:59:10'),
(3, 'test', '098f6bcd4621d373cade4e832627b4f6', 'user', '2021-06-07 06:20:42'),
(10, 'Pak Samad', '667b726d8e50cf22d10e5915040319b1', 'vendor', '2021-06-19 06:45:50'),
(17, 'gerai01', 'bdc583ab58f143aa72556e6a74749535', 'vendor', '2021-06-22 07:28:38'),
(18, 'gerai02', '6034e00fd9e997d13ec1b6742e624f5c', 'vendor', '2021-06-22 07:28:47'),
(19, 'gerai03', 'd20e5eddd3d0872d8af064b2218b46c5', 'vendor', '2021-06-22 07:28:56'),
(20, 'gerai04', '6434d4a9bb025d9cfb625738d9b67ef1', 'vendor', '2021-06-22 07:29:04'),
(21, 'gerai05', '0eeaf489aa78cdb2c754ffa7c903ece', 'vendor', '2021-06-22 07:29:12'),
(27, 'vendor300', '827ccb0eea8a706c4c34a16891f84e7b', 'vendor', '2021-07-01 13:29:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `fk_ITEM_shopID` (`shopID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `fk_ORDERS_shopID` (`shopID`),
  ADD KEY `fk_ORDERS_userID` (`userID`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shopID`),
  ADD KEY `fk_to_userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_ITEM_shopID` FOREIGN KEY (`shopID`) REFERENCES `shops` (`shopID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_ORDERS_shopID` FOREIGN KEY (`shopID`) REFERENCES `shops` (`shopID`),
  ADD CONSTRAINT `fk_ORDERS_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `fk_to_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
