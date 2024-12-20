-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 03:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankingsite`
--
CREATE DATABASE IF NOT EXISTS `bankingsite` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bankingsite`;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

DROP TABLE IF EXISTS `bank_account`;
CREATE TABLE `bank_account` (
  `accountId` int(11) NOT NULL,
  `accountNickname` varchar(50) DEFAULT NULL,
  `accountType` enum('Checking','Savings') NOT NULL,
  `accountStatus` enum('Good Standing','Overdrawn') NOT NULL,
  `userId` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `bank_account`:
--   `userId`
--       `user_account` -> `userId`
--

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`accountId`, `accountNickname`, `accountType`, `accountStatus`, `userId`, `total`) VALUES(1, NULL, 'Checking', 'Good Standing', 1, 0);
INSERT INTO `bank_account` (`accountId`, `accountNickname`, `accountType`, `accountStatus`, `userId`, `total`) VALUES(2, 'My First Savings Account', 'Savings', 'Good Standing', 2, 0);
INSERT INTO `bank_account` (`accountId`, `accountNickname`, `accountType`, `accountStatus`, `userId`, `total`) VALUES(3, 'House Account', 'Checking', 'Overdrawn', 3, 0);
INSERT INTO `bank_account` (`accountId`, `accountNickname`, `accountType`, `accountStatus`, `userId`, `total`) VALUES(4, NULL, 'Checking', 'Good Standing', 2, 0);
INSERT INTO `bank_account` (`accountId`, `accountNickname`, `accountType`, `accountStatus`, `userId`, `total`) VALUES(5, NULL, 'Savings', 'Good Standing', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `transactionId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `type` enum('Withdrawal','Deposit','Transfer') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `transaction`:
--   `accountId`
--       `bank_account` -> `accountId`
--   `accountId`
--       `bank_account` -> `accountId`
--

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(1, 3, 'Withdrawal', -3000.00, '2024-11-19 15:33:09');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(2, 2, 'Deposit', 100.00, '2024-11-19 15:33:09');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(3, 3, 'Withdrawal', -1000.00, '2024-11-19 15:33:09');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(4, 4, 'Withdrawal', -3000.00, '2024-11-19 15:33:09');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(5, 2, 'Deposit', 200.00, '2024-11-19 15:33:09');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(6, 1, 'Withdrawal', -200.00, '2024-12-12 00:53:05');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(7, 1, 'Deposit', 300.00, '2024-12-12 00:53:05');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(8, 1, 'Withdrawal', -200.00, '2024-12-12 00:53:15');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(9, 1, 'Deposit', 300.00, '2024-12-12 00:53:15');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(10, 4, 'Deposit', 200.00, '2024-12-12 00:54:15');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(11, 4, 'Deposit', 300.00, '2024-12-12 00:54:15');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(12, 5, 'Deposit', 800.00, '2024-12-12 00:54:39');
INSERT INTO `transaction` (`transactionId`, `accountId`, `type`, `amount`, `time`) VALUES(13, 5, 'Withdrawal', 300.00, '2024-12-12 00:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `user_account`:
--

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`userId`, `firstName`, `lastName`, `emailAddress`, `password`, `role`) VALUES(1, 'Cameron', 'Crosby', 'ccAccount@account.com', '$2y$10$NPqWOmLsBDjlHFfRcYXyMePYxYq.WUszgqTVbAzvGLJukqHOowjY6', 'User');
INSERT INTO `user_account` (`userId`, `firstName`, `lastName`, `emailAddress`, `password`, `role`) VALUES(2, 'Test', 'User', 'testUser@test.com', '$2y$10$NPqWOmLsBDjlHFfRcYXyMePYxYq.WUszgqTVbAzvGLJukqHOowjY6', 'User');
INSERT INTO `user_account` (`userId`, `firstName`, `lastName`, `emailAddress`, `password`, `role`) VALUES(3, 'Test2', 'MyName', 'testUser@testing.com', '$2y$10$NPqWOmLsBDjlHFfRcYXyMePYxYq.WUszgqTVbAzvGLJukqHOowjY6', 'User');
INSERT INTO `user_account` (`userId`, `firstName`, `lastName`, `emailAddress`, `password`, `role`) VALUES(4, 'Tester', 'Tester', 'tester@test.com', '$2y$10$NPqWOmLsBDjlHFfRcYXyMePYxYq.WUszgqTVbAzvGLJukqHOowjY6!', 'User');
INSERT INTO `user_account` (`userId`, `firstName`, `lastName`, `emailAddress`, `password`, `role`) VALUES(5, 'Admin', 'Admin', 'admin@frameworkFinancial.com', '$2y$10$NPqWOmLsBDjlHFfRcYXyMePYxYq.WUszgqTVbAzvGLJukqHOowjY6', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`accountId`),
  ADD KEY `bank_account_ibfk_1` (`userId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`),
  ADD KEY `accountId` (`accountId`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `bank_account_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user_account` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `accountId` FOREIGN KEY (`accountId`) REFERENCES `bank_account` (`accountId`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `bank_account` (`accountId`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
