-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2026 at 10:14 AM
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
-- Database: `recycling-donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `ActivityId` int(11) NOT NULL,
  `UserId` varchar(15) NOT NULL,
  `ActivityText` varchar(255) NOT NULL,
  `ActivityDate` datetime DEFAULT current_timestamp(),
  `ActivityType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`ActivityId`, `UserId`, `ActivityText`, `ActivityDate`, `ActivityType`) VALUES
(9, 'ADM-1', 'Approved item ITM-1', '2026-06-22 14:57:31', 'Admin'),
(10, 'PBC-1', 'Your item Nike Shirt has been approved by admin', '2026-06-22 14:57:31', 'User'),
(11, 'PBC-1', 'Approved item ITM-1', '2026-06-22 15:00:26', 'Admin'),
(12, 'PBC-1', 'Your item Nike Shirt has been approved by admin', '2026-06-22 15:00:26', 'User'),
(13, 'PBC-1', 'Approved item ITM-2', '2026-06-22 15:09:24', 'Admin'),
(14, 'PBC-1', 'Your item Stone Islan Shirt has been approved by admin', '2026-06-22 15:09:24', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemId` varchar(15) NOT NULL,
  `ItemName` varchar(70) NOT NULL,
  `Category` varchar(70) NOT NULL,
  `Condition` enum('New','Used','Damaged') NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `ActivityType` enum('Donate','Recycle') NOT NULL,
  `ItemDate` date NOT NULL DEFAULT curdate(),
  `Status` enum('Pending','Approved','Rejected') NOT NULL,
  `UserId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemId`, `ItemName`, `Category`, `Condition`, `Description`, `Image`, `ActivityType`, `ItemDate`, `Status`, `UserId`) VALUES
('ITM-1', 'Nike Shirt', 'Clothing', 'Used', 'Barang Boek mantap pak abu', '../image-UserItem/img_6a38cec269aaf_Screenshot 2026-06-22 135550.png', 'Donate', '2026-06-22', 'Approved', 'PBC-1');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_item`
--

CREATE TABLE `pickup_item` (
  `ItemId` varchar(15) NOT NULL,
  `RequestId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pickup_item`
--

INSERT INTO `pickup_item` (`ItemId`, `RequestId`) VALUES
('ITM-1', 'PKP-1'),
('ITM-1', 'PKP-2'),
('ITM-2', 'PKP-2'),
('ITM-2', 'PKP-3'),
('ITM-3', 'PKP-2');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_request`
--

CREATE TABLE `pickup_request` (
  `RequestId` varchar(15) NOT NULL,
  `PickupDate` date NOT NULL,
  `PickupTime` time NOT NULL,
  `PickupAddress` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `UserId` varchar(15) NOT NULL
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
  `Points` int(10) NOT NULL DEFAULT 0,
  `Role` enum('Admin','Student(UTeM)','Staff(UTeM)','Public') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Name`, `Email`, `Password`, `NoPhone`, `Points`, `Role`) VALUES
('ADM-1', 'admin', 'admin@utem.edu.my', '$2y$10$wgFpsD4WkyNiDGIDaIpt2uIOYdj6VE3fut77VufNsXB5nuX1bNVju', '0122222342', 0, 'Admin'),
('PBC-1', 'haziq', 'haziq.irfann04@gmail.com', '$2y$10$76FBJqFTQu/wQdfa6gd6feFVorgXE.DzeQrA5VFiNsV8U.AbfY0M.', '0123456789', 0, 'Public'),
('PBC-2', 'Hakim', 'hakimmanan4@gmail.com', '$2y$10$.F/ZOT6QVNW24hynDUzny.0hdci4kz7u0N2AC3IEbPOzYplcoHLda', '0108920312', 0, 'Public');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`ActivityId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `pickup_item`
--
ALTER TABLE `pickup_item`
  ADD PRIMARY KEY (`ItemId`,`RequestId`),
  ADD KEY `ItemId` (`ItemId`,`RequestId`);

--
-- Indexes for table `pickup_request`
--
ALTER TABLE `pickup_request`
  ADD PRIMARY KEY (`RequestId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`RewardId`),
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `ActivityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pickup_request`
--
ALTER TABLE `pickup_request`
  ADD CONSTRAINT `pickup_request_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reward`
--
ALTER TABLE `reward`
  ADD CONSTRAINT `reward_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track_item`
--
ALTER TABLE `track_item`
  ADD CONSTRAINT `track_item_ibfk_1` FOREIGN KEY (`ItemId`) REFERENCES `item` (`ItemId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
