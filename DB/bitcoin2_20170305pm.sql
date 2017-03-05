CREATE DATABASE  IF NOT EXISTS `bitcoin20170218` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `bitcoin20170218`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bitcoin20170218
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_log`
--

DROP TABLE IF EXISTS `access_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_date` datetime DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_log`
--

LOCK TABLES `access_log` WRITE;
/*!40000 ALTER TABLE `access_log` DISABLE KEYS */;
INSERT INTO `access_log` VALUES (1,'2017-03-05 11:19:52','127.0.0.1','thanh2',1,2),(2,'2017-03-05 11:22:54','127.0.0.1','admin',0,1),(3,'2017-03-05 11:23:16','127.0.0.1','admin',1,1),(4,'2017-03-05 12:34:52','127.0.0.1','thanh2',0,1),(5,'2017-03-05 12:34:56','127.0.0.1','thanh2',0,1),(6,'2017-03-05 12:34:59','127.0.0.1','thanh2',0,1),(7,'2017-03-05 12:35:01','127.0.0.1','thanh2',0,1),(8,'2017-03-05 13:06:04','127.0.0.1','admin',1,1),(9,'2017-03-05 14:36:11','127.0.0.1','thanh2',1,2),(10,'2017-03-05 14:42:02','127.0.0.1','thanh3',1,2),(11,'2017-03-05 14:43:14','127.0.0.1','thanh4',0,2),(12,'2017-03-05 14:43:19','127.0.0.1','thanh4',0,2),(13,'2017-03-05 14:43:28','127.0.0.1','thanh4',0,2),(14,'2017-03-05 14:43:35','127.0.0.1','thanh4',1,2),(15,'2017-03-05 18:20:31','127.0.0.1','thanh2',1,2),(16,'2017-03-05 18:25:21','127.0.0.1','thanh2',0,1),(17,'2017-03-05 18:28:33','127.0.0.1','thanh2',0,1),(18,'2017-03-05 18:32:16','127.0.0.1','thanh2',0,1),(19,'2017-03-05 18:33:02','127.0.0.1','thanh2',0,1),(20,'2017-03-05 18:33:08','127.0.0.1','thanh2',0,1),(21,'2017-03-05 18:33:13','127.0.0.1','thanh2',0,1),(22,'2017-03-05 18:39:01','127.0.0.1','thanh2',0,1),(23,'2017-03-05 19:21:44','127.0.0.1','admin',1,1);
/*!40000 ALTER TABLE `access_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Password` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `Name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `IsDelete` tinyint(4) DEFAULT NULL,
  `Mobile` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Address` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','123456','Administrator',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adminwallet`
--

DROP TABLE IF EXISTS `adminwallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminwallet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `wallet` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminwallet`
--

LOCK TABLES `adminwallet` WRITE;
/*!40000 ALTER TABLE `adminwallet` DISABLE KEYS */;
INSERT INTO `adminwallet` VALUES (1,'1GVmZrGTv2pK9jNYd9M1CwowXfbBd5ih7K'),(2,'1FiEnViouVC1Kt1bJouZ9jen4imEZhoJMc'),(3,'16XUuQj7XwjKcNNnZhymbVBcTbjUsmTJyV'),(4,'17R14uWzLyZWMyUbSTp97Zrn5RqUY6qgsH'),(5,'1L5pEzWQn2igRatysfa7dBPC1By7acVcSg'),(6,'1FpYxPkwp32Hs3nL8pH3Ywvqpr2KDQXECK'),(7,'1Aqm3euFVXYDmPCDvY5yaiNpXrjFrTyoJ4'),(8,'1Lnk9rYHoPBDjiXxaE4oYn9jiz6BTghKxK'),(9,'14mHHTj89JWxqTkbzqDex5bV15YUbRVeCj'),(10,'1M7bE2yskYEddAfVxtWRREqgtemWSn4zij');
/*!40000 ALTER TABLE `adminwallet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Birthday` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PeoplesIdentity` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PasswordSalt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CustomerAvatarID` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CountryID` int(11) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `IsDelete` tinyint(4) DEFAULT NULL,
  `ListCustomerId` longtext COLLATE utf8_unicode_ci,
  `ParentID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `SecondPassword` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WalletAddress` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BitcoinQRUrl` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneCode` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `ListCustomerRef` longtext COLLATE utf8_unicode_ci,
  `levecustomerRef` int(11) DEFAULT NULL,
  `listPV` longtext COLLATE utf8_unicode_ci,
  `IsPH` tinyint(4) DEFAULT NULL,
  `RankID` int(11) DEFAULT NULL,
  `PercentRank` int(11) DEFAULT NULL,
  `ishappy1` tinyint(4) DEFAULT NULL,
  `ishappy2` tinyint(4) DEFAULT NULL,
  `ishappy3` tinyint(4) DEFAULT NULL,
  `TotalSystemBit` double DEFAULT NULL,
  `TotalF1InMonth` int(11) DEFAULT NULL,
  `TotalF2Inmonth` int(11) DEFAULT NULL,
  `TotMember` int(11) DEFAULT NULL,
  `TopIndex` tinyint(4) DEFAULT NULL,
  `client_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'client ip',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'pham tuan hai','haipham92','haiphamtuan010192@gmail.com',NULL,NULL,'','$2a$10$1qAz2wSx3eDc4rFv5tGb5eFWsS2l5MtRbJMHQBYXeOnFWm.tW4lXy','haihalove123','01696391964',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'1LnBMw6aoqGXF1JPRKM5sGavY187Emr7gW',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'27.67.10.54'),(2,'alibaba','alibaba','pentest313@gmail.com',NULL,NULL,'','$2a$10$1qAz2wSx3eDc4rFv5tGb5eNAzKmbvMU5dZZ2hhRQDgZB6tefh.fve','123456a@','012391234',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'1M7bE2yskYEddAfVxtWRREqgtemWSn4zij',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1.55.239.92'),(3,'maiyeuem','maiyeuem','pentest314@gmail.com',NULL,NULL,'','$2a$10$1qAz2wSx3eDc4rFv5tGb5eNAzKmbvMU5dZZ2hhRQDgZB6tefh.fve','123456a@','012312312',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'1M7bE2yskYEddAfVxtWRREqgtemWSn4zij',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1.55.239.92'),(4,'Nguyễn Văn Thành','nguyenthanh2017','nguyenthanhuet@gmail.com',NULL,NULL,'','$2a$10$1qAz2wSx3eDc4rFv5tGb5eefTzKCx/LNf./BqxzudS.QZxVA6PX66','123456','1687522330',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'14BNJyo1YBJG36Aa1ga7rrBTYaw1yyN7DX',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1.52.124.234'),(5,'Thanh Bui Duc','xaoxuyenxoi12','xaoxuyenxoi12@gmail.com',NULL,NULL,'','$2a$10$1qAz2wSx3eDc4rFv5tGb5eE71RoXe3A7azNGgkQGfs/amTg8heami','Saosang101','0976498383',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'1Dqih6LMxDzDvvSxWD7cUvxHhu7rWXDz6R',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'14.184.210.212'),(6,'Nguyễn Văn Thành','thanh2','nguyenthanhuet23@gmail.com',NULL,NULL,'','$2a$10$1qAz2wSx3eDc4rFv5tGb5eprWkuXd.sGMPxStzeRB/KZ92jOLNvZa','12345','1687522330',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'Số 6, Ngõ 104 Cổ Nhuế, Từ Liêm ( gần đường tàu)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'127.0.0.1'),(7,'thanh3','thanh3','nguyenthanh1233@gmail.com',NULL,NULL,'thanh2','$2a$10$1qAz2wSx3eDc4rFv5tGb5eprWkuXd.sGMPxStzeRB/KZ92jOLNvZa','','',NULL,NULL,NULL,1,NULL,NULL,6,NULL,NULL,'ssđrr32312sâsasasasssss',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'127.0.0.1'),(8,'thanh4','thanh4','nguyenthanhuet33@gmail.com',NULL,NULL,'thanh3','$2a$10$1qAz2wSx3eDc4rFv5tGb5eefTzKCx/LNf./BqxzudS.QZxVA6PX66','','',NULL,NULL,NULL,1,NULL,NULL,7,NULL,NULL,'sssssssssssssssssssss',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'127.0.0.1');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feeamount`
--

DROP TABLE IF EXISTS `feeamount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feeamount` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_typ` int(11) DEFAULT '0',
  `amount` double DEFAULT '0',
  `recived` double DEFAULT '0',
  `duration` int(11) DEFAULT '0',
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='bảng phí cho các loại giao dịch : 1 ngày, 3 ngày, 5 ngày';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feeamount`
--

LOCK TABLES `feeamount` WRITE;
/*!40000 ALTER TABLE `feeamount` DISABLE KEYS */;
INSERT INTO `feeamount` VALUES (1,1,0.3,0.45,30,'spin 1 months'),(2,2,0.5,0.8,60,'spin 2 months'),(3,3,0.7,1.6,90,'spin 3 months'),(4,4,0,20,0,'bonus from f1'),(5,5,0,10,0,'bonus from f2'),(6,6,0,5,0,'bonus from f3');
/*!40000 ALTER TABLE `feeamount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sendmoney_his`
--

DROP TABLE IF EXISTS `sendmoney_his`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sendmoney_his` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sendmoney_his`
--

LOCK TABLES `sendmoney_his` WRITE;
/*!40000 ALTER TABLE `sendmoney_his` DISABLE KEYS */;
INSERT INTO `sendmoney_his` VALUES (3,'2017-03-04'),(4,'2017-03-04'),(5,'2017-03-05'),(6,'2017-03-05'),(7,'2017-03-05'),(8,'2017-03-05');
/*!40000 ALTER TABLE `sendmoney_his` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) DEFAULT NULL,
  `question` text CHARACTER SET utf8,
  `senddate` datetime DEFAULT NULL,
  `answer` text CHARACTER SET utf8,
  `status` int(11) DEFAULT NULL COMMENT '0: chưa trả lời\n1: trả lời',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1,6,'ghg','2017-02-25 20:26:17','fdg',1);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_gh`
--

DROP TABLE IF EXISTS `transaction_gh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_gh` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) DEFAULT '0',
  `amount` double DEFAULT '0',
  `senddate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '1: waiting\n2:confirmed\n3:sendmoney',
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_typ` int(11) DEFAULT '0' COMMENT '1: 3days\n2: 5days\n3: 7days\n4: bonus from f1',
  `del_flg` int(11) DEFAULT '0',
  `bonus_from` int(11) DEFAULT NULL COMMENT 'f1 ID',
  `bonus_from_transgh` int(11) DEFAULT NULL COMMENT 'bonus from transaction gh nào?',
  `remaining_day` int(11) DEFAULT '0',
  `active_sendmoney` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user send admin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_gh`
--

LOCK TABLES `transaction_gh` WRITE;
/*!40000 ALTER TABLE `transaction_gh` DISABLE KEYS */;
INSERT INTO `transaction_gh` VALUES (1,5,0.7,'2017-02-27 23:04:15',2,'D:\\work\\xampp2\\htdocs\\bitcoin20170218\\application/../public/upload/customer/6/170227111102021515.jpg',3,0,NULL,NULL,88,1),(2,6,0.3,'2017-02-28 23:04:15',2,'D:\\work\\xampp2\\htdocs\\bitcoin20170218\\application/../public/upload/customer/6/170227111102021515.jpg',1,0,NULL,NULL,28,1),(3,6,0.7,'2017-03-02 20:44:24',2,'D:\\work\\xampp2\\htdocs\\bitcoin20170218\\application/../public/upload/customer/6/170302080803032424.jpg',3,0,NULL,NULL,90,1),(4,6,0,'2017-03-02 00:00:00',2,NULL,4,0,5,1,28,1),(8,8,0.7,'2017-03-05 14:52:18',2,'D:\\work\\xampp2\\htdocs\\bitcoin20170218\\application/../public/upload/customer/8/170305020203031818.jpg',3,0,NULL,NULL,90,1),(43,7,0.14,'2017-03-05 15:31:29',2,'',4,0,8,8,90,1),(44,6,0.07,'2017-03-05 15:31:29',2,'',5,0,8,8,90,1);
/*!40000 ALTER TABLE `transaction_gh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_ph`
--

DROP TABLE IF EXISTS `transaction_ph`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_ph` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) DEFAULT '0',
  `amount` double DEFAULT '0',
  `level` int(11) DEFAULT '0' COMMENT '1: F0, 2:F1, 3:F2',
  `senddate` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `issuccess` int(11) DEFAULT '0',
  `gh_id` int(11) DEFAULT '0' COMMENT 'Khi GH dc confirm thì PH sẽ tạo 1 bản ghi tương ứng transaction_ph.gh_id= transaction_gh.ID \nVà bản ghi này có issuccess = 0 ( chưa hoàn thành hay chưa chueyern tiền). Sau này khi chuyển tiền thành công thi issuccess =1',
  `remaining_day` int(11) DEFAULT '0',
  `active_sendmoney` int(11) DEFAULT '0',
  `del_flg` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='admin send user';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_ph`
--

LOCK TABLES `transaction_ph` WRITE;
/*!40000 ALTER TABLE `transaction_ph` DISABLE KEYS */;
INSERT INTO `transaction_ph` VALUES (45,6,0.015000000000000001,0,'2017-03-05 00:51:09',0,1,2,0,0,0),(46,5,0.017777777777777778,0,'2017-03-05 00:51:09',0,1,1,0,0,0),(47,6,0.017777777777777778,0,'2017-03-05 00:51:09',0,1,3,0,0,0),(48,6,0.0002,0,'2017-03-05 00:51:09',0,1,4,0,0,0),(52,6,0.015000000000000001,0,'2017-03-05 00:51:48',0,1,2,0,0,0),(53,5,0.017777777777777778,0,'2017-03-05 00:51:48',0,1,1,0,0,0),(54,6,0.017777777777777778,0,'2017-03-05 00:51:48',0,1,3,0,0,0),(55,6,0.0002,0,'2017-03-05 00:51:48',0,1,4,0,0,0);
/*!40000 ALTER TABLE `transaction_ph` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_temp`
--

DROP TABLE IF EXISTS `transaction_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_temp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Amount` double DEFAULT NULL,
  `del_flg` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_temp`
--

LOCK TABLES `transaction_temp` WRITE;
/*!40000 ALTER TABLE `transaction_temp` DISABLE KEYS */;
INSERT INTO `transaction_temp` VALUES (1,'kendy2310','2017-01-16 10:00:00',3,0.15,0),(2,'minhthanh2017','2017-01-11 10:45:00',2,0.18,0),(3,'jely_autobit','2017-01-15 10:34:00',3,0.15,0),(4,'nguyenhoanglong_2110','2017-01-11 17:34:00',3,0.7,0),(5,'jacktran','2017-01-10 17:34:00',3,0.7,0),(6,'thaonguyen270728','2017-01-15 17:09:00',3,0.35,0),(7,'nguyenhue68','2017-01-11 16:05:00',3,0.18,0),(8,'tranvu1993','2017-01-11 21:05:00',3,0.18,0),(9,'emily_katy','2017-01-16 22:05:00',3,0.5,0),(10,'thanhtrinhhoa','2017-01-15 22:05:00',3,0.5,0),(11,'hoanghai2310','2017-01-16 11:00:00',1,0.35,0),(12,'baby_waller','2017-01-16 18:00:00',1,0.18,0),(13,'oneprice','2017-01-17 00:00:00',2,0.18,0),(14,'alexnguyen2017','2017-01-17 01:00:00',1,0.5,0);
/*!40000 ALTER TABLE `transaction_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bitcoin20170218'
--

--
-- Dumping routines for database 'bitcoin20170218'
--
/*!50003 DROP FUNCTION IF EXISTS `SPLIT_STR` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR`(
  x VARCHAR(255),
  delim VARCHAR(12),
  pos INT
) RETURNS varchar(255) CHARSET utf8 COLLATE utf8_unicode_ci
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, '') ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `explode_table` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `explode_table`(bound VARCHAR(255))
BEGIN

    DECLARE id INT DEFAULT 0;
    DECLARE value TEXT;
    DECLARE occurance INT DEFAULT 0;
    DECLARE i INT DEFAULT 0;
    DECLARE splitted_value INT;
    DECLARE done INT DEFAULT 0;
    DECLARE cur1 CURSOR FOR SELECT table1.id, table1.value
                                         FROM table1
                                         WHERE table1.value != '';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    DROP TEMPORARY TABLE IF EXISTS table2;
    CREATE TEMPORARY TABLE table2(
    `id` INT NOT NULL,
    `value` VARCHAR(255) NOT NULL
    ) ENGINE=Memory;

    OPEN cur1;
      read_loop: LOOP
        FETCH cur1 INTO id, value;
        IF done THEN
          LEAVE read_loop;
        END IF;

        SET occurance = (SELECT LENGTH(value)
                                 - LENGTH(REPLACE(value, bound, ''))
                                 +1);
        SET i=1;
        WHILE i <= occurance DO
          SET splitted_value =
          (SELECT REPLACE(SUBSTRING(SUBSTRING_INDEX(value, bound, i),
          LENGTH(SUBSTRING_INDEX(value, bound, i - 1)) + 1), ',', ''));

          INSERT INTO table2 VALUES (id, splitted_value);
          SET i = i + 1;

        END WHILE;
      END LOOP;

      SELECT * FROM table2;
    CLOSE cur1;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getInforWebsite` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getInforWebsite`(IN menu varchar(100))
BEGIN
	SELECT 
		tbl_about.*
	FROM
		tbl_about
	WHERE
		tbl_about.del_flg = 1
	ORDER BY tbl_about.about_id
	LIMIT 1
	;
    
    
	SELECT 
		tbl_news.*
	FROM
		tbl_news
			LEFT JOIN
		tbl_menu ON tbl_news.cate_id = tbl_menu.menu_id
			LEFT JOIN
		tbl_status ON tbl_news.news_action_id = tbl_status.status_id
	WHERE
		tbl_news.del_flg = 1
			AND tbl_menu.del_flag = 0
			AND tbl_status.status_id = 5
			AND tbl_menu.url LIKE concat('%', menu, '%')
	ORDER BY CASE
		WHEN tbl_news.upd_date IS NULL THEN tbl_news.inp_date
		ELSE tbl_news.upd_date
	END DESC
	LIMIT 5
		;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_COUNT_LOG` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_COUNT_LOG`()
BEGIN
	SELECT COUNT(id) AS count_log FROM access_log;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_FEE_AMOUNT_INVEST_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_FEE_AMOUNT_INVEST_LIST`()
BEGIN
	SELECT 
    feeamount.*
    ,ROUND((feeamount.recived - feeamount.amount)/duration,4)AS recived_day
    FROM feeamount
    WHERE feeamount.transaction_typ < 4;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_FEE_AMOUNT_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_FEE_AMOUNT_LIST`()
BEGIN
SELECT 
    *
    FROM feeamount;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_LAST_TRAN_TMP` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_LAST_TRAN_TMP`()
BEGIN
	CREATE TEMPORARY TABLE IF NOT EXISTS temp_table 
	As (
		SELECT
			transaction_temp.ID
		,	transaction_temp.UserName
		,	TIMEDIFF(NOW(),transaction_temp.Date) AS Date
		,	CASE
				WHEN transaction_temp.Status =  2 THEN 'Confirmed'
				WHEN transaction_temp.Status =  3 THEN 'Success'
				ELSE 'Waiting'
			END Status
		,	transaction_temp.Amount
		FROM transaction_temp
	);
        INSERT INTO temp_table
		SELECT
			transaction_gh.ID
		,	customer.UserName
		,	TIMEDIFF(NOW(),transaction_gh.senddate) AS Date
		,	CASE
				WHEN transaction_gh.status =  2 THEN 'Confirmed'
				WHEN transaction_gh.status =  3 THEN 'Success'
				ELSE 'Waiting'
			END Status
		,	transaction_gh.amount
		FROM transaction_gh
		LEFT JOIN customer ON
			transaction_gh.CustomerID = customer.ID;
		SELECT * FROM temp_table
        ORDER BY temp_table.Date;
        DROP TEMPORARY TABLE IF EXISTS temp_table;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POLICY_HOME_LST1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_POLICY_HOME_LST1`()
BEGIN
	SELECT
		feeamount.ID
	,	feeamount.transaction_typ
    ,	feeamount.amount
    ,	feeamount.recived
    ,	feeamount.duration
    FROM feeamount
    WHERE feeamount.ID <=3;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_PROFIT_PLAN` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PROFIT_PLAN`()
BEGIN
	DECLARE total_recived_blance 	DOUBLE DEFAULT 0;
    DECLARE total_send_balance		DOUBLE DEFAULT 0;
    DECLARE total_profit			DOUBLE DEFAULT 0;
    DECLARE plan_money_send			DOUBLE DEFAULT 0;
    DECLARE plan_profit				DOUBLE DEFAULT 0;
    DECLARE count_send				INT DEFAULT 0;
    SET total_recived_blance = (
    SELECT
		SUM(bh.amount)
    FROM transaction_gh AS bh
    WHERE 
    (bh.status = 2 OR bh.status = 3)
    AND bh.del_flg <> 1
    );
    SET total_send_balance =
	(SELECT
		SUM(ph.amount)
    FROM transaction_ph AS ph
    WHERE issuccess = 1
     AND ph.del_flg <> 1
    ); 
    SET total_profit = total_recived_blance- total_send_balance;
    
    
    SET plan_money_send = (
		SELECT
		SUM(feeamount.recived /feeamount.duration)
		FROM transaction_gh
		LEFT JOIN feeamount ON
				transaction_gh.transaction_typ = feeamount.transaction_typ
		WHERE transaction_gh.del_flg <> 1
			AND transaction_gh.remaining_day >0
            AND transaction_gh.active_sendmoney = 1
	);
    SET plan_profit = total_profit - plan_money_send;
    SET count_send = (
    SELECT
		COUNT(id) AS day_send_count
	FROM sendmoney_his
    WHERE DATE(send_date) = DATE(NOW())
    );
	SELECT
		total_recived_blance As total_recived_blance
	,	total_send_balance	AS total_send_balance
	,	total_profit		AS total_profit
	,	plan_profit			AS plan_profit
	,	plan_money_send		AS plan_money_send
    ,	count_send		AS count_send_day;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_ACTIVE_CUSTOMER_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_ACTIVE_CUSTOMER_ACT1`(IN
	customerID	INT
,	active		INT
)
BEGIN
	UPDATE customer
    SET customer.isActive = active
    WHERE customer.ID	=	customerID;
    
    IF active = 0 THEN
    UPDATE transaction_gh
    SET active_sendmoney = active
    WHERE transaction_gh.CustomerID	=	customerID
    AND transaction_gh.remaining_day >0;
    END IF;
        
    SELECT 1 AS success;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_CHANGE_PASSWORD_CUS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_CHANGE_PASSWORD_CUS`(IN
	userName	VARCHAR(100)
,	password_new VARCHAR(100)
)
BEGIN
	UPDATE customer
    SET customer.Password =  password_new
    WHERE customer.UserName = userName;
    
    SELECT 1 AS success;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_DELETE_CUSTOMER_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_DELETE_CUSTOMER_ACT1`(IN
	CustomerID INT
)
BEGIN
	DELETE FROM customer
    WHERE customer.ID = CustomerID;
	
    DELETE FROM ticket WHERE ticket.CustomerID = CustomerID;
    
    SELECT 1 AS success;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_DUPLICATE_CUSTOMER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_DUPLICATE_CUSTOMER`(IN
	userName varchar(100)
,	email varchar(100)
,	sponsor varchar(100)
)
BEGIN
	IF (SELECT COUNT(customer.ID) FROM customer WHERE customer.UserName = userName OR customer.Email = email) =  0 THEN 
		IF(SELECT COUNT(customer.ID) FROM customer WHERE customer.UserName = sponsor)>0 || sponsor=''  THEN
			SELECT 1 As success;
		ELSE
			SELECT -2 As success;
		END IF;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_ACCESS_LOG` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_ACCESS_LOG`(
	limit_record INT
,	page_index INT
)
BEGIN
	DECLARE offset_index INT ;
    SET offset_index =page_index*limit_record ;
	SELECT
    access_log.id,
    access_log.access_date,
    access_log.ip,
    access_log.user_name,
    CASE
		WHEN access_log.status = 1 THEN 'Login success'
        ELSE 'Login failed'
	END AS access_status,
    CASE
		WHEN access_log.type = 1 THEN 'Admin login'
        ELSE 'Customer login'
	END AS access_type,
    access_log.status AS access_status_int
	
    FROM access_log
    ORDER BY
		access_log.access_date DESC
	LIMIT limit_record OFFSET offset_index;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_ADMIN_TICKET_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_ADMIN_TICKET_LIST`()
BEGIN
	SELECT
		ticket.ID
	,	ticket.CustomerID
    ,	ticket.question
    ,	ticket.senddate
    ,	ticket.answer
    ,	customer.UserName
    ,	customer.Email
    ,	ticket.status AS status_val
    ,	CASE
			WHEN ticket.status = 1 THEN 'Answered'
            ELSE 'Waiting answer'
		END 	AS status
	,	CASE
			WHEN ticket.status = 1 THEN 'color-success'
            ELSE 'color-default'
		END 	AS color
    FROM ticket
    LEFT JOIN customer ON
		ticket.CustomerID = customer.ID
	ORDER BY
		ticket.ID DESC
	,	ticket.CustomerID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_BUSSINESS_REPORT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_BUSSINESS_REPORT`(IN
P_CustomerID	INT
)
BEGIN
    DECLARE totalInvest INT DEFAULT 0;
    DECLARE waitingInvest INT DEFAULT 0;
    DECLARE confirmedInvest INT DEFAULT 0;
    DECLARE amountInvest DECIMAL(18,5) DEFAULT 0;
    DECLARE amountWaitingInvest DECIMAL(18,5) DEFAULT 0;
    DECLARE amountConfirmedInvest DECIMAL(18,5) DEFAULT 0;
    DECLARE amountConfirmedInvestLast DECIMAL(18,5) DEFAULT 0;
    
    DECLARE transactionGHLastID INT DEFAULT 0;
    
    DECLARE totalRecived INT DEFAULT 0;
    DECLARE errorRecived INT DEFAULT 0;
    DECLARE successRecived INT DEFAULT 0;
    DECLARE planRecivedLast DECIMAL(18,5) DEFAULT 0;
    DECLARE amountRecived DECIMAL(18,5) DEFAULT 0;
    DECLARE amountErrorRecived DECIMAL(18,5) DEFAULT 0;
    DECLARE amountSuccessRecived DECIMAL(18,5) DEFAULT 0;
    DECLARE amountSuccessRecivedLast DECIMAL(18,5) DEFAULT 0;
    SET totalInvest = 
    (SELECT
         COUNT(1)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
    AND transaction_gh.del_flg <> 1);
    
    
    SET waitingInvest = 
    (SELECT
         COUNT(1)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
    AND transaction_gh.status = 1
    AND transaction_gh.del_flg <> 1);
    
    SET confirmedInvest = 
    (SELECT
         COUNT(1)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
    AND transaction_gh.status = 2
    AND transaction_gh.del_flg <> 1);
    
    
    SET amountInvest = 
    (SELECT
         IFNULL(SUM(transaction_gh.amount),0)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
    AND transaction_gh.del_flg <> 1
    AND transaction_gh.status = 2);
    
    SET amountWaitingInvest = 
    (SELECT
         IFNULL(SUM(transaction_gh.amount),0)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
     AND transaction_gh.status = 1
    AND transaction_gh.del_flg <> 1);
    
    SET amountConfirmedInvest = 
    (SELECT
         IFNULL(SUM(transaction_gh.amount),0)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
     AND transaction_gh.status = 2
    AND transaction_gh.del_flg <> 1);

    SET amountConfirmedInvestLast = 
    (SELECT 
         IFNULL(transaction_gh.amount,0)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
     AND transaction_gh.status = 2
    AND transaction_gh.del_flg <> 1
    ORDER BY transaction_gh.senddate DESC
    LIMIT 1);
    
    SET transactionGHLastID = 
    (SELECT 
         IFNULL(transaction_gh.ID,0)
    FROM transaction_gh
    WHERE transaction_gh.CustomerID = P_customerID
     AND transaction_gh.status = 2
    AND transaction_gh.del_flg <> 1
    ORDER BY transaction_gh.senddate DESC
    LIMIT 1);
    
    SET totalRecived = 
    (SELECT
         COUNT(1)
    FROM transaction_ph
    WHERE transaction_ph.CustomerID = P_customerID
    AND transaction_ph.del_flg <> 1);
    
    SET errorRecived = 
    (SELECT
         COUNT(1)
    FROM transaction_ph
    WHERE transaction_ph.CustomerID = P_customerID
    AND transaction_ph.issuccess = 0
    AND transaction_ph.del_flg <> 1);
    
    SET successRecived = 
    (SELECT
         COUNT(1)
    FROM transaction_ph
    WHERE transaction_ph.CustomerID = P_customerID
    AND transaction_ph.issuccess = 1
    AND transaction_ph.del_flg <> 1);
    
    SET amountRecived = 
    (SELECT
         IFNULL(SUM(transaction_ph.amount),0)
    FROM transaction_ph
    WHERE transaction_ph.CustomerID = P_customerID
    AND transaction_ph.del_flg <> 1);
    
    SET amountErrorRecived = 
    (SELECT
         IFNULL(SUM(transaction_ph.amount),0)
    FROM transaction_ph
    WHERE transaction_ph.CustomerID = P_customerID
    AND transaction_ph.issuccess = 0
    AND transaction_ph.del_flg <> 1);
    
    SET amountSuccessRecived = 
    (SELECT
         IFNULL(SUM(transaction_ph.amount),0)
    FROM transaction_ph
    WHERE transaction_ph.CustomerID = P_customerID
    AND transaction_ph.issuccess = 1
    AND transaction_ph.del_flg <> 1);
    
    SET amountSuccessRecivedLast = 
    (SELECT amount FROM transaction_ph WHERE transaction_ph.CustomerID = P_customerID ORDER BY senddate limit 1);
    
    SET planRecivedLast = 
    (SELECT 
         IFNULL(feeamount.recived,0)
    FROM transaction_gh
    LEFT JOIN feeamount ON
        transaction_gh.transaction_typ = feeamount.transaction_typ
    WHERE transaction_gh.CustomerID = P_customerID
     AND transaction_gh.status = 2
    AND transaction_gh.del_flg <> 1
    AND transaction_gh.status = 2
    ORDER BY transaction_gh.senddate DESC
    LIMIT 1);
    
    
    SELECT 
        totalInvest,
        waitingInvest,
        confirmedInvest, 
        amountInvest,
        amountWaitingInvest,
        amountConfirmedInvest, 
        totalRecived,
        errorRecived, 
        successRecived,
        amountRecived,
        amountErrorRecived,
        amountSuccessRecived,
        amountSuccessRecivedLast,
        amountConfirmedInvestLast,
        planRecivedLast,
        transactionGHLastID;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_CUSTOMER_LST1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_CUSTOMER_LST1`()
BEGIN
	SELECT
		customer.ID
	,	customer.FullName
    ,	customer.UserName
    ,	customer.Email
    ,	customer.Mobile
    ,	customer.WalletAddress
    ,	customer.isActive
    ,	customer.isDelete
    ,	customer.client_ip
	FROM customer;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_DASHBOARD_DATA_INFO` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_DASHBOARD_DATA_INFO`()
BEGIN
	DECLARE total_recived_blance 	DOUBLE DEFAULT 0;
    DECLARE total_send_balance		DOUBLE DEFAULT 0;
    DECLARE total_waiting			INT DEFAULT 0;
    DECLARE total_confrimed			INT DEFAULT 0;
    DECLARE total_PH				INT DEFAULT 0;
	DECLARE total_customer			INT DEFAULT 0;
    SET total_recived_blance = (
    SELECT
		SUM(bh.amount)
    FROM transaction_gh AS bh
    WHERE 
    (bh.status = 2 OR bh.status = 3)
    AND bh.del_flg <> 1
    );
    SET total_send_balance =
	(SELECT
		SUM(ph.amount)
    FROM transaction_ph AS ph
    WHERE issuccess = 1
     AND ph.del_flg <> 1
    ); 
    SET total_waiting = (
    SELECT
		COUNT(1)
    FROM transaction_gh AS bh
    WHERE 
    bh.status = 1
    AND bh.del_flg <> 1
    );
    SET total_confrimed = (
    SELECT
		COUNT(1)
    FROM transaction_gh AS bh
    WHERE 
    bh.status = 2
    AND bh.del_flg <> 1
    );
    SET total_PH = (
    SELECT
		COUNT(1)
    FROM transaction_gh AS bh
    WHERE 
    bh.status = 3
    AND bh.del_flg <> 1
    );
    
    SET total_customer = (
    SELECT
		COUNT(1)
    FROM customer
    );
    
    SELECT
		total_recived_blance As total_recived_blance
	,	total_send_balance	AS total_send_balance
    ,	total_waiting		AS total_waiting
    ,	total_confrimed		AS total_confrimed
    ,	total_PH			AS total_PH
    ,	total_customer		AS total_customer;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_DATA_INFO` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_DATA_INFO`(IN
P_customerID INT
)
BEGIN
	DECLARE invest_blance DOUBLE DEFAULT 0;
    DECLARE bonus_balance		DOUBLE DEFAULT 0;
    DECLARE total_teferrals		DOUBLE DEFAULT 0;
    DECLARE investValidDay		INT	DEFAULT	0;
    DECLARE investValid			INT	DEFAULT	1;
    DECLARE countChild			INT	DEFAULT	0;
    SET bonus_balance = 
    (SELECT
		 SUM(ph.amount)
    FROM transaction_ph AS ph
    WHERE ph.CustomerID = P_customerID
    AND ph.del_flg <> 1
    AND ph.issuccess = 1
    GROUP BY ph.CustomerID);
    SET invest_blance = (
    SELECT
		SUM(bh.amount)
    FROM transaction_gh AS bh
    WHERE bh.CustomerID = P_customerID
    AND bh.del_flg <> 1
    GROUP BY bh.CustomerID
    );
    SET total_teferrals =
	(SELECT
		SUM(ph.amount)
    FROM transaction_ph AS ph
    WHERE ph.CustomerID = P_customerID
    AND ph.del_flg <> 1
    AND ph.level > 0
    GROUP BY ph.CustomerID); -- neu customer hien tại là F1, F2
    
    
    SET countChild = 
    (
		SELECT COUNT(1)
        FROM customer
        WHERE customer.ParentID = P_customerID
    );
    
    SET investValidDay = 
    (
		SELECT COUNT(1)
        FROM transaction_gh
        WHERE transaction_gh.customerID = P_customerID
        /*AND DATE(transaction_gh.senddate) = CURDATE()*/
        AND transaction_gh.status = 1
        AND transaction_gh.del_flg <> 1
    );
    IF(countChild >= 2 AND countChild<4) THEN
		SET investValid = 2 - investValidDay;
	ELSEIF (countChild >=4  AND countChild< 8) THEN
		SET investValid = 3 - investValidDay;
	ELSEIF (countChild >=8) THEN
		SET investValid = 4 - investValidDay;
	else SET investValid = 1 - investValidDay;
	END IF;
    SELECT
		invest_blance As invest_blance
	,	bonus_balance	AS bonus_balance
    ,	total_teferrals	AS total_teferrals
    ,	investValid		AS invest_valid; -- so lan invest con lai
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_FEE_BY_ID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_FEE_BY_ID`(IN
P_ID	INT
)
BEGIN
	SELECT * FROM feeamount WHERE feeamount.ID = P_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_PLAN_FEE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_PLAN_FEE`()
