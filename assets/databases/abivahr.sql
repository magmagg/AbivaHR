-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2017 at 03:11 AM
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
-- Table structure for table `tblacceptedfiles`
--

CREATE TABLE `tblacceptedfiles` (
  `accepted_files_id` int(11) NOT NULL,
  `accepted_files` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblacceptedfiles`
--

INSERT INTO `tblacceptedfiles` (`accepted_files_id`, `accepted_files`) VALUES
(1, 'html'),
(2, 'docx'),
(3, 'doc'),
(4, 'ppt'),
(5, 'pdf'),
(6, 'txt'),
(7, 'xls'),
(8, 'xlxs'),
(9, 'rar'),
(11, '7z'),
(12, 'epub'),
(14, 'psd');

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
(1, 'Generic');

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
  `files_last_updated` int(11) NOT NULL,
  `files_team_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfiles_folder`
--

CREATE TABLE `tblfiles_folder` (
  `ffolder_id` int(11) NOT NULL,
  `ffolder_name` varchar(35) NOT NULL,
  `ffolder_dept_id_fk` int(11) NOT NULL,
  `ffolder_teams_id_fk` int(11) NOT NULL
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
-- Table structure for table `tblteams`
--

CREATE TABLE `tblteams` (
  `teams_id` int(11) NOT NULL,
  `teams_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblteams`
--

INSERT INTO `tblteams` (`teams_id`, `teams_name`) VALUES
(1, 'Generic'),
(2, 'English'),
(3, 'Science'),
(4, 'Math'),
(5, 'Araling Panlipunan'),
(6, 'Senior High School'),
(7, 'Teachers Guide'),
(8, 'Filipino');

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
  `user_active` tinyint(4) NOT NULL DEFAULT '1',
  `user_teams_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `user_firstname`, `user_middlename`, `user_lastname`, `user_username`, `user_password`, `user_department`, `user_birthday`, `user_gender`, `user_aboutme`, `user_address`, `user_email`, `user_cpnumber`, `user_google`, `user_linkedin`, `user_wordpress`, `user_picture`, `user_read_ann`, `user_isadmin`, `user_active`, `user_teams_id_fk`) VALUES
