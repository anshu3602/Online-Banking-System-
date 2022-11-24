-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 03:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `counting` ()   BEGIN
Select count(accno),ifsc from account group by ifsc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `countings` ()   BEGIN
Select count(accno),ifsc from account group by ifsc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getcategories` ()   BEGIN
    DECLARE tid,tamt TEXT;
    DECLARE exit_loop BOOLEAN DEFAULT FALSE;
    DECLARE category_cursor CURSOR FOR SELECT tid,tamt FROM fund_transfer;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop=TRUE;
    
    OPEN category_cursor;
    category_loop: LOOP
    		FETCH FROM category_cursor INTO tid,tamt;
            IF exit_loop THEN
            	LEAVE category_loop;
            END IF;
            IF tamt>='1000' THEN
            	SELECT tid;
            END IF;
    END LOOP category_loop;
    CLOSE category_cursor;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ACCNO` int(11) NOT NULL,
  `ATYPE` varchar(10) DEFAULT NULL,
  `AMOUNT` int(11) DEFAULT NULL,
  `IFSC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACCNO`, `ATYPE`, `AMOUNT`, `IFSC`) VALUES
(1001, 'FIXED', 10000, 'SBIN000002'),
(2001, 'SAVINGS', 20000, 'CNRB000002'),
(3001, 'SAVINGS', 10000, 'UTIB000002');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `BNAME` varchar(20) NOT NULL,
  `BLOC` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`BNAME`, `BLOC`) VALUES
('AXIS BANK', 'DELHI'),
('CANARA BANk', 'BANGALORE'),
('SBI', 'DELHI');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BNAME` varchar(20) NOT NULL,
  `BRLOC` varchar(20) DEFAULT NULL,
  `IFSC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BNAME`, `BRLOC`, `IFSC`) VALUES
('AXIS BANK', 'HYDREBAD', 'UTIB000002'),
('CANARA BANK', 'CHENNAI', 'CNRB000002'),
('SBI', 'BANGALORE', 'SBIN000002');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `CNO` int(11) NOT NULL,
  `CTYPE` varchar(10) DEFAULT NULL,
  `EXPDATE` date DEFAULT NULL,
  `CVV` varchar(3) DEFAULT NULL,
  `IFSC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`CNO`, `CTYPE`, `EXPDATE`, `CVV`, `IFSC`) VALUES
(22001, 'DEBIT', '0000-00-00', '122', 'CNRB000002'),
(12001, 'DEBIT', '0000-00-00', '111', 'SBIN000002'),
(32001, 'CREDIT', '0000-00-00', '133', 'UTIB000002');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `CUSID` varchar(10) NOT NULL,
  `PHNO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`CUSID`, `PHNO`) VALUES
('CNR001', 2147483647),
('SBI001', 2147483647),
('UTI001', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUSID` varchar(10) NOT NULL,
  `FNAME` varchar(10) DEFAULT NULL,
  `LNAME` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `ADDRESS` varchar(20) DEFAULT NULL,
  `IFSC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUSID`, `FNAME`, `LNAME`, `EMAIL`, `ADDRESS`, `IFSC`) VALUES
('CNR001', 'MOHAN', 'KUMAR', 'MOHANK@GMAIL.COM', 'CHENNAI', 'CNRB000002'),
('SBI001', 'ROHAN', 'KUMAR', 'ROHANK@GMAIL.COM', 'BANGALORE', 'SBIN000002'),
('UTI001', 'ASHOK', 'KUMAR', 'ASHOKK@GMAIL.COM', 'HYDERBAD', 'UTIB000002');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `customer_name` AFTER INSERT ON `customer` FOR EACH ROW BEGIN 
   UPDATE customer set full_name = fname || ' ' || lname;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fund_transfer`
--

CREATE TABLE `fund_transfer` (
  `tid` int(11) NOT NULL,
  `tamt` int(11) DEFAULT NULL,
  `IFSC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fund_transfer`
--

INSERT INTO `fund_transfer` (`tid`, `tamt`, `IFSC`) VALUES
(67345, 2000, 'CNR001001'),
(89723, 8000, 'SBI001001'),
(98123, 1000, 'UTI001001');

--
-- Triggers `fund_transfer`
--
DELIMITER $$
CREATE TRIGGER `before_update_tamt` BEFORE UPDATE ON `fund_transfer` FOR EACH ROW BEGIN DECLARE error_msg VARCHAR(255); SET error_msg = ('The new amount cannot be lesser than 1000'); IF new.tamt < 1000 THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error_msg; END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `CUSID` varchar(10) NOT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`CUSID`, `PASSWORD`) VALUES
('SBI001', '123451'),
('CNR001', '123452'),
('UTI001', '123453');

-- --------------------------------------------------------

--
-- Table structure for table `maintains`
--

CREATE TABLE `maintains` (
  `ACCNO` int(11) NOT NULL,
  `CUSID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintains`
--

INSERT INTO `maintains` (`ACCNO`, `CUSID`) VALUES
(1001, 'SBI001'),
(2001, 'CNR001'),
(3001, 'UTI001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ACCNO`,`IFSC`),
  ADD KEY `ACCNO` (`ACCNO`),
  ADD KEY `IFSC` (`IFSC`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`BNAME`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BNAME`,`IFSC`),
  ADD KEY `BNAME` (`BNAME`),
  ADD KEY `IFSC` (`IFSC`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`IFSC`),
  ADD KEY `IFSC` (`IFSC`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`CUSID`,`PHNO`),
  ADD KEY `CUSID` (`CUSID`),
  ADD KEY `PHNO` (`PHNO`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSID`,`IFSC`),
  ADD KEY `CUSID` (`CUSID`),
  ADD KEY `IFSC` (`IFSC`);

--
-- Indexes for table `fund_transfer`
--
ALTER TABLE `fund_transfer`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD KEY `CUSID` (`CUSID`);

--
-- Indexes for table `maintains`
--
ALTER TABLE `maintains`
  ADD PRIMARY KEY (`ACCNO`,`CUSID`),
  ADD KEY `ACCNO` (`ACCNO`),
  ADD KEY `CUSID` (`CUSID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`IFSC`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`BNAME`) REFERENCES `bank` (`BNAME`) ON DELETE CASCADE;

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`IFSC`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`CUSID`) REFERENCES `customer` (`CUSID`) ON DELETE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`IFSC`) REFERENCES `branch` (`IFSC`) ON DELETE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`CUSID`) REFERENCES `customer` (`CUSID`) ON DELETE CASCADE;

--
-- Constraints for table `maintains`
--
ALTER TABLE `maintains`
  ADD CONSTRAINT `maintains_ibfk_1` FOREIGN KEY (`ACCNO`) REFERENCES `account` (`ACCNO`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintains_ibfk_2` FOREIGN KEY (`CUSID`) REFERENCES `customer` (`CUSID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

