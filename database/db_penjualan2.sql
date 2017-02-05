-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2017 at 07:05 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(25) DEFAULT NULL,
  `ket_kategori` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `ket_kategori`) VALUES
(1, 'Baju Pria', 'Baju Untuk Pria Dewasa'),
(2, 'Baju Wanita', 'Baju untuk wanita dewasa'),
(3, 'Baju Anak', ''),
(4, 'Baju Bayi', 'lol'),
(6, 'Baju asal', ''),
(7, 'Baju Emak', ''),
(8, 'Baju aja', '');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_profil` int(5) NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `level` varchar(1) DEFAULT NULL,
  `session_start` datetime DEFAULT NULL,
  `session_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_profil`, `username`, `password`, `email`, `level`, `session_start`, `session_end`) VALUES
(3, 'admin', '$2y$10$zjBeF8J4YIJAHk6O5GYKs.Md9OR08g7kx1tCv03eUCXWYmhPVjkwG', 'administrator@admin.com', '1', '2017-02-05 11:54:38', NULL),
(4, 'bambang', '$2y$10$CjAqZxRRqLss5QOoPA2bDOKxq1JR84ghffBWM3y6KATci/dXuWJr.', 'mbm@bmb.com', '2', '2017-02-05 11:53:49', NULL),
(5, 'johan', '$2y$10$6tEL3uB78If1vB7mz4RphO8IElLZKc8bdFNuwLWROU4zYBNnNIn.G', 'johan@jn.com', '2', '2017-02-05 01:14:18', NULL),
(6, 'yoyo', '$2y$10$BLlma1M44xiTGNzYbEfQAOu8jxwH9WJWU0bzhSMvoPg5YwVjm.4GG', 'yo@yo.com', '2', '2017-02-05 01:35:02', NULL),
(7, 'andre', '$2y$10$fLLNxbZSq/0pN2ItRbdUvu49QGs4aDfax2xoYmBFVhEgFVj1ZiS8i', 'andre@andre.com', '2', '2017-02-05 10:32:31', NULL),
(8, 'yolo', '$2y$10$dNzl6Cz8aYQrbq.rsycJPuB9h/lU1RC0sXIALiHnfMfnPI4DeFBgS', 'yolo@yolo.com', '2', '2017-02-05 11:40:55', NULL),
(9, 'bambang23', '$2y$10$ne.kZFWxh6sFheQwS2UMke/JRmyafT78VKYHgMA3mG5oX2BezrIx6', 'qw@qw.com', '2', '2017-02-05 11:43:24', NULL),
(10, 'user', '$2y$10$g.3U5x2SO5bufnqn0Q4JiuDsAJoFmDW4RG7sXnaBXmmFYE/YwLR7W', 'user@user.com', '2', '2017-02-05 11:54:22', NULL);

--
-- Triggers `member`
--
DELIMITER $$
CREATE TRIGGER `delete_profile` AFTER DELETE ON `member` FOR EACH ROW BEGIN
	delete from tabel_profile where tabel_profile.id_profile = old.id_profil;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `profil` AFTER INSERT ON `member` FOR EACH ROW BEGIN
		insert into tabel_profile(id_profile,email,foto) values (NEW.id_profil,NEW.email,'no_image.png');
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_product`
--

CREATE TABLE `tabel_product` (
  `id_produk` int(5) NOT NULL,
  `nama_produk` varchar(35) DEFAULT NULL,
  `foto_produk` varchar(15) DEFAULT NULL,
  `ket_produk` text,
  `harga_produk` int(10) DEFAULT NULL,
  `id_penjual` int(5) DEFAULT NULL,
  `ukuran` varchar(10) DEFAULT NULL,
  `id_kategori` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_product`
--

INSERT INTO `tabel_product` (`id_produk`, `nama_produk`, `foto_produk`, `ket_produk`, `harga_produk`, `id_penjual`, `ukuran`, `id_kategori`) VALUES
(2, 'waso', 'no_image.png', 'produk gagal', 123456, NULL, 's', '1'),
(3, 'Bajoo2', 'orang.jpg', 'Bajoo bola', 4567, NULL, 'l', '1'),
(4, 'Weleh 2', 'no_image_2.png', 'woyo 22323', 1500, NULL, 's', '4'),
(5, 'qwe', '1gdjfw_3.jpg', 'baju anak aja', 123, NULL, 's', '3'),
(6, 'cvb', 'no_image_3.png', 'qweqwe', 123, NULL, 'm', '7');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_profile`
--

CREATE TABLE `tabel_profile` (
  `id_profile` int(5) DEFAULT NULL,
  `nama_member` varchar(35) DEFAULT NULL,
  `alamat_member` text,
  `foto` varchar(150) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `tlp_member` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_profile`
--

INSERT INTO `tabel_profile` (`id_profile`, `nama_member`, `alamat_member`, `foto`, `email`, `tlp_member`) VALUES
(3, 'Administrator', 'Jl. Lobang', '12088089_10154107616036840_4488462661110324075_n_1.jpg', 'administrator@admin.com', 768),
(4, NULL, NULL, NULL, 'mbm@bmb.com', NULL),
(5, NULL, NULL, 'no-image.png', 'johan@jn.com', NULL),
(6, NULL, NULL, 'no-image.png', 'yo@yo.com', NULL),
(7, 'Andre Taulani', 'Jl. gajelas lah', 'brokenmissile_1.png', 'andre@andre.com', 2147483647),
(8, NULL, NULL, 'no-image.png', 'yolo@yolo.com', NULL),
(9, 'Bambang', 'Jl. jalan', 'fcuk.jpg', 'qw@qw.com', 895467),
(10, NULL, NULL, 'no_image.png', 'user@user.com', NULL);

--
-- Triggers `tabel_profile`
--
DELIMITER $$
CREATE TRIGGER `update_email` AFTER UPDATE ON `tabel_profile` FOR EACH ROW BEGIN
	update member set member.email=new.email where member.`id_profil`=new.id_profile; 
    END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `tabel_product`
--
ALTER TABLE `tabel_product`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_profil` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tabel_product`
--
ALTER TABLE `tabel_product`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
