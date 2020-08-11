-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2020 at 11:26 AM
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
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `profile_picture` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `user_name`, `username`, `password`, `profile_picture`, `email`) VALUES
(1, 'Ilham Izzul Hadyan', 'ilhamizzul', '$2y$10$LOacn0VbbFC4Ty8gv5Jg9eEnLOKgDPxiYJAefgkxcQTJb98xyFLtu', '', 'ilhamizzul@gmail.com');

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
  `id_company` varchar(15) NOT NULL,
  `id_repeater` varchar(10) NOT NULL,
  `createdAt` datetime NOT NULL,
  `activedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_carousel`
--

INSERT INTO `tb_carousel` (`id_carousel`, `data_carousel`, `title`, `description`, `data_type`, `active`, `id_company`, `id_repeater`, `createdAt`, `activedAt`) VALUES
('CA-I-2007270001', '49388510_p0.jpg', 'Version Control with Git Final Project', '', 'image', 'true', 'COM1000001', 'RE002', '2020-07-27 16:03:26', '2020-07-30 15:47:13'),
('CA-I-2007300001', 'Alone.jpg', 'chemistry', '', 'image', 'false', 'COM1000001', 'RE003', '2020-07-30 16:32:29', '2020-08-05 16:32:28'),
('CA-V-2007280001', 'sample.mp4', 'Our Planet', 'watch the documentary series free on netflix channel', 'video', 'true', 'COM1000001', 'RE002', '2020-07-28 09:48:10', '2020-08-03 08:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_client_coloring`
--

CREATE TABLE `tb_client_coloring` (
  `id_color` varchar(15) NOT NULL,
  `id_company` varchar(15) NOT NULL,
  `title` varchar(25) NOT NULL,
  `bg_color1` varchar(7) NOT NULL,
  `bg_color2` varchar(7) NOT NULL,
  `bg_color3` varchar(7) NOT NULL,
  `nav_color` varchar(7) NOT NULL,
  `txt_color` varchar(7) NOT NULL,
  `txt_news_color` varchar(7) NOT NULL,
  `active_color` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_client_coloring`
--

INSERT INTO `tb_client_coloring` (`id_color`, `id_company`, `title`, `bg_color1`, `bg_color2`, `bg_color3`, `nav_color`, `txt_color`, `txt_news_color`, `active_color`) VALUES
('COL-20080400001', 'COM1000001', 'vnfdks', '#db2929', '#ba0303', '#642b2b', '#ba1212', '#f46767', '#240000', 0),
('COL-20080400002', 'COM1000001', 'ufbes', '#1aff47', '#1916e9', '#e63333', '#db2424', '#15a8b2', '#f5f5f5', 1),
('COL-20081100001', 'COM-20081100001', 'Default', '#023e8a', '#0096c7', '#48cae4', '#03045e', 'white', '#48cae4', 1),
('COL200804000001', 'COM1000001', 'Default', '#023e8a', '#0096c7', '#48cae4', '#03045e', 'white', '#48cae4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_company`
--

CREATE TABLE `tb_company` (
  `id_company` varchar(15) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_logo` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `address` varchar(250) NOT NULL,
  `activeStatus` tinyint(1) NOT NULL,
  `firstLogin` tinyint(1) NOT NULL,
  `onTrial` tinyint(1) NOT NULL,
  `validity` date NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_company`
--

INSERT INTO `tb_company` (`id_company`, `company_name`, `company_logo`, `email`, `address`, `activeStatus`, `firstLogin`, `onTrial`, `validity`, `createdAt`) VALUES
('COM-20081100001', 'tani makmur 2', '', 'kukuhwidiatmoko0@gmail.com', '', 1, 0, 1, '2020-08-15', '2020-08-11 06:38:43'),
('COM1000001', 'Pyxis', 'logo.png', 'johnDoe@gmail.com', 'malang', 1, 0, 0, '2020-09-30', '2020-07-28 13:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_content_grp`
--

CREATE TABLE `tb_content_grp` (
  `id` int(11) NOT NULL,
  `id_company` varchar(15) NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_content_grp`
--

INSERT INTO `tb_content_grp` (`id`, `id_company`, `description`, `active`) VALUES
(1, 'COM1000001', 'footer', 'true'),
(2, 'COM1000001', 'carousel', 'true'),
(3, 'COM1000001', 'schedule', 'true'),
(4, 'COM1000001', 'navigation_bar', 'false'),
(5, 'COM-20081100001', 'footer', 'true'),
(6, 'COM-20081100001', 'carousel', 'true'),
(7, 'COM-20081100001', 'schedule', 'true'),
(8, 'COM-20081100001', 'navigation_bar', 'true');

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
  `id_company` varchar(15) NOT NULL,
  `createdAt` datetime NOT NULL,
  `activedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_info`
--

INSERT INTO `tb_info` (`id_info`, `description`, `location`, `due_date`, `info_type`, `active`, `id_repeater`, `id_company`, `createdAt`, `activedAt`) VALUES
('EV-200724000001', 'meeting about SeREG', 'meeting room', '2020-07-31 08:19:00', 'event', 'false', 'RE001', 'COM1000001', '2020-07-27 09:02:31', '2020-07-30 15:59:55'),
('EV-200727000001', 'urgent meeting', 'meeting room', '2020-07-31 06:30:00', 'event', '', 'RE001', 'COM1000001', '2020-07-27 09:02:09', '2020-07-30 16:05:29'),
('NE-200725000001', 'lorem ipsum dolor sit amet hiyahiyahiya', '', '2020-12-31 11:06:00', 'news', 'false', 'RE003', 'COM1000001', '2020-07-27 09:46:24', '2020-08-04 10:39:34'),
('NE-200804000001', 'udnsindv', '-', '2020-08-27 03:46:00', 'news', 'true', 'RE002', 'COM1000001', '2020-08-04 15:46:57', '2020-08-04 15:47:04'),
('SL-200729000001', 'HOK A HOK E', '-', '2020-12-30 11:59:00', 'slogan', 'true', 'RE002', 'COM1000001', '2020-07-29 09:45:57', '2020-08-04 08:57:20'),
('SL-200804000001', 'cuci tangan gan', '-', '2020-08-31 08:57:00', 'slogan', 'true', 'RE003', 'COM1000001', '2020-08-04 08:58:06', '2020-08-04 08:58:10');

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
  `id_company` varchar(15) NOT NULL,
  `active` enum('false','true') NOT NULL,
  `role` enum('owner','admin') NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `user_name`, `username`, `password`, `profile_picture`, `address`, `email`, `id_company`, `active`, `role`, `createdAt`) VALUES
('US-200723000001', 'Chamadani Faisal Amri', 'chamadani', '$2y$10$ki840B5yrPP9p6ha8jfigeezH0hdpHTgMVoCSNL58oWc60idwwPte', '', '', '', 'COM1000001', 'true', 'admin', '2020-07-23 09:38:07'),
('US-200723000002', 'Ilham Izzul Hadyan', 'ilhamizzul', '$2y$10$wSnL2uw.ycuyh0Ufpx1I6.AoCBVA69EdbD.BfJyArpmuTUcGWM9L6', 'profile.jpg', 'malang', 'ilhamizzul@gmail.com', 'COM1000001', 'true', 'owner', '2020-08-03 09:13:44'),
('US-200728000001', 'admin', 'admin', '$2y$10$WqiuQOegd7phRdYClgVgHORguniPIgSZfNOcgHpzxK8MscHPCaL9O', '', '', '', 'COM1000001', 'true', 'admin', '2020-07-30 08:37:28'),
('US-200728000002', 'owner', 'owner', '$2y$10$JZkw4jq1uyzL8U2z0gj5POL9WoZhEF/ybctt5VFytX8xMV3d8FHMa', '', '', '', 'COM1000001', 'true', 'owner', '2020-07-28 15:53:11'),
('US-200811000001', 'kukuh widiatmoko', 'owner2', '$2y$10$cM3nMZt4UsqXwxo.p1OaieSEjh2MnnFFToSCQY56Q8E13MNQQBXRu', '', '', 'kukuhwidiatmoko0@gmail.com', 'COM-20081100001', 'true', 'owner', '2020-08-11 11:41:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_carousel`
--
ALTER TABLE `tb_carousel`
  ADD PRIMARY KEY (`id_carousel`),
  ADD KEY `id_company` (`id_company`),
  ADD KEY `id_repeater` (`id_repeater`);

--
-- Indexes for table `tb_client_coloring`
--
ALTER TABLE `tb_client_coloring`
  ADD PRIMARY KEY (`id_color`),
  ADD KEY `id_company` (`id_company`);

--
-- Indexes for table `tb_company`
--
ALTER TABLE `tb_company`
  ADD PRIMARY KEY (`id_company`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_content_grp`
--
ALTER TABLE `tb_content_grp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_company` (`id_company`);

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
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_content_grp`
--
ALTER TABLE `tb_content_grp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_carousel`
--
ALTER TABLE `tb_carousel`
  ADD CONSTRAINT `tb_carousel_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `tb_company` (`id_company`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_carousel_ibfk_2` FOREIGN KEY (`id_repeater`) REFERENCES `tb_repeater` (`id_repeater`);

--
-- Constraints for table `tb_client_coloring`
--
ALTER TABLE `tb_client_coloring`
  ADD CONSTRAINT `tb_client_coloring_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `tb_company` (`id_company`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_content_grp`
--
ALTER TABLE `tb_content_grp`
  ADD CONSTRAINT `tb_content_grp_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `tb_company` (`id_company`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `tb_company` (`id_company`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
