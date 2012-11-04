-- MySQL dump 10.13  Distrib 5.5.25a, for Win32 (x86)
--
-- Host: localhost    Database: gbiz
-- ------------------------------------------------------
-- Server version	5.5.25a

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
-- Table structure for table `_sys_autoids`
--

DROP TABLE IF EXISTS `_sys_autoids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_sys_autoids` (
  `tb_inau` varchar(255) NOT NULL,
  `counter` int(11) unsigned NOT NULL DEFAULT '1',
  `lock` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tb_inau`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `_sys_orderstatus`
--

DROP TABLE IF EXISTS `_sys_orderstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_sys_orderstatus` (
  `id` int(2) NOT NULL,
  `order_status_id` varchar(20) NOT NULL,
  `progession_id` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `_sys_pagesizes`
--

DROP TABLE IF EXISTS `_sys_pagesizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_sys_pagesizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `format_id` varchar(50) NOT NULL,
  `dip_width` float(10,3) NOT NULL,
  `dip_height` float(10,3) NOT NULL,
  `inch_width` float(10,3) NOT NULL,
  `inch_height` float(10,3) NOT NULL,
  `mm_width` float(10,3) NOT NULL,
  `mm_height` float(10,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `batchinvoicedetails`
--

DROP TABLE IF EXISTS `batchinvoicedetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchinvoicedetails` (
  `id` int(11) unsigned NOT NULL,
  `batch_id` varchar(16) NOT NULL,
  `invoice_id` int(11) unsigned NOT NULL,
  `alt_invoice_id` int(11) unsigned NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `order_date` date NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `order_details` varchar(255) NOT NULL,
  `extended_total` float(16,2) NOT NULL,
  `tax_total` float(16,2) NOT NULL,
  `order_total` float(16,2) NOT NULL,
  `payment_total` float(16,2) NOT NULL,
  `balance` float(16,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `batchinvoicedetails_hs`
--

DROP TABLE IF EXISTS `batchinvoicedetails_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchinvoicedetails_hs` (
  `id` int(11) unsigned NOT NULL,
  `batch_id` varchar(16) NOT NULL,
  `invoice_id` int(11) unsigned NOT NULL,
  `alt_invoice_id` int(11) unsigned NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `order_date` date NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `order_details` varchar(255) NOT NULL,
  `extended_total` float(16,2) NOT NULL,
  `tax_total` float(16,2) NOT NULL,
  `order_total` float(16,2) NOT NULL,
  `payment_total` float(16,2) NOT NULL,
  `balance` float(16,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `batchinvoicedetails_is`
--

DROP TABLE IF EXISTS `batchinvoicedetails_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchinvoicedetails_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` varchar(16) DEFAULT NULL,
  `invoice_id` int(11) unsigned DEFAULT NULL,
  `alt_invoice_id` int(11) unsigned DEFAULT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `order_details` varchar(255) DEFAULT NULL,
  `extended_total` float(16,2) DEFAULT NULL,
  `tax_total` float(16,2) DEFAULT NULL,
  `order_total` float(16,2) DEFAULT NULL,
  `payment_total` float(16,2) DEFAULT NULL,
  `balance` float(16,2) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1221 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `batchinvoices`
--

DROP TABLE IF EXISTS `batchinvoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchinvoices` (
  `id` int(11) unsigned NOT NULL,
  `batch_id` varchar(16) NOT NULL,
  `batch_date` date NOT NULL,
  `batch_description` varchar(255) NOT NULL,
  `batch_type` varchar(50) NOT NULL,
  `batch_details` text NOT NULL,
  `comments` text NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_batch_id` (`batch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `batchinvoices_hs`
--

DROP TABLE IF EXISTS `batchinvoices_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchinvoices_hs` (
  `id` int(11) unsigned NOT NULL,
  `batch_id` varchar(16) NOT NULL,
  `batch_date` date NOT NULL,
  `batch_description` varchar(255) NOT NULL,
  `batch_type` varchar(50) NOT NULL,
  `batch_details` text NOT NULL,
  `comments` text NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `batchinvoices_is`
--

DROP TABLE IF EXISTS `batchinvoices_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batchinvoices_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` varchar(16) DEFAULT NULL,
  `batch_date` date DEFAULT NULL,
  `batch_description` varchar(255) DEFAULT NULL,
  `batch_type` varchar(50) DEFAULT NULL,
  `batch_details` text,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_batch_id` (`batch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` int(11) unsigned NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `region_id` int(11) unsigned NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `branches_hs`
--

DROP TABLE IF EXISTS `branches_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches_hs` (
  `id` int(11) unsigned NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `region_id` int(11) unsigned NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `branches_is`
--

DROP TABLE IF EXISTS `branches_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `region_id` int(11) unsigned DEFAULT NULL,
  `active` enum('Y','N') DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `certofinstallations`
--

DROP TABLE IF EXISTS `certofinstallations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certofinstallations` (
  `id` int(11) unsigned NOT NULL,
  `certificate_id` varchar(20) NOT NULL,
  `certificate_status` enum('ACTIVE','RETIRED','EXPIRED') NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `chassis_number` varchar(100) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vehicle_make` varchar(50) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `vehicle_colour` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `installation_type` varchar(50) NOT NULL,
  `device_model` varchar(50) NOT NULL,
  `device_serial_no` varchar(50) NOT NULL,
  `expiry_date` date NOT NULL,
  `issue_date` date NOT NULL,
  `commisioning_fld01` varchar(3) NOT NULL,
  `commisioning_fld02` varchar(3) NOT NULL,
  `commisioning_fld03` varchar(3) NOT NULL,
  `commisioning_fld04` varchar(3) NOT NULL,
  `commisioning_fld05` varchar(3) NOT NULL,
  `commisioning_fld06` varchar(3) NOT NULL,
  `commisioning_fld07` varchar(3) NOT NULL,
  `commisioning_fld08` varchar(3) NOT NULL,
  `commisioning_fld09` varchar(3) NOT NULL,
  `commisioning_fld10` varchar(3) NOT NULL,
  `commisioning_fld11` varchar(3) NOT NULL,
  `commisioning_fld12` varchar(3) NOT NULL,
  `usrinstr_fld01` varchar(3) NOT NULL,
  `usrinstr_fld02` varchar(3) NOT NULL,
  `usrinstr_fld03` varchar(3) NOT NULL,
  `usrinstr_fld04` varchar(3) NOT NULL,
  `usrinstr_fld05` varchar(3) NOT NULL,
  `usrinstr_fld06` varchar(3) NOT NULL,
  `usrinstr_fld07` varchar(3) NOT NULL,
  `usrinstr_fld08` varchar(3) NOT NULL,
  `usrinstr_fld09` varchar(3) NOT NULL,
  `usrinstr_fld10` varchar(3) NOT NULL,
  `usrinstr_fld11` varchar(3) NOT NULL,
  `usrinstr_fld12` varchar(3) NOT NULL,
  `variations` varchar(255) NOT NULL,
  `validation_period` varchar(50) NOT NULL,
  `signature_name` varchar(50) NOT NULL,
  `signature_position` varchar(50) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_certificate_id` (`certificate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `certofinstallations_hs`
--

DROP TABLE IF EXISTS `certofinstallations_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certofinstallations_hs` (
  `id` int(11) unsigned NOT NULL,
  `certificate_id` varchar(20) NOT NULL,
  `certificate_status` enum('ACTIVE','RETIRED','EXPIRED') NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `chassis_number` varchar(100) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vehicle_make` varchar(50) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `vehicle_colour` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `installation_type` varchar(50) NOT NULL,
  `device_model` varchar(50) NOT NULL,
  `device_serial_no` varchar(50) NOT NULL,
  `expiry_date` date NOT NULL,
  `issue_date` date NOT NULL,
  `commisioning_fld01` varchar(3) NOT NULL,
  `commisioning_fld02` varchar(3) NOT NULL,
  `commisioning_fld03` varchar(3) NOT NULL,
  `commisioning_fld04` varchar(3) NOT NULL,
  `commisioning_fld05` varchar(3) NOT NULL,
  `commisioning_fld06` varchar(3) NOT NULL,
  `commisioning_fld07` varchar(3) NOT NULL,
  `commisioning_fld08` varchar(3) NOT NULL,
  `commisioning_fld09` varchar(3) NOT NULL,
  `commisioning_fld10` varchar(3) NOT NULL,
  `commisioning_fld11` varchar(3) NOT NULL,
  `commisioning_fld12` varchar(3) NOT NULL,
  `usrinstr_fld01` varchar(3) NOT NULL,
  `usrinstr_fld02` varchar(3) NOT NULL,
  `usrinstr_fld03` varchar(3) NOT NULL,
  `usrinstr_fld04` varchar(3) NOT NULL,
  `usrinstr_fld05` varchar(3) NOT NULL,
  `usrinstr_fld06` varchar(3) NOT NULL,
  `usrinstr_fld07` varchar(3) NOT NULL,
  `usrinstr_fld08` varchar(3) NOT NULL,
  `usrinstr_fld09` varchar(3) NOT NULL,
  `usrinstr_fld10` varchar(3) NOT NULL,
  `usrinstr_fld11` varchar(3) NOT NULL,
  `usrinstr_fld12` varchar(3) NOT NULL,
  `variations` varchar(255) NOT NULL,
  `validation_period` varchar(50) NOT NULL,
  `signature_name` varchar(50) NOT NULL,
  `signature_position` varchar(50) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `certofinstallations_is`
--

DROP TABLE IF EXISTS `certofinstallations_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certofinstallations_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `certificate_id` varchar(20) DEFAULT NULL,
  `certificate_status` enum('ACTIVE','RETIRED','EXPIRED') DEFAULT 'ACTIVE',
  `vehicle_id` varchar(50) DEFAULT NULL,
  `chassis_number` varchar(100) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_make` varchar(50) DEFAULT NULL,
  `vehicle_model` varchar(50) DEFAULT NULL,
  `vehicle_colour` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `installation_type` varchar(50) DEFAULT 'New',
  `device_model` varchar(50) DEFAULT NULL,
  `device_serial_no` varchar(50) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `commisioning_fld01` varchar(3) DEFAULT 'yes',
  `commisioning_fld02` varchar(3) DEFAULT 'yes',
  `commisioning_fld03` varchar(3) DEFAULT 'yes',
  `commisioning_fld04` varchar(3) DEFAULT 'yes',
  `commisioning_fld05` varchar(3) DEFAULT 'yes',
  `commisioning_fld06` varchar(3) DEFAULT 'yes',
  `commisioning_fld07` varchar(3) DEFAULT 'yes',
  `commisioning_fld08` varchar(3) DEFAULT 'yes',
  `commisioning_fld09` varchar(3) DEFAULT 'yes',
  `commisioning_fld10` varchar(3) DEFAULT 'n/a',
  `commisioning_fld11` varchar(3) DEFAULT 'yes',
  `commisioning_fld12` varchar(3) DEFAULT 'yes',
  `usrinstr_fld01` varchar(3) DEFAULT 'yes',
  `usrinstr_fld02` varchar(3) DEFAULT 'yes',
  `usrinstr_fld03` varchar(3) DEFAULT 'yes',
  `usrinstr_fld04` varchar(3) DEFAULT 'yes',
  `usrinstr_fld05` varchar(3) DEFAULT 'yes',
  `usrinstr_fld06` varchar(3) DEFAULT 'yes',
  `usrinstr_fld07` varchar(3) DEFAULT 'n/a',
  `usrinstr_fld08` varchar(3) DEFAULT 'n/a',
  `usrinstr_fld09` varchar(3) DEFAULT 'n/a',
  `usrinstr_fld10` varchar(3) DEFAULT 'yes',
  `usrinstr_fld11` varchar(3) DEFAULT 'yes',
  `usrinstr_fld12` varchar(3) DEFAULT 'yes',
  `variations` varchar(255) DEFAULT 'None',
  `validation_period` varchar(50) DEFAULT 'one(1)',
  `signature_name` varchar(50) DEFAULT NULL,
  `signature_position` varchar(50) DEFAULT 'Technician',
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_certificate_id` (`certificate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countrys`
--

DROP TABLE IF EXISTS `countrys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countrys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` varchar(3) NOT NULL,
  `common_name` varchar(255) DEFAULT NULL,
  `formal_name` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `sovereignty` varchar(255) DEFAULT NULL,
  `currency_code` varchar(3) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `telephone_code` int(4) DEFAULT NULL,
  `iana_country_code` varchar(3) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` varchar(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countrys_hs`
--

DROP TABLE IF EXISTS `countrys_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countrys_hs` (
  `id` int(11) unsigned NOT NULL,
  `country_id` varchar(3) NOT NULL,
  `common_name` varchar(255) NOT NULL,
  `formal_name` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `sovereignty` varchar(255) DEFAULT NULL,
  `currency_code` varchar(3) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `telephone_code` int(4) DEFAULT NULL,
  `iana_country_code` varchar(3) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countrys_is`
--

DROP TABLE IF EXISTS `countrys_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countrys_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` varchar(3) DEFAULT NULL,
  `common_name` varchar(255) DEFAULT NULL,
  `formal_name` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `sovereignty` varchar(255) DEFAULT NULL,
  `currency_code` varchar(3) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `telephone_code` int(4) DEFAULT NULL,
  `iana_country_code` varchar(3) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_country_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `csvs`
--

DROP TABLE IF EXISTS `csvs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `csvs` (
  `id` int(11) unsigned NOT NULL,
  `csv_id` varchar(30) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `csv` longtext,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_csv_id` (`csv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `csvs_hs`
--

DROP TABLE IF EXISTS `csvs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `csvs_hs` (
  `id` int(11) unsigned NOT NULL,
  `csv_id` varchar(30) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `csv` longtext,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `csvs_is`
--

DROP TABLE IF EXISTS `csvs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `csvs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `csv_id` varchar(30) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `csv` longtext,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_csv_id` (`csv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=568 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) unsigned NOT NULL,
  `customer_id` varchar(8) NOT NULL,
  `customer_type` enum('INDIVIDUAL','COMPANY') NOT NULL,
  `business_type` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `region_id` int(11) unsigned NOT NULL,
  `country_id` varchar(2) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('M','F','N') NOT NULL,
  `phone_home` int(7) DEFAULT NULL,
  `phone_work` int(7) DEFAULT NULL,
  `phone_mobile1` int(7) NOT NULL,
  `phone_mobile2` int(7) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `driver_permit` varchar(10) NOT NULL,
  `identification_card` varchar(12) DEFAULT NULL,
  `passport` varchar(10) DEFAULT NULL,
  `driver_permit_expiry_date` date DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(7) DEFAULT NULL,
  `branch_id` varchar(50) NOT NULL,
  `referrer_id` varchar(8) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customers_hs`
--

DROP TABLE IF EXISTS `customers_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_hs` (
  `id` int(11) unsigned NOT NULL,
  `customer_id` varchar(8) NOT NULL,
  `customer_type` enum('INDIVIDUAL','COMPANY') NOT NULL,
  `business_type` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL,
  `country_id` varchar(2) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('M','F','N') NOT NULL,
  `phone_home` int(7) DEFAULT NULL,
  `phone_work` int(7) DEFAULT NULL,
  `phone_mobile1` int(7) DEFAULT NULL,
  `phone_mobile2` int(7) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `driver_permit` varchar(10) NOT NULL,
  `identification_card` varchar(12) DEFAULT NULL,
  `passport` varchar(10) DEFAULT NULL,
  `driver_permit_expiry_date` date DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(7) DEFAULT NULL,
  `branch_id` varchar(50) NOT NULL,
  `referrer_id` varchar(8) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customers_is`
--

DROP TABLE IF EXISTS `customers_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(8) DEFAULT NULL,
  `customer_type` enum('INDIVIDUAL','COMPANY') DEFAULT NULL,
  `business_type` varchar(50) DEFAULT 'PERSONAL',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `country_id` varchar(2) DEFAULT 'TT',
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('M','F','N') DEFAULT NULL,
  `phone_home` int(7) DEFAULT NULL,
  `phone_work` int(7) DEFAULT NULL,
  `phone_mobile1` int(7) DEFAULT NULL,
  `phone_mobile2` int(7) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `driver_permit` varchar(10) DEFAULT NULL,
  `identification_card` varchar(12) DEFAULT NULL,
  `passport` varchar(10) DEFAULT NULL,
  `driver_permit_expiry_date` date DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(7) DEFAULT NULL,
  `branch_id` varchar(50) DEFAULT 'HEAD.OFFICE',
  `referrer_id` varchar(8) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2790 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `daytimes`
--

DROP TABLE IF EXISTS `daytimes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daytimes` (
  `id` int(11) unsigned NOT NULL,
  `daytime_id` time NOT NULL,
  `description` varchar(25) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_datetime_id` (`daytime_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `daytimes_hs`
--

DROP TABLE IF EXISTS `daytimes_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daytimes_hs` (
  `id` int(11) unsigned NOT NULL,
  `daytime_id` time NOT NULL,
  `description` varchar(25) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `daytimes_is`
--

DROP TABLE IF EXISTS `daytimes_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daytimes_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `daytime_id` time DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_datetime_id` (`daytime_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deliverynotes`
--

DROP TABLE IF EXISTS `deliverynotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliverynotes` (
  `id` int(11) unsigned NOT NULL,
  `deliverynote_id` varchar(16) NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `deliverynote_date` date NOT NULL,
  `details` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `delivered_by` varchar(50) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `returned_signed_by` varchar(50) DEFAULT NULL,
  `returned_signed_date` date DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_deliverynote_id` (`deliverynote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deliverynotes_hs`
--

DROP TABLE IF EXISTS `deliverynotes_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliverynotes_hs` (
  `id` int(11) unsigned NOT NULL,
  `deliverynote_id` varchar(16) NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `deliverynote_date` date NOT NULL,
  `details` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `delivered_by` varchar(50) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `returned_signed_by` varchar(50) DEFAULT NULL,
  `returned_signed_date` date DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deliverynotes_is`
--

DROP TABLE IF EXISTS `deliverynotes_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliverynotes_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `deliverynote_id` varchar(16) DEFAULT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `deliverynote_date` date DEFAULT NULL,
  `details` text,
  `status` varchar(20) DEFAULT NULL,
  `delivered_by` varchar(50) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `returned_signed_by` varchar(50) DEFAULT NULL,
  `returned_signed_date` date DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_deliverynote_id` (`deliverynote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1331 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(11) unsigned NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departments_hs`
--

DROP TABLE IF EXISTS `departments_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments_hs` (
  `id` int(11) unsigned NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departments_is`
--

DROP TABLE IF EXISTS `departments_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` int(11) unsigned NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `device_status` enum('ACTIVE','RETIRED') NOT NULL,
  `warranty_expiry_date` date DEFAULT NULL,
  `passcode` varchar(255) DEFAULT NULL,
  `sms_enabled` enum('Y','N') NOT NULL,
  `gprs_enabled` enum('Y','N') NOT NULL,
  `imei` varchar(50) NOT NULL,
  `phone_device` int(7) unsigned NOT NULL,
  `phone_textback1` int(7) unsigned NOT NULL,
  `phone_textback2` int(7) unsigned DEFAULT NULL,
  `sms_server` int(7) unsigned NOT NULL,
  `gprs_server` varchar(50) DEFAULT NULL,
  `realtime_useraccount` varchar(50) DEFAULT NULL,
  `realtime_password` varchar(50) DEFAULT NULL,
  `realtime_appname` varchar(50) DEFAULT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `devices_hs`
--

DROP TABLE IF EXISTS `devices_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices_hs` (
  `id` int(11) unsigned NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `device_status` enum('ACTIVE','RETIRED') NOT NULL,
  `warranty_expiry_date` date DEFAULT NULL,
  `passcode` varchar(255) DEFAULT NULL,
  `sms_enabled` enum('Y','N') NOT NULL,
  `gprs_enabled` enum('Y','N') NOT NULL,
  `imei` varchar(50) NOT NULL,
  `phone_device` int(7) unsigned NOT NULL,
  `phone_textback1` int(7) unsigned NOT NULL,
  `phone_textback2` int(7) unsigned DEFAULT NULL,
  `sms_server` int(7) unsigned NOT NULL,
  `gprs_server` varchar(50) DEFAULT NULL,
  `realtime_useraccount` varchar(50) DEFAULT NULL,
  `realtime_password` varchar(50) DEFAULT NULL,
  `realtime_appname` varchar(50) DEFAULT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `devices_is`
--

DROP TABLE IF EXISTS `devices_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `device_id` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `device_status` enum('ACTIVE','RETIRED') DEFAULT 'ACTIVE',
  `warranty_expiry_date` date DEFAULT NULL,
  `passcode` varchar(255) DEFAULT NULL,
  `sms_enabled` enum('Y','N') DEFAULT 'N',
  `gprs_enabled` enum('Y','N') DEFAULT 'N',
  `imei` varchar(50) DEFAULT NULL,
  `phone_device` int(7) unsigned DEFAULT NULL,
  `phone_textback1` int(7) unsigned DEFAULT NULL,
  `phone_textback2` int(7) unsigned DEFAULT NULL,
  `sms_server` int(7) unsigned DEFAULT NULL,
  `gprs_server` varchar(50) DEFAULT NULL,
  `realtime_useraccount` varchar(50) DEFAULT NULL,
  `realtime_password` varchar(50) DEFAULT NULL,
  `realtime_appname` varchar(50) DEFAULT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_device_id` (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3253 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enquirydefs`
--

DROP TABLE IF EXISTS `enquirydefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquirydefs` (
  `id` int(11) unsigned NOT NULL,
  `controller` varchar(255) NOT NULL,
  `formfields` text,
  `tablename` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `idfield` varchar(50) NOT NULL,
  `enqheader` varchar(255) NOT NULL,
  `showfilter` tinyint(1) NOT NULL,
  `printuser` tinyint(1) NOT NULL,
  `printdatetime` tinyint(1) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_controller` (`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enquirydefs_hs`
--

DROP TABLE IF EXISTS `enquirydefs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquirydefs_hs` (
  `id` int(11) unsigned NOT NULL,
  `controller` varchar(255) NOT NULL,
  `formfields` text,
  `tablename` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `idfield` varchar(50) NOT NULL,
  `enqheader` varchar(255) NOT NULL,
  `showfilter` tinyint(1) NOT NULL,
  `printuser` tinyint(1) NOT NULL,
  `printdatetime` tinyint(1) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enquirydefs_is`
--

DROP TABLE IF EXISTS `enquirydefs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquirydefs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) DEFAULT NULL,
  `formfields` text,
  `tablename` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `idfield` varchar(50) DEFAULT NULL,
  `enqheader` varchar(255) DEFAULT NULL,
  `showfilter` tinyint(1) DEFAULT '1',
  `printuser` tinyint(1) DEFAULT '1',
  `printdatetime` tinyint(1) DEFAULT '1',
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_controller` (`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fixedselections`
--

DROP TABLE IF EXISTS `fixedselections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixedselections` (
  `id` int(11) unsigned NOT NULL,
  `fixedselection_id` varchar(50) NOT NULL,
  `enquiry_type` enum('default','custom') NOT NULL,
  `formfields` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_controller` (`fixedselection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fixedselections_hs`
--

DROP TABLE IF EXISTS `fixedselections_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixedselections_hs` (
  `id` int(11) unsigned NOT NULL,
  `fixedselection_id` varchar(50) NOT NULL,
  `enquiry_type` enum('default','custom') NOT NULL,
  `formfields` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fixedselections_is`
--

DROP TABLE IF EXISTS `fixedselections_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixedselections_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fixedselection_id` varchar(50) DEFAULT NULL,
  `enquiry_type` enum('default','custom') DEFAULT 'default',
  `formfields` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_controller` (`fixedselection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventchkouts`
--

DROP TABLE IF EXISTS `inventchkouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventchkouts` (
  `id` int(11) unsigned NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `checkout_details` text,
  `run` enum('Y','N') NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventchkouts_hs`
--

DROP TABLE IF EXISTS `inventchkouts_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventchkouts_hs` (
  `id` int(11) unsigned NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `checkout_details` text,
  `run` enum('Y','N') NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventchkouts_is`
--

DROP TABLE IF EXISTS `inventchkouts_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventchkouts_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(16) DEFAULT NULL,
  `checkout_details` text,
  `run` enum('Y','N') DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1374 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_track_details`
--

DROP TABLE IF EXISTS `inventory_track_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_track_details` (
  `id` int(11) unsigned NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `stockbatch_id` varchar(16) NOT NULL,
  `item_status` varchar(25) NOT NULL,
  `item_comments` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_serial_no` (`serial_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_track_details_hs`
--

DROP TABLE IF EXISTS `inventory_track_details_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_track_details_hs` (
  `id` int(11) unsigned NOT NULL,
  `serial_no` varchar(50) NOT NULL,
  `stockbatch_id` varchar(16) NOT NULL,
  `item_status` varchar(25) NOT NULL,
  `item_comments` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_track_details_is`
--

DROP TABLE IF EXISTS `inventory_track_details_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_track_details_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `serial_no` varchar(50) DEFAULT NULL,
  `stockbatch_id` varchar(16) DEFAULT NULL,
  `item_status` varchar(25) DEFAULT NULL,
  `item_comments` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_serial_no` (`serial_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2610 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_tracks`
--

DROP TABLE IF EXISTS `inventory_tracks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_tracks` (
  `id` int(11) unsigned NOT NULL,
  `stockbatch_id` varchar(16) NOT NULL,
  `stock_description` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `stockin_date` date NOT NULL,
  `stockin_quantity` int(11) unsigned NOT NULL,
  `stockbatch_status` enum('EDIT','CLOSED') NOT NULL,
  `stockbatch_details` text NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_stockbatch_id` (`stockbatch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_tracks_hs`
--

DROP TABLE IF EXISTS `inventory_tracks_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_tracks_hs` (
  `id` int(11) unsigned NOT NULL,
  `stockbatch_id` varchar(16) NOT NULL,
  `stock_description` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `stockin_date` date NOT NULL,
  `stockin_quantity` int(11) unsigned NOT NULL,
  `stockbatch_status` enum('EDIT','CLOSED') NOT NULL,
  `stockbatch_details` text NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory_tracks_is`
--

DROP TABLE IF EXISTS `inventory_tracks_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_tracks_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `stockbatch_id` varchar(16) DEFAULT NULL,
  `stock_description` varchar(50) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `stockin_date` date DEFAULT NULL,
  `stockin_quantity` int(11) unsigned DEFAULT '1',
  `stockbatch_status` enum('EDIT','CLOSED','NEW') DEFAULT 'NEW',
  `stockbatch_details` text,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_stockbatch_id` (`stockbatch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1018 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventorys`
--

DROP TABLE IF EXISTS `inventorys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventorys` (
  `id` int(11) unsigned NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `qty_instock` float(16,2) unsigned NOT NULL,
  `qty_diff` float(16,2) NOT NULL,
  `reorder_level` int(11) unsigned NOT NULL,
  `last_update_type` varchar(50) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_product_id_branch_id` (`product_id`,`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventorys_hs`
--

DROP TABLE IF EXISTS `inventorys_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventorys_hs` (
  `id` int(11) unsigned NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `qty_instock` float(16,2) unsigned NOT NULL,
  `qty_diff` float(16,2) NOT NULL,
  `reorder_level` int(11) unsigned NOT NULL,
  `last_update_type` varchar(50) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventorys_is`
--

DROP TABLE IF EXISTS `inventorys_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventorys_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) DEFAULT NULL,
  `branch_id` varchar(50) DEFAULT NULL,
  `qty_instock` float(16,2) unsigned DEFAULT '0.00',
  `qty_diff` float(16,2) DEFAULT '0.00',
  `reorder_level` int(11) unsigned DEFAULT '1',
  `last_update_type` varchar(50) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=519 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventupdtypes`
--

DROP TABLE IF EXISTS `inventupdtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventupdtypes` (
  `id` int(11) unsigned NOT NULL,
  `update_type_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock_movement` varchar(20) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_update_type_id` (`update_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventupdtypes_hs`
--

DROP TABLE IF EXISTS `inventupdtypes_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventupdtypes_hs` (
  `id` int(11) unsigned NOT NULL,
  `update_type_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stock_movement` varchar(20) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventupdtypes_is`
--

DROP TABLE IF EXISTS `inventupdtypes_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventupdtypes_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `update_type_id` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `stock_movement` varchar(20) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_update_type_id` (`update_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mantopupaccs`
--

DROP TABLE IF EXISTS `mantopupaccs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantopupaccs` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `tracker_type` varchar(50) DEFAULT NULL,
  `topup_cycle_days` int(3) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `topup_date` date NOT NULL,
  `next_topup_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `comment` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mantopupaccs_hs`
--

DROP TABLE IF EXISTS `mantopupaccs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantopupaccs_hs` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `tracker_type` varchar(50) DEFAULT NULL,
  `topup_cycle_days` int(3) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `topup_date` date NOT NULL,
  `next_topup_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `comment` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mantopupaccs_is`
--

DROP TABLE IF EXISTS `mantopupaccs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantopupaccs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(50) DEFAULT NULL,
  `tracker_type` varchar(50) DEFAULT NULL,
  `topup_cycle_days` int(3) unsigned DEFAULT NULL,
  `amount` int(11) unsigned DEFAULT NULL,
  `topup_date` date DEFAULT NULL,
  `next_topup_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'ACTIVE',
  `comment` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menudefs`
--

DROP TABLE IF EXISTS `menudefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menudefs` (
  `id` int(11) unsigned NOT NULL,
  `menu_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `sortpos` float(16,5) DEFAULT NULL,
  `nleft` int(11) DEFAULT NULL,
  `nright` int(11) DEFAULT NULL,
  `nlevel` int(11) DEFAULT NULL,
  `node_or_leaf` enum('L','N') DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `label_input` varchar(255) DEFAULT NULL,
  `label_enquiry` varchar(255) DEFAULT NULL,
  `url_input` varchar(255) DEFAULT NULL,
  `url_enquiry` varchar(255) DEFAULT NULL,
  `controls_input` varchar(255) DEFAULT NULL,
  `controls_enquiry` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menudefs_hs`
--

DROP TABLE IF EXISTS `menudefs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menudefs_hs` (
  `id` int(11) unsigned NOT NULL,
  `menu_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `sortpos` float(16,5) NOT NULL,
  `nleft` int(11) DEFAULT NULL,
  `nright` int(11) DEFAULT NULL,
  `nlevel` int(11) DEFAULT NULL,
  `node_or_leaf` enum('L','N') NOT NULL,
  `module` varchar(50) NOT NULL,
  `label_input` varchar(255) NOT NULL,
  `label_enquiry` varchar(255) NOT NULL,
  `url_input` varchar(255) DEFAULT NULL,
  `url_enquiry` varchar(255) DEFAULT NULL,
  `controls_input` varchar(255) DEFAULT NULL,
  `controls_enquiry` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menudefs_is`
--

DROP TABLE IF EXISTS `menudefs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menudefs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned DEFAULT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `sortpos` float(16,5) DEFAULT NULL,
  `nleft` int(11) DEFAULT NULL,
  `nright` int(11) DEFAULT NULL,
  `nlevel` int(11) DEFAULT NULL,
  `node_or_leaf` enum('L','N') DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `label_input` varchar(255) DEFAULT NULL,
  `label_enquiry` varchar(255) DEFAULT NULL,
  `url_input` varchar(255) DEFAULT NULL,
  `url_enquiry` varchar(255) DEFAULT NULL,
  `controls_input` varchar(255) DEFAULT NULL,
  `controls_enquiry` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=522 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menudefs_old`
--

DROP TABLE IF EXISTS `menudefs_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menudefs_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `nleft` int(11) DEFAULT NULL,
  `nright` int(11) DEFAULT NULL,
  `nlevel` int(11) DEFAULT NULL,
  `sortpos` float(16,5) DEFAULT NULL,
  `node_or_leaf` enum('L','N') DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `menulabel` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menudefs_users`
--

DROP TABLE IF EXISTS `menudefs_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menudefs_users` (
  `id` int(11) unsigned DEFAULT NULL,
  `menu_id` int(11) unsigned NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sortpos` float(16,5) DEFAULT NULL,
  `nleft` int(11) DEFAULT NULL,
  `nright` int(11) DEFAULT NULL,
  `nlevel` int(11) DEFAULT NULL,
  `node_or_leaf` enum('L','N') CHARACTER SET utf8 DEFAULT NULL,
  `module` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `label_input` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `label_enquiry` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url_input` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url_enquiry` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `controls_input` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `controls_enquiry` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `inputter` varchar(50) CHARACTER SET utf8 NOT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) CHARACTER SET utf8 DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`inputter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) unsigned NOT NULL,
  `vw` enum('Y','N') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `recipient` varchar(50) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages_hs`
--

DROP TABLE IF EXISTS `messages_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_hs` (
  `id` int(11) unsigned NOT NULL,
  `vw` enum('Y','N') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `recipient` varchar(50) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages_is`
--

DROP TABLE IF EXISTS `messages_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vw` enum('Y','N') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `recipient` varchar(50) DEFAULT NULL,
  `sender` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) NOT NULL DEFAULT 'IHLD',
  `current_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10045 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails` (
  `id` int(11) unsigned NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `qty` int(11) unsigned NOT NULL,
  `unit_price` float(16,2) NOT NULL,
  `tax_percentage` float(4,2) NOT NULL,
  `taxable` enum('Y','N') NOT NULL,
  `discount_amount` float(16,2) NOT NULL,
  `discount_type` enum('DOLLAR','PERCENT') NOT NULL,
  `description` text NOT NULL,
  `description_type` enum('STANDARD','EXTENDED') NOT NULL,
  `user_text` varchar(255) DEFAULT NULL,
  `inventory_update` enum('STANDARD','RESERVE','BACKORDER','NONE') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orderdetails_hs`
--

DROP TABLE IF EXISTS `orderdetails_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails_hs` (
  `id` int(11) unsigned NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `qty` int(11) unsigned NOT NULL,
  `unit_price` float(16,2) NOT NULL,
  `tax_percentage` float(4,2) NOT NULL,
  `taxable` enum('Y','N') NOT NULL,
  `discount_amount` float(16,2) NOT NULL,
  `discount_type` enum('DOLLAR','PERCENT') NOT NULL,
  `description` text,
  `description_type` enum('STANDARD','EXTENDED') NOT NULL,
  `user_text` varchar(255) DEFAULT NULL,
  `inventory_update` enum('STANDARD','RESERVE','BACKORDER','NONE') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orderdetails_is`
--

DROP TABLE IF EXISTS `orderdetails_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `qty` int(11) unsigned DEFAULT '0',
  `unit_price` float(16,2) DEFAULT '0.00',
  `tax_percentage` float(4,2) DEFAULT '0.00',
  `taxable` enum('Y','N') DEFAULT 'Y',
  `discount_amount` float(16,2) DEFAULT '0.00',
  `discount_type` enum('DOLLAR','PERCENT') DEFAULT 'DOLLAR',
  `description` text,
  `description_type` enum('STANDARD','EXTENDED') DEFAULT 'STANDARD',
  `user_text` varchar(255) DEFAULT NULL,
  `inventory_update` enum('STANDARD','RESERVE','BACKORDER','NONE') DEFAULT 'STANDARD',
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1939 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `customer_id` varchar(8) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_details` text NOT NULL,
  `order_date` date NOT NULL,
  `quotation_date` date NOT NULL,
  `invoice_date` date NOT NULL,
  `status_change_date` date NOT NULL,
  `inventory_checkout_type` enum('AUTO','MANUAL') NOT NULL,
  `inventory_update_type` enum('SALE','LOAN') DEFAULT NULL,
  `inventory_checkout_status` enum('NONE','PARTIAL','COMPLETED') NOT NULL,
  `invoice_note` varchar(256) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orders_hs`
--

DROP TABLE IF EXISTS `orders_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_hs` (
  `id` int(11) unsigned NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `customer_id` varchar(8) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_details` text NOT NULL,
  `order_date` date NOT NULL,
  `quotation_date` date NOT NULL,
  `invoice_date` date NOT NULL,
  `status_change_date` date NOT NULL,
  `inventory_checkout_type` enum('AUTO','MANUAL') NOT NULL,
  `inventory_update_type` enum('SALE','LOAN') DEFAULT NULL,
  `inventory_checkout_status` enum('NONE','PARTIAL','COMPLETED') NOT NULL,
  `invoice_note` varchar(256) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orders_is`
--

DROP TABLE IF EXISTS `orders_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `branch_id` varchar(50) DEFAULT NULL,
  `customer_id` varchar(8) DEFAULT NULL,
  `order_status` varchar(20) DEFAULT 'NEW',
  `order_details` text,
  `order_date` date DEFAULT NULL,
  `quotation_date` date DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `status_change_date` date DEFAULT NULL,
  `inventory_checkout_type` enum('AUTO','MANUAL') DEFAULT 'AUTO',
  `inventory_update_type` enum('SALE','LOAN') DEFAULT 'SALE',
  `inventory_checkout_status` enum('NONE','PARTIAL','COMPLETED') DEFAULT 'NONE',
  `invoice_note` varchar(256) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13990 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `params`
--

DROP TABLE IF EXISTS `params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `params` (
  `id` int(11) unsigned NOT NULL,
  `controller` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `formfields` text,
  `module` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `auth_mode_on` tinyint(1) NOT NULL DEFAULT '1',
  `index_field_on` tinyint(1) NOT NULL DEFAULT '1',
  `indexview` varchar(255) CHARACTER SET latin1 DEFAULT 'default_index',
  `viewview` varchar(255) CHARACTER SET latin1 DEFAULT 'default_view',
  `inputview` varchar(255) CHARACTER SET latin1 DEFAULT 'default_input',
  `authorizeview` varchar(255) CHARACTER SET latin1 DEFAULT 'default_authorize',
  `deleteview` varchar(255) CHARACTER SET latin1 DEFAULT 'default_delete',
  `enquiryview` varchar(255) CHARACTER SET latin1 DEFAULT 'default_enquiry',
  `indexfield` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'id' COMMENT 'name of field on indexview',
  `indexfieldvalue` varchar(255) CHARACTER SET latin1 DEFAULT NULL COMMENT 'value of field on indexview',
  `indexlabel` varchar(255) DEFAULT 'Id' COMMENT 'name of field on indexview',
  `appheader` varchar(255) CHARACTER SET latin1 DEFAULT NULL COMMENT 'name of app, usually backend table',
  `primarymodel` varchar(255) CHARACTER SET latin1 DEFAULT 'Site_Model',
  `tb_live` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tb_inau` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tb_hist` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `errormsgfile` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `inputter` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) CHARACTER SET latin1 DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`indexfield`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `params_hs`
--

DROP TABLE IF EXISTS `params_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `params_hs` (
  `id` int(11) unsigned NOT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `formfields` text,
  `module` varchar(255) DEFAULT NULL,
  `auth_mode_on` tinyint(1) NOT NULL DEFAULT '1',
  `index_field_on` tinyint(1) NOT NULL DEFAULT '1',
  `indexview` varchar(255) DEFAULT 'default_index',
  `viewview` varchar(255) DEFAULT 'default_view',
  `inputview` varchar(255) DEFAULT 'default_input',
  `authorizeview` varchar(255) DEFAULT 'default_authorize',
  `deleteview` varchar(255) DEFAULT 'default_delete',
  `enquiryview` varchar(255) DEFAULT 'default_enquiry',
  `indexfield` varchar(255) NOT NULL DEFAULT 'id' COMMENT 'name of field on indexview',
  `indexfieldvalue` varchar(255) DEFAULT NULL COMMENT 'value of field on indexview',
  `indexlabel` varchar(255) DEFAULT 'Id' COMMENT 'name of field on indexview',
  `appheader` varchar(255) DEFAULT NULL COMMENT 'name of app usually backend table',
  `primarymodel` varchar(255) DEFAULT 'Site_Model',
  `tb_live` varchar(255) DEFAULT NULL,
  `tb_inau` varchar(255) DEFAULT NULL,
  `tb_hist` varchar(255) DEFAULT NULL,
  `errormsgfile` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `params_is`
--

DROP TABLE IF EXISTS `params_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `params_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) DEFAULT NULL,
  `formfields` text,
  `module` varchar(255) DEFAULT NULL,
  `auth_mode_on` tinyint(1) DEFAULT '1',
  `index_field_on` tinyint(1) DEFAULT '1',
  `indexview` varchar(255) DEFAULT 'default_index',
  `viewview` varchar(255) DEFAULT 'default_view',
  `inputview` varchar(255) DEFAULT 'default_input',
  `authorizeview` varchar(255) DEFAULT 'default_authorize',
  `deleteview` varchar(255) DEFAULT 'default_delete',
  `enquiryview` varchar(255) DEFAULT 'default_enquiry',
  `indexfield` varchar(255) DEFAULT 'id' COMMENT 'name of field on indexview',
  `indexfieldvalue` varchar(255) DEFAULT NULL COMMENT 'value of field on indexview',
  `indexlabel` varchar(255) DEFAULT 'Id' COMMENT 'name of field on indexview',
  `appheader` varchar(255) DEFAULT NULL COMMENT 'name of app usually backend table',
  `primarymodel` varchar(255) DEFAULT 'Site_Model',
  `tb_live` varchar(255) DEFAULT NULL,
  `tb_inau` varchar(255) DEFAULT NULL,
  `tb_hist` varchar(255) DEFAULT NULL,
  `errormsgfile` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_controller` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=519 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) unsigned NOT NULL,
  `payment_id` varchar(16) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `till_id` varchar(59) NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `amount` float(16,2) NOT NULL,
  `payment_type` enum('CASH','CHEQUE','DEBIT.CARD','CREDIT.CARD') NOT NULL,
  `payment_date` date NOT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_payment_id` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payments_hs`
--

DROP TABLE IF EXISTS `payments_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments_hs` (
  `id` int(11) unsigned NOT NULL,
  `payment_id` varchar(16) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `till_id` varchar(59) NOT NULL,
  `order_id` varchar(16) NOT NULL,
  `amount` float(16,2) NOT NULL,
  `payment_type` enum('CASH','CHEQUE','DEBIT.CARD','CREDIT.CARD') NOT NULL,
  `payment_date` date NOT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payments_is`
--

DROP TABLE IF EXISTS `payments_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(16) DEFAULT NULL,
  `branch_id` varchar(50) DEFAULT NULL,
  `till_id` varchar(59) DEFAULT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `amount` float(16,2) DEFAULT NULL,
  `payment_type` enum('CASH','CHEQUE','DEBIT.CARD','CREDIT.CARD') DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_payment_id` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1377 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pdfs`
--

DROP TABLE IF EXISTS `pdfs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdfs` (
  `id` int(11) unsigned NOT NULL,
  `pdf_id` varchar(30) NOT NULL,
  `pdf_template` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `data` longtext,
  `data_type` enum('html','xml','json','csv','text') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_pdf_id` (`pdf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pdfs_hs`
--

DROP TABLE IF EXISTS `pdfs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdfs_hs` (
  `id` int(11) unsigned NOT NULL,
  `pdf_id` varchar(30) NOT NULL,
  `pdf_template` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `data` longtext,
  `data_type` enum('html','xml','json','csv','text') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pdfs_is`
--

DROP TABLE IF EXISTS `pdfs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdfs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pdf_id` varchar(30) DEFAULT NULL,
  `pdf_template` varchar(50) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `data` longtext,
  `data_type` enum('html','xml','json','csv','text') DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_pdf_id` (`pdf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64571 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pdftemplates`
--

DROP TABLE IF EXISTS `pdftemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdftemplates` (
  `id` int(11) unsigned NOT NULL,
  `template_id` varchar(50) NOT NULL,
  `pdf_header_class` varchar(50) NOT NULL,
  `pdf_template_file` varchar(255) NOT NULL,
  `pdf_page_orientation` enum('P','L') NOT NULL,
  `pdf_unit` enum('mm','cm','in','pt') NOT NULL,
  `pdf_page_format` varchar(50) NOT NULL,
  `pdf_output` enum('I','D','F','FI','FD','E','S') NOT NULL,
  `pdf_margin_top` float(5,2) unsigned NOT NULL,
  `pdf_margin_right` float(5,2) unsigned NOT NULL,
  `pdf_margin_bottom` float(5,2) unsigned NOT NULL,
  `pdf_margin_left` float(5,2) unsigned NOT NULL,
  `pdf_font_monospaced` varchar(50) NOT NULL,
  `pdf_font` varchar(50) NOT NULL,
  `pdf_fontstyle` varchar(3) DEFAULT NULL,
  `pdf_fontsize` int(4) unsigned NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_template_id` (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pdftemplates_hs`
--

DROP TABLE IF EXISTS `pdftemplates_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdftemplates_hs` (
  `id` int(11) unsigned NOT NULL,
  `template_id` varchar(50) NOT NULL,
  `pdf_header_class` varchar(50) NOT NULL,
  `pdf_template_file` varchar(255) NOT NULL,
  `pdf_page_orientation` enum('P','L') NOT NULL,
  `pdf_unit` enum('mm','cm','in','pt') NOT NULL,
  `pdf_page_format` varchar(50) NOT NULL,
  `pdf_output` enum('I','D','F','FI','FD','E','S') NOT NULL,
  `pdf_margin_top` float(5,2) unsigned NOT NULL,
  `pdf_margin_right` float(5,2) unsigned NOT NULL,
  `pdf_margin_bottom` float(5,2) unsigned NOT NULL,
  `pdf_margin_left` float(5,2) unsigned NOT NULL,
  `pdf_font_monospaced` varchar(50) NOT NULL,
  `pdf_font` varchar(50) NOT NULL,
  `pdf_fontstyle` varchar(3) DEFAULT NULL,
  `pdf_fontsize` int(4) unsigned NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pdftemplates_is`
--

DROP TABLE IF EXISTS `pdftemplates_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pdftemplates_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` varchar(50) DEFAULT NULL,
  `pdf_header_class` varchar(50) DEFAULT 'SITEPDF',
  `pdf_template_file` varchar(255) DEFAULT NULL,
  `pdf_page_orientation` enum('P','L') DEFAULT 'P',
  `pdf_unit` enum('mm','cm','in','pt') DEFAULT 'mm',
  `pdf_page_format` varchar(50) DEFAULT 'LETTER',
  `pdf_output` enum('I','D','F','FI','FD','E','S') DEFAULT 'I',
  `pdf_margin_top` float(5,2) unsigned DEFAULT '35.00',
  `pdf_margin_right` float(5,2) unsigned DEFAULT '12.00',
  `pdf_margin_bottom` float(5,2) unsigned DEFAULT '25.00',
  `pdf_margin_left` float(5,2) unsigned DEFAULT '12.00',
  `pdf_font_monospaced` varchar(50) DEFAULT 'courier',
  `pdf_font` varchar(50) DEFAULT 'helvetica',
  `pdf_fontstyle` varchar(3) DEFAULT NULL,
  `pdf_fontsize` int(4) unsigned DEFAULT '12',
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_template_id` (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `package_items` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) NOT NULL,
  `extended_description` text,
  `category` varchar(50) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `unit_price` float(15,2) NOT NULL,
  `taxable` enum('Y','N') NOT NULL,
  `tax_percentage` float(4,2) NOT NULL,
  `transfer_code` varchar(50) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE','DISCONTINUED') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products_hs`
--

DROP TABLE IF EXISTS `products_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_hs` (
  `id` int(11) unsigned NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `package_items` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) NOT NULL,
  `extended_description` text,
  `category` varchar(50) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `unit_price` float(15,2) NOT NULL,
  `taxable` enum('Y','N') NOT NULL,
  `tax_percentage` float(4,2) NOT NULL,
  `transfer_code` varchar(50) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE','DISCONTINUED') NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products_is`
--

DROP TABLE IF EXISTS `products_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `package_items` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `extended_description` text,
  `category` varchar(50) DEFAULT NULL,
  `sub_category` varchar(50) DEFAULT NULL,
  `unit_price` float(15,2) DEFAULT '0.00',
  `taxable` enum('Y','N') DEFAULT 'Y',
  `tax_percentage` float(4,2) DEFAULT '15.00',
  `transfer_code` varchar(50) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE','DISCONTINUED') DEFAULT 'ACTIVE',
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=534 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recordlocks`
--

DROP TABLE IF EXISTS `recordlocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recordlocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idname` varchar(50) DEFAULT NULL,
  `lock_table` varchar(255) NOT NULL,
  `record_id` int(11) NOT NULL,
  `pre_status` varchar(4) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11310 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recurrences`
--

DROP TABLE IF EXISTS `recurrences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurrences` (
  `id` int(11) unsigned NOT NULL,
  `recurrence_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_recurrence_id` (`recurrence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recurrences_hs`
--

DROP TABLE IF EXISTS `recurrences_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurrences_hs` (
  `id` int(11) unsigned NOT NULL,
  `recurrence_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recurrences_is`
--

DROP TABLE IF EXISTS `recurrences_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurrences_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recurrence_id` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_recurrence_id` (`recurrence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `id` int(11) unsigned NOT NULL,
  `area` varchar(255) NOT NULL,
  `sub_region` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `country_id` varchar(2) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regions_hs`
--

DROP TABLE IF EXISTS `regions_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions_hs` (
  `id` int(11) unsigned NOT NULL,
  `area` varchar(255) NOT NULL,
  `sub_region` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `country_id` varchar(2) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regions_is`
--

DROP TABLE IF EXISTS `regions_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(255) DEFAULT NULL,
  `sub_region` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `country_id` varchar(2) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reportdefs`
--

DROP TABLE IF EXISTS `reportdefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportdefs` (
  `id` int(11) unsigned NOT NULL,
  `controller` varchar(255) NOT NULL,
  `formfields` text,
  `model` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `rptheader` varchar(255) NOT NULL,
  `showfilter` tinyint(1) NOT NULL,
  `printuser` tinyint(1) NOT NULL,
  `printdatetime` tinyint(1) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_controller` (`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reportdefs_hs`
--

DROP TABLE IF EXISTS `reportdefs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportdefs_hs` (
  `id` int(11) unsigned NOT NULL,
  `controller` varchar(255) NOT NULL,
  `formfields` text,
  `model` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `rptheader` varchar(255) NOT NULL,
  `showfilter` tinyint(1) NOT NULL,
  `printuser` tinyint(1) NOT NULL,
  `printdatetime` tinyint(1) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reportdefs_is`
--

DROP TABLE IF EXISTS `reportdefs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportdefs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) DEFAULT NULL,
  `formfields` text,
  `model` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `rptheader` varchar(255) DEFAULT NULL,
  `showfilter` tinyint(1) DEFAULT NULL,
  `printuser` tinyint(1) DEFAULT NULL,
  `printdatetime` tinyint(1) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_controller` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `securityprofile` longtext,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles_hs`
--

DROP TABLE IF EXISTS `roles_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_hs` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `securityprofile` longtext NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles_is`
--

DROP TABLE IF EXISTS `roles_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `securityprofile` longtext,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sysconfigs`
--

DROP TABLE IF EXISTS `sysconfigs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sysconfigs` (
  `id` int(11) unsigned NOT NULL,
  `sysconfig_id` varchar(50) NOT NULL,
  `initialization_date` date NOT NULL,
  `global_authmode_on` enum('1','0') DEFAULT '1',
  `global_indexfield_on` enum('1','0') DEFAULT '1',
  `app_version` varchar(20) NOT NULL,
  `db_version` varchar(20) NOT NULL,
  `environment` varchar(50) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_sysconfig_id` (`sysconfig_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sysconfigs_hs`
--

DROP TABLE IF EXISTS `sysconfigs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sysconfigs_hs` (
  `id` int(11) unsigned NOT NULL,
  `sysconfig_id` varchar(50) NOT NULL,
  `initialization_date` date NOT NULL,
  `global_authmode_on` enum('1','0') DEFAULT '1',
  `global_indexfield_on` enum('1','0') DEFAULT '1',
  `app_version` varchar(20) NOT NULL,
  `db_version` varchar(20) NOT NULL,
  `environment` varchar(50) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sysconfigs_is`
--

DROP TABLE IF EXISTS `sysconfigs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sysconfigs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sysconfig_id` varchar(50) DEFAULT NULL,
  `initialization_date` date DEFAULT NULL,
  `global_authmode_on` enum('1','0') DEFAULT '1',
  `global_indexfield_on` enum('1','0') DEFAULT '1',
  `app_version` varchar(20) DEFAULT NULL,
  `db_version` varchar(20) DEFAULT NULL,
  `environment` varchar(50) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_sysconfig_id` (`sysconfig_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tableresetconfigs`
--

DROP TABLE IF EXISTS `tableresetconfigs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableresetconfigs` (
  `id` int(11) unsigned NOT NULL,
  `reset_id` varchar(255) NOT NULL,
  `reset_profile` text NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_reset_id` (`reset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tableresetconfigs_hs`
--

DROP TABLE IF EXISTS `tableresetconfigs_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableresetconfigs_hs` (
  `id` int(11) unsigned NOT NULL,
  `reset_id` varchar(255) NOT NULL,
  `reset_profile` text NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tableresetconfigs_is`
--

DROP TABLE IF EXISTS `tableresetconfigs_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableresetconfigs_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reset_id` varchar(255) DEFAULT NULL,
  `reset_profile` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_reset_id` (`reset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tableresetruns`
--

DROP TABLE IF EXISTS `tableresetruns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableresetruns` (
  `id` int(11) unsigned NOT NULL,
  `resetconfig_id` varchar(255) NOT NULL,
  `lastrun_date` varchar(255) NOT NULL,
  `log` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_resetconfig_id` (`resetconfig_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tableresetruns_hs`
--

DROP TABLE IF EXISTS `tableresetruns_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableresetruns_hs` (
  `id` int(11) unsigned NOT NULL,
  `resetconfig_id` varchar(255) NOT NULL,
  `lastrun_date` varchar(255) NOT NULL,
  `log` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tableresetruns_is`
--

DROP TABLE IF EXISTS `tableresetruns_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableresetruns_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resetconfig_id` varchar(255) DEFAULT NULL,
  `lastrun_date` varchar(255) DEFAULT NULL,
  `log` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_resetconfig_id` (`resetconfig_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telbooks`
--

DROP TABLE IF EXISTS `telbooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telbooks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `telno` varchar(50) DEFAULT NULL,
  `plate` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `totalmoney` decimal(11,0) NOT NULL DEFAULT '75',
  `centerpassword` varchar(50) NOT NULL DEFAULT '666666',
  `hasalarm` decimal(11,0) NOT NULL DEFAULT '0',
  `groupid` decimal(11,0) NOT NULL DEFAULT '0',
  `modemkind` decimal(11,0) NOT NULL DEFAULT '0',
  `vehicle_id` varchar(50) NOT NULL,
  `security_code` varchar(2) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL DEFAULT 'TS01',
  `input_date` datetime NOT NULL DEFAULT '2011-01-01 00:00:00',
  `authorizer` varchar(50) NOT NULL DEFAULT 'TS01',
  `auth_date` datetime NOT NULL DEFAULT '2011-01-01 00:00:00',
  `record_status` char(4) NOT NULL DEFAULT 'LIVE',
  `current_no` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_plate` (`plate`),
  UNIQUE KEY `uniq_telno` (`telno`)
) ENGINE=InnoDB AUTO_INCREMENT=2013 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `telbooks_hs`
--

DROP TABLE IF EXISTS `telbooks_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telbooks_hs` (
  `id` int(11) unsigned NOT NULL,
  `telno` varchar(50) DEFAULT NULL,
  `plate` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `totalmoney` int(11) NOT NULL,
  `centerpassword` varchar(50) NOT NULL,
  `hasalarm` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `modemkind` int(11) NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `security_code` varchar(2) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tills`
--

DROP TABLE IF EXISTS `tills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tills` (
  `id` int(11) unsigned NOT NULL,
  `till_id` varchar(59) NOT NULL,
  `till_user` varchar(50) NOT NULL,
  `till_date` date NOT NULL,
  `initial_balance` float(16,2) NOT NULL,
  `status` enum('OPEN','SUSPENDED','CLOSED') NOT NULL,
  `expiry_date` date NOT NULL,
  `expiry_time` time NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_till_id` (`till_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tills_hs`
--

DROP TABLE IF EXISTS `tills_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tills_hs` (
  `id` int(11) unsigned NOT NULL,
  `till_id` varchar(59) NOT NULL,
  `till_user` varchar(50) NOT NULL,
  `till_date` date NOT NULL,
  `initial_balance` float(16,2) NOT NULL,
  `status` enum('OPEN','SUSPENDED','CLOSED') NOT NULL,
  `expiry_date` date NOT NULL,
  `expiry_time` time NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tills_is`
--

DROP TABLE IF EXISTS `tills_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tills_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `till_id` varchar(59) DEFAULT NULL,
  `till_user` varchar(50) DEFAULT NULL,
  `till_date` date DEFAULT NULL,
  `initial_balance` float(16,2) DEFAULT '0.00',
  `status` enum('OPEN','SUSPENDED','CLOSED') DEFAULT 'OPEN',
  `expiry_date` date DEFAULT NULL,
  `expiry_time` time DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_till_id` (`till_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1146 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tilltransactions`
--

DROP TABLE IF EXISTS `tilltransactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tilltransactions` (
  `id` int(11) unsigned NOT NULL,
  `transaction_id` varchar(16) NOT NULL,
  `till_id` varchar(59) NOT NULL,
  `amount` float(16,2) NOT NULL,
  `transaction_type` enum('CASH','CHEQUE','DEBIT.CARD','CREDIT.CARD') NOT NULL,
  `transaction_date` date NOT NULL,
  `movement` enum('IN','OUT') NOT NULL,
  `reason` varchar(255) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_transaction_id` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tilltransactions_hs`
--

DROP TABLE IF EXISTS `tilltransactions_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tilltransactions_hs` (
  `id` int(11) unsigned NOT NULL,
  `transaction_id` varchar(16) NOT NULL,
  `till_id` varchar(59) NOT NULL,
  `amount` float(16,2) NOT NULL,
  `transaction_type` enum('CASH','CHEQUE','DEBIT.CARD','CREDIT.CARD') NOT NULL,
  `transaction_date` date NOT NULL,
  `movement` enum('IN','OUT') NOT NULL,
  `reason` varchar(255) NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tilltransactions_is`
--

DROP TABLE IF EXISTS `tilltransactions_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tilltransactions_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(16) DEFAULT NULL,
  `till_id` varchar(59) DEFAULT NULL,
  `amount` float(16,2) DEFAULT '0.00',
  `transaction_type` enum('CASH','CHEQUE','DEBIT.CARD','CREDIT.CARD') DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `movement` enum('IN','OUT') DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_transaction_id` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1148 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `userroles`
--

DROP TABLE IF EXISTS `userroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userroles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idname` varchar(50) NOT NULL,
  `roles` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_idname` (`idname`)
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `userroles_hs`
--

DROP TABLE IF EXISTS `userroles_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userroles_hs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idname` varchar(50) NOT NULL,
  `roles` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=MyISAM AUTO_INCREMENT=10002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `userroles_is`
--

DROP TABLE IF EXISTS `userroles_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userroles_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idname` varchar(50) DEFAULT NULL,
  `roles` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT 'IHLD',
  `current_no` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1010 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL,
  `idname` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(32) NOT NULL DEFAULT '',
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `enabled` enum('Y','N') NOT NULL DEFAULT 'Y',
  `expiry_date` date NOT NULL DEFAULT '2037-12-31',
  `branch_id` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `password` char(50) DEFAULT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_idname` (`idname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_hs`
--

DROP TABLE IF EXISTS `users_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_hs` (
  `id` int(11) unsigned NOT NULL,
  `idname` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(32) NOT NULL DEFAULT '',
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `enabled` enum('Y','N') NOT NULL DEFAULT 'Y',
  `expiry_date` date NOT NULL DEFAULT '2037-12-31',
  `branch_id` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `password` char(50) DEFAULT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_is`
--

DROP TABLE IF EXISTS `users_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idname` varchar(50) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `enabled` enum('Y','N') NOT NULL DEFAULT 'Y',
  `expiry_date` date NOT NULL DEFAULT '2037-12-31',
  `branch_id` varchar(50) DEFAULT NULL,
  `department_id` varchar(50) DEFAULT NULL,
  `password` char(50) DEFAULT NULL,
  `logins` int(10) unsigned DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) NOT NULL DEFAULT 'IHLD',
  `current_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_id` varchar(20) NOT NULL,
  `owner_id` varchar(8) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `chassis_number` varchar(50) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `vehicletype_id` varchar(50) DEFAULT NULL,
  `vehicleusagetype_id` varchar(50) DEFAULT NULL,
  `installer` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `installation_date` date NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicles_hs`
--

DROP TABLE IF EXISTS `vehicles_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_hs` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_id` varchar(20) NOT NULL,
  `owner_id` varchar(8) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `chassis_number` varchar(50) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `vehicletype_id` varchar(50) DEFAULT NULL,
  `vehicleusagetype_id` varchar(50) DEFAULT NULL,
  `installer` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `installation_date` date NOT NULL,
  `comments` text,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicles_is`
--

DROP TABLE IF EXISTS `vehicles_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(20) DEFAULT NULL,
  `owner_id` varchar(8) DEFAULT NULL,
  `device_id` varchar(50) DEFAULT 'NO.DEVICE',
  `chassis_number` varchar(50) DEFAULT 'N/A',
  `make` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `vehicletype_id` varchar(50) DEFAULT 'SEDAN',
  `vehicleusagetype_id` varchar(50) DEFAULT 'PERSONAL',
  `installer` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT 'SERVICE.CENTER',
  `installation_date` date DEFAULT NULL,
  `comments` text,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3159 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicletypes`
--

DROP TABLE IF EXISTS `vehicletypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicletypes` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_type_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_type_id` (`vehicle_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicletypes_hs`
--

DROP TABLE IF EXISTS `vehicletypes_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicletypes_hs` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_type_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicletypes_is`
--

DROP TABLE IF EXISTS `vehicletypes_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicletypes_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_type_id` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_type_id` (`vehicle_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicleusagetypes`
--

DROP TABLE IF EXISTS `vehicleusagetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicleusagetypes` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_usage_type_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_usage_type_id` (`vehicle_usage_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicleusagetypes_hs`
--

DROP TABLE IF EXISTS `vehicleusagetypes_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicleusagetypes_hs` (
  `id` int(11) unsigned NOT NULL,
  `vehicle_usage_type_id` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vehicleusagetypes_is`
--

DROP TABLE IF EXISTS `vehicleusagetypes_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicleusagetypes_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_usage_type_id` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_vehicle_usage_type_id` (`vehicle_usage_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `vw_batchorders_lookup`
--

DROP TABLE IF EXISTS `vw_batchorders_lookup`;
/*!50001 DROP VIEW IF EXISTS `vw_batchorders_lookup`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_batchorders_lookup` (
  `invoice_id` int(11) unsigned,
  `order_id` varchar(20),
  `order_date` date,
  `first_name` varchar(255),
  `order_details` varchar(341),
  `last_name` varchar(255),
  `extended_total` double(19,2),
  `tax_total` double(19,2),
  `order_total` double(19,2),
  `payment_total` double(19,2),
  `balance` double(19,2),
  `payment_type` varchar(341)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_batchtypes`
--

DROP TABLE IF EXISTS `vw_batchtypes`;
/*!50001 DROP VIEW IF EXISTS `vw_batchtypes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_batchtypes` (
  `type` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_biztype`
--

DROP TABLE IF EXISTS `vw_biztype`;
/*!50001 DROP VIEW IF EXISTS `vw_biztype`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_biztype` (
  `business_type` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_certificate_accounts`
--

DROP TABLE IF EXISTS `vw_certificate_accounts`;
/*!50001 DROP VIEW IF EXISTS `vw_certificate_accounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_certificate_accounts` (
  `vehicle_id` varchar(20),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `device_tag_id` varchar(50),
  `device_model` varchar(50),
  `phone_device` int(7) unsigned
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_core_fixedselections_available`
--

DROP TABLE IF EXISTS `vw_core_fixedselections_available`;
/*!50001 DROP VIEW IF EXISTS `vw_core_fixedselections_available`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_core_fixedselections_available` (
  `fixedselection_id` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_core_users_noroles`
--

DROP TABLE IF EXISTS `vw_core_users_noroles`;
/*!50001 DROP VIEW IF EXISTS `vw_core_users_noroles`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_core_users_noroles` (
  `idname` varchar(50),
  `fullname` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_device_info`
--

DROP TABLE IF EXISTS `vw_device_info`;
/*!50001 DROP VIEW IF EXISTS `vw_device_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_device_info` (
  `d_id` int(11) unsigned,
  `device_id` varchar(50),
  `model` varchar(50),
  `device_status` enum('ACTIVE','RETIRED'),
  `warranty_expiry_date` date,
  `passcode` varchar(255),
  `sms_enabled` enum('Y','N'),
  `gprs_enabled` enum('Y','N'),
  `imei` varchar(50),
  `phone_device` int(7) unsigned,
  `phone_textback1` int(7) unsigned,
  `phone_textback2` int(7) unsigned,
  `sms_server` int(7) unsigned,
  `gprs_server` varchar(50),
  `realtime_useraccount` varchar(50),
  `realtime_password` varchar(50),
  `realtime_appname` varchar(50),
  `order_id` varchar(16),
  `device_comments` text,
  `itd_id` int(11) unsigned,
  `serial_no` varchar(50),
  `stockbatch_id` varchar(16),
  `item_status` varchar(25),
  `item_comments` varchar(255),
  `it_id` int(11) unsigned,
  `stock_description` varchar(50),
  `product_id` varchar(50),
  `stockin_date` date,
  `stockin_quantity` int(11) unsigned,
  `stockbatch_status` enum('EDIT','CLOSED'),
  `stockbatch_details` text,
  `it_comments` text
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_device_instock`
--

DROP TABLE IF EXISTS `vw_device_instock`;
/*!50001 DROP VIEW IF EXISTS `vw_device_instock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_device_instock` (
  `serial_no` varchar(50),
  `product_id` varchar(50),
  `item_status` varchar(25),
  `item_comments` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_device_products`
--

DROP TABLE IF EXISTS `vw_device_products`;
/*!50001 DROP VIEW IF EXISTS `vw_device_products`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_device_products` (
  `product_id` varchar(50),
  `product_description` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_devices_available`
--

DROP TABLE IF EXISTS `vw_devices_available`;
/*!50001 DROP VIEW IF EXISTS `vw_devices_available`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_devices_available` (
  `id` int(11) unsigned,
  `device_id` varchar(50),
  `imei` varchar(50),
  `model` varchar(50),
  `phone_device` int(7) unsigned,
  `item_status` varchar(25)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_distinct_product_category`
--

DROP TABLE IF EXISTS `vw_distinct_product_category`;
/*!50001 DROP VIEW IF EXISTS `vw_distinct_product_category`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_distinct_product_category` (
  `category` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_distinct_product_subcategory`
--

DROP TABLE IF EXISTS `vw_distinct_product_subcategory`;
/*!50001 DROP VIEW IF EXISTS `vw_distinct_product_subcategory`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_distinct_product_subcategory` (
  `sub_category` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_eomorders_lookup`
--

DROP TABLE IF EXISTS `vw_eomorders_lookup`;
/*!50001 DROP VIEW IF EXISTS `vw_eomorders_lookup`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_eomorders_lookup` (
  `invoice_id` int(11) unsigned,
  `order_id` varchar(20),
  `order_date` date,
  `first_name` varchar(255),
  `last_name` varchar(255),
  `extended_total` double(19,2),
  `tax_total` double(19,2),
  `payment_total` double(19,2),
  `payment_type` varchar(341)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_estimator_products`
--

DROP TABLE IF EXISTS `vw_estimator_products`;
/*!50001 DROP VIEW IF EXISTS `vw_estimator_products`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_estimator_products` (
  `product_id` varchar(50),
  `product_description` varchar(255),
  `TYPE` varchar(20),
  `taxable` enum('Y','N'),
  `unit_price` float(15,2),
  `total_price` float(16,2),
  `category` varchar(50),
  `sub_category` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_inventchkout_sideinfo`
--

DROP TABLE IF EXISTS `vw_inventchkout_sideinfo`;
/*!50001 DROP VIEW IF EXISTS `vw_inventchkout_sideinfo`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_inventchkout_sideinfo` (
  `id` int(11) unsigned,
  `order_id` varchar(20),
  `branch_id` varchar(50),
  `customer_id` varchar(8),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `order_date` date,
  `order_status` varchar(20),
  `inventory_checkout_status` enum('NONE','PARTIAL','COMPLETED')
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_inventprod_available`
--

DROP TABLE IF EXISTS `vw_inventprod_available`;
/*!50001 DROP VIEW IF EXISTS `vw_inventprod_available`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_inventprod_available` (
  `id` int(11) unsigned,
  `product_id` varchar(50),
  `description` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_nonpackageproducts`
--

DROP TABLE IF EXISTS `vw_nonpackageproducts`;
/*!50001 DROP VIEW IF EXISTS `vw_nonpackageproducts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_nonpackageproducts` (
  `id` int(11) unsigned,
  `product_id` varchar(50),
  `type` varchar(20),
  `package_items` varchar(255),
  `product_description` varchar(255),
  `extended_description` text,
  `category` varchar(50),
  `sub_category` varchar(50),
  `unit_price` float(15,2),
  `taxable` enum('Y','N'),
  `tax_percentage` float(4,2),
  `status` enum('ACTIVE','INACTIVE','DISCONTINUED'),
  `inputter` varchar(50),
  `input_date` datetime,
  `authorizer` varchar(50),
  `auth_date` datetime,
  `record_status` char(4),
  `current_no` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_orderbalances`
--

DROP TABLE IF EXISTS `vw_orderbalances`;
/*!50001 DROP VIEW IF EXISTS `vw_orderbalances`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_orderbalances` (
  `id` int(11) unsigned,
  `order_id` varchar(20),
  `branch_id` varchar(50),
  `customer_id` varchar(8),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `customer_type` enum('INDIVIDUAL','COMPANY'),
  `address1` varchar(255),
  `address2` varchar(255),
  `city` varchar(255),
  `phone_mobile1` int(7),
  `phone_home` int(7),
  `phone_work` int(7),
  `order_details` varchar(341),
  `payment_type` varchar(341),
  `order_date` date,
  `quotation_date` date,
  `invoice_date` date,
  `order_status` varchar(20),
  `inventory_checkout_status` enum('NONE','PARTIAL','COMPLETED'),
  `inventory_update_type` enum('SALE','LOAN'),
  `inputter` varchar(50),
  `input_date` datetime,
  `invoice_note` varchar(256),
  `comments` text,
  `current_no` int(11),
  `unit_total` double(19,2),
  `discount_total` double(19,2),
  `extended_total` double(19,2),
  `tax_total` double(19,2),
  `order_total` double(19,2),
  `payment_total` double(19,2),
  `balance` double(19,2)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_orderbalances_nonzero`
--

DROP TABLE IF EXISTS `vw_orderbalances_nonzero`;
/*!50001 DROP VIEW IF EXISTS `vw_orderbalances_nonzero`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_orderbalances_nonzero` (
  `order_id` varchar(20),
  `branch_id` varchar(50),
  `customer_id` varchar(8),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `order_date` date,
  `order_status` varchar(20),
  `order_total` double(19,2),
  `payment_total` double(19,2),
  `balance` double(19,2)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_orderstatus`
--

DROP TABLE IF EXISTS `vw_orderstatus`;
/*!50001 DROP VIEW IF EXISTS `vw_orderstatus`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_orderstatus` (
  `id` int(2),
  `order_status_id` varchar(20)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_technicians`
--

DROP TABLE IF EXISTS `vw_technicians`;
/*!50001 DROP VIEW IF EXISTS `vw_technicians`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_technicians` (
  `idname` varchar(50),
  `fullname` varchar(255)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_telbooks_available`
--

DROP TABLE IF EXISTS `vw_telbooks_available`;
/*!50001 DROP VIEW IF EXISTS `vw_telbooks_available`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_telbooks_available` (
  `id` int(11) unsigned,
  `vehicle_id` varchar(20),
  `telno` int(7) unsigned,
  `username` varchar(511),
  `mobile` varchar(512),
  `duplicate_telno` char(1)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_trackers_info`
--

DROP TABLE IF EXISTS `vw_trackers_info`;
/*!50001 DROP VIEW IF EXISTS `vw_trackers_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_trackers_info` (
  `id` int(11) unsigned,
  `serial_no` varchar(50),
  `stockbatch_id` varchar(16),
  `item_status` varchar(25),
  `item_comments` varchar(255),
  `inputter` varchar(50),
  `input_date` datetime,
  `authorizer` varchar(50),
  `auth_date` datetime,
  `record_status` char(4),
  `current_no` int(11),
  `it_id` int(11) unsigned,
  `stock_description` varchar(50),
  `product_id` varchar(50),
  `stockin_date` date,
  `stockin_quantity` int(11) unsigned,
  `stockbatch_status` enum('EDIT','CLOSED'),
  `it_comments` text,
  `d_id` int(11) unsigned,
  `device_id` varchar(50),
  `model` varchar(50),
  `device_status` enum('ACTIVE','RETIRED'),
  `warranty_expiry_date` date,
  `passcode` varchar(255),
  `sms_enabled` enum('Y','N'),
  `gprs_enabled` enum('Y','N'),
  `imei` varchar(50),
  `phone_device` int(7) unsigned,
  `phone_textback1` int(7) unsigned,
  `phone_textback2` int(7) unsigned,
  `sms_server` int(7) unsigned,
  `gprs_server` varchar(50),
  `realtime_useraccount` varchar(50),
  `realtime_password` varchar(50),
  `realtime_appname` varchar(50),
  `order_id` varchar(16),
  `device_comments` text
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_userbranches`
--

DROP TABLE IF EXISTS `vw_userbranches`;
/*!50001 DROP VIEW IF EXISTS `vw_userbranches`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_userbranches` (
  `id` int(11) unsigned,
  `idname` varchar(50),
  `username` varchar(32),
  `fullname` varchar(255),
  `email` varchar(100),
  `enabled` enum('Y','N'),
  `expiry_date` date,
  `branch_id` varchar(50),
  `department_id` varchar(50),
  `description` varchar(255),
  `location` varchar(255),
  `region_id` int(11) unsigned,
  `active` enum('Y','N')
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_vehicle_accounts`
--

DROP TABLE IF EXISTS `vw_vehicle_accounts`;
/*!50001 DROP VIEW IF EXISTS `vw_vehicle_accounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_vehicle_accounts` (
  `id` int(11) unsigned,
  `vehicle_id` varchar(20),
  `owner_id` varchar(8),
  `device_id` varchar(50),
  `chassis_number` varchar(50),
  `make` varchar(50),
  `vehicle_model` varchar(50),
  `color` varchar(50),
  `vehicletype` varchar(50),
  `vehicleusage` varchar(50),
  `installer` varchar(50),
  `installer_fullname` varchar(255),
  `location` varchar(50),
  `installation_date` date,
  `comments` text,
  `customer_type` enum('INDIVIDUAL','COMPANY'),
  `business_type` varchar(50),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `address1` varchar(255),
  `address2` varchar(255),
  `city` varchar(255),
  `region_id` int(11) unsigned,
  `country_id` varchar(2),
  `date_of_birth` date,
  `gender` enum('M','F','N'),
  `phone_home` int(7),
  `phone_work` int(7),
  `phone_mobile1` int(7),
  `phone_mobile2` int(7),
  `email_address` varchar(255),
  `driver_permit` varchar(10),
  `identification_card` varchar(12),
  `passport` varchar(10),
  `driver_permit_expiry_date` date,
  `emergency_contact` varchar(255),
  `emergency_contact_phone` varchar(7),
  `branch_id` varchar(50),
  `referrer_id` varchar(8),
  `customer_comments` text,
  `device_tag_id` varchar(50),
  `device_status` enum('ACTIVE','RETIRED'),
  `device_model` varchar(50),
  `warranty_expiry_date` date,
  `passcode` varchar(255),
  `sms_enabled` enum('Y','N'),
  `gprs_enabled` enum('Y','N'),
  `imei` varchar(50),
  `phone_device` int(7) unsigned,
  `phone_textback1` int(7) unsigned,
  `phone_textback2` int(7) unsigned,
  `sms_server` int(7) unsigned,
  `gprs_server` varchar(50),
  `realtime_useraccount` varchar(50),
  `realtime_password` varchar(50),
  `realtime_appname` varchar(50),
  `order_id` varchar(16),
  `device_comments` text,
  `plate` varchar(50),
  `security_code` varchar(2)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_vehiclecolor`
--

DROP TABLE IF EXISTS `vw_vehiclecolor`;
/*!50001 DROP VIEW IF EXISTS `vw_vehiclecolor`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_vehiclecolor` (
  `color` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_vehiclemake`
--

DROP TABLE IF EXISTS `vw_vehiclemake`;
/*!50001 DROP VIEW IF EXISTS `vw_vehiclemake`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_vehiclemake` (
  `make` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_vehiclemodel`
--

DROP TABLE IF EXISTS `vw_vehiclemodel`;
/*!50001 DROP VIEW IF EXISTS `vw_vehiclemodel`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_vehiclemodel` (
  `model` varchar(50)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `weekdays`
--

DROP TABLE IF EXISTS `weekdays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weekdays` (
  `id` int(11) unsigned NOT NULL,
  `weekday_id` varchar(21) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_weekday_id` (`weekday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `weekdays_hs`
--

DROP TABLE IF EXISTS `weekdays_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weekdays_hs` (
  `id` int(11) unsigned NOT NULL,
  `weekday_id` varchar(21) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) NOT NULL,
  `input_date` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL,
  `auth_date` datetime NOT NULL,
  `record_status` char(4) NOT NULL,
  `current_no` int(11) NOT NULL,
  PRIMARY KEY (`id`,`current_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `weekdays_is`
--

DROP TABLE IF EXISTS `weekdays_is`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weekdays_is` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weekday_id` varchar(21) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `inputter` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `auth_date` datetime DEFAULT NULL,
  `record_status` char(4) DEFAULT NULL,
  `current_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_weekday_id` (`weekday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'gbiz'
--
/*!50003 DROP FUNCTION IF EXISTS `func_CalculateExtendedPrice` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_CalculateExtendedPrice`(unit_price FLOAT, tax_percentage FLOAT, taxable VARCHAR(1)) RETURNS float(16,2)
BEGIN
	DECLARE ret FLOAT;		
	DECLARE tax_amount FLOAT;		
	IF taxable = 'Y' THEN
	    SET tax_amount = unit_price * (tax_percentage/100);
	ELSE
	    SET tax_amount ='0';
        END IF;
	set ret = unit_price + tax_amount;
	return (ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_CalculateTotalPrice` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_CalculateTotalPrice`(unit_price FLOAT, tax_percentage FLOAT, taxable VARCHAR(1)) RETURNS float(16,2)
BEGIN
	DECLARE ret FLOAT;		
	DECLARE tax_amount FLOAT;		
	IF taxable = 'Y' THEN
	    SET tax_amount = unit_price * (tax_percentage/100);
	ELSE
	    SET tax_amount ='0';
        END IF;
	set ret = unit_price + tax_amount;
	return (ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_DuplicateTelbookPhoneNo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_DuplicateTelbookPhoneNo`(var INT(7)) RETURNS char(1) CHARSET latin1
    READS SQL DATA
BEGIN
	DECLARE ret CHAR(1);
	DECLARE rcount int(11);
	SELECT count(telno) into rcount from telbooks where telno = var;
	IF rcount > 0 THEN
	    SET ret='Y';
	ELSE
	    SET ret='N';
        END IF;
        RETURN(ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_GETAGE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_GETAGE`(dob DATE) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE age INT;
	SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dob, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(dob, '00-%m-%d')) into age;
	RETURN age;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_IdAlpha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`%`*/ /*!50003 FUNCTION `func_IdAlpha`(vehicle_id VARCHAR(7)) RETURNS varchar(3) CHARSET latin1
    DETERMINISTIC
BEGIN
 	DECLARE ret VARCHAR(3);
	DECLARE idlen INT;		
	SELECT CHAR_LENGTH(vehicle_id) into idlen; 
	
	IF idlen < 7 THEN
		SET ret='SH';
          ELSE
		SELECT SUBSTRING(vehicle_id,0,3) into ret;
		
        END IF;
        RETURN(ret);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_OrderDetailDiscountTotal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_OrderDetailDiscountTotal`(qty FLOAT, unit_price FLOAT, discount_amount FLOAT, discount_type VARCHAR(10)) RETURNS float(16,2)
BEGIN
	DECLARE ret FLOAT;		
	IF discount_type = 'PERCENT' THEN
	    set discount_amount = (qty*unit_price) * (discount_amount / 100);
	END IF;
	set ret = discount_amount;
	return (ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_OrderDetailOrderTotal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_OrderDetailOrderTotal`(qty FLOAT, unit_price FLOAT, discount_amount FLOAT, tax_percentage FLOAT, taxable varchar(1), discount_type VARCHAR(10)) RETURNS float(16,2)
BEGIN
	DECLARE ret FLOAT;		
	DECLARE tax_amount FLOAT;		
	IF discount_type = 'PERCENT' THEN
	    set discount_amount = (qty*unit_price) * (discount_amount / 100);
	END IF;
	IF taxable = 'Y' THEN
	    SET tax_amount = ((qty*unit_price)-discount_amount) * (tax_percentage/ 100);
	ELSE
	    SET tax_amount ='0.00';
	END IF;
	set ret = (qty*unit_price) - discount_amount + tax_amount;
	return (ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_OrderDetailSubTotal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_OrderDetailSubTotal`(qty FLOAT, unit_price FLOAT, discount_amount FLOAT, discount_type VARCHAR(10)) RETURNS float(16,2)
BEGIN
	DECLARE ret FLOAT;		
	IF discount_type = 'PERCENT' THEN
	    set discount_amount = (qty*unit_price) * (discount_amount / 100);
	END IF;
	set ret = (qty*unit_price) - discount_amount;
	return (ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_OrderDetailTaxTotal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_OrderDetailTaxTotal`(qty FLOAT, unit_price FLOAT, discount_amount FLOAT, tax_percentage FLOAT, taxable VARCHAR(1), discount_type VARCHAR(10)) RETURNS float(16,2)
BEGIN
	DECLARE ret FLOAT;		
	DECLARE tax_amount FLOAT;		
	IF discount_type = 'PERCENT' THEN
	    set discount_amount = (qty*unit_price) * (discount_amount / 100);
	END IF;
	IF taxable = 'Y' THEN
	    SET tax_amount = ((qty*unit_price)-discount_amount) * (tax_percentage/ 100);
	ELSE
	    SET tax_amount ='0.00';
	END IF;
	set ret = tax_amount;
	return (ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_OrderDetailUnitTotal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 FUNCTION `func_OrderDetailUnitTotal`(qty FLOAT, unit_price FLOAT) RETURNS float(16,2)
BEGIN
	DECLARE ret FLOAT;
	set ret = (qty*unit_price);
	return (ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_SetNullToBlank` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`%`*/ /*!50003 FUNCTION `func_SetNullToBlank`(var VARCHAR(100)) RETURNS varchar(100) CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE ret VARCHAR(100);
	IF ISNULL(var) THEN
             SET ret="";
          ELSE
             SET ret=var;
        END IF;
        RETURN(ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_SetNullToZero` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`%`*/ /*!50003 FUNCTION `func_SetNullToZero`(var VARCHAR(20)) RETURNS float(16,2)
    DETERMINISTIC
BEGIN
	DECLARE ret FLOAT(16,2);
	IF var=null THEN
             SET ret='0.00';
          ELSE
             SET ret=var;
        END IF;
        RETURN(ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_SetToBlankCo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`%`*/ /*!50003 FUNCTION `func_SetToBlankCo`(var VARCHAR(255)) RETURNS varchar(255) CHARSET latin1
BEGIN
	DECLARE ret VARCHAR(255);
	IF var='CO.' THEN
             SET ret='';
          ELSE
             SET ret=var;
        END IF;
        RETURN(ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `func_SetToBlankZero` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`%`*/ /*!50003 FUNCTION `func_SetToBlankZero`(var INT(11)) RETURNS varchar(255) CHARSET latin1
BEGIN
	DECLARE ret VARCHAR(255);
	IF var=0 THEN
             SET ret='';
          ELSE
             SET ret=var;
        END IF;
        RETURN(ret);
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_AddAuditFields` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 PROCEDURE `sp_AddAuditFields`(IN tablename varchar(100), IN opt char(1))
BEGIN
	IF opt = 'I' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN inputter varchar(50) NULL DEFAULT NULL");
	ELSEIF opt = 'L' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN inputter varchar(50) NOT NULL DEFAULT ''");
	END IF;
 	PREPARE stmt FROM @qry;
 	EXECUTE stmt;
 	
 	IF opt = 'I' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN input_date datetime NULL DEFAULT NULL");
	ELSEIF opt = 'L' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN input_date datetime NOT NULL DEFAULT ''");
	END IF;
 	PREPARE stmt FROM @qry;
 	EXECUTE stmt;
		
	if opt = 'I' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN authorizer varchar(50) NULL DEFAULT NULL");
	elseIF opt = 'L' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN authorizer varchar(50) NOT NULL DEFAULT ''");
	end if;
 	PREPARE stmt FROM @qry;
 	EXECUTE stmt;
 	
 	IF opt = 'I' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN auth_date datetime NULL DEFAULT NULL");
	ELSEIF opt = 'L' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN auth_date datetime NOT NULL DEFAULT ''");
	END IF;
 	PREPARE stmt FROM @qry;
 	EXECUTE stmt;
 	
 	IF opt = 'I' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN record_status char(4) NULL DEFAULT NULL");
	ELSEIF opt = 'L' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN record_status char(4) NOT NULL DEFAULT ''");
	END IF;
 	PREPARE stmt FROM @qry;
 	EXECUTE stmt;
 	
 	IF opt = 'I' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN current_no int(11) NULL DEFAULT NULL");
	ELSEIF opt = 'L' THEN
		SET @qry = CONCAT("ALTER TABLE ",tablename," ADD COLUMN current_no int(11) NOT NULL DEFAULT ''");
	END IF;
 	PREPARE stmt FROM @qry;
 	EXECUTE stmt;
 	DEALLOCATE PREPARE stmt;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_CopyRecord` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 PROCEDURE `sp_CopyRecord`(IN tablename VARCHAR(255), alt_id_fld VARCHAR(255), src INT(11), dest int(11), alt_dest VARCHAR(255) )
BEGIN
	DROP table IF EXISTS `tmp`;
	SET @qry = CONCAT('CREATE TEMPORARY TABLE tmp SELECT * FROM ',tablename,' WHERE id=',src);
	PREPARE stmt FROM @qry;
 	EXECUTE stmt;
	
	IF alt_id_fld is not null THEN
		SET @qry = CONCAT('UPDATE tmp SET ',alt_id_fld,'="',alt_dest,'" WHERE id=',src);
		PREPARE stmt FROM @qry; 
		EXECUTE stmt;
	END IF;
		
	SET @qry = CONCAT('UPDATE tmp SET id=',dest,' WHERE id=',src);
	PREPARE stmt FROM @qry; 
	EXECUTE stmt;
		
	SET @qry = CONCAT('INSERT INTO ',tablename,' SELECT * FROM tmp WHERE id=',dest);
	PREPARE stmt FROM @qry; 
	EXECUTE stmt;
	DROP TABLE tmp;
	DEALLOCATE PREPARE stmt;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ENQ_contacttest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 PROCEDURE `sp_ENQ_contacttest`()
BEGIN
	DROP TABLE IF EXISTS `tt_contacttest`;
	CREATE TEMPORARY TABLE tt_contacttest 
	(
		contact_id VARCHAR(50) DEFAULT NULL,
		first_name VARCHAR(255) DEFAULT NULL,
		last_name VARCHAR(255) DEFAULT NULL
	) ENGINE=MEMORY;
	INSERT INTO tt_contacttest SELECT contact_id,first_name,last_name FROM contacts;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_t` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50020 DEFINER=`dbuser`@`localhost`*/ /*!50003 PROCEDURE `sp_t`(IN opt CHAR(1))
BEGIN
DECLARE resetid INT DEFAULT 0;
IF opt = 'Y' THEN
select * from contacts;
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vw_batchorders_lookup`
--

/*!50001 DROP TABLE IF EXISTS `vw_batchorders_lookup`*/;
/*!50001 DROP VIEW IF EXISTS `vw_batchorders_lookup`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_batchorders_lookup` AS (select `vw_orderbalances`.`id` AS `invoice_id`,`vw_orderbalances`.`order_id` AS `order_id`,`vw_orderbalances`.`order_date` AS `order_date`,`vw_orderbalances`.`first_name` AS `first_name`,`vw_orderbalances`.`order_details` AS `order_details`,`vw_orderbalances`.`last_name` AS `last_name`,`vw_orderbalances`.`extended_total` AS `extended_total`,`vw_orderbalances`.`tax_total` AS `tax_total`,`vw_orderbalances`.`order_total` AS `order_total`,`vw_orderbalances`.`payment_total` AS `payment_total`,`vw_orderbalances`.`balance` AS `balance`,`vw_orderbalances`.`payment_type` AS `payment_type` from `vw_orderbalances` where ((`vw_orderbalances`.`order_status` <> 'ORDER.CANCELLED') and (`vw_orderbalances`.`order_status` <> 'QUOTATION'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_batchtypes`
--

/*!50001 DROP TABLE IF EXISTS `vw_batchtypes`*/;
/*!50001 DROP VIEW IF EXISTS `vw_batchtypes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_batchtypes` AS (select distinct `batchinvoices`.`batch_type` AS `type` from `batchinvoices` order by `batchinvoices`.`batch_type`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_biztype`
--

/*!50001 DROP TABLE IF EXISTS `vw_biztype`*/;
/*!50001 DROP VIEW IF EXISTS `vw_biztype`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_biztype` AS (select distinct `customers`.`business_type` AS `business_type` from `customers` order by `customers`.`business_type`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_certificate_accounts`
--

/*!50001 DROP TABLE IF EXISTS `vw_certificate_accounts`*/;
/*!50001 DROP VIEW IF EXISTS `vw_certificate_accounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_certificate_accounts` AS (select `vw_vehicle_accounts`.`vehicle_id` AS `vehicle_id`,`vw_vehicle_accounts`.`first_name` AS `first_name`,`vw_vehicle_accounts`.`last_name` AS `last_name`,`vw_vehicle_accounts`.`device_tag_id` AS `device_tag_id`,`vw_vehicle_accounts`.`device_model` AS `device_model`,`vw_vehicle_accounts`.`phone_device` AS `phone_device` from `vw_vehicle_accounts` where ((`vw_vehicle_accounts`.`device_tag_id` <> 'NO.DEVICE') and (`vw_vehicle_accounts`.`device_status` <> 'RETIRED'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_core_fixedselections_available`
--

/*!50001 DROP TABLE IF EXISTS `vw_core_fixedselections_available`*/;
/*!50001 DROP VIEW IF EXISTS `vw_core_fixedselections_available`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_core_fixedselections_available` AS select `params`.`controller` AS `fixedselection_id` from `params` where ((`params`.`controller` <> 'site') and (not(`params`.`controller` in (select `fixedselections`.`fixedselection_id` AS `fixedselection_id` from `fixedselections`)))) union select `enquirydefs`.`controller` AS `fixedselection_id` from `enquirydefs` where (not(`enquirydefs`.`controller` in (select `fixedselections`.`fixedselection_id` AS `fixedselection_id` from `fixedselections`))) order by `fixedselection_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_core_users_noroles`
--

/*!50001 DROP TABLE IF EXISTS `vw_core_users_noroles`*/;
/*!50001 DROP VIEW IF EXISTS `vw_core_users_noroles`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_core_users_noroles` AS (select `users`.`idname` AS `idname`,`users`.`fullname` AS `fullname` from `users` where ((not(`users`.`idname` in (select `userroles`.`idname` AS `idname` from `userroles`))) and (`users`.`branch_id` <> '_SYSTEM'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_device_info`
--

/*!50001 DROP TABLE IF EXISTS `vw_device_info`*/;
/*!50001 DROP VIEW IF EXISTS `vw_device_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_device_info` AS (select `devices`.`id` AS `d_id`,`devices`.`device_id` AS `device_id`,`devices`.`model` AS `model`,`devices`.`device_status` AS `device_status`,`devices`.`warranty_expiry_date` AS `warranty_expiry_date`,`devices`.`passcode` AS `passcode`,`devices`.`sms_enabled` AS `sms_enabled`,`devices`.`gprs_enabled` AS `gprs_enabled`,`devices`.`imei` AS `imei`,`devices`.`phone_device` AS `phone_device`,`devices`.`phone_textback1` AS `phone_textback1`,`devices`.`phone_textback2` AS `phone_textback2`,`devices`.`sms_server` AS `sms_server`,`devices`.`gprs_server` AS `gprs_server`,`devices`.`realtime_useraccount` AS `realtime_useraccount`,`devices`.`realtime_password` AS `realtime_password`,`devices`.`realtime_appname` AS `realtime_appname`,`devices`.`order_id` AS `order_id`,`devices`.`comments` AS `device_comments`,`inventory_track_details`.`id` AS `itd_id`,`inventory_track_details`.`serial_no` AS `serial_no`,`inventory_track_details`.`stockbatch_id` AS `stockbatch_id`,`inventory_track_details`.`item_status` AS `item_status`,`inventory_track_details`.`item_comments` AS `item_comments`,`inventory_tracks`.`id` AS `it_id`,`inventory_tracks`.`stock_description` AS `stock_description`,`inventory_tracks`.`product_id` AS `product_id`,`inventory_tracks`.`stockin_date` AS `stockin_date`,`inventory_tracks`.`stockin_quantity` AS `stockin_quantity`,`inventory_tracks`.`stockbatch_status` AS `stockbatch_status`,`inventory_tracks`.`stockbatch_details` AS `stockbatch_details`,`inventory_tracks`.`comments` AS `it_comments` from ((`devices` left join `inventory_track_details` on((`devices`.`imei` = `inventory_track_details`.`serial_no`))) left join `inventory_tracks` on((`inventory_track_details`.`stockbatch_id` = `inventory_tracks`.`stockbatch_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_device_instock`
--

/*!50001 DROP TABLE IF EXISTS `vw_device_instock`*/;
/*!50001 DROP VIEW IF EXISTS `vw_device_instock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_device_instock` AS (select `inventory_track_details`.`serial_no` AS `serial_no`,`inventory_tracks`.`product_id` AS `product_id`,`inventory_track_details`.`item_status` AS `item_status`,`inventory_track_details`.`item_comments` AS `item_comments` from ((`inventory_track_details` left join `devices` on((`inventory_track_details`.`serial_no` = `devices`.`imei`))) join `inventory_tracks` on((`inventory_track_details`.`stockbatch_id` = `inventory_tracks`.`stockbatch_id`))) where (isnull(`devices`.`imei`) and (`inventory_track_details`.`item_status` like 'STOCK%'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_device_products`
--

/*!50001 DROP TABLE IF EXISTS `vw_device_products`*/;
/*!50001 DROP VIEW IF EXISTS `vw_device_products`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_device_products` AS (select `products`.`product_id` AS `product_id`,`products`.`product_description` AS `product_description` from `products` where ((`products`.`sub_category` like 'TRACKER%') and (`products`.`status` = 'ACTIVE') and (`products`.`type` = 'STOCK'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_devices_available`
--

/*!50001 DROP TABLE IF EXISTS `vw_devices_available`*/;
/*!50001 DROP VIEW IF EXISTS `vw_devices_available`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_devices_available` AS (select distinct `vw_device_info`.`d_id` AS `id`,`vw_device_info`.`device_id` AS `device_id`,`vw_device_info`.`serial_no` AS `imei`,`vw_device_info`.`model` AS `model`,`vw_device_info`.`phone_device` AS `phone_device`,`vw_device_info`.`item_status` AS `item_status` from (`vw_device_info` left join `vehicles` on((`vw_device_info`.`device_id` = `vehicles`.`device_id`))) where ((isnull(`vehicles`.`device_id`) and ((`vw_device_info`.`item_status` like 'STOCK%') or (`vw_device_info`.`item_status` = 'FLOATING')) and (`vw_device_info`.`device_status` = 'ACTIVE')) or (`vw_device_info`.`device_id` = 'NO.DEVICE'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_distinct_product_category`
--

/*!50001 DROP TABLE IF EXISTS `vw_distinct_product_category`*/;
/*!50001 DROP VIEW IF EXISTS `vw_distinct_product_category`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_distinct_product_category` AS (select distinct `products`.`category` AS `category` from `products`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_distinct_product_subcategory`
--

/*!50001 DROP TABLE IF EXISTS `vw_distinct_product_subcategory`*/;
/*!50001 DROP VIEW IF EXISTS `vw_distinct_product_subcategory`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_distinct_product_subcategory` AS (select distinct `products`.`sub_category` AS `sub_category` from `products`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_eomorders_lookup`
--

/*!50001 DROP TABLE IF EXISTS `vw_eomorders_lookup`*/;
/*!50001 DROP VIEW IF EXISTS `vw_eomorders_lookup`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_eomorders_lookup` AS (select `vw_orderbalances`.`id` AS `invoice_id`,`vw_orderbalances`.`order_id` AS `order_id`,`vw_orderbalances`.`order_date` AS `order_date`,`vw_orderbalances`.`first_name` AS `first_name`,`vw_orderbalances`.`last_name` AS `last_name`,`vw_orderbalances`.`extended_total` AS `extended_total`,`vw_orderbalances`.`tax_total` AS `tax_total`,`vw_orderbalances`.`payment_total` AS `payment_total`,`vw_orderbalances`.`payment_type` AS `payment_type` from `vw_orderbalances` where ((not((`vw_orderbalances`.`payment_type` like '%CASH%'))) and (`vw_orderbalances`.`customer_type` = 'INDIVIDUAL') and (`vw_orderbalances`.`order_status` = 'INVOICE.FULL.PAID') and (not(`vw_orderbalances`.`order_id` in (select `batchinvoicedetails`.`order_id` AS `order_id` from `batchinvoicedetails`))))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_estimator_products`
--

/*!50001 DROP TABLE IF EXISTS `vw_estimator_products`*/;
/*!50001 DROP VIEW IF EXISTS `vw_estimator_products`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_estimator_products` AS (select `products`.`product_id` AS `product_id`,`products`.`product_description` AS `product_description`,`products`.`type` AS `TYPE`,`products`.`taxable` AS `taxable`,`products`.`unit_price` AS `unit_price`,`func_CalculateTotalPrice`(`products`.`unit_price`,`products`.`tax_percentage`,`products`.`taxable`) AS `total_price`,`products`.`category` AS `category`,`products`.`sub_category` AS `sub_category` from `products` where (`products`.`status` = 'ACTIVE')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_inventchkout_sideinfo`
--

/*!50001 DROP TABLE IF EXISTS `vw_inventchkout_sideinfo`*/;
/*!50001 DROP VIEW IF EXISTS `vw_inventchkout_sideinfo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_inventchkout_sideinfo` AS select `orders`.`id` AS `id`,`orders`.`order_id` AS `order_id`,`orders`.`branch_id` AS `branch_id`,`orders`.`customer_id` AS `customer_id`,`customers`.`first_name` AS `first_name`,`customers`.`last_name` AS `last_name`,`orders`.`order_date` AS `order_date`,`orders`.`order_status` AS `order_status`,`orders`.`inventory_checkout_status` AS `inventory_checkout_status` from (`orders` join `customers` on((`orders`.`customer_id` = `customers`.`customer_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_inventprod_available`
--

/*!50001 DROP TABLE IF EXISTS `vw_inventprod_available`*/;
/*!50001 DROP VIEW IF EXISTS `vw_inventprod_available`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_inventprod_available` AS (select `products`.`id` AS `id`,`products`.`product_id` AS `product_id`,`products`.`product_description` AS `description` from `products` where ((not(`products`.`product_id` in (select `inventorys`.`product_id` AS `product_id` from `inventorys`))) and (`products`.`type` = 'STOCK'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_nonpackageproducts`
--

/*!50001 DROP TABLE IF EXISTS `vw_nonpackageproducts`*/;
/*!50001 DROP VIEW IF EXISTS `vw_nonpackageproducts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_nonpackageproducts` AS (select `products`.`id` AS `id`,`products`.`product_id` AS `product_id`,`products`.`type` AS `type`,`products`.`package_items` AS `package_items`,`products`.`product_description` AS `product_description`,`products`.`extended_description` AS `extended_description`,`products`.`category` AS `category`,`products`.`sub_category` AS `sub_category`,`products`.`unit_price` AS `unit_price`,`products`.`taxable` AS `taxable`,`products`.`tax_percentage` AS `tax_percentage`,`products`.`status` AS `status`,`products`.`inputter` AS `inputter`,`products`.`input_date` AS `input_date`,`products`.`authorizer` AS `authorizer`,`products`.`auth_date` AS `auth_date`,`products`.`record_status` AS `record_status`,`products`.`current_no` AS `current_no` from `products` where (`products`.`type` <> 'PACKAGE')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_orderbalances`
--

/*!50001 DROP TABLE IF EXISTS `vw_orderbalances`*/;
/*!50001 DROP VIEW IF EXISTS `vw_orderbalances`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_orderbalances` AS (select `orders`.`id` AS `id`,`orders`.`order_id` AS `order_id`,`orders`.`branch_id` AS `branch_id`,`orders`.`customer_id` AS `customer_id`,`customers`.`first_name` AS `first_name`,`customers`.`last_name` AS `last_name`,`customers`.`customer_type` AS `customer_type`,`customers`.`address1` AS `address1`,`customers`.`address2` AS `address2`,`customers`.`city` AS `city`,`customers`.`phone_mobile1` AS `phone_mobile1`,`customers`.`phone_home` AS `phone_home`,`customers`.`phone_work` AS `phone_work`,(select group_concat(`orderdetails`.`product_id`,'(',`orderdetails`.`qty`,')' separator ';') AS `aa` from `orderdetails` where (`orders`.`order_id` = `orderdetails`.`order_id`)) AS `order_details`,(select coalesce(group_concat(`payments`.`payment_type`,'(',`payments`.`amount`,')' separator ';'),'') AS `ba` from `payments` where ((`orders`.`order_id` = `payments`.`order_id`) and (`payments`.`payment_status` = 'VALID'))) AS `payment_type`,`orders`.`order_date` AS `order_date`,`orders`.`quotation_date` AS `quotation_date`,`orders`.`invoice_date` AS `invoice_date`,`orders`.`order_status` AS `order_status`,`orders`.`inventory_checkout_status` AS `inventory_checkout_status`,`orders`.`inventory_update_type` AS `inventory_update_type`,`orders`.`inputter` AS `inputter`,`orders`.`input_date` AS `input_date`,`orders`.`invoice_note` AS `invoice_note`,`orders`.`comments` AS `comments`,`orders`.`current_no` AS `current_no`,(select coalesce(sum(`func_OrderDetailUnitTotal`(`orderdetails`.`qty`,`orderdetails`.`unit_price`)),0) AS `ab` from `orderdetails` where (`orderdetails`.`order_id` = `orders`.`order_id`)) AS `unit_total`,(select coalesce(sum(`func_OrderDetailDiscountTotal`(`orderdetails`.`qty`,`orderdetails`.`unit_price`,`orderdetails`.`discount_amount`,`orderdetails`.`discount_type`)),0) AS `ac` from `orderdetails` where (`orderdetails`.`order_id` = `orders`.`order_id`)) AS `discount_total`,(select coalesce(sum(`func_OrderDetailSubTotal`(`orderdetails`.`qty`,`orderdetails`.`unit_price`,`orderdetails`.`discount_amount`,`orderdetails`.`discount_type`)),0) AS `ad` from `orderdetails` where (`orderdetails`.`order_id` = `orders`.`order_id`)) AS `extended_total`,(select coalesce(sum(`func_OrderDetailTaxTotal`(`orderdetails`.`qty`,`orderdetails`.`unit_price`,`orderdetails`.`discount_amount`,`orderdetails`.`tax_percentage`,`orderdetails`.`taxable`,`orderdetails`.`discount_type`)),0) AS `ae` from `orderdetails` where (`orderdetails`.`order_id` = `orders`.`order_id`)) AS `tax_total`,(select coalesce(sum(`func_OrderDetailOrderTotal`(`orderdetails`.`qty`,`orderdetails`.`unit_price`,`orderdetails`.`discount_amount`,`orderdetails`.`tax_percentage`,`orderdetails`.`taxable`,`orderdetails`.`discount_type`)),0) AS `af` from `orderdetails` where (`orderdetails`.`order_id` = `orders`.`order_id`)) AS `order_total`,(select coalesce(sum(`payments`.`amount`),0) AS `ag` from `payments` where ((`payments`.`order_id` = `orders`.`order_id`) and (`payments`.`payment_status` = 'VALID'))) AS `payment_total`,((select coalesce(sum(`func_OrderDetailOrderTotal`(`orderdetails`.`qty`,`orderdetails`.`unit_price`,`orderdetails`.`discount_amount`,`orderdetails`.`tax_percentage`,`orderdetails`.`taxable`,`orderdetails`.`discount_type`)),0) AS `ah` from `orderdetails` where (`orderdetails`.`order_id` = `orders`.`order_id`)) - (select coalesce(sum(`payments`.`amount`),0) AS `ai` from `payments` where ((`payments`.`order_id` = `orders`.`order_id`) and (`payments`.`payment_status` = 'VALID')))) AS `balance` from (`orders` join `customers` on((`orders`.`customer_id` = `customers`.`customer_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_orderbalances_nonzero`
--

/*!50001 DROP TABLE IF EXISTS `vw_orderbalances_nonzero`*/;
/*!50001 DROP VIEW IF EXISTS `vw_orderbalances_nonzero`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`l ocalhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_orderbalances_nonzero` AS (select `vw_orderbalances`.`order_id` AS `order_id`,`vw_orderbalances`.`branch_id` AS `branch_id`,`vw_orderbalances`.`customer_id` AS `customer_id`,`vw_orderbalances`.`first_name` AS `first_name`,`vw_orderbalances`.`last_name` AS `last_name`,`vw_orderbalances`.`order_date` AS `order_date`,`vw_orderbalances`.`order_status` AS `order_status`,`vw_orderbalances`.`order_total` AS `order_total`,`vw_orderbalances`.`payment_total` AS `payment_total`,`vw_orderbalances`.`balance` AS `balance` from `vw_orderbalances` where ((`vw_orderbalances`.`balance` > 0) and (`vw_orderbalances`.`order_status` <> 'ORDER.CANCELLED'))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_orderstatus`
--

/*!50001 DROP TABLE IF EXISTS `vw_orderstatus`*/;
/*!50001 DROP VIEW IF EXISTS `vw_orderstatus`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_orderstatus` AS (select `_sys_orderstatus`.`id` AS `id`,`_sys_orderstatus`.`order_status_id` AS `order_status_id` from `_sys_orderstatus` where (`_sys_orderstatus`.`progession_id` <= 5)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_technicians`
--

/*!50001 DROP TABLE IF EXISTS `vw_technicians`*/;
/*!50001 DROP VIEW IF EXISTS `vw_technicians`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_technicians` AS (select `users`.`idname` AS `idname`,`users`.`fullname` AS `fullname` from `users` where (`users`.`department_id` = 'TECHNICAL')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_telbooks_available`
--

/*!50001 DROP TABLE IF EXISTS `vw_telbooks_available`*/;
/*!50001 DROP VIEW IF EXISTS `vw_telbooks_available`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_telbooks_available` AS (select `vw_vehicle_accounts`.`id` AS `id`,`vw_vehicle_accounts`.`vehicle_id` AS `vehicle_id`,`vw_vehicle_accounts`.`phone_device` AS `telno`,trim(both ' ' from ucase(concat(convert(`func_SetToBlankCo`(`vw_vehicle_accounts`.`first_name`) using utf8),' ',convert(`vw_vehicle_accounts`.`last_name` using utf8)))) AS `username`,concat(`func_SetToBlankZero`(`vw_vehicle_accounts`.`phone_textback1`),'#',`func_SetToBlankZero`(`vw_vehicle_accounts`.`phone_textback2`),'#') AS `mobile`,`func_DuplicateTelbookPhoneNo`(`vw_vehicle_accounts`.`phone_device`) AS `duplicate_telno` from `vw_vehicle_accounts` where ((`vw_vehicle_accounts`.`sms_enabled` = 'Y') and (not(`vw_vehicle_accounts`.`vehicle_id` in (select `telbooks`.`plate` AS `plate` from `telbooks` where ((`telbooks`.`plate` <> NULL) or (`telbooks`.`plate` <> ''))))))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_trackers_info`
--

/*!50001 DROP TABLE IF EXISTS `vw_trackers_info`*/;
/*!50001 DROP VIEW IF EXISTS `vw_trackers_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_trackers_info` AS (select `inventory_track_details`.`id` AS `id`,`inventory_track_details`.`serial_no` AS `serial_no`,`inventory_track_details`.`stockbatch_id` AS `stockbatch_id`,`inventory_track_details`.`item_status` AS `item_status`,`inventory_track_details`.`item_comments` AS `item_comments`,`inventory_track_details`.`inputter` AS `inputter`,`inventory_track_details`.`input_date` AS `input_date`,`inventory_track_details`.`authorizer` AS `authorizer`,`inventory_track_details`.`auth_date` AS `auth_date`,`inventory_track_details`.`record_status` AS `record_status`,`inventory_track_details`.`current_no` AS `current_no`,`inventory_tracks`.`id` AS `it_id`,`inventory_tracks`.`stock_description` AS `stock_description`,`inventory_tracks`.`product_id` AS `product_id`,`inventory_tracks`.`stockin_date` AS `stockin_date`,`inventory_tracks`.`stockin_quantity` AS `stockin_quantity`,`inventory_tracks`.`stockbatch_status` AS `stockbatch_status`,`inventory_tracks`.`comments` AS `it_comments`,`devices`.`id` AS `d_id`,`devices`.`device_id` AS `device_id`,`devices`.`model` AS `model`,`devices`.`device_status` AS `device_status`,`devices`.`warranty_expiry_date` AS `warranty_expiry_date`,`devices`.`passcode` AS `passcode`,`devices`.`sms_enabled` AS `sms_enabled`,`devices`.`gprs_enabled` AS `gprs_enabled`,`devices`.`imei` AS `imei`,`devices`.`phone_device` AS `phone_device`,`devices`.`phone_textback1` AS `phone_textback1`,`devices`.`phone_textback2` AS `phone_textback2`,`devices`.`sms_server` AS `sms_server`,`devices`.`gprs_server` AS `gprs_server`,`devices`.`realtime_useraccount` AS `realtime_useraccount`,`devices`.`realtime_password` AS `realtime_password`,`devices`.`realtime_appname` AS `realtime_appname`,`devices`.`order_id` AS `order_id`,`devices`.`comments` AS `device_comments` from ((`inventory_track_details` left join `inventory_tracks` on((`inventory_track_details`.`stockbatch_id` = `inventory_tracks`.`stockbatch_id`))) left join `devices` on((`inventory_track_details`.`serial_no` = `devices`.`imei`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_userbranches`
--

/*!50001 DROP TABLE IF EXISTS `vw_userbranches`*/;
/*!50001 DROP VIEW IF EXISTS `vw_userbranches`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_userbranches` AS select `users`.`id` AS `id`,`users`.`idname` AS `idname`,`users`.`username` AS `username`,`users`.`fullname` AS `fullname`,`users`.`email` AS `email`,`users`.`enabled` AS `enabled`,`users`.`expiry_date` AS `expiry_date`,`users`.`branch_id` AS `branch_id`,`users`.`department_id` AS `department_id`,`branches`.`description` AS `description`,`branches`.`location` AS `location`,`branches`.`region_id` AS `region_id`,`branches`.`active` AS `active` from (`users` join `branches` on((`users`.`branch_id` = `branches`.`branch_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_vehicle_accounts`
--

/*!50001 DROP TABLE IF EXISTS `vw_vehicle_accounts`*/;
/*!50001 DROP VIEW IF EXISTS `vw_vehicle_accounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_vehicle_accounts` AS (select `vehicles`.`id` AS `id`,`vehicles`.`vehicle_id` AS `vehicle_id`,`vehicles`.`owner_id` AS `owner_id`,`vehicles`.`device_id` AS `device_id`,`vehicles`.`chassis_number` AS `chassis_number`,`vehicles`.`make` AS `make`,`vehicles`.`model` AS `vehicle_model`,`vehicles`.`color` AS `color`,`vehicles`.`vehicletype_id` AS `vehicletype`,`vehicles`.`vehicleusagetype_id` AS `vehicleusage`,`vehicles`.`installer` AS `installer`,`users`.`fullname` AS `installer_fullname`,`vehicles`.`location` AS `location`,`vehicles`.`installation_date` AS `installation_date`,`vehicles`.`comments` AS `comments`,`customers`.`customer_type` AS `customer_type`,`customers`.`business_type` AS `business_type`,`customers`.`first_name` AS `first_name`,`customers`.`last_name` AS `last_name`,`customers`.`address1` AS `address1`,`customers`.`address2` AS `address2`,`customers`.`city` AS `city`,`customers`.`region_id` AS `region_id`,`customers`.`country_id` AS `country_id`,`customers`.`date_of_birth` AS `date_of_birth`,`customers`.`gender` AS `gender`,`customers`.`phone_home` AS `phone_home`,`customers`.`phone_work` AS `phone_work`,`customers`.`phone_mobile1` AS `phone_mobile1`,`customers`.`phone_mobile2` AS `phone_mobile2`,`customers`.`email_address` AS `email_address`,`customers`.`driver_permit` AS `driver_permit`,`customers`.`identification_card` AS `identification_card`,`customers`.`passport` AS `passport`,`customers`.`driver_permit_expiry_date` AS `driver_permit_expiry_date`,`customers`.`emergency_contact` AS `emergency_contact`,`customers`.`emergency_contact_phone` AS `emergency_contact_phone`,`customers`.`branch_id` AS `branch_id`,`customers`.`referrer_id` AS `referrer_id`,`customers`.`comments` AS `customer_comments`,`devices`.`device_id` AS `device_tag_id`,`devices`.`device_status` AS `device_status`,`devices`.`model` AS `device_model`,`devices`.`warranty_expiry_date` AS `warranty_expiry_date`,`devices`.`passcode` AS `passcode`,`devices`.`sms_enabled` AS `sms_enabled`,`devices`.`gprs_enabled` AS `gprs_enabled`,`devices`.`imei` AS `imei`,`devices`.`phone_device` AS `phone_device`,`devices`.`phone_textback1` AS `phone_textback1`,`devices`.`phone_textback2` AS `phone_textback2`,`devices`.`sms_server` AS `sms_server`,`devices`.`gprs_server` AS `gprs_server`,`devices`.`realtime_useraccount` AS `realtime_useraccount`,`devices`.`realtime_password` AS `realtime_password`,`devices`.`realtime_appname` AS `realtime_appname`,`devices`.`order_id` AS `order_id`,`devices`.`comments` AS `device_comments`,`telbooks`.`plate` AS `plate`,`telbooks`.`security_code` AS `security_code` from ((((`vehicles` join `customers` on((`vehicles`.`owner_id` = `customers`.`customer_id`))) join `devices` on((`vehicles`.`device_id` = `devices`.`device_id`))) join `users` on((`vehicles`.`installer` = `users`.`idname`))) left join `telbooks` on((`vehicles`.`vehicle_id` = `telbooks`.`vehicle_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_vehiclecolor`
--

/*!50001 DROP TABLE IF EXISTS `vw_vehiclecolor`*/;
/*!50001 DROP VIEW IF EXISTS `vw_vehiclecolor`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_vehiclecolor` AS (select distinct `vehicles`.`color` AS `color` from `vehicles` order by `vehicles`.`color`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_vehiclemake`
--

/*!50001 DROP TABLE IF EXISTS `vw_vehiclemake`*/;
/*!50001 DROP VIEW IF EXISTS `vw_vehiclemake`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_vehiclemake` AS (select distinct `vehicles`.`make` AS `make` from `vehicles` order by `vehicles`.`make`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_vehiclemodel`
--

/*!50001 DROP TABLE IF EXISTS `vw_vehiclemodel`*/;
/*!50001 DROP VIEW IF EXISTS `vw_vehiclemodel`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`dbuser`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_vehiclemodel` AS (select distinct `vehicles`.`model` AS `model` from `vehicles` order by `vehicles`.`model`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-03 23:57:23
