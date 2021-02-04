-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2019 at 07:56 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `growap`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `active`) VALUES
(1, '/growap/imgs/adverts/eac7e9d135ec039fc93d6e314859c5e3.jpg', 1),
(2, '/growap/imgs/adverts/02713814cea4f0362366d3dfa618c2b6.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL,
  `carttime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `orderid` int(11) NOT NULL,
  `confirm` int(11) NOT NULL,
  `deliver` int(11) NOT NULL,
  `userread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `pid`, `price`, `quantity`, `uid`, `carttime`, `orderid`, `confirm`, `deliver`, `userread`) VALUES
(62, 19, '1900', 2, 6, '2018-07-05 13:07:22', 32340, 1, 1, 1),
(75, 18, '300', 1, 10, '2018-07-05 12:28:02', 46479, 1, 1, 1),
(97, 19, '1900', 1, 17, '2018-07-12 12:05:29', 79306, 0, 0, 0),
(100, 18, '300', 2, 17, '2018-07-12 16:54:36', 74750, 0, 0, 0),
(101, 16, '344', 1, 17, '2019-08-08 16:04:53', 84877, 1, 1, 0),
(102, 19, '1900', 1, 17, '2019-08-08 16:04:53', 84877, 1, 1, 0),
(104, 19, '1900', 3, 18, '2018-07-13 15:29:15', 25559, 1, 1, 1),
(105, 16, '344', 2, 18, '2018-07-13 15:29:15', 25559, 1, 1, 1),
(107, 19, '1900', 1, 18, '2018-07-13 15:22:21', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'Fruits &amp; Vegetables'),
(3, 'Meat &amp; Sea food'),
(4, 'Beverages'),
(5, 'Breakfast &amp; Snacks'),
(6, 'Kitchen'),
(8, 'Personal Care'),
(11, 'Electronics'),
(12, 'Jobs');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `password` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` int(11) NOT NULL,
  `regdate` datetime DEFAULT current_timestamp(),
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderz`
--

CREATE TABLE `orderz` (
  `orderid` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `carttime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `confirm` int(11) NOT NULL,
  `deliver` int(11) NOT NULL,
  `userread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `images` text NOT NULL,
  `recommended` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `product` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `datesent` datetime NOT NULL DEFAULT current_timestamp(),
  `readi` int(11) NOT NULL DEFAULT 0,
  `user` varchar(100) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL,
  `userread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`email`, `phone`, `details`, `product`, `id`, `datesent`, `readi`, `user`, `confirm`, `userid`, `userread`) VALUES
('jamalmachacke@gmail.com', 565656565, 'some big shit', 'Chungwa', 12, '2018-06-21 04:40:01', 1, 'Jamal Machack', 2, 4, 0),
('bukuruhenry@gmail.com', 714558558, 'any type', 'Nanasi', 13, '2018-06-21 13:37:24', 1, 'bukuru henry', 1, 3, 0),
('jamalmachacke@gmail.com', 2147483647, 'bgfghfhgf', 'pulapu', 14, '2018-06-21 13:58:29', 1, 'bukuru henry', 1, 3, 0),
('fatuma@gmail.com', 714558558, 'raffuyykukbuopuiopbgulkgjk', 'fatuma', 15, '2018-07-04 18:56:23', 1, 'Bukuru GoodBoy', 1, 6, 1),
('fatuma@gmail.com', 714558558, 'raffuyykukbuopuiopbgulkgjk', 'fatuma', 16, '2018-07-04 18:57:17', 1, 'Bukuru GoodBoy', 2, 6, 0),
('ernestnzallawahe@yahoo.com', 711142232, 'i need house keeping', 'job', 17, '2019-08-07 10:19:22', 1, 'Ernest Joseph Nzallawahe', 1, 19, 1),
('ernestnzallawahe@yahoo.com', 711142232, 'nataka tena', 'kuku', 18, '2019-08-14 03:37:28', 1, 'Ernest Joseph Nzallawahe', 2, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `permission`, `date`) VALUES
(6, 'Nesty Jose Nzalla', 'ernestjoju@gmail.com', '$2y$10$rRhxVos/VXDsdNORNcTU7.NAiLgHCFSPjW2gZV4S3BYSGr60Iz3vm', 'admin,editor', '2019-08-19 17:00:09'),
(7, 'Prisca kelvin Johnson', 'priscaj83@gmail.com', '$2y$10$0tg1qM1SR/yA2.ndrJTBQOFWlx9Rd1FXZYuiP1yHDdLAD6f4LYdPK', 'admin,editor', '2019-08-19 17:07:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
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
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
