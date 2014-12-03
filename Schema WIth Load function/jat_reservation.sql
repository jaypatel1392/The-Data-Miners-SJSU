CREATE DATABASE  IF NOT EXISTS `jat_reservation` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `jat_reservation`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: jat_reservation
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `cID` int(11) NOT NULL,
  `hID` int(11) NOT NULL,
  `rID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `ccNo` bigint(20) NOT NULL,
  `smoker` tinyint(1) NOT NULL DEFAULT '0',
  `rStartDate` date NOT NULL,
  `rEndDate` date NOT NULL,
  `discount` int(11) DEFAULT '0',
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cID`,`hID`),
  KEY `fk_Customer_Rooms1_idx` (`rID`,`hID`),
  CONSTRAINT `fk_Customer_Rooms1` FOREIGN KEY (`rID`, `hID`) REFERENCES `rooms` (`rID`, `hID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,1,1,'Bruce Wayne','9999 Main St. San Jose, CA 95131',111122223334,1,'2014-12-22','2014-12-30',0,'2014-11-17 01:10:53'),(1,2,1,'Loki','9999 Some Universer Asgard, OS 96131',111122223324,1,'2015-01-22','2015-01-30',5,'2014-11-17 01:10:53'),(1,3,1,'Anna','8888 Some Universer Asgard, OS 97131',111322223324,1,'2015-10-22','2015-10-30',15,'2014-11-17 01:10:53'),(1,4,1,'Sofia','8888 New York St. San Mateo, CA 95131',110022223324,1,'2015-01-20','2015-01-30',10,'2014-11-17 01:10:53'),(1,5,1,'Colton','777 Main St. San Jose, CA 95131',111120023334,1,'2014-12-20','2014-12-30',0,'2014-11-17 01:10:53'),(2,1,2,'Clark Kent','777 First St. Washington, MA 95131',111122223335,1,'2015-04-14','2015-04-30',10,'2014-11-17 01:10:53'),(2,2,2,'Iron Man','666 Universal Studios Anahiem, CA 978651',111122223315,1,'2015-06-14','2015-06-30',0,'2014-11-17 01:10:53'),(2,3,2,'Aaliyah','909 Universal Studios Anahiem, CA 978651',111132223315,1,'2015-11-14','2015-11-30',5,'2014-11-17 01:10:53'),(2,4,2,'Grace','707 Professor Oak Pokemon, LN 12345',111022223315,1,'2015-06-14','2015-06-20',10,'2014-11-17 01:10:53'),(2,5,2,'Jace','807 No St. Washington, MA 95131',111122223300,1,'2015-04-01','2015-04-30',0,'2014-11-17 01:10:53'),(3,1,6,'Diana','907 Second St. New York, NY 95131',111122223336,0,'2014-12-22','2014-12-30',0,'2014-11-17 01:10:53'),(3,2,6,'Super Man','888 California St. San Francisco, CA 95131',111122223339,0,'2015-12-22','2015-12-30',5,'2014-11-17 01:10:53'),(3,3,6,'Alexis','8888 California St. San Francisco, CA 95131',111123223339,0,'2015-09-22','2015-09-30',5,'2014-11-17 01:10:53'),(3,4,6,'Peyton','8888 Washington St. Gotham, NH 95131',110122223339,0,'2015-12-22','2015-12-25',10,'2014-11-17 01:10:53'),(3,5,6,'Angel','8888 Some St. New York, NY 95131',111002223336,0,'2015-11-22','2015-12-05',0,'2014-11-17 01:10:53');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `courtesyValet` 
AFTER INSERT ON `customer` 
FOR EACH ROW 
BEGIN 
IF(TIMESTAMPDIFF(DAY, NEW.rStartDate, NEW.rEndDate) >14 AND New.cID NOT IN (SELECT cID FROM parking))
THEN 
INSERT INTO parking (hID, valet, cID) 
VALUES (NEW.hID, 1, NEW.cID);
END IF; 
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `eID` int(11) NOT NULL,
  `hID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `position` varchar(30) NOT NULL,
  `salary` double NOT NULL DEFAULT '40000',
  PRIMARY KEY (`eID`,`hID`),
  KEY `fk_Employee_Hotels1_idx` (`hID`),
  CONSTRAINT `fk_Employee_Hotels1` FOREIGN KEY (`hID`) REFERENCES `hotels` (`hID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels` (
  `hID` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(50) NOT NULL,
  `location` varchar(250) NOT NULL,
  `totalrooms` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`hID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `managerlogin`
--

DROP TABLE IF EXISTS `managerlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `managerlogin` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `employee_eID` int(11) NOT NULL,
  `employee_hID` int(11) NOT NULL,
  PRIMARY KEY (`username`,`employee_eID`,`employee_hID`),
  KEY `fk_managerlogin_employee1_idx` (`employee_eID`,`employee_hID`),
  CONSTRAINT `fk_managerlogin_employee1` FOREIGN KEY (`employee_eID`, `employee_hID`) REFERENCES `employee` (`eID`, `hID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parking`
--

DROP TABLE IF EXISTS `parking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parking` (
  `pID` int(11) NOT NULL AUTO_INCREMENT,
  `hID` int(11) NOT NULL,
  `valet` tinyint(1) NOT NULL DEFAULT '1',
  `cID` int(11) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pID`,`hID`),
  KEY `fk_Parking_Customer1_idx` (`cID`,`hID`),
  CONSTRAINT `fk_Parking_Customer1` FOREIGN KEY (`cID`, `hID`) REFERENCES `customer` (`cID`, `hID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `ratingID` int(11) NOT NULL AUTO_INCREMENT,
  `hID` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `review` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ratingID`),
  KEY `fk_rating_hotels1_idx` (`hID`),
  CONSTRAINT `fk_rating_hotels1` FOREIGN KEY (`hID`) REFERENCES `hotels` (`hID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `rID` int(11) NOT NULL,
  `hID` int(11) NOT NULL,
  `smoking` tinyint(1) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '100',
  PRIMARY KEY (`rID`,`hID`),
  KEY `fk_Rooms_Hotels_idx` (`hID`),
  CONSTRAINT `fk_Rooms_Hotels` FOREIGN KEY (`hID`) REFERENCES `hotels` (`hID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOAD DATA LOCAL INFILE 'c:\\mysql\\customers.txt' INTO TABLE CUSTOMER;
LOAD DATA LOCAL INFILE 'c:\\mysql\\employee.txt' INTO TABLE EMPLOYEE;
LOAD DATA LOCAL INFILE 'c:\\mysql\\hotels.txt' INTO TABLE HOTELS;
LOAD DATA LOCAL INFILE 'c:\\mysql\\managerlogin.txt' INTO TABLE MANAGERLOGIN;
LOAD DATA LOCAL INFILE 'c:\\mysql\\rooms.txt' INTO TABLE ROOMS;

--
-- Temporary table structure for view `viewratings`
--

DROP TABLE IF EXISTS `viewratings`;
/*!50001 DROP VIEW IF EXISTS `viewratings`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `viewratings` (
  `companyName` tinyint NOT NULL,
  `rating` tinyint NOT NULL,
  `review` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'jat_reservation'
--
/*!50003 DROP PROCEDURE IF EXISTS `cancelReservation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelReservation`(IN sDate DATE, IN eDate DATE, IN hotel VARCHAR(50) CHARSET utf8, IN roomid INT, IN loc VARCHAR(50) CHARSET utf8)
BEGIN 
	DELETE FROM customer
	WHERE rID=roomid AND rStartDate=sDate AND rEndDate=eDate
	AND hID IN (SELECT hID FROM hotels WHERE companyName=hotel AND location=loc);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ComputeTotalPrice` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ComputeTotalPrice`(IN cID INT, IN hID INT, IN name VARCHAR(20), OUT price DOUBLE)
BEGIN
	Select ((r.price * (rEndDate - rStartDate)) - (r.price * (rEndDate - rStartDate) * (c.discount / 100))) INTO price
	From customer c natural join rooms r
	where c.cID = cID and c.hID = hID and c.name = name;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `rateHotel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `rateHotel`(IN hid INT, IN numstars INT, IN review VARCHAR(500) CHARSET utf8)
BEGIN 
	INSERT INTO rating (hID, rating, review)
	VALUES(hid, numstars, review);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `viewratings`
--

/*!50001 DROP TABLE IF EXISTS `viewratings`*/;
/*!50001 DROP VIEW IF EXISTS `viewratings`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `viewratings` AS select `hotels`.`companyName` AS `companyName`,`rating`.`rating` AS `rating`,`rating`.`review` AS `review` from (`rating` left join `hotels` on((`rating`.`hID` = `hotels`.`hID`))) order by `hotels`.`companyName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-02 16:10:46