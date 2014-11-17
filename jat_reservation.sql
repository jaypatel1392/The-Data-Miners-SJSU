-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2014 at 02:25 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jat_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
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
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cID`, `hID`, `rID`, `name`, `address`, `ccNo`, `smoker`, `rStartDate`, `rEndDate`, `discount`, `updatedAt`) VALUES
(1, 1, 1, 'Bruce Wayne', '101 Main St. San Jose, CA, 95131', 111122223334, 1, '2014-12-22', '2014-12-30', 0, '2014-11-17 01:10:53'),
(1, 2, 1, 'Loki', '74012 Some Universer, Asgard, OS, 00000', 111122223324, 1, '2015-01-22', '2015-01-30', 5, '2014-11-17 01:10:53'),
(1, 3, 1, 'Anna', '05 Some Universer, Asgard, OS, 00000', 111322223324, 1, '2015-10-22', '2015-10-30', 15, '2014-11-17 01:10:53'),
(1, 4, 1, 'Sofia', '1123 New York St. San Mateo, CA, 95131', 110022223324, 1, '2015-01-20', '2015-01-30', 10, '2014-11-17 01:10:53'),
(1, 5, 1, 'Colton', '11 Main St. San Jose, CA, 95131', 111120023334, 1, '2014-12-20', '2014-12-30', 0, '2014-11-17 01:10:53'),
(2, 1, 2, 'Clark Kent', '100 First St. Washington, MA, 95131', 111122223335, 1, '2015-04-14', '2015-04-30', 10, '2014-11-17 01:10:53'),
(2, 2, 2, 'Iron Man', '74012 Universal Studios, Anahiem, CA, 978651', 111122223315, 1, '2015-06-14', '2015-06-30', 0, '2014-11-17 01:10:53'),
(2, 3, 2, 'Aaliyah', '01 Universal Studios, Anahiem, CA, 978651', 111132223315, 1, '2015-11-14', '2015-11-30', 5, '2014-11-17 01:10:53'),
(2, 4, 2, 'Grace', '4235 Professor Oak, Pokemon, LN, 12345', 111022223315, 1, '2015-06-14', '2015-06-20', 10, '2014-11-17 01:10:53'),
(2, 5, 2, 'Jace', '12 No St. Washington, MA, 95131', 111122223300, 1, '2015-04-01', '2015-04-30', 0, '2014-11-17 01:10:53'),
(3, 1, 6, 'Diana ', '200 Second St. New York, NY, 95131', 111122223336, 0, '2014-12-22', '2014-12-30', 0, '2014-11-17 01:10:53'),
(3, 2, 6, 'Super Man', '133 California St. San Francisco, CA, 95131', 111122223339, 0, '2015-12-22', '2015-12-30', 5, '2014-11-17 01:10:53'),
(3, 3, 6, 'Alexis', '200 California St. San Francisco, CA, 95131', 111123223339, 0, '2015-09-22', '2015-09-30', 5, '2014-11-17 01:10:53'),
(3, 4, 6, 'Peyton', '123 Washington St. Gotham, NH, 95131', 110122223339, 0, '2015-12-22', '2015-12-25', 10, '2014-11-17 01:10:53'),
(3, 5, 6, 'Angel', '20 Some St. New York, NY, 95131', 111002223336, 0, '2015-11-22', '2015-12-05', 0, '2014-11-17 01:10:53'),
(4, 1, 7, 'Tim Cook', '300 Third St. Newark, NJ, 95131', 111122223337, 0, '2015-04-14', '2015-04-30', 10, '2014-11-17 01:10:53'),
(4, 2, 7, 'Thor Of Asgard', '425 MiddleofNowhere, Hope, NJ, 95131', 111122223338, 0, '2015-04-14', '2015-04-30', 0, '2014-11-17 01:10:53'),
(4, 3, 7, 'Claire', '300 MiddleofNowhere, Hope, NJ, 95131', 111122233338, 0, '2015-03-14', '2015-03-30', 15, '2014-11-17 01:10:53'),
(4, 4, 7, 'Tyler', '425 MiddleofNowhere, Hope, NJ, 95131', 101122223338, 0, '2015-04-10', '2015-04-20', 10, '2014-11-17 01:10:53'),
(4, 5, 7, 'Dominic', '30 Third St. Newark, NJ, 95131', 110122223338, 0, '2015-12-14', '2015-12-30', 0, '2014-11-17 01:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `eID` int(11) NOT NULL,
  `hID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `position` varchar(30) NOT NULL,
  `salary` double NOT NULL DEFAULT '40000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eID`, `hID`, `name`, `position`, `salary`) VALUES
