-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: phishguard
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_verifications` int DEFAULT '0',
  `malicious_count` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'runtime_user_1763616208718','runtime_user_1763616208718@local','auto_generated','000000000',0,0),(2,'runtime_user_1763616437319','runtime_user_1763616437319@local','auto_generated','000000000',0,0),(3,'runtime_user_1763616672432','runtime_user_1763616672432@local','auto_generated','000000000',1,0),(4,'runtime_user_1763617242824','runtime_user_1763617242824@local','auto_generated','000000000',4,0),(5,'runtime_user_1763618062498','runtime_user_1763618062498@local','auto_generated','000000000',2,0),(6,'runtime_user_1763618349842','runtime_user_1763618349842@local','auto_generated','000000000',1,0),(7,'runtime_user_1763618895544','runtime_user_1763618895544@local','auto_generated','000000000',0,0),(8,'runtime_user_1763619324429','runtime_user_1763619324429@local','auto_generated','000000000',0,0),(9,'runtime_user_1763619726807','runtime_user_1763619726807@local','auto_generated','000000000',1,0),(10,'runtime_user_1763619901390','runtime_user_1763619901390@local','auto_generated','000000000',1,0),(11,'runtime_user_1763620194604','runtime_user_1763620194604@local','auto_generated','000000000',1,0),(12,'runtime_user_1763674190514','runtime_user_1763674190514@local','auto_generated','000000000',0,0),(13,'runtime_user_1763685313878','runtime_user_1763685313878@local','auto_generated','000000000',1,0),(14,'runtime_user_1763685524775','runtime_user_1763685524775@local','auto_generated','000000000',4,0),(15,'runtime_user_1763714198258','runtime_user_1763714198258@local','auto_generated','000000000',0,0),(16,'runtime_user_1763714321744','runtime_user_1763714321744@local','auto_generated','000000000',0,0),(17,'runtime_user_1763714554711','runtime_user_1763714554711@local','auto_generated','000000000',0,0),(18,'Seed User 1','seed1@local','pass123','1199000001',0,0),(19,'Seed User 2','seed2@local','pass123','1199000002',0,0),(20,'Seed User 3','seed3@local','pass123','1199000003',0,0),(21,'Seed User 4','seed4@local','pass123','1199000004',0,0),(22,'Seed User 5','seed5@local','pass123','1199000005',0,0),(23,'Seed User 6','seed6@local','pass123','1199000006',0,0),(24,'Seed User 7','seed7@local','pass123','1199000007',0,0),(25,'Seed User 8','seed8@local','pass123','1199000008',0,0),(26,'Seed User 9','seed9@local','pass123','1199000009',0,0),(27,'Seed User 10','seed10@local','pass123','1199000010',0,0),(28,'Seed User 11','seed11@local','pass123','1199000011',0,0),(29,'Seed User 12','seed12@local','pass123','1199000012',0,0),(30,'Seed User 13','seed13@local','pass123','1199000013',0,0),(31,'Seed User 14','seed14@local','pass123','1199000014',0,0),(32,'Seed User 15','seed15@local','pass123','1199000015',0,0),(33,'Seed User 16','seed16@local','pass123','1199000016',0,0),(34,'Seed User 17','seed17@local','pass123','1199000017',0,0),(35,'Seed User 18','seed18@local','pass123','1199000018',0,0),(36,'Seed User 19','seed19@local','pass123','1199000019',0,0),(37,'Seed User 20','seed20@local','pass123','1199000020',0,0),(38,'Seed User 21','seed21@local','pass123','1199000021',0,0),(39,'Seed User 22','seed22@local','pass123','1199000022',0,0),(40,'Seed User 23','seed23@local','pass123','1199000023',0,0),(41,'Seed User 24','seed24@local','pass123','1199000024',0,0),(42,'Seed User 25','seed25@local','pass123','1199000025',0,0),(43,'Seed User 26','seed26@local','pass123','1199000026',0,0),(44,'Seed User 27','seed27@local','pass123','1199000027',0,0),(45,'Seed User 28','seed28@local','pass123','1199000028',0,0),(46,'Seed User 29','seed29@local','pass123','1199000029',0,0),(47,'Seed User 30','seed30@local','pass123','1199000030',0,0),(48,'Seed User 31','seed31@local','pass123','1199000031',0,0),(49,'Seed User 32','seed32@local','pass123','1199000032',0,0),(50,'Seed User 33','seed33@local','pass123','1199000033',0,0),(51,'Seed User 34','seed34@local','pass123','1199000034',0,0),(52,'Seed User 35','seed35@local','pass123','1199000035',0,0),(53,'Seed User 36','seed36@local','pass123','1199000036',0,0),(54,'Seed User 37','seed37@local','pass123','1199000037',0,0),(55,'Seed User 38','seed38@local','pass123','1199000038',0,0),(56,'Seed User 39','seed39@local','pass123','1199000039',0,0),(57,'Seed User 40','seed40@local','pass123','1199000040',0,0),(58,'Seed User 41','seed41@local','pass123','1199000041',0,0),(59,'Seed User 42','seed42@local','pass123','1199000042',0,0),(60,'Seed User 43','seed43@local','pass123','1199000043',0,0),(61,'Seed User 44','seed44@local','pass123','1199000044',0,0),(62,'Seed User 45','seed45@local','pass123','1199000045',0,0),(63,'Seed User 46','seed46@local','pass123','1199000046',0,0),(64,'Seed User 47','seed47@local','pass123','1199000047',0,0),(65,'Seed User 48','seed48@local','pass123','1199000048',0,0),(66,'Seed User 49','seed49@local','pass123','1199000049',0,0),(67,'Seed User 50','seed50@local','pass123','1199000050',0,0),(68,'Seed User 51','seed51@local','pass123','1199000051',0,0),(69,'Seed User 52','seed52@local','pass123','1199000052',0,0),(70,'Seed User 53','seed53@local','pass123','1199000053',0,0),(71,'Seed User 54','seed54@local','pass123','1199000054',0,0),(72,'Seed User 55','seed55@local','pass123','1199000055',0,0),(73,'Seed User 56','seed56@local','pass123','1199000056',0,0),(74,'Seed User 57','seed57@local','pass123','1199000057',0,0),(75,'Seed User 58','seed58@local','pass123','1199000058',0,0),(76,'Seed User 59','seed59@local','pass123','1199000059',0,0),(77,'Seed User 60','seed60@local','pass123','1199000060',0,0),(78,'Seed User 61','seed61@local','pass123','1199000061',0,0),(79,'Seed User 62','seed62@local','pass123','1199000062',0,0),(80,'Seed User 63','seed63@local','pass123','1199000063',0,0),(81,'Seed User 64','seed64@local','pass123','1199000064',0,0),(82,'Seed User 65','seed65@local','pass123','1199000065',0,0),(83,'Seed User 66','seed66@local','pass123','1199000066',0,0),(84,'Seed User 67','seed67@local','pass123','1199000067',0,0),(85,'Seed User 68','seed68@local','pass123','1199000068',0,0),(86,'Seed User 69','seed69@local','pass123','1199000069',0,0),(87,'Seed User 70','seed70@local','pass123','1199000070',0,0),(88,'Seed User 71','seed71@local','pass123','1199000071',0,0),(89,'Seed User 72','seed72@local','pass123','1199000072',0,0),(90,'Seed User 73','seed73@local','pass123','1199000073',0,0),(91,'Seed User 74','seed74@local','pass123','1199000074',0,0),(92,'Seed User 75','seed75@local','pass123','1199000075',0,0),(93,'Seed User 76','seed76@local','pass123','1199000076',0,0),(94,'Seed User 77','seed77@local','pass123','1199000077',0,0),(95,'Seed User 78','seed78@local','pass123','1199000078',0,0),(96,'Seed User 79','seed79@local','pass123','1199000079',0,0),(97,'Seed User 80','seed80@local','pass123','1199000080',0,0),(98,'Seed User 81','seed81@local','pass123','1199000081',0,0),(99,'Seed User 82','seed82@local','pass123','1199000082',0,0),(100,'Seed User 83','seed83@local','pass123','1199000083',0,0),(101,'Seed User 84','seed84@local','pass123','1199000084',0,0),(102,'Seed User 85','seed85@local','pass123','1199000085',0,0),(103,'Seed User 86','seed86@local','pass123','1199000086',0,0),(104,'Seed User 87','seed87@local','pass123','1199000087',0,0),(105,'Seed User 88','seed88@local','pass123','1199000088',0,0),(106,'Seed User 89','seed89@local','pass123','1199000089',0,0),(107,'Seed User 90','seed90@local','pass123','1199000090',0,0),(108,'Seed User 91','seed91@local','pass123','1199000091',0,0),(109,'Seed User 92','seed92@local','pass123','1199000092',0,0),(110,'Seed User 93','seed93@local','pass123','1199000093',0,0),(111,'Seed User 94','seed94@local','pass123','1199000094',0,0),(112,'Seed User 95','seed95@local','pass123','1199000095',0,0),(113,'Seed User 96','seed96@local','pass123','1199000096',0,0),(114,'Seed User 97','seed97@local','pass123','1199000097',0,0),(115,'Seed User 98','seed98@local','pass123','1199000098',0,0),(116,'Seed User 99','seed99@local','pass123','1199000099',0,0),(117,'Seed User 100','seed100@local','pass123','1199000100',0,0),(118,'runtime_user_1763716965801','runtime_user_1763716965801@local','auto_generated','000000000',0,0),(119,'runtime_user_1763757102913','runtime_user_1763757102913@local','auto_generated','000000000',3,0),(120,'runtime_user_1763758991584','runtime_user_1763758991584@local','auto_generated','000000000',0,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-21 18:53:54
