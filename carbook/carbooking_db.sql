-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 11:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carbooking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `b_date` date NOT NULL,
  `r_date` date NOT NULL,
  `total` float NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `u_id`, `reg_no`, `b_date`, `r_date`, `total`, `status`) VALUES
(27, 1, 'NBT8956', '2022-02-10', '2022-02-10', 500, 5),
(28, 8, 'JGM1456', '2022-02-11', '2022-02-20', 2500, 5),
(29, 1, 'KFC5214', '2022-02-11', '2022-02-11', 150, 5),
(30, 8, 'NBT8956', '2022-02-08', '2022-02-10', 1120, 5),
(31, 1, 'MCD9998', '2022-02-12', '2022-02-12', 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `file_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `reg_no`, `file_name`) VALUES
(7, 'JGM1456', '7JGM1456.jpg'),
(9, 'MCD9998', '9MCD9998.jpg'),
(10, 'MDH2304', '10MDH2304webp'),
(11, 'NBT8956', '11NBT8956.jpg'),
(13, 'NBT8956', '13NBT8956.jpg'),
(15, 'KFC5214', '15KFC5214.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(3) NOT NULL,
  `desc_` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `desc_`) VALUES
(1, 'Received'),
(2, 'Approved'),
(3, 'Rejected'),
(4, 'Taken'),
(5, 'Done'),
(6, 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `ic` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp(),
  `authority` int(2) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `ic`, `name`, `email`, `contact_no`, `reg_date`, `authority`, `password`) VALUES
(1, '010801011447', 'Singthai Srisoi', 'singthaisrisoi010801@gmail.com', '01790089501', '2022-02-09', 1, '8ae249dc3306af3789fc3bad90b07463a0f5ca3d5ce8f0f5e0'),
(5, '12345678', 'Aloysius', 'aloysius@gmail.com', '0143639822', '2022-02-10', 2, '410943463d1786da4b258d5113a29d3dd7119ea86002729c27'),
(8, '4566778', 'Dinie', 'dinie@email.com', '1231231344', '2022-02-11', 1, '77ab447cf3cecbd7b67a5f8be53bd203dd0a32b197ee73b4d5'),
(9, '987654321', 'Customer', '010801011447', '5566447', '2022-02-12', 1, 'ef8c8033e4425edff93f8b0f241a746e37d7022b5411b64c23');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `reg_no` varchar(15) NOT NULL,
  `type` varchar(20) NOT NULL,
  `model` varchar(100) NOT NULL,
  `seat` int(5) NOT NULL,
  `price` float NOT NULL,
  `reg_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`reg_no`, `type`, `model`, `seat`, `price`, `reg_date`) VALUES
('JGM1456', 'SUV', 'Proton X70', 5, 250, '2022-02-10'),
('KFC5214', 'Sedan', 'Honda City', 5, 150, '2022-02-10'),
('MCD9998', 'SUV', 'Perodua Ativa', 5, 200, '2022-02-10'),
('MDH2304', 'Subcompact', 'Perodua Myvi', 4, 50, '2022-02-10'),
('NBT8956', 'MPV', 'Toyota Vellfire', 7, 500, '2022-02-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`,`reg_no`),
  ADD KEY `reg_no` (`reg_no`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ic` (`ic`),
  ADD UNIQUE KEY `ic_2` (`ic`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `vehicle` (`reg_no`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
