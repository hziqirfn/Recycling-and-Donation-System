-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2026 at 03:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recycling-donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `UserId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `DonationId` varchar(15) NOT NULL,
  `DonationDate` datetime NOT NULL,
  `StatusDonate` enum('Pending','Approved','Rejected','') NOT NULL,
  `ItemId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemId` varchar(15) NOT NULL,
  `ItemName` int(5) NOT NULL,
  `Category` varchar(70) NOT NULL,
  `Condition` enum('New','Good','Poor','') NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image` longtext NOT NULL,
  `UserId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_request`
--

CREATE TABLE `pickup_request` (
  `RequestId` varchar(15) NOT NULL,
  `PickupDate` datetime NOT NULL,
  `PickupAddress` varchar(255) NOT NULL,
  `StatusReq` enum('Pending','Accepted','Completed','Cancelled') NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `UserId` varchar(15) NOT NULL,
  `ItemId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `public_nearby`
--

CREATE TABLE `public_nearby` (
  `UserId` varchar(15) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `RewardPoint` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recycle`
--

CREATE TABLE `recycle` (
  `RecycleId` varchar(15) NOT NULL,
  `RecycleDate` datetime NOT NULL,
  `RecycleCenter` varchar(255) NOT NULL,
  `ItemId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `RewardId` varchar(15) NOT NULL,
  `RewardName` varchar(70) NOT NULL,
  `Point` int(5) NOT NULL,
  `ActivityType` varchar(50) NOT NULL,
  `Date` datetime NOT NULL,
  `UserId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `UserId` varchar(15) NOT NULL,
  `Staff_Position` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `RewardPoint` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `UserId` varchar(15) NOT NULL,
  `NoMatric` varchar(20) DEFAULT NULL,
  `Faculty` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `RewardPoint` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `track_item`
--

CREATE TABLE `track_item` (
  `TrackId` varchar(15) NOT NULL,
  `Status` enum('Pending','Collected','Processing','Completed') NOT NULL,
  `StatusDate` date NOT NULL,
  `Description` varchar(255) NOT NULL,
  `ItemId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` varchar(15) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `NoPhone` varchar(20) NOT NULL,
  `Role` enum('Admin','Student(UTeM)','Staff(UTeM)','Public') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`DonationId`),
  ADD KEY `ItemId` (`ItemId`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `pickup_request`
--
ALTER TABLE `pickup_request`
  ADD PRIMARY KEY (`RequestId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `ItemId` (`ItemId`);

--
-- Indexes for table `public_nearby`
--
ALTER TABLE `public_nearby`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `recycle`
--
ALTER TABLE `recycle`
  ADD PRIMARY KEY (`RecycleId`),
  ADD KEY `ItemId` (`ItemId`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`RewardId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `track_item`
--
ALTER TABLE `track_item`
  ADD PRIMARY KEY (`TrackId`),
  ADD KEY `ItemId` (`ItemId`),
  ADD KEY `ItemId_2` (`ItemId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`ItemId`) REFERENCES `item` (`ItemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pickup_request`
--
ALTER TABLE `pickup_request`
  ADD CONSTRAINT `pickup_request_ibfk_1` FOREIGN KEY (`ItemId`) REFERENCES `item` (`ItemId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickup_request_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `public_nearby`
--
ALTER TABLE `public_nearby`
  ADD CONSTRAINT `public_nearby_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recycle`
--
ALTER TABLE `recycle`
  ADD CONSTRAINT `recycle_ibfk_1` FOREIGN KEY (`ItemId`) REFERENCES `item` (`ItemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reward`
--
ALTER TABLE `reward`
  ADD CONSTRAINT `reward_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track_item`
--
ALTER TABLE `track_item`
  ADD CONSTRAINT `track_item_ibfk_1` FOREIGN KEY (`ItemId`) REFERENCES `item` (`ItemId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
