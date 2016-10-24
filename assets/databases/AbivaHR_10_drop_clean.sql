-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 03:45 AM
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
(1, 'EDP'),
(2, 'A'),
(3, 'B'),
(4, 'C'),
(5, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `tblfiles_archive`
--

CREATE TABLE `tblfiles_archive` (
  `archive_id` int(11) NOT NULL,
  `archive_path` text NOT NULL,
  `archive_user_id_fk` int(11) NOT NULL,
  `archive_display_name` varchar(50) NOT NULL,
  `archive_version` varchar(255) NOT NULL,
  `archive_timestamp` varchar(50) NOT NULL,
  `archive_files_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfiles_content`
--

CREATE TABLE `tblfiles_content` (
  `files_id` int(11) NOT NULL,
  `files_name` varchar(30) NOT NULL,
  `files_user_id_fk` int(11) NOT NULL,
  `files_path` text NOT NULL,
  `files_display_name` varchar(50) NOT NULL,
  `files_version` varchar(255) NOT NULL DEFAULT '1.0',
  `files_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `files_ffolder_id_fk` int(11) NOT NULL,
  `files_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfiles_folder`
--

CREATE TABLE `tblfiles_folder` (
  `ffolder_id` int(11) NOT NULL,
  `ffolder_name` varchar(35) NOT NULL,
  `ffolder_dept_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfiles_shared`
--

CREATE TABLE `tblfiles_shared` (
  `shared_id` int(11) NOT NULL,
  `shared_ffolder_id_fk` int(11) NOT NULL,
  `shared_dept_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery_folder`
--

CREATE TABLE `tblgallery_folder` (
  `gfolder_id` int(11) NOT NULL,
  `gfolder_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery_pictures`
--

CREATE TABLE `tblgallery_pictures` (
  `picture_id` int(11) NOT NULL,
  `picture_name` text NOT NULL,
  `picture_path` text NOT NULL,
  `gfolder_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage_content`
--

CREATE TABLE `tblmessage_content` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_receiver` int(11) NOT NULL,
  `message_subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `message_isread` tinyint(4) NOT NULL DEFAULT '0',
  `message_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `thread_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage_threadno`
--

CREATE TABLE `tblmessage_threadno` (
  `thread_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicies`
--

CREATE TABLE `tblpolicies` (
  `policy_id` int(11) NOT NULL,
  `policy_title` varchar(50) NOT NULL,
  `policy_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicies_sub1`
--

CREATE TABLE `tblpolicies_sub1` (
  `sub1_id` int(11) NOT NULL,
  `sub1_title` varchar(50) NOT NULL,
  `sub1_content` text NOT NULL,
  `policy_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicies_sub2`
--

CREATE TABLE `tblpolicies_sub2` (
  `sub2_id` int(11) NOT NULL,
  `sub2_title` varchar(50) NOT NULL,
  `sub2_content` text NOT NULL,
  `sub1_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicies_sub3`
--

CREATE TABLE `tblpolicies_sub3` (
  `sub3_id` int(11) NOT NULL,
  `sub3_title` varchar(50) NOT NULL,
  `sub3_content` text NOT NULL,
  `sub2_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltodolist`
--

CREATE TABLE `tbltodolist` (
  `todo_id` int(11) NOT NULL,
  `todo_title` varchar(100) NOT NULL,
  `todo_isfinished` tinyint(4) NOT NULL DEFAULT '0',
  `todo_employee_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltodolist`
--

INSERT INTO `tbltodolist` (`todo_id`, `todo_title`, `todo_isfinished`, `todo_employee_id_fk`) VALUES
(1, 'ar', 0, 1);

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
  `user_birthday` varchar(11) NOT NULL,
  `user_gender` varchar(7) NOT NULL,
  `user_aboutme` text NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_cpnumber` varchar(12) NOT NULL,
  `user_google` varchar(50) NOT NULL,
  `user_linkedin` varchar(50) NOT NULL,
  `user_wordpress` varchar(50) NOT NULL,
  `user_picture` varchar(75) NOT NULL,
  `user_isadmin` tinyint(4) NOT NULL,
  `user_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `user_firstname`, `user_middlename`, `user_lastname`, `user_username`, `user_password`, `user_department`, `user_birthday`, `user_gender`, `user_aboutme`, `user_address`, `user_email`, `user_cpnumber`, `user_google`, `user_linkedin`, `user_wordpress`, `user_picture`, `user_isadmin`, `user_active`) VALUES
(1, 'Lorenzo', 'C.', 'Magno', 'magmagg', '$2y$10$Kb3A6kS.ZimMvPOpn4D1PupExnZH5KQUgzZd6ryfmKbJUmSO0Cz3q', 1, '', '', '', '', '', '', '', '', '', 'C:\\xampp\\htdocs\\AbivaHR/assets/images/avatars/avatar2.png', 1, 1),
(2, 'Kassandra Martina', '.', 'Cipriano', 'kassie', '$2y$10$X.yhT5w9w4a0a587qjnDweujsvr78xVdTHBNXSulNXFoBifZ7XBiW', 1, '', '', '', '', '', '', '', '', '', 'C:\\xampp\\htdocs\\AbivaHR/assets/images/avatars/avatar2.png', 0, 1);

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
  ADD KEY `ann_id_fk` (`ann_id_fk`),
  ADD KEY `ann_department_fk` (`ann_department_fk`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tblfiles_archive`
--
ALTER TABLE `tblfiles_archive`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `archive_files_id_fk` (`archive_files_id_fk`),
  ADD KEY `archive_user_id_fk` (`archive_user_id_fk`);

--
-- Indexes for table `tblfiles_content`
--
ALTER TABLE `tblfiles_content`
  ADD PRIMARY KEY (`files_id`),
  ADD KEY `files_ffolder_id_fk` (`files_ffolder_id_fk`),
  ADD KEY `files_user_id_fk` (`files_user_id_fk`);

--
-- Indexes for table `tblfiles_folder`
--
ALTER TABLE `tblfiles_folder`
  ADD PRIMARY KEY (`ffolder_id`),
  ADD KEY `ffolder_dept_id_fk` (`ffolder_dept_id_fk`);

--
-- Indexes for table `tblfiles_shared`
--
ALTER TABLE `tblfiles_shared`
  ADD PRIMARY KEY (`shared_id`),
  ADD KEY `shared_ffolder_id` (`shared_ffolder_id_fk`),
  ADD KEY `shared_dept_id_fk` (`shared_dept_id_fk`);

--
-- Indexes for table `tblgallery_folder`
--
ALTER TABLE `tblgallery_folder`
  ADD PRIMARY KEY (`gfolder_id`);

--
-- Indexes for table `tblgallery_pictures`
--
ALTER TABLE `tblgallery_pictures`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `gfolder_id_fk` (`gfolder_id_fk`);

--
-- Indexes for table `tblmessage_content`
--
ALTER TABLE `tblmessage_content`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `thread_id_fk` (`thread_id_fk`);

--
-- Indexes for table `tblmessage_threadno`
--
ALTER TABLE `tblmessage_threadno`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `tblpolicies`
--
ALTER TABLE `tblpolicies`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `tblpolicies_sub1`
--
ALTER TABLE `tblpolicies_sub1`
  ADD PRIMARY KEY (`sub1_id`),
  ADD KEY `policy_id_fk` (`policy_id_fk`);

--
-- Indexes for table `tblpolicies_sub2`
--
ALTER TABLE `tblpolicies_sub2`
  ADD PRIMARY KEY (`sub2_id`),
  ADD KEY `sub1_id_fk` (`sub1_id_fk`);

--
-- Indexes for table `tblpolicies_sub3`
--
ALTER TABLE `tblpolicies_sub3`
  ADD PRIMARY KEY (`sub3_id`),
  ADD KEY `sub2_id_fk` (`sub2_id_fk`);

--
-- Indexes for table `tbltodolist`
--
ALTER TABLE `tbltodolist`
  ADD PRIMARY KEY (`todo_id`),
  ADD KEY `todo_employee_id_fk` (`todo_employee_id_fk`);

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
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblfiles_archive`
--
ALTER TABLE `tblfiles_archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfiles_content`
--
ALTER TABLE `tblfiles_content`
  MODIFY `files_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfiles_folder`
--
ALTER TABLE `tblfiles_folder`
  MODIFY `ffolder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfiles_shared`
--
ALTER TABLE `tblfiles_shared`
  MODIFY `shared_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblgallery_folder`
--
ALTER TABLE `tblgallery_folder`
  MODIFY `gfolder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblgallery_pictures`
--
ALTER TABLE `tblgallery_pictures`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmessage_content`
--
ALTER TABLE `tblmessage_content`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmessage_threadno`
--
ALTER TABLE `tblmessage_threadno`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpolicies`
--
ALTER TABLE `tblpolicies`
  MODIFY `policy_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpolicies_sub1`
--
ALTER TABLE `tblpolicies_sub1`
  MODIFY `sub1_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpolicies_sub2`
--
ALTER TABLE `tblpolicies_sub2`
  MODIFY `sub2_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpolicies_sub3`
--
ALTER TABLE `tblpolicies_sub3`
  MODIFY `sub3_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbltodolist`
--
ALTER TABLE `tbltodolist`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblannouncements_visible`
--
ALTER TABLE `tblannouncements_visible`
  ADD CONSTRAINT `tblannouncements_visible_ibfk_1` FOREIGN KEY (`ann_id_fk`) REFERENCES `tblannouncements` (`ann_id`),
  ADD CONSTRAINT `tblannouncements_visible_ibfk_2` FOREIGN KEY (`ann_department_fk`) REFERENCES `tbldepartments` (`department_id`);

--
-- Constraints for table `tblfiles_archive`
--
ALTER TABLE `tblfiles_archive`
  ADD CONSTRAINT `tblfiles_archive_ibfk_1` FOREIGN KEY (`archive_files_id_fk`) REFERENCES `tblfiles_content` (`files_id`),
  ADD CONSTRAINT `tblfiles_archive_ibfk_2` FOREIGN KEY (`archive_user_id_fk`) REFERENCES `tblusers` (`user_id`);

--
-- Constraints for table `tblfiles_content`
--
ALTER TABLE `tblfiles_content`
  ADD CONSTRAINT `tblfiles_content_ibfk_1` FOREIGN KEY (`files_ffolder_id_fk`) REFERENCES `tblfiles_folder` (`ffolder_id`),
  ADD CONSTRAINT `tblfiles_content_ibfk_2` FOREIGN KEY (`files_user_id_fk`) REFERENCES `tblusers` (`user_id`);

--
-- Constraints for table `tblfiles_folder`
--
ALTER TABLE `tblfiles_folder`
  ADD CONSTRAINT `tblfiles_folder_ibfk_1` FOREIGN KEY (`ffolder_dept_id_fk`) REFERENCES `tbldepartments` (`department_id`);

--
-- Constraints for table `tblfiles_shared`
--
ALTER TABLE `tblfiles_shared`
  ADD CONSTRAINT `tblfiles_shared_ibfk_1` FOREIGN KEY (`shared_ffolder_id_fk`) REFERENCES `tblfiles_folder` (`ffolder_id`),
  ADD CONSTRAINT `tblfiles_shared_ibfk_2` FOREIGN KEY (`shared_dept_id_fk`) REFERENCES `tbldepartments` (`department_id`);

--
-- Constraints for table `tblgallery_pictures`
--
ALTER TABLE `tblgallery_pictures`
  ADD CONSTRAINT `gfolder_id_fk` FOREIGN KEY (`gfolder_id_fk`) REFERENCES `tblgallery_folder` (`gfolder_id`);

--
-- Constraints for table `tblmessage_content`
--
ALTER TABLE `tblmessage_content`
  ADD CONSTRAINT `tblmessage_content_ibfk_1` FOREIGN KEY (`thread_id_fk`) REFERENCES `tblmessage_threadno` (`thread_id`);

--
-- Constraints for table `tblpolicies_sub1`
--
ALTER TABLE `tblpolicies_sub1`
  ADD CONSTRAINT `tblpolicies_sub1_ibfk_1` FOREIGN KEY (`policy_id_fk`) REFERENCES `tblpolicies` (`policy_id`);

--
-- Constraints for table `tblpolicies_sub2`
--
ALTER TABLE `tblpolicies_sub2`
  ADD CONSTRAINT `tblpolicies_sub2_ibfk_1` FOREIGN KEY (`sub1_id_fk`) REFERENCES `tblpolicies_sub1` (`sub1_id`);

--
-- Constraints for table `tblpolicies_sub3`
--
ALTER TABLE `tblpolicies_sub3`
  ADD CONSTRAINT `tblpolicies_sub3_ibfk_1` FOREIGN KEY (`sub2_id_fk`) REFERENCES `tblpolicies_sub2` (`sub2_id`);

--
-- Constraints for table `tbltodolist`
--
ALTER TABLE `tbltodolist`
  ADD CONSTRAINT `todo_employee_id_fk` FOREIGN KEY (`todo_employee_id_fk`) REFERENCES `tblusers` (`user_id`);

--
-- Constraints for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`user_department`) REFERENCES `tbldepartments` (`department_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
