-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3316
-- Generation Time: Apr 17, 2019 at 09:35 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fac_leave_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `applies`
--

CREATE TABLE `applies` (
  `leave_id` int(11) NOT NULL,
  `emp_id` char(8) NOT NULL,
  `Reason` varchar(30) NOT NULL,
  `Fdate` date NOT NULL,
  `Tdate` date NOT NULL,
  `No_of_days` int(11) NOT NULL,
  `branch` varchar(4) NOT NULL,
  `type` char(2) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applies`
--

INSERT INTO `applies` (`leave_id`, `emp_id`, `Reason`, `Fdate`, `Tdate`, `No_of_days`, `branch`, `type`, `status`) VALUES
(4, 'ANIL0002', 'Fever', '2019-03-31', '2019-04-02', 2, 'CSE', 'CL', 'APPROVED'),
(5, 'ANIL0005', 'Paper Correction', '2019-05-04', '2019-05-05', 1, 'EEE', 'OD', 'APPROVED'),
(6, 'ANIL0002', 'Fever', '2019-10-03', '2019-10-04', 1, 'CSE', 'CL', 'APPROVED'),
(7, 'ANIL0005', 'Paper correction', '2019-05-03', '2019-05-04', 1, 'EEE', 'OD', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` char(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `branch` varchar(4) NOT NULL,
  `type` varchar(2) NOT NULL,
  `desig` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` char(10) NOT NULL,
  `DOJ` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `name`, `branch`, `type`, `desig`, `email`, `mobile`, `DOJ`) VALUES
('ANIL0001', 'sivaranjani', 'CSE', 'T', 'HOD', 'sivaranjani.cse@anits.edu.in', '8899889988', '2016-06-11'),
('ANIL0002', 'K Chandrashekar', 'CSE', 'T', 'Ass. Prof', 'kchandrashekar@anits.edu.in', '7755339955', '2013-06-12'),
('ANIL0003', 'Likith', 'CSE', 'T', 'Ass.Prof', 'likith.cse@gmail.com', '4569856859', '2013-06-11'),
('ANIL0004', 'administrator', 'ADM', 'NT', 'ADMIN', 'admin.anits@anits.edu.in', '7899874547', '2013-01-09'),
('ANIL0005', 'someone', 'EEE', 'T', 'Ass.Prof', '0005@anits.edu.in', '9966458855', '2011-06-14'),
('ANIL0006', 'EEEHOD', 'EEE', 'T', 'HOD', 'triodefective@gmail.com', '9871269562', '2014-08-25'),
('ANIL0007', 'principal', 'ADM', 'NT', 'PRIN', 'principal@anits.edu.in', '7777777777', '2012-06-11');

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `NumOfLeaves` AFTER INSERT ON `employee` FOR EACH ROW IF new.type LIKE 'T' THEN
	INSERT INTO leaves values(new.emp_id,8,12,5,10);
ELSEIF new.type LIKE 'NT' THEN
	INSERT INTO leaves values(new.emp_id,10,7,0,0);
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `toHOD` BEFORE INSERT ON `employee` FOR EACH ROW begin
if new.desig like 'HOD' then
insert into HOD values(new.emp_id,new.branch,new.name,new.email,new.mobile);
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `forwards`
--

CREATE TABLE `forwards` (
  `leave_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forwards_to_admin`
--

CREATE TABLE `forwards_to_admin` (
  `HOD_id` char(8) NOT NULL,
  `leave_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `HOD_id` char(8) NOT NULL,
  `branch` varchar(4) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`HOD_id`, `branch`, `Name`, `email`, `mobile`) VALUES
('ANIL0001', 'CSE', 'sivaranjani', 'sivaranjani.cse@anits.edu.in', '8899889988'),
('ANIL0006', 'EEE', 'EEEHOD', 'triodefective@gmail.com', '9871269562');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `emp_id` char(8) NOT NULL,
  `CL` float DEFAULT NULL,
  `EL` float DEFAULT NULL,
  `AL` float DEFAULT NULL,
  `OD` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`emp_id`, `CL`, `EL`, `AL`, `OD`) VALUES
('ANIL0001', 6, 8, 5, 6),
('ANIL0002', 3, 8, 1, 6),
('ANIL0003', 6, 12, 1, 1),
('ANIL0004', 10, 7, 0, 0),
('ANIL0005', 2, 12, 5, 8),
('ANIL0006', 8, 12, 5, 10),
('ANIL0007', 10, 7, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('ANIL0001', 'iamhod'),
('ANIL0002', '0002'),
('ANIL0003', '0003'),
('ANIL0004', '0004'),
('ANIL0005', '0005'),
('ANIL0006', '0006'),
('ANIL0007', '0007');

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `leave_id` int(11) NOT NULL,
  `status` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applies`
--
ALTER TABLE `applies`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `applies_fk_eID` (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `forwards`
--
ALTER TABLE `forwards`
  ADD KEY `for_leave` (`leave_id`);

--
-- Indexes for table `forwards_to_admin`
--
ALTER TABLE `forwards_to_admin`
  ADD KEY `for_to_admin_leave` (`leave_id`),
  ADD KEY `for_to_admin_hod` (`HOD_id`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`HOD_id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `branch` (`branch`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD KEY `princi_leave` (`leave_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applies`
--
ALTER TABLE `applies`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applies`
--
ALTER TABLE `applies`
  ADD CONSTRAINT `applies_fk_eID` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `forwards`
--
ALTER TABLE `forwards`
  ADD CONSTRAINT `for_leave` FOREIGN KEY (`leave_id`) REFERENCES `applies` (`leave_id`);

--
-- Constraints for table `forwards_to_admin`
--
ALTER TABLE `forwards_to_admin`
  ADD CONSTRAINT `for_to_admin_hod` FOREIGN KEY (`HOD_id`) REFERENCES `hod` (`HOD_id`),
  ADD CONSTRAINT `for_to_admin_leave` FOREIGN KEY (`leave_id`) REFERENCES `applies` (`leave_id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leave_fk_eID` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `principal`
--
ALTER TABLE `principal`
  ADD CONSTRAINT `princi_leave` FOREIGN KEY (`leave_id`) REFERENCES `applies` (`leave_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
