-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 04:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `subject`, `teacher_id`, `year_level`) VALUES
(8, 'Mathematics', 6, 10),
(9, 'Physics', 7, 11),
(10, 'Chemistry', 8, 11),
(11, 'Biology', 9, 10),
(12, 'English', 10, 12),
(13, 'History', 11, 12),
(14, 'Geography', 12, 10),
(15, 'Physical Education', 13, 9),
(16, 'Computer Science', 14, 11),
(17, 'Art', 15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `day_of_week` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `section_id`, `class_id`, `day_of_week`, `start_time`, `end_time`) VALUES
(1, 1, 8, 'Monday', '08:00:00', '09:00:00'),
(2, 1, 9, 'Monday', '09:15:00', '10:15:00'),
(3, 1, 10, 'Monday', '10:30:00', '11:30:00'),
(4, 1, 11, 'Monday', '11:45:00', '12:45:00'),
(5, 1, 12, 'Tuesday', '08:00:00', '09:00:00'),
(6, 1, 13, 'Tuesday', '09:15:00', '10:15:00'),
(7, 1, 14, 'Tuesday', '10:30:00', '11:30:00'),
(8, 1, 15, 'Tuesday', '11:45:00', '12:45:00'),
(9, 1, 16, 'Wednesday', '08:00:00', '09:00:00'),
(10, 1, 17, 'Wednesday', '09:15:00', '10:15:00'),
(11, 2, 9, 'Monday', '08:00:00', '09:00:00'),
(12, 2, 10, 'Monday', '09:15:00', '10:15:00'),
(13, 2, 11, 'Monday', '10:30:00', '11:30:00'),
(14, 2, 12, 'Monday', '11:45:00', '12:45:00'),
(15, 2, 13, 'Tuesday', '08:00:00', '09:00:00'),
(16, 2, 14, 'Tuesday', '09:15:00', '10:15:00'),
(17, 2, 15, 'Tuesday', '10:30:00', '11:30:00'),
(18, 2, 16, 'Tuesday', '11:45:00', '12:45:00'),
(19, 2, 17, 'Wednesday', '08:00:00', '09:00:00'),
(20, 2, 8, 'Wednesday', '09:15:00', '10:15:00'),
(21, 3, 10, 'Monday', '08:00:00', '09:00:00'),
(22, 3, 11, 'Monday', '09:15:00', '10:15:00'),
(23, 3, 12, 'Monday', '10:30:00', '11:30:00'),
(24, 3, 13, 'Monday', '11:45:00', '12:45:00'),
(25, 3, 14, 'Tuesday', '08:00:00', '09:00:00'),
(26, 3, 15, 'Tuesday', '09:15:00', '10:15:00'),
(27, 3, 16, 'Tuesday', '10:30:00', '11:30:00'),
(28, 3, 17, 'Tuesday', '11:45:00', '12:45:00'),
(29, 3, 8, 'Wednesday', '08:00:00', '09:00:00'),
(30, 3, 9, 'Wednesday', '09:15:00', '10:15:00'),
(31, 4, 11, 'Monday', '08:00:00', '09:00:00'),
(32, 4, 12, 'Monday', '09:15:00', '10:15:00'),
(33, 4, 13, 'Monday', '10:30:00', '11:30:00'),
(34, 4, 14, 'Monday', '11:45:00', '12:45:00'),
(35, 4, 15, 'Tuesday', '08:00:00', '09:00:00'),
(36, 4, 16, 'Tuesday', '09:15:00', '10:15:00'),
(37, 4, 17, 'Tuesday', '10:30:00', '11:30:00'),
(38, 4, 8, 'Tuesday', '11:45:00', '12:45:00'),
(39, 4, 9, 'Wednesday', '08:00:00', '09:00:00'),
(40, 4, 10, 'Wednesday', '09:15:00', '10:15:00'),
(41, 5, 12, 'Monday', '08:00:00', '09:00:00'),
(42, 5, 13, 'Monday', '09:15:00', '10:15:00'),
(43, 5, 14, 'Monday', '10:30:00', '11:30:00'),
(44, 5, 15, 'Monday', '11:45:00', '12:45:00'),
(45, 5, 16, 'Tuesday', '08:00:00', '09:00:00'),
(46, 5, 17, 'Tuesday', '09:15:00', '10:15:00'),
(47, 5, 8, 'Tuesday', '10:30:00', '11:30:00'),
(48, 5, 9, 'Tuesday', '11:45:00', '12:45:00'),
(49, 5, 10, 'Wednesday', '08:00:00', '09:00:00'),
(50, 5, 11, 'Wednesday', '09:15:00', '10:15:00'),
(51, 6, 13, 'Monday', '08:00:00', '09:00:00'),
(52, 6, 14, 'Monday', '09:15:00', '10:15:00'),
(53, 6, 15, 'Monday', '10:30:00', '11:30:00'),
(54, 6, 16, 'Monday', '11:45:00', '12:45:00'),
(55, 6, 17, 'Tuesday', '08:00:00', '09:00:00'),
(56, 6, 8, 'Tuesday', '09:15:00', '10:15:00'),
(57, 6, 9, 'Tuesday', '10:30:00', '11:30:00'),
(58, 6, 10, 'Tuesday', '11:45:00', '12:45:00'),
(59, 6, 11, 'Wednesday', '08:00:00', '09:00:00'),
(60, 6, 12, 'Wednesday', '09:15:00', '10:15:00'),
(61, 7, 14, 'Monday', '08:00:00', '09:00:00'),
(62, 7, 15, 'Monday', '09:15:00', '10:15:00'),
(63, 7, 16, 'Monday', '10:30:00', '11:30:00'),
(64, 7, 17, 'Monday', '11:45:00', '12:45:00'),
(65, 7, 8, 'Tuesday', '08:00:00', '09:00:00'),
(66, 7, 9, 'Tuesday', '09:15:00', '10:15:00'),
(67, 7, 10, 'Tuesday', '10:30:00', '11:30:00'),
(68, 7, 11, 'Tuesday', '11:45:00', '12:45:00'),
(69, 7, 12, 'Wednesday', '08:00:00', '09:00:00'),
(70, 7, 13, 'Wednesday', '09:15:00', '10:15:00'),
(71, 8, 15, 'Monday', '08:00:00', '09:00:00'),
(72, 8, 16, 'Monday', '09:15:00', '10:15:00'),
(73, 8, 17, 'Monday', '10:30:00', '11:30:00'),
(74, 8, 8, 'Monday', '11:45:00', '12:45:00'),
(75, 8, 9, 'Tuesday', '08:00:00', '09:00:00'),
(76, 8, 10, 'Tuesday', '09:15:00', '10:15:00'),
(77, 8, 11, 'Tuesday', '10:30:00', '11:30:00'),
(78, 8, 12, 'Tuesday', '11:45:00', '12:45:00'),
(79, 8, 13, 'Wednesday', '08:00:00', '09:00:00'),
(80, 8, 14, 'Wednesday', '09:15:00', '10:15:00'),
(81, 9, 16, 'Monday', '08:00:00', '09:00:00'),
(82, 9, 17, 'Monday', '09:15:00', '10:15:00'),
(83, 9, 8, 'Monday', '10:30:00', '11:30:00'),
(84, 9, 9, 'Monday', '11:45:00', '12:45:00'),
(85, 9, 10, 'Tuesday', '08:00:00', '09:00:00'),
(86, 9, 11, 'Tuesday', '09:15:00', '10:15:00'),
(87, 9, 12, 'Tuesday', '10:30:00', '11:30:00'),
(88, 9, 13, 'Tuesday', '11:45:00', '12:45:00'),
(89, 9, 14, 'Wednesday', '08:00:00', '09:00:00'),
(90, 9, 15, 'Wednesday', '09:15:00', '10:15:00'),
(91, 10, 17, 'Monday', '08:00:00', '09:00:00'),
(92, 10, 8, 'Monday', '09:15:00', '10:15:00'),
(93, 10, 9, 'Monday', '10:30:00', '11:30:00'),
(94, 10, 10, 'Monday', '11:45:00', '12:45:00'),
(95, 10, 11, 'Tuesday', '08:00:00', '09:00:00'),
(96, 10, 12, 'Tuesday', '09:15:00', '10:15:00'),
(97, 10, 13, 'Tuesday', '10:30:00', '11:30:00'),
(98, 10, 14, 'Tuesday', '11:45:00', '12:45:00'),
(99, 10, 15, 'Wednesday', '08:00:00', '09:00:00'),
(100, 10, 16, 'Wednesday', '09:15:00', '10:15:00'),
(101, 11, 8, 'Monday', '08:00:00', '09:00:00'),
(102, 11, 9, 'Monday', '09:15:00', '10:15:00'),
(103, 11, 10, 'Monday', '10:30:00', '11:30:00'),
(104, 11, 11, 'Monday', '11:45:00', '12:45:00'),
(105, 11, 12, 'Tuesday', '08:00:00', '09:00:00'),
(106, 11, 13, 'Tuesday', '09:15:00', '10:15:00'),
(107, 11, 14, 'Tuesday', '10:30:00', '11:30:00'),
(108, 11, 15, 'Tuesday', '11:45:00', '12:45:00'),
(109, 11, 16, 'Wednesday', '08:00:00', '09:00:00'),
(110, 11, 17, 'Wednesday', '09:15:00', '10:15:00'),
(111, 12, 9, 'Monday', '08:00:00', '09:00:00'),
(112, 12, 10, 'Monday', '09:15:00', '10:15:00'),
(113, 12, 11, 'Monday', '10:30:00', '11:30:00'),
(114, 12, 12, 'Monday', '11:45:00', '12:45:00'),
(115, 12, 13, 'Tuesday', '08:00:00', '09:00:00'),
(116, 12, 14, 'Tuesday', '09:15:00', '10:15:00'),
(117, 12, 15, 'Tuesday', '10:30:00', '11:30:00'),
(118, 12, 16, 'Tuesday', '11:45:00', '12:45:00'),
(119, 12, 17, 'Wednesday', '08:00:00', '09:00:00'),
(120, 12, 8, 'Wednesday', '09:15:00', '10:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`) VALUES
(1, 'VNHS-7A'),
(2, 'VNHS-7B'),
(3, 'VNHS-8A'),
(4, 'VNHS-8B'),
(5, 'VNHS-9A'),
(6, 'VNHS-9B'),
(7, 'VNHS-10A'),
(8, 'VNHS-10B'),
(9, 'VNHS-11A'),
(10, 'VNHS-11B'),
(11, 'VNHS-12A'),
(12, 'VNHS-12B');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `grade_level` varchar(10) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `parent_names` varchar(200) DEFAULT NULL,
  `parent_contact` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `dob`, `gender`, `phone`, `home_address`, `grade_level`, `enrollment_date`, `parent_names`, `parent_contact`) VALUES
