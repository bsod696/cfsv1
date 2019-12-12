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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.account_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `account_details` DISABLE KEYS */;
INSERT INTO `account_details` (`id`, `staffid`, `fullname`, `billaddr1`, `billaddr2`, `city`, `zipcode`, `state`, `country`, `bankname`, `banknum`, `defaultpay`, `created_at`, `updated_at`) VALUES
	(2, 9, 'Vladislaus Dragillius', '55, Jalan Hang Tuah', 'Taman Cempaka', 'Ipoh', '25555', 'Perak', 'Malaysia', 'MAYBANK', 'MBB859595966585', 'Y', '2019-12-03 00:30:15', '2019-12-03 00:47:00'),
	(3, 1, 'Ghazali bin Ahmad', '5, Lorong Hajjah Rodiah', 'Taman Air Manis', 'Sabak Bernam', '65262', 'Malacca', 'Malaysia', 'Bank Islam Berhad', '25632525852', 'Y', '2019-12-03 14:57:04', '2019-12-03 15:03:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.menus: ~8 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `menuname`, `menudesc`, `menutype`, `allergyid`, `menuprice`, `menucalories`, `menupic`, `staffid`, `created_at`, `updated_at`) VALUES
	(1, 'Nasi Lemak Telur Rebus', 'Coconut rice with Cooked Chillies to with slices of cucumbers, fried anchovies, fried peanuts and half of hard-boiled eggs', 'food', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:1;s:9:"noallergy";b:0;}', '2.50', '720', 'storage/images/admin/menup/00000001/MENUP00000001.jpg', '1', '2019-11-10 17:54:58', '2019-12-06 00:30:09'),
	(2, 'Mi Goreng Mamak', 'Egg noodles stir-fried with soy sauce, chilli paste. Top it off with tofu and some veggies (mustard and bean sprouts).', 'food', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:1;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2.40', '650', 'https://assets.nst.com.my/images/articles/26ntmee3_1535260361.jpg', '2', '2019-11-10 18:18:16', '2019-12-02 04:45:07'),
	(3, 'Rose Syrup', 'Icy cold water with Rose Syrup and sugar', 'beverage', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:1;}', '1.00', '200', 'storage/images/admin/menup/00000001/MENUP00000001.jfif', '2', '2019-11-10 18:28:41', '2019-12-09 03:36:59'),
	(4, 'Curry Puff', 'Butter Pastry stuffed with dry potato and chicken curry. Fried until golden brown and crispy.', 'food', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:1;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '0.50', '210', 'storage/images/admin/menup/14ba03c7/MENUP14ba03c7.jpg', NULL, '2019-12-02 04:10:42', '2019-12-02 16:13:36'),
	(5, 'Keria', 'Fried sweet potato and glaze with sugar syrup', 'food', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '0.40', '352', 'storage/images/admin/menup/059901ed/MENUP059901ed.jpg', NULL, '2019-12-04 02:49:55', '2019-12-04 02:49:55'),
	(6, 'Mi Rebus', 'Egg noodles with shrimp and sweet potato curry soup.', 'food', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:1;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '3.50', '785', 'storage/images/admin/menup/0bc002d8/MENUP0bc002d8.jpg', NULL, '2019-12-04 02:53:06', '2019-12-04 02:53:06'),
	(7, 'Lemonade', 'Fresh squeezed lemon with icy cold water', 'beverage', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:1;}', '1.00', '142', 'storage/images/admin/menup/0dec0326/MENUP0dec0326.jpg', NULL, '2019-12-04 02:56:37', '2019-12-04 02:56:37'),
	(8, 'Tteokbokki', 'Chewy rice cakes cooked in sweet and spicy Korean sauce', 'food', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:1;s:4:"fish";b:1;s:9:"noallergy";b:0;}', '5.30', '785', 'storage/images/admin/menup/163f0418/MENUP163f0418.jpg', NULL, '2019-12-06 05:42:47', '2019-12-06 05:42:47');
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
  `studentid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.orders: ~18 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `parentid`, `studentid`, `studentname`, `menuid`, `menuname`, `menudate`, `menuprice`, `menuqty`, `redeemstatus`, `redeemdate`, `txid`, `staffid`, `created_at`, `updated_at`) VALUES
	(4, '17', 'SC001', 'Student Satu bin Parent Satu', '1', 'Nasi Lemak Telur Rebus', '2019-12-06 17:54:58', '2.50', '3', 'REDEEMED', '2019-12-03 19:47:04', 'CFSP17D4H1573758074TXDRW12', '1', '2019-11-14 03:15:30', '2019-12-12 03:44:37'),
	(6, '17', 'SC001', 'Student Satu bin Parent Satu', '2', 'Mi Goreng Mamak', '2019-12-06 17:54:58', '2.40', '1', 'NOTREDEEEMED', '2019-12-03 19:47:04', 'CFSP17D6H1573758299TXLZJFK', '1', '2019-11-15 03:04:48', '2019-12-05 00:48:33'),
	(7, '17', 'SC003', 'Student Tiga', '2', 'Mi Goreng Mamak', '2019-11-10 18:18:16', '2.40', '1', 'NOTREDEEEMED', NULL, 'CFSP17D7H1575393870TXMQ9NP', NULL, '2019-11-15 03:19:56', '2019-12-04 01:24:30'),
	(8, '17', 'SC002', 'Student Dua', '3', 'Rose Syrup ', '2019-11-10 18:28:41', '1.00', '2', 'NOTREDEEEMED', NULL, 'CFSP17D8P1H1575396711TXOAFGI', NULL, '2019-11-15 04:03:44', '2019-12-04 02:11:51'),
	(10, '17', 'SC00X', 'Student X', '1', 'Nasi Lemak Telur Rebus', '2019-12-11 17:54:58', '2.50', '3', 'NOTREDEEEMED', NULL, 'CFSP17D10H1574792695TXULUG4', '1', '2019-11-27 02:24:46', '2019-12-05 00:53:54'),
	(11, '17', 'SCasdfghj', 'Student 11', '2', 'Mi Goreng Mamak', '2019-12-03 00:00:00', '2.40', '1', 'NOTREDEEEMED', NULL, 'CFSP17D11P1H1575396764TX1NWBH', '1', '2019-12-03 18:41:55', '2019-12-05 00:55:39'),
	(12, '17', 'SC008', 'Student Lapan', '4', 'Curry Puff', '2019-12-03 00:00:00', '0.50', '2', 'NOTREDEEEMED', NULL, 'CFSP17D12P1H1575396721TXBZNOG', '1', '2019-12-03 20:04:44', '2019-12-08 02:54:08'),
	(13, '20', 'SC004', 'Park Chae Young', '6', 'Mi Rebus', '2019-12-09 00:00:00', '3.50', '1', 'NOTREDEEEMED', NULL, 'CFSP20D13P3H1575755532TX6PHAL', '1', '2019-12-06 01:08:41', '2019-12-08 06:17:31'),
	(15, '20', 'SC004', 'Park Chae Young', '7', 'Lemonade', '2019-12-09 00:00:00', '1.00', '1', 'NOTREDEEEMED', NULL, 'CFSP20D15P3H1575981744TXFGNRZ', '1', '2019-12-06 01:13:53', '2019-12-10 20:42:25'),
	(16, '20', 'SC005', 'Kim Jennie', '8', 'Tteokbokki', '2019-12-09 00:00:00', '5.30', '1', 'NOTREDEEEMED', NULL, 'CFSP20D16P4H1575755543TXNYBLK', '1', '2019-12-08 05:34:08', '2019-12-08 06:15:50'),
	(17, '20', 'SC005', 'Kim Jennie', '3', 'Rose Syrup', '2019-12-09 00:00:00', '1.00', '1', 'NOTREDEEEMED', NULL, 'CFSP20D17P3H1575755552TX6KASS', '1', '2019-12-08 05:34:37', '2019-12-08 06:15:59'),
	(18, '20', 'SC006', 'Song Ji Hyo', '5', 'Keria', '2019-12-11 00:00:00', '0.40', '2', 'NOTREDEEEMED', NULL, 'CFSP20D18P4H1575833496TXYCOP9', '1', '2019-12-09 01:09:37', '2019-12-09 04:00:41'),
	(19, '20', 'SC005', 'Kim Jennie', '4', 'Curry Puff', '2019-12-13 00:00:00', '0.50', '1', 'NOTREDEEEMED', NULL, 'CFSP20D19P3H1575988999TX7BXKE', '', '2019-12-10 20:42:59', '2019-12-10 22:43:19'),
	(20, '20', 'SC0012', 'Nur Jamiah Binti Muhammed Hariz', '1', 'Nasi Lemak Telur Rebus', '2019-12-13 00:00:00', '2.50', '1', 'NOTREDEEEMED', NULL, 'CFSP20D4H1576005931TX8ZWO9', '', '2019-12-10 20:43:11', '2019-12-11 03:25:31'),
	(21, '20', 'SC0012', 'Nur Jamiah Binti Muhammed Hariz', '7', 'Lemonade', '2019-12-13 00:00:00', '1.00', '1', 'NOTREDEEEMED', NULL, 'CFSP20D5H1576087326TXQ1JJS', '', '2019-12-10 20:43:25', '2019-12-12 02:02:06'),
	(22, '20', 'SC0012', 'Nur Jamiah Binti Muhammed Hariz', '8', 'Tteokbokki', '2019-12-13 00:00:00', '5.30', '1', 'NOTREDEEEMED', NULL, 'CFSP20D22P3H1575988999TXVDCZJ', '', '2019-12-10 20:43:49', '2019-12-10 22:43:19'),
	(23, '20', 'SC004', 'Park Chae Young', '8', 'Tteokbokki', '2019-12-13 00:00:00', '5.30', '2', 'NOTREDEEEMED', NULL, 'CFSP20D4H1576004000TXTNZ5C', '1', '2019-12-10 23:15:02', '2019-12-12 03:37:17'),
	(24, '20', 'SC004', 'Park Chae Young', '2', 'Mi Goreng Mamak', '2019-12-13 00:00:00', '2.40', '4', 'NOTREDEEEMED', NULL, 'CFSP20D4H1576004000TXTNZ5C', '1', '2019-12-11 02:27:50', '2019-12-12 03:33:32'),
	(25, '20', 'SC004', 'Park Chae Young', '3', 'Rose Syrup', '2019-12-13 00:00:00', '1.00', '1', 'NOTREDEEEMED', NULL, 'CFSP20D4H1576004000TXTNZ5C', '1', '2019-12-11 02:28:00', '2019-12-12 03:26:59'),
	(29, '20', 'SC005', 'Kim Jennie', '4', 'Curry Puff', '2019-12-13 00:00:00', '0.50', '7', 'NOTREDEEEMED', NULL, 'CFSP20D5H1576090073TXXCMHH', '', '2019-12-12 02:08:54', '2019-12-12 02:47:53');
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
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('vladislaus.dragillius@gmail.com', '$2y$10$6lnr3U9TTs6FiGPe/WhDNeuc66rrzCvo1HarxL9dgDx3BivlPQQIK', '2019-12-12 02:53:17');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table cfsv1.payment_details
DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE IF NOT EXISTS `payment_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` bigint(20) unsigned NOT NULL,
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
  UNIQUE KEY `cardnum` (`cardnum`),
  KEY `FK_payment_details_users` (`parentid`),
  CONSTRAINT `FK_payment_details_users` FOREIGN KEY (`parentid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.payment_details: ~4 rows (approximately)
/*!40000 ALTER TABLE `payment_details` DISABLE KEYS */;
INSERT INTO `payment_details` (`id`, `parentid`, `fullname`, `billaddr1`, `billaddr2`, `city`, `zipcode`, `state`, `country`, `cardtype`, `cardnum`, `cvvnum`, `expdate`, `defaultpay`, `created_at`, `updated_at`) VALUES
	(1, 17, 'User Satu', '55, Jalan Hang Tuah', 'Taman Cempaka', 'Ipoh', '32050', 'Perak', 'Malaysia', 'mastercard', '452356835235', '566', '12/20', 'Y', '2019-11-25 23:46:54', '2019-11-27 02:21:30'),
	(3, 20, 'Muhammed Hariz Bin Sulaiman', '34, Jalan Lapangan A/12', 'Persiaran Las Manors', 'Ipoh', '32060', 'Perak', 'Malaysia', 'visa', '7845548745', '888', '03/22', 'Y', '2019-11-27 14:47:23', '2019-12-11 03:33:12'),
	(4, 20, 'Nurul Syafinaz Binti Abdul Mutolib', '99, Lorong 1', 'Taman Mas', 'Sungai Buloh', '56888', 'Selangor', 'Malaysia', 'mastercard', '85296385296', '746', '07/22', 'N', '2019-11-27 14:52:39', '2019-12-11 03:32:54'),
	(5, 20, 'Juliana Bahanun Binti Mohd Razak', '77, Jalan 1', 'Persiaran Lahat', 'Ipoh', '63555', 'Labuan', 'Malaysia', 'mastercard', '852785275275274525', '853', '09/22', 'N', '2019-12-11 03:37:00', '2019-12-11 03:37:00');
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
	(1, 'staff1', 'Saadiah binti Ahmad Jusoh', '0189832255', 'staff.satu@gmail.com', NULL, '$2y$10$il3euzHGZFzPBlJ0X4ALEu85V8AY/A35dVXS21tEGKtyb26/aHih2', NULL, '2019-11-09 13:50:08', '2019-12-12 03:26:28'),
	(2, 'staff2', 'Staff Dua', '0125355666', 'staff.dua@gmail.com', NULL, '$2y$10$mgdwZ8Ar1YFzMvqjB3s3LOMFPeubNZYYcScb9QJdOzWTtbh1zNn3O', NULL, '2019-11-13 22:23:37', '2019-11-13 22:23:37'),
	(3, 'staff3', 'Staff Tiga', '01255568555', 'staff.tiga@gmail.com', NULL, '$2y$10$lmVdzUSE0Y0aFNXu/9KwcOwxKB8pP.Ea.ceU1upPFa50nT.4DQD/m', NULL, '2019-11-13 22:26:35', '2019-11-13 22:26:35'),
	(4, 'staff4', 'Staff Empat', '0523332222', 'staff.empat@gmail.com', NULL, '$2y$10$uHZyDOzJcdF7Cb3qeQVE1OTmWUKD6G/MdbJvjUbIgJXo1H/f2Bt3q', NULL, '2019-11-13 22:31:08', '2019-11-13 22:31:08'),
	(5, 'staff5', 'Staff Lima', '0165538555', 'staff.lima@gmail.com', NULL, '$2y$10$ToDlGNsQajck9DkZ2IaiHudW5mqXHtNvDOxHayf546MqGqz037onC', NULL, '2019-11-13 22:48:55', '2019-11-13 22:48:55'),
	(6, 'staff6', 'Staff Enam', '0156835598', 'staff.enam@gmail.com', NULL, '$2y$10$r03C97dsb54Ma7dhbhUVOuty0K.W6UTG5OKJaRlWhNEIKQnZDeQ.K', NULL, '2019-11-13 22:50:08', '2019-12-02 22:46:50'),
	(7, 'staff8', 'Staff Lapan', '02533366888', 'staff.lapan@gmail.com', NULL, '$2y$10$B/T/Db0vlHXLJVKhQ4FD4uu0n1ZUFpTSRs/.0SAQccvOgshVyzMuy', NULL, '2019-11-13 23:06:11', '2019-11-13 23:06:11'),
	(9, 'vladislaus', 'Vladislaus Dragillius', '0156668566', 'vladislaus.dragillius@gmail.com', NULL, '$2y$10$Nn/rQO7lktB8F00rN.ZdsOg4tzpYWA9CvAkwfqBOxHasp8yfIGd3K', 'KiOw8y4oPMGcmWbGqBihmQHpDVTyfRkEZefQlF2W9QSzhxPXn7s7I1Zm2P3S', '2019-11-27 01:13:19', '2019-11-27 01:42:36');
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;

-- Dumping structure for table cfsv1.student
DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentid` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.student: ~9 rows (approximately)
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`id`, `fullname`, `studentid`, `parentid`, `class`, `school_session`, `dob`, `age`, `height`, `weight`, `gender`, `bmi`, `target_calories`, `allergies`, `created_at`, `updated_at`) VALUES
	(3, 'Student Satu bin Parent Satu', 'SC001', '17', '1A', 'morning', '2009-07-14', '10', '155', '56', 'male', '23.3', '2533', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:8:"treenuts";b:1;s:4:"eggs";b:0;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-11-10 14:35:09', '2019-12-02 22:39:59'),
	(5, 'Student Dua', 'SC002', '18', '4A', 'afternoon', '2011-10-13', '8', '166', '55', 'female', '20.0', '3200', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:1;s:9:"noallergy";b:0;}', '2019-11-10 14:51:18', '2019-12-06 00:54:03'),
	(6, 'Student Tiga', 'SC003', '17', '2A', 'morning', '1999-11-30', '19', '120', '45', 'male', '31.3', '1800', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:1;}', '2019-11-15 02:08:30', '2019-11-27 16:52:16'),
	(7, 'Student Lapan', 'SC008', '17', '2A', 'morning', '2019-11-12', '0', '120', '45', 'male', '31.3', '1498', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-11-20 09:54:43', '2019-11-27 16:52:40'),
	(8, 'Student Sembilan', 'SC009', '17', '4A', 'morning', '2003-11-11', '16', '153', '54', 'male', '23.1', '2400', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:1;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-11-27 01:44:22', '2019-11-27 16:52:59'),
	(11, 'Nur Jamiah Binti Muhammed Hariz', 'SC0012', '20', '2A', 'morning', '2010-12-15', '8', '142', '66', 'female', '32.7', '2100', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:1;}', '2019-11-27 14:43:38', '2019-12-09 02:31:57'),
	(12, 'Student 11', 'SCasdfghj', '17', '1A', 'afternoon', '2019-12-19', '0', '222', '72', 'male', '14.6', '10000', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:1;s:7:"peanuts";b:1;s:8:"treenuts";b:1;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:1;s:4:"fish";b:1;s:9:"noallergy";b:0;}', '2019-12-03 13:43:53', '2019-12-03 13:44:22'),
	(13, 'Kim Jennie', 'SC005', '20', '6A', 'afternoon', '2019-12-01', '0', '165', '55', 'female', '20.2', '2000', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:1;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-12-06 00:44:52', '2019-12-06 00:54:12'),
	(14, 'Park Chae Young', 'SC004', '20', '4A', 'afternoon', '2019-05-07', '0', '156', '55', 'female', '22.6', '1200', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-12-06 01:06:37', '2019-12-06 01:06:37'),
	(15, 'Song Ji Hyo', 'SC006', '20', '6A', 'morning', '2019-06-11', '0', '156', '52', 'female', '21.4', '1400', 'a:9:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:0;s:8:"treenuts";b:0;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-12-09 01:07:58', '2019-12-09 01:07:58'),
	(16, 'Kim Jisoo', 'BG238765432365', '20', '5A', 'morning', '2012-07-26', '7', '163', '58', 'female', '21.8', '3500', 'a:9:{s:9:"shellfish";b:0;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:8:"treenuts";b:1;s:4:"eggs";b:0;s:5:"wheat";b:0;s:3:"soy";b:0;s:4:"fish";b:0;s:9:"noallergy";b:0;}', '2019-12-11 03:40:24', '2019-12-11 03:40:49');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

-- Dumping structure for table cfsv1.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentid` bigint(20) unsigned NOT NULL,
  `orderid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `txstatus` enum('success','fail') COLLATE utf8mb4_unicode_ci NOT NULL,
  `txreference` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txamount` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_transaction_payment_details` (`paymentid`),
  CONSTRAINT `FK_transaction_payment_details` FOREIGN KEY (`paymentid`) REFERENCES `payment_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.transaction: ~14 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `parentid`, `paymentid`, `orderid`, `txstatus`, `txreference`, `txamount`, `txid`, `created_at`, `updated_at`) VALUES
	(1, '17', 1, 'a:1:{i:0;s:2:"04";}', 'success', 'PAYORDERS', '7.50', 'CFSP17D4H1573758074TXDRW12', '2019-11-15 03:01:14', '2019-12-12 06:20:29'),
	(2, '17', 1, 'a:1:{i:0;s:2:"06";}', 'success', 'PAYORDERS', '2.40', 'CFSP17D6H1573758299TXLZJFK', '2019-11-15 03:04:59', '2019-12-12 06:20:32'),
	(3, '17', 1, 'a:1:{i:0;s:2:"08";}', 'success', 'PAYORDERS', '0.00', 'CFSP17D8P1H1575396711TXOAFGI', '2019-12-04 02:11:51', '2019-12-12 06:20:35'),
	(4, '17', 1, 'a:1:{i:0;s:2:"12";}', 'success', 'PAYORDERS', '0.00', 'CFSP17D12P1H1575396721TXBZNOG', '2019-12-04 02:12:01', '2019-12-11 00:58:58'),
	(5, '17', 1, 'a:1:{i:0;s:2:"11";}', 'success', 'PAYORDERS', '0.00', 'CFSP17D11P1H1575396764TX1NWBH', '2019-12-04 02:12:44', '2019-12-11 00:58:51'),
	(6, '20', 3, 'a:1:{i:0;s:2:"13";}', 'success', 'PAYORDERS', '0.00', 'CFSP20D13P3H1575755532TX6PHAL', '2019-12-08 05:52:12', '2019-12-11 00:58:41'),
	(7, '20', 4, 'a:1:{i:0;s:2:"16";}', 'success', 'PAYORDERS', '0.00', 'CFSP20D16P4H1575755543TXNYBLK', '2019-12-08 05:52:23', '2019-12-11 00:58:33'),
	(8, '20', 3, 'a:1:{i:0;s:2:"17";}', 'success', 'PAYORDERS', '0.00', 'CFSP20D17P3H1575755552TX6KASS', '2019-12-08 05:52:32', '2019-12-11 00:58:24'),
	(9, '20', 4, 'a:1:{i:0;s:2:"18";}', 'success', 'PAYORDERS', '0.80', 'CFSP20D18P4H1575833496TXYCOP9', '2019-12-09 03:31:36', '2019-12-11 00:58:14'),
	(10, '20', 3, 'a:1:{i:0;s:2:"15";}', 'success', 'PAYORDERS', '1.00', 'CFSP20D15P3H1575981744TXFGNRZ', '2019-12-10 20:42:25', '2019-12-11 00:58:07'),
	(11, '20', 3, 'a:1:{i:0;s:2:"19";}', 'success', 'PAYORDERS', '0.50', 'CFSP20D19P3H1575988999TX7BXKE', '2019-12-10 22:43:19', '2019-12-11 00:58:00'),
	(12, '20', 3, 'a:1:{i:0;s:2:"22";}', 'success', 'PAYORDERS', '5.30', 'CFSP20D22P3H1575988999TXVDCZJ', '2019-12-10 22:43:19', '2019-12-11 00:57:53'),
	(13, '20', 4, 'a:3:{i:0;s:2:"23";i:1;s:2:"24";i:2;s:2:"25";}', 'success', 'PAYORDERS', '21.2', 'CFSP20D4H1576004000TXTNZ5C', '2019-12-11 02:53:20', '2019-12-11 02:53:20'),
	(14, '20', 4, 'a:1:{i:0;s:2:"20";}', 'success', 'PAYORDERS', '2.5', 'CFSP20D4H1576005931TX8ZWO9', '2019-12-11 03:25:31', '2019-12-11 03:25:31'),
	(15, '20', 5, 'a:1:{i:0;s:2:"21";}', 'success', 'PAYORDERS', '1', 'CFSP20D5H1576087326TXQ1JJS', '2019-12-12 02:02:06', '2019-12-12 02:02:06'),
	(16, '20', 5, 'a:1:{i:0;s:2:"29";}', 'success', 'PAYORDERS', '3.5', 'CFSP20D5H1576090073TXXCMHH', '2019-12-12 02:47:53', '2019-12-12 02:47:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cfsv1.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `fullname`, `phonenum`, `usrrole`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(17, 'user1', 'Sulaiman Yaasin bin Abdul Kamal', '0123456789', 'parent', 'user.satu@gmail.com', NULL, '$2y$10$iUYcbpBK0ikwmpj9V8kqPeguXcWtYJVk.Dd1ad7o5dPVYNE9D3rLu', NULL, '2019-11-09 14:11:54', '2019-12-03 13:41:57'),
	(18, 'user2', 'Rosli Zaman bin Kadir Rahman', '01255633664', 'parent', 'user.dua@gmail.com', NULL, '$2y$10$HslMn0ay4Wt5qE64K8wOW.zhCH0OUSuoLuf/g/EkvIGMP9QAvY2U6', NULL, '2019-11-26 23:41:39', '2019-12-02 22:35:04'),
	(20, 'bsod666', 'Muhammed Hariz bin Sulaiman', '01126379781', 'parent', 'muhammedharizzubir@gmail.com', NULL, '$2y$10$fpEIBLV3zXcN6hgN9TxUMOSwdhYIe6roTDH9/C31LtIXXHb/okWxG', 'kficerhUbQTFwDwwtkNtFBWDKG28ZydqkffOQw6qA9mgFmZkbPoxuJG1bsTE', '2019-11-27 00:46:23', '2019-12-12 02:48:33'),
	(21, 'shindong', 'Shin Dong-hee', '0165586633', 'parent', 'shindong@gmail.com', NULL, '$2y$10$qaA.OJaG8WQw3cQz5ECFGuXd0jL7dCGSMRIIWQPgBwt2WrE44R8S2', NULL, '2019-12-12 02:59:03', '2019-12-12 02:59:03');
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
