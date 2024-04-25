-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 01:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
DROP DATABASE fmr_system ;
CREATE DATABASE IF NOT EXISTS fmr_system ;
USE fmr_system ;


--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--
DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('', '', '', '', '', '$2y$10$nOy451NmlsQiqhxp8dkTAeApJXKSziRdOeRNXu8CdWFGdwvszXRAW'),
('Kim', 'Kimberly Gwadiva', '0756432971', 'kim@gmail.com', 'Kisumu', '$2y$10$hsqtqXnmK42Keh0G1sNMAeX4/Ybvq70HkNTdZhkAWv9DKW09NNE.C'),
('Rome', 'Rome Ayub', '0746512973', 'rome@gmail.com', 'Eldoret', '$2y$10$TWfjd8uc.VS0V0RvIPRiiu9tXT.Hn895t.QAQg10vdut/AMQyyE6y');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `name` varchar(20) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `e_mail`, `message`) VALUES
('Nikhil', 'nikhil@gmail.com', 'Hope this works.');

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--
DROP TABLE IF EXISTS `machines`;
CREATE TABLE IF NOT EXISTS `machines` (
  `MACHINE_ID` int(20) NOT NULL,
  `MACHINE_NAME` varchar(50) NOT NULL,
  `MACHINE_REGISTRATION_NO` varchar(50) NOT NULL,
  `MACHINE_IMG` varchar(50) DEFAULT 'NA',
  `FUELED_PRICE_PER_HR` float NOT NULL,
  `NON_FUELED_PRICE_PER_HR` float NOT NULL,
  `FUELED_PRICE_PER_DAY` float NOT NULL,
  `NON_FUELED_PRICE_PER_DAY` float NOT NULL,
  `MACHINE_AVAILABILITY` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`MACHINE_ID`, `MACHINE_NAME`, `MACHINE_REGISTRATION_NO`, `MACHINE_IMG`, `FUELED_PRICE_PER_HR`, `NON_FUELED_PRICE_PER_HR`, `FUELED_PRICE_PER_DAY`, `NON_FUELED_PRICE_PER_DAY`, `MACHINE_AVAILABILITY`) VALUES
