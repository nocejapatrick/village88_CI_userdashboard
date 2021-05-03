-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for capstoneproject
CREATE DATABASE IF NOT EXISTS `capstoneproject` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `capstoneproject`;

-- Dumping structure for table capstoneproject.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table capstoneproject.categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(23, 'Mugs', '2021-05-02 23:50:41', NULL),
	(25, 'T-Shirts!', '2021-05-03 00:23:56', NULL),
	(26, 'Shortssss', '2021-05-03 00:24:42', NULL),
	(28, 'Appliances', '2021-05-03 00:38:50', NULL),
	(30, 'Furnitures', '2021-05-03 17:49:36', NULL),
	(31, 'Caps', '2021-05-03 17:51:21', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table capstoneproject.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordered_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  `addresses_information` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table capstoneproject.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table capstoneproject.orders_products
CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_orders_products` (`order_id`),
  KEY `products_orders_products` (`product_id`),
  CONSTRAINT `orders_orders_products` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_orders_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table capstoneproject.orders_products: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;

-- Dumping structure for table capstoneproject.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `stocks` int(11) NOT NULL,
  `price` float NOT NULL,
  `images` longtext,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_categories` (`category_id`),
  CONSTRAINT `products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table capstoneproject.products: ~13 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `description`, `stocks`, `price`, `images`, `category_id`, `created_at`, `updated_at`) VALUES
	(5, 'Helicaptor', 'Sample Description', 30, 23.54, '{"main":"bgytSVJjXT9D.jpeg","subs":["RvcfXwpe2sy6.jpeg","OaTYst8BpWv2.jpeg"]}', 28, '2021-05-03 13:46:10', NULL),
	(6, 'Nike T-Shirt', '', 100, 39.99, '{"main":"2fnz56F3oJ1P.jpeg","subs":["6a4VZGeNMXoF.png","so2JPEG6XRkx.png"]}', 25, '2021-05-03 14:38:36', NULL),
	(7, 'Cool T-Shirt', '', 20, 20.32, '{"main":"kEeta5IWL9mR.png","subs":["anuVDPprCj8l.jpeg","fAs2P4vUMb9i.jpeg","b7PAcQgRBqhN.jpeg","MJbGNufazt6S.jpeg"]}', 25, '2021-05-03 17:42:00', NULL),
	(8, 'Simple T-Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 90, 20.42, '{"main":"DfPBXLnYJRMK.png","subs":["ZEUNVS2Yd6AQ.jpeg","Gz6KCe5OjuSP.jpeg","cCKN1AfrlJko.jpeg","cjeW2hkITCrb.png"]}', 25, '2021-05-03 17:42:58', NULL),
	(9, 'Shark T-Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 56, 10.94, '{"main":"Yy9NmegF24aS.png","subs":["aqOhJx5BtcG8.jpeg","4Yx1e7RTltVu.png","Tgw78XB59pjC.png"]}', 25, '2021-05-03 17:43:20', NULL),
	(10, 'T-Shirt For Dogs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 20, 10.32, '{"main":"EYi84nD6KpcM.png","subs":["Mz0Ft7mfyEi5.jpeg","qOhfvEXd31ig.jpeg","uzXoO0sqrglt.jpeg","8CK1FQZGLWEl.png"]}', 25, '2021-05-03 17:44:29', NULL),
	(11, 'T-Shirt For Cats', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 85, 2.43, '{"main":"T5M8nPFEwpXd.jpeg","subs":["EZzxSNmuyVYQ.jpeg","BtyC97SUkVns.jpeg","IABh0Z2Ozma5.jpeg"]}', 25, '2021-05-03 17:45:34', NULL),
	(12, 'Couple Mug', '', 20, 30.02, '{"main":"aL6PdhTEXNgq.jpeg","subs":["x7gwejvCuAki.jpeg","2xviGwgqt1cX.jpeg","D6UpGBJwX9fA.jpeg"]}', 23, '2021-05-03 17:47:45', NULL),
	(13, 'Simple Mug', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 85, 23, '{"main":"LRf0rbcivXKh.jpeg","subs":["xtGsZw8G2RAe.jpeg","rsYquPX6eljI.jpeg","Y3lURXDIBgPw.jpeg"]}', 23, '2021-05-03 17:48:45', NULL),
	(14, 'Sample Mug', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 49, 10, '{"main":"Qo2360wmMg7J.jpeg","subs":["qY3NM4dFKj59.jpeg","xuakDNiR1nm8.jpeg","5yql27GBrZwn.jpeg"]}', 23, '2021-05-03 17:49:01', NULL),
	(15, 'Awesome Mug', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 34, 54, '{"main":"qU7eJ2zdin8f.jpeg","subs":["QYWzNnpUZ0OP.jpeg","5BmeGFdCVuQ8.jpeg","aRlfkXDePsyB.jpeg"]}', 23, '2021-05-03 17:49:15', NULL),
	(16, 'Ugly Mug', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 43, 34, '{"main":"TZiGVWQ6tbxP.jpeg","subs":["uRAcQVqYxFok.jpeg","FOep3XxzNLov.jpeg","3z7pMs6vBJNf.jpeg"]}', 30, '2021-05-03 17:49:44', NULL),
	(17, 'A Baseball Cap', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ligula magna. Duis posuere convallis turpis, eu feugiat orci sollicitudin ac. Pellentesque porttitor velit semper velit condimentum sollicitudin. Nam sit amet rhoncus nisl. Sed feugiat ves', 45, 58, '{"main":"3KQ2oTuXBlOv.jpeg","subs":["VYqo1vIsNgyK.jpeg","aBNA3KydsmpR.jpeg"]}', 31, '2021-05-03 17:51:28', NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table capstoneproject.products_reviews
CREATE TABLE IF NOT EXISTS `products_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_reviews_users` (`user_id`),
  KEY `product_reviews_products` (`product_id`),
  CONSTRAINT `product_reviews_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_reviews_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table capstoneproject.products_reviews: ~0 rows (approximately)
/*!40000 ALTER TABLE `products_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_reviews` ENABLE KEYS */;

-- Dumping structure for table capstoneproject.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table capstoneproject.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `salt`, `is_admin`, `created_at`, `updated_at`) VALUES
	(4, 'Patrick', 'Noceja', 'nocejapatrick@gmail.com', 'cceabc03836d13ed350c266d4a216ba5', 'JxKmngGuYi', 1, '2021-05-02 11:11:14', NULL),
	(5, 'Zeth', 'Marfil', 'zeth@gmail.com', '0c7b8f3a261fef2949cab0671e454b31', 'pWfyObqTAV', 0, '2021-05-02 11:11:30', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table capstoneproject.users_orders
CREATE TABLE IF NOT EXISTS `users_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_users_orders` (`user_id`),
  KEY `orders_users_orders` (`order_id`),
  CONSTRAINT `orders_users_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_users_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table capstoneproject.users_orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_orders` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
