/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `gws_group27vs4` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `gws_group27vs4`;

CREATE TABLE IF NOT EXISTS `corporate_customer` (
  `customer_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `corporate_customer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `corporate_customer` DISABLE KEYS */;
INSERT IGNORE INTO `corporate_customer` (`customer_id`, `company_name`) VALUES
	(1, 'Herb Random '),
	(2, 'Cellar Random'),
	(3, 'Et Cetera Co.'),
	(4, 'Essentials'),
	(5, 'Forge Ahead Inc'),
	(6, '23Rd Century'),
	(7, 'Splashfest '),
	(8, 'Amber and Sisters '),
	(9, 'Maxima Company'),
	(10, 'Early Bird Pty Ltd '),
	(11, 'Wine Movers'),
	(12, 'Candor Corp'),
	(13, 'Chloe\'s Corner '),
	(14, 'Eclipse Pty Ltd'),
	(15, 'The source'),
	(16, 'House of wines'),
	(17, 'Wine Farmology'),
	(18, 'Capetown Diners');
/*!40000 ALTER TABLE `corporate_customer` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `CHK_Customer_PhoneFormat` CHECK (`phone` regexp '^[0-9]{10}$')
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT IGNORE INTO `customer` (`customer_id`, `phone`, `address`, `user_id`) VALUES
	(1, '0728456390', '3105 Calle de Alcalá', 38),
	(2, '0837564893', '6031 Esplanade du 9 Novembre 1989', 12),
	(3, '0926473637', '2165 Lerdalsfaret', 32),
	(4, '0726386383', '8435 Stanley Way', 6),
	(5, '0826473637', '8952 Rua Dezenove de Outubro', 34),
	(6, '0837382748', '9263 Rosenweg', 31),
	(7, '0236483628', '9439 Næstvedvej', 9),
	(8, '0875467321', '8501 Verkatehtaankatu', 24),
	(9, '0985371536', '2775 Fatih Sultan Mehmet Cd', 2),
	(10, '0946482648', '5739 Frejasvej', 16),
	(11, '0546482648', '333 Main Street', 30),
	(12, '0735482637', '8788 The Grove', 26),
	(13, '0957354819', '3232 Kiefernweg', 7),
	(14, '0958232323', '175 Albert Road', 14),
	(15, '0743674500', '5584 Blasiuslaan', 22),
	(16, '0785437888', '7710 H Roland Holststraat', 35),
	(17, '0874366662', '3115 Mihaylivskiy provulok', 5),
	(18, '0736734529', '7282 Tahmelantie', 29);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `destination_winery` (
  `winery_id` int(11) NOT NULL,
  `BnB_Name` text DEFAULT NULL,
  KEY `winery_id` (`winery_id`),
  CONSTRAINT `destination_winery_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `destination_winery` DISABLE KEYS */;
INSERT IGNORE INTO `destination_winery` (`winery_id`, `BnB_Name`) VALUES
	(4, 'Cellar View Bed & Breakfast'),
	(20, 'Cellar Creek Guest House'),
	(24, 'Oakwood Lodge'),
	(25, 'Grapevine Guest House'),
	(26, 'Vineyard View Cottage'),
	(27, 'Wine Route Inn'),
	(30, 'Wine Lover\'s Sanctuary'),
	(32, 'Wine Country Chalet'),
	(11, 'Wine Lovers Nest');
/*!40000 ALTER TABLE `destination_winery` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `farm_winery` (
  `winery_id` int(11) NOT NULL,
  `family_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`winery_id`),
  CONSTRAINT `farm_winery_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `farm_winery` DISABLE KEYS */;
INSERT IGNORE INTO `farm_winery` (`winery_id`, `family_name`) VALUES
	(1, 'Smith'),
	(5, 'Brown'),
	(6, 'Davis'),
	(10, 'Taylor'),
	(14, 'Harris'),
	(17, 'Young');
/*!40000 ALTER TABLE `farm_winery` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `farm_winery_restaurants` (
  `winery_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`restaurant_name`,`winery_id`),
  KEY `FK_farm_winery_restaurants_winery` (`winery_id`),
  CONSTRAINT `FK_farm_winery_restaurants_winery` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `farm_winery_restaurants` DISABLE KEYS */;
INSERT IGNORE INTO `farm_winery_restaurants` (`winery_id`, `restaurant_name`) VALUES
	(10, 'Barrel  & Vine Restaurant '),
	(5, 'Cellar Bistro'),
	(17, 'Corked Bistro'),
	(1, 'Grapevine Bistro'),
	(6, 'The Winery Table'),
	(14, 'Vines & Grains Eatery');
/*!40000 ALTER TABLE `farm_winery_restaurants` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `individual_customer` (
  `customer_id` int(11) NOT NULL,
  `age` int(11) NOT NULL DEFAULT 21,
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `individual_customer_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `individual_customer` DISABLE KEYS */;
INSERT IGNORE INTO `individual_customer` (`customer_id`, `age`) VALUES
	(1, 45),
	(2, 35),
	(3, 21),
	(4, 50),
	(5, 40),
	(6, 30),
	(7, 21),
	(8, 33),
	(9, 38),
	(10, 42),
	(11, 34),
	(12, 23),
	(13, 42),
	(14, 36),
	(15, 27),
	(16, 55),
	(17, 36),
	(18, 29);
/*!40000 ALTER TABLE `individual_customer` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `order_placement` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `wine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `received` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `wine_id` (`wine_id`),
  CONSTRAINT `order_placement_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  CONSTRAINT `order_placement_ibfk_2` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`wine_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `order_placement` DISABLE KEYS */;
INSERT IGNORE INTO `order_placement` (`order_id`, `customer_id`, `wine_id`, `quantity`, `received`) VALUES
	(1, 7, 33, 1, 0),
	(2, 11, 25, 4, 1),
	(3, 4, 11, 20, 20),
	(4, 1, 10, 1, 1),
	(5, 12, 19, 15, 0),
	(6, 18, 47, 2, 5),
	(7, 15, 32, 1, 1),
	(8, 16, 3, 9, 8),
	(9, 9, 41, 10, 10),
	(10, 5, 1, 1, 1),
	(11, 6, 23, 12, 12),
	(12, 2, 29, 1, 1),
	(13, 17, 48, 4, 4),
	(14, 3, 25, 1, 1),
	(15, 10, 25, 5, 5),
	(16, 8, 6, 1, 1),
	(17, 13, 44, 7, 6),
	(18, 14, 21, 1, 1),
	(19, 9, 8, 3, 2);
/*!40000 ALTER TABLE `order_placement` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `retailer` (
  `retailer_id` int(11) NOT NULL AUTO_INCREMENT,
  `retailer_name` varchar(255) NOT NULL,
  `retailer_location` varchar(255) NOT NULL,
  PRIMARY KEY (`retailer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `retailer` DISABLE KEYS */;
INSERT IGNORE INTO `retailer` (`retailer_id`, `retailer_name`, `retailer_location`) VALUES
	(1, 'Lestar Liquor', '1, Lynnpark Shopping Centre, 344 Lynnwood Rd &, King\'s Hwy, Lynnwood, Pretoria, 0081'),
	(2, 'DON PINO', '431 Marais St, Brooklyn, Pretoria, 0011'),
	(3, 'Liquor City Groenkloof', 'Groenkloof Plaza, 51 George Storrar St, Groenkloof, Pretoria, 0027'),
	(4, 'Checkers LiquorShop Queenswood', 'Shop L28, Queenswood Galleries Shopping Centre Corner Steve'),
	(5, 'Vee and Forti Wine Bar and Liquor Emporium', 'Vee and Forti Wine Bar and Liquor Emporium'),
	(6, 'Sipswine', '7th St, Melville, Johannesburg, 2109'),
	(7, 'Mr Pants Wine Bar', ' Shop 7, Delta Central, 74 Hillcrest Ave, Blairgowrie, Randburg, 2194'),
	(8, 'Whisk Wine Bar', '1 Cornwood ave &, Nellmapius Dr, Irene, Centurion, 0147'),
	(9, 'Wine Not Popup Bar', '14A Kramer Rd, Kramerville, Sandton, 2090'),
	(10, 'Acid Food & Wine Bar', '19 4th Ave, Parktown North, Johannesburg, 2193'),
	(11, 'Vee and Forti Wine Bar and Liquor Emporium', ' Lynnwood and, Daventry St, Lynnwood Glen, Pretoria, 0081'),
	(12, 'The Tasting Room', '198 Long St, Waterkloof, Pretoria, 0145'),
	(13, 'Leo\'s Wine Bar', 'Shop 28, De Oude Schuur, 120 Bree St, Cape Town, 8001'),
	(14, 'Culture Wine Bar', '103 Bree St, Cape Town City Centre, Cape Town, 8001'),
	(15, 'Openwine', '72 Wale St, Cape Town City Centre, Cape Town, 8001'),
	(16, 'Furny\'s Fine Wines & Taste Room', ' 67 Beach Rd, Chapmans Peak, Cape Town, 7979'),
	(17, '360° Wine Lounge & Tasting Room', ' M13, Cape Farms, Cape Town, 7550'),
	(18, 'CARPE DIEM RESTAURANT & BAR', 'CARPE DIEM RESTAURANT & BAR'),
	(19, 'Bartinney Wine & Champagne Bar', '5 Bird St, Stellenbosch, Cape Town, 7600'),
	(20, 'Plaisir Wine and Gin Lounge', ' 6 Bird St, Stellenbosch Central, Stellenbosch, 7600');
/*!40000 ALTER TABLE `retailer` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `wine_id` int(11) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `wine_id` (`wine_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`wine_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2079 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT IGNORE INTO `review` (`review_id`, `wine_id`, `rate`, `comment`, `customer_id`) VALUES
	(2048, 19, 1, 'Review group: Bad. Reason:The wine was served warm and was not enjoyable.', 18),
	(2049, 18, 4, 'Review group: Average. Reason:The wine was not the best wine but also not the worst.', 10),
	(2050, 19, 4, 'Review group: Average Reason:None given', 18),
	(2051, 2, 1, 'Review group: Bad. Reason:The wine was served warm ', 10),
	(2052, 3, 1, 'Review group: Bad. Reason:The wine has not aged well hence the off-flavours and lack of complexity', 3),
	(2053, 19, 5, 'Review group: Average. Reason: Average wine, great experience.', 13),
	(2054, 13, 0, 'Review group: Bad. Reason:Faulty cork and volatile acidity.', 16),
	(2055, 19, 9, 'Review group: Exceptional. Reason:Great wine. Would reccommend!!', 17),
	(2056, 48, 10, 'Review group: Exceptional. Reason:None given', 6),
	(2057, 20, 1, 'Review group: Bad. Reason:The wine was served warm ', 1),
	(2058, 4, 1, 'Review group: Bad. Reason:Warm wine', 1),
	(2059, 10, 2, 'Review group: Bad. Reason: Faulty cork', 6),
	(2060, 48, 7, 'Review group: Good Reason:Good wine and good vibes.', 14),
	(2061, 19, 9, 'Review group: Exceptional. Reason:Great wine. Would reccommend!!', 5),
	(2062, 6, 10, 'Review group: Exceptional. Reason:None given', 17),
	(2063, 41, 9, 'Review group: Exceptional. Reason:None given', 5),
	(2064, 47, 0, 'Review group: Bad. Reason: volatile acidity.', 13),
	(2065, 45, 5, 'Review group: Average. Reason: Average wine, great experience.', 11),
	(2066, 19, 6, 'Review group: Average. Reason: The wine is overpriced ', 9),
	(2067, 19, 4, 'Review group: Average. Reason: None given', 5);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `IDX_User_Username` (`username`),
  CONSTRAINT `CHK_User_EmailFormat` CHECK (`email` regexp '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$'),
  CONSTRAINT `CHK_User_UsernameFormat` CHECK (!(`username` regexp '[~!@#$%^&*()+={}<>?/\\|]')),
  CONSTRAINT `CHK_User_LastNameFormat` CHECK (!(`last_name` regexp '[0-9~!@#$%^&*()_+={}<>?/\\|]')),
  CONSTRAINT `CHK_User_FirstNameFormat` CHECK (!(`first_name` regexp '[0-9~!@#$%^&*()_+={}<>?/\\|]'))
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT IGNORE INTO `user` (`user_id`, `username`, `first_name`, `last_name`, `email`, `password`) VALUES
	(1, 'purplemeercat427', 'Emma', ' Heikkila', 'emma.heikkila@example.com', 'viewsoni'),
	(2, 'crazyfish867', 'Regina', ' Kolb', 'regina.kolb@example.com', 'lakota'),
	(3, 'silverbutterfly842', 'Alyssa', ' Mathieu', 'alyssa.mathieu@example.com', 'password2'),
	(4, 'sadfrog371', 'Iva', ' Vuksanović', 'iva.vuksanovic@example.com', 'bubba'),
	(5, 'orangepeacock351', 'Jeanette', ' Peck', 'jeanette.peck@example.com', 'flamingo'),
	(6, 'blueostrich117', 'Tonya', ' Snyder', 'tonya.snyder@example.com', 'getmoney'),
	(7, 'happycat805', 'Calvin', ' Wheeler', 'calvin.wheeler@example.com', 'money1'),
	(8, 'redlion239', 'Emilio', ' Menard', 'emilio.menard@example.com', 'stanley'),
	(9, 'brownzebra948', 'Maelya', ' Charles', 'maelya.charles@example.com', 'ashton'),
	(10, 'redswan905', 'Akash', ' Shayana', 'akash.shayana@example.com', 'columbia'),
	(11, 'organiccat106', 'Roxana', ' De Bot', 'roxana.debot@example.com', 'amazing'),
	(12, 'blacksnake693', 'Grace', ' Williams', 'grace.williams@example.com', '1111111'),
	(13, 'smallrabbit950', 'Carolina', ' May', 'carolina.may@example.com', 'trustno1'),
	(14, 'happydog694', 'النا', ' جعفری', 'ln.jaafry@example.com', 'ferrari1'),
	(15, 'organicfish526', 'Carolina', ' Fuentes', 'carolina.fuentes@example.com', 'summers'),
	(16, 'goldenduck924', 'Alette', ' Vestad', 'alette.vestad@example.com', 'hattrick'),
	(17, 'sadmouse174', 'Begoña', ' Carmona', 'begona.carmona@example.com', 'boxing'),
	(18, 'silverduck648', 'Ezio', ' Dupont', 'ezio.dupont@example.com', 'cumcum'),
	(19, 'smallgoose215', 'رها', ' سلطانی نژاد', 'rh.sltnynjd@example.com', 'counter'),
	(20, 'sadduck187', 'Nanci', ' da Mata', 'nanci.damata@example.com', 'christopher'),
	(21, 'smallgoose363', 'Marlene', ' Sølvberg', 'marlene.solvberg@example.com', 'big1'),
	(22, 'happykoala294', 'Sevilay', ' Van Schoonhoven', 'sevilay.vanschoonhoven@example.com', 'blink'),
	(23, 'smalltiger284', 'Fabiana', ' Guillot', 'fabiana.guillot@example.com', 'richie'),
	(24, 'crazybird287', 'Francisca', ' Iglesias', 'francisca.iglesias@example.com', 'qwertz'),
	(25, 'whitebutterfly298', 'Mestan', ' Topaloğlu', 'mestan.topaloglu@example.com', 'dustin'),
	(26, 'happybear286', 'Dobrolik', ' Bolyuh', 'dobrolik.bolyuh@example.com', 'overkill'),
	(27, 'whitefish665', 'Maia', ' Cooper', 'maia.cooper@example.com', 'general'),
	(28, 'silvermeercat263', 'Anick', ' da Cruz', 'anick.dacruz@example.com', 'manchester'),
	(29, 'orangerabbit807', 'Damien', ' Muller', 'damien.muller@example.com', 'all4one'),
	(30, 'greenpanda501', 'Kalpit', ' Nand', 'kalpit.nand@example.com', '666666'),
	(31, 'brownzebra508', 'Žarko', ' Rodić', 'zarko.rodic@example.com', '987654'),
	(32, 'blackmeercat167', 'Venla', ' Hatala', 'venla.hatala@example.com', 'vienna'),
	(33, 'smallkoala724', 'میلاد', ' موسوی', 'myld.mwswy@example.com', 'picard'),
	(34, 'brownpanda205', 'علی رضا', ' سهيلي راد', 'aalyrd.shylyrd@example.com', ''),
	(35, 'lazygorilla352', 'Neiva', ' Cavalcanti', 'neiva.cavalcanti@example.com', 'blessed'),
	(36, 'sadladybug375', 'Siham', ' Langfeldt', 'siham.langfeldt@example.com', 'studly'),
	(37, 'ticklishwolf971', 'Ben', ' Ryan', 'ben.ryan@example.com', 'bmwbmw'),
	(38, 'angryleopard316', 'Liam', ' Brown', 'liam.brown@example.com', 'asdf123'),
	(39, 'ticklishkoala217', 'آدرینا', ' قاسمی', 'adryn.qsmy@example.com', 'hhhhhh'),
	(40, 'tinygorilla364', 'Annika', ' Balstad', 'annika.balstad@example.com', 'bigfoot');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user_cart` (
  `user_id` int(11) NOT NULL,
  `wine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`,`wine_id`),
  KEY `wine_id` (`wine_id`),
  CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`wine_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `user_cart` DISABLE KEYS */;
INSERT IGNORE INTO `user_cart` (`user_id`, `wine_id`, `quantity`) VALUES
	(8, 4, 1),
	(8, 6, 1),
	(8, 12, 4),
	(8, 21, 1),
	(8, 23, 1),
	(8, 24, 3),
	(8, 28, 1),
	(8, 30, 2),
	(8, 39, 1),
	(8, 47, 1),
	(9, 4, 3),
	(9, 6, 3),
	(9, 12, 1),
	(9, 21, 2),
	(9, 23, 4),
	(9, 24, 2),
	(9, 28, 3),
	(9, 30, 1),
	(9, 39, 4),
	(9, 47, 1),
	(17, 4, 4),
	(17, 6, 2),
	(17, 12, 2),
	(17, 21, 1),
	(17, 23, 2),
	(17, 24, 2),
	(17, 28, 1),
	(17, 30, 4),
	(17, 39, 1),
	(17, 47, 4),
	(28, 4, 2),
	(28, 6, 4),
	(28, 12, 1),
	(28, 21, 4),
	(28, 23, 3),
	(28, 24, 2),
	(28, 28, 2),
	(28, 30, 2),
	(28, 39, 2),
	(28, 47, 2),
	(35, 4, 4),
	(35, 6, 4),
	(35, 12, 3),
	(35, 21, 4),
	(35, 23, 3),
	(35, 24, 3),
	(35, 28, 1),
	(35, 30, 4),
	(35, 39, 1),
	(35, 47, 4);
/*!40000 ALTER TABLE `user_cart` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `vineyard_winery` (
  `winery_id` int(11) NOT NULL,
  `reservations` tinyint(1) DEFAULT NULL,
  `tutorials` time DEFAULT NULL,
  PRIMARY KEY (`winery_id`),
  CONSTRAINT `vineyard_winery_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `vineyard_winery` DISABLE KEYS */;
INSERT IGNORE INTO `vineyard_winery` (`winery_id`, `reservations`, `tutorials`) VALUES
	(2, 2, '01:26:00'),
	(3, 2, '10:06:00'),
	(7, 4, '01:55:00'),
	(8, 3, '02:26:00'),
	(9, 4, '09:54:00'),
	(12, 1, '05:43:00'),
	(13, 4, '03:31:00'),
	(15, 1, '04:17:00'),
	(16, 2, '07:51:00'),
	(18, 1, '10:27:00'),
	(19, 4, '04:16:00'),
	(21, 3, '10:06:00'),
	(22, 1, '05:19:00'),
	(23, 1, '01:27:00'),
	(28, 1, '12:10:00'),
	(29, 3, '12:54:00'),
	(31, 4, '08:26:00');
/*!40000 ALTER TABLE `vineyard_winery` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `wine` (
  `wine_id` int(11) NOT NULL AUTO_INCREMENT,
  `wine_name` varchar(255) NOT NULL,
  `wine_age` int(11) DEFAULT NULL,
  `bottle_size` varchar(255) NOT NULL DEFAULT '750ml',
  `wine_type` enum('Red','White','Rose') NOT NULL DEFAULT 'Red',
  `winery_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'no-image.jpg',
  `price` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`wine_id`),
  KEY `winery_id` (`winery_id`),
  CONSTRAINT `wine_ibfk_1` FOREIGN KEY (`winery_id`) REFERENCES `winery` (`winery_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=557076 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `wine` DISABLE KEYS */;
INSERT IGNORE INTO `wine` (`wine_id`, `wine_name`, `wine_age`, `bottle_size`, `wine_type`, `winery_id`, `image`, `price`) VALUES
	(1, 'Touché 2012', 11, '750ml', 'Red', 6, 'https://images.vivino.com/thumbs/N6jcUeR6Tq2oA3X6-Nz3gQ_pb_x300.png', 'R300'),
	(2, 'Family Collection Amarone della Valpolicella 2007', 16, '750ml', 'Red', 25, 'https://images.vivino.com/thumbs/hWDKjQIkT6S029fJaMlj6w_pb_x300.png', 'R300'),
	(3, 'Emporda 2012', 11, '750ml', 'Red', 11, 'https://images.vivino.com/thumbs/ApnIiXjcT5Kc33OHgNb9dA_375x500.jpg', 'R300'),
	(4, 'G 2010', 13, '750ml', 'Red', 19, 'https://images.vivino.com/thumbs/icdzM1D7RAmPnwKkFm61Nw_375x500.jpg', 'R300'),
	(5, 'Mount Veeder Cabernet Sauvignon 2003', 20, '750ml', 'Red', 11, 'https://images.vivino.com/thumbs/41jCEa5TSouKrLK1mxZVLg_pb_x300.png', 'R300'),
	(6, 'Amarone della Valpolicella Riserva N.V.', 10, '750ml', 'Red', 29, 'https://images.vivino.com/thumbs/nC9V6L2mQQSq0s-wZLcaxw_pb_x300.png', 'R300'),
	(7, 'Reserve Cabernet Sauvignon 2015', 8, '750ml', 'Red', 25, 'https://images.vivino.com/thumbs/zs5_IWwJQ1mBTj8SyNvmTg_pb_x300.png', 'R300'),
	(8, 'Dulcore 2017', 6, '750ml', 'Red', 7, 'https://images.vivino.com/highlights/icon/most_user_rated.svg', 'R300'),
	(9, 'Pêra-Manca Tinto 1990', 33, '750ml', 'Red', 19, 'https://images.vivino.com/thumbs/L33jsYUuTMWTMy3KoqQyXg_pb_x300.png', 'R300'),
	(10, 'Échezeaux Grand Cru 1995', 28, '750ml', 'Red', 13, 'https://images.vivino.com/thumbs/4acI_FD8QriZh2Fx_iv_oA_pb_x300.png', 'R300'),
	(11, 'Finca Bella Vista Malbec 2003', 20, '750ml', 'Red', 22, 'https://images.vivino.com/thumbs/yVwf7mPvTfOk9gcKzV2YoQ_pb_x300.png', 'R300'),
	(12, 'Cabernet Sauvignon RBS Beckstoffer To Kalon Vineyard 2015', 8, '750ml', 'Red', 32, 'https://images.vivino.com/thumbs/GpcSXs2ERS6niDxoAsvESA_pb_x300.png', 'R300'),
	(13, 'La Tâche Grand Cru 1978', 45, '750ml', 'Red', 24, 'https://images.vivino.com/thumbs/rUPGZo11SwW6haQta4COqQ_pb_x300.png', 'R300'),
	(14, 'Showket Vineyard Cabernet Sauvignon 2007', 16, '750ml', 'Red', 13, 'https://images.vivino.com/thumbs/JywGOvs7Sfmmi4IrgnK-MA_pb_x300.png', 'R300'),
	(15, 'Wraith Cabernet Sauvignon 2013', 10, '750ml', 'Red', 29, 'https://images.vivino.com/thumbs/PBhGMcRNQ7aVnVNr7VgnWA_pb_x300.png', 'R234'),
	(16, 'Unico Reserva Especial Edición 1985', 38, '750ml', 'Red', 30, 'https://images.vivino.com/thumbs/k_UetHZ3Q2SMqUsliefGYQ_pb_x300.png', 'R689'),
	(17, 'Montrachet Grand Cru 2010', 13, '750ml', 'White', 31, 'https://images.vivino.com/thumbs/rORmihtxSrKG7SfuI0bD6w_pb_x300.png', 'R567'),
	(18, 'Meursault Les Rougeots 2001', 22, '750ml', 'White', 24, 'https://images.vivino.com/thumbs/l5W5NRvZR_SzClIDSnG5Ag_pb_x300.png', 'R567'),
	(19, 'Corton-Charlemagne Grand Cru N.V.', 10, '750ml', 'White', 1, 'https://images.vivino.com/thumbs/ZGxHdQyGQt-hfJt7eNMXlA_pb_x300.png', 'R235'),
	(20, 'Estate Finch Hollow Chardonnay (Cave Fermented) 2014', 9, '750ml', 'White', 5, 'https://images.vivino.com/thumbs/pQ_92smWRKG7Y7h5_ZwD-w_pb_x300.png', 'R138'),
	(21, 'Y 1996', 27, '750ml', 'White', 8, 'https://images.vivino.com/thumbs/6dP83oDrQy2Zv6es9tHp7w_pb_x300.png', 'R400'),
	(22, 'Bâtard-Montrachet Grand Cru 1996', 27, '750ml', 'White', 22, 'https://images.vivino.com/thumbs/EDQ4q_3FQ568NVspQBECug_pb_x300.png', 'R450'),
	(23, 'Montrachet Grand Cru Marquis de Laguiche 2004', 19, '750ml', 'White', 28, 'https://images.vivino.com/thumbs/1QoFUeYqQaCU07v4MBx8yw_pb_x300.png', 'R400'),
	(24, 'Meursault Les Rougeots 2005', 18, '750ml', 'White', 21, 'https://images.vivino.com/thumbs/l5W5NRvZR_SzClIDSnG5Ag_pb_x300.png', 'R320'),
	(25, 'Bâtard-Montrachet Grand Cru 2012', 11, '750ml', 'White', 30, 'https://images.vivino.com/thumbs/pWOdFPoyQ427uoHW_l941g_pb_x300.png', 'R600'),
	(26, 'Montrachet Grand Cru Marquis de Laguiche 2002', 21, '750ml', 'White', 16, 'https://images.vivino.com/thumbs/1QoFUeYqQaCU07v4MBx8yw_pb_x300.png', 'R650'),
	(27, 'Montrachet Grand Cru 2000', 23, '750ml', 'White', 28, 'https://images.vivino.com/thumbs/rORmihtxSrKG7SfuI0bD6w_pb_x300.png', 'R345'),
	(28, 'Ermitage de l\'Orée 2004', 19, '750ml', 'White', 4, 'https://images.vivino.com/thumbs/K3N0EZYBQeWunDuzNC0Dug_pb_x300.png', 'R234'),
	(29, 'Pessac-Léognan Blanc (Grand Cru Classé de Graves) 2005', 18, '750ml', 'White', 20, 'https://images.vivino.com/thumbs/EvtJOugzTx-HZXZfdZvTsA_pb_x300.png', 'R298'),
	(30, 'Montrachet Grand Cru Marquis de Laguiche 2015', 8, '750ml', 'White', 24, 'https://images.vivino.com/thumbs/1QoFUeYqQaCU07v4MBx8yw_pb_x300.png', 'R300'),
	(31, 'Vin de Pays de l\'Hérault Blanc 2007', 16, '750ml', 'White', 30, 'https://images.vivino.com/thumbs/tBJyYsUeTxuYIPy6oS5T4A_pb_x300.png', 'R500'),
	(32, 'Clos Sainte Hune Riesling Alsace 1990', 33, '750ml', 'White', 6, 'https://images.vivino.com/thumbs/sOfai0jLTaKoP_6oXtvH9w_pb_x300.png', 'R800'),
	(33, 'Angelicall Rosé 2014', 9, '750ml', 'Rose', 2, 'https://images.vivino.com/thumbs/LRmcfSasTD22xR6lRSKcIw_pb_x300.png', 'R429'),
	(34, 'Fonte de\' Medici 2011', 12, '750ml', 'Rose', 8, 'https://images.vivino.com/highlights/icon/top_ranked.svg', 'R250'),
	(35, '281 Rosé 2014', 9, '750ml', 'Rose', 12, 'https://images.vivino.com/thumbs/CRBSmK3xRuqHdCg4TpBpVw_pb_x300.png', 'R289'),
	(36, 'Clos de Capelune Côtes de Provence Rosé 2017', 6, '750ml', 'Rose', 26, 'https://images.vivino.com/thumbs/l7BLBu7ERi2tJIQqtli_NA_pb_x300.png', 'R432'),
	(37, 'Rosé 2016', 7, '750ml', 'Rose', 32, 'https://images.vivino.com/thumbs/__JeiUHGQ5KF6LBGEREllw_pb_x300.png', 'R300'),
	(38, '281 Rosé 2017', 6, '750ml', 'Rose', 21, 'https://images.vivino.com/thumbs/CRBSmK3xRuqHdCg4TpBpVw_pb_x300.png', 'R634'),
	(39, 'La Fantasia 2015', 8, '750ml', 'Rose', 14, 'https://images.vivino.com/highlights/icon/top_ranked.svg', 'R765'),
	(40, 'Garrus Rosé 2017', 6, '750ml', 'Rose', 3, 'https://images.vivino.com/thumbs/NGq7QIE3QwSE0cAKrvPuTA_pb_x300.png', 'R700'),
	(41, '281 Rosé 2016', 7, '750ml', 'Rose', 15, 'https://images.vivino.com/thumbs/CRBSmK3xRuqHdCg4TpBpVw_pb_x300.png', 'R543'),
	(42, 'Garrus Rosé 2010', 13, '750ml', 'Rose', 16, 'https://images.vivino.com/thumbs/NGq7QIE3QwSE0cAKrvPuTA_pb_x300.png', 'R345'),
	(43, 'Prince of Hearts Rosé N.V.', 10, '750ml', 'Rose', 23, 'https://images.vivino.com/thumbs/BXIqIzVzT2OwkLs59qSPig_pb_x300.png', 'R453'),
	(44, 'Think Pink Rosado 2017', 6, '750ml', 'Rose', 17, 'https://images.vivino.com/highlights/icon/most_user_rated.svg', 'R432'),
	(45, 'L\'Hydropathe Elite Rosé 2018', 5, '750ml', 'Rose', 27, 'https://images.vivino.com/thumbs/Kkn7RIMUSkmQIhkF6MApiA_pb_x300.png', 'R300'),
	(46, 'Palette Rose 2016', 7, '750ml', 'Rose', 13, 'https://images.vivino.com/thumbs/lnQL_iedQN2WcC2L68IceQ_pb_x300.png', 'R543'),
	(47, 'Château Romassan Rosé (Coeur de Grain) 2010', 13, '750ml', 'Rose', 19, 'https://images.vivino.com/thumbs/uE0N0zxUS1K36LSWVi_S_Q_pb_x300.png', 'R645'),
	(48, 'La Villa Rosé 2015', 8, '750ml', 'Rose', 25, 'https://images.vivino.com/thumbs/QNTe2Md7So6KJ9Wz59btzw_pb_x300.png', 'R300');
/*!40000 ALTER TABLE `wine` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `winery` (
  `winery_id` int(11) NOT NULL AUTO_INCREMENT,
  `winery_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `winery_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`winery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3463 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40000 ALTER TABLE `winery` DISABLE KEYS */;
INSERT IGNORE INTO `winery` (`winery_id`, `winery_name`, `location`, `api_key`, `password`, `winery_image`) VALUES
	(1, 'Gran Moraine', 'United States\n·\nYamhill-Carlton District', 'Gran2321', 'VLskgBPl', 'assets/wineryimages/1.jpg'),
	(2, 'Van Duzer', 'United States\n·\nWillamette Valley', 'Duzer0754', 'tJzdE2Fg', 'assets/wineryimages/2.jpg'),
	(3, 'North Valley', 'United States\n·\nWillamette Valley', 'Northgfdu', '9iLTvo3Q', 'assets/wineryimages/3.jpg'),
	(4, 'Illahe', 'United States\n·\nWillamette Valley', 'Illahe790', 'jmJKsov2', 'assets/wineryimages/4.jpg'),
	(5, 'Gothic', 'United States\n·\nWillamette Valley', 'Gothic0864', '9Uq5WKnc', 'assets/wineryimages/5.jpg'),
	(6, 'Antica Terra', 'United States\n·\nWillamette Valley', 'Terra3468', 'bhfc738', 'assets/wineryimages/6.jpg'),
	(7, 'Ehlers Estate', 'United States\n·\nSt. Helena', 'Estate5964', '3edudc', 'assets/wineryimages/7.jpg'),
	(8, 'Spell', 'United States\n·\nSonoma County', 'Spell6glgyfgj', '64rhdck', 'assets/wineryimages/8.jpg'),
	(9, 'Scribe', 'United States\n·\nSonoma Coast', 'Scribe987654', '#cjdkjv', 'assets/wineryimages/9.jpg'),
	(10, 'Eric Kent', 'United States\n·\nSonoma Coast', 'Kent234569', 'fdjkd!!jfv', 'assets/wineryimages/10.jpg'),
	(11, 'Buena Vista', 'United States\n·\nSonoma Coast', 'Vista7ttgh', '3e38fdnd', 'assets/wineryimages/11.jpg'),
	(12, 'Sea Smoke', 'United States\n·\nSta. Rita Hills', 'Smoke45768', 'cjuds833', 'assets/wineryimages/12.jpg'),
	(13, 'Hanzell', 'United States\n·\nSonoma Valley', 'Hanzellr56ujbgt5', 'cjkes7345', 'assets/wineryimages/13.jpg'),
	(14, 'Paul Hobbs', 'United States\n·\nSonoma Mountain', 'Paulo08hdjj ', 'ecjdc8943', 'assets/wineryimages/14.jpg'),
	(15, 'Morlet Family Vineyards', 'United States\n·\nSonoma County', 'Morlet76564', 'ef9eiw', 'assets/wineryimages/15.jpg'),
	(16, 'Moone-Tsai', 'United States\n·\nSonoma Coast', 'Moone6657', 'rfcncp0', 'assets/wineryimages/16.jpg'),
	(17, 'Marcassin', 'United States\n·\nSonoma Coast', 'cassin75gg', '5385jdpdm', 'assets/wineryimages/17.jpg'),
	(18, 'Kistler', 'United States\n·\nSonoma Coast', 'Kistler8667', '26hhdkod', 'assets/wineryimages/18.jpg'),
	(19, 'Ceritas', 'United States\n·\nSonoma Coast', 'Ceritas64jfhygkg', '384nfk', 'assets/wineryimages/19.jpg'),
	(20, 'Aubert', 'United States\n·\nSonoma Coast', 'Aubertiuyhghfc', 'dfckd34', 'assets/wineryimages/20.jpg'),
	(21, 'Ridge', 'United States\n·\nSanta Cruz Mountains', 'Ridge8ygdjh', '43r985', 'assets/wineryimages/21.jpg'),
	(22, 'Williams Selyem', 'United States\n·\nRussian River Valley', 'Selyem2456342', 'rthgjnnd', 'assets/wineryimages/22.jpg'),
	(23, 'Maselva', 'Spain\n·\nEmpordà', 'Maselvahyrfgvjk', '64954if', 'assets/wineryimages/23.jpg'),
	(24, 'Ernesto Ruffo', 'Italy\n·\nAmarone della Valpolicella', ' Ruffoiggd4678', 'jgkfujw9', 'assets/wineryimages/24.jpg'),
	(25, 'Cartuxa', 'Portugal\n·\nAlentejo', 'Cartuxa$$jfsm', '7594739ffn', 'assets/wineryimages/25.jpg'),
	(26, 'Schrader', 'United States\n·\nOakville', 'Schrader67349', 'rgfikjr559', 'assets/wineryimages/26.jpg'),
	(27, 'Hundred Acre', 'United States\n·\nNapa Valley', 'Acre@keorfb', '123456', 'assets/wineryimages/27.jpg'),
	(28, 'Sine Qua Non', 'United States\n·\nCalifornia', 'Sine1234@@', 'kgviknvr4', 'assets/wineryimages/28.jpg'),
	(29, 'Del Dotto', 'United States\n·\nRutherford', 'Dotto52khdhdd', 'Dediyyeo', 'assets/wineryimages/29.jpg'),
	(30, 'Darioush', 'United States\n·\nNapa Valley', '57ykgflkgDarioush', 'datrfvkmf', 'assets/wineryimages/30.jpg'),
	(31, 'Garbole', 'Italy\n·\nVeneto', '75799pGarbole', 'Bhcvj74jf', 'assets/wineryimages/31.jpg'),
	(32, 'Scarecrow', 'United States\n·\nRutherford', '%6^6hfgjScarecrow', '464hgvmld', 'assets/wineryimages/32.jpg');
/*!40000 ALTER TABLE `winery` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
