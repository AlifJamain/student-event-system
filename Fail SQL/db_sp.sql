-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 03:12 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-05-13 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `BookingId` int(11) NOT NULL,
  `PackageId` int(11) DEFAULT NULL,
  `uid` int(255) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `CancelledBy` varchar(5) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`BookingId`, `PackageId`, `uid`, `RegDate`, `status`, `CancelledBy`, `UpdationDate`) VALUES
(1, 1, 1, '2020-02-02 04:53:29', 1, NULL, '2020-06-12 14:51:29'),
(2, 1, 2, '2020-06-12 06:03:53', 1, NULL, '2020-06-12 14:52:59'),
(3, 1, 6, '2020-06-12 12:45:33', 0, NULL, NULL),
(4, 2, 5, '2020-06-12 12:48:48', 0, NULL, '2020-06-12 13:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `FacultyId` int(255) NOT NULL,
  `FacultyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`FacultyId`, `FacultyName`) VALUES
(1, 'FSKTM'),
(2, 'FKAAS'),
(3, 'FKEE'),
(4, 'FKMP'),
(5, 'FTK'),
(6, 'FPTV'),
(7, 'FPTP'),
(8, 'PPD');

-- --------------------------------------------------------

--
-- Table structure for table `tblpackages`
--

CREATE TABLE `tblpackages` (
  `PackageId` int(11) NOT NULL,
  `PackageName` varchar(200) DEFAULT NULL,
  `PackageLocation` varchar(100) DEFAULT NULL,
  `PackageDate` varchar(100) DEFAULT NULL,
  `PackageTime` varchar(100) DEFAULT NULL,
  `PackageFetures` varchar(255) DEFAULT NULL,
  `PackageDetails` mediumtext,
  `PackageImage` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpackages`
--

INSERT INTO `tblpackages` (`PackageId`, `PackageName`, `PackageLocation`, `PackageDate`, `PackageTime`, `PackageFetures`, `PackageDetails`, `PackageImage`, `Creationdate`, `UpdationDate`) VALUES
(1, 'Kursus Perkhawinan', 'Pusat Islam', '02/28/2020', '10:00 AM', 'Makanan Disediakan', '- Mengenal Isi Hati', 'banner kursus pra perkahwinan 2.jpg', '2020-02-02 04:11:40', '2020-06-12 14:26:49'),
(2, 'Kursus Pra Perkahwinan', 'Hotel Pelican, Batu Pahat, Johor', '06/12/2020', '08:00 AM', 'Makan Disediakan', '- Sijil', 'banner kursus pra perkahwinan 2.jpg', '2020-06-12 06:25:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT '',
  `detail` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `type`, `detail`) VALUES
(1, 'Manual Pengguna', '																				<p align=\"justify\"><font size=\"2\">Manual Pengguna</font></p>\r\n										\r\n										'),
(3, 'Tentang Kami', '																														<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Tentang Kami</span>'),
(11, 'Hubungi Kami', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `UserId` int(255) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `EmailId` varchar(70) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `FacultyId` int(255) NOT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`UserId`, `FullName`, `MobileNumber`, `EmailId`, `Password`, `Status`, `FacultyId`, `RegDate`, `UpdationDate`) VALUES
(1, 'AlifJamain', '0137573935', 'aliffariq96@gmail.com', 'a6892d961abf8c68618f225726c5dfb6', 1, 1, '2020-02-02 05:23:00', '2020-06-12 12:34:49'),
(2, 'AlifJamain', '0137573935', 'alifjamain1234@gmail.com', 'a6892d961abf8c68618f225726c5dfb6', 1, 2, '2020-02-02 05:24:18', '2020-06-17 13:05:18'),
(3, 'AAA', '0129014989', 'AAA@AAA.COM', 'e1faffb3e614e6c2fba74296962386b7', 1, 3, '2020-06-11 15:07:48', '2020-06-17 13:05:21'),
(4, 'bbb', '0129014989', 'bbb@bbb.com', '08f8e0260c64418510cefb2b06eee5cd', 1, 4, '2020-06-12 12:13:06', '2020-06-17 13:05:25'),
(5, 'ccc', '0129014989', 'ccc@ccc.com', '9df62e693988eb4e1e1444ece0578579', 1, 2, '2020-06-12 12:13:31', '2020-06-12 12:35:00'),
(6, 'ddd', '0129014989', 'ddd@ddd.com', '77963b7a931377ad4ab5ad6a9cd718aa', 1, 3, '2020-06-12 12:37:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`BookingId`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`FacultyId`);

--
-- Indexes for table `tblpackages`
--
ALTER TABLE `tblpackages`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `EmailId` (`EmailId`),
  ADD KEY `EmailId_2` (`EmailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `FacultyId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblpackages`
--
ALTER TABLE `tblpackages`
  MODIFY `PackageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `UserId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
