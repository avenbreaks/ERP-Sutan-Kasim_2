-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2017 at 01:44 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dunlop_erp`
--
CREATE DATABASE IF NOT EXISTS `dunlop_erp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dunlop_erp`;

-- --------------------------------------------------------

--
-- Table structure for table `bukti_transfer`
--

CREATE TABLE IF NOT EXISTS `bukti_transfer` (
  `id_transfer` varchar(11) NOT NULL,
  `id_order` varchar(11) NOT NULL,
  `nama_bank` varchar(3) NOT NULL,
  `jumlah` double NOT NULL,
  `file` text NOT NULL,
  `tgl` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_transfer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti_transfer`
--

INSERT INTO `bukti_transfer` (`id_transfer`, `id_order`, `nama_bank`, `jumlah`, `file`, `tgl`) VALUES
('TRF00000001', 'REF00000001', 'bca', 1469000, '13-12-2017_TRF00000001_REF00000001.png', '2017-12-13 14:06:38'),
('TRF00000002', 'REF00000002', 'bni', 4049760, '14-12-2017_TRF00000002_REF00000002.jpg', '2017-12-14 19:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE IF NOT EXISTS `gudang` (
  `id_datagudang` varchar(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `stok` int(10) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1= masuk, 2=keluar',
  PRIMARY KEY (`id_datagudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(6) NOT NULL,
  `tmp_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL DEFAULT '0000-00-00',
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `jk`, `tmp_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `email`, `foto`, `tgl_daftar`) VALUES
('KRY00000001', 'CHIKA JESSICA', 'wanita', 'JAKARTA', '1992-12-12', 'PADANG ', '0812-3456-7890', 'chika.j@gmail.com', 'KRY00000001.jpg', '2017-12-13 16:00:12'),
('KRY00000002', 'ERI YUSMANTO', 'pria', 'UNKNOWN', '1111-11-11', 'unknown', '1111-1111-1111', 'unknown@email.com', 'KRY00000002.jpg', '2017-12-13 16:19:02'),
('KRY00000003', 'GUDANG', 'pria', 'UNKNOWN', '0000-00-00', 'unknown', '0129-3810-2938', 'unknown@email.com', 'KRY00000003.jpg', '2017-12-13 21:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` varchar(6) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
('CTG002', 'SUV'),
('CTG003', 'SPORT'),
('CTG005', 'MPV'),
('CTG006', 'TRUCK/PICK-UP');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
  `id_kendaraan` varchar(11) NOT NULL,
  `id_kategori` varchar(6) NOT NULL,
  `nama_kendaraan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kendaraan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `id_kategori`, `nama_kendaraan`) VALUES
('CAR00000001', 'CTG002', 'TOYOTA AYLA'),
('CAR00000002', 'CTG002', 'HONDA JAZZ');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_user` varchar(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(2) NOT NULL,
  `blokir` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `username`, `password`, `level`, `blokir`) VALUES
('KRY00000001', 'sales', '9ed083b1436e5f40ef984b28255eef18', 3, 0),
('KRY00000002', 'yuto', 'f1674fa8b5d4560ec5e85339674c1bd9', 4, 0),
('KRY00000003', 'gudang', '202446dd1d6028084426867365b0c7a1', 5, 0),
('superadmin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0),
('U_M00000002', 'eri', '1f5198faff59782cd71dba9588e45697', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` varchar(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `pos` varchar(6) NOT NULL,
  `pemilik` varchar(50) NOT NULL,
  `email` varchar(32) NOT NULL,
  `foto_member` text NOT NULL,
  `tgl_daftar` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama_toko`, `no_telp`, `alamat`, `kota`, `pos`, `pemilik`, `email`, `foto_member`, `tgl_daftar`) VALUES
('U_M00000002', 'TOKO DUNLOP KARYA ANAK BANGSA', '085272617133', 'Jl. Tanjung aua nan XX,No 35', 'Padang Kota', '255555', 'Eri Yusmanto', 'eriyusmanto@gmail.com', 'U_M00000002.jpg', '2017-11-30 23:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` varchar(11) NOT NULL,
  `id_member` varchar(11) NOT NULL,
  `id_transfer` varchar(11) NOT NULL,
  `id_promo` varchar(11) NOT NULL,
  `tipe_pembayaran` varchar(7) NOT NULL,
  `tgl_order` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_bayar` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL COMMENT '1=order, 2=bayar, 3=transfer',
  `validasi` varchar(3) NOT NULL,
  `diskon` double NOT NULL,
  `total` double NOT NULL,
  `view` varchar(5) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_member`, `id_transfer`, `id_promo`, `tipe_pembayaran`, `tgl_order`, `tgl_bayar`, `status`, `validasi`, `diskon`, `total`, `view`) VALUES
('REF00000001', 'U_M00000002', 'TRF00000001', '0', 'bca', '2017-12-13 14:05:11', '2017-12-13 14:06:38', 3, 'yes', 0, 1469000, '123'),
('REF00000002', 'U_M00000002', 'TRF00000002', 'EVN00000001', 'bni', '2017-12-13 17:47:07', '2017-12-14 19:38:26', 3, 'yes', 12, 4602000, '123'),
('REF00000003', 'U_M00000002', '0', '0', '0', '2017-12-14 19:29:18', '0000-00-00 00:00:00', 1, '0', 0, 6227000, '123');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE IF NOT EXISTS `orders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `jumlah_order` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `id_order`, `id_produk`, `jumlah_order`) VALUES
(1, 'REF00000001', 'PRD00000011', 1),
(2, 'REF00000002', 'PRD00000011', 1),
(3, 'REF00000002', 'PRD00000005', 1),
(4, 'REF00000002', 'PRD00000001', 1),
(6, 'REF00000003', 'PRD00000010', 1),
(7, 'REF00000003', 'PRD00000009', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` varchar(11) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `ukuran_pelek` double NOT NULL,
  `lebar_ban` double NOT NULL,
  `speed_rating` varchar(2) NOT NULL,
  `stok` int(10) NOT NULL,
  `harga` double NOT NULL,
  `id_kategori` varchar(6) NOT NULL,
  `foto_produk` text NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `deskripsi`, `ukuran_pelek`, `lebar_ban`, `speed_rating`, `stok`, `harga`, `id_kategori`, `foto_produk`) VALUES
('PRD00000001', 'Dunlop Grandtrek AT20', 'Drive your luxury SUV in quiet comfort.', 8, 9.8, 'S', 299, 1170000, 'CTG002', 'Dunlop_Grandtrek_At20.jpg'),
('PRD00000002', 'Grandtrek AT21', 'An original equipment, all-season truck and SUV tire.', 8, 10.7, 'S', 300, 2834000, 'CTG002', 'Grandtrek_At21.jpg'),
('PRD00000003', 'Grandtrek St20', 'An original equipment, all-season truck and SUV tire.', 6.5, 8.7, 'S', 300, 2574000, 'CTG002', 'Grandtrek_St20.jpg'),
('PRD00000004', 'Dunlop Grandtrek St30', 'An original equipment, all-season truck and SUV tire.', 7, 9.8, 'S', 300, 2886000, 'CTG002', 'Dunlop_Grandtrek_St30.jpg'),
('PRD00000005', 'Dunlop Winter Maxx Sj8', 'An original equipment, all-season truck and SUV tire.', 7, 9.8, 'R', 299, 1963000, 'CTG002', 'Dunlop_Winter_Maxx_Sj8.jpg'),
('PRD00000006', 'Dunlop Signature Cs', 'An original equipment, all-season truck and SUV tire.', 7, 8.9, 'S', 300, 1495000, 'CTG002', 'Dunlop_Signature_Cs.jpg'),
('PRD00000007', 'Grandtrek Pt2a', 'Balances a luxury ride with off-road performance.', 9, 11.7, 'V', 300, 5824000, 'CTG006', 'Grandtrek_Pt2a.jpg'),
('PRD00000008', 'Mud Rover', 'An original equipment, all-season truck and SUV tire.', 8, 9.8, 'U', 300, 5954000, 'CTG006', 'Mud_Rover.jpg'),
('PRD00000009', 'Dunlop Direzza Sport Z1 Star Spec', 'An ultra high-performance summer tire.', 8, 9, 'T', 300, 1560000, 'CTG003', 'Dunlop_Direzza_Sport_Z1_Star_Spec.jpg'),
('PRD00000010', 'Dunlop Grandtrek Wt M3 Dsst Rof', 'An ultra high-performance summer tire.', 8, 10.4, 'H', 300, 4667000, 'CTG003', 'Dunlop_Grandtrek_Wt_M3_Dsst_Rof.jpg'),
('PRD00000011', 'Dunlop Signature Hp', 'Bold style meets experienced handling for all-season performance.', 6.5, 8.4, 'V', 298, 1469000, 'CTG005', 'Dunlop_Signature_Hp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` varchar(11) NOT NULL,
  `judul_promo` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `kode_promo` varchar(8) NOT NULL,
  `besar_promo` double NOT NULL,
  `min_order` double NOT NULL,
  `mulai_promo` date NOT NULL DEFAULT '0000-00-00',
  `akhir_promo` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `judul_promo`, `deskripsi`, `kode_promo`, `besar_promo`, `min_order`, `mulai_promo`, `akhir_promo`) VALUES
('EVN00000001', 'ASD', 'ASDASDA', 'O27V1HM8', 12, 123123, '2017-10-10', '2019-06-15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
