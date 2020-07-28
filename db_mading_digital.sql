-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 10:53 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mading_digital`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_carousel`
--

CREATE TABLE `tb_carousel` (
  `id_carousel` varchar(15) NOT NULL,
  `data_carousel` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `data_type` enum('image','video') NOT NULL,
  `active` enum('false','true') NOT NULL,
  `id_company` varchar(10) NOT NULL,
  `id_repeater` varchar(10) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `activedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_company`
--

CREATE TABLE `tb_company` (
  `id_company` varchar(10) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_logo` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `address` varchar(250) NOT NULL,
  `activeStatus` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_company`
--

INSERT INTO `tb_company` (`id_company`, `company_name`, `company_logo`, `email`, `address`, `activeStatus`, `createdAt`) VALUES
('COM1000001', 'Pyxis', 'logo.png', 'johnDoe@gmail.com', 'malang', 1, '2020-07-28 13:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_content_grp`
--

CREATE TABLE `tb_content_grp` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_info`
--

CREATE TABLE `tb_info` (
  `id_info` varchar(15) NOT NULL,
  `description` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `due_date` datetime NOT NULL,
  `info_type` enum('event','slogan','news') NOT NULL,
  `active` enum('false','true') NOT NULL,
  `id_repeater` varchar(10) NOT NULL,
  `id_company` varchar(10) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `activedAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_repeater`
--

CREATE TABLE `tb_repeater` (
  `id_repeater` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `delete_status` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_repeater`
--

INSERT INTO `tb_repeater` (`id_repeater`, `description`, `delete_status`) VALUES
('RE001', 'one time', 'false'),
('RE002', 'every day', 'false'),
('RE003', 'every week', 'false'),
('RE004', 'every month', 'false'),
('RE005', 'every year', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(15) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `profile_picture` varchar(25) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(35) NOT NULL,
  `id_company` varchar(10) NOT NULL,
  `active` enum('false','true') NOT NULL,
  `role` enum('owner','admin') NOT NULL,
  `onLogin` tinyint(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `user_name`, `username`, `password`, `profile_picture`, `address`, `email`, `id_company`, `active`, `role`, `onLogin`, `createdAt`) VALUES
('US-200723000001', 'Chamadani Faisal Amri', 'chamadani', '$2y$10$ki840B5yrPP9p6ha8jfigeezH0hdpHTgMVoCSNL58oWc60idwwPte', '', '', '', 'COM1000001', 'true', 'admin', 0, '2020-07-23 02:38:07'),
('US-200723000002', 'Ilham Izzul Hadyan', 'ilhamizzul', '$2y$10$wSnL2uw.ycuyh0Ufpx1I6.AoCBVA69EdbD.BfJyArpmuTUcGWM9L6', 'profile.jpg', 'malang', 'ilhamizzul@gmail.com', 'COM1000001', 'true', 'owner', 1, '2020-07-28 08:49:14'),
('US-200728000001', 'admin', 'admin', '$2y$10$WqiuQOegd7phRdYClgVgHORguniPIgSZfNOcgHpzxK8MscHPCaL9O', '', '', '', 'COM1000001', 'true', 'admin', 0, '2020-07-28 08:52:43'),
('US-200728000002', 'owner', 'owner', '$2y$10$JZkw4jq1uyzL8U2z0gj5POL9WoZhEF/ybctt5VFytX8xMV3d8FHMa', '', '', '', 'COM1000001', 'true', 'owner', 0, '2020-07-28 08:53:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_carousel`
--
ALTER TABLE `tb_carousel`
  ADD PRIMARY KEY (`id_carousel`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `id_repeater` (`id_repeater`);

--
-- Indexes for table `tb_company`
--
ALTER TABLE `tb_company`
  ADD PRIMARY KEY (`id_company`);

--
-- Indexes for table `tb_content_grp`
--
ALTER TABLE `tb_content_grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_info`
--
ALTER TABLE `tb_info`
  ADD PRIMARY KEY (`id_info`),
  ADD KEY `id_repeater` (`id_repeater`),
  ADD KEY `id_company` (`id_company`);

--
-- Indexes for table `tb_repeater`
--
ALTER TABLE `tb_repeater`
  ADD PRIMARY KEY (`id_repeater`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_perusahaan` (`id_company`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_content_grp`
--
ALTER TABLE `tb_content_grp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_carousel`
--
ALTER TABLE `tb_carousel`
  ADD CONSTRAINT `tb_carousel_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `tb_company` (`id_company`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_carousel_ibfk_2` FOREIGN KEY (`id_repeater`) REFERENCES `tb_repeater` (`id_repeater`);

--
-- Constraints for table `tb_info`
--
ALTER TABLE `tb_info`
  ADD CONSTRAINT `tb_info_ibfk_1` FOREIGN KEY (`id_repeater`) REFERENCES `tb_repeater` (`id_repeater`),
  ADD CONSTRAINT `tb_info_ibfk_2` FOREIGN KEY (`id_company`) REFERENCES `tb_company` (`id_company`) ON DELETE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `tb_company` (`id_company`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
