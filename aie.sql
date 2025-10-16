-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 04:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aie`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `type`, `token`, `status`) VALUES
(1, 'iPhone 14', '112,000', 'Cellphone', 'qu0myiJo3RQVwiSBDF7R', 'active'),
(2, 'MacBook Air 13', '150,000', 'Laptop', 'gHmAJgGk1clFD8lWwtah', 'active'),
(3, 'Apple Watch Ultra', '89,000', 'Watch', 'iY8wCTZbUMe2fw2ceHRQ', 'active'),
(4, 'Apple TV 8K', '200,000', 'TV', 'gbkYDBgV4aVAjkO0AxbZ', 'active'),
(5, 'iMac24', '129,900', 'Monitor', 'rCJoZetOT9QVzeF42nA4', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `USER_PASS` varchar(100) NOT NULL,
  `USER_POS` varchar(20) NOT NULL,
  `USER_TOKEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`USER_ID`, `USER_NAME`, `USER_PASS`, `USER_POS`, `USER_TOKEN`) VALUES
(1, 'user', '$2y$10$6E/GNXQ1lX00DcrxfZme5e6rSC1mt6H8et2n.d5RCMNCnpoOcprm2', 'user', '6yuhJSFMZ6rLpl01Dhm0'),
(2, 'admin', '$2y$10$eAMtnL3p2Eh91mGsY42BSuuNpDplpOR/NeJy.owtuR3C62iO/Yl7G', 'admin', 'HK48kXLVP3eQWyRXB34k');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
