/*
 Navicat Premium Data Transfer

 Source Server         : db server
 Source Server Type    : MySQL
 Source Server Version : 80036 (8.0.36-0ubuntu0.22.04.1)
 Source Host           : localhost:3306
 Source Schema         : oiio

 Target Server Type    : MySQL
 Target Server Version : 80036 (8.0.36-0ubuntu0.22.04.1)
 File Encoding         : 65001

 Date: 02/05/2024 11:45:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_slug` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of provinces
-- ----------------------------
BEGIN;
INSERT INTO `provinces` (`id`, `name`, `name_slug`, `full_name`, `type`) VALUES
(11, 'Hà Nội', 'ha-noi', 'Thành phố Hà Nội', 'thanh-pho'),
(12, 'Hồ Chí Minh', 'ho-chi-minh', 'Thành phố Hồ Chí Minh', 'thanh-pho'),
(13, 'Đà Nẵng', 'da-nang', 'Thành phố Đà Nẵng', 'thanh-pho'),
(14, 'Hải Phòng', 'hai-phong', 'Thành phố Hải Phòng', 'thanh-pho'),
(15, 'Cần Thơ', 'can-tho', 'Thành phố Cần Thơ', 'thanh-pho'),
(16, 'Huế', 'hue', 'Thành phố Huế', 'thanh-pho'),
(17, 'An Giang', 'an-giang', 'Tỉnh An Giang', 'tinh'),
(18, 'Bắc Ninh', 'bac-ninh', 'Tỉnh Bắc Ninh', 'tinh'),
(19, 'Cà Mau', 'ca-mau', 'Tỉnh Cà Mau', 'tinh'),
(20, 'Cao Bằng', 'cao-bang', 'Tỉnh Cao Bằng', 'tinh'),
(21, 'Đắk Lắk', 'dak-lak', 'Tỉnh Đắk Lắk', 'tinh'),
(22, 'Điện Biên', 'dien-bien', 'Tỉnh Điện Biên', 'tinh'),
(23, 'Đồng Nai', 'dong-nai', 'Tỉnh Đồng Nai', 'tinh'),
(24, 'Đồng Tháp', 'dong-thap', 'Tỉnh Đồng Tháp', 'tinh'),
(25, 'Gia Lai', 'gia-lai', 'Tỉnh Gia Lai', 'tinh'),
(26, 'Hà Tĩnh', 'ha-tinh', 'Tỉnh Hà Tĩnh', 'tinh'),
(27, 'Hưng Yên', 'hung-yen', 'Tỉnh Hưng Yên', 'tinh'),
(28, 'Khánh Hòa', 'khanh-hoa', 'Tỉnh Khánh Hòa', 'tinh'),
(29, 'Lai Châu', 'lai-chau', 'Tỉnh Lai Châu', 'tinh'),
(30, 'Lâm Đồng', 'lam-dong', 'Tỉnh Lâm Đồng', 'tinh'),
(31, 'Lạng Sơn', 'lang-son', 'Tỉnh Lạng Sơn', 'tinh'),
(32, 'Lào Cai', 'lao-cai', 'Tỉnh Lào Cai', 'tinh'),
(33, 'Nghệ An', 'nghe-an', 'Tỉnh Nghệ An', 'tinh'),
(34, 'Ninh Bình', 'ninh-binh', 'Tỉnh Ninh Bình', 'tinh'),
(35, 'Phú Thọ', 'phu-tho', 'Tỉnh Phú Thọ', 'tinh'),
(36, 'Quảng Ngãi', 'quang-ngai', 'Tỉnh Quảng Ngãi', 'tinh'),
(37, 'Quảng Ninh', 'quang-ninh', 'Tỉnh Quảng Ninh', 'tinh'),
(38, 'Quảng Trị', 'quang-tri', 'Tỉnh Quảng Trị', 'tinh'),
(39, 'Sơn La', 'son-la', 'Tỉnh Sơn La', 'tinh'),
(40, 'Tây Ninh', 'tay-ninh', 'Tỉnh Tây Ninh', 'tinh'),
(41, 'Thái Nguyên', 'thai-nguyen', 'Tỉnh Thái Nguyên', 'tinh'),
(42, 'Thanh Hóa', 'thanh-hoa', 'Tỉnh Thanh Hóa', 'tinh'),
(43, 'Tuyên Quang', 'tuyen-quang', 'Tỉnh Tuyên Quang', 'tinh'),
(44, 'Vĩnh Long', 'vinh-long', 'Tỉnh Vĩnh Long', 'tinh');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
