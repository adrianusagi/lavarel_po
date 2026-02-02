-- MySQL dump 10.13  Distrib 9.0.1, for macos15.0 (arm64)
--
-- Host: 127.0.0.1    Database: p2p
-- ------------------------------------------------------
-- Server version	8.4.6

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_p2p_rf_cabang`
--

DROP TABLE IF EXISTS `tb_p2p_rf_cabang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_rf_cabang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_rf_cabang`
--

LOCK TABLES `tb_p2p_rf_cabang` WRITE;
/*!40000 ALTER TABLE `tb_p2p_rf_cabang` DISABLE KEYS */;
INSERT INTO `tb_p2p_rf_cabang` VALUES (1,'Surabaya','570-9196 Torquent Road, Surabaya','1-823-762-4132','p2p','adrian','2026-01-31 14:43:09','p2p','adrian','2026-01-31 14:45:15'),(2,'Malang','Ap #774-4951 In Road','1-734-925-8528','p2p','adrian','2026-01-31 14:44:39',NULL,NULL,NULL),(3,'Jakarta','548-4582 Amet Road','1-354-267-3074','p2p','adrian','2026-01-31 14:45:03',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_p2p_rf_cabang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_rf_options`
--

DROP TABLE IF EXISTS `tb_p2p_rf_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_rf_options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` enum('pr_status','po_status','product_category','receive_condition') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ordering` float DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `configs` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` enum('YES','NO') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_rf_options`
--

LOCK TABLES `tb_p2p_rf_options` WRITE;
/*!40000 ALTER TABLE `tb_p2p_rf_options` DISABLE KEYS */;
INSERT INTO `tb_p2p_rf_options` VALUES (1,'pr_status','Waiting',100,'[default-if-null]',NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(2,'pr_status','Approved',200,'[allow_po]',NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(3,'pr_status','Rejected',300,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(4,'pr_status','Completed',400,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(5,'product_category','IT',NULL,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(6,'product_category','Stationery',NULL,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(7,'product_category','Services',NULL,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(8,'product_category','Packaging',NULL,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(9,'product_category','Raw Material',NULL,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(10,'product_category','Software',NULL,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(11,'product_category','Furniture',NULL,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(12,'po_status','Draft',100,'[default-if-null]',NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(13,'po_status','Sent',200,'[allow_po]',NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(14,'po_status','Partially Received',300,'[allow_po]',NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(15,'po_status','Fulfilled',400,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(16,'po_status','Canceled',500,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(17,'receive_condition','Good',100,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(18,'receive_condition','Damaged',200,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL),(19,'receive_condition','Shortage',300,NULL,NULL,'YES',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_p2p_rf_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_rf_product_catalog`
--

DROP TABLE IF EXISTS `tb_p2p_rf_product_catalog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_rf_product_catalog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` int DEFAULT NULL,
  `default_uom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_price` int DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_rf_product_catalog`
--

LOCK TABLES `tb_p2p_rf_product_catalog` WRITE;
/*!40000 ALTER TABLE `tb_p2p_rf_product_catalog` DISABLE KEYS */;
INSERT INTO `tb_p2p_rf_product_catalog` VALUES (1,'IT-0001','Macbook Air M1',5,'Unit',13000000,'p2p','adrian','2026-02-01 08:38:27',NULL,NULL,NULL),(2,'IT-0002','Macbook Pro 13 M1',5,'Unit',15000000,'p2p','adrian','2026-02-01 08:42:41',NULL,NULL,NULL),(3,'PKG-0001','Card Board 10x30x20',8,'pcs',2500,'p2p','adrian','2026-02-01 08:44:07',NULL,NULL,NULL),(4,'IT-003','Dell 24\" Monitor - UltraSharp',5,'Unit',4500000,'p2p','adrian','2026-02-01 08:46:39',NULL,NULL,NULL),(5,'SW-001','Microsoft 365 Business License',10,'License',250000,'p2p','adrian','2026-02-01 08:48:10',NULL,NULL,NULL),(6,'OF-001','A4 Paper 80gsm (Sinar Dunia)',6,'Box',285000,'p2p','adrian','2026-02-01 08:48:42',NULL,NULL,NULL),(7,'OF-002','Standard Ballpoint Pen (Black)',6,'Pack',25000,'p2p','adrian','2026-02-01 08:49:12',NULL,NULL,NULL),(8,'FN-001','Ergonomic Office Chair - Mesh',11,'Unit',2200000,'p2p','adrian','2026-02-01 08:49:52',NULL,NULL,NULL),(9,'FN-002','Standing Desk (Electric)',11,'Unit',5500000,'p2p','adrian','2026-02-01 08:50:19','p2p','adrian','2026-02-01 14:01:35'),(10,'SV-001','Daily Catering (Lunch Box)',7,'Pax',45000,'p2p','adrian','2026-02-01 08:50:48',NULL,NULL,NULL),(11,'SV-002','Express Courier Service (Jabodetabek)',7,'Trip',15000,'p2p','adrian','2026-02-01 08:51:23',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_p2p_rf_product_catalog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_rf_suppliers`
--

