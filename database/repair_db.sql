-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2022 at 07:58 PM
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
(2, 'จอภาพ'),
(3, 'อุปกรณ์ต่อพ่วง'),
(4, 'เครื่องสำรองไฟ'),
(5, 'Printer'),
(6, 'Router');

-- --------------------------------------------------------

--
-- Table structure for table `notify_setting`
--

CREATE TABLE `notify_setting` (
  `noti_id` int(5) NOT NULL,
  `noti_token` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noti_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noti_active` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_setting`
--

INSERT INTO `notify_setting` (`noti_id`, `noti_token`, `noti_type`, `noti_active`) VALUES
(1, '2gzP4iAJKFyqt7wbnfSvnY6SVQImD25nznjZIZ32JRG', 'insert', 'on');

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

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`req_id`, `user_id`, `service_id`, `type_id`, `dev_serial`, `req_date`, `req_detail`, `req_status`) VALUES
('REQ-63244aa988ef', 'USR-631db1cb646b1', 3, 1, 'COM-874755', '2022-08-31', 'สาย LAN ชำรุดเสียหาย', 'กำลังดำเนินการ'),
('REQ-63244aa988ei', 'USR-631db1cb646b1', 3, 1, 'COM-104877', '2022-08-31', 'ไดร์เวอร์การ์ด Wifi หาย ขึ้นข้อความ This device cannot start. (code 10) ใน device manager', 'รอดำเนินการ'),
('REQ-63244c43ab02b', 'USR-631db1cb646b1', 1, 1, 'COM-100342', '2022-09-16', 'บูทเครื่องไม่ติด วนซ้ำหน้า Starting Window', 'กำลังดำเนินการ'),
('REQ-63244c8967c86', 'USR-631db1cb646b1', 2, 3, '', '2022-09-16', 'คีย์บอร์ด คอมคอมพิวเตอร์เครื่อง 3  ห้องออฟฟิศกลุ่มงานเวชระเบียน พิมพ์ไม่ติด แต่มีไฟสถานะขึ้นปรกติ', 'รอดำเนินการ'),
('REQ-63244cb68a7c3', 'USR-631db1cb646b1', 3, 1, 'COM-100452', '2022-09-16', 'เชื่อมต่ออินเตอร์เน็ตไม่ได้', 'ดำเนินการเสร็จสิ้น'),
('REQ-632451332b014', 'USR-631db1cb646b1', 1, 4, '', '2022-09-16', 'ไฟชาร์จไม่เข้า มีเสียงแจ้งเตือนเมื่อใช้งาน', 'รอดำเนินการ'),
('REQ-6325706bd2c41', 'USR-63252e59ddd51', 1, 3, '', '2022-09-17', 'เมาส์เลื่อนไม่ได้ ไม่มีไฟแม้จะเสียบสาย USB', 'ยกเลิกรายการ'),
('REQ-6326b99ea5db6', 'USR-63269481200d4', 2, 3, '', '2022-09-18', 'สายคีย์บอร์ดขาด', 'ยกเลิกรายการ'),
('REQ-6326c4655651a', 'USR-63269481200d4', 1, 2, '', '2022-09-18', 'จอกระพริบตลอดเวลา รีบูทเครื่องแล้วก็ยังเป็นอยู่', 'ดำเนินการเสร็จสิ้น'),
('REQ-6327b88483e28', 'USR-63269481200d4', 1, 1, 'COM-17725', '2022-09-19', 'เคสคอมพิวเตอร์ขึ้นสนิม', 'กำลังดำเนินการ'),
('REQ-632be7c007a04', 'USR-631db1cb646b1', 1, 2, 'COM-6320014', '2022-09-22', 'จอไม่ติด แต่ไฟเข้าปกติ', 'กำลังดำเนินการ'),
('REQ-632c9a6fd6c57', 'USR-63252e59ddd51', 3, 6, '', '2022-09-23', 'Router ไฟสถานะไม่ติด', 'รอดำเนินการ'),
('REQ-632c9db3a333e', 'USR-63269481200d4', 2, 5, '', '2022-09-23', 'หมึกไม่ออกเมื่อพิมพ์เอกสารสีไปประมาณ 5 แผ่น', 'กำลังดำเนินการ'),
('REQ-6337258d094ef', 'USR-631db1cb646b1', 2, 5, '', '2022-10-01', 'Printer ที่ออฟฟิศเสีย', 'รอดำเนินการ'),
('REQ-633726d03deb8', 'USR-6337262134124', 2, 3, '', '2022-10-01', 'ไมโครโฟนตั้งโต๊ะห้อง 303 เสียงเบาผิดปกติ', 'รอดำเนินการ'),
('REQ-6337271258b89', 'USR-6337262134124', 2, 3, '', '2022-10-01', 'Webcam ห้อง Video Conference ไม่สามารถเปิดได้ หน้าจอเป็นสีดำ', 'รอดำเนินการ'),
('REQ-6337275c9dedc', 'USR-6337262134124', 2, 3, '', '2022-10-01', 'ลำโพงห้องประชุม 3 มีเสียงช็อต ไม่สามารถใช้งานได้', 'รอดำเนินการ');

