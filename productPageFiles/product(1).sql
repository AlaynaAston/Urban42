-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2026 at 02:34 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs2team42_db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `material` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `size` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `colour` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `availableStock` int NOT NULL,
  `categoryID` int DEFAULT NULL,
  `image1Path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `image2Path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `image3Path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `name`, `description`, `material`, `size`, `colour`, `price`, `availableStock`, `categoryID`, `image1Path`, `image2Path`, `image3Path`) VALUES
(1, 'Urban Hoodie', 'Comfortable oversized hoodie with Urban 42 branding', 'Cotton', 'M', 'Black', 29.99, 50, 1, NULL, NULL, NULL),
(2, 'Kayo Sinah', 'NICE NICE KAYO', 'LOve\r\nJoy', 'XL', 'pONK', 649.33, 646, 4, 'images/img_69b887de0914c1.05925514.jpg', 'images/img_69b887de091661.24172998.jpg', 'images/img_69b887de0916a9.87326366.jpg'),
(3, 'Kayo Sinah', 'NICE NICE KAYO', 'LOve\r\nJoy', 'XL', 'pONK', 649.33, 646, 4, 'images/img_69b887e3d04467.22692561.jpg', 'images/img_69b887e3d045b1.95620425.jpg', 'images/img_69b887e3d045f3.83917585.jpg'),
(4, 'Brown Leather Bag', 'T-Lock leather shoulder bag', '100% Leather', 'L', 'Brown', 12.99, 503, 2, 'images/img_69ba31c4c419a7.40039861.jpg', 'images/img_69ba31c4c41b36.46871971.png', 'images/img_69ba31c4c41b65.35595276.png'),
(5, 'Streetstyle Trainers', 'Snake print, leopard print, and shaggy materials collide with statement denim, graphic tees, and other streetwear staples.', 'Nice material', 'XL', 'Grey and White', 59.99, 537, 3, 'images/img_69ba3282d056d9.79818600.png', 'images/img_69ba3282d05841.92570138.png', 'images/img_69ba3282d05866.48693307.png'),
(6, 'Streetwear Trousers in Black', 'P.O.A. Black Vapor Tracksuit Bottoms', '100% Cotton', 'XS', 'Black', 23.50, 693, 2, 'images/img_69ba333b64ded1.61179467.png', 'images/img_69ba333b64e004.40136529.png', 'images/img_69ba333b64e032.64583071.png'),
(7, 'Black Hi-Top Ultimate Trainer', 'A certified legend just got a serious refresh. The Black Hi-Top Ultimate Trainer in a black suede has landed, ready to prove why some styles are truly timeless. ', '100% suede', 'L', 'Black', 20.99, 673, 3, 'images/img_69ba33fa138d20.69519417.png', 'images/img_69ba33fa138ed2.42616230.png', 'images/img_69ba33fa138f17.30035319.png'),
(8, 'Brown Top Tier Beanie', 'Autumn Winter Hats For Men Women Fashion Streetwear Cap Acrylic Knitted Hat', '100% Acrylic Yarn', 'L', 'Brown', 7.99, 648, 4, 'images/img_69ba3e7c006347.68275704.png', 'images/img_69ba3e7c0066d3.03697671.png', 'images/img_69ba3e7c006719.24913974.png'),
(9, 'Grey Cyber-goth Hoodie', 'Y2K Dark Gothic Streetwear Hoodie - Angel Print Unisex Pullover', '100% Cotton', 'S', 'Grey', 34.99, 242, 1, 'images/img_69ba3f4a426db9.56077266.png', 'images/img_69ba3f4a426ed6.09677669.png', 'images/img_69ba3f4a426f00.23014105.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
