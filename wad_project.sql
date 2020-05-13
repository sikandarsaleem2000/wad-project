-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 03:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wad_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `pid`, `comment`, `sender_name`, `date`) VALUES
(8, 6, 'nice product', 'sikandar@gmail.com', '2020-01-30 00:08:18'),
(9, 6, 'nice product but i you', 'sikandar@gmail.com', '2020-01-30 00:09:09'),
(10, 11, 'nicee', 'test@gmail.com', '2020-01-30 13:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`cid`, `pid`, `quantity`) VALUES
(1, 13, 2),
(1, 9, 1),
(18, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PID` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` varchar(255) DEFAULT NULL,
  `product_location` varchar(255) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_short_intro` varchar(255) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `customer_signup_time` varchar(255) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `product_rating` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PID`, `product_name`, `product_price`, `product_location`, `product_quantity`, `product_short_intro`, `product_img`, `product_description`, `customer_signup_time`, `seller_id`, `comments`, `date`, `product_rating`) VALUES
(1, 'Macbook Pro', '350000', 'Lahore', 7, 'Apple 13MacBook Pro laptops with Touch Bar, Intel Core i5 2.4GHz, Plus 655, 16GB RAM, 256GB SSD', 'uploads/5e30ec28aef87.jpg', 'Apple 13MacBook Pro laptops with Touch Bar, Intel Core i5 2.4GHz, Plus 655, 16GB RAM, 256GB SSD', NULL, 1, NULL, '2020-01-28 17:29:51', ''),
(2, 'IPhone 11', '200000', 'Lahore', 9, 'Trade in your current iPhone mobiles and get credit toward a new iPhone 11 Pro . Buy now with free shipping.', 'uploads/5e3101144c140.jpg', 'Trade in your current iPhone mobiles and get credit toward a new iPhone 11 Pro . Buy now with free shipping.', NULL, 1, NULL, '2020-01-28 17:31:51', ''),
(3, 'HP Probook', '60000', 'Lahore', 8, 'HP ProBook laptops 440 G6 Core i7 8th Generation Laptop 8GB RAM 1TB HDD 2GB Graphics Card Nvidia 930MX', 'uploads/5e30ec4650ed6.jpg', 'HP ProBook laptops 440 G6 Core i7 8th Generation Laptop 8GB RAM 1TB HDD 2GB Graphics Card Nvidia 930MX', NULL, 1, NULL, '2020-01-28 17:32:54', ''),
(5, 'Dell Latitude', '140000', 'Islamabad', 11, 'Display laptops. Size. 14.00-inch. Resolution. ... Processor. Processor. Intel Core i5 6300U. Base Clock Speed. ... Memory. RAM. 8GB.', 'uploads/5e30ec61adc9c.webp', 'Display laptops. Size. 14.00-inch. Resolution. ... Processor. Processor. Intel Core i5 6300U. Base Clock Speed. ... Memory. RAM. 8GB.', NULL, 1, NULL, '2020-01-28 17:40:53', ''),
(6, 'Samsung Note 10', '160000', 'Faisalbad', 9, 'The Samsung Galaxy Note 10 mobiles has a 6.3 inches screen and 256GB 8GB RAM. It comes with 10 MP selfie camera', 'uploads/5e30ea59ae0eb.jpg', 'The Samsung Galaxy Note 10 mobiles has a 6.3 inches screen and 256GB 8GB RAM. It comes with 10 MP selfie camera', NULL, 1, NULL, '2020-01-28 17:42:44', ''),
(8, 'Infinix 5S Lite', '30000', 'Lahore', 11, 'Infinix S5 lite Android mobiles. Announced Nov 2019. Features 6.6 IPS LCD display, MT6762 Helio P22 chipset,', 'uploads/5e30ea6d60a23.jpg', 'Infinix S5 lite Android mobiles. Announced Nov 2019. Features 6.6 IPS LCD display, MT6762 Helio P22 chipset,', NULL, 1, NULL, '2020-01-28 17:53:50', ''),
(9, 'Sport Watches', '12000', 'Lahore', 9, 'Boamigo Men Waterproof Watches 3 Time Zone Sports Watches Male Led Digital Quartz Wristwatches Blue', 'uploads/5e307ca6aba41.webp', 'Boamigo Men Waterproof Watches 3 Time Zone Sports Watches Male Led Digital Quartz Wristwatches Blue', NULL, 1, NULL, '2020-01-28 18:24:16', ''),
(10, 'Airpods', '12999', 'Islamabad', 10, 'Rather than just offering tweaks, the Pro model completely redesigns the in-ear experience', 'uploads/5e307da718bb4.jpg', 'Rather than just offering tweaks, the Pro model completely redesigns the in-ear experience', NULL, 1, NULL, '2020-01-28 18:28:02', ''),
(11, 'Ascer Laptop', '99999', 'Islamabad', 8, 'Acer Aspire laptops 3 A315 53 Core i3 8th Gen  4GB Ram  1TB Hard Drive  15.6 Display  DOS  Local Warranty', 'uploads/5e30ec759e524.jpg', 'Acer Aspire laptops 3 A315 53 Core i3 8th Gen  4GB Ram  1TB Hard Drive  15.6 Display  DOS  Local Warranty', NULL, 1, NULL, '2020-01-28 18:42:55', ''),
(12, 'S10 Mobiles', '149000', 'Lahore', 4, 'Skjermbeskytter for Galaxy S10 Plus som holder mobilens skjerm helt fri for riper og beskytter mot knusing. Beskytteren', 'uploads/5e31007bb330e.jpeg', 'Skjermbeskytter for Galaxy S10 Plus som holder mobilens skjerm helt fri for riper og beskytter mot knusing. Beskytteren er veldig tynn og har 100 %', NULL, 45, NULL, '2020-01-29 03:46:46', ''),
(13, 'Samsung LEDS', '150000', 'Lahore', 10, 'According to one product review site, a 32 LED TV uses about 18 watts of energy. Moving up to a 40 LED increases', 'uploads/5e3325f7c7335.jpg', 'According to one product review site, a 32 LED TV uses about 18 watts of energy. Moving up to a 40 LED increases', NULL, 1, NULL, '2020-01-30 16:29:18', '');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `SID` int(11) NOT NULL,
  `seller_shop_name` varchar(255) DEFAULT NULL,
  `seller_contact_no` varchar(255) DEFAULT NULL,
  `seller_city` varchar(255) DEFAULT NULL,
  `seller_pswd` varchar(255) DEFAULT NULL,
  `seller_email` varchar(255) DEFAULT NULL,
  `seller_signup_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`SID`, `seller_shop_name`, `seller_contact_no`, `seller_city`, `seller_pswd`, `seller_email`, `seller_signup_time`) VALUES
(1, 'Dose', '03447000390', 'Lahore', '1122333', 'sikandar@gmail.com', '2020-01-15 13:32:08'),
(45, 'UCP', '03446721813', 'Lahore', '1122333', 'sikandar.saleem@ucp.edu.pk', '2020-01-29 08:42:52'),
(46, 'WAD', '03457879380', 'Lahore', '1122333', 'ahmad@gmail.com', '2020-01-30 07:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `CID` int(11) NOT NULL,
  `customer_phone_no` varchar(255) DEFAULT NULL,
  `customer_pswd` varchar(255) DEFAULT NULL,
  `customer_dob` date DEFAULT NULL,
  `customer_gender` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_permotion_status` varchar(255) DEFAULT NULL,
  `customer_signup_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`CID`, `customer_phone_no`, `customer_pswd`, `customer_dob`, `customer_gender`, `customer_name`, `customer_email`, `customer_permotion_status`, `customer_signup_time`) VALUES
(1, '03447000390', '112233', '2020-01-03', 'Male', 'Sikandar Saleem', 'sikandar@gmail.com', 'true', '2020-01-15 12:36:39'),
(18, '03446721813', '112233', '2020-01-24', 'Male', 'Muhammad Ahmad', 'ahmad@gmail.com', 'true', '2020-01-26 20:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `word` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`word`) VALUES
('kill'),
('killed'),
('murder'),
('abuse'),
('angry'),
('cry'),
('cruel'),
('war'),
('fire'),
('firing'),
('damage'),
('destroy'),
('disease'),
('hurt'),
('grave'),
('danger'),
('killing'),
('killer'),
('killing'),
('killer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`CID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
