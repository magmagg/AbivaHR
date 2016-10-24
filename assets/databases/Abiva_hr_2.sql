-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2016 at 07:42 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abivahr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncements`
--

CREATE TABLE `tblannouncements` (
  `ann_id` int(11) NOT NULL,
  `ann_title` varchar(20) NOT NULL,
  `ann_content` text NOT NULL,
  `ann_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblannouncements_visible`
--

CREATE TABLE `tblannouncements_visible` (
  `ann_visible_id` int(11) NOT NULL,
  `ann_id_fk` int(11) NOT NULL,
  `ann_department_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`department_id`, `department_name`) VALUES
(1, 'EDP');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_middlename` varchar(20) NOT NULL,
  `user_lastname` varchar(20) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_department` int(11) NOT NULL,
  `user_isadmin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `user_firstname`, `user_middlename`, `user_lastname`, `user_username`, `user_password`, `user_department`, `user_isadmin`) VALUES
(1, 'lorenzo', 'copon', 'magno', 'magmagg', '$2y$10$RXShv9fJOZnpNZKb7GMV0eySiayNaAGDpF3ndzdnH2dcDHGelcJLy', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblannouncements`
--
ALTER TABLE `tblannouncements`
  ADD PRIMARY KEY (`ann_id`);

--
-- Indexes for table `tblannouncements_visible`
--
ALTER TABLE `tblannouncements_visible`
  ADD PRIMARY KEY (`ann_visible_id`),
  ADD KEY `fk_ann_id` (`ann_id_fk`),
  ADD KEY `fk_dept_id` (`ann_department_fk`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_department` (`user_department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblannouncements`
--
ALTER TABLE `tblannouncements`
  MODIFY `ann_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblannouncements_visible`
--
ALTER TABLE `tblannouncements_visible`
  MODIFY `ann_visible_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblannouncements_visible`
--
ALTER TABLE `tblannouncements_visible`
  ADD CONSTRAINT `fk_ann_id` FOREIGN KEY (`ann_id_fk`) REFERENCES `tblannouncements` (`ann_id`),
  ADD CONSTRAINT `fk_dept_id` FOREIGN KEY (`ann_department_fk`) REFERENCES `tbldepartments` (`department_id`);

--
-- Constraints for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`user_department`) REFERENCES `tbldepartments` (`department_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
