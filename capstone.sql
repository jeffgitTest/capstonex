-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2017 at 06:12 PM
-- Server version: 1.0.110
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin'),
(2, 'admin2', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(3, 'accounting', '81dc9bdb52d04dc20036dbd8313ed055', 'accountant');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `user_id`, `name`) VALUES
(1, 3, 'RR Rowling');

-- --------------------------------------------------------

--
-- Table structure for table `author_bid`
--

CREATE TABLE IF NOT EXISTS `author_bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `co_author` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `projected_price` varchar(255) NOT NULL,
  `status` varchar(19) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `author_bid`
--

INSERT INTO `author_bid` (`id`, `bid_id`, `title`, `details`, `co_author`, `author_id`, `genre`, `projected_price`, `status`, `created_date`) VALUES
(39, 53, '111', '111', '', 6, '111', '1111', '1', '2017-03-20 17:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `type`, `active`, `created_date`) VALUES
(53, 'author', 0, '2017-03-20 17:20:46'),
(54, 'supplier', 0, '2017-03-20 17:22:53'),
(55, 'supplier', 0, '2017-03-26 16:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `category`) VALUES
(2, ' J. Gonzales, Â R. Nocon', '24'),
(3, 'Rodibelle F. Leona, Â RodellaÂ F. Salas, Â Henry T', '25'),
(4, 'Joanna Lynn L. Mercado', '26'),
(5, 'Erika S. Farshid Mehr,  Frederic D. Yulo', '25');

-- --------------------------------------------------------

--
-- Table structure for table `cacel_order`
--

CREATE TABLE IF NOT EXISTS `cacel_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(50) NOT NULL,
  `payer_email` varchar(50) NOT NULL,
  `now` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cacel_order`
--

INSERT INTO `cacel_order` (`id`, `txn_id`, `payer_email`, `now`) VALUES
(1, '053621837E670284T', 'capstoneTest@gmail.com', '2017-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(40) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(23, 'Match'),
(24, 'Math'),
(25, 'Computer'),
(26, 'Marketing'),
(27, 'asdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `cod_details`
--

CREATE TABLE IF NOT EXISTS `cod_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cod_details`
--

INSERT INTO `cod_details` (`id`, `user_id`, `address`, `province`, `city_municipality`, `zip_code`, `mobile_number`, `created_date`) VALUES
(1, 6, 'Mandaluyong', 'NCR', 'Mandaluyong', '2305', '09067224095', '2017-03-24 03:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `validity` varchar(10) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `bid`, `user_id`, `type`, `validity`, `active`, `created_date`) VALUES
(13, 53, 6, 'author', '03/31/2017', 0, '2017-03-20 17:21:32'),
(14, 54, 3, 'supplier', '03/31/2017', 0, '2017-03-20 17:23:24'),
(15, 55, 6, 'supplier', '03/31/2017', 1, '2017-03-26 16:47:21'),
(16, 55, 6, 'supplier', '03/31/2017', 1, '2017-03-26 16:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `critical_level`
--

CREATE TABLE IF NOT EXISTS `critical_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `crit_level` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `critical_level`
--

