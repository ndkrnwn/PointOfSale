-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_type` varchar(10) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_point` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `discount_item` int(11) NOT NULL,
  `sub_price` int(11) NOT NULL,
  `disc_total` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `total_point` int(11) DEFAULT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`cart_id`, `item_id`, `item_type`, `item_price`, `item_point`, `qty`, `discount_item`, `sub_price`, `disc_total`, `total_price`, `total_point`, `createdby`) VALUES
(1, 91, 'product', 75000, 600, 1, 0, 75000, 0, 75000, 600, 13),
(2, 1, 'service', 80000, 0, 1, 0, 80000, 0, 80000, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `category` varchar(5) NOT NULL,
  `point` int(11) DEFAULT 0,
  `password` varchar(100) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `modifyby` int(11) DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`customer_id`, `name`, `gender`, `phone`, `email`, `address`, `category`, `point`, `password`, `createdby`, `createddate`, `modifyby`, `modifydate`) VALUES
(8, 'Umum Laki - Laki', 'L', NULL, '', NULL, 'CC001', 600, '', 13, '2023-10-18 03:59:00', NULL, NULL),
(9, 'Umum Perempuan', 'P', NULL, '', NULL, 'CC001', 200, '', 13, '2023-10-18 03:59:28', NULL, NULL),
(37, 'Andy Kurniawan', 'P', '081347112088', 'ndkrnwn07@gmail.com', NULL, 'CC002', 500, '827ccb0eea8a706c4c34a16891f84e7b', 13, '2024-08-11 11:02:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_parameter`
--

CREATE TABLE `tb_parameter` (
  `id` int(11) NOT NULL,
  `class` varchar(25) NOT NULL,
  `code` varchar(7) NOT NULL,
  `explanation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_parameter`
--

INSERT INTO `tb_parameter` (`id`, `class`, `code`, `explanation`) VALUES
(5, 'User Level', 'UL001', 'Admin'),
(153, 'User Level', 'UL003', 'Cashier'),
(162, 'Customer Category', 'CC001', 'Non Membership'),
(163, 'Customer Category', 'CC002', 'Membership'),
(166, 'Service Category', 'SC001', 'Facial Treatment'),
(167, 'Service Category', 'SC002', 'Eyelash Treatment'),
(168, 'Service Category', 'SC003', 'Nails Treatment'),
(169, 'Service Category', 'SC004', 'Waxing Treatment'),
(170, 'Service Category', 'SC005', 'Hair Treatment'),
(171, 'Service Category', 'SC006', 'SPA'),
(172, 'Service Category', 'SC007', 'SPA Package'),
(173, 'Service Category', 'SC008', 'Podiy Kids Treatment');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` longtext DEFAULT NULL,
  `price` int(11) NOT NULL,
  `stock` int(10) NOT NULL DEFAULT 0,
  `is_point_exchange` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `file_name` varchar(255) DEFAULT NULL,
  `createddate` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `modifydate` datetime DEFAULT NULL,
  `modifyby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `name`, `description`, `price`, `stock`, `is_point_exchange`, `point`, `file_name`, `createddate`, `createdby`, `modifydate`, `modifyby`) VALUES
(77, 'Slimming Capsule', NULL, 225000, 100, 0, 0, 'Slimming_Capsule.jpg', '2023-10-16 10:19:02', 13, '2023-11-06 08:45:44', 13),
(91, 'Acne Daily Bb Cream', NULL, 75000, 94, 1, 600, 'Acne_Daily_Bb_Cream1.jpg', '2023-10-17 16:41:28', 13, '2024-08-15 11:20:08', 13),
(92, 'Acne Night Cream', NULL, 85000, 97, 0, 0, 'Acne_Night_Cream.jpg', '2023-10-17 16:41:28', 13, '2024-07-29 05:35:40', 13),
(93, 'Acne Serum', NULL, 150000, 100, 0, 0, 'Acne_Serum.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:49:12', 13),
(94, 'Toner Acne Fight', NULL, 80000, 100, 0, 0, 'Toner_Acne_Fight.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:51:47', 13),
(95, 'Paket MS Kids', NULL, 265000, 100, 0, 0, 'Paket_MS_Kids.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 08:56:27', 13),
(96, 'White Cell DNA Body Essence Skin Tone Booster', NULL, 99000, 100, 0, 0, 'White_Cell_DNA_Body_Essence_Skin_Tone_Booster.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:52:34', 13),
(97, 'Easy White Body Lotion', NULL, 110000, 100, 0, 0, 'Easy_White_Body_Lotion.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:54:18', 13),
(98, 'Easy Bright Body Serum', 'Diperkaya dengan Glutathione & Tranexamic Acid, Body Serum ini bermanfaat untuk melembabkan kulit, mencerahkan warna kulit dan memudarkan bekas luka. Mengapa body serum penting? Karena body serum merupakan konsentrat dimana partikel nanonya mampu menembus layer kulit terdalam sehingga hasilnya lebih cepat dan lebih maksimal.', 110000, 100, 0, 0, 'Easy_Bright_Body_Serum.jpg', '2023-10-17 16:41:28', 13, '2024-08-02 05:51:42', 13),
(99, 'Body Treatment Oil', NULL, 225000, 100, 0, 0, 'Body_Treatment_Oil.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:54:43', 13),
(100, 'Balm Juice - Yuzu', NULL, 120000, 100, 0, 0, 'Balm_Juice_-_Yuzu.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 09:09:46', 13),
(101, 'Juice Moisturizer Cactus Grape Seed', NULL, 150000, 100, 0, 0, 'Juice_Moisturizer_Cactus_Grape_Seed.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:56:26', 13),
(104, 'Ultra Moist Cushion - Light', NULL, 200000, 100, 0, 0, 'Ultra_Moist_Cushion_-_Light.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:57:54', 13),
(105, 'Ultra Moist Cushion - Medium', NULL, 200000, 100, 0, 0, 'Ultra_Moist_Cushion_-_Medium.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:58:08', 13),
(106, 'Dark Spot Treatment Serum', NULL, 100000, 100, 0, 0, 'Dark_Spot_Treatment_Serum.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 07:58:55', 13),
(108, 'Deep Treatment Essence', NULL, 175000, 100, 0, 0, 'Deep_Treatment_Essence.jpg', '2023-10-17 16:41:28', 13, '2023-11-06 08:02:05', 13),
(109, 'Deodorant For Men - Terra', NULL, 75000, 100, 0, 0, 'Deodorant_For_Men_-_Terra.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:02:41', 13),
(110, 'Deodorant For Men - Silva', NULL, 75000, 100, 0, 0, 'Deodorant_For_Men_-_Silva.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:02:54', 13),
(111, 'White Cell DNA Night Cream', NULL, 90000, 100, 0, 0, 'White_Cell_DNA_Night_Cream.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:03:35', 13),
(117, 'Eyeshadow Seminyak', NULL, 120000, 100, 0, 0, 'Eyeshadow_Seminyak.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:05:47', 13),
(118, 'Face Peel Scrub', NULL, 125000, 100, 0, 0, 'Face_Peel_Scrub.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:06:14', 13),
(119, 'Facial Wash ', NULL, 60000, 100, 0, 0, 'Facial_Wash_.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:06:42', 13),
(120, 'Facial Wash Golden', NULL, 60000, 100, 0, 0, 'Facial_Wash_Golden.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:07:21', 13),
(121, 'Facial Wash MS Glow For Men', NULL, 60000, 100, 0, 0, 'Facial_Wash_MS_Glow_For_Men.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:07:55', 13),
(122, 'Glasskin Drink', NULL, 250000, 100, 0, 0, 'Glasskin_Drink.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:08:25', 13),
(123, 'Gluta Soap - Kojic', NULL, 100000, 100, 0, 0, 'Gluta_Soap_-_Kojic1.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:52:29', 13),
(124, 'Gluta Soap - Milk', NULL, 100000, 100, 0, 0, 'Gluta_Soap_-_Milk1.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:52:37', 13),
(125, 'Green Tea Clay Mask', NULL, 125000, 100, 0, 0, 'Green_Tea_Clay_Mask.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:09:40', 13),
(127, 'Beard Hair Serum', NULL, 150000, 100, 0, 0, 'Beard_Hair_Serum.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:10:34', 13),
(128, 'JJ Glow', NULL, 125000, 100, 0, 0, 'JJ_Glow.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:11:11', 13),
(130, 'Bubble Wash - MS KIDS', NULL, 85000, 100, 0, 0, 'Bubble_Wash_MS_KIDS.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:12:57', 13),
(131, 'Shampoo Kids - MS KIDS', NULL, 95000, 100, 0, 0, 'Shampoo_Kids_-_MS_KIDS.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:12:48', 13),
(134, 'Whitening Lifting Glow Serum', NULL, 150000, 100, 0, 0, 'Whitening_Lifting_Glow_Serum.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:15:01', 13),
(135, 'Super Shine Lip Serum', NULL, 59000, 100, 0, 0, 'Super_Shine_Lip_Serum.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:15:30', 13),
(136, 'Loose Powder Ivory', NULL, 98000, 100, 0, 0, 'Loose_Powder_Ivory.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:16:04', 13),
(137, 'Loose Powder Hay To Shine Natural', NULL, 98000, 100, 0, 0, 'Loose_Powder_Hay_To_Shine_Natural.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:16:44', 13),
(138, 'Loose Powder Oily to Matte', NULL, 98000, 100, 0, 0, 'Loose_Powder_Oily_to_Matte.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:17:21', 13),
(139, 'Luminous Glowing Serum', NULL, 150000, 100, 0, 0, 'Luminous_Glowing_Serum.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:18:02', 13),
(140, 'Luminous Whitening Night Cream', NULL, 85000, 100, 0, 0, 'Luminous_Whitening_Night_Cream.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:18:40', 13),
(141, 'Body Maskulin', NULL, 100000, 100, 0, 0, 'Body_Maskulin.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:19:01', 13),
(143, 'Pomade Playmaker - Water Base Pomade', NULL, 100000, 100, 0, 0, 'Pomade_Playmaker_-_Water_Base_Pomade.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:20:25', 13),
(144, 'Pomade Playmaker - Oil Base Pomade', NULL, 100000, 100, 0, 0, 'Pomade_Playmaker_-_Oil_Base_Pomade.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:20:54', 13),
(145, 'Pomade Playmaker - Clay Base Pomade', NULL, 100000, 100, 0, 0, 'Pomade_Playmaker_-_Clay_Base_Pomade.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:21:12', 13),
(147, 'MS Slim', NULL, 250000, 100, 0, 0, 'MS_Slim.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:22:03', 13),
(148, 'Nail Polish - 01', NULL, 59000, 100, 0, 0, 'Nail_Polish_-_01.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:24:37', 13),
(149, 'Nail Polish - 02', NULL, 59000, 100, 0, 0, 'Nail_Polish_-_02.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:25:00', 13),
(150, 'Nail Polish - 03', NULL, 59000, 100, 0, 0, 'Nail_Polish_-_03.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:25:10', 13),
(151, 'Nail Polish - 04', NULL, 59000, 100, 0, 0, 'Nail_Polish_-_04.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:25:22', 13),
(152, 'Nail Polish - 05', NULL, 59000, 100, 0, 0, 'Nail_Polish_-_05.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:26:02', 13),
(153, 'Nail Polish - 06', NULL, 59000, 100, 0, 0, 'Nail_Polish_-_06.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:26:12', 13),
(157, 'Neck Cream By MS Glow', NULL, 150000, 100, 0, 0, 'Neck_Cream_By_MS_Glow.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:28:00', 13),
(158, 'Paket - Easy White Body Series ', NULL, 200000, 100, 0, 0, 'Paket_-_Easy_White_Body_Series_.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:29:50', 13),
(190, 'Peeling Serum', NULL, 150000, 100, 0, 0, 'Peeling_Serum.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:31:10', 13),
(191, 'Pore Away Spot Treatment', NULL, 100000, 100, 0, 0, 'Pore_Away_Spot_Treatment.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:32:09', 13),
(192, 'Radiance Gold Gel', NULL, 300000, 100, 0, 0, 'Radiance_Gold_Gel.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:48:25', 13),
(193, 'Flawless Glow Red Jelly', NULL, 300000, 100, 0, 0, 'Flawless_Glow_Red_Jelly.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:49:12', 13),
(194, 'Eye Treatment Serum', NULL, 125000, 100, 0, 0, 'Eye_Treatment_Serum.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:50:20', 13),
(196, 'Serum White Cell DNA', NULL, 175000, 100, 0, 0, 'Serum_White_Cell_DNA.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:53:57', 13),
(211, 'Gluta Soap - Collagen', NULL, 100000, 100, 0, 0, 'Gluta_Soap_-_Collagen.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:52:20', 13),
(212, 'Acne Spot Treatment', NULL, 100000, 100, 0, 0, 'Acne_Spot_Treatment.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:51:08', 13),
(213, 'Sunscreen Spray MS Glow For Men', NULL, 100000, 100, 0, 0, 'Sunscreen_Spray_MS_Glow_For_Men.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:47:46', 13),
(215, 'Toner Glowing ', NULL, 80000, 100, 0, 0, 'Toner_Glowing_.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:44:31', 13),
(219, 'Balm Juice - Watermelon', NULL, 120000, 100, 0, 0, 'Balm_Juice_-_Watermelon.jpg', '2023-10-17 16:41:29', 13, '2024-07-29 05:35:45', 13),
(220, 'Juice Moisturizer Watermelon', NULL, 150000, 100, 0, 0, 'Juice_Moisturizer_Watermelon.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:46:20', 13),
(221, 'Whitening Bb Cream', NULL, 75000, 100, 0, 0, 'Whitening_Bb_Cream.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:42:41', 13),
(222, 'Whitening Day Cream', NULL, 75000, 100, 0, 0, 'Whitening_Day_Cream.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:40:22', 13),
(223, 'Whitening Gold Serum', NULL, 175000, 100, 0, 0, 'Whitening_Gold_Serum.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:39:56', 13),
(224, 'Whitening Night Cream', NULL, 85000, 100, 0, 0, 'Whitening_Night_Cream.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:39:25', 13),
(225, 'Whitening Scrub - Collagen', NULL, 100000, 100, 0, 0, 'Whitening_Scrub_-_Collagen.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:36:52', 13),
(226, 'Whitening Scrub - Kojic', NULL, 100000, 100, 0, 0, 'Whitening_Scrub_-_Kojic.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:37:26', 13),
(227, 'Whitening Scrub - Milk', NULL, 100000, 100, 0, 0, 'Whitening_Scrub_-_Milk.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:37:41', 13),
(228, 'Balm Juice - Cactus', NULL, 120000, 100, 0, 0, 'Balm_Juice_-_Cactus.jpg', '2023-10-17 16:41:29', 13, '2023-11-06 08:33:40', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_review`
--

CREATE TABLE `tb_review` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `detail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale`
--

CREATE TABLE `tb_sale` (
  `sale_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sub_total` int(11) NOT NULL,
  `disc_total` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `point` int(11) DEFAULT 0,
  `payment` varchar(25) NOT NULL,
  `pay_point` int(11) DEFAULT NULL,
  `sale_date` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_sale`
--

INSERT INTO `tb_sale` (`sale_id`, `invoice`, `customer_id`, `sub_total`, `disc_total`, `total_price`, `cash`, `remaining`, `point`, `payment`, `pay_point`, `sale_date`, `createdby`, `createddate`) VALUES
(124, 'MP2408110001', 37, 75000, 0, 75000, 75000, 0, 100, 'CASH', 0, '2024-08-11 17:02:53', 13, '2024-08-11 11:03:49'),
(125, 'MP2408110002', 37, 300000, 15000, 285000, 0, 0, 200, 'BCA', 0, '2024-08-11 17:04:16', 13, '2024-08-11 11:05:03'),
(126, 'MP2408120001', 37, 75000, 0, 75000, 0, 0, 100, 'BCA', 0, '2024-08-12 11:19:51', 28, '2024-08-12 05:21:08'),
(127, 'MP2408150001', 37, 170000, 0, 170000, 0, 0, 100, 'BRI', 0, '2024-08-15 17:18:02', 13, '2024-08-15 11:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale_detail`
--

CREATE TABLE `tb_sale_detail` (
  `detail_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `detail_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount_item` int(11) NOT NULL,
  `sub_price` int(11) NOT NULL,
  `disc_total` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `review` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sale_detail`
--

INSERT INTO `tb_sale_detail` (`detail_id`, `sale_id`, `service_id`, `product_id`, `detail_price`, `qty`, `discount_item`, `sub_price`, `disc_total`, `total_price`, `review`) VALUES
(152, 124, NULL, 91, 75000, 1, 0, 75000, 0, 75000, 0),
(153, 125, NULL, 91, 75000, 4, 5, 300000, 15000, 285000, 0),
(154, 126, NULL, 91, 75000, 1, 0, 75000, 0, 75000, 0),
(155, 127, NULL, 92, 85000, 3, 0, 255000, 0, 255000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_service`
--

CREATE TABLE `tb_service` (
  `service_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(5) NOT NULL,
  `modal` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL DEFAULT current_timestamp(),
  `modifyby` int(11) DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_service`
--

INSERT INTO `tb_service` (`service_id`, `name`, `category`, `modal`, `price`, `createdby`, `createddate`, `modifyby`, `modifydate`) VALUES
(1, 'Acc Nails Gel Full Set', 'SC003', 50000, 80000, 13, '2023-10-16 11:27:16', NULL, NULL),
(2, 'Add Massage (30 Min)', 'SC006', 20000, 50000, 13, '2023-10-16 11:27:16', NULL, NULL),
(3, 'Aromatherapy Body Spa', 'SC007', 140000, 265000, 13, '2023-10-16 11:27:16', NULL, NULL),
(4, 'Balinese Massage', 'SC006', 75000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(5, 'Bleaching', 'SC005', 120000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(6, 'Blow', 'SC005', 15000, 55000, 13, '2023-10-16 11:27:16', NULL, NULL),
(7, 'Body Bleaching', 'SC006', 50000, 100000, 13, '2023-10-16 11:27:16', NULL, NULL),
(8, 'Body Mask', 'SC006', 30000, 65000, 13, '2023-10-16 11:27:16', NULL, NULL),
(9, 'Body Scrub', 'SC006', 35000, 65000, 13, '2023-10-16 11:27:16', NULL, NULL),
(10, 'Body Steam', 'SC006', 30000, 55000, 13, '2023-10-16 11:27:16', NULL, NULL),
(11, 'Breast Care', 'SC006', 35000, 85000, 13, '2023-10-16 11:27:16', NULL, NULL),
(12, 'Bride Package', 'SC007', 370000, 620000, 13, '2023-10-16 11:27:16', NULL, NULL),
(13, 'Bright Glow Body Spa', 'SC007', 160000, 310000, 13, '2023-10-16 11:27:16', NULL, NULL),
(14, 'Bunny Package', 'SC007', 442500, 775000, 13, '2023-10-16 11:27:16', NULL, NULL),
(15, 'Candle Massage', 'SC006', 85000, 250000, 13, '2023-10-16 11:27:16', NULL, NULL),
(16, 'Charger Room', 'SC006', 20000, 50000, 13, '2023-10-16 11:27:16', NULL, NULL),
(17, 'Classic Lash', 'SC002', 115000, 195000, 13, '2023-10-16 11:27:16', NULL, NULL),
(18, 'Coloring Biasa (No Bleach) Uk. Extra L', 'SC005', 450000, 550000, 13, '2023-10-16 11:27:16', NULL, NULL),
(19, 'Coloring Biasa (No Bleach) Uk. L', 'SC005', 350000, 450000, 13, '2023-10-16 11:27:16', NULL, NULL),
(20, 'Coloring Biasa (No Bleach) Uk. M', 'SC005', 275000, 375000, 13, '2023-10-16 11:27:16', NULL, NULL),
(21, 'Coloring Biasa (No Bleach) Uk. S', 'SC005', 150000, 250000, 13, '2023-10-16 11:27:16', NULL, NULL),
(22, 'Coloring Biasa (No Bleach) Uk. Xm', 'SC005', 200000, 300000, 13, '2023-10-16 11:27:16', NULL, NULL),
(23, 'Coloring Biasa (No Bleach) Uk. Xs', 'SC005', 120000, 175000, 13, '2023-10-16 11:27:16', NULL, NULL),
(24, 'Creambath Biasa', 'SC005', 75000, 130000, 13, '2023-10-16 11:27:16', NULL, NULL),
(25, 'Creambath Luxury Hair (Adenovital)', 'SC005', 150000, 250000, 13, '2023-10-16 11:27:16', NULL, NULL),
(26, 'Creambath Luxury Hair (Fuente Forte)', 'SC005', 175000, 250000, 13, '2023-10-16 11:27:16', NULL, NULL),
(27, 'Creambath Tradisional', 'SC005', 50000, 85000, 13, '2023-10-16 11:27:16', NULL, NULL),
(28, 'Curly', 'SC005', 15000, 60000, 13, '2023-10-16 11:27:16', NULL, NULL),
(29, 'Cut Child', 'SC005', 25000, 65000, 13, '2023-10-16 11:27:16', NULL, NULL),
(30, 'Cut Child', 'SC008', 25000, 65000, 13, '2023-10-16 11:27:16', NULL, NULL),
(31, 'Cut Dewasa', 'SC005', 40000, 90000, 13, '2023-10-16 11:27:16', NULL, NULL),
(32, 'Cut Poni', 'SC005', 15000, 35000, 13, '2023-10-16 11:27:16', NULL, NULL),
(33, 'Ear Candle', 'SC006', 15000, 50000, 13, '2023-10-16 11:27:16', NULL, NULL),
(34, 'Edelweiss Body Spa', 'SC007', 220000, 485000, 13, '2023-10-16 11:27:16', NULL, NULL),
(35, 'Facial Acne Premium', 'SC001', 125000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(36, 'Facial Anti Aging', 'SC001', 125000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(37, 'Facial Bb Glow', 'SC001', 165000, 300000, 13, '2023-10-16 11:27:16', NULL, NULL),
(38, 'Facial Brigtening Glow', 'SC001', 85000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(39, 'Facial Caviar Peeling', 'SC001', 130000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(40, 'Facial Detox', 'SC001', 95000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(41, 'Facial Diamond Gold', 'SC001', 135000, 400000, 13, '2023-10-16 11:27:16', NULL, NULL),
(42, 'Facial Meso Glow', 'SC001', 210000, 600000, 13, '2023-10-16 11:27:16', NULL, NULL),
(43, 'Facial Oxy', 'SC001', 120000, 400000, 13, '2023-10-16 11:27:16', NULL, NULL),
(44, 'Facial Peeling Acne', 'SC001', 120000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(45, 'Facial Peeling Glow', 'SC001', 130000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(46, 'Facial Pimpel Glow', 'SC001', 85000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(47, 'Facial Rf Glow', 'SC001', 175000, 500000, 13, '2023-10-16 11:27:16', NULL, NULL),
(48, 'Facial Ultimate', 'SC001', 85000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(49, 'Facial Vit C', 'SC001', 125000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(50, 'Fechia Body Spa', 'SC007', 185000, 279000, 13, '2023-10-16 11:27:16', NULL, NULL),
(51, 'Flower Bath', 'SC006', 30000, 85000, 13, '2023-10-16 11:27:16', NULL, NULL),
(52, 'Foot Reflexy', 'SC006', 20000, 65000, 13, '2023-10-16 11:27:16', NULL, NULL),
(53, 'Full Hands', 'SC004', 100000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(54, 'Full Legs', 'SC004', 150000, 250000, 13, '2023-10-16 11:27:16', NULL, NULL),
(55, 'Full Reflexy', 'SC006', 60000, 110000, 13, '2023-10-16 11:27:16', NULL, NULL),
(56, 'Garbera Body Spa', 'SC007', 215000, 415000, 13, '2023-10-16 11:27:16', NULL, NULL),
(57, 'Hair Mask', 'SC005', 85000, 125000, 13, '2023-10-16 11:27:16', NULL, NULL),
(58, 'Hair Mask Luxury Hair (Luminogenic, Aqua, Airy Flow)', 'SC005', 150000, 250000, 13, '2023-10-16 11:27:16', NULL, NULL),
(59, 'Hair Mask Premium Hair (Absolut, Vitamino, Liss Unlimited)', 'SC005', 125000, 225000, 13, '2023-10-16 11:27:16', NULL, NULL),
(60, 'Hair Spa', 'SC005', 95000, 160000, 13, '2023-10-16 11:27:16', NULL, NULL),
(61, 'Hair Treatment Child', 'SC008', 39000, 69000, 13, '2023-10-16 11:27:16', NULL, NULL),
(62, 'Hair Wash ', 'SC005', 10000, 25000, 13, '2023-10-16 11:27:16', NULL, NULL),
(63, 'Half Hands', 'SC004', 50000, 150000, 13, '2023-10-16 11:27:16', NULL, NULL),
(64, 'Half Legs', 'SC004', 75000, 175000, 13, '2023-10-16 11:27:16', NULL, NULL),
(65, 'Hand & Foot Reflexy', 'SC006', 40000, 95000, 13, '2023-10-16 11:27:16', NULL, NULL),
(66, 'Hand Reflexy', 'SC006', 20000, 45000, 13, '2023-10-16 11:27:16', NULL, NULL),
(67, 'Herbal Massage', 'SC006', 135000, 240000, 13, '2023-10-16 11:27:16', NULL, NULL),
(68, 'Highlight', 'SC005', 170000, 300000, 13, '2023-10-16 11:27:16', NULL, NULL),
(69, 'Honey Package', 'SC007', 575000, 1150000, 13, '2023-10-16 11:27:16', NULL, NULL),
(70, 'Hot Stone Massage', 'SC006', 95000, 225000, 13, '2023-10-16 11:27:16', NULL, NULL),
(71, 'Javanesse Massage', 'SC006', 69000, 169000, 13, '2023-10-16 11:27:16', NULL, NULL),
(72, 'Korean Fey Lash', 'SC002', 130000, 275000, 13, '2023-10-16 11:27:16', NULL, NULL),
(73, 'Kutek Cat Eyes', 'SC003', 80000, 110000, 13, '2023-10-16 11:27:16', NULL, NULL),
(74, 'Kutek Gel Polish (Kaki)', 'SC003', 90000, 120000, 13, '2023-10-16 11:27:16', NULL, NULL),
(75, 'Kutek Gel Polish (Tangan)', 'SC003', 80000, 110000, 13, '2023-10-16 11:27:16', NULL, NULL),
(76, 'Kutek Inglot (Tangan/Kaki)', 'SC003', 50000, 75000, 13, '2023-10-16 11:27:16', NULL, NULL),
(77, 'Kutek Inglot Tangan Dan Kaki', 'SC003', 0, 150000, 13, '2023-10-16 11:27:16', NULL, NULL),
(78, 'Kutek Opi Tangan Dan Kaki', 'SC003', 0, 110000, 13, '2023-10-16 11:27:16', NULL, NULL),
(79, 'Kutek Polish Opi (Tangan / Kaki)', 'SC003', 0, 55000, 13, '2023-10-16 11:27:16', NULL, NULL),
(80, 'Lash Lift', 'SC002', 90000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(81, 'Lash Spa', 'SC002', 10000, 20000, 13, '2023-10-16 11:27:16', NULL, NULL),
(82, 'Menicure Child', 'SC008', 30000, 50000, 13, '2023-10-16 11:27:16', NULL, NULL),
(83, 'Menicure Express', 'SC003', 45000, 75000, 13, '2023-10-16 11:27:16', NULL, NULL),
(84, 'Menicure Gehwol', 'SC003', 85000, 115000, 13, '2023-10-16 11:27:16', NULL, NULL),
(85, 'Menicure Spa', 'SC003', 90000, 150000, 13, '2023-10-16 11:27:16', NULL, NULL),
(86, 'Menipedi Child', 'SC008', 65000, 100000, 13, '2023-10-16 11:27:16', NULL, NULL),
(87, 'Milan Beauty', 'SC002', 160000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(88, 'Nail Polish Full Art Child', 'SC008', 35000, 55000, 13, '2023-10-16 11:27:16', NULL, NULL),
(89, 'Nail Polos - Child', 'SC008', 20000, 45000, 13, '2023-10-16 11:27:16', NULL, NULL),
(90, 'Pedicure Child', 'SC008', 35000, 55000, 13, '2023-10-16 11:27:16', NULL, NULL),
(91, 'Pedicure Express', 'SC003', 55000, 85000, 13, '2023-10-16 11:27:16', NULL, NULL),
(92, 'Pedicure Gehwol', 'SC003', 95000, 125000, 13, '2023-10-16 11:27:16', NULL, NULL),
(93, 'Pedicure Spa', 'SC003', 110000, 170000, 13, '2023-10-16 11:27:16', NULL, NULL),
(94, 'Podiy Massage', 'SC006', 65000, 165000, 13, '2023-10-16 11:27:16', NULL, NULL),
(95, 'Pregnancy Massage', 'SC006', 69000, 169000, 13, '2023-10-16 11:27:16', NULL, NULL),
(96, 'Pregnancy Package', 'SC007', 175000, 305000, 13, '2023-10-16 11:27:16', NULL, NULL),
(97, 'Privilage Body Spa', 'SC007', 270000, 580000, 13, '2023-10-16 11:27:16', NULL, NULL),
(98, 'Ratus V Spa', 'SC006', 35000, 65000, 13, '2023-10-16 11:27:16', NULL, NULL),
(99, 'Remove Eyelash', 'SC002', 25000, 50000, 13, '2023-10-16 11:27:16', NULL, NULL),
(100, 'Remove Gel', 'SC003', 25000, 50000, 13, '2023-10-16 11:27:16', NULL, NULL),
(101, 'Retouch 1', 'SC002', 90000, 200000, 13, '2023-10-16 11:27:16', NULL, NULL),
(102, 'Retouch 2', 'SC002', 80000, 180000, 13, '2023-10-16 11:27:16', NULL, NULL),
(103, 'Retouch 3', 'SC002', 50000, 100000, 13, '2023-10-16 11:27:16', NULL, NULL),
(104, 'Retouch 4', 'SC002', 30000, 80000, 13, '2023-10-16 11:27:16', NULL, NULL),
(105, 'Romance Body Spa', 'SC007', 200000, 395000, 13, '2023-10-16 11:27:16', NULL, NULL),
(106, 'Russian', 'SC002', 185000, 350000, 13, '2023-10-16 11:27:16', NULL, NULL),
(107, 'Slimming Package', 'SC007', 110000, 275000, 13, '2023-10-16 11:27:16', NULL, NULL),
(108, 'Smoothing Uk L', 'SC005', 450000, 600000, 13, '2023-10-16 11:27:16', NULL, NULL),
(109, 'Smoothing Uk M', 'SC005', 350000, 500000, 13, '2023-10-16 11:27:16', NULL, NULL),
(110, 'Smoothing Uk S', 'SC005', 250000, 400000, 13, '2023-10-16 11:27:16', NULL, NULL),
(111, 'Spa Bath (Milk/Salt)', 'SC006', 35000, 75000, 13, '2023-10-16 11:27:16', NULL, NULL),
(112, 'Spa For Kids', 'SC007', 140000, 240000, 13, '2023-10-16 11:27:16', NULL, NULL),
(113, 'Straight', 'SC005', 15000, 50000, 13, '2023-10-16 11:27:16', NULL, NULL),
(114, 'Totok Wajah 15 Min', 'SC006', 20000, 55000, 13, '2023-10-16 11:27:16', NULL, NULL),
(115, 'Totok Wajah 30 Min', 'SC006', 40000, 95000, 13, '2023-10-16 11:27:16', NULL, NULL),
(116, 'Underarm', 'SC004', 50000, 85000, 13, '2023-10-16 11:27:16', NULL, NULL),
(117, 'Wash & Blow', 'SC005', 25000, 80000, 13, '2023-10-16 11:27:16', NULL, NULL),
(118, 'Wash & Curly', 'SC005', 25000, 85000, 13, '2023-10-16 11:27:16', NULL, NULL),
(119, 'Wash & Straight', 'SC005', 25000, 75000, 13, '2023-10-16 11:27:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stock`
--

CREATE TABLE `tb_stock` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `qty` int(10) NOT NULL,
  `date` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_survey`
--

CREATE TABLE `tb_survey` (
  `survey_id` int(11) NOT NULL,
  `survey_type` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `improvement` text NOT NULL,
  `comments` text NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(5) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` date DEFAULT NULL,
  `modifyby` int(11) DEFAULT NULL,
  `modifydate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `name`, `username`, `password`, `level`, `createdby`, `createddate`, `modifyby`, `modifydate`) VALUES
(13, 'Andy Kurniawan', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 'UL001', 0, NULL, 13, '2024-08-02'),
(28, 'Olivia Mahsa Arnelya', 'olivia.mahsa', 'e10adc3949ba59abbe56e057f20f883e', 'UL003', 13, '2024-08-02', 13, '2024-08-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `modifyby` (`modifyby`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `tb_parameter`
--
ALTER TABLE `tb_parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `modifyby` (`modifyby`);

--
-- Indexes for table `tb_review`
--
ALTER TABLE `tb_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `detail_id` (`detail_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `createdby` (`createdby`);

--
-- Indexes for table `tb_sale_detail`
--
ALTER TABLE `tb_sale_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `tb_service`
--
ALTER TABLE `tb_service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `modifyby` (`modifyby`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `tb_stock`
--
ALTER TABLE `tb_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `createdby` (`createdby`);

--
-- Indexes for table `tb_survey`
--
ALTER TABLE `tb_survey`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `createdby` (`createdby`),
  ADD KEY `modifyby` (`modifyby`),
  ADD KEY `level` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_parameter`
--
ALTER TABLE `tb_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `tb_review`
--
ALTER TABLE `tb_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_sale`
--
ALTER TABLE `tb_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tb_sale_detail`
--
ALTER TABLE `tb_sale_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `tb_service`
--
ALTER TABLE `tb_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tb_stock`
--
ALTER TABLE `tb_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tb_survey`
--
ALTER TABLE `tb_survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD CONSTRAINT `tb_cart_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD CONSTRAINT `tb_customer_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `tb_product_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_review`
--
ALTER TABLE `tb_review`
  ADD CONSTRAINT `tb_review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tb_customer` (`customer_id`);

--
-- Constraints for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD CONSTRAINT `tb_sale_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tb_customer` (`customer_id`),
  ADD CONSTRAINT `tb_sale_ibfk_3` FOREIGN KEY (`createdby`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_sale_detail`
--
ALTER TABLE `tb_sale_detail`
  ADD CONSTRAINT `tb_sale_detail_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `tb_service` (`service_id`),
  ADD CONSTRAINT `tb_sale_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tb_product` (`product_id`),
  ADD CONSTRAINT `tb_sale_detail_ibfk_3` FOREIGN KEY (`sale_id`) REFERENCES `tb_sale` (`sale_id`);

--
-- Constraints for table `tb_service`
--
ALTER TABLE `tb_service`
  ADD CONSTRAINT `tb_service_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_stock`
--
ALTER TABLE `tb_stock`
  ADD CONSTRAINT `tb_stock_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tb_product` (`product_id`),
  ADD CONSTRAINT `tb_stock_ibfk_3` FOREIGN KEY (`createdby`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_survey`
--
ALTER TABLE `tb_survey`
  ADD CONSTRAINT `tb_survey_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tb_customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
