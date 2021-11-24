-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 05:09 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangayhealth_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_doctor_id` int(11) NOT NULL,
  `appointment_patient_id` int(11) NOT NULL,
  `appointment_patient_fname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_patient_mname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_patient_lname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_patient_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_patient_pnum` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_selected_date` date NOT NULL,
  `appointment_selected_time` int(11) NOT NULL,
  `appointment_selected_service` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_status` tinyint(4) NOT NULL,
  `appointment_reason` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_bool` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_old`
--

CREATE TABLE `appointment_old` (
  `appointment_id` int(11) NOT NULL,
  `appointment_user_id` int(11) NOT NULL,
  `appointment_doctor_id` int(11) NOT NULL,
  `appointment_service_id` int(11) NOT NULL,
  `appointment_consultation_id` int(11) NOT NULL,
  `appointment_consultation_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_start_datetime` datetime NOT NULL,
  `appointment_end_datetime` datetime NOT NULL,
  `appointment_date` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_status` tinyint(4) NOT NULL,
  `appointment_bool` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appointment_old`
--

INSERT INTO `appointment_old` (`appointment_id`, `appointment_user_id`, `appointment_doctor_id`, `appointment_service_id`, `appointment_consultation_id`, `appointment_consultation_type`, `appointment_start_datetime`, `appointment_end_datetime`, `appointment_date`, `appointment_status`, `appointment_bool`) VALUES
(1, 2, 3, 1, 0, 'Book Appointment', '2021-08-06 20:48:19', '2021-08-07 20:48:19', '', 1, 1),
(2, 2, 3, 1, 0, 'Walk-in Appointment', '2021-08-06 21:39:10', '2021-08-07 21:39:10', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `schedule_day` tinyint(4) NOT NULL,
  `schedule_start_time` time NOT NULL,
  `schedule_end_time` time NOT NULL,
  `schedule_time_interval` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_status` tinyint(4) NOT NULL,
  `schedule_bool` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`schedule_id`, `doctor_id`, `schedule_day`, `schedule_start_time`, `schedule_end_time`, `schedule_time_interval`, `schedule_status`, `schedule_bool`) VALUES
(8, 3, 1, '10:00:00', '11:00:00', '60', 1, 1),
(9, 3, 0, '10:00:00', '11:00:00', '60', 1, 1),
(10, 3, 2, '08:00:00', '11:00:00', '60', 1, 1),
(11, 3, 5, '08:00:00', '11:00:00', '60', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule_time`
--

CREATE TABLE `doctor_schedule_time` (
  `schedule_time_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `schedule_start_time` time NOT NULL,
  `schedule_end_time` time NOT NULL,
  `schedule_time_status` tinyint(4) NOT NULL,
  `schedule_time_bool` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_schedule_time`
--

INSERT INTO `doctor_schedule_time` (`schedule_time_id`, `schedule_id`, `schedule_start_time`, `schedule_end_time`, `schedule_time_status`, `schedule_time_bool`) VALUES
(18, 8, '10:00:00', '11:00:00', 60, 1),
(19, 10, '08:00:00', '09:00:00', 60, 1),
(20, 10, '09:00:00', '10:00:00', 60, 1),
(21, 10, '10:00:00', '11:00:00', 60, 1),
(22, 11, '08:00:00', '09:00:00', 60, 1),
(23, 11, '09:00:00', '10:00:00', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `medical_history_id` int(11) NOT NULL,
  `medical_history_user_id` int(11) NOT NULL,
  `medical_history_appointment_id` int(11) NOT NULL,
  `medical_history_patient_condition` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_consultation`
--

CREATE TABLE `online_consultation` (
  `online_consultation_id` int(11) NOT NULL,
  `online_consultation_user_id` int(11) NOT NULL,
  `online_consultation_message` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `online_consultation_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `service_description` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `service_description`) VALUES
(1, 'General Consultation', 'Regular Checkups ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_account_id` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_firstname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_middlename` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_lastname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_dob` date NOT NULL,
  `user_cnum` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` enum('Administrator','Patient','Doctor','Barangay Health Worker') COLLATE utf8_unicode_ci NOT NULL,
  `user_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `user_bool` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_account_id`, `user_email`, `user_password`, `user_firstname`, `user_middlename`, `user_lastname`, `user_dob`, `user_cnum`, `user_type`, `user_image`, `user_status`, `user_bool`) VALUES
(1, 'BH20210650', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Connie Rose', 'T', 'Torrente', '2021-06-20', '09254540012', 'Administrator', '../assets/img/profile_pictures/2021-10-04_1-41_cupcake2.jpg', 1, 1),
(2, 'BH20210800', 'patient@gmail.com', 'b39024efbc6de61976f585c8421c6bba', 'Nina Angelina', 'S', 'Morcilla', '2021-06-20', '09234567894', 'Patient', '../assets/img/profile_pictures/2021-10-02_profile-angelina.jpg', 1, 1),
(3, 'BH20210680', 'doctor@gmail.com', 'f9f16d97c90d8c6f2cab37bb6d1f1992', 'Remie Kaye', 'B', 'Pulmones', '2021-06-20', '09284561234', 'Doctor', '../assets/img/profile_pictures/2021-10-02_profile-remie.jpg', 1, 1),
(4, 'BH20210660', 'bhw@gmail.com', '6adcff9bb6c324d349dfd67c82e1e832', 'Gerald', 'S', 'Montoya', '2021-06-20', '09287154234', 'Barangay Health Worker', '../assets/img/profile_pictures/2021-10-02_profile-austin.jpg', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `appointment_old`
--
ALTER TABLE `appointment_old`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `doctor_schedule_time`
--
ALTER TABLE `doctor_schedule_time`
  ADD PRIMARY KEY (`schedule_time_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`medical_history_id`);

--
-- Indexes for table `online_consultation`
--
ALTER TABLE `online_consultation`
  ADD PRIMARY KEY (`online_consultation_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `appointment_old`
--
ALTER TABLE `appointment_old`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctor_schedule_time`
--
ALTER TABLE `doctor_schedule_time`
  MODIFY `schedule_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `medical_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_consultation`
--
ALTER TABLE `online_consultation`
  MODIFY `online_consultation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