BEGIN
	select transaction_typ, amount, recived, duration from feeamount where amount <> 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_RAND_ADMIN_WALLET` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_RAND_ADMIN_WALLET`(IN
P_customerID INT
)
BEGIN
	DECLARE investValidDay		INT	DEFAULT	0;
    DECLARE investValid			INT	DEFAULT	1;
    DECLARE countChild			INT	DEFAULT	0;
    
	DECLARE adminWallet VARCHAR(500) DEFAULT '';
    SET adminWallet =  (SELECT adminwallet.wallet FROM adminwallet ORDER BY RAND() LIMIT 1);
    
    SET countChild = 
    (
		SELECT COUNT(1)
        FROM customer
        WHERE customer.ParentID = P_customerID
    );
    
    SET investValidDay = 
    (
		SELECT COUNT(1)
        FROM transaction_gh
        WHERE transaction_gh.customerID = P_customerID
        /*AND DATE(transaction_gh.senddate) = CURDATE()*/
        AND transaction_gh.status = 1
        AND transaction_gh.del_flg <> 1
    );
    IF(countChild >= 2 AND countChild<4) THEN
		SET investValid = 2 - investValidDay;
	ELSEIF (countChild >=4  AND countChild< 8) THEN
		SET investValid = 3 - investValidDay;
	ELSEIF (countChild >=8) THEN
		SET investValid = 4 - investValidDay;
	ELSE 
		SET investValid = 1 - investValidDay;
	END IF;
    SELECT
		investValid	AS invest_valid
	,	adminWallet AS admin_wallet;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_STATUS_USER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_STATUS_USER`(IN 
`P_customerID` INT
)
BEGIN        
SELECT fullname, isactive 
from customer 
where ID = P_customerID;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_TICKET_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_TICKET_LIST`(IN
P_CustomerID	INT
)
BEGIN
	SELECT
		ticket.ID
	,	ticket.CustomerID
    ,	ticket.question
    ,	ticket.senddate
    ,	ticket.answer
    ,	CASE
			WHEN ticket.status = 1 THEN 'Answered'
            ELSE 'Have sent'
		END 	AS status
	,	CASE
			WHEN ticket.status = 1 THEN 'color-success'
            ELSE 'color-default'
		END 	AS color
    FROM ticket
    WHERE ticket.CustomerID = P_CustomerID
    ORDER BY	ticket.senddate;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_TRANS_CONFIRMED` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_TRANS_CONFIRMED`()
