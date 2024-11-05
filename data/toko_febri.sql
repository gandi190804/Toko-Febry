-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 11:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_febri`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` char(36) NOT NULL,
  `id_menu` char(36) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` char(36) NOT NULL,
  `banyak_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_menu`, `total_harga`, `tanggal`, `waktu`, `deleted_at`, `id_user`, `banyak_item`) VALUES
('0c7bc40f-1513-11ef-a28c-00e04c1a26ed', 'a4766d69-1511-11ef-a28c-00e04c1a26ed', 15000, '2024-05-18', '14:35:02', '2024-05-18 07:35:25', '6163d330-1124-11ef-8cbd-0a0027000002', 1),
('0ec8f47a-1513-11ef-a28c-00e04c1a26ed', 'a4766d69-1511-11ef-a28c-00e04c1a26ed', 30000, '2024-05-18', '14:35:06', '2024-05-18 07:35:25', '6163d330-1124-11ef-8cbd-0a0027000002', 2),
('139ef06c-1513-11ef-a28c-00e04c1a26ed', 'eb47d524-114f-11ef-8cbd-0a0027000002', 30000, '2024-05-18', '14:35:14', '2024-05-18 07:35:25', '6163d330-1124-11ef-8cbd-0a0027000002', 1),
('1d3bb562-1513-11ef-a28c-00e04c1a26ed', 'a4766d69-1511-11ef-a28c-00e04c1a26ed', 15000, '2024-05-18', '14:35:31', '2024-05-18 07:35:36', '6163d330-1124-11ef-8cbd-0a0027000002', 1),
('30e5e569-1513-11ef-a28c-00e04c1a26ed', 'eb47d524-114f-11ef-8cbd-0a0027000002', 30000, '2024-05-18', '14:36:04', '2024-05-18 07:36:21', '6163d330-1124-11ef-8cbd-0a0027000002', 1),
('338c41b7-1513-11ef-a28c-00e04c1a26ed', 'a4766d69-1511-11ef-a28c-00e04c1a26ed', 15000, '2024-05-18', '14:36:08', '2024-05-18 07:36:21', '6163d330-1124-11ef-8cbd-0a0027000002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_pengeluaran`
--

CREATE TABLE `cart_pengeluaran` (
  `id` char(36) NOT NULL,
  `id_menu` char(36) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_pengeluaran`
--

INSERT INTO `cart_pengeluaran` (`id`, `id_menu`, `jumlah_pengeluaran`, `tanggal`, `waktu`, `deleted_at`, `id_user`) VALUES
('20743518-147c-11ef-95ad-00e04c1a26ed', 'eb47d524-114f-11ef-8cbd-0a0027000002', 10000, '2024-05-17', '20:34:42', '2024-05-17 13:53:22', '6163d330-1124-11ef-8cbd-0a0027000002'),
('489d75c4-1511-11ef-a28c-00e04c1a26ed', 'eb47d524-114f-11ef-8cbd-0a0027000002', 10001, '2024-05-18', '14:22:24', '2024-05-18 07:22:43', '6163d330-1124-11ef-8cbd-0a0027000002'),
('7e57b2db-150c-11ef-a28c-00e04c1a26ed', 'eb47d524-114f-11ef-8cbd-0a0027000002', 20000, '2024-05-18', '13:48:07', '2024-05-18 06:48:17', '6163d330-1124-11ef-8cbd-0a0027000002'),
('8795a424-1512-11ef-a28c-00e04c1a26ed', 'a4766d69-1511-11ef-a28c-00e04c1a26ed', 10002, '2024-05-18', '14:31:20', '2024-05-18 07:31:45', '6163d330-1124-11ef-8cbd-0a0027000002'),
('8cf878bf-1512-11ef-a28c-00e04c1a26ed', 'eb47d524-114f-11ef-8cbd-0a0027000002', 10004, '2024-05-18', '14:31:29', '2024-05-18 07:31:45', '6163d330-1124-11ef-8cbd-0a0027000002'),
('9b1daa99-1512-11ef-a28c-00e04c1a26ed', 'a4766d69-1511-11ef-a28c-00e04c1a26ed', 11111, '2024-05-18', '14:31:52', '2024-05-18 07:32:00', '6163d330-1124-11ef-8cbd-0a0027000002'),
('d847bc31-15c0-11ef-ab09-0a0027000002', 'a4766d69-1511-11ef-a28c-00e04c1a26ed', 60000, '2024-05-19', '11:19:07', '2024-05-19 04:19:16', '6163d330-1124-11ef-8cbd-0a0027000002'),
('ff684735-1504-11ef-a28c-00e04c1a26ed', 'eb47d524-114f-11ef-8cbd-0a0027000002', 10000, '2024-05-18', '12:54:28', '2024-05-18 05:54:35', '6163d330-1124-11ef-8cbd-0a0027000002');

-- --------------------------------------------------------

--
-- Table structure for table `cart_users`
--

CREATE TABLE `cart_users` (
  `id` char(36) NOT NULL,
  `id_menu` char(36) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_viewer` char(36) NOT NULL,
  `banyak_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` char(36) NOT NULL,
  `foto_menu` varchar(255) NOT NULL,
  `nama_menu` varchar(60) NOT NULL,
  `kategori_menu` varchar(60) NOT NULL,
  `harga` int(11) NOT NULL,
  `penjualan` varchar(60) NOT NULL,
  `berat_makanan` int(11) NOT NULL,
  `stok` tinyint(1) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `foto_menu`, `nama_menu`, `kategori_menu`, `harga`, `penjualan`, `berat_makanan`, `stok`, `deleted_at`) VALUES
