-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2022 at 04:43 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `password`, `email`) VALUES
(1, 'ChiragModh', '123', 'chirag@gmail.com'),
(2, 'Chirag', '123', 'chiragq123@gmail.com'),
(3, 'abc', '123', 'abc@gmail.com'),
(4, 'chirag1', '123', 'abc@gmail.com'),
(5, 'chirag1234', '12356', 'chirag@gmail.com'),
(6, 'admin', '1245', 'abc@gmail.com'),
(7, 'chirag1', '123', 'abc@gmail.com'),
(12, 'mahesh', '123', 'mahesh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(53, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(63, 'Chirag', 'chirag369', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `featured` varchar(10) CHARACTER SET utf8 NOT NULL,
  `active` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(23, 'Pizza', 'Food_Category_795.jpg', 'Yes', 'Yes'),
(21, 'Burger', 'Food_Category_213.jpg', 'Yes', 'Yes'),
(22, 'MoMo', 'Food_Category_610.jpg', 'Yes', 'Yes'),
(18, 'Sandwich', 'Food_Category_370.jpg', 'Yes', 'Yes'),
(14, 'Samosa', 'Food_Category_737.jpg', 'Yes', 'Yes'),
(24, 'French Fries', 'Food_Category_444.jpg', 'Yes', 'Yes'),
(25, 'Pasta', 'Food_Category_306.jpg', 'Yes', 'Yes'),
(26, 'Aloo Tikki', 'Food_Category_124.jpg', 'Yes', 'Yes'),
(27, 'Vada Pav', 'Food_Category_135.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `featured` varchar(10) CHARACTER SET utf8 NOT NULL,
  `active` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(15, 'Cheese Burger', 'A cheeseburger is a hamburger topped with cheese.', '99.00', 'Food-Name-6920.jpg', 21, 'Yes', 'Yes'),
(14, 'Smoky Burger', 'Juicy, big, loaded with toppings of my choice.', '79.00', 'Food-Name-6467.jpg', 21, 'Yes', 'Yes'),
(13, 'Samosa', 'A samosa is a fried or baked pastry with a savory filling.', '29.00', 'Food-Name-6799.jpeg', 14, 'Yes', 'Yes'),
(16, 'Grilled Cheese Sandwich', 'It is a hot sandwich made with buttered and toasted bread.', '129.00', 'Food-Name-948.jpg', 18, 'Yes', 'Yes'),
(17, 'Paneer Seekh Kabab', 'Made with Italian Sauce and organice vegetables.', '149.00', 'Food-Name-9527.jpg', 27, 'Yes', 'No'),
(18, 'Steam Momo', 'Momo is a type of dumpling with some form of filling.', '59.00', 'Food-Name-9149.jpg', 22, 'Yes', 'Yes'),
(20, 'Veggie Samosa', 'A samosa is a fried or baked pastry with a savory filling.', '49.00', 'Food-Name-400.jpeg', 14, 'Yes', 'Yes'),
(21, 'Lilva Kachori', 'Lilva kachori is a winter snack made with fresh tuvar.', '69.00', 'Food-Name-1358.jpg', 23, 'Yes', 'Yes'),
(22, 'Schezwan Noodles', 'Schezwan Noodles are made of chili peppers and vinegar.', '79.00', 'Food-Name-9506.jpg', 23, 'Yes', 'Yes'),
(23, 'Vada Pav', 'Vada Pav is a vegetarian fast food dish.', '29.00', 'Food-Name-5107.jpg', 27, 'Yes', 'Yes'),
(24, 'Kachhi Dabeli', 'Kachhi Dabeli is made from Aloo or Potato Masala Mixture.', '49.00', 'Food-Name-5476.jpg', 23, 'Yes', 'Yes'),
(25, 'Dahi Puri', 'Dahi Puri is a small fried puff of flat bread filled with yogurt.', '129.00', 'Food-Name-2409.jpg', 23, 'Yes', 'Yes'),
(28, 'Veggie Pizza', 'Cheese Pizza is made of peppers, and black olives.\r\n\r\n', '299.00', 'Food-Name-9705.jpg', 23, 'Yes', 'Yes'),
(45, 'rtd', 'sedf', '15645.00', 'Food-Name-470.jpg', 32, 'Yes', 'Yes'),
(30, 'Cheese Pizza', 'Cheese Pizza is made of  red peppers onions, olives.', '129.00', 'Food-Name-7976.gif', 23, 'Yes', 'Yes'),
(31, 'Chilli burger With Pepper Relish', 'A cheeseburger is a hamburger topped with cheese.', '149.00', 'Food-Name-7584.png', 21, 'Yes', 'Yes'),
(32, 'Perfect Lamb Satay Burger', 'A cheeseburger is a hamburger topped with cheese.', '129.00', 'Food-Name-6602.jpg', 21, 'Yes', 'Yes'),
(33, 'Potato Corn Burger', 'A cheeseburger is a hamburger topped with cheese.', '199.00', 'Food-Name-4577.jpg', 21, 'Yes', 'Yes'),
(34, 'Rajma Patty Burger', 'A cheeseburger is a hamburger topped with cheese.', '199.00', 'Food-Name-2852.jpg', 21, 'Yes', 'Yes'),
(35, 'Cheese Momos', 'Momo is a type of dumpling with some form of filling.', '49.00', 'Food-Name-4461.jpg', 22, 'Yes', 'Yes'),
(42, 'Italian Pizza', 'Cheese Pizza is made of peppers, and black olives.', '299.00', 'Food-Name-8229.jpg', 23, 'Yes', 'Yes'),
(37, 'The authentic momos', 'Momo is a type of dumpling with some form of filling.\r\n\r\n', '129.00', 'Food-Name-8460.jpg', 22, 'Yes', 'Yes'),
(38, 'Vegetable momos', 'Momo is a type of dumpling with some form of filling.\r\n\r\n', '39.00', 'Food-Name-2980.jpg', 22, 'Yes', 'Yes'),
(39, 'Cheese Sandwich', 'It is a hot sandwich made with buttered and toasted bread.\r\n\r\n', '69.00', 'Food-Name-2441.jpg', 18, 'Yes', 'Yes'),
(40, 'Nutella Sandwich', 'It is a hot sandwich made with buttered and toasted bread.\r\n\r\n', '129.00', 'Food-Name-9095.jpg', 18, 'Yes', 'Yes'),
(41, 'Veg Sandwich', 'It is a hot sandwich made with buttered and toasted bread.\r\n\r\n', '59.00', 'Food-Name-6007.jpg', 18, 'Yes', 'Yes'),
(43, 'Pepperoni Pizza', 'Cheese Pizza is made of peppers, and black olives.\r\n\r\n', '349.00', 'Food-Name-7010.jpg', 23, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `food` varchar(150) CHARACTER SET utf8 NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 NOT NULL,
  `customer_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `customer_contact` varchar(20) CHARACTER SET utf8 NOT NULL,
  `customer_email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(9, 'Cheese Burger', '99.00', 5, '495.00', '2022-03-21 03:27:43', 'Delivered', 'Chirag', '9523674126', 'abc@gmail.com', 'adzdxv'),
(6, 'Cheese Burger', '99.00', 2, '198.00', '2022-03-19 04:00:03', 'Delivered', 'Jainesh Gandhi', '7461326589', 'jainesh@gmail.com', 'Palanpur'),
(5, 'Samosa', '29.00', 5, '145.00', '2022-03-18 12:17:52', 'Delivered', 'Modh Chirag', '9142643258', 'chirag@gmail.com', 'Jagana'),
(10, 'rtd', '15645.00', 3, '46935.00', '2022-03-24 04:41:05', 'Delivered', 'fds', '656456466', 'acb@gmail.com', 'dsfdgfdfg');
