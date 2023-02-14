-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2023 at 03:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `foodname` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `foodtype` int(11) DEFAULT NULL,
  `img` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `foodname`, `price`, `foodtype`, `img`) VALUES
(4, 'cokes', '100', 2, 'assets/icon/logo.png'),
(10, 'testfood', '100', 1, 'assets/icon/logo.png'),
(11, 'testwater22', '100', 2, 'assets/icon/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderlist` longtext DEFAULT NULL,
  `totalprice` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `paymentmode` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_number` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderlist`, `totalprice`, `status`, `paymentmode`, `user_id`, `transaction_number`, `address`) VALUES
(14, '[{\"id\":\"2\",\"foodname\":\"burger\",\"price\":\"45\",\"foodtype\":\"1\"},{\"id\":\"2\",\"foodname\":\"fries\",\"price\":\"25\",\"foodtype\":\"1\"},{\"id\":\"2\",\"foodname\":\"pizza\",\"price\":\"15\",\"foodtype\":\"1\"}]', '85', '1', 0, 2, '1418175984', NULL),
(15, '[{\"id\":\"2\",\"foodname\":\"fries\",\"price\":\"100\",\"foodtype\":\"1\"},{\"id\":\"2\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\"},{\"id\":\"2\",\"foodname\":\"pizzab\",\"price\":\"100\",\"foodtype\":\"1\"}]', '300', '0', 0, 2, '2984038762', NULL),
(16, '[{\"id\":\"2\",\"foodname\":\"burger\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"2\",\"foodname\":\"pizzac\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '0', 1, 2, '8307764242', NULL),
(23, '[{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"9\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '1', 1, 4, '9931454046', NULL),
(24, '[{\"id\":\"9\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '0', 1, 4, '8786356093', NULL),
(25, '[{\"id\":\"9\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '0', 1, 4, '1494811290', NULL),
(26, '[{\"id\":\"9\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '0', 1, 4, '3808553430', 'dasdsadsadsa'),
(27, '[{\"id\":\"9\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '1', 1, 4, '1466227418', 'asdsadsadasd'),
(28, '[{\"id\":\"9\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '1', 1, 4, '8583705013', 'adasdsadasdsa'),
(29, '[{\"id\":\"9\",\"foodname\":\"pizza\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"},{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '200', '1', 1, 4, '7659755939', 'asdsadsadsadsa'),
(30, '[{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '100', '0', 1, 4, '5971958348', 'sample address'),
(31, '[{\"id\":\"10\",\"foodname\":\"testfood\",\"price\":\"100\",\"foodtype\":\"1\",\"img\":\"assets\\/icon\\/logo.png\"}]', '100', '0', 1, 2, '8357310776', 'address somewhere');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `name`) VALUES
(1, 'user', '$2y$11$CRl8Sqn1k5jkpMBAD71eluD3WoXR0lrz46sgpTalwgxJENGAa.1Ay', '1', 'Kon'),
(2, 'testuser', '$2y$11$CRl8Sqn1k5jkpMBAD71eluD3WoXR0lrz46sgpTalwgxJENGAa.1Ay', '1', 'Danel'),
(3, 'admin', '$2y$11$D8ONfoJs4U8QoABtZho8..Gs.zZxOAY1.8Xyo5hmQMRfzLSCoQiZW', '2', 'Admin'),
(4, 'testwang', '$2y$11$Kkx8//hUzCbUwkgMUqppxOgZ5KoMwpXfOJMX.Ybgv.2njX5argbcm', '1', 'wang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
