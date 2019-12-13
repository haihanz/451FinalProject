-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.24a-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema petstore
--

CREATE DATABASE IF NOT EXISTS petstore;
USE petstore;

--
-- Definition of table `petstore`.`petowner`
--

DROP TABLE IF EXISTS `petstore`.`petowner`;
CREATE TABLE  `petstore`.`petowner` (
  `owner_number` smallint(6) NOT NULL,
  `fname` char(15) default NULL,
  `lname` char(15) default NULL,
  `address` char(20) default NULL,
  `email` char(50) NOT NULL default '',
  `tel_number` char(50) default NULL,
  PRIMARY KEY  (`owner_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petstore`.`petowner`
--

/*!40000 ALTER TABLE `petowner` DISABLE KEYS */;
LOCK TABLES `petowner` WRITE;
INSERT INTO `petstore`.`petowner` VALUES (1, 'Anthony','Higgins','1143 Carver Place','anthonyHig@gmail.com','415-8886-6677'),
(2, 'Bob','Shorter','10100 Bay Meadows Ro','BillBobs@aol.com','415-6535-0011'),
(3, 'Arnold','Sadler','1817 N. Thomas Road','ASssadler@bell.com','283-0338-4290'),
(4, 'Jane','Miller','478 Joliet Way','janejane@hotmail.com','184-6186-0151'),
(5, 'James','Wallack','320 Brest Avenue','wallack219@gmail.com','408-7223-8789'),
(6, 'Chris','Putnum','663 Baha Blanca Parkway','chris_p@gmail.com','137-8097-4111'),
(7, 'Colten','Rylee','207 Cuernavaca Loop','colRe@gmail.com','590-7642-5675'),
(8, 'Mason','Michelle','614 Denizli Parkway','Michellemensah@gmail.com','154-1242-0457'),
(9, 'Benjamin','Giselle','431 Xiangtan Avenue','BenGis@gmail.com','946-1140-4231'),
(10, 'Gavin','Juan','1101 Bucuresti Boulevard','JGavin2008@yahoo.com','165-1647-6435'),
(11, 'Angel','Nora	','1895 Zhezqazghan Drive','Norawoa@gmail.com','644-0238-0889'),
(12, 'Sydney','Haley','1427 Tabuk Place','Syhaleyley@gmail.com','889-3189-3672'),
(13, 'Harper','Sara','1402 Zanzibar Boulevard','SaraRjy@gmail.com','302-3666-7511'),
(14, 'Eva	','Genesis','47 Syktyvkar Lane','EvaGene20@gmail.com','875-7567-7175'),
(15, 'Kim','Keyes','1089 Iwatsuki Avenue','cliffchiboston@domain.com','918-3585-2074');


UNLOCK TABLES;
/*!40000 ALTER TABLE `petowner` ENABLE KEYS */;




--
-- Definition of table `petstore`.`room`
--

DROP TABLE IF EXISTS `petstore`.`room`;
CREATE TABLE  `petstore`.`room` (
  `room_number` smallint(6) NOT NULL,
  `size` char(5) NOT NULL,
  `price_per_day` smallint(6) NOT NULL,
  PRIMARY KEY  (`room_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petstore`.`room`
--

/*!40000 ALTER TABLE `room` DISABLE KEYS */;
LOCK TABLES `room` WRITE;
INSERT INTO `petstore`.`room` VALUES (1,'S',35),
(2,'S',35),
(3,'S',35),
(4,'S',35),
(5,'S',35),
(6,'S',35),
(7,'S',35),
(8,'M',49),
(9,'M',49),
(10,'M',49),
(11,'M',49),
(12,'M',49),
(13,'M',49),
(14,'M',49),
(15,'L',68),
(16,'L',68),
(17,'L',68),
(18,'L',68),
(19,'L',68),
(20,'L',68),
(21,'L',68);

UNLOCK TABLES;
/*!40000 ALTER TABLE `room` ENABLE KEYS */;




--
-- Definition of table `petstore`.`pet`
--

DROP TABLE IF EXISTS `petstore`.`pet`;
CREATE TABLE  `petstore`.`pet` (
  `pet_number` smallint(6) NOT NULL,
  `pet_name` char(10) NOT NULL,
  `kind` char(10) NOT NULL default '',
  `owner_number` smallint(6) NOT NULL,
  `e_ssn` char(15) NOT NULL,
  `room_number` smallint(6) NOT NULL,
  `special_description` char(80) NOT NULL default '',
  PRIMARY KEY  (`pet_number`),
  UNIQUE KEY `pet_number` (`pet_number`),
  KEY `FK_pet_owner` (`owner_number`),
  CONSTRAINT `FK_pet_owner` FOREIGN KEY (`owner_number`) REFERENCES `owner` (`owner_number`),
  CONSTRAINT `FK_pet_room` FOREIGN KEY (`room_number`) REFERENCES `room` (`room_number`),
  CONSTRAINT `FK_pet_essn` FOREIGN KEY (`e_ssn`) REFERENCES `employee` (`SSN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `petstore`.`pet`
--

/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
LOCK TABLES `pet` WRITE;
INSERT INTO `petstore`.`pet` VALUES (1,'Vivi','Ragdoll', 5,'545769690',1, ''),
(2,'Kiw','Bulldog',13,'545769690',3, ''),
(3,'Q','Husky',15,'700798328',15,''),
(4,'xiaoK','Burmese cat',3,'434912003',2,''),
(5,'Mengmeng','Husky',15,'700798328',15,''),
(6,'Mumu','Poodle',10,'545769690',7,''),
(7,'Atticus','Shiba Inu',7,'345950411',20,''),
(8,'Mars','Shiba Inu',7,'345950411',20,''),
(9,'Ron','Golden Retriever',9,'719296541',18,''),
(10,'Yan','Golden Retriever',6,'719296541',17,''),
(11,'Miallox','Dachshund',14,'222949504',8,''),
(12,'Plggy','Welsh Corgi',2,'434912003',4,''),
(13,'Gifty','Pug',1,'222949504',11,''),
(14,'Astrix','American Shorthair',8,'648533996',6,''),
(15,'Austin','Bichon Frise',11,'632453996',21,''),
(16,'Linwieys','Bichon Frise',12,'632453996',21,''),
(17,'Ubatu','Chihuahua',4,'683429950',14,'');

UNLOCK TABLES;
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;




--
-- Definition of table `petstore`.`employee`
--

DROP TABLE IF EXISTS `petstore`.`employee`;
CREATE TABLE  `petstore`.`employee` (
  `fname` char(10) NOT NULL,
  `lname` char(10) NOT NULL,
  `dep_number` smallint(6) NOT NULL,
  `SSN` char(10) NOT NULL,
  `tel_number` char(15) NOT NULL default '',
  `super_ssn` char(15) NOT NULL default '',
  PRIMARY KEY  (`SSN`),
  KEY `FK_emp_dno` (`dep_number`),
  CONSTRAINT `FK_emp_dno` FOREIGN KEY (`dep_number`) REFERENCES `department` (`dp_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
LOCK TABLES `employee` WRITE;
INSERT INTO `petstore`.`employee` VALUES ('Vivi','Brianna', 1,'333445555','106-5564-8674', NULL),
('Mia', 'Katherine',2,'648533996', '168-5806-8397','333445555'),
('Lucy','Morg',3,'343769695','917-1960-1885', '333445555'),
('Jasmine','Stipowan',4,'683429950','630-4248-2919','333445555'),
('Madelyn','Xavier',2,'545769690','510-3831-7915','648533996'),
('Molly','Olivston',2,'434912003','206-6065-2238','648533996'),
('Scarlett','Belly',3,'222949504','943-2980-2725', '343769695'),
('Luis','Jan',3,'345950411','956-6695-1770', '343769695'),
('Kaden','Logan',4,'700798328','121-1599-1599','683429950'),
('Jeremy','Gee',4,'632453996','737-2290-0396','683429950'),
('Vivian','Ni',4,'719296541','368-8412-0423','683429950');

UNLOCK TABLES;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;




--
-- Definition of table `petstore`.`department`
--

DROP TABLE IF EXISTS `petstore`.`department`;
CREATE TABLE  `petstore`.`department` (
  `dp_number` smallint(6) NOT NULL,
  `dep_name` char(10) NOT NULL,
  `mrg_ssn` char(15) NOT NULL default '',
  PRIMARY KEY  (`dp_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `department` DISABLE KEYS */;
LOCK TABLES `department` WRITE;
INSERT INTO `petstore`.`department` VALUES (1,'General Manage','333445555'),
(2,'Group 1','648533996'),
(3,'Group 2','343769695'),
(4,'Group 3','683429950');

UNLOCK TABLES;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;



--
-- Definition of table `petstore`.`activity`
--

DROP TABLE IF EXISTS `petstore`.`activity`;
CREATE TABLE  `petstore`.`activity` (
  `activity_name` char(10) NOT NULL,
  `price` smallint(6) NOT NULL default 0,
  PRIMARY KEY  (`activity_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
LOCK TABLES `activity` WRITE;
INSERT INTO `petstore`.`activity` VALUES ('Groomy', 25),
('Shower',20),
('Haircut',18),
('Facial Clean',13),
('Pet Garden',34),
('Photograph',45),
('Prof Training',45),
('Treatment',39);

UNLOCK TABLES;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;



--
-- Definition of table `petstore`.`records`
--

DROP TABLE IF EXISTS `petstore`.`records`;
CREATE TABLE  `petstore`.`records` (
  `pet_num` smallint(5) NOT NULL,
  `activity_name` char(12) NOT NULL default '',
  `activity_time` char(12) NOT NULL default '',
  `drop_off_time` char(40) NOT NULL,
  `pick_up_time` char(40) NOT NULL,
  PRIMARY KEY  (`pet_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*!40000 ALTER TABLE `records` DISABLE KEYS */;
LOCK TABLES `records` WRITE;
INSERT INTO `petstore`.`records` VALUES (1,'','','2019-11-15','2019-11-18'),
(2,'','','2019-11-12','2019-11-18'),
(3,'','','2019-11-11','2019-11-22'),
(4,'','','2019-11-14','2019-11-23'),
(5,'','','2019-11-15','2019-11-22'),
(6,'','','2019-11-15','2019-11-19'),
(7,'','','2019-11-12','2019-11-23'),
(8,'','','2019-11-12','2019-11-23'),
(9,'','','2019-11-15','2019-11-29'),
(10,'','','2019-11-11','2019-11-27'),
(11,'','','2019-11-15','2019-11-24'),
(12,'','','2019-11-09','2019-11-18'),
(13,'','','2019-11-17','2019-11-18'),
(14,'','','2019-11-18','2019-11-21'),
(15,'','','2019-11-15','2019-11-25'),
(16,'','','2019-11-15','2019-11-25'),
(17,'','','2019-11-16','2019-11-23');

UNLOCK TABLES;
/*!40000 ALTER TABLE `records` ENABLE KEYS */;



--
-- Definition of table `petstore`.`total_price_pet`
--

DROP TABLE IF EXISTS `petstore`.`total_price_pet`;
CREATE TABLE  `petstore`.`total_price_pet` (
  `pet_num` smallint(5) NOT NULL,
  `price_pet` smallint(5) default NULL,
  PRIMARY KEY  (`pet_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `total_price_pet` DISABLE KEYS */;
LOCK TABLES `total_price_pet` WRITE;
INSERT INTO `petstore`.`total_price_pet` VALUES (1, 105),
(2,210),
(3,748),
(4,315),
(5,476),
(6,140),
(7,748),
(8,748),
(9,952),
(10,1088),
(11,441),
(12,441),
(13,49),
(14,105),
(15,68),
(16,68),
(17,343);

UNLOCK TABLES;
/*!40000 ALTER TABLE `total_price_pet` ENABLE KEYS */;


--
-- Definition of table `petstore`.`total_price_customer`
--

DROP TABLE IF EXISTS `petstore`.`total_price_customer`;
CREATE TABLE  `petstore`.`total_price_customer` (
  `pet_num` smallint(5) NOT NULL,
  `owner_num` smallint(5) NOT NULL,
  `price_pet` smallint(5) default NULL,
  PRIMARY KEY  (`pet_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `total_price_customer` DISABLE KEYS */;
LOCK TABLES `total_price_customer` WRITE;
INSERT INTO `petstore`.`total_price_customer` VALUES (1, 5, 105),
(2,13,210),
(3,15,748),
(4,3,315),
(5,15,476),
(6,10,140),
(7,7,748),
(8,7,748),
(9,9,952),
(10,6,1088),
(11,14,441),
(12,2,441),
(13,1,49),
(14,8,105),
(15,11,68),
(16,12,68),
(17,4,343);

UNLOCK TABLES;
/*!40000 ALTER TABLE `total_price_customer` ENABLE KEYS */;



--
-- Definition of table `petstore`.`item_rate`
--

DROP TABLE IF EXISTS `petstore`.`item_rate`;
CREATE TABLE  `petstore`.`item_rate` (
  `item_num` smallint(5) NOT NULL,
  `item_rate` smallint(5) default NULL,
  PRIMARY KEY  (`item_num`),
  UNIQUE KEY `item_num` (`item_num`),
  KEY `FK_item_rate` (`item_num`),
  CONSTRAINT `FK_item_rate` FOREIGN KEY (`item_num`) REFERENCES `sale` (`item_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `item_rate` DISABLE KEYS */;
LOCK TABLES `item_rate` WRITE;
INSERT INTO `petstore`.`item_rate` VALUES (1, 5),
(2,4),
(3,5),
(4,5),
(5,5),
(6,3.5),
(7,4.5),
(8,4.5);
UNLOCK TABLES;
/*!40000 ALTER TABLE `item_rate` ENABLE KEYS */;



--
-- Definition of table `petstore`.`sale`
--

DROP TABLE IF EXISTS `petstore`.`sale`;
CREATE TABLE  `petstore`.`sale` (
  `item_num` smallint(5) NOT NULL,
  `item_name` char(10) default NULL,
  `price` smallint(5) NOT NULL,
  PRIMARY KEY  (`item_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `sale` DISABLE KEYS */;
LOCK TABLES `sale` WRITE;
INSERT INTO `petstore`.`sale` VALUES (1, 'bangbangtang', 14),
(2, 'cat food', 18),
(3, 'delux cat food', 25),
(4, 'dog food', 22),
(5, 'delux dog food', 32),
(6, 'canine chewing gum', 14),
(7, 'teething rusks', 14),
(8, 'cat teaser', 14);

UNLOCK TABLES;
/*!40000 ALTER TABLE `sale` ENABLE KEYS */;


--
-- Definition of table `petstore`.`Pre_order`
--

DROP TABLE IF EXISTS `petstore`.`Pre_order`;
CREATE TABLE  `petstore`.`Pre_order` (
  `buyer_fname` char(20) NOT NULL,
  `buyer_lname` char(20) NOT NULL,
  `buyer_phone_num` char(20) NOT NULL,
  `item_num` smallint(5) NOT NULL,
  `item_name` char(10) NOT NULL,
  `item_amount` smallint(10) default 0,
  PRIMARY KEY  (`item_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- /*!40000 ALTER TABLE `Pre_order` DISABLE KEYS */;
-- LOCK TABLES `Pre_order` WRITE;
-- INSERT INTO `petstore`.`Pre_order` VALUES (1, 'bangbangtang', 14);

-- UNLOCK TABLES;
-- /*!40000 ALTER TABLE `Pre_order` ENABLE KEYS */;


