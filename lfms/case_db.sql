-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 29, 2019 at 11:07 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `case_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

DROP TABLE IF EXISTS `archives`;
CREATE TABLE IF NOT EXISTS `archives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `date_uploaded` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `name`, `document`, `date_uploaded`) VALUES
(2, 'Wamp usage', 'instructions_for_use.pdf', '2019-09-27'),
(3, 'Word doc sample', 'MenEngage Accountability Toolkit_ final version December 8_2017 (SN).docx', '2019-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `billed_fee`
--

DROP TABLE IF EXISTS `billed_fee`;
CREATE TABLE IF NOT EXISTS `billed_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(200) NOT NULL,
  `file_number` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `invoice_number` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `total` varchar(200) NOT NULL,
  `paid` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billed_fee`
--

INSERT INTO `billed_fee` (`id`, `client_name`, `file_number`, `subject`, `invoice_number`, `date`, `total`, `paid`) VALUES
(1, 'PHC/SANKU', '001/R/2018', 'Retainer', '001/AC/R/01/18', '2018-01-20', '600', '600'),
(2, 'Uwanyirigira Phaina', '002/G/2018', 'Divorce', '002/AC/G/01/18', '2018-01-24', '2500000', '1000000'),
(3, 'Kagaba Saidi', '003/G/2018', 'Divorce', '003/AC/G/01/18', '2018-01-25', '600000', '250000');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `dossier` varchar(150) NOT NULL,
  `institution` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `nature` varchar(150) NOT NULL,
  `its_date` date NOT NULL,
  `lead_counsel` varchar(150) NOT NULL,
  `observation` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `user_id`, `dossier`, `institution`, `status`, `nature`, `its_date`, `lead_counsel`, `observation`) VALUES
(1, '12', 'Sample Calendar one', 'TB Nyamata', 'Fond', 'Civil - Divorce', '2018-09-26', 'Peter Drake', ''),
(2, '12', 'Mukashema et crts', 'HC Kigali', 'Fond', 'Criminal - Civil party', '2018-09-27', 'Peter Drake', ''),
(3, '12', 'Tabaruka Dieudonne v. Gicumbi District', 'TGI Gicumbi', 'Fond', 'Administrative', '2018-05-31', 'Peter Drake', ''),
(4, '12', 'Mupende Diocles v. Nyirabahizi Gaudence', 'Court of Appeal', 'Fond', 'Civil', '2018-09-27', 'Peter Drake', ''),
(5, '12', 'Minintco v. Dresoceco', 'Supreme Court', 'Fond', 'Intellectual Property', '2018-06-05', 'Peter Drake', ''),
(6, '12', 'Gakwandi v. Wellars', 'HC Kigali', 'Mise en etat', 'Civil', '2018-09-18', 'Drake Peter', '');

-- --------------------------------------------------------

--
-- Table structure for table `case_history`
--

DROP TABLE IF EXISTS `case_history`;
CREATE TABLE IF NOT EXISTS `case_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` varchar(100) NOT NULL,
  `case_no` varchar(200) NOT NULL,
  `case_subject` varchar(200) NOT NULL,
  `file_number` varchar(200) NOT NULL,
  `urega` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `open_date` date NOT NULL,
  `closed_date` date NOT NULL,
  `leader` varchar(200) NOT NULL,
  `institution` varchar(200) NOT NULL,
  `date_status_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `case_infos`
--

DROP TABLE IF EXISTS `case_infos`;
CREATE TABLE IF NOT EXISTS `case_infos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `case_no` varchar(250) NOT NULL,
  `case_subject` varchar(200) NOT NULL,
  `file_number` varchar(250) NOT NULL,
  `urega` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `case_date` date NOT NULL,
  `closed_date` date NOT NULL,
  `leader` varchar(100) NOT NULL,
  `instutition` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `case_infos`
--

