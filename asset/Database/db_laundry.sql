-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 09:07 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_packets`
--

CREATE TABLE `tbl_packets` (
  `packets_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_packets`
--

INSERT INTO `tbl_packets` (`packets_id`, `name`, `price`) VALUES
(2, 'Celana', 2000),
(4, 'Baju', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `name` enum('Cash','Bayar Nanti') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `name`) VALUES
(6, 'Cash'),
(8, 'Bayar Nanti');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `transaction_id` bigint(20) NOT NULL,
  `pelanggan_id` varchar(12) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_status` enum('Baru','Proses','Sudah Selesai') NOT NULL,
  `transaction_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`transaction_id`, `pelanggan_id`, `payment_id`, `transaction_date`, `transaction_status`, `transaction_total`) VALUES
(20000001, '10000001', 6, '2020-12-02', 'Baru', 4000),
(20000002, '10000001', 6, '2020-12-02', 'Baru', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_detail`
--

CREATE TABLE `tbl_transaction_detail` (
  `id` int(11) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `packets_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `transaction_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction_detail`
--

INSERT INTO `tbl_transaction_detail` (`id`, `transaction_id`, `packets_id`, `weight`, `transaction_total`) VALUES
(46, 20000001, 2, 1, 2000),
(47, 20000001, 4, 1, 2000),
(48, 20000002, 2, 10, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_detail_temp`
--

CREATE TABLE `tbl_transaction_detail_temp` (
  `id` int(11) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `packets_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `transaction_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `users_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(40) NOT NULL,
  `roles` enum('Petugas','Pelanggan') NOT NULL,
  `petugas_id` varchar(12) DEFAULT NULL,
  `pelanggan_id` varchar(12) DEFAULT NULL,
  `point` varchar(20) NOT NULL,
  `no_hp` int(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`users_id`, `username`, `password`, `name`, `roles`, `petugas_id`, `pelanggan_id`, `point`, `no_hp`, `alamat`, `photo`) VALUES
(1, 'nmilenia58', 'admin', 'Nadia', 'Petugas', 'A001', '10000003', '0', 812345678, 'Jl. Penjajahan', ''),
(3, 'biskandar129', 'admin', 'Bayu', 'Pelanggan', NULL, '10000001', '0.2', 812345678, 'Jl. Penjajahan', ''),
(10, 'cantikatikaaaaa', 'admin', 'Cantika', 'Pelanggan', NULL, '10000002', '0', 812345678, 'Jl. Penjajahan', ''),
(11, '123', '123', 'asd1', 'Pelanggan', NULL, '10000004', '0', 852165451, 'alamat', ''),
(12, '123', '123', '123', 'Pelanggan', NULL, '10000005', '0', 123, '123', ''),
(13, '123', '123', '123', 'Pelanggan', NULL, '10000006', '0', 123, '123', ''),
(14, '123', '123', '123', 'Pelanggan', NULL, '10000007', '0', 123, '123', ''),
(15, 'bayuganteng', 'apaaja', 'Bayu Ganteng', 'Pelanggan', NULL, '10000008', '0', 81230192, 'Bogor', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_packets`
--
ALTER TABLE `tbl_packets`
  ADD PRIMARY KEY (`packets_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `Pelanggan_FK` (`pelanggan_id`),
  ADD KEY `Payment_FK` (`payment_id`);

--
-- Indexes for table `tbl_transaction_detail`
--
ALTER TABLE `tbl_transaction_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Transaction_FK` (`transaction_id`),
  ADD KEY `Packets` (`packets_id`);

--
-- Indexes for table `tbl_transaction_detail_temp`
--
ALTER TABLE `tbl_transaction_detail_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `Pelanggan_UK` (`pelanggan_id`),
  ADD UNIQUE KEY `Petugas_UK` (`petugas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_packets`
--
ALTER TABLE `tbl_packets`
  MODIFY `packets_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `transaction_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20000018;

--
-- AUTO_INCREMENT for table `tbl_transaction_detail`
--
ALTER TABLE `tbl_transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_transaction_detail_temp`
--
ALTER TABLE `tbl_transaction_detail_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD CONSTRAINT `Payment_FK` FOREIGN KEY (`payment_id`) REFERENCES `tbl_payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Pelanggan_FK` FOREIGN KEY (`pelanggan_id`) REFERENCES `tbl_user` (`pelanggan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transaction_detail`
--
ALTER TABLE `tbl_transaction_detail`
  ADD CONSTRAINT `Packets` FOREIGN KEY (`packets_id`) REFERENCES `tbl_packets` (`packets_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Transaction_FK` FOREIGN KEY (`transaction_id`) REFERENCES `tbl_transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
