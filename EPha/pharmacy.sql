-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2018 at 01:39 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `FullName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `salt` int(11) NOT NULL,
  `permission` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `Username`, `Email`, `Password`, `FullName`, `salt`, `permission`) VALUES
(10, 'admin', 'admin@gmail.com', 'f0f8e902ca7a41c634c5c8247d4b94f2c9b351fb', 'Admin', 123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_sessions`
--

CREATE TABLE `admin_sessions` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Hash` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_sessions`
--

INSERT INTO `admin_sessions` (`ID`, `Username`, `Hash`) VALUES
(1, 'admin', '99aa731a583555bb3205378963c0008181eff38b');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`) VALUES
(111, 'Liquid Medicines', 'This category contain only the liquid medicines'),
(222, 'Injection Medicines', 'This category contain only the injection medicines'),
(333, 'Rivet Medicines', 'This category contain only the rivet medicines');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `PhoneNo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `MedName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` date NOT NULL,
  `ID` int(11) NOT NULL,
  `Approve` tinyint(2) NOT NULL DEFAULT '0',
  `TotalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Name`, `Address`, `PhoneNo`, `MedName`, `Quantity`, `Date`, `ID`, `Approve`, `TotalPrice`) VALUES
('Mohamed Salah', 'University City , Building S , Room 241', '01150435045', 'EUTHYROX', 2, '2018-11-30', 7, 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `BatchNo` int(11) NOT NULL,
  `SalesPrice` int(11) NOT NULL,
  `PurchasePrice` int(11) NOT NULL,
  `CatName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`ID`, `Name`, `BatchNo`, `SalesPrice`, `PurchasePrice`, `CatName`, `Quantity`) VALUES
(1, 'DECADRON', 1, 40, 37, 'Injection Medicines', 100),
(2, 'ELTROXIN TAB', 2, 5, 3, 'Rivet Medicines', 500),
(3, 'ALDACTONE', 3, 50, 47, 'Injection Medicines', 90),
(4, 'DEXAMED', 4, 20, 18, 'Liquid Medicines', 80),
(5, 'EUTHYROX', 5, 30, 26, 'Injection Medicines', 88),
(6, 'MICROVAL', 6, 30, 25, 'Injection Medicines', 300),
(7, 'ALDACTONE', 7, 60, 55, 'Liquid Medicines', 75),
(8, 'NORLEVO', 8, 90, 85, 'Liquid Medicines', 60),
(9, 'GLUCOPHAGE XR', 9, 60, 56, 'Injection Medicines', 90),
(10, 'DUPHASTON', 10, 90, 85, 'Injection Medicines', 100),
(11, 'PROGEST', 11, 25, 20, 'Rivet Medicines', 65),
(12, 'congestal', 12, 5, 3, 'Rivet Medicines', 600),
(13, 'OMCET 10MG F.C. TABS', 13, 60, 55, 'Rivet Medicines', 80),
(14, 'Lorine tablets', 14, 90, 85, 'Liquid Medicines', 100),
(15, 'Aerius Tab', 15, 35, 30, 'Rivet Medicines', 200),
(16, 'LORADAY 10MG TABLET', 16, 20, 18, 'Injection Medicines', 200),
(17, 'LORATIN', 17, 30, 26, 'Liquid Medicines', 200),
(18, 'FEROMIN', 18, 100, 90, 'Liquid Medicines', 50),
(19, 'EPREX 4000IU-0.4ML PROFILLED SYRING', 19, 60, 55, 'Liquid Medicines', 60),
(20, 'DECA-DURABOLIN', 20, 36, 30, 'Injection Medicines', 200),
(21, 'epoetin', 21, 20, 17, 'Rivet Medicines', 50),
(22, 'DESFERAL', 22, 30, 25, 'Injection Medicines', 60),
(23, 'FUMACUR', 23, 60, 56, 'Injection Medicines', 60),
(24, 'LASIX', 24, 60, 55, 'Injection Medicines', 500),
(25, 'INDERAL TABLETS', 25, 60, 55, 'Liquid Medicines', 120),
(26, 'Diovan', 26, 60, 58, 'Injection Medicines', 600),
(27, 'Cialis', 27, 120, 110, 'Liquid Medicines', 100),
(28, 'AMLOR', 28, 50, 45, 'Liquid Medicines', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`Username`);

--
-- Indexes for table `admin_sessions`
--
ALTER TABLE `admin_sessions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `category` (`Name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `batchno` (`BatchNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `admin_sessions`
--
ALTER TABLE `admin_sessions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
