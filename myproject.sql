-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2022 at 09:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_ID`, `Category_Name`) VALUES
(1, 'Flowers'),
(3, 'Ring'),
(6, 'Dairy'),
(7, 'Chocolates');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(20) NOT NULL,
  `Product_Price` int(20) NOT NULL,
  `Product_Description` varchar(100) NOT NULL,
  `Product_Status` tinyint(4) NOT NULL,
  `Product_Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_ID`, `Product_Name`, `Product_Price`, `Product_Description`, `Product_Status`, `Product_Category`) VALUES
(1, 'Limestone', 100, 'Lorem Ipsum', 1, ''),
(2, 'Gems', 200, '', 0, ''),
(3, 'Stone', 80, '', 0, ''),
(4, 'Emerald', 90, '', 0, ''),
(5, 'Earing stone', 400, '', 0, ''),
(6, 'Ring', 390, '', 0, ''),
(7, 'Bangles', 190, '', 0, ''),
(8, 'Locket', 370, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas temporibus consequatur animi repellat!', 0, ''),
(9, 'Moon stone', 179, '', 0, ''),
(13, 'Earings', 200, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas temporibus consequatur animi repellat!', 0, ''),
(14, 'Crystal Frame', 300, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea dolorem voluptatum culpa tempora?', 1, ''),
(37, 'testing', 12000, 'heyy', 1, ''),
(39, 'Stone Ring', 300, 'Stone Ring here', 1, 'Ring');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `firstnamee` varchar(100) NOT NULL,
  `emailll` varchar(100) NOT NULL,
  `passwordd` varchar(100) NOT NULL,
  `statuss` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `firstnamee`, `emailll`, `passwordd`, `statuss`) VALUES
(1, 'Esha', 'esha@gmail.com', '123', 1),
(2, 'Abdul Rauf', 'abdulrauf03@gmail.com', '12345678', 0),
(3, 'Fayyash', 'fayyash12@gmail.com', '12345678', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