INSERT INTO `case_infos` (`id`, `user_id`, `case_no`, `case_subject`, `file_number`, `urega`, `category`, `case_date`, `closed_date`, `leader`, `instutition`, `status`) VALUES
(1, '12', '000', 'IP / Mark protection', '000', 'Minintco', 'Commercial', '2018-07-17', '0000-00-00', 'Cyridion Nsengumuremyi', 'RRA / RDB / MINICOM / RPD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashflow`
--

DROP TABLE IF EXISTS `cashflow`;
CREATE TABLE IF NOT EXISTS `cashflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paid_by` varchar(200) NOT NULL,
  `paid_to` varchar(200) NOT NULL,
  `transaction` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(200) NOT NULL,
  `credited_rwf` varchar(200) NOT NULL,
  `debited_rwf` varchar(200) NOT NULL,
  `credited_usd` varchar(200) NOT NULL,
  `debited_usd` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashflow`
--

INSERT INTO `cashflow` (`id`, `paid_by`, `paid_to`, `transaction`, `date`, `reference`, `credited_rwf`, `debited_rwf`, `credited_usd`, `debited_usd`) VALUES
(101, 'Abayo', 'Abayo', 'Supplies', '2018-09-05', 'Supplies', '', '15200', '', ''),
(102, 'Abayo', 'Abayo', 'Payment', '2018-08-30', 'Payment', '1000000', '', '', ''),
(103, 'Abayo', 'Abayo', 'Payment', '2018-09-05', '', '1000000', '', '', ''),
(104, 'Abayo', 'Abayo', '1st Instalment Mandera v. BNR', '2018-08-03', '', '500000', '', '', ''),
(105, 'Abayo', 'Abayo', 'Retainer June - July 18', '2018-08-06', '', '1000000', '', '', ''),
(106, 'Abayo', 'Abayo', 'Pay Jul 18', '2018-08-07', 'Pay Jul 18', '', '1103000', '', ''),
(107, 'Abayo', 'Abayo', 'Pay Jul 18', '2018-08-07', 'Pay Jul 18', '', '307000', '', ''),
(108, 'Abayo', 'Abayo', 'Out of cash advance non-repayable', '2018-09-01', 'Out of cash advance non-repayable', '', '1000000', '', ''),
(109, 'Abayo', 'Abayo', 'Cyridion training', '2018-08-09', 'Cyridion training', '', '', '', '275'),
(110, 'Abayo', 'Abayo', 'Pay Jul 18', '2018-08-01', 'Pay Jul 18', '', '150000', '', ''),
(111, 'Abayo', 'Abayo', 'Fuel', '2018-08-01', 'Fuel', '', '400000', '', ''),
(112, 'Abayo', 'Abayo', 'Tax', '2018-08-07', 'Tax', '', '75000', '', ''),
(113, 'Abayo', 'Abayo', '40% participation fee RGB ECOS', '2018-09-06', '40% participation fee RGB ECOS', '288000', '', '', ''),
(114, 'Abayo', 'Abayo', 'Out of cash advance non-repayable', '2018-09-06', 'Out of cash advance non-repayable', '', '288000', '', ''),
(115, 'Abayo', 'Abayo', 'Notary service', '2018-09-07', 'Notary service', '11700', '', '', ''),
(116, 'Abayo', 'Abayo', 'Notary service', '2018-09-07', 'Notary service', '76700', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Commercial', 'Commercial'),
(2, 'Intellectual property', 'Intellectual property'),
(3, 'Retainers', 'Retainers'),
(4, 'General', 'General'),
(5, 'Tax', 'Tax'),
(6, 'Business', 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `national_id` varchar(200) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `amount_paid` varchar(200) NOT NULL,
  `second_klient_info` varchar(200) NOT NULL,
  `advocat` varchar(200) NOT NULL,
  `opposing` varchar(200) NOT NULL,
  `quality` varchar(200) NOT NULL,
  `opening_date` date NOT NULL,
  `excepted_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `names`, `address`, `phone`, `email`, `national_id`, `total_amount`, `amount_paid`, `second_klient_info`, `advocat`, `opposing`, `quality`, `opening_date`, `excepted_date`) VALUES
