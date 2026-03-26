-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.16.0.7229
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ilmisgarden
CREATE DATABASE IF NOT EXISTS `ilmisgarden` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ilmisgarden`;

-- Dumping structure for table ilmisgarden.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden.admin: ~0 rows (approximately)
INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`, `created_at`) VALUES
	(3, 'admin', 'admin@ilmis.com', '$2y$10$TDf8Vvm6yMsEHwXBLWb3Eux8CErm1uvqhLB.7oo5I6relknebFd76', '2025-09-10 04:02:30');

-- Dumping structure for table ilmisgarden.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_cart`),
  UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  KEY `fk_cart_product` (`product_id`),
  CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden.cart: ~3 rows (approximately)
INSERT INTO `cart` (`id_cart`, `user_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
	(27, 'IL009', 53, 1, '2026-01-01 06:13:21', '2026-01-01 06:13:21'),
	(37, 'IL017', 94, 1, '2026-03-25 12:33:28', '2026-03-25 12:33:28'),
	(38, 'IL017', 90, 1, '2026-03-25 12:33:37', '2026-03-25 12:33:37');

-- Dumping structure for table ilmisgarden.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_product_images` (`product_id`),
  CONSTRAINT `fk_product_images` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden.product_images: ~187 rows (approximately)
INSERT INTO `product_images` (`id`, `product_id`, `image`, `is_primary`, `created_at`) VALUES
	(1, 17, 'img/pr/1762403454_Red Noir.png', 1, '2025-12-28 04:26:02'),
	(2, 18, 'img/pr/1762403536_IMG_1523.jpg', 1, '2025-12-28 04:26:02'),
	(3, 19, 'img/pr/1762403689_Sunshine Bliss Bouquet 1.png', 1, '2025-12-28 04:26:02'),
	(4, 20, 'img/pr/1762403708_Rosé Amour Bouquet.png', 1, '2025-12-28 04:26:02'),
	(5, 21, 'img/pr/1764310814_Gambar WhatsApp 2025-11-11 pukul 11.18.05_1d550a51.jpg', 1, '2025-12-28 04:26:02'),
	(6, 22, 'img/pr/1764311112_Gambar WhatsApp 2025-11-11 pukul 11.20.11_dbc17a26.jpg', 1, '2025-12-28 04:26:02'),
	(7, 23, 'img/pr/1764312079_Gambar WhatsApp 2025-11-11 pukul 11.21.12_0c79bc98.jpg', 1, '2025-12-28 04:26:02'),
	(8, 24, 'img/pr/1764397061_Gambar WhatsApp 2025-11-11 pukul 12.40.59_56ac68fc.jpg', 1, '2025-12-28 04:26:02'),
	(9, 25, 'img/pr/1764398833_Gambar WhatsApp 2025-11-12 pukul 12.23.23_b421ea40.jpg', 1, '2025-12-28 04:26:02'),
	(10, 26, 'img/pr/1764400600_Gambar WhatsApp 2025-11-24 pukul 13.04.51_09423aa5.jpg', 1, '2025-12-28 04:26:02'),
	(11, 27, 'img/pr/1764410743_a784ce6a-f084-4f0b-a974-49c6b41d13a2.jpg', 1, '2025-12-28 04:26:02'),
	(12, 28, 'img/pr/1764412451_c9051c87-d381-4f40-be33-68adab4733c2.jpg', 1, '2025-12-28 04:26:02'),
	(13, 29, 'img/pr/1764412766_a75a0622-8e06-4499-a483-625432f41916.jpg', 1, '2025-12-28 04:26:02'),
	(14, 30, 'img/pr/1764413427_Gambar WhatsApp 2025-11-29 pukul 17.43.21_81781cb3.jpg', 1, '2025-12-28 04:26:02'),
	(15, 31, 'img/pr/1764413931_IMG_3645.jpg', 1, '2025-12-28 04:26:02'),
	(16, 32, 'img/pr/1764414766_IMG_9700.jpg', 1, '2025-12-28 04:26:02'),
	(17, 33, 'img/pr/1764416000_224a160a-8e29-4369-86aa-16445f016a90.jpg', 1, '2025-12-28 04:26:02'),
	(18, 34, 'img/pr/1764488187_IMG_1546.jpg', 1, '2025-12-28 04:26:02'),
	(19, 35, 'img/pr/1764499207_9c65b67c-918a-42be-96ea-af8eb7030753.jpg', 1, '2025-12-28 04:26:02'),
	(20, 36, 'img/pr/1764654613_Gambar WhatsApp 2025-11-27 pukul 13.08.16_48141392.jpg', 1, '2025-12-28 04:26:02'),
	(21, 37, 'img/pr/1764658279_9e736459-4cc7-4219-b056-462a8d1bfd2d.jpg', 1, '2025-12-28 04:26:02'),
	(22, 38, 'img/pr/1764658841_16e44b60-da5f-4a3e-9d3e-0598c41d94ef.jpg', 1, '2025-12-28 04:26:02'),
	(23, 39, 'img/pr/1764660191_4c4531e2-6ad7-4d94-a9c4-6cbefb431598.jpg', 1, '2025-12-28 04:26:02'),
	(24, 40, 'img/pr/1764671041_Gambar WhatsApp 2025-12-02 pukul 14.05.10_0f08c337.jpg', 1, '2025-12-28 04:26:02'),
	(25, 41, 'img/pr/1764836668_DSC09986.JPG', 1, '2025-12-28 04:26:02'),
	(26, 42, 'img/pr/1764837400_DSC09614.JPG', 1, '2025-12-28 04:26:02'),
	(27, 43, 'img/pr/1764838004_IMG_96444.jpg', 1, '2025-12-28 04:26:02'),
	(30, 50, 'img/pr/1765448365_DSC01829 (1).jpg', 1, '2025-12-28 04:26:02'),
	(31, 51, 'img/pr/1765449128_Gambar WhatsApp 2025-11-25 pukul 13.54.53_ec4c6c13.jpg', 1, '2025-12-28 04:26:02'),
	(32, 52, 'img/pr/1765449659_Gambar WhatsApp 2025-11-25 pukul 13.54.37_13d3f918.jpg', 1, '2025-12-28 04:26:02'),
	(33, 53, 'img/pr/1766723970_56cfb519-fe07-4296-b96c-607dd94903af.jpg', 1, '2025-12-28 04:26:02'),
	(34, 54, 'img/pr/1766815911_9b19438e-be4a-4bfe-aec2-953bfdd86e14.jpg', 1, '2025-12-28 04:26:02'),
	(39, 17, 'img/pr/69533c7574a5b.jpeg', 0, '2025-12-30 02:44:05'),
	(40, 17, 'img/pr/69533c7575201.jpeg', 0, '2025-12-30 02:44:05'),
	(41, 19, 'img/pr/69533d8d053df.JPG', 0, '2025-12-30 02:48:45'),
	(42, 20, 'img/pr/69533df80c58f.jpeg', 0, '2025-12-30 02:50:32'),
	(43, 20, 'img/pr/69533df80cb3e.jpeg', 0, '2025-12-30 02:50:32'),
	(45, 21, 'img/pr/6953452fd8317.jpeg', 0, '2025-12-30 03:21:19'),
	(46, 21, 'img/pr/6953452fd90f4.jpeg', 0, '2025-12-30 03:21:19'),
	(47, 22, 'img/pr/695346f4a59b5.jpeg', 0, '2025-12-30 03:28:52'),
	(48, 22, 'img/pr/695346f4a63fc.jpeg', 0, '2025-12-30 03:28:52'),
	(49, 22, 'img/pr/695346f4a73b6.jpeg', 0, '2025-12-30 03:28:52'),
	(50, 23, 'img/pr/695347ea9562e.jpg', 0, '2025-12-30 03:32:58'),
	(51, 24, 'img/pr/69534a7093ef7.jpg', 0, '2025-12-30 03:43:44'),
	(52, 24, 'img/pr/69534a7094528.jpg', 0, '2025-12-30 03:43:44'),
	(53, 25, 'img/pr/69534b3852427.jpg', 0, '2025-12-30 03:47:04'),
	(54, 26, 'img/pr/695368134f305.jpeg', 0, '2025-12-30 05:50:11'),
	(55, 27, 'img/pr/695368609f10c.jpg', 0, '2025-12-30 05:51:28'),
	(56, 27, 'img/pr/695368609f87a.jpg', 0, '2025-12-30 05:51:28'),
	(57, 28, 'img/pr/69536a4f9e8bc.jpg', 0, '2025-12-30 05:59:43'),
	(58, 28, 'img/pr/69536a4f9ef8c.jpg', 0, '2025-12-30 05:59:43'),
	(59, 29, 'img/pr/6953ae7d450e3.jpg', 0, '2025-12-30 10:50:37'),
	(60, 30, 'img/pr/6953af7e16ba5.jpeg', 0, '2025-12-30 10:54:54'),
	(61, 30, 'img/pr/6953af7e17309.jpeg', 0, '2025-12-30 10:54:54'),
	(62, 30, 'img/pr/6953af7e179de.jpeg', 0, '2025-12-30 10:54:54'),
	(63, 31, 'img/pr/6953b02e177f7.jpg', 0, '2025-12-30 10:57:50'),
	(64, 31, 'img/pr/6953b02e1806a.jpg', 0, '2025-12-30 10:57:50'),
	(65, 32, 'img/pr/6953b0e3d63e0.jpg', 0, '2025-12-30 11:00:51'),
	(66, 33, 'img/pr/6953b12914c4e.jpg', 0, '2025-12-30 11:02:01'),
	(67, 34, 'img/pr/6953b17e25dd5.jpg', 0, '2025-12-30 11:03:26'),
	(68, 35, 'img/pr/6953b1dc6f46f.jpg', 0, '2025-12-30 11:05:00'),
	(69, 36, 'img/pr/6953b2242d221.jpg', 0, '2025-12-30 11:06:12'),
	(70, 36, 'img/pr/6953b2242d6c5.jpg', 0, '2025-12-30 11:06:12'),
	(71, 37, 'img/pr/6953b28f9aef3.jpg', 0, '2025-12-30 11:07:59'),
	(72, 38, 'img/pr/6953b6c8de142.jpeg', 0, '2025-12-30 11:26:00'),
	(73, 38, 'img/pr/6953b6c8de5ab.jpeg', 0, '2025-12-30 11:26:00'),
	(75, 38, 'img/pr/6953b70e4a183.jpeg', 0, '2025-12-30 11:27:10'),
	(76, 43, 'img/pr/6954cb4b745e4.jpg', 0, '2025-12-31 07:05:47'),
	(81, 41, 'img/pr/695747a43bc9a.jpg', 0, '2026-01-02 04:20:52'),
	(82, 41, 'img/pr/695747a43cb54.jpg', 0, '2026-01-02 04:20:52'),
	(83, 41, 'img/pr/695747a43deed.jpg', 0, '2026-01-02 04:20:52'),
	(84, 41, 'img/pr/695747a43e892.jpg', 0, '2026-01-02 04:20:52'),
	(85, 44, 'img/pr/6957571d32594.jpg', 1, '2026-01-02 05:26:53'),
	(86, 44, 'img/pr/6957571d32cf2.jpg', 0, '2026-01-02 05:26:53'),
	(87, 45, 'img/pr/695759200e767.jpg', 1, '2026-01-02 05:35:28'),
	(88, 45, 'img/pr/695759200ef53.jpg', 0, '2026-01-02 05:35:28'),
	(89, 45, 'img/pr/695759200f6f0.jpg', 0, '2026-01-02 05:35:28'),
	(90, 50, 'img/pr/69575a49727a1.jpg', 0, '2026-01-02 05:40:25'),
	(91, 50, 'img/pr/69575a4973ad3.jpg', 0, '2026-01-02 05:40:25'),
	(92, 52, 'img/pr/69575cce7a890.jpeg', 0, '2026-01-02 05:51:10'),
	(93, 52, 'img/pr/69575cce7ad46.jpeg', 0, '2026-01-02 05:51:10'),
	(94, 53, 'img/pr/6957602bb5372.jpeg', 0, '2026-01-02 06:05:31'),
	(96, 56, 'img/pr/6957645a6c93a.jpg', 1, '2026-01-02 06:23:22'),
	(97, 56, 'img/pr/6957647181125.jpg', 0, '2026-01-02 06:23:45'),
	(101, 58, 'img/pr/69589836a3649.png', 1, '2026-01-03 04:16:54'),
	(102, 58, 'img/pr/69589e4fcecb2.png', 0, '2026-01-03 04:42:55'),
	(103, 58, 'img/pr/69589ed959d8b.png', 0, '2026-01-03 04:45:13'),
	(104, 59, 'img/pr/6958a057d27ae.jpg', 1, '2026-01-03 04:51:35'),
	(105, 59, 'img/pr/6958a057d3645.jpg', 0, '2026-01-03 04:51:35'),
	(106, 59, 'img/pr/6958a057d4077.jpg', 0, '2026-01-03 04:51:35'),
	(107, 59, 'img/pr/6958a057d4d22.jpg', 0, '2026-01-03 04:51:35'),
	(111, 60, 'img/pr/6958ae9d8bcc5.jpg', 1, '2026-01-03 05:52:29'),
	(112, 60, 'img/pr/6958aed66bade.jpg', 0, '2026-01-03 05:53:26'),
	(113, 60, 'img/pr/6958aed66d720.jpg', 0, '2026-01-03 05:53:26'),
	(114, 60, 'img/pr/6958aed66eaa6.jpg', 0, '2026-01-03 05:53:26'),
	(118, 61, 'img/pr/6958b0d4bdc65.jpg', 1, '2026-01-03 06:01:56'),
	(120, 61, 'img/pr/6958b0f41fcd9.jpg', 0, '2026-01-03 06:02:28'),
	(121, 61, 'img/pr/6958b0f42077b.jpg', 0, '2026-01-03 06:02:28'),
	(122, 61, 'img/pr/6958b0f420f75.jpg', 0, '2026-01-03 06:02:28'),
	(124, 62, 'img/pr/6958b32e83d4b.jpeg', 1, '2026-01-03 06:11:58'),
	(125, 62, 'img/pr/6958b3cd8aa2e.jpeg', 0, '2026-01-03 06:14:37'),
	(133, 29, 'img/pr/6959f15a3efe7.jpg', 0, '2026-01-04 04:49:30'),
	(134, 29, 'img/pr/6959f15a40fe4.jpg', 0, '2026-01-04 04:49:30'),
	(137, 64, 'img/pr/695a06e645ff4.jpeg', 1, '2026-01-04 06:21:26'),
	(138, 64, 'img/pr/695a078f22dd5.jpeg', 0, '2026-01-04 06:24:15'),
	(139, 64, 'img/pr/695a078f238a0.jpeg', 0, '2026-01-04 06:24:15'),
	(140, 65, 'img/pr/695a0afeb68e9.jpeg', 1, '2026-01-04 06:38:54'),
	(141, 65, 'img/pr/695a0afeb6f4d.jpeg', 0, '2026-01-04 06:38:54'),
	(142, 65, 'img/pr/695a0afeb7470.jpeg', 0, '2026-01-04 06:38:54'),
	(143, 66, 'img/pr/695b4c0e381f0.jpg', 1, '2026-01-05 05:28:46'),
	(144, 66, 'img/pr/695b4c0e38a71.jpg', 0, '2026-01-05 05:28:46'),
	(145, 66, 'img/pr/695b4c0e391bf.jpg', 0, '2026-01-05 05:28:46'),
	(146, 67, 'img/pr/695b4e0ae7f1a.jpg', 1, '2026-01-05 05:37:14'),
	(147, 67, 'img/pr/695b4e0ae89ec.jpg', 0, '2026-01-05 05:37:14'),
	(148, 68, 'img/pr/695b5315a2c39.jpg', 1, '2026-01-05 05:58:45'),
	(149, 68, 'img/pr/695b5315a3df9.jpg', 0, '2026-01-05 05:58:45'),
	(152, 69, 'img/pr/695b8309ec112.jpg', 1, '2026-01-05 09:23:21'),
	(153, 69, 'img/pr/695b8309ec720.jpg', 0, '2026-01-05 09:23:21'),
	(155, 70, 'img/pr/695b88fcaca76.jpg', 1, '2026-01-05 09:48:44'),
	(156, 70, 'img/pr/695b88fcad64d.jpeg', 0, '2026-01-05 09:48:44'),
	(157, 70, 'img/pr/695b8a267db97.jpeg', 0, '2026-01-05 09:53:42'),
	(158, 71, 'img/pr/695b8b4ae877c.jpg', 1, '2026-01-05 09:58:34'),
	(159, 72, 'img/pr/695b8d21bc13e.jpeg', 1, '2026-01-05 10:06:25'),
	(160, 73, 'img/pr/695b912d09197.jpg', 1, '2026-01-05 10:23:41'),
	(161, 73, 'img/pr/695b912d09e3b.jpg', 0, '2026-01-05 10:23:41'),
	(163, 74, 'img/pr/6960b450535e3.jpg', 1, '2026-01-09 07:54:56'),
	(164, 75, 'img/pr/6960baea1cd6c.jpg', 1, '2026-01-09 08:23:06'),
	(165, 76, 'img/pr/6960bbdef0db1.JPG', 1, '2026-01-09 08:27:10'),
	(167, 77, 'img/pr/6960c2febc990.jpg', 1, '2026-01-09 08:57:34'),
	(168, 78, 'img/pr/6960c51960f6d.png', 1, '2026-01-09 09:06:33'),
	(224, 79, 'img/pr/6982f19f90f9f.jpg', 1, '2026-02-04 07:13:35'),
	(225, 79, 'img/pr/6982f19f92360.jpg', 0, '2026-02-04 07:13:35'),
	(226, 79, 'img/pr/6982f19f93869.jpg', 0, '2026-02-04 07:13:35'),
	(227, 79, 'img/pr/6982f1b016f57.jpg', 0, '2026-02-04 07:13:52'),
	(242, 80, 'img/pr/6982fc0ca93f6.jpg', 1, '2026-02-04 07:58:04'),
	(243, 80, 'img/pr/6982fc0ca9fd3.jpg', 0, '2026-02-04 07:58:04'),
	(244, 80, 'img/pr/6982fc0caaa49.jpg', 0, '2026-02-04 07:58:04'),
	(245, 80, 'img/pr/6982fc2c74515.jpg', 0, '2026-02-04 07:58:36'),
	(246, 81, 'img/pr/6982fc6f9c8f4.jpg', 1, '2026-02-04 07:59:43'),
	(247, 81, 'img/pr/6982fc6f9d99d.jpg', 0, '2026-02-04 07:59:43'),
	(248, 81, 'img/pr/6982fc6f9e668.jpg', 0, '2026-02-04 07:59:43'),
	(249, 81, 'img/pr/6982fc8abc0c2.jpg', 0, '2026-02-04 08:00:10'),
	(250, 82, 'img/pr/6982fcc84cc59.jpg', 1, '2026-02-04 08:01:12'),
	(251, 82, 'img/pr/6982fcc84db59.jpg', 0, '2026-02-04 08:01:12'),
	(252, 82, 'img/pr/6982fcc84e87c.jpg', 0, '2026-02-04 08:01:12'),
	(253, 82, 'img/pr/6982fcd78ecc8.jpg', 0, '2026-02-04 08:01:27'),
	(257, 83, 'img/pr/6982fd6319af8.jpg', 1, '2026-02-04 08:03:47'),
	(258, 83, 'img/pr/6982fd631a8cc.png', 0, '2026-02-04 08:03:47'),
	(259, 83, 'img/pr/6982fd6ea5235.jpg', 0, '2026-02-04 08:03:58'),
	(260, 84, 'img/pr/6982fda94912f.jpg', 1, '2026-02-04 08:04:57'),
	(261, 84, 'img/pr/6982fda94a01a.jpg', 0, '2026-02-04 08:04:57'),
	(262, 84, 'img/pr/6982fda94ad7d.jpg', 0, '2026-02-04 08:04:57'),
	(263, 85, 'img/pr/6982fdda0f7b7.jpg', 1, '2026-02-04 08:05:46'),
	(264, 85, 'img/pr/6982fdda10827.jpg', 0, '2026-02-04 08:05:46'),
	(265, 85, 'img/pr/6982fdda11707.jpg', 0, '2026-02-04 08:05:46'),
	(266, 85, 'img/pr/6982fded9d93c.jpg', 0, '2026-02-04 08:06:05'),
	(267, 86, 'img/pr/6982fe232960a.jpg', 1, '2026-02-04 08:06:59'),
	(268, 86, 'img/pr/6982fe232ab14.jpg', 0, '2026-02-04 08:06:59'),
	(269, 86, 'img/pr/6982fe232bcd0.jpg', 0, '2026-02-04 08:06:59'),
	(270, 86, 'img/pr/6982fe391898d.jpg', 0, '2026-02-04 08:07:21'),
	(277, 87, 'img/pr/6982fef292791.jpg', 1, '2026-02-04 08:10:26'),
	(278, 87, 'img/pr/6982fef294493.jpg', 0, '2026-02-04 08:10:26'),
	(279, 87, 'img/pr/6982ff1ede2a6.jpg', 0, '2026-02-04 08:11:10'),
	(280, 87, 'img/pr/6982ff1edeacb.jpg', 0, '2026-02-04 08:11:10'),
	(282, 88, 'img/pr/698305c7574c5.jpg', 1, '2026-02-04 08:39:35'),
	(283, 88, 'img/pr/698305c758ae7.jpg', 0, '2026-02-04 08:39:35'),
	(284, 88, 'img/pr/698305e3d5672.jpg', 0, '2026-02-04 08:40:03'),
	(285, 88, 'img/pr/698305e3d5e5c.jpg', 0, '2026-02-04 08:40:03'),
	(292, 89, 'img/pr/69830777ae037.jpg', 1, '2026-02-04 08:46:47'),
	(293, 89, 'img/pr/698307e5efed3.jpg', 0, '2026-02-04 08:48:37'),
	(294, 89, 'img/pr/698307f6d1dc1.jpg', 0, '2026-02-04 08:48:54'),
	(295, 89, 'img/pr/698307f6d2762.jpg', 0, '2026-02-04 08:48:54'),
	(296, 90, 'img/pr/69830bd207d5f.jpg', 1, '2026-02-04 09:05:22'),
	(297, 90, 'img/pr/69830beab822c.jpg', 0, '2026-02-04 09:05:46'),
	(298, 90, 'img/pr/69830bf41aa95.jpg', 0, '2026-02-04 09:05:56'),
	(299, 90, 'img/pr/69831992aad50.jpg', 0, '2026-02-04 10:04:02'),
	(322, 91, 'img/pr/69aaa0834fdd0.jpg', 1, '2026-03-06 09:38:11'),
	(323, 91, 'img/pr/69aaa08351416.jpg', 0, '2026-03-06 09:38:11'),
	(324, 91, 'img/pr/69aaa08351e55.jpg', 0, '2026-03-06 09:38:11'),
	(325, 92, 'img/pr/69aaa0eb127ff.jpg', 1, '2026-03-06 09:39:55'),
	(326, 92, 'img/pr/69aaa0eb13acb.jpg', 0, '2026-03-06 09:39:55'),
	(327, 92, 'img/pr/69aaa0eb14ad8.jpg', 0, '2026-03-06 09:39:55'),
	(328, 93, 'img/pr/69aaa10cac17c.jpg', 1, '2026-03-06 09:40:28'),
	(329, 93, 'img/pr/69aaa10cae47d.jpg', 0, '2026-03-06 09:40:28'),
	(330, 93, 'img/pr/69aaa10caf152.jpg', 0, '2026-03-06 09:40:28'),
	(331, 94, 'img/pr/69aaa12be83a9.jpg', 1, '2026-03-06 09:40:59'),
	(332, 94, 'img/pr/69aaa12be9bb9.jpg', 0, '2026-03-06 09:40:59');

-- Dumping structure for table ilmisgarden.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `catalog` varchar(50) DEFAULT NULL,
  `flower` varchar(50) DEFAULT NULL,
  `occasion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden.products: ~71 rows (approximately)
