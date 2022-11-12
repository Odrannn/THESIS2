-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2022 at 07:24 PM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u314764576_bgy_system`
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
(12, 'Request Document', 12, 'requested a document.', 11, '22-10-10 05:27:56', 1),
(13, 'File Complaint', 15, 'filed a complaint.', 9, '22-10-11 02:38:02', 1),
(14, 'File Blotter', 8, 'filed a blotter.', 10, '22-10-11 06:53:35', 1),
(15, 'Request Document', 13, 'requested a document.', 10, '22-10-11 07:21:12', 1),
(16, 'Request Document', 14, 'requested a document.', 11, '22-10-12 04:28:04', 1),
(17, 'File Blotter', 9, 'filed a blotter.', 11, '22-10-24 12:17:19', 1),
(18, 'File Blotter', 10, 'filed a blotter.', 11, '22-10-24 12:21:06', 1),
(19, 'Request Document', 15, 'requested a document.', 11, '22-10-25 09:32:06', 1),
(20, 'Request Document', 16, 'requested a document.', 11, '22-10-25 10:09:59', 1),
(21, 'Request Document', 17, 'requested a document.', 11, '22-10-25 10:17:11', 1),
(22, 'Request Document', 18, 'requested a document.', 11, '22-10-25 11:18:46', 1),
(23, 'Request Document', 19, 'requested a document.', 11, '22-10-25 11:31:33', 1),
(24, 'Request Document', 19, 'sent a payment.', 11, '22-10-25 11:57:13', 1),
(25, 'Request Document', 20, 'requested a document.', 11, '22-10-25 12:03:10', 1),
(26, 'Request Document', 20, 'sent a payment.', 11, '22-10-25 12:10:29', 1),
(27, 'Request Document', 21, 'requested a document.', 10, '22-10-25 12:13:09', 1),
(28, 'Request Document', 22, 'requested a document.', 10, '22-10-25 12:28:16', 1),
(29, 'File Complaint', 16, 'filed a complaint.', 11, '22-10-25 04:39:53', 1),
(30, 'Send Suggestion', 14, 'sent a suggestion.', 11, '22-10-25 04:55:55', 1),
(31, 'Request Document', 23, 'requested a document.', 11, '22-10-25 05:18:25', 1),
(33, 'Residency Registration', NULL, 'New residency application.', NULL, '22-10-09 02:31:04', 1),
(36, 'Residency Registration', NULL, 'New residency application.', NULL, '22-10-27 05:01:03', 1),
(37, 'Request Document', 24, 'requested a document.', 8, '22-10-28 04:40:35', 1),
(38, 'Request Document', 24, 'sent a payment.', 8, '22-10-28 04:40:47', 1),
(39, 'File Complaint', 17, 'filed a complaint.', 11, '22-10-29 06:49:11', 1),
(40, 'File Complaint', 17, 'filed a complaint.', 8, '22-10-29 06:54:53', 1),
(41, 'File Complaint', 17, 'filed a complaint.', 11, '22-10-29 07:01:23', 1),
(42, 'File Complaint', 17, 'filed a complaint.', 11, '22-10-29 07:02:12', 1),
(43, 'File Complaint', 17, 'filed a complaint.', 11, '22-10-29 07:02:48', 1),
(44, 'File Complaint', 17, 'filed a complaint.', 11, '22-10-29 07:02:55', 1),
(45, 'File Complaint', 18, 'filed a complaint.', 11, '22-10-29 07:04:50', 1),
(46, 'File Complaint', 19, 'filed a complaint.', 11, '22-10-30 01:05:48', 1),
(47, 'Residency Registration', NULL, 'New residency registration.', NULL, '22-10-30 01:14:41', 1),
(48, 'File Blotter', 12, 'filed a blotter.', 8, '22-10-30 11:49:50', 1),
(49, 'Request Document', 25, 'requested a document.', 8, '22-11-02 04:07:47', 1),
(50, 'File Blotter', 13, 'filed a blotter.', 8, '22-11-02 11:08:03', 1),
(51, 'Request Document', 25, 'sent a payment.', 8, '22-11-02 04:11:32', 1),
(52, 'File Complaint', 20, 'filed a complaint.', 8, '22-11-05 01:49:33', 1),
(53, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-05 06:21:44', 1),
(54, 'File Complaint', 21, 'filed a complaint.', 10, '22-11-05 03:58:25', 1),
(55, 'Residency Registration', NULL, 'New residency registration.', NULL, '22-11-05 04:07:17', 1),
(56, 'File Complaint', 22, 'filed a complaint.', 10, '22-11-05 09:12:31', 1),
(57, 'File Complaint', 23, 'filed a complaint.', 10, '22-11-05 09:13:32', 1),
(58, 'Request Document', 26, 'requested a document.', 10, '22-11-05 01:15:14', 1),
(59, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-05 01:32:14', 1),
(60, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-05 01:36:06', 1),
(61, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-05 01:50:47', 1),
(63, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-05 03:09:37', 1),
(64, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-05 03:09:37', 1),
(65, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-05 03:22:52', 1),
(66, 'Request Document', 27, 'requested a document.', 48, '22-11-05 03:27:20', 1),
(67, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 05:20:44', 1),
(68, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 05:28:24', 1),
(69, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 05:29:42', 1),
(70, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 05:34:38', 1),
(71, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 08:52:56', 1),
(72, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 12:18:20', 1),
(73, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 12:18:21', 1),
(74, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 12:56:36', 1),
(75, 'File Complaint', 23, 'filed a complaint.', 55, '22-11-06 09:06:50', 1),
(76, 'File Complaint', 23, 'filed a complaint.', 55, '22-11-06 09:14:14', 1),
(77, 'File Complaint', 23, 'filed a complaint.', 32, '22-11-06 10:03:43', 1),
(78, 'Request Document', 28, 'requested a document.', 32, '22-11-06 02:05:20', 1),
(79, 'File Complaint', 23, 'filed a complaint.', 32, '22-11-06 10:06:58', 1),
(80, 'Residency Registration', NULL, 'New residency registration.', NULL, '22-11-06 10:09:01', 1),
(81, 'File Complaint', 24, 'filed a complaint.', 8, '22-11-06 10:11:54', 1),
(82, 'File Complaint', 25, 'filed a complaint.', 8, '22-11-06 10:12:06', 1),
(83, 'File Complaint', 25, 'filed a complaint.', 32, '22-11-06 10:14:07', 1),
(84, 'File Complaint', 26, 'filed a complaint.', 8, '22-11-06 10:19:48', 1),
(85, 'File Complaint', 27, 'filed a complaint.', 32, '22-11-06 10:21:16', 1),
(86, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-06 02:30:06', 1),
(87, 'Request Document', 29, 'requested a document.', 8, '22-11-06 02:31:44', 1),
(88, 'Request Document', 28, 'sent a payment.', 32, '22-11-06 02:34:11', 1),
(89, 'Request Document', 29, 'sent a payment.', 8, '22-11-06 02:49:40', 1),
(90, 'File Complaint', 28, 'filed a complaint.', 55, '22-11-06 11:33:06', 1),
(91, 'Residency Registration', NULL, 'New residency registration.', NULL, '22-11-07 12:19:20', 1),
(92, 'File Blotter', 15, 'filed a blotter.', 8, '22-11-07 12:24:18', 1),
(93, 'File Complaint', 29, 'filed a complaint.', 8, '22-11-07 05:37:12', 1),
(94, 'File Complaint', 30, 'filed a complaint.', 8, '22-11-07 05:41:44', 1),
(95, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-10 12:59:40', 1),
(96, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-10 01:03:30', 1),
(97, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-11 01:43:04', 1),
(98, 'File Complaint', 31, 'filed a complaint.', 8, '22-11-12 08:40:53', 1),
(99, 'Residency Registration', NULL, 'New residency registration.', NULL, '22-11-12 08:49:51', 0),
(100, 'Residency Registration', NULL, 'New residency registration.', NULL, '22-11-12 08:50:17', 0),
(101, 'Send Suggestion', NULL, 'sent a suggestion.', 8, '8', 0),
(102, 'Send Suggestion', NULL, 'sent a suggestion.', 8, '22-11-12 08:55:56', 0),
(103, 'Send Suggestion', NULL, 'sent a suggestion.', 8, '22-11-12 9:11:10', 0),
(104, 'Send Suggestion', NULL, 'sent a suggestion.', 8, '22-11-12 09:13:23', 0),
(105, 'File Complaint', 32, 'filed a complaint.', 10, '22-11-12 10:53:56', 0),
(106, 'File Complaint', 33, 'filed a complaint.', 10, '22-11-12 10:55:00', 0),
(107, 'File Complaint', 34, 'filed a complaint.', 10, '22-11-12 10:57:53', 0),
(108, 'File Complaint', 35, 'filed a complaint.', 10, '22-11-12 10:58:40', 0),
(109, 'File Complaint', 36, 'filed a complaint.', 10, '22-11-12 11:01:41', 0),
(110, 'File Complaint', 37, 'filed a complaint.', 10, '22-11-12 11:02:20', 0),
(111, 'File Complaint', 38, 'filed a complaint.', 10, '22-11-12 11:03:41', 0),
(112, 'File Complaint', 39, 'filed a complaint.', 10, '22-11-12 11:04:46', 0),
(113, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:06:06', 0),
(114, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:06:55', 0),
(115, 'File Complaint', 40, 'filed a complaint.', 8, '22-11-12 11:07:26', 0),
(116, 'File Complaint', 41, 'filed a complaint.', 29, '22-11-12 11:07:34', 0),
(117, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:07:49', 0),
(118, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:08:39', 0),
(119, 'File Complaint', 42, 'filed a complaint.', 29, '22-11-12 11:09:01', 0),
(120, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:09:33', 0),
(121, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:10:05', 0),
(122, 'File Complaint', 43, 'filed a complaint.', 29, '22-11-12 11:10:27', 0),
(123, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:10:46', 0),
(124, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:11:12', 0),
(125, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:11:29', 0),
(126, 'File Complaint', 44, 'filed a complaint.', 8, '22-11-12 11:12:07', 0),
(127, 'File Complaint', 45, 'filed a complaint.', 29, '22-11-12 11:12:42', 0),
(128, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:13:03', 0),
(129, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:14:31', 0),
(130, 'File Complaint', 46, 'filed a complaint.', 29, '22-11-12 11:15:49', 0),
(131, 'File Complaint', 47, 'filed a complaint.', 10, '22-11-12 11:16:03', 0),
(132, 'File Complaint', 48, 'filed a complaint.', 10, '22-11-12 11:16:22', 0),
(133, 'File Complaint', 49, 'filed a complaint.', 10, '22-11-12 11:16:45', 0),
(134, 'File Complaint', 50, 'filed a complaint.', 29, '22-11-12 11:16:48', 0),
(135, 'File Complaint', 51, 'filed a complaint.', 10, '22-11-12 11:17:13', 0),
(136, 'File Complaint', 52, 'filed a complaint.', 29, '22-11-12 11:17:49', 0),
(137, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:18:18', 0),
(138, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:18:46', 0),
(139, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:19:58', 0),
(140, 'Send Suggestion', NULL, 'sent a suggestion.', 29, '22-11-12 11:20:08', 0),
(141, 'File Complaint', 53, 'filed a complaint.', 8, '22-11-12 11:20:20', 0),
(142, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:20:55', 0),
(143, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:22:15', 0),
(144, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:22:32', 0),
(145, 'Send Suggestion', NULL, 'sent a suggestion.', 29, '22-11-12 11:24:10', 0),
(146, 'Send Suggestion', NULL, 'sent a suggestion.', 8, '22-11-12 11:24:12', 0),
(147, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:24:37', 0),
(148, 'Send Suggestion', NULL, 'sent a suggestion.', 29, '22-11-12 11:24:59', 0),
(149, 'Send Suggestion', NULL, 'sent a suggestion.', 8, '22-11-12 11:25:13', 0),
(150, 'Send Suggestion', NULL, 'sent a suggestion.', 8, '22-11-12 11:26:17', 0),
(151, 'Send Suggestion', NULL, 'sent a suggestion.', 29, '22-11-12 11:26:30', 0),
(152, 'Send Suggestion', NULL, 'sent a suggestion.', 10, '22-11-12 11:27:02', 0),
(153, 'File Blotter', 16, 'filed a blotter.', 10, '22-11-12 11:29:36', 0),
(154, 'File Blotter', 17, 'filed a blotter.', 10, '22-11-12 11:37:34', 0),
(155, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-12 03:40:59', 0),
(156, 'File Blotter', 17, 'filed a blotter.', 10, '22-11-12 11:41:30', 0),
(157, 'File Blotter', 17, 'filed a blotter.', 10, '22-11-13 12:12:02', 0),
(158, 'File Blotter', 20, 'filed a blotter.', 10, '22-11-13 12:15:31', 0),
(159, 'Request Document', 30, 'requested a document.', 10, '22-11-12 04:45:22', 0),
(160, 'Request Document', 31, 'requested a document.', 10, '22-11-12 04:49:09', 0),
(161, 'Request Document', 32, 'requested a document.', 10, '22-11-12 04:49:44', 0),
(162, 'Request Document', 33, 'requested a document.', 10, '22-11-12 04:52:09', 0),
(163, 'Request Document', 34, 'requested a document.', 10, '22-11-12 04:56:51', 0),
(164, 'Request Document', 35, 'requested a document.', 60, '22-11-12 04:58:05', 0),
(165, 'Request Document', 36, 'requested a document.', 10, '22-11-12 04:58:24', 0),
(166, 'Request Document', 37, 'requested a document.', 10, '22-11-12 04:59:01', 0),
(167, 'Request Document', 38, 'requested a document.', 60, '22-11-12 04:59:33', 0),
(168, 'Request Document', 39, 'requested a document.', 10, '22-11-12 04:59:50', 0),
(169, 'Request Document', 40, 'requested a document.', 10, '22-11-12 05:00:43', 0),
(170, 'Request Document', 41, 'requested a document.', 10, '22-11-12 05:04:43', 0),
(171, 'Request Document', 42, 'requested a document.', 60, '22-11-12 05:05:25', 0),
(172, 'Request Document', 43, 'requested a document.', 60, '22-11-12 05:09:03', 0),
(173, 'Request Document', 44, 'requested a document.', 60, '22-11-12 05:09:15', 0),
(174, 'Request Document', 45, 'requested a document.', 60, '22-11-12 05:09:30', 0),
(175, 'Request Document', 46, 'requested a document.', 60, '22-11-12 05:09:43', 0),
(176, 'Request Document', 47, 'requested a document.', 60, '22-11-12 05:10:21', 0),
(177, 'Request Document', 48, 'requested a document.', 10, '22-11-12 05:10:34', 0),
(178, 'Request Document', 49, 'requested a document.', 10, '22-11-12 05:10:56', 0),
(179, 'Request Document', 50, 'requested a document.', 60, '22-11-12 05:10:59', 0),
(180, 'Request Document', 51, 'requested a document.', 60, '22-11-12 05:11:35', 0),
(181, 'Request Document', 52, 'requested a document.', 10, '22-11-12 05:12:01', 0),
(182, 'Request Document', 53, 'requested a document.', 60, '22-11-12 05:12:06', 0),
(183, 'Request Document', 54, 'requested a document.', 10, '22-11-12 05:13:04', 0),
(184, 'File Blotter', 21, 'filed a blotter.', 10, '22-11-13 01:14:22', 0),
(185, 'File Blotter', 22, 'filed a blotter.', 10, '22-11-13 01:16:14', 0),
(186, 'File Blotter', 23, 'filed a blotter.', 10, '22-11-13 01:17:42', 0),
(187, 'File Blotter', 24, 'filed a blotter.', 10, '22-11-13 01:19:36', 0),
(188, 'File Blotter', 25, 'filed a blotter.', 10, '22-11-13 01:19:37', 0),
(189, 'File Blotter', 26, 'filed a blotter.', 60, '22-11-13 01:21:37', 0),
(190, 'File Blotter', 27, 'filed a blotter.', 10, '22-11-13 01:21:53', 0),
(191, 'File Blotter', 28, 'filed a blotter.', 60, '22-11-13 01:27:56', 0),
(192, 'File Blotter', 29, 'filed a blotter.', 60, '22-11-13 01:33:51', 0),
(193, 'File Blotter', 30, 'filed a blotter.', 60, '22-11-13 01:34:51', 0),
(194, 'File Blotter', 31, 'filed a blotter.', 60, '22-11-13 01:40:24', 0),
(195, 'File Complaint', 54, 'filed a complaint.', 55, '22-11-13 01:46:47', 0),
(196, 'File Complaint', 55, 'filed a complaint.', 55, '22-11-13 01:46:57', 0),
(197, 'File Blotter', 32, 'filed a blotter.', 60, '22-11-13 02:59:07', 0),
(198, 'Residency Registration', NULL, 'New residency application.', NULL, '22-11-12 07:04:23', 1),
(199, 'File Blotter', 33, 'filed a blotter.', 61, '22-11-13 03:11:15', 0),
(200, 'File Blotter', 34, 'filed a blotter.', 60, '22-11-13 03:12:19', 0),
(201, 'File Blotter', 35, 'filed a blotter.', 61, '22-11-13 03:13:19', 0),
(202, 'File Blotter', 35, 'filed a blotter.', 61, '22-11-13 03:15:27', 0),
(203, 'File Blotter', 37, 'filed a blotter.', 8, '22-11-13 03:17:53', 0),
(204, 'File Blotter', 38, 'filed a blotter.', 61, '22-11-13 03:18:02', 0),
(205, 'File Blotter', 39, 'filed a blotter.', 61, '22-11-13 03:20:10', 0),
(206, 'File Blotter', 40, 'filed a blotter.', 60, '22-11-13 03:20:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `descrip` varchar(200) NOT NULL,
  `date` datetime(6) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `img_url`, `descrip`, `date`, `status`) VALUES
(1, 'SK San Juan Volleyball League', 'IMG-636facf0c70697.68167659.jpg', 'Good Day Guys! \r\n\r\nPaparating na po ang SK VOLLEYBALL LEAGUE 3.0\r\nKita kits po tayo sa Caingin Covered Court at exactly 2:00PM!\r\nJULY 10, 2022\r\n\r\nParticipating teams:\r\n\r\nMen’s Division\r\nCaingin\r\nCaing', '2022-11-12 10:25:52.000000', 'active'),
(2, 'Voter Registration Starts Today', 'IMG-636fad2d615275.36772695.jpg', 'Magparehistro Ka ✍️\r\n\r\nPara sa darating na 2022 Barangay and SK elections\r\n-SK Voters: 15-30 years old\r\n-Regular Voters: 18 years old and above \r\n\r\nMagdala lang ng valid ID at ballpen \r\n\r\nAng opisina ', '2022-11-12 10:26:53.000000', 'active'),
(3, 'Oplan Tuli Registration', 'IMG-636fad5707f326.17740948.jpg', '\r\nOCCUPIED NA PO ANG ATING 60 slots FOR OPLAN TULI OPERATION.\r\n\r\nMakipag ugnayan nalang po dito sa aming facebook page, kung kayo ay may mga katanungan.\r\n\r\nMaraming Salamat Po! 💚', '2022-11-12 10:27:35.000000', 'active'),
(4, 'Traffic Advisory', 'IMG-636fad792168d5.50318607.jpg', '𝗡𝗢𝗧𝗜𝗖𝗘 𝗧𝗢 𝗧𝗛𝗘 𝗣𝗨𝗕𝗟𝗜𝗖\r\n𝗧𝗿𝗮𝗳𝗳𝗶𝗰 𝗔𝗱𝘃𝗶𝘀𝗼𝗿𝘆\r\n\r\nExpect medium to heavy traffic on April 7, 2022, 8:00AM at T. Claudio St. (Poblacion), Sagbat, and Manila East Rd. (Lagundi-Maybancal) due to 3rd Anniversary ', '2022-11-12 10:28:09.000000', 'active'),
(5, 'Covid19 Update', 'IMG-636fad8fe9b6e8.17778533.jpg', 'COVID19 UPDATE\r\n\r\nNEW CASES\r\nP1714 35/M \r\nNO KNOWN EXPOSURE \r\nBOMBONGAN\r\n\r\nP1715 28/M \r\nNO KNOWN EXPOSURE \r\nBOMBONGAN\r\n\r\nRECOVERIES\r\nP1704\r\nP1705\r\nP1711', '2022-11-12 10:28:31.000000', 'active');

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
  `background_url` varchar(100) DEFAULT NULL,
  `telephone_number` varchar(10) NOT NULL,
  `bgy_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bgy_info`
--

INSERT INTO `bgy_info` (`id`, `color_theme`, `logo_url`, `bgy_name`, `vision`, `mission`, `city`, `background_url`, `telephone_number`, `bgy_email`) VALUES
(1, '#ff7300', 'IMG-636f80a83eed64.06099132.jpg', '310', 'We envision the Barangay Pico to be more progressive, loving and peaceful place to live in where people and residents enjoy harmonious way of life, business, at work and at home, and most especially for a more directed and progressive Barangay Governance.', 'We commit to perform better duties and responsibilities to carry out the plans and objectives of the barangay thru voluntary and excellent performance, most especially in the delivery of the basic needs such as improved roads and environment, water system, health care, education, housing and agricultural farming needs of the farmers and residents of the barangay.', 'Manila ', 'IMG-636f80a83f7617.83553297.jpg', '0287779571', 'barangay310@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `blotter_table`
--

CREATE TABLE `blotter_table` (
  `blotter_ID` int(11) NOT NULL,
  `official_ID` int(11) DEFAULT NULL,
  `complainant_ID` int(11) NOT NULL,
  `complainee_ID` int(11) DEFAULT NULL,
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
(2, 5, 9, 8, 'Bernard Kabiling Mazo', '2022-10-01', '23:38:00', 'stafa', 'hindi nag babayad ng utang', '0000-00-00', '00:00:00', 'magbabayad ng buo sa nov 11, 2022', 'unsettled'),
(3, NULL, 9, NULL, 'Kyrie Irving', '2022-10-13', '23:42:00', 'Stafa', 'Inistafa yung pusta namin sa basketball', '0000-00-00', '00:00:00', 'magbabayad ng buo sa nov 11, 2022', 'unscheduled'),
(4, 5, 9, NULL, 'Lebron James', '2022-09-28', '23:42:00', 'Play and Run', 'hindi nag bayad ng pang schedule', '2022-10-19', '12:52:00', 'magbabayad ng buo sa nov 11, 2022', 'settled'),
(5, 5, 9, 10, 'Charles Wilcent Ilustre Urbano', '0000-00-00', '13:02:00', 'Nanuntok', 'nanuntok ng limang tao', '2022-10-12', '08:37:00', '', 'unscheduled'),
(7, 5, 11, 10, 'Charles Wilcent Ilustre Urbano', '2022-09-29', '22:19:00', 'nanipa', 'sinipa kapatid ko', '2022-10-14', '22:06:00', '', 'scheduled'),
(8, 5, 10, 29, 'john daniel san juan policarpio', '0000-00-00', '00:54:00', 'nanapak', 'sinapak ako sa kanto', '2022-10-20', '21:38:00', '', 'unscheduled'),
(9, 5, 11, NULL, 'Jhepoy Dizon', '0000-00-00', '18:20:00', 'Bully', 'bullying', '2022-10-07', '21:14:00', '', 'unscheduled'),
(10, 5, 11, NULL, 'Wilson The Goat', '0000-00-00', '18:23:00', 'Maingay', 'madaling araw na karaoke pa rin', '2022-10-14', '21:40:00', '', 'scheduled'),
(12, NULL, 8, 9, 'Christian Philip Diff Orsolino', '2022-10-05', '23:51:00', 'Bullying', 'bullying me', '0000-00-00', NULL, '', 'cancelled'),
(13, NULL, 8, 34, 'Bernandito Malacas Mazo', '2022-11-20', '11:11:00', 'bullying', 'nangingikil sa labas ng school', '0000-00-00', NULL, '', 'cancelled'),
(15, NULL, 8, 44, 'Banana Goat Apple', '2022-11-07', '00:24:00', 'Nanuntok', 'sinuntok sa mukha palakda yung bata', '0000-00-00', NULL, '', 'unscheduled'),
(16, NULL, 10, 40, 'Nardo Kabiling Mazo', '2022-11-07', '14:31:00', 'Bully', 'Bully po inaaway mga aso dito samen', '0000-00-00', NULL, '', 'unscheduled'),
(17, NULL, 10, 8, 'Bernard Kabiling Mazo', '2022-11-10', '00:37:00', 'animal cruelty', 'Namamalo ng pusa', '0000-00-00', NULL, '', 'unscheduled'),
(20, NULL, 10, 60, 'Al Rashied Buenavista Idris', '2022-11-10', '00:16:00', 'nagpapasugal', 'nagpapasugal dito samen baka hindi po legal', '0000-00-00', NULL, '', 'unscheduled'),
(21, NULL, 10, 44, 'Banana Goat Apple', '2022-11-14', '13:13:00', 'nanuntok', 'lakas mag trip dame sinuntok sa daan. ', '0000-00-00', NULL, '', 'unscheduled'),
(22, NULL, 10, 17, 'John  Wall', '2022-11-07', '09:16:00', 'Di na sumisipot', 'kinuha po nameng import di na sumisipot sa laro', '0000-00-00', NULL, '', 'unscheduled'),
(23, NULL, 10, 8, 'Bernard Kabiling Mazo', '2022-11-11', '13:16:00', 'scammer', 'gumawa ng paluwagan sa eskinita namen pero di na nagpapa sweldo', '0000-00-00', NULL, '', 'unscheduled'),
(24, NULL, 10, 8, 'Bernard Kabiling Mazo', '2022-10-31', '13:22:00', 'brawl fight', 'nanapak ng kalaban matapos mapikon sa basketball', '0000-00-00', NULL, '', 'unscheduled'),
(25, NULL, 10, 8, 'Bernard Kabiling Mazo', '2022-10-31', '13:22:00', 'brawl fight', 'nanapak ng kalaban matapos mapikon sa basketball', '0000-00-00', NULL, '', 'unscheduled'),
(26, NULL, 60, 9, 'Christian Philip Diff Orsolino', '2022-01-07', '12:14:00', 'Stealing', 'Kinuha niya po yung iniihaw ko na isda', '0000-00-00', NULL, '', 'unscheduled'),
(27, NULL, 10, 47, 'Shinna Marie Gonzales  Gonzales', '2022-11-11', '13:20:00', 'marites', 'lagi po maingay dito nakaka perwisyo na', '0000-00-00', NULL, '', 'unscheduled'),
(28, NULL, 60, 9, 'Christian Philip Diff Orsolino', '2022-02-17', '01:27:00', 'Akyat bahay', 'Umakyat po sa bahay namin ng paalam', '0000-00-00', NULL, '', 'unscheduled'),
(29, NULL, 60, 10, 'Charles Wilcent Ilustre Urbano', '2022-03-15', '16:35:00', 'Hindi nag babayad ng utang', '1 month na po hindi nag babayad ng utang', '0000-00-00', NULL, '', 'unscheduled'),
(30, NULL, 60, 40, 'Nardo Kabiling Mazo', '2022-08-03', '04:34:00', 'Nangunguha po ng tsinelas', 'Kinuhya niya po yung bagong bili kong tsinelas ', '0000-00-00', NULL, '', 'unscheduled'),
(31, NULL, 60, 14, 'Lebron  James', '2022-07-08', '06:40:00', 'Physical attack', 'Sinuntok niya po ako kahit napadaan lang po ako sa eskinita', '0000-00-00', NULL, '', 'unscheduled'),
(32, NULL, 60, 48, 'Christian Cabrera Mangulabnab', '2022-02-17', '16:19:00', 'Physical assault', 'Sinaktan niya po yung anak ko', '0000-00-00', NULL, '', 'unscheduled'),
(33, NULL, 61, 55, 'Blue Abenson Orso', '2022-11-02', '16:12:00', 'bullying', 'nang haharas para bigyan sya ng pera', '0000-00-00', NULL, '', 'unscheduled'),
(34, NULL, 60, 17, 'John  Wall', '2022-04-09', '09:25:00', 'Stealing', 'Ninakaw niya po yung sapatos na naiwan ko sa court', '0000-00-00', NULL, '', 'unscheduled'),
(35, NULL, 61, 10, 'Charles Wilcent Ilustre Urbano', '2022-11-03', '15:12:00', 'nagnakaw', 'pumuslit ng itlog  sa tindahan namen. Kita sya sa CCTV. Nag smile pa ', '0000-00-00', NULL, '', 'unscheduled'),
(37, NULL, 8, 29, 'John Daniel San Juan Policarpio', '2022-11-13', '15:19:00', 'mag nanakaw ng tsinelas', 'ninakaw yung tsinelas ko, limang beses na', '0000-00-00', NULL, '', 'unscheduled'),
(38, NULL, 61, 52, 'Helbert B Capada', '2022-11-04', '15:17:00', 'nambabato ng bubong', 'nambabato ng bubong tuwing madaling araw, kanina lang nakita sa cctv ', '0000-00-00', NULL, '', 'unscheduled'),
(39, NULL, 61, 59, 'Yuki Kabiling Mazo', '2022-11-04', '15:22:00', 'nagnakaw', 'nagnakaw ng tinola pamulutan ata nila patungo sa nagiinuman eh', '0000-00-00', NULL, '', 'unscheduled'),
(40, NULL, 60, 13, 'Kobe  Bryant', '2022-06-08', '18:16:00', 'harassment', 'Lagi niya po ako pinapainom sa tuwing dadaan ako sa eskinita, kahit ayaw ko po pinipilit niya po ako', '0000-00-00', NULL, '', 'unscheduled');

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
(1, 5, 9, 'Dirty Barangay', 'maruming lugar', '2022-09-26', 'IMG-6331aa2bdf2245.84869776.png', 'solved'),
(2, 5, 9, 'Drugs', 'drugs drugs drugs drugs drugs', '2022-09-26', 'IMG-6331aa8ac786d0.08725937.png', 'solved'),
(3, 5, 9, 'Gossip Mongers', 'Wilcent urbano ang ngalan', '2022-09-27', 'IMG-6332ec0067dd74.43852234.png', 'solved'),
(4, 5, 9, 'Noise', 'Noisy Karaoke', '2022-09-27', 'IMG-6332ece1b2b828.26135177.png', 'solved'),
(7, 5, 9, 'Drugs', 'may bentahan ata ng mj sa purok dos narinig ko lang usapan ng mga tambay.', '2022-09-27', 'IMG-6333053e5fcb96.27694649.png', 'solved'),
(9, 6, 9, 'Gossip Mongers', 'tsismosa', '2022-09-28', '', 'solved'),
(10, 6, 9, 'Other', 'SUGALAN SA KANTO', '2022-09-28', '', 'solved'),
(11, 44, 9, 'Other', 'illegal parking', '2022-09-28', '', 'solved'),
(12, NULL, 9, 'Other', 'sugalan', '2022-10-17', 'IMG-633453d006e131.68377680.jpg', 'pending'),
(13, 5, 9, 'Other', 'illegal parking', '2022-10-17', 'IMG-633453de511e23.56622787.jpg', 'solved'),
(14, 5, 9, 'Dirty Barangay', 'street 1 is very dirty', '2022-10-17', 'IMG-63346d10292875.87716455.jpg', 'solved'),
(15, 5, 9, 'Dirty Barangay', 'ang dameng kalat sa kanal malapit sa tinagan corner', '2022-10-18', 'IMG-634563a9e852f8.39870037.jpg', 'solved'),
(16, NULL, 11, 'Sugalan', 'Sugalan sa kanto', '2022-10-25', 'IMG-6357f538e709c0.67166961.jpg', 'pending'),
(17, NULL, 11, 'Dirty Barangay', 'nagkalat po mga dumi ng aso', '2022-10-29', 'IMG-635d5987b47342.25145990.jpg', 'pending'),
(18, NULL, 11, 'Dirty Barangay', 'nagkalat ng basura mga bata dito sa kanto trese', '2022-10-29', '', 'pending'),
(19, NULL, 11, 'Dirty Barangay', 'liters everywhere. Here in Tinagan Street', '2022-10-30', '', 'pending'),
(20, NULL, 8, 'Dirty Barangay', 'basura sa tabe ng kanal ang dame po', '2022-11-05', '', 'pending'),
(21, NULL, 10, 'Dirty Barangay', 'Testing only', '2022-11-05', '', 'pending'),
(22, NULL, 10, 'Dirty Barangay', 'dame basura ', '2022-11-05', '', 'pending'),
(23, NULL, 10, 'Dirty Barangay', 'nagkalat balat ng saging sa daan', '2022-11-05', '', 'pending'),
(24, NULL, 8, 'Dirty Barangay', 'Kalat po dito sa kanto ng tinagan', '2022-11-06', '', 'pending'),
(25, NULL, 8, 'Noise', 'Karaoke 10 pm na po', '2022-11-06', '', 'pending'),
(26, NULL, 8, 'Dirty Barangay', 'dame basura sa kanto', '2022-11-06', 'IMG-6367c284b923e4.84405112.jpg', 'pending'),
(27, 5, 32, 'Noise', 'Too much noise from our neighbor ', '2022-11-06', 'IMG-6367c2dc616194.56001415.jpg', 'solved'),
(28, NULL, 55, 'Dirty Barangay', 'tagal po ng truck ng basura 2 days delay pwede po bang ma contact yun?', '2022-11-06', '', 'pending'),
(29, NULL, 8, 'Dirty Barangay', 'nagkalat ng papel mga dayo paki linis po', '2022-11-07', 'IMG-6368d1c8bc3745.06565415.jpg', 'pending'),
(30, 5, 8, 'Dirty Barangay', 'kalat sa purok dos ', '2022-11-07', 'IMG-6368d2d8157542.27695252.jpg', 'solved'),
(31, 5, 8, 'Dirty Barangay', 'madumi ditto sa purok 1', '2022-11-12', '', 'solved'),
(32, NULL, 10, 'Noise', 'Ingay ng mga aso sa kapitbahay namen.', '2022-11-12', '', 'pending'),
(33, NULL, 10, 'Dirty Barangay', 'Dame ng basura nagkalat sa tinagan street', '2022-11-12', '', 'pending'),
(34, NULL, 10, 'Noise', 'Karaoke at night here in Tondo ', '2022-11-12', '', 'pending'),
(35, NULL, 10, 'Gossip Mongers', 'Grabe chismosa dito mas alam pa ata nila yung tunay na nangyari', '2022-11-12', '', 'pending'),
(36, NULL, 10, 'Manhole', 'Sira Manhole dito. Ah barado sa street 23\r\n', '2022-11-12', '', 'pending'),
(37, NULL, 10, 'Noise', 'Ingay ng mga aso kapag nakakakita ng tao', '2022-11-12', '', 'pending'),
(38, NULL, 10, 'Gossip Mongers', 'Iingay ng mga marites sa kanto, Grabe kumpulan nila parang walang Covid.', '2022-11-12', '', 'pending'),
(39, NULL, 10, 'Face mask issue', 'Walang facemask mga tambay dito sa sitio 3\r\n', '2022-11-12', '', 'pending'),
(40, NULL, 8, 'Dirty Barangay', 'Nagtatapon po ng kalat yung kapitbahay namin sa bakuran namin.', '2022-11-12', '', 'pending'),
(41, NULL, 29, 'Noise', 'Meron mga kabataan dito sa labas namin sa wawa mga nag iinom sobrang ingay hindi nag papatulog.', '2022-11-12', '', 'pending'),
(42, NULL, 29, 'Dirty Barangay', 'meron mga kabataan na nag tatapon ng basura dito sa tapat naminkahit kahit meron ng nakikitang basur', '2022-11-12', '', 'pending'),
(43, NULL, 29, 'Drugs', 'meron mga pabalik balik dito samin na mga hindi taga dito sana makareponde agad kayo ng maaga.', '2022-11-12', '', 'pending'),
(44, NULL, 8, 'Noise', 'Lagi po nag karaoke yung kaptibahay namin tuwing madaling araw', '2022-11-12', '', 'pending'),
(45, NULL, 29, 'Gossip Mongers', 'may mga tsismosa dito samin nagkakalat ng maling balita', '2022-11-12', '', 'pending'),
(46, NULL, 29, 'Away', 'Meron mga nagaaway dito na mga kabataan madaming nadadamay.', '2022-11-12', '', 'pending'),
(47, NULL, 10, 'Dirty Barangay', 'Dame po ng basura sa may ilog nakaka bother', '2022-11-12', '', 'pending'),
(48, NULL, 10, 'Baha', 'Grabe onting ulan ang bilis bumaha', '2022-11-12', '', 'pending'),
(49, NULL, 10, 'Baradong Kanal', 'Barado po ulit yung kanal dito sa sitio3', '2022-11-12', '', 'pending'),
(50, NULL, 29, 'Drugs', 'meron mga paulik ulik dito samin mga hindi taga dito nagtutulak ng droga.', '2022-11-12', '', 'pending'),
(51, NULL, 10, 'Noise', 'Ingay po ng mga tao dito lakas magpatugtog sa sitio2', '2022-11-12', '', 'pending'),
(52, NULL, 29, 'Drugs', 'may mga kabataan ng gumagamit ng cocaine paki respondehan agad.', '2022-11-12', '', 'pending'),
(53, NULL, 8, 'Dirty Barangay', 'Lagi po nag tatambak ng basura sa gilid ng bahay namin kahit hindi naman tapunan', '2022-11-12', '', 'pending'),
(54, NULL, 55, 'Drugs', '...', '2022-11-13', 'IMG-636fdc0740f6e9.66929703.jpg', 'pending'),
(55, NULL, 55, 'Dirty Barangay', 'asdasdasdasdasdsa', '2022-11-13', '', 'pending');

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
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document_request`
--

