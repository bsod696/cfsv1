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
CREATE DATABASE IF NOT EXISTS `cfsv1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cfsv1`;

-- Dumping structure for table cfsv1.admins
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
CREATE TABLE IF NOT EXISTS `allergy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `allergies` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `childuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.allergy: ~8 rows (approximately)
/*!40000 ALTER TABLE `allergy` DISABLE KEYS */;
INSERT INTO `allergy` (`id`, `allergies`, `childuid`, `created_at`, `updated_at`) VALUES
	(1, 'shellfish', NULL, '2019-11-14 00:55:59', '2019-11-14 00:59:10'),
	(2, 'dairy', NULL, '2019-11-14 00:56:14', '2019-11-14 00:56:14'),
	(3, 'peanuts', NULL, '2019-11-14 00:56:27', '2019-11-14 00:58:38'),
	(4, 'tree nuts', NULL, '2019-11-14 00:56:34', '2019-11-14 01:01:22'),
	(5, 'eggs', NULL, '2019-11-14 00:58:57', '2019-11-14 00:58:57'),
	(6, 'wheat', NULL, '2019-11-14 00:59:26', '2019-11-14 01:01:00'),
	(7, 'soy', NULL, '2019-11-14 00:59:43', '2019-11-14 00:59:43'),
	(8, 'fish', NULL, '2019-11-14 01:00:15', '2019-11-14 01:00:15');
/*!40000 ALTER TABLE `allergy` ENABLE KEYS */;

-- Dumping structure for table cfsv1.failed_jobs
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
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('food','beverage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `allergy_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calories` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foodpic` text COLLATE utf8mb4_unicode_ci,
  `staffuid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.menus: ~3 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `name`, `desc`, `type`, `allergy_id`, `stock`, `price`, `calories`, `foodpic`, `staffuid`, `created_at`, `updated_at`) VALUES
	(1, 'Nasi Lemak Telur Rebus', 'Coconut rice with Cooked Chillies to with slices of cucumbers, fried anchovies, fried peanuts and half of hard-boiled eggs', 'food', '{1,2,3}', '44', '2.50', '720', 'https://images.unicartapp.com/image/dzafstore/image/data/NL.jpg', '1', '2019-11-10 17:54:58', '2019-11-14 03:15:30'),
	(2, 'Mi Goreng Mamak', 'Egg noodles stir-fried with soy sauce, chilli paste. Top it off with tofu and some veggies (mustard and bean sprouts).', 'food', '{2,6}', '28', '2.40', '650', 'https://assets.nst.com.my/images/articles/26ntmee3_1535260361.jpg', '2', '2019-11-10 18:18:16', '2019-11-15 03:19:56'),
	(3, 'Rose Syrup ', 'Icy cold water with Rose Syrup and sugar', 'beverage', '{}', '117', '1.00', '200', 'data:image/jpeg;base64,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', '2', '2019-11-10 18:28:41', '2019-11-14 03:32:05');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table cfsv1.migrations
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

-- Dumping structure for table cfsv1.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentid` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studentname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_date` timestamp NOT NULL,
  `menu_price` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_qty` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redeem_status` enum('REDEEMED','NOTREDEEEMED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NOTREDEEEMED',
  `redeem_date` timestamp NULL DEFAULT NULL,
  `txid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.orders: ~2 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `parentid`, `studentid`, `studentname`, `menu_id`, `menu_name`, `menu_date`, `menu_price`, `menu_qty`, `redeem_status`, `redeem_date`, `txid`, `created_at`, `updated_at`) VALUES
	(4, '17', 'SC001', 'Student Satu bin Parent Satu', '1', 'Nasi Lemak Telur Rebus', '2019-11-10 17:54:58', '2.50', '3', 'NOTREDEEEMED', NULL, 'CFSP17D4H1573758074TXDRW12', '2019-11-14 03:15:30', '2019-11-15 03:01:14'),
	(6, '17', 'SC003', 'Student Tiga', '2', 'Mi Goreng Mamak', '2019-11-10 18:18:16', '2.40', '1', 'NOTREDEEEMED', NULL, 'CFSP17D6H1573758299TXLZJFK', '2019-11-15 03:04:48', '2019-11-15 03:04:59'),
	(7, '17', 'SC003', 'Student Tiga', '2', 'Mi Goreng Mamak', '2019-11-10 18:18:16', '2.40', '1', 'NOTREDEEEMED', NULL, '', '2019-11-15 03:19:56', '2019-11-15 03:19:56');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table cfsv1.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cfsv1.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table cfsv1.staffs
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.staffs: ~7 rows (approximately)
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
INSERT INTO `staffs` (`id`, `username`, `fullname`, `phonenum`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'staff1', 'Staff Satu', '0168859966', 'staff.satu@gmail.com', NULL, '$2y$10$XXu2X98obVJhXykjLvwuj.AMyb0bpMW1fyhJvLQeo1UODslkhmHWK', NULL, '2019-11-09 13:50:08', '2019-11-09 13:50:08'),
	(2, 'staff2', 'Staff Dua', '0125355666', 'staff.dua@gmail.com', NULL, '$2y$10$mgdwZ8Ar1YFzMvqjB3s3LOMFPeubNZYYcScb9QJdOzWTtbh1zNn3O', NULL, '2019-11-13 22:23:37', '2019-11-13 22:23:37'),
	(3, 'staff3', 'Staff Tiga', '01255568555', 'staff.tiga@gmail.com', NULL, '$2y$10$lmVdzUSE0Y0aFNXu/9KwcOwxKB8pP.Ea.ceU1upPFa50nT.4DQD/m', NULL, '2019-11-13 22:26:35', '2019-11-13 22:26:35'),
	(4, 'staff4', 'Staff Empat', '0523332222', 'staff.empat@gmail.com', NULL, '$2y$10$uHZyDOzJcdF7Cb3qeQVE1OTmWUKD6G/MdbJvjUbIgJXo1H/f2Bt3q', NULL, '2019-11-13 22:31:08', '2019-11-13 22:31:08'),
	(5, 'staff5', 'Staff Lima', '0165538555', 'staff.lima@gmail.com', NULL, '$2y$10$ToDlGNsQajck9DkZ2IaiHudW5mqXHtNvDOxHayf546MqGqz037onC', NULL, '2019-11-13 22:48:55', '2019-11-13 22:48:55'),
	(6, 'staff6', 'Staff Enam', '12435456754654', 'staff.enam@gmail.com', NULL, '$2y$10$r03C97dsb54Ma7dhbhUVOuty0K.W6UTG5OKJaRlWhNEIKQnZDeQ.K', NULL, '2019-11-13 22:50:08', '2019-11-13 22:50:08'),
	(7, 'staff8', 'Staff Lapan', '02533366888', 'staff.lapan@gmail.com', NULL, '$2y$10$B/T/Db0vlHXLJVKhQ4FD4uu0n1ZUFpTSRs/.0SAQccvOgshVyzMuy', NULL, '2019-11-13 23:06:11', '2019-11-13 23:06:11'),
	(8, 'staff9', 'Staff Sembilan', '0195558866', 'staff.sembilan@gmail.com', NULL, '$2y$10$3VlFaotjPxp3ykXERcwLsuVwUCov07fkE3SJvwd4n9UYkOAKk/Tby', NULL, '2019-11-13 23:08:27', '2019-11-13 23:08:27');
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;

