-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2016 at 10:33 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admission_process`
--

CREATE TABLE IF NOT EXISTS `tbl_admission_process` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(9) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `result` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_admission_process`
--

INSERT INTO `tbl_admission_process` (`id`, `academic_year`, `status`, `result`) VALUES
(8, '2015-2016', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allocations`
--

CREATE TABLE IF NOT EXISTS `tbl_allocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_process_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_allocations`
--

INSERT INTO `tbl_allocations` (`id`, `admission_process_id`, `year`, `branch_id`, `gender`, `category_id`, `seats`) VALUES
(1, 8, 4, 1, 1, 1, 2),
(2, 8, 4, 1, 1, 2, 1),
(3, 8, 4, 1, 1, 3, 1),
(4, 8, 2, 1, 1, 1, 2),
(5, 8, 2, 1, 1, 2, 2),
(6, 8, 2, 1, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branches`
--

CREATE TABLE IF NOT EXISTS `tbl_branches` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_branches`
--

INSERT INTO `tbl_branches` (`id`, `branch_name`) VALUES
(1, 'Civil'),
(2, 'Mechanical'),
(3, 'Electrical'),
(4, 'Electronics'),
(5, 'Computer Science'),
(6, 'Instrumentation'),
(7, 'Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category_name`) VALUES
(1, 'OPEN'),
(2, 'OBC'),
(3, 'SC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hostels`
--

CREATE TABLE IF NOT EXISTS `tbl_hostels` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `type` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_hostels`
--

INSERT INTO `tbl_hostels` (`id`, `name`, `type`) VALUES
(1, 'Sahyadri Hostel', 0),
(2, 'Satpuda Hostel', 0),
(3, 'Jijau Hostel', 1),
(4, 'New Girls Hostel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE IF NOT EXISTS `tbl_rooms` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `hostel_id` int(2) DEFAULT NULL,
  `room_no` int(3) DEFAULT NULL,
  `seat_no` int(1) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hostel_id` (`hostel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`id`, `hostel_id`, `room_no`, `seat_no`, `student_id`, `floor`) VALUES
(1, 1, 101, 1, NULL, 1),
(2, 1, 103, 1, NULL, 1),
(3, 2, 101, 1, NULL, 1),
(4, 2, 102, 1, NULL, 1),
(5, 3, 101, 1, NULL, 1),
(6, 3, 102, 1, NULL, 1),
(7, 4, 102, 1, NULL, 1),
(8, 4, 101, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE IF NOT EXISTS `tbl_students` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `college_id` varchar(8) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `blood_group` varchar(3) DEFAULT NULL,
  `category` int(2) NOT NULL,
  `p_address` text NOT NULL,
  `p_contact` int(10) NOT NULL,
  `p_office_address` text,
  `p_office_contact` int(10) NOT NULL,
  `g_address` text,
  `g_contact` int(10) DEFAULT NULL,
  `branch_id` int(2) NOT NULL,
  `year` int(1) NOT NULL,
  `gender` int(1) NOT NULL,
  `ph` tinyint(4) NOT NULL,
  `is_valid` tinyint(4) NOT NULL,
  `profile_pic` varchar(20) DEFAULT NULL,
  `is_alloted` tinyint(1) DEFAULT NULL,
  `exam_last` double NOT NULL,
  `exam_curr` double NOT NULL,
  `dob` date NOT NULL,
  `rank` int(11) NOT NULL,
  `alloted_under_quota` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `college_id`, `fname`, `mname`, `lname`, `blood_group`, `category`, `p_address`, `p_contact`, `p_office_address`, `p_office_contact`, `g_address`, `g_contact`, `branch_id`, `year`, `gender`, `ph`, `is_valid`, `profile_pic`, `is_alloted`, `exam_last`, `exam_curr`, `dob`, `rank`, `alloted_under_quota`) VALUES
(11, '11105004', 'Sagar', 'Krishnakumar', 'Udasi', 'O-', 2, 'Plot no 1, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, NULL, 0, 'Plot no 2, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, 1, 2, 1, 0, 1, NULL, 1, 5.6, 6.8, '1992-10-01', 3, 'OBC'),
(12, '14107010', 'Soniya', 'Krishnakumar', 'Udasi', 'A-', 2, 'sainagar, amravati', 2147483647, NULL, 0, 'sainagar,amravati', 2147483647, 1, 2, 1, 0, 1, NULL, 1, 6.9, 7.4, '1992-10-02', 1, 'OPEN'),
(13, '14107022', 'Pooja ', 'Gajanan', 'Pundkar', 'AB+', 1, 'akot', 898655456, NULL, 0, 'akot', 786545479, 1, 2, 1, 0, 1, NULL, 1, 8.4, 7.3, '1992-10-03', 2, 'OPEN'),
(14, '14107028', 'Shubham', 'Arvind', 'Maraskohle', 'A+', 1, 'Nagpur', 886565354, NULL, 0, 'Nagpur', 2147483647, 1, 4, 1, 0, 1, NULL, NULL, 6.8, 7.3, '1992-10-04', 4, '1'),
(15, '14107031', 'Neha', 'Jivan', 'Kotwal', 'B+', 2, 'Daryapur', 2147483647, NULL, 0, 'Daryapur', 2147483647, 1, 4, 1, 0, 1, NULL, 1, 7.9, 8.1, '1992-10-05', 2, 'OPEN'),
(16, '14107007', 'Vishakha', 'Mohan', 'Telgote', 'B+', 3, 'Rahatgaon', 2147483647, NULL, 0, 'Rahatgaon', 2147483647, 1, 4, 1, 0, 1, NULL, 1, 6.8, 7.3, '1992-10-06', 3, 'SC'),
(17, '11105004', 'Crazy', 'Stupid', 'Crux', 'O-', 1, 'Plot no 1, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, NULL, 0, 'Plot no 2, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, 1, 4, 1, 0, 0, NULL, NULL, 7.4, 8.1, '1992-10-07', 0, '1'),
(18, '11105004', 'Crazy', 'Stupid', 'Crux', 'O-', 1, 'Plot no 1, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, NULL, 0, 'Plot no 2, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, 1, 2, 1, 0, 0, NULL, NULL, 7.2, 8.6, '1992-10-10', 0, '1'),
(19, '11105004', 'Crazy', 'Stupid', 'Crux', 'O-', 1, 'Plot no 1, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, NULL, 0, 'Plot no 2, Sane guruji nagar 2, Sainagar, Amravati', 2147483647, 1, 4, 1, 0, 1, NULL, 1, 7.9, 8.9, '1992-10-10', 1, 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tokens`
--

CREATE TABLE IF NOT EXISTS `tbl_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(10) DEFAULT NULL,
  `admission_process_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `admission_process_id` (`admission_process_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=222 ;

--
-- Dumping data for table `tbl_tokens`
--

INSERT INTO `tbl_tokens` (`id`, `token`, `admission_process_id`, `student_id`) VALUES
(207, '974451966', 8, 11),
(208, '162944378', 8, 12),
(209, '141394215', 8, 13),
(210, '535244051', 8, 14),
(211, '478029166', 8, 15),
(212, '524823620', 8, 16),
(213, '824558743', 8, 19),
(214, '946028823', 8, 20),
(215, '755955371', 8, NULL),
(216, '370152400', 8, NULL),
(217, '297396914', 8, NULL),
(218, '236636976', 8, NULL),
(219, '684548415', 8, NULL),
(220, '615513304', 8, NULL),
(221, '665153703', 8, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD CONSTRAINT `tbl_rooms_ibfk_1` FOREIGN KEY (`hostel_id`) REFERENCES `tbl_hostels` (`id`);

--
-- Constraints for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD CONSTRAINT `tbl_students_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branches` (`id`),
  ADD CONSTRAINT `tbl_students_ibfk_2` FOREIGN KEY (`category`) REFERENCES `tbl_categories` (`id`);

--
-- Constraints for table `tbl_tokens`
--
ALTER TABLE `tbl_tokens`
  ADD CONSTRAINT `tbl_tokens_ibfk_1` FOREIGN KEY (`admission_process_id`) REFERENCES `tbl_admission_process` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
