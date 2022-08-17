-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2019 at 04:07 AM
-- Server version: 10.2.12-MariaDB-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clienemo_business_accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'accounts are like income,other_income,expense,cost_of_good-sold,other_expense,current_asset,non_current_asset,fixed_assets,accounts_receivable,bank,other_non_current_asset,credit_card,other_current_liability,equity,non-current_liability,account_receivable,account_payble',
  `nature` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nature like: Income, Expense, Assets Liability ,  Equity and 6 for COGS',
  `account_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `export_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_account_of` int(11) NOT NULL,
  `default_tax_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_opening_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ibt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `financial_institute` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bsb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opening_balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `current_balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `last_reconciliation_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `last_reconciliation_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_name`, `account_type`, `nature`, `account_code`, `export_code`, `account_description`, `sub_account_of`, `default_tax_code`, `visibility_status`, `account_opening_date`, `ibt`, `created_date`, `ip_address`, `timestamp`, `financial_institute`, `account_holder_name`, `bsb`, `account_number`, `apca`, `opening_balance`, `current_balance`, `last_reconciliation_amount`, `last_reconciliation_date`) VALUES
(1, 'Income', 'income', 'income', '4-0000', '', 'Income', 0, '2', 'active', '', '', '2016-09-01', '182.64.132.9', '2016-09-01 13:28:59', '', '', '', '', '', '0', '0', '0', ''),
(2, 'Consulting Revenue', 'income', 'income', '', '', '', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:13', '', '', '', '', '', '0', '0', '0', ''),
(4, 'Other Fees and Charges ', 'income', 'income', '4-4040', '', 'Other Fees and Charges ', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-29 09:37:42', '', '', '', '', '', '0', '0', '0', ''),
(5, 'Assets', 'current_asset', 'assets', '1-0000', '', 'Assets', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:19', '', '', '', '', '', '0', '0', '0', ''),
(6, 'GST Payable', 'other_current_liability', 'liabilities', '2-1150', '895', 'GST Payable', 0, '2', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:21', '', '', '', '', '', '0', '0', '0', ''),
(7, 'Meals', 'expense', 'expense', '', '', 'Meals for work trips', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:23', '', '', '', '', '', '0', '0', '0', ''),
(8, 'Current Assets', 'current_asset', 'assets', '1-1100', '', 'Current Assets', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:25', '', '', '', '', '', '0', '0', '0', ''),
(10, 'Accounting Fees', 'expense', 'expense', '6-0010', '300', 'Accounting Fees', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-09-01 13:29:03', '', '', '', '', '', '0', '0', '0', ''),
(11, 'Undeposited Funds', 'current_asset', 'assets', '1-1160', '1-1160', 'Undeposited Funds', 0, '1', 'active', '', '', '2016-08-31', '182.64.72.187', '2016-08-31 12:59:00', '', '', '', '', '', '0', '0', '0', ''),
(12, 'Bank - NAB Business Credit Card', 'bank', 'liabilities', '', '', 'System account for bank account \'NAB Business Credit Card\'', 0, '1', 'active', '03-08-2016', '', '2016-08-31', '182.64.72.187', '2016-09-01 13:29:06', '', '', '', '', '', '0', '0', '0', ''),
(13, 'Assets Purchased <$5,000', 'expense', 'expense', '6-0040', '', 'Assets Purchased <$5,000', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:35', '', '', '', '', '', '0', '0', '0', ''),
(14, 'Current Financial Assets', 'current_asset', 'assets', '1-1200', '', 'Current Financial Assets', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-29 09:37:53', '', '', '', '', '', '0', '0', '0', ''),
(15, 'Opening Balance Equity', 'equity', 'equity', '3-0100', '30000', 'Opening Balance Equity', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:39', '', '', '', '', '', '0', '0', '0', ''),
(16, 'Bank - ANZ', 'bank', 'assets', '', '680', 'System account for bank account \'ANZ\'', 0, '1', 'active', '', 'ibt', '2016-08-31', '182.64.72.187', '2016-09-01 13:29:12', '1', 'durgesh666666', 'BSB-1666666', '6666666', 'apca-6666666', '0', '0', '0', ''),
(17, 'GST Collected', 'other_current_liability', 'liabilities', '2-1155', '895.00', 'GST Collected', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-30 10:36:17', '', '', '', '', '', '0', '0', '0', ''),
(18, 'Retained Earnings Surplus/(Accumulated Losses)', 'equity', 'equity', '3-1000', '638', 'Retained Earnings Surplus/(Accumulated Losses)', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:45', '', '', '', '', '', '0', '0', '0', ''),
(19, 'Drawings', 'equity', 'equity', '', '', '', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-05 12:20:47', '', '', '', '', '', '0', '0', '0', ''),
(20, 'Bank - NAB Business Account', 'bank', 'assets', '', '680', 'System account for bank account \'NAB Business Account\'', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-09-01 13:29:14', '', '', '', '', '', '0', '0', '0', ''),
(21, 'GST Paid', 'other_current_liability', 'liabilities', '2-1160', '895.99', 'GST Paid', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-09-01 13:29:19', '', '', '', '', '', '0', '0', '0', ''),
(22, 'Sales', 'income', 'income', '4-4010', '230', 'Sales', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-09-01 13:29:22', '', '', '', '', '', '0', '0', '0', ''),
(23, 'Cost of Goods Sold', 'expense', 'expense', '', '', '', 0, '1', 'active', '', '', '2016-07-04', '122.162.208.124', '2016-08-29 09:38:19', '', '', '', '', '', '0', '0', '0', ''),
(25, 'Other Income', 'income', 'income', '4-5000', '', 'Other Income ', 0, '1', 'active', '', '', '2016-07-05', '182.64.89.222', '2016-08-05 12:21:00', '', '', '', '', '', '0', '0', '0', ''),
(32, 'tea expence', 'expense', 'expense', 'acc202', '', 'tea expence', 0, '1', 'active', '', '', '2016-07-05', '182.64.89.222', '2016-08-05 12:21:02', '', '', '', '', '', '0', '0', '0', ''),
(34, 'anthew check', 'fixed_asset', 'assets', '0001A-A', '0001B-B', 'It is to check account', 0, '4', 'active', '', '', '2016-07-07', '110.227.145.4', '2016-08-05 12:21:05', '', '', '', '', '', '0', '0', '0', ''),
(36, 'Trade debtors', 'current_asset', 'assets', '1-3100', '1-3100', 'Trade debtors', 0, '20', 'active', '', '', '2016-07-08', '182.77.38.240', '2016-09-01 13:29:25', '', '', '', '', '', '0', '0', '0', ''),
(37, 'Trade Creditors', 'other_current_liability', 'liabilities', '2-2100', '2-2100', 'Trade Creditors', 0, '20', 'active', '', '', '2016-07-08', '182.77.38.240', '2016-08-30 12:01:50', '', '', '', '', '', '0', '0', '0', ''),
(38, 'Companinon', 'non-current_liability', 'liabilities', 'asdfasdf', 'asdfasdfasdf', 'asdfasdf', 0, '', 'active', '', '', '2016-08-30', '182.64.177.2', '2016-08-30 08:21:00', '', '', '', '', '', '0', '0', '0', ''),
(39, 'Purchase of New Items', 'expense', 'expense', '123123123', '', '', 0, '', 'active', '', '', '2018-12-09', '103.255.5.31', '2018-12-09 04:50:24', '', '', '', '', '', '0', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `account_transaction`
--

CREATE TABLE `account_transaction` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:debit or creadit',
  `transaction_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reconcile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'reconcile like :yes or no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `username`, `event`, `created_date`, `ip_address`, `timestamp`) VALUES
(1, 1, '', 'Login', '2018-04-02', '192.168.1.40', '2018-04-02 06:13:23'),
(2, 1, '', 'Logout', '2018-04-02', '192.168.1.40', '2018-04-02 06:26:41'),
(3, 2, '', 'Login', '2018-04-02', '192.168.1.40', '2018-04-02 06:26:55'),
(4, 2, '', 'Create a new Contact  (prabha)', '2018-04-02', '192.168.1.40', '2018-04-02 06:59:13'),
(5, 2, '', 'Create a new Contact  (logesh)', '2018-04-02', '192.168.1.40', '2018-04-02 07:11:36'),
(6, 2, '', 'Create a new Contact  (Kavitha)', '2018-04-02', '192.168.1.40', '2018-04-02 07:15:36'),
(7, 2, '', 'Create a new Contact  (jansi)', '2018-04-02', '192.168.1.40', '2018-04-02 07:17:17'),
(8, 2, '', 'Add new project  (Demo project)', '2018-04-02', '192.168.1.40', '2018-04-02 07:19:28'),
(9, 2, '', 'Update project  ()', '2018-04-02', '192.168.1.40', '2018-04-02 07:21:23'),
(10, 2, '', 'Logout', '2018-04-02', '192.168.1.40', '2018-04-02 07:27:51'),
(11, 4, '', 'Login', '2018-04-02', '192.168.1.40', '2018-04-02 07:29:48'),
(12, 4, '', 'Create a new project (aaa)', '2018-04-02', '192.168.1.40', '2018-04-02 07:37:47'),
(13, 4, '', 'Create a new item  (aaaa)', '2018-04-02', '192.168.1.40', '2018-04-02 07:39:30'),
(14, 4, '', 'Create journal  (GJ000001)', '2018-04-02', '192.168.1.40', '2018-04-02 07:46:53'),
(15, 4, '', 'Create a new project (aaaaaaa)', '2018-04-02', '192.168.1.40', '2018-04-02 08:49:02'),
(16, 4, '', 'Create a new project (dfsf)', '2018-04-02', '192.168.1.40', '2018-04-02 08:50:55'),
(17, 4, '', 'Login', '2018-04-02', '192.168.1.40', '2018-04-02 09:07:06'),
(18, 1, '', 'Login', '2018-04-02', '192.168.1.40', '2018-04-02 09:07:41'),
(19, 1, '', 'Login', '2018-04-02', '192.168.1.40', '2018-04-02 09:26:09'),
(20, 1, '', 'Login', '2018-04-02', '192.168.1.46', '2018-04-02 09:38:05'),
(21, 2, '', 'Login', '2018-04-02', '192.168.1.40', '2018-04-02 10:04:21'),
(22, 1, '', 'Logout', '2018-04-02', '192.168.1.40', '2018-04-02 10:11:27'),
(23, 1, '', 'Login', '2018-04-02', '110.227.230.183', '2018-04-02 11:58:39'),
(24, 1, '', 'Logout', '2018-04-02', '110.227.230.183', '2018-04-02 11:59:43'),
(25, 4, '', 'Login', '2018-04-02', '110.227.230.183', '2018-04-02 12:00:07'),
(26, 4, '', 'Login', '2018-04-02', '110.227.230.183', '2018-04-02 12:15:31'),
(27, 1, '', 'Login', '2018-04-02', '49.207.176.90', '2018-04-02 12:25:12'),
(28, 1, '', 'Login', '2018-04-02', '110.227.230.183', '2018-04-02 12:25:22'),
(29, 4, '', 'Logout', '2018-04-02', '110.227.230.183', '2018-04-02 12:50:29'),
(30, 1, '', 'Login', '2018-04-03', '110.227.230.183', '2018-04-03 13:20:49'),
(31, 1, '', 'Logout', '2018-04-03', '110.227.230.183', '2018-04-03 13:26:41'),
(32, 1, '', 'Login', '2018-04-03', '110.227.230.183', '2018-04-03 13:31:21'),
(33, 1, '', 'Logout', '2018-04-03', '110.227.230.183', '2018-04-03 13:33:10'),
(34, 1, '', 'Login', '2018-04-08', '171.61.233.142', '2018-04-09 05:30:41'),
(35, 4, '', 'Login', '2018-04-13', '183.82.39.249', '2018-04-13 08:00:53'),
(36, 1, '', 'Login', '2018-04-13', '183.82.39.249', '2018-04-13 08:01:10'),
(37, 1, '', 'Logout', '2018-04-13', '183.82.39.249', '2018-04-13 08:01:45'),
(38, 1, '', 'Login', '2018-04-13', '110.227.225.44', '2018-04-13 09:12:44'),
(39, 1, '', 'Login', '2018-04-13', '110.227.225.44', '2018-04-13 10:19:25'),
(40, 1, '', 'Login', '2018-04-13', '110.227.225.44', '2018-04-13 11:21:21'),
(41, 1, '', 'Login', '2018-04-13', '110.227.225.44', '2018-04-13 12:02:44'),
(42, 1, '', 'Login', '2018-04-23', '183.82.39.249', '2018-04-23 09:56:50'),
(43, 1, '', 'Login', '2018-05-07', '122.164.107.142', '2018-05-07 08:06:00'),
(44, 4, '', 'Login', '2018-05-07', '122.164.107.142', '2018-05-07 08:10:21'),
(45, 4, '', 'Login', '2018-05-07', '42.111.129.17', '2018-05-08 01:56:00'),
(46, 4, '', 'Login', '2018-05-07', '122.178.22.8', '2018-05-08 04:56:35'),
(47, 1, '', 'Login', '2018-06-02', '183.82.38.235', '2018-06-02 12:34:29'),
(48, 1, '', 'Logout', '2018-06-02', '183.82.38.235', '2018-06-02 12:35:25'),
(49, 4, '', 'Login', '2018-06-02', '183.82.38.235', '2018-06-02 12:35:45'),
(50, 1, '', 'Login', '2018-06-02', '171.61.235.19', '2018-06-02 12:38:34'),
(51, 4, '', 'Login', '2018-06-11', '220.255.127.198', '2018-06-11 07:12:21'),
(52, 4, '', 'Login', '2018-06-11', '220.255.127.198', '2018-06-11 07:17:28'),
(53, 1, '', 'Login', '2018-06-13', '175.101.114.148', '2018-06-13 13:26:09'),
(54, 1, '', 'Add an item (RALLI MAX)', '2018-06-13', '175.101.114.148', '2018-06-13 13:27:58'),
(55, 4, '', 'Login', '2018-07-29', '27.4.56.203', '2018-07-29 17:30:54'),
(56, 4, '', 'Create a new item  (Test)', '2018-07-29', '27.4.56.203', '2018-07-29 17:33:34'),
(57, 1, '', 'Login', '2018-07-30', '101.109.105.40', '2018-07-30 15:41:08'),
(58, 1, '', 'Logout', '2018-07-30', '64.233.173.56', '2018-07-30 15:43:51'),
(59, 4, '', 'Login', '2018-07-30', '101.109.105.40', '2018-07-30 15:45:06'),
(60, 1, '', 'Login', '2018-07-31', '118.173.5.49', '2018-07-31 13:14:34'),
(61, 1, '', 'Logout', '2018-07-31', '64.233.173.56', '2018-07-31 13:15:45'),
(62, 4, '', 'Login', '2018-07-31', '118.173.5.49', '2018-07-31 13:15:55'),
(63, 4, '', 'Login', '2018-08-02', '154.160.23.236', '2018-08-02 16:38:19'),
(64, 1, '', 'Login', '2018-08-07', '151.82.87.136', '2018-08-07 10:52:17'),
(65, 4, '', 'Login', '2018-08-10', '122.174.247.40', '2018-08-10 13:41:57'),
(66, 4, '', 'Logout', '2018-08-10', '122.174.247.40', '2018-08-10 13:42:28'),
(67, 1, '', 'Login', '2018-08-10', '122.174.247.40', '2018-08-10 13:42:36'),
(68, 4, '', 'Login', '2018-08-11', '39.50.104.85', '2018-08-11 15:29:59'),
(69, 4, '', 'Login', '2018-08-11', '213.205.198.248', '2018-08-11 18:11:20'),
(70, 1, '', 'Login', '2018-08-13', '202.69.15.70', '2018-08-13 16:02:26'),
(71, 1, '', 'Create a new Contact  (A)', '2018-08-13', '202.69.15.70', '2018-08-13 16:06:27'),
(72, 4, '', 'Login', '2018-08-16', '49.207.186.69', '2018-08-17 06:43:12'),
(73, 1, '', 'Login', '2018-08-18', '161.123.69.92', '2018-08-18 11:00:00'),
(74, 4, '', 'Login', '2018-08-30', '130.193.223.44', '2018-08-30 09:07:49'),
(75, 4, '', 'Logout', '2018-08-30', '130.193.223.44', '2018-08-30 09:13:27'),
(76, 4, '', 'Login', '2018-09-07', '47.30.164.246', '2018-09-07 09:35:34'),
(77, 4, '', 'Login', '2018-09-07', '183.83.121.133', '2018-09-07 13:25:50'),
(78, 4, '', 'Login', '2018-09-07', '157.35.241.48', '2018-09-08 04:55:29'),
(79, 4, '', 'Login', '2018-09-08', '157.35.252.133', '2018-09-08 08:36:05'),
(80, 4, '', 'Login', '2018-09-10', '111.125.208.121', '2018-09-10 19:40:22'),
(81, 4, '', 'Logout', '2018-09-10', '111.125.208.121', '2018-09-10 19:44:01'),
(82, 1, '', 'Login', '2018-09-10', '111.125.208.121', '2018-09-10 19:44:55'),
(83, 1, '', 'Logout', '2018-09-10', '111.125.208.121', '2018-09-10 19:48:48'),
(84, 4, '', 'Login', '2018-09-15', '122.164.108.108', '2018-09-15 08:00:59'),
(85, 1, '', 'Login', '2018-09-29', '47.30.227.126', '2018-09-29 12:53:25'),
(86, 4, '', 'Login', '2018-09-29', '103.46.201.223', '2018-09-29 15:34:06'),
(87, 4, '', 'Login', '2018-10-01', '47.30.135.15', '2018-10-01 09:36:35'),
(88, 4, '', 'Login', '2018-10-11', '122.167.144.81', '2018-10-11 18:58:11'),
(89, 4, '', 'Logout', '2018-10-11', '122.167.144.81', '2018-10-11 19:02:50'),
(90, 4, '', 'Login', '2018-10-31', '41.202.219.79', '2018-10-31 10:01:15'),
(91, 1, '', 'Login', '2018-11-12', '45.116.114.65', '2018-11-12 17:05:22'),
(92, 4, '', 'Login', '2018-11-14', '87.2.21.217', '2018-11-14 17:59:55'),
(93, 1, '', 'Login', '2018-11-16', '101.109.131.152', '2018-11-16 11:30:26'),
(94, 1, '', 'Login', '2018-11-23', '45.114.177.91', '2018-11-23 09:41:07'),
(95, 1, '', 'Login', '2018-11-23', '122.174.231.170', '2018-11-23 09:41:35'),
(96, 4, '', 'Login', '2018-12-01', '171.49.186.166', '2018-12-01 08:53:16'),
(97, 4, '', 'Logout', '2018-12-01', '171.49.186.166', '2018-12-01 08:57:04'),
(98, 1, '', 'Login', '2018-12-01', '171.49.186.166', '2018-12-01 08:57:50'),
(99, 1, '', 'Login', '2018-12-01', '171.49.186.166', '2018-12-01 09:10:22'),
(100, 1, '', 'Logout', '2018-12-01', '171.49.186.166', '2018-12-01 09:10:39'),
(101, 4, '', 'Login', '2018-12-01', '171.49.186.166', '2018-12-01 09:10:55'),
(102, 1, '', 'Login', '2018-12-01', '94.96.143.21', '2018-12-01 09:51:38'),
(103, 1, '', 'Login', '2018-12-03', '95.218.148.101', '2018-12-03 13:54:50'),
(104, 1, '', 'Login', '2018-12-04', '5.156.22.47', '2018-12-04 08:50:22'),
(105, 1, '', 'Login', '2018-12-07', '27.62.90.102', '2018-12-07 08:58:05'),
(106, 1, '', 'Login', '2018-12-08', '103.255.5.31', '2018-12-09 04:45:53'),
(107, 1, '', 'Add new Account (Purchase of New Items)', '2018-12-09', '103.255.5.31', '2018-12-09 04:50:24'),
(108, 1, '', 'Login', '2018-12-09', '103.255.5.99', '2018-12-10 04:22:16'),
(109, 4, '', 'Login', '2018-12-22', '49.207.176.93', '2018-12-22 09:45:53'),
(110, 4, '', 'Login', '2018-12-22', '168.167.80.126', '2018-12-22 09:50:01'),
(111, 4, '', 'Create a new project (Test)', '2018-12-22', '168.167.80.126', '2018-12-22 09:52:43'),
(112, 1, '', 'Login', '2019-01-07', '103.85.126.77', '2019-01-08 05:22:43'),
(113, 4, '', 'Login', '2019-01-08', '200.111.6.100', '2019-01-08 17:39:26'),
(114, 4, '', 'Logout', '2019-01-08', '200.111.6.100', '2019-01-08 17:47:35'),
(115, 1, '', 'Login', '2019-01-08', '200.111.6.100', '2019-01-08 17:47:54'),
(116, 4, '', 'Login', '2019-02-05', '98.211.35.32', '2019-02-05 20:33:13'),
(117, 4, '', 'Logout', '2019-02-05', '98.211.35.32', '2019-02-05 20:39:55'),
(118, 1, '', 'Login', '2019-02-05', '98.211.35.32', '2019-02-05 20:40:31'),
(119, 4, '', 'Login', '2019-03-03', '116.74.221.168', '2019-03-04 07:43:32'),
(120, 1, '', 'Login', '2019-03-05', '171.76.44.250', '2019-03-05 12:02:55'),
(121, 2, '', 'Login', '2019-03-05', '171.76.44.250', '2019-03-05 12:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `assign_customer_project`
--

CREATE TABLE `assign_customer_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `customer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weighting` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'active or inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assign_customer_project`
--

INSERT INTO `assign_customer_project` (`id`, `project_id`, `customer`, `weighting`, `created_date`, `ip_address`, `timestamp`, `visibility_status`) VALUES
(5, 1, '1', '1000', '2018-04-02', '192.168.1.40', '2018-04-02 07:21:22', ''),
(6, 1, '1', '700', '2018-04-02', '192.168.1.40', '2018-04-02 07:21:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `assign_item_project`
--

CREATE TABLE `assign_item_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `regular_rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_supplier_project`
--

CREATE TABLE `assign_supplier_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `supplier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weighting` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'active or inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assign_supplier_project`
--

INSERT INTO `assign_supplier_project` (`id`, `project_id`, `supplier`, `weighting`, `created_date`, `ip_address`, `timestamp`, `visibility_status`) VALUES
(3, 1, '4', '300', '2018-04-02', '192.168.1.40', '2018-04-02 07:21:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `bank_statement`
--

CREATE TABLE `bank_statement` (
  `id` int(11) NOT NULL,
  `bank_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:debit or creadit',
  `withdrawals` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'debit',
  `deposits` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'credit',
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `bill_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'status like: draft,approved,overdue,paid',
  `bill_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Amounts like->Nontaxed,Gross(Tax inclusive),Net(Tax Enclusive)',
  `bill_discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taxcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance_remaining` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gst_registered` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buying_make_payment`
--

CREATE TABLE `buying_make_payment` (
  `id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `use_transaction_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allocation_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taxcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `contact_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_customer` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `is_supplier` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `is_superfund` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `contact_is` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'first name',
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'last name',
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `istpr` int(11) NOT NULL,
  `phone_pre_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_pre_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax_pre_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `office_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hp_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address_is` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address_town` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address_suburb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address_is` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address_town` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address_suburb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `physical_address_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_type`, `is_customer`, `is_supplier`, `is_superfund`, `contact_is`, `first_name`, `last_name`, `business_name`, `display_name`, `company_name`, `branch`, `business_number`, `notes`, `visibility_status`, `istpr`, `phone_pre_code`, `phone_number`, `mobile_pre_code`, `mobile_number`, `fax_pre_code`, `fax_number`, `email`, `website`, `office_number`, `hp_number`, `postal_address_is`, `postal_address`, `postal_address_town`, `postal_address_suburb`, `postal_address_state`, `postal_address_postcode`, `physical_address_is`, `physical_address`, `physical_address_town`, `physical_address_suburb`, `physical_address_state`, `physical_address_postcode`, `created_date`, `ip_address`, `timestamp`) VALUES
(1, 'customer', 'yes', 'no', '', 'business', '', '', 'prabha', 'K', 'prabha.inet@gmaail.com', '', '', '', 'active', 0, '91', '9999999999', '', '99994795840', '', '12356', 'prabhainet@gmail.com', '', '', '', 'national', 'aaaaaaa', 'Vadamadurai', 'Vadamadurai', 'Tamil Nadu', '635623', '', '', '', '', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 06:59:13'),
(2, 'customer', 'yes', 'no', '', 'business', '', '', 'logesh', 'k', 'xyz company', '', '', '', 'active', 0, '', '', '', '', '', '', 'logesh@gmail.com', 'www.example.com', '', '', 'national', '', '', '', '', '', '', '', '', '', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 07:11:36'),
(3, 'customer', 'yes', 'no', '', 'business', '', '', 'Kavitha', 'K', 'kavi infotech', '', '', '', 'active', 0, '', '', '91', '8888888888', '', '', 'kavitha@gmail.com', 'www.example.com', '', '', 'national', '', '', '', '', '', '', '', '', '', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 07:15:35'),
(4, 'customer,supplier', 'yes', 'yes', '', 'business', '', '', 'jansi', 'inet', 'jansi infotech', '', '', '', 'active', 0, '', '', '', '', '', '', 'jansiraniinet@gmail.com', '', '', '', 'national', '', '', '', '', '', '', '', '', '', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 07:17:17'),
(5, 'customer', 'yes', 'no', '', 'business', '', '', 'A', 'B', '', '', '', '', 'active', 0, '', '', '', '', '', '', 'prabhainet@gmail.com', '', '', '', 'national', '', '', '', '', '', '', '', '', '', '', '', '2018-08-13', '202.69.15.70', '2018-08-13 16:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `customer_adjustment_notes`
--

CREATE TABLE `customer_adjustment_notes` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `adjustment_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like debit or credit',
  `adjustment_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'status like: draft,approved,overdue,paid',
  `adjustment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amounts like:Non taxed,Gross (Tax inclusive),Net (Tax Enclusive)',
  `project_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taxcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance_remaining` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gst_registered` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daytoday_report_settings`
--

CREATE TABLE `daytoday_report_settings` (
  `id` int(11) NOT NULL,
  `selling_approval` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estimate_prefix` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estimate_default_template` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estimate_expiry` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estimate_term_condition` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estimate_payment_notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `invoice_prefix` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `invoice_default_template` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `invoice_payment_details` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `can_prefix` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `buying_approval` varchar(255) NOT NULL,
  `bill_prefix` varchar(255) NOT NULL,
  `san_prefix` varchar(255) NOT NULL,
  `report_basis` varchar(255) NOT NULL,
  `ageing_report` varchar(255) NOT NULL,
  `estimate_start_from` int(11) NOT NULL DEFAULT 0,
  `invoice_start_from` int(11) NOT NULL DEFAULT 0,
  `can_start_from` int(11) NOT NULL DEFAULT 0,
  `bill_start_from` int(11) NOT NULL DEFAULT 0,
  `san_start_from` int(11) NOT NULL DEFAULT 0,
  `journal_start_from` int(11) NOT NULL DEFAULT 0,
  `journal_prefix` varchar(255) NOT NULL DEFAULT 'GJ'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daytoday_report_settings`
--

INSERT INTO `daytoday_report_settings` (`id`, `selling_approval`, `estimate_prefix`, `estimate_default_template`, `estimate_expiry`, `estimate_term_condition`, `estimate_payment_notes`, `invoice_prefix`, `invoice_default_template`, `invoice_payment_details`, `can_prefix`, `buying_approval`, `bill_prefix`, `san_prefix`, `report_basis`, `ageing_report`, `estimate_start_from`, `invoice_start_from`, `can_start_from`, `bill_start_from`, `san_start_from`, `journal_start_from`, `journal_prefix`) VALUES
(1, 'enabled', 'QUOTATION', '', '25', 'I had to agree to the terms and conditions of the site before I joined because there were a lot of policies I had to abide by.\r\n', 'A promissory note is a legal instrument (more particularly, a financial instrument), in which one party (the maker or issuer) promises in writing to pay a determinate sum of money to the other (the payee), either at a fixed or determinable future time or ', 'INV', '', 'A promissory note is a legal instrument (more particularly, a financial instrument), in which one party (the maker or issuer) promises in writing to pay a determinate sum of money to the other (the payee), either at a fixed or determinable future time or ', 'CAN', 'enabled', 'BILL', 'SAN', 'cash_basis', 'transaction_date', 0, 0, 0, 0, 0, 1, 'GJ');

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `estimate_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estimate_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amounts like:Non taxed,Gross (Tax inclusive),Net (Tax Enclusive)',
  `project_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `markup` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taxcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:active or inactive',
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gst_registered` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:yes or no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'status like: draft,approved,overdue,paid',
  `invoice_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_term` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amounts like:Non taxed,Gross (Tax inclusive),Net (Tax Enclusive)',
  `invoice_discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taxcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance_remaining` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unpaid' COMMENT 'payment status like paid and unpaid',
  `gst_registered` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:yes or no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iras_gst_codes`
--

CREATE TABLE `iras_gst_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `iras_gst_codes`
--

INSERT INTO `iras_gst_codes` (`id`, `code`, `purpose`, `description`, `create_date`, `ip_address`, `timestamp`) VALUES
(1, 'BL', 'purchase', 'GST incurred( not claimable -REG-26/27)', '2016-07-07', '110.227.145.4', '2016-07-07 09:22:11'),
(2, 'DS', 'supply', 'Deemed supplier(Supplies to be reported under the GST legislation)', '2016-07-07', '110.227.145.4', '2016-07-13 08:39:22'),
(3, 'EP', 'purchase', 'Purchase exempted from GST', '2016-07-07', '110.227.145.4', '2016-07-07 09:23:31'),
(4, 'ES33', 'supply', 'Regulation 33 Exempt Supplier', '2016-07-07', '110.227.145.4', '2016-07-07 09:24:34'),
(5, 'ESN33', 'supply', 'Non  Regulation 33 Exempt Supplies', '2016-07-07', '110.227.145.4', '2016-07-07 09:25:19'),
(6, 'IGDS', 'purchase', 'Import under the import GST deferment scheme', '2016-07-07', '110.227.145.4', '2016-07-07 09:26:30'),
(7, 'IM', 'purchase', 'GST incurred for import of goods', '2016-07-07', '110.227.145.4', '2016-07-07 09:27:38'),
(8, 'ME', 'purchase', 'Import under under special scheme(no GST incurred)', '2016-07-07', '110.227.145.4', '2016-07-07 09:29:26'),
(10, 'NR', 'purchase', 'purchase from Non GST-registed supplier', '2016-07-07', '110.227.145.4', '2016-07-07 09:32:56'),
(11, 'OP', 'purchase', 'Out of the scope of GST legislation(Purchases outside the scope of the GST Act)', '2016-07-07', '110.227.145.4', '2016-07-13 08:41:15'),
(12, 'OS', 'supply', 'Out-of-scope supplier(Supplies outside the scope of the GST Act)', '2016-07-07', '110.227.145.4', '2016-07-13 08:40:38'),
(13, 'SR', 'supply', 'Standard-rated supplies with GST charged(local supply of goods and services)', '2016-07-07', '110.227.145.4', '2016-07-13 08:37:34'),
(14, 'TX-ESS', 'purchase', 'GST incurred(Reg-33 exempt supplies)', '2016-07-07', '110.227.145.4', '2016-07-16 12:15:29'),
(15, 'TX-N33', 'purchase', 'GST incurred(Non-Reg-33 exempt supplies)', '2016-07-07', '110.227.145.4', '2016-07-08 08:39:50'),
(16, 'TX-RE', 'purchase', 'GST not attributable to taxable or exempt supplies', '2016-07-07', '110.227.145.4', '2016-07-07 09:38:42'),
(17, 'TX', 'purchase', 'Purchases with GST 7%(Standard-rated purchase)', '2016-07-08', '182.77.38.240', '2016-07-16 12:16:35'),
(18, 'ZP', 'purchase', 'Zero rated purchases', '2016-07-08', '182.77.38.240', '2016-07-08 08:32:29'),
(19, 'ZR ', 'supply', 'Zero rated supplies', '2016-07-08', '182.77.38.240', '2016-07-08 08:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:active or inactive',
  `item_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'item to like: sell,buy and both',
  `net_sell_item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gross_sell_item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sell_item_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sell_item_tax_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sell_item_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `net_buy_item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `gross_buy_item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buy_item_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buy_item_tax_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buy_item_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `selling_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buying_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_code`, `sub_item`, `visibility_status`, `item_type`, `item_tax`, `item_to`, `net_sell_item_price`, `gross_sell_item_price`, `sell_item_account`, `sell_item_tax_code`, `sell_item_description`, `net_buy_item_price`, `gross_buy_item_price`, `buy_item_account`, `buy_item_tax_code`, `buy_item_description`, `create_date`, `ip_address`, `timestamp`, `selling_price`, `buying_price`) VALUES
(1, 'aaaa', '', '', 'active', 'Service', '', 'both', '', '', '1', '3', '', '0', '', '5', '17', '', '2018-04-02', '192.168.1.40', '2018-04-02 07:39:30', '1111', '111'),
(2, 'RALLI MAX', '', '', 'active', 'Product', '', 'both', '', '', '22', NULL, '', '0', '', '23', NULL, '', '2018-06-13', '175.101.114.148', '2018-06-13 13:27:58', '7280', '6000'),
(3, 'Test', '', '', 'active', 'Service', '', 'both', '', '', '2', '15', '', '0', '', '23', '22', '', '2018-07-29', '27.4.56.203', '2018-07-29 17:33:34', '10000', '');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `journal_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `journal_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'journal or opening_balance',
  `journal_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'reference code related to invoice , bills,can, san, transfer money',
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `debit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `narration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ladger_generate` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like: yes, no',
  `generated_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'generated from like:Receipts,invoices,bills',
  `generated_from_id` int(11) NOT NULL,
  `gst_registered` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `journal_no`, `journal_type`, `journal_date`, `amounts`, `reference`, `summary`, `description`, `account`, `type`, `debit`, `credit`, `tax_code`, `tax`, `narration`, `contact`, `trans_type`, `project`, `visibility_status`, `create_date`, `ip_address`, `timestamp`, `ladger_generate`, `generated_from`, `generated_from_id`, `gst_registered`) VALUES
(1, 'GJ000001', 'journal', '02-04-2018', '', '', 'testing', 'testing', 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"7\";}', 'a:2:{i:0;s:5:\"debit\";i:1;s:6:\"credit\";}', 'a:2:{i:0;s:2:\"12\";i:1;s:0:\"\";}', 'a:2:{i:0;s:0:\"\";i:1;s:2:\"12\";}', '', '', 'a:2:{i:0;s:7:\"teating\";i:1;s:7:\"testing\";}', 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"3\";}', 'a:2:{i:0;s:4:\"sale\";i:1;s:8:\"purchase\";}', 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}', 'active', '2018-04-02', '192.168.1.40', '2018-04-02 07:46:53', '1', 'journal', 0, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `linked_accounts`
--

CREATE TABLE `linked_accounts` (
  `id` int(11) NOT NULL,
  `banking_eafce` int(11) NOT NULL COMMENT 'Equity Account for Current Earnings:',
  `banking_eafre` int(11) NOT NULL COMMENT 'Equity Account for Retained Earnings:',
  `banking_eafhb` int(11) NOT NULL COMMENT 'Equity Account for Historical Balancing:',
  `banking_bafuf` int(11) NOT NULL COMMENT 'Bank Account for Undeposited Funds:',
  `banking_gcafbd` int(11) NOT NULL COMMENT 'GST Claimed Account for Bad Debts:',
  `banking_tgrca` int(11) NOT NULL COMMENT 'Tourist GST Refund Claimed Account:',
  `sale_aaftr` int(11) NOT NULL COMMENT 'Asset Account for Tracking Receivables:',
  `sale_bafcr` int(11) NOT NULL COMMENT 'Bank Account for Customer Receipts:',
  `sale_iaff` int(11) NOT NULL COMMENT 'Income Account for Freight:',
  `sale_lafcd` int(11) NOT NULL COMMENT 'Liability Account for Customer Deposits:',
  `sale_ecosafd` int(11) NOT NULL COMMENT 'Expense or Cost of Sales Account for Discounts:',
  `purchase_bafpb` int(11) NOT NULL COMMENT 'Bank Account for Paying Bills:',
  `purchase_lafir` int(11) NOT NULL COMMENT 'Liability Account for Item Receipts:',
  `purchase_ecosaff` int(11) NOT NULL COMMENT 'Expense or Cost of Sales Account for Freight:',
  `purchase_aafsd` int(11) NOT NULL COMMENT 'Asset Account for Supplier Deposits:',
  `purchase_eafd` int(11) NOT NULL COMMENT 'Expense(or Contra) Account for Discounts:',
  `purchase_eaflc` int(11) NOT NULL COMMENT 'Expense Account for Late Charges:',
  `account_tax_collect` int(11) NOT NULL,
  `account_tax_paid` int(11) NOT NULL,
  `created_date` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ip_address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `linked_accounts`
--

INSERT INTO `linked_accounts` (`id`, `banking_eafce`, `banking_eafre`, `banking_eafhb`, `banking_bafuf`, `banking_gcafbd`, `banking_tgrca`, `sale_aaftr`, `sale_bafcr`, `sale_iaff`, `sale_lafcd`, `sale_ecosafd`, `purchase_bafpb`, `purchase_lafir`, `purchase_ecosaff`, `purchase_aafsd`, `purchase_eafd`, `purchase_eaflc`, `account_tax_collect`, `account_tax_paid`, `created_date`, `ip_address`, `timestamp`) VALUES
(1, 4, 5, 5, 11, 17, 17, 36, 16, 6, 16, 16, 12, 37, 4, 19, 19, 17, 17, 21, '', '', '2016-08-24 15:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `make_payment`
--

CREATE TABLE `make_payment` (
  `id` int(11) NOT NULL,
  `contact_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `use_transaction_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reconcile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allocation_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_for` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'payment for invoice or bill',
  `payment_for_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_terms`
--

CREATE TABLE `payment_terms` (
  `id` int(11) NOT NULL,
  `term_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `net_due` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'project status can be running,completed',
  `subproject_of` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suppliers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `visibility_status`, `start_date`, `end_date`, `project_status`, `subproject_of`, `description`, `customers`, `suppliers`, `created_date`, `ip_address`, `timestamp`) VALUES
(1, 'Demo project', 'active', '02-03-2018', '30-03-2018', 'running', '', 'tesing', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 07:21:22'),
(2, 'aaa', 'active', '02-04-2018', '23-04-2018', 'running', '', 'testing', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 07:37:47'),
(3, 'aaaaaaa', 'inactive', '02-04-2018', '23-04-2018', 'running', '', '', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 08:49:02'),
(4, 'dfsf', 'active', '02-03-2018', '02-04-2018', 'running', '', '', '', '', '2018-04-02', '192.168.1.40', '2018-04-02 08:50:55'),
(5, 'Test', 'active', '22-12-2018', '22-12-2018', 'running', '', '', '', '', '2018-12-22', '168.167.80.126', '2018-12-22 09:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `receive_money`
--

CREATE TABLE `receive_money` (
  `id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receive_money_for` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receive_money_for_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id for which invoice or bill is generated',
  `receivable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `use_transaction_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allocation_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reconcile` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `dtd_bank_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_transfer_money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_bank_payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_estimate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_invoice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_adjustment_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_receipt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_bills` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_supplier_adjustment_notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_projects` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_items` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_timesheets` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dtd_expense_claims` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rp_budgets` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fr_profit_and_loss` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fr_balance_sheet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fr_trial_balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fr_account_enquary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_gst_summery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_tax_code_transaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cr_aged_debtors` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cr_aged_debtor_transaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cr_invoice_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cr_customer_transaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sr_aged_creditors` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sr_aged_creditors_transaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sr_bill_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sr_supplier_transaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ar_aged_debtor_summery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ar_aged_creditor_summery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ar_top_ten_customers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ar_top_ten_suppliers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ar_top_ten_income_accounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ar_top_ten_expense_accounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ar_budget` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_account_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_bank_account_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_item_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_project_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_customer_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_supplier_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_employee_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lr_tax_code_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advr_journal_list` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advr_payment_and_receipt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advr_bank_account_reconcilation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adv_journal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adv_activity_statement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adv_tpar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_cintact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_payroll_employee_details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_superfunds` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_accounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_users` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_roles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_book_settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_selling_settigs` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_payment_terms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_buying_settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_time_and_expense_settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_email_settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_email_history` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_report_settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_tax_settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_payroll_items` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adm_payroll_settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `dtd_bank_account`, `dtd_transfer_money`, `dtd_bank_payment`, `dtd_estimate`, `dtd_invoice`, `dtd_adjustment_notes`, `dtd_receipt`, `dtd_bills`, `dtd_supplier_adjustment_notes`, `dtd_payment`, `dtd_projects`, `dtd_items`, `dtd_timesheets`, `dtd_expense_claims`, `rp_budgets`, `fr_profit_and_loss`, `fr_balance_sheet`, `fr_trial_balance`, `fr_account_enquary`, `tr_gst_summery`, `tr_tax_code_transaction`, `cr_aged_debtors`, `cr_aged_debtor_transaction`, `cr_invoice_list`, `cr_customer_transaction`, `sr_aged_creditors`, `sr_aged_creditors_transaction`, `sr_bill_list`, `sr_supplier_transaction`, `ar_aged_debtor_summery`, `ar_aged_creditor_summery`, `ar_top_ten_customers`, `ar_top_ten_suppliers`, `ar_top_ten_income_accounts`, `ar_top_ten_expense_accounts`, `ar_budget`, `lr_account_list`, `lr_bank_account_list`, `lr_item_list`, `lr_project_list`, `lr_customer_list`, `lr_supplier_list`, `lr_employee_list`, `lr_tax_code_list`, `advr_journal_list`, `advr_payment_and_receipt`, `advr_bank_account_reconcilation`, `adv_journal`, `adv_activity_statement`, `adv_tpar`, `con_cintact`, `con_payroll_employee_details`, `con_superfunds`, `adm_accounts`, `adm_users`, `adm_roles`, `adm_book_settings`, `adm_selling_settigs`, `adm_payment_terms`, `adm_buying_settings`, `adm_time_and_expense_settings`, `adm_email_settings`, `adm_email_history`, `adm_report_settings`, `adm_tax_settings`, `adm_payroll_items`, `adm_payroll_settings`, `create_date`, `ip_address`, `timestamp`, `role`, `description`) VALUES
(1, 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:6:\"import\";i:4;s:26:\"perform_bank_reconcilation\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:5:\"print\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'N;', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', '', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";}', 'N;', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:15:\"print_and_email\";i:4;s:10:\"lodge_tpar\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:32:\"edit_other_user_personal_details\";i:3;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:25:\"delete_tax_code_and_group\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";}', '2016-09-01', '182.64.132.9', '2016-09-01 11:32:04', 'Administrator', 'RELATED TO Administrator'),
(2, 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:6:\"import\";i:4;s:26:\"perform_bank_reconcilation\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:5:\"print\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'N;', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'N;', 'N;', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', '', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:15:\"print_and_email\";i:4;s:24:\"lodge_activity_statement\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:15:\"print_and_email\";i:4;s:10:\"lodge_tpar\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:32:\"edit_other_user_personal_details\";i:3;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:4:\"edit\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:25:\"delete_tax_code_and_group\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";}', '2016-08-29', '182.64.178.154', '2016-08-29 15:07:01', 'Manager', 'Manager'),
(4, 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:6:\"import\";i:4;s:26:\"perform_bank_reconcilation\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:15:\"print_and_email\";}', 'a:5:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";i:4;s:5:\"print\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', '', '', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', '', '', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', '', '', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', '', '', '', '', '', '', '', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', '', 'N;', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:2:{i:0;s:4:\"view\";i:1;s:6:\"export\";}', 'a:4:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";i:3;s:7:\"approve\";}', 'N;', '', 'a:3:{i:0;s:4:\"view\";i:1;s:15:\"create_and_edit\";i:2;s:6:\"delete\";}', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-09-01', '182.64.132.9', '2016-09-01 11:25:29', 'Teacher', 'teaC');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of company',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cookie_expire` int(10) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pdflogo` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'logo for pdf and print',
  `date_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '1 is for dd/mm/yy 2 is for mm/dd/yy 3 is for full date',
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `com_uen_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_uen_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_gst_registered` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `com_gst_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date_financial_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_month_financial_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gst_reporting_period` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `email`, `website`, `address`, `country`, `city`, `state`, `zip`, `telephone1`, `telephone2`, `timezone`, `currency_symbol`, `cookie_expire`, `logo`, `pdflogo`, `date_format`, `create_date`, `ip_address`, `time_stamp`, `com_uen_no`, `com_uen_type`, `is_gst_registered`, `com_gst_no`, `start_date_financial_year`, `start_month_financial_year`, `gst_reporting_period`, `fax_number`) VALUES
(1, 'Business accounting Software', 'prabhainet@gmail.com', 'www.nicdata.com.sg', '12                                                                                                                                                                                                                                              ', 'SG', 'Singapore', 'Singapore', '457909', '9999999999', '91901075', 'Asia/Singapore', '$', 0, '1467615137.png', '1467615087.png', 'd-m-Y', '', '', '2018-04-02 12:11:06', '123456', 'UL', 'no', '', '1', 'Jun', '3', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_adjustment_notes`
--

CREATE TABLE `supplier_adjustment_notes` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `adjustment_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adjustment_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'status like: draft,approved,overdue,paid',
  `adjustment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amounts` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'amounts like:Non taxed,Gross (Tax inclusive),Net (Tax Enclusive)',
  `project_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `item_qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taxcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance_remaining` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gst_registered` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `tax_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `what_trans_is_used` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:supply,purchase',
  `tax_account_for_gst_collected` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'selected account_id',
  `tax_account_for_gst_paid` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'selected account_id',
  `iras_for_gst_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'iras gst code for gst',
  `account_tax_import_duty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_tax_sale_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_tax_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `tax_name`, `tax_type`, `tax_description`, `what_trans_is_used`, `tax_account_for_gst_collected`, `tax_account_for_gst_paid`, `iras_for_gst_code`, `account_tax_import_duty`, `account_tax_sale_tax`, `visibility_status`, `tax_rate`, `tax_code`, `default_tax_code`, `created_date`, `ip_address`, `timestamp`) VALUES
(1, 'BL', 'gst', 'Not claimable GST (Reg.26/27) - Edit', 'purchase', '17', '6', 'BL', '', '', 'active', '10.00', '', '0', '2016-07-29', '182.64.85.30', '2016-08-27 11:33:29'),
(2, 'DS', 'gst', 'Deemed supplies', 'supply', '17', '6', 'DS', '', '', 'active', '10.00', '', '0', '2016-07-04', '122.162.208.124', '2016-07-29 11:41:47'),
(3, 'E33', 'gst', 'Reg. 33 exempt supplies', 'supply', '17', '6', 'TX-ESS', '', '', 'active', '20', '', '0', '2016-07-04', '122.162.208.124', '2016-07-16 12:17:08'),
(4, 'EN3', 'gst', 'Non-Reg. 33 exempt supplies', 'purchase', '17', '6', 'TX-N33', '', '', 'active', '10', '', '0', '2016-07-04', '122.162.208.124', '2016-07-13 09:02:06'),
(5, 'EP', 'gst', 'Purchases exempted from GST', 'purchase', '17', '6', 'EP', '', '', 'active', '30', '', '0', '2016-07-04', '122.162.208.124', '2016-07-13 09:02:21'),
(6, 'ES3', 'gst', 'Reg. 33 exempt supplies', 'supply', '17', '6', 'ES33', '', '', 'active', '10.00', '', '0', '2016-07-04', '122.162.208.124', '2016-07-13 09:02:42'),
(7, 'ESN', 'gst', 'Non-Reg. 33 exempt supplies', 'supply', '17', '6', 'ESN33', '', '', 'active', '11.90', '', '0', '2016-07-04', '122.162.208.124', '2016-07-29 11:44:31'),
(14, 'FRE', 'gst', 'GST Free ', 'supply', '17', '6', 'ZR ', '', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:02:55'),
(15, 'GST', 'gst', 'Goods & Services Tax', 'supply', '17', '6', 'SR', '', '', 'active', '7', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:03:02'),
(16, 'IGD ', 'gst', 'Import under deferment scheme\r\n', 'purchase', '17', '6', 'IGDS', '', '', 'active', '7', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:03:16'),
(17, 'IM', 'gst', 'Imports goods with GST 7%', 'purchase', '17', '6', 'IM', '', '', 'active', '7', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:03:24'),
(18, 'IMP', 'import_duty', 'Import Duty Import Duty\r\n', '', '17', '6', '', '2', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:04:25'),
(19, 'ME', 'gst', 'Imports under special scheme', 'purchase', '17', '6', 'ME', '', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:04:33'),
(20, 'N-T sale', 'sale_tax', 'Non-Taxable Sales Tax\r\n', 'supply', '17', '6', '', '', '10', 'active', '0', '', '1', '2016-08-27', '182.64.93.17', '2016-08-27 11:56:02'),
(21, 'NR', 'gst', 'Non GST-registered supplier\r\n', 'purchase', '17', '6', 'NR', '', '', 'active', '3', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:04:47'),
(22, 'OP', 'gst', 'Purchases (Out-of-scope) ', 'purchase', '17', '6', 'OP', '', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:05:11'),
(23, 'OS', 'gst', ' Supplies (Out-of-scope)', 'supply', '17', '6', 'OS', '', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:05:24'),
(24, 'RE', 'gst', 'GST not direct attributable', 'purchase', '17', '6', 'TX-RE', '', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:05:33'),
(25, 'SR', 'gst', 'Standard-rated supplies(GST7%)', 'supply', '17', '6', 'SR', '', '', 'active', '7', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:05:46'),
(26, 'TX', 'gst', 'Purchases with GST 7%(Standard-rated purchase)', 'purchase', '17', '6', 'TX', '', '', 'active', '7', '', '0', '2016-07-13', '182.64.54.254', '2016-07-16 12:17:15'),
(27, 'ZP', 'input_tax', 'Purchases with no GST incurred', 'purchase', '17', '6', 'ZP', '4', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:06:08'),
(28, 'ZR', 'gst', 'Zero-rated supplies', 'supply', '17', '6', 'ZR ', '', '', 'active', '0', '', '0', '2016-07-08', '182.77.38.240', '2016-07-13 09:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `tax_calculation`
--

CREATE TABLE `tax_calculation` (
  `id` int(11) NOT NULL,
  `project_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_payable_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `generated_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `generated_from_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_setting`
--

CREATE TABLE `tax_setting` (
  `id` int(11) NOT NULL,
  `register_for_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'like:- yes, no',
  `reporting_basis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_sale_figure` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_tax_for_sale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_tax_for_purchase` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allow_user_edit_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allow_user_include_tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tax_setting`
--

INSERT INTO `tax_setting` (`id`, `register_for_tax`, `reporting_basis`, `default_sale_figure`, `default_tax_for_sale`, `default_tax_for_purchase`, `allow_user_edit_tax`, `allow_user_include_tax`, `create_date`, `ip_address`, `timestamp`) VALUES
(1, 'yes', 'accrual', 'net', '15', '26', 'yes', 'yes', '2016-06-30', '45.116.114.65', '2018-11-12 17:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_rule`
--

CREATE TABLE `transaction_rule` (
  `id` int(11) NOT NULL,
  `rule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `applies_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_has` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_has_other` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `refrence_has` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `refrence_has_other` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_day_other` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_has` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_has_other` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_is` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_is_other` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `do_following` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_rule`
--

INSERT INTO `transaction_rule` (`id`, `rule`, `applies_to`, `description_has`, `description_has_other`, `refrence_has`, `refrence_has_other`, `transaction_day`, `transaction_day_other`, `type_has`, `type_has_other`, `amount_is`, `amount_is_other`, `do_following`, `description`, `contact_to`, `create_date`, `ip_address`, `timestamp`) VALUES
(1, 'rule 1', 'money in', 'Any of these words', '11', 'Any of these words', '22', 'The first day of the month', '33', 'Any of these words', '44', 'More then', '55', 'Create a receipt', 'abc123', '4', '2016-07-04', '122.162.208.124', '2016-07-04 10:38:26'),
(2, 'rule 2', 'money out', 'Any of these words', 'a', 'This exact working', 'b', 'Any date', 'c', 'Any of these words', 'd', 'Equal to or more then', 'e', 'Create a transfer', 'knlk kjkj 151', '5', '2016-07-04', '122.162.208.124', '2016-07-04 10:41:30'),
(3, 'rule 1', 'money in', 'Any of these words', '11', 'This exact working', '22', 'The first day of the month', '33', 'Any of these words', '44', 'More then', '55', 'Create a receipt', 'abc123', '20', '2016-07-05', '182.64.89.222', '2016-07-05 13:28:10'),
(4, 'role test', 'money out', 'All of these words', '11', 'All of these words', '22', 'The following day of the month', '33', 'All of these words', '44', 'Equal to', '55', 'Create a payment', 'abc123', '12', '2016-07-05', '182.64.89.222', '2016-07-05 13:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_money`
--

CREATE TABLE `transfer_money` (
  `id` int(11) NOT NULL,
  `transfer_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transfer_money` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transfer_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_fees` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'id of user who is login.',
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_photo_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `random` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'encrypt id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `role_id`, `user_type`, `user_photo_file`, `email`, `password`, `mobile`, `address`, `create_date`, `ip_address`, `timestamp`, `random`) VALUES
(1, 'Super', 'Admin', '1', 'admin', '', 'admin@gmail.com', 'nQ3cwfcFV+T1XORkLepnexs5bitq6tuCKdyYjw4IFXYbWjC2d3I1rs/+OWM2/V6KeInagKfdx9ARP6BreYl205Ul2pEmv4Z4PjRZN9jkAbg=', '9999999999', 'vellachery, chennai', '', '192.168.1.40', '2018-04-02 06:21:20', '0'),
(2, 'Suganya S', 'Inet', '2', 'user', '', 'suganyainet@gmail.com', '9wIcB963Pymv41OWySNO+8sD7NM3IH14e5JBjAemDG0WvG9nsCxInIhIDszTDu4Y/gwWbCJTqfFFFyzqZ8dXceRz/y/+EA0Z1X9x0ndH4Eg=', '9999999999', 'porur,chennai', '2018-04-02', '192.168.1.40', '2018-04-02 06:19:07', '0'),
(3, 'kowsalya', 'Inet', '4', 'user', '', 'kowsalyainet@gmail.com', 'Tqw3WJ/dhOeHeUpZRKzXRAW4JX3ARCmGrvGM2Z2tn4giYMlQDawInZrzA9tbdB88jN0cq/pTWpp6sWJMAOpvOno+8QslpeVr2Fv+zWQUmwc=', '8888888888', 'pearamathi vellor, namakkal(Dt)', '2018-04-02', '192.168.1.40', '2018-04-02 06:20:30', '0'),
(4, 'Vidhya', 'Inet', '4', 'user', '', 'vidhyainet@gmail.com', '+Y7T+qUGYP7rll1jLbac0OmT26ABeY5KG5HxAe4SyqUBZ2qAhe/+PYmJPUfWxaU26kXOFZ2k94qip9to7IEvAjyCjFTrHV/qdmoj0xBSsSY=', '7777777777', 'vellore,chennai', '2018-04-02', '192.168.1.40', '2018-04-02 06:26:23', '0'),
(5, 'Nila', 'Inet', '4', 'user', '', 'nilainet@gmail.com', 'Zgpq9gezY3mIbyazUUBL7+wmEgJ95aEVSyWzaeQxtN8V3u7JAmJS7ltl6L+u2orWEeHuDmPgZMw5HI5FNlmPtJYukUgKid7P18FKd/jvPec=', '7777777777', 'South Tamil nadu, cheennai', '2018-04-02', '192.168.1.40', '2018-04-02 06:25:36', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_transaction`
--
ALTER TABLE `account_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_customer_project`
--
ALTER TABLE `assign_customer_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_item_project`
--
ALTER TABLE `assign_item_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_supplier_project`
--
ALTER TABLE `assign_supplier_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_statement`
--
ALTER TABLE `bank_statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buying_make_payment`
--
ALTER TABLE `buying_make_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_adjustment_notes`
--
ALTER TABLE `customer_adjustment_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daytoday_report_settings`
--
ALTER TABLE `daytoday_report_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iras_gst_codes`
--
ALTER TABLE `iras_gst_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linked_accounts`
--
ALTER TABLE `linked_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make_payment`
--
ALTER TABLE `make_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_terms`
--
ALTER TABLE `payment_terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_money`
--
ALTER TABLE `receive_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_adjustment_notes`
--
ALTER TABLE `supplier_adjustment_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_calculation`
--
ALTER TABLE `tax_calculation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_setting`
--
ALTER TABLE `tax_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_rule`
--
ALTER TABLE `transaction_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_money`
--
ALTER TABLE `transfer_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `account_transaction`
--
ALTER TABLE `account_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `assign_customer_project`
--
ALTER TABLE `assign_customer_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assign_item_project`
--
ALTER TABLE `assign_item_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_supplier_project`
--
ALTER TABLE `assign_supplier_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_statement`
--
ALTER TABLE `bank_statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buying_make_payment`
--
ALTER TABLE `buying_make_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_adjustment_notes`
--
ALTER TABLE `customer_adjustment_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daytoday_report_settings`
--
ALTER TABLE `daytoday_report_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iras_gst_codes`
--
ALTER TABLE `iras_gst_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `linked_accounts`
--
ALTER TABLE `linked_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `make_payment`
--
ALTER TABLE `make_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_terms`
--
ALTER TABLE `payment_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receive_money`
--
ALTER TABLE `receive_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_adjustment_notes`
--
ALTER TABLE `supplier_adjustment_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tax_calculation`
--
ALTER TABLE `tax_calculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_setting`
--
ALTER TABLE `tax_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_rule`
--
ALTER TABLE `transaction_rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfer_money`
--
ALTER TABLE `transfer_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of user who is login.', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
