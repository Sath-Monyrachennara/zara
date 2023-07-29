-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 05:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zaradb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pro_name` varchar(150) NOT NULL,
  `pro_price` int(100) NOT NULL,
  `quantity` int(25) NOT NULL,
  `size` varchar(30) NOT NULL,
  `color` varchar(50) NOT NULL,
  `pro_image` varchar(30) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `message`) VALUES
(1, 2, 'Sath Nara', 'nara12@gmail.com', '012345600', 'st 234 PP Cambodia', 'Your products are good.');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(100) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`) VALUES
(1, 'Which country owns Zara?', 'Zara was started by Amancio Ortega in 1975. His first shop was in central A Coruña, in Galicia, Spain, where the company is still based.'),
(2, 'Is Zara a top brand?', 'Zara is one of the world\'s most successful fashion retail brands – if not the most successful one.'),
(3, 'Why Zara is affordable?', 'Design, production, distribution and retailing processes simple, Zara followed fashion trends while offering unparalleled value. Zara\'s focus on store-level sales trends and its grip on each stage.'),
(4, 'In which country Zara is cheapest?', 'Consumers looking to buy Zara items for the lowest possible prices should head to the retailer\'s home country, Spain, or its neighbor Portugal, where prices are 36 percent lower than in the United Sta'),
(5, 'How popular is Zara brand?', 'All in all, 9% of fashion store customers in the United States use Zara. That means, of the 46% who know the brand, 20% use them.'),
(6, 'Who are Zara\'s main customers?', 'The Zara target market includes women and men, mainly younger adults in the age range of 18 to 40.');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pro_name` varchar(150) NOT NULL,
  `pro_price` varchar(100) NOT NULL,
  `types` varchar(30) NOT NULL,
  `pro_image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `pro_name`, `pro_price`, `types`, `pro_image`) VALUES