BEGIN
	SELECT
		transaction_gh.ID
    ,	transaction_gh.CustomerID
    ,	transaction_gh.amount
    ,	transaction_gh.senddate
    ,	transaction_gh.image
    ,	transaction_gh.transaction_typ
    ,	customer.UserName
    ,	customer.Email
	,	customer.Mobile
    ,	CASE
			WHEN transaction_gh.status = 1 THEN 'Waiting Approve'
            WHEN transaction_gh.status = 2 THEN 'Confirmed'
            WHEN transaction_gh.status = 3 THEN 'Successfull'
		END  AS status
	,	CASE
			WHEN transaction_gh.status = 1 THEN 'label-warning'
            WHEN transaction_gh.status = 2 THEN 'label-success'
            WHEN transaction_gh.status = 3 THEN 'label-violet'
		END  AS color
    ,	CASE
			WHEN feeamount.transaction_typ <=3 THEN feeamount.recived
            ELSE transaction_gh.amount 
		END AS bonus
    ,	feeamount.duration
    ,	cus2.UserName AS bonus_from
    ,	transaction_gh.bonus_from_transgh
    ,	transaction_gh.remaining_day
    ,	transaction_gh.active_sendmoney
    FROM transaction_gh
    INNER JOIN customer ON
		transaction_gh.CustomerID = customer.ID
	AND customer.IsActive = 1
	LEFT JOIN feeamount ON
		transaction_gh.transaction_typ = feeamount.transaction_typ
	LEFT JOIN customer AS cus2 ON
			cus2.ID = transaction_gh.bonus_from
	WHERE transaction_gh.status = 2 
    AND transaction_gh.del_flg <> 1
    AND transaction_gh.remaining_day > 0
    ORDER BY transaction_gh.senddate DESC;
    
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_TRANS_GH` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_TRANS_GH`(
IN customerId	INT
)
BEGIN
	SELECT transaction_gh.CustomerID
    ,	transaction_gh.amount
    ,	transaction_gh.senddate
    ,	transaction_gh.image
    ,	transaction_gh.transaction_typ
    ,	feeamount.duration
    ,	CASE
			WHEN transaction_gh.status = 1 THEN 'Waiting Approve'
            WHEN transaction_gh.status = 2 THEN 'Confirmed'
            WHEN transaction_gh.status = 3 THEN 'success'
		END  AS status
	,	CASE
			WHEN transaction_gh.status = 1 THEN 'label-warning'
            WHEN transaction_gh.status = 2 THEN 'label-success'
            WHEN transaction_gh.status = 3 THEN 'label-success'
		END  AS color
    ,	feeamount.recived AS bonus
    FROM transaction_gh 
	LEFT JOIN feeamount ON
		transaction_gh.transaction_typ = feeamount.transaction_typ
    WHERE transaction_gh.CustomerID =  customerId
    AND (transaction_gh.bonus_from_transgh = 0 OR transaction_gh.bonus_from_transgh IS NULL)
    AND transaction_gh.del_flg <> 1
    ORDER BY transaction_gh.senddate DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_TRANS_PH` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_TRANS_PH`(
IN customerId	INT
)
BEGIN
	SELECT transaction_ph.CustomerID
    ,	CAST(transaction_ph.amount AS DECIMAL(10,5) ) AS amount
    ,	transaction_ph.senddate
    ,	CASE
			WHEN transaction_ph.issuccess = 1 THEN 'Success'
            ELSE   'Waiting'
		END  AS issuccess
	,	CASE
			WHEN transaction_ph.level = 0 THEN 'Normal'
            WHEN transaction_ph.level = 1 THEN 'From F1'
		END  AS level
	,	CASE
			WHEN transaction_ph.issuccess = 1 THEN 'label-success'
            ELSE  'label-warning'
		END  AS color
    
    FROM transaction_ph 
    WHERE transaction_ph.CustomerID =  customerId
    AND transaction_ph.del_flg <> 1
    AND (transaction_ph.issuccess = 1 OR level = 0)
    ORDER BY transaction_ph.senddate DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_TRANS_SUCCESS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_TRANS_SUCCESS`()
BEGIN
	SELECT
		transaction_ph.ID
    ,	transaction_ph.CustomerID
    ,	CAST(transaction_ph.amount AS DECIMAL (10,5)) AS amount
    ,	transaction_ph.senddate AS admin_senddate
    ,	transaction_gh.senddate
    ,	transaction_gh.image
    ,	transaction_gh.transaction_typ
    ,	customer.UserName
    ,	customer.Email
	,	customer.Mobile
    ,	CASE
            WHEN transaction_ph.issuccess = 1 THEN 'Successfull'
            ELSE 'No Successfull'
		END  AS status
	,	CASE
			WHEN transaction_ph.issuccess = 1 THEN 'label-success'
            ELSE 'label-warning'
		END  AS color
    ,	feeamount.recived AS bonus
    FROM transaction_ph
    INNER JOIN customer ON
		transaction_ph.CustomerID = customer.ID
	LEFT JOIN transaction_gh ON
		transaction_gh.ID = transaction_ph.gh_id
	AND transaction_gh.del_flg <> 1
    LEFT JOIN feeamount ON
		transaction_gh.transaction_typ = feeamount.transaction_typ
    WHERE transaction_ph.del_flg <> 1
    ORDER BY	transaction_ph.senddate DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_TRANS_WAITING` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_TRANS_WAITING`()
BEGIN
	SELECT
		transaction_gh.ID
    ,	transaction_gh.CustomerID
    ,	transaction_gh.amount
    ,	transaction_gh.senddate
    ,	transaction_gh.image
    ,	transaction_gh.transaction_typ
    ,	customer.UserName
    ,	customer.Email
	,	customer.Mobile
    ,	CASE
			WHEN transaction_gh.status = 1 THEN 'Waiting Approve'
            WHEN transaction_gh.status = 2 THEN 'Confirmed'
            WHEN transaction_gh.status = 3 THEN 'Successfull'
		END  AS status
	,	CASE
			WHEN transaction_gh.status = 1 THEN 'label-warning'
            WHEN transaction_gh.status = 2 THEN 'label-success'
            WHEN transaction_gh.status = 3 THEN 'label-violet'
		END  AS color
    ,	feeamount.recived AS bonus
    ,	feeamount.duration
    FROM transaction_gh
    INNER JOIN customer ON
		transaction_gh.CustomerID = customer.ID
	LEFT JOIN feeamount ON
		transaction_gh.transaction_typ = feeamount.transaction_typ
	WHERE transaction_gh.status = 1 
    AND transaction_gh.del_flg <> 1
    ORDER BY transaction_gh.senddate DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_GET_WALLET_BY_TRAN_ID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_GET_WALLET_BY_TRAN_ID`()
