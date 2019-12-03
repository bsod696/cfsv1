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


-- Dumping database structure for cfsv1
DROP DATABASE IF EXISTS `cfsv1`;
CREATE DATABASE IF NOT EXISTS `cfsv1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cfsv1`;

-- Dumping structure for table cfsv1.account_details
DROP TABLE IF EXISTS `account_details`;
CREATE TABLE IF NOT EXISTS `account_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `staffid` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billaddr1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `billaddr2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banknum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `defaultpay` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.account_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `account_details` DISABLE KEYS */;
INSERT INTO `account_details` (`id`, `staffid`, `fullname`, `billaddr1`, `billaddr2`, `city`, `zipcode`, `state`, `country`, `bankname`, `banknum`, `defaultpay`, `created_at`, `updated_at`) VALUES
	(2, 9, 'Vladislaus Dragillius', '55, Jalan Hang Tuah', 'Taman Cempaka', 'Ipoh', '25555', 'Perak', 'Malaysia', 'MAYBANK', 'MBB859595966585', 'Y', '2019-12-03 00:30:15', '2019-12-03 00:47:00');
/*!40000 ALTER TABLE `account_details` ENABLE KEYS */;

-- Dumping structure for table cfsv1.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenum` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.admins: ~0 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `username`, `fullname`, `phonenum`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin1', 'Admin Satu', '0123456789', 'admin.satu@gmail.com', NULL, '$2y$10$6dTNSgLPUewUrLKQlviR.eyEMXiSrlMkqK5D5HYJM68LALpiYqQo2', NULL, '2019-11-09 13:22:41', '2019-11-09 13:22:41');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table cfsv1.allergy
DROP TABLE IF EXISTS `allergy`;
CREATE TABLE IF NOT EXISTS `allergy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `allergies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.allergy: ~8 rows (approximately)
/*!40000 ALTER TABLE `allergy` DISABLE KEYS */;
INSERT INTO `allergy` (`id`, `allergies`, `studentid`, `created_at`, `updated_at`) VALUES
	(1, 'shellfish', NULL, '2019-11-14 00:55:59', '2019-11-14 00:59:10'),
	(2, 'dairy', NULL, '2019-11-14 00:56:14', '2019-11-14 00:56:14'),
	(3, 'peanuts', NULL, '2019-11-14 00:56:27', '2019-11-14 00:58:38'),
	(4, 'treenuts', NULL, '2019-11-14 00:56:34', '2019-11-27 16:48:56'),
	(5, 'eggs', NULL, '2019-11-14 00:58:57', '2019-11-14 00:58:57'),
	(6, 'wheat', NULL, '2019-11-14 00:59:26', '2019-11-14 01:01:00'),
	(7, 'soy', NULL, '2019-11-14 00:59:43', '2019-11-14 00:59:43'),
	(8, 'fish', NULL, '2019-11-14 01:00:15', '2019-11-14 01:00:15'),
	(9, 'noallergy', NULL, '2019-11-27 14:41:26', '2019-11-27 14:41:26');
/*!40000 ALTER TABLE `allergy` ENABLE KEYS */;

-- Dumping structure for table cfsv1.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cfsv1.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table cfsv1.menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menuname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menudesc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menutype` enum('food','beverage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `allergyid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuprice` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menucalories` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menupic` text COLLATE utf8mb4_unicode_ci,
  `staffid` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.menus: ~5 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `menuname`, `menudesc`, `menutype`, `allergyid`, `menuprice`, `menucalories`, `menupic`, `staffid`, `created_at`, `updated_at`) VALUES
	(1, 'Nasi Lemak Telur Rebus', 'Coconut rice with Cooked Chillies to with slices of cucumbers, fried anchovies, fried peanuts and half of hard-boiled eggs', 'food', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:1;s:9:"noallergy";b:0;}', '2.50', '720', 'https://images.unicartapp.com/image/dzafstore/image/data/NL.jpg', '1', '2019-11-10 17:54:58', '2019-12-02 04:44:24'),
	(2, 'Mi Goreng Mamak', 'Egg noodles stir-fried with soy sauce, chilli paste. Top it off with tofu and some veggies (mustard and bean sprouts).', 'food', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:1;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2.40', '650', 'https://assets.nst.com.my/images/articles/26ntmee3_1535260361.jpg', '2', '2019-11-10 18:18:16', '2019-12-02 04:45:07'),
	(3, 'Rose Syrup', 'Icy cold water with Rose Syrup and sugar', 'beverage', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:1;}', '1.00', '200', 'storage/images/admin/menup/147303dd/MENUP147303dd.jpg', '2', '2019-11-10 18:28:41', '2019-12-02 16:14:28'),
	(4, 'Curry Puff', 'Butter Pastry stuffed with dry potato and chicken curry. Fried until golden brown and crispy.', 'food', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:1;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '0.50', '210', 'storage/images/admin/menup/14ba03c7/MENUP14ba03c7.jpg', NULL, '2019-12-02 04:10:42', '2019-12-02 16:13:36');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table cfsv1.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cfsv1.migrations: ~3 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table cfsv1.months
DROP TABLE IF EXISTS `months`;
CREATE TABLE IF NOT EXISTS `months` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `monthnum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.months: ~11 rows (approximately)
/*!40000 ALTER TABLE `months` DISABLE KEYS */;
INSERT INTO `months` (`id`, `monthnum`, `month`, `created_at`, `updated_at`) VALUES
	(1, '01', 'January', '2019-11-27 15:28:32', '2019-11-27 15:28:32'),
	(2, '02', 'February', '2019-11-27 15:28:48', '2019-11-27 15:28:48'),
	(3, '03', 'March', '2019-11-27 15:28:59', '2019-11-27 15:28:59'),
	(4, '04', 'April', '2019-11-27 15:29:08', '2019-11-27 15:29:08'),
	(5, '05', 'May', '2019-11-27 15:29:15', '2019-11-27 15:29:15'),
	(6, '06', 'June', '2019-11-27 15:29:41', '2019-11-27 15:29:41'),
	(7, '07', 'July', '2019-11-27 15:29:49', '2019-11-27 15:29:49'),
	(8, '08', 'August', '2019-11-27 15:30:04', '2019-11-27 15:30:04'),
	(9, '09', 'September', '2019-11-27 15:30:13', '2019-11-27 15:30:13'),
	(10, '10', 'October', '2019-11-27 15:30:26', '2019-11-27 15:30:26'),
	(11, '11', 'November', '2019-11-27 15:30:36', '2019-11-27 15:30:36'),
	(12, '12', 'December', '2019-11-27 15:30:48', '2019-11-27 15:30:48');
/*!40000 ALTER TABLE `months` ENABLE KEYS */;

-- Dumping structure for table cfsv1.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentid` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studentname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menudate` timestamp NOT NULL,
  `menuprice` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuqty` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redeemstatus` enum('REDEEMED','NOTREDEEEMED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NOTREDEEEMED',
  `redeemdate` timestamp NULL DEFAULT NULL,
  `txid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staffid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.orders: ~4 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `parentid`, `studentid`, `studentname`, `menuid`, `menuname`, `menudate`, `menuprice`, `menuqty`, `redeemstatus`, `redeemdate`, `txid`, `staffid`, `created_at`, `updated_at`) VALUES
	(4, '17', 'SC001', 'Student Satu bin Parent Satu', '1', 'Nasi Lemak Telur Rebus', '2019-11-10 17:54:58', '2.50', '3', 'NOTREDEEEMED', NULL, 'CFSP17D4H1573758074TXDRW12', NULL, '2019-11-14 03:15:30', '2019-11-15 03:01:14'),
	(6, '17', 'SC003', 'Student Tiga', '2', 'Mi Goreng Mamak', '2019-11-10 18:18:16', '2.40', '1', 'NOTREDEEEMED', NULL, 'CFSP17D6H1573758299TXLZJFK', NULL, '2019-11-15 03:04:48', '2019-11-15 03:04:59'),
	(7, '17', 'SC003', 'Student Tiga', '2', 'Mi Goreng Mamak', '2019-11-10 18:18:16', '2.40', '1', 'NOTREDEEEMED', NULL, '', NULL, '2019-11-15 03:19:56', '2019-11-15 03:19:56'),
	(8, '17', 'SC002', 'Student Dua', '3', 'Rose Syrup ', '2019-11-10 18:28:41', '1.00', '2', 'NOTREDEEEMED', NULL, '', NULL, '2019-11-15 04:03:44', '2019-11-15 04:03:44'),
	(9, '17', 'SC008', 'Student Lapan', '1', 'Nasi Lemak Telur Rebus', '2019-11-10 17:54:58', '2.50', '3', 'NOTREDEEEMED', NULL, '', '', '2019-11-26 00:47:45', '2019-11-26 00:47:45'),
	(10, '17', 'SC00X', 'Student X', '1', 'Nasi Lemak Telur Rebus', '2019-11-10 17:54:58', '2.50', '3', 'NOTREDEEEMED', NULL, 'CFSP17D10H1574792695TXULUG4', '', '2019-11-27 02:24:46', '2019-11-27 02:24:55');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table cfsv1.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cfsv1.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table cfsv1.payment_details
DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE IF NOT EXISTS `payment_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billaddr1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `billaddr2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardtype` enum('visa','mastercard') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardnum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cvvnum` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expdate` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `defaultpay` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cardnum` (`cardnum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.payment_details: ~4 rows (approximately)
/*!40000 ALTER TABLE `payment_details` DISABLE KEYS */;
INSERT INTO `payment_details` (`id`, `parentid`, `fullname`, `billaddr1`, `billaddr2`, `city`, `zipcode`, `state`, `country`, `cardtype`, `cardnum`, `cvvnum`, `expdate`, `defaultpay`, `created_at`, `updated_at`) VALUES
	(1, 17, 'User Satu', '55, Jalan Hang Tuah', 'Taman Cempaka', 'Ipoh', '32050', 'Perak', 'Malaysia', 'mastercard', '452356835235', '566', '12/20', 'Y', '2019-11-25 23:46:54', '2019-11-27 02:21:30'),
	(2, 17, 'User Satu', '79, Lorong Jaya 1/A2', 'Persiaran Lapangan Sentosa', 'Chemor', '32222', 'Sarawak', 'Malaysia', 'mastercard', '78542784527845', '222', '03/21', 'N', '2019-11-26 00:03:22', '2019-11-27 14:59:51'),
	(3, 20, 'Hariz', '34, Jalan Lapangan A/12', 'Persiaran Las Manors', 'Ipoh', '32060', 'Perak', 'Malaysia', 'visa', '7845548745', '785', '02/23', 'N', '2019-11-27 14:47:23', '2019-11-27 15:08:18'),
	(4, 20, 'Hariz', '99, Lorong 1', 'Taman Mas', 'Sungai Buloh', '56888', 'Selangor', 'Malaysia', 'mastercard', '85296385296', '746', '11/21', 'Y', '2019-11-27 14:52:39', '2019-11-27 15:25:38');
/*!40000 ALTER TABLE `payment_details` ENABLE KEYS */;

-- Dumping structure for table cfsv1.staffs
DROP TABLE IF EXISTS `staffs`;
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenum` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.staffs: ~7 rows (approximately)
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
INSERT INTO `staffs` (`id`, `username`, `fullname`, `phonenum`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'staff1', 'Staff Satu', '0168859966', 'staff.satu@gmail.com', NULL, '$2y$10$iUYcbpBK0ikwmpj9V8kqPeguXcWtYJVk.Dd1ad7o5dPVYNE9D3rLu', NULL, '2019-11-09 13:50:08', '2019-12-03 01:19:36'),
	(2, 'staff2', 'Staff Dua', '0125355666', 'staff.dua@gmail.com', NULL, '$2y$10$mgdwZ8Ar1YFzMvqjB3s3LOMFPeubNZYYcScb9QJdOzWTtbh1zNn3O', NULL, '2019-11-13 22:23:37', '2019-11-13 22:23:37'),
	(3, 'staff3', 'Staff Tiga', '01255568555', 'staff.tiga@gmail.com', NULL, '$2y$10$lmVdzUSE0Y0aFNXu/9KwcOwxKB8pP.Ea.ceU1upPFa50nT.4DQD/m', NULL, '2019-11-13 22:26:35', '2019-11-13 22:26:35'),
	(4, 'staff4', 'Staff Empat', '0523332222', 'staff.empat@gmail.com', NULL, '$2y$10$uHZyDOzJcdF7Cb3qeQVE1OTmWUKD6G/MdbJvjUbIgJXo1H/f2Bt3q', NULL, '2019-11-13 22:31:08', '2019-11-13 22:31:08'),
	(5, 'staff5', 'Staff Lima', '0165538555', 'staff.lima@gmail.com', NULL, '$2y$10$ToDlGNsQajck9DkZ2IaiHudW5mqXHtNvDOxHayf546MqGqz037onC', NULL, '2019-11-13 22:48:55', '2019-11-13 22:48:55'),
	(6, 'staff6', 'Staff Enam', '0156835598', 'staff.enam@gmail.com', NULL, '$2y$10$r03C97dsb54Ma7dhbhUVOuty0K.W6UTG5OKJaRlWhNEIKQnZDeQ.K', NULL, '2019-11-13 22:50:08', '2019-12-02 22:46:50'),
	(7, 'staff8', 'Staff Lapan', '02533366888', 'staff.lapan@gmail.com', NULL, '$2y$10$B/T/Db0vlHXLJVKhQ4FD4uu0n1ZUFpTSRs/.0SAQccvOgshVyzMuy', NULL, '2019-11-13 23:06:11', '2019-11-13 23:06:11'),
	(8, 'staff9', 'Staff Sembilan', '0195558866', 'staff.sembilan@gmail.com', NULL, '$2y$10$3VlFaotjPxp3ykXERcwLsuVwUCov07fkE3SJvwd4n9UYkOAKk/Tby', NULL, '2019-11-13 23:08:27', '2019-11-13 23:08:27'),
	(9, 'vladislaus', 'Vladislaus Dragillius', '0156668566', 'vladislaus.dragillius@gmail.com', NULL, '$2y$10$Nn/rQO7lktB8F00rN.ZdsOg4tzpYWA9CvAkwfqBOxHasp8yfIGd3K', 'KiOw8y4oPMGcmWbGqBihmQHpDVTyfRkEZefQlF2W9QSzhxPXn7s7I1Zm2P3S', '2019-11-27 01:13:19', '2019-11-27 01:42:36');
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;

-- Dumping structure for table cfsv1.student
DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentid` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_parentid` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_parentid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_session` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmi` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_calories` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allergies` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `studentid` (`studentid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.student: ~5 rows (approximately)
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`id`, `fullname`, `studentid`, `primary_parentid`, `secondary_parentid`, `class`, `school_session`, `dob`, `age`, `height`, `weight`, `gender`, `bmi`, `target_calories`, `allergies`, `created_at`, `updated_at`) VALUES
	(3, 'Student Satu bin Parent Satu', 'SC001', '17', NULL, '1A', 'morning', '2009-07-14', '10', '155', '56', 'male', '23.3', '2533', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:8:"treenuts";b:1;s:4:"eggs";b:0;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-11-10 14:35:09', '2019-12-02 22:39:59'),
	(5, 'Student Dua', 'SC002', NULL, '17', '4A', 'afternoon', '2011-10-13', '8', '166', '55', 'female', '20.0', '3200', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:1;s:9:"noallergy";b:0;}', '2019-11-10 14:51:18', '2019-11-27 16:51:26'),
	(6, 'Student Tiga', 'SC003', '17', NULL, '2A', 'morning', '1999-11-30', '19', '120', '45', 'male', '31.3', '1800', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:1;}', '2019-11-15 02:08:30', '2019-11-27 16:52:16'),
	(7, 'Student Lapan', 'SC008', '17', NULL, '2A', 'morning', '2019-11-12', '0', '120', '45', 'male', '31.3', '1498', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-11-20 09:54:43', '2019-11-27 16:52:40'),
	(8, 'Student Sembilan', 'SC009', '17', NULL, '4A', 'morning', '2003-11-11', '16', '153', '54', 'male', '23.1', '2400', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:1;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-11-27 01:44:22', '2019-11-27 16:52:59'),
	(10, 'Student X', 'SC00X', '17', NULL, '1A', 'morning', '2019-11-11', '0', '144', '52', 'male', '25.1', '2645', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:1;s:7:"peanuts";b:1;s:8:"treenuts";b:1;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:1;s:9:"noallergy";b:0;}', '2019-11-27 01:53:42', '2019-11-27 16:53:24'),
	(11, 'Nur Jamiah Binti Muhammed Hariz', 'SC0012', '20', NULL, '2A', 'morning', '2010-12-15', '8', '142', '45', 'female', '22.3', '2100', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:1;}', '2019-11-27 14:43:38', '2019-11-27 16:53:43');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

-- Dumping structure for table cfsv1.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menuid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txstatus` enum('success','fail') COLLATE utf8mb4_unicode_ci NOT NULL,
  `txreference` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txamount` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.transaction: ~2 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `menuid`, `parentid`, `orderid`, `txstatus`, `txreference`, `txamount`, `txid`, `created_at`, `updated_at`) VALUES
	(1, '1', '17', '4', 'success', 'PAYORDERS', '7.50', 'CFSP17D4H1573758074TXDRW12', '2019-11-15 03:01:14', '2019-11-15 03:01:14'),
	(2, '2', '17', '6', 'success', 'PAYORDERS', '2.40', 'CFSP17D6H1573758299TXLZJFK', '2019-11-15 03:04:59', '2019-11-15 03:04:59');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;

-- Dumping structure for table cfsv1.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenum` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usrrole` enum('parent','child') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phonenum` (`phonenum`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cfsv1.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `fullname`, `phonenum`, `usrrole`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(17, 'user1', 'Sulaiman Yaasin bin Abdul Kamal', '0123456789', 'parent', 'user.satu@gmail.com', NULL, '$2y$10$iUYcbpBK0ikwmpj9V8kqPeguXcWtYJVk.Dd1ad7o5dPVYNE9D3rLu', NULL, '2019-11-09 14:11:54', '2019-12-02 22:34:10'),
	(18, 'user2', 'Rosli Zaman bin Kadir Rahman', '01255633664', 'parent', 'user.dua@gmail.com', NULL, '$2y$10$HslMn0ay4Wt5qE64K8wOW.zhCH0OUSuoLuf/g/EkvIGMP9QAvY2U6', NULL, '2019-11-26 23:41:39', '2019-12-02 22:35:04'),
	(19, 'user3', 'Yusoff Jamal bin Ghafarruddin', '01233333333', 'parent', 'user.tiga@gmail.com', NULL, '$2y$10$hGgd9Tt6v/Iax9VHtixZ2.nnGUCcnBSlyd/s5.R5l7AzVWa0u51fa', NULL, '2019-11-26 23:45:56', '2019-12-02 22:35:37'),
	(20, 'bsod666', 'Muhammed Hariz bin Sulaiman', '01126379781', 'parent', 'muhammedharizzubir@gmail.com', NULL, '$2y$10$1dtZK22SdsifczBGakCN0un7KyLP6kSf/9qL2ZHNt/Rfu2dCuN4hO', '4smUqJ49kwz3kk0KnPhrFDpqU5ZyyLCnQD9ZhwLtO3BcuKJJF9VBVaXPTYHh', '2019-11-27 00:46:23', '2019-12-02 22:36:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table cfsv1.years
DROP TABLE IF EXISTS `years`;
CREATE TABLE IF NOT EXISTS `years` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `yearsnum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.years: ~6 rows (approximately)
/*!40000 ALTER TABLE `years` DISABLE KEYS */;
INSERT INTO `years` (`id`, `yearsnum`, `years`, `created_at`, `updated_at`) VALUES
	(1, '20', '2020', '2019-11-27 15:31:55', '2019-11-27 15:31:55'),
	(2, '21', '2021', '2019-11-27 15:32:02', '2019-11-27 15:32:02'),
	(3, '22', '2022', '2019-11-27 15:32:07', '2019-11-27 15:32:07'),
	(4, '23', '2023', '2019-11-27 15:32:11', '2019-11-27 15:32:14'),
	(5, '24', '2024', '2019-11-27 15:34:33', '2019-11-27 15:34:33'),
	(6, '25', '2025', '2019-11-27 15:34:41', '2019-11-27 15:34:41'),
	(7, '26', '2026', '2019-11-27 15:34:49', '2019-11-27 15:34:49');
/*!40000 ALTER TABLE `years` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