INSERT INTO `document_request` (`request_ID`, `official_ID`, `resident_ID`, `document_ID`, `purpose`, `quantity`, `payment`, `request_date`, `status`) VALUES
(1, NULL, 7, 1, 'school requirement', 1, 'payment.jpg', '2022-09-22', 'pending for verification'),
(3, NULL, 9, 1, 'business', 12, 'RCPT-633afecac5b085.95733661.jpg', '2022-10-03', 'pending for verification'),
(4, NULL, 9, 2, 'business', 1, 'RCPT-633afee90462b9.73775231.jpg', '2022-10-03', 'pending for verification'),
(5, 5, 11, 2, 'business', 1, 'RCPT-633d9a114cf799.84391831.jpg', '2022-10-05', 'completed'),
(6, 5, 11, 3, 'school', 1, 'RCPT-633da47ab3f616.59006446.jpg', '2022-10-05', 'completed'),
(7, NULL, 9, 2, 'Business', 1, 'RCPT-6342bf2cd197e4.93863445.jpg', '2022-10-09', 'pending for verification'),
(8, NULL, 9, 3, 'School Requirement', 1, 'RCPT-6342bf801995f8.50901645.jpg', '2022-10-09', 'pending for verification'),
(9, NULL, 29, 2, 'business', 1, 'RCPT-6342e30774d612.08680000.jpg', '2022-10-09', 'pending for verification'),
(10, NULL, 29, 1, 'School Purposes', 2, 'RCPT-6342e70e7d8920.44333261.jpg', '2022-10-09', 'pending for verification'),
(11, 5, 11, 1, 'School Requirement', 1, 'RCPT-63442b0f908dc0.42865164.jpg', '2022-10-10', 'completed'),
(12, 5, 11, 1, 'business', 1, 'RCPT-634439fca71343.47009202.jpg', '2022-10-10', 'completed'),
(13, 5, 10, 1, 'business', 1, 'RCPT-6345a60822dfe1.60325593.jpg', '2022-10-11', 'completed'),
(14, 5, 11, 1, 'business', 1, 'RCPT-6346cef3ee8d77.36395853.jpg', '2022-10-12', 'completed'),
(15, 5, 11, 1, 'business', 1, 'RCPT-635790f68f7ce2.49300989.jpg', '2022-10-25', 'completed'),
(16, NULL, 11, 2, 'business', 1, 'RCPT-635799d78d2dd6.73321742.jpg', '2022-10-25', 'pending for verification'),
(17, NULL, 11, 1, 'School Purposes', 1, 'RCPT-63579b87877ce0.79188127.jpg', '2022-10-25', 'cancelled'),
(18, NULL, 11, 3, 'School Purposes', 1, '', '2022-10-25', 'cancelled'),
(19, NULL, 11, 1, 'School Purposes', 1, 'RCPT-6357b2f949f6e7.82317662.jpg', '2022-10-25', 'pending for verification'),
(20, 5, 11, 2, 'adasd', 2, 'RCPT-6357b615683a93.45292356.jpg', '2022-10-25', 'completed'),
(21, NULL, 10, 2, 'school', 1, '', '2022-10-25', 'pending for payment'),
(22, NULL, 10, 3, 'School Purposes', 3, '', '2022-10-25', 'pending for payment'),
(23, NULL, 11, 1, 'School Purposes', 3, '', '2022-10-25', 'pending for payment'),
(24, 5, 8, 1, 'school', 1, 'RCPT-635be9ef7e2571.50044956.jpg', '2022-10-28', 'completed'),
(25, 5, 8, 1, 'School Purposes', 1, 'RCPT-6361dfe4988d42.61837782.jpg', '2022-11-02', 'completed'),
(26, NULL, 10, 1, 'try', 1, '', '2022-11-05', 'cancelled'),
(27, NULL, 48, 2, 'Scholarship', 1, '', '2022-11-05', 'pending for payment'),
(28, 5, 32, 3, 'For work purposes only. ', 1, 'RCPT-6367c5e304e8f1.63059399.png', '2022-11-06', 'completed'),
(29, 5, 8, 1, 'school', 1, 'RCPT-6367c98403ca52.44798778.jpg', '2022-11-06', 'completed'),
(30, NULL, 10, 1, 'for work', 1, '', '2022-11-12', 'pending for payment'),
(31, NULL, 10, 2, 'scholarship', 1, '', '2022-11-12', 'pending for payment'),
(32, NULL, 10, 1, 'work related', 1, '', '2022-11-12', 'pending for payment'),
(33, NULL, 10, 2, 'scholarship purposes', 1, '', '2022-11-12', 'pending for payment'),
(34, NULL, 10, 1, 'business', 1, '', '2022-11-12', 'pending for payment'),
(35, NULL, 60, 1, 'Para po sa scholarship', 1, '', '2022-11-12', 'pending for payment'),
(36, NULL, 10, 1, 'apply po ko work', 1, '', '2022-11-12', 'pending for payment'),
(37, NULL, 10, 3, 'for scholarship', 1, '', '2022-11-12', 'pending for payment'),
(38, NULL, 60, 3, 'Para po sa work need lang po', 1, '', '2022-11-12', 'pending for payment'),
(39, NULL, 10, 1, 'business related', 1, '', '2022-11-12', 'pending for payment'),
(40, NULL, 10, 3, 'for my business', 1, '', '2022-11-12', 'pending for payment'),
(41, NULL, 10, 1, 'aapply po ako office work', 1, '', '2022-11-12', 'pending for payment'),
(42, NULL, 60, 1, 'para po sakin kailangan ko lang in case po na may need na important documents', 1, '', '2022-11-12', 'pending for payment'),
(43, NULL, 60, 2, 'Kailangan daw po ni nanay para sa work niya', 1, '', '2022-11-12', 'pending for payment'),
(44, NULL, 60, 1, 'Kailangan po ni kuya para sa work niya', 1, '', '2022-11-12', 'pending for payment'),
(45, NULL, 60, 1, 'Kailangan po ni ate para sa scholarship niya', 1, '', '2022-11-12', 'pending for payment'),
(46, NULL, 60, 1, 'Kailangan po ni tatay para sa work niya po', 1, '', '2022-11-12', 'pending for payment'),
(47, NULL, 60, 3, 'Kailangan ko po para sa trabaho', 1, '', '2022-11-12', 'pending for payment'),
(48, NULL, 10, 3, 'scholarship purposes', 1, '', '2022-11-12', 'pending for payment'),
(49, NULL, 10, 2, 'CHED scholarship', 1, '', '2022-11-12', 'pending for payment'),
(50, NULL, 60, 3, 'Kailangan po ni tito para sa trabaho niya', 1, '', '2022-11-12', 'pending for payment'),
(51, NULL, 60, 1, 'Kailangan ko lang po para ma kumpleto ang important documents ko para sa trabaho', 1, '', '2022-11-12', 'pending for payment'),
(52, NULL, 10, 1, 'business ', 1, '', '2022-11-12', 'pending for payment'),
(53, NULL, 60, 3, 'Kailangan ko po para bukas makapag apply na sa work', 1, '', '2022-11-12', 'pending for payment'),
(54, NULL, 10, 2, 'para may allowance po', 1, '', '2022-11-12', 'pending for payment');

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
(1, '07:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_logs`
--

CREATE TABLE `healthcare_logs` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `healthcare_logs`
--

INSERT INTO `healthcare_logs` (`id`, `patient_id`, `fullname`, `date`, `time`, `reason`) VALUES
(2, 8, 'Bernard Kabiling Mazo', '2022-09-19', '15:51:01', 'allergy'),
(3, 9, 'Christian Philip Diff Orsolino', '2022-09-19', '15:52:12', 'allergy'),
(4, NULL, '', '2022-09-19', '16:19:02', 'fever'),
(5, NULL, '', '2022-09-19', '16:21:05', 'stomach ache'),
(6, NULL, '', '2022-09-19', '16:25:41', 'headache'),
(7, NULL, 'Denver Mazo', '2022-09-19', '16:29:04', 'checkup'),
(8, NULL, '10', '2022-09-19', '16:29:17', 'vaccination'),
(9, NULL, '10', '2022-09-19', '16:29:55', 'checkup'),
(10, 10, 'Charles Wilcent Ilustre Urbano', '2022-09-19', '16:40:47', 'fever'),
(11, NULL, 'Charles', '2022-09-19', '16:41:23', 'allergy'),
(12, 38, 'Bernard Kabilin Mazo', '2022-10-10', '18:38:40', 'stomach ache 1'),
(13, 38, 'Bernard Kabilin Mazo', '2022-11-01', '16:18:20', 'headachea'),
(14, NULL, 'asdas', '2022-11-01', '23:24:19', 'asdaaasdasd'),
(15, 44, 'Banana Goat Apple', '2022-11-07', '01:04:26', 'fever');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `user_id`, `date_time`) VALUES
(1, 8, '2022-11-12 12:04:09'),
(2, 8, '0000-00-00 00:00:00'),
(3, 8, '2022-11-12 12:31:29'),
(4, 8, '2022-11-12 05:51:39'),
(5, 10, '0000-00-00 00:00:00'),
(6, 8, '2022-11-12 07:16:36'),
(7, 8, '0000-00-00 00:00:00'),
(8, 8, '0000-00-00 00:00:00'),
(9, 10, '0000-00-00 00:00:00'),
(10, 10, '2022-11-12 09:56:46'),
(11, 10, '0000-00-00 00:00:00'),
(12, 10, '0000-00-00 00:00:00'),
(13, 10, '2022-11-12 10:51:53'),
(14, 30, '0000-00-00 00:00:00'),
(15, 8, '0000-00-00 00:00:00'),
(16, 8, '2022-11-12 11:05:09'),
(17, 30, '2022-11-12 11:39:16'),
(18, 8, '0000-00-00 00:00:00'),
(19, 10, '2022-11-12 11:47:27'),
(20, 8, '2022-11-12 11:53:32'),
(21, 10, '0000-00-00 00:00:00'),
(22, 10, '2022-11-13 12:06:39'),
(23, 30, '0000-00-00 00:00:00'),
(24, 30, '2022-11-13 12:08:58'),
(25, 30, '0000-00-00 00:00:00'),
(26, 30, '2022-11-13 12:09:27'),
(27, 8, '2022-11-13 12:09:44'),
(28, 30, '0000-00-00 00:00:00'),
(29, 30, '2022-11-13 12:10:22'),
(30, 8, '0000-00-00 00:00:00'),
(31, 66, '2022-11-13 12:10:28'),
(32, 8, '2022-11-13 12:10:34'),
(33, 67, '0000-00-00 00:00:00'),
(34, 30, '0000-00-00 00:00:00'),
(35, 30, '2022-11-13 12:12:35'),
(36, 67, '0000-00-00 00:00:00'),
(37, 66, '2022-11-13 12:13:33'),
(38, 30, '0000-00-00 00:00:00'),
(39, 67, '0000-00-00 00:00:00'),
(40, 30, '0000-00-00 00:00:00'),
(41, 67, '0000-00-00 00:00:00'),
(42, 8, '2022-11-13 12:15:32'),
(43, 30, '0000-00-00 00:00:00'),
(44, 30, '2022-11-13 12:16:24'),
(45, 67, '0000-00-00 00:00:00'),
(46, 67, '0000-00-00 00:00:00'),
(47, 30, '2022-11-13 12:18:27'),
(48, 10, '2022-11-13 12:19:02'),
(49, 66, '2022-11-13 12:20:01'),
(50, 66, '2022-11-13 12:20:36'),
(51, 66, '2022-11-13 12:21:10'),
(52, 67, '2022-11-13 12:21:57'),
(53, 67, '0000-00-00 00:00:00'),
(54, 67, '2022-11-13 12:22:39'),
(55, 30, '0000-00-00 00:00:00'),
(56, 30, '2022-11-13 01:04:44'),
(57, 66, '2022-11-13 01:05:02'),
(58, 30, '2022-11-13 01:05:17'),
(59, 30, '2022-11-13 01:07:56'),
(60, 30, '2022-11-13 01:09:00'),
(61, 30, '2022-11-13 01:09:00'),
(62, 30, '2022-11-13 01:09:49'),
(63, 30, '0000-00-00 00:00:00'),
(64, 8, '2022-11-13 01:12:25'),
(65, 8, '0000-00-00 00:00:00'),
(66, 8, '2022-11-13 01:15:03'),
(67, 61, '0000-00-00 00:00:00'),
(68, 61, '2022-11-13 01:16:05'),
(69, 8, '0000-00-00 00:00:00'),
(70, 8, '2022-11-13 01:24:57'),
(71, 57, '0000-00-00 00:00:00'),
(72, 57, '0000-00-00 00:00:00'),
(73, 57, '0000-00-00 00:00:00'),
(74, 10, '2022-11-13 01:50:19'),
(75, 8, '2022-11-13 02:15:28'),
(76, 8, '0000-00-00 00:00:00'),
(77, 8, '2022-11-13 02:53:22'),
(78, 8, '0000-00-00 00:00:00'),
(79, 30, '2022-11-13 03:05:17'),
(80, 68, '0000-00-00 00:00:00'),
(81, 8, '0000-00-00 00:00:00'),
(82, 8, '2022-11-13 03:19:22'),
(83, 8, '2022-11-13 03:20:09');

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
(6, 'User Management', 'yes'),
(7, 'Reports', 'yes'),
(8, 'Logs', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `g_name` text NOT NULL,
  `cp_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`g_name`, `cp_number`) VALUES
('BERNARD MAZO', '09616064483');

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

INSERT INTO `registration` (`id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `birthplace`, `civilstatus`, `birthday`, `unitnumber`, `purok`, `sitio`, `street`, `subdivision`, `contactnumber`, `email`, `religion`, `occupation`, `educational`, `nationality`, `disability`, `status`, `img_path`) VALUES
(7, 'Lenz Janielle', 'Lim', 'Gerongco', '', 'female', 'Laguna', 'Single', '2022-10-12', 1004, 'Purok 3', 'sitio 2', 'TELECOM', 'tinagan', '9123456789', 'lenzgerongco@yahoo.com', 'Roman Catholic', 'Flight attendant', 'College', 'Filipino', 'none', 'accepted', 'IMG-631219de1abde9.41773945.jpg'),
(8, 'Bernard', 'Kabiling', 'Mazo', '', 'male', 'Manila', 'Single', '2022-10-13', 1759, 'purok 1', 'sitio 1', 'TELECOM', 'tinagan', '9616064483', 'nard_mazo@gmail.com', 'Roman Catholic', 'Programmer', 'College', 'Filipino', 'none', 'accepted', 'IMG-63121afc4c1067.08242643.jpg'),
(9, 'Christian Philip', 'Diff', 'Orsolino', '', 'male', 'Manila', 'Single', '2022-10-14', 1000, 'purok 1', 'sitio 2', 'TELECOM', 'tinagan', '9283523142', 'chris.orsolino@gmail.com', 'Roman Catholic', 'Dancer', 'College', 'Filipino', 'none', 'accepted', 'IMG-6315e248db3a50.51752994.jpg'),
(10, 'Charles Wilcent', 'Ilustre', 'Urbano', '', 'male', 'Manila', 'Single', '2022-10-15', 4598, 'purok 2', 'sitio 3', 'TELECOM', 'sevilla street', '9264561231', 'wilson.urbano@gmail.con', 'Roman Catholic', 'Axie player', 'College', 'Filipino', 'none', 'accepted', 'IMG-6315e7787044d0.53015656.jpg'),
(11, 'Jehan', '', 'Hadji Said', '', 'male', 'Manila', 'Single', '2022-10-16', 12312, 'purok 2', 'sitio 2', 'kalyepogi', 'parking', '9108418705', 'jehan.said@gmail.com', 'Islam', 'Web developer', 'College', 'Filipino', 'none', 'accepted', 'IMG-6316093cd6aa57.65981626.jpg'),
(16, 'john daniel', 'san juan', 'policarpio', '', 'male', 'mindoro', 'Widowed', '2022-10-18', 1004, '1', 'sitio 1', 'kalyepogi', 'tinagan', '9123123123', 'juan.delecaruz123', 'Jehovah\'s Witnesses', 'programmer', 'Bachelor\'s Degree', 'Filipino', 'pogi', 'accepted', 'IMG-6322a861ded505.42428598.jpg'),
(19, 'Denver ', 'Kabiling', 'Mazo', '', 'male', 'Pampanga', 'Single', '2022-10-19', 1759, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '9475044087', 'denver.mazo@gmail.com', 'Roman Catholic', 'Cook', 'College', 'Filipino', 'None', 'accepted', 'IMG-6336cfb21effb4.96116588.png'),
(23, 'Bernandito', 'Malacas', 'Mazo', '', 'male', 'Mindoro', 'Married', '2022-10-22', 1759, '', '', '', '', '9283523144', 'bernandito.mazo@gmail.com', 'Roman Catholic', 'Machine Operator', 'College', 'Filipino', 'none', 'accepted', 'IMG-6336f65190f495.32852079.jpg'),
(25, 'Nard', 'Kabiling', 'Mazo', '', 'male', 'Manila', 'Single', '2010-03-27', 1759, '', '', '', '', '09616064483', 'nard_maz@gmail.com', 'Roman Catholic', 'Programmer', 'College', 'Filipino', 'none', 'accepted', 'IMG-635732a9db8c34.29051974.jpg'),
(26, 'Nardo', 'Kabiling', 'Mazo', 'II', 'male', 'Pampanga', 'Single', '2011-03-29', 1234, 'purok 1', 'sitio 1', 'Grove', 'Magnolia Estate', '09616064483', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'none', 'College', 'Filipino', 'none', 'accepted', 'IMG-635733e3dcbdf6.13061455.jpg'),
(27, 'Denver', 'Kabiling', 'Mazo', '', 'male', 'Pampanga', 'Single', '1999-01-12', 7894, 'purok 2', 'sitio 2', 'KalyePogi', 'Beverly Woods', '09475044087', 'denver.mazo66@gmail.com', 'Roman Catholic', 'Cook', 'Bachelor\'\'s Degree', 'Filipino', 'none', 'accepted', 'IMG-6357345b7e1345.88315838.jpg'),
(30, 'Jennifer', 'Abella', 'Kabiling', '', 'male', 'Pampanga', 'Single', '2000-06-29', 1759, '', '', '', '', '09206460967', 'jennifer.kabiling@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'Filipino', 'none', 'accepted', 'IMG-635a9d2f2a12a3.68807450.png'),
(31, 'Banana', 'Goat', 'Apple', '', 'other', 'try', 'Married', '2022-11-18', 0, 'purok 1', 'sitio 2', 'LRC', 'Beverly Woods', '09491698996', 'adad', 'Roman Catholic', 'ada', 'Less Than Highschool', 'filipino', 'none', 'accepted', 'IMG-636600f8d14fd0.72113037.png'),
(33, 'Monique Eubelle', 'Pernesita', 'Gregorio', '', 'female', 'Manila', 'Single', '2000-12-20', 6, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09553473449', 'monekpernesita@gmail.com', 'None', 'None', 'College', 'Filipino', 'none', 'accepted', 'IMG-636666c61c7880.62194912.jpg'),
(36, 'Shinna Marie', 'Gonzales ', 'Gonzales', '', 'female', 'Mandaluyong City ', 'Single', '1998-08-23', 35, '', '', 'Telecom', 'Brittany Oaks', '09054149433', 'shi23gonzales@gmail.com', 'Roman Catholic', 'none', 'College', 'Filipino ', 'none', 'accepted', 'IMG-63667cb1e0ecc3.33441522.jpg'),
(37, 'Christian', 'Cabrera', 'Mangulabnab', '', 'male', 'Pampanga', 'Single', '2001-04-17', 12, 'purok 1', 'sitio 2', 'Telecom', 'Sycamore Village', '09176590417', 'Smangulabnan17@gmail.com', 'Roman Catholic', 'Student', 'College', 'Filipino', 'N/A', 'accepted', 'IMG-63667fcc869d41.32471240.jpg'),
(38, 'John Rey', 'Casabuena', 'Baguio', '', 'female', 'Cardona', 'Single', '2001-12-04', 69, 'purok 1', 'sitio 2', 'LRC', 'Beverly Woods', '09186016394', 'johnreybags@gmail.com', 'Roman Catholic', 'Daddy', 'College', 'Filipino', 'none', 'accepted', 'IMG-6367442cb10199.74656897.jfif'),
(39, 'Helbert', 'B', 'Capada', 'Bert', 'male', 'Cubao, Q.C', 'Single', '2000-06-28', 71, 'purok 2', 'sitio 2', 'Grove', 'Beverly Woods', '09770663786', 'Helbertcapada29@gmail.com', 'Roman Catholic', 'Student', 'College', 'Filipino', 'none', 'accepted', 'IMG-636745f8e95be4.97387081.jpg'),
(40, 'John Reys', 'Casabuena', 'Baguio', '', 'male', 'Cardona', 'Single', '2001-04-15', 69, 'Purok 3', 'sitio 2', 'KalyePogi', 'Beverly Woods', '09186016940', 'johnreybags@gmail.com', 'Roman Catholic', 'Pinoy Daddy', 'College', 'Filipino', 'none', 'accepted', 'IMG-636746462e6101.71289182.jpg'),
(41, 'Helbert', 'B', 'Capada', '', 'male', 'Cubao, QC', 'Single', '2000-06-28', 71, 'purok 1', 'sitio 2', 'Grove', 'Magnolia Estate', '09770663796', 'Helbertcapada29@gmail.com', 'Roman Catholic', 'none', 'College', 'Filipino', 'none', 'accepted', 'IMG-6367476e64f039.82491376.jpg'),
(42, 'jay', 'cruz', 'onarres', '', 'female', 'manila', 'Single', '2000-03-04', 123, 'purok 1', 'sitio 1', 'KalyePogi', 'Sycamore Village', '09457736066', 'jay123@gmail.com', 'Iglesia ni Cristo', 'none', 'College', 'filipino', 'none', 'pendingforaccountandresidency', 'IMG-636775e82d4b48.15448423.jpg'),
(43, 'Nick', 'Georgia', 'Conner', '', 'male', 'Spain', 'Married', '1993-06-08', 234, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09296738322', 'Nick24@yahoo.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'Spanish/Filipino', 'none', 'accepted', 'IMG-6367a60cd108f8.72754173.jpg'),
(44, 'Nick', 'Georgia', 'Conner', '', 'male', 'Spain', 'Married', '1993-06-08', 234, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09296738322', 'Nick24@yahoo.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'Spanish/Filipino', 'none', 'accepted', 'IMG-6367a60d846f98.84585604.jpg'),
(45, 'Blue', 'Abenson', 'Orso', '', 'female', 'Italy', 'Single', '1998-07-11', 455, 'purok 2', 'sitio 2', 'LRC', 'Beverly Woods', '09568735389', 'RAYO.RAFAELLUIGI@UE.EDU.PH', 'Roman Catholic', 'Network Engineer', 'Bachelor\'\'s Degree', 'Half breed', 'none', 'accepted', 'IMG-6367af04ae8482.63267080.jpg'),
(46, 'Robin Lee', 'Visto', 'Muricho', '', 'male', 'Manila', 'Single', '1999-03-27', 6969, 'purok 1', 'sitio 2', 'Grove', 'Beverly Woods', '09560098112', 'Murichorobinlee@gmail.com ', 'None', 'Customer Service Rep', 'Bachelor\'\'s Degree', 'Filipino', 'none', 'accepted', 'IMG-6367c4ee1c17d9.32575139.jpg'),
(48, 'Yuki', 'Kabiling', 'Mazo', '', 'female', 'ASDSAD', 'Single', '2001-11-03', 2134, 'purok 1', 'sitio 2', 'LRC', 'Beverly Woods', '09925119326', 'SADASD', 'Roman Catholic', 'none', 'Less Than Highschool', 'Japanese', 'none', 'accepted', 'IMG-636ce892b93335.98174600.png'),
(49, 'sad', 'asda', 'asd', 'asd', 'male', 'asda', 'Single', '2019-06-04', 12312, '', '', '', '', '121', 'asd', 'Roman Catholic', 'none', 'Less Than Highschool', 'asda', 'as', 'pendingforresidency', 'IMG-636e43585ff329.92322572.jpg'),
(50, 'Al Rashied', 'Buenavista', 'Idris', '', 'male', 'Zamboanga', 'Single', '2000-01-04', 1108, 'purok 1', 'sitio 1', 'Grove', 'Magnolia Estate', '09953253995', 'alrashiedidris@yahoo.com', 'Islam', 'none', 'College', 'Filipino', 'none', 'accepted', 'IMG-636fbe8b4f4781.27818417.jpg'),
(51, 'johnny', 'san miguel', 'polips', 'II', 'male', 'Rizal', 'Single', '2000-05-09', 22, 'purok 1', 'sitio 1', 'LRC', 'Magnolia Estate', '09496705512', 'johnnypolips@gmail.com', 'Roman Catholic', 'none', 'College', 'filipino', 'none', 'accepted', 'IMG-636fee370d8d26.10273427.jpg');

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
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resident_table`
--

INSERT INTO `resident_table` (`id`, `user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `birthplace`, `civilstatus`, `birthday`, `household_ID`, `unitnumber`, `purok`, `sitio`, `street`, `subdivision`, `contactnumber`, `email`, `religion`, `occupation`, `education`, `nationality`, `disability`, `status`) VALUES
(7, 7, 'Lenz Janielle', 'Lim', 'Gerongco', '', 'female', 'Laguna', 'Single', '2002-09-15', 8, 1004, 'Purok 3', 'sitio 2', '1', '1', '09123456789', 'lenzgerongco@yahoo.com', 'Roman Catholic', 'Flight attendant', 'College', 'Filipino', 'none', 'active'),
(8, 8, 'Bernard', 'Kabiling', 'Mazo', '', 'male', 'Manila', 'Single', '2001-03-27', 8, 1759, 'purok 1', 'sitio 1', 'TELECOM', 'tinagan', '09283523142', 'nard_mazo@gmail.com', 'Roman Catholic', 'Programmer', 'College', 'Filipino', 'none', 'active'),
(9, 9, 'Christian Philip', 'Diff', 'Orsolino', '', 'male', 'Manila', 'Single', '2000-12-11', 3, 1000, 'purok 1', 'sitio 2', 'TELECOM', 'tinagan', '09283523142', 'chris.orsolino@gmail.com', 'Roman Catholic', 'Dancer', 'College', 'Filipino', 'none', 'active'),
(10, 10, 'Charles Wilcent', 'Ilustre', 'Urbano', '', 'male', 'Manila', 'Single', '2000-12-02', 3, 4598, 'purok 2', 'sitio 3', '1', '1', '09925119322', 'wilcenturbano02@gmail.com', 'Roman Catholic', 'Axie player', 'College', 'Filipino', 'none', 'active'),
(11, 11, 'Jehan', '', 'Hadji Said', '', 'male', 'Manila', 'Single', '2001-06-12', NULL, 12312, 'purok 2', 'sitio 2', '1', '1', '09219657391', 'jehan.said@gmail.com', 'Islam', 'Web developer', 'College', 'Filipino', 'none', 'active'),
(12, 13, 'Michael', '', 'Jordan', '', 'male', 'Manila', 'Married', '1963-02-17', 8, 2345, 'purok 2', 'sitio 1', 'LRC', 'parking', '09781234567', 'michaejordan@gmail.com', 'Roman Catholic', 'none', 'College', 'American', 'none', 'active'),
(13, 14, 'Kobe', '', 'Bryant', '', 'male', 'Manila', 'Married', '1978-08-23', NULL, 2408, 'Purok 3', 'sitio 3', 'grove', 'sevilla street', '09244567897', 'kobe.bryant@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'American', 'none', 'active'),
(14, 15, 'Lebron', '', 'James', '', 'male', 'Manila', 'Single', '1984-12-30', NULL, 2306, 'purok 2', 'sitio 2', 'TELECOM', 'parking', '09623456781', 'lebronjames@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'American', 'none', 'active'),
(17, 18, 'John', '', 'Wall', '', 'male', 'Manila', 'Single', '1990-09-06', 3, 202, 'purok 1', 'sitio 1', 'Oroqueta', 'tinagan', '09020146545', 'john.wall@gmail.com', 'Roman Catholic', 'none', 'College', 'American', 'none', 'active'),
(29, 30, 'John Daniel', 'San Juan', 'Policarpio', '', 'male', 'mindoro', 'Single', '2002-09-20', 3, 1004, '1', 'sitio 1', '1', '1', '09123123123', 'juan.delecaruz123', 'Jehovah\'s Witnesses', 'programmer', 'Bachelor\'s Degree', 'Filipino', 'pogi', 'active'),
(32, 33, 'Denver ', 'Kabiling', 'Mazo', '', 'male', 'Pampanga', 'Single', '1999-01-12', NULL, 1759, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09475044087', 'denver.mazo@gmail.com', 'Roman Catholic', 'Cook', 'College', 'Filipino', 'None', 'active'),
(34, 42, 'Bernandito', 'Malacas', 'Mazo', '', 'male', 'Mindoro', 'Married', '2003-09-07', 7, 1759, '', '', '', '', '09283523144', 'bernandito.mazo@gmail.com', 'Roman Catholic', 'Machine Operator', 'College', 'Filipino', 'none', 'active'),
(40, 66, 'Nardo', 'Kabiling', 'Mazo', 'II', 'male', 'Pampanga', 'Single', '2011-03-29', NULL, 1234, 'purok 1', 'sitio 1', 'Grove', 'Magnolia Estate', '09616064483', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'none', 'College', 'Filipino', 'none', 'active'),
(41, 33, 'Denver', 'Kabiling', 'Mazo', '', 'male', 'Pampanga', 'Single', '1999-01-12', 8, 7894, 'purok 2', 'sitio 2', 'KalyePogi', 'Beverly Woods', '09475044087', 'orsolino.christianphilip@ue.edu.ph', 'Roman Catholic', 'Cook', 'Bachelor\'s Degree', 'Filipino', 'none', 'active'),
(43, 46, 'Jennifer', 'Abella', 'Kabiling', '', 'male', 'Pampanga', 'Single', '2000-06-29', NULL, 1759, '', '', '', '', '09206460967', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'Filipino', 'none', 'active'),
(44, NULL, 'Banana', 'Goat', 'Apple', '', 'male', 'try', 'Single', '2022-11-18', NULL, 0, 'purok 1', 'sitio 2', 'LRC', 'Beverly Woods', '09491698996', 'adad', 'Roman Catholic', 'ada', 'Less Than Highschool', 'filipino', 'none', 'active'),
(45, 47, 'Monique Eubelle', 'Pernesita', 'Gregorio', '', 'female', 'Manila', 'Single', '2000-12-20', NULL, 6, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09553473449', 'bernard.mazo04@gmail.com', 'None', 'None', 'College', 'Filipino', 'none', 'active'),
(47, 49, 'Shinna Marie', 'Gonzales ', 'Gonzales', '', 'female', 'Mandaluyong City ', 'Single', '1998-08-23', NULL, 35, '', '', 'Telecom', 'Brittany Oaks', '09054149433', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'none', 'College', 'Filipino ', 'none', 'active'),
(48, 50, 'Christian', 'Cabrera', 'Mangulabnab', '', 'male', 'Pampanga', 'Single', '2001-04-17', 8, 12, 'purok 1', 'sitio 2', 'Telecom', 'Sycamore Village', '09176590417', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'Student', 'College', 'Filipino', 'N/A', 'active'),
(49, 51, 'John Rey', 'Casabuena', 'Baguio', '', 'female', 'Cardona', 'Single', '2001-12-04', NULL, 69, 'purok 1', 'sitio 2', 'LRC', 'Beverly Woods', '09186016394', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'Daddy', 'College', 'Filipino', 'none', 'active'),
(52, 54, 'Helbert', 'B', 'Capada', '', 'male', 'Cubao, QC', 'Single', '2000-06-28', NULL, 71, 'purok 1', 'sitio 2', 'Grove', 'Magnolia Estate', '09770663796', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'none', 'College', 'Filipino', 'none', 'active'),
(53, 55, 'Leonardo', 'Titanic', 'DeCaprio', 'a', 'male', 'asd', 'Single', '2001-03-30', NULL, 123, '1', '1', '1', '1', '09108418706', 'bernard.mazo03@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'asd', 'none', 'active'),
(54, 56, 'Nick', 'Georgia', 'Conner', '', 'male', 'Spain', 'Married', '1993-06-08', NULL, 234, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09296738322', 'bernard.mazo04@gmail.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'Spanish/Filipino', 'none', 'active'),
(55, 57, 'Blue', 'Abenson', 'Orso', '', 'female', 'Italy', 'Single', '1998-07-11', NULL, 455, 'purok 2', 'sitio 2', 'LRC', 'Beverly Woods', '09568735389', 'blue.abenson04@gmail.com', 'Roman Catholic', 'Network Engineer', 'Bachelor\'s Degree', 'Half breed', 'none', 'active'),
(56, 58, 'asda', 'asdasd', 'asd', '', 'male', 'asd', 'Single', '2022-11-07', NULL, 1231, '1', '1', '1', '1', '123213', '123312', 'Roman Catholic', 'none', 'Less Than Highschool', 'sadasdasd', 'none', 'inactive'),
(57, 59, 'Robin Lee', 'Visto', 'Muricho', '', 'male', 'Manila', 'Single', '1999-03-27', NULL, 6969, 'purok 1', 'sitio 2', 'Grove', 'Beverly Woods', '09560098112', 'Murichorobinlee@gmail.com ', 'None', 'Customer Service Rep', 'Bachelor\'s Degree', 'Filipino', 'none', 'active'),
(58, 56, 'Nick', 'Georgia', 'Conner', '', 'male', 'Spain', 'Married', '1993-06-08', NULL, 234, 'purok 1', 'sitio 1', 'KalyePogi', 'Magnolia Estate', '09296738322', 'Nick24@yahoo.com', 'Roman Catholic', 'none', 'Less Than Highschool', 'Spanish/Filipino', 'none', 'active'),
(59, 61, 'Yuki', 'Kabiling', 'Mazo', '', 'female', 'ASDSAD', 'Single', '2001-11-03', NULL, 2134, 'purok 1', 'sitio 2', 'LRC', 'Beverly Woods', '09925119326', 'SADASD', 'Roman Catholic', 'none', 'Less Than Highschool', 'Japanese', 'none', 'active'),
(60, 67, 'Al Rashied', 'Buenavista', 'Idris', '', 'male', 'Zamboanga', 'Single', '2000-01-04', NULL, 1108, 'purok 1', 'sitio 1', 'Grove', 'Magnolia Estate', '09953253995', 'alrashiedidris@yahoo.com', 'Islam', 'none', 'College', 'Filipino', 'none', 'active'),
(61, 68, 'johnny', 'san miguel', 'polips', 'II', 'male', 'Rizal', 'Single', '2000-05-09', NULL, 22, 'purok 1', 'sitio 1', 'LRC', 'Magnolia Estate', '09496705512', 'johnnypolips@gmail.com', 'Roman Catholic', 'none', 'College', 'filipino', 'none', 'active');

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
(1, 5, 9, 'Education', 'school supplies', '2022-09-28', 'ok', 'noticed'),
(2, 5, 9, 'Barangay Improvement', 'More sewage', '2022-09-28', 'sge', 'noticed'),
(3, 44, 9, 'Barangay Improvement', 'add more manhole', '2022-09-28', 'feedback try', 'noticed'),
(4, NULL, 9, 'Sports', 'please organize a basketball league', '2022-09-28', '', 'pending'),
(5, 6, 9, 'Sports', 'please organize a basketball league', '2022-09-28', 'Sige sabi mo eh', 'noticed'),
(6, NULL, 9, 'Health', 'Conduct operation tuli', '2022-09-28', '', 'pending'),
(7, NULL, 9, 'Barangay Improvement', 'your hall looks dirty do some operation cleaning!!', '2022-09-28', '', 'pending'),
(8, NULL, 9, 'Sports', 'please conduct a summer league', '2022-09-28', '', 'pending'),
(9, 6, 9, 'Barangay Improvement', 'clean the purok 1', '2022-09-28', 'salamat thanks', 'noticed'),
(10, 4, 9, 'Other', 'please update availability of healhcare', '2022-09-28', 'noted with thanks', 'noticed'),
(11, 3, 9, 'Education', 'please add more brgy tanod outside the school.', '2022-10-10', 'noted', 'noticed'),
(12, 5, 9, 'Other', 'add billiards to rent', '2022-10-10', 'we\'ll consider that', 'noticed'),
(13, 5, 9, 'Other', 'swimming lesson', '2022-10-10', 'sge po', 'noticed'),
(14, NULL, 11, 'libreng tuli', 'please po consider to have another libreng tulo program', '2022-10-25', '', 'pending'),
(15, 5, 8, 'Barangay Improvement', 'dame pa po sirang manhole', '2022-10-30', 'ok po, we\'ll look at it', 'noticed'),
(16, NULL, 10, 'Sports', 'Liga po Kapitan please malapit na bakasyon.', '2022-11-05', '', 'pending'),
(17, 5, 32, 'Barangay Improvement', 'Needs to be organized and give some attention for pwds and senior citizen resident of this barangay ', '2022-11-06', 'Ok', 'noticed'),
(18, 5, 8, 'Barangay Improvement', 'extra brgy tanod please', '2022-11-07', 'Sge tol', 'noticed'),
(19, 5, 8, 'DogVaccine', 'please conduct a free vaccination for dogs', '2022-11-12', 'Noted. Thank you', 'noticed'),
(20, 5, 8, 'Barangay Improvement', 'improve ayuda giving', '2022-11-12', 'asd', 'noticed'),
(21, 5, 8, 'Barangay Improvement', 'improve basketball court', '2022-11-12', 'sge', 'noticed'),
(22, 5, 8, 'Education', 'please donate school supplies', '2022-11-12', 'okay noted', 'noticed'),
(23, NULL, 8, 'Barangay Improvement', 'pabantayan po kanto maraming makulit', '2022-11-12', '', 'pending'),
(24, 5, 8, 'Sports', 'brangay league', '2022-11-12', 'asdasd', 'noticed'),
(25, NULL, 10, 'Sports', 'another Vball league po please', '2022-11-12', '', 'pending'),
(26, NULL, 10, 'Sports', 'Wide Cashrpize po next basketball league kahit mag increase po sana ng quota', '2022-11-12', '', 'pending'),
(27, NULL, 10, 'Health', 'Bakuna para sa dengue po nakakatakot ilan na po na dengue sa barangay', '2022-11-12', '', 'pending'),
(28, NULL, 10, 'Health', 'Healthcare Center facilities need to improve po.', '2022-11-12', '', 'pending'),
(29, NULL, 10, 'Education', 'Sana po maturuan mga batang kalye ', '2022-11-12', '', 'pending'),
(30, NULL, 10, 'Barangay Improvement', 'school supplies po sana tulong lang po sa mga less fortunate', '2022-11-12', '', 'pending'),
(31, NULL, 10, 'Sports', 'Basketball league round robin elimination po para cool', '2022-11-12', '', 'pending'),
(32, NULL, 10, 'Sports', 'Chess tournament po please wala pa po na hohost ', '2022-11-12', '', 'pending'),
(33, NULL, 10, 'Barangay Improvement', 'Sport fest and team building po para masaya', '2022-11-12', '', 'pending'),
(34, NULL, 10, 'Barangay Improvement', 'Paki linis naman po bangketa dito saten ang dameng bahay ', '2022-11-12', '', 'pending'),
(35, NULL, 10, 'Barangay Improvement', 'Sana po paagahan yung schedule sa pag hakot ng basura ang hassle po sa hapon dame naaabala pag dadaa', '2022-11-12', '', 'pending'),
(36, NULL, 10, 'Dance Contest', 'Contest po nakaka miss mag compete ', '2022-11-12', '', 'pending'),
(37, NULL, 10, 'Singing Contest', 'Singing Contest din po pala.', '2022-11-12', '', 'pending'),
(38, NULL, 10, 'ML tournament ', 'Sana meron din po ML tournament, di po kase ako makasali sa mga pa liga', '2022-11-12', '', 'pending'),
(39, NULL, 29, 'Sports', 'sana po makap paliga tayo ng mga katapusan ng May para ma enjoy ng ating mga kabarangay ang bakasyon', '2022-11-12', '', 'pending'),
(40, NULL, 10, 'Turuan po sana mga bata', 'Dame po di marunong magbasa', '2022-11-12', '', 'pending'),
(41, NULL, 10, 'Health', 'add po sana new doctors lagi po kase waiting ', '2022-11-12', '', 'pending'),
(42, NULL, 10, 'Health', 'sana may guard din po sa healthcare center', '2022-11-12', '', 'pending'),
(43, NULL, 29, 'Barangay Improvement', 'sana ibalik na ang pagkuha ng basura sa daling araw hindi sa hapon dahil nakakaabala sa barangay nat', '2022-11-12', '', 'pending'),
(44, NULL, 8, 'Sports', 'Paki dagdagan po sana ang bilang ng team para sa basketball sa susunod na pa liga', '2022-11-12', '', 'pending'),
(45, NULL, 10, 'Health', 'additional CR din po sana sa healhcare center kahit isa pa', '2022-11-12', '', 'pending'),
(46, NULL, 29, 'Health', 'Libreng bakuna sa mga kabataan.\r\n', '2022-11-12', '', 'pending'),
(47, NULL, 8, 'Sports', 'Sana meron din po na palaro para sa mga may disability', '2022-11-12', '', 'pending'),
(48, NULL, 8, 'Barangay Improvement', 'Sana po magkaron na din ng ilaw yung ibang bahagi ng street ', '2022-11-12', '', 'pending'),
(49, NULL, 29, 'Health', 'libreng gamot para mga senior citizen.', '2022-11-12', '', 'pending'),
(50, NULL, 10, 'Connect po sa PNP', 'Connect po sana PNP yung sa blotter para mas mapadali ang paghanap sa mga tao pag kailangan', '2022-11-12', '', 'pending');

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
(1, 0, 34, 'Mazo', 'inactive'),
(2, 0, 10, 'Urbano', 'inactive'),
(3, 5, 9, 'Orsolino', 'active'),
(4, 2, 11, 'Hadji Said', 'inactive'),
(7, 0, 34, 'Mazo', 'active'),
(8, 6, 8, 'Mazo', 'active');

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
(1, 12, 13, 'Michael Jordan', 'Chairman', '2016-12-01', '2023-06-01', 'term ended'),
(2, 13, 14, 'Kobe Bryant', 'Kagawad', '2016-12-01', '2022-10-29', 'term ended'),
(3, 14, 15, 'Lebron James', 'Kagawad', '2016-12-01', '2023-06-01', 'active'),
(4, 17, 18, 'John Wall', 'Kagawad', '2016-12-01', '2023-06-01', 'active'),
(5, 8, 8, 'Bernard Kabiling Mazo', 'Kagawad', '2022-09-22', '2022-10-29', 'term ended'),
(6, 7, 7, 'Lenz Janielle Lim Gerongco', 'Secretary', '2022-08-02', '2023-12-28', 'active'),
(44, 10, 10, 'Charles Wilcent Ilustre Urbano', 'Kagawad', '2022-10-29', '2022-10-05', 'active'),
(45, 9, 9, 'Christian Philip Diff Orsolino', 'Kagawad', '2022-10-29', '2022-10-28', 'active'),
(47, 34, 42, 'Bernandito Malacas Mazo', 'Chairman', '2022-10-29', '2022-10-19', 'active'),
(48, 48, 50, 'Christian Cabrera Mangulabnab', 'Kagawad', '2022-11-08', '2022-11-09', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `password`, `type`, `profile`, `status`) VALUES
(7, 'lenzay', '456', 'admin', 'default.jpg', 'inactive'),
(8, 'Odrannn', '123', 'admin0', 'USER8-634839116729b9.72061641.jpg', 'active'),
(9, '09095307513', '12345678', 'admin', 'USER9-63483de9ae6059.84184043.jpg', 'active'),
(10, 'wil', 'wil', 'admin', 'USER10-636fc68b8dadc6.94387390.jpg', 'active'),
(11, 'jehan', '456', 'user', 'default.jpg', 'active'),
(13, '09781234567', '12345678', 'admin0', 'default.jpg', 'active'),
(14, '09244567897', '12345678', 'admin', 'default.jpg', 'active'),
(15, '09623456781', '12345678', 'admin', 'default.jpg', 'active'),
(18, '09020146545', '12345678', 'admin', 'default.jpg', 'active'),
(30, 'jdaniel', 'pol', 'admin', 'default.jpg', 'active'),
(33, '09475044087', '12345678', 'admin0', 'default.jpg', 'active'),
(39, 'ber', '789', 'user', 'default.jpg', 'active'),
(42, '09283523144', '12345678', 'admin0', 'default.jpg', 'active'),
(43, '096160644831', '12345678', 'user', 'default.jpg', 'active'),
(44, '09475044087', '12345678', 'user', 'default.jpg', 'active'),
(46, '09206460967', '12345678', 'user', 'default.jpg', 'active'),
(47, '09553473449', '12345678', 'user', 'default.jpg', ''),
(48, '09260828469', '12345678', 'admin', 'default.jpg', 'active'),
(49, '09054149433', '12345678', 'hadmin', 'default.jpg', 'active'),
(50, '09176590417', '12345678', 'admin', 'default.jpg', 'active'),
(51, '09186016394', '12345678', 'user', 'default.jpg', 'active'),
(52, '09186016940', '12345678', 'user', 'default.jpg', 'active'),
(53, '09770663786', '12345678', 'user', 'default.jpg', 'active'),
(54, '09770663796', '12345678', 'user', 'default.jpg', 'active'),
(55, '09108418705', '12345678', 'user', 'default.jpg', 'active'),
(56, '09296738322', '12345678', 'user', 'default.jpg', 'inactive'),
(57, '09568735389', '12345678', 'user', 'default.jpg', 'active'),
(58, '123', '12345678', 'user', 'default.jpg', 'inactive'),
(59, '09560098112', '12345678', 'user', 'default.jpg', 'active'),
(60, '09296738322', '12345678', 'user', 'default.jpg', 'active'),
(61, 'yukitong', '789', 'hadmin', 'default.jpg', 'active'),
(66, 'hnardo', 'nardo', 'hadmin', 'default.jpg', 'active'),
(67, 'rash', 'r1234', 'admin', 'default.jpg', 'active'),
(68, '09496705512', '20221668279944', 'user', 'default.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `notification_ID` int(11) NOT NULL,
  `notification_type` varchar(50) NOT NULL,
  `message` varchar(300) NOT NULL,
  `source_ID` int(11) DEFAULT NULL,
  `resident_ID` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `status` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`notification_ID`, `notification_type`, `message`, `source_ID`, `resident_ID`, `date_time`, `status`) VALUES
(1, 'Filed Blotter', 'You are invited to the barangay hall on October 14, 2022,<br> 9:40 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:37:59', 1),
(2, 'Filed Blotter', 'You are invited to the barangay hall on October 14, 2022,<br> 9:40 pm, to settle the blotter you are involved.', 5, 0, '2022-10-27 03:37:59', 0),
(3, 'Filed Blotter', 'You are invited to the barangay hall on October 28, 2022,<br> 9:50 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:45:45', 1),
(4, 'Filed Blotter', 'You are invited to the barangay hall on October 28, 2022,<br> 9:50 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:45:45', 0),
(5, 'Filed Blotter', 'You are invited to the barangay hall on October 28, 2022,<br> 9:50 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:46:06', 1),
(6, 'Filed Blotter', 'You are invited to the barangay hall on October 28, 2022,<br> 9:50 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:46:06', 0),
(7, 'Filed Blotter', 'You are invited to the barangay hall on October 5, 2022,<br> 9:51 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:49:20', 1),
(8, 'Filed Blotter', 'You are invited to the barangay hall on October 5, 2022,<br> 9:51 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:49:20', 0),
(9, 'Filed Blotter', 'You are invited to the barangay hall on October 5, 2022,<br> 9:51 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:49:34', 1),
(10, 'Filed Blotter', 'You are invited to the barangay hall on October 5, 2022,<br> 9:51 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:49:34', 0),
(11, 'Filed Blotter', 'You are invited to the barangay hall on October 13, 2022,<br> 9:53 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:50:08', 1),
(12, 'Filed Blotter', 'You are invited to the barangay hall on October 13, 2022,<br> 9:53 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:50:08', 0),
(13, 'Filed Blotter', 'You are invited to the barangay hall on October 13, 2022,<br> 9:53 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:50:46', 1),
(14, 'Filed Blotter', 'You are invited to the barangay hall on October 13, 2022,<br> 9:53 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:50:46', 0),
(15, 'Filed Blotter', 'You are invited to the barangay hall on October 5, 2022,<br> 9:58 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:54:03', 1),
(16, 'Filed Blotter', 'You are invited to the barangay hall on October 5, 2022,<br> 9:58 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:54:03', 0),
(17, 'Filed Blotter', 'You are invited to the barangay hall on October 12, 2022,<br> 9:01 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 03:58:13', 1),
(18, 'Filed Blotter', 'You are invited to the barangay hall on October 12, 2022,<br> 9:01 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 03:58:13', 0),
(19, 'Filed Blotter', 'You are invited to the barangay hall on October 14, 2022,<br> 10:06 pm, to settle the blotter you are involved.', 5, 11, '2022-10-27 04:03:25', 1),
(20, 'Filed Blotter', 'You are invited to the barangay hall on October 14, 2022,<br> 10:06 pm, to settle the blotter you are involved.', 5, 10, '2022-10-27 04:03:25', 1),
(21, 'Requested Document', 'Your Barangay Clearance request is ready.<br>\r\n        You can now download the soft copy from view<br>\r\n        requests tab or claim it in the Barangay Hall.', 5, 8, '2022-10-28 04:41:07', 1),
(22, 'Requested Document', 'Your Barangay Clearance request is ready.<br>\n        You can now download the soft copy from view<br>\n        requests tab or claim it in the Barangay Hall.', 5, 8, '2022-11-01 06:32:00', 1),
(23, 'Requested Document', 'Your Barangay Clearance request is ready.<br>\n        You can now download the soft copy from view<br>\n        requests tab or claim it in the Barangay Hall.', 5, 11, '2022-11-01 06:32:31', 0),
(24, 'Requested Document', 'Your Barangay Clearance request is ready.<br>\n        You can now download the soft copy from view<br>\n        requests tab or claim it in the Barangay Hall.', 5, 11, '2022-11-01 06:32:48', 0),
(25, 'Requested Document', 'Your Certificate of Indigency request is ready.<br>\n        You can now download the soft copy from view<br>\n        requests tab or claim it in the Barangay Hall.', 5, 11, '2022-11-01 06:33:36', 0),
(42, 'Filed Complaint', 'Your complain has been marked solved.', 44, 9, '2022-11-05 01:18:02', 0),
(43, 'Sent Suggestion', 'Kagawad. Charles Wilcent Ilustre Urbano <br>sent a feedback to your suggestion.', 44, 9, '2022-11-05 01:18:25', 0),
(44, 'Filed Complaint', 'Your complain has been marked solved.', 5, 32, '2022-11-06 02:26:42', 1),
(45, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 32, '2022-11-06 02:27:22', 1),
(49, 'Requested Document', 'Your Barangay Clearance request is ready.<br>\n        You can now download the soft copy from view<br>\n        requests tab or claim it in the Barangay Hall.', 5, 8, '2022-11-08 09:37:23', 1),
(50, 'Filed Complaint', 'Your complain has been marked solved.', 5, 8, '2022-11-12 01:41:08', 1),
(51, 'Filed Complaint', 'Your complain has been marked solved.', 5, 8, '2022-11-12 01:43:56', 1),
(52, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 8, '2022-11-12 02:00:05', 0),
(53, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 8, '2022-11-12 02:01:46', 0),
(54, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 8, '2022-11-12 02:02:27', 0),
(55, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 8, '2022-11-12 02:03:53', 0),
(56, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 8, '2022-11-12 02:05:01', 1),
(57, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 8, '2022-11-12 09:06:41', 1),
(58, 'Sent Suggestion', 'Kagawad. Bernard Kabiling Mazo <br>sent a feedback to your suggestion.', 5, 8, '2022-11-12 09:14:42', 0);

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
  ADD PRIMARY KEY (`blotter_ID`),
  ADD KEY `OFFICIAL_IG` (`official_ID`),
  ADD KEY `COMPLAINANT` (`complainant_ID`),
  ADD KEY `COMPLAINEE` (`complainee_ID`);

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
  ADD KEY `OFFICIAL_2` (`official_ID`),
  ADD KEY `RESIDENT_2` (`resident_ID`),
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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

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
  ADD PRIMARY KEY (`suggestion_ID`),
  ADD KEY `OFFICIAL` (`official_ID`),
  ADD KEY `RESIDENT` (`sender_ID`);

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
  ADD KEY `ACCOUNT` (`user_id`),
  ADD KEY `residency` (`resident_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`notification_ID`),
  ADD KEY `OFFICIAL_3` (`source_ID`);

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
  MODIFY `notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bgy_info`
--
ALTER TABLE `bgy_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blotter_table`
--
ALTER TABLE `blotter_table`
  MODIFY `blotter_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `case_option`
--
ALTER TABLE `case_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `complaint_table`
--
ALTER TABLE `complaint_table`
  MODIFY `complaint_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `document_request`
--
ALTER TABLE `document_request`
  MODIFY `request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `modules_available`
--
ALTER TABLE `modules_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `resident_table`
--
ALTER TABLE `resident_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `suggestion_table`
--
ALTER TABLE `suggestion_table`
  MODIFY `suggestion_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tblhousehold`
--
ALTER TABLE `tblhousehold`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblofficial`
--
ALTER TABLE `tblofficial`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `notification_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blotter_table`
--
ALTER TABLE `blotter_table`
  ADD CONSTRAINT `COMPLAINANT` FOREIGN KEY (`complainant_ID`) REFERENCES `resident_table` (`id`),
  ADD CONSTRAINT `COMPLAINEE` FOREIGN KEY (`complainee_ID`) REFERENCES `resident_table` (`id`),
  ADD CONSTRAINT `OFFICIAL_IG` FOREIGN KEY (`official_ID`) REFERENCES `tblofficial` (`official_id`);

--
-- Constraints for table `complaint_table`
--
ALTER TABLE `complaint_table`
  ADD CONSTRAINT `INCHARGE` FOREIGN KEY (`official_ID`) REFERENCES `tblofficial` (`official_id`),
  ADD CONSTRAINT `SENDER` FOREIGN KEY (`sender_ID`) REFERENCES `resident_table` (`id`);

--
-- Constraints for table `document_request`
--
ALTER TABLE `document_request`
  ADD CONSTRAINT `NAME` FOREIGN KEY (`document_ID`) REFERENCES `document_type` (`id`),
  ADD CONSTRAINT `OFFICIAL_2` FOREIGN KEY (`official_ID`) REFERENCES `tblofficial` (`official_id`),
  ADD CONSTRAINT `RESIDENT_2` FOREIGN KEY (`resident_ID`) REFERENCES `resident_table` (`id`);

--
-- Constraints for table `resident_table`
--
ALTER TABLE `resident_table`
  ADD CONSTRAINT `HOUSE` FOREIGN KEY (`household_ID`) REFERENCES `tblhousehold` (`household_id`),
  ADD CONSTRAINT `test` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `suggestion_table`
--
ALTER TABLE `suggestion_table`
  ADD CONSTRAINT `OFFICIAL` FOREIGN KEY (`official_ID`) REFERENCES `tblofficial` (`official_id`),
  ADD CONSTRAINT `RESIDENT` FOREIGN KEY (`sender_ID`) REFERENCES `resident_table` (`id`);

--
-- Constraints for table `tblhousehold`
--
ALTER TABLE `tblhousehold`
  ADD CONSTRAINT `HEAD` FOREIGN KEY (`household_head_ID`) REFERENCES `resident_table` (`id`);

--
-- Constraints for table `tblofficial`
--
ALTER TABLE `tblofficial`
  ADD CONSTRAINT `ACCOUNT` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`id`),
  ADD CONSTRAINT `residency` FOREIGN KEY (`resident_id`) REFERENCES `resident_table` (`id`);

--
-- Constraints for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `OFFICIAL_3` FOREIGN KEY (`source_ID`) REFERENCES `tblofficial` (`official_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
