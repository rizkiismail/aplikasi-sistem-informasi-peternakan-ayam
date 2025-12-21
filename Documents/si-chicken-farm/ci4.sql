-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 28, 2021 at 02:14 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `bibit`
--

DROP TABLE IF EXISTS `bibit`;
CREATE TABLE IF NOT EXISTS `bibit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jumlah` int(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bibit`
--

INSERT INTO `bibit` (`id`, `tanggal`, `jenis`, `jumlah`, `created_at`, `updated_at`) VALUES
(15, '2021-07-01', 'S', 2000, '2021-06-28 08:15:50', '2021-06-28 08:16:03');

--
-- Triggers `bibit`
--
DROP TRIGGER IF EXISTS `bibit_masuk`;
DELIMITER $$
CREATE TRIGGER `bibit_masuk` AFTER INSERT ON `bibit` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah = jumlah + NEW.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `del_bibit_masuk`;
DELIMITER $$
CREATE TRIGGER `del_bibit_masuk` AFTER DELETE ON `bibit` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah = jumlah - OLD.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update2_bibit`;
DELIMITER $$
CREATE TRIGGER `update2_bibit` AFTER UPDATE ON `bibit` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah=jumlah-OLD.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_bibit`;
DELIMITER $$
CREATE TRIGGER `update_bibit` BEFORE UPDATE ON `bibit` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah=jumlah+NEW.jumlah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
CREATE TABLE IF NOT EXISTS `obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) DEFAULT NULL,
  `jumlah` int(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `jenis`, `jumlah`, `created_at`, `updated_at`) VALUES
