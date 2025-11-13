-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2025 at 12:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feethub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `product_id` int(20) NOT NULL,
  `merchant_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `username`, `product_id`, `merchant_id`, `product_name`, `quantity`, `total_amount`, `payment_method`, `order_date`) VALUES
(1, 0, '', 16, 2, 'UrbanStride Sneakers', 1, 1219.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 16:59:30'),
(2, 0, '', 16, 2, 'UrbanStride Sneakers', 1, 1219.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:01:58'),
(3, 0, '', 16, 2, 'UrbanStride Sneakers', 1, 1219.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:05:11'),
(4, 0, 'rishi', 19, 14, 'ClassicSlip Sandals', 1, 769.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:19:32'),
(5, 0, 'rishi', 20, 2, 'TrekMaster Hiking Boots', 1, 2929.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:22:27'),
(6, 0, 'rishi', 24, 2, 'SprintTrail Runners', 1, 1399.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:23:58'),
(7, 0, 'rishi', 20, 2, 'TrekMaster Hiking Boots', 1, 2929.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:27:30'),
(8, 0, 'mk6', 24, 2, 'SprintTrail Runners', 2, 2748.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:28:54'),
(9, 0, 'rishi', 25, 2, 'GlamHeel Block Sandals', 1, 1009.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:31:47'),
(10, 0, 'rishi', 31, 2, 'DaintySlide Pearl Flats', 1, 769.00, 'Cash on Delivery/Pay on Delivery', '2025-10-26 17:33:29'),
(11, 0, 'nithya', 30, 14, 'ElegantPoint Pumps', 1, 1759.00, 'Other UPI Apps', '2025-10-26 18:34:54'),
(12, 0, 'pri', 28, 14, 'PowerWalk Sports Shoes', 2, 4188.00, 'Cash on Delivery/Pay on Delivery', '2025-10-27 05:17:19'),
(13, 0, 'pri', 19, 14, 'ClassicSlip Sandals', 2, 1488.00, 'Pay on Delivery', '2025-10-27 07:48:26'),
(14, 0, 'vijirishi', 25, 2, 'GlamHeel Block Sandals', 2, 1968.00, 'Other UPI Apps', '2025-10-27 12:14:39'),
(15, 0, 'rishi', 19, 14, 'ClassicSlip Sandals', 2, 1488.00, 'Pay on Delivery', '2025-10-28 10:18:30'),
(16, 0, 'mk6', 31, 2, 'DaintySlide Pearl Flats', 1, 769.00, 'Pay on Delivery', '2025-10-29 10:42:34'),
(17, 0, 'jkumaar', 31, 2, 'DaintySlide Pearl Flats', 8, 5804.00, 'Other UPI Apps', '2025-10-29 13:03:39'),
(18, 0, 'rishi', 24, 2, 'SprintTrail Runners', 3, 4097.00, 'Pay on Delivery', '2025-10-31 09:00:51'),
(19, 0, 'testuser', 19, 14, 'ClassicSlip Sandals', 5, 3646.00, 'Pay on Delivery', '2025-11-01 09:24:10'),
(20, 0, 'mk6', 53, 2, 'Testing product', 1, 0.00, '', '2025-11-03 04:51:25'),
(21, 0, 'mk6', 43, 2, 'Leather Loafers', 1, 1849.00, 'UPI Payment', '2025-11-03 04:56:26'),
(22, 0, 'mk6', 43, 2, 'Leather Loafers', 5, 9046.00, 'UPI Payment', '2025-11-03 11:12:35'),
(23, 0, 'mk6', 43, 2, 'Leather Loafers', 10, 18041.00, 'Pay on Delivery', '2025-11-03 11:13:48'),
(24, 0, 'mk6', 43, 2, 'Leather Loafers', 5, 9046.00, 'UPI Payment', '2025-11-03 11:24:56'),
(25, 0, 'mk6', 44, 2, 'Sport Runners ', 5, 4546.00, 'UPI Payment', '2025-11-03 11:29:02'),
(26, 0, 'mk6', 36, 2, 'SwiftRun Sports Shoes', 1, 1039.00, 'Pay on Delivery', '2025-11-03 11:32:12'),
(27, 0, 'mk6', 44, 2, 'Sport Runners ', 1, 949.00, 'UPI Payment', '2025-11-05 10:55:48'),
(28, 0, 'mk69', 43, 2, 'Leather Loafers', 3, 5447.00, 'Pay on Delivery', '2025-11-06 13:35:04'),
(29, 0, 'rishhh', 43, 2, 'Leather Loafers', 1, 1849.00, 'Pay on Delivery', '2025-11-07 05:05:31'),
(30, 0, 'mk69', 19, 14, 'ClassicSlip Sandals', 1, 0.00, '', '2025-11-08 02:27:07'),
(31, 0, 'mk69', 19, 14, 'ClassicSlip Sandals', 1, 0.00, '', '2025-11-08 02:31:54'),
(32, 0, 'mk69', 17, 14, ' LeatherLuxe Loafers', 1, 2208.00, 'Pay on Delivery', '2025-11-08 02:35:49'),
(33, 0, 'rishhh', 46, 14, 'Cloud Slides', 1, 2110.00, 'Pay on Delivery', '2025-11-08 05:00:08'),
(34, 0, 'rishhh', 44, 2, 'Sport Runners ', 1, 3009.00, 'Pay on Delivery', '2025-11-08 05:04:09'),
(35, 0, 'rishhh', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-08 05:12:52'),
(36, 0, 'rishhh', 46, 14, 'Cloud Slides', 1, 290.00, 'Pay on Delivery', '2025-11-08 05:12:52'),
(37, 0, 'rishhh', 44, 2, 'Sport Runners ', 1, 999.00, 'Pay on Delivery', '2025-11-08 05:12:52'),
(38, 0, 'rishhh', 24, 2, 'SprintTrail Runners', 1, 1499.00, 'Pay on Delivery', '2025-11-08 05:12:52'),
(39, 0, 'mk69', 19, 14, 'ClassicSlip Sandals', 1, 799.00, 'Pay on Delivery', '2025-11-08 06:57:49'),
(40, 0, 'mk69', 17, 14, ' LeatherLuxe Loafers', 1, 1899.00, 'Pay on Delivery', '2025-11-08 06:57:49'),
(41, 0, 'mk69', 24, 2, 'SprintTrail Runners', 1, 1499.00, 'Pay on Delivery', '2025-11-08 07:41:45'),
(42, 0, 'mk6', 20, 2, 'TrekMaster Hiking Boots', 1, 3199.00, 'Pay on Delivery', '2025-11-08 10:17:09'),
(43, 2, 'mk6', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-08 10:22:41'),
(44, 0, 'mk6', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-08 10:23:05'),
(45, 2, 'mk6', 17, 14, ' LeatherLuxe Loafers', 1, 1899.00, 'Pay on Delivery', '2025-11-08 10:26:16'),
(46, 2, 'mk6', 20, 2, 'TrekMaster Hiking Boots', 1, 3199.00, 'Pay on Delivery', '2025-11-08 10:26:16'),
(47, 1, 'rishhh', 25, 2, 'GlamHeel Block Sandals', 1, 1199.00, 'Pay on Delivery', '2025-11-08 10:27:02'),
(48, 1, 'rishhh', 25, 2, 'GlamHeel Block Sandals', 1, 1199.00, 'Pay on Delivery', '2025-11-08 10:27:02'),
(49, 1, 'rishhh', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-08 10:27:02'),
(50, 0, 'rishhh', 24, 2, 'SprintTrail Runners', 1, 1499.00, 'Pay on Delivery', '2025-11-08 10:41:58'),
(51, 0, 'rishhh', 20, 2, 'TrekMaster Hiking Boots', 1, 2929.00, 'Pay on Delivery', '2025-11-08 10:49:04'),
(52, 0, 'rishhh', 18, 14, 'AirFlex Running Shoes', 1, 1219.00, 'Pay on Delivery', '2025-11-08 10:49:24'),
(53, 0, 'rishhh', 18, 14, 'AirFlex Running Shoes', 1, 1219.00, 'Pay on Delivery', '2025-11-08 10:51:38'),
(54, 0, 'rishhh', 28, 14, 'PowerWalk Sports Shoes', 1, 2119.00, 'Pay on Delivery', '2025-11-08 10:52:53'),
(55, 0, 'rishhh', 25, 2, 'GlamHeel Block Sandals', 1, 1009.00, 'Pay on Delivery', '2025-11-08 10:53:13'),
(56, 0, 'rishhh', 25, 2, 'GlamHeel Block Sandals', 1, 1009.00, 'Pay on Delivery', '2025-11-08 10:54:05'),
(57, 0, 'rishhh', 43, 2, 'Leather Loafers', 1, 2928.00, 'Pay on Delivery', '2025-11-08 10:56:28'),
(58, 0, 'rishhh', 43, 2, 'Leather Loafers', 1, 1849.00, 'Pay on Delivery', '2025-11-08 11:00:27'),
(59, 0, 'rishhh', 43, 2, 'Leather Loafers', 1, 1849.00, 'Pay on Delivery', '2025-11-08 11:04:54'),
(60, 0, 'rishhh', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-08 11:09:03'),
(61, 0, 'mk6', 24, 2, 'SprintTrail Runners', 1, 1499.00, 'Pay on Delivery', '2025-11-11 10:48:11'),
(62, 0, 'begum', 29, 14, 'VelvetTouch House Slippers', 1, 499.00, 'Pay on Delivery', '2025-11-11 11:54:59'),
(63, 0, 'begum', 18, 14, 'AirFlex Running Shoes', 1, 1299.00, 'UPI Payment', '2025-11-11 11:58:23'),
(64, 0, 'begum', 25, 2, 'GlamHeel Block Sandals', 1, 1199.00, 'UPI Payment', '2025-11-11 11:58:23'),
(65, 0, 'rishhh', 46, 14, 'Cloud Slides', 1, 290.00, 'Pay on Delivery', '2025-11-12 11:51:39'),
(67, 0, 'rishhh', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-12 11:52:40'),
(68, 0, 'rishhh', 18, 14, 'AirFlex Running Shoes', 1, 1299.00, 'Pay on Delivery', '2025-11-12 11:53:40'),
(69, 0, 'mk6', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-12 18:26:07'),
(70, 0, 'mk6', 24, 2, 'SprintTrail Runners', 1, 1499.00, 'Pay on Delivery', '2025-11-12 18:26:45'),
(72, 0, 'mk6', 43, 2, 'Leather Loafers', 1, 1999.00, 'Pay on Delivery', '2025-11-12 18:42:42'),
(73, 0, 'mk6', 44, 2, 'Sport Runners ', 1, 949.00, 'Pay on Delivery', '2025-11-12 18:45:42'),
(75, 0, 'jayakumar', 17, 14, ' LeatherLuxe Loafers', 1, 1569.00, 'Pay on Delivery', '2025-11-12 19:34:45'),
(76, 0, 'jayakumar', 72, 23, 'PICAASO', 1, 310.10, 'Pay on Delivery', '2025-11-12 19:36:26'),
(77, 0, 'jayakumar', 16, 2, 'UrbanStride Sneakers', 1, 1219.00, 'Pay on Delivery', '2025-11-12 19:36:54'),
(78, 0, 'jayakumar', 24, 2, 'SprintTrail Runners', 1, 1399.10, 'Pay on Delivery', '2025-11-12 19:37:15'),
(79, 0, 'jayakumar', 46, 14, 'Cloud Slides', 1, 261.00, 'Pay on Delivery', '2025-11-12 19:45:13'),
(80, 0, 'jayakumar', 16, 2, 'UrbanStride Sneakers', 1, 1169.10, 'Pay on Delivery', '2025-11-12 19:45:36'),
(81, 0, 'jayakumar', 24, 2, 'SprintTrail Runners', 1, 1349.10, 'Pay on Delivery', '2025-11-12 19:45:52'),
(82, 0, 'mk6', 24, 2, 'SprintTrail Runners', 1, 1349.10, 'Pay on Delivery', '2025-11-13 10:53:24'),
(83, 0, 'mk6', 43, 2, 'Leather Loafers', 1, 1799.10, 'UPI Payment', '2025-11-13 11:01:51'),
(84, 0, 'mk6', 24, 2, 'SprintTrail Runners', 1, 1349.10, 'UPI Payment', '2025-11-13 11:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` enum('Kids','Family','Mens','Women','Formal','Seasonal') NOT NULL,
  `Type` enum('Shoes','Slippers','Flip-Flops','Sandals') NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` int(2) NOT NULL,
  `stock_status` enum('in_stock','out_of_stock') NOT NULL DEFAULT 'in_stock',
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `colour_count` int(4) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL,
  `is_best_seller` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `merchant_id`, `product_name`, `category`, `Type`, `price`, `discount`, `stock_status`, `description`, `created_at`, `colour_count`, `status`, `is_best_seller`) VALUES
(16, 2, 'UrbanStride Sneakers', 'Mens', 'Shoes', '1299', 10, 'in_stock', 'UrbanStride Sneakers blend comfort and style with a unique patchwork design, distressed details, and a heart–thunderbolt emblem—perfect for modern men seeking a fashionable edge for casual outings.', '2025-10-14 07:02:31', 2, 'active', 0),
(17, 14, ' LeatherLuxe Loafers', 'Mens', 'Shoes', '1899', 20, 'in_stock', 'LeatherLuxe Loafers exude sophistication with their sleek silhouette, premium leather finish, and cushioned insole—perfect for men who value timeless elegance and all-day comfort in every step.', '2025-10-23 23:59:46', 1, 'active', 0),
(18, 14, 'AirFlex Running Shoes', 'Mens', 'Shoes', '1299', 10, 'in_stock', 'ChatGPT said:  AirFlex Running Shoes deliver superior performance with breathable mesh fabric, lightweight cushioning, and flexible soles—ideal for men who seek comfort, speed, and style in every run.', '2025-10-24 00:03:16', 1, 'active', 0),
(20, 2, 'TrekMaster Hiking Boots', 'Mens', 'Shoes', '3199', 10, 'in_stock', 'ChatGPT said:  TrekMaster Hiking Boots are built for adventure with rugged soles, water-resistant material, and ankle support—perfect for outdoor enthusiasts seeking durability, comfort, and grip on any terrain.', '2025-10-24 00:11:33', 1, 'active', 0),
(24, 2, 'SprintTrail Runners', 'Mens', 'Shoes', '1499', 10, 'in_stock', 'SprintTrail Runners offer high-performance agility with breathable mesh uppers, shock-absorbing midsoles, and superior traction—perfect for runners who demand speed, comfort, and stability on every trail.', '2025-10-25 01:35:05', 1, 'active', 0),
(25, 2, 'GlamHeel Block Sandals', 'Women', 'Shoes', '1199', 20, 'in_stock', 'GlamHeel Block Sandals elevate your style with chic block heels, smooth straps, and a cushioned sole—perfect for adding elegance and comfort to any outfit, from brunch to evening outings.', '2025-10-25 01:51:15', 1, 'active', 0),
(26, 2, 'JumpJoy Velcro Sneakers', 'Kids', 'Shoes', '899', 10, 'in_stock', '**JumpJoy Velcro Sneakers** bring fun and comfort together with easy Velcro closures, vibrant designs, and cushioned soles—perfect for kids who love to play, explore, and move with ease all day long.', '2025-10-25 02:36:34', 1, 'active', 0),
(27, 14, 'BreezyFlip Floral Slippers', 'Women', 'Shoes', '599', 10, 'in_stock', 'BreezyFlip Floral Slippers feature a charming floral design, soft cushioned footbed, and lightweight build—perfect for a breezy, comfortable look during casual strolls or relaxing at home.', '2025-10-26 07:58:09', 1, 'active', 0),
(28, 14, 'PowerWalk Sports Shoes', 'Women', 'Shoes', '2299', 10, 'in_stock', 'PowerWalk Sports Shoes combine dynamic support with breathable mesh and cushioned midsoles—perfect for fitness enthusiasts who value comfort, stability, and performance in every step.', '2025-10-26 08:08:47', 1, 'active', 0),
(29, 14, 'VelvetTouch House Slippers', 'Women', 'Shoes', '499', 10, 'in_stock', 'VelvetTouch House Slippers offer ultimate coziness with plush velvet fabric, a soft inner lining, and non-slip soles—perfect for keeping your feet warm and comfortable during relaxing moments at home.', '2025-10-26 08:11:21', 2, 'active', 0),
(30, 14, 'ElegantPoint Pumps', 'Women', 'Shoes', '1899', 10, 'in_stock', 'ElegantPoint Pumps exude sophistication with a sleek pointed-toe design, smooth finish, and cushioned insole—perfect for adding a touch of elegance to formal events or everyday office wear.', '2025-10-26 08:12:42', 1, 'active', 0),
(31, 2, 'DaintySlide Pearl Flats', 'Women', 'Shoes', '899', 20, 'in_stock', 'DaintySlide Pearl Flats blend grace and comfort with delicate pearl embellishments, sleek straps, and a soft cushioned sole—perfect for adding a touch of elegance to casual or festive outfits.', '2025-10-26 08:15:37', 1, 'active', 0),
(33, 2, 'RainbowSlip Sandals', 'Kids', 'Shoes', '649', 10, 'in_stock', 'RainbowSlip Sandals feature vibrant multicolor straps, a lightweight design, and a comfortable footbed—perfect for adding a fun, casual touch to any summer or beach outing.', '2025-10-26 08:20:43', 1, 'active', 0),
(34, 2, 'MiniGlide School Shoes', 'Kids', 'Shoes', '749', 10, 'in_stock', 'MiniGlide School Shoes offer durable construction, a comfortable cushioned insole, and a secure fit—perfect for kids to stay active and comfortable throughout their school day.', '2025-10-26 08:22:53', 2, 'active', 0),
(35, 2, 'CuteBunny Slippers', 'Kids', 'Shoes', '499', 10, 'in_stock', 'CuteBunny Slippers feature adorable bunny designs, soft plush material, and cozy soles—perfect for keeping little feet warm and playful at home.', '2025-10-26 08:40:20', 1, 'active', 0),
(36, 2, 'SwiftRun Sports Shoes', 'Kids', 'Shoes', '1099', 10, 'in_stock', 'SwiftRun Sports Shoes deliver lightweight performance with breathable mesh, responsive cushioning, and durable soles—perfect for athletes and fitness enthusiasts seeking speed, comfort, and support.', '2025-10-26 08:42:30', 1, 'active', 0),
(37, 2, 'PlaySprint Sports Shoes', 'Kids', 'Shoes', '899', 10, 'in_stock', 'PlaySprint Sports Shoes combine vibrant style with breathable fabric, cushioned soles, and flexible support—perfect for kids who love running, playing, and staying active all day.', '2025-10-26 08:44:11', 1, 'active', 0),
(42, 14, 'Faux Fur Thong Slipper', 'Family', 'Shoes', '820', 10, 'in_stock', 'A classic flip-flop style with a cozy, plush faux fur strap and footbed for ultimate indoor comfort and warmth.', '2025-10-30 14:07:57', 1, 'active', 0),
(43, 2, 'Leather Loafers', 'Mens', 'Shoes', '1999', 10, 'in_stock', 'Leather Loafers showcase timeless elegance with premium leather craftsmanship, a sleek slip-on design, and cushioned comfort—perfect for both formal occasions and everyday sophistication.', '2025-11-01 01:40:25', 1, 'active', 1),
(44, 2, 'Sport Runners ', 'Women', 'Shoes', '999', 10, 'in_stock', 'Sport Runners deliver high-energy performance with breathable mesh uppers, shock-absorbing soles, and flexible grip—perfect for running, training, or daily active wear.', '2025-11-01 01:41:50', 1, 'active', 1),
(46, 14, 'Cloud Slides', 'Women', 'Shoes', '290', 10, 'in_stock', 'Cloud Slides provide ultimate comfort with ultra-soft cushioning, lightweight material, and a contoured footbed—perfect for relaxing at home, post-workout recovery, or casual outdoor wear.', '2025-11-01 01:47:11', 1, 'active', 1),
(48, 2, 'Lightweight Waterproof Slippers', 'Seasonal', 'Shoes', '589', 10, 'in_stock', 'Yoho Lightweight Waterproof Slippers combine comfort and practicality with a water-resistant design, soft cushioned sole, and slip-resistant grip—perfect for daily wear, indoors or outdoors.', '2025-11-01 02:06:32', 1, 'active', 0),
(49, 2, 'Women’s Sandal Pigeon', 'Seasonal', 'Shoes', '1599', 10, 'in_stock', 'Women’s Sandal Pigeon blends elegance and comfort with a sleek design, adjustable straps, and cushioned footbed—perfect for everyday wear, offering style and support with every step.', '2025-11-01 02:08:14', 1, 'active', 0),
(50, 2, 'Metro Women Brown Formal Slip Ons', 'Formal', 'Shoes', '1533', 20, 'in_stock', 'Metro Women Brown Formal Slip-Ons feature a polished finish, sleek design, and cushioned insole—perfect for professional settings, offering all-day comfort with a touch of timeless sophistication.', '2025-11-01 02:09:58', 1, 'active', 0),
(51, 2, 'Mens Formal Office Comfort zone', 'Formal', 'Shoes', '1499', 10, 'in_stock', 'Men’s Formal Office Comfort Slip-On Shoes combine classic style with modern comfort, featuring a smooth finish, cushioned footbed, and easy slip-on design—perfect for a sharp, professional look all day long.', '2025-11-01 02:14:46', 1, 'active', 0),
(72, 23, 'PICAASO', 'Women', 'Shoes', '289', 10, 'in_stock', 'PICAASO blend comfort and style with a unique patchwork design, distressed details, and a heart thunderbolt emblem perfect for modern men seeking a fashionable edge for casual outings.', '2025-11-12 15:04:07', 1, 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `image_path` varchar(400) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `color`, `image_path`, `is_main`) VALUES
(44, 16, 'Green', 'assests/images/add-product/colorGreen.png', 1),
(45, 16, 'Green', 'assests/images/add-product/colorGreen.png', 0),
(46, 16, 'Green', 'assests/images/add-product/viewFour.png', 0),
(47, 16, 'Green', 'assests/images/add-product/viewOne.png', 0),
(48, 16, 'Green', 'assests/images/add-product/viewThree.png', 0),
(49, 16, 'Green', 'assests/images/add-product/viewTwo.png', 0),
(50, 16, 'Yellow', 'assests/images/add-product/colorYellow.png', 1),
(51, 16, 'Yellow', 'assests/images/add-product/colorYellow.png', 0),
(52, 16, 'Yellow', 'assests/images/add-product/YellowFour.png', 0),
(53, 16, 'Yellow', 'assests/images/add-product/YellowOne.png', 0),
(54, 16, 'Yellow', 'assests/images/add-product/YellowThree.png', 0),
(55, 16, 'Yellow', 'assests/images/add-product/YellowTwo.png', 0),
(56, 17, 'Brown', 'assests/images/add-product/men2.png', 1),
(57, 18, 'grey', 'assests/images/add-product/men3.png', 1),
(59, 20, 'Brown', 'assests/images/add-product/men5.png', 1),
(61, 24, 'Brown', 'assests/images/add-product/men6.png', 1),
(62, 25, 'Sandal', 'assests/images/add-product/womens.png', 1),
(63, 26, 'pink', 'assests/images/add-product/kid1.png', 1),
(64, 27, 'pink', 'assests/images/add-product/women2.png', 1),
(65, 28, 'purple', 'assests/images/add-product/women3.png', 1),
(66, 29, 'pink', 'assests/images/add-product/women4.png', 1),
(67, 30, 'white', 'assests/images/add-product/women5.png', 1),
(68, 31, 'sandal', 'assests/images/add-product/women6.png', 1),
(70, 33, 'Rainbow', 'assests/images/add-product/kid2.png', 1),
(71, 34, 'Black', 'assests/images/add-product/kid3.png', 1),
(72, 35, 'pink', 'assests/images/add-product/kids4.png', 1),
(73, 36, 'orange', 'assests/images/add-product/kids5.png', 1),
(74, 37, 'Green', 'assests/images/add-product/kids6.png', 1),
(78, 42, 'pink', 'assests/images/add-product/flipflop-1.jpg', 1),
(79, 43, 'Brown', 'assests/images/add-product/bestsellerOne.png', 1),
(80, 44, 'pink', 'assests/images/add-product/bestsellerTwo.png', 1),
(82, 46, 'pink', 'assests/images/add-product/bestsellerThree.png', 1),
(84, 48, 'half-white', 'assests/images/add-product/season-2.jpg', 1),
(85, 49, 'light-pink', 'assests/images/add-product/season-1.jpg', 1),
(86, 50, 'chocolate', 'assests/images/add-product/formal-3.jpg', 1),
(87, 51, 'green', 'assests/images/add-product/formal-2.jpg', 1),
(100, 72, 'Green', 'uploads/products/color_6914e12fb36f76.59410870.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`) VALUES
(96, 18, '28'),
(97, 18, '29'),
(98, 18, '30'),
(99, 18, '31'),
(100, 18, '32'),
(107, 20, '33'),
(108, 20, '34'),
(109, 20, '35'),
(110, 20, '36'),
(111, 20, '37'),
(136, 24, '28'),
(137, 24, '29'),
(138, 24, '30'),
(139, 24, '31'),
(140, 24, '32'),
(141, 24, '33'),
(142, 24, '34'),
(143, 24, '35'),
(144, 24, '36'),
(145, 24, '37'),
(146, 25, '7'),
(147, 25, '8'),
(148, 25, '9'),
(149, 25, '10'),
(150, 25, '11'),
(151, 25, '12'),
(152, 26, '6'),
(153, 26, '7'),
(154, 26, '8'),
(155, 26, '9'),
(156, 26, '10'),
(329, 16, '28'),
(330, 16, '29'),
(331, 16, '30'),
(332, 16, '31'),
(333, 16, '32'),
(334, 16, '33'),
(335, 16, '34'),
(336, 16, '35'),
(337, 16, '36'),
(338, 16, '37'),
(346, 17, '9'),
(347, 17, '10'),
(348, 17, '11'),
(349, 17, '12'),
(350, 17, '13'),
(351, 17, '14'),
(352, 17, '15'),
(356, 27, '9'),
(357, 27, '10'),
(358, 27, '11'),
(359, 28, '28'),
(360, 28, '29'),
(361, 28, '30'),
(362, 28, '31'),
(363, 29, '11'),
(364, 29, '12'),
(365, 29, '13'),
(369, 30, '10'),
(370, 30, '11'),
(371, 30, '12'),
(372, 31, '8'),
(373, 31, '9'),
(374, 31, '10'),
(375, 31, '11'),
(380, 33, '6'),
(381, 33, '7'),
(382, 33, '8'),
(383, 33, '9'),
(384, 34, '6'),
(385, 34, '7'),
(386, 34, '8'),
(387, 34, '9'),
(388, 34, '10'),
(389, 35, '6'),
(390, 35, '7'),
(391, 35, '8'),
(392, 36, '6'),
(393, 36, '7'),
(394, 36, '8'),
(395, 36, '9'),
(396, 37, '7'),
(397, 37, '8'),
(398, 37, '9'),
(399, 37, '10'),
(417, 42, '9'),
(418, 42, '10'),
(419, 43, '28'),
(420, 43, '30'),
(421, 43, '31'),
(428, 46, '6'),
(429, 46, '7'),
(432, 49, '33'),
(433, 49, '34'),
(434, 49, '35'),
(435, 50, '35'),
(436, 50, '36'),
(437, 50, '37'),
(454, 44, '15'),
(455, 44, '28'),
(456, 44, '29'),
(457, 44, '30'),
(501, 51, '30'),
(502, 51, '31'),
(503, 51, '32'),
(504, 51, '33'),
(505, 51, '34'),
(506, 51, '35'),
(507, 51, '36'),
(508, 51, '37'),
(517, 72, '6'),
(518, 72, '7'),
(519, 72, '8');

