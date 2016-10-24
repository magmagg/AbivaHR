-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2016 at 10:25 AM
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
  `archive_display_name` varchar(50) NOT NULL,
  `archive_version` varchar(255) NOT NULL,
  `archive_files_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfiles_content`
--

CREATE TABLE `tblfiles_content` (
  `files_id` int(11) NOT NULL,
  `files_name` varchar(30) NOT NULL,
  `files_path` text NOT NULL,
  `files_display_name` varchar(50) NOT NULL,
  `files_version` varchar(255) NOT NULL DEFAULT '1.0',
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
  `picture_name` varchar(30) NOT NULL,
  `picture_path` varchar(75) NOT NULL,
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
(1, 'lorenzo', 'copon', 'magno', 'magmagg', '$2y$10$j/BOWPomvmYgAoIWLCKoeOhFoXufVda/V4y1rPaU1TtyxY416Xrqu', 4, '16-03-2016', 'female', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam congue consequat eros ac luctus. Aenean id mattis nulla. Integer convallis, velit eget malesuada pulvinar, dui nulla aliquam risus, ut tempor quam mi ac nibh. Etiam vel odio lobortis, fermentum odio a, interdum ante. Vivamus maximus dolor at ligula porttitor, eu tempor arcu venenatis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec consequat nunc non auctor facilisis. Proin ullamcorper tincidunt sapien, a aliquet libero tempor a. Ut finibus condimentum tortor, vitae aliquam leo interdum quis.\r\n\r\nVivamus tristique rhoncus massa, quis aliquam mi tempor quis. Nullam blandit, dui a sagittis ultrices, est libero varius urna, vel lacinia turpis lorem id nibh. In nec turpis elit. Fusce et elit sed urna pretium volutpat vitae eget neque. Suspendisse auctor, sapien non interdum varius, massa tortor cursus purus, eget mattis magna enim non ipsum. In pretium gravida sapien, at bibendum justo rutrum eget. Suspendisse potenti.\r\n\r\nMauris auctor id odio ac sagittis. Suspendisse non est ut nunc tempor placerat vitae vel urna. Fusce cursus lacinia sem, eu scelerisque lorem rutrum sed. Curabitur mollis fringilla feugiat. Nullam sodales magna et porta tincidunt. Fusce nec ex vel nulla rutrum imperdiet. Nam fermentum ac justo vitae lobortis. Fusce quam ipsum, volutpat in elit vel, venenatis semper quam. Ut quis risus eu sem ullamcorper elementum. Morbi ac auctor tellus. Proin pellentesque est erat, id iaculis dolor aliquet eget. Quisque nec sagittis felis. Quisque in sem dapibus, dapibus dui at, faucibus lorem. Integer pretium ac nisi eget interdum. In eget mollis justo. Suspendisse potenti.', '161 baco', 'lorenzomagno1@gmail.com', '00000000000', '991', '991', '991', 'C:/xampp/htdocs/AbivaHR/assets/files/profile_pictures/profile-pic.jpg', 1, 1),
(4, 'Alyssa', 'M.', 'Garcia', 'Aly', '$2y$10$g7507yRWeXmq63nuLI0biur4AhoCUoRESzKS4aWenaIXrnuEcszW.', 4, '', '', '', 'asdfaf', 'aly@aly.com', '20293', '', '', '', '', 1, 1);

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
  ADD KEY `archive_files_id_fk` (`archive_files_id_fk`);

--
-- Indexes for table `tblfiles_content`
--
ALTER TABLE `tblfiles_content`
  ADD PRIMARY KEY (`files_id`),
  ADD KEY `files_ffolder_id_fk` (`files_ffolder_id_fk`);

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
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  ADD CONSTRAINT `tblfiles_archive_ibfk_1` FOREIGN KEY (`archive_files_id_fk`) REFERENCES `tblfiles_content` (`files_id`);

--
-- Constraints for table `tblfiles_content`
--
ALTER TABLE `tblfiles_content`
  ADD CONSTRAINT `tblfiles_content_ibfk_1` FOREIGN KEY (`files_ffolder_id_fk`) REFERENCES `tblfiles_folder` (`ffolder_id`);

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
-- Constraints for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`user_department`) REFERENCES `tbldepartments` (`department_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
