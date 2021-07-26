-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2020 at 02:59 PM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gari_stresser`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `Username`, `Password`) VALUES
(1, 'Demo', 'cytnOE9TUEpOak9LUEo3a1Jwai9zZz09');

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `ip` text NOT NULL,
  `link` text NOT NULL,
  `layer` int(11) NOT NULL,
  `slots` int(11) NOT NULL,
  `methods` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `name`, `ip`, `link`, `layer`, `slots`, `methods`) VALUES
(1, 'TestL7', '5.21.8.5', 'https://api.link/?key=something&', 7, 15, 'HTTP BYPASSER'),
(2, 'TestL4', '2.8.11.66', 'https://api.link/?key=something&', 4, 2, 'UDP UDPPLAIN CIA HTVAC');

-- --------------------------------------------------------

--
-- Table structure for table `attack_logs`
--

CREATE TABLE `attack_logs` (
  `id` int(11) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `ip` varchar(1024) NOT NULL,
  `port` int(5) NOT NULL,
  `time` int(4) NOT NULL,
  `method` varchar(10) NOT NULL,
  `date` int(11) NOT NULL,
  `stopped` int(1) NOT NULL DEFAULT 0,
  `handler` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attack_logs`
--

INSERT INTO `attack_logs` (`id`, `userID`, `ip`, `port`, `time`, `method`, `date`, `stopped`, `handler`) VALUES
(1, '1', '1.1.1.1', 80, 120, '2', 1609840937, 0, '2'),
(2, '1', 'http://6.32.88.33', 0, 60, '24', 1609840937, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `id` int(11) NOT NULL,
  `word` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `action` text NOT NULL,
  `timestamp` text NOT NULL,
  `ip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `methods`
--

CREATE TABLE `methods` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `layer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`id`, `name`, `layer`) VALUES
(1, 'UDP', 4),
(2, 'UDPPLAIN', 4),
(3, 'STD', 4),
(4, 'FRAG', 4),
(5, 'PLAIN', 4),
(6, 'CIA', 4),
(7, 'OVH-SMASH', 4),
(8, 'OVH-DROP', 4),
(9, 'VSE', 4),
(10, 'STDHEX', 4),
(11, 'AWE', 4),
(12, 'ICE', 4),
(13, 'NFO', 4),
(14, 'PACK', 4),
(15, 'RUSE', 4),
(16, 'SHOCK', 4),
(17, 'HTVAC', 4),
(18, 'STLE', 4),
(19, 'TCP', 4),
(20, 'ASYN', 4),
(21, 'SYN', 4),
(22, 'USYN', 4),
(23, 'ACK', 4),
(24, 'HTTP', 7),
(25, 'BYPASSER', 7);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Message` text NOT NULL,
  `Date` text NOT NULL,
  `Timestamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `Title`, `Message`, `Date`, `Timestamp`) VALUES
(1, 'Its just for a test !', 'This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! This is message for test of News! ', '13.10.2020 21:53:pm', '1602618804');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `order_id` int(255) NOT NULL,
  `invoice_id` text NOT NULL,
  `userID` int(11) NOT NULL,
  `timestamp` text NOT NULL,
  `checkout_address` text NOT NULL,
  `checkout_amount` text NOT NULL,
  `Price` int(11) NOT NULL,
  `checkout_currency` text NOT NULL,
  `invoice_created` text NOT NULL,
  `invoice_expires` text NOT NULL,
  `checkout_url` text NOT NULL,
  `status_url` text NOT NULL,
  `invoice_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`order_id`, `invoice_id`, `userID`, `timestamp`, `checkout_address`, `checkout_amount`, `Price`, `checkout_currency`, `invoice_created`, `invoice_expires`, `checkout_url`, `status_url`, `invoice_status`) VALUES
(1, 'CPEL76VK1NDAK8HYFATL5UZZBO', 1, '1607016915', '33VGN6wzu9ZqypQyvvtU9sPcLrbyC3QqWw', '0.00094281188842546', 15, 'bitcoin', '1607016915', '1607072715', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dstatus%26id%3DCPEL76VK1NDAK8HYFATL5UZZBO%26key%3Df0ae1fd94e828590bbdb320d38b1386a', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dcheckout%26id%3DCPEL76VK1NDAK8HYFATL5UZZBO%26key%3Df0ae1fd94e828590bbdb320d38b1386a', '1'),
(2, 'CPEL7F6BRZMDZSOXXVWQUMQDCO', 1, '1607029434', '34sLwkotUs3QHnRALKyKAz8bzbhzuxVsRD', '0.00343000', 55, 'bitcoin', '1607029434', '1607085234', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dcheckout%26id%3DCPEL7F6BRZMDZSOXXVWQUMQDCO%26key%3D57850ebabc5aaa93ee7c0d6d442d862b', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dstatus%26id%3DCPEL7F6BRZMDZSOXXVWQUMQDCO%26key%3D57850ebabc5aaa93ee7c0d6d442d862b', '0'),
(3, 'CPEL1RZEJZ2KB73N6ICHTRF5LG', 12, '1607065151', '36HEDgXGKS48A81YGkdSnToc461qcS5b1u', '0.00063000', 10, 'bitcoin', '1607065151', '1607095751', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dcheckout%26id%3DCPEL1RZEJZ2KB73N6ICHTRF5LG%26key%3D5bca3a55116397b9a55d0ae7b3a16438', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dstatus%26id%3DCPEL1RZEJZ2KB73N6ICHTRF5LG%26key%3D5bca3a55116397b9a55d0ae7b3a16438', '0'),
(4, 'CPEL1W2GS20RHKZE7BXFYOJDC9', 1, '1608472150', '39ZW8smd83jKCXjx5AFDjPQE3Mb8okFLo7', '0.00288000', 55, 'bitcoin', '1608472150', '1608526150', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dcheckout%26id%3DCPEL1W2GS20RHKZE7BXFYOJDC9%26key%3D7fa9b04bdf46f5bc7958abd7fa12429b', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dstatus%26id%3DCPEL1W2GS20RHKZE7BXFYOJDC9%26key%3D7fa9b04bdf46f5bc7958abd7fa12429b', '0'),
(5, 'CPEL4XQMR903MJ4KISQ2BRR2GK', 1, '1608656455', '3F2daaVKtVdNrbVoaLbsoHqdThEzJ81NTp', '0.05222000', 1000, 'bitcoin', '1608656455', '1608710455', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dcheckout%26id%3DCPEL4XQMR903MJ4KISQ2BRR2GK%26key%3Db7ca0c0439a303d84f51aba90fc2eb3e', 'https%3A%2F%2Fwww.coinpayments.net%2Findex.php%3Fcmd%3Dstatus%26id%3DCPEL4XQMR903MJ4KISQ2BRR2GK%26key%3Db7ca0c0439a303d84f51aba90fc2eb3e', '0');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Price` text NOT NULL,
  `AttackTime` text NOT NULL,
  `Concurrent` text NOT NULL,
  `Power` text NOT NULL,
  `PPS` text NOT NULL,
  `Premium` text NOT NULL,
  `API` text NOT NULL,
  `L4` text NOT NULL,
  `L7` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `Name`, `Price`, `AttackTime`, `Concurrent`, `Power`, `PPS`, `Premium`, `API`, `L4`, `L7`, `type`) VALUES
