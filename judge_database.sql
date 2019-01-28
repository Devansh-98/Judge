-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: judge_database
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `username` varchar(255) NOT NULL,
  `profilename` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `motto` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `correct_answer` varchar(20000) DEFAULT NULL,
  `wrong_answer` varchar(20000) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES ('Noob','NOOB USER','$2y$10$R/xxrISG2A04juar207KwOaqz3HbMWTQo5iAfgXm2XRCaDcNL.KS.','alpha@gmail.com','Noob','Noob','Noob','Noob','Noob','Noob','Noob','2019-01-03 20:05:01','testing3;testing2;testing1;',';'),('Pawan Kumar','pawan_29','$2y$10$Zf1oavbU4hHQF3aJoASnhOifFaOU3hv9z1i8ZE1I7.SQZ7dkwce8m','pawan@gmail.com','IIT Bhilai','Patna','Bihar','India','Coder','Male','To beat Tourist','2018-12-05 12:26:08','prob1;prob2;',';'),('pawan_29','Pawan Kumar','$2y$10$plhuSngsUlQecRNmSSkrrO0OUfDL5rjOhyamRQEIvJDj3ABLsQ2Wi','pawank@iitbhilai.ac.in','IIT Bhilai','Raipur','Chhattisgarh','India','Student','Male','To beat Tourist','2019-01-01 19:06:18','testing1;testing2;','testing3;');
/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problems_db`
--

DROP TABLE IF EXISTS `problems_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problems_db` (
  `prob_id` varchar(120) DEFAULT NULL,
  `prob_name` varchar(120) DEFAULT NULL,
  `time_limit` varchar(120) DEFAULT NULL,
  `correct_submission` varchar(18) DEFAULT NULL,
  `wrong_submission` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problems_db`
--

LOCK TABLES `problems_db` WRITE;
/*!40000 ALTER TABLE `problems_db` DISABLE KEYS */;
INSERT INTO `problems_db` VALUES ('testing1','Chotu and Problem1','2','6','3'),('testing2','Chotu and Problem2','1','3','25'),('testing3','Chotu and Problem3','1','1','9');
/*!40000 ALTER TABLE `problems_db` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-06 21:14:08
