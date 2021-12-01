-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2021 at 05:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `question_img` longtext DEFAULT NULL,
  `quiz_id` int(11) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `question_img`, `quiz_id`, `date_updated`) VALUES
(62, '', NULL, 29, '2021-11-29 20:49:57'),
(63, '', NULL, 29, '2021-11-29 20:50:00'),
(64, 'Testing', 'question.jpg', 29, '2021-11-29 20:50:16'),
(71, 'This is a testing question', 'Screenshot_20211123_162413.png', 33, '2021-12-01 12:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `question_option`
--

CREATE TABLE `question_option` (
  `id` int(11) NOT NULL,
  `option_text` varchar(500) NOT NULL,
  `option_img` longtext DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `is_right` int(1) NOT NULL COMMENT '1=correct, 0=incorrect',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_option`
--

INSERT INTO `question_option` (`id`, `option_text`, `option_img`, `question_id`, `is_right`, `date_updated`) VALUES
(237, '', NULL, 62, 0, '2021-11-29 20:49:57'),
(238, '', NULL, 62, 0, '2021-11-29 20:49:57'),
(239, '', NULL, 62, 0, '2021-11-29 20:49:57'),
(240, '', NULL, 62, 0, '2021-11-29 20:49:57'),
(241, '', NULL, 63, 0, '2021-11-29 20:50:00'),
(242, '', NULL, 63, 0, '2021-11-29 20:50:00'),
(243, '', NULL, 63, 0, '2021-11-29 20:50:00'),
(244, '', NULL, 63, 0, '2021-11-29 20:50:00'),
(245, 'A', NULL, 64, 1, '2021-11-29 20:50:17'),
(246, 'asd', NULL, 64, 0, '2021-11-29 20:50:17'),
(247, 'asd', NULL, 64, 0, '2021-11-29 20:50:17'),
(248, 'asd', NULL, 64, 0, '2021-11-29 20:50:17'),
(249, 'R', NULL, 65, 1, '2021-11-30 16:48:02'),
(250, 'W', NULL, 65, 0, '2021-11-30 16:48:02'),
(251, 'W', NULL, 65, 0, '2021-11-30 16:48:03'),
(252, 'W', NULL, 65, 0, '2021-11-30 16:48:03'),
(253, '1', NULL, 66, 1, '2021-11-30 16:55:08'),
(254, '2', NULL, 66, 0, '2021-11-30 16:55:08'),
(255, '3', NULL, 66, 0, '2021-11-30 16:55:08'),
(256, '4', NULL, 66, 0, '2021-11-30 16:55:08'),
(257, 'Yeah', NULL, 67, 1, '2021-11-30 17:23:24'),
(258, 'w', NULL, 67, 0, '2021-11-30 17:23:24'),
(259, 'w', NULL, 67, 0, '2021-11-30 17:23:24'),
(260, 'w', NULL, 67, 0, '2021-11-30 17:23:24'),
(261, '1', NULL, 68, 1, '2021-11-30 17:26:09'),
(262, '2', NULL, 68, 0, '2021-11-30 17:26:09'),
(263, '3', NULL, 68, 0, '2021-11-30 17:26:09'),
(264, '4', NULL, 68, 0, '2021-11-30 17:26:09'),
(265, '123', NULL, 69, 1, '2021-11-30 18:08:31'),
(266, 'asd', NULL, 69, 0, '2021-11-30 18:08:31'),
(267, 'asd', NULL, 69, 0, '2021-11-30 18:08:31'),
(268, 'asd', NULL, 69, 0, '2021-11-30 18:08:31'),
(269, 'R', NULL, 70, 1, '2021-11-30 20:40:03'),
(270, 'W', NULL, 70, 0, '2021-11-30 20:40:03'),
(271, 'W', NULL, 70, 0, '2021-11-30 20:40:03'),
(272, 'W', NULL, 70, 0, '2021-11-30 20:40:03'),
(273, 'For testing only', NULL, 71, 1, '2021-12-01 12:11:45'),
(274, 'Wrong', NULL, 71, 0, '2021-12-01 12:11:45'),
(275, 'Wrong', NULL, 71, 0, '2021-12-01 12:11:45'),
(276, 'Wrong', NULL, 71, 0, '2021-12-01 12:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_list`
--

CREATE TABLE `quiz_list` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `points` int(2) NOT NULL,
  `u_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL COMMENT 'active = 1\r\nnot active = 0',
  `quiz_pw` varchar(50) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_list`
--

INSERT INTO `quiz_list` (`id`, `title`, `points`, `u_id`, `is_active`, `quiz_pw`, `date_updated`) VALUES
(29, 'This is a testing quiz DDT5S7', 2, 13, 1, 'testing', '2021-11-28 14:25:00'),
(33, 'Database Management DDT5S7', 2, 4, 1, 'unique', '2021-12-01 12:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL,
  `std_username` varchar(50) NOT NULL,
  `std_password` varchar(50) NOT NULL,
  `std_name` varchar(150) NOT NULL,
  `std_matric` varchar(25) NOT NULL,
  `std_session` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_username`, `std_password`, `std_name`, `std_matric`, `std_session`) VALUES
(1, 'test', 'acf7ef943fdeb3cbfed8dd0d8f584731', 'Falaqin Hakimi', 'F1133', '2019/2021'),
(2, 'daud', '098f6bcd4621d373cade4e832627b4f6', 'Ahmad Mahmood Bin Daud', 'F5101', '2019/2021'),
(3, 'haji', '098f6bcd4621d373cade4e832627b4f6', 'Bakhil', 'F9999', '2020/2022'),
(4, 'Adib', '81dc9bdb52d04dc20036dbd8313ed055', 'Adib Haikal', 'F1147', '2019/2021'),
(5, 'ahmad', '202cb962ac59075b964b07152d234b70', 'Ahmad', 'F9911', '2019/2021'),
(11, 'armi', '202cb962ac59075b964b07152d234b70', 'armi ', 'F1056', '2019/2021'),
(12, 'falaqin', '202cb962ac59075b964b07152d234b70', 'Falaqin', 'F1133', '2021'),
(15, 'hakimi', '202cb962ac59075b964b07152d234b70', 'Hakimi Saeed', 'F1100', '2019/2020'),
(16, 'pog', '202cb962ac59075b964b07152d234b70', 'PogChamp', 'FPOG', '2019/2021'),
(17, 'f10', '202cb962ac59075b964b07152d234b70', '10th User Anniversary', 'F10th', '2019/2021'),
(18, 'come', '202cb962ac59075b964b07152d234b70', 'This is my kingdom come', 'FC0M', '2019/2021'),
(19, 'aaaa', '202cb962ac59075b964b07152d234b70', 'Testing', 'F1111', '123');

-- --------------------------------------------------------

--
-- Table structure for table `student_answer`
--

CREATE TABLE `student_answer` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `is_right` int(1) NOT NULL COMMENT '1=correct, 0=incorrect',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_quiz`
--

CREATE TABLE `student_quiz` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_score`
--

CREATE TABLE `student_score` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `quiz_points` int(5) NOT NULL,
  `total_points` int(5) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `u_username` varchar(30) NOT NULL,
  `u_password` varchar(35) NOT NULL,
  `u_access_lvl` tinyint(2) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_name`, `u_username`, `u_password`, `u_access_lvl`, `date_updated`) VALUES
(1, 'Administrator', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 1, '2021-11-19 14:42:27'),
(4, 'Rislah Binti Zakaria', 'pnrislah', '202cb962ac59075b964b07152d234b70', 2, '2021-11-19 14:42:27'),
(7, 'Encik Lecturer', 'en', '202cb962ac59075b964b07152d234b70', 2, '2021-11-19 14:42:27'),
(9, 'Encik Kamalul', 'kamalul', '202cb962ac59075b964b07152d234b70', 2, '2021-11-19 14:43:27'),
(10, 'Ahmad Kiraan', 'kira', '202cb962ac59075b964b07152d234b70', 2, '2021-11-19 14:45:46'),
(12, 'Karim', 'krim', '202cb962ac59075b964b07152d234b70', 2, '2021-11-20 23:27:57'),
(13, 'Chi Ken Ween', 'chickenwing', '202cb962ac59075b964b07152d234b70', 2, '2021-11-20 23:28:18'),
(18, 'Nama1', 'nama1', '202cb962ac59075b964b07152d234b70', 2, '2021-11-21 09:00:30'),
(19, 'Nama2', 'Nama2', '202cb962ac59075b964b07152d234b70', 2, '2021-11-21 09:00:30'),
(20, 'Hantu', 'hantu', '202cb962ac59075b964b07152d234b70', 2, '2021-11-28 15:26:52'),
(21, 'Ghost', 'ghost', '202cb962ac59075b964b07152d234b70', 2, '2021-11-28 15:27:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_option`
--
ALTER TABLE `question_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_list`
--
ALTER TABLE `quiz_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `student_answer`
--
ALTER TABLE `student_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_quiz`
--
ALTER TABLE `student_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_score`
--
ALTER TABLE `student_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `question_option`
--
ALTER TABLE `question_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `quiz_list`
--
ALTER TABLE `quiz_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student_answer`
--
ALTER TABLE `student_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_quiz`
--
ALTER TABLE `student_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_score`
--
ALTER TABLE `student_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