(27, 'Ford', 'KTCA 367M', 'assets/img/MACHINES/tractor6.jpg', 2000, 1600, 6000, 5500, 'yes'),
(28, 'John Deere', 'KTCB 756G', 'assets/img/MACHINES/tractor5.jpg', 2000, 1400, 5800, 5200, 'yes'),
(29, 'Mahindra-354', 'KTWG 170H', 'assets/img/MACHINES/tractor3.jpg', 2500, 2000, 6000, 5600, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `machine_owners`
--
DROP TABLE IF EXISTS `machine_owners`;
CREATE TABLE IF NOT EXISTS `machine_owners` (
  `MACHINE_ID` int(20) NOT NULL,
  `OWNER_USERNAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `machine_owners`
--

INSERT INTO `machine_owners` (`MACHINE_ID`, `OWNER_USERNAME`) VALUES
(29, 'Crystal'),
(27, 'Frank'),
(28, 'Izo');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--
DROP TABLE IF EXISTS `operators`;
CREATE TABLE IF NOT EXISTS `operators` (
  `OPERATOR_ID` int(20) NOT NULL,
  `OPERATOR_NAME` varchar(50) NOT NULL,
  `DL_NUMBER` varchar(50) NOT NULL,
  `OPERATOR_PHONE` varchar(15) NOT NULL,
  `OPERATOR_ADDRESS` varchar(50) NOT NULL,
  `OPERATOR_GENDER` varchar(10) NOT NULL,
  `OWNER_USERNAME` varchar(50) NOT NULL,
  `OPERATOR_AVAILABILITY` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`OPERATOR_ID`, `OPERATOR_NAME`, `DL_NUMBER`, `OPERATOR_PHONE`, `OPERATOR_ADDRESS`, `OPERATOR_GENDER`, `OWNER_USERNAME`, `OPERATOR_AVAILABILITY`) VALUES
(12, 'Kelsey Obiro', 'A1452895', '0745823796', 'Nyeri', 'Male', 'Frank', 'yes'),
(13, 'Vincent Onyango', 'B168924', '0115249607', 'Kitale', 'Male', 'Izo', 'yes'),
(14, 'Roy Muthee', 'R589371', '0792962358', 'Kitale', 'Male', 'Izo', 'yes'),
(15, 'Jesse Matara', 'G2802467', '0743195782', 'Nyeri', 'Male', 'Frank', 'yes'),
(16, 'Edward Mosire', 'D239715', '0123579645', 'Kisii', 'Male', 'Crystal', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--
DROP TABLE IF EXISTS `owners` ;
CREATE TABLE IF NOT EXISTS `owners` (
  `OWNER_USERNAME` varchar(50) NOT NULL,
  `OWNER_NAME` varchar(50) NOT NULL,
  `OWNER_PHONE` varchar(15) NOT NULL,
  `OWNER_EMAIL` varchar(25) NOT NULL,
  `OWNER_ADDRESS` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `OWNER_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`OWNER_USERNAME`, `OWNER_NAME`, `OWNER_PHONE`, `OWNER_EMAIL`, `OWNER_ADDRESS`, `OWNER_PASSWORD`) VALUES
('', '', '', '', '', '$2y$10$XOl9E.fIQX3YXoDdQgQ5aOSUpiLFmXde3SnmB4.c8zXnpUrdF/BnS'),
('Crystal', 'Crystal Kimani', '0728614397', 'crystal@gmail.com', 'Kiambu', '$2y$10$rPyvQxNfBC8isgXn4IKRgOSNpX8auU0fVooMwbZ2tR1Rdy5Sv3YvK'),
('Frank', 'Frank Mburu', '0718592298', 'frank@gmail.com', 'Nyeri', '$2y$10$Oi3hOFU/NCuSM5/ySjX0WOpPeD.jp0AtKSAa34TvjQ722DHIUWPAy'),
('Izo', 'Isaac Chiari', '0714522677', 'izo@gmail.com', 'Kitale', '$2y$10$XUmlm7OYx5TcYBvpEXf.vuAZhhldAycUJSh.H1yOVPn2q983OUfYm');

-- --------------------------------------------------------

--
-- Table structure for table `rented_machines`
--
DROP TABLE IF EXISTS `rented_machines` ;
CREATE TABLE IF NOT EXISTS `rented_machines` (
  `ID` int(100) NOT NULL,
  `CUSTOMER_USERNAME` varchar(50) NOT NULL,
  `MACHINE_ID` int(20) NOT NULL,
  `OPERATOR_ID` int(20) NOT NULL,
  `BOOKING_DATE` date NOT NULL,
  `RENT_START_DATE` date NOT NULL,
  `RENT_END_DATE` date NOT NULL,
  `MACHINE_RETURN_DATE` date DEFAULT NULL,
  `CHARGE` double NOT NULL,
  `CHARGE_TYPE` varchar(25) NOT NULL DEFAULT 'days',
  `HOURS` double DEFAULT NULL,
  `NO_OF_DAYS` int(50) DEFAULT NULL,
  `TOTAL_AMOUNT` double DEFAULT NULL,
  `RETURN_STATUS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rented_machines`
--

INSERT INTO `rented_machines` (`ID`, `CUSTOMER_USERNAME`, `MACHINE_ID`, `OPERATOR_ID`, `BOOKING_DATE`, `RENT_START_DATE`, `RENT_END_DATE`, `MACHINE_RETURN_DATE`, `CHARGE`, `CHARGE_TYPE`, `HOURS`, `NO_OF_DAYS`, `TOTAL_AMOUNT`, `RETURN_STATUS`) VALUES
(574681290, 'Rome', 27, 12, '2024-04-18', '2024-04-19', '2024-04-21', '0000-00-00', 2000, 'hr', 6, 2, 12000, 'R'),
(574681292, 'Rome', 28, 13, '2024-04-18', '2024-04-22', '2024-04-24', '0000-00-00', 5200, 'days', NULL, 2, 10400, 'R'),
(574681294, 'Kim', 27, 12, '2024-04-18', '2024-04-19', '2024-04-22', '0000-00-00', 6000, 'days', NULL, 3, 18000, 'R'),
(574681296, 'Kim', 29, 16, '2024-04-18', '2024-04-19', '2024-04-22', '0000-00-00', 2500, 'hr', 7, 3, 17500, 'R'),
(574681298, 'Kim', 28, 13, '2024-04-18', '2024-04-19', '2024-04-19', '0000-00-00', 2000, 'hr', 5, 0, 10000, 'R');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`MACHINE_ID`),
  ADD UNIQUE KEY `car_nameplate` (`MACHINE_REGISTRATION_NO`);

--
-- Indexes for table `machine_owners`
--
ALTER TABLE `machine_owners`
  ADD PRIMARY KEY (`MACHINE_ID`),
  ADD KEY `client_username` (`OWNER_USERNAME`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`OPERATOR_ID`),
  ADD UNIQUE KEY `dl_number` (`DL_NUMBER`),
  ADD KEY `client_username` (`OWNER_USERNAME`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`OWNER_USERNAME`);

--
-- Indexes for table `rented_machines`
--
ALTER TABLE `rented_machines`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `customer_username` (`CUSTOMER_USERNAME`),
  ADD KEY `car_id` (`MACHINE_ID`),
  ADD KEY `driver_id` (`OPERATOR_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `MACHINE_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `OPERATOR_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rented_machines`
--
ALTER TABLE `rented_machines`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681300;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `machine_owners`
--
ALTER TABLE `machine_owners`
  ADD CONSTRAINT `machine_owners_ibfk_1` FOREIGN KEY (`OWNER_USERNAME`) REFERENCES `owners` (`OWNER_USERNAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `machine_owners_ibfk_2` FOREIGN KEY (`MACHINE_ID`) REFERENCES `machines` (`MACHINE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `operators_ibfk_1` FOREIGN KEY (`OWNER_USERNAME`) REFERENCES `owners` (`OWNER_USERNAME`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rented_machines`
--
ALTER TABLE `rented_machines`
  ADD CONSTRAINT `rented_machines_ibfk_1` FOREIGN KEY (`CUSTOMER_USERNAME`) REFERENCES `customers` (`customer_username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rented_machines_ibfk_2` FOREIGN KEY (`MACHINE_ID`) REFERENCES `machines` (`MACHINE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rented_machines_ibfk_3` FOREIGN KEY (`OPERATOR_ID`) REFERENCES `operators` (`OPERATOR_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