(6, 'Adrian', '.', 'Jimenez', 'ajimenez_user', '$2y$10$/D.Ib5mj5KyuCKB1ugJeX.BPWsdlG5lnzqSHpz9mSArG41CVu0pZW', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 2, 1, 1),
(7, 'Aldrin', '.', 'Claudio', 'aclaudio_user', '$2y$10$7SedSpbrU5j2CrCApB1sx.C8Hufrp.nYCBf3EqzJAYOzi3ybmQ1X.', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 4),
(8, 'Arman', '.', 'Gersin', 'agersin_user', '$2y$10$XWB5GrAzVEU.uCMQraX6C.Ye1CMHu8zzlPCdi8BBVBwKCsC9GJR0a', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(9, 'Caren Clariza', '.', 'Cortez', 'ccortez_user', '$2y$10$Rp8Ml.mpTD/76e2Yl3msk./42uX4Hg7DqXRnMCff6Ea1ZHZKB8gVS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 2),
(10, 'Carmencita', '.', 'Usman', 'cusman_user', '$2y$10$eSyZEYKoFYcHnakOOvqoZOnni1faZ0GukGYwJUAPecq1GxhSu8.ba', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(11, 'Cristina', '.', 'Rotairo', 'crotairo_user', '$2y$10$9BhpHKNRh/a6yX7G5byuIuVOAzoe2P.jj1X70dmFrJGEjGyY3YK5e', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(12, 'Danilo Niño', '.', 'Calalang', 'dcalalang_user', '$2y$10$YfkWEKUcMYcknHMSC9Ba..cjHQNeUIRqPlTTbAcZU9wOcBE3wA/62', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(13, 'Dick', '.', 'Bantolino', 'dbantolino_user', '$2y$10$mNUSIKrGDrwMd9VFZRAkZuKHsLRGuk2wd07MqH3nOa3T3gn7wedSS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(14, 'Eman', '.', 'Pelagio', 'epelagio_user', '$2y$10$nfn0htoXe8LVov.nTDxTAOLoBegWZgUmTPD4/vbYpaXJolWJqCvHu', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(15, 'Eva', '.', 'Tuvilla', 'etuvilla_user', '$2y$10$5.L46Z3Ws6B9pWZRNHGqvOtL3/RyJfzTpvy5JIY/Ij9W/fMZDi8Ty', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(16, 'Helen', '.', 'de Guzman', 'hdeguzman_user', '$2y$10$aoO4ygRHllKpR1hVJQreM..9FTeKOM2l1gLlr5ktT6k9HioIi3ItK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(17, 'Janice', '.', 'Pangilinar', 'jpangilinar_user', '$2y$10$P6C.BhNtIdgN47JytHYQkODy7MF6k6yVIf0b1vMOJ/Oa1veC6pGau', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 3),
(18, 'Jayson', '.', 'Fajardo', 'jfajardo_user', '$2y$10$qUflMlqejoS9q2.HyL1u6.lQ2aS70PeXLjcGqxiRqk/J2AhZSDkx.', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 8),
(19, 'Jessa', '.', 'Borres', 'jborres_user', '$2y$10$kKUSSOorRtgNutoS2ytGz.lHnzmBm26aXvOpmkFtVoJCoMoqobjJ6', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 8),
(20, 'Jhoanna Fe', '.', 'Manaog', 'jmanaog_user', '$2y$10$pto4saLX9X0x7GpDro/oSeM12mEMwQ8R1he2MGiOezzkQaCURA8g.', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(21, 'Joey', '.', 'Manicjang', 'jmanicjang_user', '$2y$10$bd2nA8LPGMMZ32ejko8pHeu1FdiCtAbxotOGp2cDBFCWQg0TMaqGi', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(22, 'Josie', '.', 'Caoael', 'jcaoael_user', '$2y$10$VDoUiHUjNGl0B76Hdvs4BO42hoxYGeu9bDVkpy7WM9Uzf9PihvmZ2', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(23, 'Kristine Joy', '.', 'Bartolome', 'kbartolome_user', '$2y$10$oqPVX8uqd62rg9OJaS8Z7eOwFybsJKsyApJgIzgu7J4AzBTtfqCbK', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 4),
(24, 'Loydgee James', '.', 'Andaya', 'landaya_user', '$2y$10$NiLSslmceTGDZEkt153.z.4emErJwQEMs4P57QVIScgilJQK3uvvq', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(25, 'Ma. Jose', '.', 'Bayani', 'mbayani_user', '$2y$10$6ZA6XqxBm9sBOFcXv0RA4.QUgbacc7uJ0NhYIRu4/HwYdDKasDqti', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(26, 'Maribel', '.', 'Quintinc', 'mquintinc_user', '$2y$10$vW7XX6PJNut9R.0pvSjy.OWe4thuMfCAsqSMPOXasDZAWWhrWRQ9y', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 8),
(27, 'Martin', '.', 'Racza', 'mracza_user', '$2y$10$tnwUuCtP4czH3kRb/dMfxuJi4o7//sKqwR1.TJajDuLk.C73fSjcS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 5),
(28, 'Nikki Mae', '.', 'Lucas', 'nlucas_user', '$2y$10$ebmW1n4pa4d8vrlsESfka..zx73OF8GohrqGyEngltWN06FPKonAq', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(29, 'Nimfa Grace', '.', 'Jorvina', 'njorvina_user', '$2y$10$2Df/XFMI2tVCSrC5eckjteI24mREjlHidT1uIVwdl1XxArwACMbVq', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(30, 'Raphael', '.', 'Cristobal', 'rcristobal_user', '$2y$10$HkaRGvC25rRIxEyX0dIaneJvMvIz3chGZzQBLMcZi3GRCSgwpTC0S', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(31, 'Raya', '.', 'Moron', 'rmoron_user', '$2y$10$IuG1mycL8Y3qqIFByvKde.VDjaUfDbLNonZn4/U5ur1uLgZiNNb7i', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 2),
(32, 'Santiago', '.', 'Melarpis', 'smelarpis_user', '$2y$10$I2y5JcSqMdY9S0DgL8LnCeCJ.2XoZtTlrwN9zyLcF7nfHHNlquYeu', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 8),
(33, 'Sharmaine', '.', 'Lizaca', 'slizaca_user', '$2y$10$4OzIEd6EiqF.kgh2.WRuyeKcPg.8Ph/Xg1aRifPs1HQWTVWzIKAKa', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 5),
(34, 'Victorio', '.', 'Malatbalat', 'vmalatbalat_user', '$2y$10$erXUNGkJo8bXr4gi7fBTfOuICMSom2pGaYXrdU/BYlI9WgRJYFXfu', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 1),
(35, 'Ida Grace', '.', 'Baylor', 'ibaylor_user', '$2y$10$BO0hz1EKKqL9AIFIBrF4o.KT00j/ul6ruUkyGscCPBARgzmYle8Qe', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 8),
(36, 'Josefina DG', '.', 'Sison', 'jsison_user', '$2y$10$1404IsKBla0DxEU3irdIF..cXhGN15HiN9hUk.RBc7IHS1gzFFDla', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 8),
(37, 'Lyn', '.', 'Moreno', 'lmoreno_user', '$2y$10$C4JThBIrZLj4eSiW90w02eMXADw3vgcaYZ.FEzCvKMuRJFgcMDIlS', 1, '', '', '', '', '', '', '', '', '', './assets/images/avatars/avatar2.png', 0, 0, 1, 5),
(41, 'SUPER', 'S.', 'ADMIN', 'SUPERADMIN', '$2y$10$m1uVsvn5K8B.JiTkJAWFYecPHaCDuxYcb8HhJ9Rz27lWcsSoLADXi', 1, '', 'female', '																							', '', '', '', '', '', '', './assets/files/profile_pictures/administrator.png', 0, 1, 1, 1);

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
-- Indexes for table `tblacceptedfiles`
--
ALTER TABLE `tblacceptedfiles`
  ADD PRIMARY KEY (`accepted_files_id`);

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
  ADD KEY `files_team_id_fk` (`files_team_id_fk`);

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
-- Indexes for table `tblteams`
--
ALTER TABLE `tblteams`
  ADD PRIMARY KEY (`teams_id`);

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
  ADD KEY `fk_department` (`user_department`),
  ADD KEY `user_teams_id_fk` (`user_teams_id_fk`);

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
-- AUTO_INCREMENT for table `tblacceptedfiles`
--
ALTER TABLE `tblacceptedfiles`
  MODIFY `accepted_files_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tblannouncements`
--
ALTER TABLE `tblannouncements`
  MODIFY `ann_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `tblteams`
--
ALTER TABLE `tblteams`
  MODIFY `teams_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  ADD CONSTRAINT `tblfiles_deleted_ibfk_1` FOREIGN KEY (`files_team_id_fk`) REFERENCES `tblteams` (`teams_id`);

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
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`user_department`) REFERENCES `tbldepartments` (`department_id`),
  ADD CONSTRAINT `tblusers_ibfk_1` FOREIGN KEY (`user_teams_id_fk`) REFERENCES `tblteams` (`teams_id`);

--
-- Constraints for table `tblvideos_content`
--
ALTER TABLE `tblvideos_content`
  ADD CONSTRAINT `vfolder_id_fk` FOREIGN KEY (`vfolder_id_fk`) REFERENCES `tblvideos_folder` (`vfolder_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