INSERT INTO `critical_level` (`id`, `product_id`, `crit_level`, `type`, `created_date`) VALUES
(1, 0, 200, 'bs', '2017-03-17 18:09:24'),
(2, 0, 150, 'nbs', '2017-03-17 18:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `amount`, `created_date`) VALUES
(1, 'Kuryente', '1000', '2017-03-08 08:21:46'),
(2, 'Tubig', '500', '2017-03-08 08:21:46'),
(3, 'Internet', '999', '2017-03-08 08:21:46'),
(4, 'Rent', '3000', '2017-03-08 08:21:46'),
(5, 'Gastos', '500', '2017-03-08 09:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `name`, `subject`, `email`, `message`, `date`) VALUES
(1, 'Russell James', 'sample subject', 'rje.mindo@gmail.com', 'sample message', '2017-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `pname` varchar(35) NOT NULL,
  `lessted_value` int(11) NOT NULL,
  `current_stock` int(11) NOT NULL,
  `previous stock` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `message` longtext NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_option`
--

CREATE TABLE IF NOT EXISTS `payment_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(255) NOT NULL,
  `merchant` varchar(255) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`id`, `option`, `merchant`, `base_url`, `active`) VALUES
(1, 'https://www.sandbox.paypal.com/cgi-bin/webscr', 'fritzlicda1-facilitator-1@gmail.com', 'http://localhost/capstone/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(16) NOT NULL,
  `details` text NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(16) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `timestamp` varchar(10) NOT NULL,
  `date_added` date NOT NULL,
  `ext` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `author_id`, `product_name`, `price`, `details`, `stock`, `category`, `sub_category`, `status`, `timestamp`, `date_added`, `ext`) VALUES
(9, 1, 'Essential Statistics', '550', 'There are so many books about statistics out there written both by local and foreign authors. So why come up with yet another one? This book makes use of the same format adopted for an earlier, similar book in Algebra found useful by many students and teachers. It utilizes step-by-step procedures, includes lots of exercises, and worksheets, offers opportunities for student reflection and real-world connections, highlights the use of technology-based tools, requires student projects, presents chapter highlights, and provides students preparatory materials for major examinations.. It also has materials on integrating student portfolios and learning papers into the course.', 100, '24', ' J. Gonzales, Â R. Nocon', 'active', '2017-02-11', '2017-02-11', 'png'),
(10, 1, 'Practical Approach to Information Communication Technology (ICT)', '123', 'SAMPLE DESCRIPTION', 115, '25', 'Erika S. Farshid Mehr,  Frederic D. Yulo', 'active', '2017-02-15', '2017-02-15', 'png'),
(11, 6, 'Basic Marketing', '50', 'The marketing world today is very much different from it was years ago. Today, market enterprises use modem communication technologies such as email, fax machines, Internet. World Wide Web in their marketing transactions to help making them cross boundaries with ease_ With globalization and applications of quantitative tools in marketing as the trend, modern marketing managers, marketing instructors and students have to equip themselves with modem know- how of the basic principles of marketing for them to meet the challenges in this rapid changing world of marketing.', 223, '23', ' J. Gonzales, Â R. Nocon', 'unactive', '2017-02-15', '2017-02-15', 'png'),
(12, 6, '2222', '2222', '', 50, '', '', 'unactive', '', '0000-00-00', 'png'),
(13, 6, '1111', '1111', '', 50, '', '', 'unactive', '', '0000-00-00', 'png'),
(14, 6, '111', '1111', '', 50, '', '', 'unactive', '', '0000-00-00', 'png');

-- --------------------------------------------------------

--
-- Table structure for table `product_history`
--

CREATE TABLE IF NOT EXISTS `product_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `qty_added` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_history`
--

INSERT INTO `product_history` (`id`, `pid`, `qty_added`, `date`) VALUES
(1, 13, 100, '2017-03-10'),
(2, 13, 20, '2017-03-15'),
(3, 13, -5, '2017-03-15'),
(4, 13, -20, '2017-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `reason` text NOT NULL,
  `product` varchar(30) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_type`, `email`, `full_name`, `contact_num`, `reason`, `product`, `status`) VALUES
(1, 'supplier', 'mendozalaxus@gmail.com', '0', '09067224096', 'Wala lang!', 'Wala lang!', 'accepted'),
(2, 'supplier', 'roxelrollmendoza@gmail.com', 'Roxel Roll Mendoza', '09067224096', 'wala lang ulit!', 'Papel de liha', 'accepted'),
(3, 'author', 'natsumendoza@gmail.com', 'natsu', '09078463744', 'asdasdasdsad', NULL, 'accepted'),
(4, 'author', 'sdasd', 'aadasdas', '21312312312', 'asdasdasd', NULL, 'pending'),
(5, 'author', 'sdasd', 'aadasdas', '21312312312', 'asdasdasd', NULL, 'pending'),
(6, 'author', 'mendozalaxus@gmail.com', 'roro', '123456778', 'reason 3', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `security_qa`
--

CREATE TABLE IF NOT EXISTS `security_qa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `security_qa`
--

INSERT INTO `security_qa` (`id`, `user_id`, `question`, `answer`, `created_date`) VALUES
(4, 23, 'What is your mother''s maiden name?', 'orog', '2017-03-24 05:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `product` varchar(40) NOT NULL,
  `contract` varchar(10) NOT NULL,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `product`, `contract`, `valid_until`) VALUES
(1, '0', 'Wala lang!', 'valid', '2017-04-30 05:23:10'),
(2, 'Roxel Roll Mendoza', 'Papel de liha', 'valid', '2017-07-31 05:23:10'),
(3, 'Roxel', 'papel', 'invalid', '2017-03-14 09:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_bid`
--

CREATE TABLE IF NOT EXISTS `supplier_bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_bid` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `supplier_bid`
--

INSERT INTO `supplier_bid` (`id`, `bid_id`, `supplier_id`, `product_bid`, `details`, `price`, `status`, `created_date`) VALUES
(15, 54, 3, '222', '222', '222', 1, '2017-03-20 17:22:54'),
(16, 55, 6, 'Martilyo', 'dasd', '600', 1, '2017-03-26 16:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE IF NOT EXISTS `supplies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `bid_id`, `supplier_id`, `product_name`, `details`, `price`, `active`, `created_date`) VALUES
(3, 54, 15, '222', '222', '222', 1, '2017-03-20 17:23:25'),
(4, 55, 16, 'Martilyo', 'dasd', '600', 1, '2017-03-26 16:47:21'),
(5, 55, 16, 'Martilyo', 'dasd', '600', 1, '2017-03-26 16:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id_array` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `month` varchar(4) NOT NULL,
  `day` varchar(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mc_gross` varchar(255) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `payer_status` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_state` varchar(255) NOT NULL,
  `address_zip` varchar(255) NOT NULL,
  `address_country` varchar(255) NOT NULL,
  `address_status` varchar(255) NOT NULL,
  `notify_version` varchar(255) NOT NULL,
  `verify_sign` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `mc_currency` varchar(255) NOT NULL,
  `mc_fee` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `product_id_array`, `payer_email`, `first_name`, `last_name`, `month`, `day`, `year`, `payment_date`, `mc_gross`, `payment_currency`, `receiver_email`, `payment_type`, `payment_status`, `txn_type`, `payer_status`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `address_status`, `notify_version`, `verify_sign`, `payer_id`, `mc_currency`, `mc_fee`, `txn_id`, `qty`) VALUES
(3, 3, '10', 'capstoneTest@gmail.com', 'test', 'account', '03', '08', '2017', '2017-03-07 18:23:04', '123.00', '', 'capstoneTest-facilitator@gmail.com', 'instant', 'Pending', 'cart', 'VERIFIED', '001', 'San Jose', 'CA', '50002', 'US', '', 'UNVERSIONED', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AYdzMHdxcQ0MoBjUi6eo5yguAf-v', 'TUZBW7N55UVH2', 'PHP', '123.00', '62N38974UP192673H', 1),
(4, 3, '10', 'capstoneTest@gmail.com', 'test', 'account', '03', '08', '2017', '2017-03-10 03:31:02', '2460.00', '', 'capstoneTest-facilitator@gmail.com', 'instant', 'Cancelled', 'cart', 'VERIFIED', '001', 'San Jose', 'CA', '50002', 'US', '', 'UNVERSIONED', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AZlJVDgbTHTA5oO7m1Ef8rCKIWkG', 'TUZBW7N55UVH2', 'PHP', '123.00', '9TJ22836RR194715C', 20),
(6, 3, '9', 'capstoneTest@gmail.com', 'test', 'account', '03', '09', '2017', '2017-03-10 03:34:28', '1100.00', '', 'capstoneTest-facilitator@gmail.com', 'instant', 'Cancelled', 'cart', 'VERIFIED', '001', 'San Jose', 'CA', '50002', 'US', '', 'UNVERSIONED', 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAa7r78Sn4-tqV5l1GoHXpw9X0XSk', 'TUZBW7N55UVH2', 'PHP', '550.00', '053621837E670284T', 2),
(11, 6, '10', 'mendozalaxus@yahoo.com', 'RR', 'Mendoza', '', '', '', '2017-03-24 03:32:03', '123', '', '', 'cod', 'Pending', '', '', '', '', '', '', '', '', '', '', '', 'PHP', '123', '1773052396', 1),
(12, 6, '10', 'mendozalaxus@yahoo.com', 'RR', 'Mendoza', '', '', '', '2017-03-24 03:46:55', '123', '', '', 'cod', 'Pending', '', '', '', '', '', '', '', '', '', '', '', 'PHP', '123', '1112809937', 1),
(13, 6, '9', 'mendozalaxus@yahoo.com', 'RR', 'Mendoza', '', '', '', '2017-03-24 04:13:17', '550', '', '', 'cod', 'Completed', '', '', '', '', '', '', '', '', '', '', '', 'PHP', '550', '2002881133', 1),
(14, 6, '10', 'mendozalaxus@yahoo.com', 'RR', 'Mendoza', '', '', '', '2017-03-26 17:19:30', '123', '', '', 'cod', 'Pending', '', '', '', '', '', '', '', '', '', '', '', 'PHP', '123', '1184942234', 1),
(15, 6, '10', 'mendozalaxus@yahoo.com', 'RR', 'Mendoza', '', '', '', '2017-03-26 17:20:04', '123', '', '', 'cod', 'Pending', '', '', '', '', '', '', '', '', '', '', '', 'PHP', '123', '1640458798', 1);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_bid_file`
--

CREATE TABLE IF NOT EXISTS `uploaded_bid_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `uploaded_bid_file`
--

INSERT INTO `uploaded_bid_file` (`id`, `bid_id`, `author_id`, `file_name`, `ext`, `active`, `created_date`) VALUES
(34, 46, 6, 'Practical Exam.pdf', 'pdf', 0, '2017-03-20 06:52:53'),
(35, 47, 6, '10266.pdf', 'pdf', 0, '2017-03-19 12:20:05'),
(36, 48, 6, '26995711901-539067804-ticket.pdf', 'pdf', 1, '2017-03-20 03:33:20'),
(37, 53, 6, '10266.pdf', 'pdf', 0, '2017-03-20 17:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_contract_file`
--

CREATE TABLE IF NOT EXISTS `uploaded_contract_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `uploaded_contract_file`
--

INSERT INTO `uploaded_contract_file` (`id`, `contract_id`, `file_name`, `ext`, `created_date`) VALUES
(10, 53, ' CPA1015ra_Mla_e.pdf', 'pdf', '2017-03-20 17:21:32'),
(11, 54, ' How_to_Clean_Install_CM13.pdf', 'pdf', '2017-03-20 17:23:25'),
(14, 53, '53-author-contract.pdf', 'pdf', '2017-03-23 18:04:16'),
(18, 54, '54-supplier-contract.pdf', 'pdf', '2017-03-23 18:18:43'),
(19, 0, '-author-contract.pdf', '', '2017-03-24 02:14:17'),
(20, 0, '-author-contract.pdf', '', '2017-03-24 02:14:54'),
(21, 0, '-author-contract.pdf', '', '2017-03-24 02:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_contract_template_file`
--

CREATE TABLE IF NOT EXISTS `uploaded_contract_template_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL,
  `ext` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `uploaded_contract_template_file`
--

INSERT INTO `uploaded_contract_template_file` (`id`, `file_name`, `type`, `ext`) VALUES
(7, 'author-contract.pdf', 'author', 'pdf'),
(8, 'supplier-contract.pdf', 'supplier', 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_supp_bid_file`
--

CREATE TABLE IF NOT EXISTS `uploaded_supp_bid_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `uploaded_supp_bid_file`
--

INSERT INTO `uploaded_supp_bid_file` (`id`, `bid_id`, `supplier_id`, `file_name`, `ext`, `active`, `created_date`) VALUES
(15, 54, 3, 'Practical Exam.pdf', 'pdf', 0, '2017-03-20 17:22:54'),
(16, 55, 6, 'contracttemplate-author-contract.pdf', 'pdf', 0, '2017-03-26 16:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usn` varchar(50) NOT NULL,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(60) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(128) NOT NULL,
  `activate` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `date` date NOT NULL,
  `block` int(11) NOT NULL,
  `pic` int(11) NOT NULL,
  `ext` varchar(5) NOT NULL,
  `admin` int(11) NOT NULL,
  `user_type` int(10) NOT NULL,
  `retrieve_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usn`, `fname`, `lname`, `birthday`, `address`, `contact`, `email`, `password`, `activate`, `code`, `date`, `block`, `pic`, `ext`, `admin`, `user_type`, `retrieve_code`) VALUES
(1, 'rjemindo', 'Russell James', 'Mindo', '1955-10-15', 'Antipolo', 3934875, 'rje.mindo@gmail.com', '4794b24d2508fd381736b30aa4e3a886', 1, 67591688, '2013-11-28', 0, 0, '', 0, 0, ''),
(3, 'rr', 'Roxel', 'Mendoza', '1994-03-03', 'Tarlac', 2147483647, 'mendozalaxus@gmail.com', '3b5e13941ae2b58ed925c4b69396af02', 1, 0, '2017-03-06', 0, 0, '', 0, 3, ''),
(4, 'jeydah1231', 'Jedidiah Ysis', 'Gutierrez', '1993-06-20', '9 Agnes St., Sta. Teresita Village Marikina', 2147483647, 'jeydahgutierrez0910@gmail.com', '16f26d92e4c585a66ed58f7bb2d0f919', 1, 97629123, '2017-02-11', 0, 0, '', 0, 0, ''),
(6, 'rr2', 'RR', 'Mendoza', '1956-01-17', 'Mandaluyong', 2147483647, 'mendozalaxus@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 85639105, '2017-03-09', 0, 0, '', 0, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'client'),
(2, 'author'),
(3, 'supplier'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_uploads`
--

CREATE TABLE IF NOT EXISTS `user_uploads` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` text,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
