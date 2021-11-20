-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 08:49 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colivebase`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutpage`
--

CREATE TABLE `aboutpage` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(25) NOT NULL,
  `feature_type` varchar(20) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aboutpage`
--

INSERT INTO `aboutpage` (`id`, `feature_name`, `feature_type`, `value`) VALUES
(1, 'Header', 'text', 'Colive London Letting is a Independent Firm of Estate Agent established in 2021.'),
(2, 'Content', 'text', 'The aim is to achieve a high standard in customer services and pride ourselves on providing a professional and personal approach to our clients. We specialise in the sale and rentals of high-quality property in London, Manchester, Birmingham and Leeds.\r\n\r\nOur clients benefit from the high level of enthusiasm and commitment our team brings to each potential instruction. With a combination of our dedication and extensive knowledge of some of England’s most sought-after residential locations, we have established a firm position in the property market.\r\n\r\nColive London Letting have a diverse and Global Client base. As the Company grows, the original ethos remains; at Colive London Letting, we are big enough to cope, yet small enough to care about the personal needs of our clients.'),
(3, 'Slide Image', 'datalist', 'http://127.0.0.1/casa/data/uploads/abtslide1.jpg;\r\nhttp://127.0.0.1/casa/data/uploads/abtslide2.jpg;\r\nhttp://127.0.0.1/casa/data/uploads/abtslide3.jpg'),
(4, 'Residential Developed', 'number', '3'),
(5, 'Homes Builded', 'number', '160'),
(6, 'Statisfied Custumers', 'number', '145'),
(7, 'AboutH Image', 'image', 'http://127.0.0.1/casa/data/uploads/AboutHImage.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role` varchar(25) NOT NULL,
  `pwd_reset` text NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `password`, `role`, `pwd_reset`, `created_date`) VALUES
(1, 'Administrator', 'admin@email.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin', 'none', '2021-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(25) NOT NULL,
  `feature_type` varchar(20) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `feature_name`, `feature_type`, `value`) VALUES
(1, 'Company Name', 'text', 'Colive London Letting'),
(2, 'Telephone', 'text', '800-1-5142'),
(3, 'Email', 'email', 'company@gmail.com'),
(4, 'Address', 'text', 'Diplomat Road, Muyenga'),
(5, 'facebook', 'social', 'Facebook'),
(6, 'instagram', 'social', 'Instagram'),
(7, 'twitter', 'social', 'Twitter'),
(8, 'linkedin', 'social', 'LinkedIn');

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(25) NOT NULL,
  `feature_type` varchar(20) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `feature_name`, `feature_type`, `value`) VALUES
(1, 'Hero Header', 'text', 'Welcome to Colive London'),
(2, 'Hero Subtitle', 'text', 'One stop location to buy Modern House'),
(3, 'Promo House1 Header', 'text', 'MODERN VILLA 1'),
(4, 'Promo House1 Quote', 'text', 'Nam gravida elit non massa congue, ac commodo ipsum mattis. Fusce erat magna, egestas vitae arcu non, posu-ere iaculis leo. Sed a lectus risus. Morbi eros sapien, inter-dum ut sollicitudin eget, porttitor nec elit. Fusce dignis-sim velit sit amet ligula dapibus fringilla. Cras fermentum consequat ornare. Etiam tempus ex nec nibh eleifend, nec tempus ipsum finibus.'),
(5, 'Promo House1 Button', 'link', 'about'),
(6, 'Promo House2 Header', 'text', 'MODERN VILLA 2'),
(7, 'Promo House2 Quote', 'text', 'Nam gravida elit non massa congue, ac commodo ipsum mattis. Fusce erat magna, egestas vitae arcu non, posu-ere iaculis leo. Sed a lectus risus. Morbi eros sapien, inter-dum ut sollicitudin eget, porttitor nec elit. Fusce dignis-sim velit sit amet ligula dapibus fringilla. Cras fermentum consequat ornare. Etiam tempus ex nec nibh eleifend, nec tempus ipsum finibus.'),
(8, 'Promo House2 Button', 'link', 'about'),
(9, 'Promo House1 Image', 'image', 'http://127.0.0.1/colive/img/intro/1.jpg'),
(10, 'Promo House2 Image', 'image', 'http://127.0.0.1/colive/img/intro/2.jpg'),
(11, 'Showroom Image', 'datalist', 'http://127.0.0.1/casa/data/uploads/slide1.jpg;\r\nhttp://127.0.0.1/casa/data/uploads/slide2.jpg;\r\nhttp://127.0.0.1/casa/data/uploads/slide3.jpg;\r\nhttp://127.0.0.1/casa/data/uploads/slide4.jpg'),
(12, 'Showroom Title1', 'text', 'INTERIOR'),
(13, 'Showroom Quote1', 'text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.'),
(14, 'Showroom Title2', 'text', 'ENVIORMENT FRIENDLY'),
(15, 'Showroom Quote2', 'text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.'),
(16, 'Hero Image', 'image', 'http://127.0.0.1/casa/data/uploads/HeroImage.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `housing`
--

CREATE TABLE `housing` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `road` text NOT NULL,
  `summary` text NOT NULL,
  `price` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `housing`
--

INSERT INTO `housing` (`id`, `name`, `road`, `summary`, `price`, `image`) VALUES
(1, 'New Palace with Giant Poolside', 'st. The Main Road', 'some desc info 123', '$1980,000', 'http://127.0.0.1/casa/data/uploads/New Palace with Giant Poolside.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `feature_name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `position` text NOT NULL,
  `about` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fullname`, `position`, `about`, `image`) VALUES
(2, 'JANE DOE', 'General Manager', 'Lorem ipsum dolor sit amet, consecte-tur adipiscing elit. Maecenas sed sollici-tudin sem.', 'http://127.0.0.1/colive/img/team/team.webp'),
(3, 'JANE DOE', 'General Manager', 'Lorem ipsum dolor sit amet, consecte-tur adipiscing elit. Maecenas sed sollici-tudin sem.', 'http://127.0.0.1/colive/img/team/team.webp'),
(4, 'Ibrahimo', 'Manager IOI', 'some info 123', 'http://127.0.0.1/casa/data/uploads/Ibrahimo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutpage`
--
ALTER TABLE `aboutpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutpage`
--
ALTER TABLE `aboutpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `housing`
--
ALTER TABLE `housing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