(1, 'Starter #1', '10', '500', '1', '5', '1,200,000', '0', '0', '1', '0', 'starter'),
(2, 'Starter #2', '15', '600', '1', '5-10', '1,200,000', '0', '0', '1', '0', 'starter'),
(3, 'Starter #3', '20', '900', '1', '5-15', '2,000,000', '0', '0', '1', '0', 'starter'),
(4, 'Basic #1', '35', '1200', '1', '20-40', '4,400,000', '0', '0', '1', '1', 'basic'),
(5, 'Basic #2', '20', '1200', '1', '10', '4,400,000', '0', '0', '1', '1', 'basic'),
(6, 'Basic #3', '35', '2200', '1', '20', '5,400,00', '0', '0', '1', '1', 'basic'),
(7, 'Premium #1', '90', '3600', '2', '40-70', '8,000,000', '1', '1', '1', '1', 'premium'),
(8, 'Premium #2', '200', '7200', '2', '60-100', '11,000,000', '1', '1', '1', '1', 'premium'),
(9, 'Premium #3', '250', '7200', '3', '60-100', '11,000,000', '1', '1', '1', '1', 'premium'),
(10, 'Reseller #1', '1000', '14400', '5', '150-200', '23,000,000', '1', '1', '1', '1', 'reseller'),
(11, 'Reseller #2', '1500', '43200', '7', '250-350', '40,000,000', '1', '1', '1', '1', 'reseller'),
(12, 'Reseller #3', '2000', '86400', '10', '400-500', '60,000,000', '1', '1', '1', '1', 'reseller'),
(13, 'Enterprise #1', '600', '14400', '3', '100-150', '16,000,000', '1', '1', '1', '1', 'enterprise');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `Title` text DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Priority` text DEFAULT NULL,
  `Status` text DEFAULT NULL,
  `Date` text DEFAULT NULL,
  `userID` text DEFAULT NULL,
  `lastactivity` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Plan` text NOT NULL,
  `Expire` text NOT NULL,
  `Money` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Email`, `Password`, `Plan`, `Expire`, `Money`, `Status`) VALUES
(1, 'Demo', 'demo@garipog.com', 'cytnOE9TUEpOak9LUEo3a1Jwai9zZz09', '12', '1685564841', 273, 1),
(13, 'test', 'asfasfa@gagga.cc', 'MW42UWtLOURTREl5bjdyRkJEOG9zdz09', '0', '0', 0, 2),
(14, 'sextne', 'sextne@gmail.com', 'SzUzc2J0Z1Fta0xyZk5iTjdIMVYvZz09', '0', '0', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_api`
--

CREATE TABLE `users_api` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `api_key` text NOT NULL,
  `WhiteList` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attack_logs`
--
ALTER TABLE `attack_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `methods`
--
ALTER TABLE `methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_api`
--
ALTER TABLE `users_api`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attack_logs`
--
ALTER TABLE `attack_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `methods`
--
ALTER TABLE `methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_api`
--
ALTER TABLE `users_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
