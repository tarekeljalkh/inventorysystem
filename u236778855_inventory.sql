-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2024 at 06:19 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u236778855_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SOUND', NULL, '2024-03-30 16:45:33'),
(2, 'LED SCREEN', NULL, '2024-03-30 16:45:44'),
(3, 'LIGHTING', NULL, '2024-03-30 16:45:24'),
(4, 'NOUR MUSIC', '2024-03-30 16:45:56', '2024-03-30 16:45:56'),
(5, 'CABLES', '2024-03-30 16:46:13', '2024-03-30 16:46:13'),
(6, 'SPARE PARTS', '2024-03-30 16:47:10', '2024-03-30 16:47:10'),
(7, 'STAGE', '2024-03-30 16:47:23', '2024-03-30 16:47:23'),
(8, 'SCAFFOLDING', '2024-03-30 16:47:52', '2024-03-30 16:47:52'),
(9, 'TRUSS', '2024-03-30 16:48:19', '2024-03-30 16:48:19'),
(10, 'ACCESSORIES', '2024-03-30 16:52:39', '2024-03-30 16:52:39'),
(11, 'MIXER LIGHTING', '2024-03-30 18:40:53', '2024-03-30 18:40:53'),
(12, 'MIXER SOUND', '2024-03-30 18:41:02', '2024-03-30 18:41:02'),
(13, 'MEDIA SERVER', '2024-03-30 18:41:21', '2024-03-30 18:41:21'),
(14, 'PROJECTOR', '2024-03-30 18:55:33', '2024-03-30 18:55:33'),
(15, 'LAPTOP', '2024-03-30 18:55:47', '2024-03-30 18:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `checkout_user` varchar(255) NOT NULL,
  `returned_by_user` varchar(255) DEFAULT NULL,
  `return_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout_items`
--

CREATE TABLE `checkout_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checkout_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `returned_quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `residency_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `mobile`, `residency_number`, `created_at`, `updated_at`) VALUES
(5, 'E9 +', 966, '1', '2024-03-30 16:51:05', '2024-03-30 16:51:05'),
(6, 'SLS', 966, '2', '2024-03-30 16:53:02', '2024-03-30 16:53:02'),
(7, 'SPACETOON', 966, '3', '2024-03-30 16:54:16', '2024-03-30 16:54:16'),
(8, 'MILI', 966, '4', '2024-03-30 16:54:29', '2024-03-30 16:54:29'),
(9, 'ENSO', 966, '5', '2024-03-30 16:54:41', '2024-03-30 16:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `quantity`, `category_id`, `image`, `created_at`, `updated_at`) VALUES
(5, 'LIGHTSKY  Shark Profile', 32, 3, '/uploads/media_66084812501b3.jpg', '2024-03-30 17:12:50', '2024-03-30 17:12:50'),
(6, 'LIGHTSKY  Super Scope', 60, 3, '/uploads/media_6608484d7ce14.jpg', '2024-03-30 17:13:49', '2024-03-30 17:13:49'),
(7, 'VLTG City Color 96 LED', 50, 3, '/uploads/media_660849ca8835b.jpg', '2024-03-30 17:20:10', '2024-03-30 17:20:10'),
(8, 'CYCLOPS Sparkly 1400 Profile', 8, 3, '/uploads/media_66084a3b71fce.jpg', '2024-03-30 17:22:03', '2024-03-30 17:22:03'),
(9, 'LIGHTSKY  City Color-216x3w', 30, 3, '/uploads/media_66084a872900a.jpg', '2024-03-30 17:23:19', '2024-03-30 17:23:19'),
(10, 'Blinder  4x100w Led', 40, 3, '/uploads/media_66084ade6805d.jpg', '2024-03-30 17:24:46', '2024-03-30 17:24:46'),
(11, 'LIGHTSKY  Aurora  A470', 20, 3, '/uploads/media_66084b4bd3e15.jpg', '2024-03-30 17:26:35', '2024-03-30 17:26:35'),
(12, 'LIGHTSKY F230 Beam', 30, 3, '/uploads/media_66084befac65c.jpg', '2024-03-30 17:29:19', '2024-03-30 17:29:19'),
(13, 'CYCLOPS Sparkly 300 Beam', 30, 3, '/uploads/media_66084c52ae6d7.png', '2024-03-30 17:30:58', '2024-03-30 17:30:58'),
(14, 'LIGHTSKY TX0760', 24, 3, '/uploads/media_66084d3396771.png', '2024-03-30 17:34:43', '2024-03-30 17:34:43'),
(15, 'LIGHTSKY TX 1940', 60, 3, '/uploads/media_66084d7866652.jpg', '2024-03-30 17:35:52', '2024-03-30 17:35:52'),
(16, 'LIGHTSKY Bar 10x15W   RGBW', 210, 3, '/uploads/media_66084dd3017eb.jpg', '2024-03-30 17:37:23', '2024-03-30 17:37:23'),
(17, 'LIGHTSKY   RGBW Lazer Bar 10w', 20, 3, '/uploads/media_66084e83c9b5a.jpg', '2024-03-30 17:40:19', '2024-03-30 17:40:19'),
(18, 'LIGHTSKY Par Led 54x 3W  RGBW Outdoor', 104, 3, '/uploads/media_66084efa55f21.jpg', '2024-03-30 17:42:18', '2024-03-30 17:42:18'),
(19, 'LIGHTSKY Par Led 54x3W RGBW Indoor', 152, 3, '/uploads/media_66084f65112d9.jpg', '2024-03-30 17:44:05', '2024-03-30 17:44:05'),
(20, 'LIGHTSKY Follow Spot   F450', 6, 3, '/uploads/media_66084fab78fba.jpg', '2024-03-30 17:45:15', '2024-03-30 17:45:15'),
(21, 'LIGHTSKY Profile 150W Led', 12, 3, '/uploads/media_66085002d3ad1.jpg', '2024-03-30 17:46:42', '2024-03-30 17:46:42'),
(22, 'LIGHTSKY Profile 525 W Dimmer', 24, 3, '/uploads/media_6608511494c03.jpg', '2024-03-30 17:51:16', '2024-03-30 17:51:16'),
(23, 'MR Moving Head 1200', 5, 3, '/uploads/media_660851c1ad3c4.jpg', '2024-03-30 17:54:09', '2024-03-30 17:54:09'),
(24, 'TU Fresnel 2000k', 8, 3, '/uploads/media_66085210b0bf1.jpg', '2024-03-30 17:55:28', '2024-03-30 17:55:28'),
(25, 'LIGHTSKY  Strobe', 6, 3, '/uploads/media_660855793c864.jpg', '2024-03-30 18:10:01', '2024-03-30 18:10:01'),
(26, 'STORMY   Strobe 3000W', 40, 3, '/uploads/media_6608561b0ad7b.jpg', '2024-03-30 18:12:43', '2024-03-30 18:12:43'),
(27, 'Rotator Truss Circle', 3, 9, '/uploads/media_660856af65a95.jpg', '2024-03-30 18:15:11', '2024-03-30 18:15:11'),
(28, 'Mini  Wash 6x10W', 24, 3, '/uploads/media_6608575687c8f.jpg', '2024-03-30 18:17:58', '2024-03-30 18:17:58'),
(29, 'LIGHTSKY  Parled 61x3W   w/w Outdoor', 24, 3, '/uploads/media_660857e068439.jpg', '2024-03-30 18:20:16', '2024-03-30 18:20:16'),
(30, 'Dimmer 12 CH Socapex', 2, 3, '/uploads/media_6608586528cad.png', '2024-03-30 18:22:29', '2024-03-30 18:22:29'),
(31, 'Antari LowFog', 2, 3, '/uploads/media_660858c754c58.jpg', '2024-03-30 18:24:07', '2024-03-30 18:24:07'),
(32, 'Antari Haze HZ1000', 2, 3, '/uploads/media_66085902bb4a9.png', '2024-03-30 18:25:06', '2024-03-30 18:25:06'),
(33, 'Antari Hight Fog F7', 2, 3, '/uploads/media_66085949be8ee.jpg', '2024-03-30 18:26:17', '2024-03-30 18:26:17'),
(34, 'Antari Bubble Machine', 1, 3, '/uploads/media_660859e442707.jpg', '2024-03-30 18:28:52', '2024-03-30 18:28:52'),
(35, 'Antari Smoke Machine Z3000', 4, 3, '/uploads/media_66085a5e17a8e.jpg', '2024-03-30 18:30:54', '2024-03-30 18:30:54'),
(36, 'LowFog Machine', 2, 3, '/uploads/media_66085a9488c59.jpg', '2024-03-30 18:31:48', '2024-03-30 18:31:48'),
(37, 'Smoke Machine 1200', 2, 3, '/uploads/media_66085b00ad9c8.jpg', '2024-03-30 18:33:36', '2024-03-30 18:33:36'),
(38, 'Snow Machine', 2, 3, '/uploads/media_66085b8930bf4.jpg', '2024-03-30 18:35:53', '2024-03-30 18:35:53'),
(39, 'Upsmoke Machine RGB', 4, 3, '/uploads/media_66085c61d40cb.png', '2024-03-30 18:39:29', '2024-03-30 18:39:29'),
(40, 'Bubble Machine', 2, 3, '/uploads/media_66085c92d9b49.jpg', '2024-03-30 18:40:18', '2024-03-30 18:40:18'),
(41, 'Grand MA', 3, 11, '/uploads/media_66085d1541c61.png', '2024-03-30 18:42:29', '2024-03-30 18:42:29'),
(42, 'MA WING', 1, 11, '/uploads/media_66085d6ea6bf9.jpg', '2024-03-30 18:43:58', '2024-03-30 18:43:58'),
(43, 'MA NPU', 2, 11, '/uploads/media_66085db1ce6fc.jpg', '2024-03-30 18:45:05', '2024-03-30 18:45:05'),
(44, 'AVOLITES Tiger Touch', 2, 11, '/uploads/media_66085e0ad740f.jpg', '2024-03-30 18:46:34', '2024-03-30 18:46:34'),
(45, 'ABSEN   P3.9 Y', 42, 2, '/uploads/media_660864b4decba.jpg', '2024-03-30 19:15:00', '2024-03-30 19:15:00'),
(46, 'ABSEN   P3.9 B', 200, 2, '/uploads/media_660864d1a48da.jpg', '2024-03-30 19:15:29', '2024-03-30 19:15:29'),
(47, 'ABSEN   P3.9 CORNER', 16, 2, '/uploads/media_660865040ba33.jpg', '2024-03-30 19:16:20', '2024-03-30 19:16:20'),
(48, 'Epson  3.5K', 10, 14, '/uploads/media_6608666521598.png', '2024-03-30 19:22:13', '2024-03-30 19:24:54'),
(49, 'Epson  17K', 2, 14, '/uploads/media_660866ef72781.jpg', '2024-03-30 19:24:31', '2024-03-30 19:24:31'),
(50, 'ABSEN  Hanging Bar', 50, 2, '/uploads/media_660867cb5684b.jpg', '2024-03-30 19:28:11', '2024-03-30 19:28:11'),
(51, 'Connector 1m', 200, 2, '/uploads/media_6608695f7a753.jpg', '2024-03-30 19:34:55', '2024-03-30 19:34:55'),
(52, 'ABSEN  Corner Frame New', 20, 2, '/uploads/media_66086b5a4f51a.jpg', '2024-03-30 19:43:22', '2024-03-30 19:43:22'),
(53, 'Single Pipe + Clamp  NEW', 50, 10, '/uploads/media_66086c0c7dfae.jpg', '2024-03-30 19:46:20', '2024-03-30 19:46:20'),
(54, 'Euro Truss   MEGA  4 M', 15, 9, '/uploads/media_660874a439ed9.png', '2024-03-30 20:23:00', '2024-03-30 20:23:00'),
(55, 'Euro Truss   MEGA 3 M', 6, 9, '/uploads/media_660874cf7f56e.png', '2024-03-30 20:23:43', '2024-03-30 20:23:43'),
(56, 'Euro Truss   MEGA 2 M', 6, 9, '/uploads/media_660874eb45bf0.png', '2024-03-30 20:24:11', '2024-03-30 20:24:11'),
(57, 'Euro Truss   MEGA 1 M', 4, 9, '/uploads/media_660874ff43bfd.png', '2024-03-30 20:24:31', '2024-03-30 20:24:31'),
(58, 'Euro Truss   MEGA 1/2   M', 4, 9, '/uploads/media_6608752f10b67.png', '2024-03-30 20:25:19', '2024-03-30 20:25:19'),
(59, 'Opera Truss 60*40  4 M', 10, 9, '/uploads/media_6608764f14f8b.png', '2024-03-30 20:30:07', '2024-03-30 20:30:07'),
(60, 'Opera Truss 60*40  3 M', 10, 9, '/uploads/media_6608767ea51da.png', '2024-03-30 20:30:54', '2024-03-30 20:30:54'),
(61, 'Opera Truss 60*40  2 M', 8, 9, '/uploads/media_66087692ac17c.png', '2024-03-30 20:31:14', '2024-03-30 20:31:14'),
(62, 'Opera Truss 60*40  1 M', 4, 9, '/uploads/media_660876b3c6844.png', '2024-03-30 20:31:47', '2024-03-30 20:31:47'),
(63, 'Opera Truss 60*40   1/2 M', 4, 9, '/uploads/media_660876ce3a309.png', '2024-03-30 20:32:14', '2024-03-30 20:32:14'),
(64, 'Euro Truss   50*50   4M', 50, 9, '/uploads/media_6608776631a4c.jpg', '2024-03-30 20:34:46', '2024-03-30 20:34:46'),
(65, 'Euro Truss   50*50   3M', 59, 9, '/uploads/media_660877800b6d5.jpg', '2024-03-30 20:35:12', '2024-03-30 20:35:12'),
(66, 'Euro Truss   50*50   2M', 31, 9, '/uploads/media_6608779597695.jpg', '2024-03-30 20:35:33', '2024-03-30 20:35:33'),
(67, 'Euro Truss   50*50   1M', 20, 9, '/uploads/media_660877b19149f.jpg', '2024-03-30 20:36:01', '2024-03-30 20:36:01'),
(68, 'Euro Truss   50*50   1/2 M', 20, 9, '/uploads/media_660877c7a6f76.jpg', '2024-03-30 20:36:23', '2024-03-30 20:36:23'),
(69, 'Euro Truss   50*50   Box Corner', 24, 9, '/uploads/media_6608781caa96f.jpg', '2024-03-30 20:37:48', '2024-03-30 20:37:48'),
(70, 'Euro Truss   40*40   3M', 24, 9, '/uploads/media_660878c34b12f.jpg', '2024-03-30 20:40:35', '2024-03-30 20:40:35'),
(71, 'Euro Truss   40*40   2M', 8, 9, NULL, '2024-03-30 20:40:55', '2024-03-30 20:40:55'),
(72, 'Euro Truss   40*40   1M', 3, 9, '/uploads/media_660878f325267.jpg', '2024-03-30 20:41:23', '2024-03-30 20:41:23'),
(73, 'Euro Truss   40*40   1.20 M', 8, 9, '/uploads/media_6608791c3ff3b.jpg', '2024-03-30 20:42:04', '2024-03-30 21:37:22'),
(74, 'Euro Truss   40*40   1/2 M', 1, 9, '/uploads/media_66087939c29f7.jpg', '2024-03-30 20:42:33', '2024-03-30 20:42:33'),
(75, 'Euro Truss   30*30   4M', 66, 9, '/uploads/media_660879adeee40.jpg', '2024-03-30 20:44:29', '2024-03-30 20:44:29'),
(76, 'Euro Truss   30*30   3M', 64, 9, '/uploads/media_660879cc7f1b6.jpg', '2024-03-30 20:45:00', '2024-03-30 20:45:00'),
(77, 'Euro Truss   30*30   2M', 43, 9, '/uploads/media_66087a0b86741.jpg', '2024-03-30 20:46:03', '2024-03-30 20:46:03'),
(78, 'Euro Truss   30*30   1M', 2, 9, '/uploads/media_66087a5fc0fe1.jpg', '2024-03-30 20:47:27', '2024-03-30 20:47:27'),
(79, 'Euro Truss   30*30   1/2M', 41, 9, '/uploads/media_66087a8f59767.jpg', '2024-03-30 20:48:15', '2024-03-30 20:48:15'),
(80, 'Euro Truss   30*30   2.5M', 2, 9, '/uploads/media_66087aad33468.jpg', '2024-03-30 20:48:45', '2024-03-30 20:48:45'),
(81, 'Euro Truss   30*30   Box Corner', 24, 9, '/uploads/media_66087bbcb758c.png', '2024-03-30 20:53:16', '2024-03-30 20:53:16'),
(82, 'EAGLE TRUSS Box Corner 30*30', 60, 9, '/uploads/media_66087ef570e2c.png', '2024-03-30 21:07:01', '2024-03-30 21:38:45'),
(83, 'EAGLE TRUSS  40*40   Box Corner', 54, 9, '/uploads/media_66087f63aa893.jpg', '2024-03-30 21:08:51', '2024-03-30 21:38:17'),
(84, 'Plate Aluminium 30*30', 20, 9, '/uploads/media_66087fddce206.jpg', '2024-03-30 21:10:53', '2024-03-30 21:10:53'),
(85, 'Plate Aluminium 40*40', 6, 9, '/uploads/media_66087ff4e70e0.jpg', '2024-03-30 21:11:16', '2024-03-30 21:11:16'),
(86, 'EAGLE TRUSS  30*30   3M', 0, 9, '/uploads/media_6608804e7874b.jpg', '2024-03-30 21:12:46', '2024-03-30 21:12:46'),
(87, 'EAGLE TRUSS  30*30   2M', 25, 9, '/uploads/media_6608806db8f73.jpg', '2024-03-30 21:13:17', '2024-03-30 21:13:17'),
(88, 'EAGLE TRUSS  30*30  1M', 50, 9, '/uploads/media_660880862ae3d.jpg', '2024-03-30 21:13:42', '2024-03-30 21:13:42'),
(89, 'EAGLE TRUSS  30*30  1/2M', 38, 9, '/uploads/media_660880a2c932e.jpg', '2024-03-30 21:14:10', '2024-03-30 21:14:10'),
(90, 'EAGLE TRUSS  40*40   4M', 20, 9, '/uploads/media_660885a6db6d8.jpg', '2024-03-30 21:35:34', '2024-03-30 21:35:34'),
(91, 'EAGLE TRUSS  40*40   3M', 22, 9, '/uploads/media_660885c27be49.jpg', '2024-03-30 21:36:02', '2024-03-30 21:36:02'),
(92, 'EAGLE TRUSS  40*40   2M', 25, 9, '/uploads/media_660885d1e9cff.jpg', '2024-03-30 21:36:17', '2024-03-30 21:36:17'),
(93, 'EAGLE TRUSS  40*40  1M', 19, 9, '/uploads/media_660885e8b6634.jpg', '2024-03-30 21:36:40', '2024-03-30 21:36:40'),
(94, 'EAGLE TRUSS  40*40   1/2M', 10, 9, '/uploads/media_660885fb1bd10.jpg', '2024-03-30 21:36:59', '2024-03-30 21:36:59'),
(95, 'EAGLE TRUSS  Ladder 2M', 59, 9, '/uploads/media_660886f4ee416.png', '2024-03-30 21:41:08', '2024-03-30 21:46:06'),
(96, 'EAGLE TRUSS  Ladder 1M', 33, 9, '/uploads/media_660887085614c.png', '2024-03-30 21:41:28', '2024-03-30 21:45:56'),
(97, 'Steel  Frame 0.6m * 180 m', 24, 9, '/uploads/media_66088956e0be8.png', '2024-03-30 21:51:18', '2024-03-30 21:51:18'),
(98, 'Steel  Frame 1m * 180m', 59, 9, '/uploads/media_6608897c9235e.png', '2024-03-30 21:51:56', '2024-03-30 21:51:56'),
(99, 'Steel  Frame  2 m * 0.50m', 4, 9, '/uploads/media_660889997d6e8.png', '2024-03-30 21:52:25', '2024-03-30 21:52:25'),
(100, 'Euro Truss   Sleeve Block 50*50', 8, 9, '/uploads/media_66088bd0af315.jpg', '2024-03-30 22:01:52', '2024-03-30 22:01:52'),
(101, 'Water Tank 1000L', 12, 10, '/uploads/media_66088fcbc5d1c.jpg', '2024-03-30 22:18:51', '2024-03-30 22:18:51'),
(102, 'Barriers', 70, 10, '/uploads/media_6608900079dad.jpg', '2024-03-30 22:19:44', '2024-03-30 22:19:44'),
(103, 'EAGLE TRUSS  40*40   Sleeve Block', 8, 9, '/uploads/media_66098c4f2f965.jpg', '2024-03-31 16:16:15', '2024-03-31 16:16:15'),
(104, 'EAGLE TRUSS  30*30   Sleeve Block', 8, 9, '/uploads/media_66098c6ef260f.jpg', '2024-03-31 16:16:46', '2024-03-31 16:16:46'),
(105, 'EAGLE TRUSS  60*40   Sleeve Block', 4, 9, '/uploads/media_66098cd97fb4d.jpg', '2024-03-31 16:18:33', '2024-03-31 16:18:33'),
(106, 'Euro Truss   50*50   Base Tower', 8, 9, '/uploads/media_66098d56c942a.jpg', '2024-03-31 16:20:38', '2024-03-31 16:20:38'),
(107, 'EAGLE TRUSS  40*40   Base Tower', 8, 9, '/uploads/media_66098e06b2e68.png', '2024-03-31 16:23:34', '2024-03-31 16:23:34'),
(108, 'EAGLE TRUSS 30*30   Base Tower', 8, 9, '/uploads/media_66098e2894900.png', '2024-03-31 16:24:08', '2024-03-31 16:24:08'),
(109, 'Euro Truss   50*50   TOP', 8, 9, '/uploads/media_66098ee0b0e16.jpg', '2024-03-31 16:27:12', '2024-03-31 16:27:12'),
(110, 'EAGLE TRUSS 40*40   Top', 8, 9, '/uploads/media_66098f0a11ba7.jpg', '2024-03-31 16:27:54', '2024-03-31 16:27:54'),
(111, 'EAGLE TRUSS 30*30   Top', 8, 9, '/uploads/media_66098f316f292.jpg', '2024-03-31 16:28:33', '2024-03-31 16:28:33'),
(112, 'Euro Truss   50*50  Outrigger', 32, 9, '/uploads/media_66098fbdbd97d.jpg', '2024-03-31 16:30:53', '2024-03-31 16:30:53'),
(113, 'EAGLE TRUSS  40*40   Outrigger', 32, 9, '/uploads/media_66098fd316d3e.jpg', '2024-03-31 16:31:15', '2024-03-31 16:31:15'),
(114, 'EAGLE TRUSS  40*40   Outrigger', 32, 9, '/uploads/media_66098fe9b2f27.jpg', '2024-03-31 16:31:37', '2024-03-31 16:31:37'),
(115, 'Opera Truss 30*30   Circle  3.5 M', 10, 9, '/uploads/media_6609905e3cc43.jpg', '2024-03-31 16:33:34', '2024-03-31 16:33:34'),
(116, 'Opera Truss 30*30   Circle  2.5 M', 10, 9, '/uploads/media_6609906b7234c.jpg', '2024-03-31 16:33:47', '2024-03-31 16:33:47'),
(117, 'Opera Truss 30*30   Circle   2 M', 6, 9, '/uploads/media_660990887f4b1.jpg', '2024-03-31 16:34:16', '2024-03-31 16:34:16'),
(118, 'Lifter Small', 12, 10, '/uploads/media_6609913511171.jpg', '2024-03-31 16:37:09', '2024-03-31 16:37:09'),
(119, 'Lifter Big 5.5 M', 12, 10, '/uploads/media_660991e8f3c03.png', '2024-03-31 16:40:08', '2024-03-31 16:40:33'),
(120, 'Adjustable Leg', 78, 8, '/uploads/media_660996975b4c3.jpg', '2024-03-31 17:00:07', '2024-03-31 17:46:39'),
(121, 'Base Collar 40 cn', 78, 8, '/uploads/media_660996bbdc185.jpg', '2024-03-31 17:00:43', '2024-03-31 17:47:03'),
(122, 'Ringlock  Vertical Standard 1m', 390, 8, '/uploads/media_660996e386eef.png', '2024-03-31 17:01:23', '2024-03-31 17:48:39'),
(123, 'Ringlock  Vertical Standard 2.5m', 312, 8, '/uploads/media_6609970389fce.jpg', '2024-03-31 17:01:55', '2024-03-31 17:48:53'),
(124, 'Ledger  1.5 M', 365, 8, '/uploads/media_66099737d497c.jpg', '2024-03-31 17:02:47', '2024-03-31 17:49:09'),
(125, 'Ledger  2M', 889, 8, '/uploads/media_6609974a239d3.jpg', '2024-03-31 17:03:06', '2024-03-31 17:49:23'),
(126, 'Catwalk', 100, 8, '/uploads/media_6609979ac8f6c.jpg', '2024-03-31 17:04:26', '2024-03-31 17:47:13'),
(127, 'Diagonal brace 2M', 635, 8, '/uploads/media_6609987837e7b.jpg', '2024-03-31 17:08:08', '2024-03-31 17:48:11'),
(128, 'Diagonal brace 1.5M', 260, 8, '/uploads/media_66099889ef295.jpg', '2024-03-31 17:08:25', '2024-03-31 17:47:59'),
(129, 'Meyer Sound Panther  LFC 2100', 12, 1, '/uploads/media_660c241d1fbc8.jpg', '2024-04-02 15:28:29', '2024-04-02 15:28:29'),
(130, 'Meyer Sound Panther   Top', 24, 1, '/uploads/media_660c24881c6b3.jpg', '2024-04-02 15:30:16', '2024-04-02 15:30:16'),
(131, 'Meyer Sound LFC 900', 12, 1, '/uploads/media_660c249eccc6c.jpg', '2024-04-02 15:30:38', '2024-04-02 15:30:38'),
(132, 'Meyer Sound Leopard', 24, 1, '/uploads/media_660c24b512c8c.jpg', '2024-04-02 15:31:01', '2024-04-02 15:31:01'),
(133, 'Meyer Sound Lina', 12, 1, '/uploads/media_660c24de63d10.jpg', '2024-04-02 15:31:42', '2024-04-02 15:31:42'),
(134, 'Meyer Sound MJF 212', 2, 1, '/uploads/media_660c252b795a6.jpg', '2024-04-02 15:32:59', '2024-04-02 15:32:59'),
(135, 'Meyer Sound MJF 210', 16, 1, '/uploads/media_660c253c9f04f.jpg', '2024-04-02 15:33:16', '2024-04-02 15:33:16'),
(136, 'Meyer Sound MJF 208', 2, 1, '/uploads/media_660c2553743ac.jpg', '2024-04-02 15:33:39', '2024-04-02 15:33:39'),
(137, 'Galileo Galaxy 816', 8, 1, '/uploads/media_660c25c3b6e22.png', '2024-04-02 15:35:31', '2024-04-02 15:35:31'),
(138, 'Meyer MDM 8 CH  (3pin )', 4, 1, '/uploads/media_660c261e58c81.jpg', '2024-04-02 15:37:02', '2024-04-02 15:37:02'),
(139, 'Meyer MDM 8 CH   (5pin )', 4, 1, '/uploads/media_660c264dc3d6f.jpg', '2024-04-02 15:37:49', '2024-04-02 15:37:49'),
(140, 'Speaker SF 15 +', 12, 1, '/uploads/media_660c272990781.png', '2024-04-02 15:41:17', '2024-04-02 15:41:29'),
(141, 'Speaker NF 210', 4, 1, '/uploads/media_660c277877a36.jpg', '2024-04-02 15:42:48', '2024-04-02 15:42:48'),
(142, 'Speaker York', 16, 1, '/uploads/media_660c281d8c2da.jpg', '2024-04-02 15:45:33', '2024-04-02 15:45:33'),
(143, 'Amplifer Sound Top MA 2400', 20, 1, '/uploads/media_660c2907bc580.png', '2024-04-02 15:49:27', '2024-04-02 15:49:27'),
(144, 'Amplifer  NX 6000', 1, 1, '/uploads/media_660c293999e84.jpg', '2024-04-02 15:50:17', '2024-04-02 15:50:17'),
(145, 'Amplifer  Yamaha PX 10', 2, 1, '/uploads/media_660c2971131c4.jpg', '2024-04-02 15:51:13', '2024-04-02 15:51:13'),
(146, 'Amplifer  Yamaha PX 8', 2, 1, '/uploads/media_660c297c2a2d2.jpg', '2024-04-02 15:51:24', '2024-04-02 15:51:24'),
(147, 'Prossecor Sound Top Sp 226', 3, 1, '/uploads/media_660c29d61fba2.png', '2024-04-02 15:52:54', '2024-04-02 15:52:54'),
(148, 'Speaker RB Elmark', 150, 1, '/uploads/media_660c2a32df001.png', '2024-04-02 15:54:26', '2024-04-02 15:54:26'),
(149, 'Mixer Yamaha  CL5', 1, 1, '/uploads/media_660c2a7766ebb.png', '2024-04-02 15:55:35', '2024-04-02 15:55:35'),
(150, 'Mixer Yamaha  QL5', 1, 1, '/uploads/media_660c2abe47ee5.png', '2024-04-02 15:56:46', '2024-04-02 15:56:46'),
(151, 'Mixer Behringer X 32', 1, 1, '/uploads/media_660c2b0295d5b.jpg', '2024-04-02 15:57:54', '2024-04-02 15:57:54'),
(152, 'Mixer Allen & Heath SQ5', 1, 1, '/uploads/media_660c2bb2f0ca1.jpg', '2024-04-02 16:00:50', '2024-04-02 16:00:50'),
(153, 'Mixer Allen & Heath SQ7', 1, 1, '/uploads/media_660c2bc590ca7.jpg', '2024-04-02 16:01:09', '2024-04-02 16:01:09'),
(154, 'Dante DT 168', 2, 1, '/uploads/media_660c2bf0c7d22.jpg', '2024-04-02 16:01:52', '2024-04-02 16:01:52'),
(155, 'RIO Yamaha', 2, 1, '/uploads/media_660c2c136dbc2.jpg', '2024-04-02 16:02:27', '2024-04-02 16:02:27'),
(156, 'DL 32 CH', 1, 1, '/uploads/media_660c2c3792bae.png', '2024-04-02 16:03:03', '2024-04-02 16:03:03'),
(157, 'SHURE Wirless  ULX D4', 24, 1, '/uploads/media_660c2c86c1155.png', '2024-04-02 16:04:22', '2024-04-02 16:04:22'),
(158, 'SHURE Wirless  ULX D4   Hand Mic', 16, 1, '/uploads/media_660c2cb91ddc7.jpg', '2024-04-02 16:05:13', '2024-04-02 16:05:13'),
(159, 'SHURE Wirless  ULX D4  Belt', 12, 1, '/uploads/media_660c2cf9cce0b.png', '2024-04-02 16:06:17', '2024-04-02 16:06:17'),
(160, 'SHURE Antena Power   Distribution', 6, 1, '/uploads/media_660c2d643a441.png', '2024-04-02 16:08:04', '2024-04-02 16:15:27'),
(161, 'SHURE QLX D4 Receiver', 4, 1, '/uploads/media_660c317e15535.jpg', '2024-04-02 16:25:34', '2024-04-02 16:25:34'),
(162, 'SHURE QLX D4 Belt', 4, 1, '/uploads/media_660c31918e41d.jpg', '2024-04-02 16:25:53', '2024-04-02 16:25:53'),
(163, 'SHURE SLX  4   Receiver', 4, 1, '/uploads/media_660c3217b69d5.jpg', '2024-04-02 16:28:07', '2024-04-02 16:28:07'),
(164, 'SHURE SLX  4   Hand Mic', 5, 1, '/uploads/media_660c3247c9a37.png', '2024-04-02 16:28:55', '2024-04-02 16:28:55'),
(165, 'SHURE  SM58', 18, 1, '/uploads/media_660c33792e66a.jpg', '2024-04-02 16:34:01', '2024-04-02 16:34:01'),
(166, 'SHURE  SM57', 19, 1, '/uploads/media_660c338aa8abe.jpg', '2024-04-02 16:34:18', '2024-04-02 16:34:18'),
(167, 'SHURE  SM81', 8, 1, '/uploads/media_660c33a29586d.jpg', '2024-04-02 16:34:42', '2024-04-02 16:34:42'),
(168, 'SHURE  Beta 58', 8, 1, '/uploads/media_660c33b73769a.jpg', '2024-04-02 16:35:03', '2024-04-02 16:35:03'),
(169, 'SHURE  Beta 57', 8, 1, '/uploads/media_660c33c58d0ec.jpg', '2024-04-02 16:35:17', '2024-04-02 16:35:17'),
(170, 'SAMSON C02', 4, 1, '/uploads/media_660c341632c4d.jpg', '2024-04-02 16:36:38', '2024-04-02 16:36:38'),
(171, 'AUDIO TECHNICA AT 871', 4, 1, '/uploads/media_660c34e573175.jpg', '2024-04-02 16:40:05', '2024-04-02 16:40:05'),
(172, 'DPA SET MIC BOX', 2, 1, '/uploads/media_660c352ece940.jpg', '2024-04-02 16:41:18', '2024-04-02 16:41:18'),
(173, 'SHURE GOUSNECK', 19, 1, '/uploads/media_660c354ee5490.jpg', '2024-04-02 16:41:50', '2024-04-02 16:41:50'),
(174, 'SHURE 55  SH', 1, 1, '/uploads/media_660c3587516e8.jpg', '2024-04-02 16:42:47', '2024-04-02 16:42:47'),
(175, 'AKG C414 XLS', 4, 1, '/uploads/media_660c35afe535c.png', '2024-04-02 16:43:27', '2024-04-02 16:43:27'),
(176, 'DPA HEAD SET MIC', 16, 1, '/uploads/media_660c35ed8ec99.jpg', '2024-04-02 16:44:29', '2024-04-02 16:44:29'),
(177, 'DPA HEAD SET MIC', 16, 1, '/uploads/media_660c35fc0a9f4.jpg', '2024-04-02 16:44:44', '2024-04-02 16:44:44'),
(178, 'GOOSENECK  SENHEIZER  BASE', 14, 1, '/uploads/media_660c366e567e8.png', '2024-04-02 16:46:38', '2024-04-02 16:46:38'),
(179, 'GOOSENECK SENHEIZER MZH 3042', 8, 1, '/uploads/media_660c3694e9433.jpg', '2024-04-02 16:47:16', '2024-04-02 16:47:16'),
(180, 'GOOSENECK SENHEIZER MZH 3072', 6, 1, '/uploads/media_660c36bf2cc26.jpg', '2024-04-02 16:47:59', '2024-04-02 16:47:59'),
(181, 'GOOSENECK SAMSON', 16, 1, '/uploads/media_660c371688b44.jpg', '2024-04-02 16:49:26', '2024-04-02 16:49:26'),
(182, 'MIXER ELMARK RB800BT  8CH', 20, 1, '/uploads/media_660c37bde7ab6.png', '2024-04-02 16:52:13', '2024-04-02 16:52:13'),
(183, 'MIXER YAMAHA MG 10 XU', 1, 1, '/uploads/media_660c37fcd778c.jpg', '2024-04-02 16:53:16', '2024-04-02 16:53:16'),
(184, 'MIXER YAMAHA MG 6 X', 1, 1, '/uploads/media_660c381d5a627.jpg', '2024-04-02 16:53:49', '2024-04-02 16:53:49'),
(185, 'MIXER ALTO 8 CH', 3, 1, '/uploads/media_660c38613f6b5.jpg', '2024-04-02 16:54:57', '2024-04-02 16:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_25_190743_create_clients_table', 1),
(6, '2024_03_25_190744_create_categories_table', 1),
(7, '2024_03_25_190745_create_items_table', 1),
(8, '2024_03_26_081752_create_checkouts_table', 1),
(9, '2024_03_26_085021_create_checkout_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, '$2y$12$S5vSS6jWupPjM1paRInhueEH3OdaMVxUDGIyYX6bFbYYIcdvMfL32', NULL, NULL, NULL),
(2, 'user', 'user', 'user@user.com', NULL, '$2y$12$GcDvr8HbGPkvAFgcclE.Z.3KRWnDnIbv1xAB.oM2.YQdZXnSCACYS', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkouts_client_id_foreign` (`client_id`);

--
-- Indexes for table `checkout_items`
--
ALTER TABLE `checkout_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkout_items_checkout_id_foreign` (`checkout_id`),
  ADD KEY `checkout_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkout_items`
--
ALTER TABLE `checkout_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `checkout_items`
--
ALTER TABLE `checkout_items`
  ADD CONSTRAINT `checkout_items_checkout_id_foreign` FOREIGN KEY (`checkout_id`) REFERENCES `checkouts` (`id`),
  ADD CONSTRAINT `checkout_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