(1, 1, 'James', 'Owner', 100000),
(1, 2, 'George', 'Owner', 120000),
(1, 3, 'Jeff', 'Owner', 105000),
(1, 4, 'Joseph', 'Owner', 60000),
(1, 5, 'Kevin', 'Owner', 200000),
(2, 1, 'John', 'Manager', 60000),
(2, 2, 'Steven', 'Manager', 80000),
(2, 3, 'Lee', 'Manager', 65000),
(2, 4, 'Thomas', 'Manager', 50000),
(2, 5, 'Jason', 'Manager', 105000),
(3, 1, 'Robert', 'Regular', 40000),
(3, 2, 'Edward', 'Regular', 60000),
(3, 3, 'Ray', 'Regular', 45000),
(3, 4, 'Donald', 'Regular', 40000),
(3, 5, 'Gary', 'Regular', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE IF NOT EXISTS `hotels` (
`hID` int(11) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `location` varchar(250) NOT NULL,
  `totalrooms` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hID`, `companyName`, `location`, `totalrooms`) VALUES
(1, 'Hilton', 'San Francisco', 30),
(2, 'Marriott', 'New York', 50),
(3, 'Embassy Suites', 'Boston', 35),
(4, 'Hyatt ', 'Chicago', 20),
(5, 'Caesars Palace', 'Las Vegas', 60);

-- --------------------------------------------------------

--
-- Table structure for table `managerlogin`
--

CREATE TABLE IF NOT EXISTS `managerlogin` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `employee_eID` int(11) NOT NULL,
  `employee_hID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE IF NOT EXISTS `parking` (
  `pID` int(11) NOT NULL,
  `hID` int(11) NOT NULL,
  `valet` tinyint(1) NOT NULL DEFAULT '1',
  `cID` int(11) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`pID`, `hID`, `valet`, `cID`, `updatedAt`) VALUES
(1, 1, 1, 1, '2014-11-17 01:10:54'),
(1, 2, 1, 1, '2014-11-17 01:10:54'),
(1, 3, 1, 1, '2014-11-17 01:10:54'),
(1, 4, 1, 1, '2014-11-17 01:10:54'),
(1, 5, 1, 1, '2014-11-17 01:10:54'),
(2, 1, 1, 3, '2014-11-17 01:10:54'),
(2, 2, 1, 3, '2014-11-17 01:10:54'),
(2, 3, 1, 3, '2014-11-17 01:10:54'),
(2, 4, 1, 3, '2014-11-17 01:10:54'),
(2, 5, 1, 3, '2014-11-17 01:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
`rID` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `hID` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `review` varchar(500) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rID`, `cID`, `hID`, `rating`, `review`) VALUES
(1, 1, 1, 4, 'Great Place! '),
(2, 2, 1, 5, 'Awesome Stay'),
(3, 1, 2, 5, 'Very good! '),
(4, 3, 2, 5, 'Must stay here!'),
(5, 2, 3, 3, 'bit pricy!'),
(6, 3, 3, 3, 'expensive!'),
(7, 1, 4, 5, 'loved our stay! '),
(8, 3, 4, 5, 'Enjoyed a lot. '),
(9, 2, 5, 4, 'Expensive. Avoid at all cost'),
(10, 3, 5, 3, 'very expensive. I am poor now.');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `rID` int(11) NOT NULL,
  `hID` int(11) NOT NULL,
  `smoking` tinyint(1) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rID`, `hID`, `smoking`, `price`) VALUES
(1, 1, 1, 150),
(1, 2, 1, 175),
(1, 3, 1, 150),
(1, 4, 1, 125),
(1, 5, 1, 250),
(2, 1, 1, 150),
(2, 2, 1, 175),
(2, 3, 1, 150),
(2, 4, 1, 125),
(2, 5, 1, 250),
(3, 1, 1, 150),
(3, 2, 1, 175),
(3, 3, 1, 150),
(3, 4, 1, 125),
(3, 5, 1, 250),
(4, 1, 1, 150),
(4, 2, 1, 175),
(4, 3, 1, 150),
(4, 4, 1, 125),
(4, 5, 1, 250),
(5, 1, 1, 150),
(5, 2, 1, 175),
(5, 3, 1, 150),
(5, 4, 1, 125),
(5, 5, 1, 250),
(6, 1, 0, 125),
(6, 2, 0, 150),
(6, 3, 0, 125),
(6, 4, 0, 100),
(6, 5, 0, 225),
(7, 1, 0, 125),
(7, 2, 0, 150),
(7, 3, 0, 125),
(7, 4, 0, 100),
(7, 5, 0, 225),
(8, 1, 0, 125),
(8, 2, 0, 150),
(8, 3, 0, 125),
(8, 4, 0, 100),
(8, 5, 0, 225),
(9, 1, 0, 125),
(9, 2, 0, 150),
(9, 3, 0, 125),
(9, 4, 0, 100),
(9, 5, 0, 225),
(10, 1, 0, 125),
(10, 2, 0, 150),
(10, 3, 0, 125),
(10, 4, 0, 100),
(10, 5, 0, 225);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`cID`,`hID`), ADD KEY `fk_Customer_Rooms1_idx` (`rID`,`hID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`eID`,`hID`), ADD KEY `fk_Employee_Hotels1_idx` (`hID`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
 ADD PRIMARY KEY (`hID`);

--
-- Indexes for table `managerlogin`
--
ALTER TABLE `managerlogin`
 ADD PRIMARY KEY (`username`,`employee_eID`,`employee_hID`), ADD KEY `fk_managerlogin_employee1_idx` (`employee_eID`,`employee_hID`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
 ADD PRIMARY KEY (`pID`,`hID`), ADD KEY `fk_Parking_Customer1_idx` (`cID`,`hID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
 ADD PRIMARY KEY (`rID`), ADD KEY `fk_Rating_Customer1_idx` (`cID`,`hID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`rID`,`hID`), ADD KEY `fk_Rooms_Hotels_idx` (`hID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
MODIFY `hID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
MODIFY `rID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
ADD CONSTRAINT `fk_Customer_Rooms1` FOREIGN KEY (`rID`, `hID`) REFERENCES `rooms` (`rID`, `hID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
ADD CONSTRAINT `fk_Employee_Hotels1` FOREIGN KEY (`hID`) REFERENCES `hotels` (`hID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `managerlogin`
--
ALTER TABLE `managerlogin`
ADD CONSTRAINT `fk_managerlogin_employee1` FOREIGN KEY (`employee_eID`, `employee_hID`) REFERENCES `employee` (`eID`, `hID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `parking`
--
ALTER TABLE `parking`
ADD CONSTRAINT `fk_Parking_Customer1` FOREIGN KEY (`cID`, `hID`) REFERENCES `customer` (`cID`, `hID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
ADD CONSTRAINT `fk_Rating_Customer1` FOREIGN KEY (`cID`, `hID`) REFERENCES `customer` (`cID`, `hID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
ADD CONSTRAINT `fk_Rooms_Hotels` FOREIGN KEY (`hID`) REFERENCES `hotels` (`hID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