BEGIN
	SELECT transaction_gh.CustomerID
    ,	transaction_gh.ID
    ,	transaction_gh.amount
    ,	transaction_gh.senddate
    ,	transaction_gh.transaction_typ
    ,	feeamount.duration
    ,	transaction_gh.status
    ,	(feeamount.recived/duration) AS recived
    ,	customer.WalletAddress AS wallet_address
    ,	transaction_gh.active_sendmoney
	,	transaction_gh.remaining_day
    FROM transaction_gh 
	LEFT JOIN feeamount ON
		transaction_gh.transaction_typ = feeamount.transaction_typ
	LEFT JOIN customer ON
		transaction_gh.CustomerID = customer.ID
    WHERE
		transaction_gh.remaining_day > 0
    AND transaction_gh.active_sendmoney = 1
    AND transaction_gh.del_flg <> 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_LOGIN_ADMIN_LST1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_LOGIN_ADMIN_LST1`(IN
	userName varchar(100)
,	password_in varchar(100)
,	ip			VARCHAR(200)
)
BEGIN
	DECLARE status_tmp INT DEFAULT 0;
	SELECT
		c1.ID
	,	c1.Name
	,	c1.Email
    ,	c1.UserName
    ,	c1.Mobile
    ,	c1.Password
	,	1 AS islogin
	FROM admin AS c1
	WHERE	c1.UserName = userName COLLATE utf8_unicode_ci
		AND c1.Password = password_in COLLATE utf8_unicode_ci
	LIMIT 1;
	IF 
    (SELECT
		COUNT(*)
	FROM admin AS c1
	WHERE	c1.UserName = userName COLLATE utf8_unicode_ci
		AND c1.Password = password_in COLLATE utf8_unicode_ci) > 0
    THEN
		SET status_tmp = 1;
	END IF;
    INSERT INTO access_log(
        access_date,
        ip,
        user_name,
        status,
        type
    )
    SELECT
		NOW()
	,	ip
    ,	userName
    ,	status_tmp
    ,	1; -- admin access
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_LOGIN_CUSTOMER_LST1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_LOGIN_CUSTOMER_LST1`(IN
	userName varchar(100)
,	password_in varchar(100)
,	ip			VARCHAR(200)
)
BEGIN
	DECLARE adminWallet VARCHAR(500) DEFAULT '';
    DECLARE status_tmp INT DEFAULT 0;
    SET adminWallet =  (SELECT adminwallet.wallet FROM adminwallet ORDER BY RAND() LIMIT 1);
	SELECT
		c1.ID
	,	c1.FullName
	,	c1.Email
    ,	c1.UserName
    ,	c1.PeoplesIdentity
    ,	c1.Mobile
    ,	c1.WalletAddress
    ,	c1.Password
	,	1 AS islogin
	,	adminWallet AS adminWallet
	FROM customer AS c1
	WHERE	c1.UserName = userName
		AND c1.Password = password_in
        AND c1.IsActive =  1
	LIMIT 1;
    IF 
    (SELECT COUNT(*) 	FROM  customer AS c1
						WHERE	c1.UserName = userName
							AND c1.Password = password_in
							AND c1.IsActive =  1) > 0
    THEN
		SET status_tmp = 1;
	END IF;
    INSERT INTO access_log(
        access_date,
        ip,
        user_name,
        status,
        type
    )
    SELECT
		NOW()
	,	ip
    ,	userName
    ,	status_tmp
    ,	2; -- customer access
   
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_REGIS_CUSTOMER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_REGIS_CUSTOMER`(IN
	username	varchar(100)		
,	fullname 	varchar(100)
,	password_in	varchar(100)	
,	pin			varchar(255)
,	mobile		varchar(50)
,	email		varchar(100)
,	bitaddress	varchar(500)
,	referer		varchar(100)
,	client_ip	varchar(100)
)
BEGIN
	DECLARE ParentID INT(11) DEFAULT  0;
    SET	ParentID	=	(SELECT customer.ID FROM customer WHERE customer.UserName = referer);
	INSERT INTO customer(
		FullName  
	,	UserName  
	,	Email 
	,	PeoplesIdentity
	,	Password
	,	PasswordSalt
    ,   WalletAddress
	,	Mobile
    ,	ParentID
    ,	client_ip
    ,	IsActive
    )
    SELECT
		fullname
	,	username
	,	email
    ,	referer
    ,	password_in
    ,	pin
    ,	bitaddress
    ,	mobile
    ,	ParentID
    ,	client_ip
    ,	1;
    SELECT 1 As success; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_RESETPASS_CUSTOMER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_RESETPASS_CUSTOMER`(IN
	userName	VARCHAR(100)
,	password_new VARCHAR(100)
)
BEGIN
	UPDATE customer
    SET customer.Password =  password_new	
    WHERE customer.UserName = userName;
    
    SELECT
		1 AS success
	,	customer.Email
    ,	customer.FullName
    FROM customer
    WHERE customer.UserName = userName; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_SAVE_POLICY_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_SAVE_POLICY_ACT1`(IN
	P_ID		INT
,	P_duration 	INT
,	P_amount 	DOUBLE
,	P_recived 	DOUBLE
)
BEGIN
	DECLARE amount DOUBLE DEFAULT 0;
    UPDATE feeamount
    SET feeamount.amount = P_amount
    ,	feeamount.recived = P_recived
    ,	feeamount.duration	=	P_duration
    WHERE feeamount.ID = P_ID;
    SELECT 1 AS success;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_SENDMONEY_ALL` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_SENDMONEY_ALL`(
IN 
P_ID VARCHAR(1000),
issuccess VARCHAR(1000)

)
BEGIN
	DECLARE P_customerID INT DEFAULT 0;
    DECLARE amount DOUBLE DEFAULT 0;
    DECLARE P_bonus INT DEFAULT 0;
    DECLARE P_level INT DEFAULT 0;
    
    DECLARE delimiter VARCHAR(4);
    DECLARE a INT Default 0 ;
	DECLARE id VARCHAR(10);
    DECLARE issuccessTmp VARCHAR(10);
    CREATE TEMPORARY TABLE IF NOT EXISTS IdTemp (
		id INT
	,	issuccess INT
    );
	SET delimiter= '	';
	myloop:WHILE 1  DO
         SET a=a+1;
         SET id=SPLIT_STR(P_ID,delimiter,a);
         SET issuccessTmp= SPLIT_STR(issuccess,delimiter,a);
         INSERT INTO IdTemp
         SELECT CONVERT(id,UNSIGNED)
         ,	CONVERT(issuccess,UNSIGNED);
         IF id = '' THEN
         LEAVE  myloop;
         END IF;
    END WHILE;
    UPDATE transaction_gh
    INNER JOIN IdTemp ON
		transaction_gh.ID	=	IdTemp.id
    SET transaction_gh.status = Case
									when transaction_gh.remaining_day - 1 <= 0 THEN 3
                                    else transaction_gh.status
								end
    ,	transaction_gh.remaining_day = transaction_gh.remaining_day - 1
    WHERE transaction_gh.del_flg <> 1;
    
    INSERT INTO  transaction_ph(
		customerID
	,	amount
    ,	level
    ,	senddate
    ,	status
    ,	issuccess
    ,	gh_id
    ,	del_flg
    )
    SELECT
		transaction_gh.CustomerID
	,	(feeamount.recived /feeamount.duration)
    ,	CASE
			WHEN transaction_gh.bonus_from IS NOT NULL AND P_bonus <> 0 THEN 1
            ELSE 0
		END
    ,	NOW()
    ,	0
    ,	IdTemp.issuccess
    ,	IdTemp.id
    ,	0
	FROM IdTemp
    INNER JOIN transaction_gh ON
		IdTemp.id = transaction_gh.ID
	LEFT JOIN feeamount ON
			transaction_gh.transaction_typ = feeamount.transaction_typ
	WHERE transaction_gh.del_flg <> 1;
    
    INSERT INTO sendmoney_his(
		send_date
    )
    SELECT NOW();
    DROp TEMPORARY TABLE IdTemp;
    SELECT 1 As success; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_SEND_ADMIN_TICKET` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_SEND_ADMIN_TICKET`(IN
	P_comment		TEXT
,	P_customerID 	INT
)
BEGIN
	INSERT INTO ticket(
		CustomerID
    ,	question
    ,	senddate
    ,	answer
    ,	status
    )
    SELECT
		P_customerID
	,	P_comment
    ,	NOW()
    ,	''
	,	0;
    SELECT 1 AS success;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_TICKET_ANSWER_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_TICKET_ANSWER_ACT1`(IN
	Id 			INT
,	P_comment	TEXT
)
BEGIN
	UPDATE ticket
    SET ticket.answer = P_comment
    ,	ticket.status = 1
    WHERE ticket.ID = Id;
    SELECT 1 AS success;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_TRANSACTION_ACTIVE_SENDMONEY_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_TRANSACTION_ACTIVE_SENDMONEY_ACT1`(IN
P_id INT,
isactive INT
)
BEGIN
    
	UPDATE transaction_gh
    SET transaction_gh.active_sendmoney = isactive
    WHERE transaction_gh.ID=1*P_id;
		
	SELECT 1 AS success;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_TRANSACTION_APPROVED_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_TRANSACTION_APPROVED_ACT1`(IN
	P_ID	INT
)
BEGIN
 -- START TRANSACTION;
 -- BEGIN 
	DECLARE P_Parent2 INT  DEFAULT 0; -- first nearly
    DECLARE P_Parent1 INT  DEFAULT 0; -- second nearly
    DECLARE P_Root INT  DEFAULT 0; -- Thrid nearly
    DECLARE amountRate DECIMAL(10,6)  DEFAULT 0;
    DECLARE currentAmount DECIMAL(10,6)  DEFAULT 0;
    DECLARE currentDuration INT DEFAULT 0;
    DECLARE customerID INT  DEFAULT 0;
	
    SET SQL_SAFE_UPDATES = 0;
    SET customerID = (
		SELECT transaction_gh.CustomerID
	FROM transaction_gh
	WHERE transaction_gh.ID =  P_ID
	AND transaction_gh.del_flg <> 1
    );
	SET P_Parent2 = (
    SELECT customer.ParentID
	FROM customer
	WHERE customer.ID = customerID);
    
    SET P_Parent1 = (
    SELECT customer.ParentID
	FROM customer
	WHERE customer.ID = P_Parent2);
    
    SET P_Root = (
    SELECT customer.ParentID
	FROM customer
	WHERE customer.ID = P_Parent1);
    
    -- update transaction gh
	UPDATE transaction_gh
    LEFT JOIN feeamount ON
		transaction_gh.transaction_typ= feeamount.transaction_typ
    SET transaction_gh.status = 2 -- confrimed
	,	transaction_gh.remaining_day = feeamount.duration -- duration send money
	,	transaction_gh.active_sendmoney = 1  -- run sendmoney
    WHERE transaction_gh.ID = P_ID
    AND transaction_gh.del_flg <> 1;
    
    SET currentAmount = 
	(SELECT 
		feeamount.amount
	FROM transaction_gh
    LEFT JOIN feeamount ON
		transaction_gh.transaction_typ= feeamount.transaction_typ
    WHERE transaction_gh.ID = P_ID
    AND transaction_gh.del_flg <> 1
    );
    SET currentDuration = (
		SELECT 
		feeamount.duration
		FROM transaction_gh
		LEFT JOIN feeamount ON
			transaction_gh.transaction_typ= feeamount.transaction_typ
		WHERE transaction_gh.ID = P_ID
		AND transaction_gh.del_flg <> 1
    );
   
    /* INSERT BONUS TO Parent2*/
    IF P_Parent2 IS NOT NULL AND P_Parent2 <> 0 THEN
		SET amountRate = (SELECT feeamount.recived FROM feeamount WHERE feeamount.transaction_typ = 4 LIMIT 1);
		INSERT INTO transaction_gh(
			CustomerID
		,	amount
		,	senddate
		,	status
		,	image
		,	transaction_typ
		,	del_flg
        ,	bonus_from
        ,	bonus_from_transgh
        ,	remaining_day
        ,	active_sendmoney
		)
		SELECT
			P_Parent2
		,	CAST(amountRate * currentAmount/100 AS decimal(10,6))
		,	NOW()
		,	2 -- confirmed
		,	''
		,	4 -- bonus from f1
		,	0
        ,	customerID
        ,	P_ID
        ,	currentDuration
		,	1 -- run schedule send money
        FROM feeamount
        WHERE feeamount.transaction_typ = 4;
     
        
	END IF;
    
    /* INSERT BONUS TO Parent 1*/
    IF P_Parent1 IS NOT NULL AND P_Parent1 <> 0 THEN
		SET amountRate = (SELECT feeamount.recived FROM feeamount WHERE feeamount.transaction_typ = 5 LIMIT 1);
        
		INSERT INTO transaction_gh(
			CustomerID
		,	amount
		,	senddate
		,	status
		,	image
		,	transaction_typ
		,	del_flg
        ,	bonus_from
        ,	bonus_from_transgh
        ,	remaining_day
        ,	active_sendmoney
		)
		SELECT
			P_Parent1
		,	CAST(amountRate * currentAmount/100 AS decimal(10,6))
		,	NOW()
		,	2 -- confirmed
		,	''
		,	5 -- bonus from f2
		,	0
        ,	customerID
        ,	P_ID
        ,	currentDuration
		,	1 -- run schedule send money
        FROM feeamount
        WHERE feeamount.transaction_typ = 5;
        

	END IF;
        /* INSERT BONUS TO Proot*/
    IF P_Root IS NOT NULL AND P_Root <> 0 THEN
		SET amountRate = (SELECT feeamount.recived FROM feeamount WHERE feeamount.transaction_typ = 6 LIMIT 1);
       
		INSERT INTO transaction_gh(
			CustomerID
		,	amount
		,	senddate
		,	status
		,	image
		,	transaction_typ
		,	del_flg
        ,	bonus_from
        ,	bonus_from_transgh
        ,	remaining_day
        ,	active_sendmoney
		)
		SELECT
			P_Root
		,	CAST(amountRate * currentAmount/100 AS decimal(10,6))
		,	NOW()
		,	2 -- confirmed
		,	''
		,	6 -- bonus from f3
		,	0
        ,	customerID
        ,	P_ID
        ,	currentDuration
		,	1 -- run schedule send money
        FROM feeamount
        WHERE feeamount.transaction_typ = 6;
	END IF;
    SELECT 1 As success;
     -- END;
    -- COMMIT ;
	 -- ROLLBACK ;  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_TRANSACTION_DELETE_GH_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_TRANSACTION_DELETE_GH_ACT1`(IN
	P_ID	INT
)
BEGIN
	UPDATE  transaction_gh
    SET transaction_gh.del_flg = 1
    WHERE transaction_gh.ID = P_ID;
    --
    UPDATE transaction_ph
    SET transaction_ph.del_flg = 1
    WHERE transaction_ph.gh_id = P_ID;
    SELECT 1 As success;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_TRANSACTION_DELETE_PH_ACT1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_TRANSACTION_DELETE_PH_ACT1`(IN
	P_ID	INT
)
BEGIN
	UPDATE  transaction_gh
    SET transaction_gh.del_flg = 1
    WHERE transaction_gh.ID = P_ID;
    --
    UPDATE transaction_ph
    SET transaction_ph.del_flg = 1
    WHERE transaction_ph.gh_id = P_ID;
    SELECT 1 As success;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SPC_UPDATE_TRANSACTION_GH` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPC_UPDATE_TRANSACTION_GH`(IN
	userID	INT
,	filePath VARCHAR(200)
,	transaction_typ INT
)
BEGIN
	DECLARE amount DOUBLE DEFAULT 0;
    SET amount = (SELECT feeamount.amount FROM feeamount WHERE feeamount.transaction_typ = transaction_typ LIMIT 1);
	INSERT INTO transaction_gh(
		CustomerID
	,	amount
    ,	senddate
    ,	status
    ,	image
    ,	transaction_typ
    ,	del_flg
    )
    SELECT
		userID
	,	amount
    ,	NOW()
    ,	1 -- waiting
    ,	filePath
    ,	transaction_typ
	,	0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-05 19:24:33
