-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 02:55 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'category 1'),
(2, 'category 2'),
(3, 'category 3'),
(4, 'category 4');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_amount` float NOT NULL,
  `order_transaction` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `short_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `short_desc`, `product_image`) VALUES
(7, 'Akira 35th Anniversary Box Set', 3, 67, 8, 'In 1982, Kodansha published the first chapter of Akira, a dystopian saga set in Neo-Tokyo, a city recovering from thermonuclear attack where the streets have been ceded to motorcycle gangs and the rich and powerful run dangerous experiments on destructive, supernatural powers that they cannot control. Today, it remains a touchstone for artists, writers, filmmakers, and fans, retaining all the brutal impact and narrative intensity it had when Otomo first unleashed it onto the world, and is presented here in six beautiful hardcover volumes.', 'Katsuhiro Otomo is best known as the creator of the three-thousand page epic Akira. He also directed the groundbreaking animated feature film of the same name, as well as the acclaimed animated film, Steamboy. Most recently, he directed the live-action Japanese film, Mushishi.', '_by_boris_dyatlov-d77c875.jpg'),
(14, 'Research Methods and Statistics in Psychology', 2, 35, 73, 'Assuming no prior knowledge, this bestselling text takes you through every stage of your research project giving advice on planning and conducting studies, analysing data and writing up reports.\r\n\r\nThe book provides clear coverage of statistical procedures, and includes everything needed from nominal level tests to multi-factorial ANOVA designs, multiple regression and log linear analysis. It features detailed and illustrated SPSS instructions for all these procedures eliminating the need for an extra SPSS textbook.\r\n\r\nNew features in the sixth edition include:\r\n\r\n\"Tricky bits\" - in-depth notes on the things that students typically have problems with, including common misunderstandings and likely mistakes.\r\nImproved coverage of qualitative methods and analysis, plus updates to Grounded Theory, Interpretive Phenomenological Analysis and Discourse Analysis.\r\nA full and recently published journal article using Thematic Analysis, illustrating how articles appear in print.\r\nDiscussion of contemporary issues and debates, including recent coverage of journalsâ€™ reluctance to publish replication of studies.\r\nFully updated online links, offering even more information and useful resources, especially for statistics.\r\nEach chapter contains a glossary, key terms and newly integrated exercises, ensuring that key concepts are understood. A companion website (www.routledge.com/cw/coolican) provides additional exercises, revision flash cards, links to further reading and data for use with SPSS.', 'This sixth edition of Research Methods and Statistics in Psychology has been fully revised and updated, providing students with the most readable and comprehensive survey of research methods, statistical concepts and procedures in psychology today.', 'book01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'cosmin', 'cosmin@gmail.com', 'cosmin'),
(2, 'akira', 'akira@gmail.com', 'akira');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
