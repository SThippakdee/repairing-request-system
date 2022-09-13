-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2022 at 08:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repair_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

CREATE TABLE `device_type` (
  `type_id` int(10) NOT NULL COMMENT 'รหัสประเภทครุภัณฑ์',
  `type_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ประเภทครุภัณฑ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`type_id`, `type_name`) VALUES
(1, 'เครื่องคอมพิวเตอร์'),
(2, 'จอภาพ');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `req_id` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสรายการแจ้งซ่อม',
  `user_id` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผู้ขอรับบริการ',
  `service_id` int(10) DEFAULT NULL COMMENT 'รหัสบริการ',
  `type_id` int(10) DEFAULT NULL COMMENT 'รหัสประเภทครุภัณฑ์',
  `dev_serial` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หมายเลขครุภัณ์(ถ้ามี)',
  `req_date` date NOT NULL COMMENT 'วันที่ขอรับบริการ',
  `req_detail` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รายละเอียดปัญหาที่พบ',
  `req_status` set('รอดำเนินการ','กำลังดำเนินการ','ดำเนินการเสร็จสิ้น','ยกเลิกรายการ') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'รอดำเนินการ' COMMENT 'สถานะรายการแจ้งซ่อม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_servey`
--

CREATE TABLE `request_servey` (
  `ser_id` int(10) NOT NULL COMMENT 'รหัสการประเมิน',
  `req_id` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสรายการแจ้งซ่อม',
  `ser_date` date NOT NULL COMMENT 'วันที่ทำการประเมิน',
  `ser_average` float NOT NULL COMMENT 'ความพึงพอใจเฉลี่ย',
  `ser_feedback` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ข้อเสนอแนะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_solving`
--

CREATE TABLE `request_solving` (
  `solv_id` int(10) NOT NULL COMMENT 'รหัสบันทึกการดำเนินการ',
  `req_id` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสรายการแจ้งซ่อม',
  `solv_detail` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รายละเอียดการดำเนินการ',
  `solv_note` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุ',
  `user_id` varchar(17) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสผู้ตรวจสอบ',
  `solv_date` date NOT NULL COMMENT 'วันที่บันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servey_list`
--

CREATE TABLE `servey_list` (
  `list_id` int(10) NOT NULL COMMENT 'รหัสรายการประเมิน',
  `ser_id` int(10) NOT NULL COMMENT 'รหัสการประเมิน',
  `top_id` int(10) NOT NULL COMMENT 'รหัสหัวข้อการประเมิน',
  `list_rate` float NOT NULL COMMENT 'คะแนนประเมิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servey_topic`
--

CREATE TABLE `servey_topic` (
  `top_id` int(10) NOT NULL COMMENT 'รหัสหัวข้อการประเมิน',
  `top_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'หัวข้อการประเมิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servey_topic`
--

INSERT INTO `servey_topic` (`top_id`, `top_name`) VALUES
(1, 'ความรวดเร็วในการให้บริการของเจ้าหน้าที่'),
(2, 'ความรู้ความสามารถในการให้บริการของเจ้าหน้าที่');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(10) NOT NULL COMMENT 'รหัสบริการ',
  `service_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อบริการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผู้ใช้',
  `user_profile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-avatar.png' COMMENT 'รูปโปรไฟล์',
  `user_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อผู้ใช้',
  `user_lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'นามสกุลผู้ใช้',
  `user_tel` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'โทรศัพท์',
  `user_dep` int(5) DEFAULT NULL COMMENT 'รหัสหน่วยงาน/แผนก',
  `user_username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Username',
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผ่าน',
  `user_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'คีย์จดจำผู้ใช้',
  `user_level` int(2) DEFAULT 3 COMMENT 'สิทธิการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_profile`, `user_name`, `user_lastname`, `user_tel`, `user_dep`, `user_username`, `user_password`, `user_token`, `user_level`) VALUES
('USR-631db1cb646b1', 'default-avatar.png', 'สุรพัศ', 'ทิพย์ภักดี', '0648738153', NULL, 'surapat@admin', '$2y$10$/qKMzmniygX7VNoIJ4tP1eH2ax.9wjmuRKUa0ICNSa9A.W7I..WhC', '$2y$10$6/lDWVbSVJcKb52yIzzL/e5jDTREXB0Srl1IO9fhRR2ZaJWjefN1W', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_dep`
--

CREATE TABLE `user_dep` (
  `dep_id` int(5) NOT NULL COMMENT 'รหัสหน่วยงาน',
  `dep_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อหน่วยงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_dep`
--

INSERT INTO `user_dep` (`dep_id`, `dep_name`) VALUES
(1, 'เลขาหน้าห้องผู้อำนวยการฯ'),
(2, 'กลุ่มภารกิจอำนวยการ'),
(3, 'กลุ่มงานบริหารทั่วไป'),
(4, 'กลุ่มงานทรัพยากรบุคคล'),
(5, 'กลุ่มงานการเงินและบัญชี'),
(6, 'กลุ่มงานพัสดุ'),
(7, 'กลุ่มงานโครงสร้างพื้นฐานและวิศวกรรมทางการแพทย์'),
(8, 'กลุ่มงานสารนิเทศและประชาสัมพันธ์'),
(9, 'กลุ่มงานประกันสุขภาพ'),
(10, 'กลุ่มงานเทคโนโลยีสารสนเทศ'),
(11, 'กลุ่มงานยุทธศาสตร์และแผนงานโครงการ'),
(12, 'กลุ่มภารกิจบริการจิตเวชและสุขภาพจิต'),
(13, 'กลุ่มงานพัฒนาคุณภาพบริการและมาตรฐาน'),
(14, 'zzz');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` int(2) NOT NULL COMMENT 'รหัสสิทธิการใช้งาน',
  `level_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อเรียกสิทธิการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`) VALUES
(1, 'ผู้ดูแลระบบ'),
(2, 'ช่างซ่อมบำรุง'),
(3, 'ผู้ใช้ระบบ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device_type`
--
ALTER TABLE `device_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `request_servey`
--
ALTER TABLE `request_servey`
  ADD PRIMARY KEY (`ser_id`),
  ADD KEY `req_id` (`req_id`);

--
-- Indexes for table `request_solving`
--
ALTER TABLE `request_solving`
  ADD PRIMARY KEY (`solv_id`),
  ADD KEY `req_id` (`req_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `servey_list`
--
ALTER TABLE `servey_list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `top_id` (`top_id`),
  ADD KEY `ser_id` (`ser_id`);

--
-- Indexes for table `servey_topic`
--
ALTER TABLE `servey_topic`
  ADD PRIMARY KEY (`top_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_level` (`user_level`),
  ADD KEY `user_dep` (`user_dep`);

--
-- Indexes for table `user_dep`
--
ALTER TABLE `user_dep`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device_type`
--
ALTER TABLE `device_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทครุภัณฑ์', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_servey`
--
ALTER TABLE `request_servey`
  MODIFY `ser_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการประเมิน';

--
-- AUTO_INCREMENT for table `request_solving`
--
ALTER TABLE `request_solving`
  MODIFY `solv_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบันทึกการดำเนินการ';

--
-- AUTO_INCREMENT for table `servey_list`
--
ALTER TABLE `servey_list`
  MODIFY `list_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการประเมิน';

--
-- AUTO_INCREMENT for table `servey_topic`
--
ALTER TABLE `servey_topic`
  MODIFY `top_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหัวข้อการประเมิน', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบริการ';

--
-- AUTO_INCREMENT for table `user_dep`
--
ALTER TABLE `user_dep`
  MODIFY `dep_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหน่วยงาน', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสิทธิการใช้งาน', AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `device_type` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `request_servey`
--
ALTER TABLE `request_servey`
  ADD CONSTRAINT `request_servey_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `request` (`req_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_solving`
--
ALTER TABLE `request_solving`
  ADD CONSTRAINT `request_solving_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `request` (`req_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_solving_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `servey_list`
--
ALTER TABLE `servey_list`
  ADD CONSTRAINT `servey_list_ibfk_1` FOREIGN KEY (`top_id`) REFERENCES `servey_topic` (`top_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servey_list_ibfk_2` FOREIGN KEY (`ser_id`) REFERENCES `request_servey` (`ser_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_level`) REFERENCES `user_level` (`level_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_dep`) REFERENCES `user_dep` (`dep_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
