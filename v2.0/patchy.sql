-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2015 at 11:39 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `patchy`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isAccountType` int(1) NOT NULL DEFAULT '1',
  `uniqueSalt` varchar(512) NOT NULL,
  `otherUniqueSalt` varchar(512) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(384) NOT NULL,
  `accountCreatedIP` varchar(15) NOT NULL,
  `signUpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usedPatches` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `isActive`, `isAccountType`, `uniqueSalt`, `otherUniqueSalt`, `username`, `email`, `password`, `accountCreatedIP`, `signUpDate`, `usedPatches`) VALUES
(1, 1, 4, '5dc638d0f477c0e28f47a17696747ce3a93cacdfd2249e3a28a80aa53604f5ee2099d5e26296b515c70052e4a509a432509516ca3bb1bf7ad56be30ff6946784', '5f8cb55b6efa59ab2d149ae9145f606eb5a7a3310948bfb63d34ead94c92a427ffd7698ece2083a44073a80a2cf6e7ae293bd5b5ad6651e68aa06cda5375fb16', 'cryptic', 'jakemcneill83@me.com', 'd9daaf4e27e2a060b6de30806f0c7e529fc2ee000c9ba7bc2c75ae45d2e4bb0604e4f9937015ee6db7dd65b85a1820b2bd0222b7e61abe1ee1b4630260d26324', '::1', '2015-10-04 10:15:03', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