(1, 'Uwanyirigira Phain', 'Kigali, Kicukiro, Niboye', '0785369038', '', '', '2500000', '1500000', '', 'Habimana Pie', 'Bayingana Alexis', 'Applicant', '2018-01-24', '0000-00-00'),
(2, 'KAGABA Saidi', 'Kigali - Juba', '', '', '', '600000', '100000', '', 'Habimana Pie', 'Sabukwigura Lydia', 'Applicant', '2018-01-25', '0000-00-00'),
(3, 'Uwamariya Dorothee', 'Kigali, Gatenga', '0783503165', '', '', '0', '0', '', 'Habimana Pie', 'D\'office', 'Applicant', '2018-01-29', '0000-00-00'),
(4, 'Myasiro Joseph', 'Kigali, Gisozi', '0788479076, 0789428970', 'myjoseph31@gmail.com', '', '0', '0', '', 'Habimana Pie', 'Kabalisa Theogene', 'Defendant', '2018-01-29', '0000-00-00'),
(5, 'Minintco', 'Kigali, Nyarugenge', '0', '', '', '0', '0', '', 'Cyridion Nsengumuremyi', 'Madaka', 'Applicant', '2018-02-15', '0000-00-00'),
(6, 'Minintco', 'Nyarugenge', '07', '', '', '0', '0', '', 'Cyridion Nsengumuremyi', 'Unitex', 'Applicant', '2018-02-15', '0000-00-00'),
(7, 'Bavugamenshi Theobald', 'Kigali', '0788307319', '', '', '0', '0', '', 'Habimana Pie', 'Mutumwinka Seraphine', 'Defendant', '2018-02-15', '0000-00-00'),
(8, 'Mukabatesi Liliane', 'Bruxelles, Kigali', 'nm ', '', '', '0', '0', '', 'Habimana Pie', 'Ntiyamira Jean Leonard', 'Applicant', '2018-03-05', '0000-00-00'),
(9, 'Keza Justine', 'UK', '44', '', '', '0', '1000000', '', 'Habimana Pie', 'Kabandize Fred', 'Applicant', '2018-04-18', '0000-00-00'),
(10, 'Niringiyimana Theogene', 'Kigali', 'bhg', '', '', '0', '0', '', 'Cyridion Nsengumuremyi', 'LT Global', 'Defendant', '2018-04-09', '0000-00-00'),
(11, 'Tabaruka Dieudonne', 'Gicumbi', 'nhj', '', '', '0', '0', '', 'Habimana Pie', 'Gicumbi district', 'Applicant', '2018-03-06', '0000-00-00'),
(12, 'Minintco', 'Nyarugenge', 'mjk', '', '', '0', '0', '', 'Cyridion Nsengumuremyi', 'Criminal', 'Applicant', '2018-03-19', '0000-00-00'),
(13, 'Manonko Emmanuel', 'Bujumbura', 'mkn', '', '', '0', '0', '', 'Habimana Pie', 'Rubega Bonane Eric', 'Applicant', '2018-03-21', '0000-00-00'),
(14, 'Niyonzima Charles', 'Nyanza', 'hjn', '', '', '0', '0', '', 'Cyridion Nsengumuremyi', 'MP', 'Applicant', '2018-03-23', '0000-00-00'),
(15, 'Minintco', 'Nyarugenge', 'nhg', '', '', '0', '0', '', 'Cyridion Nsengumuremyi', 'Drocesoco', 'Defendant', '2018-04-09', '0000-00-00'),
(16, 'Minintco', 'Kigali', '0788421427', 'deonzigira@gmail.com', '', '0', '501000', '', 'Cyridion Nsengumuremyi', 'DOBUSJES', 'Applicant', '2018-07-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `client_payment_info`
--

DROP TABLE IF EXISTS `client_payment_info`;
CREATE TABLE IF NOT EXISTS `client_payment_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(200) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `client_phone` varchar(200) NOT NULL,
  `total_amount` varchar(200) NOT NULL,
  `last_paid` varchar(200) NOT NULL,
  `amount_due` varchar(200) NOT NULL,
  `due_date` date NOT NULL,
  `instalment` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'NOT PAID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_payment_info`
--

INSERT INTO `client_payment_info` (`id`, `client_id`, `client_name`, `client_phone`, `total_amount`, `last_paid`, `amount_due`, `due_date`, `instalment`, `status`) VALUES
(1, '1', 'Uwanyirigira Phain', '0785369038', '2500000', '', '1000000', '2018-05-05', '2nd Instalment', 'NOT PAID'),
(2, '9', 'Keza Justine', '44', '0', '1000000', '1000000', '2018-04-18', '1st Instalment', 'ADVANCE'),
(3, '9', 'Keza Justine', '44', '0', '', '1000000', '2018-04-18', '1st Instalment', 'NOT PAID'),
(4, '16', 'Uwanyirigira Phain', '0782626834', '0', '', '1000000', '2018-10-30', '1st Instalment', 'NOT PAID'),
(5, '16', 'Minintco', '2342342434', '0', '601540', '1000000', '2018-09-30', '2nd Instalment', 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `transaction_no` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_entered` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `amount`, `transaction_no`, `category`, `description`, `date_entered`) VALUES
(8, 'Aime', '300000', '1', 'Salary', 'Advance', '2019-09-20'),
(9, 'Transport', '3000', '2', 'Petty cash', 'Transport of Juan', '2019-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

DROP TABLE IF EXISTS `expense_category`;
CREATE TABLE IF NOT EXISTS `expense_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount_due` varchar(200) DEFAULT NULL,
  `balance` varchar(200) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, `amount_due`, `balance`, `name`, `description`) VALUES
(1, '30000', '30000', 'Taxes', 'Taxes'),
(2, '300000', '297000', 'Petty cash', 'Petty cash'),
(3, '1000000', '1000000', 'General', 'General'),
(6, '10000000', '9700000', 'Salary', 'Salary of employee');

-- --------------------------------------------------------

--
-- Table structure for table `instalments`
--

DROP TABLE IF EXISTS `instalments`;
CREATE TABLE IF NOT EXISTS `instalments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instalments`
--

INSERT INTO `instalments` (`id`, `name`, `description`) VALUES
(1, '1st Instalment', '1st Instalment'),
(2, '2nd Instalment', '2nd Instalment'),
(3, '3rd Instalment', '3rd Instalment'),
(4, '4th Instalment', '4th Instalment'),
(5, '5th Instalment', '5th Instalment'),
(6, '6th Instalment', '6th Instalment'),
(7, '7th Instalment', '7th Instalment'),
(8, '8th Instalment', '8th Instalment'),
(9, '9th Instalment', '9th Instalment'),
(10, '10th Instalment', '10th Instalment'),
(11, '11th Instalment', '11th Instalment'),
(12, '12th Instalment', '12th Instalment');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `permissions` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `user_id`, `permissions`) VALUES
(150, '1', '2'),
(151, '1', '3'),
(152, '1', '4'),
(153, '1', '5'),
(154, '1', '6'),
(155, '1', '7'),
(217, '1', '8'),
(218, '1', '9'),
(220, '12', '2'),
(221, '12', '3'),
(222, '12', '4'),
(223, '12', '5'),
(224, '12', '6'),
(225, '12', '7'),
(226, '12', '8'),
(227, '12', '9'),
(228, '13', '2'),
(229, '13', '3'),
(230, '13', '4'),
(231, '13', '5'),
(232, '13', '6'),
(233, '13', '7'),
(234, '13', '8'),
(235, '13', '9'),
(236, '1', '10'),
(237, '12', '10'),
(238, '14', '9'),
(239, '14', '10'),
(240, '13', '10');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `open_qty` varchar(250) NOT NULL,
  `minimum_qty` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `open_qty`, `minimum_qty`, `price`, `status`, `category`, `date`) VALUES
(3, 'Papers', '10', '10', '5000', 'New', 'Consumable', '2019-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `retainers`
--

DROP TABLE IF EXISTS `retainers`;
CREATE TABLE IF NOT EXISTS `retainers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `file_number` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `method` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `lead` varchar(250) NOT NULL,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retainers`
--

INSERT INTO `retainers` (`id`, `name`, `file_number`, `amount`, `method`, `start_date`, `end_date`, `lead`, `status`) VALUES
(1, 'PHC / SANKU', '001/R/2018', '600 USD', 'Monthly', '2017-12-09', '2018-12-09', 'Habimana Pie', 'In force'),
(2, 'Kigali Coach Tours & Travel Ltd', '002/R/2018', '500,000', 'Monthly', '2018-05-15', '2019-05-15', 'Cyridion Nsengumuremyi', 'In force');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `description`) VALUES
(1, 'New Cases', 'Urushya'),
(2, 'Won Cases', 'Urwatsinze'),
(3, 'Hearing Cases', 'Urwaburanywe'),
(4, 'Adjournment Cases', 'Urwasubitswe'),
(5, 'Lost Cases', 'Urwatsinzwe');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(150) NOT NULL,
  `tasked_to` varchar(150) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `open_date` date NOT NULL,
  `ecd` date NOT NULL,
  `cd` date DEFAULT NULL,
  `observation` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `tasked_to`, `phone`, `open_date`, `ecd`, `cd`, `observation`) VALUES
(4, 'Draft call for Assistant Researcher recruitment', 'Van Opfern', '0782816597', '2019-09-20', '2019-09-20', '2019-09-19', 'That is important dude!!!'),
(6, 'Draft call for Assistant Researcher recruitment', 'Benjemin', '0788580707', '2019-09-20', '2019-10-11', NULL, 'Thats crucial dude');

-- --------------------------------------------------------

--
-- Table structure for table `unbilled_fee`
--

DROP TABLE IF EXISTS `unbilled_fee`;
CREATE TABLE IF NOT EXISTS `unbilled_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(200) NOT NULL,
  `file_number` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `total` varchar(200) NOT NULL,
  `paid` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unbilled_fee`
--

INSERT INTO `unbilled_fee` (`id`, `client_name`, `file_number`, `subject`, `date`, `total`, `paid`) VALUES
(1, 'Kalimba Jean d\'Amour', 'N/A', 'Consultation', '2018-01-15', '50000', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `permission` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `token` varchar(200) NOT NULL DEFAULT '123456789qwertyuiopasdfghjklzxcvbnm',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `permission`, `status`, `token`) VALUES
(1, 'uweaime@gmail.com', 'Uwe Aime Van', 'fcb8c6fe3c375cf41265e84f18328d3c9b9c0466', '1', 1, 'cqst9gefzk'),
(14, 'musoneraellena@gmail.com', 'Musonera Ellen', 'fcb8c6fe3c375cf41265e84f18328d3c9b9c0466', '3', 1, '123456789qwertyuiopasdfghjklzxcvbnm'),
(16, 'van@gmail.com', 'Van Van', 'fcb8c6fe3c375cf41265e84f18328d3c9b9c0466', '3', 1, '123456789qwertyuiopasdfghjklzxcvbnm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
