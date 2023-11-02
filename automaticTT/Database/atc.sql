-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2023 at 01:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_id` int(11) NOT NULL,
  `ad_name` varchar(50) NOT NULL,
  `ad_pass` varchar(50) NOT NULL,
  `ad_email` varchar(50) NOT NULL,
  `ad_pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_id`, `ad_name`, `ad_pass`, `ad_email`, `ad_pic`) VALUES
(1, 'Saksham', 'Saks2002@@', 'saksham@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(1, 'BCA'),
(2, 'CSE'),
(4, 'BBA'),
(5, 'BscIT');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_id` int(11) NOT NULL,
  `fac_name` varchar(50) NOT NULL,
  `fac_email` varchar(50) NOT NULL,
  `fac_pass` varchar(10) NOT NULL,
  `fac_mob` bigint(20) NOT NULL,
  `fac_add` varchar(100) NOT NULL,
  `fac_pic` varchar(100) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_id`, `fac_name`, `fac_email`, `fac_pass`, `fac_mob`, `fac_add`, `fac_pic`, `dep_id`, `sem_id`, `sub_id`) VALUES
(4, 'Kartik', 'kartik@gmail.com', '12345', 7027479087, 'kartik@gmail.com', '', 2, 15, 24);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `sem_id` int(11) NOT NULL,
  `sem_name` varchar(20) DEFAULT NULL,
  `dep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`sem_id`, `sem_name`, `dep_id`) VALUES
(1, '1st', 1),
(2, '2nd', 1),
(3, '1st', 2),
(7, '2nd', 2),
(8, '1st', 4),
(9, '2nd', 4),
(10, '1st', 5),
(12, '3rd', 1),
(13, 'Java', 0),
(14, '', 0),
(15, '7th', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(11) NOT NULL,
  `std_fname` varchar(50) NOT NULL,
  `std_lname` varchar(50) NOT NULL,
  `std_email` varchar(50) NOT NULL,
  `std_enrno` int(12) NOT NULL,
  `std_pass` varchar(20) NOT NULL,
  `std_mob` bigint(20) NOT NULL,
  `std_add` varchar(1000) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `std_div` varchar(5) NOT NULL,
  `std_dob` date NOT NULL,
  `std_pic` varchar(255) NOT NULL,
  `std_gender` enum('Male','Female') NOT NULL,
  `enr_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_fname`, `std_lname`, `std_email`, `std_enrno`, `std_pass`, `std_mob`, `std_add`, `dep_id`, `sem_id`, `std_div`, `std_dob`, `std_pic`, `std_gender`, `enr_date`) VALUES