-- Dumping structure for table cfsv1.student
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.student: ~3 rows (approximately)
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`id`, `fullname`, `studentid`, `primary_parentid`, `secondary_parentid`, `class`, `school_session`, `dob`, `age`, `height`, `weight`, `gender`, `bmi`, `target_calories`, `allergies`, `created_at`, `updated_at`) VALUES
	(3, 'Student Satu bin Parent Satu', 'SC001', '17', '', '1A', 'morning', '2009-07-14', '10', '150', '54', 'male', '24.0', '2004', 'a:8:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:9:"tree nuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:0;s:4:"fish";b:0;}', '2019-11-10 14:35:09', '2019-11-15 02:22:14'),
	(5, 'Student Dua', 'SC002', '', '17', '4A', 'afternoon', '2011-10-13', '8', '165', '55', 'female', '20.2', '3200', 'a:8:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:9:"tree nuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:1;s:3:"soy";b:1;s:4:"fish";b:1;}', '2019-11-10 14:51:18', '2019-11-15 02:09:55'),
	(6, 'Student Tiga', 'SC003', '17', '', '2A', 'morning', '1999-11-30', '19', '120', '44', 'male', '30.6', '1800', 'a:8:{s:9:"shellfish";b:1;s:5:"dairy";b:0;s:7:"peanuts";b:1;s:9:"tree nuts";b:0;s:4:"eggs";b:1;s:5:"wheat";b:0;s:3:"soy";b:1;s:4:"fish";b:0;}', '2019-11-15 02:08:30', '2019-11-15 02:08:30');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

-- Dumping structure for table cfsv1.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentuid` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_status` enum('success','fail') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_reference` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tx_amount` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table cfsv1.transaction: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`id`, `menu_id`, `parentuid`, `order_id`, `tx_status`, `tx_reference`, `tx_amount`, `txid`, `created_at`, `updated_at`) VALUES
	(1, '1', '17', '4', 'success', 'PAYORDERS', '7.50', 'CFSP17D4H1573758074TXDRW12', '2019-11-15 03:01:14', '2019-11-15 03:01:14'),
	(2, '2', '17', '6', 'success', 'PAYORDERS', '2.40', 'CFSP17D6H1573758299TXLZJFK', '2019-11-15 03:04:59', '2019-11-15 03:04:59');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;

-- Dumping structure for table cfsv1.users
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cfsv1.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `fullname`, `phonenum`, `usrrole`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(15, 'bsod666', 'Vladislaus Dragillius', '01123456789', 'parent', 'vladislausdragillius@gmail.com', NULL, '$2y$10$lIYqBqIvTutdSNB.4mk0KOqJI5Tr5RlxHrL3K4jIbGEj3GLq51KTq', NULL, '2019-11-07 11:19:28', '2019-11-07 11:19:28'),
	(17, 'user1', 'User Satu', '0123456789', 'parent', 'user.satu@gmail.com', NULL, '$2y$10$iUYcbpBK0ikwmpj9V8kqPeguXcWtYJVk.Dd1ad7o5dPVYNE9D3rLu', NULL, '2019-11-09 14:11:54', '2019-11-09 14:11:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