DROP TABLE IF EXISTS `tb_p2p_rf_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_rf_suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tax_id` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_terms` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `office_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_rf_suppliers`
--

LOCK TABLES `tb_p2p_rf_suppliers` WRITE;
/*!40000 ALTER TABLE `tb_p2p_rf_suppliers` DISABLE KEYS */;
INSERT INTO `tb_p2p_rf_suppliers` VALUES (2,'CV. Alat Tulis Makmur','VEND-002',NULL,'Office Supplies','COD','Ani Wijaya','orders@atkmakmur.com','+62 31 888 4321','Jl. Raya Manyar No. 45, Surabaya','p2p','adrian','2026-01-31 20:32:50',NULL,NULL,NULL),(3,'PT. Katering Sejahtera','VEND-003',NULL,'F&B / Services','Net 15','Siti Aminah','info@kateringsejahtera.id','+62 21 777 9900','Kawasan Industri Pulogadung Block C, Jakarta Timur','p2p','adrian','2026-01-31 20:34:23',NULL,NULL,NULL),(6,'PT. Global Teknologi Solusi','VEND-001',NULL,'IT Hardware	sale','Net 7',NULL,'sales@globaltek.co.id',NULL,NULL,'p2p','adrian','2026-02-02 05:32:08',NULL,NULL,NULL),(7,'Surya Furniture & Interior','VEND-004',NULL,'Furniture','Net 30','marketing@surya-furni.com',NULL,NULL,NULL,'p2p','adrian','2026-02-02 05:32:46','p2p','adrian','2026-02-02 05:32:57'),(8,'PT. Logistik Cepat Indonesia','VEND-005',NULL,'Courier/Logistics','Net 7',NULL,'cs@logistikcepat.id',NULL,NULL,'p2p','adrian','2026-02-02 05:33:27',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_p2p_rf_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_tr_po_items`
--

