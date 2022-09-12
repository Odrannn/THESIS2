-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2022 at 06:15 AM
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
-- Database: `bgy_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_fields`
--

CREATE TABLE `address_fields` (
  `id` int(11) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `sitio` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `subdivision` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address_fields`
--

INSERT INTO `address_fields` (`id`, `purok`, `sitio`, `street`, `subdivision`) VALUES
(59, 'purok 1', 'sitio 1', 'grove', 'parking'),
(60, 'purok 2', 'sitio 2', 'kalyepogi', 'tinagan'),
(62, 'Purok 3', 'sitio 3', 'LRC', 'sevilla street'),
(63, '', '', 'TELECOM', ''),
(64, '', '', 'Oroqueta', '');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `descrip` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `img_url`, `descrip`) VALUES
(11, 'assembly', 'IMG-62f909accac4e9.62604401.jpg', 'hvgvkuyvubbnlb'),
(12, 'bakuna', 'IMG-62f909ca28c652.09208881.jpg', 'gf cfjc jvckvlbkbnbydfdfugvboihgniogoi7hyo87tngyyybyibyibuyhbuihiuhuihuihuihiygyigy'),
(13, 'sayaw', 'IMG-62f909eb6b3343.71586801.jpg', 'hnoi gg86g6g67g87huiohbuygvytfrtdredrfkygl');

-- --------------------------------------------------------

--
-- Table structure for table `bgy_info`
--

CREATE TABLE `bgy_info` (
  `id` int(10) NOT NULL,
  `color_theme` varchar(10) NOT NULL,
  `logo_url` text NOT NULL,
  `bgy_name` text NOT NULL,
  `vision` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `background_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bgy_info`
--

INSERT INTO `bgy_info` (`id`, `color_theme`, `logo_url`, `bgy_name`, `vision`, `mission`, `city`, `background_url`) VALUES
(1, '#006275', 'IMG-6310af57d8cd99.26288049.png', '310', 'We envision the Barangay Pico to be more progressive, loving and peaceful place to live in where people and residents enjoy harmonious way of life, business, at work and at home, and most especially for a more directed and progressive Barangay Governance.', 'We commit to perform better duties and responsibilities to carry out the plans and objectives of the barangay thru voluntary and excellent performance, most especially in the delivery of the basic needs such as improved roads and environment, water system, health care, education, housing and agricultural farming needs of the farmers and residents of the barangay.', 'Manila City', 'IMG-6310b1e4de2736.84526520.png');

-- --------------------------------------------------------

--
-- Table structure for table `case_option`
--

CREATE TABLE `case_option` (
  `id` int(11) NOT NULL,
  `complaint_nature` varchar(50) NOT NULL,
  `suggestion_nature` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `case_option`
--

INSERT INTO `case_option` (`id`, `complaint_nature`, `suggestion_nature`) VALUES
(1, 'Dirty Barangay', ''),
(2, 'Gossip Mongers', ''),
(3, 'Drugs', ''),
(4, 'Noise', '');

-- --------------------------------------------------------

--
-- Table structure for table `modules_available`
--

CREATE TABLE `modules_available` (
  `id` int(11) NOT NULL,
  `modules` varchar(100) NOT NULL,
  `availability` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules_available`
--

INSERT INTO `modules_available` (`id`, `modules`, `availability`) VALUES
(1, 'Case Management', 'yes'),
(2, 'Resident Management', 'yes'),
(3, 'Healthcare Center', 'yes'),
(4, 'Request Verification', 'yes'),
(5, 'Official Management', 'yes'),
(6, 'User Management', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthplace` varchar(100) NOT NULL,
  `civilstatus` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `unitnumber` int(11) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `sitio` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `subdivision` varchar(100) NOT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `educational` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `disability` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fname`, `mname`, `lname`, `gender`, `birthplace`, `civilstatus`, `birthday`, `age`, `unitnumber`, `purok`, `sitio`, `street`, `subdivision`, `contactnumber`, `email`, `religion`, `occupation`, `educational`, `nationality`, `disability`, `status`, `img_path`) VALUES
(7, 'Lenz Janielle', 'Lim', 'Gerongco', 'female', 'Laguna', 'Single', '2022-09-15', 20, 1004, 'Purok 3', 'sitio 2', 'TELECOM', 'tinagan', '09123456789', 'lenzgerongco@yahoo.com', 'Roman Catholic', 'Flight attendant', 'College', 'Filipino', 'none', 'accepted', 'IMG-631219de1abde9.41773945.jpg'),
(8, 'Bernard', 'Kabiling', 'Mazo', 'male', 'Manila', 'Single', '2001-03-27', 21, 1759, 'purok 1', 'sitio 1', 'TELECOM', 'tinagan', '09616064483', 'nard_mazo@gmail.com', 'Roman Catholic', 'Programmer', 'College', 'Filipino', 'none', 'accepted', 'IMG-63121afc4c1067.08242643.jpg'),
(9, 'Christian Philip', 'Diff', 'Orsolino', 'male', 'Manila', 'Single', '2000-12-11', 21, 1000, 'purok 1', 'sitio 2', 'TELECOM', 'tinagan', '09283523142', 'chris.orsolino@gmail.com', 'Roman Catholic', 'Dancer', 'College', 'Filipino', 'none', 'accepted', 'IMG-6315e248db3a50.51752994.jpg'),
(10, 'Charles Wilcent', 'Ilustre', 'Urbano', 'male', 'Manila', 'Single', '2000-12-02', 22, 4598, 'purok 2', 'sitio 3', 'TELECOM', 'sevilla street', '09264561231', 'wilson.urbano@gmail.con', 'Roman Catholic', 'Axie player', 'College', 'Filipino', 'none', 'accepted', 'IMG-6315e7787044d0.53015656.jpg'),
(11, 'Jehan', '', 'Hadji Said', 'male', 'Manila', 'Single', '2012-06-12', 10, 12312, 'purok 2', 'sitio 2', 'kalyepogi', 'parking', '09108418705', 'jehan.said@gmail.com', 'Islam', 'Web developer', 'College', 'Filipino', 'none', 'accepted', 'IMG-6316093cd6aa57.65981626.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `resident_table`
--

CREATE TABLE `resident_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(10) NOT NULL,
  `unitnumber` int(50) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `sitio` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `subdivision` varchar(50) NOT NULL,
  `contactnumber` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `disability` varchar(100) NOT NULL,
  `imgid` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resident_table`
--

INSERT INTO `resident_table` (`id`, `user_id`, `fname`, `mname`, `lname`, `gender`, `birthplace`, `civilstatus`, `birthday`, `age`, `unitnumber`, `purok`, `sitio`, `street`, `subdivision`, `contactnumber`, `email`, `religion`, `occupation`, `education`, `nationality`, `disability`, `imgid`, `status`) VALUES
(7, 7, 'Lenz Janielle', 'Lim', 'Gerongco', 'female', 'Laguna', 'Single', '2022-09-15', 20, 1004, 'Purok 3', 'sitio 2', 'TELECOM', 'tinagan', '09123456789', 'lenzgerongco@yahoo.com', 'Roman Catholic', 'Flight attendant', 'College', 'Filipino', 'none', '', 'active'),
(8, 8, 'Bernard', 'Kabiling', 'Mazo', 'male', 'Manila', 'Single', '2001-03-27', 21, 1759, 'purok 1', 'sitio 1', 'TELECOM', 'tinagan', '09616064483', 'nard_mazo@gmail.com', 'Roman Catholic', 'Programmer', 'College', 'Filipino', 'none', '', 'active'),
(9, 9, 'Christian Philip', 'Diff', 'Orsolino', 'male', 'Manila', 'Single', '2000-12-11', 21, 1000, 'purok 1', 'sitio 2', 'TELECOM', 'tinagan', '09283523142', 'chris.orsolino@gmail.com', 'Roman Catholic', 'Dancer', 'College', 'Filipino', 'none', '', 'active'),
(10, 10, 'Charles Wilcent', 'Ilustre', 'Urbano', 'male', 'Manila', 'Single', '2000-12-02', 22, 4598, 'purok 2', 'sitio 3', 'TELECOM', 'sevilla street', '09264561231', 'wilson.urbano@gmail.con', 'Roman Catholic', 'Axie player', 'College', 'Filipino', 'none', '', 'active'),
(11, 11, 'Jehan', '', 'Hadji Said', 'male', 'Manila', 'Single', '2012-06-12', 10, 12312, 'purok 2', 'sitio 2', 'kalyepogi', 'parking', '09108418705', 'jehan.said@gmail.com', 'Islam', 'Web developer', 'College', 'Filipino', 'none', '', 'active'),
(12, 13, 'Michael', '', 'Jordan', 'male', 'Manila', 'Married', '1963-02-17', 58, 2345, 'purok 2', 'sitio 1', 'LRC', 'parking', '09781234567', 'michaejordan@gmail.com', 'Roman Catholic', 'none', 'College', 'American', 'none', '', 'active'),
(13, 14, 'Kobe', '', 'Bryant', 'male', 'Manila', 'Married', '1978-08-23', 44, 2408, 'Purok 3', 'sitio 3', 'grove', 'sevilla street', '09244567897', 'kobe.bryant@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'American', 'none', '', 'active'),
(14, 15, 'Lebron', '', 'James', 'male', 'Manila', 'Single', '1984-12-30', 37, 2306, 'purok 2', 'sitio 2', 'TELECOM', 'parking', '09623456781', 'lebronjames@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'American', 'none', '', 'active'),
(17, 18, 'John', '', 'Wall', 'male', 'Manila', 'Single', '1990-09-06', 0, 202, 'purok 1', 'sitio 1', 'Oroqueta', 'tinagan', '09020146545', 'john.wall@gmail.com', 'Roman Catholic', 'none', 'College', 'American', 'none', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficial`
--

CREATE TABLE `tblofficial` (
  `official_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(30) NOT NULL,
  `term_start` date NOT NULL,
  `term_end` date NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblofficial`
--

INSERT INTO `tblofficial` (`official_id`, `resident_id`, `user_id`, `name`, `position`, `term_start`, `term_end`, `status`) VALUES
(1, 12, 13, 'Michael Jordan', 'Chairman', '2016-12-01', '2023-06-01', 'active'),
(2, 13, 14, 'Kobe Bryant', 'Kagawad', '2016-12-01', '2023-06-01', 'active'),
(3, 14, 15, 'Lebron James', 'Kagawad', '2016-12-01', '2023-06-01', 'active'),
(4, 17, 18, 'John Wall', 'Kagawad', '2016-12-01', '2023-06-01', 'active'),
(5, 8, 8, 'Bernard Kabiling Mazo', 'Exo', '2022-09-22', '2022-09-19', 'active'),
(6, 7, 7, 'Lenz Janielle Lim Gerongco', 'Secretary', '2022-08-02', '2023-12-28', 'active'),
(8, 9, 9, 'Christian Philip Diff Orsolino', 'Kagawad', '2022-09-14', '2022-09-28', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `password`, `type`) VALUES
(7, '09123456789', '12345678', 'admin'),
(8, 'Odrannn', 'Mazo2826', 'admin'),
(9, '09283523142', '12345678', 'user'),
(10, '09264561231', '12345678', 'user'),
(11, '09108418705', '12345678', 'user'),
(13, '09781234567', '12345678', 'admin'),
(14, '09244567897', '12345678', 'admin'),
(15, '09623456781', '12345678', 'admin'),
(18, '09020146545', '12345678', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_fields`
--
ALTER TABLE `address_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bgy_info`
--
ALTER TABLE `bgy_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_option`
--
ALTER TABLE `case_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules_available`
--
ALTER TABLE `modules_available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resident_table`
--
ALTER TABLE `resident_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`user_id`);

--
-- Indexes for table `tblofficial`
--
ALTER TABLE `tblofficial`
  ADD PRIMARY KEY (`official_id`),
  ADD KEY `residency` (`resident_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_fields`
--
ALTER TABLE `address_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bgy_info`
--
ALTER TABLE `bgy_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `case_option`
--
ALTER TABLE `case_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `modules_available`
--
ALTER TABLE `modules_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `resident_table`
--
ALTER TABLE `resident_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblofficial`
--
ALTER TABLE `tblofficial`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resident_table`
--
ALTER TABLE `resident_table`
  ADD CONSTRAINT `test` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tblofficial`
--
ALTER TABLE `tblofficial`
  ADD CONSTRAINT `residency` FOREIGN KEY (`resident_id`) REFERENCES `resident_table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
