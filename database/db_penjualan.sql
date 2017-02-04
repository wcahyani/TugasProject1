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
(1, 'emon', 'xxx', 'cahjbsng@gmail.com', NULL, NULL, NULL),
(2, 'ayu', 'xxxxxx', 'ayu@gmail.com', NULL, NULL, NULL);

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
		insert into tabel_profile(id_profile,email) values (NEW.id_profil,NEW.email);
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

-- --------------------------------------------------------

--
-- Table structure for table `tabel_profile`
--

CREATE TABLE `tabel_profile` (
  `id_profile` int(5) DEFAULT NULL,
  `nama_member` varchar(35) DEFAULT NULL,
  `alamat_member` text,
  `foto` varchar(15) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `tlp_member` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_profile`
--

INSERT INTO `tabel_profile` (`id_profile`, `nama_member`, `alamat_member`, `foto`, `email`, `tlp_member`) VALUES
(1, NULL, NULL, NULL, 'cahjbsng@gmail.com', NULL),
(2, NULL, NULL, NULL, 'ayu@gmail.com', NULL);

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
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_profil` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tabel_product`
--
ALTER TABLE `tabel_product`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