DROP TABLE IF EXISTS `tb_p2p_tr_po_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_tr_po_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_order` int DEFAULT NULL,
  `pr_item` int DEFAULT NULL,
  `product_catalog` int DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `uom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_p2p_tr_po_items_tb_p2p_tr_purchase_order_FK` (`purchase_order`),
  KEY `tb_p2p_tr_po_items_tb_p2p_rf_product_catalog_FK` (`product_catalog`),
  KEY `tb_p2p_tr_po_items_tb_p2p_tr_[r_items_FK` (`pr_item`),
  CONSTRAINT `tb_p2p_tr_po_items_tb_p2p_rf_product_catalog_FK` FOREIGN KEY (`product_catalog`) REFERENCES `tb_p2p_rf_product_catalog` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tb_p2p_tr_po_items_tb_p2p_tr_[r_items_FK` FOREIGN KEY (`pr_item`) REFERENCES `tb_p2p_tr_pr_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_p2p_tr_po_items_tb_p2p_tr_purchase_order_FK` FOREIGN KEY (`purchase_order`) REFERENCES `tb_p2p_tr_purchase_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_tr_po_items`
--

LOCK TABLES `tb_p2p_tr_po_items` WRITE;
/*!40000 ALTER TABLE `tb_p2p_tr_po_items` DISABLE KEYS */;
INSERT INTO `tb_p2p_tr_po_items` VALUES (2,7,3,2,2,'Unit',15000000,'p2p','adrian','2026-02-01 18:53:52','p2p','adrian','2026-02-02 04:08:09'),(3,7,11,4,1,'Unit',5000000,'p2p','adrian','2026-02-01 18:53:52','p2p','adrian','2026-02-02 04:08:09'),(4,7,NULL,3,15,'pcs',2500,'p2p','adrian','2026-02-01 18:54:50','p2p','adrian','2026-02-02 04:08:09'),(5,8,17,8,1,'Unit',2200000,'p2p','adrian','2026-02-02 05:37:43',NULL,NULL,NULL),(6,8,18,9,2,'Unit',5500000,'p2p','adrian','2026-02-02 05:37:43',NULL,NULL,NULL),(7,9,19,5,1,'License',250000,'p2p','adrian','2026-02-02 05:38:10',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_p2p_tr_po_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_tr_pr_items`
--

DROP TABLE IF EXISTS `tb_p2p_tr_pr_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_tr_pr_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_request` int DEFAULT NULL,
  `product_catalog` int DEFAULT NULL,
  `item` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `uom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `est_price` int DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_p2p_tr_pr_items_tb_p2p_tr_purchase_request_FK` (`purchase_request`),
  KEY `tb_p2p_tr_pr_items_tb_p2p_rf_product_catalog_FK` (`product_catalog`),
  CONSTRAINT `tb_p2p_tr_pr_items_tb_p2p_rf_product_catalog_FK` FOREIGN KEY (`product_catalog`) REFERENCES `tb_p2p_rf_product_catalog` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tb_p2p_tr_pr_items_tb_p2p_tr_purchase_request_FK` FOREIGN KEY (`purchase_request`) REFERENCES `tb_p2p_tr_purchase_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_tr_pr_items`
--

LOCK TABLES `tb_p2p_tr_pr_items` WRITE;
/*!40000 ALTER TABLE `tb_p2p_tr_pr_items` DISABLE KEYS */;
INSERT INTO `tb_p2p_tr_pr_items` VALUES (3,1,NULL,'Macbook pro 14',2,'pcs',25000000,'p2p','adrian','2026-02-01 04:26:34','p2p','adrian','2026-02-01 13:56:40'),(5,1,NULL,'iphone 14',1,'pcs',8000000,'p2p','adrian','2026-02-01 05:25:03','p2p','adrian','2026-02-01 13:56:40'),(7,20,NULL,'MacBook Air M2 13',1,'unit',15000000,'p2p','adrian','2026-02-01 05:32:40','p2p','adrian','2026-02-01 07:49:20'),(8,20,NULL,'Magic Mouse 2',2,'pcs',1250000,'p2p','adrian','2026-02-01 05:32:40','p2p','adrian','2026-02-01 07:49:20'),(9,20,NULL,'USB-C Hub Adapter',4,'pcs',350000,'p2p','adrian','2026-02-01 05:32:40','p2p','adrian','2026-02-01 07:49:20'),(10,8,6,NULL,5,'lusin',20000,'p2p','adrian','2026-02-01 07:32:46','p2p','adrian','2026-02-02 05:36:14'),(11,1,4,NULL,1,'Unit',4500000,'p2p','adrian','2026-02-01 13:56:40',NULL,NULL,NULL),(14,2,8,NULL,1,'Unit',2200000,'p2p','adrian','2026-02-01 14:00:11',NULL,NULL,NULL),(15,2,9,NULL,1,'Standing Desk (Electric)',5500000,'p2p','adrian','2026-02-01 14:00:11',NULL,NULL,NULL),(16,3,10,NULL,20,'Pax',45000,'p2p','adrian','2026-02-01 14:02:23',NULL,NULL,NULL),(17,4,8,NULL,1,'Unit',2200000,'p2p','adrian','2026-02-02 05:34:47',NULL,NULL,NULL),(18,4,9,NULL,2,'Unit',5500000,'p2p','adrian','2026-02-02 05:34:47',NULL,NULL,NULL),(19,5,5,NULL,1,'License',250000,'p2p','adrian','2026-02-02 05:35:35',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_p2p_tr_pr_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_tr_purchase_order`
--

DROP TABLE IF EXISTS `tb_p2p_tr_purchase_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_tr_purchase_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_request` int DEFAULT NULL,
  `po_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `purchasing_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `supplier` int DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ship_via` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_due` date DEFAULT NULL,
  `sub_total` int DEFAULT NULL,
  `vat_percent` int DEFAULT NULL,
  `vat` int DEFAULT NULL,
  `ship_cost` int DEFAULT NULL,
  `grand_total` int DEFAULT NULL,
  `other_cost` int DEFAULT NULL,
  `note_instruction` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_p2p_tr_purchase_order_tb_p2p_tr_purchase_request_FK` (`purchase_request`),
  KEY `tb_p2p_tr_purchase_order_tb_p2p_rf_suppliers_FK` (`supplier`),
  KEY `tb_p2p_tr_purchase_order_tb_p2p_rf_options_FK` (`status`),
  CONSTRAINT `tb_p2p_tr_purchase_order_tb_p2p_rf_options_FK` FOREIGN KEY (`status`) REFERENCES `tb_p2p_rf_options` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tb_p2p_tr_purchase_order_tb_p2p_rf_suppliers_FK` FOREIGN KEY (`supplier`) REFERENCES `tb_p2p_rf_suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tb_p2p_tr_purchase_order_tb_p2p_tr_purchase_request_FK` FOREIGN KEY (`purchase_request`) REFERENCES `tb_p2p_tr_purchase_request` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_tr_purchase_order`
--

LOCK TABLES `tb_p2p_tr_purchase_order` WRITE;
/*!40000 ALTER TABLE `tb_p2p_tr_purchase_order` DISABLE KEYS */;
INSERT INTO `tb_p2p_tr_purchase_order` VALUES (7,1,'PO-2026-02-001','2026-02-02','Procurement Dept',2,'Jl. Jendral Sudirman No. 1, Jakarta','JNE Truck','2026-02-25',35037500,11,3854125,150000,39291625,250000,'Handle with care',13,'p2p','adrian','2026-02-01 18:53:49','p2p','adrian','2026-02-02 04:08:09'),(8,4,'PO-2026-02-003','2026-02-02','Procurement Dept',7,'Kantor','JNE Truck','2026-02-12',13200000,NULL,0,NULL,13200000,NULL,'Dirakit sekalian di kantor',13,'p2p','adrian','2026-02-02 05:37:43',NULL,NULL,NULL),(9,5,'PO-2026-02-003','2026-02-02','Procurement Dept',6,'-','License only','2026-02-02',250000,NULL,0,NULL,250000,NULL,NULL,13,'p2p','adrian','2026-02-02 05:38:10',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_p2p_tr_purchase_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_tr_purchase_request`
--

DROP TABLE IF EXISTS `tb_p2p_tr_purchase_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_tr_purchase_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pr_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `requestor_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `requestor_dept` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `branch` int DEFAULT NULL,
  `date_of_request` date DEFAULT NULL,
  `date_needed` date DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ship_to` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prefered_supplier` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_p2p_tr_purchase_request_tb_p2p_rf_cabang_FK` (`branch`),
  KEY `tb_p2p_tr_purchase_request_tb_p2p_rf_suppliers_FK` (`prefered_supplier`),
  KEY `tb_p2p_tr_purchase_request_tb_p2p_tr_rf_options_FK` (`status`),
  CONSTRAINT `tb_p2p_tr_purchase_request_tb_p2p_rf_cabang_FK` FOREIGN KEY (`branch`) REFERENCES `tb_p2p_rf_cabang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tb_p2p_tr_purchase_request_tb_p2p_rf_suppliers_FK` FOREIGN KEY (`prefered_supplier`) REFERENCES `tb_p2p_rf_suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tb_p2p_tr_purchase_request_tb_p2p_tr_rf_options_FK` FOREIGN KEY (`status`) REFERENCES `tb_p2p_rf_options` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_tr_purchase_request`
--

LOCK TABLES `tb_p2p_tr_purchase_request` WRITE;
/*!40000 ALTER TABLE `tb_p2p_tr_purchase_request` DISABLE KEYS */;
INSERT INTO `tb_p2p_tr_purchase_request` VALUES (1,'2026/01/31/IT/001','Ahmad Rianto','IT',3,'2026-02-01','2026-02-07','For new Software Engineer hire.','Jakarta HQ',2,2,NULL,NULL,NULL,'p2p','adrian','2026-02-01 13:56:40'),(2,'2026/01/31/IT/002','John Doe','FAT',2,'2026-02-01','2026-02-14',NULL,NULL,NULL,NULL,'p2p','adrian','2026-01-31 08:07:30','p2p','adrian','2026-02-01 14:00:11'),(3,'2026/01/31/IT/003','Amir Kahn','Marketing',1,NULL,NULL,NULL,NULL,NULL,NULL,'p2p','adrian','2026-01-31 08:10:52','p2p','adrian','2026-02-01 14:02:23'),(4,'2026/01/31/IT/004','Sarah Wijaya','HR',3,'2026-02-02','2026-02-02',NULL,'Jakarta HQ',7,2,'p2p','adrian','2026-01-31 08:11:39','p2p','adrian','2026-02-02 05:34:47'),(5,'2026/01/31/IT/005','Kevin Leon','IT',2,'2026-02-02','2026-02-02','For new Software Engineer hire.','-',6,2,'p2p','adrian','2026-01-31 08:31:10','p2p','adrian','2026-02-02 05:35:35'),(8,'2026/01/31/IT/006','Budi Rahardjo','Operations',3,'2026-02-02','2026-02-02','habis bos','Jakarta HQ',2,2,'p2p','adrian','2026-01-31 08:33:36','p2p','adrian','2026-02-02 05:36:14'),(20,'PR/2026/02/001','Budi Santoso','Information Technology',3,'2026-02-01','2026-02-01',NULL,NULL,NULL,2,'p2p','adrian','2026-02-01 05:32:40','p2p','adrian','2026-02-01 07:49:20');
/*!40000 ALTER TABLE `tb_p2p_tr_purchase_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_tr_receive_order`
--

DROP TABLE IF EXISTS `tb_p2p_tr_receive_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_tr_receive_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_order` int DEFAULT NULL,
  `wo_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `receipt_date` date DEFAULT NULL,
  `receipt_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delivery_note` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_p2p_tr_receive_order_tb_p2p_tr_purchase_order_FK` (`purchase_order`),
  CONSTRAINT `tb_p2p_tr_receive_order_tb_p2p_tr_purchase_order_FK` FOREIGN KEY (`purchase_order`) REFERENCES `tb_p2p_tr_purchase_order` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_tr_receive_order`
--

LOCK TABLES `tb_p2p_tr_receive_order` WRITE;
/*!40000 ALTER TABLE `tb_p2p_tr_receive_order` DISABLE KEYS */;
INSERT INTO `tb_p2p_tr_receive_order` VALUES (3,7,'GR-2026-02-12','2026-02-02','Aris Munandar (Warehouse Team)','SJ-GTS-9981','All goods','p2p','adrian','2026-02-02 05:12:22','p2p','adrian','2026-02-02 05:30:01');
/*!40000 ALTER TABLE `tb_p2p_tr_receive_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_p2p_tr_ro_items`
--

DROP TABLE IF EXISTS `tb_p2p_tr_ro_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_p2p_tr_ro_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receive_order` int DEFAULT NULL,
  `po_item` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `condition` int DEFAULT NULL,
  `created_app` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_app` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_p2p_tr_ro_items`
--

LOCK TABLES `tb_p2p_tr_ro_items` WRITE;
/*!40000 ALTER TABLE `tb_p2p_tr_ro_items` DISABLE KEYS */;
INSERT INTO `tb_p2p_tr_ro_items` VALUES (1,3,2,2,17,'p2p','adrian','2026-02-02 05:12:22','p2p','adrian','2026-02-02 05:30:01'),(2,3,3,1,17,'p2p','adrian','2026-02-02 05:12:22','p2p','adrian','2026-02-02 05:30:01'),(3,3,4,15,17,'p2p','adrian','2026-02-02 05:12:22','p2p','adrian','2026-02-02 05:30:01');
/*!40000 ALTER TABLE `tb_p2p_tr_ro_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'p2p'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-02 14:46:35
