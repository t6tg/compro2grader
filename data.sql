-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 01, 2019 at 05:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `data`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `class` varchar(10) NOT NULL,
  `status` varchar(255) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manual`
--

CREATE TABLE `manual` (
  `id` int(11) NOT NULL,
  `week` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `week` varchar(100) NOT NULL,
  `score` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(100) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `week`, `score`, `status`, `type`) VALUES
(1, 'w1_n1', 30, 1, '1'),
(2, 'link6', 11, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `id` int(11) NOT NULL,
  `server_st` int(11) NOT NULL DEFAULT '0',
  `ban` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`id`, `server_st`, `ban`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` int(11) NOT NULL DEFAULT '2',
  `w1_n1` varchar(100) DEFAULT NULL,
  `link6` varchar(100) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'user',
  `server` int(11) NOT NULL DEFAULT '1',
  `ip` varchar(100) DEFAULT NULL,
  `ban` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `password`, `name`, `class`, `w1_n1`, `link6`, `status`, `server`, `ip`, `ban`) VALUES
(1, '47473', 'd41d8cd98f00b204e9800998ecf8427e', 'ธนวัฒน์ กุลาตี', 2, NULL, NULL, 'user', 1, '', 1),
(2, '47472', '2d01216e288ff2a1a0fd90c4a4b6bd0c', 'ธนวัฒน์ กุลาตีตี', 2, NULL, NULL, 'user', 1, '', 1),
(3, 'j', '363b122c528f54df4a0446b6bab05515', 'thanawatgulati', 2, '30.00', NULL, 'user', 1, '::1', 1),
(5, 'admin', 'b4cc344d25a2efe540adbf2678e2304c', 'thanawatgulati', 2, NULL, NULL, 'user', 1, '::1', 1),
(13, '6104062630301', 'b4cc344d25a2efe540adbf2678e2304c', 'ธนวัฒน์ กุลาตี', 2, NULL, NULL, 'user', 1, '::1', 1),
(14, '6104062630302', '870b862fdb3b3f1900f409a92c90221d', '????? ????', 3, NULL, NULL, 'user', 0, NULL, 1),
(15, '6104062630303', 'a10c952a54aaa3bb0d226ead16aa1ab8', '??????? ????????', 2, NULL, NULL, 'user', 1, NULL, 1),
(16, '6104062630304', 'e4f9bbf3c46043bcb837b3cf37460615', '?????? ???????', 1, NULL, NULL, 'user', 1, NULL, 1),
(17, '61040626303305', '6cfd9fdab4f1afd7d73e19e89653f58e', '?????? ????????', 4, NULL, NULL, 'user', 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual`
--
ALTER TABLE `manual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual`
--
ALTER TABLE `manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
