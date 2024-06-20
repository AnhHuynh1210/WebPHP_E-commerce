-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 03:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web2_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `authenID` varchar(10) NOT NULL,
  `authenRole` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authentication`
--

INSERT INTO `authentication` (`authenID`, `authenRole`) VALUES
('0', 'Admin'),
('1', 'Sale'),
('2', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billID` varchar(10) NOT NULL,
  `billPurchaser` varchar(10) NOT NULL,
  `billDate` datetime NOT NULL,
  `billDelivery` varchar(200) NOT NULL,
  `billTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandID` varchar(10) NOT NULL,
  `brandName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandID`, `brandName`) VALUES
('001', 'Samsung'),
('002', 'iPhone'),
('003', 'Oppo'),
('004', 'Vivo'),
('005', 'Dell'),
('006', 'Asus'),
('007', 'MacBook'),
('008', 'Acer'),
('009', 'Razer'),
('010', 'Logitech'),
('011', 'Corsair'),
('012', 'Steelseries');

-- --------------------------------------------------------

--
-- Table structure for table `cetorgry`
--

CREATE TABLE `cetorgry` (
  `cetorgryID` varchar(10) NOT NULL,
  `cetorgryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cetorgry`
--

INSERT INTO `cetorgry` (`cetorgryID`, `cetorgryName`) VALUES
('001', 'Điện Thoại'),
('002', 'Laptop'),
('003', 'Tai Nghe');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `userID` varchar(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userID`, `firstName`, `lastName`, `email`) VALUES
('001', 'AD', 'Admin', 'admin@gmail.com'),
('002', 'abc', 'abc', 'abc@gmail.com'),
('003', 'Nguyễn Văn', 'AB', 'ab123@gmail.com'),
('004', 'Phan Văn', 'Qúy', 'pvquy@gmail.com'),
('005', 'Lê Thị', 'Thúy', 'ltthuy12@gmail.com'),
('006', 'Nguyễn Trung', 'Tuấn', 'nttuan2000@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` varchar(10) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `productDescription` varchar(600) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productAmount` int(11) NOT NULL,
  `productCetorgry` varchar(10) NOT NULL,
  `productBrand` varchar(10) NOT NULL,
  `IMG` varchar(100) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `productPrice`, `productAmount`, `productCetorgry`, `productBrand`, `IMG`, `state`) VALUES
('001', 'Samsung Galaxy A22', 'Màn hình: Super AMOLED, 6.4\", HD+.%%Hệ điều hành: Android 11.%%Camera sau: Chính 48 MP, Phụ 8 MP.%%Camera trước: 13 MP.%%Chip: MediaTek MT6769V.%%RAM: 8GB/128GB.%%SIM: 2 Nano SIM, Hỗ trợ 4G.%%Pin, Sạc: 5000 mAh, 15 W', 5490000, 50, '001', '001', '1000-A22.jpg', 1),
('002', 'Samsung Galaxy A52', 'Màn hình: Super AMOLED, 6.5\", Full HD+.%%Hệ điều hành: Android 11.%%Camera sau: Chính 64.%% MP & Phụ 12 MP.%%Camera trước: 32 MP.%%Chip: Snapdragon 750G 5G.%%RAM: 8GB/128GB.%%SIM: 2 Nano SIM, Hỗ trợ 5G.%%Pin, Sạc: 4500 mAh, 25 W', 8590000, 50, '001', '001', '1001-A52.jpg', 1),
('003', 'Samsung Galaxy Z Flip3', 'Màn hình: Dynamic AMOLED 2XChính 6.7\" & Phụ 1.9\"Full HD+\r\nHệ điều hành: Android 10%%Camera sau: Chính 13 MP & Phụ 5 MP%%Camera trước: 8MP%%Chip: Snapdragon 450%%RAM: 3GB/32GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 4000 mAh, 15 W', 23990000, 50, '001', '001', '1002.jpg', 1),
('004', 'Samsung Galaxy A11', 'Màn hình: PLS TFT LCD, 6.4\", HD+\r\nHệ điều hành: Android 11%%Camera sau: 2 camera 12 MP%%Camera trước: 10MP%%Chip: Snapdragon 888%%RAM: 8GB/128GB%%SIM: 1 Nano SIM & 1 eSIM, Hỗ trợ 5G%%Pin, Sạc: 3300 mAh, 15 W', 2790000, 50, '001', '001', '1003.jpg', 1),
('005', 'Samsung Galaxy Z Fold4', 'Màn hình: Dynamic AMOLED 2XChính 7.6\" & Phụ 6.2\"Quad HD+ (2K+)%%Hệ điều hành: Android 12\r\nCamera sau: Chính 50 MP & Phụ 12 MP, 10 MP%%Camera trước: 10 MP & 4 MP%%Chip: Snapdragon 8+ Gen 1%%RAM: 12 GB%%Dung lượng lưu trữ: 256 GB%%SIM: 1 Nano SIM & 1 eSIM Hỗ trợ 5G%%Pin, Sạc: 4400 mAh25 W', 35990000, 50, '001', '001', '1005-samsungZ.jpg', 1),
('006', 'Samsung Galaxy S21', 'Màn hình: Dynamic AMOLED 2X, 6.8\", Quad HD+ (2K+)%%Hệ điều hành: Android 1%%Camera sau: Chính 108 MP & Phụ 12 MP%%Camera trước: 40 MP%%Chip: Exynos 2100%%RAM: 12GB/128GB%%SIM: 2 Nano SIM hoặc 1%%Nano SIM + 1 eSIM, Hỗ trợ 5G%%Pin, Sạc: 5000 mAh, 25 W', 25990000, 50, '001', '001', '1006.jpg', 1),
('007', 'Iphone 12 256GB', 'Màn hình: OLED, 6.1\", Super Retina XDR\r\nHệ điều hành: iOS 14%%Camera sau: 2 camera 12 MP%%Camera trước: 12MP%%Chip: Apple A14 Bionic%%RAM: 4GB/256GB%%SIM: 1 Nano SIM & 1 eSIM, Hỗ trợ 5G%%Pin, Sạc: 2815 mAh, 20 W', 23290000, 50, '001', '002', 'iphone12-1.jpg', 1),
('008', 'Iphone 13 256GB', 'Màn hình: OLED, 6.1\", Super Retina XDR\r\nHệ điều hành: iOS 15%%Camera sau: 2 camera 12 MP%%Camera trước: 12MP%%Chip: Apple A15 Bionic%%RAM: 4GB/256GB%%SIM: 1 Nano SIM & 1 eSIM, Hỗ trợ 5G%%Pin, Sạc: 3240 mAh, 20 W', 26990000, 50, '001', '002', '1043.jpg', 1),
('009', 'Iphone 13 Pro Max', 'Màn hình: OLED, 6.7\", Super Retina XDR\r\nHệ điều hành: iOS 15%%Camera sau: 3 camera 12 MP%%Camera trước: 12 MP%%Chip: Apple A15 Bionic%%RAM: 6GB/256GB%%SIM: 1 Nano SIM & 1 eSIM, Hỗ trợ 5G%%Pin, Sạc: 4352 mAh, 20 W', 34990000, 50, '001', '002', 'iphone-13-blue.jpg', 1),
('010', 'Iphone XS MAX 64GB', 'Màn hình: OLED, 6.5\", Super Retina\r\nHệ điều hành: iOS 14%%Camera sau: 2 camera 12 MP%%Camera trước: 7 MP%%Chip: Apple A12 Bionic%%RAM: 4GB/256GB%%SIM: 1 Nano SIM & 1 eSIM, Hỗ trợ 5G%%Pin, Sạc: 3174 mAh', 8990000, 50, '001', '002', '1051-iphoneXS.jpg', 1),
('011', 'iPhone 14 pro Max', 'Màn hình: OLED6.1\"Super Retina XDR\r\nHệ điều hành: iOS 16\r\nCamera sau: Chính 48 MP & Phụ 12 MP, 12 MP%%Camera trước:n12 MP%%Chip: Apple A16 Bionic%%RAM: 6 GB%%Dung lượng lưu trữ: 128 GB%%SIM: 1 Nano SIM & 1 eSIM Hỗ trợ 5G%%Pin, Sạc:3200 mAh20 W', 28490000, 50, '001', '002', '1058.jpg', 1),
('012', 'iPhone 12 Pro Max', 'Màn hình: OLED, 6.7\", Super Retina XDR%%Hệ điều hành: iOS 14%%Camera sau: 3 camera 12 MP%%Camera trước: 12 MP%%Chip: Apple A14 Bionic%%RAM: 6GB/256GB%%SIM: 1 Nano SIM & 1 eSIM, Hỗ trợ 5G%%Pin, Sạc: 3687 mAh, 20 W', 25590000, 50, '001', '002', '1052.jpg', 1),
('013', 'iPhone 12 128GB', 'Màn hình: OLED6.1\"Super Retina XDR\r\nHệ điều hành: iOS 15\r\nCamera sau: 2 camera 12 MP%%Camera trước: 12 MP%%Chip: Apple A14 Bionic%%RAM: 4 GB%%Dung lượng lưu trữ: 128 GB%%SIM: 1 Nano SIM & 1 eSIMHỗ trợ 5G%%Pin, Sạc:2815 mAh20 W', 16990000, 50, '001', '002', '1059-iphone12.jpg', 1),
('014', 'Oppo A92', 'Màn hình: TFT LCD, 6.5\", Full HD+%%Hệ điều hành: Android 10%%Camera sau: Chính 48 MP & Phụ 8 MP%%Camera trước: 16MP%%Chip: Snapdragon 665%%RAM: 8GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 5000 mAh, 18 W', 6990000, 50, '001', '003', '1042-OppoA92.jpg', 1),
('015', 'Oppo Find X3 Pro', 'Màn hình: AMOLED, 6.7\", Quad HD+ (2K+)%%Hệ điều hành: Android 11%%Camera sau: Chính 50 MP & Phụ 50 MP%%Camera trước: 12 MP%%Chip: Snapdragon 888%%RAM: 12GB/256GB%%SIM: 2 Nano SIM, Hỗ trợ 5G%%Pin, Sạc: 4500 mAh, 65 W', 21490000, 50, '001', '003', '1047-OppoX3.jpg', 1),
('016', 'Oppo A5S', 'Màn hình: AMOLED, 6.43\", Full HD+%%Hệ điều hành: Android 10%%Camera sau: Chính 48 MP & Phụ 8 MP%%Camera trước: Chính 16 MP & Phụ 2 MP%%Chip: MediaTek Helio P95%%RAM: 8GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 4000 mAh, 18 W', 3490000, 50, '001', '003', '1044-oppoA5S.jpg', 1),
('017', 'Oppo Reno 4 Pro', 'Màn hình: AMOLED, 6.5\", Full HD+%%Hệ điều hành: Android 10%%Camera sau: Chính 48 MP & Phụ 8 MP%%Camera trước: 32 MP%%Chip: Snapdragon 720G%%RAM: 8GB/256GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 4000 mAh, 65W', 9490000, 50, '001', '003', '1049.jpg', 1),
('018', 'Oppo A9', 'Màn hình: TFT LCD, 6.5\", HD+%%Hệ điều hành: Android 9 (Pie)%%Camera sau: Chính 48 MP & Phụ 8 MP%%Camera trước: 16 MP%%Chip: Snapdragon 665%%RAM: 8GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 5000 mAh', 3490000, 50, '001', '003', '1050-oppoA9.jpg', 1),
('019', 'Oppo A15', 'Màn hình: TFT LCD, 6.5\", HD+%%Hệ điều hành: Android 9 (Pie)%%Camera sau: Chính 48 MP & Phụ 8 MP%%Camera trước: 16 MP%%Chip: Snapdragon 665%%RAM: 8GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 5000 mAh', 8790000, 50, '001', '003', '1057.jpg', 1),
('020', 'Oppo Reno8', 'Màn hình: AMOLED6.7\"Full HD+%%Hệ điều hành: Android 12%%Camera sau: Chính 50 MP & Phụ 8 MP, 2 MP%%Camera trước: 32 MP%%Chip: MediaTek Dimensity 8100 Max 8 nhân%%RAM: 12 GB%%Dung lượng lưu trữ: 256 GB%%SIM: 2 Nano SIMHỗ trợ 5G%%Pin, Sạc: 4500 mAh80 W', 17290000, 50, '001', '003', '1046-OppoReno8.jpg', 1),
('021', 'Vivo V20', 'Màn hình: AMOLED, 6.44\", Full HD+%%Hệ điều hành: Android 11%%Camera sau: Chính 64 MP & Phụ 8 MP%%Camera trước: 44MP%%Chip: Snapdragon 730%%RAM: 8GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 4000 mAh, 33 W', 7790000, 50, '001', '004', '1027-VivoV20.jpg', 1),
('022', 'Vivo Y30i', 'Màn hình: IPS LCD, 6.47\", HD+%%Hệ điều hành: Android 10%%Camera sau: Chính 13 MP & Phụ 8 MP%%Camera trước: 8MP%%Chip: MediaTek Helio P35%%RAM: 4GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 5000 mAh, 10 W', 3890000, 50, '001', '004', '1028.jpg', 1),
('023', 'Vivo V21 5G', 'Màn hình: AMOLED, 6.44\", Full HD+%%Hệ điều hành: Android 11%%Camera sau: Chính 64 MP & Phụ 8 MP%%Camera trước: 44 MP%%Chip: MediaTek Dimensity 800U 5G%%RAM: 8GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 5G%%Pin, Sạc: 4000 mAh, 33 W', 9490000, 50, '001', '004', '1029.jpg', 1),
('024', 'Vivo Y51', 'Màn hình: IPS LCD, 6.58\", Full HD+%%Hệ điều hành: Android 11%%Camera sau: Chính 48 MP & Phụ 8 MP%%Camera trước: 16 MP%%Chip: Snapdragon 662%%RAM: 8GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 5000 mAh, 18 W', 5990000, 50, '001', '004', '1030.jpg', 1),
('025', 'Vivo S1', 'Màn hình: Super AMOLED, 6.38\", Full HD+%%Hệ điều hành: Android 9 (Pie)%%Camera sau: Chính 16 MP & 12 MP%%Camera trước: 32 MP%%Chip: MediaTek MT6768 (Helio P65)%%RAM: 6GB/128GB%%SIM: 2 Nano SIM, Hỗ trợ 4G%%Pin, Sạc: 4500 mAh', 3490000, 50, '001', '004', '1031.jpg', 1),
('026', 'Dell Vostro 5620 i7', 'CPU: i71260P2.1GHz\r\n%%RAM: 16 GBDDR4 2 khe (1 khe 8 GB + 1 khe 8 GB)3200 MHz\r\n%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 2 TB (2280) / 1 TB (2230))\r\n%%Màn hình: 16\"Full HD+ (1920 x 1200)\r\n%%Card màn hình: Card tích hợpIntel Iris Xe\r\n%%Cổng kết nối: HDMILAN (RJ45)Jack tai nghe 3.5 mm2 x USB 3.2USB Type-C (Power Delivery and DisplayPort)\r\n%%Đặc biệt: Có đèn bàn phím\r\n%%Hệ điều hành: Windows 11 Home SL + Office Home & Student vĩnh viễn\r\n%%Thiết kế: Nắp lưng và chiếu nghỉ tay bằng kim loại\r\n%%Kích thước, khối lượng: Dài 356.78 mm - Rộng 251.9 mm - Dày 17.95 mm - Nặng 1.9', 27990000, 50, '002', '005', '1068.jpg', 1),
('027', 'Dell Inspiron 16 5620 i7', 'CPU: i71255U1.7GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)3200 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe%%Màn hình: 16\"Full HD+ (1920 x 1200)%%Card màn hình: Card tích hợpIntel UHD%%Cổng kết nối: HDMIJack tai nghe 3.5 mmUSB Type-C (Power Delivery and DisplayPort)2 x USB 3.2%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL + Office Home & Student vĩnh viễn%%Thiết kế: Vỏ kim loại%%Kích thước, khối lượng: Dài 356.7 mm - Rộng 251.9 mm - Dày 17.95 mm - Nặng 1.87 kg%%Thời điểm ra mắt: 2022', 24490000, 50, '002', '005', '1070-dell.jpg', 1),
('028', 'Laptop Dell Inspirion N5515', 'Loại card đồ họa: AMD Redeon Graphics%%Dung lượng RAM: 8GB%%Loại RAM: DDR4 3200Mhz%%Số khe ram: 2 khe (1 khe 8GB + 1 khe rời)%%Ổ cứng: 512GB SSD M2 PCIe NVMe%%Công nghệ màn hình: Màn hình chống loá%%Kích thước màn hình: 15.6 inches%%Pin: 4 cell - 54Whr%%Hệ điều hành: Windows 11 Home SL\r\n%%Độ phân giải màn hình: 1920 x 1080 pixels (FullHD)%%Trọng lượng: 1.64 kg%%Cổng giao tiếp: 2 USB 3.2 Gen 1 Type-A ports\r\n1 USB 3.2 Gen 1 Type-C™ port with DisplayPort™ and Power Delivery, 1 HDMI 1.4b port, 1 Universal Audio Jack', 19990000, 50, '002', '005', '1069-dell.jpg', 1),
('029', 'Dell Gaming G15 5515 R7', 'CPU: Ryzen 75800H3.2GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)3200 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 2 TB (2280) / 1 TB (2230))%%Màn hình: 15.6\"Full HD (1920 x 1080) 120Hz%%Card màn hình: Card rờiRTX 3050 4GB%%Cổng kết nối: 2 x USB 2.0HDMILAN (RJ45)Jack tai nghe 3.5 mmUSB Type-C (Power Delivery and DisplayPort)1 x USB 3.2%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL + Office Home & Student vĩnh viễn%%Thiết kế: Vỏ nhựa%%Kích thước, khối lượng: Dài 357 mm - Rộng 272 mm - Dày 25 mm - Nặng 2.81 kg%%Thời điểm ra mắt: 2021', 29990000, 50, '002', '005', '1067.jpg', 1),
('030', 'Dell Gaming G15 5511 i5', 'CPU: i511400H2.7GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)3200 MHz%%Ổ cứng: 256 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 2 TB (2280) / 512 GB (2230))%%Màn hình: 15.6\"Full HD (1920 x 1080) 120Hz%%Card màn hình: Card rờiRTX 3050 4GB%%Cổng kết nối: USB Type-CHDMILAN (RJ45)3 x USB 3.2Jack tai nghe 3.5 mm%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL + Office Home & Student vĩnh viễn%%Thiết kế: Vỏ nhựa%%Kích thước, khối lượng: Dài 357 mm - Rộng 272 mm - Dày 25 mm - Nặng 2.81 kg%%Thời điểm ra mắt: 2021', 27490000, 50, '002', '005', '1071.jpg', 1),
('031', 'Asus VivoBook 15X OLED A1503ZA i5', 'CPU: i512500H2.5GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác không giới hạn dung lượng)%%Màn hình: 15.6\"Full HD (1920 x 1080) OLED%%Card màn hình: Card tích hợpIntel UHD%%Cổng kết nối: HDMIUSB Type-CJack tai nghe 3.5 mm2 x USB 3.21 x USB 2.0%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ nhựa%%Kích thước, khối lượng: Dài 356.8 mm - Rộng 227.6 mm - Dày 19.9 mm - Nặng 1.7 kg%%Thời điểm ra mắt: 2022', 21490000, 50, '002', '006', '1060.jpg', 1),
('032', 'Asus TUF Gaming F15 FX506LHB i5', 'CPU: i510300H2.5GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)2933 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)%%Màn hình: 15.6\"Full HD (1920 x 1080) 144Hz%%Card màn hình: Card rờiGTX 1650 4GB%%Cổng%%kết nối: HDMILAN (RJ45)USB 2.0Jack tai nghe 3.5 mm2 x USB 3.21x USB 3.2 Gen 2 Type-C support DisplayPort / power delivery / G-SYNC%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ nhựa%%Kích thước, khối lượng: Dài 359 mm - Rộng 256 mm - Dày 24.9 mm - Nặng 2.3 kg%%Thời điểm ra mắt: 2021', 20990000, 50, '002', '006', '1061.jpg', 1),
('033', 'Asus ZenBook UX325EA i5', 'CPU: i51135G72.4GHz\r\n%%RAM: 8 GBLPDDR4X (Onboard)4267 MHz\r\n%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)\r\n%%Màn hình: 13.3\"Full HD (1920 x 1080) OLED\r\n%%Card màn hình: Card tích hợpIntel Iris Xe\r\n%%Cổng kết nối: HDMI2 x Thunderbolt 4 USB-C1 x USB 3.2\r\n%%Đặc biệt: Có đèn bàn phím\r\n%%Hệ điều hành: Windows 11 Home SL\r\n%%Thiết kế: Vỏ kim loại nguyên khối\r\n%%Kích thước, khối lượng: Dài 304.2 mm - Rộng 203 mm - Dày 13.9 mm - Nặng 1.14 kg\r\n%%Thời điểm ra mắt: 2021', 22490000, 50, '002', '006', '1062.jpg', 1),
('034', 'Asus Gaming TUF Dash F15 FX517ZC i5', 'CPU: i512450H2GHz%%RAM: 8 GBDDR5 2 khe (1 khe 8 GB + 1 khe trống)4800 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng (nâng cấp tối đa 1 TB)%%Màn hình: 15.6\"Full HD (1920 x 1080) 144Hz%%Card màn hình: Card rờiRTX 3050 4GB%%Cổng kết nối: Thunderbolt 4HDMILAN (RJ45)Jack tai nghe 3.5 mm2 x USB 3.21x USB 3.2 Gen 2 Type-C support DisplayPort / power delivery / G-SYNC%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ nhựa\r\nKích thước, khối lượng: Dài 354 mm - Rộng 251 mm - Dày 20.7 mm - Nặng 2 kg%%Thời ', 28990000, 50, '002', '006', '1063-asus.jpg', 1),
('035', 'Asus Gaming ROG Strix G15 G513RC R7', 'CPU: Ryzen 76800H3.2GHz%%RAM: 8 GBDDR5 2 khe (1 khe 8 GB + 1 khe trống)4800 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)%%Màn hình: 15.6\"Full HD (1920 x 1080) 144Hz%%Card màn hình: Card rờiRTX 3050 4GB%%Cổng%%kết nối: HDMILAN (RJ45)2 x USB Type-CJack tai nghe 3.5 mm2 x USB 3.2%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ nhựa - nắp lưng bằng kim loại%%Kích thước, khối lượng: Dài 354 mm - Rộng 259 mm - Dày 25.9 mm - Nặng 2.1 kg%%Thời điểm ra mắt: 2022', 29990000, 50, '002', '006', '1064.jpg', 1),
('036', 'Asus Zenbook 14X OLED Space Edition UX5401ZAS i7', 'CPU: i712700H2.30 GHz%%RAM: 16 GBLPDDR5 (Onboard)4800 MHz%%Ổ cứng: 1 TB SSD M.2 PCIe%%Màn hình: 14\"2.8K (2880 x 1800) - OLED 16:1090Hz%%Card màn hình: Card tích hợpIntel Iris Xe%%Cổng kết nối: HDMIJack tai nghe 3.5 mm2 x Thunderbolt 41 x USB 3.2%%Đặc biệt: Có màn hình cảm ứngCó đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ kim loại%%Kích thước, khối lượng: Dài 311.2 mm - Rộng 221.1 mm - Dày 15.9 mm - Nặng 1.4 kg%%Thời điểm ra mắt: 2022', 39990000, 50, '002', '006', '1065.jpg', 1),
('037', 'Asus Vivobook S 14 Flip TP3402ZA i5', 'CPU: i512500H2.5GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB onboard + 1 khe trống)3200 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe%%Màn hình: 14\"WUXGA (1920 x 1200)%%Card màn hình: Card tích hợpIntel UHD%%Cổng kết nối: 1 x Thunderbolt 4 (hỗ trợ display/power delivery)HDMIJack tai nghe 3.5 mm1 x USB 3.21 x USB 2.0%%Đặc biệt: Có màn hình cảm ứng, Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ nhựa - nắp lưng bằng kim loại%%Kích thước, khối lượng: Dài 313.2 mm - Rộng 227.6 mm - Dày 18.9 mm - Nặng 1.5 kg%%Thời điểm ra mắt: 2022', 21490000, 50, '002', '006', '1066.jpg', 1),
('038', 'MacBook Air M2 2022 8GB/256GB/8-core GPU', 'CPU: Apple M2100GB/s%%RAM: 16 GB%%Ổ cứng: 512 GB SSD%%Màn hình: 13.6\"Liquid Retina (2560 x 1664)%%Card màn hình: Card tích hợp10 nhân GPU%%Cổng kết nối: Jack tai nghe 3.5 mmMagSafe 32 x Thunderbolt 3%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Mac OS%%Thiết kế: Vỏ kim loại%%Kích thước, khối lượng: Dài 304.1 mm - Rộng 215 mm - Dày 11.3 mm - Nặng 1.24 kg%%Thời điểm ra mắt: 6/2022', 32990000, 50, '002', '007', '1072-macbook.jpg', 1),
('039', 'MacBook Pro 14 M1 Pro 2021 8-core', 'CPU: Apple M1 Pro200GB/s%%RAM: 16 GB%%Ổ cứng: 512 GB SSD%%Màn hình: 14.2\"Liquid Retina XDR display (3024 x 1964)120Hz%%Card màn hình: Card tích hợp14 nhân GPU%%Cổng kết nối: HDMI3 x Thunderbolt 4 USB-CJack tai nghe 3.5 mm%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Mac OS%%Thiết kế: Vỏ kim loại nguyên khối%%Kích thước, khối lượng: Dài 312.6 mm - Rộng 221.2 mm - Dày 15.5 mm - Nặng 1.6 kg%%Thời điểm ra mắt: 10/2021', 42990000, 50, '002', '007', '1073.jpg', 1),
('040', 'Asus ROG Centurion True 7', 'Model: ROG Centurion True 7.1%%Chất liệu bộ truyền âm: Neodymium Magnet%%Đường kính màng dẫn âm thanh Trước : 40 mm, Loa siêu trầm : 40 mm, Trung tâm : 30 mm, Bên : 20 mm, Sau : 20 mm%%Microphone: Đơn hướng - 50 ~ 12000 Hz%%Cáp tai nghe: Cáp bện sợi (1,5M cáp tai nghe + 1,5M cáp USB = Tối đa 3M)%%Trọng lượng tai nghe:	450 g%%Bộ sản phẩm kèm theo: Microphone tháo rời được, Giá đặt tai nghe, Cáp USB, Hướng dẫn nhanh, Trạm âm thanh USB, Cáp tách loa HDMI-sang-3,5mm\r\n%%Giá đặt tai nghe: Quà tặng miễn phí, không bảo hành', 6680000, 50, '003', '006', '040.jpg', 1),
('041', 'Asus ROG Strix Fusion 300', 'Kết nối: USB/ 3.5mm ( đầu cắm kết hợp âm thanh/mic )%%Tương thích: PC/ MAC/ MOBILE/ PS4/ XBOX ONE%%Tần số phản hồi: Headphones : 20 Hz – 20 kHz, Microphone : 50 Hz – 10 kHz%%Trở kháng: 32 Ohms%%Dạng tín hiệu micro: 1 hướng%%Độ nhạy: -39 dB ± 3 dB%%Dây cáp: USB : 2m, 3.5mm : 1.5m%%Trọng lượng: 360 g', 2990000, 50, '003', '006', '041.jpg', 1),
('042', 'Corsair HS50 Stereo Gaming Carbon', 'Thương hiệu: Corsair%%Bảo hành: 24 tháng%%Model: Corsair HS50 Pro Stereo Carbon%%Màu sắc: Carbon%%Kiểu tai nghe: Over-ear%%Kiểu kết nối: Có dây ( jack 3.5mm )%%Microphone: Có (khử tiếng ồn một chiều)%%Dây: Dài 1,8m%%Tần số : Tai nghe: 20Hz - 20000Hz%%Micro: 100Hz - 10000Hz%%Trở kháng: Tai nghe: 32000 Ohms%%Micro: 2000 Ohms%%Độ nhạy: Tai nghe: 111dB (+/-3dB)%%Micro: -40dB (+/-3dB)%%Drivers: 50mm%%Tương thích: PC, PS4, XBOX One, Nintendo Switch, Mobile%%Khả năng cách âm: Có%%Chất liệu: Khung kim loại, đệm tai da PU', 1590000, 50, '003', '011', '042.png', 1),
('043', 'Corsair VOID Pro Wireless RGB', 'Hãng sản xuất: Corsair%%Model: CA-9011152-AP%%Kết nối: USB%%Tần số: 20Hz - 20 kHz%%Trở kháng: 32k Ohms @ 1 kHz%%Độ nhạy: m107dB (+/- 3dB)%%Trình điều khiển: 107dB (+/- 3dB)%%Chiều dài cáp: 1.8m%%Microphone: Có%%Màu sắc: Carbon', 3150000, 50, '003', '011', '043.png', 1),
('044', 'Logitech G933', 'Hãng sản xuất: Logitech%%Mã sản phẩm: G933 Artemis Spectrum%%Chuẩn cắm hỗ trợ: USB / Wireless%%Microphone: Có%%Trở kháng: N/a%%Tần số: 20 Hz - 20 KHz%%Kích cỡ màng loa: 40mm%%Trọng lượng: 366g%%Tính năng đặc biệt: Kết nối không dây giảm tối đa độ trễ. Hệ thống LED RGB LIGHTSYNC 16,8 triệu màu. Giả lập âm thanh vòm 7.1. Thời lượng pin 12h không bật LED. Thời lượng pin 8h có bật LED.', 4000000, 50, '003', '010', '044.png', 1),
('045', 'Logitech G433', 'Mã: G433%%Thương hiệu: Logitech%%Màng loa: 1,6 in (40 mm)%%Độ nhạy tần số: 20Hz-20KHz%%Trở kháng: 32 Ohm%%Độ nhạy: 107dB@1KHz SPL 30mW/1cm%%Độ dài dây: 2m', 2500000, 50, '003', '010', '045.jpg', 1),
('046', 'Razer Kraken Tournament Green', 'Hãng sản xuất: Razer%%Tên sản phẩm: Razer Kraken Tournament Edition Wired Gaming%%Chuẩn cắm hỗ trợ: Jack 3.5mm analog%%Microphone: Có%%Trở kháng: 32 Ohm%%Tần số: 12 Hz – 28 kHz%%Kích cỡ màng loa: Custom-Tunned 50mm với công nghệ Nam châm Neodymium%%Trọng lượng: N/a%%Tính năng đặc biệt: Công nghệ âm thanh THX Spatial Audio.\r\nTương thích nhiều nền tảng.\r\nUSB Dongle : Điều chỉnh âm lượng , âm bass, bật/tắt âm thanh THX Spatial, chuyển kênh game/chat', 2690000, 50, '003', '009', '046.png', 1),
('047', 'Razer Kraken Pro V2 Quartz Pink Edition', 'Phiên bản: Quartz Pink Edition%%Dải tần số: 12 – 28.000 Hz%%Trở kháng: 32 Ohm%%Độ nhạy: 118 dB%%Drivers: 50 mm%%Đường kính vành tai: 56 mm%%Jack cắm: 3,5 mm%%Chiều dài dây: 1,3 m ( thêm 2m nếu sử dụng jack chia cắm PC )%%Trọng lượng: 322 gram', 1990000, 50, '003', '009', '047.jpg', 1),
('048', 'SteelSeries Arctis 5 PUBG Edition', 'Hãng sản xuất: Tai nghe SteelSeries%%Chủng loại: Tai nghe SteelSeries Arctis 5 PUBG%%Chuẩn tai nghe: Fullsize%%Chuẩn giao tiếp: 3.5mm, USB%%Dải tần đáp ứng: 20Hz – 22.000Hz%%Màu: Đen (Black)%%Đèn tai nghe: RGB 16.8 triệu màu%%Các chứng năng đặc biệt: Tai nghe chơi game và nghe nhạc thế hệ mới của SteelSeries, tai nghe sử dụng củ loa 40mm cao cấp, thiết kế mới tạo sự thoải mái tối đa cho người dùng. Tai nghe hỗ trợ âm thanh vòm 7.1  phầm mềm SteelSeries Engine 3, đèn led RGB 16.8 triệu màu đẹp mắt. Phiên bản đặc biệt cho game PUBG', 3290000, 50, '003', '012', '048.jpg', 1),
('049', 'SteelSeries Arctis 3 Black Edition 2019 Edition', 'Thương hiệu: SteelSeries%%Bảo hành: 12 tháng%%Series/Model: Arctis 3 Black Edition%%Màu sắc: Đen%%Kiểu tai nghe: Over-e%%Kiểu kết nối: Có dây%%LED: Không%%Chuẩn kết nối: 3.5 mm%%Microphone: Có thể điều chỉnh hướng%%Trở kháng: 1 kHz 32 Ohm%%Tần số: 20Hz - 20KHz%%Khả năng cách âm: Có%%Chất liệu khung: Nhựa%%Chất liệu đệm tai nghe: Vải thoáng%%Phụ kiện đi kèm: Hướng dẫn sử dụng, Dây chia 1-to-2 3.5 mm%%Tương thích: Các thiết bị có jack audio 3.5 mm%%Chức năng đặc biệt: Chia sẻ âm thanh trực tiếp giữa nhiều tai nghe', 1790000, 50, '003', '012', '049.jpg', 1),
('050', 'MacBook Air M2 2022 16GB/512GB/10-core GPU', 'CPU: Apple M2100GB/s%%RAM: 16 GB%%Ổ cứng: 512 GB SSD%%Màn hình: 13.6\"Liquid Retina (2560 x 1664)%%Card màn hình: Card tích hợp10 nhân GPU%%Cổng kết nối: Jack tai nghe 3.5 mmMagSafe 32 x Thunderbolt 3%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Mac OS%%Thiết kế: Vỏ kim loại%%Kích thước, khối lượng: Dài 304.1 mm - Rộng 215 mm - Dày 11.3 mm - Nặng 1.24 kg%%Thời điểm ra mắt: 6/2022', 46990000, 50, '002', '007', '1074.jpg', 1),
('051', 'MacBook Pro M1 2020 16GB/512GB', 'CPU: Apple M1%%RAM: 16 GB%%Ổ cứng: 512 GB SSD%%Màn hình: 13.3\"Retina (2560 x 1600)%%Card màn hình: Card tích hợp8 nhân GPU%%Cổng kết nối: 2 x Thunderbolt 3 (USB-C)Jack tai nghe 3.5 mm%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Mac OS%%Thiết kế: Vỏ kim loại nguyên khối%%Kích thước, khối lượng: Dài 304.1 mm - Rộng 212.4 mm - Dày 15.6 mm - Nặng 1.4 kg%%Thời điểm ra mắt: 2020', 35990000, 50, '002', '007', '1075-macbook.jpg', 1),
('052', 'Acer Nitro 5 Gaming AN515 57 553E i5', 'CPU: i511400H2.7GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)3200 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng (nâng cấp tối đa 1 TB)Hỗ trợ khe cắm HDD SATA 2.5 inch mở rộng (nâng cấp tối đa 2 TB)%%Màn hình: 15.6\"Full HD (1920 x 1080) 144Hz%%Card màn hình: Card rờiRTX 3050 4GB%%Cổng kết nối: USB Type-CHDMILAN (RJ45)3 x USB 3.2Jack tai nghe 3.5 mm%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ nhựa%%Kích thước, khối lượng: Dài 363.4 mm - Rộng 255 mm - Dày 23.9 mm - Nặng 2.2 kg%%Thời điểm ', 21890000, 50, '002', '008', '1076.jpg', 1),
('053', 'Acer Aspire 7 Gaming A715 42G R05G R5', 'CPU: Ryzen 55500U2.1GHz\r\n%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)3200 MHz\r\n%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)Không hỗ trợ khe cắm HDDKhông hỗ trợ khe cắm SSD M2 mở rộng thêm\r\n%%Màn hình: 15.6\"Full HD (1920 x 1080) 144Hz\r\n%%Card màn hình: Card rờiGTX 1650 4GB\r\n%%Cổng kết nối: USB Type-CHDMILAN (RJ45)USB 2.0Jack tai nghe 3.5 mm2 x USB 3.2\r\n%%Đặc biệt: Có đèn bàn phím\r\n%%Hệ điều hành: Windows 11 Home SL\r\n%%Thiết kế: Vỏ nhựa\r\n%%Kích thước, khối lượng: Dài 363.4 mm - Rộng 254.5 mm - Dày 22.9 mm - Nặng 2.1 kg\r\n%%Thời điểm ra mắt: 2021', 20490000, 50, '002', '008', '1077.jpg', 1),
('054', 'Acer Swift 3 SF314 512 56QN i5', 'CPU: i51240P1.7GHz%%RAM: 16 GBLPDDR4X (Onboard)4267 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)%%Màn hình: 14\"QHD (2160 x 1440)%%Card màn hình: Card tích hợpIntel Iris Xe%%Cổng kết nối: HDMI2 x Thunderbolt 4Jack tai nghe 3.5 mm2 x USB 3.2%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ kim loại%%Kích thước, khối lượng: Dài 321 mm - Rộng 210.8 mm - Dày 15.9 mm - Nặng 1.2 kg%%Thời điểm ra mắt: 2022', 21590000, 50, '002', '008', '1078.jpg', 1),
('055', 'Acer Nitro 5 Gaming AN515 57 720A i7', 'CPU: i711800H2.30 GHz%%RAM: 8 GBDDR4 2 khe (1 khe 8 GB + 1 khe rời)3200 MHz%%Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng (nâng cấp tối đa 1 TB)Hỗ trợ khe cắm HDD SATA (nâng cấp tối đa 2 TB)%%Màn hình: 15.6\"Full HD (1920 x 1080) 144Hz%%Card màn hình: Card rờiRTX 3050Ti 4GB%%Cổng kết nối: USB Type-CHDMILAN (RJ45)3 x USB 3.2Jack tai nghe 3.5 mm%%Đặc biệt: Có đèn bàn phím%%Hệ điều hành: Windows 11 Home SL%%Thiết kế: Vỏ nhựa%%Kích thước, khối lượng: Dài 363.4 mm - Rộng 255 mm - Dày 23.9 mm - Nặng 2.2 kg%%Thời điểm ra mắt: 2021', 26090000, 50, '002', '008', '1079.jpg', 1),
('abc', 'abc', '', 1, 3, '001', '001', 'abc.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receiptID` int(11) NOT NULL,
  `userName` varchar(10) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(10) NOT NULL,
  `country` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `receiptTotal` int(11) NOT NULL,
  `receiptDate` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receiptID`, `userName`, `firstName`, `lastName`, `country`, `address`, `phone`, `email`, `description`, `receiptTotal`, `receiptDate`, `status`) VALUES
(1, 'abc123', 'abc', 'abc', 'TP.Hồ Chí Minh', 'An Duong Vuong', '1234567222', 'abc1@gmail.com', '', 99470000, '2023-03-18 13:01:48', 1),
(2, 'abc123', 'abc', 'abc', 'TP.Hồ Chí Minh', 'An Duong Vuong', '1234567222', 'abc@gmail.com', '', 37980000, '2023-03-18 13:26:17', 1),
(3, 'nguyenvanA', 'Nguyễn Văn', 'AB', 'TP.Hồ Chí Minh', 'Lý Thường kiệt', '0926637678', 'ab123@gmail.com', '', 63770000, '2023-03-18 13:31:26', 1),
(4, 'thuyle', 'Lê Thị', 'Thúy', 'TP.Hồ Chí Minh', 'Lý Tự Trọng', '0387637184', 'ltthuy12@gmail.com', '', 11890000, '2023-03-20 13:41:12', 1),
(5, 'tuannguyen', 'Nguyễn Tru', 'Tuấn', 'TP.Hồ Chí Minh', 'Võ Thị Sáu', '0378647362', 'nttuan2000@gmail.com', '', 45370000, '2023-03-20 13:47:57', 0),
(6, 'thuyle', 'Lê Thị', 'Thúy', 'TP.Hồ Chí Minh', 'Lý Tự Trọng', '0387637184', 'ltthuy12@gmail.com', '', 48480000, '2023-03-20 13:54:00', 1);

--
-- Triggers `receipt`
--
DELIMITER $$
CREATE TRIGGER `DeleteReceipt` BEFORE DELETE ON `receipt` FOR EACH ROW DELETE FROM receiptdetail WHERE receiptdetail.receiptID = OLD.receiptID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receiptdetail`
--

CREATE TABLE `receiptdetail` (
  `receiptID` int(11) NOT NULL,
  `productID` varchar(10) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `quality` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receiptdetail`
--

INSERT INTO `receiptdetail` (`receiptID`, `productID`, `productName`, `quality`, `price`, `total`) VALUES
(1, '003', 'Samsung Galaxy Z Flip3', 1, 23990000, 23990000),
(1, '011', 'iPhone 14 pro Max', 1, 28490000, 28490000),
(1, '044', 'Logitech G933', 10, 3890000, 3890000),
(1, '050', 'MacBook Air M2 2022 16GB/512GB/10-core GPU', 1, 46990000, 46990000),
(2, '047', 'Razer Kraken Pro V2 Quartz Pink Edition', 1, 1990000, 1990000),
(2, '051', 'MacBook Pro M1 2020 16GB/512GB', 1, 35990000, 35990000),
(3, '005', 'Samsung Galaxy Z Fold4', 1, 35990000, 35990000),
(3, '006', 'Samsung Galaxy S21', 1, 25990000, 25990000),
(3, '049', 'SteelSeries Arctis 3 Black Edition 2019 Edition', 1, 1790000, 1790000),
(4, '044', 'Logitech G933', 2, 4000000, 8000000),
(5, '002', 'Samsung Galaxy A52', 1, 8590000, 8590000),
(5, '019', 'Oppo A15', 1, 8790000, 8790000),
(5, '026', 'Dell Vostro 5620 i7', 1, 27990000, 27990000),
(6, '008', 'Iphone 13 256GB', 1, 26990000, 26990000),
(6, '031', 'Asus VivoBook 15X OLED A1503ZA i5', 1, 21490000, 21490000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` varchar(10) NOT NULL,
  `userName` varchar(10) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userAuthentication` varchar(10) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userPass`, `userAuthentication`, `state`) VALUES
('002', 'abc123', '$2y$10$zguR4pfwl7iKtlmkV2WAme.QJwEMfYUP6RmrqZGxPKzwLrmJLltca', '2', 1),
('001', 'admin', '$2y$10$zshkTgKqWEiq9v37MgWlU.H1d2vhX6J444xbVCNVZY9JOc87zw6ZC', '0', 1),
('003', 'nguyenvanA', '$2y$10$UwVDszTQ35B79NcN4/jFSuuaqXs8qSfpAbEOUpl5KWApFlBjOcCN6', '2', 1),
('004', 'pvquy', '$2y$10$oEPaDUCNoj0c.o/dOa5BlO4RkcTjRtV6udzxxBvncmSTo0qlnQxM2', '1', 1),
('005', 'thuyle', '$2y$10$er0gnPu3XrperzBr6.goQOmv4EWRwrG.Gn1us1G2UnjsjvbvhdP7i', '2', 1),
('006', 'tuannguyen', '$2y$10$UrA4wCKoYvF.LSaleiSHK..hBF2Yon0TebHcT1AG41s9PMdtvk6Sa', '2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`authenID`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billID`),
  ADD KEY `billPurchaser` (`billPurchaser`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `cetorgry`
--
ALTER TABLE `cetorgry`
  ADD PRIMARY KEY (`cetorgryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `FK_Brand` (`productBrand`) USING BTREE,
  ADD KEY `FK_Cetogry` (`productCetorgry`) USING BTREE;

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receiptID`),
  ADD KEY `userName` (`userName`),
  ADD KEY `userName_2` (`userName`),
  ADD KEY `receiptDate` (`receiptDate`);

--
-- Indexes for table `receiptdetail`
--
ALTER TABLE `receiptdetail`
  ADD PRIMARY KEY (`receiptID`,`productID`) USING BTREE,
  ADD KEY `receiptID` (`receiptID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userName`) USING BTREE,
  ADD KEY `userAuthentication` (`userAuthentication`),
  ADD KEY `userID` (`userID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`productBrand`) REFERENCES `brand` (`brandID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`productCetorgry`) REFERENCES `cetorgry` (`cetorgryID`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`);

--
-- Constraints for table `receiptdetail`
--
ALTER TABLE `receiptdetail`
  ADD CONSTRAINT `receiptdetail_ibfk_1` FOREIGN KEY (`receiptID`) REFERENCES `receipt` (`receiptID`),
  ADD CONSTRAINT `receiptdetail_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userAuthentication`) REFERENCES `authentication` (`authenID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `customer` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
