-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2020 at 08:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streser`
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
(1, 'Gari', '827ccb0eea8a706c4c34a16891f84e7b');

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
  `slots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `name`, `ip`, `link`, `layer`, `slots`) VALUES
(1, 'Botnet Ve 1', '1.1.1.1', 'http://test.com/', 4, 10),
(2, 'Warzone_L7', '2.2.2.2', 'http://test.com/', 7, 10),
(3, 'Imperia_L7', '2.5.2.1', 'http://test.com/', 7, 10);

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
(1, '1', '5.3.3.3', 80, 100, '2', 1609840937, 0, '1'),
(151, '1', '1', 1, 1, '2', 1, 0, '1'),
(152, '1', '1', 1, 1, '2', 1910, 0, '1'),
(153, '1', '1', 1, 1, '2', 1910, 0, '1'),
(154, '1', '1', 1, 21, '2', 22222, 0, '1'),
(155, '1', '1.1.1.1', 21, 21, '2', 1910, 0, '1'),
(156, '1', '1.1.1.1', 80, 21, '2', 1910, 0, '1'),
(157, '1', '1.1.1.1', 8022, 21, '2', 1910, 0, '1'),
(158, '1', '1.1.1.1', 8022, 1800, '1', 1910, 0, '1'),
(159, '1', 'https://google.com', 0, 11, '2', 1910, 0, '1'),
(160, '1', 'https://google.com', 0, 11, '2', 1910, 0, '1'),
(161, '1', '1.1.1.1', 11, 11, '1', 1910, 0, '1'),
(162, '1', '1.1.1.1', 11, 11, '1', 1910, 0, '1'),
(169, '1', '1', 1, 1, '2', 1, 0, '1');

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
(1, 'Layer4', 4),
(2, 'Layer7', 7);

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
(3, 'Its just for a test !', 'This is message for test of News!', '13.10.2020 21:53:pm', '1602618804'),
(4, 'Seconds', 'Brate treniram karate, Nadj je najjaci :D. Ide gass mala radi sve za nadjaBrate treniram karate, Nadj je najjaci :D. Ide gas... Brate treniram karate, Nadj je najjaci :D. Ide gas...', '13.10.2020 21:53:pm', '1602618839');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `order_id` int(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `timestamp` text NOT NULL,
  `addr` text NOT NULL,
  `txid` text NOT NULL,
  `status` text NOT NULL,
  `value` text NOT NULL,
  `bits` text NOT NULL,
  `bits_payed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`order_id`, `userID`, `timestamp`, `addr`, `txid`, `status`, `value`, `bits`, `bits_payed`) VALUES
(25102710, 1, '1602409544', '12RbXzkFU5nnrLJzBtirrinic8BLfrz6Ro', '', '-1', '15', '156774', '0'),
(73463560, 1, '1602613721', '1L9VPzM5QhFd8SRzrvqCeUXdVeVYJ2Tu7M', '', '-1', '5', '51488', '0'),
(97198525, 1, '1603188733', '17e5L8sX8DKmibdayaasgPkzjGULVicY2d', '', '-1', '1', '10011', '0'),
(2147483647, 1, '1', '', 'test', '2', '2.00', '22096', '42096');

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
  `AmpPower` text NOT NULL,
  `PPS` text NOT NULL,
  `Premium` text NOT NULL,
  `API` text NOT NULL,
  `L4` text NOT NULL,
  `L7` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `Name`, `Price`, `AttackTime`, `Concurrent`, `AmpPower`, `PPS`, `Premium`, `API`, `L4`, `L7`) VALUES
(1, 'Basic', '10', '300', '1', '1', '65,000', '0', '0', '1', '1'),
(2, 'Basic', '15', '1800', '2', '10', '400,000', '0', '0', '1', '1');

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

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `Title`, `Message`, `Priority`, `Status`, `Date`, `userID`, `lastactivity`) VALUES
(29, 'alert(&#39;test&#39;)', 'alert(&#39;test&#39;)', '1', '2', '22/10/2020, 16:46:03', '1', '1603377963'),
(30, 'alert(&#39;test&#39;)', 'alert(&#39;test&#39;)', '1', '1', '22/10/2020, 16:46:03', '1', '1603377963');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_answ`
--

CREATE TABLE `ticket_answ` (
  `id` int(11) NOT NULL,
  `tID` text DEFAULT NULL,
  `userID` text DEFAULT NULL,
  `supportID` text DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Date` text DEFAULT NULL,
  `lastactivity` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_answ`
--

INSERT INTO `ticket_answ` (`id`, `tID`, `userID`, `supportID`, `Message`, `Date`, `lastactivity`) VALUES
(8, '29', '1', '', '$Support-&gt;ticketsByUser($User-&gt;UserData()[&#39;id&#39;], 0)', '22/10/2020, 16:46pm', '1603377990'),
(9, '30', '1', '', 'alert(&#39;Lucid is gay&#39;);', '22/10/2020, 21:22pm', '1603394520'),
(10, '30', '1', '', 'test', '23/10/2020, 21:47pm', '1603482450'),
(11, '30', '1', '', 'alert(&#39;testastastast&#39;);kita', '25/10/2020, 01:19am', '1603581555'),
(12, '30', '1', '', 'alert(&#39;gazda gei&#39;); test gazda gey', '25/10/2020, 18:24pm', '1603646641'),
(13, '29', '', '1', '123', '26/10/2020, 11:28am', '1603708123'),
(14, '29', '1', '', 'Y000!', '26/10/2020, 23:02pm', '1603749726');

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
  `Token` text NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Email`, `Password`, `Plan`, `Expire`, `Money`, `Token`, `Status`) VALUES
(1, 'Gari', 'gari@warzone.to', '827ccb0eea8a706c4c34a16891f84e7b', '2', '1605564841', 273, '1', 1);

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
-- Dumping data for table `users_api`
--

INSERT INTO `users_api` (`id`, `userID`, `api_key`, `WhiteList`) VALUES
(7, 1, 'cfXSXzUDp3', '37.120.223.3|37.120.223.7|37.120.223.9');

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
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
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
-- Indexes for table `ticket_answ`
--
ALTER TABLE `ticket_answ`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attack_logs`
--
ALTER TABLE `attack_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `methods`
--
ALTER TABLE `methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ticket_answ`
--
ALTER TABLE `ticket_answ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_api`
--
ALTER TABLE `users_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
