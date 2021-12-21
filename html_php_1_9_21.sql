-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 21, 2021 lúc 04:37 AM
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
(2, 'smartphone', '2021-12-10 16:51:04', '2021-09-05 09:29:04', 0, 1),
(3, 'laptop ', '2021-12-10 16:18:02', '2021-09-05 09:29:04', 0, 1),
(22, 'pc', '2021-12-10 16:24:53', '2021-12-10 15:35:15', 0, 1),
(23, 'chuột', '2021-12-10 16:25:10', '2021-12-10 15:39:05', 0, 1),
(24, 'bàn phím', '2021-12-10 16:25:19', '2021-12-10 15:39:28', 0, 1),
(25, 'phụ kiện', '2021-12-10 16:25:39', '2021-12-10 16:18:44', 0, 1),
(26, 'nokia', '2021-12-10 16:24:23', '2021-12-10 16:24:23', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `parent_id_comment` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL,
  `id_kh_ac_send_text` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id_comment`, `parent_id_comment`, `text`, `id_kh_ac_send_text`, `id_product`, `date`) VALUES
(1, 0, 'còn sản phẩm không ', 1, 1, '2021-11-10 15:05:28'),
(27, 0, 'a', 1, 16, '2021-11-11 15:23:19'),
(29, 0, 'còn sản phẩm không shop ơi', 1, 1, '2021-11-12 09:03:47'),
(30, 0, 'sản phẩm tuyệt lắm', 1, 1, '2021-11-12 09:05:52'),
(31, 0, 'Tiki giao hàng rất nhanh, hàng chính hãng nhé. nguyên kiện nè.tem mát đầy đủ. mình mới test thử sp ok lắm ạ.cảm ứng nhạy. mua đc giá sale nên rẻ hơn của hàng tgdd rất nhìu', 1, 1, '2021-11-12 09:29:49'),
(32, 0, 'giá bao nhiu vậy ', 1, 17, '2021-11-12 10:22:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `commune`
--

CREATE TABLE `commune` (
  `id_commune` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_districts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `commune`
--

INSERT INTO `commune` (`id_commune`, `name`, `id_districts`) VALUES
(1, ' Xã An Thạnh', 1),
(2, 'Xã Long Hiệp', 1),
(3, 'Xã Long Định', 2),
(4, 'Xã Long Hòa', 2),
(5, 'Xã Tân Hà', 3),
(6, 'Xã Tân Đông', 3),
(7, 'Xã Hòa Hiệp', 4),
(8, 'Xã Thạnh Tây', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pay` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `id_provinces` int(11) NOT NULL,
  `id_districts` int(11) NOT NULL,
  `id_commune` int(11) NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id_customer`, `fullname`, `phone`, `email`, `pay`, `note`, `id_provinces`, `id_districts`, `id_commune`, `id_account`) VALUES
(46, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aaa', 1, 1, 2, 2),
(47, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aaa', 1, 1, 2, 2),
(48, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aaa', 1, 1, 2, 2),
(49, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'dddd', 1, 1, 1, 2),
(50, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'dddd', 1, 1, 1, 2),
(51, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'dddd', 1, 1, 1, 2),
(52, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'dddd', 1, 1, 1, 2),
(53, 'a', 868337741, 'nguyenchithanh2000.nina@gmail.com', 'thanh toán qua ATM', 'aaaaaa', 1, 1, 1, 2),
(54, 'a', 868337741, 'nguyenchithanh2000.nina@gmail.com', 'thanh toán qua ATM', 'aaaaaa', 1, 1, 1, 2),
(55, 'a', 868337741, 'nguyenchithanh2000.nina@gmail.com', 'thanh toán qua ATM', 'aaaaaa', 1, 1, 1, 2),
(56, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'b', 1, 1, 1, 2),
(57, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'b', 1, 1, 1, 2),
(58, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'b', 1, 1, 1, 2),
(59, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'b', 1, 1, 1, 2),
(60, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'b', 1, 1, 1, 2),
(61, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'b', 1, 1, 1, 2),
(62, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'b', 1, 1, 1, 2),
(63, 'a', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aaa', 1, 1, 1, 2),
(64, 'a', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aaa', 1, 1, 1, 2),
(65, 'a', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aaa', 1, 1, 1, 2),
(66, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aa', 2, 3, 5, 2),
(67, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'aa', 2, 3, 5, 2),
(68, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'giao nhanh', 1, 1, 1, 2),
(69, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'giao nhanh', 1, 2, 3, 2),
(70, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'giao nhanh', 1, 1, 1, 2),
(71, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'giao nhanh', 1, 1, 1, 2),
(72, 'nguyễn chí thành', 868337741, 'ncthanh357@gmail.com', 'thanh toán qua ATM', 'giao nhanh', 1, 1, 1, 2);

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
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `id_districts` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_provinces` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`id_districts`, `name`, `id_provinces`) VALUES
(1, 'Huyện Bến Lức', 1),
(2, 'Huyện Cần Đước', 1),
(3, 'Huyện Tân Châu', 2),
(4, 'Huyện Tân Biên', 2);

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
(45, 24, 'D#op', 'oppo 1', 7000000, 1, 7000000, 46, '2021-11-10 13:15:23', '2021-11-10 13:15:23', 0),
(79, 2, 'L#D', 'lap top dell 123 hay lắm', 20000000, 7, 220000000, 72, '2021-12-10 13:30:16', '2021-12-10 13:30:16', 0),
(80, 30, 'D#op', 'oppo 2', 7000000, 3, 220000000, 72, '2021-12-10 13:30:16', '2021-12-10 13:30:16', 0),
(81, 29, 'D#I12', 'iphone 16', 7000000, 5, 220000000, 72, '2021-12-10 13:30:16', '2021-12-10 13:30:16', 0),
(82, 1, 'D#SS', 'sam sung', 12000000, 2, 220000000, 72, '2021-12-10 13:30:16', '2021-12-10 13:30:16', 0);

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
(38, 'iphone', 6000000, 'D#op', 12, 'asset/public/uploads/Grande-Mat-Blue-004.png', '2021-12-10 15:18:45', '2021-12-10 15:18:45', 0, 2, 1),
(40, 'nokia 32g', 9000000, 'nk01', 10, 'asset/public/uploads/siriusfi.PNG', '2021-12-10 16:23:49', '2021-12-10 16:23:49', 0, 0, 1),
(41, 'bàn phím led', 300000, 'bp09', 10, 'asset/public/uploads/Latte-Limited-004.png', '2021-12-10 16:27:19', '2021-12-10 16:27:19', 0, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provinces`
--

CREATE TABLE `provinces` (
  `id_provinces` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `provinces`
--

INSERT INTO `provinces` (`id_provinces`, `name`) VALUES
(1, 'Long An'),
(2, 'Tây Ninh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`) VALUES
(1, 'file.png'),
(2, '390311190.jpg , 1119804039.jpg , '),
(3, '1972576181.jpg , '),
(4, '79189234.png , ');

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
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Chỉ mục cho bảng `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`id_commune`);

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
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id_districts`);

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
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id_provinces`);

--
-- Chỉ mục cho bảng `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `commune`
--
ALTER TABLE `commune`
  MODIFY `id_commune` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `id_account` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `districts`
--
ALTER TABLE `districts`
  MODIFY `id_districts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id_provinces` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
