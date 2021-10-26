-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2021 lúc 07:04 PM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `html_php_1_9_21`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cat_product`
--

CREATE TABLE `cat_product` (
  `id_cat` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cat_product`
--

INSERT INTO `cat_product` (`id_cat`, `name`, `created_at`, `updated_at`, `is_delete`, `id_user`) VALUES
(2, 'dienthoai', '2021-10-26 14:53:31', '2021-09-05 09:29:04', 0, 1),
(3, 'laptop', '2021-10-26 14:53:31', '2021-09-05 09:29:04', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id_customer`, `fullname`, `phone`, `email`, `address`, `note`, `id_account`) VALUES
(1, 'chi thanh', 868337741, 'ncthanh357@gmail.com', 'Đòng nai', 'giao vào thứ 2 ', 2),
(27, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'long thành', 'giao trong hôm nay', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_account`
--

CREATE TABLE `customer_account` (
  `id_account` int(11) UNSIGNED NOT NULL,
  `user_account` varchar(255) NOT NULL,
  `pass_account` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer_account`
--

INSERT INTO `customer_account` (`id_account`, `user_account`, `pass_account`, `created_at`, `updated_at`) VALUES
(1, 'thanh long', 'e10adc3949ba59abbe56e057f20f883e', '2021-10-26 10:21:32', '2021-10-26 10:21:32'),
(2, 'chithanh', 'e10adc3949ba59abbe56e057f20f883e', '2021-10-26 12:12:06', '2021-10-26 12:12:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `code_sp` varchar(255) NOT NULL,
  `name_sp` varchar(255) NOT NULL,
  `price_sp` int(11) NOT NULL,
  `qty_sp` int(11) NOT NULL,
  `total_sp` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_delete` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id_order`, `id_sp`, `code_sp`, `name_sp`, `price_sp`, `qty_sp`, `total_sp`, `id_customer`, `created_at`, `updated_at`, `is_delete`) VALUES
(1, 1, 'D#SS-SXT', 'sam sung stx', 12000000, 2, 24000000, 1, '2021-10-26 13:38:30', '2021-10-26 13:38:30', 0),
(19, 17, 'D#I12', 'iphone 12', 7000000, 2, 35000000, 27, '2021-10-26 14:08:37', '2021-10-26 14:08:37', 0),
(20, 16, 'D#I9', 'iphone 9', 7000000, 3, 35000000, 27, '2021-10-26 14:08:37', '2021-10-26 14:08:37', 0),
(21, 16, 'D#I9', 'iphone 9', 7000000, 3, 35000000, 27, '2021-10-26 14:08:37', '2021-10-26 14:08:37', 0),
(22, 16, 'D#I9', 'iphone 9', 7000000, 3, 35000000, 27, '2021-10-26 14:08:37', '2021-10-26 14:08:37', 0),
(23, 16, 'D#I9', 'iphone 9', 7000000, 3, 35000000, 27, '2021-10-26 14:08:37', '2021-10-26 14:08:37', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id_product`, `name`, `price`, `code`, `qty`, `thumbnail`, `created_at`, `updated_at`, `is_delete`, `id_cat`, `id_user`) VALUES
(1, 'sam sung', 12000000, 'D#SS', 1, 'asset/public/uploads/exciter150.PNG', '2021-10-25 09:21:19', '2021-10-25 09:21:19', 0, 2, 1),
(2, 'lap top dell 123 hay lắm', 20000000, 'L#D', 1, 'asset/public/uploads/exciter150.PNG', '2021-10-25 09:21:19', '2021-10-25 09:21:19', 0, 3, 2),
(16, 'iphone 9', 7000000, 'D#I9', 200, 'asset/public/uploads/exciter150.PNG', '2021-10-25 10:12:27', '2021-10-25 10:12:27', 0, 2, 1),
(17, 'iphone 12', 7000000, 'D#I12', 1000, 'asset/public/uploads/exciter150.PNG', '2021-10-25 10:24:13', '2021-10-25 10:24:13', 0, 2, 1),
(18, 'oppo', 7000000, 'D#op', 123, 'asset/public/uploads/exciter150.PNG', '2021-10-26 14:27:50', '2021-10-26 14:27:50', 0, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(233) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `email`, `pass_word`, `created_at`, `updated_at`) VALUES
(1, 'chithanh', 'ncthanh357@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-10-26 14:17:05', '2021-10-26 14:17:05');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cat_product`
--
ALTER TABLE `cat_product`
  ADD PRIMARY KEY (`id_cat`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Chỉ mục cho bảng `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`id_account`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cat_product`
--
ALTER TABLE `cat_product`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `id_account` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
