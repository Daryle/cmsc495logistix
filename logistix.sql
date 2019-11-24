-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 23, 2019 at 11:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistix`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`) VALUES
(1, 'Sony'),
(2, 'MS'),
(3, 'MSI'),
(4, 'Steel Series'),
(5, 'VertaGear'),
(6, 'DX');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manu_id` int(11) NOT NULL,
  `PName` varchar(255) NOT NULL,
  `PManu` varchar(255) NOT NULL,
  `PDesc` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `PImage` varchar(255) DEFAULT NULL,
  `dateup` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `user_id`, `manu_id`, `PName`, `PManu`, `PDesc`, `qty`, `PImage`, `dateup`) VALUES
(38, 20, 1, 'PlayStation', 'Sony', 'PlayStation Gaming', 35, 'images/playstation-4-pro.jpg', '2019-11-05 22:43:06'),
(40, 20, 2, 'XBOX One', 'MS', 'Gaming', 12, 'images/xbox-one-x_940x528-hero_575px.png', '2019-11-05 22:48:18'),
(41, 20, 3, 'MSI Laptop', 'MSI', 'Gaming', 47, 'images/msi.jpg', '2019-11-05 23:03:19'),
(42, 20, 3, 'MSI Laptop X', 'MSI', 'Gaming', 0, 'images/msi.jpg', '2019-11-05 23:04:13'),
(43, 20, 4, 'Steel Series Head Set', 'Steel Series', 'Gaming', 55, 'images/steelseries_arctis_3_headset_vit_-_2019_edition_4.jpg', '2019-11-05 23:18:22'),
(44, 20, 4, 'Steel Series Head Set 2', 'Steel Series', 'Gaming', 45, 'images/steelseries_arctis_3_headset_vit_-_2019_edition_4.jpg', '2019-11-05 23:20:29'),
(45, 20, 2, 'XBOX One Ultimate', 'MS', 'Gaming', 77, 'images/xbox-one-x_940x528-hero_575px.png', '2019-11-05 23:21:44'),
(46, 20, 5, 'VertaGear Chair', 'VertaGear', 'Gaming HeadSet', 22, 'images/vertagear_gamingchair.jpg', '2019-11-06 02:20:38'),
(47, 20, 5, 'VertaGear Chair X', 'VertaGear', 'Gaming', 45, 'images/vertagear_gamingchair.jpg', '2019-11-06 02:21:48'),
(48, 20, 1, 'Play Station 8', 'Sony', 'Gaming', 3, 'images/playstation-4-pro.jpg', '2019-11-06 02:27:02'),
(49, 30, 4, 'SteelSeries KeyBoard', 'Steel Series', 'Gaming', 45, 'images/gamingkeyboardSteel.jpg', '2019-11-06 02:36:55'),
(50, 20, 6, 'Racer Gaming Chair', 'DX', 'gaming', 12, 'images/296-2962561_dxracer-grey-chair-gaming-chair-transparent-background.png', '2019-11-06 03:40:53'),
(51, 20, 6, 'Racer Gaming Chair XX', 'DX', 'Gaming', 44, 'images/296-2962561_dxracer-grey-chair-gaming-chair-transparent-background.png', '2019-11-06 03:43:02'),
(52, 20, 1, 'Play Station 12', 'Sony', 'gaming', 55, 'images/playstation-4-pro.jpg', '2019-11-06 03:43:58'),
(53, 20, 4, 'Steel Series Head Set XX', 'Steel Series', 'Gaming', 72, 'images/steelseries_arctis_3_headset_vit_-_2019_edition_4.jpg', '2019-11-06 15:14:16'),
(54, 29, 3, 'MSI Laptop 12', 'MSI', 'Gaming', 23, 'images/msi.jpg', '2019-11-06 15:32:03'),
(55, 20, 1, 'Play Station 32', 'Sony', 'Gaming', 33, 'images/playstation-4-pro.jpg', '2019-11-08 21:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `access` tinyint(4) DEFAULT NULL,
  `failLog` tinyint(4) DEFAULT NULL,
  `initAccess` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `userName`, `email`, `passWord`, `image`, `dateTime`, `access`, `failLog`, `initAccess`) VALUES
(20, 'daryle', 'urrea', 'daryle', 'daryle@daryle.com', '$2y$10$0sW8GVydTZgacKglU8JXF.XYmnuIEAWJAyg/EZKXPNMQkdzHMJKGi', 'images/ironman.jpg', NULL, 1, NULL, 1),
(29, 'daryleStaff', 'urrea', 'daryleStaff', 'daryle@daryle.com', '$2y$10$mr66wW7jaQbuJZems53Oueyt5fMkaXmu3HQIctA833kBFAb8vGg0u', NULL, '2019-11-19 19:28:50', 4, NULL, NULL),
(33, 'Jella', 'An', 'JellaAdmin', 'Jella@jella.com', '$2y$10$CU7wqJudr.wQgPgXoS3mbu/bcf6sgCvvtPjFkK3YmX3fFUUHfM39O', NULL, '2019-11-09 11:11:49', 1, 0, 1),
(34, 'Brandon', 'Elliott', 'BrandonAdmin', 'brandon@brandon.com', '$2y$10$C5cDW0GLmV8d/rGQ3f/quuVbWZB7PINBq./Av2OWjG05Tcytj4Zgi', NULL, '2019-11-09 11:12:52', 1, 0, 0),
(35, 'Tom', 'Cress', 'TomAdmin', 'tom@tom.com', '$2y$10$qmBUAzXhf51IUHQ.vUx7auZ7cJe4QP5kjlTT8OryXrvF.SUcQ4T0y', NULL, '2019-11-09 11:13:44', 1, 0, 0),
(36, 'Jella', 'An', 'Jella', 'jella@jella.com', '$2y$10$Ty7aUPiwMZh2.7BllyoUZeICcnuW0ascn6G/vokGpW3fkWf74vxNq', NULL, '2019-11-19 10:05:22', 0, 0, 1),
(37, 'Tom', 'Cress', 'Tom', 'tom@tom.com', '$2y$10$MgFWWDi4N/FeeSMjYq4/B.thC/mpTchATZXMJqhtKFAY3PZ6Zdyyy', NULL, '2019-11-18 22:55:37', 0, 0, 1),
(38, 'Brandon', 'Elliott', 'Brandon', 'brandon@brandon.com', '$2y$10$LTIOGKubFL2.35lNoD8mRe5.B9xHbVGHystqeSQWgspIxTRRhizKm', NULL, '2019-11-18 22:55:42', 0, 0, 1),
(39, 'daryle', 'urrea', 'daryleMember', 'daryle.daryle.com', '$2y$10$qxAX1X3lmDujB5YqtgR.FeVQKKooE130H4Pq/d4jRa/unisKFt2hK', NULL, '2019-11-19 16:38:44', 0, 0, 1),
(40, 'Daryle', 'Urrea', 'daryleMember2', 'daryle.urrea@hotmail.com', '$2y$10$OklEMDyuGMR1llEiTFi3WuEsIHbgUymmyjlJveHHJLVvU2lJyfZyS', NULL, '2019-11-20 09:39:56', 4, 0, 1),
(46, 'Daryle', 'Urrea', 'daryleMember3', 'daryle.urrea@hotmail.com', '$2y$10$Sdnz9PWXCASNG9f78iWHT.izVtYFhw2vY2HLwP/.2JkMZ2DlNw.5W', 'images/ironman.jpg', '2019-11-19 17:08:11', 0, 0, 1),
(47, 'John', 'Doe', 'admin', 'Admin@logistix.com', '$2y$10$/pG83L2wsj1a./z5YhWmN.2d.XunxyL9P0vR9k/xQ1XGOQIxbhhKC', NULL, '2019-11-23 23:53:35', 1, 0, 0),
(48, 'Jane', 'Doe', 'member', 'member@logistix.com', '$2y$10$uRUldYNEnCotyhaCQVKCzeRlc.MXkO5luIAxbBYUOXF2il6LmSICq', NULL, '2019-11-23 23:54:01', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `manu_id` (`manu_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