(20240003, 'richmond', 'vilaluz', '2004-03-18', 'male', '09826783648', 'bongabon , NE', 'grade 9', '2024-09-02', 'ella elionor ', '0945266378'),
(20240004, 'niko', 'boy hudlum', '2024-10-04', 'male', '346345346436', 'bangad cabanatuan', 'grade 8', '2024-10-05', 'nifa', '0984567348'),
(20240005, 'axel ', 'tampalan', '2024-10-06', 'male', '0942674862', 'bangad cabanatuan', 'Grade 8', '2024-10-06', 'emelio', '0984567348'),
(20240006, 'matt', 'slavador', '2000-10-06', 'male', '09684829411', 'bangad cabanatuan', 'grade 9', '2024-10-06', 'mercy bondoc', '0945266378'),
(20240007, '1', '1', '2024-10-24', 'male', '1', '1', '1', '2024-10-24', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`student_id`, `class_id`) VALUES
(20240004, 8),
(20240004, 9),
(20240004, 10),
(20240004, 11),
(20240004, 12),
(20240004, 13),
(20240004, 14),
(20240004, 15),
(20240004, 16),
(20240004, 17),
(20240005, 8),
(20240005, 9),
(20240005, 10),
(20240005, 11),
(20240005, 12),
(20240005, 13),
(20240005, 14),
(20240005, 15),
(20240005, 16),
(20240005, 17);

