-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 05:08 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` char(20) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `no_telp`, `alamat`, `password`, `status`) VALUES
(1, 'Admin Laundry', 'admin@gmail.com', '08999999990', 'Jakarta, Indonesia', '$2y$10$ZpEo5yfp6hov.G0BOhNPueNOgyPqiBrYiaeEos8Ets3D9/Uc9eKCC', 1),
(2, 'Admin Laundry 01', 'admin1@gmail.com', '08122346789', 'Jakarta, Indonesia', '$2y$10$4vwgI5gV0j4kMptcK3aC2.w6qHTIhWwO1H88hhQxBFJhFUL4Hu6Km', 1),
(3, 'Admin Payment', 'admin01@gmail.com', '08999900000', 'Jakarta, Indonesia', '$2y$10$D/tHVH67wHR1CSG165SXm.U02B/nNNQKCMO2.hnCtq7nq7X03iQzO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_rek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama`, `no_rek`) VALUES
(1, 'BCA', '4584937365'),
(2, 'BRI', '089754635626570'),
(3, 'MANDIRI', '026520365790218');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kode` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kel` varchar(20) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `member` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `role_id` int(1) NOT NULL,
  `tgl_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kode`, `nama`, `jenis_kel`, `alamat`, `no_telp`, `tgl_lahir`, `email`, `password`, `member`, `status`, `gambar`, `role_id`, `tgl_dibuat`) VALUES
('00001', 'Nirvana kurt cobain', 'Laki-laki', 'Los Angeles City California', '', '0000-00-00', 'nirvana@gmail.com', '$2y$10$AXBsjnuiRWrpLDZJ2O73AOTdpJnC6ElY.c60nYGp1fu5XFfYUQj1m', 0, '1', 'default.jpg', 3, '2022-06-17'),
('00003', 'Y A D', 'Laki-laki', 'Desa Mekar Kondang rt 04/02 kec. Sukadiri, Tangerang, Banten.', '08999900000', '2001-02-11', 'yad@gmail.com', '$2y$10$jREOR85bqSClOYYgDp3U9eHAeA5LOpealoav2ycLOyU78CjPXaJEe', 0, '1', 'default.jpg', 3, '2022-06-17'),
('00004', 'Aryaherbie', 'Laki-laki', 'Los Angeles City California', '', '0000-00-00', 'aryaherby29nov2k@gamail.com', '$2y$10$WIT14aoAADEA7OBV80cSbu3wfOCsoBIBTSGsVwpwJsVNbXLbM3MHS', 0, '', 'default.jpg', 3, '2022-06-17'),
('00005', 'Budi Senja', 'Laki-laki', 'Tangerang Selatan', '', '2000-06-07', 'budidddd@gmail.com', '$2y$10$X//m2OZ0fH82cXO0l.53NeRysyL3.uKdhfq74wO8DWt3KsC2AIKVq', 0, '1', 'default.jpg', 3, '2022-06-18'),
('00006', 'Irma w', 'Perempuan', 'Jakarta, Indonesia', '', '2022-07-03', 'irma@gmail.com', '$2y$10$sl8gsRDnO8EvxdFuP/Cwl.CZvLURbgvBe0Cv6IFN6sQ/MF2WZedQi', 0, '1', 'default.jpg', 3, '2022-07-03'),
('00007', 'Lala lili lulu', 'Perempuan', 'Desa Mekar Kondang rt 04/02 kec. Sukadiri, Tangerang, Banten.', '', '2000-05-10', 'lala@gmail.com', '$2y$10$N3xBSyGVzYbO2HxAP5WENuAqU.opzw0Y8FnmgKKKWBFQXfAj7CUf2', 0, '1', 'default.jpg', 3, '2022-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `kode` varchar(5) NOT NULL,
  `nama` varchar(56) NOT NULL,
  `harga` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`kode`, `nama`, `harga`) VALUES
('001', 'Selimut tipis', '15000'),
('002', 'Selimut tebal', '20000'),
('003', 'Sprei (M)', '17000'),
('004', 'Sprei (L)', '20000'),
('005', 'Sprei (XL)', '25000');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `kode` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jns_kel` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(120) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`kode`, `nama`, `tgl_lahir`, `jns_kel`, `alamat`, `no_telp`, `email`, `password`, `status`) VALUES
('00005', 'Aku Driver', '1993-04-15', 'Perempuan', 'Kp kampungan', '08987654321', 'akudriver@gmail.com', '$2y$10$l4HYEUQz1evUKDkufS/5zu5uMMZTkRm8/FfUwfzYmyb1g5ttHHIEW', '1'),
('00006', 'Driver A', NULL, '', 'Los Angeles City California', '08299900000', 'driver@gmail.com', '$2y$10$l4HYEUQz1evUKDkufS/5zu5uMMZTkRm8/FfUwfzYmyb1g5ttHHIEW', '1'),
('00007', 'Driver B', NULL, '', 'Tangerang', '08299900009', 'driverb@gmail.com', '$2y$10$kTJNYhhpYmVjaGhC6Jg9o.BD8.6Agd9yjEZcI2.ToAPDA4tYXlptO', '1');

-- --------------------------------------------------------

--
-- Table structure for table `harga_satuan`
--

CREATE TABLE `harga_satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_satuan`
--

INSERT INTO `harga_satuan` (`id`, `satuan`, `harga`) VALUES
(1, 'KG', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jns_jasa`
--

