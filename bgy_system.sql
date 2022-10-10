-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 07:12 PM
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
(59, 'purok 1', 'sitio 1', 'Grove', 'Magnolia Estate'),
(60, 'purok 2', 'sitio 2', 'KalyePogi', 'Beverly Woods'),
(62, 'Purok 3', 'sitio 3', 'LRC', 'Brittany Oaks'),
(64, '', '', 'Oroqueta', 'Sycamore Village'),
(65, '', '', 'Telecom', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `notification_ID` int(11) NOT NULL,
  `notification_type` varchar(50) NOT NULL,
  `type_ID` int(11) DEFAULT NULL,
  `message` varchar(50) NOT NULL,
  `source_ID` int(11) DEFAULT NULL,
  `date_time` varchar(20) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_notification`
--

INSERT INTO `admin_notification` (`notification_ID`, `notification_type`, `type_ID`, `message`, `source_ID`, `date_time`, `status`) VALUES
(1, 'Request Document', 7, 'requested a document.', 9, '22-10-09 02:31:04', 1),
(2, 'Request Document', 8, 'requested a document.', 9, '22-10-09 02:33:04', 1),
(3, 'Request Document', 9, 'requested a document.', 29, '22-10-09 05:04:39', 1),
(4, 'Request Document', 10, 'requested a document.', 29, '22-10-09 05:21:50', 1),
(5, 'Request Document', 14, 'requested a document.', 9, '22-10-10 04:01:19', 1),
(6, 'File Complaint', 14, 'filed a complaint.', 9, '22-10-10 04:02:19', 1),
(7, 'Send Suggestion', 13, 'sent a suggestion.', 9, '22-10-10 04:10:47', 1),
(8, 'File Complaint', 14, 'filed a complaint.', 9, '22-10-10 04:11:04', 1),
(9, 'File Blotter', 6, 'filed a blotter.', 11, '22-10-10 04:16:13', 1),
(10, 'File Blotter', 7, 'filed a blotter.', 11, '22-10-10 04:17:57', 1),
(11, 'Request Document', 11, 'requested a document.', 11, '22-10-10 04:24:15', 1),
(12, 'Request Document', 12, 'requested a document.', 11, '22-10-10 05:27:56', 1);

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
(1, '#008a87', 'IMG-633d8bdbebdac5.77070216.png', '310', 'We envision the Barangay Pico to be more progressive, loving and peaceful place to live in where people and residents enjoy harmonious way of life, business, at work and at home, and most especially for a more directed and progressive Barangay Governance.', 'We commit to perform better duties and responsibilities to carry out the plans and objectives of the barangay thru voluntary and excellent performance, most especially in the delivery of the basic needs such as improved roads and environment, water system, health care, education, housing and agricultural farming needs of the farmers and residents of the barangay.', 'Manila ', 'IMG-6310b1e4de2736.84526520.png');

-- --------------------------------------------------------

--
-- Table structure for table `blotter_table`
--

CREATE TABLE `blotter_table` (
  `blotter_ID` int(11) NOT NULL,
  `official_ID` int(11) DEFAULT NULL,
  `complainant_ID` int(11) NOT NULL,
  `complainee_ID` int(11) NOT NULL,
  `complainee_name` varchar(100) NOT NULL,
  `blotter_date` date NOT NULL,
  `blotter_time` time NOT NULL,
  `blotter_accusation` varchar(50) NOT NULL,
  `blotter_details` varchar(100) NOT NULL,
  `settlement_schedule` date NOT NULL,
  `settlement_time` time DEFAULT NULL,
  `result_of_settlement` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blotter_table`
--

INSERT INTO `blotter_table` (`blotter_ID`, `official_ID`, `complainant_ID`, `complainee_ID`, `complainee_name`, `blotter_date`, `blotter_time`, `blotter_accusation`, `blotter_details`, `settlement_schedule`, `settlement_time`, `result_of_settlement`, `status`) VALUES
(2, 5, 9, 8, 'Bernard Kabiling Mazo', '2022-10-01', '23:38:00', 'Handsome problem', 'Ampogi ni Bernard Mazo', '0000-00-00', '00:00:00', 'asd', 'unsettled'),
(3, NULL, 9, 0, 'Kyrie Irving', '2022-10-13', '23:42:00', 'Stafa', 'Inistafa yung pusta namin sa basketball', '0000-00-00', '00:00:00', '', 'unscheduled'),
(4, 5, 9, 0, 'Lebron James', '2022-09-28', '23:42:00', 'Play and Run', 'hindi nag bayad ng pang schedule', '2022-10-19', '12:52:00', 'asdas', 'settled'),
(5, 5, 9, 10, 'Charles Wilcent Ilustre Urbano', '0000-00-00', '13:02:00', 'Nanuntok', 'nanuntok ng limang tao', '2022-10-12', '08:37:00', '', 'scheduled'),
(6, NULL, 11, 38, 'Bernard Kabilin Mazo', '2022-10-05', '22:17:00', 'igop', 'asdasdasdas', '0000-00-00', NULL, '', 'unscheduled'),
(7, NULL, 11, 10, 'Charles Wilcent Ilustre Urbano', '2022-09-29', '22:19:00', 'sobrang pogi', 'asdsadasd', '0000-00-00', NULL, '', 'unscheduled');

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
(1, 'Dirty Barangay', 'Barangay Improvement'),
(2, 'Gossip Mongers', 'Education'),
(3, 'Drugs', 'Sports'),
(4, 'Noise', 'Health');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_table`
--

CREATE TABLE `complaint_table` (
  `complaint_ID` int(11) NOT NULL,
  `official_ID` int(11) DEFAULT NULL,
  `sender_ID` int(11) NOT NULL,
  `complaint_nature` varchar(20) NOT NULL,
  `comp_desc` varchar(100) NOT NULL,
  `complaint_date` date NOT NULL,
  `img_proof` varchar(50) NOT NULL,
  `complaint_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_table`
--

INSERT INTO `complaint_table` (`complaint_ID`, `official_ID`, `sender_ID`, `complaint_nature`, `comp_desc`, `complaint_date`, `img_proof`, `complaint_status`) VALUES
(1, 5, 9, 'Dirty Barangay', 'sad', '2022-09-26', 'IMG-6331aa2bdf2245.84869776.png', 'solved'),
(2, 5, 9, 'Drugs', 'drugs drugs drugs drugs drugs', '2022-09-26', 'IMG-6331aa8ac786d0.08725937.png', 'solved'),
(3, 5, 9, 'Gossip Mongers', 'Wilcent urbano ang ngalan', '2022-09-27', 'IMG-6332ec0067dd74.43852234.png', 'solved'),
(4, 5, 9, 'Noise', 'Noisy Karaoke', '2022-09-27', 'IMG-6332ece1b2b828.26135177.png', 'solved'),
(7, 5, 9, 'Drugs', 'sdfdsf', '2022-09-27', 'IMG-6333053e5fcb96.27694649.png', 'solved'),
(9, 6, 9, 'Gossip Mongers', 'tsismosa', '2022-09-28', '', 'solved'),
(10, 6, 9, 'Other', 'SUGALAN SA KANTO', '2022-09-28', '', 'solved'),
(11, NULL, 9, 'Other', 'illegal parking', '2022-09-28', '', 'pending'),
(12, NULL, 9, 'Other', 'sugalan', '2022-09-28', 'IMG-633453d006e131.68377680.jpg', 'pending'),
(13, NULL, 9, 'Other', 'illegal parking', '2022-09-28', 'IMG-633453de511e23.56622787.jpg', 'pending'),
(14, NULL, 9, 'Dirty Barangay', 'street 1 is very dirty', '2022-09-28', 'IMG-63346d10292875.87716455.jpg', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `document_request`
--

CREATE TABLE `document_request` (
  `request_ID` int(11) NOT NULL,
  `official_ID` int(11) DEFAULT NULL,
  `resident_ID` int(11) NOT NULL,
  `document_ID` int(11) DEFAULT NULL,
  `purpose` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `request_date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document_request`
--

INSERT INTO `document_request` (`request_ID`, `official_ID`, `resident_ID`, `document_ID`, `purpose`, `quantity`, `payment`, `request_date`, `status`) VALUES
(1, NULL, 7, 1, 'school requirement', 1, 'payment.jpg', '2022-09-22', 'pending'),
(3, NULL, 9, 1, 'adasd', 12, 'RCPT-633afecac5b085.95733661.jpg', '2022-10-03', 'pending'),
(4, NULL, 9, 2, 'asd', 1, 'RCPT-633afee90462b9.73775231.jpg', '2022-10-03', 'pending'),
(5, NULL, 11, 2, 'business', 1, 'RCPT-633d9a114cf799.84391831.jpg', '2022-10-05', 'pending'),
(6, NULL, 11, 3, 'school', 1, 'RCPT-633da47ab3f616.59006446.jpg', '2022-10-05', 'pending'),
(7, NULL, 9, 2, 'Business', 1, 'RCPT-6342bf2cd197e4.93863445.jpg', '2022-10-09', 'pending'),
(8, NULL, 9, 3, 'School Requirement', 1, 'RCPT-6342bf801995f8.50901645.jpg', '2022-10-09', 'pending'),
(9, NULL, 29, 2, 'business', 1, 'RCPT-6342e30774d612.08680000.jpg', '2022-10-09', 'pending'),
(10, NULL, 29, 1, 'School Purposes', 2, 'RCPT-6342e70e7d8920.44333261.jpg', '2022-10-09', 'pending'),
(11, NULL, 11, 1, 'asdasdas', 1, 'RCPT-63442b0f908dc0.42865164.jpg', '2022-10-10', 'pending'),
(12, NULL, 11, 1, 'sadasd', 1, 'RCPT-634439fca71343.47009202.jpg', '2022-10-10', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `id` int(11) NOT NULL,
  `document_type` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `availability` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`id`, `document_type`, `price`, `availability`) VALUES
(1, 'Barangay Clearance', '100.00', 'yes'),
(2, 'Certificate of Indigency', '75.00', 'yes'),
(3, 'Certificate of Residency', '80.00', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_availability`
--

CREATE TABLE `healthcare_availability` (
  `id` int(10) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `healthcare_availability`
--

INSERT INTO `healthcare_availability` (`id`, `time_start`, `time_end`) VALUES
(1, '10:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_logs`
--

CREATE TABLE `healthcare_logs` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `healthcare_logs`
--

INSERT INTO `healthcare_logs` (`id`, `patient_id`, `fullname`, `date`, `time`, `reason`) VALUES
(2, 8, 'Bernard Kabiling Mazo', '2022-09-19', '15:51:01', 'pogi'),
(3, 9, 'Christian Philip Diff Orsolino', '2022-09-19', '15:52:12', 'allergy'),
(4, 0, '', '2022-09-19', '16:19:02', 'nothing'),
(5, 0, '', '2022-09-19', '16:21:05', 'asdas'),
(6, 0, '', '2022-09-19', '16:25:41', 'ads'),
(7, 0, 'Denver Mazo', '2022-09-19', '16:29:04', 'nothing'),
(8, 0, '10', '2022-09-19', '16:29:17', 'Varsity'),
(9, 0, '10', '2022-09-19', '16:29:55', 'varsity'),
(10, 10, 'Charles Wilcent Ilustre Urbano', '2022-09-19', '16:40:47', 'Varsity'),
(11, 0, 'Charles', '2022-09-19', '16:41:23', '12121'),
(12, 38, 'Bernard Kabilin Mazo', '2022-10-10', '18:38:40', 'stomach ache 1');

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
  `suffix` varchar(10) DEFAULT NULL,
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

INSERT INTO `registration` (`id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `birthplace`, `civilstatus`, `birthday`, `age`, `unitnumber`, `purok`, `sitio`, `street`, `subdivision`, `contactnumber`, `email`, `religion`, `occupation`, `educational`, `nationality`, `disability`, `status`, `img_path`) VALUES
(7, 'Lenz Janielle', 'Lim', 'Gerongco', NULL, 'female', 'Laguna', 'Single', '2022-09-15', 20, 1004, 'Purok 3', 'sitio 2', 'TELECOM', 'tinagan', '09123456789', 'lenzgerongco@yahoo.com', 'Roman Catholic', 'Flight attendant', 'College', 'Filipino', 'none', 'accepted', 'IMG-631219de1abde9.41773945.jpg'),
(8, 'Bernard', 'Kabiling', 'Mazo', NULL, 'male', 'Manila', 'Single', '2001-03-27', 21, 1759, 'purok 1', 'sitio 1', 'TELECOM', 'tinagan', '09616064483', 'nard_mazo@gmail.com', 'Roman Catholic', 'Programmer', 'College', 'Filipino', 'none', 'accepted', 'IMG-63121afc4c1067.08242643.jpg'),
(9, 'Christian Philip', 'Diff', 'Orsolino', NULL, 'male', 'Manila', 'Single', '2000-12-11', 21, 1000, 'purok 1', 'sitio 2', 'TELECOM', 'tinagan', '09283523142', 'chris.orsolino@gmail.com', 'Roman Catholic', 'Dancer', 'College', 'Filipino', 'none', 'accepted', 'IMG-6315e248db3a50.51752994.jpg'),
(10, 'Charles Wilcent', 'Ilustre', 'Urbano', NULL, 'male', 'Manila', 'Single', '2000-12-02', 22, 4598, 'purok 2', 'sitio 3', 'TELECOM', 'sevilla street', '09264561231', 'wilson.urbano@gmail.con', 'Roman Catholic', 'Axie player', 'College', 'Filipino', 'none', 'accepted', 'IMG-6315e7787044d0.53015656.jpg'),
(11, 'Jehan', '', 'Hadji Said', NULL, 'male', 'Manila', 'Single', '2012-06-12', 10, 12312, 'purok 2', 'sitio 2', 'kalyepogi', 'parking', '09108418705', 'jehan.said@gmail.com', 'Islam', 'Web developer', 'College', 'Filipino', 'none', 'accepted', 'IMG-6316093cd6aa57.65981626.jpg'),
(15, 'john daniel', 'san juan', 'policarpio', NULL, 'male', 'mindoro', 'Married', '2022-09-28', 2, 1004, 'purok 2', 'sitio 3', 'LRC', 'sevilla street', '09789789788', 'juan.delecaruz123', 'Roman Catholic', 'Web developer', 'Less Than Highschool', 'russian', 'pogi', 'accepted', 'IMG-6322a81c7d8017.79649686.jpg'),
(16, 'john daniel', 'san juan', 'policarpio', NULL, 'male', 'mindoro', 'Widowed', '2022-09-20', 123, 1004, '1', 'sitio 1', 'kalyepogi', 'tinagan', '09123123123', 'juan.delecaruz123', 'Jehovah\'\'s Witnesses', 'programmer', 'Bachelor\'\'s Degree', 'Filipino', 'pogi', 'accepted', 'IMG-6322a861ded505.42428598.jpg'),
(19, 'Denver ', 'Kabiling', 'Mazo', NULL, 'male', 'Pampanga', 'Single', '1999-01-12', 23, 1759, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09475044087', 'denver.mazo@gmail.com', 'Roman Catholic', 'Cook', 'College', 'Filipino', 'None', 'accepted', 'IMG-6336cfb21effb4.96116588.png'),
(21, 'Bernard', 'Kabiling', 'Mazo', 'JR', 'male', 'Pampanga', 'Single', '2002-06-04', 20, 1759, '', '', '', '', '0929829390', 'nard.mazo@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'Filipino', 'none', 'accepted', 'IMG-6336ee77a48797.16008983.jpg'),
(22, 'Bernard', 'Kabiling', 'Mazo', 'none', 'male', 'Mindoro', 'Married', '2022-09-21', 12, 1759, '', '', '', '', '09283523149', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'Machine Operator', 'College', 'Filipino', 'none', 'accepted', 'IMG-6336f40df0ce87.00659602.jpg'),
(23, 'Bernandito', 'Malacas', 'Mazo', '', 'male', 'Mindoro', 'Married', '2022-09-07', 26, 1759, '', '', '', '', '09283523144', 'bernandito.mazo@gmail.com', 'Roman Catholic', 'Machine Operator', 'College', 'Filipino', 'none', 'accepted', 'IMG-6336f65190f495.32852079.jpg'),
(24, 'Bernardo', 'Kabiling', 'Mazo', '', 'male', 'Manila', 'Single', '2022-10-12', 21, 1759, 'purok 1', 'sitio 1', 'Grove', 'Magnolia Estate', '096160644831', 'nard_mazo@gmail.com1', 'Roman Catholic', 'none', 'Less Than Highschool', 'Filipino', 'none', 'pending', 'IMG-633ee85b00dd85.83556750.jpg');

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
  `suffix` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(10) NOT NULL,
  `household_ID` int(11) DEFAULT NULL,
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

INSERT INTO `resident_table` (`id`, `user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `birthplace`, `civilstatus`, `birthday`, `age`, `household_ID`, `unitnumber`, `purok`, `sitio`, `street`, `subdivision`, `contactnumber`, `email`, `religion`, `occupation`, `education`, `nationality`, `disability`, `imgid`, `status`) VALUES
(7, 7, 'Lenz Janielle', 'Lim', 'Gerongco', '', 'female', 'Laguna', 'Single', '2022-09-15', 20, NULL, 1004, 'Purok 3', 'sitio 2', 'TELECOM', 'tinagan', '09123456789', 'lenzgerongco@yahoo.com', 'Roman Catholic', 'Flight attendant', 'College', 'Filipino', 'none', '', 'active'),
(8, 8, 'Bernard', 'Kabiling', 'Mazo', '', 'male', 'Manila', 'Single', '2001-03-27', 21, NULL, 1759, 'purok 1', 'sitio 1', 'TELECOM', 'tinagan', '09616064483', 'nard_mazo@gmail.com', 'Roman Catholic', 'Programmer', 'College', 'Filipino', 'none', '', 'active'),
(9, 9, 'Christian Philip', 'Diff', 'Orsolino', '', 'male', 'Manila', 'Single', '2000-12-11', 21, 3, 1000, 'purok 1', 'sitio 2', 'TELECOM', 'tinagan', '09283523142', 'chris.orsolino@gmail.com', 'Roman Catholic', 'Dancer', 'College', 'Filipino', 'none', '', 'active'),
(10, 10, 'Charles Wilcent', 'Ilustre', 'Urbano', '', 'male', 'Manila', 'Single', '2000-12-02', 22, 3, 4598, 'purok 2', 'sitio 3', 'TELECOM', 'sevilla street', '09264561231', 'wilson.urbano@gmail.con', 'Roman Catholic', 'Axie player', 'College', 'Filipino', 'none', '', 'active'),
(11, 11, 'Jehan', '', 'Hadji Said', '', 'male', 'Manila', 'Single', '2012-06-12', 10, NULL, 12312, 'purok 2', 'sitio 2', 'kalyepogi', 'parking', '09108418705', 'jehan.said@gmail.com', 'Islam', 'Web developer', 'College', 'Filipino', 'none', '', 'active'),
(12, 13, 'Michael', '', 'Jordan', '', 'male', 'Manila', 'Married', '1963-02-17', 58, NULL, 2345, 'purok 2', 'sitio 1', 'LRC', 'parking', '09781234567', 'michaejordan@gmail.com', 'Roman Catholic', 'none', 'College', 'American', 'none', '', 'active'),
(13, 14, 'Kobe', '', 'Bryant', '', 'male', 'Manila', 'Married', '1978-08-23', 44, NULL, 2408, 'Purok 3', 'sitio 3', 'grove', 'sevilla street', '09244567897', 'kobe.bryant@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'American', 'none', '', 'active'),
(14, 15, 'Lebron', '', 'James', '', 'male', 'Manila', 'Single', '1984-12-30', 37, NULL, 2306, 'purok 2', 'sitio 2', 'TELECOM', 'parking', '09623456781', 'lebronjames@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'American', 'none', '', 'active'),
(17, 18, 'John', '', 'Wall', '', 'male', 'Manila', 'Single', '1990-09-06', 0, 3, 202, 'purok 1', 'sitio 1', 'Oroqueta', 'tinagan', '09020146545', 'john.wall@gmail.com', 'Roman Catholic', 'none', 'College', 'American', 'none', '', 'active'),
(29, 30, 'john daniel', 'san juan', 'policarpio', '', 'male', 'mindoro', 'Widowed', '2022-09-20', 123, 3, 1004, '1', 'sitio 1', 'kalyepogi', 'tinagan', '09123123123', 'juan.delecaruz123', 'Jehovah\'s Witnesses', 'programmer', 'Bachelor\'s Degree', 'Filipino', 'pogi', '', 'active'),
(32, 33, 'Denver ', 'Kabiling', 'Mazo', '', 'male', 'Pampanga', 'Single', '1999-01-12', 23, NULL, 1759, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09475044087', 'denver.mazo@gmail.com', 'Roman Catholic', 'Cook', 'College', 'Filipino', 'None', '', 'active'),
(34, 42, 'Bernandito', 'Malacas', 'Mazo', '', 'male', 'Mindoro', 'Married', '2022-09-07', 26, 7, 1759, '', '', '', '', '09283523144', 'bernandito.mazo@gmail.com', 'Roman Catholic', 'Machine Operator', 'College', 'Filipino', 'none', '', 'active'),
(38, 39, 'Bernard', 'Kabilin', 'Mazo', '', 'female', 'Manila', 'Married', '2022-10-13', 21, 3, 1759, '', '', '', '', '0961606448', 'nard_maz@gmail.com', 'Roman Catholic', 'none', 'Highschool', 'Filipino', 'none', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion_table`
--

CREATE TABLE `suggestion_table` (
  `suggestion_ID` int(11) NOT NULL,
  `official_ID` int(11) DEFAULT NULL,
  `sender_ID` int(11) NOT NULL,
  `suggestion_nature` varchar(50) NOT NULL,
  `suggestion_desc` varchar(100) NOT NULL,
  `suggestion_date` date NOT NULL,
  `suggestion_feedback` varchar(100) NOT NULL,
  `suggestion_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suggestion_table`
--

INSERT INTO `suggestion_table` (`suggestion_ID`, `official_ID`, `sender_ID`, `suggestion_nature`, `suggestion_desc`, `suggestion_date`, `suggestion_feedback`, `suggestion_status`) VALUES
(1, 6, 9, 'Education', 'school supplies', '2022-09-28', 'ok', 'noticed'),
(2, 5, 9, 'Barangay Improvement', '', '2022-09-28', 'sge', 'noticed'),
(3, NULL, 9, 'Barangay Improvement', 'asda', '2022-09-28', '', 'pending'),
(4, NULL, 9, 'Sports', 'please organize a basketball league', '2022-09-28', '', 'pending'),
(5, 5, 9, 'Sports', 'please organize a basketball league', '2022-09-28', 'Sige sabi mo eh', 'noticed'),
(6, NULL, 9, 'Health', 'Conduct operation tuli', '2022-09-28', '', 'pending'),
(7, NULL, 9, 'Barangay Improvement', 'your hall looks dirty, do some operation cleaning!!', '2022-09-28', '', 'pending'),
(8, NULL, 9, 'Sports', 'please conduct a summer league', '2022-09-28', '', 'pending'),
(9, NULL, 9, 'Barangay Improvement', 'clean the purok 1', '2022-09-28', '', 'pending'),
(10, NULL, 9, 'Other', 'asndlnalsd', '2022-09-28', '', 'pending'),
(11, NULL, 9, 'Education', 'aasdasdsad', '2022-10-10', '', 'pending'),
(12, NULL, 9, 'Other', 'sadasd', '2022-10-10', '', 'pending'),
(13, NULL, 9, 'Other', 'sadasd', '2022-10-10', '', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tblhousehold`
--

CREATE TABLE `tblhousehold` (
  `household_id` int(11) NOT NULL,
  `household_member` int(10) DEFAULT NULL,
  `household_head_ID` int(11) DEFAULT NULL,
  `household_name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblhousehold`
--

INSERT INTO `tblhousehold` (`household_id`, `household_member`, `household_head_ID`, `household_name`, `status`) VALUES
(1, NULL, 34, 'Mazo', 'inactive'),
(2, NULL, 10, 'Urbano', 'inactive'),
(3, 5, 9, 'Orsolino', 'active'),
(4, 2, 11, 'Hadji Said', 'inactive'),
(7, NULL, 34, 'Mazo', 'active');

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
(7, 'lenzay', '456', 'admin'),
(8, 'Odrannn', '123', 'admin0'),
(9, '09283523142', '12345678', 'user'),
(10, 'wil', 'wil', 'user'),
(11, 'jehan', '456', 'user'),
(13, '09781234567', '12345678', 'admin0'),
(14, '09244567897', '12345678', 'admin'),
(15, '09623456781', '12345678', 'admin'),
(18, '09020146545', '12345678', 'admin'),
(30, 'poli', 'pol', 'user'),
(33, '09475044087', '12345678', 'user'),
(39, '0961606448', '12345678', 'user'),
(41, 'HCAdmin', 'hcadmin', 'hadmin'),
(42, '09283523144', '12345678', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_fields`
--
ALTER TABLE `address_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD PRIMARY KEY (`notification_ID`);

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
-- Indexes for table `blotter_table`
--
ALTER TABLE `blotter_table`
  ADD PRIMARY KEY (`blotter_ID`);

--
-- Indexes for table `case_option`
--
ALTER TABLE `case_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_table`
--
ALTER TABLE `complaint_table`
  ADD PRIMARY KEY (`complaint_ID`),
  ADD KEY `INCHARGE` (`official_ID`),
  ADD KEY `SENDER` (`sender_ID`);

--
-- Indexes for table `document_request`
--
ALTER TABLE `document_request`
  ADD PRIMARY KEY (`request_ID`),
  ADD KEY `NAME` (`document_ID`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healthcare_availability`
--
ALTER TABLE `healthcare_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healthcare_logs`
--
ALTER TABLE `healthcare_logs`
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
  ADD KEY `test` (`user_id`),
  ADD KEY `HOUSE` (`household_ID`);

--
-- Indexes for table `suggestion_table`
--
ALTER TABLE `suggestion_table`
  ADD PRIMARY KEY (`suggestion_ID`);

--
-- Indexes for table `tblhousehold`
--
ALTER TABLE `tblhousehold`
  ADD PRIMARY KEY (`household_id`),
  ADD KEY `HEAD` (`household_head_ID`);

--
-- Indexes for table `tblofficial`
--
ALTER TABLE `tblofficial`
  ADD PRIMARY KEY (`official_id`),
  ADD KEY `residency` (`resident_id`),
  ADD KEY `ACCOUNT` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `admin_notification`
--
ALTER TABLE `admin_notification`
  MODIFY `notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `blotter_table`
--
ALTER TABLE `blotter_table`
  MODIFY `blotter_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `case_option`
--
ALTER TABLE `case_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `complaint_table`
--
ALTER TABLE `complaint_table`
  MODIFY `complaint_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `document_request`
--
ALTER TABLE `document_request`
  MODIFY `request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `healthcare_availability`
--
ALTER TABLE `healthcare_availability`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `healthcare_logs`
--
ALTER TABLE `healthcare_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `modules_available`
--
ALTER TABLE `modules_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `resident_table`
--
ALTER TABLE `resident_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `suggestion_table`
--
ALTER TABLE `suggestion_table`
  MODIFY `suggestion_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblhousehold`
--
ALTER TABLE `tblhousehold`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblofficial`
--
ALTER TABLE `tblofficial`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint_table`
--
ALTER TABLE `complaint_table`
  ADD CONSTRAINT `INCHARGE` FOREIGN KEY (`official_ID`) REFERENCES `tblofficial` (`official_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `SENDER` FOREIGN KEY (`sender_ID`) REFERENCES `resident_table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `document_request`
--
ALTER TABLE `document_request`
  ADD CONSTRAINT `NAME` FOREIGN KEY (`document_ID`) REFERENCES `document_type` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `resident_table`
--
ALTER TABLE `resident_table`
  ADD CONSTRAINT `HOUSE` FOREIGN KEY (`household_ID`) REFERENCES `tblhousehold` (`household_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `test` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tblhousehold`
--
ALTER TABLE `tblhousehold`
  ADD CONSTRAINT `HEAD` FOREIGN KEY (`household_head_ID`) REFERENCES `resident_table` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tblofficial`
--
ALTER TABLE `tblofficial`
  ADD CONSTRAINT `ACCOUNT` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `residency` FOREIGN KEY (`resident_id`) REFERENCES `resident_table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