-- --------------------------------------------------------

--
-- Table structure for table `request_servey`
--

CREATE TABLE `request_servey` (
  `ser_id` int(10) NOT NULL COMMENT 'รหัสการประเมิน',
  `req_id` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสรายการแจ้งซ่อม',
  `ser_date` date NOT NULL COMMENT 'วันที่ทำการประเมิน',
  `ser_average` float DEFAULT NULL COMMENT 'ความพึงพอใจเฉลี่ย',
  `ser_feedback` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ข้อเสนอแนะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_servey`
--

INSERT INTO `request_servey` (`ser_id`, `req_id`, `ser_date`, `ser_average`, `ser_feedback`) VALUES
(13, 'REQ-6326b99ea5db6', '2022-09-19', 4, 'ควรจัดอุปกรณ์สำรองไว้ที่สำนักงาน เพื่อความรวดเร็วในการนำมาใช้งาน'),
(14, 'REQ-6325706bd2c41', '2022-09-19', 3.5, ''),
(15, 'REQ-63244cb68a7c3', '2022-09-19', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `request_solving`
--

CREATE TABLE `request_solving` (
  `solv_id` int(10) NOT NULL COMMENT 'รหัสบันทึกการดำเนินการ',
  `req_id` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสรายการแจ้งซ่อม',
  `solv_detail` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รายละเอียดการดำเนินการ',
  `solv_note` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุ',
  `officer_id` varchar(17) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสผู้ตรวจสอบ',
  `solv_date` date NOT NULL COMMENT 'วันที่บันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_solving`
--

INSERT INTO `request_solving` (`solv_id`, `req_id`, `solv_detail`, `solv_note`, `officer_id`, `solv_date`) VALUES
(1, 'REQ-63244cb68a7c3', 'ตรวจสอบแล้ว สาย LAN เสียหายจากสัตว์ฟันแทะ แก้ไขให้แล้วโดยการเปลี่ยนสาย LAN ใหม่', '', 'USR-63252e59ddd51', '2022-09-18'),
(3, 'REQ-63244c43ab02b', NULL, NULL, 'USR-63252e59ddd51', '2022-09-17'),
(4, 'REQ-6325706bd2c41', 'ตรวจสอบแล้ว วงจรภายในเสียหาย ไม่สามารถซ่อมแซมได้ ยกเลิกรายการ', '', 'USR-63252e59ddd51', '2022-09-17'),
(5, 'REQ-6326b99ea5db6', 'ไม่สามารถทำการซ่อมแซมได้ ขอให้มารับอุปกรณ์ทดแทนที่ฝ่ายพัสดุ', 'ไม่สามารถซ่อมแซมได้', 'USR-63252e59ddd51', '2022-09-19'),
(6, 'REQ-6327b88483e28', NULL, NULL, 'USR-63252e59ddd51', '2022-09-19'),
(7, 'REQ-6326c4655651a', 'แก้ไขแล้วโดยการติดตั้ง Window ใหม่', '', 'USR-63252e59ddd51', '2022-09-19'),
(9, 'REQ-63244aa988ef', NULL, NULL, 'USR-63252e59ddd51', '2022-09-23'),
(10, 'REQ-632c9db3a333e', NULL, NULL, 'USR-63252e59ddd51', '2022-09-23'),
(11, 'REQ-632be7c007a04', NULL, NULL, 'USR-632449680c689', '2022-09-29');

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

--
-- Dumping data for table `servey_list`
--

INSERT INTO `servey_list` (`list_id`, `ser_id`, `top_id`, `list_rate`) VALUES
(11, 13, 1, 4),
(12, 13, 2, 4),
(13, 13, 3, 3),
(14, 13, 4, 5),
(15, 14, 1, 4),
(16, 14, 2, 5),
(17, 14, 3, 2),
(18, 14, 4, 3),
(19, 15, 1, 5),
(20, 15, 2, 5),
(21, 15, 3, 5),
(22, 15, 4, 5);

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
(1, 'ภาพรวมของการให้บริการ'),
(2, 'ความรู้ความสามารถในการให้บริการของเจ้าหน้าที่'),
(3, 'การแนะนำหลังการให้บริการ'),
(4, 'ความรวดเร็วในการให้บริการของเจ้าหน้าที่');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(10) NOT NULL COMMENT 'รหัสบริการ',
  `service_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อบริการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`) VALUES