CREATE TABLE `jns_jasa` (
  `kode` char(3) NOT NULL,
  `jenis` varchar(35) NOT NULL,
  `harga` varchar(11) NOT NULL,
  `estimasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jns_jasa`
--

INSERT INTO `jns_jasa` (`kode`, `jenis`, `harga`, `estimasi`) VALUES
('001', 'Reguler', '5000', '3 hari'),
('002', 'Express', '8000', '1 hari');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `kode_pesan` varchar(15) NOT NULL,
  `nilai` int(1) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `komentar` varchar(120) NOT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `kode_pesan`, `nilai`, `nama`, `komentar`, `waktu`) VALUES
(4, 'LND220623011', 5, 'Irma w', 'Kasih bintang 5 karna saya puas dengan hasil laundry ini', '2022-07-03'),
(5, 'LND220623003', 4, 'YAD', 'Pengerjaan cepat dan hasilnya tidak mengecewakan', '2022-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `kode` varchar(15) NOT NULL,
  `kode_customer` varchar(10) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jenis_barang` varchar(5) NOT NULL,
  `barang` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `keterangan` varchar(120) DEFAULT NULL,
  `alamat` varchar(60) NOT NULL,
  `harga` varchar(20) DEFAULT NULL,
  `diskon` char(11) DEFAULT NULL,
  `netto` varchar(35) DEFAULT NULL,
  `jns_jasa` varchar(10) NOT NULL,
  `jam` varchar(10) NOT NULL,
  `driver` varchar(20) NOT NULL,
  `bayar` varchar(2) NOT NULL,
  `penilaian` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`kode`, `kode_customer`, `no_telp`, `jenis_barang`, `barang`, `tanggal`, `qty`, `status`, `keterangan`, `alamat`, `harga`, `diskon`, `netto`, `jns_jasa`, `jam`, `driver`, `bayar`, `penilaian`) VALUES
('LND220623003', '00003', '08987654321', 'KG', '', '2022-06-23', 10, 'S', '', 'Tangerang', '50000', '2500', '47500', '002', '20:54', '00006', 'YY', 'Y'),
('LND220623004', '00003', '08999900000', 'KG', '', '2022-06-23', 11, 'D', 'Mau pesen yg express', 'Los Angeles City California', NULL, '0', '', '002', '', '00007', '', ''),
('LND220623007', '00001', '08999999090', 'KG', '', '2022-06-25', 3, 'D', '', 'Tangerang', NULL, NULL, NULL, '002', '14:51', '00006', '', ''),
('LND220623008', '00003', '08999999090', 'KG', '', '2022-06-25', 11, 'D', '', 'Desa Mekar Kondang rt 04/02 kec. Sukadiri, Tangerang, Banten', '55000', '2750', '60250', '002', '16:15', '00007', '', ''),
('LND220623009', '00005', '08999999090', 'UNIT', 'Selimut tebal', '2022-06-26', 1, 'S', '', 'Tangerang Selatan', '15000', '0', '23000', '002', '04:39', '00007', 'Y', ''),
('LND220623010', '00006', '08999999090', 'UNIT', 'Selimut tipis', '2022-07-03', 2, 'D', '', 'Jakarta, Indonesia', '34000', '0', '39000', '001', '09:10', '00006', '', ''),
('LND220623011', '00006', '', 'KG', '', '2022-07-03', 12, 'S', '', 'Jakarta, Indonesia', '60000', '3000', '65000', '002', '09:11', '00006', 'YY', 'Y'),
('LND220623012', '00007', '08898765321', 'KG', '', '2022-08-10', 12, 'S', '', 'Desa Mekar Kondang rt 04/02 kec. Sukadiri, Tangerang, Banten', '60000', '3000', '62000', '001', '16:17', '00005', 'YY', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `kode` varchar(15) NOT NULL,
  `pesanan` varchar(20) NOT NULL,
  `bank` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`kode`, `pesanan`, `bank`, `tanggal`, `gambar`) VALUES
('TRN220627001', 'LND220623009', 'BRI', '2022-06-27', '13844228ea432401.png'),
('TRN220627002', 'LND220623002', 'BRI', '2022-06-29', 'bismillah4.jpeg'),
('TRN220627003', 'LND220623003', 'BRI', '2022-07-02', 'tele6.png'),
('TRN220627004', 'LND220623011', 'BRI', '2022-07-03', 'tele7.png'),
('TRN220627005', 'LND220623012', 'BCA', '2022-08-10', 'strukbca.png');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_barang`
--

CREATE TABLE `tipe_barang` (
  `id` int(11) NOT NULL,
  `jenis_barang` varchar(35) NOT NULL,
  `satuan` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_barang`
--

INSERT INTO `tipe_barang` (`id`, `jenis_barang`, `satuan`) VALUES
(1, 'Kiloan', 'KG'),
(2, 'Unit', 'UNT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `harga_satuan`
--
ALTER TABLE `harga_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jns_jasa`
--
ALTER TABLE `jns_jasa`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `harga_satuan`
--
ALTER TABLE `harga_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