(1, 2, 'FLAT-SOLE SANDALS', '132', 'shoes', 'picture11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `products` varchar(200) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `number`, `address`, `payment_method`, `products`, `total`, `date`, `payment_status`) VALUES
(1, 2, 'Heng Gogo', 'gogHeng12@gmail.com', '012345499', 'st 234 PP PP Cambodia', 'paypal', 'METALLIC KITTEN HEEL SLINGBACK, ', 121, '2023-07-29', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(100) NOT NULL,
  `pro_name` varchar(150) NOT NULL,
  `pro_price` int(100) NOT NULL,
  `image` varchar(15) NOT NULL,
  `productDetail_img` varchar(15) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `materials` varchar(130) NOT NULL,
  `types` varchar(30) NOT NULL,
  `discount_prices` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pro_name`, `pro_price`, `image`, `productDetail_img`, `detail`, `materials`, `types`, `discount_prices`) VALUES
(1, 'OVAL DENIM BAG', 46, 'picture31.jpg', 'detailImg26', 'Oval bucket bag. Denim fabric exterior with pleats and diamanté details.', '80% cotton\r\n20% viscose\r\n', 'bags', 0),
(2, 'SHIMMERY MINI CITY BAG', 34, 'picture32.jpg', 'detailImg27', 'Mini city bag in bejewelled fabric. Double handle with knotted detail on the corners. Lined interior. Metal chain crossbody strap. Magnetic clasp closure.', 'MAIN FABRIC\r\n100% polyester\r\nSHOULDER STRAP\r\n100% iron\r\n', 'bags', 32),
(3, 'CONTRAST CROSSBODY BAG\r\n\r\n', 50, 'picture33.jpg', 'detailImg28', 'Crossbody bag in a combination of materials. Contrast-coloured topstitching detail. Removable crossbody strap. Zip closure.', 'MAIN FABRIC\r\n100% cotton\r\nADDITIONAL MATERIAL\r\n100% polyurethane', 'bags', 0),
(4, 'CROSSBODY BAG WITH PEARLS', 26, 'picture34.jpg', 'detailImg29', 'Crossbody bag. Faux pearl beads on the exterior. Lining. Shoulder strap and detachable crossbody strap. Magnetic clasp closure.', '100% acrylonitrile butadiene styrene', 'bags', 23),
(5, 'FABRIC MINI CITY BAG', 120, 'picture40.jpg', 'detailImg35', 'Mini city bag in fabric. Handles and detachable crossbody shoulder strap. Zip closure.', 'MAIN FABRIC\r\n100% cotton', 'bags', 0),
(6, 'CROSSBODY BAG', 110, 'picture39.jpg', 'detailImg34', 'Crossbody bag with a flap. Two adjustable and detachable straps, one a canvas shoulder strap and the other a crossbody strap. Magnetic clasp closure.', 'MAIN MATERIAL\r\n100% polyurethane\r\nSHOULDER STRAP\r\n70% polyurethane', 'bags', 0),
(7, 'FAUX EARRINGS', 81, 'picture35.jpg', 'detailImg30', 'Metal dangle earrings in the shape of balls and faux pearl appliqués. Push-back and clip closure.', '80% plastic-acrylic\r\n10% zinc\r\n5% iron', 'accessories', 70),
(8, 'RHINESTONE EARRINGS PEAR', 100, 'picture36.jpg', 'detailImg31', 'Metal push-back earrings with bejewelled rhinestone and fresh water pearl bead appliqués.', '25% steel\r\n25% zinc\r\n20% brass', 'accessories', 0),
(9, 'IRREGULAR HOOP EARRINGS', 76, 'picture42.jpg', 'detailImg37', 'Irregular hoop-shaped metallic earrings. Push-back fastening.', '98% zinc\r\n2% steel\r\n', 'accessories', 0),
(10, 'TRIANGLE BRALETTE RHINESTONES', 121, 'picture38.jpg', 'detailImg33', 'Triangular bralette with rhinestone appliqués. Adjustable fastening at the back and neck with a lobster clasp.', '55% copper\r\n40% glass\r\n5% iron', 'accessories', 0),
(11, 'IRREGULAR HOOP', 125, 'picture41.jpg', 'detailImg36', 'Irregular metal hoop earrings. Push-back fastening.', '98% brass\r\n2% stainless steel\r\n', 'accessories', 0),
(12, 'TUBULAR CORD CHOKER', 68, 'picture37.jpg', 'detailImg32', 'Choker with metal tubular appliqué and cord.', '53% brass\r\n47% polyester', 'accessories', 0),
(13, 'HIGH-HEEL CAGE SANDALS', 160, 'picture1.jpg', 'detailImg1', 'Mid-heel cage sandals with thin straps. Buckled ankle strap fastening. Pointed toe.', '100% polyurethane thermoplastic', 'shoes', 0),
(14, 'HIGH-HEEL STRAPPY SANDALS', 125, 'picture2.jpg', 'detailImg2', 'High-heel sandals with thin straps. Buckled ankle strap fastening.', '100% polyurethane thermoplastic', 'shoes', 120),
(15, 'LACE-UP SANDALS WITH STRAPS', 145, 'picture9.jpg', 'detailImg3', 'Kitten-heel sandals with thin straps for tying at the ankle. Round toe.\r\n', '100% sheep leather\r\n', 'shoes', 126),
(16, 'LEATHER SANDALS HEEL', 150, 'picture12.jpg', 'detailImg7', 'Leather sandals with thin straps. Seashell heel. Square toe.', '100% polyurethane thermoplastic\r\n', 'shoes', 0),
(17, 'METALLIC KITTEN HEEL SLINGBACK', 121, 'picture10.jpg', 'detailImg4', 'Kitten heel slingback shoes with a metallic effect. Pointed toe. Back strap with elastic piece.', '100% polyurethane thermoplastic', 'shoes', 115),
(18, 'FLAT-SOLE SANDALS', 132, 'picture11.jpg', 'detailImg5', 'Flat cage sandals. Buckled ankle strap fastening.', '100% sbs\r\n', 'shoes', 0),
(19, 'SATIN WITH CRISS-CROSS STRAPS', 165, 'picture13.jpg', 'detailImg8', 'Heeled sandals with a satin effect. Criss-cross straps on the front. Square toe.', '100% polyurethane thermoplastic', 'shoes', 0),
(20, 'DENIM HIGH-HEEL SANDALS ', 145, 'picture7.jpg', 'detailImg6', 'Denim high-heel sandals. Thin straps on the front with rhinestone details. Square toe.\r\n', '100% polyurethane thermoplastic', 'shoes', 0),
(21, 'SATIN CROPPED BOMBER JACKET', 150, 'picture15.jpg', 'detailImg9', 'Bomber jacket with a round neckline and long sleeves with shoulder pads. Featuring matching ribbed trims, side pockets and snap-button fastening at the front.\r\n\r\n', 'MAIN FABRIC\r\n66% viscose\r\n34% polyester', 'jackets', 0),
(22, 'DENIM JACKET WITH PATCH POCKETS', 231, 'picture16.jpg', 'detailImg10', 'Jacket with a lapel collar and long sleeves. Front patch pockets. Metal button fastenings on the front.', '100% cotton', 'jackets', 216),
(23, 'OVERSIZE SHORT TRENCH COAT\r\n\r\n', 123, 'picture17.jpg', 'detailImg11', 'Trench coat with a lapel collar and a crossover neckline. Long sleeves with tabs. Belt with contrast buckle at the hem. Front button fastening.', '100% cotton', 'jackets', 0),
(24, 'FLOWING BOMBER JACKET', 120, 'picture18.jpg', 'detailImg12', 'Flowing bomber jacket made of viscose. High round neck and long sleeves with elastic cuffs. Front patch pockets with flaps. Elastic hem with adjustable ties. Front fastening with metal zip and snap-bu', '100% viscose', 'jackets', 0),
(25, 'SATIN CROPPED BOMBER JACKET', 245, 'picture19.jpg', 'detailImg14', 'Bomber jacket made of 100% viscose. Round neck and sleeves falling below the elbow. Ribbed elastic trims. Front welt pockets. Front fastening with metal zip.', '100% viscose', 'jackets', 0),
(26, 'DENIM JACKET WITH PATCH POCKETS\r\n\r\n', 125, 'picture20.jpg', 'detailImg15', 'Jacket with a lapel collar and long sleeves. Front patch pockets. Metal button fastenings on the front.', '100% cotton', 'jackets', 0),
(27, 'ZW RHINESTONE DENIM JACKET', 235, 'picture21.jpg', 'detailImg16', 'Collared denim jacket with long sleeves. Chest patch pockets with buttoned flaps. Rhinestone appliqués. Button-up front.', '100% cotton', 'jackets', 0),
(28, 'TRF DENIM BIKER JACKET', 111, 'picture22.jpg', 'detailImg17', 'Collared jacket with long cuffed sleeves. Side zip pockets. Matching fabric belt with a metal buckle. Crossover zip fastening at the front.\r\n\r\n', '100% cotton\r\n', 'jackets', 100),
(29, 'GATHERED LINEN BLEND DRESS', 210, 'picture23.jpg', 'detailImg18', 'Sleeveless midi dress made of a linen and viscose blend. Featuring a wide neckline, gathered detailing, pleats and a side slit at the hem.', '60% viscose\r\n40% linen', 'dresses', 0),
(30, 'COTTON DRESS WITH TASSELS', 145, 'picture24.jpg', 'detailImg19', 'Midi dress made of 100% cotton fabric. V-neck and full sleeves falling below the elbow. Pleated waist. Contrast embroidery and tassel details. Asymmetric hem with front slit.\r\n\r\n', 'MAIN FABRIC\r\n100% cotton\r\nEMBROIDERY\r\n100% polyester', 'dresses', 0),
(31, 'SHINY MIDI DRESS - LIMITED EDITION\r\n\r\n', 144, 'picture25.jpg', 'detailImg20', 'Midi dress made of a viscose blend. V-neck and wide adjustable straps with ties at the neck. Bead, sequin and metallic thread appliqués. ', 'MAIN FABRIC\r\n95% viscose\r\n5% metallised fibre', 'dresses', 0),
(32, 'ASYMMETRIC MIDI DRESS', 123, 'picture26.jpg', 'detailImg21', 'Dress featuring an asymmetric neckline and golden appliqué on the shoulder. Opening detail at the waist and gathering. Invisible side zip fastening.', '100% polyester', 'dresses', 0),
(33, 'JUMPSUIT WITH WRAP TROUSERS', 156, 'picture27.jpg', 'detailImg22', 'Sleeveless jumpsuit with a draped round neck. Pleated detail and wrap-style front. Wide-leg design. Back cut-out detail. Invisible side zip fastening.', '100% polyester', 'dresses', 0),
(34, 'CROCHET HALTER DRESS', 100, 'picture28.jpg', 'detailImg23', 'Halter dress featuring an adjustable V-neck with ties in the same fabric.\r\n\r\n', '100% cotton', 'dresses', 0),
(35, 'LONG SHAPE DRESS', 211, 'picture29.jpg', 'detailImg24', 'Long dress with a round neckline and thin straps. Side draped detail.', '94% polyamide\r\n6% elastane', 'dresses', 0),
(36, 'ASYMMETRIC DRAPED ORGANZA DRESS', 135, 'picture30.jpg', 'detailImg25', 'Short sleeveless organza dress with an asymmetric neckline and long sleeves. Draped detail on the side.\r\n\r\n', '68% polyester\r\n32% elastane', 'dresses', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dateof_birth` varchar(100) NOT NULL,
  `number` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `confirm_password` varchar(10) NOT NULL,
  `zodic_sign` varchar(50) NOT NULL,
  `user_img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `dateof_birth`, `number`, `gender`, `password`, `confirm_password`, `zodic_sign`, `user_img`) VALUES
(2, 'gogHeng12@gmail.com', 'Heng Gogo', '1997/05/12', '09875623', 'male', '12345', '12345', 'Leo', 'Leo.jpg'),
(3, 'testing23@gmail.com ', 'Testing Admin', '12/25/2000', '012 345 567', 'female', '123', '123', 'Leo', 'Leo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
