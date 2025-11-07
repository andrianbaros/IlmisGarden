-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ilmisgarden_db
CREATE DATABASE IF NOT EXISTS `ilmisgarden_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ilmisgarden_db`;

-- Dumping structure for table ilmisgarden_db.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.admin: ~1 rows (approximately)
INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`, `created_at`) VALUES
	(3, 'admin', 'admin@ilmis.com', '$2y$10$TDf8Vvm6yMsEHwXBLWb3Eux8CErm1uvqhLB.7oo5I6relknebFd76', '2025-09-10 04:02:30');

-- Dumping structure for table ilmisgarden_db.cart
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.cart: ~0 rows (approximately)

-- Dumping structure for table ilmisgarden_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.products: ~4 rows (approximately)
INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `type`) VALUES
	(17, 'Red Noir', 283000, 'img/pr/1762403454_Red Noir.png', 'Red Noir adalah rangkaian mawar merah tua nan memukau yang memancarkan pesona misterius dan elegan. Warna merah pekatnya melambangkan gairah, kekuatan, dan cinta yang mendalam — sempurna untuk mengungkapkan perasaan intens dengan sentuhan kemewahan dan keanggunan klasik.', 'flower'),
	(18, 'Serene Bloom Bouquet', 530000, 'img/pr/1762403536_IMG_1523.jpg', 'Serene Bloom Bouquet menghadirkan keindahan yang menenangkan lewat perpaduan bunga lembut bernuansa pastel. Setiap kelopak dipilih dengan cermat untuk menciptakan harmoni dan kedamaian dalam satu rangkaian. Sempurna untuk mengungkapkan ketulusan, ucapan terima kasih, atau harapan penuh ketenangan.', 'flower'),
	(19, 'Sunshine Bliss Bouquet', 150000, 'img/pr/1762403689_Sunshine Bliss Bouquet 1.png', 'Sunshine Bliss Bouquet memancarkan keceriaan dan kehangatan layaknya sinar mentari pagi. Rangkaian bunga berwarna kuning cerah dan putih lembut ini melambangkan optimisme, kebahagiaan, dan energi positif — pilihan sempurna untuk mencerahkan hari seseorang atau merayakan momen penuh sukacita.', 'flower'),
	(20, 'Rosé Amour Bouquet', 610000, 'img/pr/1762403708_Rosé Amour Bouquet.png', 'Rosé Amour Bouquet adalah perpaduan mawar merah muda lembut yang melambangkan kasih sayang, keanggunan, dan ketulusan cinta. Setiap tangkai dipilih dengan hati-hati untuk menciptakan rangkaian yang anggun dan romantis — sempurna untuk mengungkapkan perasaan pada momen istimewa seperti ulang tahun, hari kasih sayang, atau perayaan cinta.', 'flower');

-- Dumping structure for table ilmisgarden_db.transactions
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.transactions: ~0 rows (approximately)

-- Dumping structure for table ilmisgarden_db.transaction_items
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.transaction_items: ~0 rows (approximately)

-- Dumping structure for table ilmisgarden_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.users: ~3 rows (approximately)
INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `date_of_birth`, `created_at`, `address`) VALUES
	('IL001', 'baros', 'andrianbaros46@gmail.com', '$2y$10$uZozSrM25US9Iz8NpJvOYuReuBDIhj/a/pJgra5RGWsVW5nb7YDYi', '2003-01-08', '2025-09-07 19:19:39', 'KBB'),
	('IL002', 'Ryuuou', 'a@a.a', '$2y$10$TPMrRNj.m4MamtAG6m/U2.03eqAJNg2gvCKJPTpk7wjS202/noRGq', '2025-09-08', '2025-09-08 04:23:10', 'a'),
	('IL003', 'chef', 'aji.10121095@mahasiswa.unikom.ac.id', '$2y$10$DajmbiKrGmVccFzNVoLm1eMmDfN/KLe5qVJe8JnC9nakLGRbTvm5q', '2025-09-08', '2025-09-08 16:30:41', '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