-- --------------------------------------------------------

--
-- Table structure for table `sub_admins`
--

CREATE TABLE `sub_admins` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `manager_id` varchar(50) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_admins`
--

INSERT INTO `sub_admins` (`id`, `name`, `manager_id`, `password`, `email_id`, `phone`, `status`, `created_at`) VALUES
(19, 'ishi', 'mg-18', 'Rishi@303', 'rishikav30@gmail.com', '9865541187', 'active', '2025-11-13 05:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `landmark` varchar(50) DEFAULT NULL,
  `role` enum('customer','merchant') DEFAULT 'customer',
  `shop_name` varchar(100) DEFAULT NULL,
  `brand_name` varchar(100) DEFAULT NULL,
  `business_number` varchar(15) DEFAULT NULL,
  `shop_address` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `first_name`, `last_name`, `user_name`, `email`, `phone`, `password`, `state`, `district`, `address`, `landmark`, `role`, `shop_name`, `brand_name`, `business_number`, `shop_address`, `created_at`, `status`) VALUES
(1, 'Rishika', 'Rishika', 'rishhh', 'rishikav@gmail.com', '6381118290', 'asdfASDF@123', 'Tamil Nadu', 'Madurai', '5008, Villapuram housing board\r\nthendral Nagar 3rd street', 'vetri cinemas', 'customer', '', '', '', '', '2025-09-25 08:58:51', 'active'),
(2, 'meka', 'valaguru', 'mk6', 'mekavalaguru36@gmail.com', '9865541187', 'Mk@123456', 'Tamil Nadu', 'Madurai', '5008, Villapuram housing board\r\nthendral Nagar 3rd street', 'tpk nearby shop', 'merchant', 'Naaghi footwear', 'nike', '9789450123', '5008, Villapuram housing board', '2025-09-25 09:03:01', 'active'),
(14, 'navi', 'vaish', 'navi05', 'navi05@gmail.com', '6369698290', 'Navivaish@505', 'Tamil Nadu', '', '5008, Villapuram housing board\r\nthendral Nagar 3rd street', 'Thavuttusandhai', 'merchant', 'Lazy', 'vkc', '6369698290', '5008, Villapuram housing board', '2025-10-14 11:18:09', 'active'),
(23, 'jaya', 'kumar', 'jayakumar', 'jayakumar@gmail.com', '7894560123', 'Jkumar@!23', 'Tamil Nadu', '', 'Madurai\r\nMadurai', 'tpk nearby shop', 'merchant', 'jkfootwear', 'nike', '7894560123', 'villapuram', '2025-11-12 11:42:29', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `merchant_id` (`merchant_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sub_admins`
--
ALTER TABLE `sub_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=520;

--
-- AUTO_INCREMENT for table `sub_admins`
--
ALTER TABLE `sub_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`merchant_id`) REFERENCES `user_details` (`user_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
