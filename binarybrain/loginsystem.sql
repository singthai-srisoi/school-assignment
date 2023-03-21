-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 03:28 PM
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
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `text` text NOT NULL DEFAULT 'no feedback',
  `u_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `q_id` int(11) NOT NULL,
  `curr_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `text`, `u_id`, `date`, `q_id`, `curr_status`) VALUES
(34, ' feedback1', 17, '2022-01-26 12:54:50', 17, 'rejected'),
(35, 'adding this feedback', 17, '2022-01-26 20:04:06', 17, 'approved'),
(37, 'ok done', 17, '2022-01-27 18:13:52', 17, 'approved'),
(38, 'asdasddasdasd', 17, '2022-01-27 18:15:27', 17, 'rejected'),
(39, 'where is my item?', 17, '2022-01-27 18:19:51', 28, 'rejected'),
(43, 'll', 15, '2022-01-28 14:47:02', 17, 'Reply From Employee'),
(45, 'thank you', 17, '2022-02-04 13:07:29', 17, 'approved'),
(46, 'this add', 17, '2022-02-04 13:09:36', 17, 'approved'),
(47, 'this reject', 17, '2022-02-04 13:09:43', 17, 'rejected'),
(48, '', 17, '2022-02-04 14:33:45', 17, 'approved'),
(49, '', 18, '2022-02-04 14:38:57', 30, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `i_id` int(11) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `i_price` float NOT NULL,
  `i_quantity` int(11) NOT NULL,
  `q_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`i_id`, `i_name`, `i_price`, `i_quantity`, `q_id`) VALUES
(1, 'Pipe', 35.6, 2, 17),
(3, 'concrete', 500.1, 20, 26),
(10, 'jumper', 13.2, 5, 17),
(16, 'button01', 50, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `qid` int(11) NOT NULL,
  `service` text DEFAULT NULL,
  `status` varchar(10) DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `q_addr` text NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`qid`, `service`, `status`, `date`, `q_addr`, `uid`) VALUES
(15, 'Electrical Services', 'Pending', '2022-01-16 19:22:39', 'Kuala Lumpur', 17),
(17, 'Aircon Service', 'approved', '2022-01-16 16:59:10', 'JB', 17),
(26, 'civil', 'Pending', '2022-01-27 07:42:54', 'KB', 17),
(27, 'Civil', 'Pending', '2022-01-27 07:44:01', 'Ipoh', 17),
(28, 'Fire Fighting & Alarm System', 'rejected', '2022-01-27 10:19:31', 'Kuantan', 17),
(30, 'Air Conditioning', 'approved', '2022-02-04 06:38:46', '', 18),
(31, 'Air Conditioning', 'Pending', '2022-02-04 06:40:53', '', 18),
(32, 'Pest Control', 'Pending', '2022-02-04 06:42:35', '10 A, KAMPUNG BARU JERKOH', 18);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `r_id` int(11) NOT NULL,
  `r_date` date NOT NULL,
  `q_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `u_name` varchar(255) DEFAULT NULL,
  `u_email` varchar(255) DEFAULT NULL,
  `u_password` varchar(300) DEFAULT NULL,
  `u_contactno` varchar(11) DEFAULT NULL,
  `u_address` varchar(255) DEFAULT NULL,
  `user_type` int(2) NOT NULL DEFAULT 1,
  `u_posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_name`, `u_email`, `u_password`, `u_contactno`, `u_address`, `user_type`, `u_posting_date`) VALUES
(15, 'Eddie', 'jeddiewong@yahoo.com', 'Prowong02', '1118767163', 'Selangor', 2, '2022-01-05 01:27:44'),
(17, 'Dinie', 'customer01@gmail.com', 'Customer@01', '0000000000', 'JOHOR', 1, '2022-01-10 03:50:28'),
(18, 'Singthai', 'singthaisrisoi010801@gmail.com', '123Abcde', '0179008950', NULL, 1, '2022-01-18 06:50:16'),
(19, 'Eric', 'eric@utm.my', 'Eric@123', '0168657691', NULL, 1, '2022-02-04 11:23:39'),
(20, 'Vincent', 'vincent@utm.my', 'Vincent@123', '0123456789', 'Sarawak', 1, '2022-02-04 11:57:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `q_id` (`q_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`i_id`),
  ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`q_id`) REFERENCES `quotation` (`qid`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `quotation` (`qid`);

--
-- Constraints for table `quotation`
--
ALTER TABLE `quotation`
  ADD CONSTRAINT `quotation_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `quotation` (`qid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
