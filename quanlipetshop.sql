-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 09, 2025 lúc 08:30 AM
-- Phiên bản máy phục vụ: 8.3.0
-- Phiên bản PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlipetshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_cart_user` (`user_id`),
  KEY `FK_cart_product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `invoice_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_invoice_order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `invoices`
--

INSERT INTO `invoices` (`id`, `order_id`, `invoice_date`, `total_amount`) VALUES
(1, 8, '0000-00-00 00:00:00', 361000.00),
(2, 10, '0000-00-00 00:00:00', 1026000.00),
(3, 11, '0000-00-00 00:00:00', 985000.00),
(4, 12, '0000-00-00 00:00:00', 488000.00),
(5, 13, '2025-12-09 01:07:50', 537000.00),
(6, 14, '2025-12-09 11:12:50', 537000.00),
(7, 15, '2025-12-09 14:08:46', 176000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','canceled','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `FK_order_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `total_amount`, `status`) VALUES
(5, 1, '2025-12-08 17:42:42', 993000.00, 'completed'),
(8, 1, '2025-12-08 17:54:13', 361000.00, 'completed'),
(10, 1, '2025-12-08 17:57:51', 1026000.00, 'completed'),
(11, 1, '2025-12-08 17:58:01', 985000.00, 'completed'),
(12, 1, '2025-12-08 18:03:51', 488000.00, 'completed'),
(13, 1, '2025-12-08 18:07:50', 537000.00, 'completed'),
(14, 1, '2025-12-09 04:12:50', 537000.00, 'completed'),
(15, 1, '2025-12-09 07:08:46', 176000.00, 'completed');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orderdetail_orders` (`order_id`),
  KEY `FK_orderdetail_product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(1, 10, 'SP008', 1, 361000.00),
(2, 10, 'SP007', 1, 176000.00),
(3, 10, 'SP011', 1, 489000.00),
(4, 11, 'SP008', 1, 361000.00),
(5, 11, 'SP007', 1, 176000.00),
(6, 11, 'SP009', 1, 448000.00),
(7, 12, 'SP007', 1, 176000.00),
(8, 12, 'SP006', 1, 312000.00),
(9, 13, 'SP008', 1, 361000.00),
(10, 13, 'SP007', 1, 176000.00),
(11, 14, 'SP008', 1, 361000.00),
(12, 14, 'SP007', 1, 176000.00),
(13, 15, 'SP007', 1, 176000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `img_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `img_url`) VALUES
('ROYAL CANIN', 'ROYAL CANIN MAXI ADULT 1kg', 'Thức ăn cho chó trưởng thành', 300000.00, 1, 'https://down-vn.img.susercontent.com/file/vn-11134258-820l4-mhkjhwcmlfk2b4'),
('SP001', 'ALt banner 1', 'Hàng chính hãng Mozzi', 275000.00, 100, 'https://theme.hstatic.net/200000263355/1001161916/14/slide_1_img.jpg'),
('SP002', '/pages/gioi-thieu-ve-dich-vu-spa-di-cang-dong-tang-cang-nhieu', 'Hàng chính hãng Mozzi', 365000.00, 100, 'https://theme.hstatic.net/200000263355/1001161916/14/slide_2_img.jpg'),
('SP003', 'tri-ve-ran-viphapet', 'Hàng chính hãng Mozzi', 51000.00, 100, 'https://theme.hstatic.net/200000263355/1001161916/14/slide_3_img.jpg'),
('SP004', 'Get-golden-ticket-snowy', 'Hàng chính hãng Mozzi', 373000.00, 100, 'https://theme.hstatic.net/200000263355/1001161916/14/slide_4_img.jpg'),
('SP005', ' [500g - 1.5kg - 7.5kg ] Thức ăn hạt Royal canin Poodle Puppy Adult cho chó lông xoăn ', 'Hàng chính hãng Mozzi', 422000.00, 100, 'https://product.hstatic.net/200000263355/product/z4538150166256_36d4a9ca0093178774cd424a09339ccc_a7eff7193e68431894b6f4910c85f4ea_large.jpg'),
('SP006', ' [500g - 1.5kg - 7.5kg ] Thức ăn hạt Royal canin Poodle Puppy Adult cho chó lông xoăn ', 'Hàng chính hãng Mozzi', 312000.00, 100, 'https://product.hstatic.net/200000263355/product/z4476198004579_85b9eb2083735d612ccb14ab670ba1fe_dc9e404978e849a4a341d5329a06fd63_large.jpg'),
('SP007', ' Áo mini size Petstyle ', 'Hàng chính hãng Mozzi', 176000.00, 100, 'https://product.hstatic.net/200000263355/product/z4643630803606_0be19da6f507357a79e38255fb8a2b50_56e26cfa2fc840388d1d4330ea41200b_large.jpg'),
('SP008', ' Áo mini size Petstyle ', 'Hàng chính hãng Mozzi', 361000.00, 100, 'https://product.hstatic.net/200000263355/product/z4643630781324_ee6c4aaecde8eeb9d694e4a58a8c2157_2d19cfc44cdb44e8bf79647be81c0217_large.jpg'),
('SP009', ' KitCat Complete Cuisine Pate lon cho mèo ', 'Hàng chính hãng Mozzi', 448000.00, 100, 'https://product.hstatic.net/200000263355/product/z5812133810771_ed4697622a4bde747744fe1c45ea6426_f449b295f99d458c873f7de4f8115465_large.jpg'),
('SP010', ' KitCat Complete Cuisine Pate lon cho mèo ', 'Hàng chính hãng Mozzi', 331000.00, 100, 'https://product.hstatic.net/200000263355/product/z4422723096294_f924101fe9f2a3337bb1510d5463036f_2f163dbfe5fc41028dd31718c9ee3170_large.jpg'),
('SP011', ' KitCat Pate lon gravy cho mèo ', 'Hàng chính hãng Mozzi', 489000.00, 100, 'https://product.hstatic.net/200000263355/product/z4422721411928_986c20ecd0173dc610c170a1adb56e66_f43e826ec2c44038a8c2bce30d9d6950_large.jpg'),
('SP012', ' KitCat Pate lon gravy cho mèo ', 'Hàng chính hãng Mozzi', 327000.00, 100, 'https://product.hstatic.net/200000263355/product/z4422721407280_da218592cafe5883f0c038e017da4431_ecb032d14d3d41d48432d0ec0c4dcf17_large.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('saleperson','admin','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'saleperson',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`, `update_at`) VALUES
(1, 'admin', '123456', 'admin@shop.com', 'admin', '2025-12-07 03:21:18', '2025-12-07 03:21:18'),
(2, 'nhanvien1', '12345678', 'nguyenkien20082003@gmail.com', '', '2025-12-09 05:59:15', '2025-12-09 05:59:15'),
(3, 'nhanvien2', '456789', 'nhanvien2@gmail.com', '', '2025-12-09 05:59:32', '2025-12-09 05:59:32');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `FK_invoice_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_orderdetail_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_orderdetail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