(1, 'ปัญหาเกี่ยวกับคอมพิวเตอร์'),
(2, 'ปัญหาเกี่ยวกับอุปกรณ์ต่อพ่วง'),
(3, 'ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย');

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
  `dep_id` int(5) DEFAULT NULL COMMENT 'รหัสหน่วยงาน/แผนก',
  `user_username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Username',
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผ่าน',
  `user_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'คีย์จดจำผู้ใช้',
  `user_level` int(2) DEFAULT 3 COMMENT 'สิทธิการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_profile`, `user_name`, `user_lastname`, `user_tel`, `dep_id`, `user_username`, `user_password`, `user_token`, `user_level`) VALUES
('USR-631db1cb64111', 'default-avatar.png', 'Reserv', 'Admin Account', '-', NULL, 'reserv@admin', '$2y$10$hYiz7mZc.XAoS8hgkotCquD8P1hLKrwy55ifYc.W0JiuvSy28LWxq', '$2y$10$xM9bu6KmDOj976nC3oXCxuxNSLuvPvzTBsp1S9LTRlzue0RFY7oPG', 1),
('USR-631db1cb646b1', 'IMG-632dfd5c0aef7.jpg', 'สุรพัศ', 'ทิพย์ภักดี', '0648738153', NULL, 'surapat@admin', '$2y$10$hYiz7mZc.XAoS8hgkotCquD8P1hLKrwy55ifYc.W0JiuvSy28LWxq', '', 1),
('USR-632449680c689', 'IMG-632c9742ad547.jpg', 'ศักดิ์ชาย', 'ชื่นเจริญ', '0822569987', 6, 'sakchai@off', '$2y$10$8JbMVhUnxmXh0WiPtICA0u8uXsy1JAb3DwhqLEUe.46r20/e/WSH2', '', 2),
('USR-632449cc29251', 'IMG-632df89f19d22.jpg', 'ทิวา', 'อนันตเมฆ', '0896662253', 5, 'tiwa@user', '$2y$10$XIC9H/YNJaZO/QPkiyq/POXPjX1VbkUywh1CnVhaVdzw80J2g/HnS', NULL, 3),
('USR-63252e59ddd51', 'IMG-632c98531a913.jpg', 'สมชาย', 'นายช่างคอม', '0892009988', 10, 'somchai@off', '$2y$10$qwFlDWHrujT34pKC/xb9j.TMrB7ZdgH8SWqy774RjqZy6AWsdSRLq', '$2y$10$FarjP3L2VKhxCDMQ26xbiOBRlHD2HzRzoP5.WIAhH6JrAWBQY.r1W', 2),
('USR-63269481200d4', 'IMG-632dfe74c1a27.jpg', 'ชมพูนุท', 'ชูวัจนา', '0892003374', 3, 'chompoo@user', '$2y$10$JGEtY.8I/0nkm8LoJ/C0uOgyst1ufxyJdxvgubh8EmVD3xQVaF8Gy', '$2y$10$cmD0C4t7E0VcE18firZQh.fSAXtdNlEM61EiKq5p90IQpHlQEb0SC', 3),
('USR-6337262134124', 'IMG-633726214104c.jpg', 'พรทิพย์', 'ขำจิตร', '0873369855', 14, 'ponthip@user', '$2y$10$RrnB6YsoOKVpQSZ0ddCxneOVd612e6.9sEOzdgqbdOnBOj53CU1.i', '$2y$10$av.1roOPWUWtGpI1BwmuFehZUjhOVTJzB3ai.tW6x1ARDvoGQt.6.', 3);

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
(14, 'กลุ่มงานการแพทย์'),
(15, 'กลุ่มงานเภสัชกรรม');

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
-- Indexes for table `notify_setting`
--
ALTER TABLE `notify_setting`
  ADD PRIMARY KEY (`noti_id`);

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
  ADD KEY `user_id` (`officer_id`);

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
  ADD KEY `user_dep` (`dep_id`);

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
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทครุภัณฑ์', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notify_setting`
--
ALTER TABLE `notify_setting`
  MODIFY `noti_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_servey`
--
ALTER TABLE `request_servey`
  MODIFY `ser_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการประเมิน', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `request_solving`
--
ALTER TABLE `request_solving`
  MODIFY `solv_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบันทึกการดำเนินการ', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `servey_list`
--
ALTER TABLE `servey_list`
  MODIFY `list_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการประเมิน', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `servey_topic`
--
ALTER TABLE `servey_topic`
  MODIFY `top_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหัวข้อการประเมิน', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสบริการ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_dep`
--
ALTER TABLE `user_dep`
  MODIFY `dep_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหน่วยงาน', AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `device_type` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `request_solving_ibfk_2` FOREIGN KEY (`officer_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`dep_id`) REFERENCES `user_dep` (`dep_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