('773d95d6-1505-11ef-a28c-00e04c1a26ed', '60-608505_your-name-wallpaper-hd.png', 'Donat', 'manis', 10000, 'Bungkus', 10, 0, NULL),
('a4766d69-1511-11ef-a28c-00e04c1a26ed', '_MG_7142-removebg-preview.png', 'Donat Kacang', 'manis', 15000, 'Bungkus', 1, 1, NULL),
('da84ea90-1124-11ef-8cbd-0a0027000002', 'tentangkami (2).png', 'Donat123', 'manis', 10000, 'Bungkus', 1, 1, '2024-05-15'),
('eb47d524-114f-11ef-8cbd-0a0027000002', 'Reza Pratama_20 Tahun_Umum.png', 'garam', 'asin', 30000, 'Berat', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pencatatan`
--

CREATE TABLE `pencatatan` (
  `id` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `metode_pembayaran` varchar(60) NOT NULL,
  `hasil` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pencatatan`
--

INSERT INTO `pencatatan` (`id`, `id_user`, `metode_pembayaran`, `hasil`, `tanggal`) VALUES
('19d90ac8-1513-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 75000, '2024-05-18 07:35:25'),
('20b4a54c-1513-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 15000, '2024-05-18 07:35:36'),
('3b84ba30-1513-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 45000, '2024-05-18 07:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `metode_pembayaran` varchar(60) NOT NULL,
  `hasil` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `id_user`, `metode_pembayaran`, `hasil`, `tanggal`) VALUES
('03d74241-1505-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'qris', 10000, '2024-05-18 05:54:35'),
('537371b5-1511-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 10001, '2024-05-18 07:22:43'),
('8428afdd-150c-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'qris', 20000, '2024-05-18 06:48:17'),
('968416cb-1512-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 20006, '2024-05-18 07:31:45'),
('9fef5839-1512-11ef-a28c-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 11111, '2024-05-18 07:32:00'),
('bbbfa490-147e-11ef-95ad-00e04c1a26ed', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 10000, '2024-05-17 13:53:22'),
('ddaec313-15c0-11ef-ab09-0a0027000002', '6163d330-1124-11ef-8cbd-0a0027000002', 'tunai', 60000, '2024-05-19 04:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `no_hp` varchar(60) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `foto_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `no_hp`, `deleted_at`, `foto_user`) VALUES
('179d6f05-1483-11ef-95ad-00e04c1a26ed', 'apik', 'apikan', '$2y$10$D4S0dtH2e1IswZwRQOZGou3K8pvBKtOvjg68WJqQzQJixb20RKt6S', '0987435635', NULL, 'bae-suzy-korean-actress-uhdpaper.com-4K-4.1418.jpg'),
('6163d330-1124-11ef-8cbd-0a0027000002', 'Admin', 'admin', '$2y$10$fqG8fGs7PUMapJ0PEMgFYe2/UnS/g939Yy1Ns9fS1NoxUsKuTQgKq', '08578429432', NULL, '22.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `viewers`
--

CREATE TABLE `viewers` (
  `id` char(36) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `no_hp` varchar(60) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `foto_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viewers`
--

INSERT INTO `viewers` (`id`, `nama`, `username`, `password`, `no_hp`, `deleted_at`, `foto_user`) VALUES
('3b55ef88-15b4-11ef-ab09-0a0027000002', 'Reza', 'rzapratama', '$2y$10$CjH7ASULw91zeehrFpGxvOlhTP5bk3zmGeU8jCrCrIl55URtXY1DK', '085779410576', NULL, 'WhatsApp Image 2024-05-16 at 22.42.15_7012adce.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `fk_cart_user` (`id_user`);

--
-- Indexes for table `cart_pengeluaran`
--
ALTER TABLE `cart_pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `fk_cart_user` (`id_user`);

--
-- Indexes for table `cart_users`
--
ALTER TABLE `cart_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `fk_cart_viewer` (`id_viewer`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pencatatan`
--
ALTER TABLE `pencatatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencatatan_ibfk_1` (`id_user`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengeluaran_ibfk_1` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viewers`
--
ALTER TABLE `viewers`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `pencatatan`
--
ALTER TABLE `pencatatan`
  ADD CONSTRAINT `pencatatan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
