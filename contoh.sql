-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2015 at 11:39 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contoh`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `judul_profil` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `konten` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `about_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `judul_profil`, `slug`, `konten`, `created_at`, `updated_at`) VALUES
(1, 'History', 'history', 'This is history', '2015-04-01 04:17:10', '2015-04-01 04:17:10'),
(2, 'Vision and Mission', 'vision-and-mission', 'This is vision and mission', '2015-04-01 04:18:10', '2015-04-01 04:18:10'),
(3, 'Facility', 'facility', '<p>This is facility</p>', '2015-04-01 04:19:10', '2015-04-29 12:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) unsigned NOT NULL,
  `judul_artikel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isi` text COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_kategori_id_foreign` (`kategori_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `kategori_id`, `judul_artikel`, `slug`, `isi`, `gambar`, `featured`, `created_at`, `updated_at`) VALUES
(3, 1, 'First News', 'first-news', '<p>This is first news.</p>', 'uploads/gambar/02-supersoccer-free-wallpaper-Gabriel-Omar-Batistuta.jpg', 1, '2015-04-22 21:13:16', '2015-05-01 21:39:54'),
(4, 1, 'Second News', 'second-news', '<p>This is second news.</p>', 'uploads/gambar/Urek-Mazino.jpg', 1, '2015-04-25 02:22:39', '2015-05-01 21:40:10'),
(5, 2, 'First Events', 'first-events', '<p>This is first events.</p>', 'uploads/gambar/Gabriel-Batistuta-As-Roma-Wallpaper-HD.jpg', 1, '2015-04-25 02:23:02', '2015-05-01 21:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) unsigned NOT NULL,
  `judul_artikel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isi` text COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `artikel_slug_unique` (`slug`),
  KEY `artikel_kategori_id_foreign` (`kategori_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `kategori_id`, `judul_artikel`, `slug`, `isi`, `gambar`, `featured`, `created_at`, `updated_at`) VALUES
(7, 1, 'Berita Pertama', 'berita-pertama', '<p>Ini adalah berita pertama.</p>', 'uploads/gambar/stern_ritter_b___jugram_haschwalth_by_tremblax-d6avsv7.jpg', 1, '2015-04-22 20:53:36', '2015-04-27 11:21:47'),
(8, 2, 'Kegiatan Pertama', 'kegiatan-pertama', '<p>Ini adalah&nbsp;kegiatan pertama.</p>', 'uploads/gambar/Gabriel-Batistuta-As-Roma-Wallpaper-HD.jpg', 1, '2015-04-25 02:23:31', '2015-05-01 10:26:22'),
(10, 3, 'Pengumuman Pertama', 'pengumuman-pertama', '<p>Ini adalah pengumuman pertama.</p>', 'uploads/gambar/02-supersoccer-free-wallpaper-Gabriel-Omar-Batistuta.jpg', 1, '2015-04-26 21:16:02', '2015-05-01 10:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `document_article`
--

CREATE TABLE IF NOT EXISTS `document_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_artikel` int(10) unsigned NOT NULL,
  `nama_dokumen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link_dokumen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `documents_id_artikel_foreign` (`id_artikel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `document_article`
--

INSERT INTO `document_article` (`id`, `id_artikel`, `nama_dokumen`, `link_dokumen`, `created_at`, `updated_at`) VALUES
(11, 4, 'basic RF.PDF', 'uploads/dokumen/basic RF.PDF', '2015-05-01 23:24:35', '2015-05-01 23:24:35'),
(12, 4, '0-Telecommunication Basics_v1.7Notes.pdf', 'uploads/dokumen/0-Telecommunication Basics_v1.7Notes.pdf', '2015-05-01 23:24:49', '2015-05-01 23:24:49'),
(13, 5, 'wireless link.pdf', 'uploads/dokumen/wireless link.pdf', '2015-05-01 23:27:13', '2015-05-01 23:27:13'),
(14, 5, 'chapter1.ppt', 'uploads/dokumen/chapter1.ppt', '2015-05-01 23:28:17', '2015-05-01 23:28:17'),
(15, 3, 'chapter2.ppt', 'uploads/dokumen/chapter2.ppt', '2015-05-01 23:28:52', '2015-05-01 23:28:52'),
(16, 3, 'chapter3.ppt', 'uploads/dokumen/chapter3.ppt', '2015-05-01 23:28:52', '2015-05-01 23:28:52'),
(17, 3, 'chapter4.ppt', 'uploads/dokumen/chapter4.ppt', '2015-05-01 23:28:52', '2015-05-01 23:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_artikel`
--

CREATE TABLE IF NOT EXISTS `dokumen_artikel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_artikel` int(10) unsigned NOT NULL,
  `nama_dokumen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link_dokumen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id_artikel` (`id_artikel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `dokumen_artikel`
--

INSERT INTO `dokumen_artikel` (`id`, `id_artikel`, `nama_dokumen`, `link_dokumen`, `created_at`, `updated_at`) VALUES
(13, 7, 'form-registrasi-cpns-kemdikbud-5220.7160021.00009.pdf', 'uploads/dokumen/form-registrasi-cpns-kemdikbud-5220.7160021.00009.pdf', '2015-04-22 20:53:36', '2015-04-22 20:53:36'),
(28, 8, '5110201004.jpg', 'uploads/dokumen/5110201004.jpg', '2015-04-27 05:53:32', '2015-04-27 05:53:32'),
(30, 8, 'Gabriel-Batistuta-As-Roma-Wallpaper-HD.jpg', 'uploads/dokumen/Gabriel-Batistuta-As-Roma-Wallpaper-HD.jpg', '2015-04-27 08:35:02', '2015-04-27 08:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `NIP` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NIP`, `nama`, `tanggal_lahir`, `remember_token`, `created_at`, `updated_at`) VALUES
('nipdosen', 'Muhammad Alkaff', '1986-06-13', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_artikel`
--

CREATE TABLE IF NOT EXISTS `kategori_artikel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama_en` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug_en` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_artikel_slug_id_unique` (`slug_id`),
  UNIQUE KEY `kategori_artikel_slug_en_unique` (`slug_en`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori_artikel`
--

INSERT INTO `kategori_artikel` (`id`, `nama_id`, `slug_id`, `nama_en`, `slug_en`, `created_at`, `updated_at`) VALUES
(1, 'Berita', 'berita', 'News', 'news', '2015-04-20 21:30:15', '2015-04-20 21:30:15'),
(2, 'Kegiatan', 'kegiatan', 'Events', 'events', '2015-04-20 21:31:15', '2015-04-20 21:31:15'),
(3, 'Pengumuman', 'pengumuman', 'Announcements', 'announcements', '2015-04-20 21:32:01', '2015-04-20 21:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_03_30_090617_buat_tabel_profil', 1),
('2015_04_14_092503_buat_tabel_dosen', 1),
('2015_04_17_142522_entrust_setup_tables', 1),
('2015_04_18_044949_buat_tabel_about', 1),
('2015_04_19_005854_buat_kategori_artikel', 2),
('2015_04_19_012157_buat_tabel_artikel', 2),
('2015_04_20_060047_buat_tabel_articles', 2),
('2015_04_22_225003_buat_tabel_dokumen', 3),
('2015_04_22_225333_buat_tabel_documents', 4),
('2015_04_29_170114_buat_tabel_about', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('m.alkaff9@gmail.com', '262c446f0b21c7d35279b01b195d7b9137787cfdba670e88a1c93f5ffe86a855', '2015-04-29 20:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `judul_profil` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `konten` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `profil_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `judul_profil`, `slug`, `konten`, `created_at`, `updated_at`) VALUES
(1, 'Sejarah', 'sejarah', '<p>Ini adalah sejarah.</p>', '2015-04-21 10:42:35', '2015-04-21 10:42:35'),
(2, 'Visi dan Misi', 'visi-dan-misi', '<p>Ini adalah visi dan misi.</p>', '2015-04-21 10:46:08', '2015-04-21 10:46:08'),
(3, 'Fasilitas', 'fasilitas', '<p>Ini adalah fasilitas.</p>', '2015-04-21 10:46:30', '2015-04-29 12:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', 'Admin Utama Website', '2015-04-20 21:30:12', '2015-04-20 21:30:12'),
(2, 'dosen', 'Dosen', 'User Dosen', '2015-04-20 21:31:12', '2015-04-20 21:31:12'),
(3, 'mahasiswa', 'Mahasiswa', 'User Mahasiswa', '2015-04-30 23:50:55', '2015-04-30 23:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'administrator@localhost.com', '$2y$10$g3rukNUYqsG8UJM0UFnNpuD1V/VgXLK143zA8T4WmHxORIDrYBB3q', '4bdWE9kNwxKH119lYZzngJvw4pPASsADVLE1Mt28eC9PJfK119ZVteLwzqUY', '2015-04-20 22:49:10', '2015-05-01 23:33:14'),
(2, 'nipdosen', 'm.alkaff9@gmail.com', '$2y$10$rNs25AWkn5hCs4LvREFMWuRi15y207A1ssR9OlArouDvpRNSPkdpe', 'EvWPy3u3TEMqYgVUrZmjF7Xu5UTgkzwefP3fXfrTJzisoVD97lpj7BtG0ZrB', '2015-04-20 22:50:10', '2015-05-01 23:32:55');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_artikel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_artikel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_article`
--
ALTER TABLE `document_article`
  ADD CONSTRAINT `documents_id_artikel_foreign` FOREIGN KEY (`id_artikel`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dokumen_artikel`
--
ALTER TABLE `dokumen_artikel`
  ADD CONSTRAINT `dokumen_id_artikel_foreign` FOREIGN KEY (`id_artikel`) REFERENCES `artikel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
