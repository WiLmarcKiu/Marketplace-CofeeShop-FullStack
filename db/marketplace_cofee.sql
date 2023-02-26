-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2022 pada 05.25
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace_cofee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `foto_admin` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`, `foto_admin`) VALUES
(1, 'Wilmarc Kiu', 'baron@gmail.com', 'baron', 'admin.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kedai`
--

CREATE TABLE `kedai` (
  `id_kedai` int(11) NOT NULL,
  `nama_kedai` varchar(500) NOT NULL,
  `telepon_kedai` varchar(13) NOT NULL,
  `email_kedai` varchar(500) NOT NULL,
  `alamat_kedai` varchar(900) NOT NULL,
  `no_rekening` int(11) NOT NULL,
  `bank` varchar(500) NOT NULL,
  `rekening_atas_nama` varchar(500) NOT NULL,
  `logo_kedai` varchar(900) NOT NULL,
  `nama_pemilik` varchar(500) NOT NULL,
  `nik` int(18) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` varchar(100) NOT NULL,
  `alamat_pemilik` text NOT NULL,
  `tanggal_daftar` varchar(500) NOT NULL,
  `email_pemilik` varchar(500) NOT NULL,
  `telepon_pemilik` int(13) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `foto_pemilik` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kedai`
--

INSERT INTO `kedai` (`id_kedai`, `nama_kedai`, `telepon_kedai`, `email_kedai`, `alamat_kedai`, `no_rekening`, `bank`, `rekening_atas_nama`, `logo_kedai`, `nama_pemilik`, `nik`, `tempat_lahir`, `tanggal_lahir`, `jk`, `alamat_pemilik`, `tanggal_daftar`, `email_pemilik`, `telepon_pemilik`, `username`, `password`, `foto_pemilik`) VALUES
(1, 'kullo', '081233445667', 'kullo@gmail.com', 'jln.tamrin', 123456789, 'BANK BRI', 'aron', 'kedai1.jpg', 'Aron Kiu', 351223456, 'rote', '2016-09-06', 'Laki - Laki', 'jln.soverdi', '26-08-2022', 'aron@gmail.com', 876543498, 'aron', '123', 'aron.jpeg'),
(2, 'koi', '082345543123', 'koi@gmail.com', 'eltari', 998877, 'BANK BCA', 'arken', 'kedai2.jpg', 'arken', 352443355, 'kupang', '2022-05-25', 'Laki - Laki', 'oebobo', '', 'arken@gmail.com', 81234543, 'arken ', '111', 'arken.jpg'),
(3, 'Say Story', '087213432234', 'ss@gmail.com', 'oebufu', 9988776, 'BANK NTT', 'yoel', 'logo.png', 'yoel', 352341565, 'tiles', '2021-06-14', 'Laki - Laki', 'BTN kolhua', '', 'yoel@gmail.com', 82333213, 'yoel', '223', 'yoel.jpg'),
(4, 'Cendol', '082311233433', 'cendol@gmail.com', 'kelapa lima', 998776, 'BANK MANDIRI', 'ekhy', 'logoo.jpg', 'ekhy', 352345543, 'camplong', '2019-11-10', 'Laki - Laki', 'oesapa', '', 'ekhy@gmail.com', 81234432, 'ekhy', '333', 'ekhy.jpg'),
(5, 'beta cafe', '087213432234', 'beta@gmail.com', 'tuak daun merah', 9966554, 'BANK NTT', 'putra', 'kedai5.png', 'putra', 352456789, 'rote', '2021-04-04', 'Laki - Laki', 'jln.bejawa', '', 'putra@gmail.com', 85432234, 'putra', '321', 'putra.jpg'),
(6, 'ww cafe', '082345543109', 'ww@gmail.com', 'kayu putih', 88776655, 'BANK BNI', 'ifan', 'kedai6.png', 'ifan', 352345678, 'ende', '2020-10-04', 'Laki - Laki', 'oebufu', '23-05-2022', 'ifan@gmail.com', 82223445, 'ifan', '3333', 'ifan.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `jenis_kurir` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `jenis_kurir`) VALUES
(1, 'Gojek'),
(2, 'Grab'),
(3, 'Maxim'),
(4, 'In-Driver');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_kedai` int(11) NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `deskripsi_menu` text NOT NULL,
  `foto_menu` varchar(300) NOT NULL,
  `stok_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kedai`, `nama_menu`, `harga_menu`, `deskripsi_menu`, `foto_menu`, `stok_menu`) VALUES
(1, 1, 'Es Coklat', 18000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'menu1.jpg', 386),
(2, 2, 'Vanilla Buble', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'koi.jpg', 397),
(3, 3, 'Smoothies', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'ss.jpg', 387),
(5, 5, 'Kopi Susu5', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'menu5.jpg', 392),
(6, 6, 'Kopi Susu6', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'menu6.jpeg', 392),
(7, 1, 'Es Kopi', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'menu2.jpg', 499),
(8, 1, 'Avocado Vanilla', 27000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'menu3.jpg', 0),
(9, 1, 'Avocado Choco', 27000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'menu6.jpeg', 500),
(10, 2, 'Vanilla Jelly', 20000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'koi2.jpg', 499),
(11, 2, 'Coklat Buble', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'koi3.jpg', 400),
(12, 2, 'Vanilla Choco', 25000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'koi4.jpg', 500),
(13, 2, 'Choco Jelly', 20000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'koi5.jpg', 500),
(14, 2, 'Avocado Vanilla', 20000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'koi6.jpg', 500),
(15, 3, 'Choco Nuttela', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'ss1.jpg', 497),
(16, 3, 'Choco Taro', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'ss2.jpg', 493),
(17, 3, 'RedvelvetChoco', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'ss3.jpg', 500),
(18, 3, 'Greentea Choco', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'ss5.jpg', 500),
(19, 3, 'Oreo Choco', 20000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'ss6.jpg', 500),
(20, 4, 'Cendol Ori', 12000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'es cendol.jpg', 500),
(21, 4, 'Cendol Mix', 15000, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem id cum quasi a repellendus necessitatibus accusantium praesentium sit! Odit beatae culpa facere deleniti fugit fuga consequatur dolores. Eligendi, amet cupiditate?', 'cendol.jpeg', 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total` varchar(999) NOT NULL,
  `bukti` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `tgl_bayar`, `total`, `bukti`) VALUES
(5, 6, 'Ekhy Welo', 'BANK BCA', '2022-07-09', '45000', 'profil.jpg'),
(6, 17, 'Yanse Oematan', 'BANK MANDIRI', '2022-07-10', '150000', 'WhatsApp Image 2022-07-06 at 17.35.06.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama`, `alamat`, `telepon`, `email`, `password`) VALUES
(1, 'Karlos Nende', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', '085111253741', 'karlos@gmail.com', 'karlos'),
(2, 'Ekhy Welo', 'Jl.Sukun, Oesapa, Oesapa Timur, Kota Kupang', '085239777999', 'eky@gmail.com', 'eky'),
(3, 'Desty Miha Balo', 'Jl. Air Lobang 3, Maulafa, Sikumana, Kota Kupang', '082266229669', 'desty@gmail.com', 'desty'),
(4, 'Elma Kiu', 'Jl. Damai, Oebufu, Oebobo, Kota Kupang', '085238970733', 'elma@gmail.com', 'elma'),
(5, 'Ifan Baletty', 'Jl. Amabi, Oebufu, Oebobo, Kota Kupang', '081334456210', 'ifan@gmail.com', 'ifan'),
(6, 'Yanse Oematan', 'Jl. Damai II Gang Damai 1 RT 30 RW 030 Oebufu', '081339655677', 'yansekiu.haryati2106@gmail.com', 'romansa120300');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `tgl_pembelian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_pembelian` int(11) NOT NULL,
  `jenis_kurir` varchar(200) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending',
  `resi_pengiriman` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pembeli`, `id_kurir`, `tgl_pembelian`, `total_pembelian`, `jenis_kurir`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(1, 1, 3, '2022-06-18 10:07:00', 75000, 'Maxim', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(2, 1, 4, '2022-06-18 16:11:00', 90000, 'In-Driver', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(3, 1, 1, '2022-06-19 17:35:00', 45000, 'Gojek', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(4, 1, 3, '2022-06-20 12:19:00', 45000, 'Maxim', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(5, 1, 1, '2022-06-20 14:32:00', 15000, 'Gojek', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(6, 2, 4, '2022-07-09 11:33:54', 45000, 'In-Driver', 'Jl.Sukun, Oesapa, Oesapa Timur, Kota Kupang', 'Sudah Kirim Pembayaran', ''),
(7, 2, 2, '2022-06-21 04:21:34', 15000, 'Grab', 'Jl.Sukun, Oesapa, Oesapa Timur, Kota Kupang', 'Pending', ''),
(8, 2, 2, '2022-06-21 05:59:14', 120000, 'Grab', 'Jl.Sukun, Oesapa, Oesapa Timur, Kota Kupang', 'Pending', ''),
(9, 1, 1, '2022-06-21 06:02:18', 60000, 'Gojek', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(10, 1, 3, '2022-06-21 06:04:56', 15000, 'Maxim', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(11, 1, 1, '2022-06-21 06:06:16', 15000, 'Gojek', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(12, 1, 4, '2022-06-21 06:06:54', 15000, 'In-Driver', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(13, 3, 2, '2022-06-23 07:11:02', 30000, 'Grab', 'Jl. Air Lobang 3, Maulafa, Sikumana, Kota Kupang', 'Pending', ''),
(14, 5, 2, '2022-06-27 04:41:37', 84000, 'Grab', 'Jl. Amabi, Oebufu, Oebobo, Kota Kupang', 'Pending', ''),
(15, 3, 2, '2022-07-01 04:03:21', 45000, 'Grab', 'Jl. Air Lobang 3, Maulafa, Sikumana, Kota Kupang', 'Pending', ''),
(16, 6, 3, '2022-07-08 19:23:10', 13500000, 'Maxim', 'Jl. Rantai Damai 2 TDM', 'Pending', ''),
(17, 7, 3, '2022-07-10 01:40:15', 150000, 'Maxim', 'Jl. Damai II Gang Damai 1 RT 30 RW 030 Oebufu', 'Sudah Kirim Pembayaran', ''),
(18, 1, 2, '2022-07-22 04:21:31', 36000, 'Grab', 'Jl. Rantai Damai, Kayu Putih, Oebobo, Kota Kupang', 'Pending', ''),
(19, 3, 2, '2022-07-23 14:06:17', 20000, 'Grab', 'Jl. Air Lobang 3, Maulafa, Sikumana, Kota Kupang', 'Pending', ''),
(20, 2, 1, '2022-07-25 15:18:28', 15000, 'Gojek', 'Jl.Sukun, Oesapa, Oesapa Timur, Kota Kupang', 'Pending', ''),
(21, 2, 1, '2022-07-26 19:38:18', 18000, 'Gojek', 'Jl.Sukun, Oesapa, Oesapa Timur, Kota Kupang', 'Pending', ''),
(22, 2, 1, '2022-07-28 02:07:40', 45000, 'Gojek', 'Jl.Sukun, Oesapa, Oesapa Timur, Kota Kupang', 'Pending', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_menu`
--

CREATE TABLE `pembelian_menu` (
  `id_pembelian_menu` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_kedai` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_menu`
--

INSERT INTO `pembelian_menu` (`id_pembelian_menu`, `id_pembelian`, `id_menu`, `id_kedai`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(1, 1, 1, 1, 3, 'Kopi Susu1', 15000, 45000),
(2, 1, 2, 2, 2, 'Kopi Susu2', 15000, 30000),
(3, 2, 1, 1, 3, 'Kopi Susu1', 15000, 45000),
(4, 2, 6, 6, 3, 'Kopi Susu6', 15000, 45000),
(5, 3, 2, 2, 3, 'Kopi Susu2', 15000, 45000),
(6, 4, 1, 1, 3, 'Kopi Susu1', 15000, 45000),
(7, 5, 3, 3, 1, 'Kopi Susu3', 15000, 15000),
(8, 6, 2, 2, 3, 'Kopi Susu2', 15000, 45000),
(9, 7, 3, 3, 1, 'Kopi Susu3', 15000, 15000),
(10, 8, 5, 5, 2, 'Kopi Susu5', 15000, 30000),
(11, 8, 4, 4, 4, 'Kopi susu4', 15000, 60000),
(12, 8, 1, 1, 2, 'Kopi Susu1', 15000, 30000),
(13, 9, 1, 1, 2, 'Kopi Susu1', 15000, 30000),
(14, 9, 3, 3, 2, 'Kopi Susu3', 15000, 30000),
(15, 10, 1, 1, 1, 'Kopi Susu1', 15000, 15000),
(16, 11, 5, 5, 1, 'Kopi Susu5', 15000, 15000),
(17, 12, 4, 4, 1, 'Kopi susu4', 15000, 15000),
(18, 13, 1, 1, 1, 'Kopi Susu1', 15000, 15000),
(19, 13, 3, 3, 1, 'Kopi Susu3', 15000, 15000),
(20, 14, 1, 1, 3, 'Es Coklat', 18000, 54000),
(21, 14, 16, 3, 2, 'Choco Taro', 15000, 30000),
(22, 15, 15, 3, 3, 'Choco Nuttela', 15000, 45000),
(23, 16, 8, 1, 500, 'Avocado Vanilla', 27000, 13500000),
(24, 17, 3, 3, 5, 'Smoothies', 15000, 75000),
(25, 17, 16, 3, 5, 'Choco Taro', 15000, 75000),
(26, 18, 1, 1, 2, 'Es Coklat', 18000, 36000),
(27, 19, 10, 2, 1, 'Vanilla Jelly', 20000, 20000),
(28, 20, 7, 1, 1, 'Es Kopi', 15000, 15000),
(29, 21, 1, 1, 1, 'Es Coklat', 18000, 18000),
(30, 22, 2, 2, 3, 'Vanilla Buble', 15000, 45000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjual`
--

CREATE TABLE `penjual` (
  `id_penjual` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `nik` int(18) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL,
  `jk` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_daftar` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `telepon` int(13) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kedai`
--
ALTER TABLE `kedai`
  ADD PRIMARY KEY (`id_kedai`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_menu`
--
ALTER TABLE `pembelian_menu`
  ADD PRIMARY KEY (`id_pembelian_menu`);

--
-- Indeks untuk tabel `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kedai`
--
ALTER TABLE `kedai`
  MODIFY `id_kedai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pembelian_menu`
--
ALTER TABLE `pembelian_menu`
  MODIFY `id_pembelian_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id_penjual` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