(8, 'B', 2, '2021-06-28 07:52:05', '2021-06-28 08:33:09'),
(7, 'A', 0, '2021-06-28 07:51:48', '2021-06-28 08:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `obat_masuk`
--

DROP TABLE IF EXISTS `obat_masuk`;
CREATE TABLE IF NOT EXISTS `obat_masuk` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `obat_masuk`
--

INSERT INTO `obat_masuk` (`id`, `tanggal`, `jenis`, `jumlah`, `created_at`, `updated_at`) VALUES
(13, '2021-07-02', 'B', 4, '2021-06-28 08:33:31', '2021-06-28 08:34:08'),
(11, '2021-07-01', 'A', 2, '2021-06-28 08:29:31', '2021-06-28 08:29:49');

--
-- Triggers `obat_masuk`
--
DROP TRIGGER IF EXISTS `del_obat_masuk`;
DELIMITER $$
CREATE TRIGGER `del_obat_masuk` AFTER DELETE ON `obat_masuk` FOR EACH ROW BEGIN
UPDATE obat SET jumlah = jumlah - OLD.jumlah
WHERE obat.jenis = OLD.jenis;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `obat_masuk`;
DELIMITER $$
CREATE TRIGGER `obat_masuk` AFTER INSERT ON `obat_masuk` FOR EACH ROW BEGIN
UPDATE obat SET jumlah=jumlah+NEW.jumlah
WHERE jenis = New.jenis;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update2_obat_masuk`;
DELIMITER $$
CREATE TRIGGER `update2_obat_masuk` AFTER UPDATE ON `obat_masuk` FOR EACH ROW BEGIN
UPDATE obat SET jenis=NEW.jenis, jumlah=jumlah+NEW.jumlah
WHERE obat.jenis=NEW.jenis;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_obat_masuk`;
DELIMITER $$
CREATE TRIGGER `update_obat_masuk` BEFORE UPDATE ON `obat_masuk` FOR EACH ROW BEGIN
UPDATE obat SET jenis=NEW.jenis, jumlah=jumlah-OLD.jumlah
WHERE obat.jenis=OLD.jenis;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pakan`
--

DROP TABLE IF EXISTS `pakan`;
CREATE TABLE IF NOT EXISTS `pakan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pakan`
--

INSERT INTO `pakan` (`id`, `tanggal`, `jenis`, `jumlah`, `created_at`, `updated_at`) VALUES
(37, '2021-07-01', 'S', 20, '2021-06-28 08:28:44', '2021-06-28 08:28:44'),
(36, '2021-07-01', 'S', 20, '2021-06-28 08:26:57', '2021-06-28 08:28:28');

--
-- Triggers `pakan`
--
DROP TRIGGER IF EXISTS `del_pakan_masuk`;
DELIMITER $$
CREATE TRIGGER `del_pakan_masuk` AFTER DELETE ON `pakan` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah = jumlah - OLD.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `pakan_masuk`;
DELIMITER $$
CREATE TRIGGER `pakan_masuk` AFTER INSERT ON `pakan` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah=jumlah+NEW.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update2_pakan_masuk`;
DELIMITER $$
CREATE TRIGGER `update2_pakan_masuk` AFTER UPDATE ON `pakan` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah=jumlah-OLD.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_pakan_masuk`;
DELIMITER $$
CREATE TRIGGER `update_pakan_masuk` BEFORE UPDATE ON `pakan` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah=jumlah+NEW.jumlah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `panen`
--

DROP TABLE IF EXISTS `panen`;
CREATE TABLE IF NOT EXISTS `panen` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `data_supir` varchar(255) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `kg` int(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `panen`
--

INSERT INTO `panen` (`id`, `tanggal`, `nama`, `alamat`, `data_supir`, `jumlah`, `kg`, `created_at`, `updated_at`) VALUES
(12, '2021-07-31', 'A', 'Sumedang', 'Z 1111 AZ Ab', 500, 1000, '2021-06-28 09:01:20', '2021-06-28 09:01:20'),
(11, '2021-07-30', 'A', 'Sumedang', 'Z 1111 AZ Ab', 500, 1000, '2021-06-28 09:00:44', '2021-06-28 09:00:44');

--
-- Triggers `panen`
--
DROP TRIGGER IF EXISTS `del_panen`;
DELIMITER $$
CREATE TRIGGER `del_panen` AFTER DELETE ON `panen` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah= jumlah+OLD.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `panen`;
DELIMITER $$
CREATE TRIGGER `panen` AFTER INSERT ON `panen` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah=jumlah - NEW.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update2_panen`;
DELIMITER $$
CREATE TRIGGER `update2_panen` BEFORE UPDATE ON `panen` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah=jumlah-NEW.jumlah;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_panen`;
DELIMITER $$
CREATE TRIGGER `update_panen` AFTER UPDATE ON `panen` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah=jumlah+OLD.jumlah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengobatan`
--

DROP TABLE IF EXISTS `pengobatan`;
CREATE TABLE IF NOT EXISTS `pengobatan` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengobatan`
--

INSERT INTO `pengobatan` (`id`, `tanggal`, `jenis`, `jumlah`, `created_at`, `updated_at`) VALUES
(9, '2021-07-02', 'B', 2, '2021-06-28 08:44:13', '2021-06-28 08:44:13'),
(8, '2021-07-01', 'A', 2, '2021-06-28 08:43:59', '2021-06-28 08:43:59');

--
-- Triggers `pengobatan`
--
DROP TRIGGER IF EXISTS `del_pengobatan`;
DELIMITER $$
CREATE TRIGGER `del_pengobatan` AFTER DELETE ON `pengobatan` FOR EACH ROW BEGIN
UPDATE obat SET jumlah=jumlah + OLD.jumlah
WHERE jenis=OLD.jenis;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `pengobatan`;
DELIMITER $$
CREATE TRIGGER `pengobatan` AFTER INSERT ON `pengobatan` FOR EACH ROW BEGIN
UPDATE obat SET jumlah= jumlah-NEW.jumlah
WHERE jenis=NEW.jenis;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update2_pengobatan`;
DELIMITER $$
CREATE TRIGGER `update2_pengobatan` AFTER UPDATE ON `pengobatan` FOR EACH ROW BEGIN
UPDATE obat SET jenis=NEW.jenis, jumlah=jumlah+OLD.jumlah
WHERE obat.id=OLD.id;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_pengobatan`;
DELIMITER $$
CREATE TRIGGER `update_pengobatan` BEFORE UPDATE ON `pengobatan` FOR EACH ROW BEGIN
UPDATE obat SET jenis=NEW.jenis, jumlah=jumlah-NEW.jumlah
WHERE obat.id=NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `populasi`
--

DROP TABLE IF EXISTS `populasi`;
CREATE TABLE IF NOT EXISTS `populasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jumlah` (`jumlah`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `populasi`
--

INSERT INTO `populasi` (`id`, `jumlah`) VALUES
(1, 998);

-- --------------------------------------------------------

--
-- Table structure for table `recording`
--

DROP TABLE IF EXISTS `recording`;
CREATE TABLE IF NOT EXISTS `recording` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `umur` int(6) NOT NULL,
  `tanggal` date NOT NULL,
  `mati` int(5) NOT NULL,
  `habis_pakan` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recording`
--

INSERT INTO `recording` (`id`, `umur`, `tanggal`, `mati`, `habis_pakan`, `created_at`, `updated_at`) VALUES
(13, 2, '2021-07-02', 1, 3, '2021-06-28 08:52:59', '2021-06-28 08:52:59'),
(12, 1, '2021-07-01', 1, 3, '2021-06-28 08:52:39', '2021-06-28 08:52:39');

--
-- Triggers `recording`
--
DROP TRIGGER IF EXISTS `ayam_mati`;
DELIMITER $$
CREATE TRIGGER `ayam_mati` AFTER INSERT ON `recording` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah = jumlah - NEW.mati;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `del_ayam_mati`;
DELIMITER $$
CREATE TRIGGER `del_ayam_mati` AFTER DELETE ON `recording` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah = jumlah + OLD.mati;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `del_habis_pakan`;
DELIMITER $$
CREATE TRIGGER `del_habis_pakan` AFTER DELETE ON `recording` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah = jumlah + OLD.habis_pakan;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `habis_pakan`;
DELIMITER $$
CREATE TRIGGER `habis_pakan` AFTER INSERT ON `recording` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah = jumlah - NEW.habis_pakan;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update2_ayam_mati`;
DELIMITER $$
CREATE TRIGGER `update2_ayam_mati` AFTER UPDATE ON `recording` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah=jumlah+OLD.mati;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update2_habis_pakan`;
DELIMITER $$
CREATE TRIGGER `update2_habis_pakan` AFTER UPDATE ON `recording` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah=jumlah+OLD.habis_pakan;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_ayam_mati`;
DELIMITER $$
CREATE TRIGGER `update_ayam_mati` BEFORE UPDATE ON `recording` FOR EACH ROW BEGIN
UPDATE populasi SET jumlah=jumlah-NEW.mati;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_habis_pakan`;
DELIMITER $$
CREATE TRIGGER `update_habis_pakan` BEFORE UPDATE ON `recording` FOR EACH ROW BEGIN
UPDATE stok_pakan SET jumlah=jumlah-NEW.habis_pakan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stok_pakan`
--

DROP TABLE IF EXISTS `stok_pakan`;
CREATE TABLE IF NOT EXISTS `stok_pakan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jumlah` (`jumlah`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stok_pakan`
--

INSERT INTO `stok_pakan` (`id`, `jumlah`) VALUES
(1, 34);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
