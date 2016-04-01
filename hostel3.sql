-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: hostel
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_academic_details`
--

DROP TABLE IF EXISTS `tbl_academic_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_academic_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `stud_id` int(10) NOT NULL,
  `year` int(4) NOT NULL,
  `marks` float(2,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stud_id` (`stud_id`),
  CONSTRAINT `tbl_academic_details_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `tbl_students` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_academic_details`
--

LOCK TABLES `tbl_academic_details` WRITE;
/*!40000 ALTER TABLE `tbl_academic_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_academic_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_admission_process`
--

DROP TABLE IF EXISTS `tbl_admission_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admission_process` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(9) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admission_process`
--

LOCK TABLES `tbl_admission_process` WRITE;
/*!40000 ALTER TABLE `tbl_admission_process` DISABLE KEYS */;
INSERT INTO `tbl_admission_process` VALUES (8,'2015-2016',0),(9,'2016-2017',0);
/*!40000 ALTER TABLE `tbl_admission_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_branches`
--

DROP TABLE IF EXISTS `tbl_branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_branches` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_branches`
--

LOCK TABLES `tbl_branches` WRITE;
/*!40000 ALTER TABLE `tbl_branches` DISABLE KEYS */;
INSERT INTO `tbl_branches` VALUES (1,'Civil'),(2,'Mechanical'),(3,'Electrical'),(4,'Electronics'),(5,'Computer Science'),(6,'Instrumentation'),(7,'Information Technology');
/*!40000 ALTER TABLE `tbl_branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categories` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categories`
--

LOCK TABLES `tbl_categories` WRITE;
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
INSERT INTO `tbl_categories` VALUES (1,'open'),(2,'obc'),(3,'sc'),(4,'st'),(5,'nt1'),(6,'nt2'),(7,'nt3');
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_hostels`
--

DROP TABLE IF EXISTS `tbl_hostels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_hostels` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `type` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_hostels`
--

LOCK TABLES `tbl_hostels` WRITE;
/*!40000 ALTER TABLE `tbl_hostels` DISABLE KEYS */;
INSERT INTO `tbl_hostels` VALUES (1,'Sahyadri Hostel',0),(2,'Satpuda Hostel',0),(3,'Jijau Hostel',1),(4,'New Girls Hostel',1);
/*!40000 ALTER TABLE `tbl_hostels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rooms`
--

DROP TABLE IF EXISTS `tbl_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rooms` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `hostel_id` int(2) DEFAULT NULL,
  `room_no` int(3) DEFAULT NULL,
  `capacity` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hostel_id` (`hostel_id`),
  CONSTRAINT `tbl_rooms_ibfk_1` FOREIGN KEY (`hostel_id`) REFERENCES `tbl_hostels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rooms`
--

LOCK TABLES `tbl_rooms` WRITE;
/*!40000 ALTER TABLE `tbl_rooms` DISABLE KEYS */;
INSERT INTO `tbl_rooms` VALUES (1,1,101,3),(2,1,103,3),(3,2,101,3),(4,2,102,3),(5,3,101,3),(6,3,102,3),(7,4,102,2),(8,4,101,2);
/*!40000 ALTER TABLE `tbl_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_students`
--

DROP TABLE IF EXISTS `tbl_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_students` (
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
  `cgpa` float(4,2) NOT NULL,
  `flag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  KEY `category` (`category`),
  CONSTRAINT `tbl_students_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branches` (`id`),
  CONSTRAINT `tbl_students_ibfk_2` FOREIGN KEY (`category`) REFERENCES `tbl_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_students`
--

LOCK TABLES `tbl_students` WRITE;
/*!40000 ALTER TABLE `tbl_students` DISABLE KEYS */;
INSERT INTO `tbl_students` VALUES (11,'11105004','Sagar','Krishnakumar','Udasi','O-',2,'Plot no 1, Sane guruji nagar 2, Sainagar, Amravati',2147483647,NULL,0,'Plot no 2, Sane guruji nagar 2, Sainagar, Amravati',2147483647,2,4,0,0,0,NULL,0.00,NULL),(12,'14107010','Soniya','Krishnakumar','Udasi','A-',2,'sainagar, amravati',2147483647,NULL,0,'sainagar,amravati',2147483647,7,3,1,0,0,NULL,0.00,NULL);
/*!40000 ALTER TABLE `tbl_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tokens`
--

DROP TABLE IF EXISTS `tbl_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(10) DEFAULT NULL,
  `admission_process_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `admission_process_id` (`admission_process_id`),
  CONSTRAINT `tbl_tokens_ibfk_1` FOREIGN KEY (`admission_process_id`) REFERENCES `tbl_admission_process` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tokens`
--

LOCK TABLES `tbl_tokens` WRITE;
/*!40000 ALTER TABLE `tbl_tokens` DISABLE KEYS */;
INSERT INTO `tbl_tokens` VALUES (207,'974451966',8,11),(208,'162944378',8,12),(209,'141394215',8,NULL),(210,'535244051',8,NULL),(211,'478029166',8,NULL),(212,'81828197',9,NULL),(213,'640649755',9,NULL),(214,'115043201',9,NULL),(215,'711093394',9,NULL),(216,'668866754',9,NULL);
/*!40000 ALTER TABLE `tbl_tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-01 12:24:30