INSERT INTO `products` (`id`, `name`, `price`, `description`, `catalog`, `flower`, `occasion`) VALUES
	(17, 'Red Noir Bouquet', 283000, 'Red Noir Bouquet adalah rangkaian mawar merah tua nan memukau yang memancarkan pesona misterius dan elegan. Warna merah pekatnya melambangkan gairah, kekuatan, dan cinta yang mendalam, sempurna untuk mengungkapkan perasaan intens dengan sentuhan kemewahan dan keanggunan klasik.\r\n\r\nBouquet ini cocok untuk mengungkapkan perasaan yang kuat dan tulus dan baik seperti, anniversary, valentine, lamaran, maupun momen spesial yang penuh makna. Tampilan yang classy dan timeless menjadikannya pilihan aman namun tetap berkesan untuk berbagai kesempatan romantis.\r\n\r\nTinggi bouquet ± 45–50 cm.', 'Best Seller,Bouquet', 'Rose', 'Anniversary,Birthday,Valentine'),
	(18, 'Serene Bloom Bouquet', 530000, 'Serene Bloom Bouquet ini hadir dengan nuansa putih dan hijau pastel yang lembut, memancarkan kesan elegan, fresh, dan pure. Rangkaian ini menggunakan kombinasi bunga premium seperti lily putih yang anggun, carnation, rose yang lembut, chrysanthemum hijau, serta aksen baby breath dan eucalyptus sebagai filler untuk menambah tekstur serta aroma natural yang menenangkan.\r\n\r\nSetiap bunga disusun seimbang sehingga menciptakan tampilan yang rapi namun tetap natural. Wrapping paper hijau mint membingkai rangkaian dengan sentuhan modern dan menawan, dipadukan dengan pita satin hitam dan putih yang menambah kesan mewah dan berkelas.\r\n\r\nBouquet ini sangat cocok sebagai simbol ketulusan, harapan, dan doa baik, seperti graduation, anniversary, ulang tahun, atau ucapan semangat, simpati, atau doa kesembuhan.\r\n\r\nTinggi bouquet ± 45–50 cm.', 'Best Seller,Bouquet', 'Lilly,Rose', 'Anniversary,Birthday,Graduation,Valentine'),
	(19, 'Sunshine Bliss Bouquet', 150000, 'Sunshine Bliss Bouquet memancarkan keceriaan dan kehangatan layaknya sinar mentari pagi. Rangkaian bunga berwarna kuning cerah dan putih lembut ini melambangkan optimisme, kebahagiaan, dan energi positif. Pilihan sempurna untuk mencerahkan hari seseorang atau merayakan momen penuh sukacita.\r\n\r\nBouquet ini disusun dari bunga matahari, mawar, dan daun sebagai filler nya.\r\n\r\nTinggi bouquet ± 30 – 40 cm.', 'Best Seller,Bouquet', 'Sunflower', 'Birthday,Graduation,Gift'),
	(20, 'Rosé Amour Bouquet', 610000, 'Rosé Amour Bouquet adalah perpaduan mawar merah muda lembut yang melambangkan kasih sayang, keanggunan, dan ketulusan cinta. Setiap tangkai dipilih dengan hati-hati untuk menciptakan rangkaian yang anggun dan romantis — sempurna untuk mengungkapkan perasaan pada momen istimewa seperti ulang tahun, valentine, atau anniversary.\r\n\r\nBouquet ini terdiri dari 20 tangkai mawar merah, dan 20 tangkai mawar putih, dan filler.\r\n\r\nTinggi bouquet ± 50 – 70 cm.', 'Best Seller,Bouquet', 'Rose', 'Anniversary,Birthday,Gift,Valentine'),
	(21, 'Single Rose Bouquet', 50000, 'Bouquet single rose ini tampil anggun melalui kesederhanaannya. Menggunakan satu batang mawar merah sebagai bunga utama, bouquet ini melambangkan cinta yang tulus, ketegasan perasaan, dan keindahan yang tidak berlebihan.\r\n\r\nFiller bisa berupa daun, baby breath, caspea, dll.\r\n\r\nTinggi bouquet ± 25 cm.', 'Best Seller,Bouquet', 'Rose', 'Gift'),
	(22, 'Petite Rose Bouquet', 100000, 'Rangkaian mawar ini menghadirkan kesan manis, elegan, dan penuh ketulusan. Tampil dengan ukuran compact namun tetap berkesan mewah, bouquet ini menggunakan mawar fresh berkualitas yang mekar sebagai bunga utama.\r\n\r\nBouquet ini terdiri dari 3 tangkai mawar, dan filler.\r\n\r\nTinggi bouquet ± 30.', 'Best Seller,Bouquet', 'Rose', 'Anniversary,Birthday,Graduation,Gift,Valentine'),
	(23, 'Small Rose Bouquet', 155000, 'Small Rose Bouquet adalah rangkaian yang terdiri dari 5 tangkai bunga mawar fresh yang mekar cantik, bouquet ini cocok untuk ulang tahun, aniversarry, valentine, dan ungkapan terima kasih atau apresiasi lainnya.\r\n\r\nTersedia juga mawar warna pink, putih, peach.\r\n\r\nTinggi bouquet ± 30 – 35 cm.', 'Best Seller,Bouquet', 'Rose', 'Anniversary,Birthday,Graduation,Valentine'),
	(24, 'Single Hydrangea Bouquet', 80000, 'Single Hydrangea Bouquet ini adalah rangkaian bunga minimalis tapi tetap terlihat mewah. Menggunakan satu tangkai hydrangea fresh sebagai bunga utama, hydrangea dikenal sebagai simbol ketulusan, ucapan terima kasih, dan hubungan yang tulus, menjadikannya pilihan ideal untuk berbagai momen bermakna.\r\n\r\nTinggi bouquet ± 30 cm.', 'Bouquet', 'Hydrangea', 'Birthday,Graduation,Gift'),
	(25, 'Medium Blushing Petals Bouquet', 325000, 'Blushing Petals Bouquet ini dibuat dengan perpaduan warna pink pastel yang lembut dan penuh keceriaan, menghadirkan tampilan romantis sekaligus fresh. Cocok untuk menyampaikan pesan yang tulus seperti ulang tahun, aniversarry, graduation, dll.\r\n\r\nDisusun dengan kombinasi mawar pink, gerbera, chrysanthemum, dan carnation yang menambah tekstur manis pada rangkaian.\r\n\r\nTinggi bouquet ± 45 – 50 cm.', 'Bouquet', 'Gerbera,Rose', 'Birthday,Graduation,Gift,Valentine'),
	(26, 'Thumbelina Bouquet', 320000, 'Thumbelina Bouquet dikenal sebagai rangkaian bunga yang memancarkan keceriaan, kelembutan, dan energi positif melalui kombinasi warnanya yang hangat dan harmonis. Buket ini menggunakan perpaduan bunga berwarna peach, pink, merah, kuning, krem, dan sentuhan ungu, menciptakan tampilan yang feminine, youthful, dan lively.\r\n\r\nTinggi bouquet ± 45–55 cm.\r\n\r\nHubungi admin untuk custom warna yang diinginkan.', 'Best Seller,Bouquet', 'Gerbera,Gompie,Rose', 'Birthday,Graduation,Gift'),
	(27, 'Large Blushing Petals Bouquet', 500000, 'Blushing Petals Bouquet ini dibuat dengan perpaduan warna pink pastel yang lembut dan penuh keceriaan, menghadirkan tampilan romantis sekaligus fresh. Cocok untuk menyampaikan pesan yang tulus seperti ulang tahun, aniversarry, graduation, dll.\r\n\r\nDisusun dengan kombinasi mawar pink, gerbera, gompie, dan carnation yang menambah tekstur manis pada rangkaian.\r\n\r\nTinggi bouquet ± 50 – 60 cm.', 'Bouquet', 'Gerbera,Gompie,Rose', 'Birthday,Graduation,Valentine'),
	(28, 'Summer Breeze Bouquet', 427000, 'Perpaduan cerah sunflower dan sentuhan pastel pink yang menghadirkan energi positif dan kehangatan di bouquet ini. Melambangkan kebahagiaan, harapan baru, dan ketulusan, buket ini cocok untuk mengirim semangat dan merayakan momen spesial, seperti ulang tahun, graduation, ucapan semangat, apresiasi, dll.\r\n\r\nRangkaian ini mengkombinasikan sunflower yang cerah, gompie pink, baby rose, dan calimero kuning menambah kesan yang ceria.\r\n\r\nTinggi bouquet ± 45–55 cm.', 'Bouquet', 'Gompie,Sunflower', 'Birthday,Graduation,Gift'),
	(29, 'Strawberry Bouquet', 250000, 'Strawberry Bouquet adalah rangkaian unik yang memadukan manisnya strawberry segar dengan sentuhan lembut bunga filler pilihan. Melambangkan cinta yang tulus, perhatian, dan kehangatan, buket ini menjadi hadiah sempurna untuk menyampaikan rasa sayang dengan cara yang berbeda dan berkesan.\r\n\r\nBouquet ini terdiri dari 24 buah strawberry dan baby\'s breath sebagai filler.\r\n\r\nTinggi bouquet ± 45–55 cm.', 'Bouquet', NULL, 'Anniversary,Gift,Valentine'),
	(30, 'Medium Teddy Charm', 520000, 'Teddy Charm adalah perpaduan 20 tangkai bunga mawar dengan menambahkan boneka teddy bear. Rangkaian yang mengkombinasikan bunga dengan boneka termasuk dalam rangkaian modern, adanya boneka dalam rangkaian ini memberikan kesan sweet, cute, dan elegan.\r\n\r\nTinggi bouquet ± 60–70 cm.', 'Add-on,Bouquet', 'Rose', 'Anniversary,Birthday,Gift,Valentine'),
	(31, 'Dusty Money Bouquet', 475000, 'Dusty Money Bouquet adalah buket eksklusif yang memadukan lembaran uang tersusun rapi dengan bunga segar, menghadirkan kesan mewah, elegan dan penuh makna.\r\nBuket ini cocok untuk graduation, birthday, engagement, promotion atau momen special lainnya.\r\n\r\nTinggi bouquet ± 60 - 70 cm', 'Bouquet,Money Bouquet', 'Rose', 'Anniversary,Birthday,Graduation,Gift'),
	(32, 'Sustainable Bouquet', 160000, 'Rangkaian bunga ramah lingkungan dengan wrapping daun pisang yang alami dan elegan. Menghadirkan kesan earthy, unik, dan berkelanjutan tanpa plastik. Kombinasi bunga segar dipadukan dengan tekstur daun yang eksotis, menciptakan tampilan modern namun natural.\r\n\r\nSelain rangkaian sunflower ini, kamu juga bisa diskusikan dengan admin untuk jenis bunga lainnya.\r\n\r\nTinggi bouquet ± 30 – 40 cm', 'Bouquet', 'Sunflower', NULL),
	(33, 'Rose Round Bouquet', 295000, 'Rose Round Bouquet ini adalah rangkaian klasik yang memadukan kemewahan 10 tangkai rose merah sebagai simbol cinta, dipadukan dengan lembut baby\'s breath putih yang melambangkan ketulusan dan keabadian. Dibentuk dengan teknik hand-tied yang rapi dan elegan, menghasilkan tampilan timeless dan romantis.\r\n\r\nTinggi bouquet ± 25 - 30 cm.\r\nDiameter ± 15 cm.', 'Wedding Bouquet', 'Rose', 'Wedding'),
	(34, 'Blushing Garden Bouquet', 460000, 'Blushing Garden Bouquet adalah rangkaian bunga bernuansa pink lembut yang memancarkan kehangatan, kebahagiaan, dan kasih sayang yang tulus. Kombinasi lily dan mawar yang mekar anggun memberikan kesan mewah sekaligus romantis, menjadikannya pilihan sempurna untuk merayakan cinta, ulang tahun, anniversary, kelulusan, atau sebagai hadiah istimewa untuk orang yang tersayang.\r\n\r\nTinggi bouquet ± 45–50 cm', 'Bouquet', 'Lilly', 'Anniversary,Birthday,Graduation,Gift,Valentine'),
	(35, 'Violet Tulip Bouquet', 995000, 'Violet Tulip Bouquet adalah rangkaian tulip ungu yang memancarkan keanggunan, kekuatan, dan keindahan yang berkelas. Warna ungu pada tulip melambangkan kemewahan dan penghargaan yang mendalam. Dibalut dengan gaya modern dan minimalis, buket ini membawa kesan premium namun tetap lembut, cocok untuk Anda yang ingin memberikan hadiah yang bermakna dan berkesan.\r\n\r\nTinggi bouquet ± 40–45 cm.', 'Bouquet', NULL, 'Anniversary,Birthday'),
	(36, 'Pink Delight Bouquet', 200000, 'Pink Delight Bouquet adalah Rangkaian bunga yang penuh keceriaan dan kelembutan, memadukan rose pink yang melambangkan kasih sayang dan perhatian tulus, bersama gerbera putih yang murni, optimisme, dan kebahagiaan yang baru. Sentuhan baby’s breath putih memberikan kesan ringan, suci, dan harapan yang abadi.\r\n\r\nRangkaian ini cocok untuk ulang tahun, ucapan semangat, apresiasi, momen spesial, dan hadiah untuk orang tercinta.\r\n\r\nTinggi bouquet ± 35–45 cm', 'Bouquet', 'Gerbera,Rose', 'Birthday,Graduation,Gift'),
	(37, 'Large Artificial Lily Bouquet', 700000, 'Rangkaian bunga artificial premium bernuansa pastel dengan perpaduan lily, mawar, dan calla lily yang tampak natural dan elegan. Bouquet artificial flowers ini tahan lama tanpa perawatan, warna tidak mudah pudar, dan aman untuk penerima alergi bunga. Hadiah sempurna untuk ulang tahun, wisuda, anniversary, atau dekorasi ruangan sebagai simbol cinta dan kehangatan yang abadi.\r\n\r\nTinggi bouquet ± 45 – 50 cm', 'Artificial Flowers,Bouquet', 'Lilly,Rose', 'Birthday,Gift'),
	(38, 'Medium Peachy Bouquet', 495000, 'Medium Peachy Bouquet adalah rangkaian bunga lembut bernuansa peach dan ivory yang membawa kesan hangat dan menenangkan. Perpaduan mawar peach, gerbera putih, alstroemeria, dan baby breath menciptakan tampilan romantis yang elegan, simbol kasih sayang tulus dan harapan baik untuk masa depan.\r\n\r\nRangkaian ini cocok untuk momen spesial seperti ulang tahun, anniversary, wisuda, dan ucapan congratulations.\r\n\r\nTinggi bouquet ± 45–50 cm.', 'Bouquet', 'Gerbera,Rose', 'Birthday'),
	(39, 'Pink Royale Money Bouquet', 444000, 'Bouquet istimewa bernuansa pink elegan yang memadukan rangkaian uang dengan artificial flowers berkualitas premium. Sentuhan mawar pink dan filler flowers menambah kesan romantis dan mewah, menjadikan rangkaian ini simbol apresiasi, keberuntungan, dan harapan akan kemakmuran.\r\n\r\nDibungkus dengan wrapping warna soft pink dan jaring glitter yang mempesona, buket ini tampil megah dan berkelas, sempurna untuk merayakan momen spesial seoerti hadiah ulang tahun, anniversary, wisuda, lamaran, dan ucapan selamat atas pencapaian besar.\r\n\r\nBouquet ini juga memiliki makna kemakmuran, cinta yang tulus, dan doa terbaik untuk masa depan.\r\n\r\nTinggi bouquet ± 55 – 65 cm.', 'Artificial Flowers,Bouquet,Money Bouquet', NULL, 'Anniversary,Birthday,Gift'),
	(40, 'Medium Violet Bloombox', 612000, 'Violet Bloombox adalah rangkaian flower box bernuansa magenta dan ungu yang memancarkan kesan elegan, berani, dan penuh kehangatan. Komposisi bunga rose magenta, aster ungu, orchid merah marun, dan filler bernuansa pastel menciptakan harmoni yang cantik dan hidup, cocok untuk mempermanis ruangan ataupun sebagai hadiah penuh kesan.\r\n\r\nWarna magenta melambangkan cinta yang kuat dan penghargaan mendalam, sementara ungu membawa makna kreativitas, kemewahan, dan harapan untuk masa depan yang lebih indah. Dengan desain compact dalam box gradasi soft, rangkaian ini tampak modern dan menawan.\r\n\r\nCocok untuk hadiah ulang tahun, anniversary, corporate gift, dekorasi rumah & meja kerja.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'Box', 'Rose', 'Anniversary,Birthday,Gift'),
	(41, 'Sunflower Lily Bloom Box', 700000, 'Rangkaian bunga cerah penuh kehangatan ini memadukan keindahan sunflower, lily putih, mawar putih & kuning, serta dianthus peach & kuning dalam sebuah box premium bernuansa elegan. Kombinasi warna kuning, putih, dan peach melambangkan kebahagiaan, kemurnian hati, dan apresiasi yang tulus, menjadikannya pilihan sempurna untuk mengirimkan energi positif dan doa terbaik.\r\n\r\nDisusun dengan sentuhan artistik dan detail yang rapi, rangkaian ini menghadirkan kesan fresh, modern, dan penuh keceriaan, cocok untuk merayakan momen berbahagia bersama orang terkasih seperti, ulang tahun, ucapan semangat, wisuda, anniversary, atau sebagai hadiah spesial untuk mencerahkan hari seseorang.\r\n\r\nTinggi bloom box ± 45–55 cm.', 'Box', 'Dianthus,Lilly,Rose,Sunflower', 'Anniversary,Birthday,Graduation,Gift'),
	(42, 'Money Bloom Box', 660000, 'Money Bloom Box ini menghadirkan perpaduan mewah antara bunga dan elemen greenery yang segar, dipadukan dengan penyusunan rangkaian uang yang tertata rapi dan elegan. Desain premium dengan box silver bertekstur memberikan kesan berkelas, modern, dan sangat berkesan sebagai hadiah bernilai.\r\n\r\nKombinasi warna lembut dan elegan melambangkan kehangatan, penghargaan, dan harapan terbaik, sementara sentuhan rangkaian uang menjadikan hadiah ini bukan hanya indah dipandang tetapi juga memiliki nilai yang bermanfaat dan penuh kejutan.\r\n\r\nLebar bloom box ± 30 – 45 cm.', 'Box,Money Bouquet', 'Dianthus,Hydrangea', 'Birthday,Gift'),
	(43, 'Tulip Royal Blue Bloom Box', 925000, 'Tulip Royal Blue Bloom box ini menghadirkan sentuhan keindahan yang tenang dan berkelas. Rangkaian memadukan mawar putih dan biru, tulip biru yang menjadi pusat perhatian, diperkaya dengan aksen silver foliage yang memberikan kesan modern dan elegan. Nuansa warna dingin yang lembut menciptakan aura kedamaian, kepercayaan, dan ketulusan—menjadikannya hadiah yang penuh makna.\r\n\r\nDidesain dalam box premium silver, rangkaian ini tampil mewah dan eksklusif, ideal sebagai hadiah untuk merayakan pencapaian maupun menyampaikan apresiasi dengan cara yang berkesan.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'Box', 'Rose', 'Anniversary,Birthday,Gift,Valentine'),
	(44, 'Serene Bloom Bouquet', 680000, 'Bloom box manis bernuansa dusty pink ini menghadirkan perpaduan elegan antara mawar dusty pink dan eucalyptus segar yang dirangkai secara lembut dan modern. Sentuhan boneka pebby bear memberikan nuansa hangat, lembut, dan penuh kasih, menjadikannya hadiah yang ideal untuk mengekspresikan perhatian dan cinta dalam cara yang manis dan berkesan.\r\n\r\nWarna dusty pink melambangkan rasa sayang yang dewasa, kelembutan, dan ketulusan hati, cocok untuk diberikan kepada orang terdekat yang ingin Anda buat tersenyum seperti, valentine, ulang tahun, anniversary, hadiah untuk pasangan, sahabat, ataupun keluarga tersayang.\r\n\r\nTinggi bloom box ± 40–45 cm.', 'Add-on,Box', 'Rose', 'Anniversary,Birthday,Gift,Valentine'),
	(45, 'Elegance Noir Bloom Box', 935000, 'Elegance Noir Bloom Box adalah rangkaian bunga dalam box yang memadukan keanggunan mawar merah premium dengan sentuhan eksotis eucalyptus hitam. Komposisi warna kontras merah dan hitam menciptakan kesan dramatis, elegan, dan penuh kekuatan. Dihias dengan pita organza hitam berukuran besar yang mempertegas karakter mewah dan modern.\r\n\r\nRangkaian ini melambangkan cinta mendalam, keberanian, kekuatan hati, serta penghormatan yang tinggi. Cocok untuk momen spesial seperti anniversary, romantic surprise, congratulation, hingga sebagai gesture penghargaan yang penuh wibawa.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'Box', 'Rose', 'Anniversary,Birthday,Grand Opening,Gift,Valentine'),
	(50, 'Joyful Celebration Bloom Box', 525000, 'Joyful Celebration Bloom Box adalah rangkaian penuh keceriaan dan kehangatan yang dibuat khusus untuk momen ulang tahun, ucapan selamat, atau perayaan spesial lainnya. Menghadirkan kombinasi bunga segar seperti mawar putih, mawar merah mini, daisy putih dan aster kuning, serta bunga kertas poppy yang memberikan sentuhan artistik dan modern.\r\n\r\nDilengkapi dengan ruang khusus untuk menambahkan hadiah seperti gadget, aksesoris, atau hadiah lainnya. Menjadikan rangkaian ini pilihan istimewa dan personal untuk orang tersayang.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'Box', 'Rose', 'Birthday,Gift,Valentine'),
	(51, 'Royal Blue Jasmine Pomander Bouquet', 750000, 'Royal Blue Jasmine Pomander Bouquet adalah buket pernikahan modern yang memadukan keanggunan artificial orchid biru, kemewahan artificial amaranthus, dan sentuhan sakral dari melati segar yang menjuntai lembut. Dirancang dengan gaya pomander, buket ini menciptakan siluet memanjang yang elegan, menjadikannya pilihan sempurna untuk pengantin yang ingin tampil standout dan penuh karakter.\r\n\r\nCocok untuk pengantin yang menginginkan buket unik, fotogenik, dan tahan seharian.\r\n\r\nTinggi Wedding Bouquet ± 40–45 cm | Lebar ± 35 cm', NULL, NULL, NULL),
	(52, 'Aurora Bloom Cascade Bouquet', 1000000, 'Aurora Bloom Cascade Bouquet adalah rangkaian bunga segar yang memadukan kelembutan warna pink dan peach dalam komposisi yang anggun dan romantis. Dengan siluet cascade yang mengalir lembut, buket ini menghadirkan kesan mewah namun tetap natural, cocok untuk pengantin yang menginginkan tampilan feminin, elegan, dan timeless.\r\n\r\nRangkaiannya terdiri dari anggrek pink, lily, mawar quicksand, chrysanthemum, baby’s breath, serta aksen artificial amaranthus yang menambah efek jatuh. Perpaduan elemen ini menciptakan buket yang kaya tekstur, lembut dipandang, dan sangat fotogenik untuk momen pernikahan.\r\n\r\nMelambangkan cinta yang anggun, harapan baru, dan ketulusan yang mengalir, buket ini cocok untuk berbagai tema wedding mulai dari modern romantic, garden wedding, hingga indoor intimate celebration.\r\n\r\nTinggi Wedding Bouquet ± 60–65 cm | Lebar ± 35–40 cm', 'Wedding Bouquet', 'Gompie,Lilly,Rose', 'Wedding'),
	(53, 'White Serenity Contemporary Bouquet', 620000, 'White Serenity Contemporary Bouquet ini menghadirkan keindahan yang lembut dan anggun melalui perpaduan anggrek, anthurium, lily putih, dan sentuhan mawar soft pink, diperkaya dengan foliage hijau natural yang memberi kesan segar dan seimbang. Komposisi asimetris dengan aksen menjuntai menciptakan siluet modern namun tetap romantis.\r\n\r\nPalet warna putih dan pastel melambangkan kesucian, ketulusan, dan awal yang baru, sangat sesuai untuk akad, pemberkatan, maupun intimate wedding.\r\n\r\nBouquet ini nyaman digenggam, dan tetap terlihat sempurna sepanjang acara pilihan ideal bagi pengantin yang menginginkan tampilan timeless, rapi, dan effortless elegance tanpa khawatir layu di hari istimewa.\r\n\r\nTinggi Wedding Bouquet ± 30–35 cm | Lebar ± 45 cm', 'Wedding Bouquet', 'Lilly,Rose', 'Wedding'),
	(54, 'Pure Vow Hand Tied Bouquet', 410000, 'Pure Vow Hand Tied Bouquet ini menampilkan perpaduan elegan antara mawar putih, calla lily blush, dan lisianthus putih, dipadukan dengan sentuhan foliage hijau natural yang ringan. Aksen amaranthus menjuntai menghadirkan nuansa tradisional yang anggun sekaligus romantis.\r\n\r\nDesain hand tied dengan siluet ramping memberi kesan modern dan effortless, cocok untuk pengantin yang menyukai tampilan natural namun tetap berkarakter. Perpaduan warna putih dan blush melambangkan kesucian, ketulusan, dan kelembutan cinta, menjadikan bouquet ini ideal untuk akad, intimate wedding, maupun prosesi sakral dengan sentuhan adat.\r\n\r\nBouquet ini terasa ringan saat digenggam, fotogenik, dan memberikan kesan timeless bridal elegance dengan detail yang bermakna.\r\n\r\nTinggi Wedding Bouquet ± 30 cm | Lebar ± 25 cm', 'Wedding Bouquet', 'Rose', 'Wedding'),
	(56, 'Amour Classic Posy Bouquet', 360000, 'Amour Classic bernuansa merah & putih yang menampilkan kesan elegan, tegas, dan penuh makna. Rangkaian ini terdiri dari mawar merah yang melambangkan cinta dan keberanian, dipadukan dengan mawar putih sebagai simbol ketulusan dan kemurnian. Sentuhan baby breath putih, calimero kecil, serta aksen daun eucalyptus kering memberikan tekstur alami yang seimbang dan mempercantik tampilan keseluruhan.\r\n\r\nDisusun dengan gaya posy bouquet yang rapi dan timeless, rangkaian ini cocok untuk menyampaikan perasaan mendalam dengan cara yang sederhana namun berkelas.\r\n\r\nTinggi wedding bouquet ± 40–45 cm', 'Wedding Bouquet', 'Rose', 'Wedding'),
	(58, 'Timeless Calla Posy Bouquet', 400000, 'Timeless Calla bernuansa all white yang memancarkan kesan suci, elegan, dan timeless. Rangkaian ini menampilkan calla lily putih sebagai bunga utama, dipadukan dengan baby breath yang lembut serta sentuhan greenery natural untuk memberi kesan segar dan seimbang. Bentuk rangkaian yang rapi namun tetap terlihat ringan menciptakan tampilan anggun yang sangat menawan di tangan pengantin.\r\n\r\nCalla lily dikenal sebagai simbol kemurnian, kesetiaan, dan keanggunan, menjadikan buket ini pilihan sempurna untuk momen sakral pernikahan. Dibalut pita organza lembut, buket ini tampil klasik dan sophisticated tanpa kesan berlebihan.\r\n\r\nTinggi wedding bouquet ± 40–45 cm', 'Wedding Bouquet', NULL, 'Wedding'),
	(59, 'Azure Grace Hand Tied Bouquet', 350000, 'Azure Grace bernuansa biru dan putih ini memancarkan keanggunan yang lembut dan modern. Rangkaian terdiri dari rose putih dengan sentuhan biru, gerbera putih, chrysanthemum biru, serta anthurium putih, dipadukan dengan dedaunan hijau segar yang memberi keseimbangan alami. Aksen pita biru memberikan sentuhan akhir yang elegan dan refined.\r\n\r\nPerpaduan warna biru melambangkan ketenangan, kepercayaan, dan ketulusan, sementara putih mencerminkan kemurnian dan keanggunan, menjadikan bouquet ini pilihan sempurna untuk momen istimewa yang berkesan namun tetap understated.\r\n\r\nTinggi wedding bouquet ± 40–45 cm', 'Wedding Bouquet', 'Gerbera,Rose', 'Wedding'),
	(60, 'Harmony Round Basket', 670000, 'Rangkaian bunga dalam keranjang ini memadukan mawar peach, dianthus ungu dan carnation pink, krisan, serta anggrek phalaenopsis bernuansa peach. Disusun 360 derajat dengan gaya garden yang natural, rangkaian ini menghadirkan kesan manis, elegan, dan penuh kehangatan. Perpaduan warna pastel yang lembut menciptakan suasana ceria namun tetap anggun, cocok untuk ungkapan kasih sayang, ucapan terima kasih, ulang tahun, maupun hadiah istimewa untuk orang terdekat.\r\n\r\nTinggi basket flower ± 30 - 40 cm.\r\nDiameter ± 20 cm.', 'Basket', 'Dianthus,Rose', 'Birthday,Gift,Valentine'),
	(61, 'Small Tuty Fruty Basket', 350000, 'Rangkaian buah dan bunga ini memadukan kesegaran buah pilihan dengan keindahan bunga yang ditata harmonis dalam keranjang 360 derajat. Anggur hijau, apel, dan jeruk memberikan kesan segar dan berlimpah, berpadu dengan sentuhan bunga seperti mawar, anggrek, gerbera, dan filler hijau yang menambah nilai estetika. Tampilan keseluruhan terasa hangat, eksklusif, dan penuh perhatian, menjadikannya pilihan ideal sebagai hadiah ucapan selamat, ungkapan terima kasih, get well soon, maupun hampers premium untuk berbagai momen spesial.\r\n\r\nTinggi flower basket ± 20 - 25 cm.\r\nLebar basket 22 cm x 20 cm.', 'Basket', 'Gerbera,Rose', 'Gift'),
	(62, 'Tuty Fruty Basket', 550000, 'Rangkaian Tuty Fruty Basket ini memadukan kesegaran buah pilihan dengan sentuhan bunga bernuansa putih-emas yang elegan. Disusun dalam keranjang berisi apel merah, anggur hijau, jeruk, dan pisang yang tertata rapi, dilengkapi bunga mawar putih, krisan, serta aksen daun dekoratif berwarna emas yang memberi kesan mewah. Sentuhan pita khas Ilmis Garden mempermanis tampilan sekaligus menghadirkan kesan eksklusif. Cocok sebagai hampers ucapan cepat sembuh, hadiah keluarga, atau tanda perhatian yang hangat dan berkelas.\r\n\r\nTinggi flower basket ± 30 - 35 cm.', 'Basket', 'Gompie,Rose', 'Gift'),
	(64, 'Golden Bloom Harmony', 355000, 'Rangkaian centerpiece ini menghadirkan perpaduan warna putih, kuning, dan biru yang segar dan menenangkan. Disusun dengan mawar putih elegan, krisan kuning cerah, baby breath, serta sentuhan snapdragon biru yang memberi kontras lembut dan modern. Diletakkan dalam box minimalis dengan aksen pita khas ilmisgarden, rangkaian ini memancarkan kesan hangat, optimis, dan penuh ketulusan. Cocok sebagai hadiah ucapan terima kasih, semangat baru, ulang tahun, maupun ungkapan perhatian yang tulus dan berkelas.\r\n\r\nTinggi centerpiece box ± 30 cm.', 'Box,Centerpiece', 'Rose', 'Gift'),
	(65, 'Grace Bloom Harmony', 200000, 'Rangkaian centerpiece ini menghadirkan keindahan putih alami yang lembut dan menenangkan. Disusun dengan bunga mawar putih yang anggun, dipadukan dengan baby breath/bunga peacock, bunga ammimajus hijau muda, serta dedaunan segar yang memberi kesan natural dan seimbang. Diletakkan dalam box putih minimalis, rangkaian ini cocok sebagai dekorasi meja, hadiah ucapan terima kasih, hingga pelengkap acara intimate dengan konsep clean dan elegan. Memberikan sentuhan ketenangan, kesederhanaan, dan keanggunan dalam satu rangkaian yang timeless.\r\n\r\nTinggi centerpiece box ± 30 cm.', 'Box,Centerpiece', 'Rose', 'Gift'),
	(66, 'Ocean Money Bouquet', 360000, 'Rangkaian money bouquet ini tampil modern dan eye-catching dengan dominasi warna biru yang segar dan elegan. Susunan uang 20 lembar dengan perpaduan bunga fresh bernuansa biru, baby breath yang lembut, serta aksen dedaunan dan filler kering menciptakan tampilan yang penuh tekstur namun tetap rapi. Cocok sebagai hadiah ulang tahun, wisuda, atau momen spesial lainnya untuk menyampaikan doa kemakmuran, kesuksesan, dan kebahagiaan dengan cara yang unik dan berkesan.\r\n\r\nTinggi bouquet ± 45 – 50 cm.', 'Bouquet,Money Bouquet', 'Rose', 'Birthday,Graduation,Gift'),
	(67, 'Azure Fortune Money Bouquet', 550000, 'Money Bouquet ini menampilkan komposisi unik dengan lipatan uang 50 lembar yang dibentuk menyerupai bunga, dipadukan dengan baby breath bernuansa biru yang lembut. Dominasi warna biru pastel memberikan kesan tenang, elegan, dan modern, sementara wrapping transparan biru muda menambah tampilan yang airy dan rapi. Rangkaian ini tidak hanya menarik secara visual, tetapi juga melambangkan doa kemakmuran, harapan baik, dan keberuntungan. Cocok dijadikan hadiah wisuda, ulang tahun, atau perayaan pencapaian spesial dengan sentuhan yang berbeda dan berkesan.\r\n\r\nTinggi bouquet ± 45 – 50 cm.', 'Bouquet,Money Bouquet', NULL, 'Birthday,Gift'),
	(68, 'Majestic Money Bouquet', 325000, 'Majestic Money Bouquet ini memadukan rangkaian uang 10 lembar dengan kombinasi bunga berwarna bold dan elegan. Mawar merah yang dominan melambangkan cinta, keberanian, dan apresiasi mendalam, dipadukan dengan mawar putih yang memberi sentuhan tulus dan anggun. Kehadiran anthurium ungu serta gerbera merah menambah karakter modern dan statement yang kuat, sementara aksen filler lembut menyeimbangkan keseluruhan tampilan. Rangkaian ini cocok sebagai hadiah ulang tahun, wisuda, anniversary, atau perayaan spesial untuk menyampaikan doa kemakmuran, kesuksesan, dan rasa bangga dengan cara yang berkesan.\r\n\r\nTinggi bouquet ± 40 – 45 cm.', 'Bouquet,Money Bouquet', NULL, 'Anniversary,Birthday,Graduation,Gift'),
	(69, 'Blue Horizon Money Bouquet', 310000, 'Blue Horizon Money Bouquet ini dirancang dengan perpaduan warna biru dan putih yang segar dan elegan, menampilkan lembaran uang 20 lembar yang disusun rapi sebagai elemen utama, dipadukan dengan bunga fresh bernuansa biru–putih serta baby breath biru sebagai aksen. Rangkaian ini melambangkan doa kemakmuran, ketenangan, dan harapan baik untuk masa depan. Cocok sebagai hadiah wisuda, ulang tahun, maupun momen spesial yang ingin dikenang dengan kesan berkelas dan berharga.\r\n\r\nTinggi bouquet ± 40 – 45 cm.', 'Bouquet,Money Bouquet', 'Rose', 'Birthday,Graduation,Gift'),
	(70, 'Deluxe Money Bouquet', 850000, 'Deluxe Money Bouquet ini menampilkan uang 100 lembar yang disusun rapi dipadukan dengan mawar pink dan mawar putih. Dominasi warna pastel memberikan kesan tenang, dan modern. Rangkaian ini tidak hanya menarik secara visual, tetapi juga melambangkan doa kemakmuran, harapan baik, dan keberuntungan. Cocok dijadikan hadiah wisuda, ulang tahun, atau perayaan pencapaian spesial dengan sentuhan yang berbeda dan berkesan.\r\n\r\nTinggi bouquet ± 60 – 70 cm.', 'Bouquet,Money Bouquet', 'Rose', 'Birthday,Graduation,Gift'),
	(71, 'Treats of Fortune Money Bouquet', 205000, 'Treats of Fortune adalah rangkaian snack & uang yang dirangkai dengan konsep fun namun tetap rapi dan elegan, memadukan lembaran uang 10 lembar dengan snack favorit sebagai fokus utama. Rangkaian ini menjadi pilihan hadiah yang unik dan praktis. Tidak hanya cantik secara visual, tetapi juga bisa langsung dinikmati. Cocok untuk kado ulang tahun, wisuda, kejutan kelulusan, atau perayaan spesial dengan kesan ceria dan berkesan.\r\n\r\nTinggi bouquet ± 40 – 45 cm.', 'Add-on,Bouquet,Money Bouquet', NULL, 'Birthday,Graduation,Gift'),
	(72, 'Golden Artificial Bouquet', 360000, 'Rangkaian bunga artificial premium bernuansa emas dan merah dengan perpaduan peony, mawar, dan sentuhan filler kering menciptakan tampilan yang penuh tekstur namun tetap rapi. Bouquet artificial flowers ini tahan lama tanpa perawatan, warna tidak mudah pudar, dan aman untuk penerima alergi bunga. Hadiah sempurna untuk ulang tahun, wisuda, anniversary, atau dekorasi ruangan sebagai simbol cinta dan kehangatan yang abadi.\r\n\r\nTinggi bouquet ± 40 – 45 cm', 'Artificial Flowers,Bouquet,Dried Flowers', 'Rose', 'Birthday,Graduation,Gift'),
	(73, 'Heartfelt Artificial Bouquet', 310000, 'Heartfelt Artificial Bouquet ini menampilkan perpaduan bunga mawar pink, mawar merah, dan carnation putih sebagai fokus utama. Rangkaian ini melambangkan cinta yang tulus dan penuh kasih, disertai rasa hormat, perhatian, dan kehangatan yang lembut. Cocok untuk menyampaikan perasaan yang dalam namun tidak berlebihan seperti valentine, anniversary, atau wisuda. Bouquet artificial ini akan tetap cantik dan tahan lama meski tanpa perawatan.\r\n\r\nTinggi bouquet ± 40 – 45 cm', 'Artificial Flowers,Bouquet', 'Rose', 'Anniversary,Birthday,Gift,Valentine'),
	(74, 'Bouquet Arrangement Workshop', 1600000, 'Workshop ini dirancang untuk memperkenalkan teknik dasar hingga komposisi profesional dalam merangkai bouquet bunga. Peserta akan mempelajari pemilihan bunga, teknik hand-tied, keseimbangan warna, serta finishing agar buket terlihat rapi dan estetik. Cocok untuk pemula, hobi, hingga corporate activity.', NULL, NULL, 'Workshop'),
	(75, 'Vase Arrangement Workshop', 1840000, 'Workshop ini dirancang untuk memperkenalkan teknik dasar hingga komposisi profesional dalam merangkai bunga di dalam vase. Peserta akan mempelajari penataan bunga yang proporsional, keseimbangan warna dan tekstur, serta teknik finishing agar rangkaian terlihat harmonis dan estetik dari berbagai sudut. Cocok untuk pemula, hobi, hingga corporate activity.', NULL, NULL, 'Workshop'),
	(76, 'Box Arrangement Workshop', 2020000, 'Workshop ini dirancang untuk memperkenalkan teknik dasar hingga komposisi profesional dalam merangkai bunga di dalam box. Peserta akan mempelajari teknik penataan bunga yang rapi dan seimbang, pemilihan warna yang harmonis, serta finishing agar rangkaian terlihat elegan dan premium. Cocok untuk pemula, hobi, hingga corporate activity.', NULL, NULL, 'Workshop'),
	(77, 'Basket Arrangement Workshop', 1900000, 'Workshop ini dirancang untuk memperkenalkan teknik dasar hingga komposisi profesional dalam merangkai bunga di dalam basket. Peserta akan mempelajari penataan bunga dengan karakter natural, keseimbangan warna dan tekstur, serta teknik finishing agar rangkaian terlihat hangat dan estetik. Cocok untuk pemula, hobi, hingga corporate activity.', NULL, NULL, 'Workshop'),
	(78, 'Wedding Bouquet Workshop', 1800000, 'Workshop ini dirancang khusus untuk memperkenalkan teknik dasar hingga komposisi profesional dalam merangkai wedding bouquet. Peserta akan mempelajari struktur buket pengantin, pemilihan bunga dan warna, serta detail finishing agar buket terlihat elegan dan sesuai standar wedding florist. Cocok untuk pemula, hobi, maupun calon florist.', NULL, NULL, 'Workshop'),
	(79, 'Sweet Bouquet', 360000, 'Sweet Bouquet adalah rangkaian bunga bernuansa lembut yang memancarkan cinta, kehangatan, dan ketulusan. Perpaduan mawar sweet pink yang mekar sempurna dengan sentuhan baby breath dan daun parvi menciptakan kesan manis sekaligus elegan. Ornamen berbentuk hati menambah nuansa romantis, menjadikannya pilihan sempurna untuk mengungkapkan rasa sayang di momen spesial Sebulan Penuh Cinta ini, atau sekadar mengatakan “I’m thinking of you.”\r\nDibalut wrapping soft pink khas Ilmisgarden, Sweet Bloom hadir sebagai simbol cinta yang sederhana namun penuh makna.\r\n\r\nDetail: \r\n- 8 tangkai mawar sweet pink\r\n- daun parvi\r\n- baby breath\r\n- 2 buah ornamen hati\r\nTinggi buket ± 40 – 45 cm.\r\nLebar buket ± 35 cm.', 'Bouquet', 'Rose', 'Valentine,Sebulan Penuh Cinta'),
	(80, 'Baby Breath Bloom', 145000, 'Baby Breath Bloom menghadirkan keindahan yang ringan, manis, dan penuh ketulusan. Rangkaian baby breath berwarna pink dan hijau menciptakan tampilan yang unik, segar, sekaligus romantis. Dilengkapi dengan ornamen berbentuk hati, buket ini melambangkan cinta yang sederhana namun terus tumbuh, seperti perhatian kecil yang berarti besar.\r\nDibungkus dengan wrapping hijau sage yang modern dan pita pink, buket ini sempurna untuk momen berbagi kasih sayang di Sebulan Penuh Cinta.\r\n\r\nDetail:\r\n- baby breath pink & hijau\r\n- 2 buah ornamen hati\r\nTinggi buket ± 40 cm.\r\nLebar buket ± 35 cm.', 'Bouquet', NULL, 'Valentine,Sebulan Penuh Cinta'),
	(81, 'Blushing Heart Bouquet', 590000, 'Blushing Heart Bouquet memancarkan pesona ceria dengan sentuhan lembut dan modern. Rangkaian bunga pompom berwarna pink-ungu tampil manis dan bertekstur unik, dipadukan dengan daun parvi segar yang memberi kesan seimbang dan elegan. Ornamen berbentuk hati berwarna pink menambah nuansa romantis tanpa berlebihan.\r\nDibalut wrapping hijau sage dan pita pink khas Ilmisgarden, buket ini melambangkan kasih sayang, kebahagiaan, dan perhatian yang hangat, sempurna untuk hadiah manis di momen Sebulan Penuh Cinta.\r\n\r\nDetail:\r\n- 9 tangkai pompom pink\r\n- daun parvi\r\n- 2 buah ornamen hati\r\nTinggi buket ± 40 – 45 cm.\r\nLebar buket ± 35 - 40 cm.', 'Bouquet', 'Pom-pom', 'Valentine,Sebulan Penuh Cinta'),
	(82, 'Soft Crush Bouquet', 550000, 'Soft Crush Bouquet dirangkai dengan penuh cinta untuk menyampaikan rasa cinta atau kasih sayang kepada pasangan. Menggunakan kombinasi bunga lily putih yang lembut, gompie putih yang bertekstur unik, daun parvi, baby breath, serta mawar sweet pink yang membuat buket ini terlihat manis dan menarik. Dilengkapi juga ornamen berbentuk hati sebagai simbol cinta yang tulus dan abadi.\r\nDibungkus dengan kertas pink dan pita khas Ilmisgarden, buket ini cocok untuk momen special seperti kejutan di Sebulan Penuh Cinta.\r\n\r\nDetail:\r\n- 1 tangkai lily putih\r\n- 3 tangkai mawar sweet pink\r\n- 4 tangkai gompie putih\r\n- baby breath\r\n- daun parvi\r\n- 2 buah ornamen hati\r\nTinggi buket ± 45 – 50 cm.\r\nLebar buket ± 45 – 50 cm.', 'Bouquet', 'Gompie,Lilly,Rose', 'Valentine,Sebulan Penuh Cinta'),
	(83, 'Sunny Love', 480000, 'Sunny Love adalah rangkaian bunga yang memancarkan keceriaan, kehangatan, dan cinta. Perpaduan bunga matahari berwarna kuning cerah dengan sentuhan baby breath dan daun parvi memberikan kesan segar dan elegan. Dihiasi ornamen berbentuk hati yang manis, membuat buket ini cocok untuk mengungkapkan rasa sayang kepada orang tersayang di Sebulan Penuh Cinta.\r\nDibungkus dengan wrapping bernuansa hijau sage dan pita pink yang lembut, buket ini tampil cantik, modern, dan mencuri perhatian.\r\n\r\nDetail:\r\n- 5 tangkai bunga matahari\r\n- baby breath\r\n- daun parvi\r\n- 2 buah ornamen hati\r\nTinggi buket ± 40 – 45 cm.\r\nLebar buket ± 40 cm.', 'Bouquet', 'Sunflower', 'Valentine,Sebulan Penuh Cinta'),
	(84, 'Choco Single Flower', 90000, 'Choco Single Flower merupakan rangkaian hadiah manis yang memadukan keindahan bunga segar dengan sentuhan coklat favorit. \r\n\r\nTambahan coklat serta ornamen hati berwarna pink memperkuat nuansa romantis dan sweet.\r\n\r\nDetail:\r\n- 1 coklat silverqueen\r\n- 1 tangkai mawar sweet pink atau 2 tangkai gerbera\r\n- 1 buah ornamen hati\r\nTinggi buket ± 35 – 40 cm.\r\nLebar buket ± 20 cm.', 'Add-on,Bouquet', 'Gerbera,Rose', 'Valentine,Sebulan Penuh Cinta'),
	(85, 'Sweet Classic Bloombox', 1000000, 'Sweet Classic Bloombox adalah rangkaian bunga elegan dengan sentuhan romantis klasik yang memikat. Dipenuhi oleh mawar pink lembut yang tersusun rapi membentuk tampilan penuh dan mewah, rangkaian ini dipadukan dengan lily putih anggun yang memberikan kesan bersih, feminin, dan berkelas. Ornamen hati menambah nuansa cinta yang manis dan modern.\r\nPerpaduan warna pastel dan bunga premium menjadikan rangkaian ini simbol kasih sayang yang timeless dan penuh makna.\r\n\r\nDetail: \r\n- 40 tangkai mawar sweet pink\r\n- 1 tangkai lily putih\r\n- 2 buah ornamen love\r\nTinggi bloombox ± 40 – 45 cm.\r\nLebar bloombox ± 35 – 40 cm.', 'Box', 'Lilly,Rose', 'Valentine,Sebulan Penuh Cinta'),
	(86, 'Sweet Pebby Bloom', 620000, 'Sweet Pebby Bloom adalah rangkaian bunga bernuansa lembut dan romantis yang memadukan keindahan bunga mawar sweet pink yang mekar sempurna, gerbera putih, juga sentuhan carnation pink yang menciptakan kesan romantis, dan manis dari boneka.\r\nRangkaian ini cocok untuk melengkapi moment romantis dengan orang tersayang di Sebulan Penuh Cinta.\r\n\r\nDetail:\r\n- 1 buah boneka pebby\r\n- 3 tangkai mawar sweet pink\r\n- 4 tangkai gerbera putih\r\n- 5 tangkai carnation pink\r\n- daun parvi\r\n- 2 buah ornamen hati\r\nTinggi bloombox ± 40 – 45 cm.\r\nLebar bloombox ± 25 cm.', 'Add-on,Box', 'Gerbera,Rose', 'Valentine,Sebulan Penuh Cinta'),
	(87, 'Brownies and Bloom', 270000, 'Brownies and Bloom adalah rangkaian hadiah manis yang memadukan keindahan bunga mawar segar dan gerbera pink yang manis, dengan sajian brownies lezat dalam satu kemasan elegan.\r\nDikemas dalam cup holder pink minimalis dengan tambahan cup brownies yang praktis dan estetik, serta dihiasi pita hitam dan pink yang elegan.\r\n\r\nDetail:\r\n- 1 cup brownies coklat\r\n- 4 tangkai mawar putih\r\n- 3 tangkai gerbera pink\r\n- baby breath\r\n- daun parvi\r\n- 2 buah ornamen hati\r\nTinggi ± 30 - 35 cm.\r\nLebar ± 20 cm.', 'Add-on', 'Gerbera,Rose', 'Valentine,Sebulan Penuh Cinta'),
	(88, 'Fortune Basket', 565000, 'Rangkaian Fortune Basket ini memadukan keindahan bunga segar dengan simbol kemakmuran dalam satu keranjang anyaman yang elegan. Perpaduan bunga dan buah jeruk segar tersusun rapi di dalam basket sebagai simbol rezeki, kelimpahan, dan harapan baik, dilengkapi daun hias serta ornamen bambu dan gantungan khas yang memperkuat nuansa tradisional penuh makna.\r\n\r\nDetail:\r\n- 10 buah jeruk\r\n- 2 potong bambu\r\n- 1 tangkai heliconia\r\n- 1 tangkai daun song of india\r\n- 2 tangkai gerbera orange\r\n- 2 tangkai gompie putih\r\nTinggi basket ± 50 - 55 cm.\r\nLebar basket ± 25 cm.', 'Basket', 'Gerbera,Gompie', 'Imlek'),
	(89, 'Golden Harmony Bloombox', 720000, 'Rangkaian Golden Harmony Bloombox menghadirkan perpaduan harmonis antara keindahan bunga dan simbol keberuntungan dengan desain modern bernuansa oriental. Dirangkai menggunakan bunga heliconia, anthurium, krisan kuning, gerbera, mawar cherry brandy dan mawar mohana yang memancarkan kesan hangat, optimisme, serta kemakmuran. Aksen bambu hijau yang berdiri kokoh melambangkan pertumbuhan dan keseimbangan, dilengkapi ornamen gantung khas sebagai simbol keberuntungan dan doa baik.\r\nDikemas dalam bloombox berwarna cokelat keemasan yang memberi sentuhan eksklusif dan berkelas, rangkaian ini cocok untuk ucapan Imlek.\r\n\r\nDetail:\r\n- 1 tangkai heliconia\r\n- 4 potomg bambu\r\n- 3 tangkai daun song of india\r\n- 2 tangkai anthurium hijau\r\n- 2 tangkai gerbera orange\r\n- 1 tangkai mawar cherry brandy\r\n- 1 tangkai mawar mohana\r\nTinggi bloombox ± 60 - 65 cm.\r\nLebar bloombox  ± 55 cm.', 'Box', 'Gerbera,Gompie,Rose', 'Imlek'),
	(90, 'Imperial Luck Arrangement', 1680000, 'Rangkaian Imperial Luck Arrangement memancarkan kemewahan klasik berpadu dengan simbol keberuntungan dan kemakmuran. Disusun dengan bunga anggrek yang menjadi highlight dan memberikan kesan mewah. Aksen bambu alami yang menjulang memberikan makna keteguhan dan pertumbuhan, sementara ornamen gantung bernuansa oriental melengkapi rangkaian dengan doa keberuntungan dan keseimbangan energi positif.\r\n\r\nDetail:\r\n- 1 pohon anggrek\r\n- 2 tangkai bunga heliconia\r\n- 4 potomg bambu\r\n- 4 tangkai daun song of india\r\n- 3 tangkai bunga anthurium\r\n- 3 tangkai bunga gerbera\r\n- 6 tangkai bunga mawar cherry brandy\r\n- 7 tangkai bunga mawar mohana\r\nTinggi bloombox ± 75 - 80 cm.\r\nLebar bloombox ± 70 cm.', 'Box', 'Gerbera,Gompie,Rose', 'Imlek'),
	(91, 'Mubarak Lux Box', 1800000, 'Rangkaian Mubarak Lux Box ini memadukan keindahan bunga anggrek biru yang lembut dipadukan dengan bunga ranunculus, mawar putih, gompie, serta sentuhan greenery yang memberikan kesan segar dan elegan. Nuansa warna biru dan putih menghadirkan suasana yang tenang, bersih, dan penuh kehangatan—selaras dengan makna Idul Fitri sebagai momen kembali kepada kesucian.\r\n\r\nSemua bunga dirangkai dalam box biru pastel dan dipadukan dengan Kue khas Lebaran, Reed Diffuser, dan Floral Tea.\r\n\r\nDetail:\r\n\r\n1 bunga anggrek\r\n2 tangkai ranunculus\r\n3 tangkai sedap malam\r\n8 tangkai daun silver dollar\r\n5 tangkai baby breath\r\n4 tangkai ammimajus\r\n3 tangkai anthurium\r\n2 tangkai gompie\r\n3 kue lebaran 800 ml (nastar, kaastengel, putri salju)\r\n1 reed diffuser 150 ml\r\n1 floral tea camovender isi 10 pcs\r\n\r\nTinggi bloom box ± 75 - 80 cm.\r\nLebar bloom box ± 45 cm.', 'Box', 'Gompie,Rose,Orchid', 'Raya,Eid Al Fitr'),
	(92, 'Silaturahmi in Bloom', 1400000, 'Rangkaian Silaturahmi in Bloom menghadirkan perpaduan bunga bernuansa putih lembut seperti bunga ranunculus, mawar, gompie, dan anthurium dipadukan dengan sentuhan greenery yang memberikan kesan bersih, tenang, dan penuh kehangatan. Komposisi bunga yang tertata natural menciptakan tampilan yang anggun sekaligus menyegarkan.\r\n\r\nRangkaian ini ditempatkan dalam box biru pastel eksklusif dengan sentuhan pita signature, dipadukan dengan hampers pilihan seperti Kue khas lebaran, Reed diffuser, dan Floral tea yang tersusun rapi di atas alas hitam elegan. Perpaduan warna putih–biru menghadirkan nuansa modern minimalis dengan sentuhan luxury.\r\n\r\nDetail:\r\n5 tangkai ranunculus\r\n2 tangkai sedap malam\r\n4 tangkai daun silver dollar\r\n2 tangkai baby breath\r\n2 tangkai ammimajus\r\n2 tangkai anthurium\r\n3 tangkai gompie\r\n2 kue lebaran 400 ml (bisa request nastar, kaastengel, putri salju)\r\n1 reed diffuser 150 ml \r\n1 floral tea camovender isi 5 pcs\r\n\r\nTinggi bloom box ± 50 - 60 cm.\r\nLebar bloom box ± 40 cm.', 'Box', 'Gompie,Rose', 'Raya,Eid Al Fitr'),
	(93, 'Cookies and Bloom', 270000, 'Rangkaian Cookies and Bloom memadukan mawar putih, tuberose, dan sentuhan eucalyptus yang memberikan kesan segar serta menenangkan. Warna putih yang mendominasi melambangkan ketulusan, kedamaian, dan kehangatan dalam berbagi, sementara tekstur bunga yang berlapis menciptakan tampilan yang anggun dan natural.\r\n\r\nDi sisi box, terdapat jar Kue khas Lebaran. Aksen pita hitam–putih signature memperkuat identitas brand dan memberi sentuhan sophisticated.\r\n\r\nDetail:\r\n2 tangkai mawar putih\r\n2 tangkai sedap malam\r\n2 tangkai daun silver dollar\r\n1 tangkai baby breath\r\n2 tangkai gerbera putih\r\n1 kue lebaran 400 ml (bisa request nastar, kaastengel, putri salju)\r\n\r\nTinggi ± 30 - 35 cm.\r\nLebar ± 20 cm.', NULL, 'Rose', 'Raya,Eid Al Fitr'),
	(94, 'Tuberose Vase', 810000, 'Rangkaian bunga ini menampilkan keindahan sedap malam putih yang tersusun anggun dalam vas kaca transparan, menghadirkan kesan bersih, tenang, dan elegan. Kelopak bunganya yang lembut dengan warna putih murni melambangkan ketulusan, harapan, serta kehangatan hati, sementara sentuhan daun hijau memberi keseimbangan alami yang menyegarkan. Dengan tampilan yang minimalis namun berkelas, rangkaian ini cocok menjadi simbol doa baik, ketenangan, dan perhatian tulus bagi seseorang yang istimewa.\r\n\r\nDetail:\r\n1 vas medium\r\n20 tangkai sedap malam\r\n\r\n*bisa request jenis dan jumlah bunga sesuai yang tersedia.', 'Vase', NULL, 'Raya,Eid Al Fitr');

-- Dumping structure for table ilmisgarden.transaction_items
CREATE TABLE IF NOT EXISTS `transaction_items` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `transaction_id` (`transaction_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id_transaction`) ON DELETE CASCADE,
  CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden.transaction_items: ~2 rows (approximately)
INSERT INTO `transaction_items` (`id_item`, `transaction_id`, `product_id`, `qty`, `price`) VALUES
	(5, 7, 22, 1, 100000),
	(6, 8, 26, 1, 320000),
	(7, 9, 94, 1, 810000);

-- Dumping structure for table ilmisgarden.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `total_items` int(11) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `status` enum('belum diproses','diproses','selesai') DEFAULT 'belum diproses',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_transaction`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden.transactions: ~2 rows (approximately)
INSERT INTO `transactions` (`id_transaction`, `user_id`, `total_items`, `subtotal`, `status`, `created_at`) VALUES
	(7, 'IL014', 1, 100000, 'selesai', '2026-01-24 03:11:47'),
	(8, 'IL016', 1, 320000, 'selesai', '2026-02-13 01:38:32'),
	(9, 'IL017', 1, 810000, 'belum diproses', '2026-03-20 22:37:03');

-- Dumping structure for table ilmisgarden.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden.users: ~15 rows (approximately)
INSERT INTO `users` (`id_user`, `username`, `email`, `whatsapp`, `password`, `date_of_birth`, `created_at`, `address`) VALUES
	('IL001', 'baros', 'andrianbaros46@gmail.com', '', '$2y$10$uZozSrM25US9Iz8NpJvOYuReuBDIhj/a/pJgra5RGWsVW5nb7YDYi', '2003-01-08', '2025-09-07 19:19:39', 'KBB'),
	('IL002', 'Ryuuou', 'a@a.a', '', '$2y$10$TPMrRNj.m4MamtAG6m/U2.03eqAJNg2gvCKJPTpk7wjS202/noRGq', '2025-09-08', '2025-09-08 04:23:10', 'a'),
	('IL003', 'chef', 'aji.10121095@mahasiswa.unikom.ac.id', '', '$2y$10$DajmbiKrGmVccFzNVoLm1eMmDfN/KLe5qVJe8JnC9nakLGRbTvm5q', '2025-09-08', '2025-09-08 16:30:41', ''),
	('IL005', 'ilmisgarden', 'ilmisgarden@gmail.com', '', '$2y$10$jnLdy4rR1k1LxvFQJDFq2ezSDZ16Kn3uEVhpozUhBmvXyi6f2rO5y', '2020-01-01', '2025-10-09 11:15:48', ''),
	('IL006', 'baros', 'anjaymabar@gmail.com', '', '$2y$10$.tErAprp5WMblFNGInjb4OzxK5PQ6LTzL95KAEf2JUB7lgz4Gli/a', '2025-10-28', '2025-10-30 03:03:45', ''),
	('IL007', 'nurulilmiss', 'nurulilmisuhada@gmail.com', '', '$2y$10$FOnxBm3/xYbzqbwUujbRfe9GCNCH6UbUt2sUIQST2xlGY/giia8Uq', '1995-12-15', '2025-11-27 15:45:23', 'Jl. Raya Golf Dago No.4'),
	('IL008', 'levinakun05@gmail.com', 'levinakun05@gmail.com', '', '$2y$10$0iTX7.tuB3CCVmUyhvTZFuXFiSwuCIumQ1YY.N6dWjpemVfLB4Cy.', '1993-06-16', '2025-11-28 06:35:19', 'Jalan raya nanjung'),
	('IL009', 'baros10', 'baros10@gmail.com', '0888888888', '$2y$10$asKNip80gip8Q32XRYrqROEYvtmol0y4.PfRIxUm4BLGnhEa1KjbO', '1999-02-24', '2025-12-28 03:48:35', 'baros'),
	('IL010', 'faunahs', 'shafiyanurul@gmail.com', '085353336327', '$2y$10$34qH43vhRlKqNNdZvxHDLusnri/jKWVkYgOpIFZr4mxkvPbAPR5kq', '1991-12-20', '2026-01-02 08:52:09', 'jalan salendro timur 2 no 3 bandung 40275'),
	('IL011', 'danuu', 'didaadanuwijaya@gmail.com', '089507363235', '$2y$10$w4BkA2.nAHBIboC7xcOcSuiOEO73LJi0SnXMd.VDP44efoEImLz4.', '2002-08-05', '2026-01-05 04:04:03', 'permata cimahi\r\n'),
	('IL012', 'Bibah', 'habibahnf15@gmail.com', '0895343770222', '$2y$10$.ernNy7cxdg8uulAR/FLX.ew8KkVvZjaUmTiG3oyS1KRKKUOmzBMi', '2026-01-05', '2026-01-05 05:05:28', 'Jl dago atas'),
	('IL013', 'N4', 'ramadany058@gmail.com', '082185114173', '$2y$10$H5nbYj/oKFjPptJOw/9.x.BySWPT2Ha36.Pt.z2wT2yHaW59AAF8S', '1998-01-18', '2026-01-20 04:58:11', 'Jl. Raya Golf Dago No.4'),
	('IL014', 'nashwannaf', 'nnaafilaa@gmail.com', '085720359093', '$2y$10$vzSNimQ6jHYRnUAA5LYGVe/y0fTUavmz278uJAOv.Mw1Bg18MjqKu', '2006-12-21', '2026-01-24 03:10:47', 'tubagus ismail III, dago bandung'),
	('IL015', '1', 'asadas@dasda.j', '08678678757', '$2y$10$Cod4Aurwb6mr0/hkzdngYOcG2loPsbROeRUEsFJbpJEojbbh1biHO', '1998-06-16', '2026-01-30 12:45:52', '1'),
	('IL016', 'mutiaraa_', 'mutiailmiana@gmail.com', '085717197962', '$2y$10$gWekOGrBotqtS7ReCMwYIeAcyXssUclNn013SvCYv9TJJkYIZ2IRe', '2003-03-23', '2026-02-13 01:32:41', 'Bekasi Timur Regensi blok H7/3'),
	('IL017', 'dapin', 'dapin@gmail.com', '08962131324', '$2y$10$lijbNZoRSnPmqdAIYf8SEu/6IP6f6nIps3mSU7C8Zolf4Dr8Jq8IS', '2000-08-19', '2026-03-20 22:29:27', 'test');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
