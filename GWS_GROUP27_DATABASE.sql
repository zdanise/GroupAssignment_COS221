-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.33 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gws_group27vs4
DROP DATABASE IF EXISTS `gws_group27vs4`;
CREATE DATABASE IF NOT EXISTS `gws_group27vs4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gws_group27vs4`;

-- Dumping structure for table gws_group27vs4.corporate_customer
DROP TABLE IF EXISTS `corporate_customer`;
CREATE TABLE IF NOT EXISTS `corporate_customer` (
  `customer_id` int NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `corporate_customer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `CHK_Customer_PhoneFormat` CHECK (regexp_like(`phone`,_utf8mb4'^[0-9]{10}$'))
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.destination_winery
DROP TABLE IF EXISTS `destination_winery`;
CREATE TABLE IF NOT EXISTS `destination_winery` (
  `winery_id` int NOT NULL,
  `BnB_Name` text COLLATE utf8mb4_general_ci,
  KEY `winery_id` (`winery_id`),
  CONSTRAINT `destination_winery_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.farm_winery
DROP TABLE IF EXISTS `farm_winery`;
CREATE TABLE IF NOT EXISTS `farm_winery` (
  `winery_id` int NOT NULL,
  `family_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`winery_id`),
  CONSTRAINT `farm_winery_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.farm_winery_restaurants
DROP TABLE IF EXISTS `farm_winery_restaurants`;
CREATE TABLE IF NOT EXISTS `farm_winery_restaurants` (
  `winery_id` int NOT NULL,
  `restaurant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`restaurant_name`,`winery_id`),
  KEY `FK_farm_winery_restaurants_winery` (`winery_id`),
  CONSTRAINT `FK_farm_winery_restaurants_winery` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.individual_customer
DROP TABLE IF EXISTS `individual_customer`;
CREATE TABLE IF NOT EXISTS `individual_customer` (
  `customer_id` int NOT NULL,
  `age` int NOT NULL DEFAULT '21',
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `individual_customer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.order_placement
DROP TABLE IF EXISTS `order_placement`;
CREATE TABLE IF NOT EXISTS `order_placement` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `wine_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `received` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `wine_id` (`wine_id`),
  CONSTRAINT `order_placement_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  CONSTRAINT `order_placement_ibfk_2` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`wine_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.retailer
DROP TABLE IF EXISTS `retailer`;
CREATE TABLE IF NOT EXISTS `retailer` (
  `retailer_id` int NOT NULL AUTO_INCREMENT,
  `retailer_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `retailer_location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`retailer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.retailer_stock
DROP TABLE IF EXISTS `retailer_stock`;
CREATE TABLE IF NOT EXISTS `retailer_stock` (
  `retailer_id` int NOT NULL,
  `wine_id` int NOT NULL,
  PRIMARY KEY (`retailer_id`,`wine_id`),
  KEY `wine_id` (`wine_id`),
  CONSTRAINT `retailer_stock_ibfk_1` FOREIGN KEY (`retailer_id`) REFERENCES `retailer` (`retailer_id`) ON DELETE CASCADE,
  CONSTRAINT `retailer_stock_ibfk_2` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`wine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.review
DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `wine_id` int NOT NULL,
  `rate` int DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `wine_id` (`wine_id`),
  KEY `customer_id` (`user_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`wine_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2086 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `IDX_User_Username` (`username`),
  CONSTRAINT `CHK_User_EmailFormat` CHECK (regexp_like(`email`,_utf8mb4'^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$')),
  CONSTRAINT `CHK_User_FirstNameFormat` CHECK ((not(regexp_like(`first_name`,_utf8mb4'[0-9~!@#$%^&*()_+={}<>?/\\|]')))),
  CONSTRAINT `CHK_User_LastNameFormat` CHECK ((not(regexp_like(`last_name`,_utf8mb4'[0-9~!@#$%^&*()_+={}<>?/\\|]')))),
  CONSTRAINT `CHK_User_UsernameFormat` CHECK ((not(regexp_like(`username`,_utf8mb4'[~!@#$%^&*()+={}<>?/\\|]'))))
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.user_cart
DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE IF NOT EXISTS `user_cart` (
  `user_id` int NOT NULL,
  `wine_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`,`wine_id`),
  KEY `wine_id` (`wine_id`),
  CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`wine_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.vineyard_winery
DROP TABLE IF EXISTS `vineyard_winery`;
CREATE TABLE IF NOT EXISTS `vineyard_winery` (
  `winery_id` int NOT NULL,
  `reservations` tinyint(1) DEFAULT NULL,
  `tutorials` time DEFAULT NULL,
  PRIMARY KEY (`winery_id`),
  CONSTRAINT `vineyard_winery_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.wine
DROP TABLE IF EXISTS `wine`;
CREATE TABLE IF NOT EXISTS `wine` (
  `wine_id` int NOT NULL AUTO_INCREMENT,
  `wine_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `wine_age` int DEFAULT NULL,
  `bottle_size` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '750ml',
  `wine_type` enum('Red','White','Rose') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Red',
  `winery_id` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'no-image.jpg',
  `price` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`wine_id`),
  KEY `winery_id` (`winery_id`),
  CONSTRAINT `wine_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=557076 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table gws_group27vs4.winery
DROP TABLE IF EXISTS `winery`;
CREATE TABLE IF NOT EXISTS `winery` (
  `winery_id` int NOT NULL AUTO_INCREMENT,
  `winery_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `winery_image` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`winery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3463 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