(6, 'Harshit', 'Bhardwaj', 'harshit@gmail.com', 11202594, '11202594', 9499187818, 'YNR', 2, 15, 'A', '2001-02-08', '', 'Male', '2023-10-31'),
(7, 'Subodh', 'Kumar', 'subodh@gmail.com', 11202554, '11202554', 9128954838, 'Bihar', 2, 15, 'A', '2002-05-10', '', 'Male', '2023-10-31'),
(8, 'Kartik', 'Saini', 'kartik@gmail.com', 11202596, '11202596', 7027479087, 'YNR', 2, 15, 'A', '2002-10-28', '', 'Male', '2023-10-31'),
(9, 'Saksham', 'Singla', 'saksham@gmail.com', 11202718, '11202718', 7082158997, 'JIND (HARYANA)', 2, 15, 'A', '2002-11-10', '', 'Male', '2023-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) DEFAULT NULL,
  `sem_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `lec_per_week` int(11) NOT NULL,
  `lec_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`, `sem_id`, `dep_id`, `lec_per_week`, `lec_type`) VALUES
(1, 'Fundamentals of Programming C', 1, 1, 4, 'Theory'),
(2, 'Python', 2, 1, 5, 'Theory'),
(3, 'Fundamentals of Computer', 1, 1, 4, 'Theory'),
(5, 'Java', 12, 1, 5, 'Theory'),
(8, 'PHP', 2, 1, 5, 'Theory'),
(17, 'Fundamentals of Programming C', 1, 1, 1, 'Practical'),
(18, 'Fundamentals of Computer', 1, 1, 1, 'Practical'),
(19, 'Fundamentals of Web Development', 1, 1, 4, 'Theory'),
(20, 'Fundamentals of Web Development', 1, 1, 1, 'Practical'),
(21, 'Communication Skills', 1, 1, 4, 'Theory'),
(22, 'Mathematics', 1, 1, 4, 'Theory'),
(24, 'Blockchain', 15, 2, 3, 'Theory'),
(25, 'Modelling and Simulation', 15, 2, 3, 'Theory'),
(26, 'Programming Languages', 15, 2, 3, 'Theory'),
(27, 'Rural Developement', 15, 2, 3, 'Theory'),
(28, 'Infrastructure Developement', 15, 2, 3, 'Theory'),
(29, 'Integrated Project - II', 15, 2, 2, 'Practical'),
(30, 'Infosys SpringBoard', 15, 2, 1, 'Practical'),
(31, 'Library', 15, 2, 3, 'Theory'),
(32, 'PD', 15, 2, 3, 'Theory');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `tt_id` int(11) NOT NULL,
  `division` varchar(10) NOT NULL,
  `day` varchar(15) NOT NULL,
  `lecture_slot` varchar(50) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `lecture_type` varchar(50) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`tt_id`, `division`, `day`, `lecture_slot`, `subject_name`, `lecture_type`, `dep_id`, `sem_id`) VALUES
(4605, 'A', 'Monday', '1', 'Modelling and Simulation', 'Theory', 2, 15),
(4606, 'A', 'Monday', '2', 'Programming Languages', 'Theory', 2, 15),
(4607, 'A', 'Monday', '2', 'Infosys SpringBoard', 'Practical', 2, 15),
(4608, 'A', 'Monday', '7', 'LUNCH', 'Break', 2, 15),
(4609, 'A', 'Monday', '5', 'Library', 'Theory', 2, 15),
(4610, 'A', 'Monday', '6', 'Infrastructure Developement', 'Theory', 2, 15),
(4611, 'A', 'Tuesday', '1', 'Library', 'Theory', 2, 15),
(4612, 'A', 'Tuesday', '2', 'Infrastructure Developement', 'Theory', 2, 15),
(4613, 'A', 'Tuesday', '3', 'Blockchain', 'Theory', 2, 15),
(4614, 'A', 'Tuesday', '4', 'Programming Languages', 'Theory', 2, 15),
(4615, 'A', 'Tuesday', '7', 'LUNCH', 'Break', 2, 15),
(4616, 'A', 'Tuesday', '5', 'Rural Developement', 'Theory', 2, 15),
(4617, 'A', 'Tuesday', '6', '', '', 2, 15),
(4618, 'A', 'Wednesday', '1', 'Modelling and Simulation', 'Theory', 2, 15),
(4619, 'A', 'Wednesday', '2', 'Library', 'Theory', 2, 15),
(4620, 'A', 'Wednesday', '3', 'Infrastructure Developement', 'Theory', 2, 15),
(4621, 'A', 'Wednesday', '4', 'Programming Languages', 'Theory', 2, 15),
(4622, 'A', 'Wednesday', '7', 'LUNCH', 'Break', 2, 15),
(4623, 'A', 'Wednesday', '5', 'Rural Developement', 'Theory', 2, 15),
(4624, 'A', 'Wednesday', '6', 'Blockchain', 'Theory', 2, 15),
(4625, 'A', 'Thursday', '1', 'Blockchain', 'Theory', 2, 15),
(4626, 'A', 'Thursday', '2', 'PD', 'Theory', 2, 15),
(4627, 'A', 'Thursday', '2', 'Integrated Project - II', 'Practical', 2, 15),
(4628, 'A', 'Thursday', '7', 'LUNCH', 'Break', 2, 15),
(4629, 'A', 'Thursday', '5', 'Modelling and Simulation', 'Theory', 2, 15),
(4630, 'A', 'Thursday', '6', 'Rural Developement', 'Theory', 2, 15),
(4631, 'A', 'Friday', '1', 'PD', 'Theory', 2, 15),
(4632, 'A', 'Friday', '1.5', 'Integrated Project - II', 'Practical', 2, 15),
(4633, 'A', 'Friday', '4', 'PD', 'Theory', 2, 15),
(4634, 'A', 'Friday', '7', 'LUNCH', 'Break', 2, 15),
(4635, 'A', 'Friday', '5', '', '', 2, 15),
(4636, 'A', 'Friday', '6', '', '', 2, 15),
(4637, 'B', 'Monday', '1', 'Library', 'Theory', 2, 15),
(4638, 'B', 'Monday', '2', 'Modelling and Simulation', 'Theory', 2, 15),
(4639, 'B', 'Monday', '3', 'Rural Developement', 'Theory', 2, 15),
(4640, 'B', 'Monday', '4', 'Programming Languages', 'Theory', 2, 15),
(4641, 'B', 'Monday', '7', 'LUNCH', 'Break', 2, 15),
(4642, 'B', 'Monday', '5', 'Blockchain', 'Theory', 2, 15),
(4643, 'B', 'Monday', '6', '', '', 2, 15),
(4644, 'B', 'Tuesday', '1', 'Library', 'Theory', 2, 15),
(4645, 'B', 'Tuesday', '2', 'Infrastructure Developement', 'Theory', 2, 15),
(4646, 'B', 'Tuesday', '3', 'Modelling and Simulation', 'Theory', 2, 15),
(4647, 'B', 'Tuesday', '4', 'PD', 'Theory', 2, 15),
(4648, 'B', 'Tuesday', '7', 'LUNCH', 'Break', 2, 15),
(4649, 'B', 'Tuesday', '5', 'Programming Languages', 'Theory', 2, 15),
(4650, 'B', 'Tuesday', '6', '', '', 2, 15),
(4651, 'B', 'Wednesday', '1', 'Library', 'Theory', 2, 15),
(4652, 'B', 'Wednesday', '2', 'Infrastructure Developement', 'Theory', 2, 15),
(4653, 'B', 'Wednesday', '3', 'Programming Languages', 'Theory', 2, 15),
(4654, 'B', 'Wednesday', '4', 'Modelling and Simulation', 'Theory', 2, 15),
(4655, 'B', 'Wednesday', '7', 'LUNCH', 'Break', 2, 15),
(4656, 'B', 'Wednesday', '3', 'Integrated Project - II', 'Practical', 2, 15),
(4657, 'B', 'Thursday', '1', 'Rural Developement', 'Theory', 2, 15),
(4658, 'B', 'Thursday', '2', 'PD', 'Theory', 2, 15),
(4659, 'B', 'Thursday', '3', 'Blockchain', 'Theory', 2, 15),
(4660, 'B', 'Thursday', '4', 'Infrastructure Developement', 'Theory', 2, 15),
(4661, 'B', 'Thursday', '7', 'LUNCH', 'Break', 2, 15),
(4662, 'B', 'Thursday', '3', 'Integrated Project - II', 'Practical', 2, 15),
(4663, 'B', 'Friday', '1', 'Blockchain', 'Theory', 2, 15),
(4664, 'B', 'Friday', '1.5', 'Infosys SpringBoard', 'Practical', 2, 15),
(4665, 'B', 'Friday', '4', 'PD', 'Theory', 2, 15),
(4666, 'B', 'Friday', '7', 'LUNCH', 'Break', 2, 15),
(4667, 'B', 'Friday', '5', 'Rural Developement', 'Theory', 2, 15),
(4668, 'B', 'Friday', '6', '', '', 2, 15),
(4669, 'C', 'Monday', '1', 'Blockchain', 'Theory', 2, 15),
(4670, 'C', 'Monday', '2', 'PD', 'Theory', 2, 15),
(4671, 'C', 'Monday', '3', 'Programming Languages', 'Theory', 2, 15),
(4672, 'C', 'Monday', '4', 'Infrastructure Developement', 'Theory', 2, 15),
(4673, 'C', 'Monday', '7', 'LUNCH', 'Break', 2, 15),
(4674, 'C', 'Monday', '5', '', '', 2, 15),
(4675, 'C', 'Monday', '6', '', '', 2, 15),
(4676, 'C', 'Tuesday', '1', 'Programming Languages', 'Theory', 2, 15),
(4677, 'C', 'Tuesday', '2', 'Blockchain', 'Theory', 2, 15),
(4678, 'C', 'Tuesday', '3', 'Infrastructure Developement', 'Theory', 2, 15),
(4679, 'C', 'Tuesday', '4', 'Library', 'Theory', 2, 15),
(4680, 'C', 'Tuesday', '7', 'LUNCH', 'Break', 2, 15),
(4681, 'C', 'Tuesday', '5', 'PD', 'Theory', 2, 15),
(4682, 'C', 'Tuesday', '6', 'Modelling and Simulation', 'Theory', 2, 15),
(4683, 'C', 'Wednesday', '1', 'Library', 'Theory', 2, 15),
(4684, 'C', 'Wednesday', '2', 'Infrastructure Developement', 'Theory', 2, 15),
(4685, 'C', 'Wednesday', '3', 'Modelling and Simulation', 'Theory', 2, 15),
(4686, 'C', 'Wednesday', '4', 'Programming Languages', 'Theory', 2, 15),
(4687, 'C', 'Wednesday', '7', 'LUNCH', 'Break', 2, 15),
(4688, 'C', 'Wednesday', '3', 'Integrated Project - II', 'Practical', 2, 15),
(4689, 'C', 'Thursday', '1', 'Rural Developement', 'Theory', 2, 15),
(4690, 'C', 'Thursday', '2', 'PD', 'Theory', 2, 15),
(4691, 'C', 'Thursday', '2', 'Infosys SpringBoard', 'Practical', 2, 15),
(4692, 'C', 'Thursday', '7', 'LUNCH', 'Break', 2, 15),
(4693, 'C', 'Thursday', '3', 'Integrated Project - II', 'Practical', 2, 15),
(4694, 'C', 'Friday', '1', 'Blockchain', 'Theory', 2, 15),
(4695, 'C', 'Friday', '2', 'Library', 'Theory', 2, 15),
(4696, 'C', 'Friday', '3', 'Rural Developement', 'Theory', 2, 15),
(4697, 'C', 'Friday', '4', 'Modelling and Simulation', 'Theory', 2, 15),
(4698, 'C', 'Friday', '7', 'LUNCH', 'Break', 2, 15),
(4699, 'C', 'Friday', '5', '', '', 2, 15),
(4700, 'C', 'Friday', '6', '', '', 2, 15),
(4701, 'D', 'Monday', '1', 'Library', 'Theory', 2, 15),
(4702, 'D', 'Monday', '1.5', 'Integrated Project - II', 'Practical', 2, 15),
(4703, 'D', 'Monday', '4', 'Modelling and Simulation', 'Theory', 2, 15),
(4704, 'D', 'Monday', '7', 'LUNCH', 'Break', 2, 15),
(4705, 'D', 'Monday', '5', 'Infrastructure Developement', 'Theory', 2, 15),
(4706, 'D', 'Monday', '6', 'Rural Developement', 'Theory', 2, 15),
(4707, 'D', 'Tuesday', '1', 'Infrastructure Developement', 'Theory', 2, 15),
(4708, 'D', 'Tuesday', '2', 'Modelling and Simulation', 'Theory', 2, 15),
(4709, 'D', 'Tuesday', '3', 'Library', 'Theory', 2, 15),
(4710, 'D', 'Tuesday', '4', 'Programming Languages', 'Theory', 2, 15),
(4711, 'D', 'Tuesday', '7', 'LUNCH', 'Break', 2, 15),
(4712, 'D', 'Tuesday', '5', 'Blockchain', 'Theory', 2, 15),
(4713, 'D', 'Tuesday', '6', '', '', 2, 15),
(4714, 'D', 'Wednesday', '1', 'Modelling and Simulation', 'Theory', 2, 15),
(4715, 'D', 'Wednesday', '1.5', 'Infosys SpringBoard', 'Practical', 2, 15),
(4716, 'D', 'Wednesday', '4', 'Library', 'Theory', 2, 15),
(4717, 'D', 'Wednesday', '7', 'LUNCH', 'Break', 2, 15),
(4718, 'D', 'Wednesday', '5', 'Rural Developement', 'Theory', 2, 15),
(4719, 'D', 'Wednesday', '6', 'Infrastructure Developement', 'Theory', 2, 15),
(4720, 'D', 'Thursday', '1', 'PD', 'Theory', 2, 15),
(4721, 'D', 'Thursday', '2', 'Rural Developement', 'Theory', 2, 15),
(4722, 'D', 'Thursday', '2', 'Integrated Project - II', 'Practical', 2, 15),
(4723, 'D', 'Thursday', '7', 'LUNCH', 'Break', 2, 15),
(4724, 'D', 'Thursday', '5', 'Blockchain', 'Theory', 2, 15),
(4725, 'D', 'Thursday', '6', 'Programming Languages', 'Theory', 2, 15),
(4726, 'D', 'Friday', '1', 'Blockchain', 'Theory', 2, 15),
(4727, 'D', 'Friday', '2', 'PD', 'Theory', 2, 15),
(4728, 'D', 'Friday', '3', 'Programming Languages', 'Theory', 2, 15),
(4729, 'D', 'Friday', '4', '', '', 2, 15),
(4730, 'D', 'Friday', '7', 'LUNCH', 'Break', 2, 15),
(4731, 'D', 'Friday', '5', '', '', 2, 15),
(4732, 'D', 'Friday', '6', '', '', 2, 15),
(4733, 'E', 'Monday', '1', 'Infrastructure Developement', 'Theory', 2, 15),
(4734, 'E', 'Monday', '1.5', 'Infosys SpringBoard', 'Practical', 2, 15),
(4735, 'E', 'Monday', '4', 'Programming Languages', 'Theory', 2, 15),
(4736, 'E', 'Monday', '7', 'LUNCH', 'Break', 2, 15),
(4737, 'E', 'Monday', '5', 'Modelling and Simulation', 'Theory', 2, 15),
(4738, 'E', 'Monday', '6', '', '', 2, 15),
(4739, 'E', 'Tuesday', '1', 'Library', 'Theory', 2, 15),
(4740, 'E', 'Tuesday', '2', 'Blockchain', 'Theory', 2, 15),
(4741, 'E', 'Tuesday', '3', 'Rural Developement', 'Theory', 2, 15),
(4742, 'E', 'Tuesday', '4', 'PD', 'Theory', 2, 15),
(4743, 'E', 'Tuesday', '7', 'LUNCH', 'Break', 2, 15),
(4744, 'E', 'Tuesday', '5', 'Infrastructure Developement', 'Theory', 2, 15),
(4745, 'E', 'Tuesday', '6', 'Modelling and Simulation', 'Theory', 2, 15),
(4746, 'E', 'Wednesday', '1', 'Blockchain', 'Theory', 2, 15),
(4747, 'E', 'Wednesday', '2', 'Infrastructure Developement', 'Theory', 2, 15),
(4748, 'E', 'Wednesday', '3', 'Library', 'Theory', 2, 15),
(4749, 'E', 'Wednesday', '4', 'Modelling and Simulation', 'Theory', 2, 15),
(4750, 'E', 'Wednesday', '7', 'LUNCH', 'Break', 2, 15),
(4751, 'E', 'Wednesday', '5', 'Programming Languages', 'Theory', 2, 15),
(4752, 'E', 'Wednesday', '6', 'Rural Developement', 'Theory', 2, 15),
(4753, 'E', 'Thursday', '1', 'Programming Languages', 'Theory', 2, 15),
(4754, 'E', 'Thursday', '2', 'Blockchain', 'Theory', 2, 15),
(4755, 'E', 'Thursday', '2', 'Integrated Project - II', 'Practical', 2, 15),
(4756, 'E', 'Thursday', '7', 'LUNCH', 'Break', 2, 15),
(4757, 'E', 'Thursday', '5', 'PD', 'Theory', 2, 15),
(4758, 'E', 'Thursday', '6', 'Rural Developement', 'Theory', 2, 15),
(4759, 'E', 'Friday', '1', 'Library', 'Theory', 2, 15),
(4760, 'E', 'Friday', '2', 'PD', 'Theory', 2, 15),
(4761, 'E', 'Friday', '2', 'Integrated Project - II', 'Practical', 2, 15),
(4762, 'E', 'Friday', '7', 'LUNCH', 'Break', 2, 15),
(4763, 'E', 'Friday', '5', '', '', 2, 15),
(4764, 'E', 'Friday', '6', '', '', 2, 15),
(4765, 'F', 'Monday', '1', 'Infrastructure Developement', 'Theory', 2, 15),
(4766, 'F', 'Monday', '2', 'Programming Languages', 'Theory', 2, 15),
(4767, 'F', 'Monday', '2', 'Infosys SpringBoard', 'Practical', 2, 15),
(4768, 'F', 'Monday', '7', 'LUNCH', 'Break', 2, 15),
(4769, 'F', 'Monday', '5', 'Blockchain', 'Theory', 2, 15),
(4770, 'F', 'Monday', '6', '', '', 2, 15),
(4771, 'F', 'Tuesday', '1', 'Blockchain', 'Theory', 2, 15),
(4772, 'F', 'Tuesday', '2', 'PD', 'Theory', 2, 15),
(4773, 'F', 'Tuesday', '3', 'Infrastructure Developement', 'Theory', 2, 15),
(4774, 'F', 'Tuesday', '4', 'Programming Languages', 'Theory', 2, 15),
(4775, 'F', 'Tuesday', '7', 'LUNCH', 'Break', 2, 15),
(4776, 'F', 'Tuesday', '5', 'Modelling and Simulation', 'Theory', 2, 15),
(4777, 'F', 'Tuesday', '6', 'Rural Developement', 'Theory', 2, 15),
(4778, 'F', 'Wednesday', '1', 'Programming Languages', 'Theory', 2, 15),
(4779, 'F', 'Wednesday', '2', 'Infrastructure Developement', 'Theory', 2, 15),
(4780, 'F', 'Wednesday', '3', 'Library', 'Theory', 2, 15),
(4781, 'F', 'Wednesday', '4', 'Blockchain', 'Theory', 2, 15),
(4782, 'F', 'Wednesday', '7', 'LUNCH', 'Break', 2, 15),
(4783, 'F', 'Wednesday', '5', 'PD', 'Theory', 2, 15),
(4784, 'F', 'Wednesday', '6', '', '', 2, 15),
(4785, 'F', 'Thursday', '1', 'Modelling and Simulation', 'Theory', 2, 15),
(4786, 'F', 'Thursday', '2', 'Library', 'Theory', 2, 15),
(4787, 'F', 'Thursday', '2', 'Integrated Project - II', 'Practical', 2, 15),
(4788, 'F', 'Thursday', '7', 'LUNCH', 'Break', 2, 15),
(4789, 'F', 'Thursday', '5', 'Rural Developement', 'Theory', 2, 15),
(4790, 'F', 'Thursday', '6', 'PD', 'Theory', 2, 15),
(4791, 'F', 'Friday', '1', 'Library', 'Theory', 2, 15),
(4792, 'F', 'Friday', '2', 'Rural Developement', 'Theory', 2, 15),
(4793, 'F', 'Friday', '2', 'Integrated Project - II', 'Practical', 2, 15),
(4794, 'F', 'Friday', '7', 'LUNCH', 'Break', 2, 15),
(4795, 'F', 'Friday', '5', 'Modelling and Simulation', 'Theory', 2, 15),
(4796, 'F', 'Friday', '6', '', '', 2, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_id`),
  ADD UNIQUE KEY `eid` (`ad_email`),
  ADD KEY `user_name` (`ad_name`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);
ALTER TABLE `department` ADD FULLTEXT KEY `course_name` (`dep_name`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_id`),
  ADD UNIQUE KEY `eid` (`fac_email`),
  ADD KEY `department_id` (`dep_id`);
ALTER TABLE `faculty` ADD FULLTEXT KEY `name` (`fac_name`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`sem_id`),
  ADD KEY `course_id` (`dep_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `eid` (`std_email`),
  ADD KEY `department_id` (`dep_id`),
  ADD KEY `sem_id` (`sem_id`);
ALTER TABLE `student` ADD FULLTEXT KEY `name` (`std_fname`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `course_id` (`dep_id`),
  ADD KEY `sem_id` (`sem_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`tt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `tt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4797;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