-- --------------------------------------------------------

--
-- Table structure for table `student_section`
--

CREATE TABLE `student_section` (
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_section`
--

INSERT INTO `student_section` (`student_id`, `section_id`) VALUES
(20240003, 7),
(20240004, 2),
(20240004, 7),
(20240004, 11),
(20240005, 1),
(20240005, 2),
(20240005, 7),
(20240005, 8);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `home_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `gender`, `subject`, `contact_info`, `home_address`, `username`, `password`) VALUES
(6, 'John Doe', 'Female', 'Mathematics', 'johndoe@example.com', '123 Main St', 'teacher6', 'pass6'),
(7, 'Jane Smith', 'Female', 'Physics', 'janesmith@example.com', '456 Elm St', 'teacher7', 'pass7'),
(8, 'Robert Johnson', 'Male', 'Chemistry', 'robertjohnson@example.com', '789 Oak St', 'teacher8', 'pass8'),
(9, 'Emily Davis', 'Female', 'Biology', 'emilydavis@example.com', '101 Pine St', 'teacher9', 'pass9'),
(10, 'Michael Wilson', 'Male', 'English', 'michaelwilson@example.com', '202 Maple St', 'teacher10', 'pass10'),
(11, 'Sarah Brown', 'Female', 'History', 'sarahbrown@example.com', '303 Cedar St', 'teacher11', 'pass11'),
(12, 'David Miller', 'Male', 'Geography', 'davidmiller@example.com', '404 Birch St', 'teacher12', 'pass12'),
(13, 'Jessica Moore', 'Female', 'Physical Education', 'jessicamoore@example.com', '505 Walnut St', 'teacher13', 'pass13'),
(14, 'William Taylor', 'Female', 'Computer Science', 'williamtaylor@example.com', '606 Cherry St', 'teacher14', 'pass14'),
(15, 'Sophia Anderson', 'Female', 'Art', 'sophiaanderson@example.com', '707 Ash St', 'teacher15', 'pass15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `fk_teacher` (`teacher_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`student_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `student_section`
--
ALTER TABLE `student_section`
  ADD PRIMARY KEY (`student_id`,`section_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20240008;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `student_class`
--
ALTER TABLE `student_class`
  ADD CONSTRAINT `student_class_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_class_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_section`
--
ALTER TABLE `student_section`
  ADD CONSTRAINT `student_section_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `student_section_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
