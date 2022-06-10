-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2022 at 04:12 PM
-- Server version: 10.3.34-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qokpseqj_sutra_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `hairstylist`
--

CREATE TABLE `hairstylist` (
  `id_hairstylist` int(10) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) DEFAULT NULL,
  `keahlian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hairstylist`
--

INSERT INTO `hairstylist` (`id_hairstylist`, `nama_depan`, `nama_belakang`, `keahlian`) VALUES
(1225415, 'Sari', 'Putri', 'Facial Treatment,Body Scrub'),
(1252757, 'Mira', 'Sumirah', 'Makeup On The Spot,Beauty Makeup'),
(1875221, 'Dea', 'Mutiara', 'Makeup On The Spot,Beauty Makeup'),
(2353432, 'Putri', 'Dini', 'Makeup On The Spot,Beauty Makeup'),
(2832634, 'Dina', 'Mutiara', 'Body Scrub,Manicure,Pedicure'),
(4132412, 'Mutia', 'Luren', 'Pedicure'),
(8926861, 'Alisa', 'Laurey', 'Hair Cut,Hair Coloring,Hair Creambath'),
(9162751, 'Cica', 'Marsela', 'Hair Mask,Hair Coloring,Hair Creambath'),
(9823732, 'Melia', 'Sasa', 'Hair Cut,Smothing,Hair Mask,Smothing'),
(9834834, 'Nindi', 'Lestari', 'Manicure,Pedicure,Smothing'),
(11223344, 'Stephen', 'Jonathan', 'Hair Cut,Hair Coloring,Hair Mask');

-- --------------------------------------------------------

--
-- Table structure for table `melayani`
--

CREATE TABLE `melayani` (
  `id_hairstylist` int(10) NOT NULL,
  `id_treatment` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `melayani`
--

INSERT INTO `melayani` (`id_hairstylist`, `id_treatment`) VALUES
(8926861, 123001);

-- --------------------------------------------------------

--
-- Table structure for table `mencatat`
--

CREATE TABLE `mencatat` (
  `id_user` int(10) NOT NULL,
  `id_hairstylist` int(10) NOT NULL,
  `id_treatment` int(10) NOT NULL,
  `id_trx` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mencatat`
--

INSERT INTO `mencatat` (`id_user`, `id_hairstylist`, `id_treatment`, `id_trx`) VALUES
(926678, 8926861, 123001, 4267798);

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `id_treatment` int(10) NOT NULL,
  `nama_treatment` varchar(50) NOT NULL,
  `kategori_treatment` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`id_treatment`, `nama_treatment`, `kategori_treatment`, `harga`) VALUES
(123000, 'Hair Cut', 'Hair Treatment', 120000),
(123001, 'Hair Coloring', 'Hair Treatment', 300000),
(123002, 'Smothing', 'Hair Treatment', 230000),
(123003, 'Hair Creambath', 'Hair Treatment', 290000),
(123004, 'Hair Mask', 'Hair Treatment', 120000),
(124000, 'Facial Treatment', 'Body Treatment', 400000),
(124001, 'Body Scrub', 'Body Treatment', 280000),
(124002, 'Manicure', 'Body Treatment', 340000),
(124003, 'Pedicure', 'Body Treatment', 300000),
(125000, 'Beauty Makeup', 'Makeup', 150000),
(125001, 'Makeup On The Spot', 'Makeup', 180000);

-- --------------------------------------------------------

--
-- Table structure for table `trx_pesanan`
--

CREATE TABLE `trx_pesanan` (
  `id_trx` int(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `time_trx` datetime NOT NULL,
  `waktu_pemesanan` datetime NOT NULL,
  `metode_pembayaran` varchar(15) NOT NULL,
  `status` enum('SUDAH','BELUM') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_pesanan`
--

INSERT INTO `trx_pesanan` (`id_trx`, `harga`, `time_trx`, `waktu_pemesanan`, `metode_pembayaran`, `status`) VALUES
(4267798, 300100, '2022-01-07 11:00:00', '2022-01-05 21:49:10', 'OVO', 'BELUM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) NOT NULL,
  `level` varchar(50) NOT NULL,
  `aktif` enum('NO','YES') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_depan`, `nama_belakang`, `no_telp`, `level`, `aktif`) VALUES
(876307, 'saveroa4@gmail.com', '916865', 'Adriel', 'Savero', '081372749897', 'member', 'YES'),
(926678, 'fisa29bilia@gmail.com', 'fisa29fisa', 'fisa', 'bilia', '082293096997', 'member', 'YES'),
(12345678, 'nathan@gmail.com', 'nathan1234', 'Nathan', 'Lorent', '0821987621', 'admin', 'YES');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hairstylist`
--
ALTER TABLE `hairstylist`
  ADD PRIMARY KEY (`id_hairstylist`);

--
-- Indexes for table `melayani`
--
ALTER TABLE `melayani`
  ADD KEY `id_hairstylist` (`id_hairstylist`),
  ADD KEY `id_treatment` (`id_treatment`);

--
-- Indexes for table `mencatat`
--
ALTER TABLE `mencatat`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_hairstylist` (`id_hairstylist`),
  ADD KEY `id_treatment` (`id_treatment`),
  ADD KEY `id_trx` (`id_trx`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`id_treatment`);

--
-- Indexes for table `trx_pesanan`
--
ALTER TABLE `trx_pesanan`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `melayani`
--
ALTER TABLE `melayani`
  ADD CONSTRAINT `melayani_ibfk_1` FOREIGN KEY (`id_hairstylist`) REFERENCES `hairstylist` (`id_hairstylist`),
  ADD CONSTRAINT `melayani_ibfk_2` FOREIGN KEY (`id_treatment`) REFERENCES `treatment` (`id_treatment`);

--
-- Constraints for table `mencatat`
--
ALTER TABLE `mencatat`
  ADD CONSTRAINT `mencatat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `mencatat_ibfk_2` FOREIGN KEY (`id_hairstylist`) REFERENCES `hairstylist` (`id_hairstylist`),
  ADD CONSTRAINT `mencatat_ibfk_3` FOREIGN KEY (`id_treatment`) REFERENCES `treatment` (`id_treatment`),
  ADD CONSTRAINT `mencatat_ibfk_4` FOREIGN KEY (`id_trx`) REFERENCES `trx_pesanan` (`id_trx`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
