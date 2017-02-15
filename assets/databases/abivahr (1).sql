-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2017 at 04:37 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_status` tinyint(1) NOT NULL,
  `message_thread_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `tblfiles_archive_deleted`
--

CREATE TABLE `tblfiles_archive_deleted` (
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
-- Table structure for table `tblfiles_deleted`
--

CREATE TABLE `tblfiles_deleted` (
  `files_id` int(11) NOT NULL,
  `files_name` varchar(30) NOT NULL,
  `files_deletedby` int(11) NOT NULL,
  `files_path` text NOT NULL,
  `files_display_name` varchar(50) NOT NULL,
  `files_version` varchar(255) NOT NULL,
  `files_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `files_foldername` varchar(100) NOT NULL,
  `files_department` int(11) NOT NULL
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
  `picture_uploader_id` int(11) NOT NULL,
  `gfolder_id_fk` int(11) NOT NULL
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
  `user_read_ann` tinyint(4) NOT NULL DEFAULT '0',
  `user_isadmin` tinyint(4) NOT NULL,
  `user_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `user_firstname`, `user_middlename`, `user_lastname`, `user_username`, `user_password`, `user_department`, `user_birthday`, `user_gender`, `user_aboutme`, `user_address`, `user_email`, `user_cpnumber`, `user_google`, `user_linkedin`, `user_wordpress`, `user_picture`, `user_read_ann`, `user_isadmin`, `user_active`) VALUES
(1, 'Lorenzo', 'C.', 'Magno', 'magmagg', '$2y$10$ssIlFY9Qlaa9XPUub6/d6.mwZ3N/HjXIUFL8mhK3HfoqZeTaUxH8y', 2, '', 'female', '																																																																					', '', '', '', '', '', '', './assets/files/profile_pictures/photo1080433688446085048.jpg', 1, 1, 1),
(2, 'Sample', '.', '1', 'Sample1', '$2y$10$1PEsMDHut5H75JvSBeLlx.VTfhGnKZh4S7MXG6PkPmBvYnpSZYBAm', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 2, 1),
(3, 'Sample', '.', '2', 'Sample2', '$2y$10$D.JTYh6LP/MNYPO923kE1OAKWS39/gPZactv6RipNRuo/ULXc875i', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 0, 1),
(4, 'Sample', '.', '3', 'Sample3', '$2y$10$RZ0TK9sHlOryKdUPCPbgduYvUZlw4N9Cbn5To95YI8zPhgP6/Eda2', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 0, 1),
(5, 'A', 'a', 'A', 'A', '$2y$10$r2VGANAukfiQF5CldMiyX./fKcl4fvdyoUsdo74w.o7i3cSSNkkM6', 2, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1),
(6, 'B', 'B', 'B', 'B', '$2y$10$feiTRNF97BmzDR9XfL2ZueVLQOVBqbry45D2dpPD9qmMM1QoaBYju', 3, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 0, 1),
(7, 'C', 'C', 'C', 'C', '$2y$10$jmxogHoRDI7MUj3X5GQyVO/VD32TV1qK.ZXLMPqDX0Voz1Y05i9.G', 4, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 0, 1),
(8, 'D', 'D', 'D', 'D', '$2y$10$Wwbnqbm2tm5ae.UNMI1yW.cwlzZwMsfRqkVTlZ0lHIMrqxrlmN8rm', 5, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 0, 1),
(9, 'EDP', 'EDP', 'EDP', 'EDP', '$2y$10$Yayor/WkFOUUnhXICm6qTeZX0EV/Wvj10s9TSSwnCMjPoAXbe942K', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1),
(10, 'Adrian', '.', 'Jimenez', 'ajimenez', '$2y$10$fXeVMUQcFcLJxNWptL/A3urBo5RNJDl4F9pM9Lofy1efmJGykyE7G', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(11, 'Aldrin', '.', 'Claudio', 'aclaudio', '$2y$10$9E89iIO8e/RQRoLr67AFEuP8ANkAQop9D.qMYZIMnZpePGigXDEPS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(12, 'Arman', '.', 'Gersin', 'agersin', '$2y$10$T/2UNdNC0sUgelHYSBaUke4.Gq8S8CeniZgNtVQEiklbP9hk9MGfK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(13, 'Caren Clariza', '.', 'Cortez', 'ccortez', '$2y$10$dz/creKEQfu2Aa5bQLJRxenPA.6MVYE1xkJrVTr.qY75IC.arbCfa', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(14, 'Carmencita', '.', 'Usman', 'cusman', '$2y$10$IQj2JXEpBCv6W/vC/Jr6x.Xv1FcFzRS7OcE/4U7azYijOZLNLevSm', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(15, 'Cristina', '.', 'Rotairo', 'crotairo', '$2y$10$gZXnY2nYdysUA.IHtONVTulsRSJPkiZUOBCEB.HGX4IpY2Bts.FHO', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(16, 'Danilo Nirto', '.', 'Calalang', 'dcalalang', '$2y$10$PmqE5qAFIKEVJcWW/M1w8Oaiahnc7L/4HSHB7cvQjBhY5RUQGNRUS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(17, 'Dick', '.', 'Bantolino', 'dbantolino', '$2y$10$M6IydHwNdXHf6AC8mC9pnuJHylFr.vxv5qh4q6yYkGzzHuJRfSkWa', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(18, 'Eman', '.', 'Pelagio', 'epelagio', '$2y$10$QnyU5vwlaaIWFjksrqSkOOEeR8QuFgueUXviYOI7PacLvmau7KnXK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(19, 'Eva', '.', 'Tuvilla', 'etuvilla', '$2y$10$2nqUeWn043Op/BSVNxi/DuP36ysCxuYfGGj5LV6zC.AIOecKTawtK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(20, 'Helen', '.', 'de Guzman', 'hdeguzman', '$2y$10$tZfHFK9hCDwBkextIWb1jewpJZ/fxZ0RRk2ildl8wQHjT2XIn91nS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(21, 'Janice', '.', 'Pangilinar', 'jpangilinar', '$2y$10$MgbqjdmRjIvzMCEL2yqrCuGbYjdKMvCi.j0d8qQCR.jIGDWmdKUs2', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(22, 'Jayson', '.', 'Fajardo', 'jfajardo', '$2y$10$3STUD1Y0DL87TjJr885p4Ofo4yWaZl6zUitnJcdSyVoxAyjNa39DO', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(23, 'Jessa', '.', 'Borres', 'jborres', '$2y$10$7odRkMuwl4WQSzN0pMZAk.u4ISMlR52lp7v.U.1n4lJJuocIdchXa', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(24, 'Jhoanna Fe', '.', 'Manaog', 'jmanaog', '$2y$10$q1OQLn.hyhQEAcoioUrWUu25lxZ/yXxq5qNOYbGTsIxNKBYtnryiW', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(25, 'Joey', '.', 'Maniclang', 'jmaniclang', '$2y$10$7nHoQDNdm76D70TTLH8mDejf2/LpBD4GXyCeJmfi4m4Q4Q.EkwAD6', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(26, 'Josie', '.', 'Caoael', 'jcaoael', '$2y$10$IPkQPKUy8S0TD66Gv8JB7.KGcD9u81S/mbLmO3nC5m7DAQHwhb6qa', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(27, 'Kristine Joy', '.', 'Bartolome', 'kbartolome', '$2y$10$Zfz/odKy047TyNRJ19HxcuSRYXwhBf47fwPCm6WaZ8KnxbzyiUxBa', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(28, 'Loydgee James', '.', 'Andaya', 'landaya', '$2y$10$4CaEAfdpGUWrVHw0GOejJ.T8e5Pjr.KGz7J5ClyEmHr4ojStV5Y2G', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(29, 'Ma. Jose', '.', 'Bayani', 'mbayani', '$2y$10$IKI3cgdLlmQX9olDxsyzOurQdfi9sRah.98lNEOBy9QI/MlUAhYb2', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(30, 'Maribel', '.', 'Quintinc', 'mquintinc', '$2y$10$51hYmZVmWNFU1wlnosJHA.Lednet9ggfYZoMm94DZ4cNEzTtBIJjK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(31, 'Martin', '.', 'Racza', 'mracza', '$2y$10$av774cRDQCgGmy9xNDtIcOoytxLJPMhSo3w4wJzsAQl9e0c7z9MwK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(32, 'Nikki Mae', '.', 'Lucas', 'nlucas', '$2y$10$jBRn97nErRrIbrke9wlP5.V.MXN0AIATfe1EQxKXd2Vh6clLJT9tq', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(33, 'Nimfa Grace', '.', 'Jorvina', 'njorvina', '$2y$10$sboqqbWW7JvhUgGfzyVd6OawbFI9e0T4QRX.8B2U9gQ90P57.sgHq', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(34, 'Raphael', '.', 'Cristobal', 'rcristobal', '$2y$10$0Ud0DE4N.gKY0mmErHRY.eF7A/OjSVIJG.t8Paz9EIpBXIfM7QbfS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(35, 'Raya', '.', 'Moron', 'rmoron', '$2y$10$8WI8qMC3weabtRx1UENG1u.0G5QCHTtLxnaMXccXhKQrrvqKwEboO', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(36, 'Santiago', '.', 'Melarpis', 'smelarpis', '$2y$10$9njGD0QuJKbEDmmVpKKM4O8.r5JsHRlqoo/WnwXaGUmKk6/aQbCsK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(37, 'Sharmaine', '.', 'Lizaca', 'slizaca', '$2y$10$UrleuzOcuP0Utj9tDlyCP.92RZHDmfqszodLew5TxuLW/P7v43/Zq', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(38, 'Victorio', '.', 'Malatbalat', 'vmalatbalat', '$2y$10$LIJHAfDShMNWNxs2Sxj9LuNUa/7cdZNWCsYmcDaMYai9tFyKJpAU.', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(39, 'Ida Grace', '.', 'Baylor', 'ibaylor', '$2y$10$qTftIRWQXAg8/Qcjs7gRb.Q0KIvrIxxR3Eyx6dr2MW99Rv0WQhXPy', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(40, 'Josefina DG', '.', 'Sison', 'jsison', '$2y$10$p6tmat3h9UgkQYPaFjhwmuQZ2HDF1ds6XP3IWA9F/VURU/G8/L8Ne', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1),
(41, 'Lyn', '.', 'Moreno', 'lmoreno', '$2y$10$XPlul0H4jGDHQGrOPBvf2uchoM2KcVmtvAM.RwhUT5x7wj2ah.qKO', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblvideos_content`
--

CREATE TABLE `tblvideos_content` (
  `video_id` int(11) NOT NULL,
  `video_name` text NOT NULL,
  `video_path` text NOT NULL,
  `video_uploader_id` int(11) NOT NULL,
  `vfolder_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblvideos_folder`
--

CREATE TABLE `tblvideos_folder` (
  `vfolder_id` int(11) NOT NULL,
  `vfolder_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvideos_folder`
--

INSERT INTO `tblvideos_folder` (`vfolder_id`, `vfolder_name`) VALUES
(1, 'sdf sdf'),
(2, 'sd f sdf'),
(3, 'w3w'),
(4, 'ddf'),
(5, 'f'),
(6, 'sdddd'),
(7, 'waw'),
(8, 'zzz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tblfiles_archive_deleted`
--
ALTER TABLE `tblfiles_archive_deleted`
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
-- Indexes for table `tblfiles_deleted`
--
ALTER TABLE `tblfiles_deleted`
  ADD PRIMARY KEY (`files_id`),
  ADD KEY `files_user_id_fk` (`files_deletedby`),
  ADD KEY `files_department` (`files_department`);

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
-- Indexes for table `tblvideos_content`
--
ALTER TABLE `tblvideos_content`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `vfolder_id_fk` (`vfolder_id_fk`);

--
-- Indexes for table `tblvideos_folder`
--
ALTER TABLE `tblvideos_folder`
  ADD PRIMARY KEY (`vfolder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `tblfiles_archive_deleted`
--
ALTER TABLE `tblfiles_archive_deleted`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfiles_content`
--
ALTER TABLE `tblfiles_content`
  MODIFY `files_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfiles_deleted`
--
ALTER TABLE `tblfiles_deleted`
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
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `tblvideos_content`
--
ALTER TABLE `tblvideos_content`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblvideos_folder`
--
ALTER TABLE `tblvideos_folder`
  MODIFY `vfolder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- Constraints for table `tblfiles_deleted`
--
ALTER TABLE `tblfiles_deleted`
  ADD CONSTRAINT `tblfiles_deleted_ibfk_1` FOREIGN KEY (`files_department`) REFERENCES `tbldepartments` (`department_id`);

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

--
-- Constraints for table `tblvideos_content`
--
ALTER TABLE `tblvideos_content`
  ADD CONSTRAINT `vfolder_id_fk` FOREIGN KEY (`vfolder_id_fk`) REFERENCES `tblvideos_folder` (`vfolder_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
