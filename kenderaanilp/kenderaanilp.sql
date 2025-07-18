-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET NAMES utf8 */;
 /*!50503 SET NAMES utf8mb4 */;
 /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
 /*!40103 SET TIME_ZONE='+00:00' */;
 /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
 /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
 /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping database structure for kenderaanilp
CREATE DATABASE IF NOT EXISTS `kenderaanilp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kenderaanilp`;

-- Dumping structure for table kenderaanilp.kenderaan
CREATE TABLE IF NOT EXISTS `kenderaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jeniskenderaan` varchar(255) NOT NULL,
  `namapemandu` varchar(255) NOT NULL,
  `noplatkenderaan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping structure for table kenderaanilp.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert default admin user
INSERT INTO `users` (`userid`, `password`)
VALUES ('admin', SHA2('admin123', 256));

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
 /*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
 /*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
 /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
